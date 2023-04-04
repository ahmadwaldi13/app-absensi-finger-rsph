<?php

namespace App\Services;

use App\Models\RefUserInfo;
use App\Models\UserMesinTmp;

class RefUserInfoService extends BaseService
{
    public $refUserInfo;
    
    public function __construct(){
        parent::__construct();
        $this->refUserInfo = new RefUserInfo;
    }

    // function getList($params=[],$type=''){
        
    //     $query = $this->ipsrsJenisBarang
    //         ->select('ipsrsjenisbarang.*','prefix')
    //         ->Leftjoin('uxui_ipsrsjenisbarang','uxui_ipsrsjenisbarang.kd_jenis','=','ipsrsjenisbarang.kd_jenis')
    //         ->orderBy('ipsrsjenisbarang.kd_jenis','ASC')
    //     ;

    //     $list_search=[
    //         'where_or'=>['ipsrsjenisbarang.kd_jenis','ipsrsjenisbarang.nm_jenis'],
    //     ];

    //     if($params){
    //         $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
    //     }
    //     if(empty($type)){
    //         return $query->get();
    //     }else{
    //         return $query;
    //     }
    // }
}