<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenilaianMedisMasterController extends PenilaianMasterController
{
    public function __construct(
        GlobalService $globalService,
        PenilaianPasienService $penilaianPasienService,
        RawatJalanService $rawatJalanService,
        RekamMedisService $rekamMedisService

    ){
        $this->globalService = $globalService;
        $this->penilaianPasienService = $penilaianPasienService;
        $this->rawatJalanService = $rawatJalanService;
        $this->rekamMedisService = $rekamMedisService;
        $this->additional_parameter_view = [
            "petugas_list" => $this->rawatJalanService->getPetugasDokterList(),
        ];
    }
    public function parsePenilaianData($all_data){
        $all_masalah = [];
        $table_list =  ($all_data['fr'] === "ri" && isset($this->table_list_ranap)) ? $this->table_list_ranap : $this->table_list;
        unset($all_data["_token"]);
        unset($all_data["fr"]);
        unset($all_data["no_rm"]);
        foreach($all_data as $key => $val){
            if(!isset($val)){
                $all_data[$key] = "-";
            }
        }
        // end parse data

        $service_parameter = [
            [
                "table" => $table_list['penilaian'],
                "data" => $all_data,
                "type" => 'penilaian'
            ]
        ];
        return $service_parameter;
    }

    public function actionIndex(Request $request){
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        // dd($item_pasien);
        $user = (new \App\Http\Traits\AuthFunction)->getUser();
        if(!array_key_exists($this->base_route, $user->auth_user)){
            return  view('penilaian.index', ["active"=> $this->active_tab])->with(['error' => "Anda Tidak Memiliki Hak Akses Untuk Tindakan Ini !!"]);
        }

        $data=(new \App\Http\Traits\ItemPasienFunction)->setItemPasienFilterTgl($request->fr,$request->form_filter_start,$request->form_filter_end);
        if(!empty($data)){
            $request->form_filter_start=$data->filter_start;
            $request->form_filter_end=$data->filter_end;
        }
        $filter_start=!empty($request->form_filter_start) ? $request->form_filter_start : date('Y-m-d');
        $filter_end=!empty($request->form_filter_end) ? $request->form_filter_end : date('Y-m-d');

        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {
            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

            if($get_user->type_user != "dokter"){
                return view('penilaian.forms.medis.index_error', ['active' => $this->active_tab]);
            }
            if($item_pasien->no_fr!='ri'){
                $paramater = [
                    'reg_periksa.no_rawat' => $item_pasien->no_rawat
                ];
                if($item_pasien->no_fr=='rp'){
                    $data_dokter = $this->penilaianPasienService->getDokterByRujukanPoli($paramater,2);
                }else{
                    $data_dokter = $this->penilaianPasienService->getDokterByRegPeriksa($paramater,2);
                }
            }else{
                $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
                if($get_user->type_user=='dokter'){
                    $data_dokter_tmp = $get_user;
                    $data_dokter=(object)[
                        'kd_dokter'=>$data_dokter_tmp->id_user,
                        'nm_dokter'=>$data_dokter_tmp->nama_user
                    ];
                }else{
                    $data_dokter = [];
                }
            }
            $table_list =  ($item_pasien->no_fr === "ri" && isset($this->table_list_ranap)) ? $this->table_list_ranap : $this->table_list;
            $view_list =  ($item_pasien->no_fr === "ri" && isset($this->view_list_ranap)) ? $this->view_list_ranap : $this->view_list;

            if($item_pasien->no_fr === "ri" && isset($this->table_list_ranap)){
                $listPenilaian = $this->penilaianPasienService->getPenilaianRanapListbyNoRm($table_list['penilaian'], $item_pasien->no_rm, [$filter_start,$filter_end]);
            }else{
                $listPenilaian = $this->penilaianPasienService->getPenilaianListbyNoRm($table_list['penilaian'], $item_pasien->no_rm, [$filter_start,$filter_end]);
            }
            $parameter_view = [
                "user_code" => $get_user->type_user,
                "data_pasien" => $this->globalService->getDataPasien($request->no_rm),
                "list" => $listPenilaian,
                "html_tab" => $view_list['index'],
                "data_dokter" => !empty($data_dokter) ? $data_dokter : [],
                "active" => $this->active_tab,
                "base_route" => $this->base_route,
                "data_params" => (object)$request->only('no_rawat', 'fr')
            ];
            $parameter_view = array_merge($parameter_view, $this->additional_parameter_view);
            return view('penilaian.index',$parameter_view);
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    }
}
