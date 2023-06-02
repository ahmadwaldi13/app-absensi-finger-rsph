<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\RefUserInfo;

class RefUserInfoService extends BaseService
{
    public $refUserInfo;
    
    public function __construct(){
        parent::__construct();
        $this->refUserInfo = new RefUserInfo;
    }

    function getList($params=[],$type=''){

        $query=DB::table(DB::raw('ref_user_info utama'))
        ->select(
            'utama.*','ip_address','nm_mesin','lokasi_mesin',
            DB::raw('if(a.id_user,1,0) as status_id_user'),
            'nip','id_karyawan','nm_karyawan','id_departemen','nm_departemen','id_jabatan','nm_jabatan',
        )
        ->join('ref_mesin_absensi', 'ref_mesin_absensi.id_mesin_absensi', '=', 'utama.id_mesin_absensi')
        ->leftJoin(
            DB::raw('(
                select 
                    id_mesin_absensi,
                    id_user,
                    nm_departemen,
                    nm_jabatan,
                    ref_karyawan.*
                from ref_karyawan_user
                inner join ref_karyawan on ref_karyawan_user.id_karyawan=ref_karyawan.id_karyawan
                left join ref_departemen on ref_departemen.id_departemen=ref_karyawan.id_departemen
                left join ref_jabatan on ref_jabatan.id_jabatan=ref_karyawan.id_jabatan
            ) a'),function($join) {
                    $join->on('a.id_mesin_absensi','=','utama.id_mesin_absensi')
                    ->on('a.id_user','=','utama.id_user'); 
                })
        // ->orderBy('nama','ASC');
        ->orderBy(DB::raw('if(a.id_user,1,0)'),'ASC');

        $list_search=[
            'where_or'=>['name','nm_karyawan','nip','utama.id_user'],
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

    // function getList($params=[],$type=''){
        
    //     $query = $this->ipsrsJenisBarang
    //         ->select('ipsrsjenisbarang.*','prefix')
    //         ->Leftjoin('uxui_ipsrsjenisbarang','uxui_ipsrsjenisbarang.kd_jenis','=','ipsrsjenisbarang.kd_jenis')
    //         ->orderBy('ipsrsjenisbarang.kd_jenis','ASC')
    //     ;

    //     $list_search=[
    //         'where_or'=>['ipsrsjenisbarang.kd_jenis','ipsrsjenisbarang.nm_jenis'],
    //     ];

    //     if($params){
    //         $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
    //     }
    //     if(empty($type)){
    //         return $query->get();
    //     }else{
    //         return $query;
    //     }
    // }
}