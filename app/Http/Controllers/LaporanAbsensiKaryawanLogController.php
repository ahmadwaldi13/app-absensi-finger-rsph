<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Services\GlobalService;
use App\Services\DataLaporanPresensiService;

class LaporanAbsensiKaryawanLogController extends \App\Http\Controllers\MyAuthController
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;
    public $dataLaporanPresensiService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Report Absensi Jadwal Rutin';
        $this->breadcrumbs = [
            ['title' => 'Manajemen Absensi', 'url' => url('/') . "/sub-menu?type=6"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->dataLaporanPresensiService = new DataLaporanPresensiService;
    }

    function actionIndex(Request $request){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        $form_filter_text=!empty($request->form_filter_text) ? $request->form_filter_text : '';
        $filter_tahun_bulan=!empty($request->filter_tahun_bulan) ? $request->filter_tahun_bulan : date('Y-m');

        $get_tgl_per_bulan=(new \App\Http\Traits\AbsensiFunction)->get_tgl_per_bulan($filter_tahun_bulan);
        $list_tgl=!empty($get_tgl_per_bulan->list_tgl) ? $get_tgl_per_bulan->list_tgl : [];

        $filter_tgl=!empty($get_tgl_per_bulan->tgl_start_end) ? $get_tgl_per_bulan->tgl_start_end : [];
        $filter_tgl[0]=!empty($filter_tgl[0]) ? $filter_tgl[0] : date('Y-m-d');
        $filter_tgl[1]=!empty($filter_tgl[1]) ? $filter_tgl[1] : date('Y-m-d');

        $filter_id_departemen=!empty($request->filter_id_departemen) ? $request->filter_id_departemen : '';
        $filter_id_ruangan=!empty($request->filter_id_ruangan) ? $request->filter_id_ruangan : '';

        $list_data=$collection = collect([]);
        if(!empty($request->cari_data)){

            $paramter_search=[
                'tanggal'=>$filter_tgl
            ];

            if(!empty($filter_id_departemen)){
                $paramter_search['id_departemen']=$filter_id_departemen;
            }

            if(!empty($filter_id_ruangan)){
                $paramter_search['id_ruangan']=$filter_id_ruangan;
            }

            if(!empty($filter_id_status_karyawan)){
                $paramter_search['id_status_karyawan']=$filter_id_status_karyawan;
            }
            
            $list_data=(new \App\Services\DataPresensiService)->get_data_karyawan_log($paramter_search,1)
            ->orderBy('id_departemen','ASC')
            ->orderBy('id_ruangan','ASC')
            ->orderBy('id_status_karyawan','ASC')
            ->orderBy('nm_karyawan','ASC')
            ->get();
        }

        $page = isset($request->page) ? $request->page : 1;
        $option=['path' => $request->url(), 'query' => $request->query()];
        $max_page=!empty($list_data->count()) ? $list_data->count() : 2;
        $list_data = (new \App\Http\Traits\GlobalFunction)->paginate($list_data,$max_page,$page,$option);

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_tgl'=>$list_tgl,
            'list_data'=>$list_data
        ];

        return view($this->part_view . '.index', $parameter_view);
    }
}