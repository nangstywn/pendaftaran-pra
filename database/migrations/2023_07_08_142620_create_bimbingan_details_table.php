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
        Schema::create('bimbingan_details', function (Blueprint $table) {
            $table->increments('id_detail_bimbingan');
            $table->unsignedInteger('id_bimbingan');
            $table->string('file')->nullable();
            $table->text('catatan')->nullable();
            $table->dateTime('tanggal');
            $table->string('auth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingan_details');
    }
};