<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\RawatInap2Service;
use App\Services\BillingRanapService;

class BillingListTagihanPasienRanapController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Billing Pasien Ranap';
        $this->breadcrumbs=[
            ['title'=>'Olah Data Tagihan','url'=>url('/')."/sub-menu?type=9"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->rawatInap2Service = new RawatInap2Service;
        $this->billingRanapService = new BillingRanapService;
    }

    function actionIndex(Request $request){
        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';

        $form_filter_kondisi_waktu=!empty($request->form_filter_kondisi_waktu) ? $request->form_filter_kondisi_waktu : 1;
        $form_filter_kamar=!empty($request->form_filter_kd_kamar) ? $request->form_filter_kd_kamar : '';
        $form_filter_tanggal=[!empty($request->form_filter_date_start) ? $request->form_filter_date_start : date('Y-m-d'),!empty($request->form_filter_date_end) ? $request->form_filter_date_end : date('Y-m-d')];
        $form_filter_stts_bayar = !empty($request->form_filter_stts_bayar) ? $request->form_filter_stts_bayar : '';
        $form_filter_kd_jb = !empty($request->form_filter_kd_jb) ? $request->form_filter_kd_jb : '';

        if(empty($form_filter_kd_jb)){
            $form_filter_kd_jb='BPJ';
            $request->merge(['form_filter_kd_jb' => "BPJ"]);
            $request->merge(['form_filter_jb' => "BPJS"]);
        }

        $per_page = !empty($request->per_page) ? intval($request->per_page) : 1;

        $paramater=[
            'bangsal' => $form_filter_kamar,
            'kondisi_waktu' => $form_filter_kondisi_waktu,
            'tanggal'=>$form_filter_tanggal,
            'status_bayar'=>$form_filter_stts_bayar,
            'jenis_bayar'=>$form_filter_kd_jb,
            'search'=>$form_filter_text,
        ];

        $list_data = $this->rawatInap2Service->getRanapList($paramater)->paginate($per_page ? 10 : $per_page);
        // dd($list_data);
        $item_dr_pj=[];
        foreach($list_data as $key => $value){
            if(!empty($value->no_rawat)){
                $parameter_pj=[
                    'no_rawat'=>$value->no_rawat,
                ];
                $data=$this->globalService->getDokterPjReturnNama($parameter_pj);
                $item_dr_pj[$value->no_rawat]=implode(',',$data);
            }
        }

        $get_stts_bayar=(new \App\Models\RegPeriksa)->getPossibleEnumValues("status_bayar");

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'active_tab'=>2,
            'list_data'=>$list_data,
            'item_dr_pj'=>$item_dr_pj,
            'get_stts_bayar'=>$get_stts_bayar
        ];

        return view($this->part_view.'.index',$parameter_view);
    }

    function actionView(Request $request){
        $kode = !empty($request->data_sent) ? $request->data_sent : '';
        $params_parent_json = !empty($request->params_json) ? $request->params_json : '';
        $params_parent=!empty($params_parent_json) ? json_decode($params_parent_json) : '';

        $no_rawat=$kode;
        $parameter=[
            'no_rawat'=>$no_rawat
        ];

        $check_billing=(new \App\Models\Billing)->where('no_rawat','=',$no_rawat)->count();
        if(!empty($check_billing)){
            $get_data=$this->billingRanapService->getBilling($parameter);
        }else{
            $get_data=$this->billingRanapService->getTagihan($parameter);
        }

        $this->breadcrumbs[1]=['title'=>$this->title,'url'=>(new \App\Http\Traits\GlobalFunction())->generateLink($params_parent, url('/')."/".$this->url_index)];
        $this->breadcrumbs[2]=['title'=>'Data Pasien','url'=>'','active'=>1];

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'get_data'=>(object)$get_data,
            'kode'=>$kode,
            'params_parent_json'=>$params_parent_json,
        ];

        return view($this->part_view.'.view',$parameter_view);
    }
}
