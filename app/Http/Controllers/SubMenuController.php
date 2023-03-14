<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    function listAkses($type){

        $menu='';
        $list_menu='';
        if($type){
            $menu_permission=[];

            if($type==1){
                $menu_permission=[
                    [
                        'title'=>'Master Verifikasi Permintaan Barang',
                        'key'=>'master-validasi-permintaan-barang',
                        'url'=>url('/')."/master-validasi-permintaan-barang",
                    ],
                    [
                        'title'=>'Kode Barang Non Medis',
                        'key'=>'kode-barang-non-medis-penunjang',
                        'url'=>url('/')."/kode-barang-non-medis-penunjang",
                    ],
                    [
                        'title'=>'Barang Non Medis',
                        'key'=>'barang-non-medis',
                        'url'=>url('/')."/barang-non-medis",
                    ],
                    [
                        'title'=>'Permintaan Barang Non Medis',
                        'key'=>'permintaan-barang-non-medis',
                        'url'=>url('/')."/permintaan-barang-non-medis",
                    ],
                    [
                        'title'=>'Stok Opname Barang Non Medis',
                        'key'=>'stokopname-barang-non-medis',
                        'url'=>url('/')."/stokopname-barang-non-medis",
                    ],
                    [
                        'title'=>'Verifikasi Barang Non Medis',
                        'key'=>'verifikasi-permintaan-barang-non-medis',
                        'url'=>url('/')."/verifikasi-permintaan-barang-non-medis",
                    ],
                    [
                        'title'=>'Verifikasi Inventori Barang Non Medis',
                        'key'=>'verifikasi-inventori-permintaan-barang-non-medis',
                        'url'=>url('/')."/verifikasi-inventori-permintaan-barang-non-medis",
                    ],
                ];
            }

            if($type==2){
                $menu_permission=[
                    [
                        'title'=>'User Group',
                        'key'=>'user-group-app',
                        'url'=>url('/')."/user-group-app",
                    ],
                    [
                        'title'=>'User Akses',
                        'key'=>'user-akses',
                        'url'=>url('/')."/user-akses",
                    ],

                ];
            }

            if($type==3){
                $menu_permission=[
                    [
                        'title'=>'Daftar List Display Monitor',
                        'key'=>'daftar-list-display-monitor',
                        'url'=>url('/')."/daftar-list-display-monitor",
                    ],
                    [
                        'title'=>'Setting Variabel Aplikasi',
                        'key'=>'setting-app-variabel',
                        'url'=>url('/')."/setting-app-variabel",
                    ],
                    [
                        'title'=>'Kelola Monitor Poliklinik',
                        'key'=>'setting-monitor-poli',
                        'url'=>url('/')."/setting-monitor-poli",
                    ],
                    [
                        'title'=>'Setting API Aplikasi',
                        'key'=>'setting-api-aplikasi',
                        'url'=>url('/')."/setting-api-aplikasi",
                    ],
                ];
            }

            if ($type == 4) {
                $menu_permission = [
                    [
                        'title' => 'Master Berkas Digital ',
                        'key' => 'berkas-digital-master-berkas',
                        'url' => url('/') . "/berkas-digital-master-berkas",
                    ],
                    [
                        'title' => 'Setting Berkas Klaim',
                        'key' => 'berkas-digital-berkas-klaim',
                        'url' => url('/') . "/berkas-digital-berkas-klaim",
                    ],
                    [
                        'title' => 'Berkas Digital',
                        'key' => 'berkas-digital',
                        'url' => url('/') . "/berkas-digital?start=" . date('Y-m-d') . "&end=" . date('Y-m-d'),
                    ],
                ];
            }

            if($type == 5){
                $menu_permission=[
                    [
                        'title'=>'Antrian Poliklinik',
                        'key'=>'antrian-poliklinik-petugas',
                        'url' => url('/') . "/antrian-poliklinik-petugas",
                    ],
                    [
                        'title'=>'Antrian Farmasi',
                        'key'=>'antrian-farmasi-petugas',
                        'url' => url('/') . "/antrian-farmasi-petugas?start=" . date('Y-m-d') . "&end=" . date('Y-m-d'),
                    ],
                ];
            }

            if($type == 6){
                $menu_permission=[
                    [
                        'title'=>'Setting Tarif Grouper',
                        'key'=>'setting-tarif-buffer',
                        'url' => url('/') . "/setting-tarif-buffer",
                    ],
                    [
                        'title'=>'Master Diagnosa',
                        'key'=>'master-data-diagnosa',
                        'url' => url('/') . "/master-data-diagnosa",
                    ],
                    [
                        'title'=>'Data Pasien',
                        'key'=>'tarif-grouper-pasien',
                        'url' => url('/') . "/tarif-grouper-pasien",
                    ],
                ];
            }

            if ($type == 7) {
                $menu_permission = [
                    [
                        'title' => 'Soap Farmasi',
                        'key' => 'soap-farmasi-berkas',
                        'url' => url('/') . "/soap-farmasi-berkas",
                    ]
                ];
            }

            if($type==8){
                $menu_permission=[
                    [
                        'title'=>'Antrian Online Perhari',
                        'key'=>'antrol-pertanggal',
                        'url'=>url('/')."/antrol-pertanggal",
                    ],
                    [
                        'title'=>'Antrean dan TaskID Manual',
                        'key'=>'taskid-bpjs-manual',
                        'url'=>url('/')."/taskid-bpjs-manual",
                    ],
                    [
                        'title'=>'Jadwal Dokter HFIS',
                        'key'=>'jadwal-dokter-hfis',
                        'url'=>url('/')."/jadwal-dokter-hfis",
                    ],
                    [
                        'title'=>'Dashboard Antrol BPJS Perhari',
                        'key'=>'dashboard-antrol-perhari',
                        'url'=>url('/')."/dashboard-antrol-perhari",
                    ],
                    [
                        'title'=>'Dashboard Antrol BPJS Perbulan',
                        'key'=>'dashboard-antrol-perbulan',
                        'url'=>url('/')."/dashboard-antrol-perbulan",
                    ],
                    [
                        'title'=>'TaskID Mobile JKN',
                        'key'=>'taskid-antrol',
                        'url'=>url('/')."/taskid-antrol",
                    ]
                ];
            }

            if($type==9){
                $menu_permission=[
                    [
                        'title'=>'Billing Pasien Ralan',
                        'key'=>'billing-list-tagihan-pasien-ralan',
                        'url'=>url('/')."/billing-list-tagihan-pasien-ralan",
                    ],
                    [
                        'title'=>'Billing Pasien Ranap',
                        'key'=>'billing-list-tagihan-pasien-ranap',
                        'url'=>url('/')."/billing-list-tagihan-pasien-ranap",
                    ],
                ];
            }

            if($menu_permission){
                $list_menu=[];
                $menu=(new \App\Http\Traits\AuthFunction)->checkMenuAkses($menu_permission);
                if($menu){
                    foreach($menu as $value){
                        $value=(object)$value;
                        $list_menu[]=$value->key;
                    }
                }
            }
        }

        return (object)[
            'menu'=>$menu,
            'list_menu'=>$list_menu
        ];
        return (object)[];
    }

    function index(Request $request){
        $type=!empty($request->get('type')) ? $request->get('type') : '';

        $get_menu=$this->listAkses($type);

        $parameter_view=[
            'type'=>$type,
            'menu'=>!empty($get_menu->menu) ? $get_menu->menu : []
        ];
        return view('layouts.sub_menu',$parameter_view);
    }
}
