<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DataPresensiRutinService extends BaseService
{
    public $dataAbsensiKaryawan,$refJadwalService;

    public function __construct(){
        parent::__construct();
    }

    function getListKaryawan($params=[],$type){
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
                    select * from ref_karyawan_jadwal where id_jenis_jadwal = 1
                ) utama
                inner join ref_karyawan_user rku on rku.id_karyawan=utama.id_karyawan
                inner join ref_karyawan rk on rk.id_karyawan=utama.id_karyawan
                left join ref_jabatan rj on rj.id_jabatan=rk.id_jabatan
                left join ref_departemen rd on rd.id_departemen=rk.id_departemen
                left join ref_ruangan rr on rr.id_ruangan=rk.id_ruangan
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

    public function getListKaryawanPresensi($params=[],$type){

        $search_parameter=!empty($params['search_parameter']) ? $params['search_parameter'] : [];
        $search_data_karyawan=!empty($params['search_karyawan']) ? $params['search_karyawan'] : [];
        $list_id_user=!empty($search_parameter['list_id_user']) ? $search_parameter['list_id_user'] : 0;
        $parameter_first=[
            'tanggal'=>[!empty($search_parameter['tanggal'][0]) ? $search_parameter['tanggal'][0] : date('Y-m-d'),!empty($search_parameter['tanggal'][1]) ? $search_parameter['tanggal'][1] : date('Y-m-d')],
            'list_id_karyawan'=>!empty($search_parameter['list_id_karyawan']) ? $search_parameter['list_id_karyawan'] : 0,
            'list_id_user'=>$list_id_user,
        ];

        $query=DB::table(DB::raw(
            '(
                '.(new \App\Services\DataPresensiService)->get_log_per_tgl($parameter_first,1)->toSql().'
                LEFT JOIN (
                    select 
                        karyawan.*,
                        utama.id_user id_user_karyawan,
                        nm_jabatan,
                        nm_departemen,
                        nm_ruangan
                    from (
                        select id_user,id_karyawan from ref_karyawan_user where id_user in ('.$list_id_user.') 
                    ) utama 
                    INNER JOIN ref_karyawan karyawan on utama.id_karyawan=karyawan.id_karyawan
                    LEFT JOIN ref_jabatan rj on rj.id_jabatan=karyawan.id_jabatan
                    LEFT JOIN ref_departemen rd on rd.id_departemen=karyawan.id_departemen
                    LEFT JOIN ref_ruangan rr on rr.id_ruangan=karyawan.id_ruangan
                )karyawan on karyawan.id_user_karyawan=utama.id_user
            )utama'
        ));

        $list_search=[
            'where_or'=>['nm_karyawan'],
        ];

        if($search_data_karyawan){
            $query=(new \App\Models\MyModel)->set_where($query,$search_data_karyawan,$list_search);
        }

        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }

    }


    public function getData($params=[],$type){
        $form_filter_text=!empty($params['form_filter_text']) ? $params['form_filter_text'] : '';
        $filter_date_start=!empty($params['filter_date_start']) ? $params['filter_date_start'] : date('Y-m-d');
        $filter_date_end=!empty($params['filter_date_end']) ? $params['filter_date_end'] : date('Y-m-d');

        $filter_id_jabatan=!empty($params['filter_id_jabatan']) ? $params['filter_id_jabatan'] : '';
        $filter_id_departemen=!empty($params['filter_id_departemen']) ? $params['filter_id_departemen'] : '';
        
        $paramater_data_karyawan_rutin=[
            'search'=>$form_filter_text
        ];

        if(!empty($filter_id_jabatan)){
            $paramater_data_karyawan_rutin['id_jabatan']=$filter_id_jabatan;
        }

        if(!empty($filter_id_departemen)){
            $paramater_data_karyawan_rutin['id_departemen']=$filter_id_departemen;
        }
        
        DB::statement("SET GLOBAL group_concat_max_len = 15000;");
        $list_data_karyawan_rutin = $this->getListKaryawan($paramater_data_karyawan_rutin, 1)->select(DB::raw('group_concat(id_karyawan) as id_karyawan'),DB::raw('group_concat(id_user) as id_user'))->first();
        
        $data_jadwal=(new \App\Http\Traits\PresensiHitungRutinFunction)->getWaktuKerja(['id_jenis_jadwal'=>1])->first();

        $parameter_search=[
            'search_parameter'=>[
                'tanggal'=>[$filter_date_start,$filter_date_end],
                'list_id_karyawan'=>!empty($list_data_karyawan_rutin->id_karyawan) ? $list_data_karyawan_rutin->id_karyawan : 0,
                'list_id_user'=>!empty($list_data_karyawan_rutin->id_user) ? $list_data_karyawan_rutin->id_user : '',
            ],
            'search_karyawan'=>$paramater_data_karyawan_rutin
        ];
        $list_data=$this->getListKaryawanPresensi($parameter_search,1)->get();
        if($list_data){
            $hasil=[];
            foreach($list_data as $value){
                $data_proses=[
                    'list_presensi'=>!empty($value->presensi) ? $value->presensi : '',
                    'list_data'=>!empty($value->presensi_data) ? $value->presensi_data : '',
                    'data_jadwal_kerja'=>!empty($data_jadwal) ? $data_jadwal  : ''
                ];
                
                $hasil[]=(new \App\Http\Traits\PresensiHitungRutinFunction)->getProses($data_proses);
            }
            dd($hasil);
        }
    }
}