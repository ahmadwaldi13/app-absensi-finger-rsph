<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\UserMesinTmpService;
use App\Services\RefDataAbsensiTmpService;

class TarikDataAbsensiKaryawanController extends \App\Http\Controllers\MyAuthController
{

    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;
    public $userMesinTmpService,$refDataAbsensiTmpService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Tarik Log Data Absensi';
        $this->breadcrumbs = [
            ['title' => 'Mesin Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->userMesinTmpService = new UserMesinTmpService;
        $this->refDataAbsensiTmpService = new RefDataAbsensiTmpService;
    }

    function actionIndex(Request $request){

        $tanggal_filter_start=!empty($request->tanggal_filter_start) ? $request->tanggal_filter_start : date('Y-m-d');
        $tanggal_filter_end=!empty($request->tanggal_filter_end) ? $request->tanggal_filter_end : date('Y-m-d');

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'tanggal_filter_start'=>$tanggal_filter_start,
            'tanggal_filter_end'=>$tanggal_filter_end
        ];

        return view($this->part_view . '.index', $parameter_view);
    }

    private function hitung_waktu($awal,$akhir){
        $diff  = $akhir - $awal;

        $jam   = floor($diff / (60 * 60));
        $menit = $diff - ( $jam * (60 * 60) );
        $detik = $diff % 60;

        return (object)[
            'jam'=>$jam,
            'menit'=>floor( $menit / 60 ),
            'detik'=>$detik,
        ];
    }

    private function status_absensi($tanggal,$absensi_tmp,$jadwal_masuk_tmp,$jadwal_tutup_tmp){
        $waktu_mulai=$tanggal.' '.$jadwal_masuk_tmp;
        $waktu_tutup=$tanggal.' '.$jadwal_tutup_tmp;
        $waktu_absensi=$tanggal.' '.$absensi_tmp;

        $jadwal_masuk = strtotime($waktu_mulai);
        $jadwal_tutup = strtotime($waktu_tutup);
        $absensi = strtotime($waktu_absensi);

        $return=[];
        if(($jadwal_masuk <= $absensi) and ($jadwal_tutup >= $absensi)){
            $hasil=(array)$this->hitung_waktu($absensi,$jadwal_tutup);
            $return=[
                'hasil_status_absensi'=>1,
                'hasil_status_absensi_text'=>'Tidak Telat',
            ];
            $return=array_merge($return,$hasil);
        }elseif($absensi > $jadwal_tutup ){
            $hasil=(array)$this->hitung_waktu($jadwal_tutup,$absensi);
            $return=[
                'hasil_status_absensi'=>2,
                'hasil_status_absensi_text'=>'Telat',
            ];
            $return=array_merge($return,$hasil);
        }else{
            $return=[
                'hasil_status_absensi'=>0,
                'hasil_status_absensi_text'=>'Di luar Jadwal',
            ];
        }

        return (object)$return;
    }

