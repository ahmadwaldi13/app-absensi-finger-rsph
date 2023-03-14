<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;
use DateTimeZone;

use App\Services\GlobalService;
use App\Services\RacikanService;
use App\Services\ResepService;
use App\Services\BpjsService;
use App\Services\RekamMedisService;

class RacikanController extends Controller
{
    protected $cpptService;
    public function __construct(
        GlobalService $globalService,
        RacikanService $racikanService,
        ResepService $resepService,
        BpjsService $bpjsService
    ) {
        $this->globalService = $globalService;
        $this->racikanService = $racikanService;
        $this->resepService = $resepService;
        $this->bpjsService = $bpjsService;

        $this->rekamMedisService = new RekamMedisService;
    }

    private function data_form($params){

        $no_rawat = !empty($params['no_rawat']) ? $params['no_rawat'] : '';
        $no_rm = !empty($params['no_rm']) ? $params['no_rm'] : '';
        $type_form = !empty($params['type_form']) ? $params['type_form'] : '';

        $return=[];
        if ($no_rawat && $no_rm && $type_form) {

            $data_pasien = $this->globalService->getDataPasien($no_rm);

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
            $model['nm_pasien']=!empty($data_pasien->nm_pasien) ? $data_pasien->nm_pasien : '';
            $model['kd_dokter']=!empty($data_dokter->kd_dokter) ? $data_dokter->kd_dokter : '';
            $model['nm_dokter']=!empty($data_dokter->nm_dokter) ? $data_dokter->nm_dokter : '';

            $no_resep=$this->racikanService->getNoResep(date('Y-m-d'));
            $model['no_resep']=!empty($no_resep) ? $no_resep : '';

            $model=(object)$model;

            $return=[
                "model" => !empty($model) ? $model : [],
            ];
        }

        return $return;
    }

