<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class no_surat extends Model
{
    use HasFactory;
    protected $table = 'no_surat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_surat',
        'thn_lulus',
    ];
    // tanpa created_at and updated_at
    public $timestamps = false;
}
