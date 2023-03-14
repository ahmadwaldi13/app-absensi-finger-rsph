<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\AntrianPoliklinikService;

use App\Models\UxuiPanggilMonitorPoli;

class ApiAntrianPoliklinik extends Controller
{
    public function __construct(
        AntrianPoliklinikService $antrianPoliklinikService,
        UxuiPanggilMonitorPoli $uxui_panggil_monitor_poli

    ) {
        $this->antrianPoliklinikService = $antrianPoliklinikService;
        $this->uxui_panggil_monitor_poli = $uxui_panggil_monitor_poli;
    }

    public function index(Request $request){
        if ($request->kode) {
            $kode = $request->kode;
            $date = date('Y-m-d');
            
            $data['pemeriksaan'] =$this->antrianPoliklinikService->getAllAntrian($date, $kode); 
            $data['panggilan'] = UxuiPanggilMonitorPoli::all();
            return response()->json($data, 200);
        }
        return response()->json([], 400);
    }
}
