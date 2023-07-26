<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class DataLaporanPresensiService extends BaseService
{
    public function __construct(){
        parent::__construct();
    }

    public function getRekapPresensi($params=[],$type){
        ini_set("memory_limit","800M");
        DB::statement("SET GLOBAL group_concat_max_len = 15000;");

        $id_jenis_jadwal=!empty($params['id_jenis_jadwal']) ? $params['id_jenis_jadwal'] : '';

        $tgl_awal=!empty($params['tanggal'][0]) ? $params['tanggal'][0] : date('Y-m-d');
        $tgl_akhir=!empty($params['tanggal'][1]) ? $params['tanggal'][1] : date('Y-m-d');
        
        $limit_data=!empty($params['limit']) ? $params['limit'] : [];
        $limit_data=(new \App\Http\Traits\GlobalFunction)->limit_mysql_manual($limit_data);
        $limit='';
        if(!empty($limit_data)){
            $limit="LIMIT ".implode(',',$limit_data);
        }

        $query=DB::table(DB::raw(
            '(
                select 
                    id_user,
                    utama.id_karyawan,
                    nm_karyawan,
                    utama.id_departemen,
                    nm_departemen,
                    utama.id_ruangan,
                    nm_ruangan,
                    utama.id_jabatan,
                    nm_jabatan,
                    JSON_OBJECTAGG( 
                        tgl_presensi,
                        presensi_jadwal
                    ) as presensi_jadwal,
                    JSON_OBJECTAGG( 
                        tgl_presensi,
                        JSON_ARRAY(
                            presensi_all
                        )
                    ) as presensi_all,
                    JSON_OBJECTAGG( 
                        tgl_presensi,
                        JSON_OBJECT(
                            "total_waktu_kerja_user_sec",
                            total_waktu_kerja_user_sec,
                            "status_kerja",
                            status_kerja
                        )
                    ) as detail_hitung,
                    sum(total_waktu_kerja_user_sec) sum_waktu_kerja_user_sec
                from 
                    ( select * from data_absensi_karyawan_rekap
                    where tgl_presensi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
                    '.(!empty($id_jenis_jadwal) ? ' AND id_jenis_jadwal = '.$id_jenis_jadwal : '' ).'
                    )utama
                    left join ref_karyawan karyawan on karyawan.id_karyawan=utama.id_karyawan
                    left join ref_jabatan rj on rj.id_jabatan=utama.id_jabatan
                    left join ref_departemen rd on rd.id_departemen=utama.id_departemen
                    left join ref_ruangan rr on rr.id_ruangan=utama.id_ruangan
                GROUP BY id_user
                ORDER BY 
                    UNIX_TIMESTAMP( tgl_presensi ) ASC,
                    id_departemen ASC
            ) utama'
        ));

        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }
}