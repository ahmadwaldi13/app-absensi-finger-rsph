<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;



class DashboardController extends Controller
{
    public function __construct() {
        
    }

    function index(Request $request){

        if( (new \App\Http\Traits\AuthFunction)->checkAkses('/dashboard') ) {
            return view('dashboard/index',[]);
        }else {
            return redirect('/presensi');
        }   
    }
}