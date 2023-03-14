@extends('layouts.master2')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')
    <div class="text-primary mb-3">
        <a href="{{ url($url_back_to_bagan_billing) }}" style="color:#f0ca3b">
            <i class="fa-solid fa-square-caret-left"></i><span class="mx-2">Kembali Ke form sebelumnya</span>
        </a>
    </div>
    <hr>
    <div class="row justify-content-start">
        <div class="col-lg-8 ">
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet">
                    <tr>
                        <td style="width: 30%">Nama Pasien</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 69%">{{ !empty($data_pasien->nm_pasien) ? $data_pasien->nm_pasien : ''  }}</td>
                    </tr>

                    <tr>
                        <td style="width: 30%">No.Rm</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 69%">{{ !empty($data_pasien->no_rkm_medis) ? $data_pasien->no_rkm_medis : ''  }}</td>
                    </tr>

                    <tr>
                        <td style="width: 30%">No.Rawat</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 69%">{{ !empty($data_pasien->no_rawat) ? $data_pasien->no_rawat : ''  }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    
    <div class="collapse mb-2 {{ !empty($kode_send) ? 'show' : 'show' }}" id="bagan-form-tambah-collapse">
        <div class="card card-body" style='background:#f2f2f2'>
            @if(!empty($bagan_form))
                {!! $bagan_form !!}
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <a class="btn btn-info collapse-cus" style='color:#fff' data-bs-toggle="collapse" href="#bagan-form-tambah-collapse" role="button" aria-expanded={{ !empty($kode_send) ? "true" : "false" }} aria-controls="bagan-form-tambah-collapse">
            <span id='collapse-open'><i class="fa-solid fa-angles-down"></i> Buka Form Input</span>
            <span id='collapse-closed'><i class="fa-solid fa-angles-up"></i> Tutup Form Input</span>
        </a>
    </div>

    @include($router_name->path_base.'.columns')

@endsection