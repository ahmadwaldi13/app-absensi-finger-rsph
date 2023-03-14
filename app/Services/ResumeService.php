<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\ResumePasien;
use App\Models\DetailPeriksaLab;
use App\Models\HasilRadiologi;
use App\Models\DetailPemberianObat;
use App\Models\KategoriPenyakit;
use App\Models\Icd9;
use App\Models\PemeriksaanRalan;
use App\Models\PemeriksaanRanap;
use App\Models\ResepPulang;
use App\Models\RawatJlDr;
use App\Models\RawatInapDr;
use App\Models\Operasi;
use App\Models\DetailBeriDiet;
use App\Models\PermintaanLab;
use App\Models\RegPeriksa;
use App\Models\ResumePasienRanap;
use App\Models\KamarInap;

class ResumeService extends BaseService
{
    public function __construct(
        ResumePasien $resumePasien,
        DetailPeriksaLab $detailPeriksaLab,
        HasilRadiologi $hasilRadiologi,
        DetailPemberianObat $detailPemberianObat,
        KategoriPenyakit $kategoriPenyakit,
        Icd9 $icd9,
        PemeriksaanRalan $pemeriksaanRalan,
        PemeriksaanRanap $pemeriksaanRanap,
        ResepPulang $resepPulang,
        RawatJlDr $rawatJlDr,
        RawatInapDr $rawatInapDr,
        Operasi $operasi,
        DetailBeriDiet $detailBeriDiet,
        PermintaanLab $permintaanLab,
        RegPeriksa $regPeriksa,
        ResumePasienRanap $resumePasienRanap,
        KamarInap $kamarInap
    ){
        parent::__construct(); 
        $this->resumePasien = $resumePasien;
        $this->detailPeriksaLab = $detailPeriksaLab;
        $this->hasilRadiologi = $hasilRadiologi;
        $this->detailPemberianObat = $detailPemberianObat;
        $this->kategoriPenyakit = $kategoriPenyakit;
        $this->icd9 = $icd9;
        $this->pemeriksaanRalan = $pemeriksaanRalan;
        $this->pemeriksaanRanap = $pemeriksaanRanap;
        $this->resepPulang = $resepPulang;
        $this->rawatJlDr = $rawatJlDr;
        $this->rawatInapDr = $rawatInapDr;
        $this->operasi = $operasi;
        $this->detailBeriDiet = $detailBeriDiet;
        $this->permintaanLab = $permintaanLab;
        $this->regPeriksa = $regPeriksa;
        $this->resumePasienRanap = $resumePasienRanap;
        $this->kamarInap = $kamarInap;
    }

    function getKondisiPasienPulangList()
    {
        return $this->resumePasien->getPossibleEnumValues('kondisi_pulang');
    }

    function insert($fields)
    {
        foreach ($fields as $key => $field) {
            $field == null ? $fields[$key] = "" : "";
        }
        return $this->resumePasien->insert($fields);
    }

    function insertRanap($fields)
    {
        foreach ($fields as $key => $field) {
            $field == null ? $fields[$key] = "" : "";
        }
        return $this->resumePasienRanap->insert($fields);
    }

    function update($params,$set,$type='')
    {
        $query=$this->resumePasien;
        foreach($params as $key => $value){
            if($type=='raw'){
                $query=$query->whereRaw($key.' = ? ', [$value]);
            }else{
                $query=$query->where($key,'=',$value);
            }
        }
        
        return $query->update($set);
    }

    function updateRanap($params,$set,$type='')
    {
        $query=$this->resumePasienRanap;
        foreach($params as $key => $value){
            if($type=='raw'){
                $query=$query->whereRaw($key.' = ? ', [$value]);
            }else{
                $query=$query->where($key,'=',$value);
            }
        }
        return $query->update($set);
    }

