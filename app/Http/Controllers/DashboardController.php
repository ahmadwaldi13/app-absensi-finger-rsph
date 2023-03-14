<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

use App\Services\RawatJalanService;

class DashboardController extends Controller
{
    protected $rawatJalanService;
    public function __construct(
        RawatJalanService $rawatJalanService
    ) {
        $this->rawatJalanService = $rawatJalanService;
    }

    function index(Request $request){

        $item_search=[
            'form_search'=>!empty($request->form_search) ? $request->form_search : '',
            'form_status'=>!empty($request->form_status) ? $request->form_status : 'Menunggu',
            'form_start'=>!empty($request->form_start) ? $request->form_start : date('Y-m-d'),
            'form_end'=>!empty($request->form_end) ? $request->form_end : date('Y-m-d'),
        ];

        $parameter_search=[
            'search'=>$item_search['form_search'],
            'status'=>$item_search['form_status'],
            'tanggal_start'=>$item_search['form_start'],
            'tanggal_end'=>$item_search['form_end'],
        ];

        $jadwalOperasiList = $this->rawatJalanService->getJadwalOperasiList2($parameter_search)->paginate(10);
        $jadwalOperasiStatuses = $this->rawatJalanService->getJadwalOperasiStatus();

        $paramater_view=[
            'jadwalOperasiLists' => $jadwalOperasiList,
            'jadwalOperasiStatuses'=>$jadwalOperasiStatuses,
            'item_search'=>$item_search
        ];
        return view('dashboard/index',$paramater_view);
    }
}