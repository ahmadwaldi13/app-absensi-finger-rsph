<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Models\PemeriksaanRalan;
use App\Models\PemeriksaanRanap;

class CpptService extends BaseService
{
    public function __construct(
        Pasien $pasien,
        PemeriksaanRalan $pemeriksaanRalan,
        PemeriksaanRanap $pemeriksaanRanap
    ){
        parent::__construct();
        $this->pasien = $pasien;
        $this->pemeriksaanRalan = $pemeriksaanRalan;
        $this->pemeriksaanRanap = $pemeriksaanRanap;
    }

    function getCpptKesadaran()
    {
        return $this->pemeriksaanRalan->getPossibleEnumValues('kesadaran');
    }

    function getCpptRalanListByNoRm($noRm,$data_tgl=[])
    {
        $query = $this->pasien
            ->select('pemeriksaan_ralan.no_rawat', 'reg_periksa.no_rkm_medis', 'pasien.nm_pasien', 'pemeriksaan_ralan.tgl_perawatan', 'pemeriksaan_ralan.jam_rawat', 'pemeriksaan_ralan.suhu_tubuh', 'pemeriksaan_ralan.tensi', 'pemeriksaan_ralan.nadi', 'pemeriksaan_ralan.respirasi', 'pemeriksaan_ralan.tinggi', 'pemeriksaan_ralan.berat', 'pemeriksaan_ralan.gcs', 'pemeriksaan_ralan.kesadaran', 'pemeriksaan_ralan.keluhan', 'pemeriksaan_ralan.pemeriksaan', 'pemeriksaan_ralan.alergi', 'pemeriksaan_ralan.rtl', 'pemeriksaan_ralan.penilaian', 'pemeriksaan_ralan.instruksi', 'pemeriksaan_ralan.nip', 'pegawai.nama','pemeriksaan_ralan.spo2','pemeriksaan_ralan.evaluasi')
            ->join('reg_periksa', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('pemeriksaan_ralan', 'pemeriksaan_ralan.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pegawai', 'pemeriksaan_ralan.nip', '=', 'pegawai.nik')
            ->where('reg_periksa.no_rkm_medis', 'LIKE', $noRm)
            // ->orderBy('pemeriksaan_ralan.no_rawat', 'DESC')
            ->orderBy('pemeriksaan_ralan.tgl_perawatan', 'DESC')
            ->orderBy('pemeriksaan_ralan.jam_rawat', 'DESC')
        ;

        if(!empty($data_tgl)){
            if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                $query->whereBetween('pemeriksaan_ralan.tgl_perawatan', $data_tgl);
            }
        }
        return $query->get();
    }

    function getCpptRanapListByNoRm($noRm,$data_tgl=[])
    {
        $query = $this->pasien
            ->select('pemeriksaan_ranap.no_rawat', 'reg_periksa.no_rkm_medis', 'pasien.nm_pasien', 'pemeriksaan_ranap.tgl_perawatan', 'pemeriksaan_ranap.jam_rawat', 'pemeriksaan_ranap.suhu_tubuh', 'pemeriksaan_ranap.tensi', 'pemeriksaan_ranap.nadi', 'pemeriksaan_ranap.respirasi', 'pemeriksaan_ranap.tinggi', 'pemeriksaan_ranap.berat', 'pemeriksaan_ranap.gcs', 'pemeriksaan_ranap.kesadaran', 'pemeriksaan_ranap.keluhan', 'pemeriksaan_ranap.pemeriksaan', 'pemeriksaan_ranap.alergi', 'pemeriksaan_ranap.rtl', 'pemeriksaan_ranap.penilaian', 'pemeriksaan_ranap.instruksi', 'pemeriksaan_ranap.nip', 'pegawai.nama','pemeriksaan_ranap.spo2','pemeriksaan_ranap.evaluasi')
            ->join('reg_periksa', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('pemeriksaan_ranap', 'pemeriksaan_ranap.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pegawai', 'pemeriksaan_ranap.nip', '=', 'pegawai.nik')
            ->where('reg_periksa.no_rkm_medis', 'LIKE', $noRm)
            // ->orderBy('pemeriksaan_ranap.no_rawat', 'DESC')
            ->orderBy('pemeriksaan_ranap.tgl_perawatan', 'DESC')
            ->orderBy('pemeriksaan_ranap.jam_rawat', 'DESC')
        ;

        if(!empty($data_tgl)){
            if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                $query->whereBetween('pemeriksaan_ranap.tgl_perawatan', $data_tgl);
            }
        }

        return $query->get();
    }

    public function getLastPemeriksaanRalan(string $noRm)
    {
        return $this->pemeriksaanRalan
            ->join('reg_periksa', 'pemeriksaan_ralan.no_rawat', '=', 'reg_periksa.no_rawat')
            ->where('reg_periksa.no_rkm_medis', '=', $noRm)
            ->orderByDesc('pemeriksaan_ralan.tgl_perawatan')
            ->orderByDesc('pemeriksaan_ralan.jam_rawat')
            ->first();
    }

