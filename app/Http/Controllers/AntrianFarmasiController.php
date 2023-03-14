<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\RawatJalanService;
use App\Services\AntrianFarmasiService;

class AntrianFarmasiController extends Controller
{

    public function __construct(
        AntrianFarmasiService $antrianFarmasiService,
        RawatJalanService $rawatJalanService

    ) {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view=$router_name->path_base;
        $this->url_index=$router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title='Antrian Farmasi';
        $this->breadcrumbs = [
            ['title' => 'Antrian', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];
        $this->rawatJalanService = $rawatJalanService;
        $this->antrianFarmasiService = $antrianFarmasiService;
    }


    function index(Request $request)
    {
        $filter_start = !empty($request->start) ? $request->start : date('Y-m-d');
        $filter_end = !empty($request->end) ? $request->end : date('Y-m-d');
        $tab = !empty($request->tab) ? $request->tab : "rj";
        $per_page=!empty($request->per_page) ? $request->per_page : 10;
       
        $parameter = [];
        $parameter_tanggal = [$filter_start, $filter_end];
        
        if($tab == "ri"){
            $konter = $this->antrianFarmasiService->get_konter('ranap');
            $parameter = [
                "bangsal.kd_bangsal" => !empty($request->room) ? $request->room : "",
                "search" => !empty($request->search) ?  $request->search : ""
            ];
            $data = $this->antrianFarmasiService->getResepObatRanapList($parameter_tanggal,$parameter)->paginate($per_page);
            if(!empty($request->table_only)){
                return view('antrian-farmasi/components/table_ranap', ['data_antrian' => $data, 'konters' => $konter]);
            }
 
        }else{
            $konter = $this->antrianFarmasiService->get_konter('ralan');
            $parameter = [
                "poliklinik.kd_poli" => !empty($request->poli) ?  $request->poli : "",
                "search" => !empty($request->search) ?  $request->search : "",
            ];
            $data = $this->antrianFarmasiService->getResepObatRalanList($parameter_tanggal,$parameter)->paginate($per_page);
            
            if(!empty($request->table_only)){
                // return response()->json([
                //     'html' => view('antrian-farmasi/components/table', ['data_antrian' => $data, 'konters' => $konter])->render(),
                //     'data' => $data
                // ]);
                return view('antrian-farmasi/components/table', ['data_antrian' => $data, 'konters' => $konter]);
            }
        }

        $parameter_view=[
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'data_antrian' => $data,
            'tab' => $tab,
            'perPage' => intval($request->per_page),
            'perPageList' => [10, 20, 50, 100],
            'konters' => $konter,
        ];

        if($tab == "ri"){
            $bangsals =  $this->antrianFarmasiService->getListKamarPasien();
            $parameter_view["bansals"] = $bangsals;
            return view('antrian-farmasi/index_ranap', $parameter_view);
        }else { 
            $poliKliniks =  $this->rawatJalanService->getListPoliklinik()->where('status','1')->get();
            $parameter_view["poliKliniks"] = $poliKliniks;
            return view('antrian-farmasi/index', $parameter_view);
        }
    }

    function penyerahanResep(Request $request){
        date_default_timezone_set('Asia/Bangkok');
        $fields = !empty($request->patient_data) ? json_decode($request->patient_data, 1) : [];
        $fields["tgl_penyerahan"] = date('Y-m-d');
        $fields["jam_penyerahan"] = date("H:i:s");
        $link_back='antrian-farmasi-petugas';
        $link_back_param=['start' => $fields["start"], 'end' => $fields["end"],'tab'=>$fields["tab"]];
        
        DB::beginTransaction();

        $message_default=[
            'success'=>'Data '.$fields["nm_pasien"].' berhasil diperbaharui',
            'error'=>'Maaf data Gagal diperbaharui'
        ];
        
        try {   
            $data_save=$fields;
            if($data_save){
                
                $bukti=$this->antrianFarmasiService->insertBuktiPenyerahanResep([
                    "no_resep" => $fields["no_resep"]
                ]);   
                $is_save=0;
                if($bukti){
                    $resep = $this->antrianFarmasiService->updateResepObat($fields);
                    if($resep){
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
            }else{
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
}