@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
@include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
    $nm_type_periode = (new \App\Models\RefTemplateJadwalShift())->list_type_periode($item_template_shift->type_periode);
?>

@section('content')

@if (!empty($url_back_index))
    <div class="text-warning">
        <a href="{{ url($url_back_index) }}" class="hover-pointer btn-back">
            <span class="hover-pointer btn-back text-warning">
                <img src="{{ asset('') }}icon/backwards.png" alt="">
                <span class="mx-2">Kembali ke Halaman Sebelumnya</span>
            </span>
        </a>    
    </div>
@endif

<hr>
<div class="row d-flex justify-content-between">
    <div class="col-lg-6">
        <div style="overflow-x: auto; max-width: auto;">
            <table class="table border table-responsive-tablet">
                <tbody>
                    <tr>
                        <td style='width: 20%; vertical-align: middle;'>Nama Shift</td>
                        <td style='width: 1%; vertical-align: middle;'>:</td>
                        <td style='width: 69%; vertical-align: middle;'>{{ !empty($item_template_shift->nm_shift) ? $item_template_shift->nm_shift : '' }}</td>
                    </tr>
                    <tr>
                        <td style='width: 20%; vertical-align: middle;'>Tgl. Mulai</td>
                        <td style='width: 1%; vertical-align: middle;'>:</td>
                        <td style='width: 69%; vertical-align: middle;'>{{ !empty($item_template_shift->tgl_mulai) ? $item_template_shift->tgl_mulai : '' }}</td>
                    </tr>

                    <tr>
                        <td style='width: 20%; vertical-align: middle;'>Priode</td>
                        <td style='width: 1%; vertical-align: middle;'>:</td>
                        <td style='width: 69%; vertical-align: middle;'>{{ !empty($item_template_shift->jml_periode) ? $item_template_shift->jml_periode : '' }} {{ $nm_type_periode }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@if( (new \App\Http\Traits\AuthFunction)->checkAkses($router_name->uri.'/update') )
    <div class="collapse mb-2 show" id="bagan-form-tambah-collapse">
        <div class="card card-body" style='background:#f2f2f2'>
            <?php
                $bagan_form=\App::call($router_name->base_controller.'@actionUpdate');
            ?>
            @if(!empty($bagan_form))
                {!! $bagan_form !!}
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <a class="btn btn-info collapse-cus" style='color:#fff' data-bs-toggle="collapse" href="#bagan-form-tambah-collapse"
            role="button" aria-expanded="false" aria-controls="bagan-form-tambah-collapse">
            <span id='collapse-open'><i class="fa-solid fa-angles-down"></i> Buka Form Ubah</span>
            <span id='collapse-closed'><i class="fa-solid fa-angles-up"></i> Tutup Form ubah</span>
        </a>
    </div>
@endif

@include($router_name->path_base.'.columns')

@endsection
