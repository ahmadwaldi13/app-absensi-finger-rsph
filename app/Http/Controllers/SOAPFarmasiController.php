<?php

namespace App\Http\Controllers;
use App\Services\GlobalService;
use App\Services\SOAPFarmasiService;
use App\Services\RawatInapService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UxuiSOAPFarmasi;

class SOAPFarmasiController extends Controller
{
    public function __construct(
        RawatInapService $rawatInapService
    ) {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->url_name=$router_name->router_name;

       
        $this->rawatInapService = $rawatInapService;

        $this->globalService = new GlobalService;
        $this->soapFarmasiService = new SOAPFarmasiService;
    }
    function actionIndex(Request $request)
    {   
        $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {
            $exp=explode('@',$request->cdata);
            $id_soap_farmasi=!empty($exp[5]) ? $exp[5] : '';

            $model['fr']=$item_pasien->no_fr;
            $model['no_rawat']=$item_pasien->no_rawat;
            $model['no_rkm_medis']=$item_pasien->no_rm;
            $model['tgl_perawatan']='';
            $model['jam_rawat']='';
            
            $noRm = $item_pasien->no_rm;
            $dataPasien = $this->globalService->getDataPasien($noRm);
            //jika copy maka no rm menyesuaikan
            $paramater=[
                'reg_periksa.no_rkm_medis'=> $item_pasien->no_rm
            ];

            $list = $this->soapFarmasiService->getDataSOAPRanap($paramater,null);

            $paramaterdatacopy=[
                'uxui_soap_farmasi.id_soap_farmasi'=> $id_soap_farmasi
            ];
            $model = $this->soapFarmasiService->getDataSOAPRanap($paramaterdatacopy,null,1)->first();


            $parameter_view=[
                'dataPasien' => $dataPasien,
                'action_form' => 'soap-farmasi/create',
                'list' => $list,
                'listPetugas'=>!empty($listPetugas) ? $listPetugas : [],
                'model'=>!empty($model) ? $model : [],
            ];
            return view('soap-farmasi.index',$parameter_view);
        }
    }
    function actionCreate(Request $request)
    {
        DB::beginTransaction();
        $fields = $request->all();
        $link_back=$this->url_name;
        $link_back_param=['no_rm' => $request->no_rm, 'no_rawat' => $request->no_rawat,'fr'=>$request->fr];

        $message_default=[
            'success'=>'Data berhasil ditambahkan',
            'error'=>'Maaf data tidak berhasil ditambahkan'
        ];  

        try{
            $data_save=$fields;
            // dd($data_save["fr"]); 
            // unset($data_save["fr"]);
            unset($data_save["no_rm"]);
            unset($data_save["_token"]);

            $tanggalwaktu = $data_save['tgl_perawatan'] ." ".$data_save['jam_rawat'];
            
            $data_save['no_rawat']=!empty($data_save['no_rawat']) ? $data_save['no_rawat'] : '';
            $data_save['nip']=!empty($data_save['nik']) ? $data_save['nik'] : '';
            $data_save['subjek']=!empty($data_save['subjek']) ? $data_save['subjek'] : '';
            $data_save['objek']=!empty($data_save['objek']) ? $data_save['objek'] : '';
            $data_save['assessment']=!empty($data_save['assessment']) ? $data_save['assessment'] : '';
            $data_save['plan']=!empty($data_save['plan']) ? $data_save['plan'] : '';
            $data_save['created_at']=!empty($tanggalwaktu) ? $tanggalwaktu : '';
            $data_save["jns_rawat"]=!empty($data_save["fr"])?$data_save["fr"]:'';
            if($data_save){
                $paramater=[
                    'uxui_soap_farmasi.no_rawat'=> $data_save['no_rawat']
                ];
                $cek_data = $this->soapFarmasiService->getDataSOAPRanap($paramater,null,1)->whereDate('created_at','=', date('Y-m-d'))->first();
                
                if($cek_data){
                    return redirect()->route($link_back, $link_back_param)->with(['error' => 'Nomor rawat '.$data_save['no_rawat'].' sudah dilakukan penginputan hari ini']);
                }
                $data_save=(new UxuiSOAPFarmasi)->set_columns_table_with_data($data_save);
                // dd($data_save);
                $model=new UxuiSOAPFarmasi;
                $model->set_model_with_data($data_save);
                if($model->save()){
                    $is_save=1;     
                }
            }
            if($is_save){
                DB::commit();
                return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
            }else{
                DB::rollBack();
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }

        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }
    }

