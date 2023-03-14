<?php

namespace App\Services;

use App\Models\Pegawai;

class PegawaiService extends BaseService
{
    public function __construct(){
        parent::__construct();
        $this->pegawai = new Pegawai;
    }

    function getList($params=[],$type=''){

        $query = (new Pegawai)
            ->select('pegawai.nik','pegawai.nama','pegawai.jbtn','pegawai.jnj_jabatan','pegawai.departemen','departemen.nama as departemen_nama')
            ->Leftjoin('departemen','departemen.dep_id','=','pegawai.departemen')
            ->orderBy('pegawai.nama','ASC')
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

    function getList_petugas($params=[],$type=''){

        $query = (new Pegawai)
        ->select('pegawai.nik', 'pegawai.nama', 'pegawai.jbtn', 'pegawai.jnj_jabatan', 'pegawai.departemen', 'departemen.nama AS departemen_nama')
        ->leftJoin('departemen', 'departemen.dep_id', '=', 'pegawai.departemen')
        ->leftJoin('petugas', 'petugas.nip', '=', 'pegawai.nik')
        ->whereColumn('pegawai.nik', '=', 'petugas.nip')
        ->orderBy('pegawai.nama', 'ASC')

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
