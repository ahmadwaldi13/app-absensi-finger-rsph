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

use App\Classes\ModulPDF;
use Zip;
use Elibyy\TCPDF\Facades\TCPDF;

use App\Services\GlobalService;
use App\Services\ResumeService;


use Resources\views\LayoutPdf\SEP\SEP;
use Resources\views\LayoutPdf\Barang\Barang;
use Resources\views\LayoutPdf\Billing\Billing;
use Resources\views\LayoutPdf\HasilLaborPK\HasilLaborPK;
use Resources\views\LayoutPdf\HasilRadiologi\HasilRadiologi;
use Resources\views\LayoutPdf\Resume\Resume;
use Resources\views\LayoutPdf\ResumeLaporanOperasi\ResumeLaporanOperasi;
use Resources\views\LayoutPdf\SOAP\SOAP;
use Resources\views\LayoutPdf\SPRI\SPRI;
use Resources\views\LayoutPdf\SKDP\SKDP;
class BerkasDigitalService extends BaseService
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
    function getBerkasDigital(array $filter)
    {
        $query = $this->regPeriksa->select(
            'reg_periksa.*','pasien.*','dokter.nm_dokter','poliklinik.nm_poli','penjab.png_jawab', 'bridging_sep.no_sep'
            )
            ->crossJoin('pasien')
            ->crossJoin('dokter')
            ->crossJoin('poliklinik')
            ->crossJoin('penjab')
            ->leftJoin('bridging_sep', 'bridging_sep.no_rawat', '=', 'reg_periksa.no_rawat')
            ->whereRaw('reg_periksa.no_rkm_medis = pasien.no_rkm_medis')
            ->whereRaw('reg_periksa.kd_dokter = dokter.kd_dokter')
            ->whereRaw('reg_periksa.kd_poli = poliklinik.kd_poli')
            ->whereRaw('reg_periksa.kd_pj = penjab.kd_pj')
            ->where('reg_periksa.status_lanjut','=','Ralan')
            ->orderBy('reg_periksa.no_rawat', 'ASC')
            ->when([$filter['start'], $filter['end']], function ($query, $filter) {
                if ($filter[0] != null) {
                    $query->whereBetween('reg_periksa.tgl_registrasi',  [$filter[0], $filter[1]]);
                }
            })
            ->when($filter['poli'], function ($query, $filter) {
                $query->where('poliklinik.kd_poli', '=', $filter);
            })
            ->when($filter['penjab'], function ($query, $filter) {
                $query->where('penjab.png_jawab', '=', $filter);
            })
            ->when($filter['search'], function ($query, $filter) {
                $query->where(function ($qb2) use ($filter) {
                    $qb2->where('dokter.nm_dokter', 'LIKE', '%' . $filter . '%')
                        ->orWhere('dokter.kd_dokter', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $filter . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.stts', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rawat', 'LIKE', '%' . $filter . '%');
                });
            });
        return $query;
    }

    function getBerkasDigitalRanap(array $filter)
    {
        $query = $this->regPeriksa->select(
            'reg_periksa.*','pasien.*','dokter.nm_dokter','poliklinik.nm_poli','penjab.png_jawab', 'bridging_sep.no_sep'
            )
            ->crossJoin('pasien')
            ->crossJoin('dokter')
            ->crossJoin('poliklinik')
            ->crossJoin('penjab')
            ->leftJoin('bridging_sep', 'bridging_sep.no_rawat', '=', 'reg_periksa.no_rawat')
            ->whereRaw('reg_periksa.no_rkm_medis = pasien.no_rkm_medis')
            ->whereRaw('reg_periksa.kd_dokter = dokter.kd_dokter')
            ->whereRaw('reg_periksa.kd_poli = poliklinik.kd_poli')
            ->whereRaw('reg_periksa.kd_pj = penjab.kd_pj')
            ->where('reg_periksa.status_lanjut','=','Ranap')
            ->orderBy('reg_periksa.no_rawat', 'ASC')
            ->when([$filter['start'], $filter['end']], function ($query, $filter) {
                if ($filter[0] != null) {
                    $query->whereBetween('reg_periksa.tgl_registrasi',  [$filter[0], $filter[1]]);
                }
            })
            ->when($filter['bansal'], function ($query, $filter) {
                $query->where('bangsal.kd_bangsal', '=', $filter);
            })
            ->when($filter['penjab'], function ($query, $filter) {
                $query->where('penjab.png_jawab', '=', $filter);
            })
            ->when($filter['search'], function ($query, $filter) {
                $query->where(function ($qb2) use ($filter) {
                    $qb2->where('dokter.nm_dokter', 'LIKE', '%' . $filter . '%')
                        ->orWhere('dokter.kd_dokter', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $filter . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.stts', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rawat', 'LIKE', '%' . $filter . '%');
                });
            });
        return $query;
    }

    public function getPdf(string $noRm)
    {
        $return=[];
        $return_tmp=[];
        $additionalQuery = '=';
        $query = $this->pasien->select('pasien')
        ->join('kecamatan', 'kecamatan.kd_kec = pasien.kd_kec')
        ->join('kabupaten', 'kabupaten.kd_kab = pasien.kd_kab')
        ->where('no_rkm_medis'. $additionalQuery,[$noRm]);

        $query=$query;
        $return_tmp[]=$query;

        $query = $this->regPeriksa->select('reg_periksa')
        ->join('dokter', 'dokter.kd_dokter = reg_periksa.kd_dokter')
        ->join('poliklinik', 'poliklinik.kd_poli = reg_periksa.kd_poli')
        ->join('penjab', 'penjab.kd_pj = reg_periksa.kd_pj')
        ->where('stts', '<>', 'Batal')
        ->where('no_rawat'. $additionalQuery,[$noRm]);

        $query=$query;
        $return_tmp[]=$query;

        return $return;
    }

    function getAllFileRmRw($noRw, $noRm, $url){
        $rm_dir = is_dir(public_path($url.$noRm));
        $rw_dir = is_dir(public_path($url.$noRm."/".str_replace("/", "-", $noRw)));
        $rm_file = [];
        $rm_rw_file = [];

        if($rm_dir) {
            $rm_file = array_filter(scandir(public_path($url.$noRm)), function($item) use ($noRm, $url){
                return !is_dir(public_path($url."/".$noRm."/".$item));
            });
            foreach($rm_file as $key => $value) $rm_file[$key] = $noRm."/".$value;
        }
        else return [];

        if($rw_dir){
            $rm_rw_file = array_diff(scandir(public_path($url.$noRm."/".str_replace("/", "-", $noRw))), array('.', '..'));
            foreach($rm_rw_file as $key => $value) $rm_rw_file[$key] = $noRm."/".str_replace("/", "-", $noRw)."/".$value;
        }
        $all_files = array_merge($rm_file, $rm_rw_file);
        return $all_files;
    }

    public function get_allowed_download_files($noRw, $noRm, $optional_download){
        $bj = $this->berkas_jenis->table;
        $all_patient_file_query = $this->berkas_digital->select("url", "kode", "id")
                                ->where("no_rm", "=", $noRm)
                                ->whereIn("no_rw", [$noRw, "*"])
                                ->whereIn("id", $optional_download);

        $all_patient_file = $this->globalService->toRawSql($all_patient_file_query);

        return DB::table(DB::raw(str_replace("`", "", "(".DB::raw($all_patient_file). ") as patient_file")))
                        ->select("patient_file.url", "patient_file.id")
                        ->join($bj, $bj.".kode" , "=", "patient_file.kode")
                        ->get();
                            // ->join($this->berkas_jenis->table, $this->berkas_jenis->table.".kode" , "=", "");
    }



    public function syncFileDB($noRw, $noRm, $url){
        $all_files = $this->getAllFileRmRw($noRw, $noRm, $url);


        $get_files_from_db =  $this->berkas_digital->select("url")
                                    ->where("no_rm", "=",$noRm)
                                    ->whereIn("no_rw", [$noRw, "*"])
                                    ->get()->toArray();
        $get_file_not_db = [];
        foreach($get_files_from_db as $key => $value){
            $get_file_not_db[$key] = $value["url"];
        }
        if (count($all_files) > count($get_files_from_db)) {
            $berkas_jenis_kode = $this->berkas_jenis->select("*")->get()->toArray();
            $diff = array_diff($all_files, $get_file_not_db);
            $datas = [];

            foreach($diff as $key => $diff_val){
                $split_url = explode("/", $diff_val);

                $jenis_kode='';
                foreach($berkas_jenis_kode as $code_val){

                    if(preg_match("/".$code_val['prefix']."/i", $diff_val)){
                        $jenis_kode = $code_val['kode'];
                        break;
                    }
                }
                $data = [
                    "name" => end($split_url),
                    "id_jenis_bdig" => count($split_url) > 2 ? "2" : "1",
                    "no_rm" => $noRm,
                    "no_rw"=> count($split_url) > 2 ? str_replace("-", "/", $noRw) : "*",
                    "url" => $diff_val,
                    "kode" => $jenis_kode
                ];
                array_push($datas, $data);
            }


            $sync_dir_to_db = $this->berkas_digital->insert($datas);

        }
        else if(count($all_files) < count($get_file_not_db)) {
            $diff = array_diff($get_file_not_db, $all_files);
            $sync_dir_to_db = $this->berkas_digital
                                        ->where("no_rm", "=",$noRm)
                                        ->whereIn("no_rw", [$noRw, "*"])
                                        ->whereIn("url", $diff)
                                        ->delete();
        }
    }
    public function getPDFData($noRw, $noRm, $fr){
        $data = [
            "berkas_list" => $this->getBerkasList($noRw, $noRm, $fr),
            "dataShown" => $this->getDataShown(),
            "settings" => $this->globalService->getSettingsKhanza(),
            "sep_data" => $this->getSEP($noRw, $noRm, $fr),
            "soap_data" => $this->getSOAP($noRw, $noRm, $fr),
            "spri_data" => $this->getSPRI($noRw),
            "billing_data" => $this->getBilling($noRw),
            "resume_data" => $this->getResume($noRw, $fr),
            "resume_laporan_operasi_data" => $this->getResumeLaporanOperasi($noRw, $fr),
            "hasil_pemeriksaan_lab_pk_data" => $this->getHasilPemeriksaanLab($noRw, $noRm, $fr),
            "hasil_pemeriksaan_radiologi_data" => $this->getHasilPemeriksaanRadiologi($noRw, $noRm, $fr),
            "skdp_data" => $this->getSKDP($noRm)
        ];

        return $data;
    }

    public function getBerkasList($noRw, $noRm, $fr){
        $berkas_list = $this->berkas_digital->select($this->master_bdigital->table.".nama AS jenis_file",$this->berkas_digital->table.".*" )
                                        ->join($this->master_bdigital->table, $this->berkas_digital->table.".kode", "=", $this->master_bdigital->table.".kode")
                                        ->where("no_rm", "=",$noRm)
                                        ->whereIn("no_rw", [$noRw, "*"])
                                        ->orderBy($this->berkas_digital->table.".id_jenis_bdig")
                                        // ->toSql();
                                        ->get()->toArray();
        foreach($berkas_list as $key => $value){
            $file_dir =public_path("upload/berkas_digital/".$berkas_list[$key]["url"]);
            if(!is_file($file_dir)) continue;
            $file_size = filesize(public_path("upload/berkas_digital/".$berkas_list[$key]["url"]));
            if($file_size > 1000000) {
                $file_size = number_format((float)($file_size / 1000000), 2, '.', '');
                $suffix = " MB";
            }
            else {
                $file_size = number_format((float)($file_size / 1000), 2, '.', '');
                $suffix = " KB";
            }
            $berkas_list[$key]["file_size"] = $file_size.$suffix;

        }
        return $berkas_list;

    }

    public function getDataShown(){
        $getDataShown = $this->berkas_klaim
                            ->select("*")
                            ->where("status","=", "1")
                            ->get();
        $dataShown = [];
        foreach($getDataShown as $key => $value){
            $dataShown[$value->id] = $value->nama;
        }
        return $dataShown;
    }
    private function _getSEPInfo($field, $no_rawat)
    {
        $row = DB::table('bridging_sep')->select("no_sep")->where('no_rawat',"=", $no_rawat)->first();

        return isset($row) ? $row->$field : "";
    }

    public function get_berkas_digital_list(){
        $query = $this->berkas_jenis
        ->select('type','nama', 'prefix', $this->berkas_jenis->table.".kode")
        ->join($this->master_bdigital->table, $this->berkas_jenis->table.".kode", "=", $this->master_bdigital->table.".kode")
        ->orderBy("nama", "ASC");

        return $query->get()->toArray();
    }


    public function insert_berkas_data($data){
        return $this->berkas_digital->insert($data);
    }

    public function delete_berkas_data($id){
        return $this->berkas_digital
            ->where("id","=" ,$id)
            ->delete();
    }

    public function file_rw_numbering($noRm, $noRw, $url, $name){
        $file = glob(public_path($url.$noRm."/".$noRw."/".$name."*"));


        return count($file) + 1;
    }

    function genQrCode($str){
        return QrCode::size(300)->generate($str)->toHtml();
    }

    public function createZipFile($upload_base_url, $fileName, $all_files, $klaim_pdf=[]){
        $zip = Zip::create($fileName);
        $all_files_dir = [];

        foreach ($all_files as $key => $value) {
            $file = $upload_base_url.$value;
            $zip->add($file);
        }
        if(count($klaim_pdf) > 0){
            $zip->addRaw($klaim_pdf[1], $klaim_pdf[0]);
        };
        return $zip;
    }



    public function getSEP($noRw, $noRm, $fr){
        $print_sep = array();
        $sep_value = $this->_getSEPInfo('no_sep', $noRw);
        $print_sep = DB::table('bridging_sep')
                        ->select(
                            'bridging_sep.no_sep',
                            'bridging_sep.tglsep',
                            'bridging_sep.no_kartu',
                            'bridging_sep.nama_pasien',
                            'bridging_sep.tanggal_lahir',
                            'bridging_sep.jkel',
                            'bridging_sep.notelep',
                            'bridging_sep.nmpolitujuan',
                            'bridging_sep.nmdpdjp',
                            'bridging_sep.nmppkrujukan',
                            'bridging_sep.nmdiagnosaawal',
                            'bridging_sep.catatan',
                            'bridging_sep.jnspelayanan',
                            'reg_periksa.no_reg',
                            'bridging_sep.peserta',
                            'bridging_sep.tujuankunjungan',
                            'bridging_sep.klsrawat',
                            'bridging_sep.pembiayaan',
                            'bridging_sep.tglrujukan',
                            'reg_periksa.tgl_registrasi',
                            'reg_periksa.jam_reg',
                            'poliklinik.nm_poli',
                            'kamar_pasien.nama_kamar',
                            'prb',
                            DB::raw('DATE_ADD( bridging_sep.tglrujukan, INTERVAL 85 DAY ) AS batas_rujukan'),
                            DB::raw("CASE
                                WHEN bridging_sep.klsnaik = '2' THEN
                                'Kelas VIP'
                                WHEN bridging_sep.klsnaik = '3' THEN
                                'Kelas 1'
                                WHEN bridging_sep.klsnaik = '4' THEN
                                'Kelas 2'
                                ELSE ''
                            END AS kelas_naik")
                        )
                        ->join('reg_periksa', 'reg_periksa.no_rawat' , '=', 'bridging_sep.no_rawat')
                        ->join('poliklinik', 'poliklinik.kd_poli', '=', 'reg_periksa.kd_poli')
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
                                $join->on('kamar_pasien.no_rawat','=','bridging_sep.no_rawat');
                            })
                        ->leftJoin('bpjs_prb','bpjs_prb.no_sep','=','bridging_sep.no_sep')
                        ->where('bridging_sep.no_rawat','=',$noRw)
                        ->first();
        return !empty((array)$print_sep) ? (object)$print_sep : (object)[];
    }
    public function getSOAP($noRw, $noRm, $fr){
        $rows_dpjp_ranap = DB::table('dpjp_ranap')->select("*")
                                        ->join('dokter', 'dokter.kd_dokter', "=", "dpjp_ranap.kd_dokter")
                                        ->where('no_rawat', "=", $noRw)
                                        ->get()->toArray();
        $dpjp_i = 1;
        $dpjp_ranap = [];
        foreach ($rows_dpjp_ranap as $row) {
            $row = (array)$row;
            $row['nomor'] = $dpjp_i++;
            $dpjp_ranap[] = $row;
        }
        $dataPasien = $this->globalService->getDataPasien($noRm);
        $reg_periksa = DB::table("reg_periksa")
                            ->select('reg_periksa.*','poliklinik.*', 'dokter.*', 'penjab.*')
                            ->join('dokter', 'dokter.kd_dokter', '=', 'reg_periksa.kd_dokter')
                            ->join('poliklinik', 'poliklinik.kd_poli', '=', 'reg_periksa.kd_poli')
                            ->join('penjab', 'penjab.kd_pj', '=', 'reg_periksa.kd_pj')
                            ->where('stts', '<>', 'Batal')
                            ->where('no_rawat', "=",$noRw)
                            ->first();
        $rujukan_internal = DB::table('rujukan_internal_poli')
                                ->select('rujukan_internal_poli.*','poliklinik.nm_poli')
                                ->join('poliklinik', 'poliklinik.kd_poli', '=', 'rujukan_internal_poli.kd_poli')
                                ->join('dokter', 'dokter.kd_dokter', '=', 'rujukan_internal_poli.kd_dokter')
                                ->where('no_rawat', "=",$noRw)
                                ->first();
        $pemeriksaan_ralan = DB::table('pemeriksaan_ralan')
                                ->select("*")
                                ->where('no_rawat', "=",$noRw)
                                ->get();

        $diagnosa_pasien = DB::table('diagnosa_pasien')
                                ->select("*")
                                ->join('penyakit', 'penyakit.kd_penyakit','=','diagnosa_pasien.kd_penyakit')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $prosedur_pasien = DB::table('prosedur_pasien')
                                ->select("*")
                                ->join('icd9', 'icd9.kode','=','prosedur_pasien.kode')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $pemeriksaan_ranap = DB::table('pemeriksaan_ranap')
                                ->select('*')
                                ->where('no_rawat', "=",$noRw)
                                ->orderBy('tgl_perawatan', "ASC")
                                ->orderBy('jam_rawat', "ASC")
                                ->get();
        $rawat_jl_dr = DB::table('rawat_jl_dr')
                                ->select('*')
                                ->join('jns_perawatan', 'rawat_jl_dr.kd_jenis_prw','=', 'jns_perawatan.kd_jenis_prw')
                                ->join('dokter', 'rawat_jl_dr.kd_dokter','=', 'dokter.kd_dokter')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $rawat_jl_pr = DB::table('rawat_jl_pr')
                                ->select('*')
                                ->join('jns_perawatan', 'rawat_jl_pr.kd_jenis_prw','=','jns_perawatan.kd_jenis_prw')
                                ->join('petugas', 'rawat_jl_pr.nip','=','petugas.nip')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $rawat_jl_drpr = DB::table('rawat_jl_drpr')
                                ->select('*')
                                ->join('jns_perawatan', 'rawat_jl_drpr.kd_jenis_prw','=','jns_perawatan.kd_jenis_prw')
                                ->join('dokter', 'rawat_jl_drpr.kd_dokter','=','dokter.kd_dokter')
                                ->join('petugas', 'rawat_jl_drpr.nip','=','petugas.nip')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $rawat_inap_dr = DB::table('rawat_inap_dr')
                                ->select('*')
                                ->join('jns_perawatan_inap', 'rawat_inap_dr.kd_jenis_prw','=','jns_perawatan_inap.kd_jenis_prw')
                                ->join('dokter', 'rawat_inap_dr.kd_dokter','=','dokter.kd_dokter')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $rawat_inap_pr = DB::table('rawat_inap_pr')
                                ->select('*')
                                ->join('jns_perawatan_inap', 'rawat_inap_pr.kd_jenis_prw','=','jns_perawatan_inap.kd_jenis_prw')
                                ->join('petugas', 'rawat_inap_pr.nip','=','petugas.nip')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $rawat_inap_drpr = DB::table('rawat_inap_drpr')
                                ->select('*')
                                ->join('jns_perawatan_inap', 'rawat_inap_drpr.kd_jenis_prw','=','jns_perawatan_inap.kd_jenis_prw')
                                ->join('dokter', 'rawat_inap_drpr.kd_dokter','=','dokter.kd_dokter')
                                ->join('petugas', 'rawat_inap_drpr.nip','=','petugas.nip')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $kamar_inap = DB::table('kamar_inap')
                                ->select('*')
                                ->join('kamar', 'kamar_inap.kd_kamar','=','kamar.kd_kamar')
                                ->join('bangsal', 'kamar.kd_bangsal','=','bangsal.kd_bangsal')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $operasi = DB::table('operasi')
                                ->select('*')
                                ->join('paket_operasi', 'operasi.kode_paket','=','paket_operasi.kode_paket')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $tindakan_radiologi = DB::table('periksa_radiologi')
                                ->select('*')
                                ->join('jns_perawatan_radiologi', 'periksa_radiologi.kd_jenis_prw','=','jns_perawatan_radiologi.kd_jenis_prw')
                                ->join('dokter', 'periksa_radiologi.kd_dokter','=','dokter.kd_dokter')
                                ->join('petugas', 'periksa_radiologi.nip','=','petugas.nip')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $hasil_radiologi = DB::table('hasil_radiologi')
                                ->select('*')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $pemeriksaan_laboratorium = [];
        $rows_pemeriksaan_laboratorium = DB::table('periksa_lab')
                                ->select('*')
                                ->join('jns_perawatan_lab', 'jns_perawatan_lab.kd_jenis_prw','=','periksa_lab.kd_jenis_prw')
                                ->where('no_rawat', "=",$noRw)
                                ->get();

        foreach ($rows_pemeriksaan_laboratorium as $value) {
            $value = get_object_vars($value);
            $value['detail_periksa_lab'] = DB::table('detail_periksa_lab')
                                                ->select('*')
                                                ->join('template_laboratorium', 'template_laboratorium.id_template','=','detail_periksa_lab.id_template')
                                                ->where('detail_periksa_lab.no_rawat', "=", $value['no_rawat'])
                                                ->where('detail_periksa_lab.kd_jenis_prw', "=", $value['kd_jenis_prw'])
                                                ->get();
            $pemeriksaan_laboratorium[] = $value;
        }

        $pemberian_obat = DB::table('detail_pemberian_obat')
                                ->select('*')
                                ->join('databarang', 'detail_pemberian_obat.kode_brng','=','databarang.kode_brng')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $obat_operasi = DB::table('beri_obat_operasi')
                                ->select('*')
                                ->join('obatbhp_ok', 'beri_obat_operasi.kd_obat','=','obatbhp_ok.kd_obat')
                                ->where('no_rawat', "=",$noRw)
                                ->get();
        $resep_pulang = DB::table('resep_pulang')
                                ->select('*')
                                ->join('databarang', 'resep_pulang.kode_brng','=','databarang.kode_brng')
                                ->where('no_rawat', "=",$noRw)
                                ->get();

        return [
            "dataPasien" => $dataPasien,
            "diagnosa_pasien" => $diagnosa_pasien,
            "reg_periksa" => $reg_periksa,
            "rujukan_internal" => $rujukan_internal,
            "prosedur_pasien" =>$prosedur_pasien,
            "pemeriksaan_ralan" => $pemeriksaan_ralan,
            "pemeriksaan_ranap"=> $pemeriksaan_ranap,
            "rawat_jl_dr" => $rawat_inap_dr,
            "rawat_jl_pr" => $rawat_jl_pr,
            "rawat_jl_drpr" => $rawat_inap_drpr,
            "rawat_inap_dr" => $rawat_inap_dr,
            "rawat_inap_pr" => $rawat_inap_pr,
            "rawat_inap_drpr" => $rawat_inap_drpr,
            "kamar_inap" => $kamar_inap,
            "operasi" => $operasi,
            "tindakan_radiologi" => $tindakan_radiologi,
            "hasil_radiologi" => $hasil_radiologi,
            "pemeriksaan_laboratorium" => $pemeriksaan_laboratorium,
            "pemberian_obat" => $pemberian_obat,
            "obat_operasi" => $obat_operasi,
            "resep_pulang" => $resep_pulang,
            "dpjp_ranap" => $dpjp_ranap
        ];
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

                return !empty($query) ? $query : [(object)[]];
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



    return !empty($query) ? $query : [(object)[] ];
    }

    public function getSKDP($noRm){
        // $query = DB::table("bridging_surat_kontrol_bpjs as bskp")
        //                 ->select("bskp.no_surat",
        //                         "bskp.nm_dokter_bpjs",
        //                         "bskp.nm_poli_bpjs",
        //                         "bs.no_kartu",
        //                         "bs.nama_pasien",
        //                         "bs.tanggal_lahir",
        //                         "bs.nmdiagnosaawal",
        //                         "bskp.tgl_rencana")
        //                  ->leftJoin("bridging_sep as bs", "bskp.no_ep", "=", "bs.no_sep")
        //                  ->where("bs.no_rawat", "=", $noRw)
        //                  ->get()->toArray();

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
        return !empty($query) ? $query : [(object)[]];
    }

    public function getResume($noRw, $fr){
        $resume = [];
        if($fr=='ri'){
            $rp=$this->resumeService->getResumeRanapList(['resume_pasien_ranap.no_rawat'=>$noRw]);
            foreach($rp as $key => $val){
                $data = $this->resumeService->getKamarInap(['kamar_inap.no_rawat'=>$noRw])[$key];
                $data_sidikjari= DB::table("sidikjari")
                        ->select(DB::raw("SHA1(sidikjari) as sidikjari"))
                        ->join("pegawai", "pegawai.id", "=", "sidikjari.id")
                        ->where('pegawai.nik', $val->kd_dokter)->first();
                $val->tgl_keluar = $data->tgl_keluar;
                $val->kamar = $data->kd_kamar." ".$data->nm_bangsal;
                $val->sidikjari_dokter = $data_sidikjari->sidikjari;
                array_push($resume, (object)$val->toArray());
            }
        }else{
            $rp=$this->resumeService->getResumeList(['resume_pasien.no_rawat'=>$noRw]);
            foreach($rp as $key => $val){
                $val->tgl_keluar = $val->tgl_registrasi;
                array_push($resume, (object)$val->toArray());
            }
        }
        $resume_pasien = !empty($resume) ? $resume : [(object)[]];
        return $resume_pasien;
    }
    public function getResumeLaporanOperasi($noRw, $fr){
        $pemeriksaan_table = $fr == "rj" ? "pemeriksaan_ralan" : "pemeriksaan_ranap";
        $laporan_operasi = DB::table('operasi')
                            ->select(
                                'operasi.no_rawat',
                                'reg_periksa.no_rkm_medis',
                                'pasien.nm_pasien',
                                'pasien.jk',
                                'pasien.tgl_lahir',
                                'reg_periksa.umurdaftar',
                                'reg_periksa.sttsumur',
                                'operasi.tgl_operasi',
                                'operasi.jenis_anasthesi',
                                'operasi.kategori',
                                'laporan_operasi.diagnosa_preop',
                                'laporan_operasi.diagnosa_postop',
                                'laporan_operasi.jaringan_dieksekusi',
                                'laporan_operasi.selesaioperasi',
                                'laporan_operasi.permintaan_pa',
                                'laporan_operasi.laporan_operasi',
                                'poliklinik.nm_poli',
                                'kamar_pasien.nama_kamar',
                                'pemeriksaan.*',
                                'kode_operator.operator1 as kode_operator',
                                'sidikjari_operator.sidikjari',
                                DB::raw("( SELECT nm_dokter FROM dokter WHERE dokter.kd_dokter = operasi.operator1 ) AS operator1"),
                                DB::raw("( SELECT nm_dokter FROM dokter WHERE dokter.kd_dokter = operasi.operator2 ) AS operator2"),
                                DB::raw("( SELECT nm_dokter FROM dokter WHERE dokter.kd_dokter = operasi.operator3 ) AS operator3"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.asisten_operator1 ) AS asistenoperator1"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.asisten_operator2 ) AS asistenoperator2"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.asisten_operator3 ) AS asistenoperator3"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.instrumen ) AS instrumen"),
                                DB::raw("( SELECT nm_dokter FROM dokter WHERE dokter.kd_dokter = operasi.dokter_anak ) AS dokteranak"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.perawaat_resusitas ) AS perawatresusitas"),
                                DB::raw("( SELECT nm_dokter FROM dokter WHERE dokter.kd_dokter = operasi.dokter_anestesi ) AS anastesi"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.asisten_anestesi ) AS asistenanastesi"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.asisten_anestesi2 ) AS asistenanastesi2"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.bidan ) AS bidan1"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.bidan2 ) AS bidan2"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.bidan3 ) AS bidan3"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.perawat_luar ) AS perawatluar"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.omloop ) AS omloop"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.omloop2 ) AS omloop2"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.omloop3 ) AS omloop3"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.omloop4 ) AS omloop4"),
                                DB::raw("( SELECT nama FROM petugas WHERE petugas.nip = operasi.omloop5 ) AS omloop5"),
                                DB::raw("( SELECT nm_dokter FROM dokter WHERE dokter.kd_dokter = operasi.dokter_pjanak ) AS pjanak"),
                                DB::raw("( SELECT nm_dokter FROM dokter WHERE dokter.kd_dokter = operasi.dokter_umum ) AS dokumum")
                                )
                            ->join('reg_periksa','operasi.no_rawat','=','reg_periksa.no_rawat')
                            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                            ->join('laporan_operasi',function($join) {
                                $join->on('operasi.no_rawat','=','laporan_operasi.no_rawat')
                                ->on('operasi.tgl_operasi','=','laporan_operasi.tanggal');
                            })
                            ->leftJoinSub(
                                DB::table('poliklinik')
                                ->select('poliklinik.nm_poli', "reg_periksa.no_rawat")
                                ->join('reg_periksa','reg_periksa.kd_poli','=','poliklinik.kd_poli')
                                ->where('reg_periksa.no_rawat','=',$noRw),
                                "poliklinik",
                                function($join) {
                                    $join->on('poliklinik.no_rawat','=','operasi.no_rawat');
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
                                    $join->on('kamar_pasien.no_rawat','=','operasi.no_rawat');
                                })
                            ->leftJoinSub(
                                DB::table($pemeriksaan_table)
                                    ->select("*")
                                    ->where("no_rawat", "=", $noRw)
                                    ->orderBy("tgl_perawatan", "desc")
                                    ->orderBy("jam_rawat", "desc")
                                    ->limit(1),
                                'pemeriksaan',
                                function($join){
                                    $join->on('pemeriksaan.no_rawat', "=", "operasi.no_rawat");
                                }
                            )
                            ->leftJoinSub(
                                DB::table("operasi")
                                    ->select("operator1", "tgl_operasi")
                                    ->where("no_rawat", "=", $noRw),
                                'kode_operator',
                                function($join){
                                    $join->on("operasi.tgl_operasi", "=", "operasi.tgl_operasi");
                                }
                            )
                            ->leftJoinSub(
                                DB::table("sidikjari")
                                ->select("pegawai.nik", DB::raw("SHA1(sidikjari) as sidikjari"))
                                ->join("pegawai", "pegawai.id", "=", "sidikjari.id"),
                                "sidikjari_operator",
                                function($join){
                                    $join->on("sidikjari_operator.nik", "=", "kode_operator.operator1");
                                }
                            )
                            ->where("reg_periksa.no_rawat", "=", $noRw)
                            ->first();
       return !empty($laporan_operasi) ? $laporan_operasi : (object)[];
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
                    ->first();

        return !empty($query) ? $query : [];
    }
    public function getBilling($noRw){
        $billing = DB::table('billing')
                            ->select(DB::raw("no,nm_perawatan,pemisah,if(biaya=0,'',biaya),if(jumlah=0,'',jumlah),if(tambahan=0,'',tambahan),if(totalbiaya=0,'',totalbiaya),totalbiaya"))
                            ->where('no_rawat',"=", $noRw)
                            ->get();

        return $billing;
    }

    public function createPdfFile($filename, $pdfData, $optional_download, $file_format){

        $show = function($id, $model = "1") use($pdfData, $optional_download){
            $regex = sprintf("/(%s_|\*)/i", $id);
            $status = !empty($pdfData['dataShown']["$id"]) && preg_match($regex,$optional_download );
            return $status ? $model : '-';
        };
        $pdf = new ModulPDF();

        SEP::addPDF($pdf, $pdfData["sep_data"], $show(1));
        SPRI::addPDF($pdf, $pdfData["spri_data"],$show(10),  [
            'margintop'=> 10,
            'layout_orientation' => "L",
            'paper_size' => [210, 120]
        ]);
        SOAP::addPDF($pdf, $pdfData["soap_data"], $show(2));
        Billing::addPDF($pdf, $pdfData["billing_data"], $show(3));
        foreach($pdfData['resume_data'] as $key => $value){
            if($pdfData['fr'] === 'rj'){
                Resume::addPDF($pdf, $value, $show(4));
            }else{
                Resume::addPDF($pdf, $value, $show(4, "1_ranap"));
                // Resume::addPDF($pdf, $value, $show(4, "1"));

            }
        }

        ResumeLaporanOperasi::addPDF($pdf, $pdfData['resume_laporan_operasi_data'], $show(5));
        foreach($pdfData['hasil_pemeriksaan_lab_pk_data'] as $key =>$value){
            HasilLaborPK::addPDF($pdf, $value, $show(7));
        }
        foreach($pdfData['hasil_pemeriksaan_radiologi_data'] as $key =>$value){
            HasilRadiologi::addPDF($pdf, $value, $show(8));
        }
        foreach($pdfData['skdp_data'] as $value){
            $tgl_surat = !empty($value->tgl_surat) ?$value->tgl_surat : "" ;
            if(preg_match("/(9_$tgl_surat|\*)/i",$optional_download )){
                SKDP::addPDF($pdf, $value, $show(9), [
                    'margintop'=>10,
                    'layout_orientation' => "L",
                    'paper_size' => [210, 120]
                ]);
            }
        }
        return $pdf->Output(public_path($filename), $file_format);

    }
}
