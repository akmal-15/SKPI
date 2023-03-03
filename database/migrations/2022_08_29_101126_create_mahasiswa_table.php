<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mahasiswa', function (Blueprint $table) {
			$table->id('mahasiswa_id');
			$table->integer('nim')->unique();
			$table->string('nama', 100);
			$table->string('prodi', 100);
			$table->string('thn_masuk', 4);
			$table->int('thn_lulus', 20);
			$table->text('password')->nullable();
			$table->boolean('validasi_dokumen')->default(false);
			$table->string('no_ijazah', 50)->nullable();
			$table->string('tempat_tanggal_lahir', 50)->nullable();
			$table->string('token', 10)->nullable()->collation('utf8mb4_bin');
			$table->timestamp('verified_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('mahasiswa');
	}
};
