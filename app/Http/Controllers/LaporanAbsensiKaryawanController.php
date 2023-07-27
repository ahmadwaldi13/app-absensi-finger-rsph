<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\DataLaporanPresensiService;

class LaporanAbsensiKaryawanController extends \App\Http\Controllers\MyAuthController
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;
    public $dataLaporanPresensiService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Report Absensi';
        $this->breadcrumbs = [
            ['title' => 'Manajemen Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->dataLaporanPresensiService = new DataLaporanPresensiService;
    }

    function actionIndex(Request $request){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        if(!empty($request->page)){
            $check_first_akses=1;
        }

        $form_filter_text=!empty($request->form_filter_text) ? $request->form_filter_text : '';
        $filter_tahun_bulan=!empty($request->filter_tahun_bulan) ? $request->filter_tahun_bulan : date('Y-m');

        $get_tgl_per_bulan=(new \App\Http\Traits\AbsensiFunction)->get_tgl_per_bulan($filter_tahun_bulan);

        $list_tgl=!empty($get_tgl_per_bulan->list_tgl) ? $get_tgl_per_bulan->list_tgl : [];

        $filter_tgl=!empty($get_tgl_per_bulan->tgl_start_end) ? $get_tgl_per_bulan->tgl_start_end : [];
        $filter_tgl[0]=!empty($filter_tgl[0]) ? $filter_tgl[0] : date('Y-m-d');
        $filter_tgl[1]=!empty($filter_tgl[1]) ? $filter_tgl[1] : date('Y-m-d');

        $paramter_search=$request->all();
        $paramter_search['filter_date_start']=$filter_tgl[0];
        $paramter_search['filter_date_end']=$filter_tgl[1];

        $get_data_query=(new \App\Services\DataPresensiRutinService)->getDataRumus3($paramter_search);
        $list_db=!empty($get_data_query->list_db) ? $get_data_query->list_db : [];

        if(empty($check_first_akses)){
            $save_update=(new \App\Services\DataPresensiService)->save_update_rekap($list_db);
        }

        $parameter_where=[
            'search'=>$form_filter_text,
            'tanggal'=>[$filter_tgl[0],$filter_tgl[1]],
            'id_jenis_jadwal'=>1,
        ];

        $list_data=$this->dataLaporanPresensiService->getRekapPresensi($parameter_where,1)->get();

        $page = isset($request->page) ? $request->page : 1;
        $option=['path' => $request->url(), 'query' => $request->query()];
        $max_page=!empty($list_data->count()) ? $list_data->count() : 2;
        $list_data = (new \App\Http\Traits\GlobalFunction)->paginate($list_data,$max_page,$page,$option);

        $get_presensi_masuk=(new \App\Http\Traits\AbsensiFunction)->get_list_data_presensi(1);
        $get_presensi_istirahat=(new \App\Http\Traits\AbsensiFunction)->get_list_data_presensi(2);
        $get_presensi_pulang=(new \App\Http\Traits\AbsensiFunction)->get_list_data_presensi(4);

        $paramater_where=[
            'tanggal'=>[$filter_tgl[0],$filter_tgl[1]],
        ];

        $list_hari_libur=(new \App\Services\DataPresensiService)->get_data_hari_libur($paramater_where);

        $data_jadwal_rutin=(new \App\Http\Traits\PresensiHitungRutinFunction)->get_jadwal_rutin();

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'get_presensi_masuk'=>$get_presensi_masuk,
            'get_presensi_istirahat'=>$get_presensi_istirahat,
            'get_presensi_pulang'=>$get_presensi_pulang,
            'list_tgl'=>$list_tgl,
            'list_data'=>$list_data,
            'list_hari_libur'=>$list_hari_libur,
            'data_jadwal_rutin'=>$data_jadwal_rutin,

        ];

        return view($this->part_view . '.index', $parameter_view);
    }
}