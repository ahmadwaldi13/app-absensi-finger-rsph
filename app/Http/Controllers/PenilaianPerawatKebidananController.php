<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Services\PenilaianPerawatKebidananService;
use App\Services\GlobalService;
use App\Services\RawatJalanService;
use App\Services\RiwayatPasienService;

class PenilaianPerawatKebidananController extends PenilaianMasterController
{
    public $base_route = "/penilaian-perawat-kebidanan";
    public $table_list = [
        "penilaian" => "penilaian_awal_keperawatan_kebidanan",
        "persalinan"=>"riwayat_persalinan_pasien"
    ];
    public $table_list_ranap = [
        "penilaian" => "penilaian_awal_keperawatan_kebidanan_ranap",
        "persalinan"=>"riwayat_persalinan_pasien"
    ];
    public $view_list = [
        "index" => 'keperawatan.kebidanan_kandungan.index',
        "form" => 'keperawatan.kebidanan_kandungan.form',
        "view" => 'keperawatan.kebidanan_kandungan.view',
    ];
    public $view_list_ranap = [
        "index" => 'keperawatan.kebidanan_kandungan.ranap.index',
        "form" => 'keperawatan.kebidanan_kandungan.ranap.form',
        "view" => 'keperawatan.kebidanan_kandungan.ranap.view',
    ]; 

    public $active_tab = "2";
    public $additional_parameter_view =[];
    public $penilaian_source_method ="getPenilaianKeperawatanRalanKandungan";
    public $penilaian_ranap_source_method = "getPenilaianKeperawatanRanapKandungan";
    public function __construct(
    GlobalService $globalService,
        PenilaianPerawatKebidananService $penilaianPasienService,
        RawatJalanService $rawatJalanService
    ){
        $this->globalService = $globalService;
        $this->penilaianPasienService = $penilaianPasienService;
        $this->rawatJalanService = $rawatJalanService;
        $this->additional_parameter_view = [
            "petugas_list" => $this->rawatJalanService->getPetugasList(),
        ];
        
    }
    public function parsePenilaianData($all_data){
        $all_persalinan = [];
        $no_rm = $all_data['no_rm'];
        $table_list =  ($all_data['fr'] === "ri" && isset($this->table_list_ranap)) ? $this->table_list_ranap : $this->table_list;
        unset($all_data["_token"]);
        unset($all_data["fr"]);
        unset($all_data['no_rm']);
        foreach($all_data as $key => $val){
            if(!isset($val) ){
                unset($all_data[$key]);
            }
            if(str_contains($key, "persalinan_table")){
                array_push($all_persalinan,array_merge(
                    ["no_rkm_medis" => $no_rm],
                    json_decode($all_data[$key], true)
                ) );
                unset($all_data[$key]);
            }
        }
        $service_parameter = [
            [
                "table" => $table_list['penilaian'],
                "data" => $all_data,
                "type" => "penilaian"
            ],[
                "table" => $table_list['persalinan'],
                "data" => $all_persalinan,
                "type" => "persalinan"
            ]
        ];
        return $service_parameter;
    }
}
