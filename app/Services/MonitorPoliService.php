<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\UxuiPanggilMonitorPoli;
use Carbon\Carbon;

class MonitorPoliService extends BaseService
{
    public function __construct(
        
    ){
        parent::__construct(); 
    }

    function deleteMonitorPoli($noRawat)
    {
        return UxuiPanggilMonitorPoli::where('no_rawat', $noRawat)->delete();
    }
    
    function deleteMonitorDate($data_delete)
    {
        return UxuiPanggilMonitorPoli::where('tanggal', '<=', Carbon::now()->subDay())->delete();
    }

    function deleteByStatus($data_delete)
    {
        $tgl= $data_delete['start'];
        $query = DB::select("DELETE utama FROM uxui_list_panggil_monitor_poli utama
        inner join (
        select utama.* from (
            select * from reg_periksa utama
            where tgl_registrasi = '$tgl'
            and stts='Sudah'
        )utama
        inner join uxui_list_panggil_monitor_poli a
        on a.no_rawat=utama.no_rawat
        )a on a.no_rawat=utama.no_rawat");

        return $query;
    }

    function actionDeleteMo($noRawat)
    {
        $message_default=[
            'success'=>'Data berhasil di proses',
            'error'=>'Data tidak berhasil di proses',
        ];

        $pesan=[];

        try {   
            $data_delete=$noRawat;
            if($data_delete){
                $monitorPoli = $this->deleteMonitorPoli($data_delete);
                $save_delete=0;
                if($monitorPoli){
                    $save_delete=1;
                }   
                if($save_delete){
                    DB::commit();
                    return $pesan;
                }
            }
        }
         catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                $pesan=['error','terjadi kesalahan pada database',3];
            }
                $pesan=['error',$message_default['error'],3];

        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }
    }

    function actionDeleteDate($filter)
    {
        $message_default=[
            'success'=>'Data berhasil di proses',
            'error'=>'Data tidak berhasil di proses',
        ];

        $pesan=[];

        try {   
            $data_delete=$filter['start'];
            if($data_delete){
                $monitorPoli = $this->deleteMonitorDate($data_delete);
                $save_delete=0;
                if($monitorPoli){
                    $save_delete=1;
                }   
                
                if($save_delete){
                    DB::commit();
                    return $pesan;
                }
            }
        }
         catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                $pesan=['error','terjadi kesalahan pada database',3];
            }
                $pesan=['error',$message_default['error'],3];

        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }
    }

    function actionDeleteByStatus($filter)
    {
        $message_default=[
            'success'=>'Data berhasil di proses',
            'error'=>'Data tidak berhasil di proses',
        ];

        $pesan=[];

        try {   
            $data_delete=$filter['start'];
            if($data_delete){
                $monitorPoli = $this->deleteByStatus($data_delete);
                $save_delete=0;
                if($monitorPoli){
                    $save_delete=1;
                }   
                if($save_delete){
                    DB::commit();
                    return $pesan;
                }
            }
        }
         catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                $pesan=['error','terjadi kesalahan pada database',3];
            }
                $pesan=['error',$message_default['error'],3];

        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }
    }
}