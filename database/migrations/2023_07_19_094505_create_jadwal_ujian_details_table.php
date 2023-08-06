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
        Schema::create('jadwal_ujian_details', function (Blueprint $table) {
            $table->increments('id_detail_jadwal_ujian');
            $table->unsignedInteger('id_jadwal_ujian');
            $table->unsignedInteger('id_pendaftaran');
            $table->unsignedInteger('ketua_penguji');
            $table->unsignedInteger('anggota_penguji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ujian_details');
    }
};
