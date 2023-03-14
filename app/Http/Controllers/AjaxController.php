<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Services\GlobalService;
use App\Services\BarangNonMedisService;
use App\Services\RekamMedisService;
use App\Services\RawatJalanService;
use App\Services\JadwalOperasiPasienService;

use App\Models\Bangsal;

class AjaxController extends Controller
{
    public function __construct(
        GlobalService $globalService,
        BarangNonMedisService $barangNonMedisService,
        RawatJalanService $rawatJalanService

    ) {
        $this->globalService = $globalService;
        $this->barangNonMedisService = $barangNonMedisService;
        $this->rawatJalanService = $rawatJalanService;
        $this->rekamMedisService = new RekamMedisService;
        $this->bangsal = new Bangsal;
        $this->jadwalOperasiPasienService = new JadwalOperasiPasienService; 
    }

    function dokterMedis($params=null){
        $no_rawat=!empty($params['no_rawat']) ? $params['no_rawat'] : '';
        $type_akses=!empty($params['type_akses']) ? $params['type_akses'] : '';
        $list_data=[];
        $list_data_tmp=[];


        if($type_akses!='ri'){
            $list_data_tmp_tmp = $this->globalService->getDokterByNoRawatLogin($no_rawat);
            if($list_data_tmp_tmp){
                $list_data_tmp[]=(object)[
                    'kd_dokter'=>!empty($list_data_tmp_tmp->id) ? $list_data_tmp_tmp->id : '',
                    'nm_dokter'=>!empty($list_data_tmp_tmp->name) ? $list_data_tmp_tmp->name : '',
                    'nm_sps'=>!empty($list_data_tmp_tmp->nm_sps) ? $list_data_tmp_tmp->nm_sps : '',
                ];
            }
        }else{
            $list_data_tmp_tmp = $this->globalService->getDokterRanapByNoRawatLogin($no_rawat,0);
            if($list_data_tmp_tmp){
                foreach($list_data_tmp_tmp as $value){
                    $value=(object)$value->getAttributes();
                    $list_data_tmp[]=(object)[
                        'kd_dokter'=>!empty($value->id) ? $value->id : '',
                        'nm_dokter'=>!empty($value->name) ? $value->name : '',
                        'nm_sps'=>!empty($value->nm_sps) ? $value->nm_sps : '',
                    ];
                }
            }
        }

        foreach($list_data_tmp as $value){
            $list_data[]=(object)[
                'kd_dokter'=>!empty($value->kd_dokter) ? $value->kd_dokter : '',
                'nm_dokter'=>!empty($value->nm_dokter) ? $value->nm_dokter : '',
                'nm_sps'=>!empty($value->nm_sps) ? $value->nm_sps : '',
            ];
        }

        $parameter_view=[
            'list_data'=>!empty($list_data) ? $list_data : ''
        ];

        return [
            'success' => true,
            'html'=>view('ajax.columns_dokter_medis',$parameter_view)->render(),
        ];

    }

