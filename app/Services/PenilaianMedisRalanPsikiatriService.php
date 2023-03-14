<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisRalanPsikiatriService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanPsikiatri($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanPsikiatri($params);
    }
}