    function proses($params=[]){
        $jenis_jadwal=[1,2,3];
        $data_jadwal=[];
        foreach($jenis_jadwal as $value){
            $get_jadwal=(new \App\Models\RefJadwal())->where('id_jenis_jadwal','=',$value)->get();
            foreach($get_jadwal as $key_jadwal =>$value_jadwal){
                $key_jadwal++;
                $get_jenis_jadwal=(new \App\Models\RefJenisJadwal())->where('id_jenis_jadwal','=',$value)->first();
                $value_jadwal=(array)$value_jadwal->getAttributes();
                if(!empty($get_jenis_jadwal)){
                    $value_jadwal['nm_jenis_jadwal']=$get_jenis_jadwal->nm_jenis_jadwal;
                }else{
                    $value_jadwal['nm_jenis_jadwal']='tidak diketahui';
                }
                $data_jadwal[$value][$key_jadwal]=(object)$value_jadwal;
            }
        }

        $parameter=[
            'tanggal'=>$params['tanggal_cari'],
            'limit'=>$params['limit_query'],
            'id_mesin_absensi'=>$params['id_mesin_absensi'],
        ];

        $list_data=$this->refDataAbsensiTmpService->getList($parameter)->get();
        $select_user=[];
        $select_user_jam=[];
        $hasil_ditemukan=[];
        foreach($list_data as $data_user){
            if(empty($select_user[$data_user->id_user])){
                $select_user[$data_user->id_user]=1;
            }else{
                $select_user[$data_user->id_user]++;
            }
            $data_absensi_ke=$select_user[$data_user->id_user];

            if(!empty($data_jadwal[$data_user->id_jenis_jadwal][$data_absensi_ke])){
                $get_jadwal=$data_jadwal[$data_user->id_jenis_jadwal][$data_absensi_ke];
                $get_waktu_ab=!empty($data_user->waktu_absensi) ? $data_user->waktu_absensi : '';
                if(!empty($get_waktu_ab)){
                    $waktu_tmp=new \DateTime($get_waktu_ab);
                    $tanggal_absensi = $waktu_tmp->format('Y-m-d');
                    $jam_absensi = $waktu_tmp->format('H:i:s');

                    $waktu_mulai=$get_jadwal->jam_awal;
                    $waktu_tutup=$get_jadwal->jam_akhir;

                    $hasil=$this->status_absensi($tanggal_absensi,$jam_absensi,$waktu_mulai,$waktu_tutup);
                    $kode=$get_jadwal->id_jenis_jadwal.'@'.$get_jadwal->id_jadwal;

                    if(!empty($hasil->hasil_status_absensi)){
                        if(empty($select_user_jam[$data_user->id_user][$kode][$hasil->hasil_status_absensi])){
                            $select_user_jam[$data_user->id_user][$kode][$hasil->hasil_status_absensi]=$jam_absensi;
                        }
                    }else{
                        $select_user[$data_user->id_user]--;
                    }

                    if(!empty($select_user_jam[$data_user->id_user][$kode][$hasil->hasil_status_absensi])){
                        $hasil=(array)$hasil;
                        $set_data_jadwal=[];
                        $set_data_jadwal=[
                            'id_jadwal'=>$get_jadwal->id_jadwal,
                            'nm_jadwal'=>$get_jadwal->uraian,
                            'waktu_buka'=>$get_jadwal->jam_awal,
                            'waktu_tutup'=>$get_jadwal->jam_akhir,
                            'nm_jenis_jadwal'=>$get_jadwal->nm_jenis_jadwal
                        ];
                        $hasil=array_merge($hasil,$set_data_jadwal);
                        $user_tmp_data=(array)$data_user;
                        $user_tmp_data=array_merge($user_tmp_data,$hasil);
                        $hasil_ditemukan[]=(object)$user_tmp_data;
                    }
                }
            }
        }
        
        return $hasil_ditemukan;
    }

    private function get_data_mesin(){
        $list_data_tmp=(new \App\Models\RefMesinAbsensi)->orderByRaw("CONVERT ( REPLACE ( ip_address, '.', '' ), UNSIGNED INTEGER )",'ASC')->get();

        $list_data=[];
        foreach($list_data_tmp as $value){
            $data_sent=$value->getAttributes();

            $model_mesin_tujuan=(new \App\Services\MesinFinger($value->ip_address));
            $connect_tujuan=$model_mesin_tujuan->connect();
            $connect_tujuan=!empty($connect_tujuan[2]) ? $connect_tujuan[2] : '';
            if($connect_tujuan==2){
                $data_sent['status_text']='Tidak Connect';
                $data_sent['status']=0;
            }
            $data_sent['status_text']='Connect';
            $data_sent['status']=1;
            $data_sent=(object)$data_sent;
            $list_data[]=$data_sent;
        }

        return $list_data;
    }

    private function sent_error($message=''){
        $return=[
            'success' => false,
            'message'=>$message,
            'hasil'=>504,
        ];
        return response()->json($return);
    }

