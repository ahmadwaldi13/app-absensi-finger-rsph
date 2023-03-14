<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Services\AntrianFarmasiService;


class ApiAntrianFarmasi extends Controller
{
    public function __construct(
        ReportService $reportService,
        AntrianFarmasiService $antrianFarmasiService    
    )
    {
        $this->reportService = $reportService;
        $this->antrianFarmasiService = $antrianFarmasiService;
    }
    // ganti antrianfarmasi
    function ralan(Request $request){
        $parameter_tanggal =  [date('Y-m-d'), date('Y-m-d')];
        $parameter =[];
        // $data = $this->antrianFarmasiService->getResepObatRalanList($parameter_tanggal,$parameter)->limit(50)->get();
        $data =  $this->antrianFarmasiService->getResepObatRalanListMonitor();
        return response()->json($data, 200);
    }

    function ranap(Request $request){
        $parameter_tanggal =  [date('Y-m-d'), date('Y-m-d')];
        $parameter =[];
        // $data = $this->antrianFarmasiService->getResepObatRanapList($parameter_tanggal,$parameter)->limit(50)->get();
        $data =  $this->antrianFarmasiService->getResepObatRanapListMonitor();
        return response()->json($data, 200);
    }
}
