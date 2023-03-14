<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\Pasien;
use App\Models\PoliKlinik;
use App\Models\RegPeriksa;

class RegistrasiService extends BaseService
{
    public function __construct(){
        parent::__construct();
        $this->pasien = new Pasien;
        $this->poliklinik = new PoliKlinik;
        $this->regPeriksa = new RegPeriksa;
    }

    function getPasien($params=[],$type='',$where=''){
        $query = $this->pasien
            ->select('*')
            ->orderBy('no_rkm_medis','ASC');

        if($where=='and'){
            $list_search=[
                'where'=>['no_rkm_medis', 'no_peserta', 'keluarga', 'namakeluarga', 'alamatpj'],
            ];
        }else{
            $list_search=[
                'where_or'=>['no_rkm_medis', 'no_peserta', 'keluarga', 'namakeluarga', 'alamatpj'],
            ];
        }
        
        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }

        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

    function cek_pasien($no_rkm_medik, $nik, $tgl_lahir){
        $query = Pasien::select('no_rkm_medis','nm_pasien','no_ktp','tgl_lahir','tmp_lahir', 'no_tlp', 'jk', 'alamatpj', 'kelurahanpj', 'kecamatanpj', 'kabupatenpj', 'propinsipj', 'email')
        ->selectRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, current_date) AS age')
        ->where('no_rkm_medis',$no_rkm_medik)
        ->where('no_ktp',$nik)
        ->where('tgl_lahir',$tgl_lahir)
        ->first();
        
        return $query;
	}

    function getPoliklinik($params=[],$type='',$where=''){
        $query = $this->poliklinik
            ->select('*')
            ->orderBy('kd_poli','ASC');

        if($where=='and'){
            $list_search=[
                'where'=>['kd_poli', 'nm_poli', 'registrasi', 'registrasilama', 'status'],
            ];
        }else{
            $list_search=[
                'where_or'=>['kd_poli', 'nm_poli', 'registrasi', 'registrasilama', 'status'],
            ];
        }
        
        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }

        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

    function cek_antrian_poli($params=[],$where=''){
        // $data = $this->db->query("SELECT a.tgl_registrasi, a.kd_poli, a.no_reg, b.nm_poli, c.nm_dokter, a.no_reg, a.stts FROM reg_periksa a INNER JOIN poliklinik b ON b.kd_poli=a.kd_poli INNER JOIN dokter c ON c.kd_dokter=a.kd_dokter WHERE a.no_rkm_medis = '$no_rkm_medis' and a.tgl_registrasi = '$tgl_registrasi' order by tgl_registrasi DESC limit 1")->row_array();

        $query = $this->regPeriksa 
        ->select(
            'reg_periksa.tgl_registrasi', 'reg_periksa.kd_poli', 'reg_periksa.no_reg', 'poliklinik.nm_poli', 'dokter.nm_dokter', 'reg_periksa.no_reg', 'reg_periksa.stts'
        )
        ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
        ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter');
        

        if($where=='and'){
            $list_search=[
                'where'=>['no_rkm_medis', 'tgl_registrasi'],
            ];
        }else{
            $list_search=[
                'where_or'=>['no_rkm_medis', 'tgl_registrasi'],
            ];
        }
        
        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }
        $query->orderBy('tgl_registrasi','DESC');
        return $query;
    }
}