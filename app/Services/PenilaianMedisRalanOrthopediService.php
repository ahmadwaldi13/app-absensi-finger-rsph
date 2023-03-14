<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisRalanOrthopediService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanOrthopedi($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanOrthopedi($params);
    }
}