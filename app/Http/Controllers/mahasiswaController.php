<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            "title" => "Materi"

        ]);
    }

    public function materi_detail()
    {
        return view('mahasiswa-layouts.materi-detail', [
            "title" => "Materi Detail"

        ]);
    }

    public function soal()
    {
        return view('mahasiswa-layouts.soal', [
            "title" => "Soal"

        ]);
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

        return view('mahasiswa-layouts.dokumen_akhir' , [
            "title" => "SKPIMU",
            "no" => ".............",
            "user" => $request->authM ,
            "kualifikasi" => !empty($db) ? $db->toArray() : [],
        ]);
    }
}
