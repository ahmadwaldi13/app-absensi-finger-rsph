<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UxuiPanggilMonitorPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\AntrianPoliklinikService;
use App\Services\MonitorPoliService;
use App\Services\BpjsService;

class AntrianPoliController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Antrian Poliklinik';
        $this->breadcrumbs=[
            ['title'=>'Anrtrian','url'=>url('/')."/sub-menu?type=5"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];   
        $this->antrianPoliklinikService = new AntrianPoliklinikService; 
        $this->monitorPoliService = New MonitorPoliService;
        $this->bpjsService = new BpjsService;
    }

    public function actionIndex(Request $request)
    {
        $filter = [
            'city' => '',
            'poli' => !empty($request->filter_kd_poli) ? $request->filter_kd_poli : '',
            'status' => $request->status,
            'start' => !empty($request->form_filter_date_start) ? $request->form_filter_date_start : date('Y-m-d'),
            'end' => !empty($request->form_filter_date_end) ? $request->form_filter_date_end : date('Y-m-d'),
            'per_page' => intval($request->per_page),
            'search' => !empty($request->form_filter_text) ? $request->form_filter_text : '',
        ];

        $kode = !empty($request->data_sent) ? $request->data_sent : '';

        $model = UxuiPanggilMonitorPoli::where('no_rawat', '=', $kode)->first();

        $list_data = $this->antrianPoliklinikService->getListRawatJalan($filter)
        ->paginate(!empty($request->per_page) ? $request->per_page : 20);

        if(!empty($request->table_only)){
            return view('antrian-poliklinik-petugas/components/table', ['list_data' => $list_data]);
        }
        $deleteDate = $this->monitorPoliService->actionDeleteDate($filter);
        $deleteStts = $this->monitorPoliService->deleteByStatus($filter);

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data,
            'model'=>$model
        ];

        return view($this->part_view.'.index',$parameter_view);
    }

    private function prosesCreate($request)
    {
        $req=$request->all();
        $kode=!empty($req['key_old']) ? $req['key_old'] : '';
        DB::beginTransaction();
        $pesan=[];
        $link_back_param=[];
        $message_default=[
            'success'=>!empty($kode) ? 'Data berhasil diubah' : 'Data berhasil dipanggil',
            'error'=>!empty($kode) ? 'Data tidak berhasil diubah' : 'Data tidak berhasil dipanggil'
        ];
        try {
            $model = (new \App\Models\UxuiPanggilMonitorPoli)->where('no_rawat', '=', $kode)->first();
            if(empty($model)){
                $model=(new \App\Models\UxuiPanggilMonitorPoli);
            }
            $data_save=$req;
            $data_save['no_rawat'] = $data_save['no_rawat'];
            $data_save['no_reg'] = $data_save['no_reg'];
            $data_save['nm_pasien'] = $data_save['nm_pasien'];
            $data_save['poli'] = $data_save['nm_poli'];
            $data_save['tanggal'] = $data_save['tgl_registrasi'];
            $model->set_model_with_data($data_save);
            
            $is_save=0;
            
            if($model->save()){
                $is_save=1; 
            }

            $tindakan_pasien_model = new \App\Models\UxuiTindakanPasienPerawat;
                $model_tindakan=$tindakan_pasien_model::where('no_rawat', $data_save['no_rawat'])
                ->where('no_rkm_medis', $data_save['no_rkm_medis'])
                ->where('type_akses', 'rj')
                ->first();

                if(empty($model_tindakan)){
                    $model_tindakan=$tindakan_pasien_model;
                    $model_tindakan->no_rawat=$data_save['no_rawat'];
                    $model_tindakan->no_rkm_medis=$data_save['no_rkm_medis'];
                    $model_tindakan->type_akses='rj';
                }
                $model_tindakan->pemeriksaan=1;

                if($model_tindakan->save()){
                    $is_save=1;
                }
            if($is_save){
                DB::commit();
                $pesan=['success',$message_default['success'],2];
            }else{
                DB::rollBack();
                $pesan=['error',$message_default['error'],3];
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                
            }
            $pesan=['error',$message_default['error'],3];
        
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }

        // return redirect()->route($this->url_name, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
        return redirect()->back()->with([$pesan[0]=>$pesan[1]]);
    }

    public function actionUpdate(Request $request)
    {
        $kode=!empty($request->data_sent) ? $request->data_sent : null;;
        DB::beginTransaction();
        $pesan=[];
        $link_back_param=[];
        $message_default=[
            'success'=>!empty($kode) ? 'Berkas Diterima' : 'Data berhasil dipanggill',
            'error'=>!empty($kode) ? 'Berkas tidak berhasil diterima' : 'Data tidak berhasil dipanggil'
        ];
        try {
            
            $is_save=0;
            $action_beforebb=$this->bpjsService->actionBeforeTaskId($kode,4);
            if($action_beforebb){
                if($action_beforebb[0]=='success'){
                    $is_save=1;
                }
            }

            $hasil=$this->bpjsService->taskId($kode,4);
            if($hasil){
                if($hasil){
                    $is_save=1;
                }
            }
            
            if($is_save){
                DB::commit();
                $pesan=['success',$message_default['success'],2];
            }else{
                DB::rollBack();
                $pesan=['error',$message_default['error'],3];
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                
            }
            $pesan=['error',$message_default['error'],3];
        
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }

        // return redirect()->route($this->url_name, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
        return redirect()->back()->with([$pesan[0]=>$pesan[1]]);
    }

    private function prosesDelete($request){
        DB::beginTransaction();
        $pesan=[];
        $link_back_param=[];
        $message_default=[
            'success'=>'Pasien sudah dibisukan',
            'error'=>'Maaf data tidak berhasil dibisukan'
        ];
        
        $kode = !empty($request->no_rawat) ? $request->no_rawat : null;
        try {
            $model = (new \App\Models\UxuiPanggilMonitorPoli)->where('no_rawat', '=', $kode)->first();
            if(empty($model)){
                return redirect()->route($this->url_name, $link_back_param)->with(['error','Data tidak ditemukan']);
            }

            $is_save=0;
            
            $tindakan_pasien_model = new \App\Models\UxuiTindakanPasienPerawat;
            $model_tindakan=$tindakan_pasien_model::where('no_rawat', '=' ,$kode)
            ->where('type_akses', 'rj')
            ->first();
            $model_tindakan->pemeriksaan=0;

            if($model_tindakan->save()){
                $is_save=1;
            }

            if($model->delete()){
                $is_save=1;
            }

            if($is_save){
                DB::commit();
                $pesan=['success',$message_default['success'],2];
            }else{
                DB::rollBack();
                $pesan=['error',$message_default['error'],3];
            }
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                
            }
            $pesan=['error',$message_default['error'],3];
        
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan=['error',$message_default['error'],3];
        }

        // return redirect()->route($this->url_name, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
        return redirect()->back()->with([$pesan[0]=>$pesan[1]]);
    }

    public function actionPanggilMute(Request $request)
    {
        if($request->tindakan_pasien_perawat==1){
            return $this->prosesDelete($request);
        }
        else {
            return $this->prosesCreate($request);
        }
    }
}
