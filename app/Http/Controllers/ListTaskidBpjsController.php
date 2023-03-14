<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Traits\GlobalFunction;
use App\Services\Antrol\BridgeAntrolService;
use App\Services\ListTaskidAntrolService;

class ListTaskidBpjsController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='TaskID Mobile JKN';
        $this->breadcrumbs=[
            ['title'=>'JKN Online','url'=>url('/')."/sub-menu?type=8"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];
        
        $this->globalFunction = new GlobalFunction;
        $this->bridgeAntrolService = new BridgeAntrolService; 
        $this->listTaskidAntrolService = new ListTaskidAntrolService; 
    }

    public function actionIndex(Request $request)
    {
        $filter = [
            'form_filter_date_start' => !empty($request->form_filter_date_start) ? $request->form_filter_date_start : '',
            'form_filter_date_end' => !empty($request->form_filter_date_end) ? $request->form_filter_date_end : '',
            'poli' => !empty($request->filter_kd_poli) ? $request->filter_kd_poli : '',
            'filter_search' => !empty($request->filter_search) ? $request->filter_search : '',
        ];

        if (empty($filter['form_filter_date_start'] && $filter['form_filter_date_end'])) {
            $list_data_tmp = [];
        } else{
            $list_data_tmp = $this->listTaskidAntrolService->listDataLocal($filter);
        }
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
