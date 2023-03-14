<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\PermintaanBarangNonMedisService;

class VerifikasiInventoriPermintaanBarangNonMedisController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Verifikasi Inventori Permintaan Barang Non Medis';
        $this->breadcrumbs=[
            ['title'=>'Inventori','url'=>url('/')."/sub-menu?type=1"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->permintaanbarangNonMedisService = new PermintaanBarangNonMedisService;
    }

    function actionIndex(Request $request){

        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';
        $filter_kd_departemen = !empty($request->filter_kd_departemen) ? $request->filter_kd_departemen : '';

        $filter_date_start=!empty($request->form_filter_date_start) ? $request->form_filter_date_start : date('Y-m-d');
        $filter_date_end=!empty($request->form_filter_date_end) ? $request->form_filter_date_end : date('Y-m-d');

        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

        $data_pegawai=!empty($get_user->pegawai) ? (object)$get_user->pegawai : '';

        $paramater=[
            'where_between'=>['permintaan_non_medis.tanggal'=>[$filter_date_start,$filter_date_end ]],
            'search'=>$form_filter_text,
        ];

        if($filter_kd_departemen){
            $paramater['departemen.dep_id']=$filter_kd_departemen;
        }

        $form_filter_status=isset($request->form_filter_status) ? $request->form_filter_status : 1;
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

        $get_status_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)->set_status_verifikasi();

        $list_data=$this->permintaanbarangNonMedisService->getList($paramater,1)->orderByRaw('CONVERT( REPLACE(permintaan_non_medis.no_permintaan,"PN", ""), UNSIGNED INTEGER ) DESC')->paginate(!empty($request->per_page) ? $request->per_page : 15);

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'data_pegawai'=>$data_pegawai,
            'get_status_verifikasi'=>$get_status_verifikasi,
            'form_filter_status'=>$form_filter_status,
            'list_data'=>$list_data,
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

    private function form(Request $request){
        $kode_tmp = !empty($request->data_sent) ? $request->data_sent : '';
        if(empty($kode_tmp)){
            $kode_tmp = !empty($request->key_old) ? $request->key_old : '';
        }

        if( (new \App\Http\Traits\AuthFunction)->checkAkses($this->url_index.'/fullAkses') ){
            $check_pengajuan=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)
            ->where('no_permintaan', '=', $kode_tmp)
            ->where('pengajuan', '=', 1)
            ->whereIn('status', [2,3])
            ->first();

            if(!empty($check_pengajuan)){
                dd($check_pengajuan);
                die;
            }
        }


        $exp=explode('@',$kode_tmp);
        $kode=!empty($exp[0]) ? $exp[0] : '';
        $type=!empty($exp[1]) ? $exp[1] : '';

        $status_check_data=0;
        if(!empty($request->button_check_data)){
            $status_check_data=1;
            $kode=!empty($request->check_data) ? $request->check_data : '';
        }

        if(empty($kode)){
            return redirect()->route($this->url_name, [])->with(['error'=>'No.Permintaan Tidak Ditemukan']);
        }
        $paramater=[
            'permintaan_non_medis.no_permintaan'=>['=',$kode],
        ];

        $model_permintaan=$this->permintaanbarangNonMedisService->getList($paramater,1)->first();
        $list_data=$this->permintaanbarangNonMedisService->getListDetail($paramater);

        $get_kode_list=[];
        $get_data_gudang=[];
        if($status_check_data){

            if(!empty($list_data)){
                foreach($list_data as $value){
                    $get_kode_list[]=$value->kode_brng;

                }
            }

            if($get_kode_list){
                $paramater=[
                    'where_in'=>['ipsrsbarang.kode_brng'=>$get_kode_list],
                ];
                $get_data_gudang_tmp=(new \App\Services\BarangNonMedisService)->getBarangList($paramater);
                if($get_data_gudang_tmp){
                    foreach($get_data_gudang_tmp as $value){
                        $get_data_gudang[$value->kode_brng]=$value;
                    }

                }
            }

            $action_form = $this->part_view.'/verifikasi';
        }

        $paramater=[
            'uxui_permintaan_barang_non_medis_pengeluaran.no_permintaan'=>['=',$kode],
        ];
        $list_data_keluar=$this->permintaanbarangNonMedisService->getListDetailPengeluaran($paramater);

        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
        $user_verifikasi=(object)[
            'nip'=>$get_user->id_user,
            'nm_pegawai'=>$get_user->nama_user,
        ];


        $ket_keluar=(!empty($model_permintaan->no_permintaan) ? $model_permintaan->no_permintaan.' '.(!empty($model_permintaan->ruang) ? ','.$model_permintaan->ruang : '') : '').' '.(!empty($model_permintaan->nip) ? ',oleh '.$model_permintaan->nip.' '.(!empty($model_permintaan->nama) ? $model_permintaan->nama : '') : '') ;
        $model_pengeluaran=(object)[
            'no_keluar'=>$this->getNoKeluar($request),
            'keterangan'=>$ket_keluar
        ];

        $parameter_view=[
            'model'=>[],
            'model_permintaan'=>$model_permintaan,
            'model_pengeluaran'=>$model_pengeluaran,
            'user_verifikasi'=>$user_verifikasi,
            'list_data'=>$list_data,
            'list_data_keluar'=>$list_data_keluar,
            'get_data_gudang'=>!empty($get_data_gudang) ? $get_data_gudang : [],
            'action_form'=>!empty($action_form) ? $action_form : '',
        ];

        if($request->ajax()){
            $returnHTML = view($this->part_view.'.form',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }else{
            $parameter_bagan=[
                'title'=>$this->title,
                'title_plus'=>'Detail Data',
                'breadcrumbs'=>$this->breadcrumbs,
                'bagan_form'=>view($this->part_view.'.form',$parameter_view),
                'url_back'=>$this->url_name
            ];

            return view('layouts.index_bagan_form',$parameter_bagan);
        }
    }

    private function actionVerifikasiTolak($request){
        $kode = !empty($request->data_sent) ? $request->data_sent : '';
        if(empty($kode)){
            $kode = !empty($request->key_old) ? $request->key_old : '';
        }

        $link_back_redirect=$this->url_name.'/verifikasi';

        DB::beginTransaction();
        $pesan=[];
        $link_back_param=['data_sent'=>$kode];

        $message_default=[
            'success'=>'Data berhasil diverifikasi' ,
            'error'=>'Data tidak berhasil diverifikasi'
        ];

        try {

            if( (new \App\Http\Traits\AuthFunction)->checkAkses($this->url_index.'/fullAkses') ){
                $paramater=[
                    'no_permintaan'=>['=',$kode],
                    'pengajuan'=>['=',1],
                    'status'=>2
                ];

                $data_tmp_tmp=(new \App\Models\UxuiPermintaanBarangNonMedisStatus);
                $check_model_status=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater,[])->first();
            }


            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
            if(empty($get_user->pegawai)){
                return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Verifikasi tidak terdaftar sebagai pegawai']);
            }

            $is_save=0;
            $verifikasi_n=2;
            $status_verifikasi=3;
            $status_khanza='Tidak Disetujui';

            $model = (new \App\Models\PermintaanNonMedis)
                ->where('no_permintaan', '=', $kode)
                ->first();

            if(empty($model)){
                return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Pengajuan tidak ditemukan']);
            }

            $data_save=[];
            $data_save['status']=$status_khanza;

            $model->set_model_with_data($data_save);
            if($model->save()){
                $model_pengajuan=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)
                    ->where('no_permintaan', '=', $kode)
                    ->where('nip', '=', $model->nip)
                    ->where('pengajuan', '=', 1)
                    ->first();

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

                $data_save['status']=$status_verifikasi;

                $model_pengajuan->set_model_with_data($data_save);
                if($model_pengajuan->save()){

                    $model_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)
                        ->where('no_permintaan', '=', $kode)
                        ->where('verifikasi_ke', '=', $verifikasi_n)
                        ->first();

                    if(empty($model_verifikasi)){
                        $model_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus);
                        $data_save=[
                            'no_permintaan'=>$model->no_permintaan,
                            'verifikasi_ke'=>$verifikasi_n,
                        ];
                    }

                    $data_save_form=$request->all();
                    $data_save['nip']=$get_user->id_user;
                    $data_save['departemen']=$get_user->pegawai['departemen'];
                    $data_save['status']=$status_verifikasi;

                    $data_save=array_merge($data_save_form,$data_save);
                    $model_verifikasi->set_model_with_data($data_save);

                    if($model_verifikasi->save()){
                        $is_save=1;
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

    private function actionVerifikasiTerima($request){
        $req=$request->all();
        // dd($req);
        $kode = !empty($request->data_sent) ? $request->data_sent : '';
        if(empty($kode)){
            $kode = !empty($request->key_old) ? $request->key_old : '';
        }

        $link_back_redirect=$this->url_name.'/verifikasi';

        DB::beginTransaction();
        $pesan=[];
        $link_back_param=['data_sent'=>$kode];

        $message_default=[
            'success'=>'Data berhasil diverifikasi' ,
            'error'=>'Data tidak berhasil diverifikasi'
        ];

        try {
            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
            if(empty($get_user->pegawai)){
                return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Verifikasi tidak terdaftar sebagai pegawai']);
            }

            $is_save=0;
            $verifikasi_n=2;
            $status_verifikasi=2;
            $status_khanza='Disetujui';

            $model = (new \App\Models\PermintaanNonMedis)
                ->where('no_permintaan', '=', $kode)
                ->first();

            if(empty($model)){
                return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Pengajuan tidak ditemukan']);
            }

            $data_save=[];
            $data_save['status']=$status_khanza;

            $model->set_model_with_data($data_save);
            if($model->save()){
                $model_pengajuan=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)
                    ->where('no_permintaan', '=', $kode)
                    ->where('nip', '=', $model->nip)
                    ->where('pengajuan', '=', 1)
                    ->first();

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

                $data_save['status']=$status_verifikasi;

                $model_pengajuan->set_model_with_data($data_save);
                if($model_pengajuan->save()){

                    $model_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)
                        ->where('no_permintaan', '=', $kode)
                        ->where('verifikasi_ke', '=', $verifikasi_n)
                        ->first();

                    if(empty($model_verifikasi)){
                        $model_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus);
                        $data_save=[
                            'no_permintaan'=>$model->no_permintaan,
                            'verifikasi_ke'=>$verifikasi_n,
                        ];
                    }

                    $data_save_form=$request->all();
                    $data_save['nip']=$get_user->id_user;
                    $data_save['departemen']=$get_user->pegawai['departemen'];
                    $data_save['status']=$status_verifikasi;

                    $data_save=array_merge($data_save_form,$data_save);
                    $model_verifikasi->set_model_with_data($data_save);

                    if($model_verifikasi->save()){
                        $is_save=1;
                    }
                }
            }

            $gagal=0;
            $is_save_tmp=0;
            if($is_save){
                $is_save=0;
                $no_permintaan=$model->no_permintaan;
                $no_keluar=!empty($request->no_keluar) ? $request->no_keluar : '';

                $model_pengeluaran= (new \App\Models\IpsrsPengeluaran)
                ->where('no_keluar', '=', $no_keluar)
                ->first();

                if(empty($model_pengeluaran)){
                    $model_pengeluaran= (new \App\Models\IpsrsPengeluaran);
                    $model_pengeluaran->no_keluar=$this->getNoKeluar($request);
                }

                $data_save_tmp=$request->all();
                unset($data_save_tmp['no_keluar']);
                $data_save=[];
                $data_save=$data_save_tmp;

                $model_pengeluaran->set_model_with_data($data_save);
                if($model_pengeluaran->save()){

                    (new \App\Models\UxuiPermintaanBarangNonMedisPengeluaran)->where('no_permintaan', '=', $no_permintaan)->where('no_keluar', '=', $model_pengeluaran->no_keluar)->delete();

                    $model_pengeluaran_ux=(new \App\Models\UxuiPermintaanBarangNonMedisPengeluaran);
                    $model_pengeluaran_ux->no_permintaan=$no_permintaan;
                    $model_pengeluaran_ux->no_keluar=$model_pengeluaran->no_keluar;

                    if($model_pengeluaran_ux->save()){

                        $item_list_terpilih_tmp=!empty($request->item_list_terpilih) ? $request->item_list_terpilih : '';
                        $link_back_param=['check_data'=>$no_permintaan,'button_check_data'=>1,'item_list_terpilih'=>$item_list_terpilih_tmp];

                        // $arr_item_list_terpilih = json_decode($item_list_terpilih_tmp);
                        $item_list_terpilih_tmp=json_decode($item_list_terpilih_tmp);
                        // dd((object)$item_list_terpilih_tmp);
                        if(empty($item_list_terpilih_tmp)){
                            $is_save=0;
                            return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Item barang tidak di pilih']);
                        }

                        $item_list_terpilih=[];
                        $get_kode_list=[];
                        $item_list_terpilih_keterangan = [];
                        foreach($item_list_terpilih_tmp as $key=>$value){
                            $get_kode_list[]=$key;
                            $item_list_terpilih[$key]=!empty($value->jml) ? $value->jml : '';
                            $item_list_terpilih_keterangan[$key] = !empty($value->keterangan_pengeluaran) ? $value->keterangan_pengeluaran : '';
                        }
                        // dd($item_list_terpilih, $item_list_terpilih_keterangan);
                        if($get_kode_list){
                            $paramater=[
                                'where_in'=>['ipsrsbarang.kode_brng'=>$get_kode_list],
                            ];
                            $get_data_gudang_tmp=(new \App\Services\BarangNonMedisService)->getBarangList($paramater);
                            if($get_data_gudang_tmp){

                                (new \App\Models\IpsrsDetailPengeluaran)->where('no_keluar', '=', $model_pengeluaran->no_keluar)->delete();
                                // dd($get_data_gudang_tmp);
                                foreach($get_data_gudang_tmp as $value){

                                    if(array_key_exists($value->kode_brng,$item_list_terpilih)){
                                        $jumlah=$item_list_terpilih[$value->kode_brng];
                                        $stok=$value->stok;

                                        if($jumlah){
                                            if($stok>=$jumlah){
                                                $total=0;
                                                $total=$value->harga*$jumlah;

                                                $data_save=[];
                                                $data_save=[
                                                    'no_keluar'=>$model_pengeluaran->no_keluar,
                                                    'kode_brng'=>$value->kode_brng,
                                                    'kode_sat'=>$value->kode_sat,
                                                    'jumlah'=>$jumlah,
                                                    'harga'=>$value->harga,
                                                    'total'=>$total,
                                                ];

                                                $model_pengeluaran_detail=(new \App\Models\IpsrsDetailPengeluaran);

                                                $model_pengeluaran_detail->set_model_with_data($data_save);
                                                if($model_pengeluaran_detail->save()){
                                                    $model_barang=(new \App\Models\Ipsrsbarang)->where('kode_brng','=',$model_pengeluaran_detail->kode_brng)->first();
                                                    if(empty($model_barang)){
                                                        $is_save=0;
                                                        return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Stok Barang ada yang berubah']);
                                                    }

                                                    $stok_barang_old=$model_barang->stok;
                                                    $stok_barang_now=$stok_barang_old-$model_pengeluaran_detail->jumlah;

                                                    if($stok_barang_now<0){
                                                        $is_save=0;
                                                        return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Stok Barang ada yang tidak cukup']);
                                                    }

                                                    $model_barang->stok=$stok_barang_now;

                                                    if($model_barang->save()){
                                                        $model_ipsrs_detail_pengeluaran = (new \App\Models\UxuiPermintaanBarangNonMedisIpsrsDetailPengeluaran);
                                                        // $data_save_ipsrs_detail_pengeluaran = [
                                                        //     'no_permintaan'=> $no_permintaan,  
                                                        //     'no_keluar'=>$data_save['no_keluar'],
                                                        //     'kode_brng'=>$data_save['kode_brng'],
                                                        //     'keterangan'=>$item_list_terpilih_keterangan[$data_save['kode_brng']],
                                                        // ];
                                                        // dd($data_save_ipsrs_detail_pengeluaran);
                                                        $model_ipsrs_detail_pengeluaran->set_model_with_data([
                                                            'no_permintaan'=> $no_permintaan,  
                                                            'no_keluar'=>$data_save['no_keluar'],
                                                            'kode_brng'=>$data_save['kode_brng'],
                                                            'keterangan'=>$item_list_terpilih_keterangan[$data_save['kode_brng']],
                                                        ]);
                                                        if($model_ipsrs_detail_pengeluaran->save()){
                                                            $is_save_tmp++;
                                                        }
                                                    }else{
                                                        $gagal++;
                                                    }
                                                }
                                            }else{
                                                $gagal++;
                                            }
                                        }
                                    }
                                }

                            }
                        }

                        if(!empty($gagal)){
                            $is_save=0;
                            return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Stok Barang ada yang berubah']);
                        }

                        if(!empty($is_save_tmp)){
                            $is_save=1;
                        }

                    }
                }
            }

            if($is_save){
                DB::commit();
                $link_back_param=['data_sent'=>$kode];
                $pesan=['success',$message_default['success'],2];
            }else{
                DB::rollBack();
                $pesan=['error',$message_default['error'],3];
            }

        } catch(\Illuminate\Database\QueryException $e){

            DB::rollBack();
            dd($e);
            if($e->errorInfo[1] == '1062'){

            }
            $pesan=['error',$message_default['error'],3];

        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e);
            $pesan=['error',$message_default['error'],3];
        }

        return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
    }

    function actionVerifikasi(Request $request){
        if($request->isMethod('get')){
            return $this->form($request);
        }
        if($request->isMethod('post')){
            $req=$request->all();
            $type_action=!empty($request->type_submit) ? $request->type_submit : '';

            if($type_action==2){
                return $this->actionVerifikasiTerima($request);
            }
            elseif($type_action==3){
                return $this->actionVerifikasiTolak($request);
            }
            else{
                die;
            }
        }
    }

    function getNoKeluar(Request $request){
        $get_req = $request->all();
        $tanggal=!empty($get_req['tanggal']) ? $get_req['tanggal'] : date('Y-m-d');

        $get_data_1 = (new \App\Models\IpsrsPengeluaran)->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(no_keluar,3),signed)),0) as last'))->where('tanggal','=',$tanggal)->first();
        $get_data_2 = (new \App\Models\IpsrsPengeluaran)->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(no_keluar,3),signed)),0) as last'))->whereRaw('RIGHT(LEFT(no_keluar,10),6) = ? ', [ substr( str_replace("-", "", $tanggal),2) ])->first();

        $data=$get_data_1;
        if($get_data_2->last > $get_data_1->last){
            $data=$get_data_2;
        }

        return (new \App\Http\Traits\GlobalFunction)->autoNomor($data,$tanggal,"SKNM" . substr( str_replace("-", "", $tanggal),2),3);
    }

    function ajax(Request $request){
        $get_req = $request->all();
        if(!empty($get_req['action'])){
            if($get_req['action']=='no_keluar'){
                $hasil=$this->getNoKeluar($request);
                if($request->ajax()){
                    return response()->json(array('success' => true, 'content'=>$hasil));
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