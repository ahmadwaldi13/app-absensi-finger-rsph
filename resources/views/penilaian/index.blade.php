<?php

use Illuminate\Support\Facades\Session;
?>

@extends('layouts.master')

@if(empty($kode_key_old))
@section('breadcrumbs')
@include('layouts.breadcrumbs_dokter_petugas')
@endsection
@else
@section('title-header', 'PenilaianPasien')
@endif


@php
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
    $get_user = (new \App\Http\Traits\AuthFunction)->getUser();

    $nama_pj='';
    $kode_pj='';
    $jabatan_pj='';
    if(str_contains($html_tab, "medis")){
        $kode_pj=!empty($data_dokter->kd_dokter) ? $data_dokter->kd_dokter : '';
        $nama_pj=!empty($data_dokter->nm_dokter) ? $data_dokter->nm_dokter : '';
    }else{
        if($get_user->type_user=='dokter'){
            $kode_pj=!empty($data_dokter->kd_dokter) ? $data_dokter->kd_dokter : '';
            $nama_pj=!empty($data_dokter->nm_dokter) ? $data_dokter->nm_dokter : '';
        }else if($get_user->type_user=='petugas'){
            $kode_pj=!empty($data_petugas->nip) ? $data_petugas->nip : '';
            $nama_pj=!empty($data_petugas->nama) ? $data_petugas->nama : '';
        }
    }
@endphp

@push('link')
<script type="text/javascript" src="{{ asset('libs\jquery\latest\jquery.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\jquery\latest\moment.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\daterangepicker\3.1.0\js\daterangepicker.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs\daterangepicker\3.1.0\css\daterangepicker.css' )}}" />

<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\jquery.dataTables.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\dataTables.buttons.min.js' )}}"></script>

<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\buttons\1.1.2\js\buttons.html5.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs\datatables\1.10.11\css\jquery.dataTables.min.css' )}}">
<link rel="stylesheet" type="text/css" href="{{ asset('libs\datatables\1.10.11\buttons\1.1.2\css\buttons.dataTables.min.css' )}}">

<link href="{{ asset('libs\select2\4.1.0\css\select2.min.css' )}}" rel="stylesheet" />
<script src="{{ asset('libs\select2\4.1.0\js\select2.min.js' )}}"></script>
@endpush

@push('custom-style')
<style>
    /* .buttons-copy {
            display: none !important
        } */

    .dataTables_filter {
        display: none !important
    }

    table.dataTables {
        width: 100% !important;
    }

    .btn-copy {
        width: 224px;
    }

    .nav-tabs {
        border-radius: 10px 10px 0px 0px !important;
    }

    .border-radius-top {
        border-radius: 10px 10px 0px 0px !important;
    }

    .form-check-input {
        width: 1.5em;
        height: 1.5em;
    }

    .hover-pointer {
        cursor: pointer;
    }

    .input-show-modal {
        background-image: url("{{ asset('icon/select.png') }}");
        background-size: 24px;
        background-repeat: no-repeat;
        background-position-y: center;
        background-position-x: 97%;
    }

    .input-dropdown {
        background-image: url("{{ asset('icon/dropdown.png') }}");
        background-size: 24px;
        background-repeat: no-repeat;
        background-position-y: center;
        background-position-x: 97%;
    }

    .input-daterange {
        background-image: url("{{ asset('icon/date.png') }}");
        background-size: 24px;
        background-repeat: no-repeat;
        background-position-y: center;
        background-position-x: 97%;
    }

    .pencarian {
        display: inline-block;
        padding: 5px;
        border: 1px solid #ccc;
    }

    .input-text {
        border: none;
    }

    .input-text:focus {
        outline: none;
    }

    .fixed-header {
        overflow-y: auto;
        overflow-x: hidden !important;
        max-height: 600px;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
        /* width: 300px !important; */
    }

    .select2-selection__arrow {
        height: 34px !important;
        /* width: 300px !important; */
    }

    .select2-selection__clear {
        display: none !important;
    }

    .fixed-header-50vh {
        -ms-overflow-style: none;
        scrollbar-width: none;
        overflow-x: scroll;
        overflow-x: auto;
        height: 75vh;
        /* overflow-x: hidden; */
    }

    .fixed-header thead tr {
        position: sticky !important;
        top: 0;
        background-color: #ffffff;
    }

    .fixed-header-50vh thead tr {
        position: sticky !important;
        top: 0;
        background-color: #ffffff;
        z-index: 10;
    }
</style>
@endpush

