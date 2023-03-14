<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianPerawatKebidananService extends PenilaianPasienService
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
                    $delete_data = DB::table($value['table'])->where('no_rkm_medis' ,"=" , $data_pasien['no_rkm_medis'])->delete();
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
                    $delete_riwayat_persalinan = DB::table($params['table_list']['persalinan'])
                                    ->where('no_rkm_medis' ,"=" , $params['no_rm'])
                                    ->delete();

                    if($delete_riwayat_persalinan){
                        $is_delete = 1;
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

    public function getPenilaianKeperawatanRalanKandungan($params){
        return $this->riwayatPasienService->getPenilaianKeperawatanRalanKandungan($params);
    }
    public function getPenilaianKeperawatanRanapKandungan($params){
        return $this->riwayatPasienService->getPenilaianKeperawatanRanapKandungan($params);
    }
    function getPenilaianRanapListbyNoRm($table_name, $no_rm, $data_tgl = []){
        $query = DB::table('pasien')
            ->select('reg_periksa.no_rawat',
                     'pasien.no_rkm_medis',
                     'pasien.nm_pasien',
                     'penilaian.tanggal',
                     DB::raw("concat(penilaian.nip1, '|', penilaian.nip2, '|', penilaian.kd_dokter) as kode_petugas"))
            ->join('reg_periksa','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->join($table_name.' as penilaian','reg_periksa.no_rawat','=','penilaian.no_rawat')
            ->where('reg_periksa.no_rkm_medis','=',$no_rm);

        if(!empty($data_tgl)){
            if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                $query->whereBetween('penilaian.tanggal', [$data_tgl[0]." 00:00:00", $data_tgl[1]." 23:59:59"]);
            }
        }
        return $query->get();
    }
}