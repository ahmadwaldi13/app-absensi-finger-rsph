<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\PenilaianMedisKebidananService;
use App\Services\RawatJalanService;

class PenilaianMedisKebidananController extends PenilaianMedisMasterController
{
    public $base_route = "/penilaian-medis-kebidanan";
    public $table_list = [
        "penilaian" => "penilaian_medis_ralan_kandungan"
    ];
    public $table_list_ranap = [
        "penilaian" => "penilaian_medis_ranap_kandungan"
    ];
    public $view_list = [
        "index" => 'medis.kebidanan_kandungan.index',
        "form" => 'medis.kebidanan_kandungan.form',
        "view" => 'medis.kebidanan_kandungan.view',
    ];
    public $view_list_ranap = [
        "index" => 'medis.kebidanan_kandungan.ranap.index',
        "form" => 'medis.kebidanan_kandungan.ranap.form',
        "view" => 'medis.kebidanan_kandungan.ranap.view',
    ];
    public $active_tab = "9";
    public $additional_parameter_view =[];
    public $penilaian_source_method = "getPenilaianMedisRalanKandungan";
    public $penilaian_ranap_source_method = "getPenilaianMedisRanapKandungan";

    public function __construct(
        GlobalService $globalService,
        PenilaianMedisKebidananService $penilaianPasienService,
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
