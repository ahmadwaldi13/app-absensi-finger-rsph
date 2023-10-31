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

    // function getListShift($params=[]){

    //     $query=DB::table(DB::raw(
    //         '(
    //             select
    //                 utama.id_template_jadwal_shift,
    //                 utama.nm_shift,
    //                 rtjsd.id_template_jadwal_shift_detail,
    //                 tgl_mulai,
    //                 rtjsw.id_jenis_jadwal,
    //                 nm_jenis_jadwal,masuk_kerja,pulang_kerja,pulang_kerja_next_day,bg_color,
    //                 type as type_jadwal,
    //                 tgl
    //             from (
    //                 select * from ref_template_jadwal_shift '.(!empty($params['id_template_jadwal_shift']) ? "where id_template_jadwal_shift=".$params['id_template_jadwal_shift'] : '').'
    //             ) utama
    //             inner join ref_template_jadwal_shift_detail rtjsd on rtjsd.id_template_jadwal_shift = utama.id_template_jadwal_shift
    //             inner join ref_template_jadwal_shift_waktu rtjsw on rtjsw.id_template_jadwal_shift_detail = rtjsd.id_template_jadwal_shift_detail
    //             left join ref_jenis_jadwal rjj on rjj.id_jenis_jadwal = rtjsw.id_jenis_jadwal
                
    //         ) utama'
    //     ));

    //     $hasil=$query->get();
        
    //     $data_template_jadwal_shift=[];
    //     $list_option_data=[];
    //     if($hasil){
    //         foreach($hasil as $key => $value){
    //             if(!empty($value->tgl)){
    //                 $explode=explode(',',$value->tgl);
    //                 if($explode){
    //                     foreach($explode as $val_tgl){
    //                         $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['id_template_jadwal_shift']=$value->id_template_jadwal_shift;
    //                         $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['nm_shift']=$value->nm_shift;
    //                         $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['id_template_jadwal_shift_detail']=$value->id_template_jadwal_shift_detail;

    //                         $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['data_jadwal'][]=$value->nm_jenis_jadwal;

                            
    //                         $text_lenght_jadwal_waktu=$value->nm_jenis_jadwal.' '.$value->masuk_kerja.' s/d '.$value->pulang_kerja;
    //                         if($value->pulang_kerja_next_day){
    //                             $text_lenght_jadwal_waktu.=' Esok Hari';
    //                         }
    //                         if($value->type_jadwal==2){
    //                             $text_lenght_jadwal_waktu="Libur";
    //                             $value->bg_color='#e1dede';
    //                         }
                            
    //                         $parameter=[
    //                             'title'=>$text_lenght_jadwal_waktu,
    //                             'bg_color'=>$value->bg_color,
    //                             'type_jadwal'=>$value->type_jadwal,

    //                         ];
    //                         $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['data_jadwal_waktu'][]=json_encode($parameter);

    //                         $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['item'][]=[
    //                             'id_jenis_jadwal'=>$value->id_jenis_jadwal,
    //                             'type_jadwal'=>$value->type_jadwal,
    //                             'nm_jenis_jadwal'=>$value->nm_jenis_jadwal,
    //                             'bg_color'=>$value->bg_color,
    //                             'masuk_kerja'=>$value->masuk_kerja,
    //                             'pulang_kerja'=>$value->pulang_kerja,
    //                             'pulang_kerja_next_day'=>$value->pulang_kerja_next_day,
    //                         ];

    //                         if($value->type_jadwal==1){
    //                             if(empty( $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_kerja'] )){
    //                                 $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_kerja']=1;
    //                             }else{
    //                                 $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_kerja']++;
    //                             }

    //                             if(empty($list_option_data[$value->id_template_jadwal_shift]['jml_kerja_minggu'])){
    //                                 $list_option_data[$value->id_template_jadwal_shift]['jml_kerja_minggu']=1;
    //                             }else{
    //                                 $list_option_data[$value->id_template_jadwal_shift]['jml_kerja_minggu']++;
    //                             }

    //                             $masuk=(new \App\Http\Traits\AbsensiFunction)->his_to_seconds($value->masuk_kerja);
    //                             $pulang=(new \App\Http\Traits\AbsensiFunction)->his_to_seconds($value->pulang_kerja);
                                
    //                             if(empty($value->pulang_kerja_next_day)){
    //                                 $total_kerja=$pulang-$masuk;
    //                             }else{
    //                                 $total_kerja=$masuk-$pulang;
    //                             }

    //                             if(empty($data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['total_kerja_per_hari'])){
    //                                 $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['total_kerja_per_hari']=$total_kerja;
    //                             }else{
    //                                 $total_kerja_per_hari_tmp=$data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['total_kerja_per_hari'];
    //                                 $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['total_kerja_per_hari']=$total_kerja_per_hari_tmp+$total_kerja;
    //                             }
                                
    //                             if(empty($list_option_data[$value->id_template_jadwal_shift]['total_kerja_minggu'])){
    //                                 $list_option_data[$value->id_template_jadwal_shift]['total_kerja_minggu']=$total_kerja;
    //                             }else{
    //                                 $total_kerja_tmp=$list_option_data[$value->id_template_jadwal_shift]['total_kerja_minggu'];
    //                                 $list_option_data[$value->id_template_jadwal_shift]['total_kerja_minggu']=$total_kerja_tmp+$total_kerja;
    //                             }
    //                         }

    //                         if($value->type_jadwal==2){

    //                             if(empty( $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_libur'] )){
    //                                 $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_libur']=1;
    //                             }

    //                             if(empty($list_option_data[$value->id_template_jadwal_shift]['jml_libur_minggu'])){
    //                                 $list_option_data[$value->id_template_jadwal_shift]['jml_libur_minggu']=1;
    //                             }else{
    //                                 $list_option_data[$value->id_template_jadwal_shift]['jml_libur_minggu']++;
    //                             }
    //                         }
                            
    //                     }
    //                 }
    //             }
    //         }
    //     }

        

    //     $data_template_jadwal_shift_tmp=$data_template_jadwal_shift;
    //     $list_data=[];
        
    //     foreach($data_template_jadwal_shift_tmp as $key => $item){
    //         $list_option_data[$key]['jml_kerja_bulan']=$list_option_data[$key]['jml_kerja_minggu'];
    //         $list_option_data[$key]['jml_libur_bulan']=$list_option_data[$key]['jml_libur_minggu'];
    //         $list_option_data[$key]['total_kerja_bulan']=$list_option_data[$key]['total_kerja_minggu'];
    //         foreach($item as $key_hari => $val_hasil){
    //             for($i=1; $i<=4; $i++){
    //                 $jml=$i*count($item);
    //                 $tgl_hasil=$jml+$key_hari;
    //                 if($tgl_hasil<=31){
    //                     $data_template_jadwal_shift_tmp[$key][$tgl_hasil]=$val_hasil;
    //                     if(!empty($data_template_jadwal_shift_tmp[$key][$tgl_hasil]['jml_kerja'])){
    //                         $tmp=$list_option_data[$key]['jml_kerja_bulan'];
    //                         $list_option_data[$key]['jml_kerja_bulan']=$tmp+$data_template_jadwal_shift_tmp[$key][$tgl_hasil]['jml_kerja'];
    //                     }

    //                     if(!empty($data_template_jadwal_shift_tmp[$key][$tgl_hasil]['jml_libur'])){
    //                         $tmp=$list_option_data[$key]['jml_libur_bulan'];
    //                         $list_option_data[$key]['jml_libur_bulan']=$tmp+$data_template_jadwal_shift_tmp[$key][$tgl_hasil]['jml_libur'];
    //                     }

    //                     if(!empty($data_template_jadwal_shift_tmp[$key][$tgl_hasil]['total_kerja_per_hari'])){
    //                         $tmp=$list_option_data[$key]['total_kerja_bulan'];
    //                         $list_option_data[$key]['total_kerja_bulan']=$tmp+$data_template_jadwal_shift_tmp[$key][$tgl_hasil]['total_kerja_per_hari'];
    //                     }
    //                 }
    //             }
    //         }
    //         ksort($data_template_jadwal_shift_tmp[$key]);
    //         $list_data[$key]['item']=json_encode($data_template_jadwal_shift_tmp[$key]);
    //     }

    //     foreach($list_data as $key => $item){
    //         if(!empty($list_option_data[$key])){
    //             $list_data[$key]=array_merge($list_option_data[$key],$list_data[$key]);
    //         }
    //     }
    //     return $list_data;
    // }


    public function putar($tgl_mulai,$end_tgl,$callback){
        $return=[];
        $tgl1 = new \DateTime($tgl_mulai);
        $tgl2 = new \DateTime($tgl_mulai);
        $vv=8;
        $tgl2->modify('+'.$vv.' day');
        $hasil=$tgl2->format('Y-m-d');

        $strtotime_start=strtotime($tgl_mulai);
        $strtotime_end=strtotime($end_tgl);

        if(!empty($callback)){
            $return=$callback;
        }
        $callback[$hasil]=1;

        if($strtotime_start<=$strtotime_end){
            return $this->putar($hasil,$end_tgl,$callback);
        }
        
        return $return;
    }

    function getListShift($params=[]){

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

        $hasil=$query->get();
        
        $data_template_jadwal_shift=[];
        $list_option_data=[];
        $list_option_data_2=[];
        if($hasil){
            foreach($hasil as $key => $value){
                if(!empty($value->tgl)){
                    $explode=explode(',',$value->tgl);
                    if($explode){
                        foreach($explode as $val_tgl){
                            $list_option_data_2[$value->id_template_jadwal_shift]['tgl_mulai']=$value->tgl_mulai;

                            $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['id_template_jadwal_shift']=$value->id_template_jadwal_shift;
                            $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['nm_shift']=$value->nm_shift;
                            $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['id_template_jadwal_shift_detail']=$value->id_template_jadwal_shift_detail;

                            $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['data_jadwal'][]=$value->nm_jenis_jadwal;

                            
                            $text_lenght_jadwal_waktu=$value->nm_jenis_jadwal.' '.$value->masuk_kerja.' s/d '.$value->pulang_kerja;
                            if($value->pulang_kerja_next_day){
                                $text_lenght_jadwal_waktu.=' Esok Hari';
                            }
                            if($value->type_jadwal==2){
                                $text_lenght_jadwal_waktu="Libur";
                                $value->bg_color='#e1dede';
                            }
                            
                            $parameter=[
                                'title'=>$text_lenght_jadwal_waktu,
                                'bg_color'=>$value->bg_color,
                                'type_jadwal'=>$value->type_jadwal,

                            ];
                            $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['data_jadwal_waktu'][]=json_encode($parameter);

                            $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['item'][]=[
                                'id_jenis_jadwal'=>$value->id_jenis_jadwal,
                                'type_jadwal'=>$value->type_jadwal,
                                'nm_jenis_jadwal'=>$value->nm_jenis_jadwal,
                                'bg_color'=>$value->bg_color,
                                'masuk_kerja'=>$value->masuk_kerja,
                                'pulang_kerja'=>$value->pulang_kerja,
                                'pulang_kerja_next_day'=>$value->pulang_kerja_next_day,
                            ];

                            if($value->type_jadwal==1){
                                if(empty( $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_kerja'] )){
                                    $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_kerja']=1;
                                }else{
                                    $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_kerja']++;
                                }

                                if(empty($list_option_data[$value->id_template_jadwal_shift]['jml_kerja_minggu'])){
                                    $list_option_data[$value->id_template_jadwal_shift]['jml_kerja_minggu']=1;
                                }else{
                                    $list_option_data[$value->id_template_jadwal_shift]['jml_kerja_minggu']++;
                                }

                                $masuk=(new \App\Http\Traits\AbsensiFunction)->his_to_seconds($value->masuk_kerja);
                                $pulang=(new \App\Http\Traits\AbsensiFunction)->his_to_seconds($value->pulang_kerja);
                                
                                if(empty($value->pulang_kerja_next_day)){
                                    $total_kerja=$pulang-$masuk;
                                }else{
                                    $total_kerja=$masuk-$pulang;
                                }

                                if(empty($data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['total_kerja_per_hari'])){
                                    $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['total_kerja_per_hari']=$total_kerja;
                                }else{
                                    $total_kerja_per_hari_tmp=$data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['total_kerja_per_hari'];
                                    $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['total_kerja_per_hari']=$total_kerja_per_hari_tmp+$total_kerja;
                                }
                                
                                if(empty($list_option_data[$value->id_template_jadwal_shift]['total_kerja_minggu'])){
                                    $list_option_data[$value->id_template_jadwal_shift]['total_kerja_minggu']=$total_kerja;
                                }else{
                                    $total_kerja_tmp=$list_option_data[$value->id_template_jadwal_shift]['total_kerja_minggu'];
                                    $list_option_data[$value->id_template_jadwal_shift]['total_kerja_minggu']=$total_kerja_tmp+$total_kerja;
                                }
                            }

                            if($value->type_jadwal==2){

                                if(empty( $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_libur'] )){
                                    $data_template_jadwal_shift[$value->id_template_jadwal_shift][$val_tgl]['jml_libur']=1;
                                }

                                if(empty($list_option_data[$value->id_template_jadwal_shift]['jml_libur_minggu'])){
                                    $list_option_data[$value->id_template_jadwal_shift]['jml_libur_minggu']=1;
                                }else{
                                    $list_option_data[$value->id_template_jadwal_shift]['jml_libur_minggu']++;
                                }
                            }
                            
                        }
                    }
                }
            }
        }

        // $filter_tahun_bulan="2023-01";
        // $tgl1 = new \DateTime($filter_tahun_bulan);
        // dd($tgl1);

        // $get_tgl_per_bulan=(new \App\Http\Traits\AbsensiFunction)->get_tgl_per_bulan($filter_tahun_bulan);
        // dd($get_tgl_per_bulan);


        $datetime_1 = '2023-05-01';
        
        $tgl1 = new \DateTime($datetime_1);
        $tgl2 = new \DateTime($datetime_1);
        $tgl2->modify('+11 month');
        // $tgl2 = new \DateTime($datetime_2);
        // dd($tgl1,$tgl2);

        $get_diff = $tgl1->diff($tgl2);


        foreach($data_template_jadwal_shift as $key => $value){
            if(!empty($list_option_data_2[$key])){
                $tgl_mulai=$list_option_data_2[$key]['tgl_mulai'];
                $tgl_mulai_tmp = new \DateTime($tgl_mulai);
                $year_month=$tgl_mulai_tmp->format('Y-m');
                $tgl=$year_month.'-'.$key;
                

                $tgl1 = new \DateTime($tgl);
                $tgl2 = new \DateTime($tgl);
                $tgl2->modify('+12 month');
                $tgl2_end=$tgl2->format('Y-m-d');

                $get_diff = $tgl1->diff($tgl2);

                $hasil=$this->putar($tgl1->format('Y-m-d'),$tgl2_end,[]);
                dd($hasil);
                

                dd($year_month,$tgl1,$tgl2,$get_diff->days,$tgl2_end);
            }
            dd($value,$list_option_data_2);
        }
        $data=[];
        $datetime_1 = '2023-05-01';
        $data[]=$datetime_1;
        for($i=1; $i<=60; $i++ ){
            $tgl1 = new \DateTime($datetime_1);
            $tgl2 = new \DateTime($datetime_1);
            $vv=$i*8;
            $tgl2->modify('+'.$vv.' day');
            $data[]=$tgl2->format('Y-m-d');
        }
        dd($data);

        // dd($tgl1,$tgl2,$get_diff,$get_diff->format('%y'));
        // die;

        // $tgl1 = new \DateTime($datetime_1);
        // dd($tgl1);
        
        // // for ($i=1; $i <=$get_diff->days ; $i++) { 
        // //     // dd($i);
        // // }

        // dd($get_diff,$data_template_jadwal_shift[1]);
 

        // dd($data_template_jadwal_shift[1],$get_tgl_per_bulan);
        

        $data_template_jadwal_shift_tmp=$data_template_jadwal_shift;
        $list_data=[];
        
        foreach($data_template_jadwal_shift_tmp as $key => $item){
            $list_option_data[$key]['jml_kerja_bulan']=$list_option_data[$key]['jml_kerja_minggu'];
            $list_option_data[$key]['jml_libur_bulan']=$list_option_data[$key]['jml_libur_minggu'];
            $list_option_data[$key]['total_kerja_bulan']=$list_option_data[$key]['total_kerja_minggu'];
            foreach($item as $key_hari => $val_hasil){
                for($i=1; $i<=4; $i++){
                    $jml=$i*count($item);
                    $tgl_hasil=$jml+$key_hari;
                    if($tgl_hasil<=31){
                        $data_template_jadwal_shift_tmp[$key][$tgl_hasil]=$val_hasil;
                        if(!empty($data_template_jadwal_shift_tmp[$key][$tgl_hasil]['jml_kerja'])){
                            $tmp=$list_option_data[$key]['jml_kerja_bulan'];
                            $list_option_data[$key]['jml_kerja_bulan']=$tmp+$data_template_jadwal_shift_tmp[$key][$tgl_hasil]['jml_kerja'];
                        }

                        if(!empty($data_template_jadwal_shift_tmp[$key][$tgl_hasil]['jml_libur'])){
                            $tmp=$list_option_data[$key]['jml_libur_bulan'];
                            $list_option_data[$key]['jml_libur_bulan']=$tmp+$data_template_jadwal_shift_tmp[$key][$tgl_hasil]['jml_libur'];
                        }

                        if(!empty($data_template_jadwal_shift_tmp[$key][$tgl_hasil]['total_kerja_per_hari'])){
                            $tmp=$list_option_data[$key]['total_kerja_bulan'];
                            $list_option_data[$key]['total_kerja_bulan']=$tmp+$data_template_jadwal_shift_tmp[$key][$tgl_hasil]['total_kerja_per_hari'];
                        }
                    }
                }
            }
            ksort($data_template_jadwal_shift_tmp[$key]);
            dd($data_template_jadwal_shift_tmp[$key]);
            $list_data[$key]['item']=json_encode($data_template_jadwal_shift_tmp[$key]);
        }

        foreach($list_data as $key => $item){
            if(!empty($list_option_data[$key])){
                $list_data[$key]=array_merge($list_option_data[$key],$list_data[$key]);
            }
        }
        return $list_data;
    }
}