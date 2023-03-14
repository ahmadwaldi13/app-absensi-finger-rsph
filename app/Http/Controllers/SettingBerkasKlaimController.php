<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\GlobalService;

class SettingBerkasKlaimController extends \App\Http\Controllers\MyAuthController
{
    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Setting Berkas Klaim';
        $this->breadcrumbs = [
            ['title' => 'Berkas Digital', 'url' => url('/') . "/sub-menu?type=4"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
    }

    function actionIndex(Request $request)
    {
        $form_filter_text = !empty($request->form_filter_text) ? $request->form_filter_text : '';

        $paramater = [
            'search' => $form_filter_text
        ];
        $query = (new \App\Models\UxuiBerkasKlaim);
        $list_search = [
            'where_or' => ['uxui_berkas_klaim.nama'],
        ];

        if ($paramater) {
            $query = (new \App\Models\UxuiBerkasKlaim)->set_where($query, $paramater, $list_search)->paginate(!empty($request->per_page) ? $request->per_page : 15);
        } else
            $query->paginate(!empty($request->per_page) ? $request->per_page : 15)->sortBy('kode');

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'list_data' => $query
        ];

        return view($this->part_view . '.index', $parameter_view);
    }


    function form(Request $request)
    {
        $kode = !empty($request->data_sent) ? $request->data_sent : null;
        $model = (new \App\Models\UxuiBerkasKlaim)->where('id', '=', $kode)->first();
        $action_form = 'berkas-digital-berkas-klaim/update';
        $parameter_view = [
            'action_form' => $action_form,
            'model' => $model,
            'kode' => $kode,
        ];

        $bagan_html = 'berkas-digital-berkas-klaim.form';

        if ($request->ajax()) {
            $returnHTML = view($bagan_html, $parameter_view)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            return view($bagan_html, $parameter_view);
        }
    }

    function actionUpdate(Request $request)
    {
        if ($request->isMethod('get')) {
            $bagan_form = $this->form($request);

            $parameter_view = [
                'title' => $this->title,
                'breadcrumbs' => $this->breadcrumbs,
                'bagan_form' => $bagan_form,
                'url_back' => $this->url_name
            ];

            return view('layouts.index_bagan_form', $parameter_view);
        }

        if ($request->isMethod('post')) {
            return $this->proses($request);
        }
    }
    private function proses($request)
    {
        $req = $request->all();
        $kode = !empty($req['key_old']) ? $req['key_old'] : '';
        $action_is_create = (str_contains($request->getPathInfo(), $this->url_index . '/create')) ? 1 : 0;
        $link_back_redirect = ($action_is_create) ? $this->url_name : $this->url_name . '/update';
        DB::beginTransaction();
        $pesan = [];
        $link_back_param = [];
        if ($action_is_create) {
            $link_back_param = [];
        } else {
            $link_back_param = ['data_sent' => $kode];
        }
        $link_back_param = array_merge($link_back_param, $request->all());
        $message_default = [
            'success' => !empty($kode) ? 'Data berhasil diubah' : 'Data berhasil disimpan',
            'error' => !empty($kode) ? 'Data tidak berhasil diubah' : 'Data tidak berhasil disimpan'
        ];
       
        try {
            $model = (new \App\Models\UxuiBerkasKlaim)->where('id', '=', $kode)->first();
        if (empty($model)) {
                $model = (new \App\Models\UxuiBerkasKlaim);
            }
            $req['status'] = !empty($req['status']) ? $req['status'] : '0';
            $data_save = $req;
            $model->set_model_with_data($data_save);
            $is_save = 0;
            if ($model->save()) {
                $model_1 = (new \App\Models\UxuiBerkasKlaim)->where('id', '=', $model->id)->first();
                if (empty($model_1)) {
                    $model_1 = (new \App\Models\UxuiBerkasKlaim);
                }
                $model_1->set_model_with_data($data_save);
                if ($model_1->save()) {
                    $is_save = 1;
                }
                $is_save = 1;
            }

            if ($is_save) {
                DB::commit();
                // $link_back_param = $this->clear_request($link_back_param, $request);
                $pesan = ['success', $message_default['success'], 2];
            } else {
                DB::rollBack();
                $pesan = ['error', $message_default['error'], 3];
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->errorInfo[1] == '1062') {
            }
            $pesan = ['error', $message_default['error'], 3];
        } catch (\Throwable $e) {
            DB::rollBack();
            $pesan = ['error', $message_default['error'], 3];
        }

        return redirect()->route($link_back_redirect, $link_back_param)->with([$pesan[0] => $pesan[1]]);
    }
}