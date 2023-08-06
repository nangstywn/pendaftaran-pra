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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->increments('id_pendaftaran');
            $table->string('nim');
            $table->integer('id_dosen');
            $table->string('judul')->nullable();
            $table->tinyInteger('semester')->nullable();
            $table->tinyInteger('tahun_ajaran')->nullable();
            $table->date('tanggal')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
