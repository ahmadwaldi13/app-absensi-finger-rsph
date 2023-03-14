<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisRalanGeriatriService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanGeriatri($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanGeriatri($params);
    }
}