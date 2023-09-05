<?php

namespace App\Services;

use App\Models\CutiKaryawan;
use Illuminate\Support\Facades\DB;

class CutiKaryawanService extends BaseService
{
    public $cutiKaryawan='';

    public function __construct(){
        parent::__construct();
        $this->cutiKaryawan = new CutiKaryawan;
    }

    function getList($params=[],$type=''){
        $query = $this->cutiKaryawan
            ->select('ref_cuti_karyawan.id_karyawan','ref_karyawan.nip','ref_karyawan.nm_karyawan','nm_jabatan','nm_departemen','nm_ruangan','ref_cuti_karyawan.uraian','ref_cuti_karyawan.tgl_mulai','ref_cuti_karyawan.tgl_selesai','ref_cuti_karyawan.jumlah')
            ->Leftjoin('ref_karyawan','ref_cuti_karyawan.id_karyawan','=','ref_karyawan.id_karyawan')
            ->Leftjoin('ref_jabatan','ref_jabatan.id_jabatan','=','ref_karyawan.id_jabatan')
            ->Leftjoin('ref_departemen','ref_departemen.id_departemen','=','ref_karyawan.id_departemen')
            ->Leftjoin('ref_ruangan','ref_ruangan.id_ruangan','=','ref_karyawan.id_ruangan')
            ->orderBy('nm_karyawan','ASC')
        ;

        $list_search=[
            'where_or'=>['ref_karyawan.nm_karyawan','ref_karyawan.alamat','nip','nm_jabatan','nm_departemen'],
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