<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisBayiService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanBayi($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanBayi($params);
    }
}