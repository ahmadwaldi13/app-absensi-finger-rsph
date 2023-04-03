<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GlobalService;
use App\Services\MesinFinger;
use App\Classes\SoapMesinFinger;
use Illuminate\Support\Facades\DB;

class PresensiController extends \App\Http\Controllers\MyAuthController
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService, $mesinFinger, $soapMesinFinger;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Data Presensi';
        $this->breadcrumbs = [
            ['title' => 'Presensi', 'url' => url('/') . "/sub-menu?type=6"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->mesinFinger = new MesinFinger;
        $this->soapMesinFinger = new SoapMesinFinger;
    }

    function actionIndex(Request $request)
    {

        // $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';

        // $paramater_where=[
        //     'search' => $form_filter_text
        // ];

        // $paramater_search=[
        //     'where_or'=>['nm_departemen'],
        // ];

        $list_data=(new \App\Models\UxuiDataPresensi)->paginate(!empty($request->per_page) ? $request->per_page : 15);
        // $list_data=$data_tmp_tmp->set_where($data_tmp_tmp,$paramater_where,$paramater_search)->paginate(!empty($request->per_page) ? $request->per_page : 15);

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data' => $list_data
        ];

        return view($this->part_view . '.index', $parameter_view);
    }

    // public function actionSync(Request $request)
    // {
    //     $req = $this->mesinFinger->get_presensi();
    //     dd($req);
    //     DB::beginTransaction();
    //     $pesan = [];
    //     $link_back_param = [];
    //     $link_back_param = array_merge($link_back_param);
    //     $message_default = [
    //         'success' => !empty($kode) ? 'Data berhasil diubah' : 'Data berhasil disimpan',
    //         'error' => !empty($kode) ? 'Data tidak berhasil diubah' : 'Data berhasil disimpan'
    //     ];

    //     try {
    //         if (empty($model)) {
    //             $model = (new \App\Models\UxuiDataPresensi);
    //         }
    //         $data_save = $req;
    //         $model->set_model_with_data($data_save);

    //         $is_save = 0;

    //         if ($model->save()) {
    //             $is_save = 1;
    //         }

    //         if ($is_save) {
    //             DB::commit();
    //             $link_back_param = $this->clear_request($link_back_param, $request);
    //             $pesan = ['success', $message_default['success'], 2];
    //         } else {
    //             DB::rollBack();
    //             $pesan = ['error', $message_default['error'], 3];
    //         }
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         DB::rollBack();
    //         if ($e->errorInfo[1] == '1062') {
    //         }
    //         $pesan = ['error', $message_default['error'], 3];
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         $pesan = ['error', $message_default['error'], 3];
    //     }

    //     return redirect()->back()->with([$pesan[0] => $pesan[1]]);
    // }

    public function _checkExists($pin, $datetime)
    {
      $userData = (new \App\Models\UxuiDataPresensi)::where('user_id', $pin)->where('datetime', $datetime)->get();
      return $userData;
    }

    function actionSync(){
        $fp = ( new \App\Models\RefMesinAbsensi )->get();

        if (count($fp) == 0) {
            return "tidak ada mesin absensi!";
        }

        foreach ($fp as $key => $value) {
            $IP = $value->ip;
            $Key = $value->comkey;

            if ($IP == "") {
            $IP = $value->ip;
            }
            if ($Key == "") {
            $Key = $value->comkey;
            }

            $connect = @fsockopen($IP, '80', $errno, $errstr, 1);
            if($connect) {
            $soapRequest = "<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
            $newLine = "\r\n";
            fputs($connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($connect, "Content-Type: text/xml".$newLine);
            fputs($connect, "Content-Length: ".strlen($soapRequest).$newLine.$newLine);
            fputs($connect, $soapRequest.$newLine);
            $buffer = "";
            while ($response = fgets($connect, 1024)) {
                $buffer = $buffer.$response;
            }
            } else {
                return "Koneksi Gagal";
            }
            $buffer = $this->soapMesinFinger->parse_data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
            $buffer = explode("\r\n", $buffer);

            $create = [];
            for ($a=1; $a < count($buffer); $a++) {
            $data = $this->soapMesinFinger->parse_data($buffer[$a], "<Row>", "</Row>");

            $pin = $this->soapMesinFinger->parse_data($data, "<PIN>", "</PIN>");
            
            $datetime  = $this->soapMesinFinger->parse_data($data, "<DateTime>", "</DateTime>");

            if ($data != "") {
                if (!count($this->_checkExists($pin, $datetime)) > 0) {
                $create[] = [
                    'user_id' => $pin,
                    'datetime' => $datetime,
                    'machine_id' => $value->id,
                    'created_at' => $datetime
                ];
                }
            }
            }
            (new \App\Models\UxuiDataPresensi)::insert($create);
        }
            return redirect()->back();
        }
}
