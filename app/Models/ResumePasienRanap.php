<?php

namespace App\Models;

class ResumePasienRanap extends \App\Models\MyModel
{
    protected $table = 'resume_pasien_ranap';

    public function getListKeadaanPulangPasien(){
        return ["Membaik", "Sembuh", "Keadaan Khusus", "Meninggal"];
    }

    public function getListCaraKeluarPasien(){
        return ["Atas Izin Dokter", "Pindah RS", "Pulang Atas Permintaan Sendiri", "Lainnya"];
    }

    public function getListPasienDilanjutkan(){
        return ["Kembali Ke RS", "RS Lain", "Dokter Luar", "Puskesmes", "Lainnya"];
    }
}
