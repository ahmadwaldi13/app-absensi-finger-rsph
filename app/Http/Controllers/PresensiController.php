<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index(Request $request) {
        return view('presensi.index');
    }
}
