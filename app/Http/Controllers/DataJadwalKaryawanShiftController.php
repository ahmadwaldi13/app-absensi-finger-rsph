<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;

class DataJadwalKaryawanShiftController extends \App\Http\Controllers\MyAuthController
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;
    public $refKaryawanService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Data Jadwal Karyawan Shift';
        $this->breadcrumbs = [
            ['title' => 'Data Karyawan', 'url' => url('/') . "/sub-menu?type=4"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
    }

    function actionIndex(Request $request)
    {
        $req = $request->all();
        $data_sent = !empty($req['data_sent']) ? $req['data_sent'] : '';
        $params = !empty($req['params']) ? $req['params'] : '';
        $params=json_decode($params);
        $exp=explode('@',$data_sent);
        $id_karyawan=!empty($exp[0]) ? $exp[0] : 0;
        $id_template_jadwal_shift=!empty($exp[1]) ? $exp[1] : 0;

        $breadcrumbs=$this->breadcrumbs;
        array_push($breadcrumbs,['title' => 'Atur Waktu Jadwal Karyawan', 'url' => url('/') . "/" . $this->url_index]);
        
        $paramater = [
            'id_karyawan' => $id_karyawan
        ];
        $data_karyawan = (new \App\Services\RefKaryawanService)->getList($paramater, 1)->first();
    
        $url_back_index=(new \App\Http\Traits\GlobalFunction)->set_paramter_url('data-jadwal-karyawan',$params);

        $filter_tahun_bulan=!empty($request->filter_tahun_bulan) ? $request->filter_tahun_bulan : date('Y-m');
        $export_date=new \DateTime($filter_tahun_bulan);
        $tahun_filter=$export_date->format('Y');
        $bulan_filter=$export_date->format('m');

        $get_tgl_per_bulan=(new \App\Http\Traits\AbsensiFunction)->get_tgl_per_bulan($filter_tahun_bulan);
        $list_tgl=!empty($get_tgl_per_bulan->list_tgl) ? $get_tgl_per_bulan->list_tgl : [];

        $model_shift=(new \App\Models\RefTemplateJadwalShift)->where(['id_template_jadwal_shift'=>$id_template_jadwal_shift])->first();
        
        $parameter=[
            'id_template_jadwal_shift'=>$id_template_jadwal_shift,
            'tahun'=>$tahun_filter,
            'bulan'=>$bulan_filter,
        ];
        
        $get_list_shift=(new \App\Services\DataPresensiService)->setListShift($parameter);
        $list_shift=!empty($get_list_shift->data) ? json_decode($get_list_shift->data,true)  : [];
        
        $parameter_view = [
            'title' => 'Atur Waktu Jadwal Karyawan',
            'breadcrumbs' => $breadcrumbs,
            'url_back_index' => $url_back_index,
            'data_sent'=>$data_sent,
            'params_json'=>json_encode($params),
            'data_karyawan' => $data_karyawan,
            'list_tgl'=>$list_tgl,
            'model_shift'=>$model_shift,
            'list_shift'=>$list_shift,
        ];

        return view($this->part_view . '.index', $parameter_view);
        
    }
}