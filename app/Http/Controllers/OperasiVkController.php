<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\GlobalService;

class OperasiVkController extends Controller
{
    protected $cpptService;
    public function __construct(
        GlobalService $globalService
    ) {
        $this->globalService = $globalService;
    }

    function actionIndex(Request $request)
    {
        $item_pasien = (new \App\Http\Traits\ItemPasienFunction)->getItemPasien($request->fr);
        if ($item_pasien->no_rm && $item_pasien->no_rawat && $item_pasien->no_fr) {
            return view('operasi-vk.index');
        }
        return redirect()->route('dashboard')->with(['error' => 'Url Link anda ada yang salah']);
    }
}
