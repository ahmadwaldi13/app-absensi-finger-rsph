<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class DataPresensiService extends BaseService
{
    public function __construct(){
        parent::__construct();
    }

    public function get_log_per_tgl($params=[],$type){
        ini_set("memory_limit","800M");

        $tgl_awal=!empty($params['tanggal'][0]) ? $params['tanggal'][0] : date('Y-m-d');
        $tgl_akhir=!empty($params['tanggal'][1]) ? $params['tanggal'][1] : date('Y-m-d');
        $list_id_user=!empty($params['list_id_user']) ? $params['list_id_user'] : 0;
        // $list_id_user=0;
        DB::statement("SET GLOBAL group_concat_max_len = 15000;");
        $query=DB::table(DB::raw(
            '(
                SELECT 
                    utama.*
                FROM(
                    SELECT
                        id_user,
                        date(waktu) tgl_presensi,
                        GROUP_CONCAT( TIME_FORMAT(waktu,"%H:%i:%s") ORDER BY UNIX_TIMESTAMP( time(waktu) ) ASC ) AS presensi,
                        CONCAT("[", GROUP_CONCAT( JSON_OBJECT(TIME_FORMAT(waktu,"%H:%i:%s"), JSON_OBJECT( "idmesin",utama.id_mesin_absensi,"mesin",nm_mesin,"lokasi",lokasi_mesin,"verif",verified,"sts",status )  ) ORDER BY UNIX_TIMESTAMP( time(waktu) ) ASC ) ,"]" ) AS presensi_data
                    FROM
                        ref_data_absensi_tmp utama
                        INNER JOIN ref_mesin_absensi rma on rma.id_mesin_absensi = utama.id_mesin_absensi
                    WHERE
                        date( waktu ) BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
                        AND id_user in ( '.$list_id_user.' )
                        GROUP BY id_user,UNIX_TIMESTAMP( date(waktu) )
                        ORDER BY UNIX_TIMESTAMP( date(waktu) ) ASC
                )utama
            ) utama'
        ));
    
        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }
}