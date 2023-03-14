<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
class PenilaianPerawatGigiService extends PenilaianPerawatUmumService
{
    public function getPenilaianKeperawatanGigi($params){
        return $this->riwayatPasienService->getPenilaianKeperawatanGigi($params);
    }
}