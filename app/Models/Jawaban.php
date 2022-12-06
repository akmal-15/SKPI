<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
	use HasFactory;
	protected $table = 'jawaban';
	protected $primaryKey = 'jawaban_id';
	protected $fillable = ['*'];
}
