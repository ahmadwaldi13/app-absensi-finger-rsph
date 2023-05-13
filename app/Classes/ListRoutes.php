<?php

namespace App\Classes;

class ListRoutes
{
	function getDataAuth($index = null)
	{
		$data = [
			[
				'title' => 'Sub Menu',
				'item' => [
					[
						'type' => ' index ',
						'method' => 'get',
						'url' => '/sub-menu',
						'controller' => 'SubMenuController@index',
						'name' => 'sub_menu',
						'middleware' => '',
					],
					[
						'type' => ' index ',
						'method' => 'get',
						'url' => '/sub-menu/list_akses',
						'controller' => 'SubMenuController@listAkses',
						'name' => '',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'Halaman Awal',
				'item' => [
					[
						'type' => ' index ',
						'method' => 'get',
						'url' => '/',
						'controller' => 'DashboardController@index',
						'name' => 'dashboard',
						'middleware' => '',
					]
				]
			],
			[
				'title' => 'logout',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/logout',
						'controller' => 'AuthController@logout',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'ajax',
				'item' => [
					[
						'type' => 'system',
						'method' => 'get',
						'url' => '/ajax',
						'controller' => 'AjaxController@ajax',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Data Karyawan | Referensi Departemen/Bidang',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/departemen',
						'controller' => 'DepartemenController@actionIndex',
						'name' => 'departemen',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/departemen/create',
						'controller' => 'DepartemenController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/departemen/update',
						'controller' => 'DepartemenController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/departemen/delete',
						'controller' => 'DepartemenController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Data Karyawan | Referensi Jabatan Karyawan',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/jabatan',
						'controller' => 'JabatanController@actionIndex',
						'name' => 'jabatan',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/jabatan/create',
						'controller' => 'JabatanController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/jabatan/update',
						'controller' => 'JabatanController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/jabatan/delete',
						'controller' => 'JabatanController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Data Karyawan | Data karyawan',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/data-karyawan',
						'controller' => 'DataKaryawanController@actionIndex',
						'name' => 'data_karyawan',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/data-karyawan/create',
						'controller' => 'DataKaryawanController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/data-karyawan/update',
						'controller' => 'DataKaryawanController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/data-karyawan/delete',
						'controller' => 'DataKaryawanController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Mesin Absensi | Data Mesin',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/data-mesin-absensi',
						'controller' => 'DataMesinAbsensiController@actionIndex',
						'name' => 'data_mesin_absensi',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => ['get', 'post'],
						'url' => '/data-mesin-absensi/create',
						'controller' => 'DataMesinAbsensiController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => ['get', 'post'],
						'url' => '/data-mesin-absensi/update',
						'controller' => 'DataMesinAbsensiController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/data-mesin-absensi/delete',
						'controller' => 'DataMesinAbsensiController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Mesin Absensi | Data User Pada Database',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/data-user-mesin',
						'controller' => 'DataUserMesinController@actionIndex',
						'name' => 'data_user_mesin',
						'middleware' => '',
					],
					[
                        'type' => 'update',
                        'method' => ['get', 'post'],
                        'url' => '/data-user-mesin/update',
                        'controller' => 'DataUserMesinController@actionUpdate',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'delete',
                        'method' => 'delete',
                        'url' => '/data-user-mesin/delete',
                        'controller' => 'DataUserMesinController@actionDelete',
                        'name' => '',
                        'middleware' => '',
                    ],
				]
			],
			[
				'title' => 'Mesin Absensi | Sinkronisasi Mesin & Database',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/data-user-mesin-sinkronisasi',
						'controller' => 'DataUserMesinSinkronisasiController@actionIndex',
						'name' => 'data_user_mesin_sinkronisasi',
						'middleware' => '',
					],
					[
						'type' => 'Sinkronisasi',
						'method' => 'post',
						'url' => '/data-user-mesin-sinkronisasi/sinkron',
						'controller' => 'DataUserMesinSinkronisasiController@actionSinkron',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'User Presensi',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/data-presensi',
						'controller' => 'PresensiController@actionIndex',
						'name' => 'data-presensi',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Upload Data Ke Mesin',
				'item' => [
					[
                        'type' => 'Upload',
                        'method' => ['get', 'post'],
                        'url' => '/upload-data',
                        'controller' => 'UploadDataController@actionIndex',
                        'name' => '',
                        'middleware' => '',
                    ],
                    [
                        'type' => 'system',
                        'method' => 'get',
                        'url' => '/upload-data/ajax',
                        'controller' => 'UploadDataController@ajax',
                        'name' => '',
                        'middleware' => '',
                    ],
				]
			],
			[
				'title' => 'Manajemen User | Group User',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/user-group-app',
						'controller' => 'UserGroupAppController@actionIndex',
						'name' => 'user_group_app',
						'middleware' => '',
					],
					[
						'type' => 'create',
						'method' => 'post',
						'url' => '/user-group-app/create',
						'controller' => 'UserGroupAppController@actionCreate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/user-group-app/update',
						'controller' => 'UserGroupAppController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/user-group-app/delete',
						'controller' => 'UserGroupAppController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/user-group-app/form',
						'controller' => 'UserGroupAppController@form',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Manajemen User | Group User | Permission',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/permission-group-app',
						'controller' => 'PermissionGroupAppController@actionIndex',
						'name' => 'permission_group_app',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/permission-group-app/update',
						'controller' => 'PermissionGroupAppController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title' => 'Manajemen User | Akses User',
				'item' => [
					[
						'type' => 'index',
						'method' => 'get',
						'url' => '/user-akses',
						'controller' => 'UserAksesController@actionIndex',
						'name' => 'user_akses',
						'middleware' => '',
					],
					[
						'type' => 'update',
						'method' => 'post',
						'url' => '/user-akses/update',
						'controller' => 'UserAksesController@actionUpdate',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'delete',
						'method' => 'delete',
						'url' => '/user-akses/delete',
						'controller' => 'UserAksesController@actionDelete',
						'name' => '',
						'middleware' => '',
					],
					[
						'type' => 'form',
						'method' => 'get',
						'url' => '/user-akses/form',
						'controller' => 'UserAksesController@form',
						'name' => '',
						'middleware' => '',
					],
				]
			],
			[
				'title'=>'Setting Variabel Aplikasi',
				'item'=>[
					[
						'type'=>'index',
						'method'=>'get',
						'url'=>'/setting-app-variabel',
						'controller'=>'SettingAppVariabelController@actionIndex',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'create',
						'method'=>['get','post'],
						'url'=>'/setting-app-variabel/create',
						'controller'=>'SettingAppVariabelController@actionCreate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'update',
						'method'=>['get','post'],
						'url'=>'/setting-app-variabel/update',
						'controller'=>'SettingAppVariabelController@actionUpdate',
						'name'=>'',
						'middleware'=>'',
					],
					[
						'type'=>'delete',
						'method'=>'delete',
						'url'=>'/setting-app-variabel/delete',
						'controller'=>'SettingAppVariabelController@actionDelete',
						'name'=>'',
						'middleware'=>'',
					],
				]
			],
		];

		if (!empty($index)) {
			return !empty($data[$index]) ? $data[$index] : null;
		}
		return $data;
	}

	function getIgnoreType($type = null)
	{
		$data = ['/', 'form', 'ajax', 'system'];
		if (!empty($type)) {
			if (!in_array($type, $data)) {
				return 1;
			}
			return 0;
		}
		return $data;
	}
}