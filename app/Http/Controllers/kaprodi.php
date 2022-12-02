<?php

namespace App\Http\Controllers;

use App\Models\Kaprodi as ModelsKaprodi;
use App\Models\Mahasiswa;
use App\Models\Materi;
use App\Models\Pengajuan;
use App\Models\Soal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

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
            "menu" => "materi",
            "pesan" => session('pesan') ?? null,
            "materi" => Materi::get()->toArray(),
        ]);
    }

    public function tambah_materi()
    {
        return view('kaprodi-layouts.tambah-materi', [
            "title" => "Tambah Data Materi",
            "menu" => "materi",

        ]);
    }



    public function update_materi(Request $request)
    { {

            $validator = Validator::make(
                $request->input(),
                [
                    "nama_materi" => ["required",],
                    "deskripsi" => ["required"],
                    "waktu_soal" => ["required"],
                    "waktu_exp" => ["required"],
                ]
            );

            if ($validator->fails()) {
                // dd($validator->errors()->toArray()) ;
                return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi", "id" => $request->input("id")]);
            }

            $db = Materi::where('materi_id', $request->input('id'))->first()->toArray();

            if (empty($db)) {
                return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada", "id" => $request->input("id")]);
            }
            $data = [
                "nama_materi" => $request->input('nama_materi'),
                "deskripsi" => $request->input('deskripsi'),
                "waktu_soal" => $request->input('waktu_soal'),
                "waktu_exp" => $request->input('waktu_exp'),
            ];
            if ($data['nama_materi'] != $db['nama_materi']) {
                if (Materi::where('nama_materi', $request->input('nama_materi'))->first()) {
                    return redirect()->back()->with("pesan", ["status" => false, "pesan" => "materi sama", "id" => $request->input("id")]);
                }
            }

            $db = Materi::where('materi_id', $request->input('id'))->update($data);

            if ($db) {
                return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate", "id" => $request->input("id")]);
            } else {
                return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update", "id" => $request->input("id")]);
            }
        }
    }

    public function delete_materi(Request $request)
    { {
            $validator = Validator::make(
                $request->input(),
                [
                    "id" => ["required", "numeric"],

                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi", "id" => $request->input("id")]);
            }

            $db = Materi::where('materi_id', $request->input('id'))->first()->toArray();

            if (empty($db)) {
                return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada", "id" => $request->input("id")]);
            }

            $db = Materi::where('materi_id', $request->input('id'))->delete();

            if ($db) {
                return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate", "id" => $request->input("id")]);
            } else {
                return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update", "id" => $request->input("id")]);
            }
        }
    }



    public function edit_materi()
    {
        return view('', [
            "title" => "Edit Data Materi",
            "menu" => "materi",

        ]);
    }

    public function tambah_soal(Request $request)
    {
        // dd($request->input('id'));
        return view('kaprodi-layouts.tambah-soal', [
            "title" => "Tambah Soal",
            "menu" => "soal",
            'id' => $request->input('id'),

        ]);
    }

    public function soalPost(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => ["required",],
                "soal.*" => ["required"],
                "jawabanA.*" => ["required"],
                "jawabanB.*" => ["required"],
                "jawabanC.*" => ["required"],
                "jawabanD.*" => ["required"],
                "jawaban.*" => ["required"],
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('status', ["status" => false, "pesan" => "gagal validasi"]);
        }

        // dd($request->all());
        $data = [];
        foreach ($request->input("soal") as $i => $val) {
            array_push($data, [
                "materi_id" => $request->input("id"),
                "soal" => $val,
                "jawaban_1" => $request->input("jawabanA")[$i],
                "jawaban_2" => $request->input("jawabanB")[$i],
                "jawaban_3" => $request->input("jawabanC")[$i],
                "jawaban_4" => $request->input("jawabanD")[$i],
                "jawaban" => $request->input("jawaban")[$i]
            ]);
        }
        // dd($data);
        $result = Soal::insert($data);
        if ($result) {
            return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil menambahkan soal"]);
        } else {
            return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal menambahkan soal"]);
        }
    }

    public function updateSoalPost(Request $request)
    { {

            $validator = Validator::make(
                $request->input(),
                [
                    "soal" => ["required",],
                    "jawaban_1" => ["required"],
                    "jawaban_2" => ["required"],
                    "jawaban_3" => ["required"],
                    "jawaban_4" => ["required"],
                    "jawaban" => ["required"],
                ]
            );

            if ($validator->fails()) {
                // dd($validator->errors()->toArray()) ;
                return redirect()->back()->with('pesan', ["status" => false, "pesan" => "gagal validasi", "id" => $request->input("id")]);
            }

            $db = Soal::where('soal_id', $request->input('id'))->first()->toArray();

            if (empty($db)) {
                return redirect()->back()->with("pesan", ["status" => false, "pesan" => "id ga ada", "id" => $request->input("id")]);
            }
            $data = [

                "soal" => $request->input('soal'),
                "jawaban_1" =>  $request->input('jawabanA'),
                "jawaban_2" => $request->input('jawabanB'),
                "jawaban_3" => $request->input('jawabanC'),
                "jawaban_4" => $request->input('jawabanD'),
                "jawaban" => $request->input('jawaban'),

            ];

            // if ($data['soal'] != $db['soal']) {
            //     if (Soal::where('soal', $request->input('soal'))->first()) {
            //         return redirect()->back()->with("pesan", ["status" => false, "pesan" => "Soal sama", "id" => $request->input("id")]);
            //     }
            // }

            // $db = Soal::where('soal', $request->input('id'))->update($data);

            // if ($db) {
            //     return redirect()->back()->with("pesan", ["status" => true, "pesan" => "data terupdate", "id" => $request->input("id")]);
            // } else {
            //     return redirect()->back()->with("pesan", ["status" => false, "pesan" => "gagal update", "id" => $request->input("id")]);
            // }
        }
    }

    public function materiPost(Request $request)
    {
        // dd($request->authK);
        $validator = Validator::make(
            $request->all(),
            [
                "nama_materi" => ["required",],
                "deskripsi" => ["required"],
                "waktu_soal" => ["required"],
                "waktu_exp" => ["required"],
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('status', ["status" => false, "pesan" => "gagal validasi"]);
        }

        if (Materi::where('nama_materi', $request->input("nama_materi"))->first()) {
            return redirect()->back()->with('status', ["status" => false, "pesan" => "nama materi sudah ada"]);
        }
        $data = [
            'kaprodi_id' => $request->authK['kaprodi_id'],
            "nama_materi" => $request->input("nama_materi"),
            "deskripsi" => $request->input("deskripsi"),
            "waktu_soal" => $request->input("waktu_soal"),
            'waktu_exp' => $request->input("waktu_exp")
        ];
        // dd($data);

        $result = Materi::insert($data);
        if ($result) {
            return redirect()->back()->with("status", ["status" => true, "pesan" => "berhasil menambahkan materi"]);
        } else {
            return redirect()->back()->with("status", ["status" => false, "pesan" => "gagal menambahkan materi"]);
        }
    }

    public function data_soal(Request $request)
    {
        // $id = $request->input('id');
        // if(empty($id)) return redirect()->back();

        $materi = Materi::get();
        // $soal = Soal::where('materi_id', $materi->)
        return view('kaprodi-layouts.data-soal', [
            "title" => "Data Soal",
            "menu" => "soal",
            'materi' => empty($materi) ? [] : $materi->toArray(),
        ]);
    }

    public function detail_soal(Request $request)
    {
        // cek id dan wajib ada id
        $id = $request->input('id');
        if(empty($id)) return redirect()->to('/kaprodi/data-soal');
        
        // ambil data soal
        $soal = Soal::where('materi_id', $id)->get();
        // dd($soal->toArray());
        // if(empty($soal)) return redirect()->to('/kaprodi/data-soal');

        return view('kaprodi-layouts.detail-soal', [
            "title" => "Detail Soal",
            "menu" => "soal",
            'id' => $id,
            'soal' => $soal->toArray()

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
            "mahasiswa" => Mahasiswa::where("validasi_dokumen", true)->get()->toArray(),
        ]);
    }

    public function dokumen_akhir(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('mahasiswa_id', $id)->first();
        if (!$mahasiswa) {
            return abort(404);
        }
        $db = Pengajuan::where('mahasiswa_id', $mahasiswa['mahasiswa_id'])->get();

        return view('mahasiswa-layouts.dokumen_akhir', [
            "title" => "SKPIMU",
            "no" => ".............",
            "user" => $mahasiswa->toArray(),
            "kualifikasi" => !empty($db) ? $db->toArray() : [],
        ]);
    }
}
