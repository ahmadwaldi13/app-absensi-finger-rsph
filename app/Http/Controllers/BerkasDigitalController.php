<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Services\RawatJalanService;
use App\Services\RawatInapService;
use App\Services\GlobalService;
use App\Services\BerkasDigitalService;

use File;
use Resources\views\Barang\BarangPDF;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
class BerkasDigitalController extends Controller
{
    protected $globalService;
    protected $berkasDigitalService;
    protected $rawatInapService;
    protected $file_base_url;
    public function __construct(

        GlobalService $globalService,
        RawatJalanService $rawatJalanService,
        RawatInapService $rawatInapService,
        BerkasDigitalService $berkasDigitalService
    ) {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Berkas Digital';
        $this->breadcrumbs = [
            ['title' => 'Berkas Digital', 'url' => url('/') . "/sub-menu?type=4"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];
        $this->globalService = $globalService;
        $this->rawatJalanService = $rawatJalanService;
        $this->rawatInapService = $rawatInapService;
        $this->berkasDigitalService = $berkasDigitalService;
        $this->file_base_url = 'upload/berkas_digital/';
    }

    public function index(Request $request)
    {
        $tab = !empty($request->tab) ? $request->tab : "rj";
        $filter = [
            'poli' => $request->poli,
            'bansal' => $request->bansal,
            'start' => $request->start,
            'end' => $request->end,
            'penjab' => $request->penjab,
            'per_page' => intval($request->per_page),
            'search' => $request->search,
        ];

        $jenisBayar = $this->globalService->Penjab()->where('status', '1')->get();
        $penjab_pil=!empty($request->penjab) ? $request->penjab : '';

        $parameter = [];
        $get_user = (new \App\Http\Traits\AuthFunction)->getUser();

        if ($get_user->type_user == 'dokter') {
            $filter['kd_dokter'] = $get_user->id_user;
        }

        if ($tab == "ri") {
            $berkasDigital = $this->berkasDigitalService->getBerkasDigitalRanap($filter, $parameter, 'ranap')
                ->paginate($filter['per_page'] ? 10 : $filter['per_page']);
        }else{
            $berkasDigital = $this->berkasDigitalService->getBerkasDigital($filter, $parameter, 'ralan')
                ->paginate($filter['per_page'] ? 10 : $filter['per_page']);
        }
        $berkas_list = $this->berkasDigitalService->get_berkas_digital_list();
        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'berkasDigital' => $berkasDigital,
            'tab' => $tab,
            'perPage' => $filter['per_page'],
            'berkas_list' => $berkas_list,
            'jenisBayar' => $jenisBayar,
            'penjab_pil'=>$penjab_pil
        ];

        if ($tab == "ri") {
            $bangsals =  $this->rawatInapService->getListBangsal();
            $parameter_view["bansals"] = $bangsals;
            return view('berkas-digital/index_ranap', $parameter_view);
        } else {
            $poliKliniks =  $this->rawatJalanService->getListPoliklinik()->where('status', '1')->get();
            $parameter_view["poliKliniks"] = $poliKliniks;
            return view('berkas-digital/index', $parameter_view);
        }
    }

    function actionViewKlaim(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $noRm = $request->no_rm;
        $fr = $request->fr;
        $this->berkasDigitalService->syncFileDB($no_rawat, $noRm, $this->file_base_url);
        $pdfData = $this->berkasDigitalService->getPDFData($no_rawat, $noRm, $fr);
        return view('berkas-digital/klaim-berkas/index', $pdfData);
    }

