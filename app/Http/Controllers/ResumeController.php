<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Services\GlobalService;
use App\Services\RawatJalanService;
use App\Services\CpptService;
use App\Services\ResumeService;
use App\Services\RekamMedisService;

class ResumeController extends Controller
{
    protected $cpptService;
    public function __construct(
        GlobalService $globalService,
        RawatJalanService $rawatJalanService,
        CpptService $cpptService,
        ResumeService $resumeService
    ) {
        $this->globalService = $globalService;
        $this->rawatJalanService = $rawatJalanService;
        $this->cpptService = $cpptService;
        $this->resumeService = $resumeService;
        $this->rekamMedisService = new RekamMedisService;
    }

    private function data_form($params){

        $no_rawat = !empty($params['no_rawat']) ? $params['no_rawat'] : '';
        $no_rm = !empty($params['no_rm']) ? $params['no_rm'] : '';
        $type_form = !empty($params['type_form']) ? $params['type_form'] : '';

        $return=[];
        if ($no_rawat && $no_rm && $type_form) {

            $dataPasien = $this->globalService->getDataPasien($no_rm);
            $diagnosaList = $this->resumeService->getDiagnosaList("");
            $prosedurList = $this->resumeService->getProsedurList("");

            if($type_form!='ri'){
                $kondisiPasienPulang = $this->resumeService->getKondisiPasienPulangList();                
            }else{
                $keadaan_pulang_pasien = $this->resumeService->resumePasienRanap->getListKeadaanPulangPasien();
                $cara_keluar_pasien = $this->resumeService->resumePasienRanap->getListCaraKeluarPasien();
                $pasien_dilanjutkan = $this->resumeService->resumePasienRanap->getListPasienDilanjutkan();
            }

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

            $model['no_rawat']=$no_rawat;
            $model['fr']=$type_form;
            $model['no_rm']=$no_rm;
            $model['nm_pasien']=!empty($dataPasien->nm_pasien) ? $dataPasien->nm_pasien : '';
            $model['kd_dokter']=!empty($data_dokter->kd_dokter) ? $data_dokter->kd_dokter : '';
            $model['nm_dokter']=!empty($data_dokter->nm_dokter) ? $data_dokter->nm_dokter : '';

            if($type_form=='ri'){
                $data_ranap=$this->resumeService->getDataRawatRanap(['reg_periksa.no_rawat'=>$no_rawat]);
                $data_ranap=!empty($data_ranap) ? $data_ranap[0] : [];
                $model['diagnosa_awal']=!empty($data_ranap->diagnosa_awal) ? $data_ranap->diagnosa_awal :  "";
            }
            $model=(object)$model;

            $return=[
                "dataPasien" => $dataPasien,
                "data_dokter" => !empty($data_dokter) ? $data_dokter : [],
                "diagnosaList" => !empty($diagnosaList) ? $diagnosaList : [],
                "prosedurList" => !empty($prosedurList) ? $prosedurList : [],
                "model" => !empty($model) ? $model : [],
                "kondisiPasienPulang" => !empty($kondisiPasienPulang) ? $kondisiPasienPulang : [],
                'data_ranap'=>!empty($data_ranap) ? $data_ranap : [],
                "keadaan_pulang_pasien" => !empty($keadaan_pulang_pasien) ? $keadaan_pulang_pasien : [],
                "cara_keluar_pasien" => !empty($cara_keluar_pasien) ? $cara_keluar_pasien : [],
                "pasien_dilanjutkan" => !empty($pasien_dilanjutkan) ? $pasien_dilanjutkan : [],
            ];
        }

        return $return;
    }

