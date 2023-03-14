<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;

use App\Services\TBService;
use App\Services\CpptService;
use App\Services\RawatJalanService;


use App\Services\BpjsService;

class CpptController extends \App\Http\Controllers\MyAuthController
{
    protected $cpptService;
    public function __construct(
        GlobalService $globalService,
        BpjsService $bpjsService,
        CpptService $cpptService,
        RawatJalanService $rawatJalanService
    ) {
        $this->tbService = new TBService;
        $this->globalService = $globalService;
        $this->bpjsService = $bpjsService;
        $this->cpptService = $cpptService;
        $this->rawatJalanService = $rawatJalanService;
    }

    function actionIndex(Request $request)
    {   
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {

            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

            $noRm = $item_pasien->no_rm;
            $noRawat = $item_pasien->no_rawat;
            $dataPasien = $this->globalService->getDataPasien($noRm);
            $dokters = $this->globalService->getDokterList();
            
            $kesadarans = $this->cpptService->getCpptKesadaran();

            $data=(new \App\Http\Traits\ItemPasienFunction)->setItemPasienFilterTgl($request->fr,$request->form_filter_start,$request->form_filter_end);
            if(!empty($data)){
                $request->form_filter_start=$data->filter_start;
                $request->form_filter_end=$data->filter_end;
            }
            $filter_start=!empty($request->form_filter_start) ? $request->form_filter_start : date('Y-m-d');
            $filter_end=!empty($request->form_filter_end) ? $request->form_filter_end : date('Y-m-d');
            
            if($item_pasien->no_fr=='ri'){
                $list = $this->cpptService->getCpptRanapListByNoRm($noRm,[$filter_start,$filter_end]);
                $lastCppt = $this->cpptService->getLastPemeriksaanRanap($noRm);
            }else{
                $list = $this->cpptService->getCpptRalanListByNoRm($noRm,[$filter_start,$filter_end]);
                $lastCppt = $this->cpptService->getLastPemeriksaanRalan($noRm);
            }

            
            if($get_user->type_user=='dokter'){
                $listDokter = $this->globalService->getDokterList();
            }if($get_user->type_user=='petugas'){
                $listPetugas = $this->globalService->getPetugasList();
            }

            if($get_user->type_user=='petugas'){
                $petugases = $this->globalService->getPetugasList();
                $selectedPetugas = $this->globalService->getPetugasList(['nip'=>$get_user->id_user]);
                if(!empty($selectedPetugas[0])){
                    $selectedPetugas=(object)$selectedPetugas[0];
                }
            }elseif($get_user->type_user=='dokter'){
                $selectedDokter = $this->globalService->getDataDokterList(['kd_dokter'=>$get_user->id_user]);
                if(!empty($selectedDokter[0])){
                    $selectedDokter=(object)$selectedDokter[0];
                }
            }

            if(!empty($request->cdata)){
                $exp=explode('@',$request->cdata);
                $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
                $no_rawat=!empty($exp[1]) ? $exp[1] : ''; 
                $tgl_perawatan=!empty($exp[2]) ? $exp[2] : ''; 
                $jam_rawat=!empty($exp[3]) ? $exp[3] : ''; 
                $no_rm=!empty($exp[4]) ? $exp[4] : ''; 

                if($type_akses=='ri'){
                    $paramater=[
                        'pemeriksaan_ranap.no_rawat'=>!empty($no_rawat) ? ['=',$no_rawat] : '',
                        'pemeriksaan_ranap.tgl_perawatan'=>!empty($exp[2]) ? ['=',$exp[2]] : '',
                        'pemeriksaan_ranap.jam_rawat'=>!empty($exp[3]) ? ['=',$exp[3]] : '',
                    ];
                    $model = $this->cpptService->getDataCpptRanapList($paramater);
                }else{
                    $paramater=[
                        'pemeriksaan_ralan.no_rawat'=>!empty($no_rawat) ? ['=',$no_rawat] : '',
                        'pemeriksaan_ralan.tgl_perawatan'=>!empty($exp[2]) ? ['=',$exp[2]] : '',
                        'pemeriksaan_ralan.jam_rawat'=>!empty($exp[3]) ? ['=',$exp[3]] : '',
                    ];
                    $model = $this->cpptService->getDataCpptRalanList($paramater);
                }
                $model=!empty($model[0]) ? $model[0]->getAttributes() : (object)[];
                $model['fr']=$item_pasien->no_fr;
                $model['no_rawat']=$item_pasien->no_rawat;
                $model['no_rkm_medis']=$item_pasien->no_rm;
                $model['tgl_perawatan']='';
                $model['jam_rawat']='';
                $model=(object)$model;
            }

            if($item_pasien->no_fr=='rj'){
                $action_beforebb=$this->bpjsService->actionBeforeTaskId($noRawat,4);
                $hasil=$this->bpjsService->taskId($noRawat,4);
            }

            $parameter = [
                'uxui_pasien_sitb.no_rkm_medis' => $request->no_rm
            ];

            $singleDataTb = $this->tbService->checkPasienTB($parameter,1)->first();
            if($singleDataTb && $singleDataTb->status=='SELESAI'){
                $singleDataTb=[];
            }
            $listDataTB = $this->tbService->checkPasienTB($parameter,1)->get();

            $parameter_view=[
                'dataPasien' => $dataPasien,
                'dokters' => $dokters,
                'list' => $list,
                'selectedDokter' => !empty($selectedDokter) ? $selectedDokter : [],
                'kesadarans' => $kesadarans,
                'petugases'=>!empty($petugases) ? $petugases : [],
                'selectedPetugas' => !empty($selectedPetugas) ? $selectedPetugas : [],
                'lastCppt' => $lastCppt,
                'listDokter'=> !empty($listDokter) ? $listDokter : [],
                'listPetugas'=> !empty($listPetugas) ? $listPetugas : [],
                'singleDataTb' => !empty($singleDataTb) ? $singleDataTb : [],
                'listDataTB' => !empty($listDataTB) ? $listDataTB : [],
                'model'=>!empty($model) ? $model : [],
            ];
            
            return view('cppt.index',$parameter_view);
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    }

    function actionCreate(Request $request)
    {
        DB::beginTransaction();
        $fields = $request->all();
        unset($fields["fr"]);
        unset($fields["no_rm"]);
        $link_back='isi_cppt';
        $link_back_param=['no_rm' => $request->no_rm, 'no_rawat' => $request->no_rawat,'fr'=>$request->fr];

        $message_default=[
            'success'=>'Data berhasil ditambahkan',
            'error'=>'Maaf data tidak berhasil ditambahkan'
        ];  

        try {   
            $data_save=$fields;
            unset($data_save["fr"]);
            unset($data_save["no_rm"]);
            unset($data_save["_token"]);
            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
            if($get_user->type_user=='dokter'){
                $data_save['nip']=$get_user->id_user;
            }

            $data_save['spo2']=!empty($data_save['spo2']) ? $data_save['spo2'] : 0;
            $data_save['kesadaran']=!empty($data_save['kesadaran']) ? $data_save['kesadaran'] : '';
            $data_save['tensi']=!empty($data_save['tensi']) ? $data_save['tensi'] : '';
            $data_save['spo2']=!empty($data_save['spo2']) ? $data_save['spo2'] : '';
            $data_save['rtl']=!empty($data_save['rtl']) ? $data_save['rtl'] : '';
            $data_save['penilaian']=!empty($data_save['penilaian']) ? $data_save['penilaian'] : '';
            $data_save['instruksi']=!empty($data_save['instruksi']) ? $data_save['instruksi'] : '';
            $data_save['evaluasi']=!empty($data_save['evaluasi']) ? $data_save['evaluasi'] : '';
            
            if($data_save){
                if($request->fr=='ri'){
                    $data_save=$this->cpptService->pemeriksaanRanap->set_columns_table_with_data($data_save);
                    $model=new $this->cpptService->pemeriksaanRanap;
                    $model->set_model_with_data($data_save);
                    if($model->save()){
                        $check_save=1;     
                    }
                }else{
                    $data_save=$this->cpptService->pemeriksaanRalan->set_columns_table_with_data($data_save);
                    $model=new $this->cpptService->pemeriksaanRalan;
                    $model->set_model_with_data($data_save);
                    if($model->save()){
                        $check_save=1;     
                    }
                }
                $is_save=0;
                if($check_save){
                    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);

                    $tindakan_pasien_model = $get_user->type_user=='dokter' ?  new \App\Models\UxuiTindakanPasien : new \App\Models\UxuiTindakanPasienPerawat;
                    $model_tindakan=$tindakan_pasien_model::where('no_rawat', $item_pasien->no_rawat)
                    ->where('no_rkm_medis', $item_pasien->no_rm)
                    ->where('type_akses', $item_pasien->no_fr)
                    ->first();

                    if(empty($model_tindakan)){
                        $model_tindakan=$tindakan_pasien_model;
                        $model_tindakan->no_rawat=$item_pasien->no_rawat;
                        $model_tindakan->no_rkm_medis=$item_pasien->no_rm;
                        $model_tindakan->type_akses=$item_pasien->no_fr;
                    }
                    $model_tindakan->pemeriksaan=1;

                    if($model_tindakan->save()){
                        $is_save=1;
                    }
                }

                if($item_pasien->no_fr=='rj'){
                    if($is_save){
                        $action_beforebb=$this->bpjsService->actionBeforeTaskId($item_pasien->no_rawat,5);
                        if($action_beforebb){
                            if($action_beforebb[0]=='error'){
                                $is_save=0;
                            }
                        }
                    }
                    if($is_save){
                        $hasil=$this->bpjsService->taskId($item_pasien->no_rawat,5);
                        if($hasil){
                            if($hasil[0]=='error'){
                                $is_save=0;
                            }
                        }
                    }
                }

                if($is_save){
                    DB::commit();
                    return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
                }else{
                    DB::rollBack();
                    return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
                }
            }else{
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf tidak dapat menyimpan data yang sama']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }

    }

    function formUpdate(Request $request) {
        DB::beginTransaction();
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : ''; 
        $no_rm=!empty($exp[4]) ? $exp[4] : ''; 

        if($type_akses=='ri'){
            $paramater=[
                'pemeriksaan_ranap.no_rawat'=>!empty($no_rawat) ? ['=',$no_rawat] : '',
                'pemeriksaan_ranap.tgl_perawatan'=>!empty($exp[2]) ? ['=',$exp[2]] : '',
                'pemeriksaan_ranap.jam_rawat'=>!empty($exp[3]) ? ['=',$exp[3]] : '',
            ];
            $model = $this->cpptService->getDataCpptRanapList($paramater);
        }else{
            $paramater=[
                'pemeriksaan_ralan.no_rawat'=>!empty($no_rawat) ? ['=',$no_rawat] : '',
                'pemeriksaan_ralan.tgl_perawatan'=>!empty($exp[2]) ? ['=',$exp[2]] : '',
                'pemeriksaan_ralan.jam_rawat'=>!empty($exp[3]) ? ['=',$exp[3]] : '',
            ];
            $model = $this->cpptService->getDataCpptRalanList($paramater);
        }
        $model=!empty($model[0]) ? $model[0]->getAttributes() : (object)[];
        $model['fr']=$type_akses;
        $model['no_rm']=$no_rm;
        $model=(object)$model;
        
        $kesadarans = $this->cpptService->getCpptKesadaran();
        
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
        if($get_user->type_user=='dokter'){
            $listDokter = $this->globalService->getDokterList();
        }if($get_user->type_user=='petugas'){
            $listPetugas = $this->globalService->getPetugasList();
        }

        $data_dilakukan=$this->checkDataDilakukan($model);
        
        $kode_key_old=[
            'no_rawat'=>!empty($no_rawat) ? $no_rawat : '',
            'tgl_perawatan'=>!empty($exp[2]) ? $exp[2] : '',
            'jam_rawat'=>!empty($exp[3]) ? $exp[3] : '',
        ];

        $kode_key_old=(new \App\Http\Traits\GlobalFunction)->makeJson($kode_key_old);
        
        $parameter_view=[
            'action_form'=>'isi-cppt/update',
            'kode_key_old'=>$kode_key_old,
            'model'=>$model,
            'type_akses'=>$type_akses,
            'data_dilakukan'=>$data_dilakukan,
            'kesadarans' => $kesadarans,
            'listDokter'=>!empty($listDokter) ? $listDokter : [],
            'listPetugas'=>!empty($listPetugas) ? $listPetugas : []
        ];

        if($request->ajax()){
            $returnHTML = view('cppt.form',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    function actionUpdate(Request $request)
    {
        DB::beginTransaction();
        $fields = $request->all();
        unset($fields["fr"]);
        unset($fields["no_rm"]);
        $type_akses=!empty($request->fr) ? $request->fr : 'rj';
        $link_back='isi_cppt';
        $link_back_param=['no_rm' => $request->no_rm, 'no_rawat' => $request->no_rawat,'fr'=>$request->fr];

        $message_default=[
            'success'=>'Data berhasil diubah',
            'error'=>'Maaf data tidak berhasil diubah'
        ];
        try {   
            $data_save=$fields;
            $key_old=$data_save['key_old'];
            $key_old=json_decode($key_old);
            unset($data_save["fr"]);
            unset($data_save["no_rm"]);
            unset($data_save["_token"]);
            unset($data_save["key_old"]);

            $data_save['spo2']=!empty($data_save['spo2']) ? $data_save['spo2'] : 0;
            $data_save['kesadaran']=!empty($data_save['kesadaran']) ? $data_save['kesadaran'] : '';
            $data_save['tensi']=!empty($data_save['tensi']) ? $data_save['tensi'] : '';
            $data_save['spo2']=!empty($data_save['spo2']) ? $data_save['spo2'] : '';
            $data_save['rtl']=!empty($data_save['rtl']) ? $data_save['rtl'] : '';
            $data_save['penilaian']=!empty($data_save['penilaian']) ? $data_save['penilaian'] : '';
            $data_save['instruksi']=!empty($data_save['instruksi']) ? $data_save['instruksi'] : '';
            $data_save['evaluasi']=!empty($data_save['evaluasi']) ? $data_save['evaluasi'] : '';

            if($key_old && $data_save){
                $jlh_save=0;
                if($request->fr=='ri'){
                    $delete_model=$this->cpptService->deleteRanap($key_old->no_rawat,$key_old->tgl_perawatan,$key_old->jam_rawat);
                    if($delete_model){
                        $data_save=$this->cpptService->pemeriksaanRanap->set_columns_table_with_data($data_save);
                        $model=new $this->cpptService->pemeriksaanRanap;
                        $model->set_model_with_data($data_save);
                        if($model->save()){
                            $jlh_save=1;
                        }
                    }
                }else{
                    $delete_model=$this->cpptService->deleteRalan($key_old->no_rawat,$key_old->tgl_perawatan,$key_old->jam_rawat);
                    if($delete_model){
                        $data_save=$this->cpptService->pemeriksaanRalan->set_columns_table_with_data($data_save);
                        $model=new $this->cpptService->pemeriksaanRalan;
                        $model->set_model_with_data($data_save);
                        if($model->save()){
                            $jlh_save=1;
                        }
                    }
                }

                if($jlh_save){
                    DB::commit();
                    return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
                }else{
                    DB::rollBack();
                    return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
                }
            }else{
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf tidak dapat menyimpan data yang sama']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }
    }

    function actionDelete(Request $request)
    {
        DB::beginTransaction();
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        
        $no_rawat=!empty($exp[1]) ? $exp[1] : 0;
        $tgl_perawatan=!empty($exp[2]) ? $exp[2] : 0;
        $jam_rawat=!empty($exp[3]) ? $exp[3] : 0;
        $no_rm=!empty($exp[4]) ? $exp[4] : 0;

        $link_back='isi_cppt';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $no_rawat,'fr'=>$type_akses];
        
        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

        try {  
            if(!empty($no_rawat) && !empty($tgl_perawatan) && !empty($jam_rawat)){
                if($type_akses=='ri'){
                    $delete_model=$this->cpptService->deleteRanap($no_rawat, $tgl_perawatan, $jam_rawat);
                }else{
                    $delete_model=$this->cpptService->deleteRalan($no_rawat, $tgl_perawatan, $jam_rawat);
                }

                $save_delete=0;
                if ($delete_model) {
                    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($type_akses);

                    $tindakan_pasien_model = $get_user->type_user=='dokter' ?  new \App\Models\UxuiTindakanPasien : new \App\Models\UxuiTindakanPasienPerawat;
                    $model_tindakan=$tindakan_pasien_model::where('no_rawat', $item_pasien->no_rawat)
                    ->where('no_rkm_medis', $item_pasien->no_rm)
                    ->where('type_akses', $item_pasien->no_fr)
                    ->first();

                    if(!empty($model_tindakan)){
                        $model_tindakan->pemeriksaan=0;

                        if($model_tindakan->save()){
                            $save_delete=1;
                        }
                    }else{
                        $save_delete=1;
                    }
                }

                if ($save_delete) {
                    DB::commit();
                    $pesan=['success' => $message_default['success']];
                }else{
                    DB::rollBack();
                    $pesan=['error' => $message_default['error']];
                }
                return redirect()->route($link_back, $link_back_param)->with($pesan);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);


        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf tidak dapat menyimpan data yang sama']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        } 
    }

    function actionView(Request $request)
    {
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : '';
        if($type_akses=='ri'){
            $paramater=[
                'pemeriksaan_ranap.no_rawat'=>!empty($exp[1]) ? ['=',$no_rawat] : '',
                'pemeriksaan_ranap.tgl_perawatan'=>!empty($exp[2]) ? ['=',$exp[2]] : '',
                'pemeriksaan_ranap.jam_rawat'=>!empty($exp[3]) ? ['=',$exp[3]] : '',
            ];
            $model = $this->cpptService->getDataCpptRanapList($paramater);
        }else{
            $paramater=[
                'pemeriksaan_ralan.no_rawat'=>!empty($exp[1]) ? ['=',$no_rawat] : '',
                'pemeriksaan_ralan.tgl_perawatan'=>!empty($exp[2]) ? ['=',$exp[2]] : '',
                'pemeriksaan_ralan.jam_rawat'=>!empty($exp[3]) ? ['=',$exp[3]] : '',
            ];
            $model = $this->cpptService->getDataCpptRalanList($paramater);
        }
        $model=!empty($model[0]) ? $model[0] : (object)[];
        
        $data_dilakukan=$this->checkDataDilakukan($model);
        
        $parameter_view=[
            'model'=>$model,
            'type_akses'=>$type_akses,
            'data_dilakukan'=>$data_dilakukan
        ];

        if($request->ajax()){
            $returnHTML = view('cppt.view',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    private function checkDataDilakukan($model){
        $data_dilakukan=[];
        $data_dokter=$this->globalService->getDataDokterList(['kd_dokter'=>$model->nip]);
        $data_dokter=!empty($data_dokter[0]) ? $data_dokter[0] : [];
        if($data_dokter){
            $data_dilakukan=[
                'nama'=>!empty($data_dokter->nm_dokter) ? $data_dokter->nm_dokter : '', 
                'kode'=>!empty($data_dokter->kd_dokter) ? $data_dokter->kd_dokter : '', 
                'jabatan'=>!empty($data_dokter->jabatan) ? $data_dokter->jabatan : '', 
            ];
        }else{
            $data_petugas=$this->globalService->getPetugasList(['nip'=>$model->nip]);
            $data_petugas=!empty($data_petugas[0]) ? $data_petugas[0] : [];
            if($data_petugas){
                $data_dilakukan=[
                    'nama'=>!empty($data_petugas->nama) ? $data_petugas->nama : '', 
                    'kode'=>!empty($data_petugas->nip) ? $data_petugas->nip : '', 
                    'jabatan'=>!empty($data_petugas->nm_jbtn) ? $data_petugas->nm_jbtn : '', 
                ];
            }
        }

        return (object)$data_dilakukan;
    }
}