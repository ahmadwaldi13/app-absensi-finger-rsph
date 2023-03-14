<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GlobalService;
use App\Services\PenilaianMedisUmumService;
use App\Services\RawatJalanService;

class PenilaianMedisUmumController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-umum";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan"
    ];
    public $table_list_ranap = [
        "penilaian" => "penilaian_medis_ranap"
    ];
    public $view_list = [
        "index" => 'medis.umum.index',
        "form" => 'medis.umum.form',
        "view" => 'medis.umum.view',
    ];
    public $view_list_ranap = [
        "index" => 'medis.umum.ranap.index',
        "form" => 'medis.umum.ranap.form',
        "view" => 'medis.umum.ranap.view',
    ];
    public $active_tab = "6";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanUmum";
    public $penilaian_ranap_source_method = "getPenilaianMedisRanapUmum";
    
    public function __construct(
        GlobalService $globalService,
        PenilaianMedisUmumService $penilaianPasienService,
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
