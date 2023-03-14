<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GlobalService;
use App\Services\JadwalOperasiPasienService;
use Illuminate\Support\Facades\DB;

class JadwalOperasiPasienController extends Controller
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->url_name=$router_name->router_name;

        $this->globalService = new GlobalService;
        $this->jadwalOperasiPasienService = new JadwalOperasiPasienService;
    }

    function actionIndex(Request $request)
    {   
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {

            $noRm = $item_pasien->no_rm;
            $dataPasien = $this->globalService->getDataPasien($noRm);
            $list = $this->jadwalOperasiPasienService->getPaketOperasi();
            $ruangOK = (new \App\Models\RuangOk)->get();
            $noRawat = $item_pasien->no_rawat;

            $jadwalOperasiStatuses = $this->jadwalOperasiPasienService->getJadwalOperasiStatus();

            $item_search=[
                'form_search'=>!empty($request->form_search) ? $request->form_search : '',
                'form_status'=>!empty($request->form_status) ? $request->form_status : 'Menunggu',
                'form_start'=>!empty($request->form_filter_end) ? $request->form_filter_end : date('Y-m-d'),
                'form_end'=>!empty($request->form_filter_end) ? $request->form_filter_end : date('Y-m-d'),
            ];
    
            $parameter_search=[
                'search'=>$item_search['form_search'],
                'status'=>$item_search['form_status'],
                'tanggal_start'=>$item_search['form_start'],
                'tanggal_end'=>$item_search['form_end'],
            ];
            $jadwalOperasiLists = $this->jadwalOperasiPasienService->getJadwalOperasiList($parameter_search, $noRawat)->paginate(10);

            $parameter_view=[
                'dataPasien' => $dataPasien,
                'action_form' => 'jadwal-operasi-pasien/create',
                'list' => $list,
                'ruangOK' => $ruangOK,
                'item_search' => $item_search,
                'jadwalOperasiStatuses' => $jadwalOperasiStatuses,
                'jadwalOperasiLists'=>!empty($jadwalOperasiLists) ? $jadwalOperasiLists : [],
                'model'=>!empty($model) ? $model : [],
            ];
            return view('jadwal-operasi-pasien.index',$parameter_view);
        }
    }

    function actionCreate(Request $request)
    {
        DB::beginTransaction();
        $fields = $request->all();
        $link_back=$this->url_name;
        $link_back_param=['no_rm' => $request->no_rm, 'no_rawat' => $request->no_rawat,'fr'=>$request->fr];

        $message_default=[
            'success'=>'Data berhasil ditambahkan',
            'error'=>'Maaf data tidak berhasil ditambahkan'
        ];  
        $data_save=$fields;
        try{
            $data_save=$fields;
            unset($data_save["no_rm"]);
            unset($data_save["_token"]);
            
            $data_save['no_rawat']=!empty($data_save['no_rawat']) ? $data_save['no_rawat'] : '';
            $data_save['kode_paket']=!empty($data_save['kode_paket']) ? $data_save['kode_paket'] : '';
            $data_save['tanggal']=!empty($data_save['tanggal']) ? $data_save['tanggal'] : '';
            $data_save['jam_mulai']=!empty($data_save['jam_mulai']) ? $data_save['jam_mulai'] : '';
            $data_save['jam_selesai']=!empty($data_save['jam_selesai']) ? $data_save['jam_selesai'] : '';
            $data_save['status']=!empty($data_save['status']) ? $data_save['status'] : '';
            $data_save['kd_dokter']=!empty($data_save['kd_dokter']) ? $data_save['kd_dokter'] : '';
            $data_save['kd_ruang_ok']=!empty($data_save['kd_ruang_ok']) ? $data_save['kd_ruang_ok'] : '';
            if($data_save){
                $cek_data = (new \App\Models\BookingOperasi)->where('no_rawat','=', $data_save['no_rawat'])->first();
                
                if($cek_data){
                    return redirect()->route($link_back, $link_back_param)->with(['error' => 'Nomor rawat '.$data_save['no_rawat'].' sudah dilakukan penginputan hari ini']);
                }
                $data_save=(new \App\Models\BookingOperasi)->set_columns_table_with_data($data_save);
                $model=(new \App\Models\BookingOperasi);
                $model->set_model_with_data($data_save);
                if($model->save()){
                    $is_save=1;     
                }
            }
            if($is_save){
                DB::commit();
                return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
            }else{
                DB::rollBack();
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }

        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }
    }

    function formUpdate(Request $request) 
    {
        DB::beginTransaction();
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : ''; 
        $no_rm=!empty($exp[2]) ? $exp[2] : '';
        
        $ruangOK = (new \App\Models\RuangOk)->get();
        $dataPasien = $this->globalService->getDataPasien($no_rm);

        $model = $this->jadwalOperasiPasienService->getUpJadwalOperasi($no_rawat)->first($no_rawat);
        
        $model=!empty($model) ? $model->getAttributes() : (object)[];
        $model['fr']=$type_akses;
        $model['no_rm']=$no_rm;
        $model=(object)$model;
        
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
        if($get_user->type_user=='dokter'){
            $listDokter = $this->globalService->getDokterList();
        }if($get_user->type_user=='petugas'){
            $listPetugas = $this->globalService->getPetugasList();
        }

        
        $kode_key_old=[
            'no_rawat'=>!empty($no_rawat) ? $no_rawat : '',
            'tgl_perawatan'=>!empty($exp[2]) ? $exp[2] : '',
            'jam_rawat'=>!empty($exp[3]) ? $exp[3] : '',
        ];

        $kode_key_old=(new \App\Http\Traits\GlobalFunction)->makeJson($kode_key_old);
        
        $parameter_view=[
            'action_form'=>'jadwal-operasi-pasien/update',
            'kode_key_old'=>$kode_key_old,
            'ruangOK'=>$ruangOK,
            'dataPasien'=>$dataPasien,
            'noRm'=>$no_rm,
            'model'=>$model,
            'type_akses'=>$type_akses,
            'listDokter'=>!empty($listDokter) ? $listDokter : [],
            'listPetugas'=>!empty($listPetugas) ? $listPetugas : []
        ];

        if($request->ajax()){
            $returnHTML = view('jadwal-operasi-pasien.form',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    function actionUpdate(Request $request){
        DB::beginTransaction();
        $fields = $request->all();
        unset($fields["fr"]);
        unset($fields["no_rm"]);
        $type_akses=!empty($request->fr) ? $request->fr : 'rj';
        $link_back= $this->url_name;
        $link_back_param=['no_rm' => $request->no_rm, 'no_rawat' => $request->no_rawat,'fr'=>$request->fr];

        $message_default=[
            'success'=>'Data berhasil diubah',
            'error'=>'Maaf data tidak berhasil diubah'
        ];
        try {   
            $data_save=$fields;
            unset($data_save["fr"]);
            unset($data_save["no_rm"]);
            unset($data_save["_token"]);
            
            $no_rawat = $fields["no_rawat"];

            if($data_save){
                $data_save=[
                    'kode_paket'=>!empty($data_save['kode_paket']) ? $data_save['kode_paket'] : '',
                    'tanggal'=>!empty($data_save['tanggal']) ? $data_save['tanggal'] : '',
                    'jam_mulai'=>!empty($data_save['jam_mulai']) ? $data_save['jam_mulai'] : '',
                    'jam_selesai'=>!empty($data_save['jam_selesai']) ? $data_save['jam_selesai'] : '',
                    'status'=>!empty($data_save['status']) ? $data_save['status'] : '',
                    'kd_dokter'=>!empty($data_save['kd_dokter']) ? $data_save['kd_dokter'] : '',
                    'kd_ruang_ok'=>!empty($data_save['kd_ruang_ok']) ? $data_save['kd_ruang_ok'] : ''
                ];
                $model=$this->jadwalOperasiPasienService->updateOperasi(['no_rawat'=>$no_rawat],$data_save);
                $is_save=0;
                if($model){
                    $is_save=1;
                }
            }
            if($is_save){
                DB::commit();
                return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
            }else{
                DB::rollBack();
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

        $link_back='jadwal-operasi-pasien';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $no_rawat,'fr'=>$type_akses];
        
        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

        try {  
            $model = $this->jadwalOperasiPasienService->deleteOperasi($no_rawat);

            $is_save=0;
            if($model){
                $is_save=1;
            }   
            if($is_save){
                DB::commit();
                return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
            }else{
                DB::rollBack();
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf data gagal dihapus']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        } 

    }
}
