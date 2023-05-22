<?php

namespace App\Services;

use App\Models\RefJadwal;

class RefjadwalService extends BaseService
{
    public $refJadwal='';

    public function __construct(){
        parent::__construct();
        $this->refJadwal = new RefJadwal();
    }

    function getList($params=[],$type=''){
        
        $query = $this->refJadwal;

        $list_search=[
            'where_or'=>['id_jadwal','uraian'],
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