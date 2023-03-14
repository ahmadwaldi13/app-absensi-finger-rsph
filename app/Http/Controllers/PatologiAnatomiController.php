<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Services\GlobalService;
use App\Services\RawatJalanService;
use App\Services\PatologiAnatomiService;
use App\Services\PatologiKlinisService;
use App\Services\PemeriksaanRadiologiService;
use App\Services\RekamMedisService;

class PatologiAnatomiController extends Controller
{
    public function __construct(
        GlobalService $globalService,
        RawatJalanService $rawatJalanService,
        PatologiAnatomiService $patologiAnatomiService,
        PatologiKlinisService $patologiKlinisService,
        PemeriksaanRadiologiService $pemeriksaanRadiologiService
    ) {
        $this->globalService = $globalService;
        $this->rawatJalanService = $rawatJalanService;
        $this->patologiAnatomiService = $patologiAnatomiService;
        $this->patologiKlinisService = $patologiKlinisService;
        $this->pemeriksaanRadiologiService = $pemeriksaanRadiologiService;
        $this->rekamMedisService = new RekamMedisService;
    }

    private function data_form($params){

        $no_rawat = !empty($params['no_rawat']) ? $params['no_rawat'] : '';
        $no_rm = !empty($params['no_rm']) ? $params['no_rm'] : '';
        $type_form = !empty($params['type_form']) ? $params['type_form'] : '';

        $return=[];
        if ($no_rawat && $no_rm && $type_form) {
            $no_order=$this->patologiAnatomiService->getNoOrder(date('Y-m-d'));

            $data_dokter =null;
            if($type_form!='ri'){
                $paramater = [
                    'reg_periksa.no_rawat' => $no_rawat
                ];
                if($type_form=='rp'){
                    $data_dokter = $this->rekamMedisService->getDokterByRujukanPoli($paramater,2);
                }else{
                    $data_dokter = $this->rekamMedisService->getDokterByRegPeriksa($paramater,2);
                }
            }else{
                $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
                if($get_user->type_user=='dokter'){
                    $data_dokter_tmp = $get_user;
                    $data_dokter=(object)[
                        'kd_dokter'=>$data_dokter_tmp->id_user,
                        'nm_dokter'=>$data_dokter_tmp->nama_user
                    ];
                }else{
                    $data_dokter = [];
                }
            }
            
            $dataPasien = $this->globalService->getDataPasien($no_rm);

            $model['no_rawat']=$no_rawat;
            $model['fr']=$type_form;
            $model['no_rm']=$no_rm;
            $model['nm_pasien']=!empty($dataPasien->nm_pasien) ? $dataPasien->nm_pasien : '';
            $model['kd_dokter']=!empty($data_dokter->kd_dokter) ? $data_dokter->kd_dokter : '';
            $model['nm_dokter']=!empty($data_dokter->nm_dokter) ? $data_dokter->nm_dokter : '';
            $model['no_order']=!empty($no_order) ? $no_order : '';

            $model=(object)$model;

            $pemeriksaan_list1=$this->patologiKlinisService->getjnsPerawatanLab(['jns_perawatan_lab.kategori'=>'PA','jns_perawatan_lab.status'=>'1']);
            
            $return=[
                "model" => !empty($model) ? $model : [],
                'pemeriksaan_list1'=>$pemeriksaan_list1,
            ];
        }

        return $return;
    }

    function actionIndex(Request $request){
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);

        if ($item_pasien->no_rawat && $item_pasien->no_fr) {

            $check_registrasi=$this->globalService->cariRegistrasi($item_pasien->no_rawat);

            if($check_registrasi>0){
                \Session::flash('error', 'Data billing sudah terverifikasi ..!!');
                $allow_btn_save=1;
            }

            $noRawat = $item_pasien->no_rawat;

            $set_filter_search_tgl=(new \App\Http\Traits\ItemPasienFunction)->setItemPasienFilterTgl($item_pasien->no_fr,$request->form_filter_start,$request->form_filter_end);
            if(!empty($set_filter_search_tgl)){
                $request->form_filter_start=$set_filter_search_tgl->filter_start;
                $request->form_filter_end=$set_filter_search_tgl->filter_end;
            }

            $filter_start=!empty($request->form_filter_start) ? $request->form_filter_start : date('Y-m-d');
            $filter_end=!empty($request->form_filter_end) ? $request->form_filter_end : date('Y-m-d');

        
            if($item_pasien->no_fr=='ri'){
                $list_data=$this->patologiAnatomiService->getListRanap(['permintaan_labpa.no_rawat'=>$noRawat,'permintaan_labpa.status'=>'ranap','tgl_permintaan'=>[$filter_start,$filter_end]]);
            }else{
                $list_data=$this->patologiAnatomiService->getListRalan(['permintaan_labpa.no_rawat'=>$noRawat,'permintaan_labpa.status'=>'ralan','tgl_permintaan'=>[$filter_start,$filter_end]]);
            }

            $paramater_data=[
                'no_rawat'=>$item_pasien->no_rawat,
                'no_rm'=>$item_pasien->no_rm,
                'type_form'=>$item_pasien->no_fr,
            ];



            $parameter_data_form=$this->data_form($paramater_data);
            
            $parameter_view=[
                'list_data'=>!empty($list_data) ? $list_data : [],
                'action_form'=>'patologi-anatomi/create',
                'allow_btn_save'=>!empty($allow_btn_save) ? 1 : 0,
            ];

            $parameter_view=array_merge($parameter_view,$parameter_data_form);

            return view('patologi-anatomi.index',$parameter_view);
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    }