    private function proses_regenerate_return($param){
        $param=(object)$param;
        $hasil=200;

        $exs_query=$param->exs_query;
        $calcu=$param->calcu;
        $urut_proses=$param->urut_proses;
        $query_status=$param->query_status;
        $jml_hasil_query=$param->jml_hasil_query;
        $start_query=$param->start_query;
        $end_query=$param->end_query;

        if($query_status=='success'){
            $start_query=$end_query;
            $end_query=$end_query+$exs_query;
        }else{
            $hasil=504;
        }

        $progres_bar=$calcu*$urut_proses;
        if($start_query>$jml_hasil_query){
            $urut_proses=$urut_proses+1;
            $start_query=0;
            $end_query=0;
        }

        return (object)[
            'hasil'=>$hasil,
            'progres_bar'=>$progres_bar,
            'start_query'=>$start_query,
            'end_query'=>$end_query,
            'urut_proses'=>$urut_proses,
        ];
    }

    private function tarik_data_mesin($params){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        $proses_selesai=0;
        $hasil=504;
        $end_proses=2;
        $end_proses=$end_proses+1;
        $calcu=floor(100/$end_proses);
        $progres_bar=0;
        $exs_query=100;

        try {
            $urut_proses=!empty($params['urut_proses']) ? $params['urut_proses'] : 0;
            $id_mesin=!empty($params['key']) ? $params['key'] : 0;
            $tanggal_start=!empty($params['tanggal_start']) ? $params['tanggal_start'] : date('Y-m-d');
            $tanggal_end=!empty($params['tanggal_end']) ? $params['tanggal_end'] : date('Y-m-d');
            $start_query=!empty($params['start_query']) ? $params['start_query'] : 0;
            $end_query=!empty($params['end_query']) ? $params['end_query'] : $exs_query;

            if($urut_proses==1){
                $data_mesin=(new \App\Models\RefMesinAbsensi)->where(['id_mesin_absensi'=>$id_mesin])->first();
                if(empty($data_mesin)){
                    return $this->sent_error('proses'.$urut_proses.' 1');
                    die;
                }

                $mesin=(new \App\Services\MesinFinger($data_mesin->ip_address));
                $get_data_log=$mesin->get_log_data_absensi();
                $check_hasil=!empty($get_data_log[0]) ? $get_data_log[0] : '';
                $proses_gagal=0;
                if($check_hasil=='error'){
                    $proses_gagal++;
                    $message=$get_data_log[1];
                }else{
                    if($get_data_log){
                        $get_data_log=json_decode($get_data_log);
                        if(!empty($get_data_log)){

                            DB::beginTransaction();

                            (new \App\Models\RefDataAbsensiTmp)->whereRaw('date(waktu) BETWEEN "'.$tanggal_start.'" and "'.$tanggal_end.'"')->where('id_mesin_absensi','=',$id_mesin)->delete();
                            
                            try{
                                $jml_waktu_dicari=0;
                                $jml_save=0;
                                foreach($get_data_log as $value){
                                    $waktu_data=$value->date_time;
                                    $waktu_data = new \DateTime($waktu_data);
                                    $tgl_waktu_data=$waktu_data->format('Y-m-d');
                                    $jam_waktu_data=$waktu_data->format('H:i:s');

                                    $paymentDate=date('Y-m-d', strtotime($tgl_waktu_data));
                                    $contractDateBegin = date('Y-m-d', strtotime($tanggal_start));
                                    $contractDateEnd = date('Y-m-d', strtotime($tanggal_end));
                                       
                                    $tgl_antara=0;
                                    if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)){
                                        $tgl_antara=1;
                                    }

                                    if(!empty($tgl_antara)){
                                        $model_tmp = (new \App\Models\RefDataAbsensiTmp);
                                        $model_tmp->id_mesin_absensi = $id_mesin;
                                        $model_tmp->id_user = $value->id;
                                        $model_tmp->waktu = $value->date_time;
                                        $model_tmp->verified = $value->verified;
                                        $model_tmp->status = $value->status;

                                        if ($model_tmp->save()) {
                                            $jml_save++;
                                        }
                                    }else{
                                        $jml_waktu_dicari++;
                                    }
                                }

                                if($jml_save>0){
                                    $is_save = 1;
                                }

                                if (!empty($is_save)) {
                                    DB::commit();
                                    $proses_gagal=0;
                                } else {
                                    DB::rollBack();
                                    if($jml_waktu_dicari>0){
                                        $proses_gagal++;
                                        $message='Data Tidak Ada';
                                    }else{
                                        return $this->sent_error('proses'.$urut_proses.' 2');
                                        die;
                                    }
                                }
                            } catch (\Illuminate\Database\QueryException $e) {
                                DB::rollBack();
                                if ($e->errorInfo[1] == '1062') {
                                }
                                return $this->sent_error('proses'.$urut_proses.' 3');
                                die;
                            } catch (\Throwable $e) {
                                DB::rollBack();
                                $return=[
                                    'success' => false,
                                    'message'=>'',
                                    'hasil'=>504,
                                ];
                                return $this->sent_error('proses'.$urut_proses.' 4');
                                die;
                            }
                        }else{
                            $proses_gagal++;
                        }
                    }else{
                        $proses_gagal++;
                    }
                }
                if($proses_gagal){
                    $status_mesin=1;
                    $urut_proses=$end_proses;
                }else{
                    $status_mesin=0;
                    $message='';
                    $progres_bar=$calcu*$urut_proses;
                    $urut_proses_succ=$urut_proses+1;
                    $urut_proses_tmp=$urut_proses_succ;
                    $urut_proses=$urut_proses_tmp;
                }

                $hasil=200;
                $start_query=0;
                $end_query=$exs_query;
            }

