<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

use App\Http\Traits\AbsensiFunction;

trait PresensiHitungRutinTraits {

    public $absensif;
    public function __construct()
    {
        $this->absensif = new AbsensiFunction;
    }

    public function getWaktuKerja($params){
        DB::statement("SET GLOBAL group_concat_max_len = 15000;");
        $query=DB::table(DB::raw(
            '(
                SELECT
                    utama.*,
                    JSON_OBJECTAGG(
                        kd_jadwal,
                        JSON_ARRAY(
                            kd_jadwal,
                            uraian,
                            alias,
                            TIME_FORMAT(jam_awal,"%H:%i:%s"),
                            TIME_FORMAT(jam_akhir,"%H:%i:%s"),
                            status_toren_jam_cepat,
                            TIME_FORMAT(toren_jam_cepat,"%H:%i:%s"),
                            status_toren_jam_telat,
                            TIME_FORMAT(toren_jam_telat,"%H:%i:%s"),
                            status_jadwal
                        )
                    ) AS data_jadwal
                FROM
                    ( SELECT * FROM ref_jenis_jadwal WHERE id_jenis_jadwal = '.$params['id_jenis_jadwal'].' ) utama
                    INNER JOIN ref_jadwal jadwal ON jadwal.id_jenis_jadwal = utama.id_jenis_jadwal 
                GROUP BY
                    utama.id_jenis_jadwal
                ) utama'
        ));

