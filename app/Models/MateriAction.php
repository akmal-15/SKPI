<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriAction extends Model
{
	use HasFactory;
	protected $table = 'materi_action';
	protected $primaryKey = 'materi_action_id';
	protected $fillable = ['*'];
}
