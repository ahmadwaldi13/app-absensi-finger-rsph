<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedisRalanBedahService;
use App\Services\RawatJalanService;
class PenilaianMedisBedahController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-bedah";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_bedah"
    ];
    public $view_list = [
        "index" => 'medis.bedah.index',
        "form" => 'medis.bedah.form',
        "view" => 'medis.bedah.view',
    ];
    public $active_tab = "15";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanBedah";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisRalanBedahService $penilaianPasienService,
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
