<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UxuiSettinganMonitorPoli;

class MonitorController extends Controller
{
    //
    public function __construct(){
        $this->settingan_monitor_poli = new UxuiSettinganMonitorPoli();

    }

    public function index(Request $request){

        return view('fe_monitor/fe_monitor', ['data' => []]);
    }
    public function monitor_antrian_farmasi_ranap(Request $request){
        return view('fe_monitor/fe_monitor', ['data' => []]);
    }
    public function monitor_jadwal_operasi(Request $request){
        return view('fe_monitor/fe_monitor', ['data' => []]);
    }
    public function monitor_antrian_poliklinik(Request $request){
        $kode = !empty($request->kode) ? $request->kode : '';
        $data = $this->settingan_monitor_poli->where('kode_setting', $kode)->first()->toArray();
        return view('fe_monitor/fe_monitor', ['data' => $data]);
    }
}