    function delete($params,$type='')
    {
        $query=$this->resumePasien;
        foreach($params as $key => $value){
            if($type=='raw'){
                $query=$query->whereRaw($key.' = ? ', [$value]);
            }else{
                $query=$query->where($key,'=',$value);
            }
        }
        return $query->delete();
    }

    function deleteRanap($params,$type='')
    {
        $query=$this->resumePasienRanap;
        foreach($params as $key => $value){
            if($type=='raw'){
                $query=$query->whereRaw($key.' = ? ', [$value]);
            }else{
                $query=$query->where($key,'=',$value);
            }
        }
        return $query->delete();
    }

    function getResumeList($where=[],$data_tgl=[]){

        // $query=$this->resumePasien
        //     ->select('reg_periksa.tgl_registrasi','reg_periksa.no_rawat','reg_periksa.status_lanjut','reg_periksa.no_rkm_medis','pasien.nm_pasien','resume_pasien.kd_dokter','dokter.nm_dokter','resume_pasien.kondisi_pulang','resume_pasien.keluhan_utama','resume_pasien.jalannya_penyakit','resume_pasien.pemeriksaan_penunjang','resume_pasien.hasil_laborat','resume_pasien.diagnosa_utama','resume_pasien.kd_diagnosa_utama','resume_pasien.diagnosa_sekunder','resume_pasien.kd_diagnosa_sekunder','resume_pasien.diagnosa_sekunder2','resume_pasien.kd_diagnosa_sekunder2','resume_pasien.diagnosa_sekunder3','resume_pasien.kd_diagnosa_sekunder3','resume_pasien.diagnosa_sekunder4','resume_pasien.kd_diagnosa_sekunder4','resume_pasien.prosedur_utama','resume_pasien.kd_prosedur_utama','resume_pasien.prosedur_sekunder','resume_pasien.kd_prosedur_sekunder','resume_pasien.prosedur_sekunder2','resume_pasien.kd_prosedur_sekunder2','resume_pasien.prosedur_sekunder3','resume_pasien.kd_prosedur_sekunder3',
        //     'resume_pasien.obat_pulang')
        //     ->join('reg_periksa', 'resume_pasien.no_rawat', '=', 'reg_periksa.no_rawat')
        //     ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
        //     ->join('dokter', 'resume_pasien.kd_dokter', '=', 'dokter.kd_dokter')
        //     ->orderBy('reg_periksa.tgl_registrasi','DESC')
        // ;
        $check_field=$this->resumePasien->get_columns_table(['Field'=>'id_resume']);
        $query_select=['reg_periksa.tgl_registrasi', 'reg_periksa.no_rawat', 'reg_periksa.status_lanjut', 'reg_periksa.no_rkm_medis', 'pasien.nm_pasien', 'pasien.umur', 'pasien.tgl_lahir', 'pasien.pekerjaan', 'pasien.alamat', 'pasien.jk', 'poliklinik.nm_poli', 'resume_pasien.kd_dokter', 'dokter.nm_dokter', 'resume_pasien.kondisi_pulang', 'resume_pasien.keluhan_utama', 'resume_pasien.jalannya_penyakit', 'resume_pasien.pemeriksaan_penunjang', 'resume_pasien.hasil_laborat', 'resume_pasien.diagnosa_utama', 'resume_pasien.kd_diagnosa_utama', 'resume_pasien.diagnosa_sekunder', 'resume_pasien.kd_diagnosa_sekunder', 'resume_pasien.diagnosa_sekunder2', 'resume_pasien.kd_diagnosa_sekunder2', 'resume_pasien.diagnosa_sekunder3', 'resume_pasien.kd_diagnosa_sekunder3', 'resume_pasien.diagnosa_sekunder4', 'resume_pasien.kd_diagnosa_sekunder4', 'resume_pasien.prosedur_utama', 'resume_pasien.kd_prosedur_utama', 'resume_pasien.prosedur_sekunder', 'resume_pasien.kd_prosedur_sekunder', 'resume_pasien.prosedur_sekunder2', 'resume_pasien.kd_prosedur_sekunder2', 'resume_pasien.prosedur_sekunder3', 'resume_pasien.kd_prosedur_sekunder3', 'resume_pasien.obat_pulang'];
        if($check_field){
            array_unshift($query_select,"id_resume");
        }
        
        $query = $this->resumePasien->select($query_select)
        ->join('reg_periksa','resume_pasien.no_rawat','=','reg_periksa.no_rawat')
        ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
        ->join('dokter','resume_pasien.kd_dokter','=','dokter.kd_dokter')
        ->leftJoin('poliklinik','poliklinik.kd_poli','=','reg_periksa.kd_poli')
        ->orderBy('reg_periksa.tgl_registrasi','desc');
        if(!empty($where)){
            foreach($where as $key => $value){
                if($key!='search' and $key!='raw'){
                    $query->where($key,'=',$value);
                }
            }
        }

        if(!empty($where['raw'])){
            $where_raw=$where['raw'];
            foreach($where_raw as $key => $value){
                $query->whereRaw($key.' = ? ', [$value]);
            }
        }

        if(!empty($data_tgl)){
            if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                $query->whereBetween('reg_periksa.tgl_registrasi', $data_tgl);
            }
        }

