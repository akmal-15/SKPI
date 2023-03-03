<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengalaman extends Model
{
    use HasFactory;
    protected $table = 'pengalaman';
    protected $primaryKey = 'pengalaman_id';
    protected $fillable = [
        'kegiatan', 'url',  'mahasiswa_id', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
