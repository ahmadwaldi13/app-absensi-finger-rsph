<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Services\GlobalService;
use App\Services\PatologiKlinisService;
use App\Services\PatologiAnatomiService;
use App\Services\PemeriksaanRadiologiService;
use App\Services\RekamMedisService;

class PatologiKlinisController extends Controller
{
    public function __construct(
        GlobalService $globalService,
        PatologiKlinisService $patologiKlinisService,
        PatologiAnatomiService $patologiAnatomiService,
        PemeriksaanRadiologiService $pemeriksaanRadiologiService

    ) {
        $this->globalService = $globalService;
        $this->patologiKlinisService = $patologiKlinisService;
        $this->patologiAnatomiService = $patologiAnatomiService;
        $this->pemeriksaanRadiologiService = $pemeriksaanRadiologiService;
        $this->rekamMedisService = new RekamMedisService;

    }

    private function data_form($params){

        $no_rawat = !empty($params['no_rawat']) ? $params['no_rawat'] : '';
        $no_rm = !empty($params['no_rm']) ? $params['no_rm'] : '';
        $type_form = !empty($params['type_form']) ? $params['type_form'] : '';

        $return=[];
        if ($no_rawat && $no_rm && $type_form) {

            $no_order=$this->patologiKlinisService->getNoOrder(date('Y-m-d'));

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

            $getReqPeriksa= (new \App\Models\RegPeriksa)->select('kd_pj')->where('no_rawat',$no_rawat)->first();
            $parameter_where=[
                'jns_perawatan_lab.kategori'=>'PK',
                'jns_perawatan_lab.status'=>'1',
                'penjab.kd_pj'=>!empty($getReqPeriksa->kd_pj) ? $getReqPeriksa->kd_pj : '',
            ];

            $pemeriksaan_list1=$this->patologiKlinisService->getjnsPerawatanLab($parameter_where);

            $return=[
                "model" => !empty($model) ? $model : [],
                'pemeriksaan_list1'=>$pemeriksaan_list1
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
                $list_data=$this->patologiKlinisService->getListRanap(['permintaan_lab.no_rawat'=>$noRawat,'permintaan_lab.status'=>'ranap','tgl_permintaan'=>[$filter_start,$filter_end]]);
            }else{
                $list_data=$this->patologiKlinisService->getListRalan(['permintaan_lab.no_rawat'=>$noRawat,'permintaan_lab.status'=>'ralan','tgl_permintaan'=>[$filter_start,$filter_end]]);
            }

            $paramater_data=[
                'no_rawat'=>$item_pasien->no_rawat,
                'no_rm'=>$item_pasien->no_rm,
                'type_form'=>$item_pasien->no_fr,
            ];



            $parameter_data_form=$this->data_form($paramater_data);

            $parameter_view=[
                'list_data'=>!empty($list_data) ? $list_data : [],
                'action_form'=>'patologi-klinis/create',
                'allow_btn_save'=>!empty($allow_btn_save) ? 1 : 0,
            ];

            $parameter_view=array_merge($parameter_view,$parameter_data_form);

            return view('patologi-klinis.index',$parameter_view);
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    }

    function actionCreate(Request $request)
    {
        DB::beginTransaction();
        $link_back='patologi_klinis';
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

            $data_save=$request->all();
            $data_periksa=!empty($data_save['periksa']) ? $data_save['periksa'] : [];
            $data_periksa_detail_tmp=!empty($data_save["periksa_sub"]) ? $data_save["periksa_sub"] : '';
            $link_back_param['pds']=$data_periksa_detail_tmp;
            $data_periksa_detail_tmp=explode('@',$data_periksa_detail_tmp);
            $data_periksa_detail=[];
            if(!empty($data_periksa_detail_tmp)){
                $data_periksa=[];
                foreach($data_periksa_detail_tmp as $value){
                    $exp=explode('$',$value);
                    if($exp[0] and $exp[1]){
                        $data_periksa[$exp[0]]=$exp[0];
                        $data_periksa_detail[$exp[0]][$exp[1]]=$exp[1];
                    }
                }
            }

            unset($data_save["fr"]);
            unset($data_save["no_rm"]);
            unset($data_save["_token"]);
            unset($data_save["key_old"]);
            unset($data_save['periksa']);
            unset($data_save["periksa_sub"]);

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
                'noorder' => 'required|unique:permintaan_lab'
            ];

            $message = [
                'noorder.unique' => 'Nomor Permintaan sudah digunakan.',
            ];

            if(empty($data_save['tgl_permintaan'])){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Form tanggal tidak boleh kosong']);
            }

            $no_order=$this->patologiKlinisService->getNoOrder($data_save['tgl_permintaan']);
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

            $no_order=$this->patologiKlinisService->getNoOrder($data_save['tgl_permintaan']);

            $model_save=$this->patologiKlinisService->permintaanLab->set_columns_table_with_data($data_save);
            $model_save['noorder']=$no_order;

            $model_permintaan=$this->patologiKlinisService->insert($model_save);
            if($model_permintaan){
                foreach($data_periksa as $key => $value){
                    $paramater=[];
                    $paramater = [
                        "noorder" => $model_save['noorder'],
                        "kd_jenis_prw" => $value,
                        "stts_bayar" => "Belum"
                    ];
                    $model_permintaan_lab=$this->patologiKlinisService->insert_pemeriksaan_lab($paramater);
                    if($model_permintaan_lab){
                        if(!empty($data_periksa_detail[$value])){
                            foreach($data_periksa_detail[$value] as $key_1 => $value_1){
                                $paramater=[];
                                $paramater = [
                                    "noorder" => $model_save['noorder'],
                                    "kd_jenis_prw" => $value,
                                    "id_template" => $value_1,
                                    "stts_bayar" => "Belum"
                                ];
                                $model_permintaan_detail_lab=$this->patologiKlinisService->insert_pemeriksaan_detail_lab($paramater);
                                if($model_permintaan_detail_lab){
                                    $jlh_save++;
                                }
                            }
                        }
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
                unset($link_back_param['pds']);
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

        $link_back='patologi_klinis';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $no_rawat,'fr'=>$type_akses];

        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];

        try {
            if($type_akses=='ri'){
                $model=$this->patologiKlinisService->getListRanap(['permintaan_lab.noorder'=>$noorder,'permintaan_lab.status'=>'ranap']);
            }else{
                $model=$this->patologiKlinisService->getListRalan(['permintaan_lab.noorder'=>$noorder,'permintaan_lab.status'=>'ralan']);
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
                    $delete_model=$this->patologiKlinisService->delete(['noorder'=>$noorder,'stts_bayar'=>'Sudah']);
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
                                $check_anatomi=$this->patologiAnatomiService->getListRanap(['permintaan_labpa.no_rawat'=>$item_pasien->no_rawat,'reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'permintaan_labpa.status'=>'ranap']);
                                $check_radiologi=$this->pemeriksaanRadiologiService->getListRanap(['permintaan_radiologi.no_rawat'=>$item_pasien->no_rawat,'reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'permintaan_radiologi.status'=>'ranap']);
                            }else{
                                $check_anatomi=$this->patologiAnatomiService->getListRalan(['permintaan_labpa.no_rawat'=>$item_pasien->no_rawat,'reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'permintaan_labpa.status'=>'ralan']);
                                $check_radiologi=$this->pemeriksaanRadiologiService->getListRalan(['permintaan_radiologi.no_rawat'=>$item_pasien->no_rawat,'reg_periksa.no_rkm_medis'=>$item_pasien->no_rm,'permintaan_radiologi.status'=>'ralan']);
                            }

                            if(count($check_anatomi)){
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
            $model=$this->patologiKlinisService->getListRanap(['permintaan_lab.noorder'=>$noorder,'permintaan_lab.status'=>'ranap']);
        }else{
            $model=$this->patologiKlinisService->getListRalan(['permintaan_lab.noorder'=>$noorder,'permintaan_lab.status'=>'ralan']);
        }

        $model=!empty($model[0]) ? $model[0] : (object)[];
        $list_pp_lab=[];
        $list_pdp_lab=[];
        if(!empty($model)){
            $data=$this->patologiKlinisService->getPermintaanPemeriksaanLab(['permintaan_pemeriksaan_lab.noorder'=>$model->noorder]);
            if(!empty($data)){
                foreach($data as $key => $value){
                    $list_pp_lab[$value->kd_jenis_prw]=$value;
                }
            }

            $data=$this->patologiKlinisService->getPermintaanDetailPermintaanLab(['permintaan_detail_permintaan_lab.noorder'=>$model->noorder]);
            if(!empty($data)){
                foreach($data as $key => $value){
                    $list_pdp_lab[$value->kd_jenis_prw][]=$value;
                }
            }
        }

        $parameter_view=[
            'model'=>$model,
            'type_akses'=>$type_akses,
            'list_pp_lab'=>$list_pp_lab,
            'list_pdp_lab'=>$list_pdp_lab
        ];

        if($request->ajax()){
            $returnHTML = view('patologi-klinis.view',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    function getNoOrder(Request $request){

        return $this->sendSuccess($this->patologiKlinisService->getNoOrder($request->tgl), "Success");
    }

    function ajax(Request $request){

        $get_req = $request->all();
        $get_kode=!empty($get_req['data_sent']) ? $get_req['data_sent'] : [];
        $data_sent=explode('@',$get_kode);
        $data_sent=array_unique($data_sent);
        $list_data=[];
        $list_data_header=[];

        if(!empty($data_sent)){
            $where=[
                'where_in'=>['jns_perawatan_lab.kd_jenis_prw',$data_sent],
                'Pemeriksaan'=>['<>',''],
            ];
            $data=$this->patologiKlinisService->getTemplateLaboratorium($where);
            if(!empty($data)){
                foreach($data as $value){
                    $list_data[$value->kd_jenis_prw][$value->id_template]=$value;
                    $list_data_header[$value->kd_jenis_prw]=$value->nm_perawatan;
                }
            }
        }

        $parameter_view=[
            'list_data'=>$list_data,
            'list_data_header'=>$list_data_header,
        ];
        if($request->ajax()){
            $returnHTML = view('patologi-klinis.columns_templatelab',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }else{
            return view('patologi-klinis.columns_templatelab',$parameter_view);
        }
    }
}
