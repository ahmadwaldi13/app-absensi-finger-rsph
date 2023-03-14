<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\PermintaanRadiologi;
use App\Models\PermintaanPemeriksaanRadiologi;
use App\Models\JnsPerawatanRadiologi;

class PemeriksaanRadiologiService extends BaseService
{
    public function __construct(
        PermintaanRadiologi $permintaanRadiologi,
        PermintaanPemeriksaanRadiologi $permintaanPemeriksaanRadiologi,
        JnsPerawatanRadiologi $jnsPerawatanRadiologi
    ){
        parent::__construct(); 
        $this->permintaanRadiologi = $permintaanRadiologi;
        $this->permintaanPemeriksaanRadiologi = $permintaanPemeriksaanRadiologi;
        $this->jnsPerawatanRadiologi = $jnsPerawatanRadiologi;
    }

    function getNoOrder($tanggal)
    {
        $get_data_1=$this->permintaanRadiologi->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(noorder,4),signed)),0) as last'))->where('tgl_permintaan', '=', $tanggal)->first();
        
        $get_data_2=$this->permintaanRadiologi->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(noorder,4),signed)),0) as last'))->whereRaw('LEFT(noorder,8) = ? ', [str_replace("-", "", $tanggal)])->first();

        $data=$get_data_1;
        if($get_data_2->last > $get_data_1->last){
            $data=$get_data_2;
        }

        return (new \App\Http\Traits\GlobalFunction)->autoNomor($data,$tanggal,"PR" . str_replace("-", "", $tanggal),4);
    }
    
    function getjnsPerawatanRadiologi($params=[])
    {
        $query=$this->jnsPerawatanRadiologi
            ->select('kd_jenis_prw','nm_perawatan','kd_pj','kelas')
            ->orderBy('kd_jenis_prw','ASC')
        ;

        if($params){

            foreach($params as $key =>$value){
                if($key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query=$query->where(function ($query) use ($search) {
                    $query->where('jns_perawatan_lab.nm_perawatan', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
    }

    function insert($fields)
    {
        foreach ($fields as $key => $field) {
            $field == null ? $fields[$key] = "" : "";
        }
        return $this->permintaanRadiologi->insert($fields);
    }

    function insert_pemeriksaan_radiologi($fields)
    {
        return $this->permintaanPemeriksaanRadiologi->insert($fields);
    }

    function delete($params)
    {
        $check_jlh=0;
        $query = $this->permintaanPemeriksaanRadiologi->select('noorder');

        if($params){
            foreach($params as $key =>$value){
                $query->where($key,'=',$value);
            }
        }
        $check=$query->count();

        if(!empty($check)){
            $check_jlh++;
        }

        if(!empty($check_jlh)){
            return 'error';
        }else{
            $query=$this->permintaanRadiologi;
            unset($params['stts_bayar']);
            foreach($params as $key => $value){
                $query=$query->where($key,'=',$value);
            }
            return $query->delete();
        }
    }

    function getListRalan($params){

        $query = $this->permintaanRadiologi
            ->select('permintaan_radiologi.noorder','permintaan_radiologi.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien','permintaan_radiologi.tgl_permintaan',DB::raw('if(permintaan_radiologi.jam_permintaan=\'00:00:00\',\'\',permintaan_radiologi.jam_permintaan) as jam_permintaan'),DB::raw('if(permintaan_radiologi.tgl_sampel=\'0000-00-00\',\'\',permintaan_radiologi.tgl_sampel) as tgl_sampel'),DB::raw('if(permintaan_radiologi.jam_sampel=\'00:00:00\',\'\',permintaan_radiologi.jam_sampel) as jam_sampel'),'permintaan_radiologi.tgl_hasil',DB::raw('if(permintaan_radiologi.jam_hasil=\'00:00:00\',\'\',permintaan_radiologi.jam_hasil) as jam_hasil'),'permintaan_radiologi.dokter_perujuk','dokter.nm_dokter','poliklinik.nm_poli','permintaan_radiologi.informasi_tambahan','permintaan_radiologi.diagnosa_klinis')
            ->join('reg_periksa','permintaan_radiologi.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','permintaan_radiologi.dokter_perujuk','=','dokter.kd_dokter')
            ->join('poliklinik','reg_periksa.kd_poli','=','poliklinik.kd_poli')
            ->orderBy('permintaan_radiologi.tgl_permintaan','ASC')
            ->orderBy('permintaan_radiologi.jam_permintaan','DESC')
            ->groupBy(['permintaan_radiologi.noorder'])
        ;

        if($params){
            foreach($params as $key =>$value){
                
                if($key!='tgl_permintaan' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_permintaan'])){
                $data_tgl=$params['tgl_permintaan'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('permintaan_radiologi.tgl_permintaan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('permintaan_radiologi.noorder', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_radiologi.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_radiologi.diagnosa_klinis', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getListRanap($params){
        $query = $this->permintaanRadiologi
            ->select('permintaan_radiologi.noorder','permintaan_radiologi.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien','permintaan_radiologi.tgl_permintaan',DB::raw('if(permintaan_radiologi.jam_permintaan=\'00:00:00\',\'\',permintaan_radiologi.jam_permintaan) as jam_permintaan'),DB::raw('if(permintaan_radiologi.tgl_sampel=\'0000-00-00\',\'\',permintaan_radiologi.tgl_sampel) as tgl_sampel'),DB::raw('if(permintaan_radiologi.jam_sampel=\'00:00:00\',\'\',permintaan_radiologi.jam_sampel) as jam_sampel'),'permintaan_radiologi.tgl_hasil',DB::raw('if(permintaan_radiologi.jam_hasil=\'00:00:00\',\'\',permintaan_radiologi.jam_hasil) as jam_hasil'),'permintaan_radiologi.dokter_perujuk','dokter.nm_dokter',DB::raw('ifnull(bangsal.nm_bangsal,\'Ranap Gabung\') as nm_bangsal'),'permintaan_radiologi.informasi_tambahan','permintaan_radiologi.diagnosa_klinis')
            ->join('reg_periksa','permintaan_radiologi.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','permintaan_radiologi.dokter_perujuk','=','dokter.kd_dokter')
            ->leftJoin('kamar_inap','reg_periksa.no_rawat','=','kamar_inap.no_rawat')
            ->leftJoin('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->leftJoin('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            ->groupBy('permintaan_radiologi.noorder')
            ->orderBy('permintaan_radiologi.tgl_permintaan','ASC')
            ->orderBy('permintaan_radiologi.jam_permintaan','DESC')
        ;

        if($params){
            foreach($params as $key =>$value){
                
                if($key!='tgl_permintaan' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_permintaan'])){
                $data_tgl=$params['tgl_permintaan'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('permintaan_radiologi.tgl_permintaan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('permintaan_radiologi.noorder', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_radiologi.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_radiologi.diagnosa_klinis', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getPermintaanPemeriksaanRadiologi($params){
        $query = $this->permintaanPemeriksaanRadiologi
            ->select('permintaan_pemeriksaan_radiologi.kd_jenis_prw','jns_perawatan_radiologi.nm_perawatan')
            ->join('jns_perawatan_radiologi','permintaan_pemeriksaan_radiologi.kd_jenis_prw','=','jns_perawatan_radiologi.kd_jenis_prw')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }

        return $query->get();
        // return $query->toSql();
    }

}