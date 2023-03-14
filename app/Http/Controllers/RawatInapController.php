<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanRalan;
use App\Models\PemeriksaanRanap;
use Illuminate\Http\Request;
use App\Services\RawatInapService;
use App\Services\RawatJalanService;
use App\Services\GlobalService;
use App\Services\LaporanOperasiPasienService;

class RawatInapController extends Controller
{
    protected $rawatInapService;
    protected $rawatJalanService;
    protected $globalService;
    public function __construct(
        RawatInapService $rawatInapService,
        RawatJalanService $rawatJalanService,
        GlobalService $globalService,
        LaporanOperasiPasienService $laporanOperasiPasienService
    ){
        $this->rawatJalanService = $rawatJalanService;
        $this->rawatInapService = $rawatInapService;
        $this->globalService = $globalService;
        $this->laporanOperasiPasienService = $laporanOperasiPasienService;
    }

    function index(Request $request)
    {
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

        $kondisi_waktu=!empty($request->kondisi_waktu) ? $request->kondisi_waktu : 1;
        $tanggal_filter=[!empty($request->form_start) ? $request->form_start : date('Y-m-d'),!empty($request->form_end) ? $request->form_end : date('Y-m-d')];
        $bangsal=!empty($request->room) ? $request->room : '';
        $bangsal=($bangsal=='-') ? '' : $bangsal;

        $params = [
            // 'status' => !empty($request->status) ? $request->status : '',
            'bangsal' => $bangsal,
            'kondisi_waktu' => $kondisi_waktu,
            'tanggal'=>$tanggal_filter,
            'search'=>!empty($request->search) ? $request->search : '',
        ];

        $filter = [
            'per_page' => intval($request->per_page),
        ];

        if($get_user->type_user=='dokter'){
            $params['dpjp_ranap.kd_dokter']=$get_user->id_user;

            $norawat_operasi=$this->laporanOperasiPasienService->getLaporanOperasiCheckByDoketer($get_user->id_user,[$request->start,$request->end]);
        }

        $filter['per_page']=$request->per_page;
        $rawatInaps = $this->rawatInapService->getRanapList($params)->paginate($filter['per_page'] ? 10 : $filter['per_page']);

        $item_dr_pj=[];
        foreach($rawatInaps as $key => $value){
            if(!empty($value->no_rawat)){
                $parameter=[
                    'no_rawat'=>$value->no_rawat,
                ];
                $data=$this->globalService->getDokterPjReturnNama($parameter);
                $item_dr_pj[$value->no_rawat]=implode(',',$data);
            }
        }

        $bangsals =  $this->rawatInapService->getListBangsal();
        $regStatuses = $this->rawatInapService->getListRegisterStatusBayar();

        // (new \App\Http\Traits\GlobalFunction)->delete_session(['item_pasien_ri','item_pasien_filter_tgl_ri']);
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
        $tindakan_pasien_model = $get_user->type_user=='dokter' ?  new \App\Models\UxuiTindakanPasien : new \App\Models\UxuiTindakanPasienPerawat;
        $tindakan_pasien_model->delete_data_kosong('ri');


        $paramater_view=[
            'rawatInaps' => $rawatInaps,
            'bansals' => $bangsals,
            'statuses' => $regStatuses,
            'kondisi_waktu'=>$kondisi_waktu,
            'tanggal_filter'=>$tanggal_filter,
            'item_dr_pj'=>$item_dr_pj,
            'norawat_operasi'=>!empty($norawat_operasi) ? $norawat_operasi : null,
            'perPage' => $filter['per_page'],
        ];

        return view('rawat-inap/index',$paramater_view);
    }
}