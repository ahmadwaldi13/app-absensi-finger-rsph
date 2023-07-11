<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\DataAbsensiKaryawan;

class DataAbsensiKaryawanService extends BaseService
{
    public $dataAbsensiKaryawan;
    
    public function __construct(){
        parent::__construct();
        $this->dataAbsensiKaryawan = new DataAbsensiKaryawan;
    }

    function getListKaryawanByJadwal($params=[],$type){
        $query=DB::table(DB::raw(
            '(
                select 
                    utama.id_karyawan,
                    rku.id_user,
                    id_jenis_jadwal,
                    nm_karyawan,
                    alamat,
                    nip,
                    rj.id_jabatan,
                    nm_jabatan,
                    rd.id_departemen,
                    nm_departemen,
                    rr.id_ruangan,
                    nm_ruangan
                from ( 
                    select * from ref_karyawan_jadwal
                    '.(!empty($params['id_jenis_jadwal_tmp']) ? 'where id_jenis_jadwal='.$params['id_jenis_jadwal_tmp'] : '' ).'
                ) utama
                inner join ref_karyawan_user rku on rku.id_karyawan=utama.id_karyawan
                inner join ref_karyawan rk on rk.id_karyawan=utama.id_karyawan
                left join ref_jabatan rj on rj.id_jabatan=rk.id_jabatan
                left join ref_departemen rd on rd.id_departemen=rk.id_departemen
                left join ref_ruangan rr on rr.id_ruangan=rk.id_ruangan
            ) utama'
            ))
        ;

        $list_search=[
            'where_or'=>['nm_karyawan'],
        ];

        unset($params['id_jenis_jadwal_tmp']);

        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }
        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }
    
    function getDataAbsensi($params=[],$type=''){
        $list_id_karyawan=!empty($params['list_id_karyawan']) ? $params['list_id_karyawan'] : 0;
        $list_id_user=!empty($params['list_id_user']) ? $params['list_id_user'] : 0;

        $tanggal_bettween=!empty($params['tanggal']) ? $params['tanggal'] : [date('Y-m-d'),date('Y-m-d')];
        
        $query=DB::table(DB::raw(
            '(
                select 
                    utama.*,
                    karyawan.*
                from (
                    select
                        utama.id_mesin_absensi,
                        nm_mesin,
                        lokasi_mesin,
                        id_user,
                        username,
                        waktu as waktu_absensi,
                        DATE(waktu) as tanggal,
                        lcase(replace(trim(DATE(waktu)),"-","") ) as tanggal_uniq,
                        TIME(waktu) as jam,
                        verified as verified_mesin,
                        status as status_absensi_mesin
                    from
                        ( select * from ref_data_absensi_tmp where date(waktu) BETWEEN "'.$tanggal_bettween[0].'" and "'.$tanggal_bettween[1].'" and id_user in ('.$list_id_user.') order by id_user,UNIX_TIMESTAMP( waktu ) asc  ) utama
                        inner join ref_mesin_absensi rma on rma.id_mesin_absensi = utama.id_mesin_absensi
                        left join (
                            select 
                                id_user id_user_info,
                                name username
                            from ref_user_info 
                            where id_user in ('.$list_id_user.')
                        )user_info on user_info.id_user_info=utama.id_user
                )utama
                left join (
                    select 
                        utama.id_user id_user_karyawan,
                        karyawan.*
                    from( 
                        select id_user,id_karyawan 
                        from ref_karyawan_user 
                        where id_user in ('.$list_id_user.') 
                    ) utama 
                    inner join (
                        select 
                            utama.*,
                            nm_jabatan,
                            nm_departemen,
                            nm_ruangan
                        from(
                            select * from ref_karyawan where id_karyawan in ('.$list_id_karyawan.') 
                        )utama
                        left join ref_jabatan rj on rj.id_jabatan=utama.id_jabatan
                        left join ref_departemen rd on rd.id_departemen=utama.id_departemen
                        left join ref_ruangan rr on rr.id_ruangan=utama.id_ruangan
                    )karyawan on karyawan.id_karyawan=utama.id_karyawan 
                ) karyawan on karyawan.id_user_karyawan=utama.id_user 
            ) utama'

            ))
        ;

        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
        
    }


    public function hitung_waktu_absensi($awal,$akhir){
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

    function proses_absensi_rutin($get_jadwal_rutin,$data){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        $check_nilai_jadwal=[];
        if(!empty($get_jadwal_rutin)){
            foreach($get_jadwal_rutin as $val_jadwal){
                $jam_mulai=$val_jadwal->jam_awal;
                $jam_akhir=$val_jadwal->jam_akhir;
                $jam_absensi=$data->jam;

                $jadwal_masuk_str = strtotime($jam_mulai);
                $jadwal_tutup_str = strtotime($jam_akhir);
                $absensi_str = strtotime($jam_absensi);

                $hasil_absensi=[];
                if(($jadwal_masuk_str <= $absensi_str) and ($jadwal_tutup_str >= $absensi_str)){
                    $type_status=1;
                    $selisih_waktu=(array)$this->hitung_waktu_absensi($absensi_str,$jadwal_tutup_str);
                }elseif($absensi_str > $jadwal_tutup_str ){
                    $type_status=2;
                    $selisih_waktu=(array)$this->hitung_waktu_absensi($jadwal_tutup_str,$absensi_str);
                }else{
                    $type_status=3;
                }
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
        if(!empty($check_nilai_jadwal[1])){
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
            $hasil_absensi_tmp=[
                'hasil_status_absensi'=>$index_me,
                'hasil_status_absensi_text'=>'Di Luar Jadwal',
            ];
            $hasil_absensi=array_merge($hasil_absensi,$hasil_absensi_tmp);
        }

        return (object)$hasil_absensi;
    }
}