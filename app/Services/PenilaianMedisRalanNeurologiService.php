<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisRalanNeurologiService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanNeurologi($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanNeurologi($params);
    }
}