            if($urut_proses==2){
                try{
                    $parameter=[
                        'tanggal'=>['start'=>$tanggal_start,'end'=>$tanggal_end],
                        'id_mesin_absensi'=>$id_mesin
                    ];

                    $list_data=$this->refDataAbsensiTmpService->getListCount($parameter)->first();
                    $jml_hasil_query=!empty($list_data->jml) ? $list_data->jml : 0;
                } catch (\Illuminate\Database\QueryException $e) {
                    $jml_hasil_query='error';
                } catch (\Throwable $e) {
                    $jml_hasil_query='error';
                }

                if($jml_hasil_query==='error'){
                    $return=[
                        'success' => false,
                        'message'=>'',
                        'hasil'=>504,
                    ];
                    return $this->sent_error('proses'.$urut_proses.' 1');
                }

                $proses_gagal=0;
                if(!empty($jml_hasil_query)){
                    DB::beginTransaction();
                    try{
                        $params=[
                            'tanggal_cari'=>['start'=>$tanggal_start,'end'=>$tanggal_end],
                            'limit_query'=>['start'=>$start_query,'end'=>$end_query],
                            'id_mesin_absensi'=>$id_mesin
                        ];
                        $hasil_proses=$this->proses($params);
                        if($hasil_proses){
                            $jml_save=0;
                            foreach($hasil_proses as $item){
                                $data_save=(array)$item;
                                $model=(new \App\Models\DataAbsensiKaryawan())->where([
                                    'id_user'=>$item->id_user,
                                    'id_mesin_absensi'=>$item->id_mesin_absensi,
                                    'waktu_absensi'=>$item->waktu_absensi
                                ])->first();
                                if(!empty($model)){
                                    unset($data_save['id_user']);
                                    unset($data_save['id_mesin_absensi']);
                                }else{
                                    $model=(new \App\Models\DataAbsensiKaryawan());
                                }
                                
                                if(!empty($data_save['waktu_absensi'])){
                                    $waktu_absensi=$data_save['waktu_absensi'];
                                    $waktu_tmp=new \DateTime($waktu_absensi);
                                    $tanggal_absensi = $waktu_tmp->format('Y-m-d');
                                    $jam_absensi = $waktu_tmp->format('H:i:s');

                                    $data_save['tgl_absensi']=$tanggal_absensi;
                                    $data_save['jam_absensi']=$jam_absensi;
                                }
                                $model->set_model_with_data($data_save);

                                if ($model->save()) {
                                    $jml_save++;
                                }
                            }

                            if($jml_save>0){
                                $is_save = 1;
                            }

                            if (!empty($is_save)) {
                                DB::commit();
                                $paramater=[
                                    'query_status'=>'success',
                                    'exs_query'=> $exs_query,
                                    'calcu'=>$calcu,
                                    'urut_proses'=>$urut_proses,
                                    'jml_hasil_query'=>$jml_hasil_query,
                                    'start_query'=>$start_query,
                                    'end_query'=>$end_query,
                                ];

                                $return_hasil=$this->proses_regenerate_return($paramater);

                                $urut_proses_tmp=$return_hasil->urut_proses;
                                $hasil=$return_hasil->hasil;
                                $progres_bar=$return_hasil->progres_bar;
                                $start_query=$return_hasil->start_query;
                                $end_query=$return_hasil->end_query;
                                $urut_proses=$urut_proses_tmp;

                            }else{
                                DB::rollBack();
                                return $this->sent_error('proses'.$urut_proses.' tidak simpan');
                                die;
                            }
                        }else{
                            $paramater=[
                                'query_status'=>'success',
                                'exs_query'=> $exs_query,
                                'calcu'=>$calcu,
                                'urut_proses'=>$urut_proses,
                                'jml_hasil_query'=>$jml_hasil_query,
                                'start_query'=>$start_query,
                                'end_query'=>$end_query,
                            ];

                            $return_hasil=$this->proses_regenerate_return($paramater);

                            $urut_proses_tmp=$return_hasil->urut_proses;
                            $hasil=$return_hasil->hasil;
                            $progres_bar=$return_hasil->progres_bar;
                            $start_query=$return_hasil->start_query;
                            $end_query=$return_hasil->end_query;
                            $urut_proses=$urut_proses_tmp;
                        }

                    } catch (\Illuminate\Database\QueryException $e) {
                        DB::rollBack();
                        if ($e->errorInfo[1] == '1062') {
                        }
                        return $this->sent_error('proses'.$urut_proses.' 3');
                        die;
                    } catch (\Throwable $e) {
                        DB::rollBack();
                        $return=[
                            'success' => false,
                            'message'=>'',
                            'hasil'=>504,
                        ];
                        return $this->sent_error('proses'.$urut_proses.' 4');
                        die;
                    }
                }else{
                    dd('2');
                }
            }

