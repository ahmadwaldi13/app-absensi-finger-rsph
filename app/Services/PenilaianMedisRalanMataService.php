<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisRalanMataService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanMata($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanMata($params);
    }
}