<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
class TarifGrouperPasienController extends \App\Http\Controllers\MyAuthController
{
    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Data Pasien Grouper';
        $this->breadcrumbs = [
            ['title' => 'Tarif grouper', 'url' => url('/') . "/sub-menu?type=6"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
    }

    function actionIndex(Request $request)
    {
        $tab = !empty($request->tab) ? $request->tab : "rj";

        $query = [
            [
                'hahah' => 'hahah'
            ]
        ];

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data' => $query,
            'tab' => $tab,
        ];


        if ($tab == "ri") {
            return view($this->part_view . '.index_ranap', $parameter_view);
        } else {
            return view($this->part_view . '.index', $parameter_view);
        }
    }
}
