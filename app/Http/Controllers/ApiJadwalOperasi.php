<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JadwalOperasiService;

class ApiJadwalOperasi extends Controller
{
    public function __construct(
        JadwalOperasiService $jadwalOperasiService
    )
    {
        $this->jadwalOperasiService = $jadwalOperasiService;
    }
    function index(Request $request){
        $parameter=[
            'tanggal'=>[date('Y-m-d'), date('Y-m-d')],
            'whereIn'=>['booking_operasi.status'=>['Menunggu','Proses Operasi']]
        ];
        $data = $this->jadwalOperasiService->getJadwalOperasiList($parameter,1)->limit(50)->get();
        return response()->json($data, 200);
    }
}
