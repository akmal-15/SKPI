<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Mahasiswa;
use App\Models\Materi;
use App\Models\MateriAction;
use App\Models\Pengajuan;
use App\Models\Soal;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class mahasiswaController extends Controller
{

	public function logout()
	{
		return redirect("/login-mahasiswa")->withoutCookie("mahasiswa");
	}

	public function login(Request $request)
	{
		$kuki = $request->cookie("mahasiswa");
		if ($kuki) {
			$db = Mahasiswa::where(["token" => $kuki])->first();
			if ($db) {
				return redirect("/mahasiswa");
			}
		}
		return view('login-mahasiswa', [
			"title" => "Login"

		]);
	}

	public function loginPost(Request $request)
	{
		//ngecek nim mahasiswa
		$mahasiswa = Mahasiswa::where(['nim' => $request->input("nim")])->first();
		if (!$mahasiswa) return redirect("/login-mahasiswa")->with('status', 'Username atau Password Salah');

		// ngecek password
		$password = Hash::check($request->input("pass"), $mahasiswa->password);
		if (!$password) return redirect("/login-mahasiswa")->with('status', 'Password Salah');

		// update token login
		$token = Str::random(10);
		$mahasiswa->token = $token;
		return $mahasiswa->save() ? redirect("/mahasiswa")->withCookie("mahasiswa", $token, Carbon::tomorrow()->diffInMinutes(Carbon::now())) : redirect("/login-mahasiswa")->with('status', 'gagal login');
	}

	public function verifikasi()
	{
		return view('verifikasi', [
			"title" => "Daftar Akun"

		]);
	}

	public function verifikasiPost(Request $request)
	{
		$validator = Validator::make(
			$request->only(["nim", "pass", "pass2",]),
			[
				"nim" => ["required", "numeric"],
				"pass" => ["required"],
				"pass2" => ["required", "same:pass"]
			]
		);

		if ($validator->fails()) {
			return redirect()->back()->with('status', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$nim = $request->input("nim");
		$pass = $request->input("pass");
		$mahasiswa = Mahasiswa::where(["nim" => $nim, "verified_at" => null])->first();
		if (!$mahasiswa) {
			return redirect()->back()->with('status', ["status" => false, "pesan" => "nim tidak terdaftar"]);
		}

		$mahasiswa->password = bcrypt($pass);
		if ($mahasiswa->save()) {
			return redirect("/login-mahasiswa");
		} else {
			return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal daftar"]);
		}
	}

	public function index()
	{
		return view('mahasiswa-layouts.home', [
			"title" => "Home"

		]);
	}

	public function materi()
	{
		return view('mahasiswa-layouts.materi', [
			"title" => "Materi",
			"materi" => Materi::get()->toArray()
		]);
	}

	public function materi_detail(Request $request)
	{

		// cek id dan wajib ada id
		$id = $request->input('id');
		if (empty($id)) return redirect()->to('/mahasiswa/materi');

		// ambil data soal
		$materi = Materi::where('materi_id', $id)->first();
		// dd($soal->toArray());
		if (empty($materi)) return redirect()->to('/mahasiswa/materi');

		return view('mahasiswa-layouts.materi-detail', [
			"title" => "Materi Detail",
			'id' => $id,
			'materi' => $materi->toArray(),
			'pesan' => session('pesan') ?? false
		]);
	}

	public function materi_detail_post(Request $request)
	{

		$validator = Validator::make(
			$request->input(),
			[
				"materi" => ["required"],
			]
		);


		if ($validator->fails()) {
			dd($validator->errors()->toArray());
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$materi = Materi::where('materi_id', $request->materi)->first();
		if (empty($materi)) {
			// dd($validator->errors()->toArray());
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "materi tidak ada"]);
		}

		$start = Carbon::now();
		$end = Carbon::now()->addMinutes($materi->waktu_soal);
		$end = $end->greaterThan($materi->waktu_exp) ? $materi->waktu_exp : $end;
		if (Carbon::now()->greaterThan($materi->waktu_exp)) {
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "materi tidak ada"]);
		}
		if ($materi->submit) {
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "anda sudah mengerjakan materi ini"]);
		}
		// $data = [
		// 	'start_at' => 
		// ]
		$data = [
			'materi_id' => $request->materi,
			'mahasiswa_id' => $request->authM['mahasiswa_id'],
			'start_at' => Carbon::now(),
			'end_at' => $end,
			'submit' => true,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		];


		if (MateriAction::insert($data)) {
			return redirect("/mahasiswa/soal?page=1&id=" . $request->materi);
		} else {
			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal memilih materi"]);
		}
	}

	public function soal(Request $request)
	{
		$id = $request->id;
		$page = $request->page;
		if (empty($id) || empty($page) || $page < 0) {
			dd('gagal1');
			return redirect('/mahasiswa/materi');
		}
		$materi = Materi::where('materi_id', $id)->first();
		$materi_action = MateriAction::where('materi_id', $id)->where('mahasiswa_id', $request->authM['mahasiswa_id'])->first();
		if (empty($materi) || empty($materi_action)) {
			dd('gagal2');
			return redirect('/mahasiswa/materi');
		}
		// if (Carbon::now()->greaterThan($materi->waktu_exp) || Carbon::now()->greaterThan($materi_action->end_at)) {
		// 	dd('gagal2');
		// 	return redirect('/mahasiswa/materi');
		// }
		$soal_list = Soal::where('materi_id', $id)->get();
		if (empty($soal_list)) {
			dd('gagal3');
			return redirect('/mahasiswa/materi');
		}
		$soal_list = $soal_list->toArray();
		if ((int) $page > count($soal_list)) {
			dd('gagal4');
			return redirect('/mahasiswa/materi');
		}
		$soal = $soal_list[$page - 1];
		$jawaban = Jawaban::where('soal_id', $soal['soal_id'])->where('mahasiswa_id', $request->authM['mahasiswa_id'])->first();
		return view('mahasiswa-layouts.soal', [
			"title" => "Soal",
			'soal' => $soal,
			'soal_list' => $soal_list,
			'materi' => $materi,
			'materi_action' => $materi_action,
			'page' => $page,
			'id' => $id,
			'jawaban' => $jawaban ? $jawaban->jawaban : null,
		]);
	}

	function soal_post(Request $request)
	{
		$validator = Validator::make(
			$request->input(),
			[
				"url" => ["required"],
				"jawaban" => ['nullable', Rule::in(['a', 'b', 'c', 'd'])],
				"soal_id" => ["required"],
			]
		);
		// dd($request->input());
		if ($validator->fails()) {
			dd($validator->errors()->toArray());
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
		}

		if (empty($request->jawaban)) {

			return redirect($request->url);
		}

		$db = Soal::where('soal_id', $request->soal_id)->first();
		if (empty($db)) {
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "soal tidak ada"]);
		}

		$db = Jawaban::where('soal_id', $request->soal_id)->where('mahasiswa_id', $request->authM['mahasiswa_id'])->first();
		if (empty($db)) {
			$db = new Jawaban();
			$db->soal_id = $request->soal_id;
			$db->mahasiswa_id = $request->authM['mahasiswa_id'];
		}
		$db->jawaban = $request->jawaban;

		if ($db->save()) {
			return redirect($request->url);
		} else {
			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal menjawab soal"]);
		}
	}

	public function pengajuan(Request $request)
	{
		return view('mahasiswa-layouts.pengajuan', [
			"title" => "Pengajuan",
			"mahasiswa" => $request->authM,

		]);
	}

	public function pengajuanPost(Request $request)
	{
		$validator = Validator::make(
			$request->input(),
			[
				"id" => ["required", "numeric", "min:0"],
				"kegiatan.*" => ["required",],
				"link.*" => ["required", "file", "mimes:pdf", "size:1024",],
			]
		);


		if ($validator->fails()) {
			dd($validator->errors()->toArray());
			return redirect()->back()->with('status', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$data = [];
		foreach ($request->input("kegiatan") as $i => $val) {
			array_push($data, [
				"kegiatan" => $val,
				"mahasiswa_id" => $request->input('id'),
			]);
		}
		try {
			$berkas = [];
			foreach ($request->file("link") as $i => $v) {
				$file = $v->store($request->input('id'));
				array_push($berkas, $file);
				$data[$i] += ["kegiatan_url" => $file];
			}
			$result = Pengajuan::insert($data);
			if ($result) {
				return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil mengirim"]);
			} else {
				return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal mengirim"]);
			}
		} catch (\Throwable $th) {
			foreach ($berkas as $v) {
				Storage::delete($v);
			}

			return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal mengirim"]);
		}
	}

	public function dokumenDelete(Request $request)
	{
		$validator = Validator::make(
			$request->input(),
			[
				"id" => ["required", "numeric"],
			]
		);

		if ($validator->fails()) {
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi", "id" => $request->input("id")]);
		}

		$db = Pengajuan::where('pengajuan_id', $request->input('id'))->first()->toArray();

		if (empty($db)) {
			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada", "id" => $request->input("id")]);
		}
		$berkas = $db['kegiatan_url'];

		$db = Pengajuan::where('pengajuan_id', $request->input('id'))->delete();

		if ($db) {
			Storage::delete($berkas);
			return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate", "id" => $request->input("id")]);
		} else {
			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update", "id" => $request->input("id")]);
		}
	}

	public function dokumen(Request $request)
	{
		$mahasiswa = $request->authM;
		$db = Pengajuan::where('mahasiswa_id', $mahasiswa['mahasiswa_id'])->get();
		return view('mahasiswa-layouts.dokumen', [
			"title" => "Dokumen",
			"dokumen" => !empty($db) ? $db->toArray() : [],
			"mahasiswa" => $mahasiswa,
		]);
	}

	public function akun()
	{
		return view('mahasiswa-layouts.akun', [
			"title" => "Akun"

		]);
	}

	public function doc(Request $request)
	{
		$mahasiswa = $request->authM;
		$db = Pengajuan::where('mahasiswa_id', $mahasiswa['mahasiswa_id'])->get();

		return view('mahasiswa-layouts.dokumen_akhir', [
			"title" => "SKPIMU",
			"no" => ".............",
			"user" => $request->authM,
			"kualifikasi" => !empty($db) ? $db->toArray() : [],
		]);
	}
}
