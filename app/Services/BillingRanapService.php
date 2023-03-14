<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BillingRanapService extends BaseService
{
    public function __construct(){
        parent::__construct();
    }

    function getDataPasien($params=[]){
        $sql="
            select reg_periksa.no_rkm_medis,reg_periksa.no_rawat,pasien.nm_pasien,concat(DATE_FORMAT(reg_periksa.tgl_registrasi, '%e %M %Y'),' ',reg_periksa.jam_reg) as registrasi,kamar_inap.kd_kamar,concat(if(kamar_inap.tgl_keluar='0000-00-00',DATE_FORMAT(CURDATE(), '%e %M %Y'),DATE_FORMAT(kamar_inap.tgl_keluar, '%e %M %Y')),' ',kamar_inap.jam_keluar) as keluar,
            (select sum(kamar_inap.lama) from kamar_inap where kamar_inap.no_rawat=reg_periksa.no_rawat ) as lama,reg_periksa.biaya_reg,reg_periksa.umurdaftar,reg_periksa.sttsumur,reg_periksa.tgl_registrasi
            from reg_periksa inner join kamar_inap on reg_periksa.no_rawat=kamar_inap.no_rawat
            inner join pasien on pasien.no_rkm_medis=reg_periksa.no_rkm_medis
            where reg_periksa.no_rawat=?
            order by kamar_inap.tgl_keluar desc limit 1
        ";
        $result=DB::select($sql,[$params['no_rawat']]);
        return !empty($result[0]) ? $result[0] : [];
    }

    function getKamarInapPasien($params=[]){

        $sql="
            select kamar_inap.kd_kamar,bangsal.nm_bangsal,bangsal.kd_bangsal,kamar_inap.trf_kamar,
            kamar_inap.lama,kamar_inap.ttl_biaya as total,kamar_inap.tgl_masuk,
            kamar_inap.jam_masuk,if(kamar_inap.tgl_keluar='0000-00-00',current_date(),kamar_inap.tgl_keluar) as tgl_keluar,
            if(kamar_inap.jam_keluar='00:00:00',current_time(),kamar_inap.jam_keluar) as jam_keluar
            from kamar_inap inner join bangsal inner join kamar
            on kamar_inap.kd_kamar=kamar.kd_kamar
            and kamar.kd_bangsal=bangsal.kd_bangsal where
            kamar_inap.no_rawat=? order by kamar_inap.tgl_masuk,kamar_inap.kd_kamar
        ";
        $result=DB::select($sql,[$params['no_rawat']]);
        return $result;
    }

    function getTagihan($params=[],$type=''){
        // dd($type);
        $list_data=[];

        // $sql="
        //     select * from set_nota
        // ";
        // $result=DB::select($sql);
        // $pengaturan_nota=!empty($result[0]) ? $result[0] : [];

        $list_data['data_pasien']=$this->getDataPasien($params);
        $data_pasien='';
        if(!empty($list_data['data_pasien'])){
            $data_pasien=$list_data['data_pasien'];

            $sql="
                select concat(kamar.kd_kamar,', ',bangsal.nm_bangsal) bangsal from bangsal inner join kamar on kamar.kd_bangsal=bangsal.kd_bangsal where kamar.kd_kamar=?
            ";
            $result=DB::select($sql,[$data_pasien->kd_kamar]);
            $list_data['bangsal']=!empty($result[0]) ? $result[0]->bangsal : [];

            $sql="
                select pasien.no_rkm_medis,pasien.nm_pasien,ranap_gabung.no_rawat2 from reg_periksa inner join pasien inner join ranap_gabung on pasien.no_rkm_medis=reg_periksa.no_rkm_medis and ranap_gabung.no_rawat2=reg_periksa.no_rawat where ranap_gabung.no_rawat=?
            ";
            $result=DB::select($sql,[$params['no_rawat']]);
            $list_data['bayi']=!empty($result[0]) ? $result[0] : [];

            $sql="
                select concat(pasien.alamat,', ',kelurahan.nm_kel,', ',kecamatan.nm_kec,', ',kabupaten.nm_kab) alamat from pasien
                inner join kelurahan inner join kecamatan inner join kabupaten on pasien.kd_kel=kelurahan.kd_kel
                and pasien.kd_kec=kecamatan.kd_kec and pasien.kd_kab=kabupaten.kd_kab
                where pasien.no_rkm_medis=?
            ";
            $result=DB::select($sql,[$data_pasien->no_rkm_medis]);
            $list_data['alamat']=!empty($result[0]) ? $result[0]->alamat : [];

            $sql="
                select dokter.nm_dokter from rawat_jl_dr
                inner join dokter on rawat_jl_dr.kd_dokter=dokter.kd_dokter
                where rawat_jl_dr.no_rawat=? group by rawat_jl_dr.kd_dokter
            ";
            $result=DB::select($sql,[$params['no_rawat']]);
            $list_data['dokter_ralan']=$result;

            $sql="
                select dokter.nm_dokter from rawat_inap_dr
                inner join dokter on rawat_inap_dr.kd_dokter=dokter.kd_dokter
                where rawat_inap_dr.no_rawat=? group by rawat_inap_dr.kd_dokter
            ";
            $result=DB::select($sql,[$params['no_rawat']]);
            $list_data['dokter_ranap']=$result;

            $list_data['ruang']=$this->getKamarInapPasien($params);

            $sql="
            SELECT DISTINCT
             kategori_perawatan.kd_kategori, kategori_perawatan.nm_kategori  FROM kategori_perawatan INNER JOIN jns_perawatan_inap ON jns_perawatan_inap.kd_kategori = kategori_perawatan.kd_kategori INNER JOIN rawat_inap_dr ON rawat_inap_dr.kd_jenis_prw =jns_perawatan_inap.kd_jenis_prw WHERE rawat_inap_dr.no_rawat = ?
            ";
            $result=DB::select($sql,[$params['no_rawat']]);
            $list_data['kode_perawatan_inap']=$result;

            if(!empty($list_data['kode_perawatan_inap'])){
                foreach($list_data['kode_perawatan_inap'] as $item){
                    $sql="
                    SELECT jns_perawatan_inap.nm_perawatan, rawat_inap_dr.biaya_rawat AS total_byrdr, count( rawat_inap_dr.kd_jenis_prw ) AS jml,sum( rawat_inap_dr.biaya_rawat ) AS biaya FROM rawat_inap_dr INNER JOIN jns_perawatan_inap INNER JOIN kategori_perawatan ON rawat_inap_dr.kd_jenis_prw = jns_perawatan_inap.kd_jenis_prw AND jns_perawatan_inap.kd_kategori = kategori_perawatan.kd_kategori WHERE rawat_inap_dr.no_rawat = ? AND kategori_perawatan.kd_kategori = ? GROUP BY rawat_inap_dr.kd_jenis_prw
                    ";
                    $result=DB::select($sql,[$params['no_rawat'],$item->kd_kategori]);
                    $list_data['data_perawatan_inap'][$item->nm_kategori]=!empty($result) ? $result : "";
                }
            }

            $sql="
            SELECT DISTINCT kategori_perawatan.kd_kategori , kategori_perawatan.nm_kategori FROM kategori_perawatan INNER JOIN jns_perawatan ON jns_perawatan.kd_kategori = kategori_perawatan.kd_kategori INNER JOIN rawat_jl_dr ON rawat_jl_dr.kd_jenis_prw = jns_perawatan.kd_jenis_prw WHERE rawat_jl_dr.no_rawat = ?
            ";
            $result=DB::select($sql,[$params['no_rawat']]);
            $list_data['kode_perawatan_jalan']=$result;


            if(!empty($list_data['kode_perawatan_jalan'])){
                foreach($list_data['kode_perawatan_jalan'] as $item){
                    $sql="
                    SELECT jns_perawatan.nm_perawatan, rawat_jl_dr.biaya_rawat AS total_byrdr, count( rawat_jl_dr.kd_jenis_prw ) AS jml, sum( rawat_jl_dr.biaya_rawat ) AS biaya FROM rawat_jl_dr INNER JOIN jns_perawatan INNER JOIN kategori_perawatan ON rawat_jl_dr.kd_jenis_prw = jns_perawatan.kd_jenis_prw AND jns_perawatan.kd_kategori = kategori_perawatan.kd_kategori WHERE rawat_jl_dr.no_rawat = ? and kategori_perawatan.kd_kategori= ? GROUP BY rawat_jl_dr.kd_jenis_prw

                    ";
                    $result=DB::select($sql,[$params['no_rawat'],$item->kd_kategori]);
                    $list_data['data_perawatan_jalan'][$item->nm_kategori]=!empty($result) ? $result : "";
                }
            }


            if(!empty($list_data['pemeriksaan_radiologi'])){
                foreach($list_data['pemeriksaan_radiologi'] as $item_radiologi){

                    $sql="
                        select temporary_tambahan_potongan.biaya from temporary_tambahan_potongan
                        where temporary_tambahan_potongan.no_rawat=?
                        and temporary_tambahan_potongan.nama_tambahan=?
                        and temporary_tambahan_potongan.status=?
                    ";
                    $result=DB::select($sql,[$params['no_rawat'],$item_radiologi->nm_perawatan,'Radiologi']);
                    $list_data['pemeriksaan_radiologi_detail'][$item_radiologi->kd_jenis_prw]=!empty($result[0]) ? $result[0]->biaya : 0;
                }
            }




            $sql="
                select jns_perawatan_lab.nm_perawatan, count(periksa_lab.kd_jenis_prw) as jml,periksa_lab.biaya as biaya,
                sum(periksa_lab.biaya) as total,jns_perawatan_lab.kd_jenis_prw
                from periksa_lab inner join jns_perawatan_lab
                on jns_perawatan_lab.kd_jenis_prw=periksa_lab.kd_jenis_prw where
                periksa_lab.no_rawat=? group by periksa_lab.kd_jenis_prw
            ";
            $result=DB::select($sql,[$params['no_rawat']]);
            $list_data['pemeriksaan_lab']=$result;

            if(!empty($list_data['pemeriksaan_lab'])){
                foreach($list_data['pemeriksaan_lab'] as $item_pemeriksaan_lab){
                    $sql="
                        select sum(detail_periksa_lab.biaya_item) as total from detail_periksa_lab
                        where detail_periksa_lab.no_rawat=?
                        and detail_periksa_lab.kd_jenis_prw=?
                    ";
                    $result=DB::select($sql,[$params['no_rawat'],$item_pemeriksaan_lab->kd_jenis_prw]);
                    $list_data['pemeriksaan_lab_detail'][$item_pemeriksaan_lab->kd_jenis_prw]=!empty($result[0]) ? $result[0]->total : 0;
                }
            }

            $sql="
                select jns_perawatan_radiologi.nm_perawatan, count(periksa_radiologi.kd_jenis_prw) as jml,periksa_radiologi.biaya as biaya,
                sum(periksa_radiologi.biaya) as total,jns_perawatan_radiologi.kd_jenis_prw
                from periksa_radiologi inner join jns_perawatan_radiologi
                on jns_perawatan_radiologi.kd_jenis_prw=periksa_radiologi.kd_jenis_prw where
                periksa_radiologi.no_rawat=?  group by periksa_radiologi.kd_jenis_prw
            ";
            $result=DB::select($sql,[$params['no_rawat']]);
            $list_data['pemeriksaan_radiologi']=$result;

            if(!empty($list_data['pemeriksaan_radiologi'])){
                foreach($list_data['pemeriksaan_radiologi'] as $item_radiologi){

                    $sql="
                        select temporary_tambahan_potongan.biaya from temporary_tambahan_potongan
                        where temporary_tambahan_potongan.no_rawat=?
                        and temporary_tambahan_potongan.nama_tambahan=?
                        and temporary_tambahan_potongan.status=?
                    ";
                    $result=DB::select($sql,[$params['no_rawat'],$item_radiologi->nm_perawatan,'Radiologi']);
                    $list_data['pemeriksaan_radiologi_detail'][$item_radiologi->kd_jenis_prw]=!empty($result[0]) ? $result[0]->biaya : 0;
                }
            }

            $sql = "
            SELECT paket_operasi.nm_perawatan, SUM( operasi.biayaoperator1 + operasi.biayaoperator2 + operasi.biayaoperator3 + operasi.biayaasisten_operator1 + operasi.biayaasisten_operator2 + operasi.biayaasisten_operator3 + operasi.biayainstrumen + operasi.biayadokter_anak + operasi.biayaperawaat_resusitas + operasi.biayadokter_anestesi + operasi.biayaasisten_anestesi + operasi.biayaasisten_anestesi2 + operasi.biayabidan + operasi.biayabidan2 + operasi.biayabidan3 + operasi.biayaperawat_luar + operasi.biayaalat + operasi.biayasewaok + operasi.akomodasi + operasi.bagian_rs + operasi.biaya_omloop + operasi.biaya_omloop2 + operasi.biaya_omloop3 + operasi.biaya_omloop4 + operasi.biaya_omloop5 + operasi.biayasarpras + operasi.biaya_dokter_pjanak + operasi.biaya_dokter_umum ) AS biaya, SUM( IFNULL(tambahan_biaya.besar_biaya, 0) ) AS tambahan, COUNT( paket_operasi.nm_perawatan ) AS jumlah FROM operasi INNER JOIN paket_operasi ON operasi.kode_paket = paket_operasi.kode_paket LEFT JOIN tambahan_biaya ON operasi.no_rawat = tambahan_biaya.no_rawat WHERE operasi.no_rawat = ? AND operasi.STATUS LIKE 'Ranap' GROUP BY paket_operasi.nm_perawatan;

            ";

            $result=DB::select($sql,[$params['no_rawat']]);
            $list_data['operasi']=$result;

            $sql = "
            SELECT databarang.nama_brng, jenis.nama, detail_pemberian_obat.biaya_obat,SUM(detail_pemberian_obat.jml) AS jml,SUM(detail_pemberian_obat.embalase + detail_pemberian_obat.tuslah) AS tambahan,(SUM(detail_pemberian_obat.total) - SUM(detail_pemberian_obat.embalase + detail_pemberian_obat.tuslah)) AS total
            FROM detail_pemberian_obat
            INNER JOIN databarang ON detail_pemberian_obat.kode_brng = databarang.kode_brng
            INNER JOIN jenis ON databarang.kdjns = jenis.kdjns
            WHERE
            detail_pemberian_obat.no_rawat = ?
            GROUP BY databarang.kode_brng, detail_pemberian_obat.biaya_obat
            ORDER BY jenis.nama
            ";

            $result=DB::select($sql,[$params['no_rawat']]);
            $list_data['obat_bhp']=$result;
            // dd($list_data);

            $sql="
                select * from ".(new \App\Models\UxuiPasienPindahKamar())->table."
                where no_rawat=? and no_rkm_medis=?
            ";
            $result=DB::select($sql,[$params['no_rawat'],$data_pasien->no_rkm_medis]);
            $list_data['pindah_kamar']=$result;
        }
        // dd($list_data);
        return $list_data;
    }

    function getBilling($params=[],$type=''){
        $list_data=[];

        $list_data['data_pasien']=$this->getDataPasien($params);
        $data_pasien='';
        if(!empty($list_data['data_pasien'])){
            $data_pasien=$list_data['data_pasien'];
        }
        return $list_data;
    }

    function getDataPindahKamar($params=[],$type=''){
        $pdf_data = [];
        $pindah_kamar_params = $params['pindah_kamar_params'];
        if(array_key_exists('key_me',$params['pindah_kamar_params'])){
            $tmp=$params['pindah_kamar_params']['key_me'];
            unset($params['pindah_kamar_params']['key_me']);
            $params['pindah_kamar_params']['id_pindah_kamar']=$tmp;
            $pindah_kamar_params = $params['pindah_kamar_params'];
        }

        $table_name ="uxui_pasien_pindah_kamar";
        $prefixed_params = array_reduce(array_keys($pindah_kamar_params), function($result, $key) use ($pindah_kamar_params, $table_name) {
            return $result + [$table_name .'.'. $key => $pindah_kamar_params[$key]];
        }, []);

        $pdf_data['data_settings'] = (new \App\Services\GlobalService())->getSettingsKhanza();
        $pdf_data['data_pindahan'] = (new \App\Models\UxuiPasienPindahKamar())->select("uxui_pasien_pindah_kamar.*", "pasien.nm_pasien", "pasien.alamat", "penjab.png_jawab")
                                                ->join('pasien', 'pasien.no_rkm_medis','=',  'uxui_pasien_pindah_kamar.no_rkm_medis')
                                                ->join('reg_periksa','uxui_pasien_pindah_kamar.no_rawat','=','reg_periksa.no_rawat')
                                                ->join('penjab','reg_periksa.kd_pj','=','penjab.kd_pj')
                                                ->where($prefixed_params)->first();
        return $pdf_data;
    }
}