@section('content')
<div>
    @include('penilaian.tab_penilaian')
    <div class="card border-top-0 px-4 py-5">
        @if(!empty($url_back_index))
        <div class="text-primary mb-3">
            <a href="{{ url($url_back_index) }}" class="hover-pointer btn-back">
                <span class="iconify" data-icon="vaadin:backwards" style="font-size: 20px;"></span>
                <span class="mx-2">Kembali Ke Data Resep</span>
            </a>
        </div>
        @endif
        <div class="">
            @if(!empty($html_tab))
                @include("penilaian.forms.".$html_tab)
            @endif
        </div>
        <div class="mt-5">
            <form action="" method="GET">
                <input type="hidden" name="no_rawat" value="{{ $item_pasien->no_rawat }}">
                <input type="hidden" name="no_rm" value="{{ $item_pasien->no_rm }}">
                <input type="hidden" name="fr" value="{{ $item_pasien->no_fr }}">

                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-4 col-md-10 my-2">
                        <label for="tgl_rawat" class="form-label">Tanggal Pemeriksaan</label>
                        <div class='input-date-range-bagan'>
                            <input type="text" class="form-control input-daterange input-date-range" id="tgl_rawat" placeholder="Tanggal">
                            <input type="hidden" id="tgl_start" name="form_filter_start" value="{{ !empty($item_pasien->filter_start) ? $item_pasien->filter_start : Request::get('form_filter_start') }}">
                            <input type="hidden" id="tgl_end" name="form_filter_end" value="{{ !empty($item_pasien->filter_end) ? $item_pasien->filter_end : Request::get('form_filter_end') }}">
                        </div>
                    </div>

                    <div class="col-md-1 my-2">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-block btn-primary">
                                <!-- <span class="iconify" style="font-size: 24px;" data-icon="fe:search"></span> -->
                                <img src="{{ asset('') }}icon/search.png" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 8%">No Rawat</th>
                            <th class="py-3" style="width: 5%;">No.RM</th>
                            <th class="py-3" style="width: 15%;">Nama Pasien</th>
                            <th class="py-3" style="width: 9%;">Tgl.Pemeriksaan</th>
                            <th class="py-3" style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tbody data-jml="{{ count($list) }}">
                        @foreach($list as $key => $item)
                        <?php
                        $kode = $item_pasien->no_fr . '@' . $item->no_rawat . '@' . $item->tanggal. '@' . $item_pasien->no_rm. "@". count($list);
                        $check_akses = false;
                        if(str_contains($item->kode_petugas, '|')){
                            foreach (explode('|',$item->kode_petugas) as $kode_petugas) {
                                $check_akses = (new \App\Http\Traits\GlobalFunction)->check_akses($kode_petugas);
                                if($check_akses) break;
                            }
                        }else{
                            $check_akses = (new \App\Http\Traits\GlobalFunction)->check_akses($item->kode_petugas);
                        }
                        if( (new \App\Http\Traits\AuthFunction)->checkAkses("$base_route/fullAkses") ){
                            $check_akses=1;
                        }
                        $kode_lama = '@' . $item_pasien->no_rawat . '$$' . $item_pasien->no_rm;
                        ?>
                        <tr>
                            <td>{{$item->no_rawat}}</td>
                            <td>{{$item->no_rkm_medis}}</td>
                            <td>{{$item->nm_pasien}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>
                                <a href='{{url("$base_route/view")}}' class='modal-remote' data-modal-width="1000px" data-modal-key='{{ $kode.$kode_lama }}' data-modal-title='View Penilaian'>
                                    <!-- <span class="iconify text-primary" style="font-size: 28px;" data-icon="bx:bxs-info-circle"></span> -->
                                    <img src="{{ asset('') }}icon/info.png" alt="">
                                </a>
                                @if($check_akses)
                                    <a href='{{url("$base_route/delete")}}' class='modal-remote-delete' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?">
                                        <!-- <span class="iconify text-danger" style="font-size: 24px;" data-icon="el:trash-alt"></span> -->
                                        <img src="{{ asset('') }}icon/delete.png" alt="">
                                    </a>
                                    <a href='{{url("$base_route/form_update")}}' class='modal-remote modal-edit' data-modal-row="{{ $key }}" data-modal-key='{{ $kode }}' data-modal-title='Ubah Penilaian'>
                                        <!-- <span class="iconify text-primary" style="font-size: 28px;" data-icon="el:file-edit-alt"></span> -->
                                        <img src="{{ asset('') }}icon/edit.png" alt="">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')
<script src="{{ asset('js/globalScript.js') }}"></script>
<script src="{{ asset('js/resep/resep.js') }}"></script>
<script src="{{ asset('js/penilaian_pasien_form/penilaian_pasien_form.js') }}"></script>
@if (!empty($html_tab))
    @php

        $js_file = str_replace(".", "_", $html_tab);

    @endphp
    @if (file_exists(public_path("js/penilaian_pasien_form/penilaian_$js_file.js")))
        <script src="{{ asset("js/penilaian_pasien_form/penilaian_$js_file.js") }}"></script>
    @endif
@endif
@endpush
