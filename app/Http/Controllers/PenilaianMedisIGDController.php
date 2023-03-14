<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedisIGDService;
use App\Services\RawatJalanService;

class PenilaianMedisIGDController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-igd";
    public $table_list = [
        "penilaian" => "penilaian_medis_igd"
    ];
    public $view_list = [
        "index" => 'medis.igd.index',
        "form" => 'medis.igd.form',
        "view" => 'medis.igd.view',
    ];
    public $active_tab = "7";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisIGD";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisIGDService $penilaianPasienService,
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
