<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_ujians', function (Blueprint $table) {
            $table->increments('id_jadwal_ujian');
            $table->unsignedInteger('id_bimbingan');
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->string('ruangan')->nullable();
            $table->tinyInteger('hasil_ujian')->nullable();
            $table->tinyInteger('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ujians');
    }
};
