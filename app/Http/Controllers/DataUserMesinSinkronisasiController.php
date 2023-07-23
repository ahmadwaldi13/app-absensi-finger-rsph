<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\UserMesinTmpService;

class DataUserMesinSinkronisasiController extends \App\Http\Controllers\MyAuthController
{

    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;
    public $userMesinTmpService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Sikronisasi Data Mesin & Database';
        $this->breadcrumbs = [
            ['title' => 'Mesin Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->userMesinTmpService = new UserMesinTmpService;
    }

    function actionIndex(Request $request){

        if($request->isMethod('post')){
            return $this->proses_data($request);
        }

        $paramater_search=[];
        if(!empty($request->searchbymesin)){
            $id_mesin_absensi = !empty($request->filter_id_mesin) ? $request->filter_id_mesin : '';
            if(!empty($id_mesin_absensi)){
                $data_mesin=(new \App\Models\RefMesinAbsensi)->where(['id_mesin_absensi'=>$id_mesin_absensi])->first();
            }

            if(!empty($data_mesin)){
                $mesin=(new \App\Services\MesinFinger($data_mesin->ip_address));
                $connect=$mesin->connect();
                $connect=!empty($connect[2]) ? $connect[2] : '';
                if($connect==2){
                    return redirect()->route($this->url_name, [])->with(['error' => 'Maaf Mesin tidak connect']);
                }
                
                $hasil=$this->proses_tmp($data_mesin);
                $check_hasil=!empty($hasil[0]) ? $hasil[0] : '';
                if($check_hasil=='error'){
                    return redirect()->route($this->url_name, [])->with(['error' => $hasil[1]]);
                }
            }
        }

        if(!empty($request->searchbydb)){
            $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';
            $filter_id_mesin_asal = !empty($request->filter_id_mesin_asal) ? $request->filter_id_mesin_asal : '';
            $filter_simpan_db = !empty($request->filter_simpan_db) ? $request->filter_simpan_db : '';
            $filter_duplicate_data = !empty($request->filter_duplicate_data) ? $request->filter_duplicate_data : '';

            $paramater_search = [
                'search' => $form_filter_text
            ];

            $id_mesin_absensi = !empty($filter_id_mesin_asal) ? $filter_id_mesin_asal : '';
            if(!empty($id_mesin_absensi)){
                $data_mesin=(new \App\Models\RefMesinAbsensi)->where(['id_mesin_absensi'=>$id_mesin_absensi])->first();
                $hasil_ip_asal=!empty($data_mesin->ip_address) ? $data_mesin->ip_address : '';
                $paramater_search['id_mesin_absensi']=$id_mesin_absensi;
            }

            if(!empty($filter_simpan_db)){
                $hasil=0;
                if($filter_simpan_db==1){
                    $hasil=1;
                }
                $paramater_search['db']=$hasil;
            }

            if(!empty($filter_duplicate_data)){
                $hasil=0;
                if($filter_duplicate_data==2){
                    $hasil=1;
                }
                $paramater_search['where_and_or']=['duplicate_id'=>$hasil,'duplicate_name'=>$hasil ];
            }
        }

        $list_data = $this->userMesinTmpService->getList($paramater_search, 1)->paginate(!empty($request->per_page) ? $request->per_page : 30);

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data' => $list_data,
            'data_mesin'=> !empty($data_mesin) ? $data_mesin : [],
            'hasil_ip_asal'=>!empty($hasil_ip_asal) ? $hasil_ip_asal : '',
        ];

        return view($this->part_view . '.index', $parameter_view);
    }

    private function proses_tmp($data_mesin){
        DB::beginTransaction();
        $pesan = [];
        $message_default = [
            'success' => !empty($kode) ? 'Data berhasil diubah' : 'Data berhasil disimpan',
            'error' => !empty($kode) ? 'Data tidak berhasil diubah' : 'Data berhasil disimpan'
        ];

        try {

            $is_save = 0;
            $mesin=(new \App\Services\MesinFinger($data_mesin->ip_address));
            $get_user=$mesin->get_user();
            $check_hasil=!empty($get_user[0]) ? $get_user[0] : '';
            if($check_hasil=='error'){
                return ['error',$get_user[1]];
            }
            if($get_user){
                $get_user=json_decode($get_user);
                
                (new \App\Models\UserMesinTmp)->truncate();
                
                $jml_save=0;
                foreach($get_user as $value){
                    $model = (new \App\Models\UserMesinTmp);
                    $model->id_mesin_absensi = $data_mesin->id_mesin_absensi;
                    $model->id_user = $value->id;
                    $model->name = $value->name;
                    $model->group = $value->group;
                    $model->privilege = $value->privilege;

                    if ($model->save()) {
                        $jml_save++;
                    }
                }

                if($jml_save>0){
                    $is_save = 1;
                }
            }

            if ($is_save) {
                DB::commit();
                $pesan = ['success', $message_default['success'], 2];
            } else {
                DB::rollBack();
                $pesan = ['error', $message_default['error'], 3];
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->errorInfo[1] == '1062') {
            }
            $pesan = ['error', $message_default['error'], 3];
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan = ['error', $message_default['error'], 3];
        }

        return $pesan;
    }

