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
        Schema::create('capaian_pembelajaran', function (Blueprint $table) {
            $table->id('cp_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('kemampuan_kerja', 100);
            $table->string('penguasaan_pengetahuan', 100);
            $table->string('sikap_khusus', 100);
            $table->string('prodi', 100);
            $table->timestamps();
            $table->foreign('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capaian_pembelajaran');
    }
};
