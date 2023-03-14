<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianMedisKebidananService extends PenilaianMedisUmumService
{
    public function getPenilaianMedisRalanKandungan($params){
        return $this->riwayatPasienService->getPenilaianMedisRalanKandungan($params);
    }
    public function getPenilaianMedisRanapKandungan($params){
        $query = DB::table("penilaian_medis_ranap_kandungan")
                    ->select("penilaian_medis_ranap_kandungan.*", "dokter.nm_dokter")
                    ->join("dokter", "penilaian_medis_ranap_kandungan.kd_dokter", "=" , "dokter.kd_dokter")
                    ->where("penilaian_medis_ranap_kandungan.no_rawat", "=", $params['no_rawat'])
                    ->get();
        return ["penilaian"=> $query];
    }
}