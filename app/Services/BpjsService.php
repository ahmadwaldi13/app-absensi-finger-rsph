<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\RegPeriksa;
use App\Models\MutasiBerkas;
use App\Models\ReferensiMobilejknBpjsTaskid;
use App\Models\PemeriksaanRalan;
use App\Models\ResepObat;
use App\Models\UxuiTaskidErrors;
use App\Services\GenerateBpjsService;

class BpjsService extends BaseService
{
    public function __construct()
    {
        parent::__construct(); 
        $this->regPeriksa = new RegPeriksa;
        $this->mutasiBerkas = new MutasiBerkas;
        $this->referensiMobilejknBpjsTaskid = new ReferensiMobilejknBpjsTaskid;
        $this->pemeriksaanRalan = new PemeriksaanRalan;
        $this->resepObat = new ResepObat;
        $this->uxuiTaskidErrors = new UxuiTaskidErrors;

        $this->urlEndpoint = getenv('API_BPJS_ANTROL');
        $this->urlEndpoint_service = getenv('SERVISCE_ANTROL');
        $this->consId = getenv('CONS_ID');
        $this->secretKey = getenv('SECRET_KEY');
        $this->userKey = getenv('USER_KEY_ANTROL');
    }

    function insertMutasiBerkas($fields)
    {
        foreach ($fields as $key => $field) {
            $field == null ? $fields[$key] = "" : "";
        }
        return $this->mutasiBerkas->insert($fields);
    }

    function updateMutasiBerkas($params,$set,$type='')
    {
        $query=$this->mutasiBerkas;
        foreach($params as $key => $value){
            if($type=='raw'){
                $query=$query->whereRaw($key.' = ? ', [$value]);
            }else{
                $query=$query->where($key,'=',$value);
            }
        }
        
        return $query->update($set);
    }

    function updateRegPeriksa($params,$set,$type='')
    {
        $query=$this->regPeriksa;
        foreach($params as $key => $value){
            if($type=='raw'){
                $query=$query->whereRaw($key.' = ? ', [$value]);
            }else{
                $query=$query->where($key,'=',$value);
            }
        }
        
        return $query->update($set);
    }

    function insertReferensiMobilejknBpjsTaskid($fields)
    {
        foreach ($fields as $key => $field) {
            $field == null ? $fields[$key] = "" : "";
        }
        return $this->referensiMobilejknBpjsTaskid->insert($fields);
    }

    function updateReferensiMobilejknBpjsTaskid($params,$set,$type='')
    {
        $query=$this->referensiMobilejknBpjsTaskid;
        foreach($params as $key => $value){
            if($type=='raw'){
                $query=$query->whereRaw($key.' = ? ', [$value]);
            }else{
                $query=$query->where($key,'=',$value);
            }
        }
        
        return $query->update($set);
    }


    function insertUxuiTaskidErrors($fields)
    {
        foreach ($fields as $key => $field) {
            $field == null ? $fields[$key] = "" : "";
        }
        return $this->uxuiTaskidErrors->insert($fields);
    }

    function updateUxuiTaskidErrors($params,$set,$type='')
    {
        $query=$this->uxuiTaskidErrors;
        foreach($params as $key => $value){
            if($type=='raw'){
                $query=$query->whereRaw($key.' = ? ', [$value]);
            }else{
                $query=$query->where($key,'=',$value);
            }
        }
        
        return $query->update($set);
    }


    function checkDataTaskid($no_rawat,$task_id)
    {
        $query=$this->referensiMobilejknBpjsTaskid
        ->join(DB::raw('reg_periksa rp'),'rp.no_rawat','=',$this->referensiMobilejknBpjsTaskid->getTable().'.no_rawat')
        ;
        $query->where($this->referensiMobilejknBpjsTaskid->getTable().'.no_rawat','=',$no_rawat);
        $query->where('taskid','=',$task_id);

        return $query->count('taskid');
    }

