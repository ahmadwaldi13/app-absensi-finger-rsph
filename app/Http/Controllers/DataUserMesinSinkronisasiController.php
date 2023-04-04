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
            $get_user=$mesin->get_user_dummy();
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
}