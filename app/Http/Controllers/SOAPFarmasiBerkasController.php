<?php

namespace App\Http\Controllers;
use App\Services\GlobalService;
use App\Services\SOAPFarmasiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\RawatInapService;

class SOAPFarmasiBerkasController extends Controller
{
    public function __construct(
        RawatInapService $rawatInapService
    ) {
        $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();

        $this->url_index = $router_name->uri;
        $this->url_name=$router_name->router_name;

        $this->title = 'Berkas SOAP Farmasi';
        $this->breadcrumbs = [
            ['title' => 'SOAP Farmasi berkas', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->rawatInapService = $rawatInapService;

        $this->globalService = new GlobalService;
        $this->soapFarmasiService = new SOAPFarmasiService;
    }
    function actionIndex(Request $request)
    {   
        $tab = !empty($request->tab) ? $request->tab : "rj";

        $kondisi_waktu=!empty($request->kondisi_waktu) ? $request->kondisi_waktu : 1;
        $tanggal_filter=[!empty($request->form_start) ? $request->form_start : date('Y-m-d'),!empty($request->form_end) ? $request->form_end : date('Y-m-d')];
        $paramater = [];
        $filter = [
            'bansal' => $request->bansal,
            'kondisi_waktu' => $kondisi_waktu,
            'tanggal'=>$tanggal_filter,
            'per_page' => intval($request->per_page),
            'search' => $request->search,
        ];
        
        // dd($filter); 
        $datasoap = $this->soapFarmasiService->getDataSOAPRanap($paramater,$filter,1)->groupBy('reg_periksa.no_rawat')
        ->paginate($filter['per_page'] ? 10 : $filter['per_page']);
        
        // $paramater_get_pj_penginput = [
        //     'nip' = >
        // ]
        // dd($datasoap);
        $parameter_view = [
            'kondisi_waktu'=>$kondisi_waktu,
            'tanggal_filter'=>$tanggal_filter,
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'datasoap' => $datasoap, 
            'tab' => $tab,
            'perPage' => $filter['per_page'],
            'perPageList' => [10, 20, 50, 100]
        ];

        

        $bangsals =  $this->rawatInapService->getListBangsal();

        $parameter_view["bansals"] = $bangsals;
        return view('soap-farmasi-berkas.index', $parameter_view);
        
    }
    function actionViewSOAP(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $noRm = $request->no_rm;
        $fr = $request->fr;
        $pdfData = $this->soapFarmasiService->getPDFData($no_rawat, $noRm, $fr);
        
        $pdfData['fr'] = $fr;
        $pdfData['no_rawat'] = $no_rawat;
        $pdfData['no_rm'] = $noRm;

        return view('soap-farmasi-berkas/berkas-list/soap-farmasi/index', $pdfData);
    }

    function actionDownloadViewSOAPPDF(Request $request){
        
        $no_rw = $request->no_rawat;
        $no_rm = $request->no_rm;

        $fr = $request->fr;
        $optional_download  = $request->option_download_list;
        $dir_no_rw = str_replace("/", "-", $no_rw);
        $filename = $no_rm . '_' . $dir_no_rw . '.pdf';

        $pdfData = $this->soapFarmasiService->getPDFData($no_rw, $no_rm, $fr);
        
        $pdfData['fr'] = $fr;
        $pdfData['no_rawat'] = $no_rw;
        $pdfData['no_rm'] = $no_rm;
        
        return $this->soapFarmasiService->createPdfFile($filename, $pdfData, $optional_download, "I");
    }
}
