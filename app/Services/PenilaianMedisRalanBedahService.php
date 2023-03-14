<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisRalanBedahService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanBedah($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanBedah($params);
    }
}