<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\ResepObat;
use App\Models\Bangsal;
use App\Models\BuktiPenyerahanResepObat;
use App\Models\UxuiKonterFarmasi;

class AntrianFarmasiService extends BaseService
{
    public function __construct(
        ResepObat $resepObat,
        Bangsal $bangsal,
        UxuiKonterFarmasi $konter

    ){
        parent::__construct();
        $this->resepObat = $resepObat;
        $this->bangsal = $bangsal;
        $this->konter = $konter;
    }
    function getResepObatRanapListMonitor(){
        $query=DB::table(DB::raw(
            "(
                select @rownum := @rownum + 1 AS row_number, resep_obat.* 
                from resep_obat 
                CROSS JOIN ( SELECT @rownum := 0 ) r
                where 
                    tgl_peresepan <> '0000-00-00' 
                    AND tgl_perawatan <> '0000-00-00'
                    AND tgl_penyerahan is null
	                AND status = 'ranap' 
	                AND tgl_peresepan BETWEEN '".date('Y-m-d')."' AND '".date('Y-m-d')."'
            ) `resep_obat`"))
            ->select(
                DB::raw('resep_obat.row_number'),
                'resep_obat.no_resep','resep_obat.tgl_peresepan','resep_obat.jam_peresepan','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'Belum Terlayani\',\'Sudah Terlayani\') as status'),'bangsal.nm_bangsal','kamar.kd_bangsal','penjab.png_jawab',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'\',resep_obat.tgl_perawatan) as tgl_perawatan'),DB::raw('if(resep_obat.jam=\'00:00:00\',\'\',resep_obat.jam) as jam'))
            ->join('reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->join('kamar_inap','reg_periksa.no_rawat','=','kamar_inap.no_rawat')
            ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            ->whereNull('resep_obat.tgl_penyerahan')
            ->groupBy('resep_obat.no_resep')
            ->orderBy('resep_obat.tgl_perawatan','ASC')
            ->orderBy('resep_obat.jam','ASC')
            ->limit(50)->get();

        return $query;
    }
    function getResepObatRalanListMonitor(){
        $query=DB::table(DB::raw(
            "(
                select @rownum := @rownum + 1 AS row_number, resep_obat.* 
                from resep_obat 
                CROSS JOIN ( SELECT @rownum := 0 ) r
                where 
                    tgl_peresepan <> '0000-00-00' 
                    AND tgl_perawatan <> '0000-00-00' 
	                AND status = 'ralan' 
	                AND tgl_peresepan BETWEEN '".date('Y-m-d')."' AND '".date('Y-m-d')."'
                    ORDER BY
                        `resep_obat`.`tgl_perawatan` ASC,
                        `resep_obat`.`jam` ASC 
            ) `resep_obat`"))
            ->select(
                DB::raw('resep_obat.row_number'),
                'resep_obat.no_resep','resep_obat.tgl_peresepan','resep_obat.jam_peresepan','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw('IF(resep_obat.tgl_perawatan = \'0000-00-00\',\'Belum Terlayani\',\'Sudah Terlayani\') AS status'),'poliklinik.nm_poli','reg_periksa.kd_poli','penjab.png_jawab',DB::raw('IF(resep_obat.tgl_perawatan = \'0000-00-00\',\'\',resep_obat.tgl_perawatan) AS tgl_perawatan'),DB::raw('IF(resep_obat.jam = \'00:00:00\',\'\',resep_obat.jam) AS jam'),DB::raw('IF(resep_obat.tgl_penyerahan = \'0000-00-00\',\'\',resep_obat.tgl_penyerahan) AS tgl_penyerahan'),DB::raw('IF(resep_obat.jam_penyerahan = \'00:00:00\',\'\',resep_obat.jam_penyerahan) AS jam_penyerahan'))
            ->join('reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
            ->join('poliklinik','reg_periksa.kd_poli','=','poliklinik.kd_poli')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->orderBy('resep_obat.tgl_perawatan','ASC')
            ->orderBy('resep_obat.jam','ASC')
            ->whereNull('resep_obat.tgl_penyerahan')
            ->limit(50)->get();

        return $query;
    }
    function getResepObatRalanList($tgl_peresepan,$params=[])
    {
        $query=DB::table(DB::raw(
            "(
                select @rownum := @rownum + 1 AS row_number, resep_obat.* 
                from resep_obat 
                CROSS JOIN ( SELECT @rownum := 0 ) r
                where 
                    tgl_peresepan <> '0000-00-00' 
                    AND tgl_perawatan <> '0000-00-00' 
	                AND status = 'ralan' 
	                AND tgl_peresepan BETWEEN '".$tgl_peresepan[0]."' AND '".$tgl_peresepan[1]."'
                    ORDER BY
                        `resep_obat`.`tgl_perawatan` ASC,
                        `resep_obat`.`jam` ASC 
            ) `resep_obat`"))
            ->select(
                DB::raw('resep_obat.row_number'),
                'resep_obat.no_resep','resep_obat.tgl_peresepan','resep_obat.jam_peresepan','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw('IF(resep_obat.tgl_perawatan = \'0000-00-00\',\'Belum Terlayani\',\'Sudah Terlayani\') AS status'),'poliklinik.nm_poli','reg_periksa.kd_poli','penjab.png_jawab',DB::raw('IF(resep_obat.tgl_perawatan = \'0000-00-00\',\'\',resep_obat.tgl_perawatan) AS tgl_perawatan'),DB::raw('IF(resep_obat.jam = \'00:00:00\',\'\',resep_obat.jam) AS jam'),DB::raw('IF(resep_obat.tgl_penyerahan = \'0000-00-00\',\'\',resep_obat.tgl_penyerahan) AS tgl_penyerahan'),DB::raw('IF(resep_obat.jam_penyerahan = \'00:00:00\',\'\',resep_obat.jam_penyerahan) AS jam_penyerahan'))
            ->join('reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
            ->join('poliklinik','reg_periksa.kd_poli','=','poliklinik.kd_poli')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->orderBy('resep_obat.tgl_perawatan','ASC')
            ->orderBy('resep_obat.jam','ASC')
            ->whereNull('resep_obat.tgl_penyerahan');

        if($params){
            foreach($params as $key =>$value){
                if($key!='search' and $key!='tgl_peresepan'){
                    if(!empty($value)){
                        $type=is_numeric($value) ? '=' : 'like';
                        $query->where($key,$type,$value);
                    }
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('resep_obat.no_resep', 'LIKE', '%' . $search . '%')
                        ->orWhere('resep_obat.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        // dd($query->toSql());
        return $query;
    }

    function getResepObatRanapList($tgl_peresepan,$params=[])
    {
        
        $query=DB::table(DB::raw(
            "(
                select @rownum := @rownum + 1 AS row_number, resep_obat.* 
                from resep_obat 
                CROSS JOIN ( SELECT @rownum := 0 ) r
                where 
                    tgl_peresepan <> '0000-00-00' 
                    AND tgl_perawatan <> '0000-00-00'
                    AND tgl_penyerahan is null
	                AND status = 'ranap' 
	                AND tgl_peresepan BETWEEN '".$tgl_peresepan[0]."' AND '".$tgl_peresepan[1]."'
            ) `resep_obat`"))
            ->select(
                DB::raw('resep_obat.row_number'),
                'resep_obat.no_resep','resep_obat.tgl_peresepan','resep_obat.jam_peresepan','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'Belum Terlayani\',\'Sudah Terlayani\') as status'),'bangsal.nm_bangsal','kamar.kd_bangsal','penjab.png_jawab',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'\',resep_obat.tgl_perawatan) as tgl_perawatan'),DB::raw('if(resep_obat.jam=\'00:00:00\',\'\',resep_obat.jam) as jam'))
            ->join('reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->join('kamar_inap','reg_periksa.no_rawat','=','kamar_inap.no_rawat')
            ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            ->whereNull('resep_obat.tgl_penyerahan')
            ->groupBy('resep_obat.no_resep')
            ->orderBy('resep_obat.tgl_perawatan','ASC')
            ->orderBy('resep_obat.jam','ASC');
        // $query=DB::table(DB::raw(
        //     "(
        //         select * 
        //         from resep_obat 
        //         where 
        //             tgl_peresepan <> '0000-00-00' 
        //             AND tgl_perawatan <> '0000-00-00'
        //             AND tgl_penyerahan is null
	    //             AND status = 'ranap' 
	    //             AND tgl_peresepan BETWEEN '".$tgl_peresepan[0]."' AND '".$tgl_peresepan[1]."'
        //     ) `resep_obat`"))
        //     ->select('resep_obat.no_resep','resep_obat.tgl_peresepan','resep_obat.jam_peresepan','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'Belum Terlayani\',\'Sudah Terlayani\') as status'),'bangsal.nm_bangsal','kamar.kd_bangsal','penjab.png_jawab',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'\',resep_obat.tgl_perawatan) as tgl_perawatan'),DB::raw('if(resep_obat.jam=\'00:00:00\',\'\',resep_obat.jam) as jam'))
        //     ->join('reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
        //     ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
        //     ->join('dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
        //     ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
        //     ->join('kamar_inap','reg_periksa.no_rawat','=','kamar_inap.no_rawat')
        //     ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
        //     ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
        //     ->groupBy('resep_obat.no_resep')
        //     ->orderBy('resep_obat.tgl_perawatan','ASC')
        //     ->orderBy('resep_obat.jam','ASC')
        // ;

        // $query->where('kamar_inap.stts_pulang','=','-');

        if($params){
            foreach($params as $key =>$value){
                if($key!='search' and $key!='tgl_peresepan'){
                    if(!empty($value)){
                        $type=is_numeric($value) ? '=' : 'like';
                        $query->where($key,$type,$value);
                    }
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('resep_obat.no_resep', 'LIKE', '%' . $search . '%')
                        ->orWhere('resep_obat.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        $query2=DB::table(DB::raw(
            "(
                select @rownum := @rownum + 1 AS row_number, resep_obat.* 
                from resep_obat 
                CROSS JOIN ( SELECT @rownum := 0 ) r
                where 
                    tgl_peresepan <> '0000-00-00' 
                    AND tgl_perawatan <> '0000-00-00'
                    AND tgl_penyerahan is null
	                AND status = 'ranap' 
	                AND tgl_peresepan BETWEEN '".$tgl_peresepan[0]."' AND '".$tgl_peresepan[1]."'
            ) `resep_obat`"))
            ->select(
                DB::raw('resep_obat.row_number'),
                'resep_obat.no_resep','resep_obat.tgl_peresepan','resep_obat.jam_peresepan','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'Belum Terlayani\',\'Sudah Terlayani\') as status'),'bangsal.nm_bangsal','kamar.kd_bangsal','penjab.png_jawab',DB::raw('if(resep_obat.tgl_perawatan=\'0000-00-00\',\'\',resep_obat.tgl_perawatan) as tgl_perawatan'),DB::raw('if(resep_obat.jam=\'00:00:00\',\'\',resep_obat.jam) as jam'))
            ->join('ranap_gabung','ranap_gabung.no_rawat2','=','resep_obat.no_rawat')
            ->join('reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
            ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->join('kamar_inap','ranap_gabung.no_rawat','=','kamar_inap.no_rawat')
            ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            ->groupBy('resep_obat.no_resep')
            ->orderBy('resep_obat.tgl_perawatan','ASC')
            ->orderBy('resep_obat.jam','ASC')
        ;
        // $query2=DB::table(DB::raw(
        //     "(
        //         select * 
        //         from resep_obat 
        //         where 
        //             tgl_peresepan <> '0000-00-00' 
        //             AND tgl_perawatan <> '0000-00-00'
        //             AND tgl_penyerahan is null
        //             AND status = 'ranap' 
        //             AND tgl_peresepan BETWEEN '".$tgl_peresepan[0]."' AND '".$tgl_peresepan[1]."'
        //     ) `resep_obat`"))
        //     ->select('resep_obat.no_resep','resep_obat.tgl_peresepan','resep_obat.jam_peresepan','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw('IF(resep_obat.tgl_perawatan = \'0000-00-00\',\'Belum Terlayani\',\'Sudah Terlayani\') AS STATUS'),'bangsal.nm_bangsal','kamar.kd_bangsal','penjab.png_jawab',DB::raw('IF(resep_obat.tgl_perawatan = \'0000-00-00\',\'\',resep_obat.tgl_perawatan) AS tgl_perawatan'),DB::raw('IF(resep_obat.jam = \'00:00:00\',\'\',resep_obat.jam) AS jam'))
        //     ->join('ranap_gabung','ranap_gabung.no_rawat2','=','resep_obat.no_rawat')
        //     ->join('reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
        //     ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
        //     ->join('dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
        //     ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
        //     ->join('kamar_inap','ranap_gabung.no_rawat','=','kamar_inap.no_rawat')
        //     ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
        //     ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
        //     ->groupBy('resep_obat.no_resep')
        //     ->orderBy('resep_obat.tgl_perawatan','ASC')
        //     ->orderBy('resep_obat.jam','ASC')
        // ;
        
        // $query2->where('kamar_inap.stts_pulang','=','-');

        if($params){
            foreach($params as $key =>$value){
                if($key!='search' and $key!='tgl_peresepan'){
                    if(!empty($value)){
                        $type=is_numeric($value) ? '=' : 'like';
                        $query2->where($key,$type,$value);
                    }
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query2->where(function ($qb2) use ($search) {
                    $qb2->where('resep_obat.no_resep', 'LIKE', '%' . $search . '%')
                        ->orWhere('resep_obat.no_rawat', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }
        $query->union($query2);

        // echo $query->toSql();die;
        return $query;
    }

    function updateResepObat($fields){
        $query = $this->resepObat
                ->where('no_resep', $fields["no_resep"])
                ->where('no_rawat', $fields["no_rawat"])
                ->where('status', $fields["tab"] == "rj" ? "ralan" : "ranap")
                ->update([
                    'tgl_penyerahan'=> $fields["tgl_penyerahan"],
                    'jam_penyerahan' => $fields["jam_penyerahan"]
                ]);
        return $query;
    }
    public function getListKamarPasien(){
        $query = $this->bangsal
        ->select("bangsal.nm_bangsal", "bangsal.kd_bangsal")
        ->join("kamar", 'kamar.kd_bangsal', '=', 'bangsal.kd_bangsal')
        ->groupBy("bangsal.nm_bangsal")
        ->orderBy("bangsal.nm_bangsal");
        return $query->get();
    }

    public function insertBuktiPenyerahanResep($data){
        return BuktiPenyerahanResepObat::Create($data);
    }

    public function get_konter($kode){
        $query = $this->konter->select('konter_no');
        $query->where('kode_konter', $kode);
        return $query->get();
    }

}