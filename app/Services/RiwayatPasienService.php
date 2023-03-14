<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Models\RegPeriksa;
use App\Models\PemeriksaanRalan;
use App\Models\RawatJlPr;
use App\Models\DiagnosaPasien;
use App\Models\RawatJl;
use App\Models\RawatJlDrPr;
use App\Models\RawatInapDr;
use App\Models\RawatInapDrPr;
use App\Models\DetReturJual;
use App\Models\HasilRadiologi;

use App\Services\GlobalService;
use App\Services\ResumeService;
use App\Services\CpptService;
use App\Services\LaporanOperasiPasienService;

class RiwayatPasienService extends BaseService
{
    protected $pasien;
    protected $regPeriksa;
    protected $pemeriksaanRalan;
    protected $rawatJlPr;
    public function __construct(
        Pasien $pasien,
        RegPeriksa $regPeriksa,
        RawatJlPr $rawatJlPr,
        DiagnosaPasien $diagnosaPasien,
        RawatJl $rawatJl,
        RawatJlDrPr $rawatJlDrPr,
        RawatInapDr $rawatInapDr,
        RawatInapDrPr $rawatInapDrPr,
        DetReturJual $detReturJual,
        HasilRadiologi $hasilRadiologi,

        GlobalService $globalService,
        ResumeService $resumeService,
        CpptService $cpptService,
        LaporanOperasiPasienService $laporanOperasiPasienService
    ){
        parent::__construct();
        $this->pasien = $pasien;
        $this->regPeriksa = $regPeriksa;
        $this->rawatJlPr = $rawatJlPr;
        $this->diagnosaPasien = $diagnosaPasien;
        $this->rawatJl = $rawatJl;
        $this->rawatJlDrPr = $rawatJlDrPr;
        $this->rawatInapDr = $rawatInapDr;
        $this->rawatInapDrPr = $rawatInapDrPr;
        $this->detReturJual = $detReturJual;
        $this->hasilRadiologi = $hasilRadiologi;

        $this->globalService = $globalService;
        $this->resumeService = $resumeService;
        $this->cpptService = $cpptService;
        $this->laporanOperasiPasienService = $laporanOperasiPasienService;
    }
    /**
     * sayuti buat service baru untuk riwayat pasien
     *
     * @return Model
     * @throws conditon
     **/
    public function getResumePasien($noRm, $filter = [])
    {
        return $this->regPeriksa
            ->select('reg_periksa.no_reg', 'reg_periksa.no_rawat', 'reg_periksa.tgl_registrasi', 'reg_periksa.jam_reg', 'reg_periksa.kd_dokter', 'dokter.nm_dokter', 'poliklinik.nm_poli', 'reg_periksa.p_jawab', 'reg_periksa.almt_pj', 'reg_periksa.hubunganpj', 'reg_periksa.biaya_reg', 'reg_periksa.status_lanjut', 'penjab.png_jawab')
            ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->join('penjab', 'reg_periksa.kd_pj', '=', 'penjab.kd_pj')
            ->where([['reg_periksa.stts', '<>', 'Batal'], ['reg_periksa.no_rkm_medis', $noRm]])
            ->when(isset($filter['start_date']), function ($query) use ($filter) {
                $query->whereBetween('reg_periksa.tgl_registrasi', [$filter['start_date'], $filter['end_date']]);
            })
            ->orderBy('reg_periksa.tgl_registrasi', 'DESC')

            ->get();
    }
    public function getDataRiwayat3Pasien($noRm)
    {
        return $this->regPeriksa
            ->select('reg_periksa.no_reg', 'reg_periksa.no_rawat', 'reg_periksa.tgl_registrasi', 'reg_periksa.jam_reg', 'reg_periksa.kd_dokter', 'dokter.nm_dokter', 'poliklinik.nm_poli', 'reg_periksa.p_jawab', 'reg_periksa.almt_pj', 'reg_periksa.hubunganpj', 'reg_periksa.biaya_reg', 'reg_periksa.status_lanjut', 'penjab.png_jawab')
            ->join('dokter', 'reg_periksa.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->join('penjab', 'reg_periksa.kd_pj', '=', 'penjab.kd_pj')
            ->where([['reg_periksa.stts', '<>', 'Batal'], ['reg_periksa.no_rkm_medis', $noRm]])
            ->orderBy('reg_periksa.tgl_registrasi', 'DESC')
            ->limit(3)
            ->get();
    }

    function getDiagnosaPenyakit($noRawat)
    {

        $diagnosaPenyakit = $this->diagnosaPasien->select('diagnosa_pasien.kd_penyakit', 'penyakit.nm_penyakit', 'diagnosa_pasien.status')
            ->join('penyakit', 'diagnosa_pasien.kd_penyakit', '=', 'penyakit.kd_penyakit')
            ->where('diagnosa_pasien.no_rawat', '=', $noRawat)
            ->get();
        return $diagnosaPenyakit;
    }

    function getTindakanRawatJalan($noRawat)
    {
        return $this->rawatJl
            ->select('rawat_jl_dr.kd_jenis_prw', 'jns_perawatan.nm_perawatan', 'dokter.nm_dokter', 'rawat_jl_dr.biaya_rawat', 'rawat_jl_dr.tgl_perawatan', 'rawat_jl_dr.jam_rawat')
            ->join('jns_perawatan', 'rawat_jl_dr.kd_jenis_prw', '=', 'jns_perawatan.kd_jenis_prw')
            ->join('dokter', 'rawat_jl_dr.kd_dokter', '=', 'dokter.kd_dokter')
            ->where('rawat_jl_dr.no_rawat', '=', $noRawat)
            ->orderBy('rawat_jl_dr.tgl_perawatan', 'ASC')
            ->orderBy('rawat_jl_dr.jam_rawat', 'ASC')
            ->get();
    }

    function getTindakanRawatJalanParamedis($noRawat)
    {
        return $this->rawatJlPr
            ->select('rawat_jl_pr.kd_jenis_prw', 'jns_perawatan.nm_perawatan', 'petugas.nama', 'rawat_jl_pr.biaya_rawat', 'rawat_jl_pr.tgl_perawatan', 'rawat_jl_pr.jam_rawat')
            ->join('jns_perawatan', 'rawat_jl_pr.kd_jenis_prw', '=', 'jns_perawatan.kd_jenis_prw')
            ->join('petugas', 'rawat_jl_pr.nip', '=', 'petugas.nip')
            ->where('rawat_jl_pr.no_rawat', '=', $noRawat)
            ->orderBy('rawat_jl_pr.tgl_perawatan', 'ASC')
            ->orderBy('rawat_jl_pr.jam_rawat', 'ASC')
            ->get();
    }

    function getTindakanRawatJalanDokterParamedis($noRawat)
    {
        return $this->rawatJlDrPr
            ->select('rawat_jl_drpr.kd_jenis_prw', 'jns_perawatan.nm_perawatan', 'dokter.nm_dokter', 'petugas.nama', 'rawat_jl_drpr.biaya_rawat', 'rawat_jl_drpr.tgl_perawatan', 'rawat_jl_drpr.jam_rawat')
            ->join('jns_perawatan', 'rawat_jl_drpr.kd_jenis_prw', '=', 'jns_perawatan.kd_jenis_prw')
            ->join('dokter', 'rawat_jl_drpr.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('petugas', 'rawat_jl_drpr.nip', '=', 'petugas.nip')
            ->where('rawat_jl_drpr.no_rawat', '=', $noRawat)
            ->orderBy('rawat_jl_drpr.tgl_perawatan', 'ASC')
            ->orderBy('rawat_jl_drpr.jam_rawat', 'ASC')
            ->get();
    }

    function getTindakanRawatInapParamedis($noRawat)
    {
        return  DB::select("
        select rawat_inap_pr.tgl_perawatan,rawat_inap_pr.jam_rawat,
        rawat_inap_pr.kd_jenis_prw,jns_perawatan_inap.nm_perawatan,
        petugas.nama,rawat_inap_pr.biaya_rawat
        from rawat_inap_pr inner join jns_perawatan_inap on rawat_inap_pr.kd_jenis_prw=jns_perawatan_inap.kd_jenis_prw
        inner join petugas on rawat_inap_pr.nip=petugas.nip where rawat_inap_pr.no_rawat='" . $noRawat . "'");
    }

    function getTindakanRawatInapDokterParamedis($noRawat)
    {
        return $this->rawatInapDrPr
            ->select('rawat_inap_drpr.tgl_perawatan', 'rawat_inap_drpr.jam_rawat', 'rawat_inap_drpr.kd_jenis_prw', 'jns_perawatan_inap.nm_perawatan', 'dokter.nm_dokter', 'petugas.nama', 'rawat_inap_drpr.biaya_rawat')
            ->join('jns_perawatan_inap', 'rawat_inap_drpr.kd_jenis_prw', '=', 'jns_perawatan_inap.kd_jenis_prw')
            ->join('dokter', 'rawat_inap_drpr.kd_dokter', '=', 'dokter.kd_dokter')
            ->join('petugas', 'rawat_inap_drpr.nip', '=', 'petugas.nip')
            ->where('rawat_inap_drpr.no_rawat', '=', $noRawat)
            ->orderBy('rawat_inap_drpr.tgl_perawatan', 'ASC')
            ->orderBy('rawat_inap_drpr.jam_rawat', 'ASC')
            ->get();
    }

    function getPenggunaanKamar($noRawat)
    {
        return DB::select(
            "select kamar_inap.kd_kamar,bangsal.nm_bangsal,kamar_inap.tgl_masuk, kamar_inap.tgl_keluar,
            kamar_inap.stts_pulang,kamar_inap.lama,kamar_inap.jam_masuk,kamar_inap.jam_keluar,
            kamar_inap.ttl_biaya from kamar_inap inner join kamar on kamar_inap.kd_kamar=kamar.kd_kamar
            inner join bangsal on kamar.kd_bangsal=bangsal.kd_bangsal
            where kamar_inap.no_rawat='" . $noRawat . "' order by kamar_inap.tgl_masuk,kamar_inap.jam_masuk
            "
        );
    }

    function getPerencanaanPemulangan($noRawat)
    {
        return DB::select(
            "select perencanaan_pemulangan.no_rawat, perencanaan_pemulangan.rencana_pulang,perencanaan_pemulangan.alasan_masuk,perencanaan_pemulangan.diagnosa_medis,
            perencanaan_pemulangan.pengaruh_ri_pasien_dan_keluarga,perencanaan_pemulangan.keterangan_pengaruh_ri_pasien_dan_keluarga,
            perencanaan_pemulangan.pengaruh_ri_pekerjaan_sekolah,perencanaan_pemulangan.keterangan_pengaruh_ri_pekerjaan_sekolah,
            perencanaan_pemulangan.pengaruh_ri_keuangan,perencanaan_pemulangan.keterangan_pengaruh_ri_keuangan,
            perencanaan_pemulangan.antisipasi_masalah_saat_pulang,perencanaan_pemulangan.keterangan_antisipasi_masalah_saat_pulang,
            perencanaan_pemulangan.bantuan_diperlukan_dalam,perencanaan_pemulangan.keterangan_bantuan_diperlukan_dalam,
            perencanaan_pemulangan.adakah_yang_membantu_keperluan,perencanaan_pemulangan.keterangan_adakah_yang_membantu_keperluan,
            perencanaan_pemulangan.pasien_tinggal_sendiri,perencanaan_pemulangan.keterangan_pasien_tinggal_sendiri,
            perencanaan_pemulangan.pasien_menggunakan_peralatan_medis,perencanaan_pemulangan.keterangan_pasien_menggunakan_peralatan_medis,
            perencanaan_pemulangan.pasien_memerlukan_alat_bantu,perencanaan_pemulangan.keterangan_pasien_memerlukan_alat_bantu,
            perencanaan_pemulangan.memerlukan_perawatan_khusus,perencanaan_pemulangan.keterangan_memerlukan_perawatan_khusus,
            perencanaan_pemulangan.bermasalah_memenuhi_kebutuhan,perencanaan_pemulangan.keterangan_bermasalah_memenuhi_kebutuhan,
            perencanaan_pemulangan.memiliki_nyeri_kronis,perencanaan_pemulangan.keterangan_memiliki_nyeri_kronis,
            perencanaan_pemulangan.memerlukan_edukasi_kesehatan,perencanaan_pemulangan.keterangan_memerlukan_edukasi_kesehatan,
            perencanaan_pemulangan.memerlukan_keterampilkan_khusus,perencanaan_pemulangan.keterangan_memerlukan_keterampilkan_khusus,
            perencanaan_pemulangan.nama_pasien_keluarga,perencanaan_pemulangan.nip,petugas.nama 
            from perencanaan_pemulangan join petugas on perencanaan_pemulangan.nip=petugas.nip 
            where perencanaan_pemulangan.no_rawat='". $noRawat . "' 
            "
        );
    }

    function getOperasiVK($noRawat)
    {
        return DB::select("
        select operasi.tgl_operasi,operasi.jenis_anasthesi,operasi.operator1, operasi.operator2, operasi.operator3, operasi.asisten_operator1,
        operasi.asisten_operator2,operasi.asisten_operator3,operasi.biayaasisten_operator3, operasi.instrumen, operasi.dokter_anak, operasi.perawaat_resusitas,
        operasi.dokter_anestesi, operasi.asisten_anestesi, operasi.asisten_anestesi2,operasi.asisten_anestesi2, operasi.bidan, operasi.bidan2, operasi.bidan3, operasi.perawat_luar, operasi.omloop,
        operasi.omloop2,operasi.omloop3,operasi.omloop4,operasi.omloop5,operasi.dokter_pjanak,operasi.dokter_umum,
        operasi.kode_paket,paket_operasi.nm_perawatan, operasi.biayaoperator1, operasi.biayaoperator2, operasi.biayaoperator3,
        operasi.biayaasisten_operator1, operasi.biayaasisten_operator2, operasi.biayaasisten_operator3, operasi.biayainstrumen,
        operasi.biayadokter_anak, operasi.biayaperawaat_resusitas, operasi.biayadokter_anestesi,
        operasi.biayaasisten_anestesi,operasi.biayaasisten_anestesi2, operasi.biayabidan,operasi.biayabidan2,operasi.biayabidan3, operasi.biayaperawat_luar, operasi.biayaalat,
        operasi.biayasewaok,operasi.akomodasi,operasi.bagian_rs,operasi.biaya_omloop,operasi.biaya_omloop2,operasi.biaya_omloop3,operasi.biaya_omloop4,operasi.biaya_omloop5,
        operasi.biayasarpras,operasi.biaya_dokter_pjanak,operasi.biaya_dokter_umum,
        (operasi.biayaoperator1+operasi.biayaoperator2+operasi.biayaoperator3+
        operasi.biayaasisten_operator1+operasi.biayaasisten_operator2+operasi.biayaasisten_operator3+operasi.biayainstrumen+
        operasi.biayadokter_anak+operasi.biayaperawaat_resusitas+operasi.biayadokter_anestesi+
        operasi.biayaasisten_anestesi+operasi.biayaasisten_anestesi2+operasi.biayabidan+operasi.biayabidan2+operasi.biayabidan3+operasi.biayaperawat_luar+operasi.biayaalat+
        operasi.biayasewaok+operasi.akomodasi+operasi.bagian_rs+operasi.biaya_omloop+operasi.biaya_omloop2+operasi.biaya_omloop3+operasi.biaya_omloop4+operasi.biaya_omloop5+
        operasi.biayasarpras+operasi.biaya_dokter_pjanak+operasi.biaya_dokter_umum) as total,
        operator1.nm_dokter as namaoperator1,operator2.nm_dokter as namaoperator2,operator3.nm_dokter as namaoperator3,
        asisten_operator1.nama as namaasisten_operator1, asisten_operator2.nama as namaasisten_operator2,asisten_operator3.nama as namaasisten_operator3,
        instrumen.nama as namainstrumen,dokter_anak.nm_dokter as namadokter_anak,perawaat_resusitas.nama as namaperawaat_resusitas,
        dokter_anestesi.nm_dokter as namadokter_anestesi,asisten_anestesi.nama as namaasisten_anestesi,asisten_anestesi2.nama as namaasisten_anestesi2,
        bidan.nama as namabidan,bidan2.nama as namabidan2,bidan3.nama as namabidan3,perawat_luar.nama as namaperawat_luar,
        omloop.nama as namaomloop,omloop2.nama as namaomloop2,omloop3.nama as namaomloop3,omloop4.nama as namaomloop4,omloop5.nama as namaomloop5,
        dokter_pjanak.nm_dokter as namadokter_pjanak,dokter_umum.nm_dokter as namadokter_umum
        from operasi inner join paket_operasi on operasi.kode_paket=paket_operasi.kode_paket
        inner join dokter as operator1 on operator1.kd_dokter=operasi.operator1
        inner join dokter as operator2 on operator2.kd_dokter=operasi.operator2
        inner join dokter as operator3 on operator3.kd_dokter=operasi.operator3
        inner join dokter as dokter_anak on dokter_anak.kd_dokter=operasi.dokter_anak
        inner join dokter as dokter_anestesi on dokter_anestesi.kd_dokter=operasi.dokter_anestesi
        inner join dokter as dokter_pjanak on dokter_pjanak.kd_dokter=operasi.dokter_pjanak
        inner join dokter as dokter_umum on dokter_umum.kd_dokter=operasi.dokter_umum
        inner join petugas as asisten_operator1 on asisten_operator1.nip=operasi.asisten_operator1
        inner join petugas as asisten_operator2 on asisten_operator2.nip=operasi.asisten_operator2
        inner join petugas as asisten_operator3 on asisten_operator3.nip=operasi.asisten_operator3
        inner join petugas as instrumen on instrumen.nip=operasi.instrumen
        inner join petugas as perawaat_resusitas on perawaat_resusitas.nip=operasi.perawaat_resusitas
        inner join petugas as asisten_anestesi on asisten_anestesi.nip=operasi.asisten_anestesi
        inner join petugas as asisten_anestesi2 on asisten_anestesi2.nip=operasi.asisten_anestesi2
        inner join petugas as bidan on bidan.nip=operasi.bidan
        inner join petugas as bidan2 on bidan2.nip=operasi.bidan2
        inner join petugas as bidan3 on bidan3.nip=operasi.bidan3
        inner join petugas as omloop on omloop.nip=operasi.omloop
        inner join petugas as omloop2 on omloop2.nip=operasi.omloop2
        inner join petugas as omloop3 on omloop3.nip=operasi.omloop3
        inner join petugas as omloop4 on omloop4.nip=operasi.omloop4
        inner join petugas as omloop5 on omloop5.nip=operasi.omloop5
        inner join petugas as perawat_luar on perawat_luar.nip=operasi.perawat_luar
        where operasi.no_rawat='" . $noRawat . "' order by operasi.tgl_operasi
        ");
    }

    function getPemeriksaanRadiologi($noRawat)
    {
        return DB::select("
        select periksa_radiologi.tgl_periksa,periksa_radiologi.jam,periksa_radiologi.kd_jenis_prw,
        jns_perawatan_radiologi.nm_perawatan,petugas.nama,periksa_radiologi.biaya,periksa_radiologi.dokter_perujuk,
        dokter.nm_dokter,concat(
       if(periksa_radiologi.proyeksi<>'',concat('Proyeksi : ',periksa_radiologi.proyeksi,', '),''),
       if(periksa_radiologi.kV<>'',concat('kV : ',periksa_radiologi.kV,', '),''),
       if(periksa_radiologi.mAS<>'',concat('mAS : ',periksa_radiologi.mAS,', '),''),
       if(periksa_radiologi.FFD<>'',concat('FFD : ',periksa_radiologi.FFD,', '),''),
       if(periksa_radiologi.BSF<>'',concat('BSF : ',periksa_radiologi.BSF,', '),''),
       if(periksa_radiologi.inak<>'',concat('Inak : ',periksa_radiologi.inak,', '),''),
       if(periksa_radiologi.jml_penyinaran<>'',concat('Jml Penyinaran : ',periksa_radiologi.jml_penyinaran,', '),''),
       if(periksa_radiologi.dosis<>'',concat('Dosis Radiasi : ',periksa_radiologi.dosis),'')) as proyeksi
        from periksa_radiologi inner join jns_perawatan_radiologi on periksa_radiologi.kd_jenis_prw=jns_perawatan_radiologi.kd_jenis_prw
        inner join petugas on periksa_radiologi.nip=petugas.nip inner join dokter on periksa_radiologi.kd_dokter=dokter.kd_dokter
        where periksa_radiologi.no_rawat='" . $noRawat . "' order by periksa_radiologi.tgl_periksa,periksa_radiologi.jam
        ");
    }

    public function getPeriksaLab($noRawat, &$totalBiaya)
    {
        $periksaLab = DB::select("
            select
                periksa_lab.tgl_periksa,
                periksa_lab.jam
            from
                periksa_lab
            where
                periksa_lab.kategori = 'PK'
                and periksa_lab.no_rawat = ?
            group by
                concat(periksa_lab.no_rawat, periksa_lab.tgl_periksa, periksa_lab.jam)
            order by
                periksa_lab.tgl_periksa,
                periksa_lab.jam", [$noRawat]);

        foreach ($periksaLab as $index => $periksa) {
            $jenisPerawatan = DB::select("
                select
                    periksa_lab.kd_jenis_prw,
                    jns_perawatan_lab.nm_perawatan,
                    petugas.nama,
                    periksa_lab.biaya,
                    periksa_lab.dokter_perujuk,
                    dokter.nm_dokter
                from
                    periksa_lab
                inner join jns_perawatan_lab on
                    periksa_lab.kd_jenis_prw = jns_perawatan_lab.kd_jenis_prw
                inner join petugas on
                    periksa_lab.nip = petugas.nip
                inner join dokter on
                    periksa_lab.kd_dokter = dokter.kd_dokter
                where
                    periksa_lab.kategori = 'PK'
                    and periksa_lab.no_rawat = ?
                    and periksa_lab.tgl_periksa = ?
                    and periksa_lab.jam = ?
                    ", [$noRawat, $periksa->tgl_periksa, $periksa->jam]);

            $periksaLab[$index]->jenis = $jenisPerawatan;

            foreach ($jenisPerawatan as $index2 => $jenis) {
                $totalBiaya += $jenis->biaya;
                $templateLaborat = DB::select("
                    select
                        template_laboratorium.Pemeriksaan,
                        detail_periksa_lab.nilai,
                        template_laboratorium.satuan,
                        detail_periksa_lab.nilai_rujukan,
                        detail_periksa_lab.biaya_item,
                        detail_periksa_lab.keterangan
                    from
                        detail_periksa_lab
                    inner join template_laboratorium on
                        detail_periksa_lab.id_template = template_laboratorium.id_template
                    where
                        detail_periksa_lab.no_rawat = ?
                        and detail_periksa_lab.kd_jenis_prw = ?
                        and detail_periksa_lab.tgl_periksa = ?
                        and detail_periksa_lab.jam = ?
                    order by
                        detail_periksa_lab.kd_jenis_prw,
                        template_laboratorium.urut
                    ", [$noRawat, $jenis->kd_jenis_prw, $periksa->tgl_periksa, $periksa->jam]);

                foreach ($templateLaborat as $template) {
                    $totalBiaya += $template->biaya_item;
                }
                $jenisPerawatan[$index2]->template_labor = $templateLaborat;
            }

            $saranKesan = DB::select("
                select
                    saran,
                    kesan
                from
                    saran_kesan_lab
                where
                    no_rawat = ?
                    and tgl_periksa = ?
                    and jam = ?
            ", [$noRawat, $periksa->tgl_periksa, $periksa->jam]);
            $periksaLab[$index]->saran_kesan = $saranKesan;
        }

        return $periksaLab;
    }

    public function getPeriksaLab2($noRawat, &$totalBiaya)
    {
        $periksaLab2 = DB::select("
            select
                periksa_lab.tgl_periksa,
                periksa_lab.jam,
                periksa_lab.kd_jenis_prw,
                jns_perawatan_lab.nm_perawatan,
                petugas.nama,
                periksa_lab.biaya,
                periksa_lab.dokter_perujuk,
                dokter.nm_dokter
            from
                periksa_lab
            inner join jns_perawatan_lab on
                periksa_lab.kd_jenis_prw = jns_perawatan_lab.kd_jenis_prw
            inner join petugas on
                periksa_lab.nip = petugas.nip
            inner join dokter on
                periksa_lab.kd_dokter = dokter.kd_dokter
            where
                periksa_lab.kategori = 'PA'
                and periksa_lab.no_rawat = ?
            order by
                periksa_lab.tgl_periksa,
                periksa_lab.jam
                ", [$noRawat]);

        foreach ($periksaLab2 as $index => $periksa) {
            $totalBiaya += $periksa->biaya;

            $detail = DB::select("
                select
                    diagnosa_klinik,
                    makroskopik,
                    mikroskopik,
                    kesimpulan,
                    kesan
                from
                    detail_periksa_labpa
                where
                    no_rawat = ?
                    and kd_jenis_prw = ?
                    and tgl_periksa = ?
                    and jam = ?
            ", [$noRawat, $periksa->kd_jenis_prw, $periksa->tgl_periksa, $periksa->jam]);

            $isiDetail = [];
            if (!empty($detail)) {
                $isiDetail = $detail[0];

                $file = DB::select("
                select
                    photo
                from
                    detail_periksa_labpa_gambar
                where
                    no_rawat = ?
                    and kd_jenis_prw = ?
                    and tgl_periksa = ?
                    and jam = ?
                ", [$noRawat, $periksa->kd_jenis_prw, $periksa->tgl_periksa, $periksa->jam]);

                $filePath = null;
                if (!empty($file)) {
                    $filename = !empty($file) ? $file[0]->photo : '';
                    $filePath = env('HYBRIDWEB_HOST') . "/" . env('HYBRIDWEB_FOLDER') . "/labpa/" . $filename;
                }
                $isiDetail->file = $filePath;
            }
            $periksaLab2[$index]->detail = $isiDetail;
        }

        return $periksaLab2;
    }

    function getPemberianObat($noRawat, &$totalBiaya)
    {
        $pemberianObat =  DB::select("
            select
                detail_pemberian_obat.tgl_perawatan,
                detail_pemberian_obat.jam,
                databarang.kode_sat,
                detail_pemberian_obat.kode_brng,
                detail_pemberian_obat.jml,
                detail_pemberian_obat.total,
                databarang.nama_brng
            from
                detail_pemberian_obat
            inner join databarang on
                detail_pemberian_obat.kode_brng = databarang.kode_brng
            where
                detail_pemberian_obat.no_rawat = ?
            order by
                detail_pemberian_obat.tgl_perawatan,
                detail_pemberian_obat.jam
        ", [$noRawat]);

        foreach ($pemberianObat as $index => $obat) {
            $totalBiaya += $obat->total;
            $aturanPakai = DB::select("
                select
                    aturan
                from
                    aturan_pakai
                where
                    tgl_perawatan = ?
                    and jam = ?
                    and no_rawat = ?
                    and kode_brng = ?
            ", [$obat->tgl_perawatan, $obat->jam, $noRawat, $obat->kode_brng]);
            $aturan = null;
            if (!empty($aturanPakai)) {
                $aturan = $aturanPakai[0]->aturan;
            }
            $pemberianObat[$index]->aturan_pakai = $aturan;
        }

        return $pemberianObat;
    }

    function getReturObat($params)
    {
        $query = $this->detReturJual
            ->select('databarang.kode_brng','databarang.nama_brng','detreturjual.kode_sat','detreturjual.h_retur',DB::raw('(detreturjual.jml_retur * -1) as jumlah'),DB::raw('(detreturjual.subtotal * -1) as total'))
            ->join('databarang','detreturjual.kode_brng','=','databarang.kode_brng')
            ->join('returjual','returjual.no_retur_jual','=','detreturjual.no_retur_jual')
            ->orderBy('databarang.nama_brng','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }

        return $query->get();
    }

    function getPenggunaanObatOperasi($noRawat)
    {
        return DB::select("
            select beri_obat_operasi.tanggal,beri_obat_operasi.kd_obat,beri_obat_operasi.hargasatuan,obatbhp_ok.kode_sat,beri_obat_operasi.jumlah, obatbhp_ok.nm_obat,(beri_obat_operasi.hargasatuan*beri_obat_operasi.jumlah) as total
            from beri_obat_operasi inner join obatbhp_ok  on  beri_obat_operasi.kd_obat=obatbhp_ok.kd_obat
            where beri_obat_operasi.no_rawat='" . $noRawat . "' order by beri_obat_operasi.tanggal
        ");
    }

    function getResepPulang($noRawat)
    {
        return DB::select("
            select resep_pulang.kode_brng,databarang.nama_brng,resep_pulang.dosis,resep_pulang.jml_barang,databarang.kode_sat,resep_pulang.dosis,resep_pulang.total from resep_pulang inner join databarang
            on resep_pulang.kode_brng=databarang.kode_brng
            where resep_pulang.no_rawat='" . $noRawat . "'
            order by databarang.nama_brng
        ");
    }

    function getTambahanBiaya($noRawat)
    {
        return DB::select("
            select nama_biaya, besar_biaya from tambahan_biaya where no_rawat=" . $noRawat . " order by nama_biaya
        ");
    }

    function getPotonganBiaya($noRawat)
    {
        return DB::select("
        select nama_pengurangan, (-1*besar_pengurangan) as besar_pengurangan from pengurangan_biaya where no_rawat=" . $noRawat . " order by nama_pengurangan
        ");
    }

    function getTindakanRawatInapDokter($params)
    {
        $query = $this->rawatInapDr
            ->select('rawat_inap_dr.tgl_perawatan','rawat_inap_dr.jam_rawat','rawat_inap_dr.kd_jenis_prw','jns_perawatan_inap.nm_perawatan','dokter.nm_dokter','rawat_inap_dr.biaya_rawat')
            ->join('jns_perawatan_inap','rawat_inap_dr.kd_jenis_prw','=','jns_perawatan_inap.kd_jenis_prw')
            ->join('dokter','rawat_inap_dr.kd_dokter','=','dokter.kd_dokter')
            ->orderBy('rawat_inap_dr.tgl_perawatan','ASC')
            ->orderBy('rawat_inap_dr.jam_rawat','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }

        return $query->get();
    }

    public function reportPerawatan(string $noRm, bool $isAll = false,$type_akses)
    {
        $totalBiaya = 0;
        $additionalQuery = 'desc';
        if (!$isAll) {
            $additionalQuery = ' desc limit 3';
        }
        // =========================
        // Data Rawat
        // =========================
        $dataRawat = DB::select(
            "
            select
                reg_periksa.no_reg,
                reg_periksa.no_rawat,
                reg_periksa.tgl_registrasi,
                reg_periksa.jam_reg,
                reg_periksa.kd_dokter,
                dokter.nm_dokter,
                poliklinik.nm_poli,
                reg_periksa.p_jawab,
                reg_periksa.almt_pj,
                reg_periksa.hubunganpj,
                reg_periksa.biaya_reg,
                reg_periksa.status_lanjut,
                penjab.png_jawab
            from
                reg_periksa
            inner join dokter on
                reg_periksa.kd_dokter = dokter.kd_dokter
            inner join poliklinik on
                reg_periksa.kd_poli = poliklinik.kd_poli
            inner join penjab on
                reg_periksa.kd_pj = penjab.kd_pj
            where
                reg_periksa.stts <> 'Batal'
                and reg_periksa.no_rkm_medis = ?
            order by
                reg_periksa.tgl_registrasi " . $additionalQuery,
            [$noRm]
        );

        $dataPasien = DB::select ("
            SELECT
                pasien.no_rkm_medis,
                pasien.nm_pasien,
                pasien.jk,
                pasien.tmp_lahir,
                pasien.tgl_lahir,
                pasien.agama,
                bahasa_pasien.nama_bahasa,
                cacat_fisik.nama_cacat,
                pasien.gol_darah,
                pasien.nm_ibu,
                pasien.stts_nikah,
                pasien.pnd,
                concat( pasien.alamat, ', ', kelurahan.nm_kel, ', ', kecamatan.nm_kec, ', ', kabupaten.nm_kab ) AS alamat,
                pasien.pekerjaan
            FROM
                pasien
                INNER JOIN bahasa_pasien ON bahasa_pasien.id = pasien.bahasa_pasien
                INNER JOIN cacat_fisik ON cacat_fisik.id = pasien.cacat_fisik
                INNER JOIN kelurahan ON pasien.kd_kel = kelurahan.kd_kel
                INNER JOIN kecamatan ON pasien.kd_kec = kecamatan.kd_kec
                INNER JOIN kabupaten ON pasien.kd_kab = kabupaten.kd_kab
            WHERE
                pasien.no_rkm_medis =?", [$noRm]);

        // child tiap data rawat
        $idx = 1;
        foreach ($dataRawat as $index => $rawat) {

            $dataRawat[$index]->urutan = $idx;
            $idx++;

            // =========================
            // Poliklinik
            // =========================
            $poliRujukanData = DB::select("
                select
                    poliklinik.nm_poli,
                    dokter.nm_dokter
                from
                    rujukan_internal_poli
                inner join poliklinik on
                    rujukan_internal_poli.kd_poli = poliklinik.kd_poli
                inner join dokter on
                    rujukan_internal_poli.kd_dokter = dokter.kd_dokter
                where
                    no_rawat = ?", [$rawat->no_rawat]);

            $dokterRujukan = '';
            $poliRujukan = '';
            foreach ($poliRujukanData as $poli) {
                $poliRujukan .= ', ' . $poli->nm_poli;
                $dokterRujukan .= ', ' . $poli->nm_dokter;
            }

            $dataRawat[$index]->dokter_rujukan = $dokterRujukan;
            $dataRawat[$index]->poli_rujukan = $poliRujukan;

            $dpjpRanap = DB::select("
                select
                    dokter.nm_dokter
                from dpjp_ranap
                inner join dokter on dpjp_ranap.kd_dokter=dokter.kd_dokter
                where dpjp_ranap.no_rawat = ?", [$rawat->no_rawat]
            );

            $dpjp_list=[];
            if(!empty($dpjpRanap)){
                foreach($dpjpRanap as $key =>$value){
                    $dpjp_list[]=($key+1).'.'.$value->nm_dokter;
                }
            }

            $dpjp_list=implode(', ',$dpjp_list);

            $dataRawat[$index]->dpjp_dokter = $dpjp_list;

            $triasePrimer = DB::select(
                "
            SELECT
                data_triase_igdprimer.keluhan_utama,
                data_triase_igdprimer.kebutuhan_khusus,
                data_triase_igdprimer.catatan,
                data_triase_igdprimer.plan,
                data_triase_igdprimer.tanggaltriase,
                data_triase_igdprimer.nik,
                data_triase_igd.tekanan_darah,
                data_triase_igd.nadi,
                data_triase_igd.pernapasan,
                data_triase_igd.suhu,
                data_triase_igd.saturasi_o2,
                data_triase_igd.nyeri,
                data_triase_igd.cara_masuk,
                data_triase_igd.alat_transportasi,
                data_triase_igd.alasan_kedatangan,
                data_triase_igd.keterangan_kedatangan,
                data_triase_igd.kode_kasus,
                master_triase_macam_kasus.macam_kasus,
                pegawai.nama
            FROM
                data_triase_igdprimer
                INNER JOIN data_triase_igd ON data_triase_igd.no_rawat = data_triase_igdprimer.no_rawat
                INNER JOIN master_triase_macam_kasus ON data_triase_igd.kode_kasus = master_triase_macam_kasus.kode_kasus
                INNER JOIN pegawai ON data_triase_igdprimer.nik = data_triase_igdprimer.nik
            WHERE
                data_triase_igd.no_rawat = ?",
                [$rawat->no_rawat]
            );

            $dataRawat[$index]->triase_primer = $triasePrimer ? $triasePrimer[0] : [];

            if (!empty($triasePrimer)) {

                $masterTriaseSkala1 = DB::select(
                    "
                    SELECT
                        master_triase_pemeriksaan.kode_pemeriksaan,
                        master_triase_pemeriksaan.nama_pemeriksaan
                    FROM
                        master_triase_pemeriksaan
                        INNER JOIN master_triase_skala1 ON master_triase_pemeriksaan.kode_pemeriksaan = master_triase_skala1.kode_pemeriksaan
                        INNER JOIN data_triase_igddetail_skala1 ON master_triase_skala1.kode_skala1 = data_triase_igddetail_skala1.kode_skala1
                    WHERE
                        data_triase_igddetail_skala1.no_rawat = ?
                    GROUP BY
                        master_triase_pemeriksaan.kode_pemeriksaan
                    ORDER BY
                        master_triase_pemeriksaan.kode_pemeriksaan
                    ",
                    [$rawat->no_rawat]
                );

                $dataRawat[$index]->triase_primer->master_triase_skala_1 = $masterTriaseSkala1;

                // =========================
                // Triase skala 1
                // =========================
                foreach ($masterTriaseSkala1 as $index1 => $masterTriase) {
                    $triaseSkala1 = DB::select(
                        "
                        SELECT
                            master_triase_skala1.pengkajian_skala1
                        FROM
                            master_triase_skala1
                            INNER JOIN data_triase_igddetail_skala1 ON master_triase_skala1.kode_skala1 = data_triase_igddetail_skala1.kode_skala1
                        WHERE
                            master_triase_skala1.kode_pemeriksaan = ?
                            AND data_triase_igddetail_skala1.no_rawat = ?
                        ORDER BY
                            data_triase_igddetail_skala1.kode_skala1",
                        [$masterTriase->kode_pemeriksaan, $rawat->no_rawat]
                    );

                    $dataRawat[$index]->triase_primer->master_triase_skala_1[$index1]->triase_skala_1 = $triaseSkala1;
                }
                // =========================
                // Master Triase skala 2
                // =========================

                $masterTriaseSkala2 = DB::select(
                    "
                        SELECT
                            master_triase_pemeriksaan.kode_pemeriksaan,
                            master_triase_pemeriksaan.nama_pemeriksaan
                        FROM
                            master_triase_pemeriksaan
                            INNER JOIN master_triase_skala2 ON master_triase_pemeriksaan.kode_pemeriksaan = master_triase_skala2.kode_pemeriksaan
                            INNER JOIN data_triase_igddetail_skala2 ON master_triase_skala2.kode_skala2 = data_triase_igddetail_skala2.kode_skala2
                        WHERE
                            data_triase_igddetail_skala2.no_rawat = ?
                        GROUP BY
                            master_triase_pemeriksaan.kode_pemeriksaan
                        ORDER BY
                            master_triase_pemeriksaan.kode_pemeriksaan",
                    [$rawat->no_rawat]
                );

                $dataRawat[$index]->triase_primer->master_triase_skala_2 = $masterTriaseSkala2;

                // =========================
                // Triase skala 2
                // =========================
                foreach ($masterTriaseSkala2 as $index2 => $masterTriase) {
                    $triaseSkala2 = DB::select(
                        "
                        SELECT
                            master_triase_skala2.pengkajian_skala2
                        FROM
                            master_triase_skala2
                            INNER JOIN data_triase_igddetail_skala2 ON master_triase_skala2.kode_skala2 = data_triase_igddetail_skala2.kode_skala2
                        WHERE
                            master_triase_skala2.kode_pemeriksaan = ?
                            AND data_triase_igddetail_skala2.no_rawat = ?
                        ORDER BY
                            data_triase_igddetail_skala2.kode_skala2",
                        [$masterTriase->kode_pemeriksaan, $rawat->no_rawat]
                    );

                    $dataRawat[$index]->triase_primer->master_triase_skala_2[$index2]->triase_skala_2 = $triaseSkala2;
                }
            }

            $triaseSekunder = DB::select(
                "
                SELECT
                    data_triase_igdsekunder.anamnesa_singkat,
                    data_triase_igdsekunder.catatan,
                    data_triase_igdsekunder.plan,
                    data_triase_igdsekunder.tanggaltriase,
                    data_triase_igdsekunder.nik,
                    data_triase_igd.tekanan_darah,
                    data_triase_igd.nadi,
                    data_triase_igd.pernapasan,
                    data_triase_igd.suhu,
                    data_triase_igd.saturasi_o2,
                    data_triase_igd.nyeri,
                    data_triase_igd.cara_masuk,
                    data_triase_igd.alat_transportasi,
                    data_triase_igd.alasan_kedatangan,
                    data_triase_igd.keterangan_kedatangan,
                    data_triase_igd.kode_kasus,
                    master_triase_macam_kasus.macam_kasus,
                    pegawai.nama
                FROM
                    data_triase_igdsekunder
                    INNER JOIN data_triase_igd ON data_triase_igd.no_rawat = data_triase_igdsekunder.no_rawat
                    INNER JOIN master_triase_macam_kasus ON data_triase_igd.kode_kasus = master_triase_macam_kasus.kode_kasus
                    INNER JOIN pegawai ON data_triase_igdsekunder.nik = pegawai.nik
                WHERE
                    data_triase_igd.no_rawat = ?
                ",
                [$rawat->no_rawat]
            );
            $dataRawat[$index]->triase_sekunder = $triaseSekunder ? $triaseSekunder[0] : [];

            if (!empty($triaseSekunder)) {
                // =========================
                // Master Triase skala 3
                // =========================
                $masterTriaseSkala3 = DB::select("
                    select
                        master_triase_pemeriksaan.kode_pemeriksaan,
                        master_triase_pemeriksaan.nama_pemeriksaan
                    from
                        master_triase_pemeriksaan
                    inner join master_triase_skala3 on
                        master_triase_pemeriksaan.kode_pemeriksaan = master_triase_skala3.kode_pemeriksaan
                    inner join data_triase_igddetail_skala3 on
                        master_triase_skala3.kode_skala3 = data_triase_igddetail_skala3.kode_skala3
                    where
                        data_triase_igddetail_skala3.no_rawat = ?
                    group by
                        master_triase_pemeriksaan.kode_pemeriksaan
                    order by
                        master_triase_pemeriksaan.kode_pemeriksaan", [$rawat->no_rawat]);

                $dataRawat[$index]->triase_sekunder->master_triase_skala_3 = $masterTriaseSkala3;

                // =========================
                // Triase skala 3
                // =========================
                foreach ($masterTriaseSkala3 as $index3 => $masterTriase) {
                    $triaseSkala3 = DB::select("
                        select
                            master_triase_skala3.pengkajian_skala3
                        from
                            master_triase_skala3
                        inner join data_triase_igddetail_skala3 on
                            master_triase_skala3.kode_skala3 = data_triase_igddetail_skala3.kode_skala3
                        where
                            master_triase_skala3.kode_pemeriksaan = ?
                            and data_triase_igddetail_skala3.no_rawat = ?
                        order by
                            data_triase_igddetail_skala3.kode_skala3", [$masterTriase->kode_pemeriksaan, $rawat->no_rawat]);

                    $dataRawat[$index]->triase_sekunder->master_triase_skala_3[$index3]->triase_skala_3 = $triaseSkala3;
                }

                // =========================
                // Master Triase skala 4
                // =========================
                $masterTriaseSkala4 = DB::select(
                    "select
                        master_triase_pemeriksaan.kode_pemeriksaan,
                        master_triase_pemeriksaan.nama_pemeriksaan
                    from
                        master_triase_pemeriksaan
                    inner join master_triase_skala4 on
                        master_triase_pemeriksaan.kode_pemeriksaan = master_triase_skala4.kode_pemeriksaan
                    inner join data_triase_igddetail_skala4 on
                        master_triase_skala4.kode_skala4 = data_triase_igddetail_skala4.kode_skala4
                    where
                        data_triase_igddetail_skala4.no_rawat = ?
                    group by
                        master_triase_pemeriksaan.kode_pemeriksaan
                    order by
                        master_triase_pemeriksaan.kode_pemeriksaan",
                    [$rawat->no_rawat]
                );
                $dataRawat[$index]->triase_sekunder->master_triase_skala_4 = $masterTriaseSkala4;

                // =========================
                // Triase skala 4
                // =========================
                foreach ($masterTriaseSkala4 as $index4 => $masterTriase) {
                    $triaseSkala4 = DB::select("
                        select
                            master_triase_skala4.pengkajian_skala4
                        from
                            master_triase_skala4
                        inner join data_triase_igddetail_skala4 on
                            master_triase_skala4.kode_skala4 = data_triase_igddetail_skala4.kode_skala4
                        where
                            master_triase_skala4.kode_pemeriksaan = ?
                            and data_triase_igddetail_skala4.no_rawat = ?
                        order by
                            data_triase_igddetail_skala4.kode_skala4", [$masterTriase->kode_pemeriksaan, $rawat->no_rawat]);

                    $dataRawat[$index]->triase_sekunder->master_triase_skala_4[$index4]->triase_skala_4 = $triaseSkala4;
                }

                // =========================
                // Master Triase skala 5
                // =========================
                $masterTriaseSkala5 = DB::select(
                    "select
                        master_triase_pemeriksaan.kode_pemeriksaan,
                        master_triase_pemeriksaan.nama_pemeriksaan
                    from
                        master_triase_pemeriksaan
                    inner join master_triase_skala5 on
                        master_triase_pemeriksaan.kode_pemeriksaan = master_triase_skala5.kode_pemeriksaan
                    inner join data_triase_igddetail_skala5 on
                        master_triase_skala5.kode_skala5 = data_triase_igddetail_skala5.kode_skala5
                    where
                        data_triase_igddetail_skala5.no_rawat = ?
                    group by
                        master_triase_pemeriksaan.kode_pemeriksaan
                    order by
                        master_triase_pemeriksaan.kode_pemeriksaan",
                    [$rawat->no_rawat]
                );
                $dataRawat[$index]->triase_sekunder->master_triase_skala_5 = $masterTriaseSkala5;

                // =========================
                // Triase skala 5
                // =========================
                foreach ($masterTriaseSkala5 as $index5 => $masterTriase) {
                    $triaseSkala5 = DB::select("
                        select
                            master_triase_skala5.pengkajian_skala5
                        from
                            master_triase_skala5
                        inner join data_triase_igddetail_skala5 on
                            master_triase_skala5.kode_skala5 = data_triase_igddetail_skala5.kode_skala5
                        where
                            master_triase_skala5.kode_pemeriksaan = ?
                            and data_triase_igddetail_skala5.no_rawat = ?
                        order by
                            data_triase_igddetail_skala5.kode_skala5", [$masterTriase->kode_pemeriksaan, $rawat->rawat]);

                    $dataRawat[$index]->triase_sekunder->master_triase_skala_5[$index5]->triase_skala_5 = $triaseSkala5;
                }
            }
            $penilaianKeperawatanRalanData = $this->getPenilaianKeperawatanRalan([
                "no_rawat" =>$rawat->no_rawat
            ]);
            $penilaianKeperawatan =  $penilaianKeperawatanRalanData['penilaian'] ;

            $dataRawat[$index]->penilaian_keperawatan = $penilaianKeperawatan;

            foreach ($penilaianKeperawatan as $index0 => $penilaian) {
                $masalahKeperawatan = !empty($penilaianKeperawatanRalanData['masalah']) ? $penilaianKeperawatanRalanData['masalah'] : [];
                $dataRawat[$index]->penilaian_keperawatan[$index0]->masalah_keperawatan = $masalahKeperawatan;
            }

            // =========================
            // Awal Keperawatan Rawat Jalan Gigi & Mulut
            // =========================
            $penilaian_keperawatan_ralan_gigi_data = $this->getPenilaianKeperawatanGigi([
                "no_rawat" =>$rawat->no_rawat
            ]);
            $penilaian_keperawatan_ralan_gigi = $penilaian_keperawatan_ralan_gigi_data['penilaian'];
            $dataRawat[$index]->penilaian_keperawatan_ralan_gigi = $penilaian_keperawatan_ralan_gigi;
            foreach ($penilaian_keperawatan_ralan_gigi as $index0 => $penilaian) {
                $masalahKeperawatanGigi =  $penilaian_keperawatan_ralan_gigi_data["masalah"] ;
                $dataRawat[$index]->penilaian_keperawatan_ralan_gigi[$index0]->masalah_keperawatan = $masalahKeperawatanGigi;
            }

            // =========================
            // Awal Keperawatan Rawat Jalan Psikiatri
            // =========================
            $penilaian_awal_keperawatan_ralan_psikiatri_data = $this->getPenilaianKeperawatanPsikiatri([
                "no_rawat" =>$rawat->no_rawat,
                "no_rm" => $noRm
            ]);
            $penilaian_awal_keperawatan_ralan_psikiatri = $penilaian_awal_keperawatan_ralan_psikiatri_data['penilaian'];
            $dataRawat[$index]->penilaian_awal_keperawatan_ralan_psikiatri = $penilaian_awal_keperawatan_ralan_psikiatri;
            foreach ($penilaian_awal_keperawatan_ralan_psikiatri as $index0 => $penilaian) {
                $masalahKeperawatanPsikiatri = $penilaian_awal_keperawatan_ralan_psikiatri_data['masalah'];

                $dataRawat[$index]->penilaian_awal_keperawatan_ralan_psikiatri[$index0]->masalah_keperawatan = $masalahKeperawatanPsikiatri;
            }


            // =========================
            // Awal Keperawatan Rawat Jalan Bayi
            // =========================
            $penilaian_keperawatan_ralan_bayi_data = $this->getPenilaianKeperawatanBayi([
                "no_rawat" =>$rawat->no_rawat,
                "no_rm" => $noRm
            ]);
            $penilaian_keperawatan_ralan_bayi = $penilaian_keperawatan_ralan_bayi_data['penilaian'];
            $dataRawat[$index]->penilaian_keperawatan_ralan_bayi = $penilaian_keperawatan_ralan_bayi;


            foreach ($penilaian_keperawatan_ralan_bayi as $index0 => $penilaian) {
                $masalahKeperawatanBayi = $penilaian_keperawatan_ralan_bayi_data['masalah'];

                $riwayat_imunisasi = $penilaian_keperawatan_ralan_bayi_data['imunisasi'];

                $dataRawat[$index]->penilaian_keperawatan_ralan_bayi[$index0]->riwayat_imunisasi = $riwayat_imunisasi;
                $dataRawat[$index]->penilaian_keperawatan_ralan_bayi[$index0]->masalah_keperawatan = $masalahKeperawatanBayi;
            }

            // =========================
            // Awal Keperawatan Rawat Jalan Kandungan
            // =========================
            $penilaian_keperawatan_ralan_kandungan_data = $this->getPenilaianKeperawatanRalanKandungan([
                "no_rawat" => $rawat->no_rawat,
                "no_rm" => $noRm
            ]);
            $penilaian_keperawatan_ralan_kandungan = $penilaian_keperawatan_ralan_kandungan_data['penilaian'];
            $dataRawat[$index]->penilaian_keperawatan_ralan_kandungan = $penilaian_keperawatan_ralan_kandungan;

            foreach ($penilaian_keperawatan_ralan_kandungan as $index0 => $penilaian) {
                $riwayat_persalinan_pasien = $penilaian_keperawatan_ralan_kandungan_data['persalinan'];
                $dataRawat[$index]->penilaian_keperawatan_ralan_kandungan[$index0]->riwayat_persalinan_pasien = $riwayat_persalinan_pasien;
            }


            // =========================
            // Awal Keperawatan Rawat Inap Kandungan
            // =========================
            $penilaian_keperawatan_ranap_kandungan_data = $this->getPenilaianKeperawatanRanapKandungan([
                "no_rawat" => $rawat->no_rawat,
                "no_rm" => $noRm
            ]);
           $penilaian_keperawatan_ranap_kandungan = $penilaian_keperawatan_ranap_kandungan_data['penilaian'];
            $dataRawat[$index]->penilaian_keperawatan_ranap_kandungan = $penilaian_keperawatan_ranap_kandungan;
            foreach ($penilaian_keperawatan_ranap_kandungan as $index0 => $penilaian) {
                $riwayat_persalinan_pasien = $penilaian_keperawatan_ranap_kandungan_data['persalinan'];
                $dataRawat[$index]->penilaian_keperawatan_ranap_kandungan[$index0]->riwayat_persalinan_pasien = $riwayat_persalinan_pasien;
            }

            // =========================
            // Awal Medis IGD
            // =========================
            $penilaian_medis_igd = $this->getPenilaianMedisIGD([
                "no_rawat" => $rawat->no_rawat
            ]);

            $dataRawat[$index]->penilaian_medis_igd = $penilaian_medis_igd['penilaian'];


            // =========================
            // Awal Medis Rawat Jalan Umum
            // =========================
            $penilaian_medis_ralan_umum = $this->getPenilaianMedisRalanUmum([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_umum = $penilaian_medis_ralan_umum['penilaian'];


            // =========================
            // Awal Medis Rawat Jalan Kandungan
            // =========================
            $penilaian_medis_ralan_kandungan = $this->getPenilaianMedisRalanKandungan([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_kandungan = $penilaian_medis_ralan_kandungan['penilaian'];

              // =========================
            // Awal Medis Psikiatri
            // =========================
            $penilaian_medis_psikiatri = $this->getPenilaianMedisRalanPsikiatri([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_psikiatri = $penilaian_medis_psikiatri['penilaian'];


            // =========================
            // Awal Medis Rawat Jalan Bayi
            // =========================
            $penilaian_medis_ralan_bayi = $this->getPenilaianMedisRalanBayi([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_bayi = $penilaian_medis_ralan_bayi['penilaian'];

            // =========================
            // Awal Medis Rawat Jalan Psikiatri
            // =========================
            $penilaian_medis_ralan_psikiatri = $this->getPenilaianMedisRalanPsikiatri([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_psikiatri = $penilaian_medis_ralan_psikiatri['penilaian'];

             // =========================
            // Awal Medis Rawat Jalan neurologi
            // =========================
            $penilaian_medis_ralan_penyakit_dalam = $this->getPenilaianMedisRalanNeurologi([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_penyakit_dalam = $penilaian_medis_ralan_penyakit_dalam['penilaian'];

             // =========================
            // Awal Medis Rawat Jalan Penyakit dalam
            // =========================
            $penilaian_medis_ralan_neurologi = $this->getPenilaianMedisRalanPenyakitDalam([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_neurologi = $penilaian_medis_ralan_neurologi['penilaian'];

            // =========================
            // Awal Medis Rawat Jalan Penyakit mata
            // =========================
            $penilaian_medis_ralan_mata = $this->getPenilaianMedisRalanMata([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_mata = $penilaian_medis_ralan_mata['penilaian'];

            // =========================
            // Awal Medis Rawat Jalan THT
            // =========================
            $penilaian_medis_ralan_tht = $this->getPenilaianMedisRalanTht([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_tht = $penilaian_medis_ralan_tht['penilaian'];

             // =========================
            // Awal Medis Rawat Jalan bedah
            // =========================
            $penilaian_medis_ralan_bedah = $this->getPenilaianMedisRalanBedah([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_bedah = $penilaian_medis_ralan_bedah['penilaian'];

              // =========================
            // Awal Medis Rawat Jalan orthopedi
            // =========================
            $penilaian_medis_ralan_orthopedi = $this->getPenilaianMedisRalanOrthopedi([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_orthopedi = $penilaian_medis_ralan_orthopedi['penilaian'];

             // =========================
            // Awal Medis Rawat Jalan geriatri halo
            // =========================
            $penilaian_medis_ralan_geriatri = $this->getPenilaianMedisRalanGeriatri([
                "no_rawat" => $rawat->no_rawat
            ]);
            $dataRawat[$index]->penilaian_medis_ralan_geriatri = $penilaian_medis_ralan_geriatri['penilaian'];


            // =========================
            // Diagnosa Penyakit
            // =========================
            $dataRawat[$index]->diagnosa_penyakit = $this->getDiagnosaPenyakit($rawat->no_rawat);

            // =========================
            // Pemeriksaan Rawat Jalan
            // =========================
            if($type_akses=='ri'){
                $paramater=[
                    'pemeriksaan_ranap.no_rawat'=>!empty($rawat->no_rawat) ? ['=',$rawat->no_rawat] : '',
                ];
                $dataList = $this->cpptService->getDataCpptRanapList($paramater);
            }else{
                $paramater=[
                    'pemeriksaan_ralan.no_rawat'=>!empty($rawat->no_rawat) ? ['=',$rawat->no_rawat] : '',
                ];
                $dataList = $this->cpptService->getDataCpptRalanList($paramater);
            }
            $dataRawat[$index]->cppt = $dataList;

            // ------------Administrasi-----------
            // $totalBiaya += $rawat->biaya_reg;

            // =========================
            // Tindakan Rawat Jalan
            // =========================
            $dataRawat[$index]->tindakan_rawat_jalan = $this->getTindakanRawatJalan($rawat->no_rawat);
            // foreach ($dataRawat[$index]->tindakan_rawat_jalan as $data) {
            //     $totalBiaya += $data->biaya_rawat;
            // }

            $dataRawat[$index]->tindakan_rawat_jalan_paramedis = $this->getTindakanRawatJalanParamedis($rawat->no_rawat);
            // foreach ($dataRawat[$index]->tindakan_rawat_jalan_paramedis as $data) {
            //     $totalBiaya += $data->biaya_rawat;
            // }

            $dataRawat[$index]->tindakan_rawat_jalan_dokter_paramedis = $this->getTindakanRawatJalanDokterParamedis($rawat->no_rawat);
            // foreach ($dataRawat[$index]->tindakan_rawat_jalan_dokter_paramedis as $data) {
            //     $totalBiaya += $data->biaya_rawat;
            // }

            $paramater=[
                'rawat_inap_dr.no_rawat'=>$rawat->no_rawat
            ];
            $dataRawat[$index]->tindakan_rawat_inap_dokter = $this->getTindakanRawatInapDokter($paramater);
            // foreach ($dataRawat[$index]->tindakan_rawat_inap_dokter as $data) {
            //     $totalBiaya += $data->biaya_rawat;
            // }

            $dataRawat[$index]->perencanaan_pemulangan = $this->getPerencanaanPemulangan($rawat->no_rawat);
            // foreach ($dataRawat[$index]->tindakan_rawat_inap_dokter as $data) {
            //     $totalBiaya += $data->biaya_rawat;
            // }

            $dataRawat[$index]->tindakan_rawat_inap_paramedis = $this->getTindakanRawatInapParamedis($rawat->no_rawat);
            // foreach ($dataRawat[$index]->tindakan_rawat_inap_paramedis as $data) {
            //     $totalBiaya += $data->biaya_rawat;
            // }

            $dataRawat[$index]->tindakan_rawat_inap_dokter_paramedis = $this->getTindakanRawatInapDokterParamedis($rawat->no_rawat);
            // foreach ($dataRawat[$index]->tindakan_rawat_inap_dokter_paramedis as $data) {
            //     $totalBiaya += $data->biaya_rawat;
            // }

            $dataRawat[$index]->penggunaan_kamar = $this->getPenggunaanKamar($rawat->no_rawat);
            // foreach ($dataRawat[$index]->penggunaan_kamar as $data) {
            //     $totalBiaya += $data->ttl_biaya;
            // }

            $dataRawat[$index]->operasi_vk = $this->getOperasiVK($rawat->no_rawat);
            // foreach ($dataRawat[$index]->operasi_vk as $data) {
            //     $totalBiaya += $data->total;
            // }

            $paramater=[
                'no_rawat'=>$rawat->no_rawat,
            ];
            $dataRawat[$index]->laporan_operasi = $this->laporanOperasiPasienService->getLaporanOperasiQueri1($paramater);

            $dataRawat[$index]->pemeriksaan_radiologi = $this->getPemeriksaanRadiologi($rawat->no_rawat);
            // foreach ($dataRawat[$index]->pemeriksaan_radiologi as $data) {
            //     $totalBiaya += $data->biaya;
            // }
            $dataRawat[$index]->hasil_radiologi = $this->hasilRadiologi->select('tgl_periksa','jam', 'hasil')->where('no_rawat','=',$rawat->no_rawat)->orderBy('tgl_periksa','ASC')->orderBy('jam','ASC')->get();

            $dataRawat[$index]->periksa_lab = $this->getPeriksaLab($rawat->no_rawat, $totalBiaya);
            $dataRawat[$index]->periksa_lab2 = $this->getPeriksaLab2($rawat->no_rawat, $totalBiaya);

            $dataRawat[$index]->pemberian_obat = $this->getPemberianObat($rawat->no_rawat, $totalBiaya);

            $paramater=[
                'returjual.no_retur_jual'=>$rawat->no_rawat,
            ];
            $dataRawat[$index]->retur_obat = $this->getReturObat($paramater);

            $dataRawat[$index]->penggunaan_obat_operasi = $this->getPenggunaanObatOperasi($rawat->no_rawat);
            // foreach ($dataRawat[$index]->penggunaan_obat_operasi as $data) {
            //     $totalBiaya += $data->total;
            // }

            $dataRawat[$index]->resep_pulang = $this->getResepPulang($rawat->no_rawat);
            // foreach ($dataRawat[$index]->resep_pulang as $data) {
            //     $totalBiaya += $data->total;
            // }

            $dataRawat[$index]->tambahan_biaya = $this->getTambahanBiaya($rawat->no_rawat);
            // foreach ($dataRawat[$index]->tambahan_biaya as $data) {
            //     $totalBiaya += $data->besar_biaya;
            // }

            $dataRawat[$index]->potongan_biaya = $this->getPotonganBiaya($rawat->no_rawat);
            // foreach ($dataRawat[$index]->potongan_biaya as $data) {
            //     $totalBiaya += $data->besar_pengurangan;
            // }
            // =========================
            // Resume
            // =========================
            if($type_akses=='ri'){
                $dataList=$this->resumeService->getResumeRanapList(['resume_pasien_ranap.no_rawat'=>$rawat->no_rawat]);
            }else{
                $dataList=$this->resumeService->getResumeList(['resume_pasien.no_rawat'=>$rawat->no_rawat]);
            }
            // $dataList=!empty($dataList[0]) ? (object)$dataList[0]->getAttributes() : [];
            $dataRawat[$index]->resume = $dataList;
            // $dataRawat[$index]->total_biaya = $totalBiaya;

            // data pasien
            $dataRawat[$index]->dataPasien = $dataPasien;
        }

        return $dataRawat;
    }
    function getPenilaianKeperawatanBayi($params = []){
        $penilaian_keperawatan_ralan_bayi = DB::select("
        SELECT
            penilaian_awal_keperawatan_ralan_bayi.*,
            petugas.nama
        FROM
            penilaian_awal_keperawatan_ralan_bayi
            INNER JOIN petugas ON penilaian_awal_keperawatan_ralan_bayi.nip = petugas.nip
        WHERE
            penilaian_awal_keperawatan_ralan_bayi.no_rawat = ?", [$params['no_rawat']]);
        $masalah_keperawatan = DB::select("
                SELECT
                    master_masalah_keperawatan_anak.kode_masalah,
                    master_masalah_keperawatan_anak.nama_masalah
                FROM
                    master_masalah_keperawatan_anak

                    INNER JOIN penilaian_awal_keperawatan_ralan_bayi_masalah ON penilaian_awal_keperawatan_ralan_bayi_masalah.kode_masalah = master_masalah_keperawatan_anak.kode_masalah
                WHERE
                    penilaian_awal_keperawatan_ralan_bayi_masalah.no_rawat = ?
                ORDER BY
                    kode_masalah", [$params['no_rawat']]);

        $riwayat_imunisasi = DB::select("
            SELECT
                master_imunisasi.kode_imunisasi,
                master_imunisasi.nama_imunisasi,
                riwayat_imunisasi.no_imunisasi
            FROM
                master_imunisasi
                INNER JOIN riwayat_imunisasi ON riwayat_imunisasi.kode_imunisasi = master_imunisasi.kode_imunisasi
            WHERE
                riwayat_imunisasi.no_rkm_medis = ?
            GROUP BY
                master_imunisasi.kode_imunisasi
            ORDER BY
                master_imunisasi.kode_imunisasi", [$params['no_rm']]);
        return [
            "penilaian"=> $penilaian_keperawatan_ralan_bayi,
            "masalah" => $masalah_keperawatan,
            "imunisasi" => $riwayat_imunisasi
        ];
    }
    function getPenilaianKeperawatanGigi($params = []){
        $penilaian_keperawatan_ralan_gigi = DB::select("
        SELECT
            penilaian_awal_keperawatan_gigi.*,
            petugas.nama
        FROM
            penilaian_awal_keperawatan_gigi
            INNER JOIN petugas ON penilaian_awal_keperawatan_gigi.nip = petugas.nip
        WHERE
            penilaian_awal_keperawatan_gigi.no_rawat=?", [$params['no_rawat']]);

        $masalah_keperawatan = DB::select("
                SELECT
                    master_masalah_keperawatan_gigi.kode_masalah,
                    master_masalah_keperawatan_gigi.nama_masalah
                FROM
                    master_masalah_keperawatan_gigi
                    INNER JOIN penilaian_awal_keperawatan_gigi_masalah ON penilaian_awal_keperawatan_gigi_masalah.kode_masalah = master_masalah_keperawatan_gigi.kode_masalah
                WHERE
                    penilaian_awal_keperawatan_gigi_masalah.no_rawat=?", [$params['no_rawat']]);
        return [
            "penilaian"=> $penilaian_keperawatan_ralan_gigi,
            "masalah" => $masalah_keperawatan
        ];
    }

    function getPenilaianKeperawatanPsikiatri($params = []){
        $penilaian_awal_keperawatan_ralan_psikiatri = DB::select("
        SELECT
        penilaian_awal_keperawatan_ralan_psikiatri.*,
            petugas.nama
        FROM
        penilaian_awal_keperawatan_ralan_psikiatri
            INNER JOIN petugas ON penilaian_awal_keperawatan_ralan_psikiatri.nip = petugas.nip
        WHERE
        penilaian_awal_keperawatan_ralan_psikiatri.no_rawat=?", [$params['no_rawat']]);

        $masalah_keperawatan = DB::select("
        SELECT
            master_masalah_keperawatan_psikiatri.kode_masalah,
            master_masalah_keperawatan_psikiatri.nama_masalah
        FROM
            master_masalah_keperawatan_psikiatri
            INNER JOIN penilaian_awal_keperawatan_ralan_masalah_psikiatri ON penilaian_awal_keperawatan_ralan_masalah_psikiatri.kode_masalah = master_masalah_keperawatan_psikiatri.kode_masalah
        WHERE
            penilaian_awal_keperawatan_ralan_masalah_psikiatri.no_rawat=?", [$params['no_rawat']]);
        return [
            "penilaian"=> $penilaian_awal_keperawatan_ralan_psikiatri,
            "masalah" => $masalah_keperawatan
        ];
    }

    function getPenilaianKeperawatanRalanKandungan($params = []){
        $penilaian_keperawatan_ralan_kandungan = DB::select("
        SELECT
            penilaian_awal_keperawatan_kebidanan.*,
            petugas.nama
        FROM
            penilaian_awal_keperawatan_kebidanan
            INNER JOIN petugas ON penilaian_awal_keperawatan_kebidanan.nip = petugas.nip
        WHERE
            penilaian_awal_keperawatan_kebidanan.no_rawat = ?", [$params["no_rawat"]]);

        $riwayat_persalinan_pasien = DB::select("
                SELECT
                    *
                FROM
                    riwayat_persalinan_pasien
                WHERE
                    no_rkm_medis = ?
                ORDER BY
                    tgl_thn", [$params['no_rm']]);

        return [
            "penilaian" => $penilaian_keperawatan_ralan_kandungan,
            "persalinan" => $riwayat_persalinan_pasien
        ];
    }
    function getPenilaianKeperawatanRanapKandungan($params = []){
        $penilaian_keperawatan_kandungan = DB::select("
        SELECT
            penilaian_awal_keperawatan_kebidanan_ranap.*,
            pengkaji1.nama AS pengkaji1,
            pengkaji2.nama AS pengkaji2,
            dokter.nm_dokter
        FROM
            penilaian_awal_keperawatan_kebidanan_ranap
            INNER JOIN petugas AS pengkaji1 ON penilaian_awal_keperawatan_kebidanan_ranap.nip1 = pengkaji1.nip
            INNER JOIN petugas AS pengkaji2 ON penilaian_awal_keperawatan_kebidanan_ranap.nip2 = pengkaji2.nip
            INNER JOIN dokter ON penilaian_awal_keperawatan_kebidanan_ranap.kd_dokter = dokter.kd_dokter
        WHERE
            penilaian_awal_keperawatan_kebidanan_ranap.no_rawat =?", [$params['no_rawat']]);

        $riwayat_persalinan_pasien = DB::select("
            SELECT
                *
            FROM
                riwayat_persalinan_pasien
            WHERE
                no_rkm_medis = ?
            ORDER BY
                tgl_thn", [$params['no_rm']]);
        return [
            "penilaian" => $penilaian_keperawatan_kandungan,
            "persalinan" => $riwayat_persalinan_pasien
        ];
    }
    function getPenilaianMedisIGD($params = []){
        $penilaian_medis_igd = DB::select("
        SELECT
           penilaian_medis_igd.*,
            dokter.nm_dokter
        FROM
           penilaian_medis_igd
            INNER JOIN dokter ON penilaian_medis_igd.kd_dokter = dokter.kd_dokter
        WHERE
           penilaian_medis_igd.no_rawat=?", [$params["no_rawat"]]);

        return [
            "penilaian" => $penilaian_medis_igd
        ];
    }

    function getPenilaianMedisRalanUmum($params =[]){
        $penilaian_medis_ralan_umum = DB::select("
        SELECT
            penilaian_medis_ralan.*,
            dokter.nm_dokter
        FROM
            penilaian_medis_ralan
            INNER JOIN dokter ON penilaian_medis_ralan.kd_dokter = dokter.kd_dokter
        WHERE
            penilaian_medis_ralan.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_umum
        ];
    }

    function getPenilaianMedisRalanKandungan($params = []){
        $penilaian_medis_ralan_kandungan = DB::select("
        SELECT
            penilaian_medis_ralan_kandungan.*,
            dokter.nm_dokter
        FROM
            penilaian_medis_ralan_kandungan
            INNER JOIN dokter ON penilaian_medis_ralan_kandungan.kd_dokter = dokter.kd_dokter
        WHERE
            penilaian_medis_ralan_kandungan.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_kandungan
        ];
    }

    function get_penilaian_pre_operasi($params = []){
        $penilaian_pre_operasi = DB::select("
        SELECT penilaian_pre_operasi.*, dokter.nm_dokter as nama_dokter
        FROM penilaian_pre_operasi
        INNER JOIN dokter ON penilaian_pre_operasi.kd_dokter = dokter.kd_dokter
        WHERE no_rawat = ? AND tanggal = ?", [$params['no_rawat'], $params['tanggal']]);
        return [
            'rmoperasi' => $penilaian_pre_operasi
        ];
    }

    function get_penilaian_pre_anestesi($params = []){
        $penilaian_pre_anestesi = DB::select("
        SELECT penilaian_pre_anestesi.*, dokter.nm_dokter as nama_dokter
        FROM penilaian_pre_anestesi
        INNER JOIN dokter ON penilaian_pre_anestesi.kd_dokter = dokter.kd_dokter
        WHERE no_rawat = ? AND tanggal = ?", [$params['no_rawat'], $params['tanggal']]);
        return [
            'rmoperasi' => $penilaian_pre_anestesi
        ];
    }

    function get_checklist_pre_operasi($params = []){
        $checklist_pre_operasi = DB::select("
        SELECT checklist_pre_operasi.* ,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_bedah ) as dokter_bedah,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_anestesi ) as dokter_anestesi,
        (SELECT nama FROM petugas WHERE nip = nip_petugas_ruangan) as petugas_ruangan,
        (SELECT nama FROM petugas WHERE nip = nip_perawat_ok) as petugas_ok
        FROM checklist_pre_operasi
        INNER JOIN dokter ON checklist_pre_operasi.kd_dokter_bedah = dokter.kd_dokter
        INNER JOIN petugas ON checklist_pre_operasi.nip_perawat_ok = petugas.nip
        WHERE no_rawat = ? AND tanggal = ?", [$params['no_rawat'], $params['tanggal']]);
        return [
            'rmoperasi' => $checklist_pre_operasi
        ];
    }

    function get_signin_sebelum_anestesi($params = []){
        $signin_sebelum_anestesi = DB::select("
        SELECT signin_sebelum_anestesi.* ,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_bedah ) as dokter_bedah,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_anestesi ) as dokter_anestesi,
        (SELECT nama FROM petugas WHERE nip = nip_perawat_ok) as petugas_ok
        FROM signin_sebelum_anestesi
        INNER JOIN dokter ON signin_sebelum_anestesi.kd_dokter_bedah = dokter.kd_dokter
        INNER JOIN petugas ON signin_sebelum_anestesi.nip_perawat_ok = petugas.nip
        WHERE no_rawat = ? AND tanggal = ?", [$params['no_rawat'], $params['tanggal']]);
        // dd($signin_sebelum_anestesi);
        return [
            'rmoperasi' => $signin_sebelum_anestesi
        ];
    }

    function get_timeout_sebelum_insisi($params = []){
        $timeout_sebelum_insisi = DB::select("
        SELECT timeout_sebelum_insisi.* ,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_bedah ) as dokter_bedah,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_anestesi ) as dokter_anestesi,
        (SELECT nama FROM petugas WHERE nip = nip_perawat_ok) as petugas_ok
        FROM timeout_sebelum_insisi
        INNER JOIN dokter ON timeout_sebelum_insisi.kd_dokter_bedah = dokter.kd_dokter
        INNER JOIN petugas ON timeout_sebelum_insisi.nip_perawat_ok = petugas.nip
        WHERE no_rawat = ? AND tanggal = ?", [$params['no_rawat'], $params['tanggal']]);
        // dd($signin_sebelum_anestesi);
        return [
            'rmoperasi' => $timeout_sebelum_insisi
        ];
    }

    function get_signout_sebelum_menutup_luka($params = []){
        $signout_sebelum_menutup_luka = DB::select("
        SELECT signout_sebelum_menutup_luka.* ,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_bedah ) as dokter_bedah,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_anestesi ) as dokter_anestesi,
        (SELECT nama FROM petugas WHERE nip = nip_perawat_ok) as petugas_ok
        FROM signout_sebelum_menutup_luka
        INNER JOIN dokter ON signout_sebelum_menutup_luka.kd_dokter_bedah = dokter.kd_dokter
        INNER JOIN petugas ON signout_sebelum_menutup_luka.nip_perawat_ok = petugas.nip
        WHERE no_rawat = ? AND tanggal = ?", [$params['no_rawat'], $params['tanggal']]);
        // dd($signin_sebelum_anestesi);
        return [
            'rmoperasi' => $signout_sebelum_menutup_luka
        ];
    }

    function get_checklist_post_operasi($params = []){
        $checklist_post_operasi = DB::select("
        SELECT checklist_post_operasi.* ,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_bedah ) as dokter_bedah,
        (SELECT nm_dokter FROM dokter WHERE kd_dokter = kd_dokter_anestesi ) as dokter_anestesi,
        (SELECT nama FROM petugas WHERE nip = nip_perawat_ok) as petugas_ok,
        (SELECT nama FROM petugas WHERE nip = nip_perawat_anestesi) as petugas_anestesi
        FROM checklist_post_operasi
        INNER JOIN dokter ON checklist_post_operasi.kd_dokter_bedah = dokter.kd_dokter
        INNER JOIN petugas ON checklist_post_operasi.nip_perawat_ok = petugas.nip
        WHERE no_rawat = ? AND tanggal = ?", [$params['no_rawat'], $params['tanggal']]);
        // dd($checklist_post_operasi);
        return [
            'rmoperasi' => $checklist_post_operasi
        ];
    }

    function getPenilaianMedisRalanPsikiatri($params = []){
        $penilaian_medis_ralan_psikiatrik = DB::select("
        SELECT
        penilaian_medis_ralan_psikiatrik.*,
            dokter.nm_dokter
        FROM
        penilaian_medis_ralan_psikiatrik
            INNER JOIN dokter ON penilaian_medis_ralan_psikiatrik.kd_dokter = dokter.kd_dokter
        WHERE
        penilaian_medis_ralan_psikiatrik.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_psikiatrik
        ];
    }

    function getPenilaianMedisRalanTht($params = []){
        $penilaian_medis_ralan_tht = DB::select("
        SELECT
        penilaian_medis_ralan_tht.*,
            dokter.nm_dokter
        FROM
        penilaian_medis_ralan_tht
            INNER JOIN dokter ON penilaian_medis_ralan_tht.kd_dokter = dokter.kd_dokter
        WHERE
        penilaian_medis_ralan_tht.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_tht
        ];
    }

    function getPenilaianMedisRalanNeurologi($params = []){
        $penilaian_medis_ralan_neurologi = DB::select("
        SELECT
	    penilaian_medis_ralan_neurologi.*,
	        dokter.nm_dokter
        FROM
	    penilaian_medis_ralan_neurologi
	        INNER JOIN dokter ON penilaian_medis_ralan_neurologi.kd_dokter = dokter.kd_dokter
        WHERE
        penilaian_medis_ralan_neurologi.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_neurologi
        ];
    }

    function getPenilaianMedisRalanBedah($params = []){
        $penilaian_medis_ralan_bedah = DB::select("
        SELECT
	    penilaian_medis_ralan_bedah.*,
	        dokter.nm_dokter
        FROM
	    penilaian_medis_ralan_bedah
	        INNER JOIN dokter ON penilaian_medis_ralan_bedah.kd_dokter = dokter.kd_dokter
        WHERE
        penilaian_medis_ralan_bedah.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_bedah
        ];
    }

    function getPenilaianMedisRalanGeriatri($params = []){
        $penilaian_medis_ralan_geriatri = DB::select("
        SELECT
	    penilaian_medis_ralan_geriatri.*,
	        dokter.nm_dokter
        FROM
	    penilaian_medis_ralan_geriatri
	        INNER JOIN dokter ON penilaian_medis_ralan_geriatri.kd_dokter = dokter.kd_dokter
        WHERE
        penilaian_medis_ralan_geriatri.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_geriatri
        ];
    }

    function getPenilaianMedisRalanPenyakitDalam($params = []){
        $penilaian_medis_ralan_penyakit_dalam = DB::select("
        SELECT
	    penilaian_medis_ralan_penyakit_dalam.*,
	        dokter.nm_dokter
        FROM
	    penilaian_medis_ralan_penyakit_dalam
	        INNER JOIN dokter ON penilaian_medis_ralan_penyakit_dalam.kd_dokter = dokter.kd_dokter
        WHERE
        penilaian_medis_ralan_penyakit_dalam.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_penyakit_dalam
        ];
    }

    function getPenilaianMedisRalanMata($params = []){
        $penilaian_medis_ralan_mata = DB::select("
        SELECT
	    penilaian_medis_ralan_mata.*,
	        dokter.nm_dokter
        FROM
	    penilaian_medis_ralan_mata
	        INNER JOIN dokter ON penilaian_medis_ralan_mata.kd_dokter = dokter.kd_dokter
        WHERE
        penilaian_medis_ralan_mata.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_mata
        ];
    }

    function getPenilaianMedisRalanOrthopedi($params = []){
        $penilaian_medis_ralan_orthopedi = DB::select("
        SELECT
	    penilaian_medis_ralan_orthopedi.*,
	        dokter.nm_dokter
        FROM
	    penilaian_medis_ralan_orthopedi
	        INNER JOIN dokter ON penilaian_medis_ralan_orthopedi.kd_dokter = dokter.kd_dokter
        WHERE
        penilaian_medis_ralan_orthopedi.no_rawat=?", [$params['no_rawat']]);

        return [
            'penilaian' => $penilaian_medis_ralan_orthopedi
        ];
    }

    function getPenilaianMedisRalanBayi($params = []){
        $penilaian_medis_ralan_bayi = DB::select("
        SELECT
            penilaian_medis_ralan_anak.*,
            dokter.nm_dokter
        FROM
            penilaian_medis_ralan_anak
            INNER JOIN dokter ON penilaian_medis_ralan_anak.kd_dokter = dokter.kd_dokter
        WHERE
            penilaian_medis_ralan_anak.no_rawat=?", [$params['no_rawat']]);

        return [
            "penilaian" =>$penilaian_medis_ralan_bayi
        ];
    }

    public function getPenilaianKeperawatanRalan($params = []){

        $penilaianKeperawatan = DB::select("
            select
                penilaian_awal_keperawatan_ralan.*,
                petugas.nama
            from
                penilaian_awal_keperawatan_ralan
            inner join petugas on
                penilaian_awal_keperawatan_ralan.nip = petugas.nip
            where
                penilaian_awal_keperawatan_ralan.no_rawat = ?", [$params["no_rawat"]]);


        $masalahKeperawatan = DB::select("
            select
                master_masalah_keperawatan.kode_masalah,
                master_masalah_keperawatan.nama_masalah
            from
                master_masalah_keperawatan
            inner join penilaian_awal_keperawatan_ralan_masalah on
                penilaian_awal_keperawatan_ralan_masalah.kode_masalah = master_masalah_keperawatan.kode_masalah
            where
                penilaian_awal_keperawatan_ralan_masalah.no_rawat = ?
            order by
                kode_masalah", [$params['no_rawat']]);
        return [
            "penilaian" => $penilaianKeperawatan,
            "masalah" => $masalahKeperawatan
        ];
    }

}
