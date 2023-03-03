<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'mahasiswa_id';
    protected $fillable = [
        'nim', 'nama', 'prodi',
        'thn_masuk', 'thn_lulus', 'password', 'token', 'verified_at', 'validasi_dokumen', 'no_ijazah', 
        'tempat_tanggal_lahir',
    ];
    protected $casts = [
        'validasi_dokumen' => 'boolean',
    ];


    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'mahasiswa_id', 'mahasiswa_id');
    }
}
