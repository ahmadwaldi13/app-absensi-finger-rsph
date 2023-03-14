<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedis;
use App\Services\PenilaianMedisRalanThtService;
use App\Services\RawatJalanService;
class PenilaianMedisThtController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-tht";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_tht"
    ];
    public $view_list = [
        "index" => 'medis.tht.index',
        "form" => 'medis.tht.form',
        "view" => 'medis.tht.view',
    ];
    public $active_tab = "14";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanTht";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisRalanThtService $penilaianPasienService,
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