            if($urut_proses==$end_proses){
                $progres_bar=100;
                $urut_proses=$end_proses;
                $hasil=200;
                $proses_selesai=1;
            }

        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sent_error('proses'.$urut_proses.' 5');
            die;
        } catch (\Throwable $e) {
            return $this->sent_error('proses'.$urut_proses.' 6');
            die;
        }
        
        return [
            'hasil'=>$hasil,
            'proses_selesai'=>$proses_selesai,
            'no_proses'=>$urut_proses,
            'progres_bar'=>$progres_bar,
            'start_query'=>$start_query,
            'end_query'=>$end_query,
            'message'=>!empty($message) ? $message : '',
            'status_mesin'=>!empty($status_mesin) ? $status_mesin : '',
            'id_mesin'=>$id_mesin
        ];
    }

    function ajax(Request $request){

        $get_req = $request->all();

        if(!empty($get_req['action'])){
            if($get_req['action']=='get_data_mesin'){
                $list_data=$this->get_data_mesin();

                $parameter=[
                    'list_data'=>$list_data
                ];

                if($request->ajax()){
                    $returnHTML = view($this->part_view . '.get_data_mesin', $parameter)->render();
                    return response()->json(array('success' => true, 'html'=>$returnHTML));
                }
            }
        }

        if(!empty($get_req['action'])){
            if($get_req['action']=='get_data_log'){
                $hasil=$this->tarik_data_mesin($get_req);
                if($request->ajax()){
                    return response()->json($hasil);
                }
            }
        }

        return response()->json(array('error' => true, 'html'=>''));
    }
}