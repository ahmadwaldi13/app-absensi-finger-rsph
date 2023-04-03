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
                        'title'=>'Setting Variabel Aplikasi',
                        'key'=>'setting-app-variabel',
                        'url'=>url('/')."/setting-app-variabel",
                    ],
                ];
            }

            if($type==4){
                $menu_permission=[
                    [
                        'title'=>'Referensi Departemen/Bidang',
                        'key'=>'departemen',
                        'url'=>url('/')."/departemen",
                    ],
                    [
                        'title'=>'Referensi Jabatan Karyawan',
                        'key'=>'jabatan',
                        'url'=>url('/')."/jabatan",
                    ],
                    [
                        'title'=>'Data Karyawan',
                        'key'=>'data-karyawan',
                        'url'=>url('/')."/data-karyawan",
                    ],
                ];
            }

            if($type==5){
                $menu_permission=[
                    [
                        'title'=>'Data Mesin Absensi',
                        'key'=>'data-mesin-absensi',
                        'url'=>url('/')."/data-mesin-absensi",
                    ],
                    [
                        'title'=>'Data User Mesin',
                        'key'=>'data-user-mesin',
                        'url'=>url('/')."/data-user-mesin",
                    ],
                ];
            }

            if($type==6){
                $menu_permission=[
                    [
                        'title'=>'Presensi',
                        'key'=>'data-presensi',
                        'url'=>url('/')."/data-presensi",
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