    function actionCreate(Request $request)
    {
        DB::beginTransaction();
        $link_back='patologi_anatomi';
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        $type_akses=!empty($item_pasien->no_fr) ? $item_pasien->no_fr : '';
        $link_back_param=['no_rm' => $item_pasien->no_rm, 'no_rawat' => $item_pasien->no_rawat,'fr'=>$item_pasien->no_fr];

        $message_default=[
            'success'=>'Data berhasil ditambahkan',
            'error'=>'Maaf data tidak berhasil ditambahkan'
        ];

        try {   

            $check_registrasi=$this->globalService->cariRegistrasi($item_pasien->no_rawat);
        
            if($check_registrasi>0){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Data billing sudah terverifikasi ..!!']);
            }
            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
            
            $data_save=$request->all();

            $data_periksa=!empty($data_save['periksa']) ? $data_save['periksa'] : [];
            $link_back_param['pdt']=implode('@',$data_periksa);
            
            unset($data_save["fr"]);
            unset($data_save["no_rm"]);
            unset($data_save["?no_rm"]);
            unset($data_save["_token"]);
            unset($data_save["key_old"]);
            unset($data_save['periksa']);

            
            $data_dokter =null;
            if($type_akses!='ri'){
                $paramater = [
                    'reg_periksa.no_rawat' => $item_pasien->no_rawat
                ];
                if($type_akses=='rp'){
                    $data_dokter = $this->rekamMedisService->getDokterByRujukanPoli($paramater,2);
                }else{
                    $data_dokter = $this->rekamMedisService->getDokterByRegPeriksa($paramater,2);
                }
            }else{
                $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
                if($get_user->type_user=='dokter'){
                    $data_dokter_tmp = $get_user;
                    $data_dokter=(object)[
                        'kd_dokter'=>$data_dokter_tmp->id_user,
                        'nm_dokter'=>$data_dokter_tmp->nama_user
                    ];
                }else{
                    $paramater = [
                        'dpjp_ranap.no_rawat' => $item_pasien->no_rawat,
                        'dpjp_ranap.kd_dokter' =>  !empty($request->kd_dokter) ? $request->kd_dokter : 0,
                    ];
                    $data_dokter = $this->rekamMedisService->getDokterByDpjpRanap($paramater,2);
                    if(!$data_dokter){
                        return redirect()->route($link_back, $link_back_param)->with(['error' => 'Dokter PJ Tidak terdaftar pada no rawat '.$item_pasien->no_rawat.'..!!']);
                    }
                }
            }

            if(!empty($data_dokter)){
                $data_save['dokter_perujuk']=$data_dokter->kd_dokter;
            }

            if(empty($data_save['dokter_perujuk'])){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf form dokter masih kosong']);
            }

            $rules = [
                'noorder' => 'required|unique:permintaan_labpa'
            ];
    
            $message = [
                'noorder.unique' => 'Nomor Permintaan sudah digunakan.',
            ];

            if(empty($data_save['tgl_permintaan'])){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Form tanggal tidak boleh kosong']);
            }

            $no_order=$this->patologiAnatomiService->getNoOrder($data_save['tgl_permintaan']);
            $data_save['noorder']=$no_order;
            
            $validator = Validator::make($data_save, $rules, $message);
            if ($validator->fails()) {
                $errors = $validator->errors()->messages();
                return redirect()->route($link_back, $link_back_param)->with(['error' => true, 'error-messages' => $errors, 'errordata' => $request->all()]);
            }

            $jlh_save=0;
            if($item_pasien->no_fr=='ri'){
                $data_save['status']='ranap';
            }else{
                $data_save['status']='ralan';
            }

            $no_order=$this->patologiAnatomiService->getNoOrder($data_save['tgl_permintaan']);
            $data_save=$this->patologiAnatomiService->permintaanLabPa->set_columns_table_with_data($data_save);
            $data_save['noorder']=$no_order;
        
            $model_permintaan=$this->patologiAnatomiService->insert($data_save);
            if($model_permintaan){
                foreach($data_periksa as $key => $value){
                    $paramater=[];
                    $paramater = [
                        "noorder" => $data_save['noorder'],
                        "kd_jenis_prw" => $value,
                        "stts_bayar" => "Belum"
                    ];
                    $model_permintaan_lab=$this->patologiAnatomiService->insert_pemeriksaan_lab_pa($paramater);
                    if($model_permintaan_lab){
                        $jlh_save++;
                    }else{
                        $jlh_save--;
                    }
                }
            }

            $is_save=0;
            if($jlh_save>0){

                $tindakan_pasien_model = new \App\Models\UxuiTindakanPasien;
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
                $model_tindakan->permintaan_lab=1;

                if($model_tindakan->save()){
                    $is_save=1;
                }
            }

            if($is_save>0){
                DB::commit();
                $pesan=['success' => $message_default['success']];
                unset($link_back_param['pdt']);
            }else{
                DB::rollBack();
                $pesan=['error' => $message_default['error']];
            }
            return redirect()->route($link_back, $link_back_param)->with($pesan);
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf gagal menyimpan data. Ada data yang sama dimasukan sebelumnya']);
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
        $noorder=!empty($exp[1]) ? $exp[1] : 0;
        $no_rm=!empty($exp[2]) ? $exp[2] : 0;
        $no_rawat=!empty($exp[3]) ? $exp[3] : 0;

        $link_back='patologi_anatomi';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $no_rawat,'fr'=>$type_akses];
        
        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];