    function actionIndex(Request $request){
        
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {

            $noRawat = $item_pasien->no_rawat;
            $noRm = $item_pasien->no_rm;

            $paramater_data=[
                'no_rawat'=>$item_pasien->no_rawat,
                'no_rm'=>$item_pasien->no_rm,
                'type_form'=>$item_pasien->no_fr,
            ];

            $parameter_data_form=$this->data_form($paramater_data);

            if(!empty($request->cdata)){
                $kodes_data=$request->cdata;
                $id_resume=!empty($request->cid_resume) ? $request->cid_resume : '';
                $type_akses=$item_pasien->no_fr;
                $get_kodes=$this->setting_kodes_data($kodes_data,$type_akses);
                $kodes_data=$get_kodes->kodes_data;

                if($type_akses=='ri'){
                    $where_params["raw"]=$kodes_data;
                    if(!empty($id_resume)){
                        $where_params=[
                            "id_resume_ranap"=>$id_resume
                        ];
                    }
                    $get_data=$this->resumeService->getResumeRanapList($where_params);
                }else{
                    $where_params["raw"]=$kodes_data;
                    if(!empty($id_resume)){
                        $where_params=[
                            "id_resume"=>$id_resume
                        ];
                    }
                    $get_data=$this->resumeService->getResumeList($where_params);
                }
                $get_data=!empty($get_data[0]) ? (array)$get_data[0]->getAttributes() : [];
                unset($get_data['no_rm']);
                unset($get_data['no_rawat']);
                unset($get_data['nm_pasien']);
                unset($get_data['kd_dokter']);
                unset($get_data['nm_dokter']);
                unset($get_data['kondisi_pulang']);
                unset($get_data['diagnosa_awal']);
                unset($get_data['alasan']);
                unset($get_data['keadaan']);
                unset($get_data['ket_keadaan']);
                unset($get_data['cara_keluar']);
                unset($get_data['ket_keluar']);
                unset($get_data['dilanjutkan']);
                unset($get_data['ket_dilanjutkan']);
                unset($get_data['tanggal_kontrol']);
                unset($get_data['jam_kontrol']);
                unset($get_data['id_resume']);
                unset($get_data['id_resume_ranap']);

                $model=(array)$parameter_data_form['model'];
                $model=array_merge($model,$get_data);
                $model=(object)$model;
                $parameter_data_form['model']=$model;
            }

            $filter_start=!empty($request->form_filter_start) ? $request->form_filter_start : '';
            $filter_end=!empty($request->form_filter_end) ? $request->form_filter_end : '';
            $filter_search_text=!empty($request->form_filter_text) ? $request->form_filter_text : '';

            if($item_pasien->no_fr=='ri'){
                // $dataList=$this->resumeService->getResumeRanapList(['resume_pasien_ranap.no_rawat'=>$noRawat,'tgl_registrasi'=>[$filter_start,$filter_end],'search'=>$filter_search_text]);
                $dataList=$this->resumeService->getResumeRanapList(['reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'tgl_registrasi'=>[$filter_start,$filter_end],'search'=>$filter_search_text]);
                DB::statement("ALTER TABLE resume_pasien_ranap AUTO_INCREMENT = 1");
            }else{
                // $dataList=$this->resumeService->getResumeList(['resume_pasien.no_rawat'=>$noRawat,'search'=>$filter_search_text],[$filter_start,$filter_end]);
                $dataList=$this->resumeService->getResumeList(['reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'search'=>$filter_search_text],[$filter_start,$filter_end]);
                DB::statement("ALTER TABLE resume_pasien AUTO_INCREMENT = 1");
            }

            $data_list_tmp=[];

            $pattern = array('/\s+/','/(\+|\s)+/');
            $replacement = array('', '+');
            foreach($dataList as $key => $value){
                $value=$value->getAttributes();
                $kode=json_encode($value,true);
                // $kode=preg_replace('/\s+/', '', $kode);
                $kode=preg_replace($pattern, $replacement, $kode);
                $kode=str_replace ('+','',$kode);
                $value['kodes']=$kode;
                $data_list_tmp[]=(object)$value;
            }

            $dataList=$data_list_tmp;


            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
            if($item_pasien->no_fr!='ri'){
                $get_keluhan = $this->resumeService->getKeluhanUtamaRalan(['no_rawat'=>$noRawat,'nik'=>$get_user->id_user]);
            }else{
                $get_keluhan = $this->resumeService->getKeluhanUtamaRanap(['no_rawat'=>$noRawat,'nik'=>$get_user->id_user]);
            }
            $keluhan_utama_tmp=[];
            $pemeriksaan_utama_tmp=[];
            if(!empty($get_keluhan)){
                foreach($get_keluhan as $key=>$value){
                    $keluhan_utama_tmp[]=$value->keluhan;
                    $pemeriksaan_utama_tmp[]=$value->pemeriksaan;
                }
            }
            $keluhan_utama_tmp=array_unique($keluhan_utama_tmp);
            $pemeriksaan_utama_tmp=array_unique($pemeriksaan_utama_tmp);

            $model=(array)$parameter_data_form['model'];
            if(empty($model['keluhan_utama'])){
                $model['keluhan_utama']=implode(',',$keluhan_utama_tmp);
            }
            if(empty($model['pemeriksaan_fisik'])){
                $model['pemeriksaan_fisik']=implode(',',$pemeriksaan_utama_tmp);
            }
            $parameter_data_form['model']=(object)$model;
            
            
            $parameter_view=[
                'dataList'=> !empty($dataList) ? $dataList : [],
                'action_form'=>'isi-resume/create',
            ];

            $parameter_view=array_merge($parameter_view,$parameter_data_form);

            return view('resume.index',$parameter_view);
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    }

    function actionCreate(Request $request){

        DB::beginTransaction();
        $fields = $request->all();
        $type_akses=$fields["fr"];
        unset($fields["fr"]);
        unset($fields["no_rm"]);
        $link_back='isi_resume';
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
            unset($data_save["key_old"]);
            unset($data_save["id_resume"]);
        
            $data_dokter =null;
            if($type_akses!='ri'){
                $paramater = [
                    'reg_periksa.no_rawat' => $request->no_rawat
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
                        'dpjp_ranap.no_rawat' => $request->no_rawat,
                        'dpjp_ranap.kd_dokter' =>  !empty($request->kd_dokter) ? $request->kd_dokter : 0,
                    ];
                    $data_dokter = $this->rekamMedisService->getDokterByDpjpRanap($paramater,2);
                    if(!$data_dokter){
                        return redirect()->route($link_back, $link_back_param)->with(['error' => 'Dokter PJ Tidak terdaftar pada no rawat '.$request->no_rawat.'..!!']);
                    }
                }
            }
        
            unset($data_save["kd_dokter"]);

            if(!empty($data_dokter)){
                $data_save["kd_dokter"]=$data_dokter->kd_dokter;
            }

            if($type_akses=='ri'){
                $waktu_kontrol=$data_save['tanggal_kontrol'].' '.$data_save['jam_kontrol'];
                unset($data_save["tanggal_kontrol"]);
                unset($data_save["jam_kontrol"]);
                $data_save["kontrol"]=$waktu_kontrol;
            }

            foreach($data_save as $dk => $dt){
                if($dt==null){
                    $data_save[$dk]='';
                }
            }

            if($data_save){
                if($type_akses=='ri'){
                    $model_save=$this->resumeService->insertRanap($data_save);
                }else{
                    $model_save=$this->resumeService->insert($data_save);
                }

                $is_save=0;
                if($model_save){
                    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($type_akses);
                    
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
                    $model_tindakan->resume=1;

                    if($model_tindakan->save()){
                        $is_save=1;
                    }
                }

                if($is_save){
                    DB::commit();
                    $pesan=['success' => $message_default['success']];
                }else{
                    DB::rollBack();
                    $pesan=['error' => $message_default['error']];
                }
            }else{
                $pesan=['error' => $message_default['error']];
            }
            return redirect()->route($link_back, $link_back_param)->with($pesan);
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf gagal menyimpan data. Ada No.Rawat yang sama dimasukan sebelumnya']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }
    }

    private function setting_kodes_data_query($data){
        $quer='';
        $quer="REPLACE(".$data.",' ', '')";
        $quer="REPLACE(".$quer.",'+', '')";
        return $quer;
    }

    private function setting_kodes_data($kodes_data,$type_akses,$id_resume=''){
        // $kodes_data = preg_replace('/[[:cntrl:]]/', '', $kodes_data);
        $kodes_data=(array)json_decode($kodes_data,true);
        
        $khusus=[
            'no_rkm_medis'=>'reg_periksa.no_rkm_medis',
            'tgl_registrasi'=>'reg_periksa.tgl_registrasi',
            'nm_pasien'=>'pasien.nm_pasien',
        ];

        $table_qu='resume_pasien';
        if($type_akses=='ri'){
            $table_qu='resume_pasien_ranap';

            $khusus['kodepengirim']='reg_periksa.kd_dokter';
            $khusus['jam_reg']='reg_periksa.jam_reg';
            $khusus['kd_pj']='reg_periksa.kd_pj';
            $khusus['png_jawab']='penjab.png_jawab';
            unset($kodes_data['pengirim']);
        }else{
            $khusus['status_lanjut']='reg_periksa.status_lanjut';
        }
        unset($kodes_data['nm_dokter']);

        $kodes_data_update=[];
        $kodes_data_tmp=[];

        if($type_akses=='ri'){
            $kodes_data=$this->resumeService->resumePasienRanap->set_columns_table_with_data($kodes_data);
        }else{
            $kodes_data=$this->resumeService->resumePasien->set_columns_table_with_data($kodes_data);    
        }

        foreach($kodes_data as $index => $value){
            if(!empty($khusus[$index]) ){
                $d=$this->setting_kodes_data_query($khusus[$index]);
            }else{
                $d=$this->setting_kodes_data_query($table_qu.'.'.$index);
                $kodes_data_update[$d]=$value;
            }
            $kodes_data_tmp[$d]=$value;
        }

        return (object)[
            'kodes_data'=>$kodes_data_tmp,
            'kodes_data_update'=>$kodes_data_update,
        ];
    }

    function formUpdate(Request $request){

        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : '';
        $no_rm=!empty($exp[2]) ? $exp[2] : '';
        $kodes_data=!empty($exp[3]) ? $exp[3] : '';
        $id_resume=!empty($exp[4]) ? $exp[4] : '';

        $link_back='isi_resume';
        $url_back_index='isi-resume?'.'no_rm='.$no_rm.'&'.'no_rawat='.$no_rawat.'&'.'fr='.$type_akses;

        if ($no_rm && $no_rawat && $type_akses) {

            $paramater_data=[
                'no_rawat'=>$no_rawat,
                'no_rm'=>$no_rm,
                'type_form'=>$type_akses,
            ];

            $parameter_data_form=$this->data_form($paramater_data);

            $model=!empty($parameter_data_form['model']) ? (array)$parameter_data_form['model'] : [];

            $get_kodes=$this->setting_kodes_data($kodes_data,$type_akses,$id_resume);
            $kodes_data=$get_kodes->kodes_data;
            
            if($type_akses=='ri'){
                $where_params["raw"]=$kodes_data;
                if(!empty($id_resume)){
                    $where_params=[
                        "id_resume_ranap"=>$id_resume
                    ];
                }
                $get_data=$this->resumeService->getResumeRanapList($where_params);
            }else{
                $where_params["raw"]=$kodes_data;
                if(!empty($id_resume)){
                    $where_params=[
                        "id_resume"=>$id_resume
                    ];
                }
                $get_data=$this->resumeService->getResumeList($where_params);
            }

            $get_data=!empty($get_data[0]) ? (array)$get_data[0]->getAttributes() : [];
            if(!empty($get_data['kontrol'])){
                $waktu=new \DateTime($get_data['kontrol']);
                $tanggal=$waktu->format('Y-m-d');
                $jam=$waktu->format('H:i');
                $get_data['tanggal_kontrol']=$tanggal;
                $get_data['jam_kontrol']=$jam;
            }
            $model=array_merge($model,$get_data);

            $model=(object)$model;
            $parameter_data_form['model']=$model;

            $kode_key_old=$get_kodes->kodes_data_update;

            $kode_key_old=(new \App\Http\Traits\GlobalFunction)->makeJson($kode_key_old);

            $parameter_view=[
                'action_form'=>'isi-resume/update',
                'kode_key_old'=>$kode_key_old,
                'url_back_index'=>$url_back_index,
                'type_akses'=>$type_akses
            ];

            $parameter_view=array_merge($parameter_view,$parameter_data_form);

            return view('resume.index',$parameter_view);
        }
    }

    function actionUpdate(Request $request){
        
        DB::beginTransaction();
        $fields = $request->all();

        $type_akses=!empty($fields['fr']) ? $fields['fr'] : 'rj';
        $no_rm=!empty($fields['no_rm']) ? $fields['no_rm'] : '';
        $no_rawat=!empty($fields['no_rawat']) ? $fields['no_rawat'] : 'rj';
        $id_resume=!empty($fields['id_resume']) ? $fields['id_resume'] : '';

        $link_back='isi_resume';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $request->no_rawat,'fr'=>$type_akses];

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
            unset($data_save["no_rawat"]);
            unset($data_save["id_resume"]);

            $next_proses=0;
            if($key_old && $data_save){
                $next_proses=1;
            }
            if(empty($next_proses)){
                if($id_resume && $data_save){
                    $next_proses=1;
                }
            }

            if($next_proses){
                
                $data_dokter =null;
                if($type_akses!='ri'){
                    $paramater = [
                        'reg_periksa.no_rawat' => $request->no_rawat
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
                            'dpjp_ranap.no_rawat' => $request->no_rawat,
                            'dpjp_ranap.kd_dokter' =>  !empty($request->kd_dokter) ? $request->kd_dokter : 0,
                        ];
                        $data_dokter = $this->rekamMedisService->getDokterByDpjpRanap($paramater,2);
                        if(!$data_dokter){
                            return redirect()->route($link_back, $link_back_param)->with(['error' => 'Dokter PJ Tidak terdaftar pada no rawat '.$request->no_rawat.'..!!']);
                        }
                    }
                }

                if(!empty($data_dokter)){
                    $data_save['kd_dokter']=$data_dokter->kd_dokter;
                }

                if($type_akses=='ri'){
                    $waktu_kontrol=$data_save['tanggal_kontrol'].' '.$data_save['jam_kontrol'];
                    unset($data_save["tanggal_kontrol"]);
                    unset($data_save["jam_kontrol"]);
                    $data_save["kontrol"]=$waktu_kontrol;
                }
                
                $jlh_save=0;

                foreach($data_save as $dk => $dt){
                    if($dt==null){
                        $data_save[$dk]='';
                    }
                }

                $paramater_where=(array)$key_old;

                if($type_akses=='ri'){
                    if(!empty($id_resume)){
                        $paramater_where=[
                            'id_resume_ranap'=>$id_resume,
                        ];
                        $update_model=$this->resumeService->updateRanap($paramater_where,$data_save);    
                    }else{
                        $update_model=$this->resumeService->updateRanap($paramater_where,$data_save,'raw');    
                    }
                }else{
                    if(!empty($id_resume)){
                        $paramater_where=[
                            'id_resume'=>$id_resume,
                        ];
                        $update_model=$this->resumeService->update($paramater_where,$data_save);  
                    }else{
                        $update_model=$this->resumeService->update($paramater_where,$data_save,'raw');
                    }
                }

                if($update_model){
                    $jlh_save=1;
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

    function actionDelete(Request $request){

        DB::beginTransaction();
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : 0;
        $no_rm=!empty($exp[2]) ? $exp[2] : 0;
        $kodes_data=!empty($exp[3]) ? $exp[3] : '';
        $id_resume=!empty($exp[4]) ? $exp[4] : '';

        $link_back='isi_resume';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $no_rawat,'fr'=>$type_akses];

        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];

        try {
            if(!empty($no_rawat)){
                $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
                
                $get_kodes=$this->setting_kodes_data($kodes_data,$type_akses);
                $paramater_where=$get_kodes->kodes_data_update;

                if($type_akses=='ri'){
                    if(!empty($id_resume)){
                        $paramater_where=[
                            'id_resume_ranap'=>$id_resume,
                        ];
                        $delete_model=$this->resumeService->deleteRanap($paramater_where);
                    }else{
                        $delete_model=$this->resumeService->deleteRanap($paramater_where,'raw');
                    }
                }else{
                    if(!empty($id_resume)){
                        $paramater_where=[
                            'id_resume'=>$id_resume,
                        ];
                        $delete_model=$this->resumeService->delete($paramater_where);
                    }else{
                        $delete_model=$this->resumeService->delete($paramater_where,'raw');
                    }
                }

                $save_delete=0;
                if ($delete_model) {
                    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($type_akses);
                    
                    $tindakan_pasien_model = new \App\Models\UxuiTindakanPasien;
                    $model_tindakan=$tindakan_pasien_model::where('no_rawat', $item_pasien->no_rawat)
                    ->where('no_rkm_medis', $item_pasien->no_rm)
                    ->where('type_akses', $item_pasien->no_fr)
                    ->first();

                    if(!empty($model_tindakan)){
                        $model_tindakan->resume=0;

                        if($model_tindakan->save()){
                            $save_delete=1;
                        }
                    }else{
                        $save_delete=1;
                    }
                }

                if ($save_delete) {
                    DB::commit();
                    if($type_akses=='ri'){
                        DB::statement("ALTER TABLE resume_pasien_ranap AUTO_INCREMENT = 1");
                    }else{
                        DB::statement("ALTER TABLE resume_pasien AUTO_INCREMENT = 1");
                    }
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

    function actionView(Request $request){

        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : '';
        $kodes_data=!empty($exp[3]) ? $exp[3] : '';
        $id_resume=!empty($exp[4]) ? $exp[4] : '';
        
        $get_kodes=$this->setting_kodes_data($kodes_data,$type_akses);
        $kodes_data=$get_kodes->kodes_data;

        if($type_akses=='ri'){
            $where_params["raw"]=$kodes_data;
            if(!empty($id_resume)){
                $where_params=[
                    "id_resume_ranap"=>$id_resume
                ];
            }
            $model=$this->resumeService->getResumeRanapList($where_params);
            $kamarInap=$this->resumeService->getKamarInap(['kamar_inap.no_rawat'=>$no_rawat]);
            $kamarInap=!empty($kamarInap[0]) ? $kamarInap[0] : (object)[];
        }else{
            $where_params["raw"]=$kodes_data;
            if(!empty($id_resume)){
                $where_params=[
                    "id_resume"=>$id_resume
                ];
            }
            $model=$this->resumeService->getResumeList($where_params);
        }
        $model=!empty($model[0]) ? $model[0] : (object)[];

        $bagan_html='resume.view';
        if($type_akses=='ri'){
            $parameter_view=[
                'model'=>$model,
                'kamarInap'=>$kamarInap
            ];
            $bagan_html='resume.view_ranap';
        }else{
            $parameter_view=[
                'model'=>$model,
            ];
            $bagan_html='resume.view';
        }

        if($request->ajax()){
            $returnHTML = view($bagan_html,$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }else{
            return view($bagan_html,$parameter_view);
        }
    }

    function penyakitIndexData(Request $request){
        return $this->resumeService->getDiagnosaList($request->search);
    }

    function prosedurIndexData(Request $request){
        return $this->resumeService->getProsedurList($request->search);
    }

    function ajax(Request $request){

        $get_req = $request->all();

        if(!empty($get_req['action'])){
            if($get_req['action']=='pemeriksaan_keluhan'){
                $exp=explode('@',$get_req['data_sent']);
                $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
                $no_rawat=!empty($exp[1]) ? $exp[1] : '';

                if($type_akses!='ri'){
                    $list_data = $this->resumeService->getKeluhanUtamaRalan(['no_rawat'=>$no_rawat]);
                }else{
                    $list_data = $this->resumeService->getKeluhanUtamaRanap(['no_rawat'=>$no_rawat]);
                }

                if($request->ajax()){
                    $returnHTML = view('resume.columns_pemeriksaan_keluhan',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }

            if($get_req['action']=='pemeriksaan_fisik'){
                $exp=explode('@',$get_req['data_sent']);
                $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
                $no_rawat=!empty($exp[1]) ? $exp[1] : '';

                if($type_akses!='ri'){
                    $list_data = $this->resumeService->getKeluhanUtamaRalan(['no_rawat'=>$no_rawat]);
                }else{
                    $list_data = $this->resumeService->getKeluhanUtamaRanap(['no_rawat'=>$no_rawat]);
                }

                if($request->ajax()){
                    $returnHTML = view('resume.columns_pemeriksaan_fisik',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }

            if($get_req['action']=='pemeriksaan_radiologi'){
                $exp=explode('@',$get_req['data_sent']);
                $no_rawat=!empty($exp[0]) ? $exp[0] : '';

                $list_data = $this->resumeService->getHasilRadiologiList($no_rawat);

                if($request->ajax()){
                    $returnHTML = view('resume.columns_pemeriksaan_radiologi',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }

            if($get_req['action']=='pemeriksaan_lab'){
                $exp=explode('@',$get_req['data_sent']);
                $no_rawat=!empty($exp[0]) ? $exp[0] : '';

                $list_data = $this->resumeService->getDetailPeriksaLabList($no_rawat);

                if($request->ajax()){
                    $returnHTML = view('resume.columns_pemeriksaan_lab',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }

            if($get_req['action']=='riwayat_tindakan_operasi'){
                $exp=explode('@',$get_req['data_sent']);
                $no_rawat=!empty($exp[0]) ? $exp[0] : '';

                $list_data = $this->resumeService->getRiwayatTindakanOperasi(['rawat_jl_dr.no_rawat'=>$no_rawat],['rawat_inap_dr.no_rawat'=>$no_rawat],['operasi.no_rawat'=>$no_rawat]);

                if($request->ajax()){
                    $returnHTML = view('resume.columns_riwayat_tindakan_operasi',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }

            if($get_req['action']=='obat_rs'){
                $exp=explode('@',$get_req['data_sent']);
                $no_rawat=!empty($exp[0]) ? $exp[0] : '';

                $list_data = $this->resumeService->getObatRs($no_rawat);

                if($request->ajax()){
                    $returnHTML = view('resume.columns_obat_rs',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }

            if($get_req['action']=='obat_pulang'){
                $exp=explode('@',$get_req['data_sent']);
                $no_rawat=!empty($exp[0]) ? $exp[0] : '';

                $list_data = $this->resumeService->getObatPulang(['resep_pulang.no_rawat'=>$no_rawat]);

                if($request->ajax()){
                    $returnHTML = view('resume.columns_obat_pulang',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }

            if($get_req['action']=='riwayat_diet'){
                $exp=explode('@',$get_req['data_sent']);
                $no_rawat=!empty($exp[0]) ? $exp[0] : '';

                $list_data = $this->resumeService->getRiwayatDiet(['detail_beri_diet.no_rawat'=>$no_rawat]);

                if($request->ajax()){
                    $returnHTML = view('resume.columns_riwayat_diet',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }

            if($get_req['action']=='hasil_lab_belum'){
                $exp=explode('@',$get_req['data_sent']);
                $no_rawat=!empty($exp[0]) ? $exp[0] : '';

                $list_data = $this->resumeService->getRiwayatLabBelum(['permintaan_lab.tgl_hasil'=>'0000-00-00','permintaan_lab.no_rawat'=>$no_rawat]);

                if($request->ajax()){
                    $returnHTML = view('resume.columns_riwayat_lab_belum',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }
        }

        return response()->json(array('error' => true, 'html'=>''));
    }
}