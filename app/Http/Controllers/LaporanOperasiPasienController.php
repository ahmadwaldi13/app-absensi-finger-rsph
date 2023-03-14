<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\LaporanOperasiPasienService;

class LaporanOperasiPasienController extends Controller
{
    protected $cpptService;
    public function __construct(
        GlobalService $globalService,
        LaporanOperasiPasienService $laporanOperasiPasienService
    ) {
        $this->globalService = $globalService;
        $this->laporanOperasiPasienService = $laporanOperasiPasienService;
    }

    function actionIndex(Request $request)
    {
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {
            $no_rm = $item_pasien->no_rm;
            $no_rawat = $item_pasien->no_rawat;
            $type_akses = !empty($item_pasien->no_fr) ? $item_pasien->no_fr : 'rj';

            $data_pasien = $this->globalService->getDataPasien($no_rm);

            $data=(new \App\Http\Traits\ItemPasienFunction)->setItemPasienFilterTgl($request->fr,$request->form_filter_start,$request->form_filter_end);
            if(!empty($data)){
                $request->form_filter_start=$data->filter_start;
                $request->form_filter_end=$data->filter_end;
            }
            
            $filter_start=!empty($request->form_filter_start) ? $request->form_filter_start : date('Y-m-d');
            $filter_end=!empty($request->form_filter_end) ? $request->form_filter_end : date('Y-m-d');

            $dokterLogin = \Illuminate\Support\Facades\Auth::user();

            $parameter=[
                'pasien.no_rkm_medis'=>$no_rm,
                'operasi.no_rawat'=>$no_rawat,
                'tgl_operasi'=>[$filter_start,$filter_end],
                'operasi.operator1'=>$dokterLogin->id
            ];
            $per_page=!empty($request->per_page) ? intval($request->per_page) : 10;
            // $data_list=$this->laporanOperasiPasienService->getDataOperasi($parameter);
            $data_list=$this->laporanOperasiPasienService->getDataOperasi($parameter,1)->paginate($per_page);
            
            $data_list_detail_tmp=$this->laporanOperasiPasienService->getDataOperasiDetail($parameter);
            $data_list_detail=[];
            foreach($data_list_detail_tmp as $index =>$value){
                $data_list_detail[$value->no_rawat][$value->no_rkm_medis][$value->tgl_operasi][$value->kode_paket]=$value;
            }
            
            $parameter_view=[
                'action_form'=>'laporan-operasi-pasien/create',
                'data_pasien'=>$data_pasien,
                'data_list'=>$data_list,
                'data_list_detail'=>$data_list_detail,
            ];
            return view('laporan-operasi-pasien.index',$parameter_view);
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    }

    function formLaporanOperasi(Request $request)
    {
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : '';
        $no_rm=!empty($exp[2]) ? $exp[2] : '';
        $kode_tgl_operasi=!empty($exp[3]) ? $exp[3] : '';
        
        $tgl_operasi=null;
        if(!empty($kode_tgl_operasi) and is_numeric($kode_tgl_operasi)){
            $tgl_operasi =date("Y-m-d H:i:s",$kode_tgl_operasi);
        }

        $data_permintaan_pa=$this->laporanOperasiPasienService->getDataPermintaanPa();
        $model=$this->laporanOperasiPasienService->laporanOperasi->where(['no_rawat'=>$no_rawat,'tanggal'=>$tgl_operasi])->first();
        if(!empty($model)){
            $model=(array)$model->getAttributes();
            if($model['selesaioperasi']){
                $waktu=strtotime($model['selesaioperasi']);
                $model['tgl_selesai']=date('Y-m-d',$waktu);
                $model['jam_selesai']=date('H:i:s',$waktu);
            }
        }
        if(empty($model)){
            $model['no_rawat']=$no_rawat;
            $model['tanggal']=$tgl_operasi;
        }
        $model['fr']=$type_akses;
        $model['no_rm']=$no_rm;
        $model=(object)$model;
        
        $parameter_view=[
            'action_form'=>'operasi-vk/update',
            'data_permintaan_pa'=>$data_permintaan_pa,
            'model'=>$model
        ];
        $bagan_html='laporan-operasi-pasien.form_laporan';
        
        if($request->ajax()){
            $returnHTML = view($bagan_html,$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }else{
            return view($bagan_html,$parameter_view);
        }
    }

    function actionUpdate(Request $request)
    {
        DB::beginTransaction();
        $fields = $request->all();

        $type_akses=!empty($fields['fr']) ? $fields['fr'] : 'rj';
        $no_rawat=!empty($fields['no_rawat']) ? $fields['no_rawat'] : '';
        $no_rm=!empty($fields['no_rm']) ? $fields['no_rm'] : '';
        $tgl_operasi=!empty($fields['tanggal']) ? $fields['tanggal'] : '';
        
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($type_akses);
        $link_back='operasi-vk';
        $link_back_param=['no_rm' => $item_pasien->no_rm, 'no_rawat' => $item_pasien->no_rawat,'fr'=>$type_akses];

        $message_default=[
            'success'=>'Data berhasil diubah',
            'error'=>'Maaf data tidak berhasil diubah'
        ];
        try {
            $model=$this->laporanOperasiPasienService->laporanOperasi->where(['no_rawat'=>$no_rawat,'tanggal'=>$tgl_operasi])->first();
            $status_next=0;
            if(!empty($model)){
                $paramater_where=[
                    'no_rawat'=>$no_rawat,
                    'tanggal'=>$tgl_operasi
                ];
                $delete_model=$this->laporanOperasiPasienService->delete($paramater_where);
                if($delete_model){
                    $status_next=1;
                }
            }else{
                $status_next=1;
            }

            if($status_next==1){
                $data=(object)$fields;
                $data_save['no_rawat']=$no_rawat;
                $data_save['tanggal']=$tgl_operasi;
                $data_save['diagnosa_preop']=!empty($data->diagnosa_preop) ? $data->diagnosa_preop : '';
                $data_save['diagnosa_postop']=!empty($data->diagnosa_postop) ? $data->diagnosa_postop : '';
                $data_save['jaringan_dieksekusi']=!empty($data->jaringan_dieksekusi) ? $data->jaringan_dieksekusi : '';
                $data_save['permintaan_pa']=!empty($data->permintaan_pa) ? $data->permintaan_pa : '';
                $data_save['laporan_operasi']=!empty($data->laporan_operasi) ? $data->laporan_operasi : '';
                $tgl_selesai=!empty($data->tgl_selesai) ? $data->tgl_selesai : date('Y-m-d');
                $jam_selesai=!empty($data->jam_selesai) ? $data->jam_selesai : date('H:i:s');
                $waktu_selesai=$tgl_selesai.' '.$jam_selesai;
                $waktu_selesai=strtotime($tgl_selesai.' '.$jam_selesai);
                $waktu_selesai=date('Y-m-d H:i:s',$waktu_selesai);
                $data_save['selesaioperasi']=$waktu_selesai;

                $model_save=$this->laporanOperasiPasienService->insert($data_save);
                if($model_save){
                    DB::commit();
                    $pesan=['success' => $message_default['success']];
                }else{
                    DB::rollBack();
                    $pesan=['error' => $message_default['error']];
                }
            }else{
                DB::rollBack();
                $pesan=['error' => $message_default['error']];
            }
            return redirect()->route($link_back, $link_back_param)->with($pesan);
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf tidak dapat menyimpan data yang sama']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }
    }

    function actionView(Request $request)
    {
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : '';
        $no_rm=!empty($exp[2]) ? $exp[2] : '';
        $kode_tgl_operasi=!empty($exp[3]) ? $exp[3] : '';
        $tgl_operasi=null;
        if(!empty($kode_tgl_operasi) and is_numeric($kode_tgl_operasi)){
            $tgl_operasi =date("Y-m-d H:i:s",$kode_tgl_operasi);
        }

        $parameter=[
            'pasien.no_rkm_medis'=>$no_rm,
            'operasi.no_rawat'=>$no_rawat,
            'operasi.tgl_operasi'=>$tgl_operasi
        ];
        $list_data_operasi=$this->laporanOperasiPasienService->getDataOperasiDetail($parameter);
        $model=!empty($list_data_operasi[0]) ? $list_data_operasi[0] : null;
        $data_laporan=$this->laporanOperasiPasienService->laporanOperasi->where(['no_rawat'=>$no_rawat,'tanggal'=>$tgl_operasi])->first();
        
        $parameter_view=[
            'model'=>$model,
            'list_data_operasi'=>$list_data_operasi,
            'data_laporan'=>$data_laporan,
            'type_akses'=>$type_akses,
        ];

        if($request->ajax()){
            $returnHTML = view('laporan-operasi-pasien.view',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }
}