    public function getLastPemeriksaanRanap(string $noRm)
    {
        return $this->pemeriksaanRanap
            ->join('reg_periksa', 'pemeriksaan_ranap.no_rawat', '=', 'reg_periksa.no_rawat')
            ->where('reg_periksa.no_rkm_medis', '=', $noRm)
            ->orderByDesc('pemeriksaan_ranap.tgl_perawatan')
            ->orderByDesc('pemeriksaan_ranap.jam_rawat')
            ->first();
    }

    function getDataCpptRalanList($params=[])
    {
        $query= $this->pasien
            ->select('pemeriksaan_ralan.no_rawat', 'reg_periksa.no_rkm_medis', 'pasien.nm_pasien', 'pemeriksaan_ralan.tgl_perawatan', 'pemeriksaan_ralan.jam_rawat', 'pemeriksaan_ralan.suhu_tubuh', 'pemeriksaan_ralan.tensi', 'pemeriksaan_ralan.nadi', 'pemeriksaan_ralan.respirasi', 'pemeriksaan_ralan.tinggi', 'pemeriksaan_ralan.berat', 'pemeriksaan_ralan.gcs', 'pemeriksaan_ralan.kesadaran', 'pemeriksaan_ralan.keluhan', 'pemeriksaan_ralan.pemeriksaan', 'pemeriksaan_ralan.alergi', 'pemeriksaan_ralan.rtl', 'pemeriksaan_ralan.penilaian', 'pemeriksaan_ralan.instruksi', 'pemeriksaan_ralan.nip', 'pegawai.nama','pemeriksaan_ralan.spo2','pemeriksaan_ralan.evaluasi','pegawai.nama','pegawai.jbtn','pemeriksaan_ralan.lingkar_perut')
            ->join('reg_periksa', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('pemeriksaan_ralan', 'pemeriksaan_ralan.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pegawai', 'pemeriksaan_ralan.nip', '=', 'pegawai.nik')
            ->orderBy('pemeriksaan_ralan.no_rawat', 'DESC')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=!empty($value[0]) ? $value[0] : '=';
                $nilai=!empty($value[1]) ? $value[1] : '';
                $query->where($key,$type,$nilai);
            }
        }

        return $query->get();
    }

    function getDataCpptRanapList($params=[])
    {

        $query= $this->pasien
            ->select('pemeriksaan_ranap.no_rawat', 'reg_periksa.no_rkm_medis', 'pasien.nm_pasien', 'pemeriksaan_ranap.tgl_perawatan', 'pemeriksaan_ranap.jam_rawat', 'pemeriksaan_ranap.suhu_tubuh', 'pemeriksaan_ranap.tensi', 'pemeriksaan_ranap.nadi', 'pemeriksaan_ranap.respirasi', 'pemeriksaan_ranap.tinggi', 'pemeriksaan_ranap.berat', 'pemeriksaan_ranap.gcs', 'pemeriksaan_ranap.kesadaran', 'pemeriksaan_ranap.keluhan', 'pemeriksaan_ranap.pemeriksaan', 'pemeriksaan_ranap.alergi', 'pemeriksaan_ranap.rtl', 'pemeriksaan_ranap.penilaian', 'pemeriksaan_ranap.instruksi', 'pemeriksaan_ranap.nip', 'pegawai.nama','pemeriksaan_ranap.spo2','pemeriksaan_ranap.evaluasi','pegawai.nama','pegawai.jbtn')
            ->join('reg_periksa', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('pemeriksaan_ranap', 'pemeriksaan_ranap.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pegawai', 'pemeriksaan_ranap.nip', '=', 'pegawai.nik')
            ->orderBy('pemeriksaan_ranap.no_rawat', 'DESC')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=!empty($value[0]) ? $value[0] : '=';
                $nilai=!empty($value[1]) ? $value[1] : '';
                $query->where($key,$type,$nilai);
            }
        }

        return $query->get();
    }

    public function insertRalan($data)
    {
        return PemeriksaanRalan::Create($data);
    }

    function deleteRalan($noRawat, $tgl, $jam)
    {
        return PemeriksaanRalan::where('no_rawat', $noRawat)->where('tgl_perawatan', $tgl)->where('jam_rawat', $jam)->delete();
    }

    public function insertRanap($data)
    {
        return PemeriksaanRanap::Create($data);
    }

    function deleteRanap($noRawat, $tgl, $jam)
    {
        return PemeriksaanRanap::where('no_rawat', $noRawat)->where('tgl_perawatan', $tgl)->where('jam_rawat', $jam)->delete();
    }
}