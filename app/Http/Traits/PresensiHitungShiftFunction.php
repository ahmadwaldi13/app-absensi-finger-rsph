<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

use App\Http\Traits\AbsensiFunction;

trait PresensiHitungShiftTraits {

    public $absensif;
    public function __construct()
    {
        $this->absensif = new AbsensiFunction;
    }

    public function hitung_jadwal($data=[]){
        $data=(object)$data;
        $data_jadwal=!empty($data->data_jadwal) ? $data->data_jadwal : '';
        $data_jadwal_mesin=!empty($data->data_jadwal_mesin) ? $data->data_jadwal_mesin : '';
        $user_presensi=!empty($data->user_presensi) ? $data->user_presensi : [];

        $jam_masuk_kerja=!empty($data_jadwal->masuk_kerja) ? $data_jadwal->masuk_kerja : '';
        $jam_pulang_kerja=!empty($data_jadwal->pulang_kerja) ? $data_jadwal->pulang_kerja : '';

        $jam_masuk_kerja_sec=$this->absensif->his_to_seconds($jam_masuk_kerja);
        $jam_pulang_kerja_sec=$this->absensif->his_to_seconds($jam_pulang_kerja);

        $total_kerja_default_sec=$jam_pulang_kerja_sec-$jam_masuk_kerja_sec;
        if(!empty($data_jadwal->pulang_kerja_next_day)){
            $total_kerja_default_sec=$jam_masuk_kerja_sec-$jam_pulang_kerja_sec;
        }
        $total_kerja_default_sec_text=gmdate("H:i:s", $total_kerja_default_sec);
        
        $data_jadwal_mesin_json=[];
        if(!empty($data_jadwal_mesin[$data_jadwal->id_jenis_jadwal])){
            foreach($data_jadwal_mesin[$data_jadwal->id_jenis_jadwal] as $item){
                $data_jadwal_mesin_json[$item->kd_jadwal]=[
                    $item->kd_jadwal,
                    $item->uraian,
                    $item->alias,
                    $item->jam_awal,
                    $item->jam_akhir,
                    $item->status_toren_jam_cepat,
                    $item->toren_jam_cepat,
                    $item->status_toren_jam_telat,
                    $item->toren_jam_telat,
                    $item->status_jadwal,
                ];
            }
        }
        $data_jadwal_mesin_json=!empty($data_jadwal_mesin_json) ? json_encode($data_jadwal_mesin_json) : json_encode([]);
        
        $hasil_presensi_by_mesin=$this->absensif->get_presensi_by_jadwal_mesin($data_jadwal_mesin_json,$user_presensi);
        $hasil_presensi_user=!empty($hasil_presensi_by_mesin->hasil_presensi) ? $hasil_presensi_by_mesin->hasil_presensi : '';
        
        // var_dump($data_jadwal_mesin_json,$user_presensi,$hasil_presensi_by_mesin->hasil_presensi);


        // die;
        
    }

    public function getHitung($data=[]){
        $data=(object)$data;
        $tanggal=!empty($data->tgl) ? $data->tgl : '';
        $data_presensi_user=!empty($data->data_presensi_user) ? $data->data_presensi_user : '';
        $tamplate_jadwal=!empty($data->tamplate_jadwal) ? $data->tamplate_jadwal : '';
        $data_jadwal_shift_by_sistem=!empty($data->data_jadwal_shift_by_sistem) ? $data->data_jadwal_shift_by_sistem : '';

        if(!empty($tamplate_jadwal[$tanggal])){
            foreach($tamplate_jadwal[$tanggal] as $jadwal){
                $jadwal=(object)$jadwal;
                if(empty($jadwal->pulang_kerja_next_day)){
                    // dd($jadwal);
                    if(!empty($data_jadwal_shift_by_sistem[$jadwal->id_jenis_jadwal])){
                        $data_proses=[
                            'user_presensi'=>!empty($data_presensi_user[$tanggal]->presensi) ? $data_presensi_user[$tanggal]->presensi : '',
                            'data_jadwal'=>$jadwal,
                            'data_jadwal_mesin'=>$data_jadwal_shift_by_sistem,
                        ];
                        $hasil=$this->hitung_jadwal($data_proses);
                    }
                }else{

                }
                
            }
        }

        // dd($tamplate_jadwal[$tanggal],$data_jadwal_shift_by_sistem);
        // dd($data,$tanggal,$tamplate_jadwal,$data_jadwal_shift_by_sistem);
        // $jadwal_presensi_tmp=!empty($data['data_jadwal_kerja']) ? $data['data_jadwal_kerja'] : '';
        // $user_presensi=!empty($data['list_presensi']) ? $data['list_presensi'] : '';

        // dd($jadwal_presensi_tmp,$user_presensi);

        // die;
    }
}

class PresensiHitungShiftFunction {
    use PresensiHitungShiftTraits;
}

?>