<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\PenilaianPasienService;
class RmOperasiMasterController extends Controller
{
    //
    public $base_route = "";
    public $table_list = [];
    public $view_list = [];
    public $active_tab = "";
    public $additional_parameter_view =[];
    public $penilaian_source_riwayat_method = "";

    private function data_form($params){

        $no_rawat = !empty($params['no_rawat']) ? $params['no_rawat'] : '';
        $no_rm = !empty($params['no_rm']) ? $params['no_rm'] : '';
        $type_form = !empty($params['type_form']) ? $params['type_form'] : '';

        $return=[];
        if ($no_rawat && $no_rm && $type_form) {

            $data_dokter =null;
            if($type_form!='ri'){
                $paramater = [
                    'reg_periksa.no_rawat' => $no_rawat
                ];
                if($type_form=='rp'){
                    $data_dokter = $this->rekamMedisService->getDokterByRujukanPoli($paramater,2);
                }else{
                    $data_dokter = $this->rekamMedisService->getDokterByRegPeriksa($paramater,2);
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

            $dataPasien = $this->globalService->getDataPasien($no_rm);

            $model['no_rawat']=$no_rawat;
            $model['fr']=$type_form;
            $model['no_rm']=$no_rm;
            $model['nm_pasien']=!empty($dataPasien->nm_pasien) ? $dataPasien->nm_pasien : '';
            $model['tgl_lahir']=!empty($dataPasien->tgl_lahir) ? $dataPasien->tgl_lahir : '';
            $model['jk']=!empty($dataPasien->jk) ? $dataPasien->jk : '';

            $model=(object)$model;

            $getReqPeriksa= (new \App\Models\RegPeriksa)->select('kd_pj')->where('no_rawat',$no_rawat)->first();
            $parameter_where=[
                'jns_perawatan_lab.kategori'=>'PK',
                'jns_perawatan_lab.status'=>'1',
                'penjab.kd_pj'=>!empty($getReqPeriksa->kd_pj) ? $getReqPeriksa->kd_pj : '',
            ];

            $return=[
                "model" => !empty($model) ? $model : [],
            ];
        }

        return $return;
    }


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

        $table_list =  ($item_pasien->no_fr === "ri" && isset($this->table_list_ranap)) ? $this->table_list_ranap : $this->table_list;
        $view_list =  ($item_pasien->no_fr === "ri" && isset($this->view_list_ranap)) ? $this->view_list_ranap : $this->view_list;

        $listPenilaian = $this->penilaianPasienService->getDataRmOperasi($table_list['rmoperasi'],$item_pasien->no_rm, [$filter_start,$filter_end]);

        $paramater_data=[
                'no_rawat'=>$item_pasien->no_rawat,
                'no_rm'=>$item_pasien->no_rm,
                'type_form'=>$item_pasien->no_fr,
            ];

            $parameter_data_form=$this->data_form($paramater_data);

            $parameter_view=[
                "base_route" => $this->base_route,
                'action_form'=> $this->base_route.'/create',
                'penilaian'=> $listPenilaian,
            ];

            // dd($parameter_view);

            $parameter_view=array_merge($parameter_view,$parameter_data_form);
            return view('rm-operasi.'.$view_list['index'],$parameter_view);
        }


    public function actionCreate(Request $request){
        $user = (new \App\Http\Traits\AuthFunction)->getUser();
        if(!array_key_exists("$this->base_route/create", $user->auth_user)){
            return redirect()->back()->with(['error' => "Anda Tidak Memiliki Hak Akses Untuk Tindakan Ini !!"]);
        }

        $all_data  = $request->all();
        $service_parameter = $this->parsePenilaianData($all_data);

        $insert_status = $this->penilaianPasienService->insertPenilaian($service_parameter);
        return redirect()->back()->with($insert_status);
    }

    public function actionView(Request $request){
        $fields = $request->all();

        $exp=explode('@',$fields['data_sent']);

        $no_rawat=!empty($exp[0]) ? $exp[0] : '';
        $tanggal = !empty($exp[1]) ? $exp[1] : '';
        $no_rm = !empty($exp[2]) ? $exp[2] : '';
        $type_akses = !empty($exp[3]) ? $exp[3] : '';

        // kode di bawah setara dengan '$this->riwayatPasienService->namaMethodDidalamServiceRiwayat()'
        $penilaian_data = [$this->riwayatPasienService, $this->penilaian_source_method]([
            'no_rawat' => $no_rawat,
            "tanggal" => $tanggal
        ]);


        $paramater_data=[
                'no_rawat'=>$no_rawat,
                'no_rm'=>$no_rm,
                'type_form'=>$type_akses
            ];


        $parameter_data_form=$this->data_form($paramater_data);

        $parameter_view = [
            'data_pasien'=>$penilaian_data['rmoperasi'][0],
            'form_header'=>$parameter_data_form['model']
        ];

        // dd($parameter_view);

        if($request->ajax()){
            $returnHTML = view('rm-operasi.'.$this->view_list['view'],$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }

    }

    public function actionUpdate(Request $request){
        $user = (new \App\Http\Traits\AuthFunction)->getUser();
        if(!array_key_exists("$this->base_route/create", $user->auth_user)){
            return redirect()->back()->with(['error' => "Anda Tidak Memiliki Hak Akses Untuk Tindakan Ini !!"]);
        }
        $all_data  = $request->all();
        $data_pasien = [
            'no_rawat' => !empty($request->no_rawat) ? $request->no_rawat : '',
            'tanggal' =>!empty($request->tanggal) ? $request->tanggal : ''
        ];


        $service_parameter = $this->parsePenilaianData($all_data);

        $insert_status = $this->penilaianPasienService->updateRmoperasi($service_parameter,$data_pasien);
        // dd($insert_status);

        return redirect()->back()->with($insert_status);
    }
    public function actionDelete(Request $request){
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);

        $no_rawat=!empty($exp[0]) ? $exp[0] : '';
        $tanggal=!empty($exp[1]) ? $exp[1] : '';
        $no_rm=!empty($exp[2]) ? $exp[2] : '';
        $type_akses=!empty($exp[3]) ? $exp[3] : 'rj';


        $service_parameter  = [
            "no_rawat" => $no_rawat,
            "no_rm" => $no_rm,
            "tanggal" => $tanggal,
            "table_list"=> $this->table_list['rmoperasi']
        ];

        $delete_status = $this->penilaianPasienService->deleteRmoperasi($service_parameter);
        // dd($delete_status);
        return redirect()->back()->with($delete_status);

    }
    public function formUpdate(Request $request){
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);

        $no_rawat=!empty($exp[0]) ? $exp[0] : '';
        $tanggal = !empty($exp[1]) ? $exp[1] : '';
        $no_rm = !empty($exp[2]) ? $exp[2] : '';
        $type_akses=!empty($exp[3]) ? $exp[3] : 'ri';

        $table_list =  ($type_akses === "ri" && isset($this->table_list_ranap)) ? $this->table_list_ranap : $this->table_list;
        $view_list = ($type_akses === "ri" && isset($this->view_list_ranap)) ? $this->view_list_ranap : $this->view_list;
        $penilaian_source_method = ($type_akses === "ri" && isset($this->penilaian_ranap_source_method)) ? $this->penilaian_ranap_source_method : $this->penilaian_source_method;
        // kode di bawah setara dengan '$this->riwayatPasienService->namaMethodDidalamServiceRiwayat()'

        $penilaian_data = [$this->riwayatPasienService, $this->penilaian_source_method]([
            'no_rawat' => $no_rawat,
            "tanggal" => $tanggal
        ]);

        $paramater_data=[
                'no_rawat'=>$no_rawat,
                'no_rm'=>$no_rm,
                'type_form'=>$type_akses
            ];


        $parameter_data_form=$this->data_form($paramater_data);

        $parameter_view = [
            'data_pasien'=>$penilaian_data['rmoperasi'][0],
            'form_header'=>$parameter_data_form['model'],

        ];
        // dd($parameter_view);

        if($request->ajax()){
            $returnHTML = view('rm-operasi.'.$this->view_list['form_update'],$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }
}
