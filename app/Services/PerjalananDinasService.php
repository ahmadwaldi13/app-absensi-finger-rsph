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

    public function getDataPerjalanDinas($params=[],$type){
        ini_set("memory_limit","800M");
        DB::statement("SET GLOBAL group_concat_max_len = 15000;");

        $tgl_awal=!empty($params['tanggal'][0]) ? $params['tanggal'][0] : date('Y-m-d');
        $tgl_akhir=!empty($params['tanggal'][1]) ? $params['tanggal'][1] : date('Y-m-d');

        unset($params['tanggal']);
        
        $query=DB::table(DB::raw(
            '(
                select
                    JSON_OBJECTAGG(
                        id_karyawan,data_pd
                    ) hasil
                from(
                    select
                        utama.*,
                        json_object(
                            "waktu",
                            JSON_ARRAYAGG(
                                JSON_array(
                                    tgl_mulai,tgl_selesai,jml,uraian,jenis_dinas
                                )
                            ),
                            "nm_karyawan",
                            nm_karyawan
                        ) as data_pd
                    from
                    (
                        select utama.*,nm_karyawan,rd.id_departemen,nm_departemen,rr.id_ruangan,nm_ruangan
                        from
                        (
                            select
                                id_karyawan,uraian,tgl_mulai,tgl_selesai,if(tgl_selesai>=tgl_mulai,(DATEDIFF(tgl_selesai,tgl_mulai)),0) jml,jenis_dinas
                            from ref_perjalanan_dinas
                            where
                                ( tgl_mulai between "'.$tgl_awal.'" and "'.$tgl_akhir.'" ) or
                                ( tgl_selesai between "'.$tgl_awal.'" and "'.$tgl_akhir.'" )
                        ) utama
                        inner join ref_karyawan rk on rk.id_karyawan=utama.id_karyawan
                        left join ref_departemen rd on rd.id_departemen=rk.id_departemen
                        left join ref_ruangan rr on rr.id_ruangan=rk.id_ruangan
                        '.(!empty($params['search']) ? "where nm_karyawan like '%".$params['search']."%'" : '' ).'
                    )utama
                    group by id_karyawan
                )utama
            ) utama'
        ));

        $list_search=[];

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