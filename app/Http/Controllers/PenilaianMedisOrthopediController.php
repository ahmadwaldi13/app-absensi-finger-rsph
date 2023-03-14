<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedisRalanOrthopediService;
use App\Services\RawatJalanService;
class PenilaianMedisOrthopediController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-orthopedi";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_orthopedi"
    ];
    public $view_list = [
        "index" => 'medis.orthopedi.index',
        "form" => 'medis.orthopedi.form',
        "view" => 'medis.orthopedi.view',
    ];
    public $active_tab = "17";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanOrthopedi";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisRalanOrthopediService $penilaianPasienService,
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
