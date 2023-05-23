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

        $this->title = 'Data User Mesin';
        $this->breadcrumbs = [
            ['title' => 'Mesin Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->userMesinTmpService = new UserMesinTmpService;
    }

    function actionIndex(Request $request){

        $id_mesin_absensi = !empty($request->filter_id_mesin) ? $request->filter_id_mesin : '';

        if(!empty($id_mesin_absensi)){
            $data_mesin=(new \App\Models\RefMesinAbsensi)->where(['id_mesin_absensi'=>$id_mesin_absensi])->first();
        }

        $list_data=[];

        if(!empty($request->searchbymesin)){
            if(!empty($data_mesin)){
                $hasil=$this->proses_tmp($data_mesin);
            }
        }

        if(!empty($request->searchbydb)){
            $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';

            $paramater_column = [
                'search' => $form_filter_text
            ];
        }

        $list_data=[];
        $paramater = [];
        if(!empty($data_mesin)){
            $paramater = [
                'user_mesin_tmp.id_mesin_absensi' => $data_mesin->id_mesin_absensi
            ];

            if(!empty($paramater_column)){
                $paramater=array_merge($paramater,$paramater_column);
            }
            $list_data = $this->userMesinTmpService->getList($paramater, 1)->paginate(!empty($request->per_page) ? $request->per_page : 30);
        }


        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data' => $list_data,
            'data_mesin'=> !empty($data_mesin) ? $data_mesin : []
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
            if($get_user){
                $get_user=json_decode($get_user);

                (new \App\Models\UserMesinTmp)->where(['id_mesin_absensi'=>$data_mesin->id_mesin_absensi])->delete();

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

                    $model_user=(new \App\Models\RefUserInfo())->where(['id_mesin_absensi'=>$id_mesin_absensi,'id_user'=>$value_user->id])->first();
                    if(empty($model_user)){
                        $model_user=(new \App\Models\RefUserInfo());
                        $model_user->id_mesin_absensi=$id_mesin_absensi;
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
                                $model_finger->id_mesin_absensi=$id_mesin_absensi;
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
                if($jml_save_user>0 && $jml_save_finger>0){
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
}