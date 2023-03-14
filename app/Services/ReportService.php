<?php

namespace App\Services;

use App\PoliKlinik;
use App\Models\RegPeriksa;
use App\Services\BaseService;
use App\Models\Pasien;
use App\Models\Opname;
use App\Models\IpsrsOpname;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

class ReportService extends BaseService
{
    protected $regPeriksa;
    protected $pasien;
    protected $opname;

    public function __construct(RegPeriksa $regPeriksa,
     Pasien $pasien, 
     Opname $opname,
     IpsrsOpname $ipsrsOpname
     )
    {
        parent::__construct();
        $this->pasien = $pasien;
        $this->regPeriksa = $regPeriksa;
        $this->opname = $opname;
        $this->ipsrsOpname = $ipsrsOpname;
    }


    public function getListReportToday($start)
    {
        return $this->regPeriksa
            ->select(DB::raw('\'Rawat Inap\' as name'), DB::raw('coalesce(count(tgl_registrasi),0) as jumlah'))
            ->where([['tgl_registrasi', $start], ['status_lanjut', 'Ranap']])
            ->union(DB::table(DB::raw('reg_periksa rp'))
                ->select(DB::raw('\'Rawat Jalan\' as name'), DB::raw('coalesce(count(tgl_registrasi),0) as jumlah'))
                ->where([['tgl_registrasi', $start], ['status_lanjut', 'Ralan']]))
            ->get();
    }
    public function getTotalPasien()
    {
        return $this->pasien
            ->count('*');
    }

    public function getListReportPoli($start, $end)
    {
        return $this->regPeriksa
            ->select('poliklinik.nm_poli', DB::raw('count(poliklinik.nm_poli) as jumlah'))
            ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
            ->whereBetween('tgl_registrasi', [$start, $end])
            ->groupBy('poliklinik.nm_poli')
            ->get();
    }

    public function getListReportRegistMonth($start, $end)
    {
        return $this->regPeriksa
            ->select(DB::raw('DATE_FORMAT(reg_periksa.tgl_registrasi,\'%y-%m\') as nm'), DB::raw('count(DATE_FORMAT(reg_periksa.tgl_registrasi,\'%y-%m\')) as jumlah'))
            ->whereBetween('tgl_registrasi', [$start, $end])
            ->groupByRaw('DATE_FORMAT(reg_periksa.tgl_registrasi,\'%y-%m\')')
            ->get();
    }

    public function getListReportRegistYear($start, $end)
    {
        return $this->regPeriksa
            ->select(DB::raw('year(reg_periksa.tgl_registrasi) as year'), DB::raw('count(year(reg_periksa.tgl_registrasi)) as jumlah'))
            ->whereBetween('tgl_registrasi', [$start, $end])
            ->groupByRaw('year(reg_periksa.tgl_registrasi)')
            ->get();
    }

    public function getReportStokObat($start, $end) {
        return $this->opname
        ->select('opname.kode_brng','databarang.nama_brng','opname.h_beli','databarang.kode_sat','opname.tanggal','opname.stok','opname.real','opname.selisih','opname.lebih',DB::raw('(opname.real*opname.h_beli) as totalreal'),'opname.nomihilang','opname.nomilebih','opname.keterangan','bangsal.kd_bangsal','bangsal.nm_bangsal','opname.no_batch','opname.no_faktur')
        ->join('databarang','opname.kode_brng','=','databarang.kode_brng')
        ->join('bangsal','opname.kd_bangsal','=','bangsal.kd_bangsal')
        ->join('jenis','databarang.kdjns','=','jenis.kdjns')
        ->join('kategori_barang','databarang.kode_kategori','=','kategori_barang.kode')
        ->join('golongan_barang','databarang.kode_golongan','=','golongan_barang.kode')
        ->whereBetween('opname.tanggal',[$start,$end])
        ->orderBy('opname.tanggal','ASC')
        ->get();
    }

    public function getReportNonMedis($start, $end) {
        return $this->ipsrsOpname->select('ipsrsopname.kode_brng','ipsrsbarang.nama_brng','ipsrsopname.h_beli','ipsrsbarang.kode_sat','ipsrsopname.tanggal','ipsrsopname.stok','ipsrsopname.real','ipsrsopname.selisih','ipsrsopname.lebih',DB::raw('(ipsrsopname.real*ipsrsopname.h_beli) as totalreal'),'ipsrsopname.nomihilang','ipsrsopname.nomilebih','ipsrsopname.keterangan')
        ->join('ipsrsbarang', 'ipsrsopname.kode_brng','=','ipsrsbarang.kode_brng')
        ->join('ipsrsjenisbarang','ipsrsjenisbarang.kd_jenis','=','ipsrsbarang.jenis')
        ->whereBetween('ipsrsopname.tanggal',[$start,$end])
        ->orderBy('ipsrsopname.tanggal','ASC')
        ->get();
    }
}
