<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\RawatJalanService;
use App\Services\RiwayatPasienService;
use App\Services\BpjsService as BpjsService;

class RiwayatPasienController extends \App\Http\Controllers\MyAuthController
{
    protected $rawatJalanService;
    protected $riwayatPasienService;

    public function __construct(
        GlobalService $globalService,
        RawatJalanService $rawatJalanService,
        RiwayatPasienService $riwayatPasienService,
        BpjsService $bpjsService
    ) {
        $this->globalService = $globalService;
        $this->rawatJalanService = $rawatJalanService;
        $this->riwayatPasienService = $riwayatPasienService;
        $this->bpjsService = $bpjsService;
    }

    function actionIndex(Request $request){
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {

            $filter['start_date'] = $request->start_date;
            $filter['end_date'] = $request->end_date;
            $noRawat = $item_pasien->no_rawat;
            $noRm = $item_pasien->no_rm;
            $dataPasien = $this->globalService->getDataPasien($noRm);
            $resumePasien = $this->riwayatPasienService->getResumePasien($noRm, $filter);
            $riwayatPasiens = $this->riwayatPasienService->getDataRiwayat3Pasien($noRm);
            
            if($request->fr=='rj'){
                $action_beforebb=$this->bpjsService->actionBeforeTaskId($noRawat,3);
            }

            return view('riwayat-pasien.index', [
                'dataPasien' => $dataPasien,
                'resumePasien' => $resumePasien,
                'riwayatPasiens' => $riwayatPasiens,
            ]);
        } else {
            return "false Param";
        }
    }

    public function actionView(Request $request){
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        // dd($item_pasien);
        if ($item_pasien->no_rm && $item_pasien->no_fr) {
            $noRm = $item_pasien->no_rm;
            $noRawat=$item_pasien->no_rawat;
            $isAll = $request->semua == 'true' ? true : false;
            $type_akses=$item_pasien->no_fr;
            $dataRawat = $this->riwayatPasienService->reportPerawatan($noRm, $isAll,$type_akses);
            $parameter_view=[
                'dataRawat' => $dataRawat,
                'type_akses' => $type_akses
            ];
            // dd($parameter_view);
            // $str = str_replace("\n","<br/>",$dataRawat[2]->cppt[1]["pemeriksaan"]);
            return view('riwayat-pasien.bagan-laporan',$parameter_view );
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    }
}