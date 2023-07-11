<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\RefJadwalService;
use App\Services\DataAbsensiKaryawanService;

class AbsensiKaryawanController extends \App\Http\Controllers\MyAuthController
{

    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;
    public $dataAbsensiKaryawanService,$refJadwalService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Data Absensi';
        $this->breadcrumbs = [
            ['title' => 'Mesin Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->dataAbsensiKaryawanService = new DataAbsensiKaryawanService;
        $this->refJadwalService = new RefJadwalService;
    }

    function actionIndex(Request $request){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        $list_data=$this->get_data_by_jadwal_rutin($request);

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data'=>$list_data
        ];

        return view($this->part_view . '.index', $parameter_view);
    }


    function get_data_by_jadwal_rutin($request){
        $form_filter_text=!empty($request->form_filter_text) ? $request->form_filter_text : '';
        $filter_date_start=!empty($request->filter_date_start) ? $request->filter_date_start : date('Y-m-d');
        $filter_date_end=!empty($request->filter_date_end) ? $request->filter_date_end : date('Y-m-d');

        $filter_id_jabatan=!empty($request->filter_id_jabatan) ? $request->filter_id_jabatan : '';
        $filter_id_departemen=!empty($request->filter_id_departemen) ? $request->filter_id_departemen : '';
        $filter_id_ruangan=!empty($request->filter_id_ruangan) ? $request->filter_id_ruangan : '';
        
        $filter_status_absensi=!empty($request->filter_status_absensi) ? $request->filter_status_absensi : '';
        $filter_cara_absensi=!empty($request->filter_cara_absensi) ? $request->filter_cara_absensi : '';
        
        $paramater_data_karyawan_rutin=[
            'search'=>$form_filter_text,
            'id_jenis_jadwal_tmp'=>1,
        ];

        if(!empty($filter_id_jabatan)){
            $paramater_data_karyawan_rutin['id_jabatan']=$filter_id_jabatan;
        }

        if(!empty($filter_id_departemen)){
            $paramater_data_karyawan_rutin['id_departemen']=$filter_id_departemen;
        }

        $list_data_karyawan_rutin = $this->dataAbsensiKaryawanService->getListKaryawanByJadwal($paramater_data_karyawan_rutin, 1)->select(DB::raw('group_concat(id_karyawan) as id_karyawan'),DB::raw('group_concat(id_user) as id_user'))->first();
        
        $parameter_first=[
            'tanggal'=>[$filter_date_start,$filter_date_end],
            'list_id_karyawan'=>!empty($list_data_karyawan_rutin->id_karyawan) ? $list_data_karyawan_rutin->id_karyawan : '',
            'list_id_user'=>!empty($list_data_karyawan_rutin->id_user) ? $list_data_karyawan_rutin->id_user : '',
        ];
        $list_absensi=$this->dataAbsensiKaryawanService->getDataAbsensi($parameter_first,1)->get();

        $data_jadwal_rutin=[];
        $get_jadwal_rutin = $this->refJadwalService->getList(['ref_jadwal.id_jenis_jadwal'=>1], 1)->get();
        if(!empty($get_jadwal_rutin)){
            foreach($get_jadwal_rutin as $val){
                $data_jadwal_rutin[$val->id_jadwal]=(object)$val->getAttributes();
            }
        }

        $data_absensi=[];
        foreach($list_absensi as $value){
            $hasil=$this->dataAbsensiKaryawanService->proses_absensi_rutin($get_jadwal_rutin,$value);
            $tgl_filter=trim($value->tanggal);

            if(empty($data_absensi[$tgl_filter][$value->id_user]['data_karyawan'])){
                $paramter_data=(object)[
                    'id_user'=>!empty($value->id_user) ? $value->id_user : '',
                    'username'=>!empty($value->username) ? $value->username : '',
                    'id_karyawan'=>!empty($value->id_karyawan) ? $value->id_karyawan : '',
                    'nm_karyawan'=>!empty($value->nm_karyawan) ? $value->nm_karyawan : '',
                    'alamat'=>!empty($value->alamat) ? $value->alamat : '',
                    'nip'=>!empty($value->nip) ? $value->nip : '',
                    'id_jabatan'=>!empty($value->id_jabatan) ? $value->id_jabatan : '',
                    'nm_jabatan'=>!empty($value->nm_jabatan) ? $value->nm_jabatan : '',
                    'id_departemen'=>!empty($value->id_departemen) ? $value->id_departemen : '',
                    'nm_departemen'=>!empty($value->nm_departemen) ? $value->nm_departemen : '',
                    'id_ruangan'=>!empty($value->id_ruangan) ? $value->id_ruangan : '',
                    'nm_ruangan'=>!empty($value->nm_ruangan) ? $value->nm_ruangan : '',
                ];
                $data_absensi[$tgl_filter][$value->id_user]['data_karyawan']=$paramter_data;
            }

            if(empty($data_absensi[$tgl_filter][$value->id_user]['data_jadwal'])){
                $data_absensi[$tgl_filter][$value->id_user]['data_jadwal']=$data_jadwal_rutin;
            }

            if(empty($data_absensi[$tgl_filter][$value->id_user]['absensi'][$hasil->id_jadwal])){
                $data_absensi[$tgl_filter][$value->id_user]['absensi'][$hasil->id_jadwal]=$hasil;
            }
        }
        return $data_absensi;
    }
}