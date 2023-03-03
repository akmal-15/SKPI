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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('nilai_id');
            $table->unsignedBigInteger('materi_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->integer('nilai');
            $table->string('grade');
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
        Schema::dropIfExists('nilais');
    }
};
