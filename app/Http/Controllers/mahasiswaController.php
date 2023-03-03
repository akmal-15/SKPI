<?php

namespace App\Http\Controllers;

use App\Models\capaian_pembelajaran;
use App\Models\Jawaban;
use App\Models\Mahasiswa;
use App\Models\Materi;
use App\Models\MateriAction;
use App\Models\nilai;
use App\Models\no_surat;
use App\Models\Pengajuan;
use App\Models\pengalaman;
use App\Models\Soal;
use Carbon\Carbon;
use Exception;
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
		$mahasiswa->verified_at = Carbon::now();
		if ($mahasiswa->save()) {
			// return redirect("/login-mahasiswa");
			return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil verifikasi"]);
		} else {
			return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal daftar"]);
		}
	}

	public function index(Request $request)
	{
		return view('mahasiswa-layouts.home', [
			"title" => "Home",
			"mhs" => $request->authM
		]);
	}

	public function indexPost(Request $request)
	{
	
		$validator = Validator::make(
			$request->only(["tl", "no_ijazah", "ttl"]),
			[
				"tl" => ["required"],
				"no_ijazah" => ["required"],
				"ttl" => ["required"]
			]
		);

		if ($validator->fails()) {
			return redirect()->back()->with('status', ["status" => false, "pesan" => "gagal validasi"]);
		}

		// cek data mahasiswa nya
		$mhs = Mahasiswa::where('mahasiswa_id', $request->authM['mahasiswa_id'])->first();
		if (empty($mhs)) {
			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada", "id" => $request->input("id")]);
		}
		$mhs->thn_lulus = $request->input("tl");
		$mhs->no_ijazah = $request->input("no_ijazah");
		$mhs->tempat_tanggal_lahir = $request->input("ttl");

		if ($mhs->save()) {
			return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil menyimpan"]);
		} else {
			return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal terkirim"]);
		}
	}

	public function materi(Request $request)
	{
		$pesan = session('pesan');

		// multiple
		$materi = [];
		$ma = MateriAction::where('mahasiswa_id', $request->authM['mahasiswa_id'])->first();
		if (!empty($ma) && Carbon::now()->greaterThan($ma->end_at)) {
			$pesan = ["status" => false, "pesan" => "Anda Sudah Memilih Materi. ( 1 mahasiswa = 1 materi )"];
		}else{
			$materi = Materi::where('prodi', $request->authM['prodi'])->get()->toArray();
		}
		// multiple

		// $materi = Materi::where('prodi', $request->authM['prodi'])->get()->toArray();
		// dd($request->authM['prodi']);
		// dd(Materi::where('prodi', $request->autM['prodi'])->toSql());
		return view('mahasiswa-layouts.materi', [
			"title" => "Materi",
			"ma_ac" => $ma ? $ma->materi_id : '',
			"materi" => $materi,
			"pesan" => $pesan
		]);
	}

	public function materi_detail(Request $request)
	{
		// multiple
		$ma = MateriAction::where('mahasiswa_id', $request->authM['mahasiswa_id'])->first();
		if (!empty($ma) && Carbon::now()->greaterThan($ma->end_at)) {
			return redirect('/mahasiswa/materi')->with("pesan", ["status" => false, "pesan" => "Anda Sudah Memilih Materi. ( 1 mahasiswa = 1 materi )"]);
		}
		// multiple

		// cek id dan wajib ada id
		$id = $request->input('id');
		if (empty($id)) return redirect()->to('/mahasiswa/materi');

		// ambil data soal
		$materi = Materi::where('materi_id', $id)->first();
		// dd($soal->toArray());
		if (empty($materi)) return redirect()->to('/mahasiswa/materi');
		$jumlah = Soal::where('materi_id', $materi->materi_id)->get()->count();
		
		return view('mahasiswa-layouts.materi-detail', [
			"title" => "Materi Detail",
			'id' => $id,
			'materi' => $materi->toArray(),
			'pesan' => session('pesan') ?? false,
			'jumlah' => $jumlah,
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
			// dd($validator->errors()->toArray());
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$materi = Materi::where('materi_id', $request->materi)->first();
		if (empty($materi)) {
			// dd($validator->errors()->toArray());
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "materi tidak ada"]);
		}
		
		// multiple
		$materi_action = MateriAction::where(['mahasiswa_id' => $request->authM['mahasiswa_id']])->first();
		// dd($materi_action->materi_id , (int)$request->materi);
		if($materi_action){
			if($materi_action->materi_id != $request->materi){
				return redirect()->back()->with("pesan", ["status" => false, "pesan" => "1 mahasiswa = 1 materi"]);
			}
		}
		// 

		$materi_action = MateriAction::where(['mahasiswa_id' => $request->authM['mahasiswa_id'], 'materi_id' => $materi->materi_id])->first();
		if($materi_action){
			if(Carbon::now()->greaterThan($materi_action->start_at) && Carbon::now()->lessThan($materi_action->end_at) && !$materi_action->submit){
				return redirect("/mahasiswa/soal?page=1&id=" . $request->materi);
			}else{
				return redirect()->back()->with("pesan", ["status" => false, "pesan" => "materi atau waktu soal sudah expired"]);
			}
		}else{
			$start = Carbon::now();
			$end = Carbon::now()->addMinutes($materi->waktu_soal);
			$end = $end->greaterThan($materi->waktu_exp) ? $materi->waktu_exp : $end;
			if (Carbon::now()->greaterThan($materi->waktu_exp)) {
				return redirect()->back()->with('pesan', ["status" => false, "pesan" => "soal belum di tambahkan"]);
			}
			if ($materi->submit) {
				return redirect()->back()->with('pesan', ["status" => false, "pesan" => "anda sudah mengerjakan materi ini"]);
			}
			$data = [
				'materi_id' => $request->materi,
				'mahasiswa_id' => $request->authM['mahasiswa_id'],
				'start_at' => Carbon::now(),
				'end_at' => $end,
				'submit' => false,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			];

			if (MateriAction::insert($data)) {
				return redirect("/mahasiswa/soal?page=1&id=" . $request->materi);
			} else {
				return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal memilih materi"]);
			}
		}
		
	}

	public function soal(Request $request)
	{
		$id = $request->id;
		$page = $request->page;
		if (empty($id) || empty($page) || $page < 0) {
			return redirect('mahasiswa/materi-detail?id=' . $id);
		}
		$materi = Materi::where('materi_id', $id)->first();
		$materi_action = MateriAction::where('materi_id', $id)->where('mahasiswa_id', $request->authM['mahasiswa_id'])->first();
		// dd($materi, $materi_action);
		if (empty($materi) || empty($materi_action) || $materi_action->submit) {
			// gagal materi dan soal kosong
			// dd('gagal2');
			return redirect('mahasiswa/materi-detail?id='. $id)->with('pesan', ["status" => false, "pesan" => "soal sudah dikerjakan"]);
		}
		$soal_list = Soal::where('materi_id', $id)->orderBy('soal_id', 'asc')->get();
		if (empty($soal_list)) {
			return redirect('mahasiswa/materi-detail?id='. $id);
		}
		$soal_list = $soal_list->toArray();
		if (Carbon::now()->greaterThan($materi->waktu_exp) || Carbon::now()->greaterThan($materi_action->end_at)) {
			// melibihi waktu exp soal
			$soal = Soal::where('materi_id', $materi->materi_id)->get();
			if (empty($soal)) {
				return redirect()->back()->with('pesan', ["status" => false, "pesan" => "soal tidak ada"]);
			}
			$jawaban = Jawaban::where('materi_id', $materi->materi_id)->where('mahasiswa_id', $request->authM['mahasiswa_id'])->orderBy('soal_id', 'asc')->get();
			if (empty($jawaban)) {
				$jawaban = [];
			}
			$benar = 0;
			foreach ($soal as $i => $so) {
				foreach ($jawaban as $i2 => $ja) {
					if ($so->soal_id == $ja->soal_id) {
						if (strtoupper($so->jawaban) === strtoupper($ja->jawaban)) {
							$benar += 1;
							break;
						}
					}
				}
			}
			$grade = "";
			$score = intval(floatval($benar / count($soal->toArray())) * 100);
			if ($score > 90 && $score <= 100) {
				$grade = 'A';
			} else if ($score > 70 && $score <= 90) {
				$grade = 'B';
			} else if ($score > 50 && $score <= 70) {
				$grade = 'C';
			} else if ($score > 30 && $score <= 50) {
				$grade = 'D';
			} else {
				$grade = 'E';
			}
			
			$data = [
				'materi_id' => $materi->materi_id,
				'mahasiswa_id' => $request->authM['mahasiswa_id'],
				'nilai' => $score,
				'grade' => $grade,
			];
			MateriAction::where(['materi_id' => $data['materi_id'], 'mahasiswa_id' => $data['mahasiswa_id']])->update(['submit' => true]);
			Nilai::updateOrCreate(['materi_id' => $data['materi_id'], 'mahasiswa_id' => $data['mahasiswa_id']], $data);
			return redirect('mahasiswa/materi-detail?id='. $id)->with("pesan", ["status" => false, "pesan" => "Anda Telah Mengerjakan"]);
		}
		// dd($soal_list);
		if ((int) $page > count($soal_list)) {
			// dd('gagal4');
			return redirect('mahasiswa/materi-detail?id='. $id);
		}
		$soal = $soal_list[$page - 1];
		// dd($soal);
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
		// dd($request->soal_id);
		if (empty($request->jawaban)) {

			return redirect($request->url);
		}

		$soal = Soal::where('soal_id', $request->soal_id)->first();
		if (empty($soal)) {
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "soal tidak ada"]);
		}

		$db = Jawaban::where('soal_id', $request->soal_id)->where('mahasiswa_id', $request->authM['mahasiswa_id'])->first();
		if (empty($db)) {
			$db = new Jawaban();
			// dd($db);
			$db->soal_id = $request->soal_id;
			$db->mahasiswa_id = $request->authM['mahasiswa_id'];
			$db->materi_id = $soal->materi_id;
		}
		$db->jawaban = $request->jawaban;

		if ($db->save()) {
			return redirect($request->url);
		} else {
			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal menjawab soal"]);
		}
	}

	function soal_submit(Request $request)
	{

		$validator = Validator::make(
			$request->input(),
			[
				"materi_id" => ['required'],

			]
		);
		// dd($request->input());
		if ($validator->fails()) {
			dd($validator->errors()->toArray());
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$materi = Materi::where('materi_id', $request->materi_id)->first();
		if (empty($materi)) {
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "materi tidak ada"]);
		}

		$soal = Soal::where('materi_id', $request->materi_id)->get();
		if (empty($soal)) {
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "soal tidak ada"]);
		}
		$jawaban = Jawaban::where('materi_id', $request->materi_id)->where('mahasiswa_id', $request->authM['mahasiswa_id'])->orderBy('soal_id', 'asc')->get();
		if (empty($jawaban)) {
			$jawaban = [];
		}

		// $nilai = nilai::where('materi_id', $request->materi_id)->where('mahasiswa_id', $request->authM['mahasiswa_id'])->first();
		// if (empty($nilai)) {
		// 	$nilai = new nilai();
		// }
		$benar = 0;
		foreach ($soal as $i => $so) {
			// $merge = $so->toArray();
			foreach ($jawaban as $i2 => $ja) {
				if ($so->soal_id == $ja->soal_id) {
					// $merge += ['jawaban_mhs' => $v2->jawaban];
					// dd(strtoupper($so->jawaban) === strtoupper($ja->jawaban), $so->jawaban ,$ja->jawaban, 'A' == 'A');
					if (strtoupper($so->jawaban) === strtoupper($ja->jawaban)) {
						$benar += 1;
						break;
					}
				}
				// $merge += ['jawaban_mhs' => null];
			}

			// array_push($data, $merge);
		}
		$grade = "";
		$score = intval(floatval($benar / count($soal->toArray())) * 100);
		if ($score > 90 && $score <= 100) {
			$grade = 'A';
		} else if ($score > 70 && $score <= 90) {
			$grade = 'B';
		} else if ($score > 50 && $score <= 70) {
			$grade = 'C';
		} else if ($score > 30 && $score <= 50) {
			$grade = 'D';
		} else {
			$grade = 'E';
		}
		$data = [
			'materi_id' => $materi->materi_id,
			'mahasiswa_id' => $request->authM['mahasiswa_id'],
			'nilai' => $score,
			'grade' => $grade,
		];

		// dd(Nilai::updateOrCreate(['materi_id', 'mahasiswa_id'], $data));
		// dd($benar, count($soal->toArray()), $score);

		MateriAction::where(['materi_id' => $data['materi_id'], 'mahasiswa_id' => $data['mahasiswa_id']])->update(['submit' => true]);
		if (Nilai::updateOrCreate(['materi_id' => $data['materi_id'], 'mahasiswa_id' => $data['mahasiswa_id']], $data)) {
			// if ($nilai->fill($data)->save()) {
			return redirect("/mahasiswa/dokumen")->with("pesan", ["status" => true, "pesan" => "Soal Sudah Dikerjakan"]);
		} else {

			return redirect("/mahasiswa/soal")->with("pesan", ["status" => false, "pesan" => "Soal gagal terkirim"]);
		}
	}

	public function pengajuan(Request $request)
	{
		// dd(Pengajuan::where('mahasiswa_id', 1)->get());
		// dd($request->authM);
		return view('mahasiswa-layouts.pengajuan', [
			"title" => "Pengajuan",
			"mahasiswa" => $request->authM,
			"pengajuan" => null,
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
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$data = [];
		$berkas = [];
		try {
			if(!empty($request->input("kegiatan")) || !empty($request->file("link")) || !empty($request->file("link"))){
				foreach ($request->input("kegiatan") as $i => $val) {
					array_push($data, [
						"kegiatan" => $val,
						"mahasiswa_id" => $request->input('id'),
					]);
				}
				foreach ($request->file("link") as $i => $v) {
					$file = $v->store($request->input('id'));
					array_push($berkas, $file);
					$data[$i] += ["kegiatan_url" => $file];
				}
				$result = Pengajuan::insert($data);
				if ($result) {
					return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil menyimpan"]);
				} else {
					return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal menyimpan"]);
				}
			}
			return redirect()->back();
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
		$db2 = pengalaman::where('mahasiswa_id', $mahasiswa['mahasiswa_id'])->get();
		// dd($mahasiswa);

		$nilaiDB = nilai::where('mahasiswa_id', $mahasiswa['mahasiswa_id'])->get();
		$nilaiDB = $nilaiDB ? $nilaiDB->toArray() : [];  
		foreach($nilaiDB as $i => $v){
			$materi = Materi::where('materi_id' , $v['materi_id'])->first();
			$nilaiDB[$i] += ['materi' => $materi ? $materi->nama_materi : ''];
			if ($v['grade'] == 'A') {
				$nilaiDB[$i]['grade'] = 'Sangat Baik';
			} else if ($v['grade'] == 'B') {
				$nilaiDB[$i]['grade'] = 'Baik';
			} else if ($v['grade'] == 'C') {
				$nilaiDB[$i]['grade'] = 'Kurang Baik';
			} else if ($v['grade'] == 'D') {
				$nilaiDB[$i]['grade'] = 'Cukup';
			} else {
				$nilaiDB[$i]['grade'] = 'Kurang Cukup';
			}
		}
		return view('mahasiswa-layouts.dokumen', [
			"title" => "Dokumen",
			"dokumen" => !empty($db) ? $db->toArray() : [],
			"dokumen2" => !empty($db2) ? $db2->toArray() : [],
			"mahasiswa" => $mahasiswa,
			"nilai" =>  $nilaiDB,
		]);
	}

	public function cek()
	{
		return view('mahasiswa-layouts.cek-kelengkapan', [
			"title" => "Kelengkapan Data Tambahan",
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
		if(!$mahasiswa['validasi_dokumen']) return redirect('/mahasiswa/dokumen')->with('pesan', ["status" => false, "pesan" => "anda belum tervalidasi. silakan hubungi akademik"]);
		if (empty($mahasiswa['thn_lulus']) || empty($mahasiswa['tempat_tanggal_lahir']) || empty($mahasiswa['no_ijazah'])) return redirect('/mahasiswa/dokumen')->with('pesan', ["status" => false, "pesan" => "mahasiswa belum melengkapi data diri"]);
		$db = Pengajuan::where('mahasiswa_id', $mahasiswa['mahasiswa_id'])->where('status' , true)->get();
		$db2 = pengalaman::where('mahasiswa_id', $mahasiswa['mahasiswa_id'])->where('status', true)->get();
		$db3 = capaian_pembelajaran::where('prodi', $mahasiswa['prodi'])->get();

		$materi_action = MateriAction::where('mahasiswa_id', $mahasiswa['mahasiswa_id'])->first();
		if(empty($materi_action)){
			return redirect('/mahasiswa/dokumen')->with('pesan', ["status" => false, "pesan" => "mahasiswa belum memilih materi dan mengerjakan soal"]);
		}
		$nilaiDB = Materi::where(['materi.materi_id' => $materi_action->materi_id, 'mahasiswa_id' => $mahasiswa['mahasiswa_id']])->join('nilai', 'nilai.materi_id', '=', 'materi.materi_id')->get();
		if(empty($nilaiDB) || empty($nilaiDB->toArray())){
			return redirect('/mahasiswa/dokumen')->with('pesan', ["status" => false, "pesan" => "mahasiswa belum memilih materi dan mengerjakan soal"]);
		}
		// dd($materiDB->toArray());
		// $nilaiDB = nilai::where('mahasiswa_id', $mahasiswa['mahasiswa_id'])->get();
		$nilaiDB = $nilaiDB ? $nilaiDB->toArray() : [];
		foreach ($nilaiDB as $i => $v) {
			if ($v['grade'] == 'A') {
				$nilaiDB[$i]['grade'] = 'Sangat Baik';
			} else if ($v['grade'] == 'B') {
				$nilaiDB[$i]['grade'] = 'Baik';
			} else if ($v['grade'] == 'C') {
				$nilaiDB[$i]['grade'] = 'Kurang Baik';
			} else if ($v['grade'] == 'D') {
				$nilaiDB[$i]['grade'] = 'Cukup';
			} else {
				$nilaiDB[$i]['grade'] = 'Kurang Cukup';
			}
		}
		
		// dd(no_surat::where('mahasiswa_id', $request->authM['mahasiswa_id'])->first());
		return view('mahasiswa-layouts.dokumen_akhir', [
			"title" => "SKPI",
			"no" => no_surat::where('thn_lulus', $request->authM['thn_lulus'])->first(),
			"user" => $request->authM,
			"kualifikasi" => !empty($db) ? $db->toArray() : [],
			"kualifikasi2" => !empty($db2) ? $db2->toArray() : [],
			"cp" => !empty($db3) ? $db3->toArray() : [],
			"nilai" =>  $nilaiDB,
		]);
	}

	public function cp(Request $request)
	{
		return view('mahasiswa-layouts.capaian_pembelajaran', [
			"title" => "Capaian Pembelajaran",
			"mahasiswa" => $request->authM,
			'cp' => capaian_pembelajaran::where('mahasiswa_id', $request->authM['mahasiswa_id'])->get(),
			"pengajuan" => null,
		]);
	}

	public function pengalaman(Request $request)
	{
		// dd(Pengajuan::where('mahasiswa_id', 1)->get());
		// dd($request->authM);
		return view('mahasiswa-layouts.pengalaman', [
			"title" => "Pengalaman",
			"mahasiswa" => $request->authM,
			"pengalaman" => null,
		]);
	}

	public function cpPost(Request $request)
	{
		$validator = Validator::make(
			$request->input(),
			[
				"id" => ["required", "numeric", "min:0"],
				"kk.*" => ["required"],
				"pp.*" => ["required"],
				"sk.*" => ["required"],
			]
		);


		if ($validator->fails()) {
			// dd($validator->errors()->toArray());
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$data = [];
		foreach ($request->input("kk") as $i => $val) {
			array_push($data, [
				"kemampuan_kerja" => $val,
				"mahasiswa_id" => $request->input('id'),
				"penguasaan_pengetahuan" => $request->input('pp')[$i],
				"sikap_khusus" => $request->input('sk')[$i],
			]);
		}
		$result = capaian_pembelajaran::where('mahasiswa_id', $request->input('id'))->delete();
		if(!$result) return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal proses"]);
		$result = capaian_pembelajaran::insert($data);
		if ($result) {
			return redirect()->back()->with("pesan", ["status" => true, "pesan" => "berhasil menyimpan"]);
		} else {
			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal menyimpan"]);
		}
	}

	public function pengalamanPost(Request $request)
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
			// dd($validator->errors()->toArray());
			return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
		}

		$data = [];
		$berkas = [];
		try {
			if (!empty($request->input("kegiatan")) || !empty($request->file("link")) || !empty($request->file("link"))) {
				foreach ($request->input("kegiatan") as $i => $val) {
					array_push($data, [
						"kegiatan" => $val,
						"mahasiswa_id" => $request->input('id'),
						'status' => false,
					]);
				}
				foreach ($request->file("link") as $i => $v) {
					$file = $v->store($request->input('id'));
					array_push($berkas, $file);
					$data[$i] += ["url" => $file];
				}
				$result = pengalaman::insert($data);
				if ($result) {
					return redirect()->back()->with("pesan", ["status" => true, "pesan" => "berhasil menyimpan"]);
				} else {
					return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal menyimpan"]);
				}
			}
			return redirect()->back();
		} catch (\Throwable $th) {
			foreach ($berkas as $v) {
				Storage::delete($v);
			}

			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal mengirim"]);
		}
	}

	public function pengalamanDelete(Request $request)
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

		$db = pengalaman::where('pengalaman_id', $request->input('id'))->first()->toArray();

		if (empty($db)) {
			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada", "id" => $request->input("id")]);
		}
		$berkas = $db['url'];

		$db = pengalaman::where('pengalaman_id', $request->input('id'))->delete();

		if ($db) {
			Storage::delete($berkas);
			return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate", "id" => $request->input("id")]);
		} else {
			return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update", "id" => $request->input("id")]);
		}
	}
}
