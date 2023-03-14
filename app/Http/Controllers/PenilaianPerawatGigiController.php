<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Services\PenilaianPasienService;
use App\Services\GlobalService;
use App\Services\RawatJalanService;
use App\Services\PenilaianPerawatGigiService;

class PenilaianPerawatGigiController extends PenilaianMasterController
{
    public $base_route = "/penilaian-perawat-gigi";
    public $table_list = [
        "penilaian" => "penilaian_awal_keperawatan_gigi",
        "masalah"=>"penilaian_awal_keperawatan_gigi_masalah",
        "master_masalah" => "master_masalah_keperawatan_gigi"
    ];
    public $view_list = [
        "index" => 'keperawatan.gigi_mulut.index',
        "form" => 'keperawatan.gigi_mulut.form',
        "view" => 'keperawatan.gigi_mulut.view',
    ];
    public $active_tab = "3";
    public $additional_parameter_view =[];
    public $penilaian_source_method ="getPenilaianKeperawatanGigi";

    public function __construct(
        GlobalService $globalService,
        PenilaianPerawatGigiService $penilaianPasienService,
        RawatJalanService $rawatJalanService
        
    ){
        $this->globalService = $globalService;
        $this->penilaianPasienService = $penilaianPasienService;
        $this->rawatJalanService = $rawatJalanService;
        $this->additional_parameter_view = [
            "masalah_keperawatan_list" =>$this->penilaianPasienService->getMasterList($this->table_list['master_masalah']),
            "petugas_list" => $this->rawatJalanService->getPetugasList(),
        ];
    }
    public function parsePenilaianData($all_data){
        $all_masalah = [];
        unset($all_data["_token"]);
        unset($all_data["fr"]);
        unset($all_data['no_rm']);

        foreach($all_data as $key => $val){
            if(!isset($val) || $val === "-"){
                $all_data[$key] = "-";
            }
            if(str_contains($key, "mslh_")){
                array_push($all_masalah, [
                    "no_rawat" => $all_data["no_rawat"],
                    "kode_masalah" => $val
                ]);
                unset($all_data[$key]);
            }
        }
        // end parse data

        $service_parameter = [
            [
                "table" => $this->table_list["penilaian"],
                "data" => $all_data, 
                "type" => "penilaian"
            ],[
                "table" => $this->table_list["masalah"],
                "data" => $all_masalah,
                "type" => "masalah"
            ]
        ];
        return $service_parameter;
    }
}
