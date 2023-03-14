@extends('layouts.master')

@if(empty($kode_key_old))
    @section('breadcrumbs')
        @include('layouts.breadcrumbs_dokter_petugas')
    @endsection
@else
    @section('title-header', 'Ubah Resume')
@endif

<?php
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
?>


@push('link')
<script type="text/javascript" src="{{ asset('libs/jquery/latest/3.2.1/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/moment/2.18.1/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/daterangepicker/3.1.0/js/daterangepicker.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs/daterangepicker/3.1.0/css/daterangepicker.css') }}" />

<script type="text/javascript" src="{{ asset('libs/datatables/1.10.11/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/datatables/1.10.11/buttons/1.1.2/js/dataTables.buttons.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\buttons\1.1.2\js\buttons.html5.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/1.10.11/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/1.10.11/buttons/1.1.2/css/buttons.dataTables.min.css') }}">

<link href="{{ asset('libs/select2/4.1.0/css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('libs/select2/4.1.0/js/select2.min.js') }}"></script>
@endpush

@push('custom-style')
<style>
    .input-show-modal {
        background-image: url("{{ asset('icon/select.png') }}");
        background-size: 24px;
        background-repeat: no-repeat;
        background-position-y: center;
        background-position-x: 97%;
    }

    .textarea-show-modal {
        background-image: url("{{ asset('icon/select.png') }}");
        background-size: 24px;
        background-repeat: no-repeat;
        background-position-y: 10%;
        background-position-x: 98%;
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

    input.form-control {
        background-color: #FCFCFD !important;
    }

    textarea.form-control {
        background-color: #FCFCFD !important;
    }

    .border-default {
        border: 1px solid #ced4da;
    }

    .select2-selection {
        height: 2.3em !important;
    }

    .select2 {
        /* padding: 0.375rem 0.75rem !important; */
        width: 100% !important;
    }

    .select2-results > ul.select2-results__options {
        width: auto !important;
        min-height: auto !important;
        max-height: 75vh !important;
    }
</style>
@endpush

@section('content')
<div>
    <div id="isi-cppt">
        @if(!empty($url_back_index))
            <div class="text-primary mb-3">
                <a href="{{ url($url_back_index) }}" class="hover-pointer btn-back">
                    <span class="iconify" data-icon="vaadin:backwards" style="font-size: 20px;"></span> 
                    <span class="mx-2">Kembali Ke Data Resume</span>
                </a>
            </div>
        @endif

        <div class="card p-3 pb-5">
            
            <div id="form">
                @php
                    $type_form=!empty($item_pasien->no_fr) ? $item_pasien->no_fr : '';
                    if(!empty($kode_key_old)){
                        $type_form=$type_akses;
                    }
                @endphp
                @if(!empty($type_form))
                    @if($type_form=='ri')
                        @include('resume.form_ranap')
                    @else
                        @include('resume.form')
                    @endif
                @endif
            </div>
            
            @if(empty($kode_key_old))
                <div class="my-3">
                    <form action="" method="GET">
                        <input type="hidden"  name="no_rawat" value="{{ $item_pasien->no_rawat }}">
                        <input type="hidden"  name="no_rm" value="{{ $item_pasien->no_rm }}">
                        <input type="hidden"  name="tab" value="{{ Request::get('tab') }}">
                        <input type="hidden"  name="fr" value="{{ $item_pasien->no_fr }}">

                        <div class="row justify-content-start align-items-end mb-3">
                            <div class="col-lg-4 col-md-10 my-3">
                                <label for="tgl_rawat" class="form-label">Tanggal Rawat</label>
                                <div class='input-date-range-bagan'>
                                    <input type="text" class="form-control input-daterange input-date-range" id="tgl_rawat" placeholder="Tanggal">
                                    <input type="hidden" id="tgl_start" name="form_filter_start" value="{{ !empty($item_pasien->filter_start) ? $item_pasien->filter_start : Request::get('form_filter_start') }}">
                                    <input type="hidden" id="tgl_end" name="form_filter_end" value="{{ !empty($item_pasien->filter_end) ? $item_pasien->filter_end : Request::get('form_filter_end') }}">
                                </div>
                            </div>

                            <div class="col-md-1 my-3">
                                <div class="d-grid grap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <!-- <span class="iconify" style="font-size: 24px;" data-icon="fe:search"></span> -->
                                        <img src="{{ asset('') }}icon/search.png" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @php
                        $type_form=!empty($item_pasien->no_fr) ? $item_pasien->no_fr : '';
                    @endphp
                    @if(!empty($type_form))
                        @if($type_form=='ri')
                            @include('resume.columns_index_ranap')
                        @else
                            @include('resume.columns_index')
                        @endif
                    @endif

                </div>
            @endif
        </div>
    </div>

    @include('resume.modal_form')
</div>
@endsection

@push('link-script')
    <script src="{{ asset('js/globalScript.js') }}"></script>
    <script src="{{ asset('js/resume/resume.js') }}"></script>
@endpush