<?php

namespace App\Services;

use App\Models\RefJadwal;
use Illuminate\Support\Facades\DB;

class RefJadwalService extends BaseService
{
    public $refJadwal='';

    public function __construct(){
        parent::__construct();
        $this->refJadwal = new RefJadwal();
    }

    function getList($params=[],$type=''){

        $query = $this->refJadwal
            ->select('ref_jadwal.*','nm_jenis_jadwal')
            ->Leftjoin('ref_jenis_jadwal','ref_jadwal.id_jenis_jadwal','=','ref_jenis_jadwal.id_jenis_jadwal')
            ->orderBy('ref_jadwal.id_jenis_jadwal','ASC')
            ->orderBy(DB::raw(' UNIX_TIMESTAMP( concat( jam_awal, " ", jam_akhir ) ) '),'ASC');
        ;

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