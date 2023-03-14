<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
class SettingBufferController extends \App\Http\Controllers\MyAuthController
{
    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Setting Buffer';
        $this->breadcrumbs = [
            ['title' => 'Tarif Grouper', 'url' => url('/') . "/sub-menu?type=6"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
    }

    function actionIndex(Request $request)
    {
        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
        ];

            return view($this->part_view . '.index', $parameter_view);
    }
}
