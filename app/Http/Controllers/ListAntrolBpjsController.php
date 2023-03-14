<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Traits\GlobalFunction;
use App\Services\Antrol\BridgeAntrolService;
use App\Services\ListAntrolService;

class ListAntrolBpjsController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Antrian Online Perhari';
        $this->breadcrumbs=[
            ['title'=>'JKN Online','url'=>url('/')."/sub-menu?type=8"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];
        
        $this->globalFunction = new GlobalFunction;
        $this->bridgeAntrolService = new BridgeAntrolService; 
        $this->listAntrolService = new ListAntrolService; 
    }

    public function actionIndex(Request $request)
    {
        $filter = !empty($request->tanggal) ? $request->tanggal : date('Y-m-d');
        $list_data_tmp = $this->listAntrolService->regPeriksaAntreanLocal($filter);
        $list_data=$this->paginate($list_data_tmp);
        $list_data->withPath('');
        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data
        ];  

        return view($this->part_view.'.index',$parameter_view);
    }

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
