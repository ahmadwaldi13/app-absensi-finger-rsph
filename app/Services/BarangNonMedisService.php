<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

use App\Models\IpsrsBarang;

class BarangNonMedisService extends BaseService
{
    public function __construct(){
        parent::__construct();
        $this->ipsrsBarang = new IpsrsBarang;
    }

    function getBarangList($params=[],$type=''){

        $query = $this->ipsrsBarang
            ->select('ipsrsbarang.*','ipsrsjenisbarang.nm_jenis','kodesatuan.satuan')
            ->join('kodesatuan','kodesatuan.kode_sat','=','ipsrsbarang.kode_sat')
            ->join('ipsrsjenisbarang','ipsrsjenisbarang.kd_jenis','=','ipsrsbarang.jenis')
            ->orderBy('ipsrsbarang.kode_brng','ASC')
        ;

        $list_search=[
            'where_or'=>['ipsrsbarang.kode_brng','ipsrsbarang.nama_brng','kodesatuan.satuan','ipsrsjenisbarang.nm_jenis'],
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

    function generateKodeBarangByJenis($jenis){

        $get_data_1=$this->ipsrsBarang->select(DB::raw("count(kode_brng) as last"))->where('jenis', '=', $jenis)->first();
        $get_data_2=$this->ipsrsBarang->select(DB::raw("max(replace(reverse(FORMAT(reverse(kode_brng), 0)), ',', '')) as last"))->where('jenis', '=', $jenis)->first();
        
        $number=$get_data_1;
        if($get_data_2->last > $get_data_1->last){
            $number=$get_data_2;
        }
        $get_prefix=(new \App\Models\UxuiIpsrsjenisbarang)->select('prefix')->where('kd_jenis', '=', $jenis)->first();
        $get_prefix=!empty($get_prefix->prefix) ? $get_prefix->prefix : 'B';

        // return (new \App\Http\Traits\GlobalFunction)->autoNomor($number,'',$get_prefix,5);
    
        $number=!empty($number->last) ? (int)$number->last : 0;
        $number++;
        return $get_prefix.$number;
    }
}