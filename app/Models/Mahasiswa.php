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
        'thn_masuk', 'password', 'token', 'verified_at', 'validasi_dokumen'
    ];
    protected $casts = [
        'validasi_dokumen' => 'boolean',
    ];
}
