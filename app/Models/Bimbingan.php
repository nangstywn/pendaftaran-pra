<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftaran;
use App\Models\DetailBimbingan;
use App\Models\Dosen;
use App\Models\JadwalUjian;

class Bimbingan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id_bimbingan';
    protected $table = 'bimbingans';
    public $incrementing = true;

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }

    public function detailBimbingan()
    {
        return $this->hasMany(DetailBimbingan::class, 'id_bimbingan', 'id_bimbingan');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'approver');
    }

    public function ujian()
    {
        return $this->hasMany(JadwalUjian::class, 'id_jadwal_ujian');
    }
}
