<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\RegPeriksa;
use App\Models\BerkasDigitalPerawatan;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\PoliKlinik;
use App\Models\RujukanInternalPoli;
use App\Models\PemeriksaanRalan;
use App\Models\PemeriksaanRanap;
use App\Models\UxuiBerkasDigital;
use App\Models\MasterBerkasDigital;
use App\Models\UxuiBerkasJenis;
use App\Models\UxuiBerkasKlaim;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use PDF;

// use App\Library\BerkasDigital\BerkasDigitalPDF;
// use App\Library\TCPDF\SEP_pdf;
use App\Library\TCPDF\KhanzaPDF;
use Zip;
use Elibyy\TCPDF\Facades\TCPDF;
// use App\Models\Berk

use App\Services\GlobalService;
use App\Services\ResumeService;
class PDFService extends BaseService
{
    protected $regPeriksa;
    protected $berkasDigitalPerawatan;
    protected $pasien;
    public function __construct(
        GlobalService $globalService,
        RegPeriksa $regPeriksa,
        BerkasDigitalPerawatan $berkasDigitalPerawatan,
        Pasien $pasien,
        RujukanInternalPoli $rujukan_internal,
        PemeriksaanRalan $pemeriksaan_ralan,
        PemeriksaanRanap $pemeriksaan_ranap,
        UxuiBerkasDigital $berkas_digital,
        UxuiBerkasJenis $berkas_jenis,
        MasterBerkasDigital $master_bdigital,
        UxuiBerkasKlaim $berkas_klaim,
        ResumeService $resumeService
    )
    {
        parent::__construct();
        $this->globalService = $globalService;
        $this->regPeriksa = $regPeriksa;
        $this->berkasDigitalPerawatan = $berkasDigitalPerawatan;
        $this->pasien = $pasien;
        $this->rujukan_internal = $rujukan_internal;
        $this->pemeriksaan_ralan = $pemeriksaan_ralan;
        $this->pemeriksaan_ranap = $pemeriksaan_ranap;
        $this->berkas_digital = $berkas_digital;
        $this->berkas_jenis = $berkas_jenis;
        $this->master_bdigital = $master_bdigital; 
        $this->berkas_klaim = $berkas_klaim;
        $this->resumeService = $resumeService;
    }

    public function  getBilling($noRw, $noRm, $fr){

    }
    public function  getResume($noRw, $noRm, $fr){

    }
    public function  getResumeLaporanOperasi($noRw, $noRm, $fr){

    }
    public function  getSEP($noRw, $noRm, $fr){
        $reg_periksa = DB::table("reg_periksa")
                            ->select('reg_periksa.*','poliklinik.*', 'dokter.*', 'penjab.*')
                            ->join('dokter', 'dokter.kd_dokter', '=', 'reg_periksa.kd_dokter')
                            ->join('poliklinik', 'poliklinik.kd_poli', '=', 'reg_periksa.kd_poli')
                            ->join('penjab', 'penjab.kd_pj', '=', 'reg_periksa.kd_pj')
                            ->where('stts', '<>', 'Batal')
                            ->where('no_rawat', "=",$noRw)
                            ->first();

        $print_sep = array();
        $sep_value = $this->_getSEPInfo('no_sep', $noRw);
        if (!empty($sep_value)) {
            $print_sep['bridging_sep'] = DB::table('bridging_sep')->select("*")->where('no_sep',"=" ,$sep_value)->first();
            $print_sep['bpjs_prb'] = DB::table('bpjs_prb')->select("*")->where('no_sep',"=",  $sep_value)->first();

            $batas_rujukan = DB::table('bridging_sep')
                                    ->select(DB::raw('DATE_ADD(`tglrujukan` , INTERVAL 85 DAY) AS batas_rujukan'))
                                    ->where('no_sep',"=", $noRw)
                                    ->first();


            $print_sep['batas_rujukan'] = $batas_rujukan['batas_rujukan'];
            switch ($print_sep['bridging_sep']->klsnaik) {
                case '2':
                    $print_sep['kelas_naik'] = 'Kelas VIP';
                    break;
                case '3':
                    $print_sep['kelas_naik'] = 'Kelas 1';
                    break;
                case '4':
                    $print_sep['kelas_naik'] = 'Kelas 2';
                    break;
        
                default:
                    $print_sep['kelas_naik'] = "";
                    break;
                }
            }
    }
    
    public function  getSOAP($noRw, $noRm, $fr){

    }

