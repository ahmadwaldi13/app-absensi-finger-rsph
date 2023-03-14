<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Services\UserManagement\UserGroupAppService;
use App\Services\UserManagement\PermissionGroupAppService;
use App\Services\UserManagement\RoutersAppService;
use App\Classes\ListRoutes;

class PermissionGroupAppController extends Controller
{
    public function __construct(
        UserGroupAppService $userGroupAppService,
        PermissionGroupAppService $permissionGroupAppService,
        RoutersAppService $routersAppService
    )
    {
        $this->permissionGroupAppService = $permissionGroupAppService;
        $this->userGroupAppService = $userGroupAppService;
        $this->routersAppService = $routersAppService;
    }

    function actionIndex(Request $request){
        $hasil=$this->routersAppService->generateRoutes();

        if($hasil[2]!=1){
            return redirect()->route('user_group_app', [])->with(['error'=>$hasil[1]]);
        }

        $id = $request->id;
        $alias = $request->alias;
        $parameter_view = [
            'user_group' => $this->userGroupAppService->getUxuiAuthGroup(['id'=>$id])->first(),
            "lib_routes_list_system" => new ListRoutes,
            "routes_list" => $this->userGroupAppService->getAllRouters(),
            "checked_permissions" => array_column($this->userGroupAppService->getAllUserGroupAccess($alias), "id")
        ];
        return view('user-management.permission-group.index', $parameter_view);
    }

    function actionUpdate(Request $request){
        DB::beginTransaction();
        
        $data_get=$request->all();
        
        $key_alias_group=!empty($data_get['key_group_alias']) ? $data_get['key_group_alias'] : '';

        $get_group= (new \App\Models\UserManagement\UxuiAuthGroup)->where('id','=',$key_alias_group)->first();

        $alias_group=!empty($get_group->alias) ? $get_group->alias : '';

        $auth_permission=$data_get;
        unset($auth_permission['group_alias']);
        unset($auth_permission['_token']);

        $message_default=[
            'success'=> 'User Group "'.$alias_group.'" berhasil di perbaharui',
            'error'=>'Maaf data Gagal diperbaharui'
        ];

        $link_back_redirect = 'permission_group_app';
        $link_back_param = [
            'id' => $get_group->id,
            'alias' => $alias_group
        ];

        try {
            $url_khusus=[
                '/tindakan-rekam-medis/ralan'=>'/riwayat-pasien',
                '/tindakan-rekam-medis/rujukan-poli'=>'/riwayat-pasien',
                '/tindakan-rekam-medis/ranap'=>'/riwayat-pasien',
            ];

            if(!empty($alias_group) && !empty($auth_permission)){
                $tmp_aut_permission=[];
                foreach($auth_permission as $value){
                    $tmp_aut_permission[$value]=$value;
                }
                $auth_permission=$tmp_aut_permission;

                $jlh_save=0;

                foreach($url_khusus as $index => $value){
                    $check=array_search($index,$auth_permission);
                    if($check){
                        $auth_permission[$value]=$value;
                    }
                }
                
                $delete_data= (new \App\Models\UserManagement\UxuiAuthPermission)->where('alias_group','=',$alias_group);
                if($delete_data->delete()){

                    foreach($auth_permission as $url){
                        $model = (new \App\Models\UserManagement\UxuiAuthPermission);
                        $model->alias_group=$alias_group;
                        $model->url=$url;
                        if ($model->save()) {
                            $jlh_save++;
                        }
                    }
                }

                if($jlh_save){
                    DB::commit();
                    $pesan = ['success', $message_default['success'], 2];
                }else{
                    DB::rollBack();
                    $pesan = ['error', $message_default['error'], 3];
                }
            }else{
                $pesan = ['error', 'Data tidak ditemukan', 3];
            }
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            $pesan = ['error', $message_default['error'], 3];

        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan = ['error', $message_default['error'], 3];
        }

        return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0] => $pesan[1]]);
    }
}
