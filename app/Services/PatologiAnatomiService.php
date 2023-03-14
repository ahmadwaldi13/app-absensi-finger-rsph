<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\PermintaanLabPA;
use App\Models\PermintaanPemeriksaanLabPA;
use App\Models\JnsPerawatanLab;

class PatologiAnatomiService extends BaseService
{
    public function __construct(
        PermintaanLabPA $permintaanLabPa,
        PermintaanPemeriksaanLabPA $permintaanPemeriksaanLabPa,
        JnsPerawatanLab $jnsPerawatanLab
    ){
        parent::__construct(); 
        $this->permintaanLabPa = $permintaanLabPa;
        $this->permintaanPemeriksaanLabPa = $permintaanPemeriksaanLabPa;
        $this->jnsPerawatanLab = $jnsPerawatanLab;
    }

    function getNoOrder($tanggal)
    {
        $get_data_1=$this->permintaanLabPa->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(noorder,4),signed)),0) as last'))->where('tgl_permintaan', '=', $tanggal)->first();
        
        $get_data_2=$this->permintaanLabPa->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(noorder,4),signed)),0) as last'))->whereRaw('LEFT(noorder,8) = ? ', [str_replace("-", "", $tanggal)])->first();

        $data=$get_data_1;
        if($get_data_2->last > $get_data_1->last){
            $data=$get_data_2;
        }

        return (new \App\Http\Traits\GlobalFunction)->autoNomor($data,$tanggal,"PA" . str_replace("-", "", $tanggal),4);
    }

    function insert($fields)
    {
        foreach ($fields as $key => $field) {
            $field == null ? $fields[$key] = "" : "";
        }
        return $this->permintaanLabPa->insert($fields);
    }

    function insert_pemeriksaan_lab_pa($fields)
    {
        return $this->permintaanPemeriksaanLabPa->insert($fields);
    }

    function delete($params)
    {
        $check_jlh=0;
        $query = $this->permintaanPemeriksaanLabPa->select('noorder');

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
            $query=$this->permintaanLabPa;
            unset($params['stts_bayar']);
            foreach($params as $key => $value){
                $query=$query->where($key,'=',$value);
            }
            return $query->delete();
        }
    }

    function getListRalan($params){

        $query = $this->permintaanLabPa
            ->select('permintaan_labpa.noorder','permintaan_labpa.no_rawat','reg_periksa.no_rkm_medis','reg_periksa.kd_pj','pasien.nm_pasien','jns_perawatan_lab.nm_perawatan','permintaan_labpa.tgl_permintaan','penjab.png_jawab',DB::raw('if(permintaan_labpa.jam_permintaan=\'00:00:00\',\'\',permintaan_labpa.jam_permintaan) as jam_permintaan'),'permintaan_labpa.tgl_sampel',DB::raw('if(permintaan_labpa.jam_sampel=\'00:00:00\',\'\',permintaan_labpa.jam_sampel) as jam_sampel'),'permintaan_labpa.tgl_hasil',DB::raw('if(permintaan_labpa.jam_hasil=\'00:00:00\',\'\',permintaan_labpa.jam_hasil) as jam_hasil'),'permintaan_labpa.dokter_perujuk','dokter.nm_dokter','poliklinik.nm_poli','permintaan_labpa.informasi_tambahan','permintaan_labpa.diagnosa_klinis','permintaan_labpa.pengambilan_bahan','permintaan_labpa.diperoleh_dengan','permintaan_labpa.lokasi_jaringan','permintaan_labpa.diawetkan_dengan','permintaan_labpa.pernah_dilakukan_di',DB::raw('if(permintaan_labpa.tanggal_pa_sebelumnya=\'0000-00-00\',\'\',permintaan_labpa.tanggal_pa_sebelumnya) as tanggal_pa_sebelumnya'),'permintaan_labpa.nomor_pa_sebelumnya','permintaan_labpa.diagnosa_pa_sebelumnya')
            ->join('reg_periksa','permintaan_labpa.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('permintaan_pemeriksaan_labpa','permintaan_labpa.noorder','=','permintaan_pemeriksaan_labpa.noorder')
            ->join('poliklinik','reg_periksa.kd_poli','=','poliklinik.kd_poli')
            ->join('jns_perawatan_lab','jns_perawatan_lab.kd_jenis_prw','=','permintaan_pemeriksaan_labpa.kd_jenis_prw')
            ->join('dokter','permintaan_labpa.dokter_perujuk','=','dokter.kd_dokter')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->orderBy('permintaan_labpa.tgl_permintaan','ASC')
            ->orderBy('permintaan_labpa.jam_permintaan','DESC')
            ->groupBy(['permintaan_labpa.noorder'])
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
                    $query->whereBetween('permintaan_labpa.tgl_permintaan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('permintaan_labpa.noorder', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_labpa.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_labpa.diagnosa_klinis', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getListRanap($params){
        $query = $this->permintaanLabPa
            ->distinct()
            ->select('permintaan_labpa.noorder','permintaan_labpa.no_rawat','reg_periksa.no_rkm_medis','reg_periksa.kd_pj','pasien.nm_pasien','jns_perawatan_lab.nm_perawatan','permintaan_labpa.tgl_permintaan','penjab.png_jawab',DB::raw('if(permintaan_labpa.jam_permintaan=\'00:00:00\',\'\',permintaan_labpa.jam_permintaan) as jam_permintaan'),'permintaan_labpa.tgl_sampel',DB::raw('if(permintaan_labpa.jam_sampel=\'00:00:00\',\'\',permintaan_labpa.jam_sampel) as jam_sampel'),'permintaan_labpa.tgl_hasil',DB::raw('if(permintaan_labpa.jam_hasil=\'00:00:00\',\'\',permintaan_labpa.jam_hasil) as jam_hasil'),'permintaan_labpa.dokter_perujuk','dokter.nm_dokter',DB::raw('ifnull(bangsal.nm_bangsal,\'Ranap Gabung\') as nm_bangsal'),'permintaan_labpa.informasi_tambahan','permintaan_labpa.diagnosa_klinis','permintaan_labpa.pengambilan_bahan','permintaan_labpa.diperoleh_dengan','permintaan_labpa.lokasi_jaringan','permintaan_labpa.diawetkan_dengan','permintaan_labpa.pernah_dilakukan_di',DB::raw('if(permintaan_labpa.tanggal_pa_sebelumnya=\'0000-00-00\',\'\',permintaan_labpa.tanggal_pa_sebelumnya) as tanggal_pa_sebelumnya'),'permintaan_labpa.nomor_pa_sebelumnya','permintaan_labpa.diagnosa_pa_sebelumnya')
            ->join('reg_periksa','permintaan_labpa.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('permintaan_pemeriksaan_labpa','permintaan_labpa.noorder','=','permintaan_pemeriksaan_labpa.noorder')
            ->leftJoin('kamar_inap','reg_periksa.no_rawat','=','kamar_inap.no_rawat')
            ->leftJoin('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->leftJoin('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            ->join('jns_perawatan_lab','jns_perawatan_lab.kd_jenis_prw','=','permintaan_pemeriksaan_labpa.kd_jenis_prw')
            ->join('dokter','permintaan_labpa.dokter_perujuk','=','dokter.kd_dokter')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->groupBy(['permintaan_labpa.noorder','permintaan_pemeriksaan_labpa.kd_jenis_prw'])
            ->orderBy('permintaan_labpa.tgl_permintaan','ASC')
            ->orderBy('permintaan_labpa.jam_permintaan','DESC')
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
                    $query->whereBetween('permintaan_labpa.tgl_permintaan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('permintaan_labpa.noorder', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_labpa.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_labpa.diagnosa_klinis', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getPermintaanPemeriksaanLabPa($params){
        $query = $this->permintaanPemeriksaanLabPa
            ->select('permintaan_pemeriksaan_labpa.kd_jenis_prw','jns_perawatan_lab.nm_perawatan')
            ->join('jns_perawatan_lab','permintaan_pemeriksaan_labpa.kd_jenis_prw','=','jns_perawatan_lab.kd_jenis_prw')
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