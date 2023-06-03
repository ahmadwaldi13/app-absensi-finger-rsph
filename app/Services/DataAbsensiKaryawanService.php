<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\DataAbsensiKaryawan;

class DataAbsensiKaryawanService extends BaseService
{
    public $dataAbsensiKaryawan;
    
    public function __construct(){
        parent::__construct();
        $this->dataAbsensiKaryawan = new DataAbsensiKaryawan;
    }

    function getList($params=[],$type=''){
        
        $query = $this->dataAbsensiKaryawan;

        // $list_search=[
        //     'where_or'=>['user_mesin_tmp.id_user','user_mesin_tmp.name','user_mesin_tmp.group','ref_user_info.name'],
        // ];

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