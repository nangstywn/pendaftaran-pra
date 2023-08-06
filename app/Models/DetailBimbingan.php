<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bimbingan;

class DetailBimbingan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id_detail_bimbingan';
    protected $table = 'bimbingan_details';
    public $incrementing = true;

    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class, 'id_bimbingan', 'id_bimbingan');
    }
}