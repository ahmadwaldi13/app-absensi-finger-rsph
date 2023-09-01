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
        ini_set("memory_limit","800M");
        set_time_limit(0);
        
        DB::beginTransaction();
        $pesan = [];
        try {
            $is_save = 0;

            $model = (new \App\Models\DataAbsensiKaryawanRekap);

            if(!empty($data_save[0])){
                $get_tgl_presensi=$data_save[0]['tgl_presensi'];
                if(!empty($get_tgl_presensi)){
                    $tb_presensi=new \DateTime($get_tgl_presensi);
                    $tahun_presensi=$tb_presensi->format('Y');
                    $bulan_presensi=(int)$tb_presensi->format('m');

                    $model::whereRaw('YEAR(tgl_presensi)', $tahun_presensi)->whereRaw('MONTH(tgl_presensi)', $bulan_presensi)->delete();
                }
                
            }
            
            if($model::insertOrIgnore($data_save)){
                $is_save = 1;
            }
            
            $check_tidak_update=0;
            if($is_save<=0){
                foreach($data_save as $value){
                    $model = (new \App\Models\DataAbsensiKaryawanRekap)->where([
                        'id_user'=>$value['id_user'],
                        'id_karyawan'=>$value['id_karyawan'],
                        'tgl_presensi'=>$value['tgl_presensi'],
                        'id_jenis_jadwal'=>$value['id_jenis_jadwal'],
                    ])->first();
                    
                    $hasil_check = array_diff_assoc($model->getOriginal(), $value);
                    if(!empty($hasil_check)){
                        $model->set_model_with_data($value);
                        if ($model->save()) {
                            $is_save++;
                        }
                    }else{
                        $check_tidak_update++;
                    }
                }
            }

            if ($is_save) {
                DB::commit();
                $pesan = ['success',2];
            } else {
                DB::rollBack();
                if(!empty($check_tidak_update)){
                    $pesan = ['success',2];    
                }else{
                    $pesan = ['error',3];
                }
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

    public function get_data_hari_libur($params=[]){

        $tanggal=!empty($params['tanggal']) ? $params['tanggal'] : [];
        $tanggal[0]=!empty($tanggal[0]) ? $tanggal[0] : date('Y-m-d');
        $tanggal[1]=!empty($tanggal[1]) ? $tanggal[1] : date('Y-m-d');

        $paramater_where=[
            'search' => !empty($params['search']) ? $params['search'] : '',
            'where_between'=>['tanggal'=>[$tanggal[0],$tanggal[1] ]],
        ];

        $data_tmp_tmp=( new \App\Models\RefHariLiburUmum() );
        $list_data_array=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater_where)->get();
        $list_data=[];
        if($list_data_array){
            foreach($list_data_array as $value){
                $tanggal_awal=$value->tanggal;
                $jumlah=$value->jumlah;
                $jumlah=$jumlah-1;
                if($jumlah<=0){
                    $jumlah=0;
                }
                $get_next=$tanggal_awal." +".$jumlah." days";
                $tanggal_akhir=date('Y-m-d', strtotime($get_next));

                $tanggal_awal_str = new \DateTime($tanggal_awal);
                $tanggal_akhir_str = new \DateTime($tanggal_akhir);


                for ($tanggal = $tanggal_awal_str; $tanggal <= $tanggal_akhir_str; $tanggal->modify("+1 day")) {
                    $this_tanggal=$tanggal->format("Y-m-d");
                    $list_data[$this_tanggal]=(object)[
                        'asal_tanggal'=>$tanggal_awal,
                        'uraian'=>$value->uraian
                    ];
                }
            }
        }

        return $list_data;

    }
}