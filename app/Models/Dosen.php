<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Dosen as Authenticatable;
use App\Models\Pendaftaran;
use App\Models\Bimbingan;

class Dosen extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'dosens';

    protected $hidden = [
        'password',
    ];
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class, 'approver');
    }
}
