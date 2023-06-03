<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\DataAbsensiKaryawanService;

class AbsensiKaryawanController extends \App\Http\Controllers\MyAuthController
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
            ['title' => 'Mesin Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->dataAbsensiKaryawanService = new DataAbsensiKaryawanService;
    }

    function actionIndex(Request $request){

        $filter_date_start=!empty($request->filter_date_start) ? $request->filter_date_start : date('Y-m-d');
        $filter_date_end=!empty($request->filter_date_end) ? $request->filter_date_end : date('Y-m-d');

        $paramater = [
            'where_between'=>['tgl_absensi'=>[$filter_date_start,$filter_date_end ]],
        ];

        $data_tmp_tmp=( new \App\Models\DataAbsensiKaryawan() );
        $list_data=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater)->orderBy('nm_karyawan','ASC')->orderByRaw('UNIX_TIMESTAMP( waktu_absensi )','ASC')->paginate(!empty($request->per_page) ? $request->per_page : 15);
        
        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data'=>$list_data
        ];

        return view($this->part_view . '.index', $parameter_view);
    }
}