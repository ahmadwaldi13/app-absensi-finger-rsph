<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\UserMesinTmpService;

class DataUserMesinCopyController extends \App\Http\Controllers\MyAuthController
{

    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;
    public $userMesinTmpService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Copy Data User ke Mesin';
        $this->breadcrumbs = [
            ['title' => 'Mesin Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->userMesinTmpService = new UserMesinTmpService;
    }

    function actionIndex(Request $request){

        if($request->isMethod('post')){
            return $this->proses($request);
        }

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
        ];

        return view($this->part_view . '.index', $parameter_view);
    }

    private function proses($request){
        $req = $request->all();
        $id_mesin_tujuan = !empty($req['id_mesin_tujuan']) ? $req['id_mesin_tujuan'] : '';
        
        $pesan = [];
        $link_back_param = [];
        $message_default = [
            'success' => 'Data berhasil disinkronisasi',
            'error' => 'Maaf Data tidak berhasil disinkronisasi'
        ];

        try {

            $get_data=( new \App\Models\RefUserInfo() )->orderBy('id_user','ASC')->get();
            if(empty($get_data[0])){
                return redirect()->route($this->url_name, $link_back_param)->with(['error'=>'Data tidak ditemukan']);
            }

            $data_mesin_tujuan=(new \App\Models\RefMesinAbsensi)->where(['id_mesin_absensi'=>$id_mesin_tujuan])->first();
            if(empty($data_mesin_tujuan)){
                return redirect()->route($this->url_name, $link_back_param)->with(['error'=>'Data Mesin Tujuan Tidak ditemukan']);
            }

            $model_mesin_tujuan=(new \App\Services\MesinFinger($data_mesin_tujuan->ip_address));
            $connect_tujuan=$model_mesin_tujuan->connect();
            $connect_tujuan=!empty($connect_tujuan[2]) ? $connect_tujuan[2] : '';
            if($connect_tujuan==2){
                return redirect()->route($this->url_name, [])->with(['error' => 'Maaf Mesin tujuan tidak connect']);
            }

            $set_waktu=$model_mesin_tujuan->set_waktu_mesin();
            $check_hasil=!empty($set_waktu[1]) ? $set_waktu[1] : '';
            if($check_hasil==2){
                return redirect()->route($this->url_name, [])->with(['error' => 'Maaf Mesin tidak dapat di set waktu']);
            }

            $get_user_mesin_tujuan=$model_mesin_tujuan->get_user();
            $check_hasil=!empty($get_user_mesin_tujuan[0]) ? $get_user_mesin_tujuan[0] : '';
            if($check_hasil!='error'){
                $get_user_mesin_tujuan=json_decode($get_user_mesin_tujuan);
                foreach($get_user_mesin_tujuan as $value){
                    $model_mesin_tujuan->delete_finger_to_mesin($value);
                    $model_mesin_tujuan->delete_user_to_mesin($value);
                }
            }
            
            $jml_user=0;
            $jml_user_detail=0;
            foreach($get_data as $user){
                $hasil_user=$model_mesin_tujuan->upload_user_to_mesin($user);
                $check_hasil=!empty($hasil_user[1]) ? $hasil_user[1] : '';
                if($check_hasil==1){
                    $jml_user++;

                    $get_user_detail=( new \App\Models\RefUserInfoDetail() )->where('id_user','=', $user->id_user)->orderBy('id_user','ASC')->get();
                    if(!empty($get_user_detail[0])){
                        foreach($get_user_detail as $user_detail){
                            $hasil_user=$model_mesin_tujuan->upload_user_finger_to_mesin($user_detail);
                            $check_hasil=!empty($hasil_user[1]) ? $hasil_user[1] : '';
                            if($check_hasil==1){
                                $model_mesin_tujuan->refresh_db_mesin();
                                $jml_user_detail++;
                            }
                        }
                    }
                }
            }

            $is_save = 0;
            if(!empty($jml_user)){
                $is_save=1;
            }

            if ($is_save) {
                $link_back_param = $this->clear_request($link_back_param, $request);
                $pesan = ['success', $message_default['success'], 2];
            } else {
                $pesan = ['error', $message_default['error'], 3];
            }
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == '1062') {
            }
            $pesan = ['error', $message_default['error'], 3];
        } catch (\Throwable $e) {
            $pesan = ['error', $message_default['error'], 3];
        }

        return redirect()->route($this->url_name, $link_back_param)->with([$pesan[0] => $pesan[1]]);
    }
}