    function actionUploadFile(Request $request)
    {
        $request->validate([
            'berkas' => 'required|mimes:pdf|max:3072',
            'jenis_berkas' => 'required',
        ]);

        $jenis_data = explode(",", $request->jenis_berkas);
        $message_default = [
            'success' => 'Berkas ' . strtoupper($jenis_data[0]) . ' pasien ' . $request->nm_pasien . ' berhasil di unggah ',
            'error' => 'Maaf data Gagal diperbaharui'
        ];


        if ($jenis_data[1] == "1") {
            $filename = $request->no_rm . '_' . $jenis_data[2] . "." . $request->berkas->getClientOriginalExtension();
            $path = public_path($this->file_base_url . $request->no_rm);
            $file_exist = file_exists(public_path($this->file_base_url . $request->no_rm . '/' . $filename));

            $dir = $request->no_rm . '/' . $filename;
        } else {
            $path = public_path($this->file_base_url . $request->no_rm . "/" . $request->no_rw);
            $file_exist = false;
            $filename = $jenis_data[2] . '_' . $this->berkasDigitalService->file_rw_numbering($request->no_rm, $request->no_rw, $this->file_base_url, $jenis_data[2]) . '.' . $request->berkas->getClientOriginalExtension();
            $dir = $request->no_rm . "/" . $request->no_rw . '/' . $filename;
        }
        $data = [
            "name" => $filename,
            "id_jenis_bdig" => $jenis_data[1],
            "no_rm" => $request->no_rm,
            "no_rw" => str_replace("-", "/", $request->no_rw),
            "url" => $dir,
            "kode" => $jenis_data[3]
        ];

        Storage::makeDirectory($path, 0777, true, true);
        $move = $request->berkas->move($path, $filename);

        if ($move) {
            if (!$file_exist) {
                $this->berkasDigitalService->insert_berkas_data($data);
            }
            $request->session()->flash('success', $message_default['success']);
            return response()->json(["success" => true, "db" => $file_exist], 200);
        } else {
            $request->session()->flash('error', $message_default['error']);
            return response()->json(["success" => false], 400);
        }
    }

    function actionDeleteFile(Request $request)
    {
        $message_default = [
            'success' => 'Berkas ' . strtoupper($request->nama) . ' berhasil di Hapus ',
            'error' => 'Maaf data Gagal dihapus'
        ];
        $delete_file = File::delete(public_path($this->file_base_url . $request->url));
        $this->berkasDigitalService->delete_berkas_data($request->id);
        $request->session()->flash('success_del', $message_default['success']);
        return response()->json(["success" => true], 200);
    }


    function actionDownloadPatientFiles(Request $request)
    {
        $no_rw = $request->no_rw;
        $dir_no_rw = str_replace("/", "-", $request->no_rw);
        $no_rm = $request->no_rm;
        $optional_download = $request->option_download_list;


        $fileName = $no_rm . '_' . $dir_no_rw . '.zip';
        // $all_files = $this->berkasDigitalService->getAllFileRmRw($no_rw, $no_rm, $this->file_base_url);
        $optional_download = explode(",", $optional_download);
        $all_files = array_column($this->berkasDigitalService->get_allowed_download_files($no_rw, $no_rm,  $optional_download)->toArray(), 'url');
        $zip_result =  $this->berkasDigitalService->createZipFile(public_path($this->file_base_url), $fileName, $all_files);
        return $zip_result;
        // if($zip_result) return response()->download($zip_result);
    }


    function actionDownloadViewKlaimPDF(Request $request)
    {

        $no_rw = $request->no_rawat;
        $no_rm = $request->no_rm;

        $fr = $request->fr;
        $optional_download  = $request->option_download_list;
        $dir_no_rw = str_replace("/", "-", $no_rw);
        $filename = $no_rm . '_' . $dir_no_rw . '.pdf';

        $pdfData = $this->berkasDigitalService->getPDFData($no_rw, $no_rm, $fr);
        $pdfData['fr'] = $fr;
        return $this->berkasDigitalService->createPdfFile($filename, $pdfData, $optional_download, "I");
    }

    function actionDownloadAllViewKlaim(Request $request)
    {
        $no_rw = $request->no_rawat;
        $no_rm = $request->no_rm;
        $fr = $request->fr;
        $option_download_list_klaim  = $request->option_download_list_klaim;
        $option_download_list_unggah  = $request->option_download_list_unggah;
        $option_download_list_unggah = explode(",", $option_download_list_unggah);
        $dir_no_rw = str_replace("/", "-", $no_rw);
        $zipFileName = $no_rm . '_' . $dir_no_rw . '_all.zip';

        $all_files = empty($option_download_list_unggah) ? [] : array_column($this->berkasDigitalService->get_allowed_download_files($no_rw, $no_rm,  $option_download_list_unggah)->toArray(), 'url');

        $pdfData = $this->berkasDigitalService->getPDFData($no_rw, $no_rm, $fr);
        $pdfFileName = $no_rm . '_' . $dir_no_rw . '.pdf';
        $pdf = $this->berkasDigitalService->createPdfFile($pdfFileName, $pdfData, $option_download_list_klaim, "S");
        $klaim_pdf = empty($option_download_list_klaim) ? [] : [
            $pdfFileName,
            $pdf
        ];
        $zip_result = $this->berkasDigitalService->createZipFile(public_path($this->file_base_url), $zipFileName, $all_files, $klaim_pdf);

        return $zip_result;
    }


}