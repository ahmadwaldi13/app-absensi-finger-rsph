<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GlobalService;
use App\Services\RekamMedisService;
use App\Services\PenilaianPasienService;
use App\Services\RiwayatPasienService;

class ChecklistPostOperasiController extends RmOperasiMasterController
{
    public $base_route = "/check-list-post-operasi";
    public $table_list = [
        "rmoperasi" => "checklist_post_operasi"
    ];
    public $view_list = [
        "index" => 'check-list-post-operasi.index',
        "form_update" => 'check-list-post-operasi.form_update',
        "form" => 'check-list-post-operasi.form',
        "view" => 'check-list-post-operasi.view',
    ];

    public $additional_parameter_view =[];
    public $penilaian_source_method = "get_checklist_post_operasi";

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
