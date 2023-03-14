<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedisRalanPenyakitDalamService;
use App\Services\RawatJalanService;
class PenilaianMedisPenyakitDalamController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-penyakit-dalam";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_penyakit_dalam"
    ];
    public $view_list = [
        "index" => 'medis.penyakit_dalam.index',
        "form" => 'medis.penyakit_dalam.form',
        "view" => 'medis.penyakit_dalam.view',
    ];
    public $active_tab = "12";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanPenyakitDalam";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisRalanPenyakitDalamService $penilaianPasienService,
        RawatJalanService $rawatJalanService
    ){
        $this->globalService = $globalService;
        $this->penilaianPasienService = $penilaianPasienService;
        $this->rawatJalanService = $rawatJalanService;
        $this->additional_parameter_view = [
            "petugas_list" => $this->rawatJalanService->getPetugasDokterList(),
        ];
    }
}
