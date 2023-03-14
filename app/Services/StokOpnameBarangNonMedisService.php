<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

use App\Models\PermintaanNonMedis;
use App\Models\DetailPermintaanNonMedis;
use App\Models\UxuiPermintaanBarangNonMedisPengeluaran;
use App\Services\GlobalService;

class StokOpnameBarangNonMedisService extends BaseService
{
    public function __construct(){
        parent::__construct();
        $this->globalService = new GlobalService;
        // $this->permintaanNonMedis = new PermintaanNonMedis;
        // $this->detailPermintaanNonMedis = new DetailPermintaanNonMedis;
        // $this->uxuiPermintaanBarangNonMedisPengeluaran = new UxuiPermintaanBarangNonMedisPengeluaran;
    }

    function getList($params=[],$type=''){

        $query = DB::table('ipsrsopname')
        ->select('ipsrsopname.kode_brng','ipsrsbarang.nama_brng','ipsrsbarang.jenis','ipsrsopname.h_beli','ipsrsbarang.kode_sat','ipsrsopname.tanggal','ipsrsopname.stok','ipsrsopname.REAL','ipsrsopname.selisih','ipsrsopname.lebih',DB::raw('( ipsrsopname.REAL * ipsrsopname.h_beli ) AS totalreal'),'ipsrsopname.nomihilang','ipsrsopname.nomilebih','ipsrsopname.keterangan')
        ->join('ipsrsbarang','ipsrsopname.kode_brng','=','ipsrsbarang.kode_brng')
        ->join('ipsrsjenisbarang','ipsrsjenisbarang.kd_jenis','=','ipsrsbarang.jenis');
        $list_search=[
            'where_or'=>['ipsrsopname.tanggal'],
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
    function datacolumn($params=[],$type=''){

        $query = DB::table('ipsrsopname')
        ->select('ipsrsopname.tanggal','keterangan','jml')
        ->join(DB::raw('(select count(tanggal) jml,tanggal from ipsrsopname
        group by tanggal
        order by tanggal) a'),'a.tanggal','=','ipsrsopname.tanggal')
        ->groupBy('ipsrsopname.tanggal')
        ->orderBy('ipsrsopname.tanggal','DESC');
        $list_search=[
            'where_or'=>['ipsrsopname.tanggal','ipsrsopname.keterangan'],
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
}
