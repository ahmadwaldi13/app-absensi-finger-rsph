<?php

namespace App\Services;

use App\Models\RefKaryawan;

class RefKaryawanService extends BaseService
{
    public $refKaryawan='';

    public function __construct(){
        parent::__construct();
        $this->refKaryawan = new RefKaryawan;
    }

    function getList($params=[],$type=''){
        
        $query = $this->refKaryawan
            ->select('ref_karyawan.*','nm_jabatan','nm_departemen')
            ->Leftjoin('ref_jabatan','ref_jabatan.id_jabatan','=','ref_karyawan.id_jabatan')
            ->Leftjoin('ref_departemen','ref_departemen.id_departemen','=','ref_karyawan.id_departemen')
            ->orderBy('id_karyawan','DESC')
        ;

        $list_search=[
            'where_or'=>['nama','alamat','nik','nip','nm_jabatan','nm_departemen'],
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