    function formUpdate(Request $request) {
        DB::beginTransaction();
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rawat=!empty($exp[1]) ? $exp[1] : ''; 
        $no_rm=!empty($exp[4]) ? $exp[4] : '';

        $id_soap_farmasi=!empty($exp[5]) ? $exp[5] : 0;

        $dataPasien = $this->globalService->getDataPasien($no_rm);

        $paramater=[
            'uxui_soap_farmasi.id_soap_farmasi'=> $id_soap_farmasi
        ];
        $model = $this->soapFarmasiService->getDataSOAPRanap($paramater,null,1)->first();

        $model=!empty($model) ? $model->getAttributes() : (object)[];
        $model['fr']=$type_akses;
        $model['no_rm']=$no_rm;
        $model=(object)$model;
        
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
        if($get_user->type_user=='dokter'){
            $listDokter = $this->globalService->getDokterList();
        }if($get_user->type_user=='petugas'){
            $listPetugas = $this->globalService->getPetugasList();
        }

        
        $kode_key_old=[
            'no_rawat'=>!empty($no_rawat) ? $no_rawat : '',
            'tgl_perawatan'=>!empty($exp[2]) ? $exp[2] : '',
            'jam_rawat'=>!empty($exp[3]) ? $exp[3] : '',
        ];

        $kode_key_old=(new \App\Http\Traits\GlobalFunction)->makeJson($kode_key_old);
        
        $parameter_view=[
            'action_form'=>'soap-farmasi/update',
            'kode_key_old'=>$kode_key_old,
            'dataPasien'=>$dataPasien,
            'noRm'=>$no_rm,
            'model'=>$model,
            'type_akses'=>$type_akses,
            'listDokter'=>!empty($listDokter) ? $listDokter : [],
            'listPetugas'=>!empty($listPetugas) ? $listPetugas : []
        ];

        if($request->ajax()){
            $returnHTML = view('soap-farmasi.form',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }

    function actionUpdate(Request $request){
        DB::beginTransaction();
        $fields = $request->all();
        unset($fields["fr"]);
        unset($fields["no_rm"]);
        $type_akses=!empty($request->fr) ? $request->fr : 'rj';
        $link_back= $this->url_name;
        $link_back_param=['no_rm' => $request->no_rm, 'no_rawat' => $request->no_rawat,'fr'=>$request->fr];

        $message_default=[
            'success'=>'Data berhasil diubah',
            'error'=>'Maaf data tidak berhasil diubah'
        ];
        try {   
            $data_save=$fields;
            unset($data_save["fr"]);
            unset($data_save["no_rm"]);
            unset($data_save["_token"]);
            
            $id_soap_farmasi = $fields["id_soap_farmasi"];
 
            
            $data_save['no_rawat']=!empty($data_save['no_rawat']) ? $data_save['no_rawat'] : '';
            $data_save['nip']=!empty($data_save['nik']) ? $data_save['nik'] : '';
            $data_save['subjek']=!empty($data_save['subjek']) ? $data_save['subjek'] : '';
            $data_save['objek']=!empty($data_save['objek']) ? $data_save['objek'] : '';
            $data_save['assessment']=!empty($data_save['assessment']) ? $data_save['assessment'] : '';
            $data_save['plan']=!empty($data_save['plan']) ? $data_save['plan'] : '';
            $data_save['updated_at']=date('Y-m-d h:i:s');

            if($data_save){
                $model = UxuiSOAPFarmasi::findOrfail($id_soap_farmasi);
                $model->set_model_with_data($data_save);
                if($model->update()){
                    $is_save=1;     
                }
            }
            if($is_save){
                DB::commit();
                return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
            }else{
                DB::rollBack();
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
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
    
    function actionDelete(Request $request){
        DB::beginTransaction();
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        
        $no_rawat=!empty($exp[1]) ? $exp[1] : 0;
        $tgl_perawatan=!empty($exp[2]) ? $exp[2] : 0;
        $jam_rawat=!empty($exp[3]) ? $exp[3] : 0;
        $no_rm=!empty($exp[4]) ? $exp[4] : 0;
        $id_soap_farmasi=!empty($exp[5]) ? $exp[5] : 0;

        $link_back='soap-farmasi';
        $link_back_param=['no_rm' => $no_rm, 'no_rawat' => $no_rawat,'fr'=>$type_akses];
        
        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];

        try {  
            $is_save =0;
            if(!empty($no_rawat) && !empty($tgl_perawatan) && !empty($jam_rawat) && !empty($id_soap_farmasi)){
                $paramater=[
                    'uxui_soap_farmasi.id_soap_farmasi'=>  $id_soap_farmasi
                ];
                $model = $this->soapFarmasiService->getDataSOAPRanap($paramater,null,1)->first();
                if(!$model){
                    return redirect()->route($link_back, $link_back_param)->with(['error' => 'Soap tidak tersedia']);
                }
                
                $deleteModel = $model->delete();
                $max = DB::table('uxui_soap_farmasi')->max('id_soap_farmasi') + 1; 
                DB::statement("ALTER TABLE uxui_soap_farmasi AUTO_INCREMENT =  $max");

                if($deleteModel){
                    $is_save= 1;
                }
            }
            
            if($is_save){
                DB::commit();
                return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
            }else{
                DB::rollBack();
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf data gagal dihapus']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        } 

    }
    

    function actionView(Request $request){
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';

        $id_soap_farmasi=!empty($exp[5]) ? $exp[5] : 0;
        
        $paramater=[
            'uxui_soap_farmasi.id_soap_farmasi'=> $id_soap_farmasi
        ];
        $model = $this->soapFarmasiService->getDataSOAPRanap($paramater,null,1)->first();


        $parameter_view=[
            'model'=>$model,
            'type_akses'=>$type_akses
        ];

        if($request->ajax()){
            $returnHTML = view('soap-farmasi.view',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }
}
