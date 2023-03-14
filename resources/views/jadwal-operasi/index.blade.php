@extends('layouts.master')

@section('title-header', '')

@section('breadcrumbs')
@include('layouts.breadcrumbs_dokter_petugas')
@endsection

<?php
$get_user = (new \App\Http\Traits\AuthFunction)->getUser();
$link_param = [
    'no_rawat' => (!empty($_GET["no_rawat"]) ? $_GET["no_rawat"] : ''),
    'no_rm' => (!empty($_GET["no_rm"]) ? $_GET["no_rm"] : ''),
    'fr' => (!empty($_GET["fr"]) ? $_GET["fr"] : ''),
];

?>

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
@endpush

@push('custom-style')
<style>
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

    .input-time {
        background-image: url("{{ asset('icon/time.png') }}");
        background-size: 24px;
        background-repeat: no-repeat;
        background-position-y: center;
        background-position-x: 97%;
    }

    .fixed-header {
        overflow-y: auto;
        height: 400px;
    }

    .fixed-header-50vh {
        -ms-overflow-style: none;
        scrollbar-width: none;
        overflow-x: scroll;
        overflow-x: auto;
        height: 50vh;
        overflow-x: hidden;
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
    }
</style>
@endpush


@section('content')
<div>
    <ul class="nav nav-tabs">
        <li class="nav-item border-radius-top text-center button-tabs me-2">
            <a class="nav-link border-radius-top tabs text-muted hover-pointer" id="tabs-klinis" href="{{ (new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('permintaan')) }}&tab=pk" onclick="removeLocalStrg()">Patologi klinis</a>
        </li>
        <li class="nav-item border-radius-top text-center button-tabs me-2">
            <a class="nav-link border-radius-top tabs text-muted hover-pointer" id="tabs-anatomi" href="{{ (new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('permintaan')) }}&tab=pa" onclick="removeLocalStrg()">Patologi anatomi</a>
        </li>
        <li class="nav-item border-radius-top text-center button-tabs me-2">
            <a class="nav-link border-radius-top tabs text-muted hover-pointer" id="tabs-radiologi" href="{{ (new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('permintaan')) }}&tab=pr" onclick="removeLocalStrg()">Pemeriksaan Radiologi</a>
        </li>
        <li class="nav-item border-radius-top text-center button-tabs me-2">
            <a class="nav-link border-radius-top tabs text-muted hover-pointer  active" id="tabs-operasi" href="{{ (new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('jadwal-operasi')) }}" >Jadwal Operasi</a>
        </li>
    </ul>

    <div class="card border-top-0 px-4 py-5">
        <div id="form">
            @include('jadwal-operasi.form')
        </div>
    </div>
</div>
@endsection

@push('link-script')
<script src="{{ asset('js/globalScript.js') }}"></script>
@endpush