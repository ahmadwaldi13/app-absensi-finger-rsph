<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

use App\Models\PermintaanNonMedis;
use App\Models\DetailPermintaanNonMedis;
use App\Models\UxuiPermintaanBarangNonMedisPengeluaran;
use App\Models\UxuiPermintaanBarangNonMedisIpsrsDetailPengeluaran;
use App\Services\GlobalService;

class PermintaanBarangNonMedisService extends BaseService
{
    public function __construct(){
        parent::__construct();
        $this->globalService = new GlobalService;
        $this->permintaanNonMedis = new PermintaanNonMedis;
        $this->detailPermintaanNonMedis = new DetailPermintaanNonMedis;
        $this->uxuiPermintaanBarangNonMedisPengeluaran = new UxuiPermintaanBarangNonMedisPengeluaran;
        $this->uxuiPermintaanBarangNonMedisIpsrsDetailPengeluaran = new UxuiPermintaanBarangNonMedisIpsrsDetailPengeluaran;
    }

    function getList($params=[],$type=''){
        
        $query = $this->permintaanNonMedis
        ->select('permintaan_non_medis.*','pegawai.nama','pegawai.jk','pegawai.jnj_jabatan','pegawai.departemen','departemen.nama as nama_departemen','pegawai.bidang','uxui_permintaan_barang_non_medis_status.status as status_veri',
        'ipsrspengeluaran.no_keluar','ipsrspengeluaran.tanggal as tanggal_keluar','pegawai_inven.nik as nip_inven','pegawai_inven.nama as nama_inven','pegawai_inven.jk as jk_inven','pegawai_inven.jnj_jabatan as jnj_jabatan_inven','pegawai_inven.departemen as departemen_inven')
            ->join('pegawai','pegawai.nik','=','permintaan_non_medis.nip')
            ->join('departemen','departemen.dep_id','=','pegawai.departemen')
            ->leftJoin('uxui_permintaan_barang_non_medis_status',function($join) {
                $join->on('uxui_permintaan_barang_non_medis_status.no_permintaan','=','permintaan_non_medis.no_permintaan')
                ->where('uxui_permintaan_barang_non_medis_status.pengajuan','=',1); 
            })
            ->leftjoin('uxui_permintaan_barang_non_medis_pengeluaran','uxui_permintaan_barang_non_medis_pengeluaran.no_permintaan','=','permintaan_non_medis.no_permintaan')
            ->leftJoin('ipsrspengeluaran','ipsrspengeluaran.no_keluar','=','uxui_permintaan_barang_non_medis_pengeluaran.no_keluar')
            ->leftJoin('pegawai as pegawai_inven','pegawai_inven.nik','=','ipsrspengeluaran.nip')
        ;
    
        $list_search=[
            'where_or'=>['permintaan_non_medis.no_permintaan','pegawai.nama','permintaan_non_medis.nip','departemen.nama','pegawai.bidang',
                        'uxui_permintaan_barang_non_medis_pengeluaran.no_keluar','pegawai_inven.nama'],
        ];

        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }

        // dd($this->globalService->toRawSql($query));
        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

    function getListDetail($params=[],$type=''){
        
        $query = $this->detailPermintaanNonMedis
            ->select('detail_permintaan_non_medis.*', 'ipsrsbarang.stok','nama_brng','ipsrsjenisbarang.nm_jenis','kodesatuan.satuan')
            ->join('permintaan_non_medis','permintaan_non_medis.no_permintaan','=','detail_permintaan_non_medis.no_permintaan')
            ->join('ipsrsbarang','ipsrsbarang.kode_brng','=','detail_permintaan_non_medis.kode_brng')
            ->join('kodesatuan','kodesatuan.kode_sat','=','ipsrsbarang.kode_sat')
            ->join('ipsrsjenisbarang','ipsrsjenisbarang.kd_jenis','=','ipsrsbarang.jenis')
            ->orderBy('detail_permintaan_non_medis.jumlah','ASC')
        ;
    
        $list_search=[
            'where_or'=>['detail_permintaan_non_medis.no_permintaan','detail_permintaan_non_medis.kode_brng','nama_brng','ipsrsjenisbarang.nm_jenis'],
        ];

        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }

        // dd($this->globalService->toRawSql($query));
        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

