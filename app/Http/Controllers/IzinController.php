<?php

namespace App\Http\Controllers;

use App\Services\GlobalService;
use App\Services\RefKaryawanService;
use Illuminate\Http\Request;
use App\Services\IzinService;
use App\Services\MasterPengajuanService;


class IzinController extends Controller
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService, $izinService;
    protected $masterPengajuanService;
    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;
        $this->izinService = new IzinService;
        $this->masterPengajuanService = new MasterPengajuanService;

        $this->title = 'Izin';
        $this->breadcrumbs = [
            ['title' => 'Pengajuan', 'url' => url('/') . "/sub-menu?type=7"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->refKaryawanService = new RefKaryawanService;
    }

    function actionIndex(Request $request){
        $user_auth = (new \App\Http\Traits\AuthFunction)->getUser();
        $role = $user_auth->group_user[0] ?? null;

        $form_filter_text = $request->form_filter_text ?? '';

        $paramater = [
            'search' => $form_filter_text,
            'is_super_admin' => false
        ];

        if ($role === 'group_super_admin') {

            $paramater['is_super_admin'] = true;

        } else {

            $get_karyawan = $this->masterPengajuanService
                ->getKaryawan($user_auth->id_user);

            $paramater['id_karyawan'] = $get_karyawan->id_karyawan;
            $paramater['id_ruangan']  = $get_karyawan->id_ruangan;
            $paramater['id_jabatan']  = $get_karyawan->id_jabatan;
        }

        $list_data = $this->izinService
            ->getListData($paramater)
            ->paginate($request->per_page ?? 10);
    
        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data' => $list_data
        ];

        return view('pengajuan.izin.index', $parameter_view);
    }

    public function actionFormCreate() {
        $user_auth=(new \App\Http\Traits\AuthFunction)->getUser();
        $role = $user_auth->group_user[0] ?? null;

        if($role != 'group_super_admin' ) {
            $user_auth=(new \App\Http\Traits\AuthFunction)->getUser()->data_user_sistem;
            $get_karyawan = $this->izinService->getKaryawan($user_auth->id_karyawan);
        }
        
        $parameter_view = [
            'action_form' => 'izin/create',
            'model' => !empty($get_karyawan) ? $get_karyawan : [],
        ];

        return view('pengajuan.izin.form', $parameter_view);
    }

    public function actionCreate(Request $request) {
        $data_req = $request->all();

        $message_default = [
            'success' => 'Izin berhasil diajukan',
            'error' =>'Izin tidak berhasil diajukan',
        ];


        $link_back_redirect = $this->url_name;
        $link_back_param = [];
        $result = $this->izinService->insert($data_req);

        if($result) {
            $pesan = ['success', $message_default['success'], 2];
        }else {
            $pesan = ['error', $message_default['error'], 3];
        }    

        return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0] => $pesan[1]]);
            
    }

    public function actionUpdate(Request $request) {
        
    }

    public function actionDelete(Request $request) {
        
    }
}
