<?php

namespace App\Services;

use App\Models\Dokter;

class DokterService extends BaseService
{
    public function __construct(){
        parent::__construct();
        $this->dokter = new Dokter;
    }

    function getList($params=[],$type=''){

        $query = (new Dokter)
        ->select('dokter.kd_dokter','dokter.nm_dokter','spesialis.nm_sps','dokter.no_ijn_praktek')
        ->join('spesialis','dokter.kd_sps','=','spesialis.kd_sps')
        ->orderBy('dokter.nm_dokter','ASC')
        ;

        $list_search=[
            // 'where_or'=>['ipsrsjenisbarang.kd_jenis','ipsrsjenisbarang.nm_jenis'],
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
