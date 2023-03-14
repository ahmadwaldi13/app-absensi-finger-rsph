<?php

namespace App\Services;

use App\Models\RegPeriksa;
use App\Models\DpjpRanap;

use Illuminate\Support\Facades\DB;

class RekamMedisService extends BaseService
{
    public function __construct(){
        parent::__construct();
        $this->regPeriksa = new regPeriksa;
        $this->dpjpRanap = new DpjpRanap;
    }

    public function getRegPeriksa($params=[],$type=''){
        $query = $this->regPeriksa
            ->select('*',DB::raw("count(no_rawat) + 1 as no_rawat_max"))
            ->orderBy('no_rawat','ASC');

        $list_search=[
            'where_or'=>['no_rkm_medis', 'kd_dokter', 'no_rawat', 'kd_poli', 'no_reg'],
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

    public function getDokterByRegPeriksa($params=[],$type='')
    {
        $query = $this->regPeriksa
            ->select(
                'dokter.kd_dokter',
                'dokter.nm_dokter'
            )
            ->rightjoin('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
        ;

        $list_search=[
            
        ];

        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }
        
        if(empty($type)){
            return $query->get();
        }elseif($type==1){
            return $query;
        }elseif($type==2){
            return $query->first();
        }
    }

    public function getDokterByRujukanPoli($params=[],$type='')
    {
        $query = $this->regPeriksa
            ->select(
                'dokter.kd_dokter',
                'dokter.nm_dokter'
            )
            ->join('rujukan_internal_poli', 'rujukan_internal_poli.no_rawat','=','reg_periksa.no_rawat')
            ->join('dokter', 'rujukan_internal_poli.kd_dokter', '=', 'dokter.kd_dokter')
        ;

        $list_search=[
            
        ];

        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }
        
        if(empty($type)){
            return $query->get();
        }elseif($type==1){
            return $query;
        }elseif($type==2){
            return $query->first();
        }
    }

    public function getDokterByDpjpRanap($params=[],$type='')
    {
        $query = $this->dpjpRanap
            ->select(
                'dokter.kd_dokter',
                'dokter.nm_dokter'
            )
            ->join('reg_periksa', 'dpjp_ranap.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('dokter', 'dpjp_ranap.kd_dokter', '=', 'dokter.kd_dokter');

        $list_search=[
            
        ];

        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }
        if(empty($type)){
            return $query->get();
        }elseif($type==1){
            return $query;
        }elseif($type==2){
            return $query->first();
        }
    }
}
