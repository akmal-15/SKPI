<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class capaian_pembelajaran extends Model
{
    use HasFactory;
    protected $table = 'capaian_pembelajaran';
    protected $primaryKey = 'cp_id';
    protected $fillable = [
        'mahasiswa_id',
        'kemampuan_kerja',
        'penguasaan_pengetahuan',
        'sikap_khusus',
        'prodi',
    ];
}
