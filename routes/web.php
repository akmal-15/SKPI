<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\kaprodi;
use App\Http\Controllers\mahasiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        "title" => "SKPI FTI UNSERA"
    ]);
});


//Admin
Route::get('/login-admin', [admin::class, 'login']);
Route::get('/logout-admin', [admin::class, 'logout']);
Route::post('/login-admin', [admin::class, 'loginPost']);
Route::get('/admin', [admin::class, 'index'])->middleware("isAdmin");
Route::get('/admin/mahasiswa-tambah', [admin::class, 'tambah'])->middleware("isAdmin");
Route::post('/admin/mahasiswa-tambah', [admin::class, 'tambahPost'])->middleware("isAdmin");
Route::post('/admin/mahasiswa-update', [admin::class, 'updateMahasiswa'])->middleware("isAdmin");
Route::post('/admin/mahasiswa-delete', [admin::class, 'deleteMahasiswa'])->middleware("isAdmin");
// Route::get('/admin/mahasiswa-edit', [admin::class, 'edit']);
Route::get('/admin/kaprodi', [admin::class, 'data_kaprodi'])->middleware("isAdmin");
Route::get('/admin/kaprodi-tambah', [admin::class, 'tambah_kaprodi'])->middleware("isAdmin");
Route::post('/admin/kaprodi-tambah', [admin::class, 'tambah_kaprodiPost'])->middleware("isAdmin");
Route::post('/admin/kaprodi-update', [admin::class, 'updateKaprodi'])->middleware("isAdmin");
Route::post('/admin/kaprodi-delete', [admin::class, 'deleteKaprodi'])->middleware("isAdmin");
Route::get('/admin/kaprodi-edit', [admin::class, 'edit_kaprodi'])->middleware("isAdmin");

//Kaprodi
Route::get('/login-kaprodi', [kaprodi::class, 'login']);
Route::get('/logout-kaprodi', [kaprodi::class, 'logout']);
Route::post('/login-kaprodi', [kaprodi::class, 'loginPost']);
Route::get('/kaprodi', [kaprodi::class, 'index'])->middleware("isKaprodi");
Route::get('/kaprodi/materi-tambah', [kaprodi::class, 'tambah_materi'])->middleware("isKaprodi");
Route::post('/kaprodi/tambah-materi', [kaprodi::class, 'materiPost'])->middleware("isKaprodi");
Route::post('/kaprodi/materi-update', [kaprodi::class, 'update_materi'])->middleware("isKaprodi");
Route::post('/kaprodi/materi-delete', [kaprodi::class, 'delete_materi'])->middleware("isKaprodi");
// Route::get('/kaprodi/materi-edit', [kaprodi::class, 'edit_materi']);
Route::get('/kaprodi/data-soal', [kaprodi::class, 'data_soal'])->middleware("isKaprodi");
Route::get('/kaprodi/tambah-soal', [kaprodi::class, 'tambah_soal'])->middleware("isKaprodi");
Route::post('/kaprodi/tambah-soal', [kaprodi::class, 'soalPost'])->middleware("isKaprodi");
Route::post('/kaprodi/update-soal', [kaprodi::class, 'updateSoalPost'])->middleware("isKaprodi");
Route::get('/kaprodi/data-soal-detail',  [kaprodi::class, 'detail_soal'])->middleware("isKaprodi");
Route::get('/kaprodi/validasi-pengajuan',  [kaprodi::class, 'validasi_pengajuan'])->middleware("isKaprodi");
Route::get('/kaprodi/validasi-pengajuan-detail',  [kaprodi::class, 'detail_validasi'])->middleware("isKaprodi");
Route::post('/kaprodi/validasi-pengajuan-update',  [kaprodi::class, 'update_validasi'])->middleware("isKaprodi");
Route::get('/kaprodi/sudah-validasi',  [kaprodi::class, 'sudah_validasi'])->middleware("isKaprodi");
Route::post('/kaprodi/konfirmasi-validasi',  [kaprodi::class, 'konfirmasi_validasi'])->middleware("isKaprodi");
Route::post('/kaprodi/konfirmasi-validasi-batal',  [kaprodi::class, 'konfirmasi_validasiBatal'])->middleware("isKaprodi");
Route::get('/kaprodi/dokumen',  [kaprodi::class, 'dokumen'])->middleware("isKaprodi")->middleware("isKaprodi");
Route::get('/kaprodi/dokumen/skpi/{id}',  [kaprodi::class, 'dokumen_akhir'])->middleware("isKaprodi")->middleware("isKaprodi");


//Mahasiswa
Route::get('/mahasiswa', [mahasiswaController::class, 'index'])->middleware("isMahasiswa");
Route::get('/login-mahasiswa', [mahasiswaController::class, 'login']);
Route::get('/logout-mahasiswa', [mahasiswaController::class, 'logout']);
Route::post('/login-mahasiswa', [mahasiswaController::class, 'loginPost']);
Route::get('/verifikasi', [mahasiswaController::class, 'verifikasi']);
Route::post('/verifikasi', [mahasiswaController::class, 'verifikasiPost']);
Route::get('/mahasiswa/materi', [mahasiswaController::class, 'materi'])->middleware("isMahasiswa");
Route::get('/mahasiswa/materi-detail', [mahasiswaController::class, 'materi_detail'])->middleware("isMahasiswa");
Route::get('/mahasiswa/soal', [mahasiswaController::class, 'soal'])->middleware("isMahasiswa");
Route::get('/mahasiswa/pengajuan', [mahasiswaController::class, 'pengajuan'])->middleware("isMahasiswa");
Route::post('/mahasiswa/pengajuan', [mahasiswaController::class, 'pengajuanPost'])->middleware("isMahasiswa");
Route::get('/mahasiswa/dokumen', [mahasiswaController::class, 'dokumen'])->middleware("isMahasiswa");
Route::post('/mahasiswa/dokumen-delete', [mahasiswaController::class, 'dokumenDelete'])->middleware("isMahasiswa");
Route::get('/mahasiswa/akun', [mahasiswaController::class, 'akun'])->middleware("isMahasiswa");
Route::get('/mahasiswa/dokumen_akhir', [mahasiswaController::class, 'doc'])->middleware("isMahasiswa");


require __DIR__ . '/auth.php';
