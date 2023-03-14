<?php

namespace App\Models;

class UxuiPermintaanBarangNonMedisStatus extends \App\Models\MyModel
{
    protected $table = 'uxui_permintaan_barang_non_medis_status';

    /*
        pengajuan = 1 sebagai pengajuan permintaan barang
        verifikasi_ke = sebagai user verifikasi ke n
        status
        jika sebagai pengajuan (
            0=pengajuan, 1=proses, 2=terima, 3=tolak
        ) 
        jika sebagai verifikasi (
            2=terima,3=tolak
        ) 
    */

    function set_status_verifikasi(){
        $status_verifikasi=['Pengajuan','Di Proses','Di Berikan','Di Tolak', 'Di Terima'];
        $status_khanza=['Baru','Baru','Disetujui','Tidak Disetujui'];
        $status_verifikator=[0=>'Di Proses',2=>'Di Terima', 3=>'Di Tolak', 'Di Terima'];

        return (object)[
            'status_verifikasi'=>$status_verifikasi,
            'status_khanza'=>$status_khanza,
            'status_verifikator'=>$status_verifikator
        ];
    }

    function get_status_verifikasi($status,$status_khanza='',$no_permintaan=''){
        $data_verifikasi=$this->set_status_verifikasi()->status_verifikasi;
        $data_khanza=$this->set_status_verifikasi()->status_khanza;
        $data_verifikator=$this->set_status_verifikasi()->status_verifikator;
        
        // dd($data_verifikasi, $data_khanza, $data_verifikator);
        if(empty($status)){
            $status=0;
        }
        if(!empty($status_khanza)){
            if(empty($status)){
                // di kasih equal == 2 karena di aplikasi khanza gak ada status tambahan kayak diberikan cuman ada di setujui
                // jadi kalo udah sampe 'diberikan' si khanza bakal nganggap udah di terima
                if(array_search($status_khanza, $data_khanza) == 2){
                    $status = 4;
                }else{
                    $status=array_search($status_khanza, $data_khanza);
                } 
            }
        }
        $return_status_verifikasi='';
        $return_status_khanza='';
        if(array_key_exists($status,$data_verifikasi)){
            $return_status_verifikasi=$data_verifikasi[$status];
        }

        if(array_key_exists($status,$data_khanza)){
            $return_status_khanza=$data_khanza[$status];
        }

        $list_verifikasi=[];
        if(!empty($no_permintaan)){
            $data=$this->where('no_permintaan','=',$no_permintaan)
                ->where('pengajuan','<>',1)
                ->whereRaw('verifikasi_ke'.' is not null ',null)
                ->orderBy('verifikasi_ke','ASC')
                ->get();
            if(!empty($data)){
                foreach($data as $value){
                    $pegawai=(new \App\Services\PegawaiService() )->getList(['nik'=>$value->nip],1)->first();
                    if(!empty($pegawai)){

                        $status_verifikatori='';
                        if(array_key_exists($value->status,$data_verifikator)){
                            $status_verifikatori=$data_verifikator[$value->status];
                        }

                        $list_verifikasi[]=[
                            'nip'=>$value->nip,
                            'nm_pegawai'=>!empty($pegawai->nama) ? $pegawai->nama : '',
                            'nm_departemen'=>!empty($pegawai->departemen) ? $pegawai->departemen_nama : '',
                            'verifikasi_ke'=>$value->verifikasi_ke,
                            'verifikasi_status'=>$status_verifikatori,
                            'keterangan'=>$value->keterangan,
                        ];
                    }
                }
            }
        }

        $data = (object)[
            'status_verifikasi'=>$return_status_verifikasi,
            'status_khanza'=>$return_status_khanza,
            'status'=>$status,
            'list_verifikasi'=>$list_verifikasi
        ];
        return $data;
    }

    function check_status($status_verif,$status_khanza){
        
        $hasil_verif='Pengajuan';
        if($status_verif==1){
            $hasil_verif='Di Proses';
        }elseif($status_verif==2){
            $hasil_verif='Diterima';
        }elseif($status_verif==3){
            $hasil_verif='Ditolak';
        }

        $action_active=1;
        if(!empty($status_verif)){
            $action_active=0;
        }

        if(trim( strtolower($status_khanza) ) !='baru' ){
            if(empty($status_verif)){
                $hasil_verif='';
                $action_active=0;
            }
        }

        return (object)[
            'status_verifikasi'=>$hasil_verif,
            'status_button'=>$action_active
        ];
    }
}