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
            ->select('id_cuti_kary','ref_cuti_karyawan.id_karyawan','ref_karyawan.nip','ref_karyawan.nm_karyawan','nm_jabatan','nm_departemen','nm_ruangan','ref_cuti_karyawan.uraian','ref_cuti_karyawan.tgl_mulai','ref_cuti_karyawan.tgl_selesai','ref_cuti_karyawan.jumlah')
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

    public function getDataCuti($params=[],$type){
        ini_set("memory_limit","800M");
        DB::statement("SET GLOBAL group_concat_max_len = 15000;");

        $tgl_awal=!empty($params['tanggal'][0]) ? $params['tanggal'][0] : date('Y-m-d');
        $tgl_akhir=!empty($params['tanggal'][1]) ? $params['tanggal'][1] : date('Y-m-d');

        unset($params['tanggal']);

        $query=DB::table(DB::raw(
            '(
                select
                    JSON_OBJECTAGG(
                        id_karyawan,data_cuti
                    ) hasil
                from(
                    select
                        utama.*,
                        json_object(
                            "waktu",
                            JSON_ARRAYAGG(
                                JSON_array(
                                    tgl_mulai,tgl_selesai,jml,uraian
                                )
                            ),
                            "nm_karyawan",
                            nm_karyawan
                        ) as data_cuti
                    from
                    (
                        select utama.*,nm_karyawan,rd.id_departemen,nm_departemen,rr.id_ruangan,nm_ruangan
                        from
                        (
                            select
                                id_karyawan,uraian,tgl_mulai,tgl_selesai,if(tgl_selesai>=tgl_mulai,(DATEDIFF(tgl_selesai,tgl_mulai)),0) jml
                            from ref_cuti_karyawan
                            where
                                ( tgl_mulai between "'.$tgl_awal.'" and "'.$tgl_akhir.'" ) or
                                ( tgl_selesai between "'.$tgl_awal.'" and "'.$tgl_akhir.'" )
                        ) utama
                        inner join ref_karyawan rk on rk.id_karyawan=utama.id_karyawan
                        left join ref_departemen rd on rd.id_departemen=rk.id_departemen
                        left join ref_ruangan rr on rr.id_ruangan=rk.id_ruangan
                    )utama
                    group by id_karyawan
                )utama
            ) utama'
        ));

        $list_search=[
            'where_or'=>['nm_karyawan'],
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