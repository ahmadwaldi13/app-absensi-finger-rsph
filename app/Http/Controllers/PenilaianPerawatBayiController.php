<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Services\PenilaianPerawatBayiService;
use App\Services\GlobalService;
use App\Services\RawatJalanService;
use Illuminate\Support\Facades\DB;
class PenilaianPerawatBayiController extends PenilaianMasterController
{
    public $base_route = "/penilaian-perawat-bayi-anak";
    public $table_list = [
        "penilaian" => "penilaian_awal_keperawatan_ralan_bayi",
        "masalah"=>"penilaian_awal_keperawatan_ralan_bayi_masalah",
        "imunisasi" => "riwayat_imunisasi",
        "master_masalah" => "master_masalah_keperawatan_anak",
        "master_imunisasi"=> "master_imunisasi"
    ];
    public $view_list = [
        "index" => 'keperawatan.bayi_anak.index',
        "form" => 'keperawatan.bayi_anak.form',
        "view" => 'keperawatan.bayi_anak.view',
    ];
    public $active_tab = "4";
    public $additional_parameter_view =[];
    public $penilaian_source_method ="getPenilaianKeperawatanBayi";

    public function __construct(
        GlobalService $globalService,
        PenilaianPerawatBayiService $penilaianPasienService,
        RawatJalanService $rawatJalanService
    ){
        $this->globalService = $globalService;
        $this->penilaianPasienService = $penilaianPasienService;
        $this->rawatJalanService = $rawatJalanService;
        $this->additional_parameter_view = [
            "masalah_keperawatan_list" =>$this->penilaianPasienService->getMasterList($this->table_list['master_masalah']),
            "imunisasi_list" => $this->penilaianPasienService->getMasterList($this->table_list['master_imunisasi']), 
            "petugas_list" => $this->rawatJalanService->getPetugasList(),
        ];
    }
    public function parsePenilaianData($all_data){
        $all_imunisasi = [];
        $all_masalah = [];
        $no_rm = $all_data['no_rm'];
        unset($all_data["_token"]);
        unset($all_data["fr"]);
        unset($all_data['no_rm']);

        foreach($all_data as $key => $val){
            if(!isset($val)|| $val === "-"){
                unset($all_data[$key]);
            }
            if(str_contains($key, "imunisasi_")){
                $data_imunisasi = json_decode($all_data[$key], true);
                unset($data_imunisasi['nama_imunisasi']);
                array_push($all_imunisasi, array_merge(
                    ["no_rkm_medis" => $no_rm],
                    $data_imunisasi
                ) );
                unset($all_data[$key]);
            }
            if(str_contains($key, "mslh_")){
                array_push($all_masalah, [
                    "no_rawat" => $all_data["no_rawat"],
                    "kode_masalah" => $val
                ]);
                unset($all_data[$key]);
            }
        }

        $service_parameter = [
            [
                "table" => $this->table_list['penilaian'],
                "data" => $all_data,
                "type" => "penilaian"
            ],[
                "table" => $this->table_list['masalah'],
                "data" => $all_masalah,
                "type" => "masalah"
            ],[
                "table"=> $this->table_list['imunisasi'],
                "data"=> $all_imunisasi,
                "type"=> "imunisasi"
            ]
        ];
        return $service_parameter;
    }
}
