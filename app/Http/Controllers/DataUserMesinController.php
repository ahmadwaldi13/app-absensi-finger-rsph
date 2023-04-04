<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;

class DataUserMesinController extends \App\Http\Controllers\MyAuthController
{

    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Data User Mesin';
        $this->breadcrumbs = [
            ['title' => 'Mesin Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
    }

    function actionIndex(Request $request){

        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';

        $paramater_where=[
            'search' => $form_filter_text
        ];

        $paramater_search=[
            'where_or'=>['ip_address','comm_key','nm_mesin','lokasi_mesin'],
        ];

        $data_tmp_tmp=(new \App\Models\RefMesinAbsensi);
        $list_data=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater_where,$paramater_search)->paginate(!empty($request->per_page) ? $request->per_page : 15);


        $data_mesin=(new \App\Models\RefMesinAbsensi)->get();
        
        // foreach($data_mesin as $value){
        //     $mesin=(new \App\Services\MesinFinger($value->ip_address));
        //     $get_user=$mesin->get_user_dummy();
        //     dd($get_user);
        //     if($get_user){
        //         $get_user=json_decode($get_user);
        //         dd($get_user);
        //     }
        // }
        
        // foreach($data_mesin as $value){
        //     $mesin=(new \App\Services\MesinFinger($value->ip_address));
        //     $check_connet=$mesin->connect();
        //     if($check_connet[0]=='error'){
        //         dd('Tidak Konek');
        //     }
        //     $get_user=$mesin->get_user_with_tamplate();
        //     if($get_user){
        //         $get_user=json_decode($get_user);
        //         dd($get_user);
        //     }
        // }

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data' => $list_data
        ];

        return view($this->part_view . '.index', $parameter_view);
    }
}