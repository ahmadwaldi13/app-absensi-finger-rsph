<?php

namespace App\Services;

use App\Models\Kabupaten;
use App\Models\PoliKlinik;
use App\Models\RawatJl;
use App\Models\RegPeriksa;
use App\Models\ResumePasien;
use App\Models\Pasien;
use App\Models\PemeriksaanRalan;
use App\Models\Dokter;
use App\Models\JnsPerawatanLab;
use App\Models\TemplateLab;
use App\Models\PermintaanLab;
use App\Models\PermintaanPemeriksaanLab;
use App\Models\PermintaanDetailPermintaanLab;
use App\Models\PermintaanLabPA;
use App\Models\PermintaanPemeriksaanLabPA;
use App\Models\JnsPerawatanRadiologi;
use App\Models\PermintaanRadiologi;
use App\Models\PermintaanPemeriksaanRadiologi;
use App\Models\BookingOperasi;
use App\Models\PaketOperasi;
use App\Models\LaporanOperasi;
use App\Models\SetDepoRalan;
use App\Models\SetLokasi;
use App\Models\DataBarang;
use App\Models\DiagnosaPasien;
use App\Models\SetHargaObatRalan;
use App\Models\ResepObat;
use App\Models\ResepDokter;
use App\Models\HasilRadiologi;
use App\Models\DetailPeriksaLab;
use App\Models\DetailPemberianObat;
use App\Models\JnsPerawatan;
use App\Models\Petugas;
use App\Models\RawatJlPr;
use App\Models\RawatJlDr;
use App\Models\ResepDokterRacikan;
use App\Models\ResepDokterRacikanDetail;
use App\Models\MetodeRacik;
use App\Models\ProsedurPasien;
use App\Models\KategoriPenyakit;
use App\Models\Icd9;
use App\Models\AturanPakai;
use App\Models\RawatJlDrPr;
use App\Models\RawatInapDr;
use App\Models\RawatInapDrPr;
use App\Models\SetTarif;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\ResumeService;
use App\Services\CpptService;


class RawatJalanService extends BaseService
{
    public function __construct(
        RawatJl $rawatJl,
        RegPeriksa $regPeriksa,
        PoliKlinik $poliKlinik,
        Kabupaten $city,
        ResumePasien $resumePasien,
        Pasien $pasien,
        PemeriksaanRalan $pemeriksaanRalan,
        Dokter $dokter,
        JnsPerawatanLab $jnsPerawatanLab,
        TemplateLab $templateLab,
        PermintaanLab $permintaanLab,
        PermintaanPemeriksaanLab $permintaanPemeriksaanLab,
        PermintaanDetailPermintaanLab $permintaanDetailPermintaanLab,
        PermintaanLabPA $permintaanLabPA,
        PermintaanPemeriksaanLabPA $permintaanPemeriksaanLabPA,
        JnsPerawatanRadiologi $jnsPerawatanRadiologi,
        PermintaanRadiologi $permintaanRadiologi,
        PermintaanPemeriksaanRadiologi $permintaanPemeriksaanRadiologi,
        BookingOperasi $bookingOperasi,
        PaketOperasi $paketOperasi,
        LaporanOperasi $laporanOperasi,
        SetDepoRalan $setDepoRalan,
        SetLokasi $setLokasi,
        DataBarang $dataBarang,
        DiagnosaPasien $diagnosaPasien,
        SetHargaObatRalan $setHargaObatRalan,
        ResepObat $resepObat,
        ResepDokter $resepDokter,
        HasilRadiologi $hasilRadiologi,
        DetailPeriksaLab $detailPeriksaLab,
        DetailPemberianObat $detailPemberianObat,
        JnsPerawatan $jnsPerawatan,
        Petugas $petugas,
        RawatJlPr $rawatJlPr,
        RawatJlDr $rawatJlDr,
        ResepDokterRacikanDetail $resepDokterRacikanDetail,
        MetodeRacik $metodeRacik,
        ResepDokterRacikan $resepDokterRacikan,
        ProsedurPasien $prosedurPasien,
        KategoriPenyakit $kategoriPenyakit,
        Icd9 $icd9,
        AturanPakai $aturanPakai,
        RawatJlDrPr $rawatJlDrPr,
        RawatInapDr $rawatInapDr,
        RawatInapDrPr $rawatInapDrPr,
        SetTarif $setTarif,
        GlobalService $globalService,
        ResumeService $resumeService,
        CpptService $cpptService
    ) {
        parent::__construct();
        $this->rawatJl = $rawatJl;
        $this->regPeriksa = $regPeriksa;
        $this->poliKlinik = $poliKlinik;
        $this->city = $city;
        $this->resumePasien = $resumePasien;
        $this->pasien = $pasien;
        $this->pemeriksaanRalan = $pemeriksaanRalan;
        $this->dokter = $dokter;
        $this->jnsPerawatanLab = $jnsPerawatanLab;
        $this->templateLab = $templateLab;
        $this->permintaanLab = $permintaanLab;
        $this->permintaanPemeriksaanLab = $permintaanPemeriksaanLab;
        $this->permintaanDetailPermintaanLab = $permintaanDetailPermintaanLab;
        $this->permintaanLabPA = $permintaanLabPA;
        $this->permintaanPemeriksaanLabPA = $permintaanPemeriksaanLabPA;
        $this->jnsPerawatanRadiologi = $jnsPerawatanRadiologi;
        $this->permintaanRadiologi = $permintaanRadiologi;
        $this->permintaanPemeriksaanRadiologi = $permintaanPemeriksaanRadiologi;
        $this->bookingOperasi = $bookingOperasi;
        $this->paketOperasi = $paketOperasi;
        $this->laporanOperasi = $laporanOperasi;
        $this->setDepoRalan = $setDepoRalan;
        $this->setLokasi = $setLokasi;
        $this->dataBarang = $dataBarang;
        $this->diagnosaPasien = $diagnosaPasien;
        $this->setHargaObatRalan = $setHargaObatRalan;
        $this->resepObat = $resepObat;
        $this->resepDokter = $resepDokter;
        $this->hasilRadiologi = $hasilRadiologi;
        $this->detailPeriksaLab = $detailPeriksaLab;
        $this->detailPemberianObat = $detailPemberianObat;
        $this->jnsPerawatan = $jnsPerawatan;
        $this->petugas = $petugas;
        $this->rawatJlPr = $rawatJlPr;
        $this->rawatJlDr = $rawatJlDr;
        $this->resepDokterRacikanDetail = $resepDokterRacikanDetail;
        $this->metodeRacik = $metodeRacik;
        $this->resepDokterRacikan = $resepDokterRacikan;
        $this->prosedurPasien = $prosedurPasien;
        $this->kategoriPenyakit = $kategoriPenyakit;
        $this->icd9 = $icd9;
        $this->aturanPakai = $aturanPakai;
        $this->rawatJlDrPr = $rawatJlDrPr;
        $this->rawatInapDr = $rawatInapDr;
        $this->rawatInapDrPr = $rawatInapDrPr;
        $this->setTarif = $setTarif;
        $this->globalService = $globalService;
        $this->resumeService = $resumeService;
        $this->cpptService = $cpptService;

    }

