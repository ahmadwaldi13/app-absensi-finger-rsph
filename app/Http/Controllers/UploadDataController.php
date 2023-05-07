<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\MesinFinger;
use App\Classes\SoapMesinFinger;
use App\Services\UserMesinTmpService;
use App\Services\UserPresensiService;
use Illuminate\Support\Facades\DB;

class UploadDataController extends Controller
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService, $mesinFinger, $soapMesinFinger, $userPresensiService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Data Presensi';
        $this->breadcrumbs = [
            ['title' => 'Presensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->mesinFinger = new MesinFinger;
        $this->soapMesinFinger = new SoapMesinFinger;
        // $this->userMesinTmpService = new UserMesinTmpService;
        $this->userPresensiService = new UserPresensiService;
    }

    function actionIndex(Request $request){

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'data_mesin'=> !empty($data_mesin) ? $data_mesin : []
        ];

        return view($this->part_view . '.index', $parameter_view);
    }
}
