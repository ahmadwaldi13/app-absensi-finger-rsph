<?php

namespace App\Services;

use App\Models\PerjalananDinas;
use Illuminate\Support\Facades\DB;

class PerjalananDinasService extends BaseService
{
    public $perjalananDinas='';

    public function __construct(){
        parent::__construct();
        $this->perjalananDinas = new PerjalananDinas;
    }

    function getList($params=[],$type=''){
        $query = $this->perjalananDinas
            ->select('id_spd','ref_perjalanan_dinas.id_karyawan','ref_karyawan.nip','ref_karyawan.nm_karyawan','nm_jabatan','nm_departemen','nm_ruangan','ref_perjalanan_dinas.jenis_dinas','ref_perjalanan_dinas.tgl_mulai','ref_perjalanan_dinas.tgl_selesai','ref_perjalanan_dinas.jumlah','ref_perjalanan_dinas.uraian')
            ->Leftjoin('ref_karyawan','ref_perjalanan_dinas.id_karyawan','=','ref_karyawan.id_karyawan')
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