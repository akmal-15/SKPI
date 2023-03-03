<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $primaryKey = 'nilai_id';
    protected $fillable = [
        // "*",
        'nilai', 'grade','materi_id', 'mahasiswa_id'
    ];
}
