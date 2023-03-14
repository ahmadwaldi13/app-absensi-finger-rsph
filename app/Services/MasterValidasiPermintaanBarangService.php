<?php

namespace App\Services;

use App\Models\UxuiPermintaanBarangValidasi;
use Illuminate\Support\Facades\DB;

class MasterValidasiPermintaanBarangService extends BaseService
{
    public function __construct(){
        parent::__construct();
        $this->uxuiPermintaanBarangValidasi = new UxuiPermintaanBarangValidasi;
    }

    function getList($params=[],$type=''){
        $query = $this->uxuiPermintaanBarangValidasi
        
            ->select('uxui_permintaan_barang_validasi.*','pegawai.nama as nama_pegawai','pegawai.jk','pegawai.jbtn','pegawai.bidang','departemen.nama as nama_departemen',DB::raw("GROUP_CONCAT(departemen.nama) as list_departemen"),DB::raw("GROUP_CONCAT(departemen.dep_id) as list_dep_id"))
            ->join('pegawai','pegawai.nik','=','uxui_permintaan_barang_validasi.nip')
            ->join('departemen','departemen.dep_id','=','uxui_permintaan_barang_validasi.departemen')
            ->orderBy('uxui_permintaan_barang_validasi.nip','ASC')
        ;

        $list_search=[
            'where_or'=>['uxui_permintaan_barang_validasi.nip','pegawai.nama','departemen.nama','pegawai.bidang'],
        ];
        if($params){
            $query=(new \App\Models\MyModel)->set_where($query,$params,$list_search);
        }
        // dd($query->get()); 
        if(empty($type)){
            return $query->get();
        }else{
            return $query;
        }
    }
}