    private function getCopyResep($params){
        $type_akses=!empty($params['type_form']) ? $params['type_form'] : 'rj';
        $no_rawat=!empty($params['no_rawat']) ? $params['no_rawat'] : 0;
        $no_rm=!empty($params['no_rm']) ? $params['no_rm'] : 0;
        $no_resep=!empty($params['no_resep']) ? $params['no_resep'] : 0;

        $paramater_search=[
            'resep_obat.no_resep'=>$no_resep
        ];
        if($type_akses=='ri'){
            $paramater_search['resep_obat.status']='ranap';
        }else{
            $paramater_search['resep_obat.status']='ralan';
        }
        $get_data=$this->racikanService->getResepListDetail($paramater_search);
        $get_data=!empty($get_data[0]) ? $get_data[0] : (object)[];
        $model=$get_data;

        $list_resep_racikan=[];
        if(!empty($model->item_resep_racikan)){
            if($type_akses=='ri'){
                $bangsal=$this->resepService->getKamar(['kamar_inap.no_rawat'=>$no_rawat]);
                $bangsal=!empty($bangsal[0]) ? $bangsal[0]->kd_bangsal : '';

                $bangsal=$this->resepService->setDepoRanap->select("kd_depo")->where('kd_bangsal','=',$bangsal)->first();
                $bangsal=!empty($bangsal->kd_depo) ? $bangsal->kd_depo : '';
                if(empty($bangsal)){
                    $bangsal=collect($this->resepService->setDepoRanap->select("kd_depo")->groupBy('kd_depo')->get())->map(function ($value) {
                        return $value->kd_depo;
                    })->toArray();
                }
            }else{
                $bangsal='';
                $reg_periksa=(new \App\Models\RegPeriksa)->select('kd_poli')->where('no_rawat','like',$no_rawat)->first();
                if(!empty($reg_periksa->kd_poli)){
                    $bangsal=(new \App\Models\SetDepoRalan)->select("kd_bangsal")->where('kd_poli','=',$reg_periksa->kd_poli)->first();
                    $bangsal=!empty($bangsal->kd_bangsal) ? $bangsal->kd_bangsal : '';
                }
                if(empty($bangsal)){
                    $bangsal=$this->resepService->setLokasi->select("kd_bangsal")->first();
                    $bangsal=!empty($bangsal->kd_bangsal) ? $bangsal->kd_bangsal : '';
                }
            }

            $i=0;
            foreach($model->item_resep_racikan as $key => $value){
                $list_resep_racikan[]=[
                    "nm_racikan"=>!empty($value->nama_racik) ? $value->nama_racik : '',
                    "metode_racikan"=>!empty($value->metode) ? $value->metode : '',
                    "kode_racikan"=>!empty($value->kd_racik) ? $value->kd_racik : 0,
                    'jml_racikan'=>!empty($value->jml_dr) ? $value->jml_dr : 0,
                    'aturan_pk'=>!empty($value->aturan_pakai) ? $value->aturan_pakai : '',
                    'keterangan'=>!empty($value->keterangan) ? $value->keterangan : '',
                    'list_obat'=>'',
                ];

                $list_resep_racikan_detail=[];
                if(!empty($model->item_resep_racikan_detail[$key])){
                    $list_obat=$model->item_resep_racikan_detail[$key];
                    foreach($list_obat as $key_obat => $value_obat){
                        $list_barang=$this->racikanService->getListBarang(['gudangbarang.kd_bangsal'=>$bangsal,'databarang.kode_brng'=>$value_obat->kode_brng]);
                        $list_barang=!empty($list_barang[0]) ? (object)$list_barang[0]->getAttributes() : [];
                        $harga=!empty($list_barang->h_beli) ? $list_barang->h_beli : 0;

                        $jml_obat=!empty($value_obat->jml) ? $value_obat->jml : 0;
                        $stok=!empty($list_barang->stok) ? $list_barang->stok : 0;
                        $sisa_stok=$stok-$jml_obat;

                        $list_resep_racikan_detail[]=json_encode([
                            "kode_barang"=>!empty($value_obat->kode_brng) ? $value_obat->kode_brng : '',
                            "nm_barang"=>!empty($value_obat->nama_brng) ? $value_obat->nama_brng : '',
                            "satuan"=>!empty($value_obat->kode_sat) ? $value_obat->kode_sat : '',
                            'harga'=>(new \App\Http\Traits\GlobalFunction)->formatMoney($harga),
                            'harga_real'=>$harga,
                            'jenis_obat'=>!empty($list_barang->nama) ? $list_barang->nama : '',
                            'stok'=>$stok,
                            'kapasitas'=>!empty($list_barang->kapasitas) ? $list_barang->kapasitas : 0,
                            'p1'=>!empty($value_obat->p1) ? $value_obat->p1 : 1,
                            'p2'=>!empty($value_obat->p2) ? $value_obat->p2 : 1,
                            'kandungan'=>!empty($value_obat->kandungan) ? $value_obat->kandungan : 0,
                            'jlh_obat'=>$jml_obat,
                            'sisa_stok'=>$sisa_stok,
                        ]);
                    }

                    if(!empty($list_resep_racikan_detail)){
                        $list_resep_racikan[$i]['list_obat']=$list_resep_racikan_detail;
                    }
                }
                $i++;
            }
        }

        $list_resep_racikan=!(empty($list_resep_racikan)) ? json_encode($list_resep_racikan) : '';

        $data_feedback_item=[
            'data_feedback_item'=>$list_resep_racikan
        ];

        return $data_feedback_item;
    }

    private function pembulatan($nilai){
        $nilai=ceil($nilai);
        return $nilai;
    }

    function actionIndex(Request $request){

        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {

            $check_registrasi=$this->globalService->cariRegistrasi($item_pasien->no_rawat);

            if($check_registrasi>0){
                \Session::flash('error', 'Data billing sudah terverifikasi ..!!');
            }

            $no_rawat = $item_pasien->no_rawat;
            $no_rm = $item_pasien->no_rm;
            if(!empty($request->cresep)){
                $paramater_data=[
                    'no_rawat'=>$item_pasien->no_rawat,
                    'no_rm'=>$item_pasien->no_rm,
                    'type_form'=>$item_pasien->no_fr,
                    'no_resep'=>$request->cresep,
                ];
                $data_feedback_item=$this->getCopyResep($paramater_data);
            }

            $paramater_data=[
                'no_rawat'=>$item_pasien->no_rawat,
                'no_rm'=>$item_pasien->no_rm,
                'type_form'=>$item_pasien->no_fr,
            ];

            $parameter_data_form=$this->data_form($paramater_data);

            $data=(new \App\Http\Traits\ItemPasienFunction)->setItemPasienFilterTgl($request->fr,$request->form_filter_start,$request->form_filter_end);
            if(!empty($data)){
                $request->form_filter_start=$data->filter_start;
                $request->form_filter_end=$data->filter_end;
            }

            $filter_start=!empty($request->form_filter_start) ? $request->form_filter_start : date('Y-m-d');
            $filter_end=!empty($request->form_filter_end) ? $request->form_filter_end : date('Y-m-d');

            $paramater_search=[
                'resep_obat.no_rawat'=>$no_rawat,
                'pasien.no_rkm_medis'=>$no_rm,
                'tgl_peresepan'=>[$filter_start,$filter_end],
            ];
            if($item_pasien->no_fr=='ri'){
                $paramater_search['resep_obat.status']='ranap';
            }else{
                $paramater_search['resep_obat.status']='ralan';
            }
            $data_list=$this->racikanService->getResepList($paramater_search);

            $parameter_view=[
                'action_form'=>'racikan/create',
                'data_list'=>$data_list,
                'data_feedback_item'=>!empty($data_feedback_item['data_feedback_item']) ? $data_feedback_item['data_feedback_item'] : '',
            ];

            $parameter_view=array_merge($parameter_view,$parameter_data_form);

            return view('racikan.index',$parameter_view);
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);

    }

