<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PenilaianMasterController;

use App\Services\PenilaianPerawatUmumService;
use App\Services\GlobalService;
use App\Services\RawatJalanService;
use App\Services\RiwayatPasienService;

class PenilaianPerawatUmumController extends PenilaianMasterController
{
    //
    public $base_route = "/penilaian-perawat-umum";
    public $table_list = [
        "penilaian" => "penilaian_awal_keperawatan_ralan",
        "masalah"=>"penilaian_awal_keperawatan_ralan_masalah",
        "master_list" => "master_masalah_keperawatan"
    ];
    public $table_list_ranap = [
        "penilaian"=> "penilaian_awal_keperawatan_ranap",
        "masalah"=> "penilaian_awal_keperawatan_ranap_masalah",
        "master_list" => "master_masalah_keperawatan"
    ];
    public $view_list = [
        "index" => 'keperawatan.umum.index',
        "form" => 'keperawatan.umum.form',
        "view" => 'keperawatan.umum.view',
    ];
    public $view_list_ranap = [
        "index" => 'keperawatan.umum.ranap.index',
        "form" => 'keperawatan.umum.ranap.form',
        "view" => 'keperawatan.umum.ranap.view'
    ];
    public $active_tab = "1";
    public $additional_parameter_view =[];
    public $penilaian_source_method ="getPenilaianKeperawatanRalan";
    public $penilaian_ranap_source_method = "getPenilaianKeperawatanRanap";
    public function __construct(
        GlobalService $globalService,
        PenilaianPerawatUmumService $penilaianPasienService,
        RawatJalanService $rawatJalanService,
        RiwayatPasienService $riwayatPasienService
        
    ){
        $this->globalService = $globalService;
        $this->penilaianPasienService = $penilaianPasienService;
        $this->rawatJalanService = $rawatJalanService;
        $this->riwayatPasienService = $riwayatPasienService;
        $this->additional_parameter_view = [
            "masalah_keperawatan_list" =>$this->penilaianPasienService->getMasterList("master_masalah_keperawatan"),
        ];
    }
    public function parsePenilaianData($all_data){
        $all_masalah = [];

        $table_list =  ($all_data['fr'] === "ri" && isset($this->table_list_ranap)) ? $this->table_list_ranap : $this->table_list;
        
        unset($all_data["_token"]);
        unset($all_data["fr"]);
        unset($all_data['no_rm']);
        foreach($all_data as $key => $val){
            if(!isset($val) || $val === "-"){
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
        // end parse data
        $service_parameter = [
            [
                "table" => $table_list["penilaian"],
                "data" => $all_data,
                "type" => 'penilaian'
            ],[
                "table" => $table_list["masalah"],
                "data" => $all_masalah,
                "type" => 'masalah'
            ]
        ];
        return $service_parameter;
    }

    public function formRencana(Request $request){
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);

        if($request->ajax()){
            $returnHTML = view('penilaian.forms.keperawatan.umum.form_rencana')->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }
    public function formMasalah(Request $request){
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);

        if($request->ajax()){
            $returnHTML = view('penilaian.forms.keperawatan.umum.form_masalahgg')->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }
}
