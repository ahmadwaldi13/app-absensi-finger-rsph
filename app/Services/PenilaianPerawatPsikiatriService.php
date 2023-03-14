<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianPerawatPsikiatriService extends PenilaianPerawatUmumService
{
    public function getPenilaianKeperawatanPsikiatri($params){
        return $this->riwayatPasienService->getPenilaianKeperawatanPsikiatri($params);
    }
}