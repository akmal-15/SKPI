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
        Schema::create('soal', function (Blueprint $table) {
            $table->id('soal_id');
            $table->unsignedBigInteger('materi_id');
            $table->string('soal',100);
            $table->string('jawaban_1', 100);
            $table->string('jawaban_2', 100);
            $table->string('jawaban_3', 100);
            $table->string('jawaban_4', 100);
            $table->string('jawaban', 10);
            $table->timestamps();
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
        Schema::dropIfExists('soals');
    }
};