    function actionCreate(Request $request)
    {
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        $data_request = $request->except('_token');

        $link_back='racikan';
        $type_akses=!empty($item_pasien->no_fr) ? $item_pasien->no_fr : '';
        $link_back_param=['no_rm' => $item_pasien->no_rm, 'no_rawat' => $item_pasien->no_rawat,'fr' => $request->fr];
        $message_default=[
            'success'=>'Data berhasil ditambahakan',
            'error'=>'Maaf data tidak berhasil ditambahakan'
        ];

        $data_sent_obat=!empty($data_request['data_form_obat']) ? $data_request['data_form_obat'] : '';

        $data_feedback=$data_sent_obat;

        DB::beginTransaction();
        try {

            $check_registrasi=$this->globalService->cariRegistrasi($item_pasien->no_rawat);
            if($check_registrasi>0){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Data billing sudah terverifikasi ..!!']);
            }

            $model_resep_obat=$data_request;

            unset($model_resep_obat["key_old"]);
            unset($model_resep_obat["fr"]);
            unset($model_resep_obat["no_rm"]);
            unset($model_resep_obat["data_form_obat"]);
            unset($model_resep_obat["list_obat"]);
            unset($model_resep_obat["nama_racikan"]);
            unset($model_resep_obat["nm_racik"]);
            unset($model_resep_obat["kd_racik"]);
            unset($model_resep_obat["jml_dr"]);
            unset($model_resep_obat["aturan_pakai"]);
            unset($model_resep_obat["keterangan"]);

            $no_resep='';
            if($model_resep_obat['tgl_peresepan']){
                $no_resep=$this->racikanService->getNoResep($model_resep_obat['tgl_peresepan']);
            }
            $model_resep_obat['no_resep']=$no_resep;

            $model_resep_obat['tgl_perawatan']='0000-00-00';
            $model_resep_obat['jam']='00:00:00';

            if($type_akses!='ri'){
                $type_status='ralan';
            }else{
                $type_status='ranap';
            }

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
            $model_resep_obat['kd_dokter']=$data_dokter->kd_dokter;

            $model_resep_obat['status']=$type_status;

            $no_resep=$this->racikanService->getNoResep($model_resep_obat['tgl_peresepan']);
            $model_resep_obat['no_resep']=$no_resep;

            $data_save=0;
            $model_save=$this->racikanService->resepObat->insert($model_resep_obat);
            $jml_model_racikan=0;
            $jml_model_racikan_detail=0;
            if($model_save){
                if($data_sent_obat){
                    $data_sent_obat=json_decode($data_sent_obat);
                    if($data_sent_obat){
                        $model_racikan=[];
                        foreach($data_sent_obat as $key => $value){
                            $model_racikan=[
                                'no_resep'=>$no_resep,
                                'no_racik'=>($key+1),
                                'nama_racik'=>$value->nm_racikan,
                                'kd_racik'=>$value->kode_racikan,
                                'jml_dr'=>$value->jml_racikan,
                                'aturan_pakai'=>$value->aturan_pk,
                                'keterangan'=>$value->keterangan,
                            ];
                            $model_aturan_pakai=$this->resepService->checkAturanPakai($model_racikan['aturan_pakai']);
                            $model_save_2=$this->racikanService->resepDokterRacikan->insert($model_racikan);
                            if($model_save_2){
                                $data_save++;
                            }else{
                                $data_save--;
                            }

                            $jml_model_racikan++;

                            if(!empty($value->list_obat)){
                                $model_racikan_detail=[];
                                foreach($value->list_obat as $key_obat => $value_obat){
                                    $value_obat=json_decode($value_obat);
                                    if($value_obat){
                                        $jlh_obat=$this->pembulatan($value_obat->jlh_obat);
                                        $model_racikan_detail=[
                                            'no_resep'=>$no_resep,
                                            'no_racik'=>$model_racikan['no_racik'],
                                            'kode_brng'=>$value_obat->kode_barang,
                                            'p1'=>$value_obat->p1,
                                            'p2'=>$value_obat->p2,
                                            'jml'=>$jlh_obat,
                                            'kandungan'=>$value_obat->kandungan,
                                        ];

                                        $model_save_3=$this->racikanService->resepDokterRacikanDetail->insert($model_racikan_detail);
                                        if($model_save_3){
                                            $data_save++;
                                        }else{
                                            $data_save--;
                                        }
                                    }
                                    $jml_model_racikan_detail++;
                                }
                            }
                        }
                    }
                }
            }

            $is_save=0;
            $total_data=$jml_model_racikan+$jml_model_racikan_detail;
            if( $total_data == $data_save){
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
                $model_tindakan->resep=1;

                if($model_tindakan->save()){
                    $is_save=1;
                }
            }

            if($item_pasien->no_fr=='rj'){
                if($is_save){
                    $hasil=$this->bpjsService->taskId($item_pasien->no_rawat,6);
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
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error'],'data_feedback'=>$data_feedback]);
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf tidak dapat menyimpan data yang sama','data_feedback'=>$data_feedback]);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error'],'data_feedback'=>$data_feedback]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error'],'data_feedback'=>$data_feedback]);
        }
    }

