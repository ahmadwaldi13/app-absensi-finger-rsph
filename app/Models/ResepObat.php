<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    protected $table = 'resep_obat';
    public $timestamps = false;
    public function resepDokter()
    {
        return $this->hasMany(ResepDokter::class, 'no_resep', 'no_resep');
    }
    public function resepDokterRacikan()
    {
        return $this->hasMany(ResepDokterRacikan::class, 'no_resep', 'no_resep');
    }
}
