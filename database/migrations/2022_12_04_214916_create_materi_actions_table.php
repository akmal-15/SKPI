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
		Schema::create('materi_action', function (Blueprint $table) {
			$table->id('materi_action_id');

			$table->unsignedBigInteger('materi_id');
			$table->unsignedBigInteger('mahasiswa_id');
			$table->boolean('submit');
			$table->timestamp('start_at')->useCurrent();
			$table->timestamp('end_at')->useCurrent();
			$table->timestamps();
			$table->foreign('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('materi_id')->references('materi_id')->on('materi')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('materi_action');
	}
};
