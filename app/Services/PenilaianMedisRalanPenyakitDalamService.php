<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisRalanPenyakitDalamService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanPenyakitDalam($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanPenyakitDalam($params);
    }
}