    function actionSinkron(Request $request){

        $req = $request->all();
        $id_mesin_absensi = !empty($req['key']) ? $req['key'] : '';
        DB::beginTransaction();
        $pesan = [];
        $link_back_redirect=$this->url_name;
        $link_back_param = ['filter_id_mesin' => $id_mesin_absensi];
        $message_default = [
            'success' => 'Data berhasil di proses',
            'error' => 'Data tidak berhasil di proses'
        ];

        try {
            $data_mesin=(new \App\Models\RefMesinAbsensi)->where(['id_mesin_absensi'=>$id_mesin_absensi])->first();

            $mesin=(new \App\Services\MesinFinger($data_mesin->ip_address));
            $get_user=$mesin->get_user();
            if($get_user){
                $get_user=json_decode($get_user);
                $jml_save_user=0;
                $jml_save_finger=0;
                foreach($get_user as $value_user){
                    $data_item=[];
                    $data_item=[
                        'name'=>$value_user->name,
                        'password'=>$value_user->password,
                        'group'=>$value_user->group,
                        'privilege'=>$value_user->privilege,
                        'card'=>$value_user->card,
                        'pin2'=>$value_user->pin2,
                        'tz1'=>$value_user->tz1,
                        'tz2'=>$value_user->tz2,
                        'tz3'=>$value_user->tz3,
                    ];

                    $model_user=(new \App\Models\RefUserInfo())->where(['id_user'=>$value_user->id])->first();
                    if(empty($model_user)){
                        $model_user=(new \App\Models\RefUserInfo());
                        $model_user->id_user=$value_user->id;
                    }
                    $model_user->set_model_with_data($data_item);
                    if($model_user->save()){
                        $jml_save_user++;
                        
                        $get_user_finger=$mesin->get_user_tamplate($value_user->id);
                        if($get_user_finger){
                            (new \App\Models\RefUserInfoDetail())->where(['id_user'=>$value_user->id])->delete();
                            foreach($get_user_finger as $value_finger){
                                $data_item=[];
                                $data_item=(array)$value_finger;
                                $data_item['finger']=$data_item['template'];
                                unset($data_item['template']);

                                $model_finger=(new \App\Models\RefUserInfoDetail());
                                $model_finger->id_user=$value_user->id;

                                $model_finger->set_model_with_data($data_item);
                                
                                if($model_finger->save()){
                                    $jml_save_finger++;
                                }
                            }
                        }
                        
                    }
                }

                $is_save=0;
                if($jml_save_user>0){
                    $is_save=1;
                }

                if ($is_save) {
                    DB::commit();
                    $pesan = ['success', $message_default['success'], 2];
                }else{
                    DB::rollBack();
                    $pesan = ['error', $message_default['error'], 3];
                }
            }else{
                $pesan = ['success', 'Tidak ada yang di proses' , 2];
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->errorInfo[1] == '1062') {
            }
            $pesan = ['error', $message_default['error'], 3];
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan = ['error', $message_default['error'], 3];
        }
        return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0] => $pesan[1]]);
    }

    private function proses_data($request){
        $req = $request->all();
        $kode = !empty($req['pk']) ? $req['pk'] : '';
        $exp=explode('@',$kode);
        $id_mesin_absensi=!empty($exp[0]) ? $exp[0] : '';
        $id_user=!empty($exp[1]) ? $exp[1] : '';
        $type=!empty($exp[2]) ? $exp[2] : '';
        $data_change = !empty($req['value']) ? $req['value'] : '';

        DB::beginTransaction();
        $pesan = [];

        $message_default = [
            'success' => 'Data berhasil diubah',
            'error' => 'Data tidak berhasil diubah'
        ];

        if ($request->ajax()) {
            try {
                $model=( new \App\Models\UserMesinTmp() )->where('id_mesin_absensi','=',$id_mesin_absensi)->where('id_user','=',$id_user)->first();
                if(!empty($model)){
                    if($type=='id'){
                        $model->id_user=$data_change;
                    }
                    if($type=='name'){
                        $model->name=$data_change;
                    }

                    if ($model->save()) {
                        $is_save = 1;
                    }
                }else{
                    $is_save=0;
                }

                if (!empty($is_save)) {
                    DB::commit();
                    $pesan = ['success', $message_default['success'], 2];
                } else {
                    DB::rollBack();
                    $pesan = ['error', $message_default['error'], 3];
                }
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                if ($e->errorInfo[1] == '1062') {
                }
                $pesan = ['error', $message_default['error'], 3];
            } catch (\Throwable $e) {
                DB::rollBack();
                $pesan = ['error', $message_default['error'], 3];
            }

            return response()->json($pesan);
        }
    }
}