        return $query;
    }

    public function rumus_3_jadwal($hasil_presensi,$data_jadwal_kerja){
        $list_kd_jadwal=[1,2,4];
        if($hasil_presensi and $data_jadwal_kerja){
            $masuk_kerja=!empty($data_jadwal_kerja->masuk_kerja) ? $data_jadwal_kerja->masuk_kerja : '';
            $pulang_kerja=!empty($data_jadwal_kerja->pulang_kerja) ? $data_jadwal_kerja->pulang_kerja : '';
            $awal_istirahat=!empty($data_jadwal_kerja->awal_istirahat) ? $data_jadwal_kerja->awal_istirahat : '';
            $akhir_istirahat=!empty($data_jadwal_kerja->akhir_istirahat) ? $data_jadwal_kerja->akhir_istirahat : '';

            $masuk_kerja_sec=$this->absensif->his_to_seconds($masuk_kerja);
            $pulang_kerja_sec=$this->absensif->his_to_seconds($pulang_kerja);
            $awal_istirahat_sec=$this->absensif->his_to_seconds($awal_istirahat);
            $akhir_istirahat_sec=$this->absensif->his_to_seconds($akhir_istirahat);

            $total_istirahat_sec=$akhir_istirahat_sec-$awal_istirahat_sec;
            $total_kerja_default_sec=($pulang_kerja_sec-$masuk_kerja_sec)-$total_istirahat_sec;

            $user_presensi_masuk=!empty($hasil_presensi[1]) ? $hasil_presensi[1] : [];
            $user_presensi_masuk=!empty($user_presensi_masuk->user_presensi) ? $user_presensi_masuk->user_presensi : '00:00:00';
            $user_presensi_masuk_sec=$this->absensif->his_to_seconds($user_presensi_masuk);

            $user_presensi_istirahat=!empty($hasil_presensi[2]) ? $hasil_presensi[2] : [];
            $user_presensi_istirahat=!empty($user_presensi_istirahat->user_presensi) ? $user_presensi_istirahat->user_presensi : '00:00:00';
            $user_presensi_istirahat_sec=$this->absensif->his_to_seconds($user_presensi_istirahat);

            $user_presensi_pulang=!empty($hasil_presensi[4]) ? $hasil_presensi[4] : [];
            $user_presensi_pulang=!empty($user_presensi_pulang->user_presensi) ? $user_presensi_pulang->user_presensi : '00:00:00';
            $user_presensi_pulang_sec=$this->absensif->his_to_seconds($user_presensi_pulang);

            $list_hasil_user_prensensi=[];

            foreach($list_kd_jadwal as $kd_jadwal){
                $hasil_check='a';
                if(!empty($hasil_presensi[$kd_jadwal])){
                    $gd=$hasil_presensi[$kd_jadwal];
                    //abaikan jika gak ada data
                    if(!empty($gd->hasil_check)){
                        $value_check=str_replace($kd_jadwal,'',$gd->hasil_check);
                        $value_check=!empty($value_check) ? $value_check : 'h';
                        
                        if($value_check=='-'){
                            $hasil_check=1;
                        }elseif($value_check=='h'){
                            $hasil_check=2;
                        }elseif($value_check=='+'){
                            $hasil_check=3;
                        }
                    }
                }
                $list_hasil_user_prensensi[]=$hasil_check;
            }
            

            $list_rumus=[
                'list_alpa'=>[
                    ['a',2,'a'],['a','a',2],['a','a','a'],['a','a',3],['a','a',1],['a',3,'a'],['a',1,'a'],
                ],
                'list_normal'=>[
                    [2,2,2],[2,2,3],[2,'a',2],[2,'a',3],[2,3,2],[2,3,3],[2,1,2],[2,1,3],[1,2,2],[1,2,3],[1,'a',2],[1,'a',3],[1,3,2],[1,3,3],[1,1,2],[1,1,3],
                ],
                'list_p1'=>[
                    [3,2,2],[3,2,3],[3,'a',2],[3,'a',3],[3,3,2],[3,3,3],[3,1,2],[3,1,3],
                ],
                'list_p2'=>[
                    ['a',2,2],['a',2,3],['a',3,2],['a',3,3],['a',1,2],['a',1,3],
                ],
                'list_p3'=>[
                    [2,2,'a'],[2,3,'a'],[2,1,'a'],[1,2,'a'],[1,3,'a'],[1,1,'a'],
                ],
                // 'list_p4'=>[
                //     [3,2,'a'],[3,3,'a'],[3,1,'a'],
                // ],
                // 'list_p5'=>[
                //     [2,2,1],[2,'a',1],[2,3,1],[2,1,1],[1,2,1],[1,'a',1],[1,3,1],[1,1,1],
                // ],
                // 'list_p6'=>[
                    
                // ],
                
                
            ];

            $get_hasil_rumus=[];
            foreach($list_rumus as $key => $val){
                $check_ada=0;
                foreach($val as $key_c => $val_c){
                    if($val_c===$list_hasil_user_prensensi){
                        $check_ada++;
                    }
                }   
                if($check_ada){
                    $get_hasil_rumus[$key]=$check_ada;
                }
            }

            if(!empty($get_hasil_rumus['list_alpa'])){
                /* 
                    masuk= Alpa,
                    istirahat= alpa,hadir,telat,cepat,
                    pulang= alpa,hadir,telat,cepat,
                */
                $mulai_kerja_sec=0;
                $pulang_kerja_sec=0;
                $total_kerja_sec=0;
            }elseif(!empty($get_hasil_rumus['list_normal'])){
                /* 
                    masuk= hadir,cepat,
                    istirahat= alpa,hadir,telat,cepat,
                    pulang= hadir,telat,
                */
                $mulai_kerja_sec=$masuk_kerja_sec;
                $pulang_kerja_sec=$pulang_kerja_sec;
                $total_kerja_sec=$total_kerja_default_sec;
            }elseif(!empty($get_hasil_rumus['list_p1'])){
                /* 
                    masuk= telat,
                    istirahat= alpa,hadir,telat,cepat,
                    pulang= hadir,telat,
                */
                $mulai_kerja_sec=$user_presensi_masuk_sec;
                $pulang_kerja_sec=$pulang_kerja_sec;
                $total_kerja_sec=($pulang_kerja_sec-$masuk_kerja_sec)-$total_istirahat_sec;
            }elseif(!empty($get_hasil_rumus['list_p2'])){
                /* 
                    masuk= alpa,
                    istirahat= hadir,telat,cepat,
                    pulang= hadir,telat,
                */
                $mulai_kerja_sec=$akhir_istirahat_sec;
                $pulang_kerja_sec=$pulang_kerja_sec;
                $total_kerja_sec=$pulang_kerja_sec-$masuk_kerja_sec;
            }elseif(!empty($get_hasil_rumus['list_p3'])){
                /* 
                    masuk= hadir,cepat,
                    istirahat= hadir,telat,cepat,
                    pulang= alpa,
                */
                $mulai_kerja_sec=$masuk_kerja_sec;
                $pulang_kerja_sec=$awal_istirahat_sec;
                $total_kerja_sec=$pulang_kerja_sec-$masuk_kerja_sec;
            }
            // elseif(!empty($get_hasil_rumus['list_p4'])){
            //     /* 
            //         masuk= telat,
            //         istirahat= hadir,telat,cepat,
            //         pulang= alpa,
            //     */
            //     $mulai_kerja_sec=$user_presensi_masuk_sec;
            //     $pulang_kerja_sec=$awal_istirahat_sec;
            //     $total_kerja_sec=$pulang_kerja_sec-$masuk_kerja_sec;
            // }
            // elseif(!empty($get_hasil_rumus['list_p5'])){
            //     /* 
            //         masuk= hadir,cepat,
            //         istirahat= hadir,alpa,telat,cepat,
            //         pulang= cepat,
            //     */
            //     $mulai_kerja_sec=$masuk_kerja_sec;
            //     $pulang_kerja_sec=$user_presensi_pulang_sec;
            //     $total_kerja_sec=$pulang_kerja_sec-$masuk_kerja_sec;
            // }
            // elseif(!empty($get_hasil_rumus['list_p6'])){
                
            // }
            


    
            $hasil_jam_kerja=[
                'mulai_kerja_sec'=>!empty($mulai_kerja_sec) ? $mulai_kerja_sec : 0,
                'mulai_kerja'=>!empty($mulai_kerja_sec) ? gmdate("H:i:s", $mulai_kerja_sec) : '00:00:00',
                'pulang_kerja_sec'=>!empty($pulang_kerja_sec) ? $pulang_kerja_sec : 0,
                'pulang_kerja'=>!empty($pulang_kerja_sec) ? gmdate("H:i:s", $pulang_kerja_sec) : '00:00:00',
                'total_kerja_sec'=>!empty($total_kerja_sec) ? $total_kerja_sec : 0,
                'total_kerja'=>!empty($total_kerja_sec) ? gmdate("H:i:s", $total_kerja_sec) : '00:00:00',
            ];
            dd($list_hasil_user_prensensi,$hasil_jam_kerja);
            

            // if(!empty($hasil_presensi[2])){

            // }

            // if(!empty($hasil_presensi[3])){

            // }

            dd($hasil_presensi,$data_jadwal_kerja);

        }
    }

    public function getProses($data=[]){
        $list_presensi=!empty($data['list_presensi']) ? explode(',',$data['list_presensi']) : '';
        $list_data=!empty($data['list_data']) ? $data['list_data'] : '';
        $data_jadwal_kerja=!empty($data['data_jadwal_kerja']) ? $data['data_jadwal_kerja'] : '';
        $data_jadwal_mesin=!empty($data_jadwal_kerja->data_jadwal) ? $data_jadwal_kerja->data_jadwal : '';
        
        $hasil_presensi_by_mesin=$this->absensif->get_presensi_by_jadwal_mesin($data_jadwal_mesin,$list_presensi);
        $hasil_presensi_user=!empty($hasil_presensi_by_mesin->hasil_presensi) ? $hasil_presensi_by_mesin->hasil_presensi : '';

        $hasil_hitung=$this->rumus_3_jadwal($hasil_presensi_user,$data_jadwal_kerja);
        
        dd(
            $hasil_presensi_by_mesin,
            $data_jadwal_kerja,
            $hasil_hitung
        );
    }
    
}

class PresensiHitungRutinFunction {
    use presensiHitungRutinTraits;
}

?>