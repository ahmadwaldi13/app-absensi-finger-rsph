<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Traits\GlobalFunction;
use App\Services\Antrol\BridgeAntrolService;

class DashboardAntrolBpjsPebulanController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Dashboard Antrol BPJS Perbulan';
        $this->breadcrumbs=[
            ['title'=>'JKN Online','url'=>url('/')."/sub-menu?type=8"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];
        
        $this->globalFunction = new GlobalFunction;
        $this->bridgeAntrolService = new BridgeAntrolService;           
    }

    public function actionIndex(Request $request)
    {   
        $filter = [
            'bulan' => !empty($request->bulan) ? $request->bulan : date('m'),
            'tahun' => !empty($request->tahun) ? $request->tahun : date('Y'),
            'waktu' => !empty($request->waktu) ? $request->waktu : 'server',
        ];

        $endpoint = "dashboard/waktutunggu/bulan/{$filter['bulan']}/tahun/{$filter['tahun']}/waktu/{$filter['waktu']}";
        
        $data_tmp_tmp = $this->bridgeAntrolService->getRequest($endpoint);
        $data = json_decode($data_tmp_tmp, true);
        $data1= !empty($data['response']['list']) ? $data['response']['list'] : "";
        $data2['periode'] = [
            'bulan' => $filter['bulan'],
            'tahun' => $filter['tahun'],
            'waktu' => $filter['waktu']
        ];
        $data2['dashboard'] = $data1;  
        $list_data_tmp = $data2['dashboard'];
        $list_data=$this->paginate($list_data_tmp);
        $list_data->withPath('');

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data
        ];  

        return view($this->part_view.'.index',$parameter_view);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
