<?php

namespace App\Services;

use App\Models\IpsrsJenisBarang;

class KodeBarangNonMedisPenunjangService extends BaseService
{
    public function __construct(){
        parent::__construct();
        $this->ipsrsJenisBarang = new IpsrsJenisBarang;
    }

    function getList($params=[],$type=''){
        
        $query = $this->ipsrsJenisBarang
            ->select('ipsrsjenisbarang.*','prefix')
            ->Leftjoin('uxui_ipsrsjenisbarang','uxui_ipsrsjenisbarang.kd_jenis','=','ipsrsjenisbarang.kd_jenis')
            ->orderBy('ipsrsjenisbarang.kd_jenis','ASC')
        ;

        $list_search=[
            'where_or'=>['ipsrsjenisbarang.kd_jenis','ipsrsjenisbarang.nm_jenis'],
        ];

        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }
        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }
}