    function formUpdate(Request $request){

        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $no_rm=!empty($exp[2]) ? $exp[2] : 0;
        $no_rawat=!empty($exp[1]) ? $exp[1] : 0;
        $no_resep=!empty($exp[3]) ? $exp[3] : 0;
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';

        $link_back='racikan';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $no_rawat,'fr' => $type_akses];
        $url_back_index=$link_back.'?'.'no_rm='.$no_rm.'&'.'no_rawat='.$no_rawat.'&'.'fr='.$type_akses;

        if ($no_rm && $no_rawat && $no_resep && $type_akses) {

            $check_registrasi=$this->globalService->cariRegistrasi($no_rawat);

            if($check_registrasi>0){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Data billing sudah terverifikasi ..!!']);
            }

            $paramater_search=[
                'resep_obat.no_resep'=>$no_resep
            ];
            if($type_akses=='ri'){
                $paramater_search['resep_obat.status']='ranap';
            }else{
                $paramater_search['resep_obat.status']='ralan';
            }
            $check=$this->racikanService->getResepList($paramater_search);
            if($check[0]->status=='Sudah Terlayani'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Resep sudah tervalidasi ..!!']);
            }

            $paramater_data=[
                'no_rawat'=>$no_rawat,
                'no_rm'=>$no_rm,
                'type_form'=>$type_akses,
            ];

            $parameter_data_form=$this->data_form($paramater_data);

            $model=!empty($parameter_data_form['model']) ? (array)$parameter_data_form['model'] : [];
            $paramater_search=[
                'resep_obat.no_resep'=>$no_resep
            ];
            if($type_akses=='ri'){
                $paramater_search['resep_obat.status']='ranap';
            }else{
                $paramater_search['resep_obat.status']='ralan';
            }
            $get_data=$this->racikanService->getResepListDetail($paramater_search);
            $get_data=!empty($get_data[0]) ? (array)$get_data[0] : [];
            $model=array_merge($model,$get_data);
            $model=(object)$model;
            $parameter_data_form['model']=$model;

            if (!empty(\Session::get('data_feedback'))) {
                $list_resep_racikan=\Session::get('data_feedback');
            }else{
                $list_resep_racikan=[];
                if(!empty($model->item_resep_racikan)){
                    if($type_akses=='ri'){
                        $bangsal=$this->resepService->getKamar(['kamar_inap.no_rawat'=>$no_rawat]);
                        $bangsal=!empty($bangsal[0]) ? $bangsal[0]->kd_bangsal : '';

                        $bangsal=$this->resepService->setDepoRanap->select("kd_depo")->where('kd_bangsal','=',$bangsal)->first();
                        $bangsal=!empty($bangsal->kd_depo) ? $bangsal->kd_depo : '';
                        if(empty($bangsal)){
                            $bangsal=collect($this->resepService->setDepoRanap->select("kd_depo")->groupBy('kd_depo')->get())->map(function ($value) {
                                return $value->kd_depo;
                            })->toArray();
                        }
                    }else{
                        $bangsal='';
                        $reg_periksa=(new \App\Models\RegPeriksa)->select('kd_poli')->where('no_rawat','like',$no_rawat)->first();
                        if(!empty($reg_periksa->kd_poli)){
                            $bangsal=(new \App\Models\SetDepoRalan)->select("kd_bangsal")->where('kd_poli','=',$reg_periksa->kd_poli)->first();
                            $bangsal=!empty($bangsal->kd_bangsal) ? $bangsal->kd_bangsal : '';
                        }
                        if(empty($bangsal)){
                            $bangsal=$this->resepService->setLokasi->select("kd_bangsal")->first();
                            $bangsal=!empty($bangsal->kd_bangsal) ? $bangsal->kd_bangsal : '';
                        }
                    }

                    $i=0;
                    foreach($model->item_resep_racikan as $key => $value){
                        $list_resep_racikan[]=[
                            "nm_racikan"=>!empty($value->nama_racik) ? $value->nama_racik : '',
                            "metode_racikan"=>!empty($value->metode) ? $value->metode : '',
                            "kode_racikan"=>!empty($value->kd_racik) ? $value->kd_racik : 0,
                            'jml_racikan'=>!empty($value->jml_dr) ? $value->jml_dr : 0,
                            'aturan_pk'=>!empty($value->aturan_pakai) ? $value->aturan_pakai : '',
                            'keterangan'=>!empty($value->keterangan) ? $value->keterangan : '',
                            'list_obat'=>'',
                        ];

                        $list_resep_racikan_detail=[];
                        if(!empty($model->item_resep_racikan_detail[$key])){
                            $list_obat=$model->item_resep_racikan_detail[$key];
                            foreach($list_obat as $key_obat => $value_obat){
                                $list_barang=$this->racikanService->getListBarang(['gudangbarang.kd_bangsal'=>$bangsal,'databarang.kode_brng'=>$value_obat->kode_brng]);
                                $list_barang=!empty($list_barang[0]) ? (object)$list_barang[0]->getAttributes() : [];
                                $harga=!empty($list_barang->h_beli) ? $list_barang->h_beli : 0;

                                $jml_obat=!empty($value_obat->jml) ? $value_obat->jml : 0;
                                $stok=!empty($list_barang->stok) ? $list_barang->stok : 0;
                                $sisa_stok=$stok-$jml_obat;

                                $list_resep_racikan_detail[]=json_encode([
                                    "kode_barang"=>!empty($value_obat->kode_brng) ? $value_obat->kode_brng : '',
                                    "nm_barang"=>!empty($value_obat->nama_brng) ? $value_obat->nama_brng : '',
                                    "satuan"=>!empty($value_obat->kode_sat) ? $value_obat->kode_sat : '',
                                    'harga'=>(new \App\Http\Traits\GlobalFunction)->formatMoney($harga),
                                    'harga_real'=>$harga,
                                    'jenis_obat'=>!empty($list_barang->nama) ? $list_barang->nama : '',
                                    'stok'=>$stok,
                                    'kapasitas'=>!empty($list_barang->kapasitas) ? $list_barang->kapasitas : 0,
                                    'p1'=>!empty($value_obat->p1) ? $value_obat->p1 : 1,
                                    'p2'=>!empty($value_obat->p2) ? $value_obat->p2 : 1,
                                    'kandungan'=>!empty($value_obat->kandungan) ? $value_obat->kandungan : 0,
                                    'jlh_obat'=>$jml_obat,
                                    'sisa_stok'=>$sisa_stok,
                                ]);
                            }

                            if(!empty($list_resep_racikan_detail)){
                                $list_resep_racikan[$i]['list_obat']=$list_resep_racikan_detail;
                            }
                        }
                        $i++;
                    }
                }

                $list_resep_racikan=!(empty($list_resep_racikan)) ? json_encode($list_resep_racikan) : '';
            }
            if(empty($list_resep_racikan)){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf tidak dapat mengubah data,data obat kosong']);
            }

            $kode_key_old=[
                'no_resep'=>!empty($no_resep) ? $no_resep : ''
            ];

            $kode_key_old=(new \App\Http\Traits\GlobalFunction)->makeJson($kode_key_old);

            $parameter_view=[
                'action_form'=>'racikan/update',
                'kode_key_old'=>$kode_key_old,
                'url_back_index'=>$url_back_index,
                'type_akses'=>$type_akses,
                'data_list_edit'=>$list_resep_racikan
            ];

            $parameter_view=array_merge($parameter_view,$parameter_data_form);

            return view('racikan.index',$parameter_view);
        }

