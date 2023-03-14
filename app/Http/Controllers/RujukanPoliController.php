<?php

namespace App\Http\Controllers;

use App\Services\RawatJalanService;
use Illuminate\Http\Request;

use App\Services\LaporanOperasiPasienService;

class RujukanPoliController extends Controller
{
    protected $rawatJalanService;
    public function __construct(
        RawatJalanService $rawatJalanService,
        LaporanOperasiPasienService $laporanOperasiPasienService
    ) {
        $this->rawatJalanService = $rawatJalanService;
        $this->laporanOperasiPasienService = $laporanOperasiPasienService;
    }

    function index(Request $request)
    {
        $filter = [
            'city' => $request->city,
            'poli' => $request->poli,
            'status' => $request->status,
            'start' => $request->start,
            'end' => $request->end,
            'per_page' => intval($request->per_page),
            'search' => $request->search,
        ];
        
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

        if($get_user->type_user=='dokter'){
            $filter['kd_dokter']=$get_user->id_user;

            $norawat_operasi=$this->laporanOperasiPasienService->getLaporanOperasiCheckByDoketer($get_user->id_user,[$request->start,$request->end]);
        }
        
        $rawatJalans = $this->rawatJalanService->getRujukanPoliList($filter)
            ->paginate($filter['per_page'] ? 10 : $filter['per_page']);

        $poliKliniks =  $this->rawatJalanService->getListPoliklinik()->where('status','1')->get();
        $regStatuses = $this->rawatJalanService->getListRegisterStatus();
        $cities = $this->rawatJalanService->getListCity();

        // (new \App\Http\Traits\GlobalFunction)->delete_session(['item_pasien_rp','item_pasien_filter_tgl_rp']);
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
        $tindakan_pasien_model = $get_user->type_user=='dokter' ?  new \App\Models\UxuiTindakanPasien : new \App\Models\UxuiTindakanPasienPerawat;
        $tindakan_pasien_model->delete_data_kosong('rp');

        $parameter_view=[
            'rawatJalans' => $rawatJalans,
            'poliKliniks' => $poliKliniks,
            'statuses' => $regStatuses,
            'cities' => $cities,
            'norawat_operasi'=>!empty($norawat_operasi) ? $norawat_operasi : null,
            'perPage' => $filter['per_page'],
        ];
        return view('rujukan-poli/index',$parameter_view);
    }
}
