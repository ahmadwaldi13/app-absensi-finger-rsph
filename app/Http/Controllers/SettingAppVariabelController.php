<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UxuiSettinganAppVariable;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\GlobalFunction;

class SettingAppVariabelController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Setting Variabel Aplikasi';
        $this->breadcrumbs=[
            ['title'=>'Setting Aplikasi','url'=>url('/')."/sub-menu?type=3"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];
    
        $this->globalFunction = new GlobalFunction;
    }

    function actionIndex(Request $request){
        $filter_kd_jenis = !empty($request->filter_kd_jenis) ? $request->filter_kd_jenis : '';
        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';
        
        $paramater=[
            'search'=>$form_filter_text
        ];
        if(!empty($filter_kd_jenis)){
            $paramater['jenis']=$filter_kd_jenis;
        }

        $data_tmp_tmp=( new \App\Models\UxuiSettinganAppVariable );
        $list_data=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater,['where_or'=>['nm_variable','value_variable']])->paginate(15);

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data
        ];

        return view($this->part_view.'.index',$parameter_view);
    }
    
    private function form(Request $request){   
        $kode = !empty($request->data_sent) ? $request->data_sent : '';

        $model = UxuiSettinganAppVariable::where('id_variable', '=', $kode)->first();
        if ($model) {
            $action_form = $this->part_view.'/update';
        } else {
            $action_form = $this->part_view.'/create';
        }
        $parameter_view = [
            'action_form' => $action_form,
            'model' => $model
        ];

        return view($this->part_view.'.form',$parameter_view);
    }

    private function generateEnvDefault(){
        $path='./.env_default';
        $data_default_tmp=file_get_contents($path);
        
        $first = trim(preg_replace('/\s+/', '+', $data_default_tmp));
        $first=explode('+',$first);
        $get_data_default=[];
        if($first){
            foreach($first as $item){
                $item=explode('=',$item);
                if(count($item)!==1){
                    $get_data_default[str_replace("'",'',$item[0])]=str_replace("'",'',$item[1]);
                }
            }
        }
    
        return (object)[
            'data_string'=>$data_default_tmp,
            'data_array'=>$get_data_default,
        ];
    }
    private function generateEnv(){
        $data = UxuiSettinganAppVariable::get();
        $get_data_default=$this->generateEnvDefault();
        $get_data_default_array=$get_data_default->data_array;
    
        $path='./.env';
        file_get_contents($path);

        $set2=[];

        foreach($data as $key => $value){
            if(!array_key_exists($value->nm_variable,$get_data_default_array)){
                $set2[]=$value->nm_variable.'='.$value->value_variable;
            }
        }
        $set_default=[];
        if(!empty($get_data_default_array)){
            foreach($get_data_default_array as $key => $item){
                $set_default[]=$key.'='.$item;
            }
            $set2=array_merge($set_default,$set2);
        }
    

        $set=implode(PHP_EOL,$set2);

        file_put_contents($path,'');

        file_put_contents($path,$set, FILE_APPEND);
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

        $action_is_create= (str_contains($request->getPathInfo(),$this->url_index.'/create')) ? 1 : 0;
        $link_back_redirect=($action_is_create) ? $this->url_name : $this->url_name.'/update';
        DB::beginTransaction();
        $pesan=[];
        if($action_is_create){
            $link_back_param=[];
        }else{
            $link_back_param=['data_sent'=>$kode];
        }
        
        $link_back_param=array_merge($link_back_param,$request->all());
        $message_default=[
            'success'=>!empty($kode) ? 'Data berhasil diubah' : 'Data berhasil disimpan',
            'error'=>!empty($kode) ? 'Data tidak berhasil diubah' : 'Data tidak berhasil disimpan'
        ];

        try {
            $data_save=$req;
            $get_data_default=$this->generateEnvDefault();
            $get_data_default_array=$get_data_default->data_array;

            if(array_key_exists($data_save['nm_variable'],$get_data_default_array)){
                return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Variabel ditolak']);
            }
            
            $model = UxuiSettinganAppVariable::where('id_variable', '=', $kode)->first();
            
            if(empty($model)){
                
                $model=(new \App\Models\UxuiSettinganAppVariable);
                
            }
            $data_save=$req;
            $data_save['nm_variable'] = strtoupper(str_replace(" ", "_", $this->globalFunction->remove_multiplespace($data_save['nm_variable'])));
            $data_save['value_variable'] = $this->globalFunction->remove_multiplespace($data_save['value_variable']);

            if(substr($data_save['value_variable'],0,1)=='"' or substr($data_save['value_variable'],0,1)=="'"){
                $petik = substr($data_save['value_variable'],0,1);
                if(substr($data_save['value_variable'],-1)!== $petik){
                    $data_save['value_variable'] = $data_save['value_variable'].$petik;
                }
            }else if(substr($data_save['value_variable'],-1)=='"' or substr($data_save['value_variable'],-1)=="'"){
                $petik = substr($data_save['value_variable'],-1);
                if(substr($data_save['value_variable'],0,1)!== $petik){
                    $data_save['value_variable'] = $petik.$data_save['value_variable'];
                }
            }
            else{
                $data_save['value_variable'] = str_replace(" ", "_", $this->globalFunction->remove_multiplespace($data_save['value_variable']));
            }

            $model->set_model_with_data($data_save);

            $is_save=0;
            
            if($model->save()){
                $is_save=1; 
            }
            
            if($is_save){
                DB::commit();
                $this->generateEnv();
                
                $link_back_param=$this->clear_request($link_back_param,$request);
                
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

        return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
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
            $model = UxuiSettinganAppVariable::where('id_variable', '=', $kode)->first();
            if(empty($model)){
                return redirect()->route($this->url_name, $link_back_param)->with(['error','Data tidak ditemukan']);
            }
            $is_save=0;
            if($model->delete()){
                $is_save=1;
            }
            
            if($is_save){
                DB::commit();
                $this->generateEnv();
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
