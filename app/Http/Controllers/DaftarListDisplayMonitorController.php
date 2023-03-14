<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Traits\GlobalFunction;

class DaftarListDisplayMonitorController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Daftar List Display Monitor';
        $this->breadcrumbs=[
            ['title'=>'Setting Aplikasi','url'=>url('/')."/sub-menu?type=3"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];
    
        $this->globalFunction = new GlobalFunction;
    }

    private function data_list(){
        $data_list=[
            [
                'nama'=>'Antrian Farmasi Rawat Jalan',
                'link'=>'monitor/monitor_antrian_farmasi_ralan',
                'keterangan'=>'',
            ],
            [
                'nama'=>'Antrian Farmasi Rawat Inap',
                'link'=>'monitor/monitor_antrian_farmasi_ranap',
                'keterangan'=>'',
            ],
            [
                'nama'=>'Jadwal Operasi',
                'link'=>'monitor/monitor_jadwal_operasi',
                'keterangan'=>'',
            ],
            [
                'nama'=>'Monitor antrian Online JKN',
                'link'=>'anjungan/jkn_online/filter_dashboard_tanggal',
                'keterangan'=>'API_BPJS dan VCLAIM harus di setting terlebih dahulu',
            ],
        ];

        $antrian_poli=[];
        $data_tmp_tmp=( new \App\Models\UxuiSettinganMonitorPoli)->all();
        foreach($data_tmp_tmp as $value){
            if ($value->kode_template == 2) {
                $antrian_poli[]=[
                    'nama'=>'Antrian Poliklinik Template 2',
                    'link'=>'monitor/monitor_antrian_poliklinik?kode='.$value->kode_setting.'&t='.$value->kode_template,
                    'keterangan'=>$value->item_poli,
                ];
            } else {
                $antrian_poli[]=[
                    'nama'=>'Antrian Poliklinik Default',
                    'link'=>'monitor/monitor_antrian_poliklinik?kode='.$value->kode_setting.'&t='.$value->kode_template,
                    'keterangan'=>$value->item_poli,
                ];
            }
        }

        if(!empty($antrian_poli)){
            $data_list=array_merge($data_list,$antrian_poli);
        }

        return $data_list;
    }

    function actionIndex(Request $request){
        $filter_kd_jenis = !empty($request->filter_kd_jenis) ? $request->filter_kd_jenis : '';
        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';
        
        $paramater=[
            'search'=>$form_filter_text
        ];
        if(!empty($filter_kd_jenis)){
            $paramater['jenis']=$filter_kd_jenis;
        }

        // $data_tmp_tmp=( new \App\Models\UxuiSettinganAppVariable );
        $list_data=$this->data_list();

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data
        ];

        return view($this->part_view.'.index',$parameter_view);
    }
}