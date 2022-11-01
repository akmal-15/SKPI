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
        Schema::create('kaprodi', function (Blueprint $table) {

            $table->id('kaprodi_id');
            $table->integer('kode_dosen')->unique();
            $table->string('nama', 100);
            $table->string('prodi', 100);
            $table->text('password')->nullable();
            $table->string('token', 10)->nullable()->collation('utf8mb4_bin');
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
        Schema::dropIfExists('kaprodis');
    }
};
