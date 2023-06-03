<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class RefDataAbsensiTmpService extends BaseService
{
    public function __construct(){
        parent::__construct();
    }

    public function getList($params=[]){
        ini_set("memory_limit","800M");

        $parameter_filter=[
            $params['tanggal']
        ];

        $query=DB::table(DB::raw('(select
                    id_mesin_absensi,
                    id_user,
                    waktu as waktu_absensi,
                    verified,
                    status as status_absensi
                from
                    ref_data_absensi_tmp
                where
                    date(waktu)="'.$params['tanggal'].'") utama')
                )
                ->join(DB::raw('(select
                                    utama.id_user as idu1,
                                    name as username,
                                    karyawan.*
                                from ref_user_info utama
                                left join (
                                    select rk.*,id_user as idu,id_jenis_jadwal
                                    from ref_karyawan_user rku
                                    inner join ref_karyawan rk on rk.id_karyawan=rku.id_karyawan
                                    left join ref_karyawan_jadwal rkj on rkj.id_karyawan=rk.id_karyawan
                                )karyawan on karyawan.idu=utama.id_user) data_user'),'data_user.idu1','=','utama.id_user'
                )
                ->orderByRaw('UNIX_TIMESTAMP( waktu_absensi )','ASC')
        ;

        return $query;
    }
}