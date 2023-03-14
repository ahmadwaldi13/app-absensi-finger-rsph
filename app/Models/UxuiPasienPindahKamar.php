<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UxuiPasienPindahKamar extends \App\Models\MyModel
{
    public $table = 'uxui_pasien_pindah_kamar';
    public $timestamps = false;
    protected $primaryKey = ['no_rkm_medis', 'no_rawat', 'waktu_masuk', 'waktu_keluar', 'kd_kamar_awal', 'kd_kamar_pindah'];
}