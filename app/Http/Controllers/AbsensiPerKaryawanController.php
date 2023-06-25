<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\DataAbsensiKaryawanService;

class AbsensiPerKaryawanController extends \App\Http\Controllers\MyAuthController
{

    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;
    public $dataAbsensiKaryawanService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Data Absensi';
        $this->breadcrumbs = [
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->dataAbsensiKaryawanService = new DataAbsensiKaryawanService;
    }

    function actionIndex(Request $request){
    
        $filter_date_start=!empty($request->filter_date_start) ? $request->filter_date_start : date('Y-m-d');
        $filter_date_end=!empty($request->filter_date_end) ? $request->filter_date_end : date('Y-m-d');

        $filter_status_absensi=!empty($request->filter_status_absensi) ? $request->filter_status_absensi : '';
        $filter_cara_absensi=!empty($request->filter_cara_absensi) ? $request->filter_cara_absensi : '';

        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
        
        if(!empty($get_user->data_user_sistem)){
            if(!empty($get_user->data_user_sistem->id_karyawan)){
                
                $paramater = [
                    'id_karyawan'=>$get_user->data_user_sistem->id_karyawan,
                    'where_between'=>['tgl_absensi'=>[$filter_date_start,$filter_date_end ]],
                    'hasil_status_absensi'=>['!=',3],
                ];

                if(!empty($filter_status_absensi)){
                    $paramater['hasil_status_absensi']=$filter_status_absensi;
                }

                if(!empty($filter_cara_absensi)){
                    $paramater['verified_mesin']=$filter_cara_absensi;
                }

                $data_tmp_tmp=( new \App\Models\DataAbsensiKaryawan() );
                $where_like=['where_or' => ['nm_karyawan', 'username']];
                $list_data=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater,$where_like)->orderBy('nm_karyawan','ASC')->orderByRaw('UNIX_TIMESTAMP( waktu_absensi )','ASC')->paginate(!empty($request->per_page) ? $request->per_page : 15);
            }
        }else{
            $list_data=[];
        }
            
        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data'=>$list_data
        ];

        return view($this->part_view . '.index', $parameter_view);
    }
}