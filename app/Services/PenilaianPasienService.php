<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Pasien;
use App\Services\GlobalService;
use App\Services\RiwayatPasienService;
use App\Services\RekamMedisService;
class PenilaianPasienService extends BaseService
{
    public function __construct(
        Pasien $pasien,
        GlobalService $globalService,
        RiwayatPasienService $riwayatPasienService,
        RekamMedisService $rekamMedisService
    ){
        $this->pasien = $pasien;
        $this->globalService = $globalService;
        $this->riwayatPasienService = $riwayatPasienService;
        $this->rekamMedisService = $rekamMedisService;
    }
    function getMasterList($tables){
        $query = DB::table($tables)
                        ->select("*")
                        ->get();
        return $query;
    }
    function getPasienData($no_rkm_mds){
        return  $this->pasien->select(
                                $this->pasien->table.".jk",
                                $this->pasien->table.".tgl_lahir",
                                "bahasa_pasien.nama_bahasa",
                                $this->pasien->table.".no_rkm_medis",
                                $this->pasien->table.".nm_pasien",
                                $this->pasien->table.".agama"
                                )

                            ->join("bahasa_pasien", $this->pasien->table.".bahasa_pasien", "=", "bahasa_pasien.nama_bahasa")
                            ->where("no_rkm_medis", "=", $no_rkm_mds)
                            ->first();
    }

    function insertPenilaian($params){
        DB::beginTransaction();
        $message_default = [
            'success' => 'Data berhasil ditambahkan',
            'error' => 'Maaf data tidak berhasil ditambahkan'
        ];
        try {
            $is_save = 0;
            foreach($params as $key => $value){
                unset($value['data']['no_rm']);
                $save_data = DB::table($value['table'])->insert($value['data']);
                if($save_data ){
                    if($key === array_key_last($params)){
                        $is_save = 1;
                    }
                }
            }

            if($is_save) {
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

    function getPenilaianListbyNoRm($table_name, $no_rm, $data_tgl = []){
        $table_type_select = str_contains($table_name, 'medis') ? 'penilaian.kd_dokter' : 'penilaian.nip';
        $query = DB::table('pasien')
            ->select('reg_periksa.no_rawat', 'pasien.no_rkm_medis', 'pasien.nm_pasien', 'penilaian.tanggal', $table_type_select." as kode_petugas")
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

    function getDataRmOperasi($table_name, $no_rm, $data_tgl = []){
        $query = DB::table('pasien')
            ->join('reg_periksa', 'pasien.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis')
            ->join($table_name, 'reg_periksa.no_rawat', '=', $table_name.'.no_rawat')
            ->select('reg_periksa.no_rawat', 'pasien.no_rkm_medis', 'pasien.nm_pasien', $table_name.'.tanggal')
            ->where('pasien.no_rkm_medis', $no_rm);

        if(!empty($data_tgl)){
            if(!empty($data_tgl[0]) && !empty($data_tgl[1])){
                $query->whereBetween('tanggal', [$data_tgl[0]." 00:00:00", $data_tgl[1]." 23:59:59"]);
            }
        }
        // dd($query->get());

        return $query->get();
    }

    public function updateRmoperasi($params,$data_pasien){
        // dd($params);
        DB::beginTransaction();
        $message_default = [
            'success' => 'Data berhasil diperbaharui',
            'error' => 'Maaf data tidak berhasil diperbaharui atau tidak ada yang berubah'
        ];
        $isupdate = 0;
            foreach($params as $key => $value){

                // dd($value['data']);
                if($value['type'] === "rmoperasi"){
                    $save_data = DB::table($value['table'])->updateOrInsert(['no_rawat' => $data_pasien['no_rawat'],'tanggal' =>$data_pasien['tanggal']], $value['data'] );
                    $isupdate = 1;
                }
            }

                // dd($isupdate);
        try {
            $isupdate = 0;
            foreach($params as $key => $value){

                // dd($value['data']);
                if($value['type'] === "rmoperasi"){
                    $save_data = DB::table($value['table'])->updateOrInsert(['no_rawat' => $data_pasien['no_rawat'],'tanggal' =>$data_pasien['tanggal']], $value['data'] );
                    $isupdate = 1;
                }
            }
            if($isupdate) {
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

    public function deleteRmoperasi($params){
        // dd($params);
        DB::beginTransaction();
        $message_default = [
            'success' => 'Data berhasil dihapus',
            'error' => 'Maaf data tidak berhasil dihapus'
        ];

        try {

            if ($params) {
            $is_delete = 0;
            $delete_penilaian = DB::table($params['table_list'])
                                ->where('no_rawat' ,"=" , $params['no_rawat'])
                                ->where('tanggal', "=", $params['tanggal'])
                                ->delete();

            $is_delete = 1;
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

}
