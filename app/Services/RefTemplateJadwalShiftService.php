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

        if(array_key_exists("id_template_jadwal_shift",$params) ){    
            $params['ref_template_jadwal_shift.id_template_jadwal_shift']=$params['id_template_jadwal_shift'];
        }

        unset($params['id_template_jadwal_shift']);

        $query = $this->refTemplateJadwalShift
            ->select('ref_template_jadwal_shift.id_template_jadwal_shift','nm_shift','id_template_jadwal_shift_detail','tgl_mulai','jml_periode','type_periode')
            ->Leftjoin('ref_template_jadwal_shift_detail','ref_template_jadwal_shift_detail.id_template_jadwal_shift','=','ref_template_jadwal_shift.id_template_jadwal_shift')
            // ->orderBy('id_template_jadwal_shift','ASC')
            // ->orderBy(DB::raw(' UNIX_TIMESTAMP( concat( jam_awal, " ", jam_akhir ) ) '),'ASC');
        ;

        $list_search=[
            'where_or'=>['nm_shift'],
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