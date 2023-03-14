<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianPerawatBayiService extends PenilaianPasienService
{
    public function updatePenilaian($params, $data_pasien){
        DB::beginTransaction();
        $message_default = [
            'success' => 'Data berhasil diperbaharui',
            'error' => 'Maaf data tidak berhasil diperbaharui atau tidak ada yang berubah'
        ];
        try {
            $finish = 0;
            foreach($params as $key => $value){
                if($value['type'] === "penilaian"){
                    $save_data = DB::table($value['table'])->updateOrInsert(['no_rawat' => $data_pasien['no_rawat']], $value['data'] );
                }else {
                    if($value['type']=== 'imunisasi'){
                        $delete_data = DB::table($value['table'])->where('no_rkm_medis' ,"=" , $data_pasien['no_rkm_medis'])->delete();
                    }else if($value['type'] === 'masalah'){
                        $delete_data = DB::table($value['table'])->where('no_rawat' ,"=" , $data_pasien['no_rawat'])->delete();
                    }
                    $save_data = DB::table($value['table'])->insert($value['data']); 
                }
                if($save_data ){
                    if($key === array_key_last($params)){
                        $finish = 1;
                    }
                }
            }
            if($finish) {
                DB::commit();
                return ['success' => $message_default['success']];
            }else {
                DB::rollBack();
                return ['error' => $message_default['error']. " (1)"];
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return ['error' => 'Data Penilaian Pasien ini Sudah Terisi!!'];
            }
            return ['error' => $message_default['error']." (2)"];

        } catch (\Throwable $e) {
            DB::rollBack();
            return ['error' => $message_default['error']." (3)"];
        }
    }
    public function deletePenilaian($params){
        DB::beginTransaction();
        $message_default = [
            'success' => 'Data berhasil dihapus',
            'error' => 'Maaf data tidak berhasil dihapus'
        ];
        try {
            $is_delete = 0;
            $table_finished = 0;
            $delete_penilaian = DB::table($params['table_list']['penilaian'])
                                ->where('no_rawat' ,"=" , $params['no_rawat'])
                                ->where('tanggal', "=", $params['tanggal'])
                                ->delete();
            if($delete_penilaian){
                if($params['total_list'] <= 1){
                    $delete_riwayat_imunisasi = DB::table($params['table_list']['imunisasi'])
                                    ->where('no_rkm_medis' ,"=" , $params['no_rm'])
                                    ->delete();
                                
                    if($delete_riwayat_imunisasi){
                        $delete_masalah = DB::table($params['table_list']['masalah'])
                                    ->where('no_rawat' ,"=" , $params['no_rawat'])
                                    ->delete();
                        if($delete_masalah){
                            $is_delete = 1;
                        }
                    }
                }else{
                    $is_delete = 1;
                }

            }
            if($is_delete) {
                DB::commit();
                return ['success' => $message_default['success']];
            }else {
                DB::rollBack();
                return ['error' => $message_default['error']. " (1)"];
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return ['error' => 'Data Penilaian Pasien ini Sudah Terisi!!'];
            }
            return ['error' => $message_default['error']." (2)"];

        } catch (\Throwable $e) {
            DB::rollBack();
            return ['error' => $message_default['error']." (3)"];
        }
    }

    public function getPenilaianKeperawatanBayi($params){
        return $this->riwayatPasienService->getPenilaianKeperawatanBayi($params);
    }
}