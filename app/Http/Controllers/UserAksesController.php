<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\GlobalFunction;
use App\Services\UserManagement\UserAksesAppService;
use App\Services\UserManagement\UserGroupAppService;

class UserAksesController extends Controller
{

    public function __construct(
        UserAksesAppService $userAksesAppService,
        UserGroupAppService $userGroupAppService
    ) {
        $this->title='User akses';
        $this->url_name_index='user_akses';
        $this->breadcrumbs=[
            ['title'=>'Manajemen User','url'=>url('/')."/sub-menu?type=2"],
            ['title'=>$this->title,'url'=>url('/')."/user-akses"],
        ];

        $this->userAksesAppService = $userAksesAppService;
        $this->userGroupAppService = $userGroupAppService;
    }

    function actionIndex(Request $request, $level = null)
    {
        $form_level_akses = !empty($request->form_level_akses) ? $request->form_level_akses : '';
        $form_jenis_akun = !empty($request->form_jenis_akun) ? $request->form_jenis_akun : '';
        $form_search_text = !empty($request->form_search_text) ? $request->form_search_text : '';

        $level_akses_list=$this->userGroupAppService->getUxuiAuthGroup();
        $jenis_akun_list = ['dokter'=>'Dokter','petugas'=>'Petugas'];
        $data_list = $this->userAksesAppService->getList(['alias_group'=>$form_level_akses,'status'=>$form_jenis_akun,'search'=>$form_search_text],1)
        ->paginate(!empty($request->per_page) ? $request->per_page : 20);
        
        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            "level_akses_list" => $level_akses_list,
            "jenis_akun_list" => $jenis_akun_list,
            "data_list" => $data_list
        ];
        return view('user-management.user-akses.index', $parameter_view);
    }

    function form(Request $request)
    {
        $kode = !empty($request->data_sent) ? $request->data_sent : null;
        $model = $this->userAksesAppService->getList(['id_user_'=>$kode]);
        $model=!empty($model[0]) ? $model[0] : (object)[];
        $action_form = 'user-akses/update';
        $level_akses_list=$this->userGroupAppService->getUxuiAuthGroup();
        
        $parameter_view = [
            'action_form' => $action_form,
            'model' => $model,
            'level_akses_list' =>  $level_akses_list,
            'kode' => $kode,
        ];

        $bagan_html = 'user-management.user-akses.form';

        if ($request->ajax()) {
            $returnHTML = view($bagan_html, $parameter_view)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            return view($bagan_html, $parameter_view);
        }
    }

    function actionUpdate(Request $request)
    {
        DB::beginTransaction();
        $key_data = !empty($request->key_data) ? $request->key_data : null;
        $level_akses = !empty($request->level_akses) ? $request->level_akses : null;
        
        $link_back = 'user_akses';
        $link_back_param = [];
        $message_default = [
            'success' => 'Level Akses Berhasil di ubah',
            'error' => 'Level Akses Gagal di Ubah'
        ];

        try {
            if (!empty($key_data) and !empty($level_akses)) {
                $check_data = $this->userAksesAppService->uxuiAuthUsers->where('id','=',$key_data)->first();
                $model = $this->userAksesAppService->getList(['id_user_'=>$key_data]);
                $model=!empty($model[0]) ? $model[0] : (object)[];
                
                $is_save=0;
                if($check_data){
                    $data_save=[
                        'id'=>$model->id_user_,
                        'id_user'=>$model->id_user,
                        'alias_group'=>$level_akses
                    ];
                    $model_save=$this->userAksesAppService->update(['id'=>$model->id_user_],$data_save);
                    if($model_save){
                        $is_save=1;
                    }
                }else{
                    $data_save=[
                        'id'=>$model->id_user_,
                        'id_user'=>$model->id_user,
                        'alias_group'=>$level_akses
                    ];
                    $model_save=$this->userAksesAppService->insert($data_save);
                    if($model_save){
                        $is_save=1;
                    }
                }
                
                if($is_save){
                    DB::commit();
                    $pesan=['success' => $message_default['success']];
                }else{
                    DB::rollBack();
                    $pesan=['error' => $message_default['error']];
                }
                return redirect()->route($link_back, $link_back_param)->with($pesan);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->errorInfo[1] == '1062') {
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf tidak dapat menyimpan data yang sama']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }
    }

    function actionDelete(Request $request)
    {
        DB::beginTransaction();
        $kode = !empty($request->data_sent) ? $request->data_sent : null;

        $link_back = 'user_akses';
        $link_back_param = [];
        $message_default = [
            'success' => 'Level Akses Berhasil di Hapus',
            'error' => 'Level Akses Gagal di Hapus'
        ];

        try {
            
            if (!empty($kode)) {
                $paramater_where = [
                    'id' => $kode
                ];
                $deleteUserGroup = $this->userAksesAppService->delete($paramater_where);
                if ($deleteUserGroup) {
                    DB::commit();
                    $pesan = ['success' => $message_default['success']];
                } else {
                    DB::rollBack();
                    $pesan = ['error' => $message_default['error']];
                }
                return redirect()->route($link_back, $link_back_param)->with($pesan);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->errorInfo[1] == '1062') {
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf tidak dapat menyimpan data yang sama']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }
    }
}