<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Services\GlobalService;
use App\Services\PenilaianMedisRalanGeriatriService;
use App\Services\RawatJalanService;
class PenilaianMedisGeriatriController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-geriatri";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_geriatri"
    ];
    public $view_list = [
        "index" => 'medis.geriatri.index',
        "form" => 'medis.geriatri.form',
        "view" => 'medis.geriatri.view',
    ];
    public $active_tab = "16";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanGeriatri";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisRalanGeriatriService $penilaianPasienService,
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