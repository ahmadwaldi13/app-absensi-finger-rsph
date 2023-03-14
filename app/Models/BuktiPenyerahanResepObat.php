<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPenyerahanResepObat extends Model
{
    protected $fillable = ['no_resep'];
    protected $table = 'bukti_penyerahan_resep_obat';
    public $timestamps = false;
    

}
