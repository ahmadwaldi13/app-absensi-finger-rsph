<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedisRalanMataService;
use App\Services\RawatJalanService;
class PenilaianMedisMataController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-mata";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_mata"
    ];
    public $view_list = [
        "index" => 'medis.mata.index',
        "form" => 'medis.mata.form',
        "view" => 'medis.mata.view',
    ];
    public $active_tab = "13";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanMata";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisRalanMataService $penilaianPasienService,
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
