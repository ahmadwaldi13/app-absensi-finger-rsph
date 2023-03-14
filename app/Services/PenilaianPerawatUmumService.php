<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\PenilaianPasienService;
class PenilaianPerawatUmumService extends PenilaianPasienService
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
                    $delete_data = DB::table($value['table'])->where('no_rawat' ,"=" , $data_pasien['no_rawat'])->delete();
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
                    $delete_masalah = DB::table($params['table_list']['masalah'])
                                    ->where('no_rawat' ,"=" , $params['no_rawat'])
                                    ->delete();

                    if($delete_masalah){
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

    public function getPenilaianKeperawatanRalan($params){
        return $this->riwayatPasienService->getPenilaianKeperawatanRalan($params);
    }
    public function getPenilaianKeperawatanRanap($params){
        $penilaian = DB::table('penilaian_awal_keperawatan_ranap as penilaian')
                        ->select(
                            'penilaian.*',
                            'petugas_1.nama as nama_petugas_1',
                            'petugas_2.nama as nama_petugas_2',
                            'dpjp.nm_dokter as nama_dpjp')
                        ->leftJoinSub(
                            DB::table('petugas')->select('nama', 'nip'),
                            'petugas_1',
                            function($join){
                                $join->on('petugas_1.nip', '=', 'penilaian.nip1');
                            })
                        ->leftJoinSub(
                            DB::table('petugas')->select('nama', 'nip'),
                            'petugas_2',
                            function($join){
                                $join->on('petugas_1.nip', '=', 'penilaian.nip2');
                            })
                        ->leftJoinSub(
                            DB::table('dokter')->select('nm_dokter', 'kd_dokter'),
                            'dpjp',
                            function($join){
                                $join->on('dpjp.kd_dokter', '=', 'penilaian.kd_dokter');
                            })
                        ->where('penilaian.no_rawat', '=', $params['no_rawat'])
                        ->get();
        $masalah = DB::table('master_masalah_keperawatan as masalah')
                        ->select('masalah.kode_masalah', 'masalah.nama_masalah')
                        ->join('penilaian_awal_keperawatan_ranap_masalah', 'masalah.kode_masalah' , '=', 'penilaian_awal_keperawatan_ranap_masalah.kode_masalah')
                        ->where('penilaian_awal_keperawatan_ranap_masalah.no_rawat', '=', $params['no_rawat'])
                        ->get();

        return [
            "penilaian" => $penilaian,
            'masalah' => $masalah
        ];
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