        if(!empty($where['search'])){
            $search=$where['search'];
            $query->where(function ($qb2) use ($search) {
                $qb2->where('reg_periksa.status_lanjut', 'LIKE', '%' . $search . '%')
                    ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                    ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                    ->orWhere('resume_pasien.kd_dokter', 'LIKE', '%' . $search . '%')
                    ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                    ->orWhere('resume_pasien.kondisi_pulang', 'LIKE', '%' . $search . '%')
                    ->orWhere('resume_pasien.kd_diagnosa_utama', 'LIKE', '%' . $search . '%')
                    ->orWhere('resume_pasien.diagnosa_utama', 'LIKE', '%' . $search . '%')
                    ->orWhere('resume_pasien.prosedur_utama', 'LIKE', '%' . $search . '%')
                    ->orWhere('reg_periksa.no_rawat', 'LIKE', '%' . $search . '%')
                    ->orWhere('resume_pasien.kd_prosedur_utama', 'LIKE', '%' . $search . '%')
                ;
            });
        }

        return $query->get();
    }

    function getResumeRanapList($params){
        $return=[];
        $return_tmp=[];

        $check_field=$this->resumePasienRanap->get_columns_table(['Field'=>'id_resume_ranap']);
        $query_select=['reg_periksa.no_rawat','reg_periksa.no_rkm_medis', 'pasien.nm_pasien', 'pasien.umur', 'pasien.tgl_lahir', 'pasien.pekerjaan', 'pasien.alamat', 'pasien.jk','resume_pasien_ranap.kd_dokter','dokter.nm_dokter','reg_periksa.kd_dokter as kodepengirim','pengirim.nm_dokter as pengirim','reg_periksa.tgl_registrasi','reg_periksa.jam_reg','resume_pasien_ranap.diagnosa_awal','resume_pasien_ranap.alasan','resume_pasien_ranap.keluhan_utama','resume_pasien_ranap.pemeriksaan_fisik','resume_pasien_ranap.jalannya_penyakit','resume_pasien_ranap.pemeriksaan_penunjang','resume_pasien_ranap.hasil_laborat','resume_pasien_ranap.tindakan_dan_operasi','resume_pasien_ranap.obat_di_rs','resume_pasien_ranap.diagnosa_utama','resume_pasien_ranap.kd_diagnosa_utama','resume_pasien_ranap.diagnosa_sekunder','resume_pasien_ranap.kd_diagnosa_sekunder','resume_pasien_ranap.diagnosa_sekunder2','resume_pasien_ranap.kd_diagnosa_sekunder2','resume_pasien_ranap.diagnosa_sekunder3','resume_pasien_ranap.kd_diagnosa_sekunder3','resume_pasien_ranap.diagnosa_sekunder4','resume_pasien_ranap.kd_diagnosa_sekunder4','resume_pasien_ranap.prosedur_utama','resume_pasien_ranap.kd_prosedur_utama','resume_pasien_ranap.prosedur_sekunder','resume_pasien_ranap.kd_prosedur_sekunder','resume_pasien_ranap.prosedur_sekunder2','resume_pasien_ranap.kd_prosedur_sekunder2','resume_pasien_ranap.prosedur_sekunder3','resume_pasien_ranap.kd_prosedur_sekunder3','resume_pasien_ranap.alergi','resume_pasien_ranap.diet','resume_pasien_ranap.lab_belum','resume_pasien_ranap.edukasi','resume_pasien_ranap.cara_keluar','resume_pasien_ranap.ket_keluar','resume_pasien_ranap.keadaan','resume_pasien_ranap.ket_keadaan','resume_pasien_ranap.dilanjutkan','resume_pasien_ranap.ket_dilanjutkan','resume_pasien_ranap.kontrol','resume_pasien_ranap.obat_pulang','reg_periksa.kd_pj','penjab.png_jawab'];
        if($check_field){
            array_unshift($query_select,"id_resume_ranap");
        }

        $query = $this->resumePasienRanap
            ->select($query_select)
            ->join('reg_periksa','resume_pasien_ranap.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('dokter','resume_pasien_ranap.kd_dokter','=','dokter.kd_dokter')
            ->join('dokter as pengirim','reg_periksa.kd_dokter','=','pengirim.kd_dokter')
            ->join('penjab','penjab.kd_pj','=','reg_periksa.kd_pj')
            ->orderBy('reg_periksa.tgl_registrasi','DESC')
            // ->orderBy('reg_periksa.status_lanjut','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                
                if($key!='tgl_registrasi' and $key!='search' and $key!='raw'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['raw'])){
                $where_raw=$params['raw'];
                foreach($where_raw as $key => $value){
                    $query->whereRaw($key.' = ? ', [$value]);
                }
            }

            if(!empty($params['tgl_registrasi'])){
                $data_tgl=$params['tgl_registrasi'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('reg_periksa.tgl_registrasi', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->where('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->where('resume_pasien_ranap.kd_dokter', 'LIKE', '%' . $search . '%')
                        ->where('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->where('resume_pasien_ranap.keadaan', 'LIKE', '%' . $search . '%')
                        ->where('resume_pasien_ranap.kd_diagnosa_utama', 'LIKE', '%' . $search . '%')
                        ->where('resume_pasien_ranap.diagnosa_utama', 'LIKE', '%' . $search . '%')
                        ->where('resume_pasien_ranap.prosedur_utama', 'LIKE', '%' . $search . '%')
                        ->where('reg_periksa.no_rawat', 'LIKE', '%' . $search . '%')
                        ->where('resume_pasien_ranap.kd_prosedur_utama', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }
        // dd($query->get());
        return $query->get();
    }

    function getKamarInap($params){
        
        $query = $this->kamarInap
            ->select(DB::raw('if(kamar_inap.tgl_keluar=\'0000-00-00\',current_date(),kamar_inap.tgl_keluar) as tgl_keluar'),DB::raw('if(kamar_inap.jam_keluar=\'00:00:00\',current_time(),kamar_inap.jam_keluar) as jam_keluar'),'kamar_inap.kd_kamar','bangsal.nm_bangsal')
            ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            ->orderBy('kamar_inap.tgl_keluar','ASC')
            ->orderBy('kamar_inap.jam_keluar','DESC')
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

    function getDataRawatRanap($params){

        $query = $this->regPeriksa
            ->select('reg_periksa.no_rkm_medis','pasien.nm_pasien','reg_periksa.tgl_registrasi','reg_periksa.jam_reg','reg_periksa.kd_dokter','dokter.nm_dokter','reg_periksa.kd_pj','penjab.png_jawab',DB::raw('if(kamar_inap.tgl_keluar=\'0000-00-00\',current_date(),kamar_inap.tgl_keluar) as tgl_keluar'),DB::raw('if(kamar_inap.jam_keluar=\'00:00:00\',current_time(),kamar_inap.jam_keluar) as jam_keluar'),'kamar_inap.diagnosa_awal','kamar_inap.kd_kamar','bangsal.nm_bangsal')
            ->join('pasien','pasien.no_rkm_medis','=','reg_periksa.no_rkm_medis')
            ->join('dokter','dokter.kd_dokter','=','reg_periksa.kd_dokter')
            ->join('penjab','penjab.kd_pj','=','reg_periksa.kd_pj')
            ->join('kamar_inap','kamar_inap.no_rawat','=','reg_periksa.no_rawat')
            ->join('kamar','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->join('bangsal','kamar.kd_bangsal','=','bangsal.kd_bangsal')
            ->orderBy('kamar_inap.tgl_keluar','ASC')
            ->orderBy('kamar_inap.jam_keluar','DESC')
        ;

        if($params){
            foreach($params as $key =>$value){
                
                if($key!='tgl_registrasi' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_registrasi'])){
                $data_tgl=$params['tgl_registrasi'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('reg_periksa.tgl_registrasi', $data_tgl);
                }
            }

            // if(!empty($params['search'])){
            //     $search=$params['search'];
            //     $query->where(function ($qb2) use ($search) {
            //         $qb2->where('template_laboratorium.Pemeriksaan', 'LIKE', '%' . $search . '%')
            //         ;
            //     });
            // }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getKeluhanUtamaRalan($params){

        $query = $this->pemeriksaanRalan
            ->select('pemeriksaan_ralan.tgl_perawatan','pemeriksaan_ralan.jam_rawat','pemeriksaan_ralan.keluhan','pemeriksaan_ralan.pemeriksaan','pemeriksaan_ralan.nip', 'pegawai.nama')
            ->join('pegawai', 'pegawai.nik', '=', 'pemeriksaan_ralan.nip')
            ->orderBy('pemeriksaan_ralan.tgl_perawatan','ASC')
            ->orderBy('pemeriksaan_ralan.jam_rawat','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                
                if($key!='tgl_perawatan' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_perawatan'])){
                $data_tgl=$params['tgl_perawatan'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('pemeriksaan_ralan.tgl_perawatan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('pemeriksaan_ralan.keluhan', 'LIKE', '%' . $search . '%')
                        ->where('pegawai.nama', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getKeluhanUtamaRanap($params){

        $query = $this->pemeriksaanRanap
            ->select('pemeriksaan_ranap.tgl_perawatan','pemeriksaan_ranap.jam_rawat','pemeriksaan_ranap.keluhan','pemeriksaan_ranap.pemeriksaan','pemeriksaan_ranap.nip', 'pegawai.nama')
            ->join('pegawai', 'pegawai.nik', '=', 'pemeriksaan_ranap.nip')
            ->orderBy('pemeriksaan_ranap.tgl_perawatan','ASC')
            ->orderBy('pemeriksaan_ranap.jam_rawat','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                
                if($key!='tgl_perawatan' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_perawatan'])){
                $data_tgl=$params['tgl_perawatan'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('pemeriksaan_ranap.tgl_perawatan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('pemeriksaan_ranap.keluhan', 'LIKE', '%' . $search . '%')
                        ->where('pegawai.nama', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getDetailPeriksaLabList($noRawat)
    {
        return $this->detailPeriksaLab
            ->select('detail_periksa_lab.tgl_periksa', 'detail_periksa_lab.jam', 'template_laboratorium.Pemeriksaan', 'detail_periksa_lab.nilai')
            ->join('template_laboratorium', 'detail_periksa_lab.id_template', '=', 'template_laboratorium.id_template')
            ->where('detail_periksa_lab.no_rawat', '=', $noRawat)
            ->orderBy('detail_periksa_lab.tgl_periksa', 'ASC')
            ->orderBy('detail_periksa_lab.jam', 'ASC')
            ->get();
    }

    function getHasilRadiologiList($noRawat)
    {
        return $this->hasilRadiologi
            ->select('tgl_periksa', 'jam', 'hasil')
            ->where('no_rawat', '=', $noRawat)
            ->orderBy('tgl_periksa', 'ASC')
            ->orderBy('jam', 'ASC')
            ->get();
    }

    function getRiwayatTindakanOperasi($params,$params2,$params3){
        $return=[];
        $return_tmp=[];
        $query = $this->rawatJlDr
            ->select('rawat_jl_dr.tgl_perawatan','rawat_jl_dr.jam_rawat','jns_perawatan.nm_perawatan')
            ->join('jns_perawatan','rawat_jl_dr.kd_jenis_prw','=','jns_perawatan.kd_jenis_prw')
            ->orderBy('rawat_jl_dr.tgl_perawatan','ASC')
            ->orderBy('rawat_jl_dr.jam_rawat','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                
                if($key!='tgl_perawatan' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_perawatan'])){
                $data_tgl=$params['tgl_perawatan'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('rawat_jl_dr.tgl_perawatan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('jns_perawatan.nm_perawatan', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        $query=$query->get();
        $return_tmp[]=$query->toArray();

        $query = $this->rawatInapDr
            ->select('rawat_inap_dr.tgl_perawatan','rawat_inap_dr.jam_rawat','jns_perawatan_inap.nm_perawatan')
            ->join('jns_perawatan_inap','rawat_inap_dr.kd_jenis_prw','=','jns_perawatan_inap.kd_jenis_prw')
            ->orderBy('rawat_inap_dr.tgl_perawatan','ASC')
            ->orderBy('rawat_inap_dr.jam_rawat','ASC')
        ;

        if($params2){
            foreach($params2 as $key =>$value){
                
                if($key!='tgl_perawatan' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params2['tgl_perawatan'])){
                $data_tgl=$params2['tgl_perawatan'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('rawat_inap_dr.tgl_perawatan', $data_tgl);
                }
            }

            if(!empty($params2['search'])){
                $search=$params2['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('jns_perawatan_inap.nm_perawatan', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        $query=$query->get();
        $return_tmp[]=$query->toArray();

        $query = $this->operasi
        ->select(DB::raw('DATE_FORMAT(operasi.tgl_operasi,\'%Y-%m-%d\') as tgl_operasi'),DB::raw('DATE_FORMAT(operasi.tgl_operasi,\'%H:%i:%s\') as jamoperasi'),'paket_operasi.nm_perawatan')
        ->join('paket_operasi','operasi.kode_paket','=','paket_operasi.kode_paket')
        ->orderBy('operasi.tgl_operasi','ASC')
        ;

        if($params3){
            foreach($params3 as $key =>$value){
                
                if($key!='tgl_operasi' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params3['tgl_operasi'])){
                $data_tgl=$params3['tgl_operasi'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('operasi.tgl_operasi', $data_tgl);
                }
            }

            if(!empty($params3['search'])){
                $search=$params3['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('paket_operasi.nm_perawatan', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        $query=$query->get();
        $return_tmp[]=$query->toArray();

        foreach($return_tmp as $key => $value){
            $return=array_merge($value,$return);
        }

        return $return;
    }

    function getObatRs($noRawat)
    {
        return $this->detailPemberianObat
            ->select('detail_pemberian_obat.tgl_perawatan', 'detail_pemberian_obat.jam', 'databarang.nama_brng', 'detail_pemberian_obat.jml', 'databarang.kode_sat')
            ->join('databarang', 'detail_pemberian_obat.kode_brng', '=', 'databarang.kode_brng')
            ->where('detail_pemberian_obat.no_rawat', '=', $noRawat)
            ->orderBy('detail_pemberian_obat.tgl_perawatan', 'ASC')
            ->orderBy('detail_pemberian_obat.jam', 'ASC')
            ->get();
    }

    function getDiagnosaList($filter)
    {
        return
            $this->kategoriPenyakit->select('penyakit.kd_penyakit', 'penyakit.nm_penyakit', 'penyakit.ciri_ciri', 'penyakit.keterangan', 'kategori_penyakit.nm_kategori', 'kategori_penyakit.ciri_umum')
            ->join('penyakit', 'penyakit.kd_ktg', '=', 'kategori_penyakit.kd_ktg')


            ->when($filter, function ($query, $filter) {
                $query->where('penyakit.kd_penyakit', 'LIKE', '%' . $filter . '%')
                    ->orWhere('penyakit.nm_penyakit', 'LIKE', '%' . $filter . '%')
                    ->orWhere('penyakit.ciri_ciri', 'LIKE', '%' . $filter . '%')
                    ->orWhere('penyakit.keterangan', 'LIKE', '%' . $filter . '%')
                    ->orWhere('kategori_penyakit.nm_kategori', 'LIKE', '%' . $filter . '%')
                    ->orWhere('kategori_penyakit.ciri_umum', 'LIKE', '%' . $filter . '%');
            })
            ->orderBy('penyakit.kd_penyakit', 'ASC')
            ->limit(1000)
            ->get();
    }

    function getProsedurList($filter)
    {
        return $this->icd9
            ->when($filter, function ($query, $filter) {
                $query->where('kode', 'LIKE', '%' . $filter . '%')
                    ->orWhere('deskripsi_panjang', 'LIKE', '%' . $filter . '%')
                    ->orWhere('deskripsi_pendek', 'LIKE', '%' . $filter . '%');
            })
            ->orderBy('kode')
            ->get();
    }

    function getObatPulang($params){

        $query = $this->resepPulang
            ->select('resep_pulang.tanggal','resep_pulang.jam','databarang.nama_brng','resep_pulang.jml_barang','resep_pulang.dosis')
            ->join('databarang','databarang.kode_brng','=','resep_pulang.kode_brng')
            ->orderBy('resep_pulang.tanggal','ASC')
            ->orderBy('resep_pulang.jam','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                
                if($key!='tanggal' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tanggal'])){
                $data_tgl=$params['tanggal'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('resep_pulang.tanggal', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('databarang.nama_brng', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getRiwayatDiet($params){

        $query = $this->detailBeriDiet
            ->select('detail_beri_diet.tanggal','detail_beri_diet.waktu','diet.nama_diet')
            ->join('diet','detail_beri_diet.kd_diet','=','diet.kd_diet')
            ->orderBy('detail_beri_diet.tanggal','ASC')
            ->orderBy('detail_beri_diet.waktu','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                
                if($key!='tanggal' and $key!='search'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tanggal'])){
                $data_tgl=$params['tanggal'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('detail_beri_diet.tanggal', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('diet.nama_diet', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }

    function getRiwayatLabBelum($params){

        $query = $this->permintaanLab
            ->select('permintaan_lab.tgl_permintaan','permintaan_lab.jam_permintaan','template_laboratorium.Pemeriksaan')
            ->join('permintaan_detail_permintaan_lab','permintaan_detail_permintaan_lab.noorder','=','permintaan_lab.noorder')
            ->join('template_laboratorium','permintaan_detail_permintaan_lab.id_template','=','template_laboratorium.id_template')
            ->orderBy('permintaan_lab.tgl_permintaan','ASC')
            ->orderBy('permintaan_lab.jam_permintaan','ASC')
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
                    $qb2->where('template_laboratorium.Pemeriksaan', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
        // return $query->toSql();
    }
}