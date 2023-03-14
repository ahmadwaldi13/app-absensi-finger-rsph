<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedisRalanNeurologiService;
use App\Services\RawatJalanService;
class PenilaianMedisNeurologiController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-neurologi";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_neurologi"
    ];
    public $view_list = [
        "index" => 'medis.neurologi.index',
        "form" => 'medis.neurologi.form',
        "view" => 'medis.neurologi.view',
    ];
    public $active_tab = "11";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanNeurologi";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisRalanNeurologiService $penilaianPasienService,
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
