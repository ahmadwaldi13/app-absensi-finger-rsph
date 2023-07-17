<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\DataAbsensiKaryawan;
use App\Services\RefJadwalService;

class DataAbsensiKaryawanService extends BaseService
{
    public $dataAbsensiKaryawan,$refJadwalService;

    public function __construct(){
        parent::__construct();
        $this->dataAbsensiKaryawan = new DataAbsensiKaryawan;
        $this->refJadwalService = new RefJadwalService;
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
                    left join (
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

    function get_data_by_jadwal_rutin($request){
        $form_filter_text=!empty($request->form_filter_text) ? $request->form_filter_text : '';
        $filter_date_start=!empty($request->filter_date_start) ? $request->filter_date_start : date('Y-m-d');
        $filter_date_end=!empty($request->filter_date_end) ? $request->filter_date_end : date('Y-m-d');

        $filter_id_jabatan=!empty($request->filter_id_jabatan) ? $request->filter_id_jabatan : '';
        $filter_id_departemen=!empty($request->filter_id_departemen) ? $request->filter_id_departemen : '';
        $filter_id_ruangan=!empty($request->filter_id_ruangan) ? $request->filter_id_ruangan : '';

        $filter_status_absensi=!empty($request->filter_status_absensi) ? $request->filter_status_absensi : '';
        $filter_cara_absensi=!empty($request->filter_cara_absensi) ? $request->filter_cara_absensi : '';

        $paramater_data_karyawan_rutin=[
            'search'=>$form_filter_text,
            'id_jenis_jadwal_tmp'=>1,
        ];

        if(!empty($filter_id_jabatan)){
            $paramater_data_karyawan_rutin['id_jabatan']=$filter_id_jabatan;
        }

        if(!empty($filter_id_departemen)){
            $paramater_data_karyawan_rutin['id_departemen']=$filter_id_departemen;
        }

        $list_data_karyawan_rutin = $this->getListKaryawanByJadwal($paramater_data_karyawan_rutin, 1)->select(DB::raw('group_concat(id_karyawan) as id_karyawan'),DB::raw('group_concat(id_user) as id_user'))->first();

        $parameter_first=[
            'tanggal'=>[$filter_date_start,$filter_date_end],
            'list_id_karyawan'=>!empty($list_data_karyawan_rutin->id_karyawan) ? $list_data_karyawan_rutin->id_karyawan : '',
            'list_id_user'=>!empty($list_data_karyawan_rutin->id_user) ? $list_data_karyawan_rutin->id_user : '',
        ];

        $list_absensi=$this->getDataAbsensi($parameter_first,1)->get();

        $data_jadwal_rutin=[];
        $get_jadwal_rutin = $this->refJadwalService->getList(['ref_jadwal.id_jenis_jadwal'=>1], 1)->get();
        if(!empty($get_jadwal_rutin)){
            foreach($get_jadwal_rutin as $val){
                $data_jadwal_rutin[$val->id_jadwal]=(object)$val->getAttributes();
            }
        }

        $data_absensi=[];
        foreach($list_absensi as $value){
            $hasil=(new \App\Http\Traits\AbsensiFunction)->proses_absensi_rutin($get_jadwal_rutin,$value);
            $tgl_filter=trim($value->tanggal);

            if(empty($data_absensi[$tgl_filter]['tgl'])){
                $data_absensi[$tgl_filter]['tgl']=$tgl_filter;
            }

            if(empty($data_absensi[$tgl_filter]['data'][$value->id_user]['data_karyawan'])){
                $paramter_data=(object)[
                    'id_user'=>!empty($value->id_user) ? $value->id_user : '',
                    'username'=>!empty($value->username) ? $value->username : '',
                    'id_karyawan'=>!empty($value->id_karyawan) ? $value->id_karyawan : '',
                    'nm_karyawan'=>!empty($value->nm_karyawan) ? $value->nm_karyawan : '',
                    'alamat'=>!empty($value->alamat) ? $value->alamat : '',
                    'nip'=>!empty($value->nip) ? $value->nip : '',
                    'id_jabatan'=>!empty($value->id_jabatan) ? $value->id_jabatan : '',
                    'nm_jabatan'=>!empty($value->nm_jabatan) ? $value->nm_jabatan : '',
                    'id_departemen'=>!empty($value->id_departemen) ? $value->id_departemen : '',
                    'nm_departemen'=>!empty($value->nm_departemen) ? $value->nm_departemen : '',
                    'id_ruangan'=>!empty($value->id_ruangan) ? $value->id_ruangan : '',
                    'nm_ruangan'=>!empty($value->nm_ruangan) ? $value->nm_ruangan : '',
                ];
                $data_absensi[$tgl_filter]['data'][$value->id_user]['data_karyawan']=$paramter_data;
            }

            if(empty($data_absensi[$tgl_filter]['data'][$value->id_user]['data_jadwal'])){
                $data_absensi[$tgl_filter]['data'][$value->id_user]['data_jadwal']=$data_jadwal_rutin;
            }

            if(empty($data_absensi[$tgl_filter]['data'][$value->id_user]['absensi'][$hasil->id_jadwal])){
                $data_absensi[$tgl_filter]['data'][$value->id_user]['absensi'][$hasil->id_jadwal]=$hasil;
            }

            if($hasil->id_jadwal==0){
                $data_absensi[$tgl_filter]['data'][$value->id_user]['absensi_luar_jadwal'][]=!empty($hasil->jam_absensi) ? $hasil->jam_absensi : '';
            }

            $data_absensi[$tgl_filter]['data'][$value->id_user]['absensi_log'][]=!empty($hasil->jam_absensi) ? $hasil->jam_absensi : '';

        }

        return $data_absensi;
    }
}