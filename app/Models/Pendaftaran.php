<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Bimbingan;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id_pendaftaran';
    protected $table = 'pendaftarans';
    public $incrementing = true;

    public function bimbingan()
    {
        return $this->hasOne(Bimbingan::class, 'id_pendaftaran', 'id_pendaftaran');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'nim', 'nim');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id');
    }
}