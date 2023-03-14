<?php

namespace App\Http\Controllers;

use App\Models\KamarInap;
use App\Models\JnsPerawatanInap;

use Illuminate\Http\Request;
use App\Services\RawatJalanService;
use App\Services\TindakanPetugasService;
use Illuminate\Support\Facades\DB;


class TindakanPetugasController extends Controller
{
    protected $rawatjalanService;
    public function __construct(
        RawatJalanService $rawatJalanService,
        TindakanPetugasService $tindakanPetugasService
    ) {
        $this->rawatJalanService = $rawatJalanService;
        $this->tindakanPetugasService = $tindakanPetugasService;
    }

    function actionIndex(Request $request){

        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {
    
            $filter = $request->search ?? "";
            $noRm = $item_pasien->no_rm;
            $noRawat = $item_pasien->no_rawat;
            $tabs=!empty($request->tab) ? $request->tab : null;
            $dataPasien = $this->rawatJalanService->getDataPasienForResume($noRm);
            
            
            $html_tab='';
            if(!$tabs){
                $setTarifs=$this->rawatJalanService->getSetTarif()->first();
    
                $get_poli_ralan=!empty($setTarifs['poli_ralan']) ? $setTarifs['poli_ralan'] : 'yes';
                $get_poli_ralan=strtolower($get_poli_ralan);
                $get_cara_bayar_ralan=!empty($setTarifs['cara_bayar_ralan']) ? $setTarifs['cara_bayar_ralan'] : 'yes';
                $get_cara_bayar_ralan=strtolower($get_cara_bayar_ralan);            
    
                $dataRefPeriksa= $this->rawatJalanService->getRegPeriksa()->where('no_rawat',$noRawat)->first();
            
                $petugases = $this->rawatJalanService->getPetugasList();
                
                if($item_pasien->no_fr=='rj'){
                    $parameter=[
                        'search_text'=>'',
                        'kd_poli'=>!empty($dataRefPeriksa['kd_poli']) ? $dataRefPeriksa['kd_poli'] : '',
                        'kd_pj'=>!empty($dataRefPeriksa['kd_pj']) ? $dataRefPeriksa['kd_pj'] : '',
                    ];
                    
                    $listTindakan = $this->tindakanPetugasService->getJnsPerawatanTindakanPetugasList($get_poli_ralan,$get_cara_bayar_ralan,$parameter);
                }
                elseif($item_pasien->no_fr=='rp'){
                    $dataRefPeriksa= $this->rawatJalanService->getRegPeriksaRujukanPoli(['reg_periksa.no_rawat'=>$noRawat])->first();
                    $parameter=[
                        'search_text'=>'',
                        'kd_poli'=>!empty($dataRefPeriksa['kd_poli_rujukan']) ? $dataRefPeriksa['kd_poli_rujukan'] : '',
                        'kd_pj'=>!empty($dataRefPeriksa['kd_pj']) ? $dataRefPeriksa['kd_pj'] : '',
                    ];
                    $listTindakan = $this->tindakanPetugasService->getJnsPerawatanTindakanPetugasList($get_poli_ralan,$get_cara_bayar_ralan,$parameter);
                }
                elseif($item_pasien->no_fr=='ri'){
                    $get_ruang_ranap=!empty($setTarifs['ruang_ranap']) ? $setTarifs['ruang_ranap'] : 'yes';
                    $get_ruang_ranap=strtolower($get_ruang_ranap);
                    $get_cara_bayar_ranap=!empty($setTarifs['cara_bayar_ranap']) ? $setTarifs['cara_bayar_ranap'] : 'yes';
                    $get_cara_bayar_ranap=strtolower($get_cara_bayar_ranap); 
                    $get_kelas_ranap=!empty($setTarifs['kelas_ranap']) ? $setTarifs['kelas_ranap'] : 'yes';
                    $get_kelas_ranap=strtolower($get_kelas_ranap); 

                    $dataRefPeriksa= $this->rawatJalanService->getRegPeriksa()->where('no_rawat',$noRawat)->first();
                
                    
                    $dataRanap = KamarInap::
                    select('kamar_inap.*','kamar.kelas','kamar.kd_bangsal')
                    ->join('kamar', 'kamar.kd_kamar', '=', 'kamar_inap.kd_kamar')
                    ->where('kamar_inap.no_rawat',$noRawat)->first();

                    $parameter=[
                        'search_text'=>'',
                        'kd_pj'=>!empty($dataRefPeriksa->kd_pj) ?$dataRefPeriksa->kd_pj : '',
                        'kd_bangsal'=>!empty($dataRanap->kd_bangsal) ? $dataRanap->kd_bangsal : '',
                        'kelas'=>!empty($dataRanap->kelas) ? $dataRanap->kelas: '',
                        'nm_kategori'=>"Paramedis"
                    ];

                    $listTindakan = $this->tindakanPetugasService->getJnsPerawatanTindakanPetugasRanapList($get_ruang_ranap,$get_cara_bayar_ranap,$get_kelas_ranap,$parameter);

                }
                $model['fr']=!empty($item_pasien->no_fr) ? $item_pasien->no_fr : '';
                $model=(object)$model;
                $parameter_view=[
                    "model" => $model,
                    "dataPasien" => $dataPasien,
                    "petugases" => $petugases,
                    "listTindakan"=> $listTindakan,
                ];
    
                $html_tab=view('tindakan-petugas.tindakan_petugas_daftar',$parameter_view)->render();
            }else if(strtolower($tabs)=='tindakan' ){
                $filter_start=!empty($request->form_filter_start) ? $request->form_filter_start : date('Y-m-d');
                $filter_end=!empty($request->form_filter_end) ? $request->form_filter_end : date('Y-m-d');
                $filter_search_text=!empty($request->form_filter_text) ? $request->form_filter_text : '';
                
                if($item_pasien->no_fr=='ri'){
                    $tindakaPetugasList=$this->tindakanPetugasService->getTindakanDilakukanPetugasRanapList($noRm,$filter_start,$filter_end,$filter_search_text);
                }else{
                    $tindakaPetugasList=$this->tindakanPetugasService->getTindakanDilakukanPetugasList($noRm,$filter_start,$filter_end,$filter_search_text);
                }
                // dd($tindakaPetugasList);
                $parameter_view=[
                    "dataPasien" => $dataPasien,
                    "tindakaPetugasList"=>$tindakaPetugasList,
                ];
    
                $html_tab=view('tindakan-petugas.tindakan_petugas_dilakukan',$parameter_view)->render();
            }
            
            if($item_pasien->no_fr!='ri'){
                $getTindakaPetugasList=$this->tindakanPetugasService->getTindakanDilakukanPetugasList($noRm,date('Y-m-d'),date('Y-m-d'),'');
                $jmlTindakan=count($getTindakaPetugasList);
            }else{
                $getTindakaPetugasList=$this->tindakanPetugasService->getTindakanDilakukanPetugasRanapList($noRm,date('Y-m-d'),date('Y-m-d'),'');
                $jmlTindakan=count($getTindakaPetugasList);
            }
            return view('tindakan-petugas.tindakan_petugas', [
                "html_tab"=>$html_tab,
                "tabs"=>$tabs,
                "jmlTindakan"=>$jmlTindakan,
            ]);
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    }

    function actionCreate(Request $request)
    {

        DB::beginTransaction();
        $link_back='tindakan_petugas';
        $paramater_req=[
            'kd_jenis_prw'=>!empty($request->kd_jenis_prw) ? $request->kd_jenis_prw : [],
        ];
        $sentForm=(new \App\Http\Traits\GlobalFunction)->getSentForm($paramater_req);
        $link_back_param=['no_rm' => $request->no_rm, 'no_rawat' => $request->no_rawat,'fr'=>$request->fr,'gsf'=>$sentForm];
        $message_default=[
            'success'=>'Sukses menambahkan tindakan petugas',
            'error'=>'Maaf data tidak berhasil disimpan'
        ];

        $type_akses = $request->fr;
        
        try {   
            $check_registrasi=(new \App\Http\Traits\GlobalFunction)->cariRegistrasi($request->no_rawat);
        
            if($check_registrasi>0){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Data billing sudah terverifikasi.<br>Silahkan hubungi bagian kasir/keuangan ..!!']);
            }

            $data_perawatans=[];
            $data_save=[];
            if(!empty($request['kd_jenis_prw'])){
                if($type_akses!=='ri')
                $data_perawatans = $this->rawatJalanService->getJnsPerawatan()->whereIn('kd_jenis_prw',$request['kd_jenis_prw'])->get();
                else
                $data_perawatans = JnsPerawatanInap::whereIn('kd_jenis_prw',$request['kd_jenis_prw'])->get();
            
            }else{
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf kode perawatan tidak ada yang dipilih']);
            }

            $item_not_empty=['no_rawat','kd_jenis_prw','nip','tgl_perawatan','jam_rawat','material','bhp','tarif_tindakanpr'];
            
            foreach($data_perawatans as $key => $value){
                $item=[];
                $item=[
                    'no_rawat'=>$request['no_rawat'],
                    'kd_jenis_prw'=>$value['kd_jenis_prw'],
                    'nip'=>$request['nip'],
                    'tgl_perawatan'=>$request['tgl_perawatan'],
                    'jam_rawat'=>$request['jam_rawat'],
                    'material'=>$value['material'],
                    'bhp'=>$value['bhp'],
                    'tarif_tindakanpr'=>$value['tarif_tindakanpr'],
                    'kso'=>$value['kso'],
                    'menejemen'=>$value['menejemen'],
                    'biaya_rawat'=>$value['total_byrpr'],
                    'stts_bayar'=>'Belum',
                ];
                $check=(new \App\Http\Traits\GlobalFunction)->filterValidasiField($item_not_empty,$item);
                if($check[0]=='error'){
                    $error_type=!empty($check[1]) ? $check[1] : '';
                    $message_error='Maaf data masih ada yang kosong';
                    if($error_type=='nip'){
                        $message_error='Petugas tidak boleh kosong';
                    }
                    return redirect()->route($link_back, $link_back_param)->with(['error' =>$message_error ]);
                }
                if(!empty($check[1])){
                    if($type_akses=='ri'){
                        $check[1]=(new \App\Models\RawatInapPr)->set_columns_table_with_data($check[1]);
                    }else{
                        $check[1]=(new \App\Models\RawatJlPr)->set_columns_table_with_data($check[1]);
                    }
                    $data_save[]=$check[1];
                }
            }

            if(!empty($data_save)){
                $this->tindakanPetugasService->insertTindakanPetugas($data_save,$type_akses);
                DB::commit();
                unset($link_back_param['gsf']);
                return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
            }
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

    function tindakanAction(Request $request){
        $link_back='tindakan_petugas';
        $get_request_json=$request->get_request;
        $get_request=json_decode($get_request_json);
        $paramater_req=[
            'kode_item'=>!empty($request->kode_item) ? $request->kode_item : [],
        ];
        $sentForm=(new \App\Http\Traits\GlobalFunction)->getSentForm($paramater_req);

        $link_back_param=[
            'no_rm' => !empty($get_request->no_rm) ? $get_request->no_rm : '',
            'no_rawat' =>!empty( $get_request->no_rawat ) ? $get_request->no_rawat : '',
            'tab'=>!empty( $get_request->tab ) ? $get_request->tab : '',
            'form_filter_text'=>!empty( $get_request->form_filter_text ) ? $get_request->form_filter_text : '',
            'form_filter_start'=>!empty( $get_request->form_filter_start ) ? $get_request->form_filter_start : date('Y-m-d'),
            'form_filter_end'=>!empty( $get_request->form_filter_end ) ? $get_request->form_filter_end : date('Y-m-d'),
            'fr'=>!empty( $get_request->fr ) ? $get_request->fr : '',
            'gsf'=>$sentForm,
        ];
        
        $action=!empty($request['action']) ? $request['action'] : '';
        $data_item=!empty($request['kode_item']) ? $request['kode_item'] : [];
        if(empty($data_item)){
            return redirect()->route($link_back, $link_back_param)->with(['error' => 'Tidak ada data yang dipilih']);
        }
        $get_request=(array)$get_request;
        $get_request['kode_item']=$data_item;
        $get_request=(object)$get_request;
        
        if($action=='delete'){
            $this->delete($request,$get_request);
        }

        return redirect()->route($link_back, $link_back_param);
    }

    function delete($request,$get_request){
        $link_back='tindakan_petugas';
        $paramater_req=[
            'kode_item'=>!empty($get_request->kode_item) ? $get_request->kode_item : [],
        ];
        $sentForm=(new \App\Http\Traits\GlobalFunction)->getSentForm($paramater_req);
        $link_back_param=[
            'no_rm' => !empty($get_request->no_rm) ? $get_request->no_rm : '',
            'no_rawat' =>!empty( $get_request->no_rawat ) ? $get_request->no_rawat : '',
            'tab'=>!empty( $get_request->tab ) ? $get_request->tab : '',
            'form_filter_text'=>!empty( $get_request->form_filter_text ) ? $get_request->form_filter_text : '',
            'form_filter_start'=>!empty( $get_request->form_filter_start ) ? $get_request->form_filter_start : date('Y-m-d'),
            'form_filter_end'=>!empty( $get_request->form_filter_end ) ? $get_request->form_filter_end : date('Y-m-d'),
            'fr'=>!empty( $get_request->fr ) ? $get_request->fr : '',
            'gsf'=>$sentForm,
        ];

        DB::beginTransaction();
        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];
        try {
            if(empty($get_request->no_rawat)){
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }

            $check_registrasi=(new \App\Http\Traits\GlobalFunction)->cariRegistrasi($get_request->no_rawat);
            
            if($check_registrasi>0){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Data billing sudah terverifikasi.<br>Silahkan hubungi bagian kasir/keuangan ..!!']);
            }

            $data_item=!empty($get_request->kode_item) ? $get_request->kode_item : [];

            $jlh_delete=0;
            foreach($data_item as $key => $value){
                $field=explode('@',$value);

                $parameter_delete=[
                    'no_rawat'=>$field[0],
                    'kd_jenis_prw'=>$field[1],
                    'nip'=>$field[2],
                    'tgl_perawatan'=>$field[3],
                    'jam_rawat'=>$field[4]
                ];

                $delete_model = $this->tindakanPetugasService->deleteTindakanPetugas($parameter_delete,$get_request->fr);
                if ($delete_model) {
                    $jlh_delete++;
                }else{
                    $jlh_delete=0;
                }
            }
            if ($jlh_delete>0) {
                DB::commit();
                unset($link_back_param['gsf']);
                $pesan=['success' => $message_default['success']];
            }else{
                DB::rollBack();
                $pesan=['error' => $message_default['error']];
            }
            return redirect()->route($link_back, $link_back_param)->with($pesan);

        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }
    }
}