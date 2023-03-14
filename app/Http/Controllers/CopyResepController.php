<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Services\GlobalService;
use App\Services\ResepService;
use App\Services\RacikanService;

class CopyResepController extends Controller
{

    public function __construct(
        GlobalService $globalService,
        ResepService $resepService,
        RacikanService $racikanService
    ) {
        $this->globalService = $globalService;
        $this->resepService = $resepService;
        $this->racikanService = $racikanService;
    }

    private function data_form($params){

        $no_rawat = !empty($params['no_rawat']) ? $params['no_rawat'] : '';
        $no_rm = !empty($params['no_rm']) ? $params['no_rm'] : '';
        $type_form = !empty($params['type_form']) ? $params['type_form'] : '';

        $return=[];
        if ($no_rawat && $no_rm && $type_form) {
            
            $data_pasien = $this->globalService->getDataPasien($no_rm);
            $dokter_login = Auth::user();

            $model['no_rawat']=$no_rawat;
            $model['fr']=$type_form;
            $model['no_rm']=$no_rm;
            $model['nm_pasien']=!empty($data_pasien->nm_pasien) ? $data_pasien->nm_pasien : '';
            $model['kd_dokter']=!empty($dokter_login->id) ? $dokter_login->id : '';
            $model['nm_dokter']=!empty($dokter_login->name) ? $dokter_login->name : '';

            $no_resep=$this->racikanService->getNoResep(date('Y-m-d'));
            $model['no_resep']=!empty($no_resep) ? $no_resep : '';

            $model=(object)$model;

            $return=[
                "model" => !empty($model) ? $model : [],
            ];
        }

        return $return;
    }

    function actionIndex(Request $request){

        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {

            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
            if($get_user->type_user!='dokter'){
                // return view('copy-resep.index_error',[]);
            }
            
            $check_registrasi=$this->globalService->cariRegistrasi($item_pasien->no_rawat);
        
            if($check_registrasi>0){
                \Session::flash('error', 'Data billing sudah terverifikasi ..!!');
            }
    
            $no_rawat = $item_pasien->no_rawat;
            $no_rm = $item_pasien->no_rm;
            
            $paramater_data=[
                'no_rawat'=>$item_pasien->no_rawat,
                'no_rm'=>$item_pasien->no_rm,
                'type_form'=>$item_pasien->no_fr,
            ];
    
            $parameter_data_form=$this->data_form($paramater_data);
            $kode_dokter=!empty($parameter_data_form['model']->kd_dokter) ? $parameter_data_form['model']->kd_dokter : 0;
    
            $filter_search=!empty($request->search) ? $request->search : '';
            $filter_active_tgl=!empty($request->pil_tgl) ? $request->pil_tgl : '';
            if(empty($filter_active_tgl)){
                $request->form_filter_start=''; 
                $request->form_filter_end=''; 
            }
            
            $filter_start=!empty($request->form_filter_start) ? $request->form_filter_start : '';
            $filter_end=!empty($request->form_filter_end) ? $request->form_filter_end : '';
            
            $paramater_search=[
                'pasien.no_rkm_medis'=>$no_rm,
                'tgl_peresepan'=>[$filter_start,$filter_end],
                'search'=>$filter_search
            ];
    
            if($item_pasien->no_fr=='ri'){
                $paramater_search['resep_obat.status']='ranap';
            }else{
                $paramater_search['resep_obat.status']='ralan';
            }
            $resep=$this->resepService->getResepListDetail($paramater_search);
            $racikan=$this->racikanService->getResepListDetail($paramater_search);
            
            $data_list_tmp=array_merge($resep,$racikan);
            
            $data_list=[];
            foreach($data_list_tmp as $key => $value){
                $data_list[$value->no_resep]=$value;
            }
            krsort($data_list);
    
            $parameter_view=[
                'data_list'=>$data_list
            ];
    
            $parameter_view=array_merge($parameter_view,$parameter_data_form);
    
            return view('copy-resep.index',$parameter_view);
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    
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

        $link_back='copy_resep';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $no_rawat,'fr'=>$type_akses];

        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];

        try {
            if(!empty($no_resep)){
                $delete_model=$this->racikanService->resepObat->where('no_resep','=',$no_resep)->delete();
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
}
