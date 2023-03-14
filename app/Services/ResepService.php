<?php

namespace App\Services;

use App\Models\ResepObat;
use App\Models\AturanPakai;
use App\Models\ResepDokter;
use App\Models\DataBarang;
use App\Models\SetLokasi;
use App\Models\Kamar;
use App\Models\SetDepoRanap;

use Illuminate\Support\Facades\DB;

class ResepService extends BaseService
{
    public function __construct(
        ResepObat $resepObat,
        AturanPakai $aturanPakai,
        ResepDokter $resepDokter,
        DataBarang $dataBarang,
        SetLokasi $setLokasi,
        Kamar $kamar,
        SetDepoRanap $setDepoRanap
    ){
        parent::__construct();
        $this->resepObat = $resepObat;
        $this->aturanPakai = $aturanPakai;
        $this->resepDokter = $resepDokter;
        $this->dataBarang = $dataBarang;
        $this->setLokasi = $setLokasi;
        $this->kamar = $kamar;
        $this->setDepoRanap = $setDepoRanap;
    }

    function getNoResep($tgl)
    {
        $get_data_1=$this->resepObat
            ->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(no_resep,4),signed)),0) as last'))
            ->where('tgl_peresepan', '=', $tgl)
        ->first();

        $get_data_2=$this->resepObat
            ->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(no_resep,4),signed)),0) as last'))
            ->whereRaw('LEFT(no_resep,8) = ? ', [str_replace("-", "", $tgl)])
        ->first();

        $data=$get_data_1;
        if($get_data_2->last > $get_data_1->last){
            $data=$get_data_2;
        }

        return (new \App\Http\Traits\GlobalFunction)->autoNomor($data, $tgl, str_replace("-", "", $tgl), 4);
    }

    function delete($params)
    {
        $query=$this->resepObat;
        foreach($params as $key => $value){
            $query=$query->where($key,'=',$value);
        }
        return $query->delete();
    }

    function update($params,$set)
    {
        $query=$this->resepObat;
        foreach($params as $key => $value){
            $query=$query->where($key,'=',$value);
        }
        return $query->update($set);
    }

    function delete_resep_dokter($params)
    {
        $query=$this->resepDokter;
        foreach($params as $key => $value){
            $query=$query->where($key,'=',$value);
        }
        return $query->delete();
    }

    function getKamar($params){

        $query= $this->kamar
            ->select('kamar.kd_kamar','kd_bangsal')
            ->join('kamar_inap','kamar_inap.kd_kamar','=','kamar.kd_kamar')
            ->orderBy('kamar_inap.tgl_masuk','DESC')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }

        return $query->get();
    }

    function getResepList($params=[])
    {
        $query= $this->resepObat
            ->select('resep_obat.no_resep', 'resep_obat.tgl_peresepan', 'resep_obat.jam_peresepan', 'resep_obat.no_rawat', 'pasien.no_rkm_medis', 'pasien.nm_pasien', 'resep_obat.kd_dokter', 'dokter.nm_dokter',DB::raw("IF( resep_obat.tgl_perawatan = '0000-00-00', 'Belum Terlayani', 'Sudah Terlayani' ) AS status "),'poliklinik.nm_poli','reg_periksa.kd_poli','penjab.png_jawab',DB::raw("IF( resep_obat.tgl_perawatan = '0000-00-00', '', resep_obat.tgl_perawatan ) AS tgl_perawatan "),DB::raw("IF( resep_obat.jam = '00:00:00', '', resep_obat.jam ) AS jam "),DB::raw("IF( resep_obat.tgl_penyerahan = '0000-00-00', '', resep_obat.tgl_penyerahan ) AS tgl_penyerahan "),DB::raw("IF( resep_obat.jam_penyerahan = '00:00:00', '', resep_obat.jam_penyerahan ) AS jam_penyerahan "))
            ->join( 'reg_periksa', 'resep_obat.no_rawat', '=' ,'reg_periksa.no_rawat')
            ->join( 'pasien', 'reg_periksa.no_rkm_medis', '=' ,'pasien.no_rkm_medis')
            ->join( 'dokter', 'resep_obat.kd_dokter', '=' ,'dokter.kd_dokter')
            ->join( 'poliklinik', 'reg_periksa.kd_poli', '=' ,'poliklinik.kd_poli')
            ->join( 'penjab', 'reg_periksa.kd_pj', '=' ,'penjab.kd_pj')
            ->join( 'resep_dokter', 'resep_dokter.no_resep', '=' ,'resep_obat.no_resep')
            ->orderBy('resep_obat.tgl_perawatan', 'DESC')
            ->orderBy('resep_obat.jam', 'DESC')
            ->groupBy('resep_obat.no_resep')
        ;

        $query->where('resep_obat.tgl_peresepan','<>','0000-00-00');

        if($params){
            foreach($params as $key =>$value){
                if($key!='search' and $key!='tgl_peresepan'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_peresepan'])){
                $data_tgl=$params['tgl_peresepan'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('resep_obat.tgl_peresepan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('resep_obat.no_resep', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                        ->orWhere('poliklinik.nm_poli', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        return $query->get();
    }

    function getResepDokter($params=[]){
        $query= $this->resepDokter
            ->select('databarang.kode_brng','databarang.nama_brng','resep_dokter.jml','databarang.kode_sat','resep_dokter.aturan_pakai')
            ->join( 'databarang','resep_dokter.kode_brng','=','databarang.kode_brng')
            ->orderBy('databarang.kode_brng')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }

        return $query->get();
    }

    function getResepListDetail($params=[])
    {
        $query= $this->resepObat
            ->select('resep_obat.no_resep','resep_obat.no_rawat','pasien.no_rkm_medis','pasien.nm_pasien','resep_obat.kd_dokter','dokter.nm_dokter',DB::raw("IF( resep_obat.tgl_perawatan = '0000-00-00', 'Belum Terlayani', 'Sudah Terlayani' ) AS status "),'poliklinik.nm_poli','resep_obat.STATUS AS status_asal','penjab.png_jawab','resep_obat.tgl_peresepan', 'resep_obat.jam_peresepan',DB::raw("IF( resep_obat.tgl_perawatan = '0000-00-00', '', resep_obat.tgl_perawatan ) AS tgl_perawatan "),DB::raw("IF( resep_obat.jam = '00:00:00', '', resep_obat.jam ) AS jam "),DB::raw("IF( resep_obat.tgl_penyerahan = '0000-00-00', '', resep_obat.tgl_penyerahan ) AS tgl_penyerahan "),DB::raw("IF( resep_obat.jam_penyerahan = '00:00:00', '', resep_obat.jam_penyerahan ) AS jam_penyerahan "))
            ->join( 'reg_periksa','resep_obat.no_rawat','=','reg_periksa.no_rawat')
            ->join( 'pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join( 'dokter','resep_obat.kd_dokter','=','dokter.kd_dokter')
            ->join( 'poliklinik','reg_periksa.kd_poli','=','poliklinik.kd_poli')
            ->join( 'penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
            ->join( 'resep_dokter', 'resep_dokter.no_resep', '=' ,'resep_obat.no_resep')
            ->orderBy('resep_obat.tgl_perawatan', 'DESC')
            ->orderBy('resep_obat.jam', 'DESC')
            ->groupBy('resep_obat.no_resep')
        ;

        $query->where('resep_obat.tgl_peresepan','<>','0000-00-00');
        // $query->where('resep_obat.status','=','ralan');

        if($params){
            foreach($params as $key =>$value){
                if($key!='search' and $key!='tgl_peresepan'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_peresepan'])){
                $data_tgl=$params['tgl_peresepan'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween('resep_obat.tgl_peresepan', $data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('resep_obat.no_resep', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('dokter.nm_dokter', 'LIKE', '%' . $search . '%')
                        ->orWhere('penjab.png_jawab', 'LIKE', '%' . $search . '%')
                        ->orWhere('poliklinik.nm_poli', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        $data=$query->get();

        $return=[];
        foreach($data as $key =>$value){
            $value=!empty($value) ? (object)$value->getAttributes() : [];
            $tmp=(array)$value;
            $detail=$this->getResepDokter(['resep_dokter.no_resep'=>$value->no_resep]);
            foreach($detail as $key_item => $value_item){
                $value_item=(object)$value_item->getAttributes();
                $tmp['item_obat'][]=$value_item;
            }
            $return[]=(object)$tmp;
        }

        return $return;
    }

    function checkAturanPakai($aturanPakai)
    {
        $aturanPakaiExisting = $this->aturanPakai->where('aturan', $aturanPakai)->first();
        if (!$aturanPakaiExisting) {
            $this->aturanPakai->insert(['aturan' => $aturanPakai]);
        }
    }

    // function insertResepDokter($dataResepObat, $dataResepDokter)
    // {
    //     if ($this->resepObat->insert($dataResepObat)) {
    //         foreach ($dataResepDokter as $resepDokter) {
    //             $this->checkAturanPakai($resepDokter['aturan_pakai']);
    //             $resepDokter["no_resep"] = $dataResepObat["no_resep"];
    //             $this->resepDokter->insert($resepDokter);
    //         }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    function getListBarang($params=[]){

        $kenaikan=!empty(config('configkhanza.kenaikan')) ? config('configkhanza.kenaikan') : 0;
        $aktifkan_batch_obat=!empty(config('configkhanza.AKTIFKANBATCHOBAT')) ? config('configkhanza.AKTIFKANBATCHOBAT') : 'no';
        $stok_kosong_resep=!empty(config('configkhanza.STOKKOSONGRESEP')) ? config('configkhanza.STOKKOSONGRESEP') : 'no';
        $return='';
        if($kenaikan>0){
            if( strtolower($aktifkan_batch_obat)=='yes'){
                $query= $this->dataBarang
                    ->select('databarang.kode_brng','databarang.nama_brng','jenis.nama','databarang.kode_sat',DB::raw('(databarang.h_beli+(databarang.h_beli*'.$kenaikan.')) as harga'),'databarang.letak_barang','industrifarmasi.nama_industri','databarang.h_beli',DB::raw('sum(gudangbarang.stok) as stok'),DB::raw('IFNULL(databarang.kapasitas,1) kapasitas_brng'))
                    ->join('jenis','databarang.kdjns','=','jenis.kdjns')
                    ->join('industrifarmasi','industrifarmasi.kode_industri','=','databarang.kode_industri')
                    ->join('gudangbarang','databarang.kode_brng','=','gudangbarang.kode_brng')
                    ->groupBy('gudangbarang.kode_brng')
                    ->orderBy('databarang.nama_brng','ASC')
                    ->where('databarang.status','=','1')
                    ->where('gudangbarang.no_batch','<>','')
                    ->where('gudangbarang.no_faktur','<>','')
                ;

                if(strtolower($stok_kosong_resep)=='no'){
                    $query->where(DB::raw('ROUND(gudangbarang.stok)'),'>',0);
                }

                if($params){
                    foreach($params as $key =>$value){
                        if($key!='search'){
                            if(is_array($value)){
                                $query=$query->whereIn($key, $value);
                            }else{
                                $type=is_numeric($value) ? '=' : 'like';
                                $query->where($key,$type,$value);
                            }
                        }
                    }

                    if(!empty($params['search'])){
                        $search=$params['search'];
                        $query->where(function ($qb2) use ($search) {
                            $qb2->where('databarang.kode_brng', 'LIKE', '%' . $search . '%')
                                ->orWhere('databarang.nama_brng', 'LIKE', '%' . $search . '%')
                                ->orWhere('jenis.nama', 'LIKE', '%' . $search . '%')
                                ->orWhere('databarang.letak_barang', 'LIKE', '%' . $search . '%')
                            ;
                        });
                    }
                }

                $return=$query->get();
            }else{
                $query= $this->dataBarang
                    ->select('databarang.kode_brng','databarang.nama_brng','jenis.nama','databarang.kode_sat',DB::raw('(databarang.h_beli+(databarang.h_beli*'.$kenaikan.')) as harga'),'databarang.letak_barang','industrifarmasi.nama_industri','databarang.h_beli','gudangbarang.stok',DB::raw('IFNULL(databarang.kapasitas,1) kapasitas_brng'))
                    ->join('jenis','databarang.kdjns','=','jenis.kdjns')
                    ->join('industrifarmasi','industrifarmasi.kode_industri','=','databarang.kode_industri')
                    ->join('gudangbarang','databarang.kode_brng','=','gudangbarang.kode_brng')
                    ->orderBy('databarang.nama_brng','ASC')
                    ->where('databarang.status','=','1')
                    ->where('gudangbarang.no_batch','=','')
                    ->where('gudangbarang.no_faktur','=','')
                ;

                if(strtolower($stok_kosong_resep)=='no'){
                    $query->where(DB::raw('ROUND(gudangbarang.stok)'),'>',0);
                }

                if($params){
                    foreach($params as $key =>$value){
                        if($key!='search'){
                            if(is_array($value)){
                                $query=$query->whereIn($key, $value);
                            }else{
                                $type=is_numeric($value) ? '=' : 'like';
                                $query->where($key,$type,$value);
                            }
                        }
                    }

                    if(!empty($params['search'])){
                        $search=$params['search'];
                        $query->where(function ($qb2) use ($search) {
                            $qb2->where('databarang.kode_brng', 'LIKE', '%' . $search . '%')
                                ->orWhere('databarang.nama_brng', 'LIKE', '%' . $search . '%')
                                ->orWhere('jenis.nama', 'LIKE', '%' . $search . '%')
                                ->orWhere('databarang.letak_barang', 'LIKE', '%' . $search . '%')
                            ;
                        });
                    }
                }

                $return=$query->get();
            }
        }else{
            if( strtolower($aktifkan_batch_obat)=='yes'){

                $query= $this->dataBarang
                    ->select('databarang.kode_brng','databarang.nama_brng','jenis.nama','databarang.kode_sat','databarang.karyawan','databarang.ralan','databarang.beliluar','databarang.kelas1','databarang.kelas2','databarang.kelas3','databarang.vip','databarang.vvip','databarang.letak_barang','databarang.utama','industrifarmasi.nama_industri','databarang.h_beli',DB::raw('sum(gudangbarang.stok) as stok'),DB::raw('IFNULL(databarang.kapasitas,1) kapasitas_brng'))
                    ->join('jenis','databarang.kdjns','=','jenis.kdjns')
                    ->join('industrifarmasi','industrifarmasi.kode_industri','=','databarang.kode_industri')
                    ->join('gudangbarang','databarang.kode_brng','=','gudangbarang.kode_brng')
                    ->groupBy('gudangbarang.kode_brng')
                    ->orderBy('databarang.nama_brng','ASC')
                    ->where('databarang.status','=','1')
                    ->where('gudangbarang.no_batch','<>','')
                    ->where('gudangbarang.no_faktur','<>','')
                ;

                if(strtolower($stok_kosong_resep)=='no'){
                    $query->where(DB::raw('ROUND(gudangbarang.stok)'),'>',0);
                }

                if($params){
                    foreach($params as $key =>$value){
                        if($key!='search'){
                            if(is_array($value)){
                                $query=$query->whereIn($key, $value);
                            }else{
                                $type=is_numeric($value) ? '=' : 'like';
                                $query->where($key,$type,$value);
                            }
                        }
                    }

                    if(!empty($params['search'])){
                        $search=$params['search'];
                        $query->where(function ($qb2) use ($search) {
                            $qb2->where('databarang.kode_brng', 'LIKE', '%' . $search . '%')
                                ->orWhere('databarang.nama_brng', 'LIKE', '%' . $search . '%')
                                ->orWhere('jenis.nama', 'LIKE', '%' . $search . '%')
                                ->orWhere('databarang.letak_barang', 'LIKE', '%' . $search . '%')
                            ;
                        });
                    }
                }

                $return=$query->get();

            }else{
                $query= $this->dataBarang
                    ->select('databarang.kode_brng','databarang.nama_brng','jenis.nama','databarang.kode_sat','databarang.karyawan','databarang.ralan','databarang.beliluar','databarang.kelas1','databarang.kelas2','databarang.kelas3','databarang.vip','databarang.vvip','databarang.letak_barang','databarang.utama','industrifarmasi.nama_industri','databarang.h_beli','gudangbarang.stok',DB::raw('IFNULL(databarang.kapasitas,1) kapasitas_brng'))
                    ->join('jenis','databarang.kdjns','=','jenis.kdjns')
                    ->join('industrifarmasi','industrifarmasi.kode_industri','=','databarang.kode_industri')
                    ->join('gudangbarang','databarang.kode_brng','=','gudangbarang.kode_brng')
                    ->orderBy('databarang.nama_brng','ASC')
                    ->where('databarang.status','=','1')
                    ->where('gudangbarang.no_batch','=','')
                    ->where('gudangbarang.no_faktur','=','')
                ;

                if(strtolower($stok_kosong_resep)=='no'){
                    $query->where(DB::raw('ROUND(gudangbarang.stok)'),'>',0);
                }

                if($params){
                    foreach($params as $key =>$value){
                        if($key!='search'){
                            if(is_array($value)){
                                $query=$query->whereIn($key, $value);
                            }else{
                                $type=is_numeric($value) ? '=' : 'like';
                                $query->where($key,$type,$value);
                            }
                        }
                    }

                    if(!empty($params['search'])){
                        $search=$params['search'];
                        $query->where(function ($qb2) use ($search) {
                            $qb2->where('databarang.kode_brng', 'LIKE', '%' . $search . '%')
                                ->orWhere('databarang.nama_brng', 'LIKE', '%' . $search . '%')
                                ->orWhere('jenis.nama', 'LIKE', '%' . $search . '%')
                                ->orWhere('databarang.letak_barang', 'LIKE', '%' . $search . '%')
                            ;
                        });
                    }
                }
                $return=$query->get();
            }
        }
        return $return;
    }

    function getKapasitasBarang($params){
        $query= $this->dataBarang
            ->select(DB::raw('IFNULL(databarang.kapasitas,1) kapasitas'))
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }

        return $query->get();
    }

    function getResepRalanList($params=[])
    {
        $query= $this->resepObat
            ->select('resep_obat.no_resep', 'resep_obat.tgl_peresepan', 'resep_obat.jam_peresepan', 'resep_obat.no_rawat', 'pasien.no_rkm_medis', 'pasien.nm_pasien', 'resep_obat.kd_dokter', 'dokter.nm_dokter',DB::raw("IF( resep_obat.tgl_perawatan = '0000-00-00', 'Belum Terlayani', 'Sudah Terlayani' ) AS status "),'poliklinik.nm_poli','reg_periksa.kd_poli','penjab.png_jawab',DB::raw("IF( resep_obat.tgl_perawatan = '0000-00-00', '', resep_obat.tgl_perawatan ) AS tgl_perawatan "),DB::raw("IF( resep_obat.jam = '00:00:00', '', resep_obat.jam ) AS jam "),DB::raw("IF( resep_obat.tgl_penyerahan = '0000-00-00', '', resep_obat.tgl_penyerahan ) AS tgl_penyerahan "),DB::raw("IF( resep_obat.jam_penyerahan = '00:00:00', '', resep_obat.jam_penyerahan ) AS jam_penyerahan "))
        ;

        $query->where('resep_obat.tgl_peresepan','<>','0000-00-00');
        // $query->where('resep_obat.status','=','ralan');

        if($params){
            foreach($params as $key =>$value){
                if($key!='search' and $key!='tgl_peresepan'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }
        }
    }

}