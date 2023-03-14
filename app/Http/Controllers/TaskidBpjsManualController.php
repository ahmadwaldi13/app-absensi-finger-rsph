<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Traits\GlobalFunction;
use App\Services\GlobalService;
use App\Services\ListTaskidAntrolService;
use App\Services\Antrol\BridgeAntrolService;
use App\Services\Vclaim\BridgeVclaimService;
use App\Services\BpjsService;
use Illuminate\Support\Facades\DB;

class TaskidBpjsManualController extends Controller
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;
        $this->title='Antrean dan TaskID Manual';
        $this->breadcrumbs=[
            ['title'=>'JKN Online','url'=>url('/')."/sub-menu?type=8"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];
        
        $this->globalFunction = new GlobalFunction;
        $this->listTaskidAntrolService = new ListTaskidAntrolService;
        $this->bridgeAntrolService = new BridgeAntrolService;
        $this->bridgeVclaim = new BridgeVclaimService;
        $this->bpjsService = new BpjsService;
        $this->globalService = new GlobalService;
    }

    public function actionIndex(Request $request)
    {
        $filter = [
            'tanggal' => !empty($request->tanggal) ? $request->tanggal : date('Y-m-d'),
            'poli' => !empty($request->filter_kd_poli) ? $request->filter_kd_poli : '',
            'filter_search' => !empty($request->filter_search) ? $request->filter_search : '',
        ];
        $list_data_tmp = $this->listTaskidAntrolService->regPeriksaLocal($filter);
        $list_data=$this->paginate($list_data_tmp);
        $list_data->withPath('');
        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data
        ];  

        return view($this->part_view.'.index',$parameter_view);
    }

    public function actionCreate(Request $request)
    {
        $fields = $request->all();
        $exp = explode('@',$fields['data_sent']);
        $noBooking = !empty($exp[0]) ? $exp[0] : 0;
        $taksid = !empty($exp[1]) ? $exp[1] : 0;
        
        $link_back_param=[];

        try {
            $endpoint = "antrean/updatewaktu";
            date_default_timezone_set(getenv('TIME_ZONE_BPJS_SERVICE'));
            $date_time = new \DateTime();
            $set_prefix_waktu_1=1000;
            $set_prefix_waktu_2=7;
            $waktu    = strtotime(''.$date_time->format('Y-m-d').' '.$date_time->format('H:i:s').'') * $set_prefix_waktu_1 + $set_prefix_waktu_2;

            if(!is_string($taksid)){
                $taksid=''.(string)$taksid.'';
            }
            
            $data = [
                "kodebooking" => $noBooking,
                "taskid"      => $taksid,
                "waktu"       => $waktu
            ];

            $data_tmp_tmp = $this->bridgeAntrolService->postRequest($endpoint, $data);

            $hasil_respon = json_decode($data_tmp_tmp, true);
            $hasil_respon =!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : '';
            $meta = $hasil_respon['message'];
            if(empty($hasil_respon)){
                $pesan=['error','Tidak ada internet',12];
            }else{
                if($hasil_respon['code']=='200'){
                    $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                    $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noBooking,$taksid,$set_waktu);
                    return redirect()->back()->with(['success' => $meta]);
                }
                if($hasil_respon['code']!=='200'){
                    $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                    $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noBooking,$taksid,$set_waktu);
                    return redirect()->back()->with(['error' => $meta]);
                }
            }

        }catch (\Throwable $e) {
            return redirect()->back()->with(['error' => $e]);
        }  
    }

    public function actionInsertAntrean(Request $request)
    {
        $fields = $request->all();
        $exp = !empty(explode('@',$fields['jkn_dpjp'])) ? explode('@',$fields['jkn_dpjp']) : '';
        $exp2 = !empty(explode('@',$fields['jkn_kodepoli'])) ? explode('@',$fields['jkn_kodepoli']) : '';
        $tanggal = date('Y-m-d');
        $no_peserta = $fields['jkn_noKartu'];
        $nik = $fields['jkn_nik'];
        $noHp = $fields['jkn_hp'];
        $noRM = $fields['jkn_norm'];
        $jenisKunjungan = $fields['jkn_jeniskunjungan'];
        $noReferensi = $fields['jkn_no_referensi'];
        // $register = DB::select("SELECT a.no_reg, a.no_rawat, a.kd_dokter FROM reg_periksa a JOIN pasien d ON a.no_rkm_medis=d.no_rkm_medis WHERE d.no_peserta = '$no_peserta' AND a.tgl_registrasi = '$tanggal'");
        $register = DB::table(DB::raw('reg_periksa a'))
                    ->select('a.no_reg','a.no_rawat','a.kd_dokter')
                    ->join(DB::raw('pasien d'),'a.no_rkm_medis','=','d.no_rkm_medis')
                    ->where([['d.no_peserta',$no_peserta],['a.tgl_registrasi',$tanggal]])
                    ->get();

        foreach($register as $v){
            $noReg = $v->no_reg;
            $noRawat = $v->no_rawat;
        }
        $dilayani = 6 * $noReg;
        $taksid = '3';
        try {
            $endpoint = "antrean/add";
            $data = [
                'kodebooking'        => $noRawat,
                'jenispasien'        => 'JKN',
                'nomorkartu'         => $no_peserta,
                'nik'                => $nik,
                'nohp'               => $noHp,
                'kodepoli'           => !empty($exp[4]) ? $exp[4] : '',
                'namapoli'           => !empty($exp2[1]) ? $exp2[1] : '',
                'pasienbaru'         => 0,
                'norm'               => $noRM,
                'tanggalperiksa'     => date('Y-m-d'),
                'kodedokter'         => !empty($exp[0]) ? $exp[0] : '',
                'namadokter'         => !empty($exp[2]) ? $exp[2] : '',
                'jampraktek'         => !empty($exp[3]) ? $exp[3] : '',
                'jeniskunjungan'     => $jenisKunjungan,
                'nomorreferensi'     => $noReferensi,
                'nomorantrean'       => !empty($exp2[0]) ? $exp2[0] : ''.'-'.$noReg,
                'angkaantrean'       => $noReg,
                'estimasidilayani'   => strtotime(substr(!empty($exp[3]) ? $exp[3] : '', 0, 5).'+'.$dilayani.' minute') * 1000 + 7,
                'sisakuotajkn'       => !empty($exp[1]) ? $exp[1] : '' - $noReg,   
                'kuotajkn'           => !empty($exp[1]) ? $exp[1] : '',
                'sisakuotanonjkn'    => !empty($exp[1]) ? $exp[1] : '' - $noReg,
                'kuotanonjkn'        => !empty($exp[1]) ? $exp[1] : '',
                'keterangan'         => 'Peserta harap 30 menit lebih awal guna pencatatan administrasi.'
            ];
           
            $data_tmp_tmp = $this->bridgeAntrolService->postRequest($endpoint, $data);
            $hasil_respon = json_decode($data_tmp_tmp, true);
            $hasil_respon =!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : '';
            $meta = $hasil_respon['message'];
            if(empty($hasil_respon)){
                $pesan=['error','Tidak ada internet',12];
            }else{
                if($hasil_respon['code']=='200'){
                    $this->taskid($noRawat, $taksid);
                    return redirect()->back()->with(['success' => $meta]);
                }
                if($hasil_respon['code']!=='200'){
                    $this->taskid($noRawat, $taksid);
                    return redirect()->back()->with(['error' => $meta]);
                }
            }

        }catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th]);
        }  
    }

    function taskid($noRawat, $taksid)
    {
        $endpoint = "antrean/updatewaktu";
        date_default_timezone_set(getenv('TIME_ZONE_BPJS_SERVICE'));
        $date_time = new \DateTime();
        $set_prefix_waktu_1=1000;
        $set_prefix_waktu_2=7;
        $waktu    = strtotime(''.$date_time->format('Y-m-d').' '.$date_time->format('H:i:s').'') * $set_prefix_waktu_1 + $set_prefix_waktu_2;

        if(!is_string($taksid)){
            $taksid=''.(string)$taksid.'';
        }
        
        $data = [
            "kodebooking" => $noRawat,
            "taskid"      => $taksid,
            "waktu"       => $waktu
        ];
        
        $data_tmp_tmp = $this->bridgeAntrolService->postRequest($endpoint, $data);

        $hasil_respon = json_decode($data_tmp_tmp, true);
        $hasil_respon =!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : '';
        $meta = $hasil_respon['message'];
        if(empty($hasil_respon)){
            $pesan=['error','Tidak ada internet',12];
        }else{
            if($hasil_respon['code']=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
            if($hasil_respon['code']!=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
        }
    }

    function formTaskIDAll(Request $request) 
    {
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $no_rawat=!empty($exp[0]) ? $exp[0] : ''; 
        $noRM=!empty($exp[1]) ? $exp[1] : ''; 

        $dataPasien = $this->globalService->getDataPasien($noRM);
        $kode_key_old=[
            'no_rawat'=>!empty($no_rawat) ? $no_rawat : '',
        ];

        $kode_key_old=(new \App\Http\Traits\GlobalFunction)->makeJson($kode_key_old);
        $parameter_view=[
            'action_form'=>'taskid-bpjs-manual/update_all',
            'kode_key_old'=>$kode_key_old,
            'dataPasien'=>$dataPasien,
            'no_rawat'=>$no_rawat,
        ];

        if($request->ajax()){
            $returnHTML = view('taskid-bpjs-manual.form',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    public function updateAll(Request $request)
    {
        $fields = $request->all();
        $kodeBooking = $fields['no_rawat'];

        $task_id4 = !empty($fields['task_4']) ? $fields['task_4'] : '';
        $task_id5 = !empty($fields['task_5']) ? $fields['task_5'] : '';
        $task_id6 = !empty($fields['task_6']) ? $fields['task_6'] : '';
        $task_id7 = !empty($fields['task_7']) ? $fields['task_7'] : '';

        $message_default=[
            'success'=>'TaskID berhasil dikirim',
            'error'=>'Maaf TaskID sudah ada'
        ];

        try {
            $cek_data_task_id = (new \App\Models\ReferensiMobilejknBpjsTaskid)->where('no_rawat','=', $kodeBooking)->count();
            if($cek_data_task_id == 0 || $cek_data_task_id == 1 || $cek_data_task_id == 2 || $cek_data_task_id == 3 || $cek_data_task_id == 4 || $cek_data_task_id ==6){
                $cek_data = (new \App\Models\ReferensiMobilejknBpjsTaskid)->where('no_rawat','=', $kodeBooking)->where('taskid', '=',  $task_id4)->count('no_rawat');
                if($cek_data==0){
                    $this->taskid4($kodeBooking, $task_id4);
                }
                $cek_data = (new \App\Models\ReferensiMobilejknBpjsTaskid)->where('no_rawat','=', $kodeBooking)->where('taskid', '=',  $task_id5)->count('no_rawat');
                if($cek_data==0){
                    $this->taskid5($kodeBooking, $task_id5);
                }
                $cek_data = (new \App\Models\ReferensiMobilejknBpjsTaskid)->where('no_rawat','=', $kodeBooking)->where('taskid', '=',  $task_id6)->count('no_rawat');
                if($cek_data==0){
                    $this->taskid6($kodeBooking, $task_id6);
                }
                $cek_data = (new \App\Models\ReferensiMobilejknBpjsTaskid)->where('no_rawat','=', $kodeBooking)->where('taskid', '=',  $task_id7)->count('no_rawat');
                if($cek_data==0){
                    $this->taskid7($kodeBooking, $task_id7);
                }
                return redirect()->back()->with(['success' => $message_default['success']]);

            } elseif($cek_data_task_id == 5 || $cek_data_task_id == 7){
                return redirect()->back()->with(['error' => $message_default['error']]);
                
            }
                

        } catch (\Throwable $th) {
            if($th->errorInfo[1] == '1062'){
                return redirect()->back()->with(['error' => 'Mungkin Anda kurang ngopii']);
            }
        }
    }

    function taskid4($noRawat, $taksid)
    {
        $endpoint = "antrean/updatewaktu";
        date_default_timezone_set(getenv('TIME_ZONE_BPJS_SERVICE'));
        $date_time = new \DateTime();
        $set_prefix_waktu_1=1000;
        $set_prefix_waktu_2=7;
        $waktu    = strtotime(''.$date_time->format('Y-m-d').' '.$date_time->format('H:i:s').'') * $set_prefix_waktu_1 + $set_prefix_waktu_2;

        if(!is_string($taksid)){
            $taksid=''.(string)$taksid.'';
        }
        
        $data = [
            "kodebooking" => $noRawat,
            "taskid"      => $taksid,
            "waktu"       => $waktu
        ];
        
        $data_tmp_tmp = $this->bridgeAntrolService->postRequest($endpoint, $data);

        $hasil_respon = json_decode($data_tmp_tmp, true);
        $hasil_respon =!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : '';
        $meta = $hasil_respon['message'];
        if(empty($hasil_respon)){
            $pesan=['error','Tidak ada internet',12];
        }else{
            if($hasil_respon['code']=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
            if($hasil_respon['code']!=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
        }
    }

    function taskid5($noRawat, $taksid)
    {
        $endpoint = "antrean/updatewaktu";
        date_default_timezone_set(getenv('TIME_ZONE_BPJS_SERVICE'));
        $date_time = new \DateTime();
        $set_prefix_waktu_1=1000;
        $set_prefix_waktu_2=7;
        $waktu    = strtotime(''.$date_time->format('Y-m-d').' '.$date_time->format('H:i:s').'') * $set_prefix_waktu_1 + $set_prefix_waktu_2;

        if(!is_string($taksid)){
            $taksid=''.(string)$taksid.'';
        }
        
        $data = [
            "kodebooking" => $noRawat,
            "taskid"      => $taksid,
            "waktu"       => $waktu
        ];
        
        $data_tmp_tmp = $this->bridgeAntrolService->postRequest($endpoint, $data);

        $hasil_respon = json_decode($data_tmp_tmp, true);
        $hasil_respon =!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : '';
        $meta = $hasil_respon['message'];
        if(empty($hasil_respon)){
            $pesan=['error','Tidak ada internet',12];
        }else{
            if($hasil_respon['code']=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
            if($hasil_respon['code']!=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
        }
    }

    function taskid6($noRawat, $taksid)
    {
        $endpoint = "antrean/updatewaktu";
        date_default_timezone_set(getenv('TIME_ZONE_BPJS_SERVICE'));
        $date_time = new \DateTime();
        $set_prefix_waktu_1=1000;
        $set_prefix_waktu_2=7;
        $waktu    = strtotime(''.$date_time->format('Y-m-d').' '.$date_time->format('H:i:s').'') * $set_prefix_waktu_1 + $set_prefix_waktu_2;

        if(!is_string($taksid)){
            $taksid=''.(string)$taksid.'';
        }
        
        $data = [
            "kodebooking" => $noRawat,
            "taskid"      => $taksid,
            "waktu"       => $waktu
        ];
        
        $data_tmp_tmp = $this->bridgeAntrolService->postRequest($endpoint, $data);

        $hasil_respon = json_decode($data_tmp_tmp, true);
        $hasil_respon =!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : '';
        $meta = $hasil_respon['message'];
        if(empty($hasil_respon)){
            $pesan=['error','Tidak ada internet',12];
        }else{
            if($hasil_respon['code']=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
            if($hasil_respon['code']!=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
        }
    }

    function taskid7($noRawat, $taksid)
    {
        $endpoint = "antrean/updatewaktu";
        date_default_timezone_set(getenv('TIME_ZONE_BPJS_SERVICE'));
        $date_time = new \DateTime();
        $set_prefix_waktu_1=1000;
        $set_prefix_waktu_2=7;
        $waktu    = strtotime(''.$date_time->format('Y-m-d').' '.$date_time->format('H:i:s').'') * $set_prefix_waktu_1 + $set_prefix_waktu_2;

        if(!is_string($taksid)){
            $taksid=''.(string)$taksid.'';
        }
        
        $data = [
            "kodebooking" => $noRawat,
            "taskid"      => $taksid,
            "waktu"       => $waktu
        ];
        
        $data_tmp_tmp = $this->bridgeAntrolService->postRequest($endpoint, $data);

        $hasil_respon = json_decode($data_tmp_tmp, true);
        $hasil_respon =!empty($hasil_respon['metadata']) ? $hasil_respon['metadata'] : '';
        $meta = $hasil_respon['message'];
        if(empty($hasil_respon)){
            $pesan=['error','Tidak ada internet',12];
        }else{
            if($hasil_respon['code']=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
            if($hasil_respon['code']!=='200'){
                $set_waktu=$cenvertedTime = date('Y-m-d H:i:s',strtotime('+'.$set_prefix_waktu_2.' hour',strtotime(date("Y-m-d H:i:s"))));
                $pesan=$this->bpjsService->simpan_respon($hasil_respon,$noRawat,$taksid,$set_waktu);
            }
        }
    }

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}