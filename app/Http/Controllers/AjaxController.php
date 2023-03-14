<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\GlobalService;

class AjaxController extends Controller
{
    public function __construct() {
        $this->globalService = new GlobalService;
    }

    function ajax(Request $request){
        $get_req = $request->all();
        $hasil='';
        if(!empty($get_req['action'])){
            
        }
    }
}