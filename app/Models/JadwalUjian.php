<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bimbingan;
use App\Models\DetailJadwalUjian;

class JadwalUjian extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id_jadwal_ujian';
    protected $table = 'jadwal_ujians';
    public $incrementing = true;

    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class, 'id_bimbingan');
    }

    public function detailUjian()
    {
        return $this->hasOne(DetailJadwalUjian::class, 'id_jadwal_ujian');
    }
}
