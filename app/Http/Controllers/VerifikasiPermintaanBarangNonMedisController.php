<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\PermintaanBarangNonMedisService;

class VerifikasiPermintaanBarangNonMedisController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Verifikasi Permintaan Barang Non Medis';
        $this->breadcrumbs=[
            ['title'=>'Inventori','url'=>url('/')."/sub-menu?type=1"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->permintaanbarangNonMedisService = new PermintaanBarangNonMedisService;
    }

    function actionIndex(Request $request){
        // dd($request->all());
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';
        $filter_kd_departemen = !empty($request->filter_kd_departemen) ? $request->filter_kd_departemen : '';

        $filter_date_start=!empty($request->form_filter_date_start) ? $request->form_filter_date_start : date('Y-m-d');
        $filter_date_end=!empty($request->form_filter_date_end) ? $request->form_filter_date_end : date('Y-m-d');

        $paramater_valid=[
            'uxui_permintaan_barang_validasi.nip'=>$get_user->id_user
        ];

        $verifikator=(new \App\Services\MasterValidasiPermintaanBarangService)->getList($paramater_valid,1)->groupBy('uxui_permintaan_barang_validasi.nip')->first();
        $get_akses_validasi=!empty($verifikator->list_dep_id) ? explode(',',$verifikator->list_dep_id) : [];

        if($verifikator){
            $pegawai=(new \App\Services\PegawaiService() )->getList(['nik'=>$verifikator->nip],1)->first();
            $verifikator->nm_pegawai=!empty($pegawai->nama) ? $pegawai->nama : '';
        }

        $paramater=[
            'where_between'=>['permintaan_non_medis.tanggal'=>[$filter_date_start,$filter_date_end ]],
            'search'=>$form_filter_text,
            'where_in'=>['departemen.dep_id'=>$get_akses_validasi],
        ];

        if($filter_kd_departemen){
            $paramater['departemen.dep_id']=$filter_kd_departemen;
        }

        $form_filter_status=isset($request->form_filter_status) ? $request->form_filter_status : 'all';
        if($form_filter_status!='all'){
            $get_status_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)->get_status_verifikasi($form_filter_status);
            if($get_status_verifikasi->status==0){
                if($get_status_verifikasi->status_khanza){
                    $paramater['permintaan_non_medis.status']=['=','Baru'];
                    $paramater['where_raw']=['uxui_permintaan_barang_non_medis_status.status'=>['is null','' ] ];
                    $paramater['where_or']=['uxui_permintaan_barang_non_medis_status.status'=>['=',0 ] ];
                }
            }else{
                if(in_array($get_status_verifikasi->status, [1, 4])){
                    $paramater['uxui_permintaan_barang_non_medis_status.status']=['=',$get_status_verifikasi->status];
                }

                if($get_status_verifikasi->status_khanza){
                    $paramater['permintaan_non_medis.status']=['=',$get_status_verifikasi->status_khanza];
                }
            }
        }
        $list_data=$this->permintaanbarangNonMedisService->getList($paramater,1)->orderByRaw('CONVERT( REPLACE(permintaan_non_medis.no_permintaan,"PN", ""), UNSIGNED INTEGER ) DESC')->paginate(!empty($request->per_page) ? $request->per_page : 15);
        $get_status_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)->set_status_verifikasi();

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'verifikator'=>$verifikator,
            'list_data'=>$list_data,
            'get_status_verifikasi'=>$get_status_verifikasi
        ];

        return view($this->part_view.'.index',$parameter_view);
    }

    function actionView(Request $request){
        $kode = !empty($request->data_sent) ? $request->data_sent : '';

        $paramater=[
            'permintaan_non_medis.no_permintaan'=>['=',$kode],
        ];

        $model=$this->permintaanbarangNonMedisService->getList($paramater,1)->first();
        $list_data=$this->permintaanbarangNonMedisService->getListDetail($paramater);

        $paramater=[
            'uxui_permintaan_barang_non_medis_pengeluaran.no_permintaan'=>['=',$kode],
        ];
        $list_data_keluar=$this->permintaanbarangNonMedisService->getListDetailPengeluaran($paramater);

        $parameter_view=[
            'model'=>$model,
            'list_data'=>$list_data,
            'list_data_keluar'=>$list_data_keluar
        ];

        $view='permintaan-barang-non-medis';
        if($request->ajax()){
            $returnHTML = view($view.'.view',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }else{
            $parameter_bagan=[
                'title'=>$this->title,
                'title_plus'=>'Detail Data',
                'breadcrumbs'=>$this->breadcrumbs,
                'bagan_form'=>view($view.'.view',$parameter_view),
                'url_back'=>$this->url_name
            ];

            return view('layouts.index_bagan_form',$parameter_bagan);
        }
    }

    private function formVerifikasi(Request $request){
        $kode_tmp = !empty($request->data_sent) ? $request->data_sent : '';
        if(empty($kode_tmp)){
            $kode_tmp = !empty($request->key_old) ? $request->key_old : '';
        }
        $exp=explode('@',$kode_tmp);
        $kode=!empty($exp[0]) ? $exp[0] : '';
        $type=!empty($exp[1]) ? $exp[1] : '';
        // dd($kode);
        if($type!=3){
            // dd("this");
            $paramater=[
                'permintaan_non_medis.no_permintaan'=>['=',$kode],
            ];

            $model=$this->permintaanbarangNonMedisService->getList($paramater,1)->first();
            $list_data=$this->permintaanbarangNonMedisService->getListDetail($paramater);
            // dd($list_data, $model);
            $paramater=[
                'uxui_permintaan_barang_non_medis_pengeluaran.no_permintaan'=>['=',$kode],
            ];
            $list_data_keluar=$this->permintaanbarangNonMedisService->getListDetailPengeluaran($paramater);

            $parameter_view=[
                'model'=>$model,
                'list_data'=>$list_data,
                'list_data_keluar'=>$list_data_keluar,
                'bagan_sisip'=>view($this->part_view.'.button_verifikasi',['model'=>$model])->render(),
            ];

            $view='permintaan-barang-non-medis';
            if($request->ajax()){
                $returnHTML = view($view.'.view',$parameter_view)->render();
                return response()->json(array('success' => true, 'html'=>$returnHTML));
            }else{
                $parameter_bagan=[
                    'title'=>$this->title,
                    'title_plus'=>'Detail Data',
                    'breadcrumbs'=>$this->breadcrumbs,
                    'bagan_form'=>view($view.'.view',$parameter_view),
                    'url_back'=>$this->url_name
                ];
                // dd($parameter_bagan);
                return view('layouts.index_bagan_form',$parameter_bagan);
            }
        }else{
            // dd("that");
            $parameter_view = [
                'action_form' => $this->part_view.'/verifikasi',
                'kode'=>$kode_tmp
            ];

            if($request->ajax()){
                $returnHTML = view($this->part_view.'.form',$parameter_view)->render();
                return response()->json(array('success' => true, 'html'=>$returnHTML));
            }else{
                return view($this->part_view.'.form',$parameter_view);
            }
        }
    }

    function actionVerifikasi(Request $request){
        if($request->isMethod('get')){
            return $this->formVerifikasi($request);
        }
        if($request->isMethod('post')){
            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

            $req=$request->all();
            $kode_tmp = !empty($request->data_sent) ? $request->data_sent : '';
            if(empty($kode_tmp)){
                $kode_tmp = !empty($request->key_old) ? $request->key_old : '';
            }
            $exp=explode('@',$kode_tmp);
            $kode=!empty($exp[0]) ? $exp[0] : '';
            $status_verifikasi=!empty($exp[1]) ? $exp[1] : '';
            // dd($status_verifikasi);
            $link_back_redirect=$this->url_name.'/verifikasi';

            DB::beginTransaction();
            $pesan=[];
            $link_back_param=['data_sent'=>$kode];

            $message_default=[
                'success'=>'Data berhasil diverifikasi' ,
                'error'=>'Data tidak berhasil diverifikasi'
            ];

            try {
                $paramater_valid=[
                    'uxui_permintaan_barang_validasi.nip'=>$get_user->id_user
                ];
                $verifikator=(new \App\Services\MasterValidasiPermintaanBarangService)->getList($paramater_valid,1)->groupBy('uxui_permintaan_barang_validasi.nip')->first();

                if(!$verifikator){
                    return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Anda tidak diizinkan melakukan verifikasi']);
                }

                $verifikasi_n=1;
                $status_pangajuan=1;
                $status_khanza='Baru';

                $keterangan=!empty($req['keterangan']) ? $req['keterangan'] : '';

                if($status_verifikasi==3){
                    $status_pangajuan=3;
                    $status_khanza='Tidak Disetujui';
                }

                $is_save=0;

                $model = (new \App\Models\PermintaanNonMedis)
                    ->where('no_permintaan', '=', $kode)
                    ->where('status', '=', 'Baru')
                    ->first();

                if($model){
                    $model_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)
                        ->where('no_permintaan', '=', $kode)
                        ->where('verifikasi_ke', '=', $verifikasi_n)
                        ->first();

                    $data_save=[];
                    if(empty($model_verifikasi)){
                        $model_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus);
                        $pegawai=(new \App\Services\PegawaiService() )->getList(['nik'=>$get_user->id_user],1)->first();
                        if(empty($pegawai)){
                            return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Data pegawai tidak ditemukan']);
                        }
                        $data_save=[
                            'no_permintaan'=>$model->no_permintaan,
                            'nip'=>$get_user->id_user,
                            'departemen'=>$pegawai->departemen,
                            'verifikasi_ke'=>$verifikasi_n,
                            'tanggal'=>date('Y-m-d h:i:s'),
                            'keterangan'=>$keterangan
                        ];
                    }

                    $data_save['status']=$status_verifikasi;

                    $model_verifikasi->set_model_with_data($data_save);
                    if($model_verifikasi->save()){
                        $model_pengajuan=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)
                            ->where('no_permintaan', '=', $kode)
                            ->where('nip', '=', $model->nip)
                            ->where('pengajuan', '=', 1)
                            ->first();
                        $data_save=[];
                        if(empty($model_pengajuan)){
                            $pegawai=(new \App\Services\PegawaiService() )->getList(['nik'=>$model->nip],1)->first();
                            $model_pengajuan=(new \App\Models\UxuiPermintaanBarangNonMedisStatus);
                            $data_save=[
                                "no_permintaan" => $model->no_permintaan,
                                "nip" => $model->nip,
                                "departemen" => $pegawai->departemen,
                                "pengajuan" => 1,
                                "tanggal" => $model->tanggal,
                            ];
                        }

                        $data_save['status']=$status_pangajuan;

                        $model_pengajuan->set_model_with_data($data_save);
                        if($model_pengajuan->save()){
                            $data_save=[];
                            $data_save['status']=$status_khanza;

                            $model->set_model_with_data($data_save);
                            if($model->save()){
                                $is_save=1;
                            }
                        }
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

            return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
        }
    }


    function getListDepartemen(Request $request){

        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

        $paramater_valid=[
            'uxui_permintaan_barang_validasi.nip'=>$get_user->id_user,
        ];
        $verifikator=(new \App\Services\MasterValidasiPermintaanBarangService)->getList($paramater_valid,1)->groupBy('uxui_permintaan_barang_validasi.nip')->first();
        $get_akses_validasi=!empty($verifikator->list_dep_id) ? explode(',',$verifikator->list_dep_id) : [];
        $list_data_tmp = [];
        if(!empty($get_akses_validasi)){
            $paramater=[
                'where_in'=>['dep_id'=>$get_akses_validasi],
            ];

            $data_tmp_tmp=( new \App\Models\Departemen );
            $list_data_tmp=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater,['where_or'=>['dep_id','nama']])->get();
        }

        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->dep_id,
                'kode'=>[
                    'data-item'=>$value->nama.'@'.$value->dep_id,
                    'value'=>$value->nama
                ],
            ];
        }

        $table=[
            'header'=>[
               'title'=> ['kode Departemen','Nama Departemen'],
               'parameter'=>[' class="w-10" ',' class="w-25" ']
            ],
            // 'columns_parameter'=>['class=py-3',''],
        ];

        $parameter_view=[
            'table'=>$table,
            'list_data'=>!empty($list_data) ? $list_data : ''
        ];

        return [
            'success' => true,
            'html'=>view('ajax.columns_ajax',$parameter_view)->render(),
        ];
    }


    function ajax(Request $request){
        $get_req = $request->all();
        if(!empty($get_req['action'])){
            if($get_req['action']=='departemen'){
                $hasil=$this->getListDepartemen($request);
                if($request->ajax()){
                    $return='';
                    if($hasil){
                        return response()->json($hasil);
                    }
                    return $return;
                }
                return $hasil;
            }
        }
    }
    public function actionUnduhBerkas(Request $request){
        $filename = "barang.pdf";
        $no_permintaan = !empty($request->data_sent) ? $request->data_sent : '';
        $result  = $this->permintaanbarangNonMedisService->getBarangPetugasPDF($no_permintaan);


        $pdf = (new \Resources\views\LayoutPdf\PermintaanBarangNonMedis\PermintaanBarangNonMedis)->makePDF($result);
        return $pdf->Output(public_path($filename), 'I');
    }
}