    function jenisBarang($request){
        $list_data_tmp=(new \App\Models\IpsrsJenisBarang)->get();

        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->kd_jenis,
                'kode'=>[
                    'data-item'=>$value->nm_jenis.'@'.$value->kd_jenis,
                    'value'=>$value->nm_jenis
                ],
            ];
        }

        $table=[
            'header'=>[
               'title'=> ['kode jenis','Jenis Barang'],
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

    function kodeBarangByJenis($request){

        $hasil='';
        if(!empty($request->kode)){
            $hasil=$this->barangNonMedisService->generateKodeBarangByJenis($request->kode);
        }

        return $this->sendSuccess($hasil, "Success");
    }

    function kodeSatuan($request){
        $list_data_tmp=(new \App\Models\Kodesatuan)->get();

        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->kode_sat,
                'kode'=>[
                    'data-item'=>$value->satuan.'@'.$value->kode_sat,
                    'value'=>$value->satuan
                ],
            ];
        }

        $table=[
            'header'=>[
               'title'=> ['Kode Satuan','Nama Satuan'],
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



    function getListPegawai($request){
        $list_data_tmp=(new \App\Services\PegawaiService() )->getList();
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->nik,
                'kode'=>[
                    'data-item'=>$value->nik.'@'.$value->nama.'@'.$value->departemen.'@'.$value->departemen_nama,
                    'value'=>$value->nama
                ],
                $value->jbtn,
                $value->departemen_nama,
            ];
        }

        $table=[
            'header'=>[
               'title'=> ['NIP','Nama','Jabatan','Departemen'],
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

    function getListPetugas($request){
        $list_data_tmp=(new \App\Services\PegawaiService() )->getList_petugas();
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->nik,
                'kode'=>[
                    'data-item'=>$value->nik.'@'.$value->nama.'@'.$value->departemen.'@'.$value->departemen_nama,
                    'value'=>$value->nama
                ],
                $value->jbtn,
                $value->departemen_nama,
            ];
        }

        $table=[
            'header'=>[
               'title'=> ['NIP','Nama','Jabatan','Departemen'],
               'parameter'=>[' class="w-10" ',' class="w-25" ']
            ],
            // 'columns_parameter'=>['class=py-3',''],
        ];

        $parameter_view=[
            'table'=>$table,
            'list_data'=>!empty($list_data) ? $list_data : ''
        ];
        // dd($parameter_view);

        return [
            'success' => true,
            'html'=>view('ajax.columns_ajax',$parameter_view)->render(),
        ];
    }

    function getListDokter($request){
        $list_data_tmp=(new \App\Services\DokterService() )->getList();

        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->kd_dokter,
                'kode'=>[
                    'data-item'=>$value->kd_dokter.'@'.$value->nm_dokter.'@'.$value->nm_sps.'@'.$value->no_ijin_praktek,
                    'value'=>$value->nm_dokter
                ],
                $value->nm_sps,
                $value->no_ijin_praktek,
            ];
        }

        $table=[
            'header'=>[
               'title'=> ['Kode Dokter','Nama','Spesialis','No Izin Praktek'],
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



    function getListDepartemen($request){

        $list_data_tmp=( new \App\Models\Departemen )->get();

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

    function getListDokterPJ($request){
        $get_req = $request->all();
        $exp=explode('@',$get_req['data_sent']);
        $no_rawat=!empty($exp[0]) ? $exp[0] : '';

        $paramater = [
            'dpjp_ranap.no_rawat' => $no_rawat
        ];

        $list_data_tmp = $this->rekamMedisService->getDokterByDpjpRanap($paramater);
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->kd_dokter,
                'kode'=>[
                    'data-item'=>$value->kd_dokter.'@'.$value->nm_dokter,
                    'value'=>$value->nm_dokter
                ],
            ];
        }
        $table=[
            'header'=>[
               'title'=> ['Kode Dokter','Nama Dokter'],
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

    function getListPoliklinik($request){

        $list_data_tmp = $this->rawatJalanService->getListPoliklinik()->where('status','1')->get();
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->kd_poli,
                'kode'=>[
                    'data-item'=>$value->nm_poli.'@'.$value->kd_poli,
                    'value'=>$value->nm_poli
                ],
            ];
        }
        $table=[
            'header'=>[
               'title'=> ['Kode Poliklinik','Nama Poliklinik'],
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

    function getListBangsal($request){

        $list_data_tmp = $this->bangsal->where('kd_bangsal','!=','-')->get();
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->kd_bangsal,
                'kode'=>[
                    'data-item'=>$value->nm_bangsal.'@'.$value->kd_bangsal,
                    'value'=>$value->nm_bangsal
                ],
            ];
        }
        $table=[
            'header'=>[
               'title'=> ['Kode Kamar','Nama Kamar'],
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

    function getListBangsalInapHarga($request){
        $get_req = $request->all();
        $data_send=!empty($get_req['data_sent']) ? $get_req['data_sent'] : '';

        $data_check_json=json_decode($data_send,true);
        if(!json_last_error()){
            $data_send=$data_check_json;
        }

        $sql="
            select kd_kamar,bangsal.kd_bangsal,nm_bangsal,kamar.trf_kamar,kelas,kamar.status status_kamar from kamar
            inner join bangsal on bangsal.kd_bangsal=kamar.kd_bangsal
        ";

        $where=[];
        if(!empty($data_send['where'])){
            $get_where=$data_send['where'];

            if(!empty($get_where['where_in'])){
                foreach($get_where['where_in'] as $key => $value){
                    $where[]=$key.' in ('.$value.')';
                }
            }
        }

        if($where){
            $where = implode(' and',$where);
            $sql.=' where '.$where;
        }else{
            $where='';
        }

        $sql.=" order by nm_bangsal ASC";
        $result=DB::select($sql);
        $list_data_tmp=$result;

        $list_data=[];
        foreach($list_data_tmp as $value){
            $tarif_kamar_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($value->trf_kamar);
            $list_data[]=[
                $value->kd_kamar,
                $value->kd_bangsal,
                'kode'=>[
                    'data-item'=>$value->kd_kamar.'@'.$value->kd_bangsal.'@'.$value->nm_bangsal.'@'.$value->trf_kamar.'@'.$value->kelas.'@'.$value->status_kamar,
                    'value'=>$value->nm_bangsal
                ],
                $tarif_kamar_text,
                $value->kelas,
                $value->status_kamar
            ];
        }
        $table=[
            'header'=>[
               'title'=> ['Kode Kamar','kode Bangsal','Nama Kamar','Tarif','Kelas','Status Kamar'],
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

    function getDataPenjab($request){
        $list_data_tmp = (new \App\Models\Penjab)->where('status','1')->orderBy('png_jawab','ASC')->get();
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->kd_pj,
                'kode'=>[
                    'data-item'=>$value->png_jawab.'@'.$value->kd_pj,
                    'value'=>$value->png_jawab
                ],
            ];
        }
        $table=[
            'header'=>[
               'title'=> ['Kode Jenis','Nama Pembayaran'],
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

    function getDokter($request){
        $list_data_tmp = $this->globalService->getDokterList();
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->kd_dokter,
                'kode'=>[
                    'data-item'=>$value->nm_dokter.'@'.$value->kd_dokter,
                    'value'=>$value->nm_dokter
                ],
            ];
        }
        $table=[
            'header'=>[
               'title'=> ['Kode Dokter','Nama Dokter'],
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

    function get_paket_operasi($request){
        $list_data_tmp=$this->jadwalOperasiPasienService->getPaketOperasi();
        $list_data=[];
        foreach($list_data_tmp as $value){
            $list_data[]=[
                $value->kode_paket,
                'kode'=>[
                    'data-item'=>$value->kode_paket.'@'.$value->nm_perawatan.'@'.$value->kategori.'@'.$value->operator1,
                    'value'=>$value->nm_perawatan
                ],
                $value->kategori,
                $value->operator1,
            ];
        }
        
        $table=[
            'header'=>[
               'title'=> ['Kode Paket','Nama Operasi','Kategori','Tarif'],
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
        $hasil='';
        if(!empty($get_req['action'])){
            if($get_req['action']=='dokter_medis'){
                $exp=explode('@',$get_req['data_sent']);
                $type_akses=!empty($exp[0]) ? $exp[0] : 'rj';
                $no_rawat=!empty($exp[1]) ? $exp[1] : '';

                $parameter=[
                    'no_rawat'=>$no_rawat,
                    'type_akses'=>$type_akses,
                ];
                $hasil=$this->dokterMedis($parameter);
            }

            if($get_req['action']=='jenis_barang'){
                $hasil=$this->jenisBarang($request);
            }

            if($get_req['action']=='kode_barang_by_jenis'){
                $hasil=$this->kodeBarangByJenis($request);
            }

            if($get_req['action']=='kode_satuan'){
                $hasil=$this->kodeSatuan($request);
            }

            if($get_req['action']=='get_list_pegawai'){
                $hasil=$this->getListPegawai($request);
            }
            if($get_req['action']=='get_list_petugas'){
                $hasil=$this->getListPetugas($request);
            }

            if($get_req['action']=='get_list_dokter'){
                $hasil=$this->getListDokter($request);
            }

            if($get_req['action']=='get_list_departemen'){
                $hasil=$this->getListDepartemen($request);
            }


            if($get_req['action']=='get_list_dokterPJ'){
                $hasil=$this->getListDokterPJ($request);
            }

            if($get_req['action']=='get_list_poliklinik'){
                $hasil=$this->getListPoliklinik($request);
            }

            if($get_req['action']=='kamar_bangsal'){
                $hasil=$this->getListBangsal($request);
            }

            if($get_req['action']=='kamar_bangsal_inap_harga'){
                $hasil=$this->getListBangsalInapHarga($request);
            }

            if($get_req['action']=='data_penjab'){
                $hasil=$this->getDataPenjab($request);
            }

            if($get_req['action']=='get_dokter'){
                $hasil=$this->getDokter($request);
            }

            if($get_req['action']=='get_paket_operasi'){
                $hasil=$this->get_paket_operasi($request);
            }

            if($request->ajax()){
                return response()->json($hasil);
            }
        }
    }
}
