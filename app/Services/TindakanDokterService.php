<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Models\RawatJlDr;
use App\Models\RawatInapDr;

class TindakanDokterService extends BaseService
{
    public function __construct(
        Pasien $pasien,
        RawatJlDr $rawatJlDr,
        RawatInapDr $rawatInapDr
    ){
        parent::__construct(); 
        $this->pasien = $pasien; 
        $this->rawatJlDr = $rawatJlDr; 
        $this->rawatInapDr = $rawatInapDr; 
        
    }

    function getTindakanDilakukanDokterList($no_rm,$tgl_start,$tgl_end,$search=null){
        $query=$this->pasien
            ->select('rawat_jl_dr.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien','rawat_jl_dr.kd_jenis_prw','jns_perawatan.nm_perawatan',
            DB::raw('concat(rawat_jl_dr.kd_jenis_prw,\' \',jns_perawatan.nm_perawatan) as tindakan'),
            'rawat_jl_dr.kd_dokter','dokter.nm_dokter','rawat_jl_dr.tgl_perawatan','rawat_jl_dr.jam_rawat','rawat_jl_dr.biaya_rawat','rawat_jl_dr.kd_jenis_prw','rawat_jl_dr.tarif_tindakandr','rawat_jl_dr.kso','rawat_jl_dr.material','rawat_jl_dr.bhp','rawat_jl_dr.menejemen')
            ->join('reg_periksa', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('rawat_jl_dr', 'rawat_jl_dr.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('jns_perawatan', 'jns_perawatan.kd_jenis_prw', '=', 'rawat_jl_dr.kd_jenis_prw')
            ->join('dokter', 'dokter.kd_dokter', '=', 'rawat_jl_dr.kd_dokter')
            ->where('reg_periksa.no_rkm_medis', '=', $no_rm)
            ->whereBetween('rawat_jl_dr.tgl_perawatan', [$tgl_start, $tgl_end])
        ;

        if (!empty($search)) {

            $query->where(function ($qb2) use ($search) {
                $qb2->where('rawat_jl_dr.no_rawat', 'LIKE', '%' . $search . '%')
                    ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                    ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                    ->orWhere('jns_perawatan.nm_perawatan', 'LIKE', '%' . $search . '%')
                    ->orWhere('rawat_jl_dr.kd_dokter', 'LIKE', '%' . $search . '%')
                    ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                    ->orWhere('rawat_jl_dr.tgl_perawatan', 'LIKE', '%' . $search . '%')
                ;
            });
        }

        return $query->get();
    }

    function getTindakanDilakukanDokterRanapList($no_rm,$tgl_start,$tgl_end,$search=null,$type=''){
        $query=$this->pasien
            ->select('rawat_inap_dr.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien','rawat_inap_dr.kd_jenis_prw','jns_perawatan_inap.nm_perawatan',
            DB::raw('concat(rawat_inap_dr.kd_jenis_prw,\' \',jns_perawatan_inap.nm_perawatan) as tindakan'),
            'rawat_inap_dr.kd_dokter','dokter.nm_dokter','rawat_inap_dr.tgl_perawatan','rawat_inap_dr.jam_rawat','rawat_inap_dr.biaya_rawat','rawat_inap_dr.kd_jenis_prw','rawat_inap_dr.tarif_tindakandr','rawat_inap_dr.kso','rawat_inap_dr.material','rawat_inap_dr.bhp','rawat_inap_dr.menejemen')
            ->join('reg_periksa', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('rawat_inap_dr', 'rawat_inap_dr.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('jns_perawatan_inap', 'jns_perawatan_inap.kd_jenis_prw', '=', 'rawat_inap_dr.kd_jenis_prw')
            ->join('dokter', 'dokter.kd_dokter', '=', 'rawat_inap_dr.kd_dokter')
            ->where('reg_periksa.no_rkm_medis', '=', $no_rm)
            ->whereBetween('rawat_inap_dr.tgl_perawatan', [$tgl_start, $tgl_end])
        ;

        if (!empty($search)) {

            $query->where(function ($qb2) use ($search) {
                $qb2->where('rawat_inap_dr.no_rawat', 'LIKE', '%' . $search . '%')
                    ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                    ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                    ->orWhere('jns_perawatan_inap.nm_perawatan', 'LIKE', '%' . $search . '%')
                    ->orWhere('rawat_inap_dr.kd_dokter', 'LIKE', '%' . $search . '%')
                    ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                    ->orWhere('rawat_inap_dr.tgl_perawatan', 'LIKE', '%' . $search . '%')
                ;
            });
        }
        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

    function getJnsPerawatanTindakanDokterList($get_poli_ralan,$get_cara_bayar_ralan,$params)
    {
        $params['search_text']=!empty($params['search_text']) ? $params['search_text'] : '';
        $params['search_text']="'".'%'.$params['search_text'].'%'."'";
        $params['kd_pj']="'".$params['kd_pj']."'";
        $params['kd_poli']="'".$params['kd_poli']."'";
        
        $sql_1 = "
            SELECT
                jns_perawatan.kd_jenis_prw,
                jns_perawatan.nm_perawatan,
                kategori_perawatan.nm_kategori,
                jns_perawatan.total_byrdr,
                jns_perawatan.total_byrpr,
                jns_perawatan.total_byrdrpr,
                jns_perawatan.bhp,
                jns_perawatan.material,
                jns_perawatan.tarif_tindakandr,
                jns_perawatan.tarif_tindakanpr,
                jns_perawatan.kso,
                jns_perawatan.menejemen 
            FROM
                jns_perawatan
                INNER JOIN kategori_perawatan ON jns_perawatan.kd_kategori = kategori_perawatan.kd_kategori 
            WHERE
                jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND ( jns_perawatan.kd_pj =".$params['kd_pj']." OR jns_perawatan.kd_pj = '-' ) 
                AND ( jns_perawatan.kd_poli =".$params['kd_poli']." OR jns_perawatan.kd_poli = '-' ) 
                AND jns_perawatan.kd_jenis_prw LIKE ".$params['search_text']." 
                OR jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND ( jns_perawatan.kd_pj =".$params['kd_pj']." OR jns_perawatan.kd_pj = '-' ) 
                AND ( jns_perawatan.kd_poli =".$params['kd_poli']." OR jns_perawatan.kd_poli = '-' ) 
                AND jns_perawatan.nm_perawatan LIKE ".$params['search_text']." 
                OR jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND ( jns_perawatan.kd_pj =".$params['kd_pj']." OR jns_perawatan.kd_pj = '-' ) 
                AND ( jns_perawatan.kd_poli =".$params['kd_poli']." OR jns_perawatan.kd_poli = '-' ) 
                AND kategori_perawatan.nm_kategori LIKE ".$params['search_text']." 
            ORDER BY
                jns_perawatan.nm_perawatan
        ";

        $sql_2 = "
            SELECT
                jns_perawatan.kd_jenis_prw,
                jns_perawatan.nm_perawatan,
                kategori_perawatan.nm_kategori,
                jns_perawatan.total_byrdr,
                jns_perawatan.total_byrpr,
                jns_perawatan.total_byrdrpr,
                jns_perawatan.bhp,
                jns_perawatan.material,
                jns_perawatan.tarif_tindakandr,
                jns_perawatan.tarif_tindakanpr,
                jns_perawatan.kso,
                jns_perawatan.menejemen 
            FROM
                jns_perawatan
                INNER JOIN kategori_perawatan ON jns_perawatan.kd_kategori = kategori_perawatan.kd_kategori 
            WHERE
                jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND ( jns_perawatan.kd_pj =".$params['kd_pj']." OR jns_perawatan.kd_pj = '-' ) 
                AND jns_perawatan.kd_jenis_prw LIKE ".$params['search_text']." 
                OR jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND ( jns_perawatan.kd_pj =".$params['kd_pj']." OR jns_perawatan.kd_pj = '-' ) 
                AND jns_perawatan.nm_perawatan LIKE ".$params['search_text']." 
                OR jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND ( jns_perawatan.kd_pj =".$params['kd_pj']." OR jns_perawatan.kd_pj = '-' ) 
                AND kategori_perawatan.nm_kategori LIKE ".$params['search_text']." 
            ORDER BY
                jns_perawatan.nm_perawatan
        ";

        $sql_3 = "
            SELECT
                jns_perawatan.kd_jenis_prw,
                jns_perawatan.nm_perawatan,
                kategori_perawatan.nm_kategori,
                jns_perawatan.total_byrdr,
                jns_perawatan.total_byrpr,
                jns_perawatan.total_byrdrpr,
                jns_perawatan.bhp,
                jns_perawatan.material,
                jns_perawatan.tarif_tindakandr,
                jns_perawatan.tarif_tindakanpr,
                jns_perawatan.kso,
                jns_perawatan.menejemen 
            FROM
                jns_perawatan
                INNER JOIN kategori_perawatan ON jns_perawatan.kd_kategori = kategori_perawatan.kd_kategori 
            WHERE
                jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND ( jns_perawatan.kd_poli =".$params['kd_poli']." OR jns_perawatan.kd_poli = '-' ) 
                AND jns_perawatan.kd_jenis_prw LIKE ".$params['search_text']." 
                OR jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND ( jns_perawatan.kd_poli =".$params['kd_poli']." OR jns_perawatan.kd_poli = '-' ) 
                AND jns_perawatan.nm_perawatan LIKE ".$params['search_text']." 
                OR jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND ( jns_perawatan.kd_poli =".$params['kd_poli']." OR jns_perawatan.kd_poli = '-' ) 
                AND kategori_perawatan.nm_kategori LIKE ".$params['search_text']." 
            ORDER BY
                jns_perawatan.nm_perawatan 
        ";

        $sql_4 = "
            SELECT
                jns_perawatan.kd_jenis_prw,
                jns_perawatan.nm_perawatan,
                kategori_perawatan.nm_kategori,
                jns_perawatan.total_byrdr,
                jns_perawatan.total_byrpr,
                jns_perawatan.total_byrdrpr,
                jns_perawatan.bhp,
                jns_perawatan.material,
                jns_perawatan.tarif_tindakandr,
                jns_perawatan.tarif_tindakanpr,
                jns_perawatan.kso,
                jns_perawatan.menejemen 
            FROM
                jns_perawatan
                INNER JOIN kategori_perawatan ON jns_perawatan.kd_kategori = kategori_perawatan.kd_kategori 
            WHERE
                jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND jns_perawatan.kd_jenis_prw LIKE ".$params['search_text']." 
                OR jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND jns_perawatan.nm_perawatan LIKE ".$params['search_text']." 
                OR jns_perawatan.total_byrdr > 0 
                AND jns_perawatan.STATUS = '1' 
                AND kategori_perawatan.nm_kategori LIKE ".$params['search_text']." 
            ORDER BY
                jns_perawatan.nm_perawatan
        ";
        
        $query='';
        if($get_poli_ralan=='yes' and $get_cara_bayar_ralan=='yes' ){
            $query=$sql_1;
        }else if($get_poli_ralan=='no' and $get_cara_bayar_ralan=='yes' ){
            $query=$sql_2;
        }else if($get_poli_ralan=='yes' and $get_cara_bayar_ralan=='no' ){
            $query=$sql_3;
        }else if($get_poli_ralan=='no' and $get_cara_bayar_ralan=='no' ){
            $query=$sql_4;
        }

        if(!empty($query)){
            return DB::select($query);
        }else{
            return [];
        }
    }

    function getJnsPerawatanTindakanDokterRanapList($ruang_ranap,$cara_bayar_ranap,$kelas_ranap,$params)
    {
        $params['search_text']=!empty($params['search_text']) ? $params['search_text'] : '';
        $params['search_text']="'".'%'.$params['search_text'].'%'."'";
        $params['kd_pj']="'".$params['kd_pj']."'";
        $params['kd_bangsal']="'".$params['kd_bangsal']."'";
        $params['kelas']="'".$params['kelas']."'";
        $params['nm_kategori']="'".$params['nm_kategori']."'";
        
        $sql = "
            SELECT
                jns_perawatan_inap.kd_jenis_prw,
                jns_perawatan_inap.nm_perawatan,
                kategori_perawatan.nm_kategori,
                jns_perawatan_inap.total_byrdr,
                jns_perawatan_inap.total_byrpr,
                jns_perawatan_inap.total_byrdrpr,
                jns_perawatan_inap.bhp,
                jns_perawatan_inap.material,
                jns_perawatan_inap.tarif_tindakandr,
                jns_perawatan_inap.tarif_tindakanpr,
                jns_perawatan_inap.kso,
                jns_perawatan_inap.menejemen,
                jns_perawatan_inap.kelas
                
                from jns_perawatan_inap 
                inner join kategori_perawatan on jns_perawatan_inap.kd_kategori=kategori_perawatan.kd_kategori
        ";

        $where = "where 
            kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and 
            (jns_perawatan_inap.kd_pj=".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') and 
            (jns_perawatan_inap.kd_bangsal=".$params['kd_bangsal']." or jns_perawatan_inap.kd_bangsal='-') and 
            jns_perawatan_inap.kd_jenis_prw like ".$params['search_text']." or kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and 
            jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_pj=".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') and 
            (jns_perawatan_inap.kd_bangsal=".$params['kd_bangsal']." or jns_perawatan_inap.kd_bangsal='-') and 
            jns_perawatan_inap.nm_perawatan like ".$params['search_text']." or kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and 
            jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_pj=".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') and 
            (jns_perawatan_inap.kd_bangsal=".$params['kd_bangsal']." or jns_perawatan_inap.kd_bangsal='-') and 
            kategori_perawatan.nm_kategori like ".$params['search_text']." order by jns_perawatan_inap.nm_perawatan";
                    
        $where2 = "where kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_pj=".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') 
                            and jns_perawatan_inap.kd_jenis_prw like ".$params['search_text']." or 
                        kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_pj=".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') 
                            and jns_perawatan_inap.nm_perawatan like ".$params['search_text']." or 
                        kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_pj=".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') 
                            and kategori_perawatan.nm_kategori like ".$params['search_text']." order by jns_perawatan_inap.nm_perawatan";
        

        $where3 = "where 
            kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and 
                jns_perawatan_inap.status='1' and 
                    (jns_perawatan_inap.kd_bangsal=".$params['kd_bangsal']." or jns_perawatan_inap.kd_bangsal='-') and 
                jns_perawatan_inap.kd_jenis_prw like ".$params['search_text']." or kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and 
                jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_bangsal=".$params['kd_bangsal']." or 
                jns_perawatan_inap.kd_bangsal='-') and jns_perawatan_inap.nm_perawatan like ".$params['search_text']." or 
                kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and 
                jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_bangsal= ".$params['kd_bangsal']." or 
                jns_perawatan_inap.kd_bangsal='-') and kategori_perawatan.nm_kategori like ".$params['nm_kategori']."
                order by jns_perawatan_inap.nm_perawatan";
        
        $where4 = "where 
            kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and 
                jns_perawatan_inap.status='1' and 
                jns_perawatan_inap.kd_jenis_prw like ".$params['search_text']." or 
                    kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and 
                    jns_perawatan_inap.nm_perawatan like ".$params['search_text']." or kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and 
                    jns_perawatan_inap.status='1' and kategori_perawatan.nm_kategori like ".$params['search_text']."
                    order by jns_perawatan_inap.nm_perawatan";
                    
        
        $where5 = "where 
            kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and
            jns_perawatan_inap.status='1' and 
                (jns_perawatan_inap.kd_pj = ".$params['kd_pj']."  or jns_perawatan_inap.kd_pj='-') and 
                (jns_perawatan_inap.kd_bangsal  =".$params['kd_bangsal']." or jns_perawatan_inap.kd_bangsal='-') and 
                (jns_perawatan_inap.kelas  =".$params['kelas']." or jns_perawatan_inap.kelas='-') and 
                jns_perawatan_inap.kd_jenis_prw IS NOT NULL or 
            kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and
            jns_perawatan_inap.status='1' and 
                (jns_perawatan_inap.kd_pj  =".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') and 
                (jns_perawatan_inap.kd_bangsal  =".$params['kd_bangsal']." or jns_perawatan_inap.kd_bangsal='-') and 
                (jns_perawatan_inap.kelas  =".$params['kelas']." or jns_perawatan_inap.kelas='-') and 
                jns_perawatan_inap.nm_perawatan IS NOT NULL or 
            kategori_perawatan.nm_kategori like ".$params['nm_kategori']."  and
            jns_perawatan_inap.status='1' and 
                (jns_perawatan_inap.kd_pj  =".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') and 
                (jns_perawatan_inap.kd_bangsal  =".$params['kd_bangsal']." or jns_perawatan_inap.kd_bangsal='-') and 
                (jns_perawatan_inap.kelas  =".$params['kelas']." or jns_perawatan_inap.kelas='-') and 
            kategori_perawatan.nm_kategori IS NOT NULL 
            order by jns_perawatan_inap.nm_perawatan
        ";
        
        $where6 = "
            where kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and 
                (jns_perawatan_inap.kd_pj=".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') and jns_perawatan_inap.kd_jenis_prw like ".$params['search_text']."or
                kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_pj=".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') and 
                jns_perawatan_inap.nm_perawatan like ".$params['search_text']." or kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and 
                (jns_perawatan_inap.kd_pj=".$params['kd_pj']." or jns_perawatan_inap.kd_pj='-') and kategori_perawatan.nm_kategori like ".$params['nm_kategori']." order by jns_perawatan_inap.nm_perawatan";
        
        
        $where7 = "where kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_bangsal=".$params['kd_bangsal']." or 
                    jns_perawatan_inap.kd_bangsal='-') and (jns_perawatan_inap.kelas=".$params['kelas']." or jns_perawatan_inap.kelas='-') and jns_perawatan_inap.kd_jenis_prw like ".$params['search_text']."
                    or kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_bangsal=".$params['kd_bangsal']." or 
                    jns_perawatan_inap.kd_bangsal='-') and (jns_perawatan_inap.kelas=".$params['kelas']." or jns_perawatan_inap.kelas='-') and jns_perawatan_inap.nm_perawatan like ".$params['search_text']."
                    or kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kd_bangsal=".$params['kd_bangsal']." or 
                    jns_perawatan_inap.kd_bangsal='-') and (jns_perawatan_inap.kelas=".$params['kelas']." or jns_perawatan_inap.kelas='-') and kategori_perawatan.nm_kategori like ".$params['search_text']."
                    order by jns_perawatan_inap.nm_perawatan";

        $where8 = "where kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kelas=".$params['kelas']." or 
                            jns_perawatan_inap.kelas='-') and jns_perawatan_inap.kd_jenis_prw like ".$params['search_text']." or 
                        kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kelas=".$params['kelas']." or 
                            jns_perawatan_inap.kelas='-') and jns_perawatan_inap.nm_perawatan like ".$params['search_text']." or 
                        kategori_perawatan.nm_kategori like ".$params['nm_kategori']." and jns_perawatan_inap.status='1' and (jns_perawatan_inap.kelas=".$params['kelas']." or 
                            jns_perawatan_inap.kelas='-') and kategori_perawatan.nm_kategori like ".$params['search_text']." order by jns_perawatan_inap.nm_perawatan";

        $query='';
        if($ruang_ranap=='yes' and $cara_bayar_ranap=='yes' and  $kelas_ranap=='no' ){
            $query=$sql. $where;
        }else if($ruang_ranap=='no' and $cara_bayar_ranap=='yes' and  $kelas_ranap=='no' ){
            $query=$sql. $where2;
        }else if($ruang_ranap=='yes' and $cara_bayar_ranap=='no' and  $kelas_ranap=='no' ){
            $query=$sql. $where3;
        }else if($ruang_ranap=='no' and $cara_bayar_ranap=='no' and  $kelas_ranap=='no' ){
            $query=$sql. $where4;
        }else if($ruang_ranap=='yes' and $cara_bayar_ranap=='yes' and  $kelas_ranap=='yes' ){
            $query=$sql. $where5;
        }else if($ruang_ranap=='no' and $cara_bayar_ranap=='yes' and  $kelas_ranap=='yes' ){
            $query=$sql. $where6;
        }else if($ruang_ranap=='yes' and $cara_bayar_ranap=='no' and  $kelas_ranap=='yes' ){
            $query=$sql. $where7;
        }else if($ruang_ranap=='no' and $cara_bayar_ranap=='no' and  $kelas_ranap=='yes' ){
            $query=$sql. $where8;
        }

        if(!empty($query)){
            return DB::select($query);
        }else{
            return [];
        }
    }

    function insertTindakanDokter($datas,$type_akses)
    {
        if($type_akses!=='ri'){
            foreach ($datas as $data) {
                $this->rawatJlDr->insert($data);
            }
        }
        else{
            foreach ($datas as $data) {
                $this->rawatInapDr->insert($data);
            }
        }
       
        return true;
    }

    function deleteTindakanDokter($fields,$type_akses)
    {
        if($type_akses!=='ri'){
            return $this->rawatJlDr
                ->where('no_rawat', $fields['no_rawat'])
                ->where('kd_jenis_prw', $fields['kd_jenis_prw'])
                ->where('kd_dokter', $fields['kd_dokter'])
                ->where('tgl_perawatan', $fields['tgl_perawatan'])
                ->where('jam_rawat', $fields['jam_rawat'])
            ->delete();
        }else{
            return $this->rawatInapDr
                ->where('no_rawat', $fields['no_rawat'])
                ->where('kd_jenis_prw', $fields['kd_jenis_prw'])
                ->where('kd_dokter', $fields['kd_dokter'])
                ->where('tgl_perawatan', $fields['tgl_perawatan'])
                ->where('jam_rawat', $fields['jam_rawat'])
            ->delete();
        }
    }
    
}