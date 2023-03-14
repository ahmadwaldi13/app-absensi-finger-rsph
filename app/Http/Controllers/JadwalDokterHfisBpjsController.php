<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GlobalFunction;
use App\Services\Vclaim\BridgeVclaimService;
use App\Services\Antrol\BridgeAntrolService;

class JadwalDokterHfisBpjsController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Jadwal Dokter HFIS';
        $this->breadcrumbs=[
            ['title'=>'JKN Online','url'=>url('/')."/sub-menu?type=8"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];
        
        $this->globalFunction = new GlobalFunction; 
        $this->bridgeVclaim = new BridgeVclaimService;
        $this->bridgeAntrolService = new BridgeAntrolService;
    }

    public function actionIndex(Request $request)
    {
        $filter = [
            'poli' => !empty($request->poli) ? $request->poli : '',
            'tanggal' => !empty($request->tanggal) ? $request->tanggal : '',
        ];
        $endpoint = "jadwaldokter/kodepoli/{$filter['poli']}/tanggal/{$filter['tanggal']}";
        $data_tmp_tmp = $this->bridgeAntrolService->getRequest($endpoint);
        $data = json_decode($data_tmp_tmp, true);
        $list_data = !empty($data['response']) ? $data['response'] : '';
        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data
        ];  

        return view($this->part_view.'.index',$parameter_view);
    }
}
