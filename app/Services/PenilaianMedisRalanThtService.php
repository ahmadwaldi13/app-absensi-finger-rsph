<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisRalanThtService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanTht($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanTht($params);
    }
}