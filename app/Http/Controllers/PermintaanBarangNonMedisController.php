<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\PermintaanBarangNonMedisService;
class PermintaanBarangNonMedisController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();

        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Permintaan Barang Non Medis';
        $this->breadcrumbs=[
            ['title'=>'Inventori','url'=>url('/')."/sub-menu?type=1"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->permintaanbarangNonMedisService = new PermintaanBarangNonMedisService;
    }

    function actionIndex(Request $request){
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';

        $filter_date_start=!empty($request->form_filter_date_start) ? $request->form_filter_date_start : date('Y-m-d');
        $filter_date_end=!empty($request->form_filter_date_end) ? $request->form_filter_date_end : date('Y-m-d');
// s       dd($request->all());
        $paramater=[
            'where_between'=>['permintaan_non_medis.tanggal'=>[$filter_date_start,$filter_date_end ]],
            'search'=>$form_filter_text
        ];
        $form_filter_status=isset($request->form_filter_status) ? $request->form_filter_status : 'all';
        if($form_filter_status!='all'){
            // dd('this');
            $get_status_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)->get_status_verifikasi($form_filter_status);
            // dd($get_status_verifikasi->status);
            if($get_status_verifikasi->status==0){
                if($get_status_verifikasi->status_khanza){
                    $paramater['permintaan_non_medis.status']=['=','Baru'];
                    $paramater['where_raw']=['uxui_permintaan_barang_non_medis_status.status'=>['in ( NUll, 0 )','' ] ];
                }
            }else{
                if(in_array($get_status_verifikasi->status, [1,2,4])){
                    // dd($get_status_verifikasi->status);
                    $paramater['uxui_permintaan_barang_non_medis_status.status']=['=',$get_status_verifikasi->status];
                }

                if($get_status_verifikasi->status_khanza){
                    $paramater['permintaan_non_medis.status']=['=',$get_status_verifikasi->status_khanza];
                }
            }
        }
        if( !(new \App\Http\Traits\AuthFunction)->checkAkses($this->url_index.'/fullAkses') ){
            // dd('also this');
            $paramater['permintaan_non_medis.nip']=['=',$get_user->id_user];
        }
        // dd(((new GlobalService())->toRawSql($this->permintaanbarangNonMedisService->getList($paramater,1)->orderByRaw('CONVERT( REPLACE(permintaan_non_medis.no_permintaan,"PN", ""), UNSIGNED INTEGER ) DESC'))));
        $list_data=$this->permintaanbarangNonMedisService->getList($paramater,1)->orderByRaw('CONVERT( REPLACE(permintaan_non_medis.no_permintaan,"PN", ""), UNSIGNED INTEGER ) DESC')->paginate(!empty($request->per_page) ? $request->per_page : 15);

        // dd($list_data);
        $get_status_verifikasi=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)->set_status_verifikasi();

        $parameter_view=[
            'title'=>$this->title,
            'breadcrumbs'=>$this->breadcrumbs,
            'list_data'=>$list_data,
            'get_status_verifikasi'=>$get_status_verifikasi
        ];

        // dd($paramater, $parameter_view);
        // dd($parameter_view);
        return view($this->part_view.'.index',$parameter_view);
    }

    private function form(Request $request){
        $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
        $kode = !empty($request->data_sent) ? $request->data_sent : '';

        $model=(new \App\Models\PermintaanNonMedis)->where('no_permintaan','=',$kode)->first();
        if ($model) {
            $action_form = $this->part_view.'/update';

            $paramater=[
                'permintaan_non_medis.no_permintaan'=>['=',$kode],
            ];

            $list_item=$this->permintaanbarangNonMedisService->getListDetail($paramater);
            $item_list_terpilih=[];
            if($list_item){
                // dd($list_item);
                foreach($list_item as $value){
                    $item_list_terpilih[$value->kode_brng]=[
                        'jml'=>(new \App\Http\Traits\GlobalFunction)->formatMoneyToSystem($value->jumlah,['.'=>',']),
                        'ket'=>$value->keterangan,
                        'data'=>[
                            '',
                            $value->kode_brng,
                            $value->nama_brng,
                            (string)$value->stok,
                            $value->satuan,
                            $value->nm_jenis,
                            '',
                        ]
                    ];
                }
            }
            if($item_list_terpilih){
                $item_list_terpilih=json_encode($item_list_terpilih);
            }

        } else {
            $action_form = $this->part_view.'/create';
            $model=(new \App\Models\PermintaanNonMedis);

            $model->no_permintaan=$this->getNoPermintaan($request);
            $model->nip=$get_user->id_user;
        }

        if(!empty($model->nip)){
            $pegawai=(new \App\Services\PegawaiService() )->getList(['nik'=>$model->nip],1)->first();
            $model->nm_pegawai=!empty($pegawai->nama) ? $pegawai->nama : '';
            $model->departemen=!empty($pegawai->departemen) ? $pegawai->departemen : '';
            $model->ruang=!empty($pegawai->departemen) ? $pegawai->departemen_nama : '';
        }

        $parameter_view = [
            'action_form' => $action_form,
            'model' => $model,
            'item_list_terpilih'=>!empty($item_list_terpilih) ? $item_list_terpilih : ''
        ];

        $get_request=$request->all();
        if(!empty($get_request['_token'])){
            unset($get_request['_token']);
        }
        $parameter_view=array_merge($parameter_view,$get_request);

        return view($this->part_view.'.form',$parameter_view);
    }

    function actionCreate(Request $request){
        if($request->isMethod('get')){
            return $this->form($request)->render();
        }
        if($request->isMethod('post')){
            return $this->proses($request);
        }
    }

    function actionUpdate(Request $request){
        if($request->isMethod('get')){
            $bagan_form=$this->form($request);
            $parameter_view=[
                'title'=>$this->title,
                'breadcrumbs'=>$this->breadcrumbs,
                'bagan_form'=>$bagan_form,
                'url_back'=>$this->url_name
            ];

            return view('layouts.index_bagan_form',$parameter_view);
        }

        if($request->isMethod('post')){
            return $this->proses($request);
        }
    }

    private function proses($request){
        $req=$request->all();
        $kode=!empty($req['key_old']) ? $req['key_old'] : '';

        $action_is_create= (str_contains($request->getPathInfo(),$this->url_index.'/create')) ? 1 : 0;
        $link_back_redirect=($action_is_create) ? $this->url_name : $this->url_name.'/update';

        DB::beginTransaction();
        $pesan=[];
        if($action_is_create){
            $link_back_param=[];
        }else{
            $link_back_param=['data_sent'=>$kode];
        }

        $link_back_param=array_merge($link_back_param,$request->all());
        $message_default=[
            'success'=>!empty($kode) ? 'Data berhasil diubah' : 'Data berhasil disimpan',
            'error'=>!empty($kode) ? 'Data tidak berhasil diubah' : 'Data berhasil disimpan'
        ];

        try {
            $data_save=$req;

            if( empty($data_save['nip']) or empty($data_save['ruang']) ){
                return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'NIP tidak boleh kosong/Form Ruangan tidak boleh kosong']);
            }
            if(!empty($action_is_create)){
                $kode=$this->getNoPermintaan($request);;
            }

            $model = (new \App\Models\PermintaanNonMedis)->where('no_permintaan', '=', $kode)->first();
            if(empty($model)){
                $model=(new \App\Models\PermintaanNonMedis);
                $data_save['no_permintaan']=$this->getNoPermintaan($request);

                $data_save['status']='Baru';
                $model->set_model_with_data($data_save);
            }else{
                $data_update['ruang']=$data_save['ruang'];
                $model->set_model_with_data($data_update);
            }

            $is_save=0;

            if($model->save()){
                $jml_save=0;
                $pegawai=(new \App\Services\PegawaiService() )->getList(['nik'=>$model->nip],1)->first();
                if($pegawai){
                    //jika sebagai verifikasi
                    $sebagai_verifikasi=0;
                    // if( (new \App\Models\UxuiPermintaanBarangValidasi)->where('nip', '=', $model->nip)->where('departemen','=',$pegawai->departemen)->count() ){
                    //     $data_save_ux=[
                    //         'no_permintaan'=>$model->no_permintaan,
                    //         'nip'=>$model->nip,
                    //         'departemen'=>$pegawai->departemen,
                    //         'verifikasi_ke'=>1,
                    //         'status'=>2,
                    //         'tanggal'=>date('Y-m-d h:i:s')
                    //     ];

                    //     $model_ux=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)
                    //     ->where('no_permintaan','=',$model->no_permintaan)
                    //     ->where('nip','=',$model->nip)
                    //     ->where('verifikasi_ke','=',1)
                    //     ->where('status','=',2)
                    //     ->first();
                    //     if(empty($model_ux)){
                    //         $model_ux=(new \App\Models\UxuiPermintaanBarangNonMedisStatus);
                    //     }
                    //     $model_ux->set_model_with_data($data_save_ux);
                    //     if($model_ux->save()){
                    //         $sebagai_verifikasi=1;
                    //         $jml_save++;
                    //     }
                    // }

                    $status_pengajuan=0;
                    if(!empty($sebagai_verifikasi)){
                        $status_pengajuan=1;
                    }
                    $data_save_ux=[
                        'no_permintaan'=>$model->no_permintaan,
                        'nip'=>$model->nip,
                        'departemen'=>$pegawai->departemen,
                        'pengajuan'=>1,
                        'status'=>$status_pengajuan,
                        'tanggal'=>date('Y-m-d h:i:s')
                    ];

                    $model_ux=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)
                    ->where('no_permintaan','=',$model->no_permintaan)
                    ->where('nip','=',$model->nip)
                    ->where('pengajuan','=',1)
                    ->where('status','=',$status_pengajuan)
                    ->first();

                    if(empty($model_ux)){
                        $model_ux=(new \App\Models\UxuiPermintaanBarangNonMedisStatus);
                    }

                    $model_ux->set_model_with_data($data_save_ux);
                    if($model_ux->save()){
                        $jml_save++;
                    }
                }

                if($jml_save>=1){
                    $item_list_terpilih=!empty($req['item_list_terpilih']) ? $req['item_list_terpilih'] : '';
                    $item_list_terpilih=json_decode($item_list_terpilih);
                    $item_list_terpilih=(array)$item_list_terpilih;
                    if($item_list_terpilih){
                        (new \App\Models\DetailPermintaanNonMedis)->where('no_permintaan', '=', $model->no_permintaan)->delete();
                        $jml_save=0;
                        foreach($item_list_terpilih  as $key => $value){
                            if(!empty($value->jml)){
                                $get_data=(new \App\Models\IpsrsBarang)->select('kode_sat')->where('kode_brng', '=', $key)->first();
                                $data_save=[
                                    'no_permintaan'=>$model->no_permintaan,
                                    'kode_brng'=>$key,
                                    'kode_sat'=>!empty($get_data->kode_sat) ? $get_data->kode_sat : '',
                                    'jumlah'=>(new \App\Http\Traits\GlobalFunction)->formatMoneyToSystem($value->jml),
                                    'keterangan'=>!empty($value->ket) ? $value->ket : ''
                                ];

                                $model=(new \App\Models\DetailPermintaanNonMedis);
                                $model->set_model_with_data($data_save);
                                if($model->save()){
                                    $jml_save++;
                                }
                            }
                        }
                    }

                    if($jml_save>=1){
                        $is_save=1;
                    }
                }
            }

            if($is_save){
                DB::commit();
                $link_back_param=$this->clear_request($link_back_param,$request);
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

    function actionDelete(Request $request){

        DB::beginTransaction();
        $pesan=[];
        $link_back_param=[];
        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];

        $kode = !empty($request->data_sent) ? $request->data_sent : null;

        try {
            $model = (new \App\Models\PermintaanNonMedis)->where('no_permintaan', '=', $kode)->first();
            if(empty($model)){
                return redirect()->route($this->url_name, $link_back_param)->with(['error','Data tidak ditemukan']);
            }

            $is_save=0;
            // $model->setKeyName(['kode_brng']);
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

        return redirect()->route($this->url_name, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
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


        if($request->ajax()){
            $returnHTML = view($this->part_view.'.view',$parameter_view)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }else{
            $parameter_bagan=[
                'title'=>$this->title,
                'title_plus'=>'Detail Data',
                'breadcrumbs'=>$this->breadcrumbs,
                'bagan_form'=>view($this->part_view.'.view',$parameter_view),
                'url_back'=>$this->url_name
            ];

            return view('layouts.index_bagan_form',$parameter_bagan);
        }
    }



    function getNoPermintaan(Request $request){
        $get_req = $request->all();
        $tanggal=!empty($get_req['tanggal']) ? $get_req['tanggal'] : date('Y-m-d');

        $get_data_1 = (new \App\Models\PermintaanNonMedis)->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(no_permintaan,3),signed)),0) as last'))->where('tanggal','=',$tanggal)->first();
        $get_data_2 = (new \App\Models\PermintaanNonMedis)->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(no_permintaan,3),signed)),0) as last'))->whereRaw('RIGHT(LEFT(no_permintaan,8),6) = ? ', [ substr( str_replace("-", "", $tanggal),2) ])->first();

        $data=$get_data_1;
        if($get_data_2->last > $get_data_1->last){
            $data=$get_data_2;
        }

        return (new \App\Http\Traits\GlobalFunction)->autoNomor($data,$tanggal,"PN" . substr( str_replace("-", "", $tanggal),2) ,3);
    }

    function getListBarangMasterForm(Request $request){

        $hasil_data=[];
        try{

            $filter_kd_jenis='';
            $form_filter_text='';
            $search = !empty($request->search) ? $request->search : '';
            $filter=!empty($search['value']) ? $search['value'] : '';
            if($filter){
                $filter=json_decode($filter);
                if(!empty($filter)){
                    foreach($filter as $value){
                        if( trim(strtolower($value->name))=='filter_kd_jenis' ){
                            $filter_kd_jenis=$value->value;
                        }
                        if( trim(strtolower($value->name))=='form_filter_text' ){
                            $form_filter_text=$value->value;
                        }
                    }
                }
            }

            $start_page=!empty($request->start) ? $request->start : 0;
            $end_page=!empty($request->end) ? $request->end : 8;

            $paramater=[
                'ipsrsbarang.status'=>['=','1'],
                'search'=>$form_filter_text
            ];
            if(!empty($filter_kd_jenis)){
                $paramater['jenis']=$filter_kd_jenis;
            }

            $data_tmp=( new \App\Services\BarangNonMedisService )->getBarangList($paramater,1)->where("ipsrsbarang.stok", ">", "0")->offset($start_page)->limit($end_page)->get();
            $data_count=( new \App\Services\BarangNonMedisService )->getBarangList($paramater,1)->count();
            if(!empty($data_tmp)){
                foreach($data_tmp as $value){
                    $data=[
                        "<input type='text' class='form-control money jml_b' data-kode='".$value->kode_brng."'>",
                        !empty($value->kode_brng) ? $value->kode_brng : '',
                        !empty($value->nama_brng) ? $value->nama_brng : '',
                        isset($value->stok) ? (string)$value->stok : '',
                        !empty($value->satuan) ? $value->satuan : '',
                        !empty($value->nm_jenis) ? $value->nm_jenis : '',
                        "<textarea class='form-control ket_b' row='2' data-kode='".$value->kode_brng."'></textarea>",
                    ];
                    $hasil_data[]=$data;
                }
            }

        } catch (\Throwable $e) {
            $hasil_data=[];
        }

        return [
            'data'=>!empty($hasil_data) ? $hasil_data : [],
            'recordsTotal'=>!empty($data_count) ? $data_count : 0,
            'recordsFiltered'=>!empty($data_count) ? $data_count : 0,
        ];
    }

    function ajax(Request $request){
        $get_req = $request->all();
        if(!empty($get_req['action'])){
            if($get_req['action']=='no_permintaan'){
                $hasil=$this->getNoPermintaan($request);
                if($request->ajax()){
                    return response()->json(array('success' => true, 'content'=>$hasil));
                }
                return $hasil;
            }

            if($get_req['action']=='list_barang_master_form'){
                $hasil=$this->getListBarangMasterForm($request);
                if($request->ajax()){
                    $return='';
                    if($hasil){
                        $return =json_encode($hasil);
                    }
                    return $return;
                    // return response()->json(array('success' => true, 'content'=>$hasil));
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

    private function formVerifikasi(Request $request){
        $kode_tmp = !empty($request->data_sent) ? $request->data_sent : '';
        if(empty($kode_tmp)){
            $kode_tmp = !empty($request->key_old) ? $request->key_old : '';
        }
        $exp=explode('@',$kode_tmp);
        $kode=!empty($exp[0]) ? $exp[0] : '';
        $type=!empty($exp[1]) ? $exp[1] : '';

        if($type!=3){
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
                return view('layouts.index_bagan_form',$parameter_bagan);
            }
        }else{

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
            // dd($request->all());
            $get_user=(new \App\Http\Traits\AuthFunction)->getUser();

            $req=$request->all();
            $kode_tmp = !empty($request->data_sent) ? $request->data_sent : '';
            if(empty($kode_tmp)){
                $kode_tmp = !empty($request->key_old) ? $request->key_old : '';
            }
            $exp=explode('@',$kode_tmp);
            $kode=!empty($exp[0]) ? $exp[0] : '';
            $status_verifikasi=!empty($exp[1]) ? $exp[1] : '';

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
                // $verifikator=(new \App\Services\MasterValidasiPermintaanBarangService)->getList($paramater_valid,1)->groupBy('uxui_permintaan_barang_validasi.nip')->first();

                // if(!$verifikator){
                //     return redirect()->route($link_back_redirect, $link_back_param)->with(['error'=>'Anda tidak diizinkan melakukan verifikasi']);
                // }

                $verifikasi_n=3;
                $status_pangajuan = 4;
                $keterangan=!empty($req['keterangan']) ? $req['keterangan'] : '';

                if($status_verifikasi==3){
                    $status_pangajuan=3;
                }

                $is_save=0;

                $model = (new \App\Models\PermintaanNonMedis)
                    ->where('no_permintaan', '=', $kode)
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
                            $is_save=1;
                        }
                    }
                }

                if($is_save){
                    DB::commit();
                    $pesan=['success',$message_default['success'],2];
                }else{
                    DB::rollBack();
                    $pesan=['error',$message_default['error']."1",3];
                }
            } catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                if($e->errorInfo[1] == '1062'){

                }
                $pesan=['error',$message_default['error']."2",3];

            } catch (\Throwable $e) {
                DB::rollBack();
                dd($e);
                $pesan=['error',$message_default['error']."3",3];
            }

            return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
        }
    }
}