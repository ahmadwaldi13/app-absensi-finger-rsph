<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedisRalanPsikiatriService;
use App\Services\RawatJalanService;


class PenilaianMedisPsikiatriController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-psikiatri";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_psikiatrik"
    ];
    public $view_list = [
        "index" => 'medis.psikiatri.index',
        "form" => 'medis.psikiatri.form',
        "view" => 'medis.psikiatri.view',
    ];
    public $active_tab = "10";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanPsikiatri";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisRalanPsikiatriService $penilaianPasienService,
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
