<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\GlobalService;

class AjaxController extends Controller
{
    public $globalService;
    
    public function __construct() {
        $this->globalService = new GlobalService;
    }

    function getListJabatan($request){
        $list_data_tmp=(new \App\Models\RefJabatan)->get();
        
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                'kode'=>[
                    'data-item'=>$value->id_jabatan.'@'.$value->nm_jabatan,
                    'value'=>$value->nm_jabatan
                ]
            ];
        }

        $table=[
            'header'=>[
               'title'=> ['Jabatan'],
               'parameter'=>[' class="w-25" ']
            ],
        ];

        $parameter_view=[
            'table'=>$table,
            'list_data'=>!empty($list_data) ? $list_data : ''
        ];

        return [
            'success' => true,
            'html'=>view('ajax.columns_ajax',$parameter_view)->render(),
        ];
    }

    function getListDepartemen($request){
        $list_data_tmp=(new \App\Models\RefDepartemen)->get();
        
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                'kode'=>[
                    'data-item'=>$value->id_departemen.'@'.$value->nm_departemen,
                    'value'=>$value->nm_departemen
                ]
            ];
        }
    
        $table=[
            'header'=>[
               'title'=> ['Departemen/Bidang'],
               'parameter'=>[' class="w-25" ']
            ],
        ];
    
        $parameter_view=[
            'table'=>$table,
            'list_data'=>!empty($list_data) ? $list_data : ''
        ];
    
        return [
            'success' => true,
            'html'=>view('ajax.columns_ajax',$parameter_view)->render(),
        ];
    }

    function getListMesihAbsensi($request){
        $list_data_tmp=(new \App\Models\RefMesinAbsensi)->get();
        
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                'kode'=>[
                    'data-item'=>$value->id_mesin_absensi.'@'.$value->ip_address.'@'.$value->comm_key.'@'.$value->nm_mesin.'@'.$value->lokasi_mesin,
                    'value'=>$value->ip_address
                ],
                $value->nm_mesin,
                $value->lokasi_mesin,
            ];
        }
    
        $table=[
            'header'=>[
               'title'=> ['Ip Mesin','Nama Mesin','Lokasi Mesin'],
               'parameter'=>[' class="w-15" ',' class="w-25" ',' class="w-30" ']
            ],
        ];
    
        $parameter_view=[
            'table'=>$table,
            'list_data'=>!empty($list_data) ? $list_data : ''
        ];
    
        return [
            'success' => true,
            'html'=>view('ajax.columns_ajax',$parameter_view)->render(),
        ];
    }
    
    function getListKaryawan($request){
        $list_data_tmp = (new \App\Services\RefKaryawanService)->getList([], 1)->get();
        
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->nik,
                $value->nip,
                'kode'=>[
                    'data-item'=>$value->id_karyawan.'@'.$value->nm_karyawan.'@'.$value->nik.'@'.$value->nip.'@'.$value->id_jabatan.'@'.$value->nm_jabatan.'@'.$value->id_departemen.'@'.$value->nm_departemen,
                    'value'=>$value->nm_karyawan
                ],
                $value->nm_jabatan,
                $value->nm_departemen,
            ];
        }
    
        $table=[
            'header'=>[
               'title'=> ['NIK','NIP','Nama','Jabatan','Departemen'],
               'parameter'=>[' class="w-5" ',' class="w-5" ',' class="w-25" ',' class="w-25" ',' class="w-25" ']
            ],
        ];
    
        $parameter_view=[
            'table'=>$table,
            'list_data'=>!empty($list_data) ? $list_data : ''
        ];
    
        return [
            'success' => true,
            'html'=>view('ajax.columns_ajax',$parameter_view)->render(),
        ];
    }

    function ajax(Request $request){
        $get_req = $request->all();
        $hasil='';
        if(!empty($get_req['action'])){

            if($get_req['action']=='get_list_jabatan'){
                $hasil=$this->getListJabatan($request);
            }
            
            if($get_req['action']=='get_list_departemen'){
                $hasil=$this->getListDepartemen($request);
            }

            if($get_req['action']=='get_list_mesih_absensi'){
                $hasil=$this->getListMesihAbsensi($request);
            }

            if($get_req['action']=='get_list_karyawan'){
                $hasil=$this->getListKaryawan($request);
            }

            if($request->ajax()){
                return response()->json($hasil);
            }
            
        }
    }
}