    public function getHasilPemeriksaanLab($noRw, $noRm, $fr){
        $periksa_lab = DB::table('periksa_lab')
                        ->select(
                            'periksa_lab.no_rawat', 
                            'reg_periksa.no_rkm_medis', 
                            'periksa_lab.nip', 
                            'periksa_lab.kd_jenis_prw',
                            DB::raw("@tgl_periksa_f := periksa_lab.tgl_periksa as tgl_periksa_f"),
                            'periksa_lab.jam as jam_periksa', 
                            'periksa_lab.kd_dokter', 
                            'periksa_lab.dokter_perujuk',
                            'reg_periksa.kd_poli')
                        ->join('reg_periksa','reg_periksa.no_rawat','=','periksa_lab.no_rawat')
                        ->where('periksa_lab.no_rawat','=',$noRw)
                        ->where('periksa_lab.kategori','=','PK')
                        ->where('periksa_lab.status', '=', $fr == 'ri' ? 'Ranap' : 'Ralan')
                        ->where('reg_periksa.no_rkm_medis','=',$noRm)
                        ->groupBy('no_rawat','no_rkm_medis','tgl_periksa','jam_periksa')
                        ->orderBy('no_rawat','asc')
                        ->orderBy('no_rkm_medis','asc')
                        ->orderBy('tgl_periksa','desc')
                        ->orderBy('jam_periksa','desc');
        
        $periksa_pasien_radiologi = $this->globalService->toRawSql($periksa_lab);
        $query = DB::table(DB::raw(str_replace("`", "", "(".DB::raw($periksa_pasien_radiologi). ") as utama")))
                    ->select(
                        "utama.no_rawat",
                        "utama.no_rkm_medis",
                        "pasien.nm_pasien",
                        "pasien.jk",
                        "pasien.umur",
                        "utama.nip",
                        "utama.tgl_periksa_f",
                        "utama.kd_jenis_prw",
                        "utama.kd_dokter",
                        "petugas.nama as nama_petugas",
                        DB::raw("DATE_FORMAT(utama.tgl_periksa_f, '%d-%m-%Y') as tgl_periksa"),
                        "utama.jam_periksa",
                        DB::raw("concat( pasien.alamat, ', ', kelurahan.nm_kel, ', ', kecamatan.nm_kec, ', ', kabupaten.nm_kab ) AS alamat"),
                        "dokter.nm_dokter as dokter_pj",
                        "dokter_pengirim.nm_dokter",
                        "kamar_pasien.nama_kamar",
                        "poliklinik.nm_poli",
                        "permintaan_lab.noorder",
                        "permintaan_lab.tgl_permintaan",
                        "permintaan_lab.jam_permintaan",
                        "sidikjari_pj.sidikjari as sidikjari_pj",
                        "sidikjari_pl.sidikjari as sidikjari_pl",
                        "pmrksaan_obt.detail_pemeriksaan",
                        "saran_kesan_lab.saran",
                        "saran_kesan_lab.kesan"
                    )
                    ->leftjoin('petugas','utama.nip','=','petugas.nip')
                    ->leftJoin('pasien','utama.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->leftJoin('dokter','dokter.kd_dokter','=','utama.kd_dokter')
                    ->leftJoin('kelurahan','pasien.kd_kel','=','kelurahan.kd_kel')
                    ->leftJoin('kecamatan','pasien.kd_kec','=','kecamatan.kd_kec')
                    ->leftJoin('kabupaten','pasien.kd_kab','=','kabupaten.kd_kab')
                    ->leftJoin('poliklinik','utama.kd_poli','=','poliklinik.kd_poli')
                    ->leftJoinSub(
                        DB::table('dokter')
                        ->select('nm_dokter', 'kd_dokter'),
                        "dokter_pengirim",
                        function($join) {
                            $join->on('dokter_pengirim.kd_dokter','=','utama.dokter_perujuk');
                        }
                    )
                    ->leftJoinSub(
                        DB::table('kamar')
                            ->select('kamar_inap.no_rawat', DB::raw("CONCAT(kamar_inap.kd_kamar, ', ', bangsal.nm_bangsal) as nama_kamar"))
                            ->join('bangsal','bangsal.kd_bangsal','=','kamar.kd_bangsal')
                            ->join('kamar_inap','kamar_inap.no_rawat','=','kamar_inap.no_rawat')
                            ->where('kamar_inap.no_rawat','=',$noRw)
                            ->orderBy('kamar_inap.tgl_masuk','desc')
                            ->limit(1),
                        'kamar_pasien' ,
                        function($join) {
                            $join->on('kamar_pasien.no_rawat','=','utama.no_rawat');
                        })
                    ->leftJoinSub(
                        DB::table('permintaan_lab')
                        ->select('noorder', 'tgl_hasil', 'jam_hasil', DB::raw("DATE_FORMAT(tgl_permintaan, '%d-%m-%Y') as tgl_permintaan"), 'jam_permintaan')
                        ->where('no_rawat','=',$noRw),
                        "permintaan_lab",
                        function($join) {
                            $join->on('permintaan_lab.tgl_hasil','=','utama.tgl_periksa_f');
                        })
                    ->leftJoinSub(
                        DB::table("sidikjari")
                        ->select("pegawai.nik", DB::raw("SHA1(sidikjari) as sidikjari"))
                        ->join("pegawai", "pegawai.id", "=", "sidikjari.id"),
                        "sidikjari_pj",
                        function($join){
                            $join->on("sidikjari_pj.nik", "=", "utama.kd_dokter");
                        }
                    )
                    ->leftJoinSub(
                        DB::table("sidikjari")
                        ->select("pegawai.nik", DB::raw("SHA1(sidikjari) as sidikjari"))
                        ->join("pegawai", "pegawai.id", "=", "sidikjari.id"),
                        "sidikjari_pl",
                        function($join){
                            $join->on("sidikjari_pj.nik", "=", "utama.nip");
                        }
                    )
                    ->leftJoinSub(
                        DB::table(
                            DB::raw(
                                str_replace("`", "", "(".
                                $this->globalService->toRawSql(
                                    DB::table('detail_periksa_lab')
                                    ->select('kd_jenis_prw', 'tgl_periksa', 'jam', 'nilai', 'nilai_rujukan', 'keterangan', 'id_template')
                                    ->where('no_rawat','=',$noRw)
                                ). ") as detail_periksa_lab")))
                            ->select(
                                'detail_periksa_lab.kd_jenis_prw',
                                'detail_periksa_lab.tgl_periksa',
                                'detail_periksa_lab.jam',
                                DB::raw("
                                    GROUP_CONCAT(
                                        concat(
                                            template_laboratorium.Pemeriksaan, ',', 
                                            detail_periksa_lab.nilai, ',', 
                                            template_laboratorium.satuan, ',', 
                                            detail_periksa_lab.nilai_rujukan, ',', 
                                            detail_periksa_lab.keterangan) 
                                            ORDER BY detail_periksa_lab.kd_jenis_prw asc, template_laboratorium.urut asc
                                            SEPARATOR '|') as detail_pemeriksaan"))
                        ->join("template_laboratorium", "detail_periksa_lab.id_template", "=","template_laboratorium.id_template")
                        ->groupBy("detail_periksa_lab.jam", "detail_periksa_lab.tgl_periksa")
                        ,
                        "pmrksaan_obt",
                        function($join){
                            $join->on("pmrksaan_obt.jam", "=", "utama.jam_periksa")
                            ->on("pmrksaan_obt.tgl_periksa", "=", "utama.tgl_periksa_f");
                        }

                    )
                    ->leftJoinSub(
                        DB::table("saran_kesan_lab")
                        ->select("saran", "kesan", "no_rawat", "jam", "tgl_periksa")
                        ->where("no_rawat" , "=", $noRw),
                        "saran_kesan_lab",
                        function($join){
                            $join->on("saran_kesan_lab.no_rawat", "=", "utama.no_rawat")
                            ->on("saran_kesan_lab.jam", "=", "utama.jam_periksa")
                            ->on("saran_kesan_lab.tgl_periksa", "=", "utama.tgl_periksa_f");
                        }
                    )

                    ->groupBy('utama.no_rawat','utama.tgl_periksa_f','utama.jam_periksa')->get()->toArray();
                $all_data = [
                    "hasil_pemeriksaan_lab" => !empty($query) ? $query : [
                        "0"=> []
                    ]
                ];  
                return $all_data;   
    }

    
    public function getHasilPemeriksaanRadiologi($noRw, $noRm, $fr){
        $periksa_pasien_radiologi = DB::table('periksa_radiologi')
                                ->select(
                                    'periksa_radiologi.no_rawat', 
                                    'periksa_radiologi.dokter_perujuk',
                                    'no_rkm_medis', 
                                    'tgl_periksa as tgl_periksa_f', 
                                    'jam',
                                    'periksa_radiologi.kd_jenis_prw',
                                    DB::raw('@kd_dokter := periksa_radiologi.kd_dokter as kd_dokter'),
                                    DB::raw('@kd_pegawai := periksa_radiologi.nip as petugas_nip')
                                )
                                ->join('reg_periksa','reg_periksa.no_rawat','=','periksa_radiologi.no_rawat')
                                ->where('periksa_radiologi.no_rawat','=',$noRw)
                                ->where('reg_periksa.no_rkm_medis','=',$noRm)
                                ->where('periksa_radiologi.status', '=', $fr == 'ri' ? 'Ranap' : 'Ralan')
                                ->groupBy('no_rawat','no_rkm_medis','tgl_periksa','jam')
                                ->orderBy('no_rawat','asc')
                                ->orderBy('no_rkm_medis','asc')
                                ->orderBy('tgl_periksa','desc')
                                ->orderBy('jam','desc');
        
        $periksa_pasien_radiologi = $this->globalService->toRawSql($periksa_pasien_radiologi);  
        $query = DB::table(DB::raw(str_replace("`", "", "(".DB::raw($periksa_pasien_radiologi). ") as utama")))
                    ->select(
                        'utama.no_rawat',
                        'utama.no_rkm_medis',
                        'pasien.nm_pasien',
                        'pasien.jk',
                        'pasien.umur',
                        'petugas.nama as nama_petugas',
                        'utama.tgl_periksa_f',
                        DB::raw("DATE_FORMAT(utama.tgl_periksa_f, '%d-%m-%Y') as tgl_periksa"),
                        "utama.jam",
                        "utama.dokter_perujuk",
                        'utama.kd_dokter',
                        "utama.petugas_nip",
                        DB::raw("CONCAT(pasien.alamat, ', ', kelurahan.nm_kel,', ', kecamatan.nm_kec, ', ', kabupaten.nm_kab) as alamat"),
                        'dokter.nm_dokter',
                        'petugas.nama as nama_petugas',
                        'dokter_pengirim.nm_dokter as dokter_pengirim',
                        'hasil_radiologi.hasil',
                        'kamar_pasien.nama_kamar',
                        'sidikjari_pj.sidikjari as finger_pj',
                        'sidikjari_pl.sidikjari as finger_pl',
                        'jns_perawatan_radiologi.nm_perawatan',
                        'poli.nm_poli'
                        )
                    ->leftJoin('pasien','pasien.no_rkm_medis','=','utama.no_rkm_medis')
                    ->leftJoin('petugas','utama.petugas_nip','=','petugas.nip')
                    ->join('dokter','utama.kd_dokter','=','dokter.kd_dokter')
                    ->leftJoin('kelurahan','pasien.kd_kel','=','kelurahan.kd_kel')
                    ->leftJoin('kecamatan','pasien.kd_kec','=','kecamatan.kd_kec')
                    ->leftJoin('kabupaten','pasien.kd_kab','=','kabupaten.kd_kab')
                    ->leftJoinSub(
                        DB::table('dokter')
                        ->select('kd_dokter', 'nm_dokter'),
                        "dokter_pengirim", 
                        function ($join){
                            $join->on('utama.dokter_perujuk','=','dokter_pengirim.kd_dokter');
                        })
                    ->leftJoin("hasil_radiologi", function($join){
                        $join->on('hasil_radiologi.no_rawat','=','utama.no_rawat')
                        ->on('hasil_radiologi.tgl_periksa','=','utama.tgl_periksa_f')
                        ->on('hasil_radiologi.jam','=','utama.jam');
                    })
                    ->leftJoinSub(
                        DB::table('kamar')
                            ->select('kamar_inap.no_rawat', DB::raw("CONCAT(kamar_inap.kd_kamar, ', ', bangsal.nm_bangsal) as nama_kamar"))
                            ->join('bangsal','bangsal.kd_bangsal','=','kamar.kd_bangsal')
                            ->join('kamar_inap','kamar_inap.no_rawat','=','kamar_inap.no_rawat')
                            ->where('kamar_inap.no_rawat','=',$noRw)
                            ->orderBy('kamar_inap.tgl_masuk','desc')
                            ->limit(1),
                        'kamar_pasien' ,
                        function($join) {
                            $join->on('kamar_pasien.no_rawat','=','hasil_radiologi.no_rawat');
                        })
                    ->leftJoinSub(
                        DB::table("sidikjari")
                        ->select("pegawai.nik", DB::raw("SHA1(sidikjari) as sidikjari"))
                        ->join("pegawai", "pegawai.id", "=", "sidikjari.id"),
                        "sidikjari_pj",
                        function($join){
                            $join->on("sidikjari_pj.nik", "=", DB::raw("@kd_dokter"));
                        }
                    )
                    ->leftJoinSub(
                        DB::table("sidikjari")
                        ->select("pegawai.nik", DB::raw("SHA1(sidikjari) as sidikjari"))
                        ->join("pegawai", "pegawai.id", "=", "sidikjari.id"),
                        "sidikjari_pl",
                        function($join){
                            $join->on("sidikjari_pj.nik", "=", DB::raw("@kd_pegawai"));
                        }
                    )
                    ->leftJoinSub(
                        DB::table('poliklinik')
                        ->select('nm_poli', 'reg_periksa.no_rawat')
                        ->join('reg_periksa', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
                        ->where('reg_periksa.no_rawat', "=", $noRw),
                        "poli", 
                        function($join){
                            $join->on("poli.no_rawat", "=", "utama.no_rawat");
                        }
                    )
                    ->leftJoin("jns_perawatan_radiologi", "jns_perawatan_radiologi.kd_jenis_prw", "=", "utama.kd_jenis_prw")
                    ->where('utama.no_rawat', '=', $noRw)
                    ->groupBy('utama.no_rawat','utama.tgl_periksa_f','utama.jam')
                    ->get()->toArray();

    
        $all_data = [
            'hasil_pasien_periksa_radiologi' => !empty($query) ? $query : [
                "0" => []
            ]
        ];   
       
        return $all_data;     
    }

    public function getSKDP($noRm){
        $query = DB::table("bridging_sep")
                    ->select("bridging_sep.no_rawat",
                    "bridging_sep.no_sep",
                    "bridging_sep.no_kartu",
                    "bridging_sep.nomr",
                    "bridging_sep.nama_pasien",
                    "bridging_sep.tanggal_lahir",
                    "bridging_sep.jkel",
                    "bridging_sep.diagawal",
                    "bridging_sep.nmdiagnosaawal",
                    "bridging_surat_kontrol_bpjs.tgl_surat",
                    "bridging_surat_kontrol_bpjs.no_surat",
                    "bridging_surat_kontrol_bpjs.tgl_rencana",
                    "bridging_surat_kontrol_bpjs.kd_dokter_bpjs",
                    "bridging_surat_kontrol_bpjs.nm_dokter_bpjs",
                    "bridging_surat_kontrol_bpjs.kd_poli_bpjs",
                    "bridging_surat_kontrol_bpjs.nm_poli_bpjs")
                    ->join("bridging_surat_kontrol_bpjs", "bridging_surat_kontrol_bpjs.no_sep" ,"=" , "bridging_sep.no_sep")
                    ->where("bridging_sep.nomr", "=", $noRm)
                    ->orderBy("bridging_surat_kontrol_bpjs.tgl_rencana", "DESC")
                    ->get()->toArray(); 
        
        return [
            'skdp' => !empty($query) ? $query : [[]]
        ];   
    }

    public function getSPRI($noRw){
        $query = DB::table("reg_periksa")
                    ->select(
                    "bridging_surat_pri_bpjs.no_rawat",
                    "bridging_surat_pri_bpjs.no_kartu",
                    "reg_periksa.no_rkm_medis",
                    "pasien.nm_pasien",
                    "pasien.tgl_lahir",
                    "pasien.jk",
                    "bridging_surat_pri_bpjs.diagnosa",
                    "bridging_surat_pri_bpjs.tgl_surat",
                    "bridging_surat_pri_bpjs.no_surat",
                    "bridging_surat_pri_bpjs.tgl_rencana",
                    "bridging_surat_pri_bpjs.kd_dokter_bpjs",
                    "bridging_surat_pri_bpjs.nm_dokter_bpjs",
                    "bridging_surat_pri_bpjs.kd_poli_bpjs",
                    "bridging_surat_pri_bpjs.nm_poli_bpjs" )
                    ->join("bridging_surat_pri_bpjs", "bridging_surat_pri_bpjs.no_rawat" ,"=" , "reg_periksa.no_rawat")
                    ->join("pasien", "reg_periksa.no_rkm_medis", "=", "pasien.no_rkm_medis")
                    ->where("reg_periksa.no_rawat", "=", $noRw)
                    ->get()->toArray(); 

        return [
            'spri' => !empty($query) ? $query : [[]]
        ];  
    }


}