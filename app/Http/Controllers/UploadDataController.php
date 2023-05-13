<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\MesinFinger;
use App\Classes\SoapMesinFinger;
use App\Services\UserMesinTmpService;
use App\Services\RefKaryawanService;
use Illuminate\Support\Facades\DB;

class UploadDataController extends Controller
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService, $mesinFinger, $soapMesinFinger, $refKaryawanService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Upload Data';
        $this->breadcrumbs = [
            ['title' => 'Mesin Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->mesinFinger = new MesinFinger;
        $this->soapMesinFinger = new SoapMesinFinger;
        $this->refKaryawanService = new RefKaryawanService;
    }

    function actionIndex(Request $request){
        if($request->isMethod('get')){
            return $this->index($request);
        }

        if($request->isMethod('post')){
            return $this->actionCreate($request);
        }
    }

    public function index(Request $request)
    {
        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'action_form' => 'setting-dokterpj-ranap',
        ];

        return view($this->part_view . '.index', $parameter_view);
    }

    function getListKaryawanMasterForm(Request $request)
    {
        $hasil_data = [];
        try {
            $form_filter_text = '';
            $search = !empty($request->search) ? $request->search : '';
            $filter = !empty($search['value']) ? $search['value'] : '';
            if ($filter) {
                $filter = json_decode($filter);
                if (!empty($filter)) {
                    foreach ($filter as $value) {
                        if (trim(strtolower($value->name)) == 'form_filter_text') {
                            $form_filter_text = $value->value;
                        }
                    }
                }
            }

            $start_page = !empty($request->start) ? $request->start : 0;
            $end_page = !empty($request->end) ? $request->end : 8;

            $paramater = [
                'search' => $form_filter_text,
            ];

            $data_tmp = (new \App\Services\RefKaryawanService())
                ->getList($paramater, 1)
                ->offset($start_page)
                ->limit($end_page)
                ->get();

            $data_count = (new \App\Services\RefKaryawanService())->getList($paramater, 1)->count();

            if (!empty($data_tmp)) {
                foreach ($data_tmp as $value) {
                    $data = ["<input class='form-check-input checked_me' type='checkbox' data-kode='" . $value->id_karyawan . "'>", !empty($value->id_karyawan) ? $value->id_karyawan : '', !empty($value->nm_karyawan) ? $value->nm_karyawan : '', !empty($value->alamat) ? $value->alamat : ''];
                    $hasil_data[] = $data;
                }
            }
        } catch (\Throwable $e) {
            $hasil_data = [];
        }

        return [
            'data' => !empty($hasil_data) ? $hasil_data : [],
            'recordsTotal' => !empty($data_count) ? $data_count : 0,
            'recordsFiltered' => !empty($data_count) ? $data_count : 0,
        ];
    }

    private function form(Request $request)
    {
        $id_mesin_absensi = !empty($request->filter_id_mesin) ? $request->filter_id_mesin : '';

        $kode = !empty($request->id_karyawan) ? $request->id_karyawan : null;
        if(!empty($id_mesin_absensi)){
            $data_mesin=(new \App\Models\RefMesinAbsensi)->where(['id_mesin_absensi'=>$id_mesin_absensi])->first();
        }
        
        $model = (new \App\Models\RefKaryawan)->where('id_karyawan', '=', $kode)->first();

        if ($model) {
            $action_form = $this->part_view;
            $list_item =  $this->refKaryawanService->getListdpjp_pasien($kode);
            dd($list_item);
            $item_list_terpilih = [];
            if ($list_item) {
                foreach ($list_item as $value) {
                    $item_list_terpilih[$value->id_karyawan] = [
                        'data' => ['', $value->id_karyawan, $value->nm_karyawan, $value->alamat],
                    ];
                }
            }

            if ($item_list_terpilih) {
                $item_list_terpilih = json_encode($item_list_terpilih);
            }
            
        } else {
            $action_form = $this->part_view;
            $model = new \App\Models\RefKaryawan;
        }

        $dataPasien['tgl_rawat'] = substr($kode, 0, 10);
        $parameter_view = [
            'no_rawat' => $kode,
            'dataPasien'=> $dataPasien,
            'action_form' => $action_form,
            'item_list_terpilih' => !empty($item_list_terpilih) ? $item_list_terpilih : '',
            'data_mesin'=> !empty($data_mesin) ? $data_mesin : [],
        ];
        $get_request = $request->all();
        if (!empty($get_request['_token'])) {
            unset($get_request['_token']);
        }
        $parameter_view = array_merge($parameter_view, $get_request);

        return view('upload-data.form', $parameter_view);
    }

    function actionCreate(Request $request)
    {
        if ($request->isMethod('get')) {
            return $this->form($request)->render();
        }
        if ($request->isMethod('post')) {
            return $this->proses($request);
        }
    }

    private function proses($request){
        $id_mesin_absensi = !empty($request->filter_id_mesin) ? $request->filter_id_mesin : '';

        $kode = !empty($request->id_karyawan) ? $request->id_karyawan : null;
        if(!empty($id_mesin_absensi)){
            $data_mesin=(new \App\Models\RefMesinAbsensi)->where(['id_mesin_absensi'=>$id_mesin_absensi])->first();
        }
        $mesin=(new \App\Services\MesinFinger($data_mesin->ip_address));
        $item_list_terpilih=!empty($request->item_list_terpilih) ? $request->item_list_terpilih : '';
        $item_list_terpilih=json_decode($item_list_terpilih);
        $item_list_terpilih=(array)$item_list_terpilih;

            if($item_list_terpilih){
                $jml_save=0;
                foreach($item_list_terpilih  as $key => $value){
                    $data_save=[
                        'id'=>$key,
                        'nama'=>$value->data[2]
                    ];  

                    $upload = $get_user=$mesin->get_user_upload('',$data_save);
                }
            }

        $jml_save=0;
        DB::beginTransaction();
        $pesan = [];
        $message_default = [
            'success' => !empty($kode) ? 'Data berhasil diubah' : 'Data berhasil disimpan',
            'error' => !empty($kode) ? 'Data tidak berhasil diubah' : 'Data berhasil disimpan'
        ];

        try {
            
            // $id_mesin='';
            $is_save = 0;
            $mesin=(new \App\Services\MesinFinger($data_mesin->ip_address));
            $get_user=$mesin->get_user_upload();
            // $get_user=$mesin->get_user_upload($data_save, $id_mesin);
            dd($get_user);
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

        // return $pesan;
    }


    function ajax(Request $request)
    {
        $get_req = $request->all();
        
        if ($get_req['action'] == 'list_karyawan_master_form') {
            $hasil = $this->getListKaryawanMasterForm($request);
            if ($request->ajax()) {
                $return = '';
                if ($hasil) {
                    $return = json_encode($hasil);
                }
                return $return;
            }
            return $hasil;
        }
    }
}
