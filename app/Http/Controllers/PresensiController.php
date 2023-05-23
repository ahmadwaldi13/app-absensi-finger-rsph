<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\MesinFinger;
use App\Classes\SoapMesinFinger;
use App\Services\UserMesinTmpService;
use App\Services\UserPresensiService;
use Illuminate\Support\Facades\DB;

class PresensiController extends \App\Http\Controllers\MyAuthController
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService, $mesinFinger, $soapMesinFinger, $userPresensiService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Data Presensi';
        $this->breadcrumbs = [
            ['title' => 'Presensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->mesinFinger = new MesinFinger;
        $this->soapMesinFinger = new SoapMesinFinger;
        // $this->userMesinTmpService = new UserMesinTmpService;
        $this->userPresensiService = new UserPresensiService;
    }

    function actionIndex(Request $request){

        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';
        $filter_id_mesin = !empty($request->filter_id_mesin) ? $request->filter_id_mesin : '';
        $filter_id_jabatan = !empty($request->filter_id_jabatan) ? $request->filter_id_jabatan : '';
        $filter_id_departemen = !empty($request->filter_id_departemen) ? $request->filter_id_departemen : '';

        $paramater=[
            'search' => $form_filter_text
        ];

        if(!empty($filter_id_mesin)){
            $paramater['utama.id_mesin_absensi']=$filter_id_mesin;
        }

        if(!empty($filter_id_jabatan)){
            $paramater['id_jabatan']=$filter_id_jabatan;
        }

        if(!empty($filter_id_departemen)){
            $paramater['id_departemen']=$filter_id_departemen;
        }
    

        $list_data = $this->userPresensiService->getList($paramater, 1)->paginate(!empty($request->per_page) ? $request->per_page : 30);

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data' => $list_data
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
            $get_user=$mesin->get_user_presensi();
            if($get_user){
                $get_user=json_decode($get_user);

                (new \App\Models\UserPresensi)->where(['id_mesin_absensi'=>$data_mesin->id_mesin_absensi])->delete();

                $jml_save=0;
                foreach($get_user as $value){
                    $model = (new \App\Models\UserPresensi);
                    $model->id_mesin_absensi = $data_mesin->id_mesin_absensi;
                    $model->id_user = $value->id;
                    $model->datetime = $value->datetime;
                    $model->verified = $value->verified;
                    $model->status = $value->status;

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
