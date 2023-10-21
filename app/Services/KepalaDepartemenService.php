<?php

namespace App\Services;

use App\Models\KepalaDepartemen;
use Illuminate\Support\Facades\DB;

class KepalaDepartemenService extends BaseService
{
    public $kepalaDepartemen='';

    public function __construct(){
        parent::__construct();
        $this->kepalaDepartemen = new KepalaDepartemen;
    }

    function getList($params=[],$type=''){
        $query = $this->kepalaDepartemen
            ->select('ref_kepala_departemen.*','ref_karyawan.nm_karyawan','ref_karyawan.nip','nm_jabatan','ref_departemen_2.nm_departemen','nm_ruangan',DB::raw("GROUP_CONCAT(ref_departemen.nm_departemen) as list_departemen"),DB::raw("GROUP_CONCAT(ref_departemen.id_departemen) as list_dep_id"))
            ->join('ref_karyawan','ref_karyawan.id_karyawan','=','ref_kepala_departemen.id_karyawan')
            ->join('ref_departemen','ref_departemen.id_departemen','=','ref_kepala_departemen.departemen')
            ->Leftjoin('ref_jabatan','ref_jabatan.id_jabatan','=','ref_karyawan.id_jabatan')
            ->Leftjoin('ref_departemen as ref_departemen_2','ref_departemen_2.id_departemen','=','ref_karyawan.id_departemen')
            ->Leftjoin('ref_ruangan','ref_ruangan.id_ruangan','=','ref_karyawan.id_ruangan')
            ->orderBy('ref_kepala_departemen.id_karyawan','ASC')
        ;

        $list_search=[
            'where_or'=>['ref_kepala_departemen.id_karyawan', 'ref_karyawan.nm_karyawan','ref_karyawan.alamat','nip'],
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