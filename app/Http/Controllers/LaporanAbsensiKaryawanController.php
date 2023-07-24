<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;

class LaporanAbsensiKaryawanController extends \App\Http\Controllers\MyAuthController
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;

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
    }

    function tampilkanSemuaTanggalSatuBulan($tahun, $bulan) {
        // Menghitung jumlah hari dalam bulan tertentu
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    
        // Mengiterasi melalui tanggal mulai dari tanggal 1 hingga tanggal terakhir bulan
        for ($tanggal = 1; $tanggal <= $jumlahHari; $tanggal++) {
            // Format tanggal dalam bentuk YYYY-MM-DD
            $tanggalFormat = sprintf('%04d-%02d-%02d', $tahun, $bulan, $tanggal);
            
            // Tampilkan tanggal
            echo $tanggalFormat . PHP_EOL;
        }
    }

    function actionIndex(Request $request){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        $data=$this->tampilkanSemuaTanggalSatuBulan(2020, 1);
        dd($data);

        die;
    }
}