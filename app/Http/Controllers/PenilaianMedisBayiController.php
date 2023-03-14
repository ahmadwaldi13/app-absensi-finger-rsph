<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedisBayiService;
use App\Services\RawatJalanService;

class PenilaianMedisBayiController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-bayi";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_anak"
    ];
    public $view_list = [
        "index" => 'medis.bayi_anak.index',
        "form" => 'medis.bayi_anak.form',
        "view" => 'medis.bayi_anak.view',
    ];
    public $active_tab = "8";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanBayi";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisBayiService $penilaianPasienService,
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