        return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf No.rawat/No.Rekap Medis anda kosong']);
    }

    function actionUpdate(Request $request)
    {
        DB::beginTransaction();
        $data_request = $request->except('_token');

        $link_back='racikan';
        $type_akses=!empty($data_request["fr"]) ? $data_request["fr"] : '';
        $link_back_param=['no_rm' => $request->no_rm, 'no_rawat' => $request->no_rawat,'fr' => $request->fr];

        $key_old=$data_request["key_old"];
        $key_old=json_decode($key_old);

        $link_back_error='racikan_form_update';
        $kode_link_back_error=$request->fr.'@'.$request->no_rawat.'@' . $request->no_rm . '@' . $key_old->no_resep;
        $link_back_param_error=['data_sent' => $kode_link_back_error];

        $message_default=[
            'success'=>'Data berhasil diubah',
            'error'=>'Maaf data tidak berhasil diubah'
        ];

        $data_sent_obat=!empty($data_request['data_form_obat']) ? $data_request['data_form_obat'] : '';

        $data_feedback=$data_sent_obat;

        try {
            $check_registrasi=$this->globalService->cariRegistrasi($request->no_rawat);
            if($check_registrasi>0){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Data billing sudah terverifikasi ..!!']);
            }

            $model_resep_obat=$data_request;
            $key_old=$model_resep_obat["key_old"];
            $key_old=json_decode($key_old);

            unset($model_resep_obat["key_old"]);
            unset($model_resep_obat["fr"]);
            unset($model_resep_obat["no_rm"]);
            unset($model_resep_obat["data_form_obat"]);
            unset($model_resep_obat["list_obat"]);
            unset($model_resep_obat["nama_racikan"]);
            unset($model_resep_obat["nm_racik"]);
            unset($model_resep_obat["kd_racik"]);
            unset($model_resep_obat["jml_dr"]);
            unset($model_resep_obat["aturan_pakai"]);
            unset($model_resep_obat["keterangan"]);

            $paramater_search=[
                'resep_obat.no_resep'=>$key_old->no_resep
            ];
            if($type_akses=='ri'){
                $paramater_search['resep_obat.status']='ranap';
            }else{
                $paramater_search['resep_obat.status']='ralan';
            }
            $model_resep_obat_old=$this->racikanService->getResepList($paramater_search);
            $model_resep_obat_old=!empty($model_resep_obat_old[0]) ? $model_resep_obat_old[0] : (object)[];

            if($model_resep_obat_old->status=='Sudah Terlayani'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Resep sudah tervalidasi ..!!']);
            }

            $get_data_obat=$no_resep=$this->resepService->resepObat->where('no_resep',$key_old->no_resep)->first();
            if(empty($get_data_obat)){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Data Obat ini tidak ditemukan']);
            }
            $model_resep_obat['status']=$get_data_obat->status;

            $model_resep_obat['no_rawat']=$get_data_obat->no_rawat;

            $form_no_rawat=$model_resep_obat['no_rawat'];
            $data_dokter =null;
            if($type_akses!='ri'){
                $paramater = [
                    'reg_periksa.no_rawat' => $form_no_rawat
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
                        'dpjp_ranap.no_rawat' => $form_no_rawat,
                        'dpjp_ranap.kd_dokter' =>  !empty($request->kd_dokter) ? $request->kd_dokter : 0,
                    ];
                    $data_dokter = $this->rekamMedisService->getDokterByDpjpRanap($paramater,2);
                    if(!$data_dokter){
                        return redirect()->route($link_back, $link_back_param)->with(['error' => 'Dokter PJ Tidak terdaftar pada no rawat '.$form_no_rawat.'..!!']);
                    }
                }
            }
            $model_resep_obat['kd_dokter']=$data_dokter->kd_dokter;

            $no_resep_old=$model_resep_obat_old->no_resep;
            $no_resep_new=$model_resep_obat['no_resep'];

            if($no_resep_old!=$no_resep_new){
                $no_resep='';
                if($model_resep_obat['tgl_peresepan']){
                    $no_resep=$this->racikanService->getNoResep($model_resep_obat['tgl_peresepan']);
                }
                $model_resep_obat['no_resep']=$no_resep;
            }

            $paramater_where=[
                'no_resep'=>$key_old->no_resep
            ];
            $model_save=$this->racikanService->update($paramater_where,$model_resep_obat);

            $data_save=0;
            $jml_model_racikan=0;
            $jml_model_racikan_detail=0;
            if($model_save){
                if($data_sent_obat){
                    $data_sent_obat=json_decode($data_sent_obat);
                    if($data_sent_obat){
                        $paramater_where=[
                            'no_resep'=>$model_resep_obat['no_resep']
                        ];

                        $check_count=$this->racikanService->resepDokterRacikan->where('no_resep',$model_resep_obat['no_resep'])->count();
                        if($check_count>0){
                            $model_resep_racikan_delete=$this->racikanService->resep_dokter_racikan($paramater_where);
                        }

                        $check_count=$this->racikanService->resepDokterRacikanDetail->where('no_resep',$model_resep_obat['no_resep'])->count();
                        if($check_count>0){
                            $model_resep_racikan_detail_delete=$this->racikanService->resep_dokter_racikan_detail($paramater_where);
                        }

                        $model_racikan=[];

                        foreach($data_sent_obat as $key => $value){
                            $model_racikan=[
                                'no_resep'=>$model_resep_obat['no_resep'],
                                'no_racik'=>($key+1),
                                'nama_racik'=>$value->nm_racikan,
                                'kd_racik'=>$value->kode_racikan,
                                'jml_dr'=>$value->jml_racikan,
                                'aturan_pakai'=>$value->aturan_pk,
                                'keterangan'=>$value->keterangan,
                            ];
                            $model_aturan_pakai=$this->resepService->checkAturanPakai($model_racikan['aturan_pakai']);
                            $model_save_2=$this->racikanService->resepDokterRacikan->insert($model_racikan);
                            if($model_save_2){
                                $data_save++;
                            }else{
                                $data_save--;
                            }

                            $jml_model_racikan++;

                            if(!empty($value->list_obat)){
                                $model_racikan_detail=[];

                                foreach($value->list_obat as $key_obat => $value_obat){
                                    $value_obat=json_decode($value_obat);
                                    if($value_obat){
                                        $jlh_obat=$this->pembulatan($value_obat->jlh_obat);
                                        $model_racikan_detail=[
                                            'no_resep'=>$model_resep_obat['no_resep'],
                                            'no_racik'=>$model_racikan['no_racik'],
                                            'kode_brng'=>$value_obat->kode_barang,
                                            'p1'=>$value_obat->p1,
                                            'p2'=>$value_obat->p2,
                                            'jml'=>$jlh_obat,
                                            'kandungan'=>$value_obat->kandungan,
                                        ];

                                        $model_save_3=$this->racikanService->resepDokterRacikanDetail->insert($model_racikan_detail);
                                        if($model_save_3){
                                            $data_save++;
                                        }else{
                                            $data_save--;
                                        }
                                    }
                                    $jml_model_racikan_detail++;
                                }
                            }
                        }
                    }
                }
            }

            $is_save=0;
            $total_data=$jml_model_racikan+$jml_model_racikan_detail;
            if( $total_data == $data_save){
                $is_save=1;
            }

            if($is_save){
                DB::commit();
                return redirect()->route($link_back_error, $link_back_param_error)->with(['success' => $message_default['success']]);
            }else{
                DB::rollBack();
                return redirect()->route($link_back_error, $link_back_param_error)->with(['error' => $message_default['error'],'data_feedback'=>$data_feedback]);
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back_error, $link_back_param_error)->with(['error' => 'Maaf tidak dapat menyimpan data yang sama']);
            }
            return redirect()->route($link_back_error, $link_back_param_error)->with(['error' => $message_default['error'],'data_feedback'=>$data_feedback]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back_error, $link_back_param_error)->with(['error' => $message_default['error'],'data_feedback'=>$data_feedback]);
        }
    }

    function actionDelete(Request $request)
    {
        DB::beginTransaction();
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : 0;
        $no_rm=!empty($exp[2]) ? $exp[2] : 0;
        $no_resep=!empty($exp[3]) ? $exp[3] : 0;

        $link_back='racikan';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $no_rawat,'fr'=>$type_akses];

        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];

        try {
            $check_registrasi=$this->globalService->cariRegistrasi($no_rawat);

            if($check_registrasi>0){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Data billing sudah terverifikasi ..!!']);
            }

            if(!empty($no_resep)){
                $paramater_search=[
                    'resep_obat.no_resep'=>$no_resep
                ];
                if($type_akses=='ri'){
                    $paramater_search['resep_obat.status']='ranap';
                }else{
                    $paramater_search['resep_obat.status']='ralan';
                }
                $check=$this->racikanService->getResepList($paramater_search);
                if($check[0]->status=='Sudah Terlayani'){
                    return redirect()->route($link_back, $link_back_param)->with(['error' => 'Resep sudah tervalidasi ..!!']);
                }

                $delete_model=$this->racikanService->delete(['no_resep'=>$no_resep]);
                if ($delete_model) {
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
        $no_rawat=!empty($exp[1]) ? $exp[1] : 0;
        $no_rm=!empty($exp[2]) ? $exp[2] : 0;
        $no_resep=!empty($exp[3]) ? $exp[3] : 0;

        $paramater_search=[
            'resep_obat.no_resep'=>$no_resep
        ];
        if($type_akses=='ri'){
            $paramater_search['resep_obat.status']='ranap';
        }else{
            $paramater_search['resep_obat.status']='ralan';
        }
        $model=$this->racikanService->getResepListDetail($paramater_search);
        $model=!empty($model[0]) ? $model[0] : (object)[];

        $parameter_view=[
            'model'=>$model,
            'type_akses'=>$type_akses,
        ];

        if($request->ajax()){
            $returnHTML = view('racikan.view',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }else{
            return view('racikan.view',$parameter_view);
        }
    }


    function ajax(Request $request){

        $get_req = $request->all();

        if(!empty($get_req['action'])){
            if($get_req['action']=='metode_racik'){
                $list_data = $this->racikanService->metodeRacik->orderBy('nm_racik', 'ASC')->get();
                if($request->ajax()){
                    $returnHTML = view('racikan.columns_metode_racik',['list_data'=>$list_data])->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
                // return view('racikan.columns_metode_racik',['list_data'=>$list_data]);
            }

            if($get_req['action']=='get_nm_racik'){
                if($request->search){
                    return $this->racikanService->resepDokterRacikan->select('nama_racik')->where('nama_racik', 'LIKE', '%' . $request->search . '%')->groupBy('nama_racik')->orderBy('nama_racik', 'ASC')->get();
                }
            }

            if($get_req['action']=='list_obat'){
                $exp=explode('@',$get_req['data_sent']);
                $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
                $no_rawat=!empty($exp[1]) ? $exp[1] : '';
                $data_racikan=!empty($exp[2]) ? $exp[2] : '';

                if($type_akses=='ri'){
                    $bangsal=$this->resepService->getKamar(['kamar_inap.no_rawat'=>$no_rawat]);
                    $bangsal=!empty($bangsal[0]) ? $bangsal[0]->kd_bangsal : '';

                    $bangsal=$this->resepService->setDepoRanap->select("kd_depo")->where('kd_bangsal','=',$bangsal)->first();
                    $bangsal=!empty($bangsal->kd_depo) ? $bangsal->kd_depo : '';
                    if(empty($bangsal)){
                        $bangsal=collect($this->resepService->setDepoRanap->select("kd_depo")->groupBy('kd_depo')->get())->map(function ($value) {
                            return $value->kd_depo;
                        })->toArray();
                    }
                }else{
                    $bangsal='';
                    $reg_periksa=(new \App\Models\RegPeriksa)->select('kd_poli')->where('no_rawat','like',$no_rawat)->first();
                    if(!empty($reg_periksa->kd_poli)){
                        $bangsal=(new \App\Models\SetDepoRalan)->select("kd_bangsal")->where('kd_poli','=',$reg_periksa->kd_poli)->first();
                        $bangsal=!empty($bangsal->kd_bangsal) ? $bangsal->kd_bangsal : '';
                    }
                    if(empty($bangsal)){
                        $bangsal=$this->resepService->setLokasi->select("kd_bangsal")->first();
                        $bangsal=!empty($bangsal->kd_bangsal) ? $bangsal->kd_bangsal : '';
                    }
                }

                $list_barang=$this->racikanService->getListBarang(['gudangbarang.kd_bangsal'=>$bangsal]);

                $parameter_view=[
                    'list_barang'=>$list_barang,
                    'data_racikan'=>$data_racikan
                ];

                if($request->ajax()){
                    $returnHTML = view('racikan.columns_list_obat',$parameter_view)->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
                return view('racikan.columns_list_obat',$parameter_view);
            }
        }
        return response()->json(array('error' => true, 'html'=>''));
    }
}