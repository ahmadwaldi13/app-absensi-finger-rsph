<?php

namespace App\Services;

use App\Models\RefKaryawan;
use App\Models\RefUserInfoDetail;

class RefKaryawanService extends BaseService
{
    public $refKaryawan='';
    public $refUserInfoDetail='';

    public function __construct(){
        parent::__construct();
        $this->refKaryawan = new RefKaryawan;
        $this->refUserInfoDetail = new RefUserInfoDetail;
    }

    function getList($params=[],$type=''){
        
        $query = $this->refKaryawan
            ->select('ref_karyawan.*','nm_jabatan','nm_departemen')
            ->Leftjoin('ref_jabatan','ref_jabatan.id_jabatan','=','ref_karyawan.id_jabatan')
            ->Leftjoin('ref_departemen','ref_departemen.id_departemen','=','ref_karyawan.id_departemen')
            ->orderBy('id_karyawan','DESC')
        ;

        $list_search=[
            'where_or'=>['nm_karyawan','alamat','nik','nip','nm_jabatan','nm_departemen'],
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

    function getList_karyawan($params){
        $query = $this->refKaryawan
        ->select('ref_karyawan.*','nm_jabatan','nm_departemen')
        ->Leftjoin('ref_jabatan','ref_jabatan.id_jabatan','=','ref_karyawan.id_jabatan')
        ->Leftjoin('ref_departemen','ref_departemen.id_departemen','=','ref_karyawan.id_departemen')
        ->where('ref_karyawan.id_karyawan', '=', $params)
        ->get();

        return $query;
    }
    function getList_finger($params){
        $query = $this->refUserInfoDetail;
        // ->select('ref_karyawan.*','nm_jabatan','nm_departemen')
        // ->Leftjoin('ref_jabatan','ref_jabatan.id_jabatan','=','ref_karyawan.id_jabatan')
        // ->Leftjoin('ref_departemen','ref_departemen.id_departemen','=','ref_karyawan.id_departemen')
        // ->where('ref_karyawan.id_karyawan', '=', $params)
        // ->where('ref_user_info.id_user', '=', $params)
        // ->get();

        // return $query;
        // $list_search=[
        //     'where_or'=>['nm_karyawan','alamat','nik','nip','nm_jabatan','nm_departemen'],
        // ];

        // if($params){
        //     $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        // }
        // if(empty($type)){
        //     return $query->get();
        // }else{
            return $query;
        // }
    }
}