<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JadwalUjian;
use App\Models\Dosen;

class DetailJadwalUjian extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id_detail_jadwal_ujian';
    protected $table = 'jadwal_ujian_details';
    public $incrementing = true;

    public function ujian()
    {
        return $this->belongsTo(JadwalUjian::class, 'id_jadwal_ujian');
    }

    public function ketuaPenguji()
    {
        return $this->belongsTo(Dosen::class, 'ketua_penguji');
    }
    public function anggotaPenguji()
    {
        return $this->belongsTo(Dosen::class, 'anggota_penguji');
    }
}
