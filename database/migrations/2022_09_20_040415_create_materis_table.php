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
        Schema::create('materi', function (Blueprint $table) {
            $table->id('materi_id');
            $table->unsignedBigInteger('kaprodi_id');
            $table->string('nama_materi', 100);
            $table->string('deskripsi', 100);
            $table->string('nilai', 100);
            $table->timestamp('waktu_soal');
            $table->timestamps();
            $table->foreign('kaprodi_id')->references('kaprodi_id')->on('kaprodi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materis');
    }
};
