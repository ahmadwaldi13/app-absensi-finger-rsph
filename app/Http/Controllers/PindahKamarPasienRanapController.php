<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\BillingRanapService;

class PindahKamarPasienRanapController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Data Pindah Kamar Pasien Ranap';
        $this->breadcrumbs=[
            ['title'=>'Olah Data Tagihan','url'=>url('/')."/sub-menu?type=9"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->billingRanapService = new BillingRanapService;

        $this->url_back_to_bagan_billing="billing-list-tagihan-pasien-ranap/view";
    }

    function actionIndex(Request $request){
        if($request->isMethod('get')){
            DB::statement("ALTER TABLE ".( new \App\Models\UxuiPasienPindahKamar )->table." AUTO_INCREMENT = 1");
            return $this->index($request);
        }

        if($request->isMethod('post')){
            return $this->proses($request);
        }

        if($request->isMethod('delete')){
            return $this->prosesDelete($request);
        }
    }

    private function index(Request $request){
        $kode = !empty($request->data_sent) ? $request->data_sent : null;
        $params_parent_json = !empty($request->params_json) ? $request->params_json : '';
        $kode_send = !empty($request->kode_send) ? $request->kode_send : null;

        $kode_exp=explode('@',$kode);
        $no_rm=!empty($kode_exp[0]) ? $kode_exp[0] : '';
        $no_rawat=!empty($kode_exp[1]) ? $kode_exp[1] : '';

        $paramater_where=[
            'no_rkm_medis'=>$no_rm,
            'no_rawat'=>$no_rawat,
        ];

        $data_pasien=$this->billingRanapService->getDataPasien(['no_rawat'=>$no_rawat]);

        $data_tmp_tmp=( new \App\Models\UxuiPasienPindahKamar );
        $list_data=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater_where)->paginate(!empty($request->per_page) ? $request->per_page : 15);

        $url_back_to_billing=$this->url_back_to_bagan_billing.'?data_sent='.$no_rawat.'&params_json='.$params_parent_json;

        $this->breadcrumbs[1]=['title'=>'Billing Pasien Ranap','url'=>$url_back_to_billing];
        $this->breadcrumbs[2]=['title'=>$this->title,'url'=>'','active'=>1];

        $bagan_form=$this->form($request);

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data' => $list_data,
            'url_back_to_bagan_billing'=>$url_back_to_billing,
            'bagan_form'=>$bagan_form,
            'data_pasien'=>$data_pasien,
            'params_parent_json'=>$params_parent_json,
            'kode_send'=>$kode_send
        ];

        return view($this->part_view . '.index', $parameter_view);
    }

    private function form(Request $request){
        $kode = !empty($request->data_sent) ? $request->data_sent : null;
        $kode_send = !empty($request->kode_send) ? $request->kode_send : null;
        $params_parent_json = !empty($request->params_json) ? $request->params_json : '';

        $kode_exp=explode('@',$kode);
        $no_rm=!empty($kode_exp[0]) ? $kode_exp[0] : '';
        $no_rawat=!empty($kode_exp[1]) ? $kode_exp[1] : '';
        
        $kode_send_exp=explode('@',$kode_send);
        $id_pindah_kamar=!empty($kode_send_exp[2]) ? $kode_send_exp[2] : '';

        $model = (new \App\Models\UxuiPasienPindahKamar())->where('id_pindah_kamar', '=', $id_pindah_kamar)->first();
        $kode_send=$kode_send;
        if(empty($model)){
            $model=new \App\Models\UxuiPasienPindahKamar();
            $model->no_rkm_medis=$no_rm;
            $model->no_rawat=$no_rawat;

            $kode_send='';
        }

        $get_kd_kamar_pasien_tmp= (new \App\Services\BillingRanapService)->getKamarInapPasien(['no_rawat'=>$no_rawat]);
        $get_kd_kamar_pasien=[];
        if(!empty($get_kd_kamar_pasien_tmp)){
            foreach($get_kd_kamar_pasien_tmp as $item_kd_kamar){
                $kd_kamar=$item_kd_kamar->kd_kamar;
                if(is_string($kd_kamar)){
                    $kd_kamar="'".$kd_kamar."'";
                }
                $get_kd_kamar_pasien[]=$kd_kamar;
            }

            $get_kd_kamar_pasien=['where'=>['where_in'=>['kd_kamar'=>implode(',',$get_kd_kamar_pasien)]]];        
            $get_kd_kamar_pasien=json_encode($get_kd_kamar_pasien);
        }
        
        $url_back_to_billing=$this->url_back_to_bagan_billing.'?data_sent='.$no_rawat.'&params_json='.$params_parent_json;

        $url_clear_form=$this->url_index.'?data_sent='.$no_rm.'@'.$no_rawat.'&params_json='.$params_parent_json;

        $parameter_view = [
            'action_form' => $this->part_view,
            'model' => $model,
            'url_back_to_bagan_billing'=>$url_back_to_billing,
            'params_parent_json'=>$params_parent_json,
            'kode_send'=>$kode_send,
            'url_clear_form'=>$url_clear_form,
            'get_kd_kamar_pasien'=>!empty($get_kd_kamar_pasien) ? $get_kd_kamar_pasien : '',
        ];

        return view($this->part_view . '.form', $parameter_view);
    }

    private function proses($request){
        $req = $request->all();
        $kode = !empty($req['key_data']) ? $req['key_data'] : '';
        $no_rm=!empty($req['no_rm']) ? $req['no_rm'] : '';
        $no_rawat=!empty($req['no_rawat']) ? $req['no_rawat'] : '';

        $link_back_redirect=$this->url_name;
        $link_back_param = [
            'data_sent' => $no_rm.'@'.$no_rawat,
            'params_json'=>!empty($req['params_parent_json']) ? $req['params_parent_json'] : '',
        ];
        
        DB::beginTransaction();
        $pesan = [];

        $message_default = [
            'success' => !empty($kode) ? 'Data berhasil diubah' : 'Data berhasil disimpan',
            'error' => !empty($kode) ? 'Data tidak berhasil diubah' : 'Data berhasil disimpan'
        ];

        try {

            $tgl_masuk=!empty($req['tgl_masuk']) ? $req['tgl_masuk'] : '';
            $jam_masuk=!empty($req['jam_masuk']) ? $req['jam_masuk'].':00' : '';
            $waktu_masuk=$tgl_masuk.' '.$jam_masuk;

            $tgl_keluar=!empty($req['tgl_keluar']) ? $req['tgl_keluar'] : '';
            $jam_keluar=!empty($req['jam_keluar']) ? $req['jam_keluar'].':00' : '';
            $waktu_keluar=$tgl_keluar.' '.$jam_keluar;

            $tgl_masuk=!empty($req['tgl_masuk']) ? $req['tgl_masuk'] : '';
            $jam_masuk=!empty($req['jam_masuk']) ? $req['jam_masuk'].':00' : '';
            // $waktu_masuk=$tgl_masuk.' '.$jam_masuk;
            $waktu_masuk=$tgl_masuk;

            $tgl_keluar=!empty($req['tgl_keluar']) ? $req['tgl_keluar'] : '';
            $jam_keluar=!empty($req['jam_keluar']) ? $req['jam_keluar'].':00' : '';
            // $waktu_keluar=$tgl_keluar.' '.$jam_keluar;
            $waktu_keluar=$tgl_keluar;

            $datetime1 = new \DateTime($waktu_masuk);
            $datetime2 = new \DateTime($waktu_keluar);
            $interval = $datetime1->diff($datetime2);
            $lama_inap = (int)$interval->format('%a');

            if($datetime1==$datetime2){
                $lama_inap=1;
            }

            $kd_kamar_awal=!empty($req['kd_kamar_awal']) ? $req['kd_kamar_awal'] : '';
            $kd_kamar_pindah=!empty($req['kd_kamar_pindah']) ? $req['kd_kamar_pindah'] : '';

            $key_data=!empty($req['key_data']) ? $req['key_data'] : '';
            $key_data_exp=explode('@',$key_data);

            $trf_pindah=!empty($req['trf_kamar_pindah']) ? $req['trf_kamar_pindah'] : 0;
            $trf_awal=!empty($req['trf_kamar_awal']) ? $req['trf_kamar_awal'] : 0;
            $selisih=$trf_pindah-$trf_awal;

            if($selisih<0){
                return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Selisih tidak boleh kurang dari 0']);
            }

            if($lama_inap<=0){
                return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Lama Menginap tidak boleh kurang dari 0']);
            }
            
            if(!empty($key_data_exp)){
                $id_pindah_kamar=!empty($key_data_exp[2]) ? $key_data_exp[2] : '';

                $model = (new \App\Models\UxuiPasienPindahKamar())
                ->where('id_pindah_kamar', '=',$id_pindah_kamar)
                ->first();
            }

            if (empty($model)) {
                $model = (new \App\Models\UxuiPasienPindahKamar());
            }
            $data_save = $req;
            $model->set_model_with_data($data_save);
            $model->no_rkm_medis=$no_rm;
            $model->waktu_masuk=$waktu_masuk;
            $model->waktu_keluar=$waktu_keluar;
            $model->lama_inap=$lama_inap;

            $trf_pindah=!empty($data_save['trf_kamar_pindah']) ? $data_save['trf_kamar_pindah'] : 0;
            $trf_awal=!empty($data_save['trf_kamar_awal']) ? $data_save['trf_kamar_awal'] : 0;
            $selisih=$trf_pindah-$trf_awal;
            $total=$lama_inap*$selisih;

            $model->total=$total;

            $is_save = 0;
            
            if($model->save()){
                $is_save=1;
            }

            if ($is_save) {
                DB::commit();
                $link_back_param = $this->clear_request($link_back_param, $request);
                $pesan = ['success', $message_default['success'], 2];
            } else {
                DB::rollBack();
                $pesan = ['error', $message_default['error'], 3];
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->errorInfo[1] == '1062') {
            }
            $pesan = ['error', $message_default['error'], 3];
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan = ['error', $message_default['error'], 3];
        }

        return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0] => $pesan[1]]);
    }

    function prosesDelete(Request $request){
        $req = $request->all();
        $kode = !empty($req['data_sent']) ? $req['data_sent'] : '';
        $kode_exp=explode('@',$kode);
        $no_rm=!empty($kode_exp[0]) ? $kode_exp[0] : '';
        $no_rawat=!empty($kode_exp[1]) ? $kode_exp[1] : '';
        $id_pindah_kamar=!empty($kode_exp[2]) ? $kode_exp[2] : '';

        DB::beginTransaction();
        $pesan=[];
        $link_back_redirect=$this->url_name;
        $link_back_param = [
            'data_sent' => $no_rm.'@'.$no_rawat,
            'params_json'=>!empty($req['params_json']) ? $req['params_json'] : '',
        ];
        $message_default = [
            'success' => 'Data berhasil dihapus',
            'error' => 'Maaf data tidak berhasil dihapus'
        ];

        try {
            $model = (new \App\Models\UxuiPasienPindahKamar())->where('id_pindah_kamar', '=', $id_pindah_kamar)->first();
            
            if(empty($model)){
                return redirect()->route($this->url_name, $link_back_param)->with(['error','Data tidak ditemukan']);
            }

            $is_save = 0;
            if ($model->delete()) {
                $is_save = 1;
            }

            if($is_save){
                DB::commit();
                DB::statement("ALTER TABLE ".( new \App\Models\UxuiPasienPindahKamar )->table." AUTO_INCREMENT = 1");
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

        return redirect()->route($this->url_name, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
    }

    public function actionCetak(Request $request){
        $pindah_kamar_params = !empty($request->pindah_kamar_params) ? json_decode($request->pindah_kamar_params, 1) : '';
        $pdf_data = $this->billingRanapService->getDataPindahKamar(['pindah_kamar_params' => $pindah_kamar_params ]);
        $pdf = (new \Resources\views\LayoutPdf\PindahKamarPasienRanap\PindahKamarPasienRanap)->makePDF($pdf_data);
        return $pdf->Output(public_path("billing pasien ranap_$request->no_rawat.pdf"), 'I');    
    }
}