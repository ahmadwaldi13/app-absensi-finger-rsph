<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\MasterValidasiPermintaanBarangService;

class BillingListTagihanPasienRalanController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Billing Pasien';
        $this->breadcrumbs=[
            ['title'=>'Olah Data Tagihan','url'=>url('/')."/sub-menu?type=9"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->masterValidasiPermintaanBarangService = new MasterValidasiPermintaanBarangService;
    }

    function actionIndex(Request $request){

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'active_tab'=>1,
            // 'list_data'=>$list_data
        ];

        return view($this->part_view.'.index',$parameter_view);
    }
}