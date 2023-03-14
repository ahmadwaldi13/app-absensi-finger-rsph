<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\RekamMedisService;
use App\Services\PenilaianPasienService;
use App\Services\RiwayatPasienService;
class SignOutSebelumMenutupLukaController extends RmOperasiMasterController
{
    public $base_route = "/sign-out-sebelum-menutup-luka";
    public $table_list = [
        "rmoperasi" => "signout_sebelum_menutup_luka"
    ];
    public $view_list = [
        "index" => 'sign-out-sebelum-menutup-luka.index',
        "form_update" => 'sign-out-sebelum-menutup-luka.form_update',
        "form" => 'sign-out-sebelum-menutup-luka.form',
        "view" => 'sign-out-sebelum-menutup-luka.view',
    ];

    public $additional_parameter_view =[];
    public $penilaian_source_method = "get_signout_sebelum_menutup_luka";

    public function __construct(
        GlobalService $globalService,
        PenilaianPasienService $penilaianPasienService,
        RekamMedisService $rekamMedisService,
        RiwayatPasienService $riwayatPasienService
    )
    {
        $this->globalService = $globalService;
        $this->penilaianPasienService = $penilaianPasienService;
        $this->rekamMedisService = $rekamMedisService;
        $this->riwayatPasienService = $riwayatPasienService;
    }

    public function parsePenilaianData($all_data){
        $all_masalah = [];
        $table_list = $this->table_list;
        unset($all_data["_token"]);
        unset($all_data["fr"]);
        unset($all_data["no_rm"]);
        unset($all_data["key_old"]);
        foreach($all_data as $key => $val){
            if(!isset($val)){
                $all_data[$key] = "-";
            }
        }
        // end parse data

        $service_parameter = [
            [
                "table" => $table_list['rmoperasi'],
                "data" => $all_data,
                "type" => 'rmoperasi'
            ]
        ];
        return $service_parameter;
    }
}