    function getListDetailPengeluaran($params=[],$type=''){
        
        $query = $this->uxuiPermintaanBarangNonMedisPengeluaran
            ->select('ipsrsdetailpengeluaran.*','nama_brng','ipsrsjenisbarang.nm_jenis','kodesatuan.satuan','detail_permintaan_non_medis.jumlah as jumlah_permintaan','detail_permintaan_non_medis.keterangan as keterangan_permintaan')
            ->join('permintaan_non_medis','permintaan_non_medis.no_permintaan','=','uxui_permintaan_barang_non_medis_pengeluaran.no_permintaan')
            ->join('ipsrspengeluaran','ipsrspengeluaran.no_keluar','=','uxui_permintaan_barang_non_medis_pengeluaran.no_keluar')
            ->join('ipsrsdetailpengeluaran','ipsrsdetailpengeluaran.no_keluar','=','ipsrspengeluaran.no_keluar')
            
            ->join('ipsrsbarang','ipsrsbarang.kode_brng','=','ipsrsdetailpengeluaran.kode_brng')
            ->join('kodesatuan','kodesatuan.kode_sat','=','ipsrsbarang.kode_sat')
            ->join('ipsrsjenisbarang','ipsrsjenisbarang.kd_jenis','=','ipsrsbarang.jenis')
            ->leftJoin('detail_permintaan_non_medis', function ($join) {
                $join->on('detail_permintaan_non_medis.no_permintaan', '=', 'permintaan_non_medis.no_permintaan');
                $join->on('detail_permintaan_non_medis.kode_brng', '=', 'ipsrsdetailpengeluaran.kode_brng');
            })
            ->orderBy('ipsrsdetailpengeluaran.jumlah','ASC')
        ;
    
        $list_search=[
            'where_or'=>['permintaan_non_medis.no_permintaan','ipsrsdetailpengeluaran.kode_brng','nama_brng','ipsrsjenisbarang.nm_jenis'],
        ];

        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }

        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }

    function generateKodeBarangByJenis($jenis){

        $get_data_1=$this->ipsrsBarang->select(DB::raw("count(kode_brng) as last"))->where('jenis', '=', $jenis)->first();
        $get_data_2=$this->ipsrsBarang->select(DB::raw("max(replace(reverse(FORMAT(reverse(kode_brng), 0)), ',', '')) as last"))->where('jenis', '=', $jenis)->first();
        
        $number=$get_data_1;
        if($get_data_2->last > $get_data_1->last){
            $number=$get_data_2;
        }
        $get_prefix=(new \App\Models\UxuiIpsrsjenisbarang)->select('prefix')->where('kd_jenis', '=', $jenis)->first();
        $get_prefix=!empty($get_prefix->prefix) ? $get_prefix->prefix : 'B';

        $number=!empty($number->last) ? (int)$number->last : 0;
        $number++;
        return $get_prefix.$number;
    }
    
    function getBarangPetugasPDF($no_permintaan){

        $query = DB::table(DB::raw('uxui_permintaan_barang_non_medis_status as bnms'))
                    ->select(
                        'no_permintaan', 
                        'bnms.tanggal',
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 0 AND bnms.pengajuan = 1 THEN bnms.tanggal END AS tanggal_pengajuan '),
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 0 AND bnms.pengajuan = 1 THEN pegawai.nama END AS nama_pemohon '),
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 0 AND bnms.pengajuan = 1 THEN pegawai.nik END AS nip_pemohon '), 
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 0 AND bnms.pengajuan = 1 then SHA1(sidikjari.sidikjari) end as finger_pemohon'),
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 1 THEN bnms.status END AS status_kabid '), 
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 1 THEN pegawai.nama END AS nama_kabid '), 
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 1 THEN pegawai.nik END AS nip_kabid '), 
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 1 then SHA1(sidikjari.sidikjari) end as finger_kabid'),
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 2 THEN bnms.status END AS status_pgwai_inventori '), 
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 2 THEN pegawai.nama END AS nama_pgwai_inventori '), 
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 2 THEN pegawai.nik END AS nip_pgwai_inventori '),
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 2 then SHA1(sidikjari.sidikjari) end as finger_pgwai_inventori'),
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 3  THEN pegawai.nama END AS nama_penerima '), 
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 3  THEN pegawai.nik END AS nip_penerima '),
                        DB::raw('CASE WHEN bnms.verifikasi_ke = 3  then SHA1(sidikjari.sidikjari) end as finger_penerima')
                    )
                    ->join('pegawai','pegawai.nik','=','bnms.nip')
                    ->leftJoin('sidikjari', 'pegawai.id' , '=', 'sidikjari.id')
                    ->where('no_permintaan','=',$no_permintaan);

        $query_final =  DB::table(DB::raw("({$query->toSql()}) as permintaan_barang"))
                            ->mergeBindings($query)
                            ->select(
                                	"no_permintaan",
                                    DB::raw("DATE_FORMAT(GROUP_CONCAT(tanggal_pengajuan SEPARATOR ''), '%d/%m/%Y')as tanggal_pengajuan"),
                                    DB::raw("GROUP_CONCAT(nama_pemohon SEPARATOR '')as nama_pemohon"),
                                    DB::raw("GROUP_CONCAT(nip_pemohon SEPARATOR '')as nip_pemohon"),
                                    DB::raw("GROUP_CONCAT(finger_pemohon SEPARATOR '')as finger_pemohon"), 
                                    DB::raw("GROUP_CONCAT(status_kabid SEPARATOR '')as status_kabid"),
                                    DB::raw("GROUP_CONCAT(nama_kabid SEPARATOR '')as nama_kabid"),
                                    DB::raw("GROUP_CONCAT(nip_kabid SEPARATOR '')as nip_kabid"),
                                    DB::raw("GROUP_CONCAT(finger_kabid SEPARATOR '')as finger_kabid"), 
                                    DB::raw("GROUP_CONCAT(status_pgwai_inventori SEPARATOR '')as status_pgwai_inventori"),
                                    DB::raw("GROUP_CONCAT(nama_pgwai_inventori SEPARATOR '')as nama_pgwai_inventori"),
                                    DB::raw("GROUP_CONCAT(nip_pgwai_inventori SEPARATOR '')as nip_pgwai_inventori"),
                                    DB::raw("GROUP_CONCAT(finger_pgwai_inventori SEPARATOR '')as finger_pgwai_inventori"),
                                    DB::raw("GROUP_CONCAT(nama_penerima SEPARATOR '')as nama_penerima"),
                                    DB::raw("GROUP_CONCAT(nip_penerima SEPARATOR '')as nip_penerima"),
                                    DB::raw("GROUP_CONCAT(finger_penerima SEPARATOR '')as finger_penerima")
                            )
                            ->first();
        $tes = $this->uxuiPermintaanBarangNonMedisIpsrsDetailPengeluaran->select("*", "uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran.keterangan as keterangan_barang")
                            ->leftJoinSub($this->getListDetail([
                                            'permintaan_non_medis.no_permintaan'=>['=',$no_permintaan],
                                            ],'1'), 
                                            'list_detail', 
                                            function($join){
                                                $join->on('list_detail.no_permintaan', '=', 'uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran.no_permintaan');
                                                $join->on('list_detail.kode_brng', '=', 'uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran.kode_brng');
                                            })
                            ->where('list_detail.no_permintaan', $no_permintaan);

        if(isset($query_final->status_pgwai_inventori) && $query_final->status_pgwai_inventori == "2"){
            // $query_final->list_data = $this->getListDetailPengeluaran([
            // 'permintaan_non_medis.no_permintaan'=>['=',$no_permintaan],
            // ]);
            $query_final->list_data = $this->uxuiPermintaanBarangNonMedisIpsrsDetailPengeluaran->select("*", "uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran.keterangan as keterangan_barang_keluar")
                            ->leftJoinSub($this->getListDetailPengeluaran([
                                            'permintaan_non_medis.no_permintaan'=>['=',$no_permintaan],
                                            ],'1'), 
                                            'list_detail_pengeluaran', 
                                            function($join){
                                                $join->on('list_detail_pengeluaran.no_keluar', '=', 'uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran.no_keluar');
                                                $join->on('list_detail_pengeluaran.kode_brng', '=', 'uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran.kode_brng');
                                            })
                            ->where('uxui_permintaan_barang_non_medis_ipsrsdetailpengeluaran.no_permintaan', $no_permintaan)->get();
        }else{
            $query_final->list_data = $this->getListDetail([
            'permintaan_non_medis.no_permintaan'=>['=',$no_permintaan],
            ]);
        }

        return $query_final;
    }
}