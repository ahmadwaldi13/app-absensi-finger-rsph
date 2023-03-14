<?php

namespace App\Services;

use App\Models\ResepObat;
use App\Models\MetodeRacik;
use App\Models\DataBarang;
use App\Models\ResepDokterRacikan;
use App\Models\ResepDokterRacikanDetail;

use Illuminate\Support\Facades\DB;

class RacikanService extends BaseService
{
    public function __construct(
        ResepObat $resepObat,
        MetodeRacik $metodeRacik,
        DataBarang $dataBarang,
        ResepDokterRacikan $resepDokterRacikan,
        ResepDokterRacikanDetail $resepDokterRacikanDetail
    ){
        parent::__construct();
        $this->resepObat = $resepObat;
        $this->metodeRacik = $metodeRacik;
        $this->dataBarang = $dataBarang;
        $this->resepDokterRacikan = $resepDokterRacikan;
        $this->resepDokterRacikanDetail = $resepDokterRacikanDetail;
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

    function update($params,$set)
    {
        $return=1;
        try{
            $query=$this->resepObat;
            foreach($params as $key => $value){
                $query=$query->where($key,'=',$value);
            }
            $query->update($set);
            $return=1;
        }catch(\Illuminate\Database\QueryException $e){
            if($e->errorInfo[1] == '1062'){
                $return=0;
            }
            $return=0;

        } catch (\Throwable $e) {
            $return=0;
        }

        return $return;
    }

    function delete($params)
    {
        $query=$this->resepObat;
        foreach($params as $key => $value){
            $query=$query->where($key,'=',$value);
        }
        return $query->delete();
    }

    function resep_dokter_racikan($params)
    {
        $query=$this->resepDokterRacikan;
        foreach($params as $key => $value){
            $query=$query->where($key,'=',$value);
        }
        return $query->delete();
    }

    function resep_dokter_racikan_detail($params)
    {
        $query=$this->resepDokterRacikanDetail;
        foreach($params as $key => $value){
            $query=$query->where($key,'=',$value);
        }
        return $query->delete();
    }

    function getListBarang($params=[]){

        $kenaikan=!empty(config('configkhanza.kenaikan')) ? config('configkhanza.kenaikan') : 0;
        $aktifkan_batch_obat=!empty(config('configkhanza.AKTIFKANBATCHOBAT')) ? config('configkhanza.AKTIFKANBATCHOBAT') : 'no';
        $stok_kosong_resep=!empty(config('configkhanza.STOKKOSONGRESEP')) ? config('configkhanza.STOKKOSONGRESEP') : 'no';
        $return='';
        if($kenaikan>0){
            if( strtolower($aktifkan_batch_obat)=='yes'){
                $query= $this->dataBarang
                    ->select('databarang.kode_brng','databarang.nama_brng','jenis.nama','databarang.kode_sat','databarang.karyawan','databarang.ralan','databarang.beliluar','databarang.kelas1','databarang.kelas2','databarang.kelas3','databarang.vip','databarang.vvip','databarang.letak_barang','databarang.utama','industrifarmasi.nama_industri','databarang.h_beli',DB::raw('sum(gudangbarang.stok) as stok'),'databarang.kapasitas')
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
                    ->select('databarang.kode_brng','databarang.nama_brng','jenis.nama','databarang.kode_sat',DB::raw('(databarang.h_beli+(databarang.h_beli*'.$kenaikan.')) as harga'),'databarang.letak_barang','industrifarmasi.nama_industri','databarang.h_beli','gudangbarang.stok','databarang.kapasitas')
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
                    ->select('databarang.kode_brng','databarang.nama_brng','jenis.nama','databarang.kode_sat','databarang.karyawan','databarang.ralan','databarang.beliluar','databarang.kelas1','databarang.kelas2','databarang.kelas3','databarang.vip','databarang.vvip','databarang.letak_barang','databarang.utama','industrifarmasi.nama_industri','databarang.h_beli','gudangbarang.stok','databarang.kapasitas')
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

    function getResepList($params=[])
    {
        $query= $this->resepObat
            ->select('resep_obat.no_resep', 'resep_obat.tgl_peresepan', 'resep_obat.jam_peresepan', 'resep_obat.no_rawat', 'pasien.no_rkm_medis', 'pasien.nm_pasien', 'resep_obat.kd_dokter', 'dokter.nm_dokter',DB::raw("IF( resep_obat.tgl_perawatan = '0000-00-00', 'Belum Terlayani', 'Sudah Terlayani' ) AS status "),'poliklinik.nm_poli','reg_periksa.kd_poli','penjab.png_jawab',DB::raw("IF( resep_obat.tgl_perawatan = '0000-00-00', '', resep_obat.tgl_perawatan ) AS tgl_perawatan "),DB::raw("IF( resep_obat.jam = '00:00:00', '', resep_obat.jam ) AS jam "),DB::raw("IF( resep_obat.tgl_penyerahan = '0000-00-00', '', resep_obat.tgl_penyerahan ) AS tgl_penyerahan "),DB::raw("IF( resep_obat.jam_penyerahan = '00:00:00', '', resep_obat.jam_penyerahan ) AS jam_penyerahan "))
            ->join( 'reg_periksa', 'resep_obat.no_rawat', '=' ,'reg_periksa.no_rawat')
            ->join( 'pasien', 'reg_periksa.no_rkm_medis', '=' ,'pasien.no_rkm_medis')
            ->join( 'dokter', 'resep_obat.kd_dokter', '=' ,'dokter.kd_dokter')
            ->join( 'poliklinik', 'reg_periksa.kd_poli', '=' ,'poliklinik.kd_poli')
            ->join( 'penjab', 'reg_periksa.kd_pj', '=' ,'penjab.kd_pj')
            ->join( 'resep_dokter_racikan', 'resep_dokter_racikan.no_resep', '=' ,'resep_obat.no_resep')
            ->join( 'resep_dokter_racikan_detail', 'resep_dokter_racikan_detail.no_resep', '=' ,'resep_obat.no_resep')
            ->orderBy('resep_obat.tgl_peresepan', 'DESC')
            ->orderBy('resep_obat.jam_peresepan', 'DESC')
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

    function getResepDokterRacikan($params=[]){
        $query= $this->resepDokterRacikan
            ->select('resep_dokter_racikan.no_racik','resep_dokter_racikan.nama_racik','resep_dokter_racikan.kd_racik','metode_racik.nm_racik as metode','resep_dokter_racikan.jml_dr','resep_dokter_racikan.aturan_pakai','resep_dokter_racikan.keterangan')
            ->join('metode_racik','resep_dokter_racikan.kd_racik','=','metode_racik.kd_racik')
        ;

        if($params){
            foreach($params as $key =>$value){
                $type=is_numeric($value) ? '=' : 'like';
                $query->where($key,$type,$value);
            }
        }

        return $query->get();
    }

    function getResepDokterRacikanDetail($params=[]){
        $query= $this->resepDokterRacikanDetail
            ->select('databarang.kode_brng','databarang.nama_brng','resep_dokter_racikan_detail.jml','databarang.kode_sat','resep_dokter_racikan_detail.p1','resep_dokter_racikan_detail.p2','resep_dokter_racikan_detail.kandungan','resep_dokter_racikan_detail.no_racik')
            ->join('databarang','resep_dokter_racikan_detail.kode_brng','=','databarang.kode_brng')
            ->orderBy('databarang.kode_brng','ASC')
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
            ->join( 'resep_dokter_racikan', 'resep_dokter_racikan.no_resep', '=' ,'resep_obat.no_resep')
            ->join( 'resep_dokter_racikan_detail', 'resep_dokter_racikan_detail.no_resep', '=' ,'resep_obat.no_resep')
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
            $detail=$this->getResepDokterRacikan(['resep_dokter_racikan.no_resep'=>$value->no_resep]);
            foreach($detail as $key_item => $value_item){
                $value_item=(object)$value_item->getAttributes();
                $tmp['item_resep_racikan'][$value_item->no_racik]=$value_item;
            }

            $detail=$this->getResepDokterRacikanDetail(['resep_dokter_racikan_detail.no_resep'=>$value->no_resep]);
            foreach($detail as $key_item => $value_item){
                $value_item=(object)$value_item->getAttributes();
                $tmp['item_resep_racikan_detail'][$value_item->no_racik][]=$value_item;
            }
            $return[]=(object)$tmp;
        }


        return $return;
    }
}