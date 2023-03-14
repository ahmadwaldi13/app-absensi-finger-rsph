<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GlobalFunction;
use App\Services\Antrol\BridgeAntrolService;

class DashboardAntrolBpjsPerhariController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Dashboard Antrol BPJS Perhari';
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
            'tanggal' => !empty($request->tanggal) ? $request->tanggal : date('Y-m-d'),
            'waktu' => !empty($request->waktu) ? $request->waktu : 'server',
        ];

        $endpoint = "dashboard/waktutunggu/tanggal/{$filter['tanggal']}/waktu/{$filter['waktu']}";
        
        $data_tmp_tmp = $this->bridgeAntrolService->getRequest($endpoint);
        $data = json_decode($data_tmp_tmp, true);

        $data1= !empty($data['response']['list']) ? $data['response']['list'] : "";
        $data2['periode'] = [
            'tanggal' => $filter['tanggal'],
            'waktu' => $filter['waktu']
        ];
        $data2['dashboard'] = $data1;  

        $list_data = $data2['dashboard'];

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data
        ];  

        return view($this->part_view.'.index',$parameter_view);
    }
}
