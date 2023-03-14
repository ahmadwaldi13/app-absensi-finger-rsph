<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisIGDService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisIGD($params){
        return $this->riwayatPasienService->getPenilaianMedisIGD($params);
    }
}