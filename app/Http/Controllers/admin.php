<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin as ModelsAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class admin extends Controller
{
    public function index()
    {
        $db = Mahasiswa::get();
        return view('admin-layouts.data-mahasiswa', [
            "title" => "Data Mahasiswa",
            "menu" => "mahasiswa",
            "pesan" => session('pesan') ?? null,
            "mahasiswa" => !empty($db) ? $db->toArray() : [],
        ]);
    }

    public function login(Request $request)
    {
        $kuki = $request->cookie("admin");
        if ($kuki) {
            $db = ModelsAdmin::where(["token" => $kuki])->first();
            if ($db) {
                return redirect("/admin");
            }
        }
        return view('login-admin', [
            "title" => "Login Admin ",

        ]);
    }

    public function logout()
    {
        return redirect("/login-admin")->withoutCookie("admin");
    }

    public function loginPost(Request $request)
    {
        // ngecek username admin
        $admin = ModelsAdmin::where(['username' => $request->input("username")])->first();
        if (!$admin) return redirect("/login-admin")->with('status', 'Username atau Password Salah');

        // ngecek password
        $password = Hash::check($request->input("pass"), $admin->password);
        if (!$password) return redirect("/login-admin")->with('status', 'Password Salah');

        // update token login
        $token = Str::random(10);
        $admin->token = $token;
        return $admin->save() ? redirect("/admin")->withCookie("admin", $token, Carbon::tomorrow()->diffInMinutes(Carbon::now())) : redirect("/login-admin")->with('status', 'gagal login');
    }

    public function tambah()
    {
        return view('admin-layouts.tambah', [
            "title" => "Tambah Data Mahasiswa",
            "menu" => "mahasiswa",

        ]);
    }

    public function tambahPost(Request $request)
    {
        // dd('ok');
        // dd($request->input());
        // dd($request->only(["nim", "nama", "prodi", "tahun"]));
        $validator = Validator::make(
            $request->only(["nim", "nama", "prodi", "tahun"]),
            [
                "nim.*" => ["required", "numeric", "unique:mahasiswa,nim"],
                "nama.*" => ["required"],
                "prodi.*" => ["required"],
                "tahun.*" => ["required", "numeric"],
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('status', ["status" => false, "pesan" => "gagal validasi"]);
        }

        $data = [];
        foreach ($request->input("nim") as $i => $val) {
            array_push($data, [
                "nim" => $val,
                "nama" => $request->input("nama")[$i],
                "prodi" => $request->input("prodi")[$i],
                "thn_masuk" => $request->input("tahun")[$i],
            ]);
        }

        $result = Mahasiswa::insert($data);
        if ($result) {
            return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil menambahkan mahasiswa"]);
        } else {
            return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal menambahkan mahasiswa"]);
        }
    }

    

    public function deleteMahasiswa(Request $request)
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

        $db = Mahasiswa::where('mahasiswa_id', $request->input('id'))->first()->toArray();

        if (empty($db)) {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada", "id" => $request->input("id")]);
        }

        $db = Mahasiswa::where('mahasiswa_id', $request->input('id'))->delete();

        if ($db) {
            return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate", "id" => $request->input("id")]);
        } else {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update", "id" => $request->input("id")]);
        }

    }

    public function updateMahasiswa(Request $request)
    {
        
        $validator = Validator::make($request->input(),
                [
                    "id" => ["required", "numeric"],
                    "nim" => ["required", "numeric"],
                    "nama" => ["required"],
                    "prodi" => ["required"],
                    "thn" => ["required", "numeric"],
                ]);

        if ($validator->fails()) {
            // dd($validator->errors()->toArray()) ;
            return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi", "id" => $request->input("id")]);
        }
        
        $db = Mahasiswa::where('mahasiswa_id', $request->input('id'))->first()->toArray();
 
        if (empty($db)) {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" =>"id ga ada", "id" => $request->input("id")]);
        }
        $data = [
            "nim" => $request->input('nim'),
            "nama" => $request->input('nama'),
            "prodi" => $request->input('prodi'),
            "thn_masuk" => $request->input('thn'),
        ];
        if ($data['nim'] != $db['nim'])  {
           if (Mahasiswa::where('nim', $request->input('nim'))->first()) {
                return redirect()->back()->with("pesan", ["status" => false, "pesan" => "nim sama", "id" => $request->input("id")]);
           }
        }

        $db = Mahasiswa::where('mahasiswa_id', $request->input('id'))->update($data);

        if ($db) {
            return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate", "id" => $request->input("id")]);
        } else {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update", "id" => $request->input("id")]);
        }
    }

    public function updateKaprodi(Request $request)
    {

        $validator = Validator::make(
            $request->input(),
            [
                "id" => ["required", "numeric"],
                "kode" => ["required", "numeric"],
                "nama" => ["required"],
                "prodi" => ["required"],
            ]
        );

        if ($validator->fails()) {
            // dd($validator->errors()->toArray()) ;
            return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi", "id" => $request->input("id")]);
        }

        $db = Kaprodi::where('kaprodi_id', $request->input('id'))->first()->toArray();

        if (empty($db)) {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada", "id" => $request->input("id")]);
        }
        $data = [
            "kode_dosen" => $request->input('kode'),
            "nama" => $request->input('nama'),
            "prodi" => $request->input('prodi'),
        ];

        if ($data['kode_dosen'] != $db['kode_dosen']) {
            if (Kaprodi::where('kode_dosen', $request->input('kode'))->first()) {
                return redirect()->back()->with("pesan", ["status" => false, "pesan" => "nim sama", "id" => $request->input("id")]);
            }
        }

        $db = Kaprodi::where('kaprodi_id', $request->input('id'))->update($data);

        if ($db) {
            return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate", "id" => $request->input("id")]);
        } else {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update", "id" => $request->input("id")]);
        }
    }

    public function deleteKaprodi(Request $request)
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

        $db = Kaprodi::where('kaprodi_id', $request->input('id'))->first()->toArray();

        if (empty($db)) {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada", "id" => $request->input("id")]);
        }

        $db = Kaprodi::where('kaprodi_id', $request->input('id'))->delete();

        if ($db) {
            return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate", "id" => $request->input("id")]);
        } else {
            return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update", "id" => $request->input("id")]);
        }
    }

    public function tambah_kaprodiPost(Request $request)
    {
        $validator = Validator::make(
            $request->only(["kodeDosen", "namaDosen", "prodi",]),
            [
                "kodeDosen.*" => ["required", "numeric", "unique:kaprodi,kode_dosen"],
                "namaDosen.*" => ["required"],
                "prodi.*" => ["required"],
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('status', ["status" => false, "pesan" => "gagal validasi"]);
        }

        $data = [];
        foreach ($request->input("kodeDosen") as $i => $val) {
            array_push($data, [
                "kode_dosen" => $val,
                "nama" => $request->input("namaDosen")[$i],
                "prodi" => $request->input("prodi")[$i],
                "password" => bcrypt("kaprodi"),
            ]);
        }


        $result = Kaprodi::insert($data);
        if ($result) {
            return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil menambahkan kaprodi"]);
        } else {
            return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal menambahkan kaprodi"]);
        }
    }

    public function edit()
    {
        return view('admin-layouts.edit', [
            "title" => "Edit Data Mahasiswa",
            "menu" => "mahasiswa",

        ]);
        // Hash::check("","")
    }

    public function data_kaprodi()
    {
        $db = Kaprodi::get();
        return view('admin-layouts.data-kaprodi', [
            "title" => "Data Kaprodi",
            "menu" => "kaprodi",
            "pesan" => session('pesan') ?? null,
            "kaprodi" => !empty($db) ? $db->toArray() : [],
        ]);
    }

    public function tambah_kaprodi()
    {
        return view('admin-layouts.tambah-kaprodi', [
            "title" => "Tambah Data Kaprodi",
            "menu" => "kaprodi",

        ]);
    }
    public function edit_kaprodi()
    {
        return view('admin-layouts.edit-kaprodi', [
            "title" => "Edit Data Kaprodi",
            "menu" => "kaprodi",

        ]);
    }
}
