<?php

namespace App\Http\Controllers;

use App\Models\Kaprodi as ModelsKaprodi;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class kaprodi extends Controller
{
    public function login(Request $request)
    {
        $kuki = $request->cookie("kaprodi");
        if ($kuki) {
            $db = ModelsKaprodi::where(["token" => $kuki])->first();
            if ($db) {
                return redirect("/kaprodi");
            }
        }
        return view('login-kaprodi', [
            "title" => "Login Kaprodi ",

        ]);
    }

    public function logout()
    {
        return redirect("/login-kaprodi")->withoutCookie("kaprodi");
    }

    public function loginPost(Request $request)
    {
        // ngecek username admin
        $kaprodi = ModelsKaprodi::where(['kode_dosen' => $request->input("kode-dosen")])->first();
        if (!$kaprodi) return redirect("/login-kaprodi")->with('status', 'Kode Dosen atau Password Salah');

        // ngecek password
        $password = Hash::check($request->input("pass"), $kaprodi->password);
        if (!$password) return redirect("/login-kaprodi")->with('status', 'Password Salah');

        // update token login
        $token = Str::random(10);
        $kaprodi->token = $token;
        return $kaprodi->save() ? redirect("/kaprodi")->withCookie("kaprodi", $token, Carbon::tomorrow()->diffInMinutes(Carbon::now())) : redirect("/login-kaprodi")->with('status', 'gagal login');
    }

    public function index()
    {
        return view('kaprodi-layouts.data-materi', [
            "title" => "Data Materi",
            "menu" => "materi"
        ]);
    }

    public function tambah_materi()
    {
        return view('kaprodi-layouts.tambah-materi', [
            "title" => "Tambah Data Materi",
            "menu" => "materi",

        ]);
    }

    public function edit_materi()
    {
        return view('', [
            "title" => "Edit Data Materi",
            "menu" => "materi",

        ]);
    }

    public function tambah_soal()
    {
        return view('kaprodi-layouts.tambah-soal', [
            "title" => "Tambah Soal",
            "menu" => "soal",

        ]);
    }

    public function data_soal()
    {
        return view('kaprodi-layouts.data-soal', [
            "title" => "Data Soal",
            "menu" => "soal",

        ]);
    }

    public function detail_soal()
    {
        return view('kaprodi-layouts.detail-soal', [
            "title" => "Detail Soal",
            "menu" => "soal",

        ]);
    }

    public function validasi_pengajuan()
    {
        return view('kaprodi-layouts.validasi-pengajuan', [
            "title" => "Validasi Pengajuan",
            "menu" => "validasi",
            "mahasiswa" => Mahasiswa::where("validasi_dokumen", false)->get()->toArray(),
        ]);
    }

    public function sudah_validasi()
    {
        return view('kaprodi-layouts.sudah-validasi', [
            "title" => "Sudah di Validasi",
            "menu" => "validasi",
            "mahasiswa" => Mahasiswa::where("validasi_dokumen", true)->get()->toArray(),

        ]);
    }

    public function detail_validasi(Request $request)
    {
        $id = $request->input('mahasiswa');
        if (!$id) {
            return redirect("/kaprodi/validasi-pengajuan");
        }
        $db = Pengajuan::where("mahasiswa_id", $id)->get();
        return view('kaprodi-layouts.detail-validasi', [
            "title" => "Detail Validasi Pengajuan",
            "menu" => "validasi",
            "mahasiswa" => Mahasiswa::where("mahasiswa_id", $id)->first(),
            "dokumen" => !empty($db) ? $db->toArray() : [],
        ]);
    }

    public function konfirmasi_validasi(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                "id" => ["required", "numeric"],
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
        }

        $db = Mahasiswa::where('mahasiswa_id', $request->input('id'))->first()->toArray();

        if (empty($db)) {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada"]);
        }

        $doc = Pengajuan::where('mahasiswa_id', $request->input('id'))->get()->toArray();
        if (empty($doc)) {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "tidak dokumen"]);
        }
        foreach ($doc as $d) {
            if (!$d['status']) {
                return redirect()->back()->with("pesan", ["status" => false, "pesan" => "dokumen belum tervalidasi semua"]);
            }
        }

        $db = Mahasiswa::where('mahasiswa_id', $request->input('id'))->update(['validasi_dokumen' => true]);

        if ($db) {
            return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate"]);
        } else {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update"]);
        }
    }

    public function konfirmasi_validasiBatal(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                "id" => ["required", "numeric"],
            ]
        );

        if ($validator->fails()) {
            dd($validator->errors(), $request->input());
            return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
        }

        $db = Mahasiswa::where('mahasiswa_id', $request->input('id'))->first()->toArray();

        if (empty($db)) {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada"]);
        }

        $db = Mahasiswa::where('mahasiswa_id', $request->input('id'))->update(['validasi_dokumen' => false]);

        if ($db) {
            return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate"]);
        } else {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update"]);
        }
    }

    public function update_validasi(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                "id" => ["required", "numeric"],
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi"]);
        }

        $db = Pengajuan::where('pengajuan_id', $request->input('id'))->first()->toArray();

        if (empty($db)) {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada"]);
        }

        $status = $db['status'] ? false : true;

        $db = Pengajuan::where('pengajuan_id', $request->input('id'))->update(['status' => $status]);

        if ($db) {
            return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate"]);
        } else {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update"]);
        }
    }

    public function dokumen()
    {
        return view('kaprodi-layouts.dokumen', [
            "title" => "Dokumen Mahasiswa",
            "menu" => "dokemen",

        ]);
    }
}
