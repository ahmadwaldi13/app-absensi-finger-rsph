<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class AbsensiKaryawanController extends \App\Http\Controllers\MyAuthController
{

    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;

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
    }

    function actionIndex(Request $request){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        $get_presensi_masuk=(new \App\Http\Traits\AbsensiFunction)->get_list_data_presensi(1);
        $get_presensi_istirahat=(new \App\Http\Traits\AbsensiFunction)->get_list_data_presensi(2);
        $get_presensi_pulang=(new \App\Http\Traits\AbsensiFunction)->get_list_data_presensi(4);

        $list_data=(new \App\Services\DataPresensiRutinService)->getDataRumus3($request->all());
        
        $page = isset($request->page) ? $request->page : 1;
        $option=['path' => $request->url(), 'query' => $request->query()];
        $list_data = (new \App\Http\Traits\GlobalFunction)->paginate($list_data,15,$page,$option);

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data'=>$list_data,
            'get_presensi_masuk'=>$get_presensi_masuk,
            'get_presensi_istirahat'=>$get_presensi_istirahat,
            'get_presensi_pulang'=>$get_presensi_pulang
        ];

        return view($this->part_view . '.index', $parameter_view);
    }
}