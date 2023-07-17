<?php

namespace App\Http\Traits;

use Hamcrest\Arrays\IsArray;
use Hamcrest\Type\IsObject;

trait AbsensiTraits {

    public function hitung_selisih_waktu($awal,$akhir){
        $diff  = $akhir - $awal;

        $jam   = floor($diff / (60 * 60));
        $menit = $diff - ( $jam * (60 * 60) );
        $detik = $diff % 60;

        return (object)[
            'jam'=>$jam,
            'menit'=>floor( $menit / 60 ),
            'detik'=>$detik,
        ];
    }

    public function hitung_waktu_by_seccond($waktu){
        $jam   = floor($waktu / (60 * 60));
        $menit = $waktu - ( $jam * (60 * 60) );
        $detik = $waktu % 60;

        return (object)[
            'jam'=>$jam,
            'menit'=>floor( $menit / 60 ),
            'detik'=>$detik,
        ];
    }

    public function his_to_seconds($time){
        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $time);
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        return  $hours * 3600 + $minutes * 60 + $seconds;
    }

    function proses_absensi_rutin($get_jadwal_rutin,$data){
        /*
            Lebih Cepat = 4
            Tepat Waktu = 1
            Terlambat = 2
            Di luar Jadwal = 3
        */

        ini_set("memory_limit","800M");
        set_time_limit(0);

        $onejam= 3600;
        $onemenit= 60;
        $hitung_plus_mulai=$onejam*0 + $onemenit*30;
        $hitung_plus_akhir=$onejam*0 + $onemenit*30;

        $get_jadwal_phitung=(new \App\Models\RefJadwalPhitung)->where(['type'=>'Rutin'])->get();
        if($get_jadwal_phitung){
            foreach($get_jadwal_phitung as $get_data){
                if($get_data->jenis=="Mulai"){
                    $hitung_plus_mulai=($onejam*$get_data->jam)+($onemenit*$get_data->menit);
                }

                if($get_data->jenis=="Akhir"){
                    $hitung_plus_akhir=($onejam*$get_data->jam)+($onemenit*$get_data->menit);
                }
            }
        }

        $check_nilai_jadwal=[];
        if(!empty($get_jadwal_rutin)){

            foreach($get_jadwal_rutin as $val_jadwal){
                $jam_mulai=$val_jadwal->jam_awal;
                $jam_akhir=$val_jadwal->jam_akhir;
                $jam_absensi=$data->jam;

                $jadwal_masuk_str = strtotime($jam_mulai);
                $jadwal_tutup_str = strtotime($jam_akhir);
                $absensi_str = strtotime($jam_absensi);

                $jam_mulai_kurang_str = $jadwal_masuk_str - $hitung_plus_mulai;
                $jam_akhir_tambah_str = $jadwal_tutup_str + $hitung_plus_akhir;

                if(($jam_mulai_kurang_str <= $absensi_str) and ($jadwal_masuk_str > $absensi_str)){
                    /* Lebih Cepat */
                    $type_status=4;
                    $selisih_waktu=(array)$this->hitung_selisih_waktu($absensi_str,$jadwal_masuk_str);
                }elseif( ($jadwal_masuk_str <= $absensi_str) and ($jadwal_tutup_str >= $absensi_str) ){
                    /* Tepat Waktu */
                    $type_status=1;
                    $selisih_waktu=(array)$this->hitung_selisih_waktu($absensi_str,$jadwal_tutup_str);
                }elseif( ( $absensi_str > $jadwal_tutup_str ) and ( $absensi_str <= $jam_akhir_tambah_str ) ){
                    /* Terlambat */
                    $type_status=2;
                    $selisih_waktu=(array)$this->hitung_selisih_waktu($jadwal_tutup_str,$absensi_str);
                }else{
                    /* Di Luar Jadwal */
                    $type_status=3;
                }

                // if(($jadwal_masuk_str <= $absensi_str) and ($jadwal_tutup_str >= $absensi_str)){
                //     $type_status=1;
                //     $selisih_waktu=(array)$this->hitung_selisih_waktu($absensi_str,$jadwal_tutup_str);
                // }elseif($absensi_str > $jadwal_tutup_str ){
                //     $type_status=2;
                //     $selisih_waktu=(array)$this->hitung_selisih_waktu($jadwal_tutup_str,$absensi_str);
                // }else{
                //     $type_status=3;
                // }

                $check_nilai_jadwal[$type_status]=[
                    'id_mesin_absensi'=>$data->id_mesin_absensi,
                    'nm_mesin'=>$data->nm_mesin,
                    'lokasi_mesin'=>$data->lokasi_mesin,
                    'verified_mesin'=>$data->verified_mesin,
                    'id_jenis_jadwal'=>$val_jadwal->id_jenis_jadwal,
                    'nm_jenis_jadwal'=>$val_jadwal->nm_jenis_jadwal,
                    'id_jadwal'=>$val_jadwal->id_jadwal,
                    'nm_jadwal'=>$val_jadwal->uraian,
                    'jam_mulai'=>$jam_mulai,
                    'jam_akhir'=>$jam_akhir,
                    'jam_absensi'=>$jam_absensi,
                    'selisih_waktu'=>!empty($selisih_waktu) ? $selisih_waktu : ''
                ];
            }
        }

        $hasil_absensi=[];
        if(!empty($check_nilai_jadwal[4])){
            $index_me=4;
            $hasil_absensi=$check_nilai_jadwal[$index_me];
            $hasil_absensi_tmp=[
                'hasil_status_absensi'=>$index_me,
                'hasil_status_absensi_text'=>'Lebih Cepat',
            ];
            $hasil_absensi=array_merge($hasil_absensi,$hasil_absensi_tmp);
        }elseif(!empty($check_nilai_jadwal[1])){
            $index_me=1;
            $hasil_absensi=$check_nilai_jadwal[$index_me];
            $hasil_absensi_tmp=[
                'hasil_status_absensi'=>$index_me,
                'hasil_status_absensi_text'=>'Tidak Telat',
            ];
            $hasil_absensi=array_merge($hasil_absensi,$hasil_absensi_tmp);
        }elseif(!empty($check_nilai_jadwal[2])){
            $index_me=2;
            $hasil_absensi=$check_nilai_jadwal[$index_me];
            $hasil_absensi_tmp=[
                'hasil_status_absensi'=>$index_me,
                'hasil_status_absensi_text'=>'Telat',
            ];
            $hasil_absensi=array_merge($hasil_absensi,$hasil_absensi_tmp);
        }else{
            $index_me=3;
            $hasil_absensi=$check_nilai_jadwal[$index_me];
            $hasil_absensi['id_jadwal']=0;
            $hasil_absensi['nm_jadwal']='';
            $hasil_absensi['jam_mulai']='';
            $hasil_absensi['jam_akhir']='';
            $hasil_absensi_tmp=[
                'hasil_status_absensi'=>$index_me,
                'hasil_status_absensi_text'=>'Di Luar Jadwal',
            ];
            $hasil_absensi=array_merge($hasil_absensi,$hasil_absensi_tmp);
        }

        return (object)$hasil_absensi;
    }

    function get_total_jam_kerja_default(){
        $get_jrutin_tkerja=(new \App\Models\RefJadwalRutinTkerja)->where(['type'=>'+'])->first();
        $jam_mulai_kerja=!empty($get_jrutin_tkerja->jam_awal) ? $get_jrutin_tkerja->jam_awal : 0;
        $jam_selesai_kerja=!empty($get_jrutin_tkerja->jam_akhir) ? $get_jrutin_tkerja->jam_akhir : 0;

        $jam_mulai_kerja_str = strtotime($jam_mulai_kerja);
        $jam_selesai_kerja_str = strtotime($jam_selesai_kerja);
        $selisih_waktu_kerja=$this->hitung_selisih_waktu($jam_mulai_kerja_str,$jam_selesai_kerja_str);
        $selisih_waktu_kerja_detik=( !empty($selisih_waktu_kerja->jam) ? $selisih_waktu_kerja->jam*3600 : 0 ) + ( !empty($selisih_waktu_kerja->menit) ? $selisih_waktu_kerja->menit*60 : 0 ) + ( !empty($selisih_waktu_kerja->detik) ? $selisih_waktu_kerja->detik : 0 ) ;

        $waktu_kurang=0;
        $waktu_kurang_text='';
        $get_jrutin_tkerja_kurang=(new \App\Models\RefJadwalRutinTkerja)->where(['type'=>'-'])->get();
        if($get_jrutin_tkerja_kurang){
            $hasil_jam=0;
            $hasil_menit=0;
            $hasil_detik=0;
            foreach($get_jrutin_tkerja_kurang as $get_data){
                $jam_mulai_kerja=!empty($get_data->jam_awal) ? $get_data->jam_awal : 0;
                $jam_selesai_kerja=!empty($get_data->jam_akhir) ? $get_data->jam_akhir : 0;

                $jam_mulai_kerja_str = strtotime($jam_mulai_kerja);
                $jam_selesai_kerja_str = strtotime($jam_selesai_kerja);

                $selisih_waktu=$this->hitung_selisih_waktu($jam_mulai_kerja_str,$jam_selesai_kerja_str);

                $hasil_jam+=!empty($selisih_waktu->jam) ? $selisih_waktu->jam : 0;
                $hasil_menit+=!empty($selisih_waktu->menit) ? $selisih_waktu->menit : 0;
                $hasil_detik+=!empty($selisih_waktu->detik) ? $selisih_waktu->detik : 0;
            }

            $jam_to_second=!empty($hasil_jam) ? $hasil_jam*3600 : 0;
            $menit_to_second=!empty($hasil_menit) ? $hasil_menit*60 : 0;
            $second_tmp=!empty($hasil_detik) ? $hasil_detik : 0;
            $waktu_kurang=$jam_to_second+$menit_to_second+$second_tmp;
        }

        $selisih_waktu_kerja_detik=($selisih_waktu_kerja_detik>0) ? $selisih_waktu_kerja_detik : 0;
        $waktu_kurang=($waktu_kurang>0) ? $waktu_kurang : 0;
        $total_kerja=$selisih_waktu_kerja_detik-$waktu_kurang;

        return (object)[
            'date'=>gmdate("H:i:s", $total_kerja),
            'strtime'=>$total_kerja,
        ];
    }

    function get_total_jam_kerja_rutin($data_absensi,$jadwal_sistem=[]){

        $total_point=0;
        if($data_absensi){
            $data_masuk=!empty($data_absensi[1]) ? $data_absensi[1] : [];
            $data_istirahat=!empty($data_absensi[2]) ? $data_absensi[2] : [];
            $data_pulang=!empty($data_absensi[3]) ? $data_absensi[3] : [];

            $keterangan_tmp=[];
            if(!empty($data_masuk->hasil_status_absensi)){
                if($data_masuk->hasil_status_absensi==1){
                    $waktu_masuk=$data_masuk->jam_absensi;
                    $total_point++;
                }

                if($data_masuk->hasil_status_absensi==2){
                    $waktu_masuk=$data_masuk->jam_absensi;
                    $keterangan_tmp[]="Terlambat Masuk";
                }

                if($data_masuk->hasil_status_absensi==4){

                }
            }

            if(!empty($data_istirahat->hasil_status_absensi)){
                if($data_istirahat->hasil_status_absensi==1){
                    $total_point++;
                }

                if($data_istirahat->hasil_status_absensi==2){

                }

                if($data_istirahat->hasil_status_absensi==4){

                }
            }

            if(!empty($data_pulang->hasil_status_absensi)){
                if($data_pulang->hasil_status_absensi==1){
                    $waktu_pulang=$data_pulang->jam_absensi;
                    $total_point++;
                }

                if($data_pulang->hasil_status_absensi==2){
                    $waktu_pulang=$data_pulang->jam_absensi;
                }

                if($data_pulang->hasil_status_absensi==4){
                    $waktu_pulang=$data_pulang->jam_absensi;
                    $keterangan_tmp[]="Pulang Cepat";
                }
            }

            if(empty($data_masuk)){
                $keterangan_tmp[]="Tidak Absen Masuk";
            }

            if(empty($data_istirahat)){
                $keterangan_tmp[]="Tidak Absen Istirahat";
            }

            if(empty($data_pulang)){
                $keterangan_tmp[]="Tidak Absen Pulang";
            }

            $total_waktu_kerja=0;
            $total_waktu_kerja_text='';
            if(!empty($waktu_masuk) && !empty($waktu_pulang)){
                $waktu_masuk=$this->his_to_seconds($waktu_masuk);
                $waktu_pulang=$this->his_to_seconds($waktu_pulang);
                $total_waktu_kerja=$waktu_pulang-$waktu_masuk;
                $total_waktu_kerja=$this->hitung_waktu_by_seccond($total_waktu_kerja);
                $total_waktu_kerja_text=$total_waktu_kerja->jam.' jam'.', '.$total_waktu_kerja->menit.' Menit'.', '.$total_waktu_kerja->detik.' Detik';
            }

            if($total_point==0){
                $total_waktu_kerja=0;
                $total_waktu_kerja_text=0;
                $keterangan='Absen';
            }
            if($total_point==3){
                $keterangan='Hadir';
            }
            if($total_point>0 && $total_point<3){
                if(!empty($keterangan_tmp)){
                    $keterangan=implode(',',$keterangan_tmp);
                }
            }
        }

        return (object)[
            'total_waktu_kerja'=>!empty($total_waktu_kerja) ? $total_waktu_kerja : [],
            'total_waktu_kerja_text'=>!empty($total_waktu_kerja_text) ? $total_waktu_kerja_text : [],
            'total_point'=>!empty($total_point) ? $total_point : 0,
            'keterangan'=>!empty($keterangan) ? $keterangan : '',
        ];
    }
}

class AbsensiFunction {
    use absensiTraits;
}

?>