<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PenilaianMasterController extends Controller
{
    //
    public $base_route = "";
    public $table_list = [];
    public $view_list = [];
    public $active_tab = "";
    public $additional_parameter_view =[];
    public $penilaian_source_riwayat_method = "";

    public function actionIndex(Request $request){
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
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

            if($get_user->type_user=='petugas'){
                $petugases = $this->globalService->getPetugasList();
                $data_petugas = $this->globalService->getPetugasList(['nip'=>$get_user->id_user]);
                if(!empty($data_petugas[0])){
                    $data_petugas=(object)$data_petugas[0];
                }
            }else if($get_user->type_user=='dokter'){
                $data_dokter = $this->globalService->getDataDokterList(['kd_dokter'=>$get_user->id_user]);
                if(!empty($data_dokter[0])){
                    $data_dokter=(object)$data_dokter[0];
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
                "data_petugas" => !empty($data_petugas) ? $data_petugas : [],
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
    public function actionCreate(Request $request){
        $user = (new \App\Http\Traits\AuthFunction)->getUser();
        if(!array_key_exists("$this->base_route/create", $user->auth_user)){
            return redirect()->back()->with(['error' => "Anda Tidak Memiliki Hak Akses Untuk Tindakan Ini !!"]);
        }

        $all_data  = $request->all();
        !empty($all_data['nip']) ? $all_data['nip'] = $user->id_user : '';
        !empty($all_data['kd_dokter']) ? $all_data['kd_dokter'] = $user->id_user : '';

        $service_parameter = $this->parsePenilaianData($all_data);
        $insert_status = $this->penilaianPasienService->insertPenilaian($service_parameter);

        return redirect()->back()->with($insert_status);
    }

    public function actionView(Request $request){
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : '';
        $no_rm = !empty($exp[3]) ? $exp[3] : '';
        $model=!empty($model[0]) ? $model[0] : (object)[];

        $table_list =  ($type_akses === "ri" && isset($this->table_list_ranap)) ? $this->table_list_ranap : $this->table_list;
        $view_list = ($type_akses === "ri" && isset($this->view_list_ranap)) ? $this->view_list_ranap : $this->view_list;
        $penilaian_source_method = ($type_akses === "ri" && isset($this->penilaian_ranap_source_method)) ? $this->penilaian_ranap_source_method : $this->penilaian_source_method;

        // kode di bawah setara dengan '$this->riwayatPasienService->namaMethodDidalamServiceRiwayat()'
        $penilaian_data = [$this->penilaianPasienService, $penilaian_source_method]([
            'no_rawat' => $no_rawat,
            "no_rm" => $no_rm
        ]);
        $parameter_view=[
            'data_pasien'=>$this->globalService->getDataPasien($no_rm),
            "base_route" => $this->base_route,
            'data_params'=> (object)[
                'no_rawat'=> $no_rawat,
                'fr'=>$type_akses
            ]
        ];
        foreach(array_keys($table_list) as $data_name){
            if($data_name === "penilaian"){
                $parameter_view[$data_name] = isset($penilaian_data[$data_name][0]) ? $penilaian_data[$data_name][0] : $penilaian_data[$data_name];
            }else if(str_contains($data_name,"master")){
                $parameter_view[$data_name] = $this->penilaianPasienService->getMasterList($table_list[$data_name]);
            }else{
                $parameter_view[$data_name] =  $penilaian_data[$data_name];
            }

        }

        if($request->ajax()){
            $returnHTML = view('penilaian.forms.'.$view_list['view'],$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }

    }

    public function actionUpdate(Request $request){
        $user = (new \App\Http\Traits\AuthFunction)->getUser();
        if(!array_key_exists("$this->base_route/create", $user->auth_user)){
            return redirect()->back()->with(['error' => "Anda Tidak Memiliki Hak Akses Untuk Tindakan Ini !!"]);
        }

        $all_data  = $request->all();
        !empty($all_data['nip']) ? $all_data['nip'] = $user->id_user : '';
        !empty($all_data['kd_dokter']) ? $all_data['kd_dokter'] = $user->id_user : '';
        $data_pasien = [
            'no_rkm_medis' =>!empty($request->no_rm) ? $request->no_rm : '',
            'no_rawat' => !empty($request->no_rawat) ? $request->no_rawat : ''
        ];
        $service_parameter = $this->parsePenilaianData($all_data);
        $insert_status = $this->penilaianPasienService->updatePenilaian($service_parameter, $data_pasien);
        return redirect()->back()->with($insert_status);
    }
    public function actionDelete(Request $request){
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';

        $no_rawat=!empty($exp[1]) ? $exp[1] : 0;
        $tgl_perawatan=!empty($exp[2]) ? $exp[2] : 0;
        $no_rm=!empty($exp[3]) ? $exp[3] : 0;
        $total_list = !empty($exp[4]) ? (int)$exp[4] : 0;

        $table_list =  ($type_akses === "ri" && isset($this->table_list_ranap)) ? $this->table_list_ranap : $this->table_list;
        $service_parameter  = [
            "table_list" => $table_list,
            "no_rm" => $no_rm,
            "no_rawat" => $no_rawat,
            "tanggal" => $tgl_perawatan,
            'total_list' => $total_list
        ];
        $delete_status = $this->penilaianPasienService->deletePenilaian($service_parameter);
        return redirect()->back()->with($delete_status);

    }
    public function formUpdate(Request $request){
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : '';
        $no_rm = !empty($exp[3]) ? $exp[3] : '';

        $table_list =  ($type_akses === "ri" && isset($this->table_list_ranap)) ? $this->table_list_ranap : $this->table_list;
        $view_list = ($type_akses === "ri" && isset($this->view_list_ranap)) ? $this->view_list_ranap : $this->view_list;
        $penilaian_source_method = ($type_akses === "ri" && isset($this->penilaian_ranap_source_method)) ? $this->penilaian_ranap_source_method : $this->penilaian_source_method;
        // kode di bawah setara dengan '$this->riwayatPasienService->namaMethodDidalamServiceRiwayat()'
        $penilaian_data = [$this->penilaianPasienService, $penilaian_source_method]([
            'no_rawat' => $no_rawat,
            "no_rm" => $no_rm
        ]);
        $parameter_view=[
            'data_pasien'=>$this->globalService->getDataPasien($no_rm),
            "base_route" => $this->base_route,
            'data_params'=> (object)[
                'no_rawat'=> $no_rawat,
                'fr'=>$type_akses
            ]
        ];
        foreach(array_keys($table_list) as $data_name){
            if($data_name === "penilaian"){
                $parameter_view[$data_name] = isset($penilaian_data[$data_name][0]) ? $penilaian_data[$data_name][0] : $penilaian_data[$data_name];
            }else if(str_contains($data_name,"master")){
                $parameter_view[$data_name] = $this->penilaianPasienService->getMasterList($this->table_list[$data_name]);
            }else{
                $parameter_view[$data_name] =  $penilaian_data[$data_name];
            }

        }
        if($request->ajax()){
            $returnHTML = view('penilaian.forms.'.$view_list['form'],$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }
}
