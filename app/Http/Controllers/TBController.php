<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Services\TBService;
use App\Models\UxuiPasienSitb;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TBController extends Controller
{
    public function __construct()
    {
        $this->tbService = new TBService;
    }

    function penyakitTBData(Request $request)
    {
        return $this->tbService->getDiagnosaTBList($request->search);
    }


    function actionCreate(Request $request)
    {
        DB::beginTransaction();
        $fields = $request->all();
        
        $link_back='isi_cppt';
        $link_back_param=['no_rm' => $request->no_rm, 'no_rawat' => $request->no_rawat,'fr'=>$request->fr];

        $message_default=[
            'success'=>'Data berhasil ditambahkan',
            'error'=>'Maaf data tidak berhasil ditambahkan'
        ];

        try {  
    
            if($fields){
                if($request->kode_icd_x==null || $request->tanggal_mulai_pengobatan==null || $request->sebelum_pengobatan_hasil_mikroskopis==null){
                    return redirect()->route($link_back, $link_back_param)->with(['error' => 'Diagnosa, Tanggal Mulai Pengobatan dan Hasil Lab Sebelum Pengobatan wajib diisi']);
                }

                $is_save = 0;
                $parameter = [
                    'uxui_pasien_sitb.no_rkm_medis' => $request->no_rm
                ];
                $cek_data = $this->tbService->checkPasienTB($parameter,1)->first();

                // kode penyakit tb dari juknis SITB
                $penyakitTB =['A15','A15.0','A15.1',"A15.2",'A15.3','A15.4','A15.5','A15.6','A15.7','A15.8','A15.9',
                    'A16','A16.0','A16.2','A16.3','A16.4','A16.5','A16.6','A16.7','A16.8','A16.9','A17+','A17.0+',
                    'A17.1+','A17.8+','A17.9+','A18','A18.0+','A18.1+','A18.2','A18.3','A18.4','A18.5+','A18.6+','A18.7+',
                    'A18.8+','A19','A19.0','A19.1','A19.2','A19.8','A19.9'
                ];

                // pengecekan apakah kode icd x yang diinput sudah sesuai dengan juknis atau belum
                if(!in_array($request->kode_icd_x,$penyakitTB)){
                    $link_back_param['singleDataTb'] = $request;
                    return redirect()->route($link_back, $link_back_param)->with(['error' => 'Diagnosa tidak sesuai dengan juknis SITB']);
                }
                    
                if($cek_data && $cek_data->status == 'BEROBAT'){
                    // update data
                    $create_format_SITB = $this->tbService->setDataSaveSITB($cek_data,$request,null,$cek_data->id_tb_03?$cek_data->id_tb_03:null,true);
                    $sendData = $this->tbService->sendDataSITB($create_format_SITB);
                    $create_format_local = $this->tbService->setDataSaveSITB($cek_data,$request,null,$cek_data->id_tb_03?$cek_data->id_tb_03:null,false);
                    unset($create_format_local['id_tb_03']);
                    
                    $model= UxuiPasienSitb::where('no_rkm_medis',$request->no_rm)->orderBy('id_tb_03', 'DESC')->first();
    
                    $model->set_model_with_data($create_format_local);
                    
                    if($model->update()){
                        $message_default['success'] = 'Update data TB berhasil dilakukan';
                        $is_save=1;     
                    }
                }else{
                    // insert data
                    $parameter1 = [
                        'no_rkm_medis' => $request->no_rm
                    ];

                    $getPasienData = $this->tbService->checkPasien($parameter1,1)->first();
                    $create_format_SITB = $this->tbService->setDataSaveSITB($getPasienData,$request,null,$getPasienData->id_tb_03?$cek_data->id_tb_03:null,true);
                    $sendData = $this->tbService->sendDataSITB($create_format_SITB);

                    if($sendData['status']=='berhasil'){
                        $create_format_local = $this->tbService->setDataSaveSITB($getPasienData,$request,null,$sendData['id_tb_03'],false);
                        
                        $model=new UxuiPasienSitb();
                        
                        $model->set_model_with_data($create_format_local);
                        
                        if($model->save()){
                            $is_save=1;    
                        }
                    }else{
                        return redirect()->route($link_back, $link_back_param)->with(['error' => 'Terjadi kesalahan saat input data ke SITB']);
                    }  
                }
                
                if($is_save){
                    DB::commit();
                    return redirect()->route($link_back, $link_back_param)->with(['success' => $message_default['success']]);
                }else{
                    dd('error 1');
                    DB::rollBack();
                    return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
                }
                
            }else{
                
                dd('error 2');
                return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
            }
        } catch(\Illuminate\Database\QueryException $e){
            dd('error catch 1 ',$e);
            DB::rollBack();
            if($e->errorInfo[1] == '1062'){
                return redirect()->route($link_back, $link_back_param)->with(['error' => 'Maaf tidak dapat menyimpan data yang sama']);
            }
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);

        } catch (\Throwable $e) {
            dd('error catch 2 ',$e);
            DB::rollBack();
            return redirect()->route($link_back, $link_back_param)->with(['error' => $message_default['error']]);
        }

    }

    function actionView(Request $request)
    {
        $fields = $request->all();
        $exp=explode('@',$fields['data_sent']);
        $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
        $no_rkm_medis=!empty($exp[1]) ? $exp[1] : '';

        $parameter = [
            'uxui_pasien_sitb.no_rkm_medis' => $no_rkm_medis
        ];

        $singleDataTb = $this->tbService->checkPasienTB($parameter,1)->first();
        $kamarInap=!empty($kamarInap[0]) ? $kamarInap[0] : (object)[];
        $model=!empty($model[0]) ? $model[0] : (object)[];
        $parameter_view=[
            'model'=>$singleDataTb
        ];

        $bagan_html='cppt.tb.view_tb';
       
        if($request->ajax()){
            $returnHTML = view($bagan_html,$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }else{
            return view($bagan_html,$parameter_view);
        }
    }
}