    function simpan_respon($hasil_respon,$no_rawat,$task_id,$waktu){
        /*
            Code pesan dari 20
        */
        try {
            $pesan = DB::transaction(function () use ($hasil_respon,$no_rawat,$task_id,$waktu) {
                $code_respon=$hasil_respon['code'];
                if($code_respon=='200'){
                    $check=$this->checkDataTaskid($no_rawat,$task_id);
                    $data=[
                        'no_rawat' => $no_rawat,
                        'taskid' => $task_id,
                        'waktu' => $waktu,
                    ];

                    if(empty($check)){  
                        $action=$this->insertReferensiMobilejknBpjsTaskid($data);
                        if($action){
                            $is_save=1;
                        }
                    }else{
                        $data_where=[
                            'taskid' => $task_id,
                            'no_rawat' => $no_rawat,
                        ];
                        $action=$this->updateReferensiMobilejknBpjsTaskid($data_where,$data);
                        if($action){
                            $is_save=1;
                        }
                    }

                    if(!empty($is_save)){
                        DB::commit();
                        $pesan=['success','taskid berhasil tersimpan',21];
                    }else{
                        DB::rollBack();
                        $pesan=['error','taskid berhasil tidak tersimpan',22];
                    }
                }else{
                    $check=$this->uxuiTaskidErrors->where('no_rawat','=',$no_rawat)->where('taskid','=',$task_id)->count('no_rawat');
                    $data=[
                        'no_rawat' => $no_rawat,
                        'taskid' => $task_id,
                        'kode' => $hasil_respon['code'],
                        'message' => $hasil_respon['message'],
                        'waktu' => $waktu,
                    ];

                    if(empty($check)){  
                        $action=$this->insertUxuiTaskidErrors($data);
                        if($action){
                            $is_save=1;
                        }
                    }else{
                        unset($data['no_rawat']);
                        $data_where=[
                            'no_rawat' => $no_rawat,
                            'taskid' => $task_id,
                        ];
                        $action=$this->updateUxuiTaskidErrors($data_where,$data);
                        if($action){
                            $is_save=1;
                        }
                    }

                    if(!empty($is_save)){
                        DB::commit();
                        $pesan=['success','history taskid berhasil tersimpan',21];
                    }else{
                        DB::rollBack();
                        $pesan=['success','history taskid tidak tersimpan',22];
                    }
                }
                return $pesan;
            }); 
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                $pesan=['error','terjadi kesalahan pada database',3];
            }
            $pesan=['error',"simpan respon tidak berhasil",22];
        } 
        catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',"simpan respon tidak berhasil",22];
        }

        return $pesan;
    }

    function sendBpjs($no_rawat,$task_id){
        /*
            Code pesan dari 10
        */
        $pesan=[];
        try {
            date_default_timezone_set(getenv('TIME_ZONE_BPJS_SERVICE'));
            $date_time = new \DateTime();
            $set_prefix_waktu_1=1000;
            $set_prefix_waktu_2=7;
            $waktu    = strtotime(''.$date_time->format('Y-m-d').' '.$date_time->format('H:i:s').'') * $set_prefix_waktu_1 + $set_prefix_waktu_2;

            if(!is_string($task_id)){
                $task_id=''.(string)$task_id.'';
            }
            
            $check=$this->checkDataTaskid($no_rawat,$task_id);
            if(empty($check)){
                $send_json = [
                    "kodebooking" => $no_rawat,
                    "taskid"      => $task_id,
                    "waktu"       => $waktu
                ];

                $data_curl=[
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $this->urlEndpoint.'/'.$this->urlEndpoint_service.'/antrean/updatewaktu',
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($send_json),
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_HTTPHEADER =>[ 
                        "Content-Type: Application/x-www-form-urlencoded",
                        "X-cons-id: ".$this->consId,
                        "X-timestamp: ".GenerateBpjsService::bpjsTimestamp(),
                        "X-signature: ".GenerateBpjsService::generateSignature($this->consId, $this->secretKey),
                        "user_key: ".$this->userKey
                    ],
                ];

                $curl = curl_init();
                curl_setopt_array($curl,$data_curl);
                $response = curl_exec($curl);
                $err      = curl_error($curl);
                curl_close($curl);

                $hasil_respon = json_decode($response, true);
                $hasil_respon=!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : [];
                
                if(empty($hasil_respon)){
                    $pesan=['error','Tidak ada internet',12];
                }else{
                    $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                    $pesan=$this->simpan_respon($hasil_respon,$no_rawat,$task_id,$set_waktu);
                    if($hasil_respon['code']=='200'){
                        $pesan=array_merge($pesan,['success','taskid berhasil di kirim',11]);
                    }
                    if($hasil_respon['code']=='201'){
                        $pesan=array_merge($pesan,['error','terjadi kesalahan pada taskid',19]);
                    }
                }
            }else{
                $pesan=['success','task id sudah diselesaikan sebelumnya',10];
            }

        }catch (\Throwable $e) {
            $message=implode('|',$e->errorInfo);
            $pesan=['error',"send bpjs ".$message,12];
        }  

        return $pesan;
    }

    function taskId($no_rawat,$type){
        $run_action=env('FUNGSI_BPJS_SERVICE', false);
        $pesan=[];
        if($run_action==true){
            date_default_timezone_set(getenv('TIME_ZONE_BPJS_SERVICE'));
            try {
                if($type==3){
                    $check_task_3=$this->regPeriksa
                        ->select(DB::raw('concat(reg_periksa.tgl_registrasi,\' \',reg_periksa.jam_reg)'))
                        ->where([['reg_periksa.no_rawat',$no_rawat],['reg_periksa.stts','Belum']])
                        ->get();
                    
                    if($check_task_3){
                        $pesan=$this->sendBpjs($no_rawat,$type);
                    }else{
                        $pesan=['info','tidak dijalankan',1];    
                    }
                }
                if($type==4){
                    // Tanpa Pakek Mutasi Berkas
                    // $check_data_1 = $this->mutasiBerkas->where('no_rawat','=',$no_rawat)->where('status','like','Sudah Diterima')->count('no_rawat');
                    $check_data_2 =$this->regPeriksa->where('no_rawat','=',$no_rawat)->where('stts','like','Berkas Diterima')->count('no_rawat');
                    // if($check_data_1 and $check_data_2){
                    if($check_data_2){
                        $pesan=$this->sendBpjs($no_rawat,$type);
                    }else{
                        $pesan=['info','tidak dijalankan',1];    
                    }
                }else if($type==5){
                    // $check_data_1 =$this->regPeriksa->where('no_rawat','=',$no_rawat)->where('stts','like','Sudah')->count('no_rawat');
                    $check_data_pemeriksaan = DB::table('pemeriksaan_ralan')
                        ->select(DB::raw('concat(pemeriksaan_ralan.tgl_perawatan,\' \',pemeriksaan_ralan.jam_rawat)'))
                        ->where('pemeriksaan_ralan.no_rawat','=',$no_rawat)
                        ->get();
                    $check_data_status =$this->pemeriksaanRalan->where('no_rawat','=',$no_rawat)->count('no_rawat');
                    if($check_data_pemeriksaan and $check_data_status){
                        $pesan=$this->sendBpjs($no_rawat,$type);
                    }else{
                        $pesan=['info','tidak dijalankan',1];    
                    }
                }else if($type==6){
                    $check_data_1 =$this->resepObat->where('no_rawat','=',$no_rawat)->count('no_rawat');
                    if($check_data_1){
                        $pesan=$this->sendBpjs($no_rawat,$type);
                    }else{
                        $pesan=['info','tidak dijalankan',1];    
                    }
                }else{
                    $pesan=['error','tidak ada pilihan taskid',3];
                }
            }catch (\Throwable $e) {
                $pesan=['error','Terjadi Kesalahan, Service tidak berhasil dijalankan',3];
            }  
        }else{
            $pesan=['success','fungsi bridging die env belum diaktifkan',4];
        }
        return $pesan;
    }

    /*
        function proses pada khanza
    */
    function actionBeforeTaskId($no_rawat,$type){
        $run_action=env('FUNGSI_BPJS_SERVICE', false);
        
        if($run_action==true){
            $message_default=[
                'success'=>'Data berhasil di proses',
                'error'=>'Data tidak berhasil di proses',
            ];
            try {
                $pesan = DB::transaction(function () use ($no_rawat,$type,$message_default) {
                    $pesan=[];
                    $status_check=0;
                    $status_save=0;

                    // if($type==3){
                    //     $check_data = $this->mutasiBerkas->where('no_rawat','=',$no_rawat)->count('no_rawat');
                    //     if($check_data){
                    //         $status_check++;
                    //         $data=[
                    //             'no_rawat' => $no_rawat,
                    //             'status' => 'Sudah Dikirim',
                    //             'dikirim' => date('Y-m-d H:i:s'),
                    //             'diterima' => '0000-00-00 00:00:00',
                    //             'kembali' => '0000-00-00 00:00:00',
                    //             'tidakada' => '0000-00-00 00:00:00',
                    //             'ranap' => '0000-00-00 00:00:00',
                    //         ];
                    //         $save_model=$this->bpjsService->insertMutasiBerkas($data);
                    //         if($save_model){
                    //             $status_save++;
                    //         }
                    //     }
                    // }
                    if($type==4){
                        // $check_data = $this->mutasiBerkas->where('no_rawat','=',$no_rawat)->where('status','like','sudah dikirim')->count('no_rawat');
                        // if($check_data){
                        //     $status_check++;
                        //     $data_update=[
                        //         'status' => 'Sudah Diterima',
                        //         'diterima' => date('Y-m-d H:i:s'),
                        //     ];
                        //     $data_where=[
                        //         'no_rawat' => $no_rawat,
                        //     ];
                        //     $update_model=$this->updateMutasiBerkas($data_where,$data_update);
                        //     if($update_model){
                        //         $status_save++;
                        //     }
                        // }
        
                        $check_data=$this->regPeriksa->where('no_rawat','=',$no_rawat)->where('stts','like','Belum')->count('no_rawat');
                        if($check_data){
                            $status_check++;
                            $data_update=[
                                'stts' => 'Berkas Diterima',
                            ];
                            $data_where=[
                                'no_rawat' => $no_rawat,
                            ];
        
                            $update_model=$this->updateRegPeriksa($data_where,$data_update);
                            if($update_model){
                                $status_save++;
                            }
                        }
                    }else if($type==5){
                        $check_data=$this->regPeriksa->where('no_rawat','=',$no_rawat)->where('stts','like','Berkas Diterima')->count('no_rawat');
                        if($check_data){
                            $status_check++;
                            $data_update=[
                                'stts' => 'Sudah',
                            ];
                            $data_where=[
                                'no_rawat' => $no_rawat,
                            ];
        
                            $update_model=$this->updateRegPeriksa($data_where,$data_update);
                            if($update_model){
                                $status_save++;
                            }
                    }
                    }else if($type==0){
                        $check_data=$this->regPeriksa->where('no_rawat','=',$no_rawat)->where('stts','like','Sudah')->count('no_rawat');
                        if($check_data){
                            $status_check++;
                            $data_update=[
                                'stts' => 'Belum',
                            ];
                            $data_where=[
                                'no_rawat' => $no_rawat,
                            ];
        
                            $update_model=$this->updateRegPeriksa($data_where,$data_update);
                            if($update_model){
                                $status_save++;
                            }
                    }
                    }else{
                        $pesan=['error','tidak ada taskid yang dipilih',2];
                        $else=1;
                    }

                    if(empty($else)){
                        if($status_check>0){
                            if($status_save>0){
                                DB::commit();
                                $pesan=['success',$message_default['success'],1];
                            }else{
                                DB::rollBack();
                                $pesan=['error',$message_default['error'],2];
                            }
                        }else{
                            $pesan=['success','tidak ada data yang di ubah',1];
                        }
                    }

                    return $pesan;
                }); 
            }catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                if($e->errorInfo[1] == '1062'){
                    $pesan=['error','terjadi kesalahan pada database',3];
                }
                $pesan=['error',$message_default['error'],3];
            } 
            catch (\Throwable $e) {
                DB::rollBack();
                $pesan=['error',$message_default['error'],3];
            }
        }else{
            $pesan=['success','fungsi bridging die env belum diaktifkan',4];
        }
        return $pesan;
    }

}