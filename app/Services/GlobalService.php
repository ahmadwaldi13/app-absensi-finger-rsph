<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Petugas;
use App\Models\RegPeriksa;
use App\Models\PemeriksaanRalan;
use App\Models\DpjpRanap;
use App\Models\SettingKhanza;
use App\Models\PenanggungJawab;
class GlobalService extends BaseService
{
    protected $pasien;
    protected $dokter;
    protected $pemeriksaanRalan;
    protected $regPeriksa;
    protected $dpjpRanap;
    public function __construct(){
        parent::__construct(); 
        $this->pasien = new Pasien; 
        $this->pemeriksaanRalan = new PemeriksaanRalan;
        $this->dokter = new Dokter;
        $this->petugas = new Petugas;
        $this->regPeriksa = new RegPeriksa;
        $this->dpjpRanap = new DpjpRanap;
        $this->settingKhanza = new SettingKhanza;
        $this->penjab = new PenanggungJawab;
    }

    public function getDataPasien($noRm)
    {
        return $this->pasien
            // ->select('pasien.no_rkm_medis','pasien.umur',  'pasien.nm_pasien', 'pasien.jk', 'pasien.tmp_lahir', 'pasien.tgl_lahir', 'pasien.agama', 'bahasa_pasien.nama_bahasa', 'cacat_fisik.nama_cacat', 'pasien.gol_darah', 'pasien.nm_ibu', 'pasien.stts_nikah', 'pasien.pnd', DB::raw('concat(pasien.alamat,\', \',kelurahan.nm_kel,\', \',kecamatan.nm_kec,\', \',kabupaten.nm_kab) as alamat'), 'pasien.pekerjaan')
            ->select('pasien.*',"bahasa_pasien.nama_bahasa","cacat_fisik.nama_cacat", DB::raw('concat(pasien.alamat,\', \',kelurahan.nm_kel,\', \',kecamatan.nm_kec,\', \',kabupaten.nm_kab) as alamat'))
            ->leftJoin('bahasa_pasien', 'bahasa_pasien.id', '=', 'pasien.bahasa_pasien')
            ->leftJoin('cacat_fisik', 'cacat_fisik.id', '=', 'pasien.cacat_fisik')
            ->leftJoin('kelurahan', 'pasien.kd_kel', '=', 'kelurahan.kd_kel')
            ->leftJoin('kecamatan', 'pasien.kd_kec', '=', 'kecamatan.kd_kec')
            ->leftJoin('kabupaten', 'pasien.kd_kab', '=', 'kabupaten.kd_kab')
            ->where('pasien.no_rkm_medis', '=', $noRm)
            ->first();
    }

    function getDokterList()
    {
        return $this->dokter->select(
            'dokter.kd_dokter',
            'dokter.nm_dokter',
            'dokter.jk',
            'dokter.tmp_lahir',
            'dokter.tgl_lahir',
            'dokter.gol_drh',
            'dokter.agama',
            'dokter.almt_tgl',
            'dokter.no_telp',
            'dokter.stts_nikah',
            'spesialis.nm_sps',
            'dokter.alumni',
            'dokter.no_ijn_praktek',
            'pegawai.jbtn as jabatan'
        )
            ->join('spesialis', 'dokter.kd_sps', '=', 'spesialis.kd_sps')
            ->leftJoin('pegawai', 'dokter.kd_dokter', 'pegawai.nik')

            ->get();
    }

    function getDokterByNoRawat($noRawat)
    {
        $kdDokter = $this->regPeriksa->select('*')->where('no_rawat', $noRawat)->first();
        $kdDokter = $kdDokter->kd_dokter;
        return $this->dokter->select(
            'dokter.kd_dokter',
            'dokter.nm_dokter',
            'dokter.jk',
            'dokter.tmp_lahir',
            'dokter.tgl_lahir',
            'dokter.gol_drh',
            'dokter.agama',
            'dokter.almt_tgl',
            'dokter.no_telp',
            'dokter.stts_nikah',
            'spesialis.nm_sps',
            'dokter.alumni',
            'dokter.no_ijn_praktek',
            'pegawai.jbtn as jabatan'
        )
            ->join('spesialis', 'dokter.kd_sps', '=', 'spesialis.kd_sps')
            ->leftJoin('pegawai', 'dokter.kd_dokter', 'pegawai.nik')
            ->where('kd_dokter', $kdDokter)
            ->first();
    }