        try {  
            if($type_akses=='ri'){
                $model=$this->patologiAnatomiService->getListRanap(['permintaan_labpa.noorder'=>$noorder,'permintaan_labpa.status'=>'ranap']);
            }else{
                $model=$this->patologiAnatomiService->getListRalan(['permintaan_labpa.noorder'=>$noorder,'permintaan_labpa.status'=>'ralan']);
            }
            $model=!empty($model[0]) ? $model[0] : (object)[];

            if(!empty($model)){

                $check=0;
                if($model->tgl_sampel!='0000-00-00' and $model->tgl_sampel!='' ){
                    $check=1;
                }
                if(!empty($check)){
                    if($model->jam_sampel!='00:00:00' and $model->jam_sampel!='' ){
                        $check=1;
                    }else{
                        $check=0;
                    }   
                }

                if(!empty($check)){
                    return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf, Sudah dilakukan pengambilan sampel...!!!!']);
                }

                if(!empty($noorder)){
                    $delete_model=$this->patologiAnatomiService->delete(['noorder'=>$noorder,'stts_bayar'=>'Sudah']);
                    if($delete_model=='error'){
                        return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf, Tidak boleh dihapus karena sudah ada tindakan yang sudah dibayar.<br>Silahkan hubungi kasir...!!!!']);
                    }

                    $save_delete=0;
                    if ($delete_model) {
                        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($type_akses);
                        $model_tindakan=\App\Models\UxuiTindakanPasien::where('no_rawat', $item_pasien->no_rawat)
                        ->where('no_rkm_medis', $item_pasien->no_rm)
                        ->where('type_akses', $item_pasien->no_fr)
                        ->first();

                        if(!empty($model_tindakan)){
                            $check_lab=0;
                            if($type_akses=='ri'){
                                $check_klinis=$this->patologiKlinisService->getListRanap(['permintaan_lab.no_rawat'=>$item_pasien->no_rawat,'reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'permintaan_lab.status'=>'ranap']);
                                $check_radiologi=$this->pemeriksaanRadiologiService->getListRanap(['permintaan_radiologi.no_rawat'=>$item_pasien->no_rawat,'reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'permintaan_radiologi.status'=>'ranap']);
                            }else{
                                $check_klinis=$this->patologiKlinisService->getListRalan(['permintaan_lab.no_rawat'=>$item_pasien->no_rawat,'reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'permintaan_lab.status'=>'ralan']);
                                $check_radiologi=$this->pemeriksaanRadiologiService->getListRalan(['permintaan_radiologi.no_rawat'=>$item_pasien->no_rawat,'reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'permintaan_radiologi.status'=>'ralan']);
                            }
                            
                            if(count($check_klinis)){
                                $check_lab++;
                            }
                            if(count($check_radiologi)){
                                $check_lab++;
                            }

                            if($check_lab==0){
                                $model_tindakan->permintaan_lab=0;
                                if($model_tindakan->save()){
                                    $save_delete=1;
                                }else{
                                    $save_delete=0;
                                }
                            }else{
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
        $noorder=!empty($exp[1]) ? $exp[1] : '';
        if($type_akses=='ri'){
            $model=$this->patologiAnatomiService->getListRanap(['permintaan_labpa.noorder'=>$noorder,'permintaan_labpa.status'=>'ranap']);
        }else{
            $model=$this->patologiAnatomiService->getListRalan(['permintaan_labpa.noorder'=>$noorder,'permintaan_labpa.status'=>'ralan']);
        }
        
        $model=!empty($model[0]) ? $model[0] : (object)[];

        $list_pp_lab=[];
        if(!empty($model)){
            $data=$this->patologiAnatomiService->getPermintaanPemeriksaanLabPa(['permintaan_pemeriksaan_labpa.noorder'=>$model->noorder]);
            if(!empty($data)){
                foreach($data as $key => $value){
                    $list_pp_lab[$value->kd_jenis_prw]=$value;
                }
            }
        }

        $parameter_view=[
            'model'=>$model,
            'type_akses'=>$type_akses,
            'list_pp_lab'=>$list_pp_lab,
        ];

        if($request->ajax()){
            $returnHTML = view('patologi-anatomi.view',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    function getNoOrder(Request $request){

        return $this->sendSuccess($this->patologiAnatomiService->getNoOrder($request->tgl), "Success");
    }
}