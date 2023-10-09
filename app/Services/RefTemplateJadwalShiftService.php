<?php

namespace App\Services;

use App\Models\RefTemplateJadwalShift;
use Illuminate\Support\Facades\DB;

class RefTemplateJadwalShiftService extends BaseService
{
    public $refTemplateJadwalShift='';

    public function __construct(){
        parent::__construct();
        $this->refTemplateJadwalShift = new RefTemplateJadwalShift();
    }

    function getList($params=[],$type=''){

        $query = $this->refTemplateJadwalShift
            ->select('*')
            // ->Leftjoin('ref_jenis_jadwal','ref_jadwal.id_jenis_jadwal','=','ref_jenis_jadwal.id_jenis_jadwal')
            // ->orderBy('id_template_jadwal_shift','ASC')
            // ->orderBy(DB::raw(' UNIX_TIMESTAMP( concat( jam_awal, " ", jam_akhir ) ) '),'ASC');
        ;

        $list_search=[
            'where_or'=>['id_template_jadwal_shift','nm_shift'],
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