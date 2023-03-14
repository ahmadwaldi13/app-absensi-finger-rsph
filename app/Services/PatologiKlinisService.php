<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\PermintaanLab;
use App\Models\PermintaanPemeriksaanLab;
use App\Models\PermintaanDetailPermintaanLab;
use App\Models\JnsPerawatanLab;
use App\Models\TemplateLab;

class PatologiKlinisService extends BaseService
{
    public function __construct(
        PermintaanLab $permintaanLab,
        PermintaanPemeriksaanLab $permintaanPemeriksaanLab,
        PermintaanDetailPermintaanLab $permintaanDetailPermintaanLab,
        JnsPerawatanLab $jnsPerawatanLab,
        TemplateLab $templateLab
    ){
        parent::__construct(); 
        $this->permintaanLab = $permintaanLab;
        $this->permintaanPemeriksaanLab = $permintaanPemeriksaanLab;
        $this->permintaanDetailPermintaanLab = $permintaanDetailPermintaanLab;
        $this->jnsPerawatanLab = $jnsPerawatanLab;
        $this->templateLab = $templateLab;
    }

    function getNoOrder($tanggal)
    {

        $get_data_1=$this->permintaanLab->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(noorder,4),signed)),0) as last'))->where('tgl_permintaan', '=', $tanggal)->first();
        
        $get_data_2=$this->permintaanLab->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(noorder,4),signed)),0) as last'))->whereRaw('LEFT(noorder,8) = ? ', [str_replace("-", "", $tanggal)])->first();

        $data=$get_data_1;
        if($get_data_2->last > $get_data_1->last){
            $data=$get_data_2;
        }

        return (new \App\Http\Traits\GlobalFunction)->autoNomor($data,$tanggal,"PL" . str_replace("-", "", $tanggal),4);
    }

    function insert($fields)
    {
        foreach ($fields as $key => $field) {
            $field == null ? $fields[$key] = "" : "";
        }
        return $this->permintaanLab->insert($fields);
    }

    function insert_pemeriksaan_lab($fields)
    {
        return $this->permintaanPemeriksaanLab->insert($fields);
    }

    function insert_pemeriksaan_detail_lab($fields)
    {
        return $this->permintaanDetailPermintaanLab->insert($fields);
    }

    function delete($params)
    {
        $check_jlh=0;
        $query = $this->permintaanPemeriksaanLab->select('noorder');

        if($params){
            foreach($params as $key =>$value){
                $query->where($key,'=',$value);
            }
        }
        $check=$query->count();

        if(!empty($check)){
            $check_jlh++;
        }

        $query = $this->permintaanDetailPermintaanLab->select('noorder');

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
            $query=$this->permintaanLab;
            unset($params['stts_bayar']);
            foreach($params as $key => $value){
                $query=$query->where($key,'=',$value);
            }
            return $query->delete();
        }
    }

    function getListRalan($params){

        $query = $this->permintaanLab
            ->select('permintaan_lab.noorder','permintaan_lab.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien','jns_perawatan_lab.nm_perawatan','template_laboratorium.Pemeriksaan','template_laboratorium.satuan','template_laboratorium.nilai_rujukan_ld','reg_periksa.kd_pj','template_laboratorium.nilai_rujukan_la','template_laboratorium.nilai_rujukan_pd','template_laboratorium.nilai_rujukan_pa','permintaan_lab.tgl_permintaan','penjab.png_jawab',DB::raw('if(permintaan_lab.jam_permintaan=\'00:00:00\',\'\',permintaan_lab.jam_permintaan) as jam_permintaan'),'permintaan_lab.tgl_sampel',DB::raw('if(permintaan_lab.jam_sampel=\'00:00:00\',\'\',permintaan_lab.jam_sampel) as jam_sampel'),'permintaan_lab.tgl_hasil',DB::raw('if(permintaan_lab.jam_hasil=\'00:00:00\',\'\',permintaan_lab.jam_hasil) as jam_hasil'),'permintaan_lab.dokter_perujuk','dokter.nm_dokter','poliklinik.nm_poli','permintaan_lab.informasi_tambahan','permintaan_lab.diagnosa_klinis')
            ->join('reg_periksa','permintaan_lab.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('permintaan_pemeriksaan_lab','permintaan_lab.noorder','=','permintaan_pemeriksaan_lab.noorder')
            ->join('poliklinik','reg_periksa.kd_poli','=','poliklinik.kd_poli')
            ->join('jns_perawatan_lab','jns_perawatan_lab.kd_jenis_prw','=','permintaan_pemeriksaan_lab.kd_jenis_prw')
            ->join('permintaan_detail_permintaan_lab',function($join) {$join->on('permintaan_lab.noorder','=','permintaan_detail_permintaan_lab.noorder')
            ->on('permintaan_detail_permintaan_lab.kd_jenis_prw','=','permintaan_pemeriksaan_lab.kd_jenis_prw'); })
            ->join('template_laboratorium','template_laboratorium.id_template','=','permintaan_detail_permintaan_lab.id_template')
            ->join('dokter','permintaan_lab.dokter_perujuk','=','dokter.kd_dokter')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->orderBy('permintaan_lab.tgl_permintaan','ASC')
            ->orderBy('permintaan_lab.jam_permintaan','DESC')
            ->groupBy('permintaan_lab.noorder')
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
                    $query->whereBetween('permintaan_lab.tgl_permintaan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('permintaan_lab.noorder', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_lab.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'LIKE', '%' . $search . '%')
                        ->orWhere('template_laboratorium.Pemeriksaan', 'LIKE', '%' . $search . '%')
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
        $query = $this->permintaanLab
            ->select('permintaan_lab.noorder','permintaan_lab.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien','permintaan_lab.tgl_permintaan',DB::raw('if(permintaan_lab.jam_permintaan=\'00:00:00\',\'\',permintaan_lab.jam_permintaan) as jam_permintaan'),'reg_periksa.kd_pj','penjab.png_jawab',DB::raw('if(permintaan_lab.tgl_sampel=\'0000-00-00\',\'\',permintaan_lab.tgl_sampel) as tgl_sampel'),DB::raw('if(permintaan_lab.jam_sampel=\'00:00:00\',\'\',permintaan_lab.jam_sampel) as jam_sampel'),DB::raw('if(permintaan_lab.tgl_hasil=\'0000-00-00\',\'\',permintaan_lab.tgl_hasil) as tgl_hasil'),DB::raw('if(permintaan_lab.jam_hasil=\'00:00:00\',\'\',permintaan_lab.jam_hasil) as jam_hasil'),'permintaan_lab.dokter_perujuk','dokter.nm_dokter',DB::raw('ifnull(bangsal.nm_bangsal,\'Ranap Gabung\') as nm_bangsal'),'permintaan_lab.informasi_tambahan','permintaan_lab.diagnosa_klinis')
            ->join('reg_periksa','permintaan_lab.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','permintaan_lab.dokter_perujuk','=','dokter.kd_dokter')
            ->leftJoin('kamar_inap','reg_periksa.no_rawat','=','kamar_inap.no_rawat')
            ->leftJoin('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->leftJoin('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->groupBy('permintaan_lab.noorder')
            ->orderByRaw('permintaan_lab.status=\'ranap\' and permintaan_lab.tgl_permintaan ASC,permintaan_lab.jam_permintaan DESC')
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
                    $query->whereBetween('permintaan_lab.tgl_permintaan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query=$query->where(function ($query) use ($search) {
                    $query->where('permintaan_lab.noorder', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_lab.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('permintaan_lab.diagnosa_klinis', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getPermintaanPemeriksaanLab($params){
        $query = $this->permintaanPemeriksaanLab
            ->select('permintaan_pemeriksaan_lab.kd_jenis_prw','jns_perawatan_lab.nm_perawatan')
            ->join('jns_perawatan_lab','permintaan_pemeriksaan_lab.kd_jenis_prw','=','jns_perawatan_lab.kd_jenis_prw')
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

    function getPermintaanDetailPermintaanLab($params){
        $query = $this->permintaanDetailPermintaanLab
            ->select('permintaan_detail_permintaan_lab.kd_jenis_prw','permintaan_detail_permintaan_lab.id_template','template_laboratorium.Pemeriksaan','template_laboratorium.satuan','template_laboratorium.nilai_rujukan_ld','template_laboratorium.nilai_rujukan_la','template_laboratorium.nilai_rujukan_pd','template_laboratorium.nilai_rujukan_pa')
            ->join('template_laboratorium','permintaan_detail_permintaan_lab.id_template','=','template_laboratorium.id_template')
            ->orderBy('template_laboratorium.urut','ASC')
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

    function getjnsPerawatanLab($params=[])
    {
        $query=$this->jnsPerawatanLab
            ->select('jns_perawatan_lab.kd_jenis_prw', 'jns_perawatan_lab.nm_perawatan', 'penjab.png_jawab')
            ->join('penjab', 'penjab.kd_pj', '=', 'jns_perawatan_lab.kd_pj')
            ->orderBy('jns_perawatan_lab.kd_jenis_prw', 'ASC')
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

    function getTemplateLaboratorium($params=[]){
        
        $query=$this->templateLab
            ->select('id_template','Pemeriksaan','satuan','nilai_rujukan_ld', 'nilai_rujukan_la', 'nilai_rujukan_pd', 'nilai_rujukan_pa','jns_perawatan_lab.kd_jenis_prw','jns_perawatan_lab.nm_perawatan')
            ->join('jns_perawatan_lab', 'jns_perawatan_lab.kd_jenis_prw', '=', 'template_laboratorium.kd_jenis_prw')
        ;

        if($params){
            foreach($params as $key =>$value){   
                if($key!='where_in' and $key!='search' and $key!='raw'){
                    $type=is_numeric($value) ? '=' : 'like';
                    if(is_array($value)){
                        $query->where($key,$value[0],$value[1]);
                    }else{
                        $query->where($key,$type,$value);
                    }
                }
            }

            if(!empty($params['where_in'])){
                $where_in=$params['where_in'];
                if($where_in[0] and $where_in[1]){
                    $query->whereIn($where_in[0], $where_in[1]);
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
}