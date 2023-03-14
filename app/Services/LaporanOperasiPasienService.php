<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Operasi;
use App\Models\LaporanOperasi;

class LaporanOperasiPasienService extends BaseService
{

    public function __construct(
        Operasi $operasi,
        LaporanOperasi $laporanOperasi
    ){
        parent::__construct();
        $this->operasi = $operasi;
        $this->laporanOperasi = $laporanOperasi;
    }

    function insert($fields)
    {
        foreach ($fields as $key => $field) {
            $field == null ? $fields[$key] = "" : "";
        }
        return $this->laporanOperasi->insert($fields);
    }

    function delete($params,$type='')
    {
        $query=$this->laporanOperasi;
        foreach($params as $key => $value){
            if($type=='raw'){
                $query=$query->whereRaw($key.' = ? ', [$value]);
            }else{
                $query=$query->where($key,'=',$value);
            }
        }
        return $query->delete();
    }

    public function getDataOperasi($params,$type_return='')
    {
        $query = $this->operasi
            ->select('operasi.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien','operasi.jenis_anasthesi','operasi.tgl_operasi',DB::raw('group_concat(nm_perawatan) item_paket'),'operasi.operator1' )
            ->join('reg_periksa','operasi.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->leftJoin('paket_operasi','paket_operasi.kode_paket','=','operasi.kode_paket')
            ->groupBy(['operasi.no_rawat','operasi.tgl_operasi'])
            ->orderBy('operasi.tgl_operasi','desc')
            ->orderBy('operasi.no_rawat','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                if($key!='search' and $key!='tgl_operasi'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_operasi'])){
                $data_tgl=$params['tgl_operasi'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    // $query->whereBetween('operasi.tgl_operasi', $data_tgl);
                    $query->whereBetween(DB::raw('date(operasi.tgl_operasi)'),$data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('operasi.tgl_operasi', 'LIKE', '%' . $search . '%')
                        ->orWhere('operasi.jenis_anasthesi', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        if(empty($type_return)){
            return $query->get();
        }else{
            return $query;
        }
    }

    public function getDataOperasiDetail($params,$type_return='')
    {
        $query = $this->operasi
            ->select('operasi.no_rawat','reg_periksa.no_rkm_medis','pasien.nm_pasien','operasi.jenis_anasthesi','operasi.tgl_operasi','operasi.operator1','operasi.operator2','operasi.operator3','operasi.asisten_operator1','operasi.asisten_operator2','operasi.asisten_operator3','operasi.instrumen','operasi.dokter_anak','operasi.perawaat_resusitas','operasi.dokter_anestesi','operasi.asisten_anestesi','operasi.asisten_anestesi2','operasi.bidan','operasi.bidan2','operasi.bidan3','operasi.perawat_luar','operasi.omloop','operasi.omloop2','operasi.omloop3','operasi.omloop4','operasi.omloop5','operasi.dokter_pjanak','operasi.dokter_umum','operasi.kode_paket','paket_operasi.nm_perawatan','operasi.biayaoperator1','operasi.biayaoperator2','operasi.biayaoperator3','operasi.biayaasisten_operator1','operasi.biayaasisten_operator2','operasi.biayaasisten_operator3','operasi.biayainstrumen','operasi.biayadokter_anak','operasi.biayaperawaat_resusitas','operasi.biayadokter_anestesi','operasi.biayaasisten_anestesi','operasi.biayaasisten_anestesi2','operasi.biayabidan','operasi.biayabidan2','operasi.biayabidan3','operasi.biayaperawat_luar','operasi.biayaalat','operasi.biayasewaok','operasi.akomodasi','operasi.bagian_rs','operasi.biaya_omloop','operasi.biaya_omloop2','operasi.biaya_omloop3','operasi.biaya_omloop4','operasi.biaya_omloop5','operasi.biayasarpras','operasi.biaya_dokter_pjanak','operasi.biaya_dokter_umum',DB::raw('(
                    operasi.biayaoperator1 + operasi.biayaoperator2 + operasi.biayaoperator3 + operasi.biayaasisten_operator1 + operasi.biayaasisten_operator2 + operasi.biayaasisten_operator3 + operasi.biayainstrumen + operasi.biayadokter_anak + operasi.biayaperawaat_resusitas + operasi.biayadokter_anestesi + operasi.biayaasisten_anestesi + operasi.biayaasisten_anestesi2 + operasi.biayabidan + operasi.biayabidan2 + operasi.biayabidan3 + operasi.biayaperawat_luar + operasi.biayaalat + operasi.biaya_dokter_pjanak + operasi.biaya_dokter_umum + operasi.biayasewaok + operasi.akomodasi + operasi.bagian_rs + operasi.biaya_omloop + operasi.biaya_omloop2 + operasi.biaya_omloop3 + operasi.biaya_omloop4 + operasi.biaya_omloop5 + operasi.biayasarpras
                ) AS total'),DB::raw('d1.nm_dokter nm_operator1'),DB::raw('d2.nm_dokter nm_operator2'),DB::raw('d3.nm_dokter nm_operator3'),DB::raw('d4.nm_dokter nm_dokter_anak'),DB::raw('d5.nm_dokter nm_dokter_anestesi'),DB::raw('p1.nama nm_asisten_operator1'),DB::raw('p2.nama nm_asisten_operator2'),DB::raw('p3.nama nm_asisten_operator3'),DB::raw('p4.nama nm_instrumen'),DB::raw('p5.nama nm_perawaat_resusitas'),DB::raw('p6.nama nm_asisten_anestesi'),DB::raw('p7.nama nm_asisten_anestesi2'),DB::raw('p8.nama nm_bidan'),DB::raw('p9.nama nm_bidan2'),DB::raw('p10.nama nm_bidan3'),DB::raw('p11.nama nm_perawat_luar'),DB::raw('p12.nama nm_omloop'),DB::raw('p13.nama nm_omloop2'),DB::raw('p14.nama nm_omloop3'),DB::raw('p15.nama nm_omloop4'),
                DB::raw('p16.nama nm_omloop5'))
            ->join('reg_periksa','operasi.no_rawat','=','reg_periksa.no_rawat')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join('paket_operasi','operasi.kode_paket','=','paket_operasi.kode_paket')
            ->leftJoin(DB::raw('dokter d1'),'d1.kd_dokter','=','operasi.operator1')
            ->leftJoin(DB::raw('dokter d2'),'d2.kd_dokter','=','operasi.operator2')
            ->leftJoin(DB::raw('dokter d3'),'d3.kd_dokter','=','operasi.operator3')
            ->leftJoin(DB::raw('dokter d4'),'d4.kd_dokter','=','operasi.dokter_anak')
            ->leftJoin(DB::raw('dokter d5'),'d5.kd_dokter','=','operasi.dokter_anestesi')
            ->leftJoin(DB::raw('petugas p1'),'p1.nip','=','operasi.asisten_operator1')
            ->leftJoin(DB::raw('petugas p2'),'p2.nip','=','operasi.asisten_operator2')
            ->leftJoin(DB::raw('petugas p3'),'p3.nip','=','operasi.asisten_operator3')
            ->leftJoin(DB::raw('petugas p4'),'p4.nip','=','operasi.instrumen')
            ->leftJoin(DB::raw('petugas p5'),'p5.nip','=','operasi.perawaat_resusitas')
            ->leftJoin(DB::raw('petugas p6'),'p6.nip','=','operasi.asisten_anestesi')
            ->leftJoin(DB::raw('petugas p7'),'p7.nip','=','operasi.asisten_anestesi2')
            ->leftJoin(DB::raw('petugas p8'),'p8.nip','=','operasi.bidan')
            ->leftJoin(DB::raw('petugas p9'),'p9.nip','=','operasi.bidan2')
            ->leftJoin(DB::raw('petugas p10'),'p10.nip','=','operasi.bidan3')
            ->leftJoin(DB::raw('petugas p11'),'p11.nip','=','operasi.perawat_luar')
            ->leftJoin(DB::raw('petugas p12'),'p12.nip','=','operasi.omloop')
            ->leftJoin(DB::raw('petugas p13'),'p13.nip','=','operasi.omloop2')
            ->leftJoin(DB::raw('petugas p14'),'p14.nip','=','operasi.omloop3')
            ->leftJoin(DB::raw('petugas p15'),'p15.nip','=','operasi.omloop4')
            ->leftJoin(DB::raw('petugas p16'),'p16.nip','=','operasi.omloop5')
            ->orderBy('operasi.tgl_operasi','desc')
            ->orderBy('operasi.no_rawat','ASC')

        ;

        if($params){
            foreach($params as $key =>$value){
                if($key!='search' and $key!='tgl_operasi'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tgl_operasi'])){
                $data_tgl=$params['tgl_operasi'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    // $query->whereBetween('operasi.tgl_operasi', $data_tgl);
                    $query->whereBetween(DB::raw('date(operasi.tgl_operasi)'),$data_tgl);
                }
            }

            if(!empty($params['search'])){
                $search=$params['search'];
                $query->where(function ($qb2) use ($search) {
                    $qb2->where('reg_periksa.no_rkm_medis', 'LIKE', '%' . $search . '%')
                        ->orWhere('pasien.nm_pasien', 'LIKE', '%' . $search . '%')
                        ->orWhere('operasi.tgl_operasi', 'LIKE', '%' . $search . '%')
                        ->orWhere('operasi.jenis_anasthesi', 'LIKE', '%' . $search . '%')
                    ;
                });
            }
        }

        if(empty($type_return)){
            return $query->get();
        }else{
            return $query;
        }
    }

    public function getDataPermintaanPa($key=null){
        $data=['Ya','Tidak'];
        if($key){
            return !empty($data[$key]) ? $data[$key] : $data[0];
        }
        return $data;
    }

    public function getLaporanOperasiQueri1($params,$type_return='')
    {
        $query = $this->laporanOperasi
            ->select('tanggal','diagnosa_preop','diagnosa_postop','jaringan_dieksekusi','selesaioperasi','permintaan_pa','laporan_operasi')
            ->groupBy(['no_rawat','tanggal'])
            ->orderBy('tanggal','ASC')
        ;

        if($params){
            foreach($params as $key =>$value){
                if($key!='tanggal'){
                    $type=is_numeric($value) ? '=' : 'like';
                    $query->where($key,$type,$value);
                }
            }

            if(!empty($params['tanggal'])){
                $data_tgl=$params['tanggal'];
                if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                    $query->whereBetween(DB::raw('date(tanggal)'),$data_tgl);
                }
            }
        }

        if(empty($type_return)){
            return $query->get();
        }else{
            return $query;
        }
    }

    public function getLaporanOperasiCheckByDoketer($id_dokter,$tgl)
    {
        $data_operasi=$this->operasi->select('no_rawat','tgl_operasi')->where('operasi.operator1','=',$id_dokter);
        $change_norm=explode('-',$tgl[0]);
        $change_norm=implode('/',$change_norm);

        $change_norm2=explode('-',$tgl[1]);
        $change_norm2=implode('/',$change_norm2);
        $data_operasi=$data_operasi->whereBetween(DB::raw('SUBSTRING(no_rawat, 1, 10)'),[$change_norm,$change_norm2]);

        $data_operasi=$data_operasi->get();
        $data_operasi=$data_operasi->all();

        $data_return=[];
        foreach($data_operasi as $value){
            $data_return[$value->no_rawat]=$value->tgl_operasi;
        }
        return $data_return;
    }
}