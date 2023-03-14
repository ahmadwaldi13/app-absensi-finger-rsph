@extends('layouts.master')

@section('title-header', '')

@section('breadcrumbs')
    @include('layouts.breadcrumbs_dokter_petugas')
@endsection

<?php

function formatAge($tl)
{
    if($tl != ""){
        $tgl = substr($tl, 8, 2);
        $bln = substr($tl, 5, 2);
        $thn = substr($tl, 0, 4);
        $birthDate = $tgl . '-' . $bln . '-' . $thn;
        $birthDate = explode("-", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, intval($birthDate[0]), intval($birthDate[1]), intval($birthDate[2])))) > date("md")
            ? ((date("Y") - intval($birthDate[2])) - 1)
            : (date("Y") - intval($birthDate[2])));
        return $age;
    }
    return $tl;
};

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

    .input-daterange {
        background-image: url("{{ asset('icon/date.png') }}");
        background-size: 24px;
        background-repeat: no-repeat;
        background-position-y: center;
        background-position-x: 97%;
    }
</style>
@endpush

@section('content')
<div>
    <div id="riwayat-pasien">
        <!-- <div class="my-3">
            <button class="btn btn-primary kembali">Kembali</button>
        </div> -->
        <ul class="nav nav-tabs">
            <li class="nav-item border-radius-top text-center" style="width: 240px; background-color: #F5F5F5;">
                <a class="nav-link border-radius-top tabs text-muted active" id="tabs-resume" aria-current="page" href="#">Data Pasien</a>
            </li>
        </ul>
        <div class="card border-top-0 px-4 py-5">
            <div id="resume">
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">No.RM</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ $dataPasien["no_rkm_medis"] }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Nama Pasien</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ $dataPasien["nm_pasien"] }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Alamat</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ $dataPasien["alamat"] }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Umur</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ formatAge($dataPasien["tgl_lahir"]) }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Tempat, Tanggal Lahir</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ $dataPasien["tgl_lahir"] }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Ibu Kandung</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ $dataPasien["nm_ibu"] }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Golongan Darah</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ $dataPasien["gol_darah"] }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Status Menikah</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ $dataPasien["stts_nikah"] }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Agama</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ $dataPasien["agama"] }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Pendidikan Terakhir</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ $dataPasien["pnd"] }}</li>
                </ul>
                <ul class="list-group list-group-horizontal border-0">
                    <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Pertama Daftar</li>
                    <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: </li>
                </ul>
                <div class="py-3">
                    @if( (new \App\Http\Traits\AuthFunction)->checkAkses('riwayat-pasien/view') )
                        <a class="btn btn-primary px-4 my-2" href="riwayat-pasien/view?no_rm={{Request::get('no_rm')}}&fr={{Request::get('fr')}}&semua=true" target="_blank">Lihat Seluruh Riwayat</a>
                        <a class="btn btn-primary px-4 my-2" href="riwayat-pasien/view?no_rm={{Request::get('no_rm')}}&fr={{Request::get('fr')}}" target="_blank">Lihat 3 Riwayat Terakhir</a>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('link-script')
<script src="{{ asset('js/riwayatPasien.js') }}"></script>
@endpush