    /**
     * Get all rawat jalan
     *
     * @param array $filter array filter ['city', 'poli', 'status', 'start']
     *
     * @return Model
     * @throws Exception
     **/
    public function getListRawatJalan(array $filter)
    {

        $query = $this->regPeriksa
            ->select(
                'reg_periksa.no_reg',
                'reg_periksa.no_rawat',
                'reg_periksa.tgl_registrasi',
                'reg_periksa.jam_reg',
                'reg_periksa.kd_dokter',
                'dokter.nm_dokter',
                'reg_periksa.no_rkm_medis',
                'pasien.nm_pasien',
                'poliklinik.nm_poli',
                'reg_periksa.p_jawab',
                'reg_periksa.almt_pj',
                'reg_periksa.hubunganpj',
                'reg_periksa.biaya_reg',
                'reg_periksa.stts',
                'penjab.png_jawab',
                DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),
                'reg_periksa.status_bayar',
                'reg_periksa.status_poli',
                'reg_periksa.kd_pj',
                'reg_periksa.kd_poli',
                'pasien.no_tlp',
                DB::raw(
                    'concat(
                        uxui_tindakan_pasien.pemeriksaan,\'-\',
                        uxui_tindakan_pasien.permintaan_lab,\'-\',
                        uxui_tindakan_pasien.resep,\'-\',
                        uxui_tindakan_pasien.resume
                    ) as tindakan_pasien'.
                    (empty($filter["kd_dokter"]) ? ',concat(uxui_tindakan_pasien_perawat.pemeriksaan) as tindakan_pasien_perawat': ''))
            )
            ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->join('penjab', 'reg_periksa.kd_pj', '=', 'penjab.kd_pj')
            ->leftJoin('uxui_tindakan_pasien', function ($join) {
                $join->on('uxui_tindakan_pasien.no_rawat', '=', 'reg_periksa.no_rawat');
                $join->on('uxui_tindakan_pasien.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis');
                $join->where('uxui_tindakan_pasien.type_akses', '=', 'rj');
            })
            ->where('reg_periksa.status_lanjut', '=', 'Ralan')
            ->orderBy('reg_periksa.no_rawat', 'ASC')

            ->when($filter['city'], function ($query, $filter) {
                $query->where('pasien.kd_kab', '=', $filter);
            })
            ->when($filter['poli'], function ($query, $filter) {
                $query->where('poliklinik.kd_poli', '=', $filter);
            })
            ->when($filter['status'], function ($query, $filter) {
                $query->where('reg_periksa.stts', '=', $filter);
            })
            ->when([$filter['start'], $filter['end']], function ($query, $filter) {
                if ($filter[0] != null) {
                    $query->whereBetween('reg_periksa.tgl_registrasi',  [$filter[0], $filter[1]]);
                }
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

            if(!empty($filter['kd_dokter'])){
                $query->where('dokter.kd_dokter', '=', $filter['kd_dokter']);
            }

            if(empty($filter['kd_dokter'])){
                $query->leftJoin('uxui_tindakan_pasien_perawat', function ($join) {
                    $join->on('uxui_tindakan_pasien_perawat.no_rawat', '=', 'reg_periksa.no_rawat');
                    $join->on('uxui_tindakan_pasien_perawat.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis');
                    $join->where('uxui_tindakan_pasien_perawat.type_akses', '=', 'rj');
                });
            }
        return $query;
    }

    public function getRawatJalanByNorawat($noRawat)
    {
        return $this->regPeriksa
            ->select(
                'reg_periksa.no_reg',
                'reg_periksa.no_rawat',
                'reg_periksa.tgl_registrasi',
                'reg_periksa.jam_reg',
                'reg_periksa.kd_dokter',
                'dokter.nm_dokter',
                'reg_periksa.no_rkm_medis',
                'pasien.nm_pasien',
                'poliklinik.nm_poli',
                'reg_periksa.p_jawab',
                'reg_periksa.almt_pj',
                'reg_periksa.hubunganpj',
                'reg_periksa.biaya_reg',
                'reg_periksa.stts',
                'penjab.png_jawab',
                DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),
                'reg_periksa.status_bayar',
                'reg_periksa.status_poli',
                'reg_periksa.kd_pj',
                'reg_periksa.kd_poli',
                'pasien.no_tlp'
            )
            ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->join('penjab', 'reg_periksa.kd_pj', '=', 'penjab.kd_pj')
            ->where('reg_periksa.no_rawat', '=', $noRawat)
            ->orderBy('reg_periksa.no_rawat', 'ASC')
            ->first();
    }

    /**
     * Get list poliklinik
     *
     * @return Model
     * @throws conditon
     **/
    public function getListPoliklinik()
    {
        return $this->poliKlinik;
    }

    /**
     * Get list register status
     *
     * @return Model
     * @throws conditon
     **/
    public function getListRegisterStatus()
    {
        return $this->regPeriksa->getPossibleEnumValues("stts");
    }

    /**
     * Get list city
     *
     * @return Model
     * @throws conditon
     **/
    public function getListCity()
    {
        return $this->city->get();
    }

    // public function getResumePasien($noRm, $filter = [])
    // {
    //     return $this->regPeriksa
    //         ->select('reg_periksa.no_reg', 'reg_periksa.no_rawat', 'reg_periksa.tgl_registrasi', 'reg_periksa.jam_reg', 'reg_periksa.kd_dokter', 'dokter.nm_dokter', 'poliklinik.nm_poli', 'reg_periksa.p_jawab', 'reg_periksa.almt_pj', 'reg_periksa.hubunganpj', 'reg_periksa.biaya_reg', 'reg_periksa.status_lanjut', 'penjab.png_jawab')
    //         ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
    //         ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
    //         ->join('penjab', 'reg_periksa.kd_pj', '=', 'penjab.kd_pj')
    //         ->where([['reg_periksa.stts', '<>', 'Batal'], ['reg_periksa.no_rkm_medis', $noRm]])
    //         ->when(isset($filter['start_date']), function ($query) use ($filter) {
    //             $query->whereBetween('reg_periksa.tgl_registrasi', [$filter['start_date'], $filter['end_date']]);
    //         })
    //         ->orderBy('reg_periksa.tgl_registrasi', 'ASC')

    //         ->get();
    // }
    public function getDataPasienForResume($noRm)
    {
        return $this->pasien
            ->select('pasien.no_rkm_medis', 'pasien.nm_pasien', 'pasien.jk', 'pasien.tmp_lahir', 'pasien.tgl_lahir', 'pasien.agama', 'bahasa_pasien.nama_bahasa', 'cacat_fisik.nama_cacat', 'pasien.gol_darah', 'pasien.nm_ibu', 'pasien.stts_nikah', 'pasien.pnd', DB::raw('concat(pasien.alamat,\', \',kelurahan.nm_kel,\', \',kecamatan.nm_kec,\', \',kabupaten.nm_kab) as alamat'), 'pasien.pekerjaan')
            ->join('bahasa_pasien', 'bahasa_pasien.id', '=', 'pasien.bahasa_pasien')
            ->join('cacat_fisik', 'cacat_fisik.id', '=', 'pasien.cacat_fisik')
            ->join('kelurahan', 'pasien.kd_kel', '=', 'kelurahan.kd_kel')
            ->join('kecamatan', 'pasien.kd_kec', '=', 'kecamatan.kd_kec')
            ->join('kabupaten', 'pasien.kd_kab', '=', 'kabupaten.kd_kab')
            ->where('pasien.no_rkm_medis', '=', $noRm)
            ->first();
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

    function getCpptList($noRm)
    {

        return $this->pasien
            ->select('pemeriksaan_ralan.no_rawat', 'reg_periksa.no_rkm_medis', 'pasien.nm_pasien', 'pemeriksaan_ralan.tgl_perawatan', 'pemeriksaan_ralan.jam_rawat', 'pemeriksaan_ralan.suhu_tubuh', 'pemeriksaan_ralan.tensi', 'pemeriksaan_ralan.nadi', 'pemeriksaan_ralan.respirasi', 'pemeriksaan_ralan.tinggi', 'pemeriksaan_ralan.berat', 'pemeriksaan_ralan.gcs', 'pemeriksaan_ralan.kesadaran', 'pemeriksaan_ralan.keluhan', 'pemeriksaan_ralan.pemeriksaan', 'pemeriksaan_ralan.alergi', 'pemeriksaan_ralan.rtl', 'pemeriksaan_ralan.penilaian', 'pemeriksaan_ralan.instruksi', 'pemeriksaan_ralan.nip', 'pegawai.nama')
            ->join('reg_periksa', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('pemeriksaan_ralan', 'pemeriksaan_ralan.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pegawai', 'pemeriksaan_ralan.nip', '=', 'pegawai.nik')
            ->where('reg_periksa.no_rkm_medis', 'LIKE', $noRm)
            ->orderBy('pemeriksaan_ralan.no_rawat', 'DESC')
            ->get();
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

    public function getDokterByKodeDokter($kdDokter)
    {
        return $this->dokter->where('kd_dokter', '=', $kdDokter)->first();
    }

    public function getDokterByNoResep($noResep)
    {
        return $this->dokter->where('kd_dokter', '=', $this->resepObat->where('no_resep', $noResep)->first()->kd_dokter)->first();
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

    
    function getTemplateLab($kdJenisPrw, $filter)
    {
        return $this->templateLab
            ->select('id_template', 'Pemeriksaan', 'satuan', 'nilai_rujukan_ld', 'nilai_rujukan_la', 'nilai_rujukan_pd', 'nilai_rujukan_pa', 'kd_jenis_prw')
            ->where([['kd_jenis_prw', $kdJenisPrw], ['Pemeriksaan', 'LIKE', '%' . $filter . '%']])
            ->orderBy('urut', 'ASC')
            ->get();
    }

    function insertPermintaanAnatomi($dataPermintaan, $dataPemeriksaan)
    {
        try {
            $insertPermintaan = $this->permintaanLabPA->insert($dataPermintaan);
        } catch (\Illuminate\Database\QueryException $ex) {
            $errorCode = $ex->errorInfo[1];
            if ($errorCode == 1062) {
                return ([false, "Nomor Permintaan sudah digunakan"]);
            }
            return [false];
        }
        foreach ($dataPemeriksaan as $pa) {   //pemeriksaan klinis
            $dataInsertPA = [
                "noorder" => $dataPermintaan["noorder"],
                "kd_jenis_prw" => $pa,
                "stts_bayar" => "Belum"
            ];
            $this->permintaanPemeriksaanLabPA->insert($dataInsertPA);
        }

        return [$insertPermintaan];
    }

    function autoNomor($rs, $tgl, $strAwal, $pnj)
    {
        $s = "1";
        foreach ($rs as $item) {
            $s = strval((int)$rs->last + 1);
        }
        $j = strlen($s);
        $s1 = "";
        for ($i = 1; $i <= $pnj - $j; $i++) {
            $s1 = $s1 . "0";
        }
        return $strAwal . $s1 . $s;
    }

    function getJadwalOperasiList($filter)
    {
        $this->diagnosaPasien
            ->select(DB::raw('concat(diagnosa_pasien.kd_penyakit,\' \',penyakit.nm_penyakit)'))
            ->join('penyakit', 'diagnosa_pasien.kd_penyakit', '=', 'penyakit.kd_penyakit')
            ->where('diagnosa_pasien.no_rawat', '=', '2020/10/05/000001')
            ->limit(1)
            ->get();
        return $this->bookingOperasi->select(
            'booking_operasi.no_rawat',
            'reg_periksa.no_rkm_medis',
            'pasien.nm_pasien',
            'booking_operasi.tanggal',
            'booking_operasi.jam_mulai',
            'booking_operasi.jam_selesai',
            'booking_operasi.status',
            'booking_operasi.kd_dokter',
            'dokter.nm_dokter',
            'booking_operasi.kode_paket',
            'paket_operasi.nm_perawatan',
            DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),
            'pasien.jk',
            'poliklinik.nm_poli',
            DB::raw('concat(diagnosa_pasien.kd_penyakit,\' \',penyakit.nm_penyakit) as diagnosa')
        )
            ->join('reg_periksa', 'booking_operasi.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('paket_operasi', 'booking_operasi.kode_paket', '=', 'paket_operasi.kode_paket')
            ->join('dokter', 'booking_operasi.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->leftJoin('diagnosa_pasien', 'booking_operasi.no_rawat', '=', 'diagnosa_pasien.no_rawat')
            ->leftJoin('penyakit', 'diagnosa_pasien.kd_penyakit', '=', 'penyakit.kd_penyakit')
            ->where('booking_operasi.status', '=', 'Menunggu')
            ->when($filter['search'], function ($query, $filter) {
                $query->where(function ($qb2) use ($filter) {
                    $qb2->where('booking_operasi.no_rawat', 'LIKE', '%' . $filter . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $filter . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $filter . '%')
                        ->orWhere('booking_operasi.status ', 'LIKE', '%' . $filter . '%')
                        ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter . '%')
                        ->orWhere('paket_operasi.nm_perawatan', 'LIKE', '%' . $filter . '%');
                });
            })
            ->orderBy('booking_operasi.tanggal', 'ASC')
            ->orderBy('booking_operasi.jam_mulai', 'ASC')
            ->get();
    }


    function getJadwalOperasiList2($filter = [])
    {
        $query = $this->bookingOperasi->select(
            'booking_operasi.no_rawat',
            'reg_periksa.no_rkm_medis',
            'pasien.nm_pasien',
            'booking_operasi.tanggal',
            'booking_operasi.jam_mulai',
            'booking_operasi.jam_selesai',
            'booking_operasi.status',
            'booking_operasi.kd_dokter',
            'dokter.nm_dokter',
            'booking_operasi.kode_paket',
            'paket_operasi.nm_perawatan',
            DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),
            'pasien.jk',
            'poliklinik.nm_poli',
            DB::raw('concat(diagnosa_pasien.kd_penyakit,\' \',penyakit.nm_penyakit) as diagnosa')
        )
            ->join('reg_periksa', 'booking_operasi.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('paket_operasi', 'booking_operasi.kode_paket', '=', 'paket_operasi.kode_paket')
            ->join('dokter', 'booking_operasi.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->leftJoin('diagnosa_pasien', 'booking_operasi.no_rawat', '=', 'diagnosa_pasien.no_rawat')
            ->leftJoin('penyakit', 'diagnosa_pasien.kd_penyakit', '=', 'penyakit.kd_penyakit')
            ->orderBy('booking_operasi.tanggal', 'ASC')
            ->orderBy('booking_operasi.jam_mulai', 'ASC');

        if ($filter) {
            if (!empty($filter['search'])) {
                $query->where('booking_operasi.no_rawat', 'LIKE', '%' . $filter['search'] . '%')
                    ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $filter['search'] . '%')
                    ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $filter['search'] . '%')
                    ->orWhere('reg_periksa.no_rkm_medis', 'LIKE', '%' . $filter['search'] . '%')
                    ->orWhere('paket_operasi.nm_perawatan', 'LIKE', '%' . $filter['search'] . '%');
            }

            if (!empty($filter['status'])) {
                if (is_array($filter['status'])) {
                    $query->whereIn('booking_operasi.status', $filter['status']);
                } else {
                    $query->where('booking_operasi.status', $filter['status']);
                }
            }

            if (!empty($filter['status'])) {
                $query->where('booking_operasi.status', $filter['status']);
            }

            if (!empty($filter['tanggal_start']) && !empty($filter['tanggal_end'])) {
                $query->whereBetween('booking_operasi.tanggal',  [$filter['tanggal_start'], $filter['tanggal_end']]);
            }
        }

        return $query;
    }

    function getJadwalOperasiOperatorList()
    {
        return $this->dokter
            ->select('kd_dokter', 'nm_dokter', 'jk', 'tmp_lahir', 'tgl_lahir', 'gol_drh', 'agama', 'almt_tgl', 'no_telp', 'stts_nikah', 'nm_sps', 'alumni', 'no_ijn_praktek')
            ->join('spesialis', 'dokter.kd_sps', '=', 'spesialis.kd_sps')
            ->orderBy('nm_dokter', 'ASC')
            ->get();
    }

    function getJadwalOperasiOperasiList()
    {
        return $this->paketOperasi
            ->select('kode_paket', 'nm_perawatan', 'kategori', 'kd_pj', 'kelas', 'operator1', 'operator2', 'operator3', 'asisten_operator1', 'asisten_operator2', 'asisten_operator3', 'instrumen', 'dokter_anak', 'perawaat_resusitas', 'dokter_anestesi', 'asisten_anestesi', 'asisten_anestesi2', 'bidan', 'bidan2', 'bidan3', 'perawat_luar', 'alat', 'sewa_ok', 'akomodasi', 'bagian_rs', 'omloop', 'omloop2', 'omloop3', 'omloop4', 'omloop5', 'sarpras', 'dokter_pjanak', 'dokter_umum', DB::raw('(operator1+operator2+operator3+
            asisten_operator1+asisten_operator2+asisten_operator3+instrumen+dokter_anak+perawaat_resusitas+
            alat+dokter_anestesi+asisten_anestesi+asisten_anestesi2+bidan+bidan2+bidan3+perawat_luar+sewa_ok+
            akomodasi+bagian_rs+omloop+omloop2+omloop3+omloop4+omloop5+sarpras+dokter_pjanak+dokter_umum) as jumlah'))
            ->where('status', '=', '1')
            ->orderBy('nm_perawatan', 'ASC')
            ->get();
    }

    function getJadwalOperasiStatus()
    {
        return $this->bookingOperasi->getPossibleEnumValues("status");
    }

    function getLaporanOperasiPermintaan()
    {
        return $this->laporanOperasi->getPossibleEnumValues("permintaan_pa");
    }

    function insertJadwalOperasi($fields)
    {

        return $this->bookingOperasi->insert($fields);
        // no_rawat
        // kode_paket
        // tanggal
        // jam_mulai
        // jam_selesai
        // status
        // kd_dokter
    }

    function updateJadwalOperasi($fieldsOld, $fieldsNew)
    {
        return $this->bookingOperasi
            ->where('no_rawat', $fieldsOld['no_rawat'])
            ->where('kode_paket', $fieldsOld['kode_paket'])
            ->where('tanggal', $fieldsOld['tanggal'])
            ->where('jam_mulai', $fieldsOld['jam_mulai'])
            ->where('jam_selesai', $fieldsOld['jam_selesai'])
            ->where('status', $fieldsOld['status'])
            ->where('kd_dokter', $fieldsOld['kd_dokter'])
            ->update($fieldsNew);
    }

    function deleteJadwalOperasi($fields)
    {
        return $this->bookingOperasi
            ->where('no_rawat', $fields['no_rawat'])
            ->where('tanggal', $fields['tanggal'])
            ->where('jam_mulai', $fields['jam_mulai'])
            ->where('jam_selesai', $fields['jam_selesai'])
            ->where('kd_dokter', $fields['kd_dokter'])
            ->where('status', $fields['status'])
            ->where('kode_paket', $fields['kode_paket'])
            ->delete();
    }

    function insertLaporanOperasi($fields)
    {
        return $this->laporanOperasi->insert($fields);
    }

    function getResepList($noRawat, $filter)
    {
        $kdBangsal = $this->getBangsalforResep();
        $kenaikan = $this->regPeriksa->select('kd_pj')->where('no_rawat', $noRawat)->first()->kd_pj;
        $kenaikan = $this->setHargaObatRalan->select(DB::raw('(hargajual/100) as harga_jual'))->where("kd_pj", $kenaikan)->first()->harga_jual ?? 0;

        return $this->dataBarang
            ->select('databarang.kode_brng', 'databarang.nama_brng', 'jenis.nama', 'databarang.kode_sat', DB::raw('(databarang.h_beli+(databarang.h_beli*' . $kenaikan . ')) as harga'), 'databarang.letak_barang', 'industrifarmasi.nama_industri', 'databarang.h_beli', 'gudangbarang.stok')
            ->join('jenis', 'databarang.kdjns', '=', 'jenis.kdjns')
            ->join('industrifarmasi', 'industrifarmasi.kode_industri', '=', 'databarang.kode_industri')
            ->join('gudangbarang', 'databarang.kode_brng', '=', 'gudangbarang.kode_brng')
            ->where([['databarang.status', '1'], ['gudangbarang.stok', '>', 0], ['gudangbarang.no_batch', ''], ['gudangbarang.no_faktur', ''], ['gudangbarang.kd_bangsal', $kdBangsal]])
            ->orderBy('databarang.nama_brng', 'ASC')
            ->when($filter['search'], function ($query, $filter) {
                $query->where(function ($qb2) use ($filter) {
                    $qb2->where('databarang.kode_brng', 'LIKE', '%' . $filter . '%')
                        ->orWhere('databarang.nama_brng', 'LIKE', '%' . $filter . '%')
                        ->orWhere('jenis.nama', 'LIKE', '%' . $filter . '%')
                        ->orWhere('databarang.letak_barang ', 'LIKE', '%' . $filter . '%');
                });
            })
            ->get();
    }

    function getResepRacikanList($noRawat, $filter)
    {
        $kdBangsal = $this->getBangsalforResep();
        $kenaikan = $this->regPeriksa->select('kd_pj')->where('no_rawat', $noRawat)->first()->kd_pj;
        $kenaikan = $this->setHargaObatRalan->select(DB::raw('(hargajual/100) as harga_jual'))->where("kd_pj", $kenaikan)->first()->harga_jual ?? 0;

        return $this->dataBarang->select('databarang.kode_brng', 'databarang.nama_brng', 'jenis.nama', 'databarang.kode_sat', DB::raw('(databarang.h_beli+(databarang.h_beli*1)) as harga'), 'databarang.letak_barang', 'industrifarmasi.nama_industri', 'databarang.h_beli', 'gudangbarang.stok', 'databarang.kapasitas')
            ->join('jenis', 'databarang.kdjns', '=', 'jenis.kdjns')
            ->join('industrifarmasi', 'industrifarmasi.kode_industri', '=', 'databarang.kode_industri')
            ->join('gudangbarang', 'databarang.kode_brng', '=', 'gudangbarang.kode_brng')
            ->where([['databarang.status', '1'], ['gudangbarang.stok', '>', 0], ['gudangbarang.no_batch', ''], ['gudangbarang.no_faktur', ''], ['gudangbarang.kd_bangsal', $kdBangsal]])
            ->orderBy('databarang.nama_brng', 'ASC')
            ->get();
    }

    function getResepPasien()
    {
    }

    function getBangsalforResep()
    {
        return $this->setLokasi->select("kd_bangsal")->limit(1)->get()[0]->kd_bangsal;
    }


    function insertResepDokter($dataResepObat, $dataResepDokter)
    {
        if ($this->resepObat->insert($dataResepObat)) {
            foreach ($dataResepDokter as $resepDokter) {
                $this->checkAturanPakai($resepDokter['aturan_pakai']);
                $resepDokter["no_resep"] = $dataResepObat["no_resep"];
                $this->resepDokter->insert($resepDokter);
            }
            return true;
        } else {
            return false;
        }
    }

    function checkAturanPakai($aturanPakai)
    {
        $aturanPakaiExisting = $this->aturanPakai->where('aturan', $aturanPakai)->first();
        if (!$aturanPakaiExisting) {
            $this->aturanPakai->insert(['aturan' => $aturanPakai]);
        }
    }

    function getNoResep($tgl)
    {
        return $this->autoNomor($this->resepObat
            ->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(no_resep,4),signed)),0) as last'))
            ->where('tgl_perawatan', '=', $tgl)
            ->first(), $tgl, str_replace("-", "", $tgl), 4);
    }


    function getResepCopyList($noRm, $kdDokter)
    {
        $data = $this->resepObat
            ->select(
                'resep_obat.no_resep',
                'resep_obat.tgl_peresepan',
                'resep_obat.jam_peresepan',
                'resep_obat.no_rawat',
                'pasien.no_rkm_medis',
                'pasien.nm_pasien',
                'resep_obat.kd_dokter',
                'dokter.nm_dokter',
                DB::raw('if(resep_obat.jam_peresepan=resep_obat.jam,\'Belum Terlayani\',\'Sudah Terlayani\') as status'),
                'resep_obat.status as status_asal'
            )
            ->join('reg_periksa', 'resep_obat.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('dokter', 'resep_obat.kd_dokter', '=', 'dokter.kd_dokter')
            ->where('pasien.no_rkm_medis', $noRm)
            ->where('resep_obat.kd_dokter', $kdDokter)
            ->orderBy('resep_obat.tgl_perawatan', 'ASC')
            ->orderBy('resep_obat.jam', 'DESC')
            ->with(['resepDokter' => function ($query) {
                $query->leftJoin('databarang', 'resep_dokter.kode_brng', '=', 'databarang.kode_brng');
            }])
            ->with(['resepDokterRacikan' => function ($query) {
                $query->leftJoin('metode_racik', 'resep_dokter_racikan.kd_racik', '=', 'metode_racik.kd_racik');
            }])
            ->get();

        foreach ($data as $keyObat => $resepObat) {
            foreach ($resepObat->resepDokterRacikan as $keyRacikan => $racikan) {
                $dataRacikanDetail =
                    $this->resepDokterRacikanDetail
                    ->leftJoin('databarang', 'resep_dokter_racikan_detail.kode_brng', '=', 'databarang.kode_brng')
                    ->where('no_resep', $racikan->no_resep)
                    ->where('no_racik', $racikan->no_racik)
                    ->get();
                $data[$keyObat]->resepDokterRacikan[$keyRacikan]->resepDokterRacikanDetail = $dataRacikanDetail;
            }
        }

        return $data;
    }

    function getMetodeRacikList()
    {
        return $this->metodeRacik->orderBy('nm_racik', 'ASC')->get();
    }

    function getResepDokterRacikanCopy($noResep)
    {
        $resepDokterRacikan = $this->resepDokterRacikan
            ->leftJoin('metode_racik', 'resep_dokter_racikan.kd_racik', '=', 'metode_racik.kd_racik')
            // ->leftJoin('')
            ->where('no_resep', $noResep)
            ->get();

        foreach ($resepDokterRacikan as $keyRacikan => $racikan) {
            $kdBangsal = $this->getBangsalforResep();
            $dataRacikanDetail =
                $this->resepDokterRacikanDetail
                ->leftJoin('databarang', 'resep_dokter_racikan_detail.kode_brng', '=', 'databarang.kode_brng')
                ->leftJoin('gudangbarang', 'resep_dokter_racikan_detail.kode_brng', '=', 'gudangbarang.kode_brng')
                ->leftJoin('jenis', 'databarang.kdjns', '=', 'jenis.kdjns')
                ->select('*', DB::raw('(databarang.h_beli+(databarang.h_beli*1)) as harga'), 'jenis.nama as jenis')
                ->where('no_resep', $racikan->no_resep)
                ->where('no_racik', $racikan->no_racik)
                ->where('gudangbarang.kd_bangsal', $kdBangsal)
                ->where('gudangbarang.no_batch', '')
                ->get();
            $resepDokterRacikan[$keyRacikan]->resepDokterRacikanDetail = $dataRacikanDetail;
        }

        return $resepDokterRacikan;
    }

    function insertResepDokterRacikan($resepObat, $resepDokterRacikanList, $resepDokterRacikanDetailList)
    {
        // $this->resepDokterRacikan->insert()
        if ($this->resepObat->insert($resepObat)) {
            foreach ($resepDokterRacikanList as $resepDokterRacikan) {
                $this->checkAturanPakai($resepDokterRacikan['aturan_pakai']);
                $this->resepDokterRacikan->insert($resepDokterRacikan);
            }
            foreach ($resepDokterRacikanDetailList as $resepDokterRacikanDetail) {
                $this->resepDokterRacikanDetail->insert($resepDokterRacikanDetail);
            }
            return true;
        } else {
            return false;
        }
    }

    function getResepById($noResep)
    {
        return $this->resepObat->where('no_resep', $noResep)
            ->with(['resepDokter' => function ($query) {
                $kdBangsal = $this->getBangsalforResep();
                $query->leftJoin('databarang', 'resep_dokter.kode_brng', '=', 'databarang.kode_brng')
                    ->select('*', DB::raw('(databarang.h_beli+(databarang.h_beli*1)) as harga'))
                    ->leftJoin('gudangbarang', 'resep_dokter.kode_brng', '=', 'gudangbarang.kode_brng')
                    ->where('gudangbarang.kd_bangsal', $kdBangsal)
                    ->where('gudangbarang.no_batch', '');
            }])
            ->with(['resepDokterRacikan' => function ($query) {
                $query->join('resep_dokter_racikan_detail', 'resep_dokter_racikan.no_resep', '=', 'resep_dokter_racikan_detail.no_resep')
                    ->join('metode_racik', 'resep_dokter_racikan.kd_racik', '=', 'metode_racik.kd_racik');
            }])
            ->get();
    }

    function getPemeriksaanRalanList($noRawat)
    {
        return $this->pemeriksaanRalan
            ->select('tgl_perawatan', 'jam_rawat', 'keluhan')
            ->where('no_rawat', '=', $noRawat)
            ->orderBy('tgl_perawatan', 'ASC')
            ->orderBy('jam_rawat', 'ASC')
            ->get();
    }

    function getKondisiPasienPulangList()
    {
        return $this->resumePasien->getPossibleEnumValues('kondisi_pulang');
    }

    function getKeluhanList()
    {
        return $this->resumePasien->getPossibleEnumValues('kondisi_pulang');
    }

    function insertResumePasien($fields)
    {
        try {
            foreach ($fields as $key => $field) {
                $field == null ? $fields[$key] = "" : "";
            }
            return $this->resumePasien->insert($fields);
        } catch (\Illuminate\Database\QueryException $ex) {
            return false;
        }
    }

    public function updateStatusRegPeriksa(string $noRawat, string $noRm, string $status)
    {
        $updatedRow = DB::table('reg_periksa')
            ->where('no_rawat', '=', $noRawat)
            ->where('no_rkm_medis', '=', $noRm)
            ->update(['stts' => $status]);

        if ($updatedRow == 0) {
            return false;
        }

        return true;
    }

    function getTindakanPetugasList()
    {
        $this->pasien
            ->select('rawat_jl_pr.no_rawat', 'reg_periksa.no_rkm_medis', 'pasien.nm_pasien', DB::raw('concat(rawat_jl_pr.kd_jenis_prw,\' \',jns_perawatan.nm_perawatan)'), 'rawat_jl_pr.nip', 'petugas.nama', 'rawat_jl_pr.tgl_perawatan', 'rawat_jl_pr.jam_rawat', 'rawat_jl_pr.biaya_rawat', 'rawat_jl_pr.kd_jenis_prw', 'rawat_jl_pr.tarif_tindakanpr', 'rawat_jl_pr.kso', 'rawat_jl_pr.material', 'rawat_jl_pr.bhp', 'rawat_jl_pr.menejemen')
            ->join('reg_periksa', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('petugas', 'rawat_jl_pr.nip', '=', 'petugas.nip')
            ->join('rawat_jl_pr', 'rawat_jl_pr.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('jns_perawatan', 'rawat_jl_pr.kd_jenis_prw', '=', 'jns_perawatan.kd_jenis_prw')
            ->orderBy('rawat_jl_pr.no_rawat', 'DESC')
            ->get();
    }

    function getJnsPerawatan()
    {
        return $this->jnsPerawatan;
    }

    function getRegPeriksa()
    {
        return $this->regPeriksa;
    }

    function getRegPeriksaRujukanPoli($params=[])
    {
        $query= RegPeriksa::select('rujukan_internal_poli.kd_poli as kd_poli_rujukan', 'reg_periksa.*')
            ->join('rujukan_internal_poli', 'rujukan_internal_poli.no_rawat', '=', 'reg_periksa.no_rawat')
            ->orderBy('reg_periksa.no_rawat', 'DESC')
        ;

        if(!empty($params)){
            $query->where($params);
        }
        return $query;
    }


    function getSetTarif(){
        return $this->setTarif;
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

    function getPetugasDokterList()
    {
        return $this->dokter->select('kd_dokter','nm_dokter','jk','tmp_lahir','tgl_lahir','gol_drh','agama','almt_tgl','no_telp','stts_nikah','nm_sps','alumni','no_ijn_praktek')
            ->join('spesialis', 'dokter.kd_sps', '=', 'spesialis.kd_sps')
            ->where('status', '=', '1')
            ->orderBy('nm_dokter', 'ASC')
            ->get();
    }

    function getAturanPakaiList()
    {
        return $this->aturanPakai->get();
    }

    private function checkDataDilakukan($model){
        $data_dilakukan=[];
        $data_dokter=$this->globalService->getDataDokterList(['kd_dokter'=>$model->nip]);
        $data_dokter=!empty($data_dokter[0]) ? $data_dokter[0] : [];
        if($data_dokter){
            $data_dilakukan=[
                'nama'=>!empty($data_dokter->nm_dokter) ? $data_dokter->nm_dokter : '',
                'kode'=>!empty($data_dokter->kd_dokter) ? $data_dokter->kd_dokter : '',
                'jabatan'=>!empty($data_dokter->jabatan) ? $data_dokter->jabatan : '',
            ];
        }else{
            $data_petugas=$this->globalService->getPetugasList(['nip'=>$model->nip]);
            $data_petugas=!empty($data_petugas[0]) ? $data_petugas[0] : [];
            if($data_petugas){
                $data_dilakukan=[
                    'nama'=>!empty($data_petugas->nama) ? $data_petugas->nama : '',
                    'kode'=>!empty($data_petugas->nip) ? $data_petugas->nip : '',
                    'jabatan'=>!empty($data_petugas->nm_jbtn) ? $data_petugas->nm_jbtn : '',
                ];
            }
        }

        return (object)$data_dilakukan;
    }

    function getPemeriksaanLaboratorium($noRawat)
    {
        return DB::select("
            select periksa_lab.tgl_periksa,periksa_lab.jam from periksa_lab where periksa_lab.kategori='PK' and periksa_lab.no_rawat='" . $noRawat . "'
            group by concat(periksa_lab.no_rawat,periksa_lab.tgl_periksa,periksa_lab.jam) order by periksa_lab.tgl_periksa,periksa_lab.jam
        ");
    }

    function getPemeriksaanRalan($noRawat)
    {
        return $this->pemeriksaanRalan->select('pemeriksaan_ralan.tgl_perawatan', 'pemeriksaan_ralan.jam_rawat', 'pemeriksaan_ralan.suhu_tubuh', 'pemeriksaan_ralan.tensi', 'pemeriksaan_ralan.nadi', 'pemeriksaan_ralan.respirasi', 'pemeriksaan_ralan.tinggi', 'pemeriksaan_ralan.berat', 'pemeriksaan_ralan.gcs', 'pemeriksaan_ralan.kesadaran', 'pemeriksaan_ralan.keluhan', 'pemeriksaan_ralan.pemeriksaan', 'pemeriksaan_ralan.alergi', 'pemeriksaan_ralan.rtl', 'pemeriksaan_ralan.penilaian', 'pemeriksaan_ralan.instruksi', 'pemeriksaan_ralan.nip', 'pegawai.nama', 'pegawai.jbtn')
            ->join('pegawai', 'pemeriksaan_ralan.nip', '=', 'pegawai.nik')
            ->where('pemeriksaan_ralan.no_rawat', '=', $noRawat)
            ->orderBy('pemeriksaan_ralan.tgl_perawatan', 'ASC')
            ->orderBy('pemeriksaan_ralan.jam_rawat', 'ASC')
            ->get();
    }

    function getRujukanPoliList(array $filter)
    {
        $query = $this->regPeriksa
            ->select(
                'reg_periksa.no_rawat',
                'reg_periksa.tgl_registrasi',
                'reg_periksa.jam_reg',
                'rujukan_internal_poli.kd_dokter',
                'dokter.nm_dokter',
                'reg_periksa.no_rkm_medis',
                'pasien.nm_pasien',
                'pasien.jk',
                DB::raw('concat(reg_periksa.umurdaftar,\' \',reg_periksa.sttsumur) as umur'),
                'poliklinik.nm_poli',
                'reg_periksa.p_jawab',
                'reg_periksa.almt_pj',
                'reg_periksa.hubunganpj',
                'reg_periksa.stts_daftar',
                'penjab.png_jawab',
                'pasien.no_tlp',
                'reg_periksa.stts',
                'rujukan_internal_poli.kd_poli',
                'reg_periksa.kd_pj',
                DB::raw(
                    'concat(
                        uxui_tindakan_pasien.pemeriksaan,\'-\',
                        uxui_tindakan_pasien.permintaan_lab,\'-\',
                        uxui_tindakan_pasien.resep,\'-\',
                        uxui_tindakan_pasien.resume
                    ) as tindakan_pasien'.
                    (empty($filter["kd_dokter"]) ? ',concat(uxui_tindakan_pasien_perawat.pemeriksaan) as tindakan_pasien_perawat': ''))
            )
            ->join('rujukan_internal_poli', 'rujukan_internal_poli.no_rawat', '=', 'reg_periksa.no_rawat')
            ->join('dokter', 'rujukan_internal_poli.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->join('poliklinik', 'rujukan_internal_poli.kd_poli', '=', 'poliklinik.kd_poli')
            ->leftJoin('uxui_tindakan_pasien', function ($join) {
                $join->on('uxui_tindakan_pasien.no_rawat', '=', 'reg_periksa.no_rawat');
                $join->on('uxui_tindakan_pasien.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis');
                $join->where('uxui_tindakan_pasien.type_akses', '=', 'rp');
            })
            ->join('penjab', 'reg_periksa.kd_pj', '=', 'penjab.kd_pj')
            ->orderBy('rujukan_internal_poli.kd_dokter', 'ASC')
            ->when($filter['city'], function ($query, $filter) {
                $query->where('pasien.kd_kab', '=', $filter);
            })
            ->when($filter['poli'], function ($query, $filter) {
                $query->where('poliklinik.kd_poli', '=', $filter);
            })
            ->when($filter['status'], function ($query, $filter) {
                $query->where('reg_periksa.stts', '=', $filter);
            })
            ->when([$filter['start'], $filter['end']], function ($query, $filter) {
                if ($filter[0] != null) {
                    $query->whereBetween('reg_periksa.tgl_registrasi',  [$filter[0], $filter[1]]);
                }
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

            if(!empty($filter['kd_dokter'])){
                $query->where('dokter.kd_dokter', '=', $filter['kd_dokter']);
            }   
            if(empty($filter['kd_dokter'])){
                $query->leftJoin('uxui_tindakan_pasien_perawat', function ($join) {
                    $join->on('uxui_tindakan_pasien_perawat.no_rawat', '=', 'reg_periksa.no_rawat');
                    $join->on('uxui_tindakan_pasien_perawat.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis');
                    $join->where('uxui_tindakan_pasien_perawat.type_akses', '=', 'rp');
                });
            }

        return $query;
    }
    // function getStatusRujukanList() {
    //     return $this->regPeriksa->getPossibleEnumValues("status_bayar");
    // }
}
