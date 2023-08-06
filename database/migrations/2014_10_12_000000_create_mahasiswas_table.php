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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama_mahasiswa')->nullable();
            $table->tinyInteger('jenis_kelamin')->nullable();
            $table->string('jurusan')->nullable();
            $table->smallInteger('sks')->nullable();
            $table->double('ipk')->nullable();
            $table->year('tahun_angkatan')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
