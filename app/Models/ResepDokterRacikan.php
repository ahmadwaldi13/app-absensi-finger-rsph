<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepDokterRacikan extends Model
{
    protected $table = 'resep_dokter_racikan';
    public function resepDokterRacikanDetail()
    {
        return $this->hasMany(ResepDokterRacikanDetail::class, 'no_resep', 'no_resep')->where('no_racik', $this->no_racik);
    }
}
