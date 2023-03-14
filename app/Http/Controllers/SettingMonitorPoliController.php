<?php

namespace App\Http\Controllers;

use App\Models\UxuiSettinganMonitorPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\GlobalFunction;

use App\Services\RawatJalanService;

class SettingMonitorPoliController extends \App\Http\Controllers\MyAuthController
{
    public function __construct(RawatJalanService $rawatJalanService) {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Kelola Monitor Poliklinik';
        $this->breadcrumbs=[
            ['title'=>'Setting Aplikasi','url'=>url('/')."/sub-menu?type=3"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];
    
        $this->rawatJalanService = $rawatJalanService;  
        $this->globalFunction = new GlobalFunction;     
    }

    public function actionIndex(Request $request)
    {
        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';
        $paramater=[
            'search'=>$form_filter_text
        ];

        $data_tmp_tmp=( new \App\Models\UxuiSettinganMonitorPoli);
        $list_data=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater,['where_or'=>['kode_setting','item_poli']])->paginate(!empty($request->per_page) ? $request->per_page : 15);
        
        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data
        ];

        return view($this->part_view.'.index',$parameter_view);
    }

    private function form(Request $request){   
        $kode = !empty($request->data_sent) ? $request->data_sent : '';
        $poliKliniks =  $this->rawatJalanService->getListPoliklinik()->where('status','1')->get();
        $model = UxuiSettinganMonitorPoli::where('kode_setting', '=', $kode)->first();
                            
        if ($model) {
            $action_form = $this->part_view.'/update';
        } else {
            $action_form = $this->part_view.'/create';
        }
        $parameter_view = [
            'polikliniks'=>$poliKliniks,
            'action_form' => $action_form,
            'model' => $model
        ];

        return view($this->part_view.'.form',$parameter_view);
    }


    function actionCreate(Request $request){
        if($request->isMethod('get')){
            return $this->form($request)->render();
        }
        if($request->isMethod('post')){
            return $this->proses($request);
        }
    }

    function actionUpdate(Request $request){
        if($request->isMethod('get')){
            $bagan_form=$this->form($request);

            // dd($bagan_form);
            $parameter_view=[
                'title'=>$this->title,
                'breadcrumbs'=>$this->breadcrumbs,
                'bagan_form'=>$bagan_form,
                'url_back'=>$this->url_name
            ];
    
            return view('layouts.index_bagan_form',$parameter_view);
        }
        
        if($request->isMethod('post')){
            return $this->proses($request);
        }
    }

    private function proses($request){
        $req=$request->all();
        $kode=!empty($req['key_old']) ? $req['key_old'] : '';
        $link_back_param=[];
        $kodeTemp = $req['kode_template'];
        if ($kodeTemp==1) {
            $linkTemp = '-';
        } else {
            $linkTemp = $req['link_video'];
        }
        DB::beginTransaction();
        $pesan=[];
        
        $message_default=[
            'success'=>!empty($kode) ? 'Data berhasil diubah' : 'Data berhasil disimpan',
            'error'=>!empty($kode) ? 'Data tidak berhasil diubah' : 'Data berhasil disimpan'
        ];
        try {
            $model = (new \App\Models\UxuiSettinganMonitorPoli)->where('kode_setting', '=', $kode)->first();
            if(empty($model)){
                $model=(new \App\Models\UxuiSettinganMonitorPoli);
            }
            $data_save=$req;
            $data_save['kode_setting'] = strtolower(str_replace(" ", "_", $this->globalFunction->remove_multiplespace($data_save['kode_setting'])));
            $data_save['kode_template'] = $data_save['kode_template'];
            $data_save['link_video'] = $linkTemp;
            $data_save['item_poli'] = implode(',', $data_save['item_poli']);
            $model->set_model_with_data($data_save);
            
            $is_save=0;

            if($model->save()){
                $is_save=1; 
            }
            if($is_save){
                DB::commit();
                $pesan=['success',$message_default['success'],2];
            }else{
                DB::rollBack();
                $pesan=['error',$message_default['error'],3];
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
            }
            $pesan=['error',$message_default['error'],3];
        
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }

        return redirect()->route($this->url_name, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
    }

    function actionDelete(Request $request){
        DB::beginTransaction();
        $pesan=[];
        $link_back_param=[];
        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];
        
        $kode = !empty($request->data_sent) ? $request->data_sent : null;

        try {
            $model = (new \App\Models\UxuiSettinganMonitorPoli)->where('kode_setting', '=', $kode)->first();
            if(empty($model)){
                return redirect()->route($this->url_name, $link_back_param)->with(['error','Data tidak ditemukan']);
            }
            
            $is_save=0;
            if($model->delete()){
                $is_save=1;
            }

            if($is_save){
                DB::commit();
                $pesan=['success',$message_default['success'],2];
            }else{
                DB::rollBack();
                $pesan=['error',$message_default['error'],3];
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                
            }
            $pesan=['error',$message_default['error'],3];
        
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }

        return redirect()->route($this->url_name, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
    }
}
