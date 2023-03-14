<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;

class TindakanRekamMedisController extends Controller
{
    public function __construct() {
        $this->title='Tindakan Rekam Medis';
        
        $this->globalService = new GlobalService;
    }

    function actionRalan(Request $request){
        $parameter=[
            'req'=>$request,
            'fr'=>'rj'
        ];
        return $this->index($parameter);
    }

    function actionRujukanPoli(Request $request){
        $parameter=[
            'req'=>$request,
            'fr'=>'rp'
        ];
        return $this->index($parameter);
    }

    function actionRanap(Request $request){
        $parameter=[
            'req'=>$request,
            'fr'=>'ri'
        ];
        return $this->index($parameter);
    }

    private function index($params){
        $request=!empty($params['req']) ? $params['req'] : [];
        $no_fr=!empty($params['fr']) ? $params['fr'] : [];
        $no_rm=!empty($request->no_rm) ? $request->no_rm : '';
        $no_rawat=!empty($request->no_rawat) ? $request->no_rawat : '';

        if ($no_rm  && $no_rawat && $no_fr) {

            
            $kode_item_pasien=[
                'no_rm'=>$no_rm,
                'no_rawat'=>$no_rawat
            ];

            (new \App\Http\Traits\ItemPasienFunction)->setItemPasien($kode_item_pasien,$no_fr);

            $url_target='riwayat-pasien';
            $parameter_url=$kode_item_pasien;
            $parameter_url['fr']=$no_fr;
            $url=(new \App\Http\Traits\GlobalFunction)->set_paramter_url($url_target,$parameter_url);
            
            return redirect($url);
            
        }else{
            die;
        }
    }
}