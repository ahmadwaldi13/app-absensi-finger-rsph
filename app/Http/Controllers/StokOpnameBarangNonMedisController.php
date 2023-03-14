<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;
use App\Services\StokOpnameBarangNonMedisService;
class StokOpnameBarangNonMedisController extends \App\Http\Controllers\MyAuthController
{
    public function __construct() {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();

        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Stok Opname Barang Non Medis';
        $this->view='View';
        $this->breadcrumbs=[
            ['title'=>'Inventori','url'=>url('/')."/sub-menu?type=1"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
        ];
        $this->breadcrumbs_view=[
            ['title'=>'Inventori','url'=>url('/')."/sub-menu?type=1"],
            ['title'=>$this->title,'url'=>url('/')."/".$this->url_index],
            ['title'=>$this->view,'url'=>url('/')."/".$this->part_view]
        ];

        $this->globalService = new GlobalService;
        $this->stokOpnameBarangNonMedisService = new StokOpnameBarangNonMedisService;
    }

    function actionIndex(Request $request){
    $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';
    $filter_date_start=!empty($request->form_filter_date_start) ? $request->form_filter_date_start : "2001-01-12";
    $filter_date_end=!empty($request->form_filter_date_end) ? $request->form_filter_date_end : date('Y-m-d');

    $paramater=[
        'where_between'=>['ipsrsopname.tanggal'=>[$filter_date_start,$filter_date_end ]],
        'search'=> $form_filter_text
    ];

    // $list_data=$this->stokOpnameBarangNonMedisService->getList($paramater,1)->orderBy('ipsrsopname.tanggal','DESC')->paginate(!empty($request->per_page) ? $request->per_page : 15);

    $list_data=$this->stokOpnameBarangNonMedisService->datacolumn($paramater,1)->paginate(!empty($request->per_page) ? $request->per_page : 15);
    // dd($get_data2->tanggal);

    $parameter_view=[
        'title'=>$this->title,
        'breadcrumbs'=>$this->breadcrumbs,
        'list_data'=>$list_data,
    ];
    // dd($parameter_view);
    return view($this->part_view.'.index',$parameter_view);
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

        $data_tmp=( new \App\Services\BarangNonMedisService )->getBarangList($paramater,1)->offset($start_page)->limit($end_page)->get();
        $data_count=( new \App\Services\BarangNonMedisService )->getBarangList($paramater,1)->count();
        if(!empty($data_tmp)){
            foreach($data_tmp as $value){

                $data=[
                    "<input type='text' class='form-control jml_b' data-kode='".$value->kode_brng."'>",
                    !empty($value->kode_brng) ? $value->kode_brng : '',
                    !empty($value->nama_brng) ? $value->nama_brng : '',
                    !empty($value->kode_sat) ? $value->kode_sat : '',
                    !empty($value->jenis) ? $value->jenis : '',
                    !empty($value->harga) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($value->harga, 'Rp.') : '',
                    !empty($value->stok) ? (string)$value->stok : '',
                    "<input type='text' class='form-control selisih_b' data-kode='".$value->kode_brng."'>",
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

    private function proses($request){
        $req=$request->all();
        // dd($req);
        $kode=!empty($req['key_old']) ? $req['key_old'] : '';
        $tanggal=!empty($req['tanggal']) ? $req['tanggal'] : '';
        $ket = !empty($req['ket']) ? $req['ket'] : '';
        $action_is_create= (str_contains($request->getPathInfo(),$this->url_index.'/create')) ? 1 : 0;
        $link_back_redirect=($action_is_create) ? $this->url_name : $this->url_name.'/update';

        try {
            DB::beginTransaction();
            $pesan=[];
            if($action_is_create){
                $link_back_param=[];
            }else{
                $link_back_param=[
                    'tgl'=>$tanggal
                ];
            }

            $link_back_param=array_merge($link_back_param,$request->all());
            $message_default=[
                'success'=>!empty($tanggal) ? 'Data berhasil diubah' : 'Data berhasil disimpan',
                'error'=>!empty($tanggal) ? 'Gagal Mneyimpan, Item Tersebut Telah di Simpan !' : 'Data berhasil disimpan'
            ];


            $item_list_terpilih=!empty($req['item_list_terpilih']) ? $req['item_list_terpilih'] : '';
            $item_list_terpilih=json_decode($item_list_terpilih);
            // dd($item_list_terpilih);
            $item_list_terpilih=(array)$item_list_terpilih;
            foreach ($item_list_terpilih as $key => $value) {
                unset($value->data['7'],$value->data['8'],$value->data['9'],$value->data['10']);
                $value->data['selisih'] = ($value->jml < $value->data[6]) ? (int)$value->data[6] - (int)$value->jml : 0;
                $value->data['nomihilang'] = ($value->data['selisih'] > 0) ? $value->data['selisih'] * $value->data[5] : 0;
                $value->data['lebih'] = ($value->data['selisih'] <= 0) ? (int)$value->jml - (int)$value->data[6] : 0;
                $value->data['nomilebih'] = ($value->data['lebih'] > 0) ? $value->data['lebih'] * (int)$value->data[5] : 0;
            }

            // update proses
            if (!empty($action_is_create==0)) {
                    if($item_list_terpilih){
                        foreach($item_list_terpilih  as $key => $value){


                            if($value->jml<0){
                                $pesan=['error','Stok tidak bisa kurang dari 0',3];
                                return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
                            }

                            $IpsrsBarang = (new \App\Models\IpsrsBarang)->where('kode_brng', '=', $key)->first();
                            $IpsrsBarang->stok = $value->jml;
                            $IpsrsBarang->save();
                            $IpsrsOpname = (new \App\Models\IpsrsOpname)->where([['kode_brng', '=', $kode],['tanggal', '=' ,$tanggal,]])->first();
                            $IpsrsOpname->real = $value->jml;
                            $IpsrsOpname->keterangan = $value->ket;
                        }
                    }
                    if($IpsrsOpname->save()){
                        $is_save=1;
                    }
            } else {
                // create proses
                if($item_list_terpilih){
                        $jml_save=0;
                        foreach($item_list_terpilih  as $key => $value){
                            if(!empty($value->jml)){
                                if($value->jml<0){
                                    $pesan=['error','Stok tidak bisa kurang dari 0',3];
                                    return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
                                }
                                $get_data=(new \App\Models\IpsrsBarang)->where('kode_brng', '=', $key)->first();
                                $data_save=[
                                    'kode_brng'=>$key,
                                    'h_beli'=>!empty($get_data->harga) ? $get_data->harga : 0,
                                    'tanggal'=>!empty($tanggal) ? $tanggal : '',
                                    'stok'=>!empty($get_data->stok) ? $get_data->stok : 0,
                                    'real'=>$value->jml,
                                    'selisih'=>$value->data['selisih'],
                                    'nomihilang'=>$value->data['nomihilang'],
                                    'lebih'=> $value->data['lebih'],
                                    'nomilebih'=> $value->data['nomilebih'],
                                    'keterangan'=> !empty($ket) ? $ket : '',
                                ];
                                $model=(new \App\Models\IpsrsOpname);
                                $model->set_model_with_data($data_save);
                                if($model->save()){
                                //update ipsrsbarang
                                $barang = (new \App\Models\IpsrsBarang)->where('kode_brng', '=', $key)->first();
                                $barang->stok = $value->jml;
                                $barang->save();
                                    $jml_save++;
                                }

                            }
                        }
                    }
                    if($jml_save>=1){
                        $is_save=1;
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

        if($pesan[0]!='error'){
            $link_return=$this->url_name;
        }else{
            $link_return=$link_back_redirect;
        }

        return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0]=>$pesan[1]]);
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

    private function form(Request $request){

        $kode = !empty($request->data_sent) ? $request->data_sent : null;
        $tgl = !empty($request->tgl) ? $request->tgl : null;

        $model = (new \App\Models\IpsrsOpname)->where([['kode_brng', '=', $kode],['tanggal', '=' ,$tgl],])->first();
        if ($model) {
            $action_form = $this->part_view.'/update';

            $params=[
                'ipsrsopname.kode_brng'=>['=',$kode],
                'ipsrsopname.tanggal'=>['=',$tgl]
            ];

            $list_item = $this->stokOpnameBarangNonMedisService->getList($params);
            $item_list_terpilih=[];
            if($list_item){
                foreach($list_item as $value){
                    $item_list_terpilih[$value->kode_brng]=[
                        'jml'=>$value->REAL,
                        'data'=>[
                            '',
                            $value->kode_brng,
                            $value->nama_brng,
                            $value->jenis,
                            $value->kode_sat,
                            (string)$value->h_beli,
                            (string)$value->stok,
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
            $model=(new \App\Models\IpsrsOpname);
        }

        $parameter_view = [
            'action_form' => $action_form,
            'model' => $model,
            'item_list_terpilih'=>!empty($item_list_terpilih) ? $item_list_terpilih : ''
        ];

        // dd($parameter_view);
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

    function actionDelete(Request $request){

        DB::beginTransaction();
        $pesan=[];
        $link_back_param=[];
        $message_default=[
            'success'=>'Data berhasil dihapus',
            'error'=>'Maaf data tidak berhasil dihapus'
        ];

        $kode = !empty($request->data_sent) ? $request->data_sent : null;
        $kode = explode("@", $kode);

        try {
            $model = (new \App\Models\IpsrsOpname)->where('tanggal', '=' ,$kode[0]);
            if(empty($model)){
                return redirect()->route($this->url_name, $link_back_param)->with(['error','Data tidak ditemukan']);
            }
            $is_save=0;
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

    public function actionView(Request $request){
        $fields = $request->all();
        $filter_date_start=!empty($request->form_filter_date_start) ? $request->form_filter_date_start : "2001-01-12";
        $filter_date_end=!empty($request->form_filter_date_end) ? $request->form_filter_date_end : date('Y-m-d');

        $paramater=[
        'where_between'=>['ipsrsopname.tanggal'=>[$filter_date_start,$filter_date_end ]],
        'search'=> $fields['data_sent']
    ];

        $list_data=$this->stokOpnameBarangNonMedisService->getList($paramater,1)->paginate(!empty($request->per_page) ? $request->per_page : 15);


        $parameter_view=[
            'breadcrumbs'=>$this->breadcrumbs_view,
            'title'=>$this->title,
            'list_data'=>$list_data,
            'url_back'=>$this->url_index
        ];
            return view($this->part_view.'.view',$parameter_view);

    }

}
