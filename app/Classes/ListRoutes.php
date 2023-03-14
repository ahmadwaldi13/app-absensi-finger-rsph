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
