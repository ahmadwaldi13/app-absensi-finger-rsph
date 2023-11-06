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

    public function get_data_karyawan_log($params=[],$type){
        ini_set("memory_limit","800M");
        DB::statement("SET GLOBAL group_concat_max_len = 15000;");

        $tgl_awal=!empty($params['tanggal'][0]) ? $params['tanggal'][0] : date('Y-m-d');
        $tgl_akhir=!empty($params['tanggal'][1]) ? $params['tanggal'][1] : date('Y-m-d');
        unset($params['tanggal']);

        $limit_data=!empty($params['limit']) ? $params['limit'] : [];
        $limit_data=(new \App\Http\Traits\GlobalFunction)->limit_mysql_manual($limit_data);
        $limit='';
        if(!empty($limit_data)){
            $limit="LIMIT ".implode(',',$limit_data);
        }
        unset($params['limit']);
        
        $query=DB::table(DB::raw(
            '(
                select
                    utama.id_user,
                    karyawan.id_karyawan,
                    nm_karyawan,
                    karyawan.id_departemen,
                    nm_departemen,
                    karyawan.id_ruangan,
                    nm_ruangan,
                    karyawan.id_status_karyawan,
                    nm_status_karyawan,
                    karyawan.id_jabatan,
                    nm_jabatan,
                    id_jenis_jadwal jadwal_rutin,
                    id_template_jadwal_shift jadwal_shift,
                    if(id_jenis_jadwal,1,if(id_template_jadwal_shift,1,0)) ada_jadwal,
                    JSON_OBJECTAGG(
                        tgl,
                        JSON_OBJECT(
                            "presensi",
                            presensi_json
                        )
                    )presensi,
                    JSON_OBJECTAGG(
                        tgl,
                        detail_data_json
                    )list_data_detail
                from (
                    select
                        id_user,
                        tgl,
                        JSON_ARRAYAGG(
                            TIME_FORMAT(jam,"%H:%i:%s")
                        )presensi_json,
                        JSON_OBJECT(
                            "id_mesin",
                            JSON_ARRAYAGG(
                                id_mesin_absensi
                            ),
                            "nm_mesin",
                            JSON_ARRAYAGG(
                                nm_mesin
                            ),
                            "lokasi_mesin",
                            JSON_ARRAYAGG(
                                lokasi_mesin
                            ),
                            "verif",
                            JSON_ARRAYAGG(
                                verified
                            ),
                            "sts",
                            JSON_ARRAYAGG(
                                status
                            )
                        )detail_data_json
                    from (
                        select
                            id_user,
                            utama.id_mesin_absensi,verified,status,nm_mesin,lokasi_mesin,
                            waktu,
                            year(waktu) tahun,
                            date(waktu) tgl,
                            time(waktu) jam
                        from ref_data_absensi_tmp utama
                        LEFT JOIN ref_mesin_absensi rma on rma.id_mesin_absensi = utama.id_mesin_absensi
                        where date(waktu) BETWEEN "'.$tgl_awal.'" and "'.$tgl_akhir.'"
                        order by
                            CONVERT ( year(waktu), UNSIGNED INTEGER) asc,
                            CONVERT ( month(waktu), UNSIGNED INTEGER) asc,
                            CONVERT ( day(waktu), UNSIGNED INTEGER) asc,
                            UNIX_TIMESTAMP( waktu ) asc
                    )utama
                    group by id_user,tgl
                )utama
                left join ref_karyawan_user rku on rku.id_user=utama.id_user
                left join ref_karyawan karyawan on karyawan.id_karyawan=rku.id_karyawan
                left join ref_jabatan rj on rj.id_jabatan=karyawan.id_jabatan
                left join ref_departemen rd on rd.id_departemen=karyawan.id_departemen
                left join ref_ruangan rr on rr.id_ruangan=karyawan.id_ruangan
                left join ref_status_karyawan rsk on rsk.id_status_karyawan=karyawan.id_status_karyawan
                left join ref_karyawan_jadwal jadwal_rutin on jadwal_rutin.id_karyawan=karyawan.id_karyawan
                left join ref_karyawan_jadwal_shift jadwal_shift on jadwal_shift.id_karyawan=karyawan.id_karyawan
                group by utama.id_user
                '.$limit.'
            ) utama'
        ));

        $list_search=[
            'where_or'=>['id_user','nm_karyawan'],
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

            // if(!empty($data_save[0])){
            //     $get_tgl_presensi=$data_save[0]['tgl_presensi'];
            //     if(!empty($get_tgl_presensi)){
            //         $tb_presensi=new \DateTime($get_tgl_presensi);
            //         $tahun_presensi=$tb_presensi->format('Y');
            //         $bulan_presensi=(int)$tb_presensi->format('m');

            //         $model::whereRaw('YEAR(tgl_presensi)', $tahun_presensi)->whereRaw('MONTH(tgl_presensi)', $bulan_presensi)->delete();
            //     }
                
            // }
            
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

    public function hitung_tgl_rekursif($params){
        $tgl_dasar=$params['tgl_dasar'];
        $tgl_awal=$params['tgl_awal'];
        $jml_range=$params['jml_range'];
        $id_jadwal=$params['id_jadwal'];
        $value_data=$params['value_data'];

        $tgl_akhir=!empty($params['tgl_akhir']) ? $params['tgl_akhir'] : '';
        
        $callback=!empty($params['callback']) ? $params['callback'] : [];

        $return=[];
        
        $tgl_next_tmp = new \DateTime($tgl_awal);
        $tgl_next_tmp->modify('+'.$jml_range.' day');
        $tgl_next_tahun=$tgl_next_tmp->format('Y');
        $tgl_next_bulan=$tgl_next_tmp->format('m');
        $tgl_next=$tgl_next_tmp->format('Y-m-d');
        
        if($tgl_dasar==$tgl_awal){
            $tgl_dasar_tmp = new \DateTime($tgl_dasar);
            $callback[$tgl_dasar_tmp->format('Y-m-d')]=$value_data;
        }

        if(!empty($callback)){
            $return=$callback;
        }
        
        $tgl_tmp = new \DateTime($tgl_dasar);
        $tgl_first=(int)$tgl_tmp->format('d');
        $tahun_first=(int)$tgl_tmp->format('Y');
        $tgl_check=(int)$tgl_next_tmp->format('d');
        $tahun_check=(int)$tgl_next_tmp->format('Y');

        $status_lopping=0;
        if( $tgl_first!=$tgl_check){
            $status_lopping=1;
        }else{
            if( $tahun_first==$tahun_check){
                $status_lopping=1;
            }
        }

        if(!empty($tgl_akhir)){
            $status_lopping=0;

            $strtotime_start=strtotime($tgl_next);
            $strtotime_end=strtotime($tgl_akhir);

            if($strtotime_start<=$strtotime_end){
                $status_lopping=1;
            }
        }

        if( ($status_lopping)){
            $callback[$tgl_next]=$value_data;
        }

        if(!empty($callback)){
            ksort($callback);
        }

        if( ($status_lopping)){
            $paramater=[
                'tgl_dasar'=>$tgl_dasar,
                'tgl_awal'=>$tgl_next,
                'jml_range'=>$jml_range,
                'id_jadwal'=>$id_jadwal,
                'value_data'=>$value_data,
                'callback'=>$callback,
            ];

            if(!empty($tgl_akhir)){
                $paramater['tgl_akhir']=$tgl_akhir;
            }
            
            return $this->hitung_tgl_rekursif($paramater);
        }else{
            $return=$callback;
        }

        return $return;
    }

    public function hitung_tgl_rekursif_bulan($params){
        $tgl_dasar=$params['tgl_dasar'];
        $tgl_awal=$params['tgl_awal'];
        $jml_range=$params['jml_range'];
        $id_jadwal=$params['id_jadwal'];
        $value_data=$params['value_data'];

        $tgl_akhir=!empty($params['tgl_akhir']) ? $params['tgl_akhir'] : '';
        
        $callback=!empty($params['callback']) ? $params['callback'] : [];

        $return=[];
        
        $tgl_next_tmp = new \DateTime($tgl_awal);
        $tgl_next_tmp->modify('+'.$jml_range.' day');
        $tgl_next_tahun=$tgl_next_tmp->format('Y');
        $tgl_next_bulan=$tgl_next_tmp->format('m');
        $tgl_next=$tgl_next_tmp->format('Y-m-d');
        
        if($tgl_dasar==$tgl_awal){
            $tgl_dasar_tmp = new \DateTime($tgl_dasar);
            $callback[$tgl_dasar_tmp->format('Y')][(int)$tgl_dasar_tmp->format('m')][$tgl_dasar_tmp->format('Y-m-d')]=$value_data;
        }

        if(!empty($callback)){
            $return=$callback;
        }

        $tgl_tmp = new \DateTime($tgl_dasar);
        $tgl_first=(int)$tgl_tmp->format('d');
        $tahun_first=(int)$tgl_tmp->format('Y');
        $tgl_check=(int)$tgl_next_tmp->format('d');
        $tahun_check=(int)$tgl_next_tmp->format('Y');

        $status_lopping=0;
        if( $tgl_first!=$tgl_check){
            $status_lopping=1;
        }else{
            if( $tahun_first==$tahun_check){
                $status_lopping=1;
            }
        }

        if(!empty($tgl_akhir)){
            $status_lopping=0;

            $strtotime_start=strtotime($tgl_next);
            $strtotime_end=strtotime($tgl_akhir);

            if($strtotime_start<=$strtotime_end){
                $status_lopping=1;
            }
        }

        if( ($status_lopping)){
            $callback[$tgl_next_tahun][(int)$tgl_next_bulan][$tgl_next]=$value_data;
        }

        if(!empty($callback)){
            ksort($callback);
        }

        if(!empty($callback[$tgl_next_tahun])){
            ksort($callback[$tgl_next_tahun]);
        }

        if(!empty($callback[$tgl_next_tahun][(int)$tgl_next_bulan])){
            ksort($callback[$tgl_next_tahun][(int)$tgl_next_bulan]);
        }

        if( ($status_lopping)){
            $paramater=[
                'tgl_dasar'=>$tgl_dasar,
                'tgl_awal'=>$tgl_next,
                'jml_range'=>$jml_range,
                'id_jadwal'=>$id_jadwal,
                'value_data'=>$value_data,
                'callback'=>$callback,
            ];

            if(!empty($tgl_akhir)){
                $paramater['tgl_akhir']=$tgl_akhir;
            }

            return $this->hitung_tgl_rekursif_bulan($paramater);
        }else{
            $return=$callback;
        }

        return $return;
    }

    function setListShiftFirst($params=[]){

        $type_fungsi=!empty($params['type_fungsi']) ? $params['type_fungsi'] : 'bulan';
        unset($params['type_fungsi']);

        $query=DB::table(DB::raw(
            '(
                select
                    utama.id_template_jadwal_shift,
                    utama.nm_shift,
                    rtjsd.id_template_jadwal_shift_detail,
                    tgl_mulai,
                    rtjsw.id_jenis_jadwal,
                    nm_jenis_jadwal,masuk_kerja,pulang_kerja,pulang_kerja_next_day,bg_color,
                    type as type_jadwal,
                    tgl
                from (
                    select * from ref_template_jadwal_shift '.(!empty($params['id_template_jadwal_shift']) ? "where id_template_jadwal_shift=".$params['id_template_jadwal_shift'] : '').'
                ) utama
                inner join ref_template_jadwal_shift_detail rtjsd on rtjsd.id_template_jadwal_shift = utama.id_template_jadwal_shift
                inner join ref_template_jadwal_shift_waktu rtjsw on rtjsw.id_template_jadwal_shift_detail = rtjsd.id_template_jadwal_shift_detail
                left join ref_jenis_jadwal rjj on rjj.id_jenis_jadwal = rtjsw.id_jenis_jadwal
                
            ) utama'
        ));

        $hasil_query=$query->get();

        $data_jadwal_tmp=[];
        $data_hari_shift=[];
        $data_hari_shift_tmp=[];
        $tgl_mulai_perhitungan='';
        if($hasil_query->count()){
            foreach($hasil_query as $key => $value){
                if(!empty($value->tgl)){
                    $tgl_mulai_perhitungan=$value->tgl_mulai;
                    $data_jadwal_tmp[$value->id_jenis_jadwal]=$value;
                    $data_hari=explode(',',$value->tgl);
                    foreach($data_hari as $key_hari => $value_hari){
                        if(empty($data_hari_shift[$value->id_jenis_jadwal])){
                            $data_hari_shift[$value->id_jenis_jadwal]=[];
                        }
                        array_push($data_hari_shift[$value->id_jenis_jadwal], $value_hari);
                        $data_hari_shift_tmp[$value_hari][]=$value->id_jenis_jadwal;
                        
                    }
                }
            }
        }else{
            return [];
        }
        ksort($data_jadwal_tmp);
        ksort($data_hari_shift_tmp);

        $return=[];
        
        if(!empty($data_hari_shift_tmp) && !empty($data_jadwal_tmp) ){
            $tgl_mulai_perhitungan = new \DateTime($tgl_mulai_perhitungan);
            $tgl_mulai_perhitungan=(object)[
                'tahun'=>$tgl_mulai_perhitungan->format('Y'),
                'bulan'=>$tgl_mulai_perhitungan->format('m'),
                'tahun_bulan'=>$tgl_mulai_perhitungan->format('Y-m'),
                'tgl'=>$tgl_mulai_perhitungan->format('Y-m-d'),
            ];

            $end_tahun_bulan_mksimal=$tgl_mulai_perhitungan->tahun.'-12';
            $get_tgl_per_bulan=(new \App\Http\Traits\AbsensiFunction)->get_tgl_per_bulan($end_tahun_bulan_mksimal);
            $end_tanggal=!empty($get_tgl_per_bulan->tgl_start_end[1]) ? $get_tgl_per_bulan->tgl_start_end[1] : '';

            foreach($data_hari_shift_tmp as $key => $value){
                $tgl_awal=$tgl_mulai_perhitungan->tahun_bulan.'-'.$key;
                
                $value_data=[];
                if($value){
                    foreach($value as $nilai){
                        if(!empty($data_jadwal_tmp[$nilai])){
                            $detail_data=(array)$data_jadwal_tmp[$nilai];
                            unset($detail_data['tgl']);
                            $detail_data=(object)$detail_data;
                            $value_data[]=$detail_data;
                        }
                        
                    }
                }

                $paramater=[
                    'tgl_dasar'=>$tgl_awal,
                    'tgl_awal'=>$tgl_awal,
                    'jml_range'=>count($data_hari_shift_tmp),
                    'value_data'=>$value_data,
                    'id_jadwal'=>$value,
                    'tgl_akhir'=>$end_tanggal
                ];

                if(!empty($return)){
                    $paramater['callback']=$return;
                }

                if($type_fungsi=='tanggal'){
                    $return=$this->hitung_tgl_rekursif($paramater);
                }else if($type_fungsi=='bulan'){
                    $return=$this->hitung_tgl_rekursif_bulan($paramater);
                }

                
                
            }
        }

        return $return;
    }

    function setListShiftFirstDatabase($params=[]){
        $hasil=$this->setListShiftFirst($params);
        if(!empty($hasil)){
            dd('simpan ke database');
            dd($params,$hasil);
        }else{
            return '';
        }
    }
}