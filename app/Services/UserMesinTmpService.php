<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\UserMesinTmp;

class UserMesinTmpService extends BaseService
{
    public $userMesinTmp;
    
    public function __construct(){
        parent::__construct();
        $this->userMesinTmp = new UserMesinTmp;
    }

    function getList($params=[],$type=''){
        
        $query = $this->userMesinTmp
            ->select('user_mesin_tmp.*',DB::raw("IF( ref_user_info.id_user, 1, 0 ) as ready "),'ref_user_info.name as db_name')
            ->leftJoin('ref_user_info', function($join){
                $join->on('user_mesin_tmp.id_mesin_absensi', '=', 'ref_user_info.id_mesin_absensi');
                $join->on('user_mesin_tmp.id_user', '=', 'ref_user_info.id_user');
            })
            ->orderBy('user_mesin_tmp.id_mesin_absensi','ASC')
            ->orderBy('user_mesin_tmp.id_user','ASC')
        ;

        $list_search=[
            'where_or'=>['user_mesin_tmp.id_user','user_mesin_tmp.name','user_mesin_tmp.group','ref_user_info.name'],
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