<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $primaryKey = 'pengajuan_id';
    protected $fillable = [
        'kegiatan', 'kegiatan_url',  'mahasiswa_id', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
