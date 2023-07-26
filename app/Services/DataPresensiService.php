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
        DB::statement("SET GLOBAL group_concat_max_len = 15000;");

        $tgl_awal=!empty($params['tanggal'][0]) ? $params['tanggal'][0] : date('Y-m-d');
        $tgl_akhir=!empty($params['tanggal'][1]) ? $params['tanggal'][1] : date('Y-m-d');
        $list_id_user=!empty($params['list_id_user']) ? $params['list_id_user'] : 0;
        
        $limit_data=!empty($params['limit']) ? $params['limit'] : [];
        $limit_data=(new \App\Http\Traits\GlobalFunction)->limit_mysql_manual($limit_data);
        $limit='';
        if(!empty($limit_data)){
            $limit="LIMIT ".implode(',',$limit_data);
        }
        
        $query=DB::table(DB::raw(
            '(
                SELECT 
                    utama.*
                FROM(
                    SELECT
                        id_user,
                        date(waktu) tgl_presensi,
                        GROUP_CONCAT( TIME_FORMAT(waktu,"%H:%i:%s") ORDER BY UNIX_TIMESTAMP( time(waktu) ) ASC ) AS presensi,
                        JSON_OBJECTAGG(
                            TIME_FORMAT(waktu,"%H:%i:%s"),
                            JSON_OBJECT( "idmesin",utama.id_mesin_absensi,"mesin",nm_mesin,"lokasi",lokasi_mesin,"verif",verified,"sts",status )
                        )AS presensi_data
                    FROM
                        (
                            select 
                                * 
                            from ref_data_absensi_tmp 
                            where
                                date( waktu ) BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'" 
                                and id_user in ( '.$list_id_user.' )
                        ) utama
                    INNER JOIN ref_mesin_absensi rma on rma.id_mesin_absensi = utama.id_mesin_absensi
                    GROUP BY id_user,UNIX_TIMESTAMP( date(waktu) )
                    ORDER BY UNIX_TIMESTAMP( date(waktu) ) ASC
                    '.$limit.'
                )utama
            ) utama'
        ));

        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

    public function get_type_verified($type=null){
        $list_data=[
            1=>'Finger',
            3=>'Password',
        ];
        
        if(!isset($type)){
            return $list_data;
        }else{
            return !empty($list_data[$type]) ? $list_data[$type] : '';
        }
    }

    public function save_update_rekap($data_save)
    {
        DB::beginTransaction();
        $pesan = [];
        try {
            $is_save = 0;

            $model = (new \App\Models\DataAbsensiKaryawanRekap);

            if($model::insertOrIgnore($data_save)){
                $is_save = 1;
            }

            if($is_save<=0){
                foreach($data_save as $value){
                    $model = (new \App\Models\DataAbsensiKaryawanRekap)->where(
                        ['id_user'=>$value['id_user'],
                        'id_karyawan'=>$value['id_karyawan'],
                        'tgl_presensi'=>$value['tgl_presensi'],
                        'id_jenis_jadwal'=>$value['id_jenis_jadwal']
                    ])->first();
                    $model->set_model_with_data($value);
                    if ($model->save()) {
                        $is_save++;
                    }
                }
            }
            
            if ($is_save) {
                DB::commit();
                $pesan = ['success',2];
            } else {
                DB::rollBack();
                $pesan = ['error',3];
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->errorInfo[1] == '1062') {
            }
            $pesan = ['error',3];
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan = ['error',3];
        }

        return $pesan;
    }
}