    function getDokterByNoRawatLogin($noRawat,$jenis=1)
    {
        $query=$this->regPeriksa->select('dokter.kd_dokter as id','dokter.nm_dokter as name',DB::raw('concat("dokter") as type_user' ),'spesialis.nm_sps' )
            ->join('dokter', 'dokter.kd_dokter', '=', 'reg_periksa.kd_dokter')
            ->join('spesialis', 'dokter.kd_sps', '=', 'spesialis.kd_sps')
            ->where('no_rawat', $noRawat)
        ;

        if($jenis==1){
            $hasil=!empty($query->first()) ? (object)$query->first()->getAttributes() : [];
        }else{
            $hasil=$query->get();
        }
        

        return $hasil;
    }

    function getDokterRanapByNoRawatLogin($noRawat,$jenis=1)
    {
        $query=$this->regPeriksa->select('dokter.kd_dokter as id','dokter.nm_dokter as name',DB::raw('concat("dokter") as type_user' ),'spesialis.nm_sps' )
            ->join('dpjp_ranap', 'dpjp_ranap.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('dokter', 'dokter.kd_dokter', '=', 'dpjp_ranap.kd_dokter')
            ->join('spesialis', 'dokter.kd_sps', '=', 'spesialis.kd_sps')
            ->where('reg_periksa.no_rawat', $noRawat)
        ;

        if($jenis==1){
            $hasil=!empty($query->first()) ? (object)$query->first()->getAttributes() : [];
        }else{
            $hasil=$query->get();
        }
        

        return $hasil;
    }

    function getDataDokterList($params=[])
    {
        $query= $this->dokter->select(
            'dokter.kd_dokter',
            'dokter.nm_dokter',
            'dokter.jk',
            'dokter.tmp_lahir',
            'dokter.tgl_lahir',
            'dokter.gol_drh',
            'dokter.agama',
            'dokter.almt_tgl',
            'dokter.no_telp',
            'dokter.stts_nikah',
            'spesialis.nm_sps',
            'dokter.alumni',
            'dokter.no_ijn_praktek',
            'pegawai.jbtn as jabatan'
        )->join('spesialis', 'dokter.kd_sps', '=', 'spesialis.kd_sps')
        ->leftJoin('pegawai', 'dokter.kd_dokter', 'pegawai.nik')
        ;

        if(!empty($params)){
            $query->where($params);
        }
        
        return $query->get();
    }

    function getPetugasList($params=[])
    {
        $query= $this->petugas->select('nip', 'nama', 'jk', 'tmp_lahir', 'tgl_lahir', 'gol_darah', 'agama', 'stts_nikah', 'alamat', 'nm_jbtn', 'no_telp')
            ->join('jabatan', 'jabatan.kd_jbtn', '=', 'petugas.kd_jbtn')
            ->where('petugas.status', '=', '1')
            ->orderBy('nip', 'ASC')
        ;

        if(!empty($params)){
            $query->where($params);
        }
        
        return $query->get();
    }

    function cariRegistrasi($no_rawat)
    {
        $angka=0;

        $data_billing=\App\Models\Billing::where('no_rawat', '=', $no_rawat)->count('no_rawat');
        $data_reg_periksa=\App\Models\RegPeriksa::where('no_rawat', '=', $no_rawat)->where('stts','=','Batal')->count('no_rawat');
        $angka=$data_billing+$data_reg_periksa;
        return $angka;
    }

    public function getDokterPj($params=[]){

        $query= $this->dpjpRanap
        ->select('dokter.kd_dokter','dokter.nm_dokter')
            ->join('dokter', 'dpjp_ranap.kd_dokter', '=', 'dokter.kd_dokter')
        ;

        if(!empty($params)){
            $query->where($params);
        }
        
        return $query->get();
    }

    public function getDokterPjReturnNama($params=[]){
        $data=$this->getDokterPj($params);
        $hasil=[];
        foreach($data as $key =>$value){
            $hasil[$value->kd_dokter]=$value->nm_dokter;
        }
        return $hasil;
    }

    public function toRawSql($query){
        $addSlashes = str_replace('?', "'?'", $query->toSql());
        return vsprintf(str_replace('?', '%s', $addSlashes), $query->getBindings());
    }
    public function getSettingsKhanza(){
        $settings = $this->settingKhanza
                            ->select('*')   
                            ->first();
        $settings->wallpaper = base64_encode($settings->wallpaper);
        $settings->logo = base64_encode($settings->logo);
        return $settings;
    }

    public function Penjab()
    {
        return $this->penjab->select('*');
    }
}