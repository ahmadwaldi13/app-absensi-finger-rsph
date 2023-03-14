<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

// use App\Models\PermintaanLab;
// use App\Models\PermintaanPemeriksaanLab;
// use App\Models\PermintaanDetailPermintaanLab;
use App\Models\ResepObat;

class RacikObatService extends BaseService
{
    //protected $permintaanLab;
    protected $resepObat;
    public function __construct(
        // PermintaanLab $permintaanLab,
        // PermintaanPemeriksaanLab $permintaanPemeriksaanLab,
        // PermintaanDetailPermintaanLab $permintaanDetailPermintaanLab
        ResepObat $resepObat
    ){
        parent::__construct(); 
        // $this->permintaanLab = $permintaanLab;
        // $this->permintaanPemeriksaanLab = $permintaanPemeriksaanLab;
        // $this->permintaanDetailPermintaanLab = $permintaanDetailPermintaanLab;
        $this->resepObat = $resepObat;
    }

    function ListRalan($params){

        $query = $this->resepObat
            ->select('resep_obat.no_resep','resep_obat.tgl_peresepan','resep_obat.jam_peresepan','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'Belum Terlayani\',\'Sudah Terlayani\') as status'),'poliklinik.nm_poli','reg_periksa.kd_poli','penjab.png_jawab',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'\',resep_obat.tgl_perawatan) as tgl_perawatan'),DB::raw('if(resep_obat.jam=\'00:00:00\',\'\',resep_obat.jam) as jam'),DB::raw('if(resep_obat.tgl_penyerahan=\'0000-00-00\',\'\',resep_obat.tgl_penyerahan) as tgl_penyerahan'),DB::raw('if(resep_obat.jam_penyerahan=\'00:00:00\',\'\',resep_obat.jam_penyerahan) as jam_penyerahan'))
            ->join('reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
            ->join('poliklinik','reg_periksa.kd_poli','=','poliklinik.kd_poli')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            // ->where('resep_obat.tgl_peresepan','<>','0000-00-00')
            // ->where('resep_obat.status','=','ralan')
            // ->whereBetween('resep_obat.tgl_peresepan',['2022-03-15','2022-03-15'])
            ->orderBy('resep_obat.tgl_perawatan','DESC')
            ->orderBy('resep_obat.jam','DESC');

            $query->where('resep_obat.tgl_peresepan','<>','0000-00-00');
            $query->where('resep_obat.status','=','ralan');
            // $query->whereBetween('resep_obat.tgl_peresepan',['2022-01-03','2022-01-03']);

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
                    $query->whereBetween('resep_obat.tgl_peresepan', $data_tgl);
                }
            }
            //resep_obat.tgl_peresepan
            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('resep_obat.no_resep', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                        ->orWhere('poliklinik.nm_poli', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function ListRanap($params){

        $query = $this->resepObat
            ->select('resep_obat.no_resep','resep_obat.tgl_peresepan','resep_obat.jam_peresepan','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'Belum Terlayani\',\'Sudah Terlayani\') as status'),'bangsal.nm_bangsal','kamar.kd_bangsal','penjab.png_jawab',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'\',resep_obat.tgl_perawatan) as tgl_perawatan'),DB::raw('if(resep_obat.jam=\'00:00:00\',\'\',resep_obat.jam) as jam'))
            ->join('reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->join('kamar_inap','reg_periksa.no_rawat','=','kamar_inap.no_rawat')
            ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            // ->where('resep_obat.tgl_peresepan','<>','0000-00-00')
            // ->where('kamar_inap.stts_pulang','=','-')
            // ->where('resep_obat.status','=','ranap')
            // ->whereBetween('resep_obat.tgl_peresepan',['2022-02-01','2022-03-17'])
            ->groupBy('resep_obat.no_resep')
            ->orderBy('resep_obat.tgl_perawatan','DESC')
            ->orderBy('resep_obat.jam','DESC');

            $query->where('resep_obat.tgl_peresepan','<>','0000-00-00');
            $query->where('kamar_inap.stts_pulang','=','-');
            $query->where('resep_obat.status','=','ranap');

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
                    $query->whereBetween('resep_obat.tgl_peresepan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('resep_obat.no_resep', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                        ->orWhere('poliklinik.nm_poli', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
    //     // return $query->toSql();
    }
    
    
}