@extends('layouts.master')

@section('title-header', '')

@section('breadcrumbs')
@include('layouts.breadcrumbs_dokter_petugas')
@endsection

<?php
$get_user = (new \App\Http\Traits\AuthFunction)->getUser();
$item_pasien = (new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));

$link_param = [
    'no_rawat' => (!empty($item_pasien->no_rawat) ? $item_pasien->no_rawat : ''),
    'no_rm' => (!empty($item_pasien->no_rm) ? $item_pasien->no_rm : ''),
    'fr' => (!empty($item_pasien->no_fr) ? $item_pasien->no_fr : ''),
];

?>

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

    .input-dropdown {
        background-image: url("{{ asset('icon/dropdown.png') }}");
        background-size: 24px;
        background-repeat: no-repeat;
        background-position-y: center;
        background-position-x: 97%;
    }

    input.form-control {
        background-color: #FCFCFD !important;
    }

    /* Customize modal box */
    @media (min-width: 1200px) {
        div.modal-xl {
            max-width: 1540px !important;
        }
    }

    @media (min-width: 992px) {
        div.modal-xl {
            max-width: 1340px !important;
        }
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

<link href="{{ asset('libs/select2/4.1.0/css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('libs/select2/4.1.0/js/select2.min.js') }}"></script>
@endpush

@section('content')
<div>
    <div id="isi-cppt">
        <ul class="nav nav-tabs">
            <li class="nav-item border-radius-top text-center" style="width: 240px; background-color: #F5F5F5;">
                <a class="nav-link hover-pointer border-radius-top tabs text-muted active" id="tabs-cppt" href="{{ (new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('isi-cppt')) }}">Isi CPPT</a>
            </li>
            <!-- <li class="nav-item border-radius-top text-center mx-2" style="width: 240px; background-color: #F5F5F5;">
                <a class="nav-link hover-pointer border-radius-top tabs text-muted" id="tabs-report" href="{{ (new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('laporan-operasi-pasien')) }}">Laporan Operasi Pasien</a>
            </li> -->
        </ul>

        <div class="card border-top-0 px-4 py-5">
            <div id="cppt">
                <?php if( (new \App\Http\Traits\AuthFunction)->checkAkses('isi-cppt/create') ){ ?>
                    <form action="isi-cppt/create" method="POST">
                        @csrf
                        <input type="text" value="{{ !empty($model->fr) ? $model->fr : $item_pasien->no_fr }}" hidden name="fr">
                        <input type="text" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }}" hidden name="no_rm">
                        <div class="row justify-content-start align-items-end">
                            <div class="col-lg-2 mb-3">
                                <label for="norawat" class="form-label">No.Rawat</label>
                                <input type="text" class="form-control" id="norawat" readonly required name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : $item_pasien->no_rawat }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }} {{ $dataPasien['nm_pasien'] }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="daterange" class="form-label">Tanggal Pemeriksaan : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-daterange" required id="daterange" autocomplete="off">
                                <input type="text" hidden id="tgl" required name="tgl_perawatan">
                                <input type="text" hidden id="jam" required name="jam_rawat">
                            </div>
                        </div>

                        <hr class="mb-5">
                        @php
                        $nama_first='';
                        $kode_first='';
                        $jabatan_first='';
                        if($get_user->type_user=='dokter'){
                        $kode_first=!empty($selectedDokter->kd_dokter) ? $selectedDokter->kd_dokter : '';
                        $nama_first=!empty($selectedDokter->nm_dokter) ? $selectedDokter->nm_dokter : '';
                        $jabatan_first=!empty($selectedDokter->jabatan) ? $selectedDokter->jabatan : '';
                        }else{
                        $kode_first=!empty($selectedPetugas->nip) ? $selectedPetugas->nip : '';
                        $nama_first=!empty($selectedPetugas->nama) ? $selectedPetugas->nama : '';
                        $jabatan_first=!empty($selectedPetugas->nm_jbtn) ? $selectedPetugas->nm_jbtn : '';
                        }

                        @endphp
                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-2 mb-3">
                                <label for="kodeDokter" class="form-label">Dilakukan</label>
                                <input type="text" aria-label="readonly input kodeDokter" readonly class="form-control readonly" id="kodeDokter" value="{{ $kode_first }}" name="nip">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="button-icon-inside">
                                    <input type="text" readonly class="input-text" id="namaDokter" value="{{ $nama_first }}" />
                                    @if($get_user->type_user=='petugas')
                                    <span id="modalDokter">
                                        <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col mb-3">
                                <label for="profesi" class="form-label">Profesi / Jabatan / Departemen :</label>
                                <input type="text" readonly class="form-control readonly" id="profesi" value="{{ $jabatan_first }}">
                            </div>
                        </div>

                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-2 mb-3">
                                <label for="gcs" class="form-label">GCS (E,V,M)</label>
                                <input type="text" class="form-control" id="gcs" name="gcs" value="{{ !empty($model->gcs) ? $model->gcs : '' }}">
                            </div>
                            <div class="col-lg-2 mb-3">
                                <label for="kesadaran" class="form-label">Kesadaran</label>
                                <select class="form-select input-dropdown" aria-label="Default select example" id="kesadaran" name="kesadaran">
                                    <option value="" selected></option>
                                    @php
                                    $dipilih=!empty($model->kesadaran) ? $model->kesadaran : '';
                                    @endphp
                                    @foreach($kesadarans as $key => $item)
                                    @php
                                    $selected='';
                                    if(strtolower($dipilih)==strtolower($item)){
                                    $selected='selected';
                                    }
                                    @endphp
                                    <option value="{{ $item }}" {{ $selected }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label for="alergi" class="form-label">Alergi : </label>
                                <input type="text" class="form-control" id="alergi" name="alergi" value="{{ !empty($model->alergi) ? $model->alergi : '' }}">
                            </div>
                            @if($item_pasien->no_fr!='ri')
                                <div class="col mb-3">
                                    <label for="lingkar_perut" class="form-label">Lingkar Perut ( Cm ) : </label>
                                    <input type="text" class="form-control" id="lingkar_perut" name="lingkar_perut" value="{{ !empty($model->lingkar_perut) ? $model->lingkar_perut : ''  }}">
                                </div>
                            @endif
                        </div>

                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-6 mb-3">
                                <label for="subjek" class="form-label">Subjek :<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="subjek" name="keluhan" rows="3" required>{{ !empty($model->keluhan) ? $model->keluhan : '' }}</textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="asesmen" class="form-label">Asesmen : <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="asesmen" rows="3" required name="penilaian">{{ !empty($model->penilaian) ? $model->penilaian : '' }}</textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="objek" class="form-label">Objek :<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="objek" name="pemeriksaan" rows="3" required>{{ !empty($model->pemeriksaan) ? $model->pemeriksaan : '' }}</textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="plan" class="form-label">Plan :</label>
                                <textarea class="form-control" id="plan" rows="3" name="rtl">{{ !empty($model->rtl) ? $model->rtl : '' }}</textarea>
                            </div>
                        </div>

                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-3 mb-3">
                                <label for="suhu" class="form-label">Suhu (*C)</label>
                                <?php
                                $value = !empty($lastCppt->suhu_tubuh) ? $lastCppt->suhu_tubuh : '';
                                if (!empty($model->suhu_tubuh)) {
                                    $value = $model->suhu_tubuh;
                                }
                                ?>
                                <input type="number" class="form-control" id="suhu" name="suhu_tubuh" step=0.01 value="{{ $value }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="tinggiBadan" class="form-label">Tinggi Badan</label>
                                <?php
                                $value = !empty($lastCppt->tinggi) ? $lastCppt->tinggi : '';
                                if (!empty($model->tinggi)) {
                                    $value = $model->tinggi;
                                }
                                ?>
                                <input type="number" class="form-control" id="tinggiBadan" name="tinggi" value="{{ $value}}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="beratBadan" class="form-label">Berat Badan</label>
                                <?php
                                $value = !empty($lastCppt->berat) ? $lastCppt->berat : '';
                                if (!empty($model->berat)) {
                                    $value = $model->berat;
                                }
                                ?>
                                <input type="number" class="form-control" id="beratBadan" name="berat" value="{{ $value }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="tensi" class="form-label">Tensi <span class="text-danger">*</span></label>
                                <?php
                                $value = !empty($lastCppt->tensi) ? $lastCppt->tensi : '';
                                if (!empty($model->tensi)) {
                                    $value = $model->tensi;
                                }
                                ?>
                                <input type="text" class="form-control" id="tensi" name="tensi" value="{{ $value }}" required>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="resporasi" class="form-label">Respirasi (/menit)</label>
                                <?php
                                $value = !empty($lastCppt->respirasi) ? $lastCppt->respirasi : '';
                                if (!empty($model->respirasi)) {
                                    $value = $model->respirasi;
                                }
                                ?>
                                <input type="number" class="form-control" id="resporasi" name="respirasi" value="{{ $value }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="nadi" class="form-label">Nadi (/menit)<span class="text-danger"></span></label>
                                <?php
                                $value = !empty($lastCppt->nadi) ? $lastCppt->nadi : '';
                                if (!empty($model->nadi)) {
                                    $value = $model->nadi;
                                }
                                ?>
                                <input type="number" class="form-control" id="nadi" name="nadi" value="{{ $value }}">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="spo2" class="form-label">SpO2 (%)</label>
                                <?php
                                $value = !empty($lastCppt->spo2) ? $lastCppt->spo2 : '';
                                if (!empty($model->spo2)) {
                                    $value = $model->spo2;
                                }
                                ?>
                                <input type="number" class="form-control" id="spo2" name="spo2" value="{{ $value }}">
                            </div>
                        </div>

                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-6 mb-3">
                                <label for="intruksi" class="form-label">Instruksi :</label>
                                <textarea class="form-control" id="intruksi" name="instruksi" rows="3">{{ !empty($model->instruksi) ? $model->instruksi : '' }}</textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="evaluasi" class="form-label">Evaluasi :</label>
                                <textarea class="form-control" id="evaluasi" name="evaluasi" rows="3">{{ !empty($model->evaluasi) ? $model->evaluasi : '' }}</textarea>
                            </div>
                        </div>

                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-2 mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>

                    </form>
                <?php } ?>

                @if( (new \App\Http\Traits\AuthFunction)->checkAkses('TB/create') )
                    @include('cppt.tb.form_tb')
                @endif
                <div class="mt-1">
                    <form action="" method="GET">
                        <input type="hidden" name="no_rawat" value="{{ $item_pasien->no_rawat }}">
                        <input type="hidden" name="no_rm" value="{{ $item_pasien->no_rm }}">
                        <input type="hidden" name="tab" value="{{ Request::get('tab') }}">
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
                                    <th class="py-3" style="width: 9%;">Jam</th>
                                    <th class="py-3" style="width: 15%;">Subjek</th>
                                    <th class="py-3" style="width: 15%;">Objek</th>
                                    <th class="py-3" style="width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody data-jml="{{ count($list) }}">
                                @foreach($list as $key => $item)
                                <?php
                                $kode = $item_pasien->no_fr . '@' . $item['no_rawat'] . '@' . $item['tgl_perawatan'] . '@' . $item['jam_rawat'] . '@' . $item_pasien->no_rm;
                                $check_akses = (new \App\Http\Traits\GlobalFunction)->check_akses($item->nip);
                                $kode_lama = '@' . $item_pasien->no_rawat . '$$' . $item_pasien->no_rm;
                                ?>
                                <tr>
                                    <td>{{$item["no_rawat"]}}</td>
                                    <td>{{$item["no_rkm_medis"]}}</td>
                                    <td>{{$item["nm_pasien"]}}</td>
                                    <td>{{$item["tgl_perawatan"]}}</td>
                                    <td>{{$item["jam_rawat"]}}</td>
                                    <td>{{$item["keluhan"]}}</td>
                                    <td>{!! str_replace("\n","<br/>",$item["pemeriksaan"]) !!}</td>
                                    <td>
                                        <a href='isi-cppt/view' class='modal-remote' data-modal-key='{{ $kode.$kode_lama }}' data-modal-title='View Cppt'>
                                            <!-- <span class="iconify text-primary" style="font-size: 28px;" data-icon="bx:bxs-info-circle"></span> -->
                                            <img src="{{ asset('') }}icon/info.png" alt="">
                                        </a>
                                        @if($check_akses)
                                        <a href='isi-cppt/delete' class='modal-remote-delete' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?">
                                            <!-- <span class="iconify text-danger" style="font-size: 24px;" data-icon="el:trash-alt"></span> -->
                                            <img src="{{ asset('') }}icon/delete.png" alt="">
                                        </a>
                                        <a href='isi-cppt/form_update' class='modal-remote modal-edit' data-modal-row="{{ $key }}" data-modal-key='{{ $kode }}' data-modal-title='Ubah Cppt'>
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
    </div>

    <!-- Button trigger modal pilih dokter -->
    <button type="button" style="display: none;" id="showModalPilihDokter" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModalPilihDokters">
    </button>

    @if($get_user->type_user=='dokter')
    <!-- Modal Pilih Dokter -->
    <div class="modal fade" id="showModalPilihDokters" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="col-6">
                        <div class="d-flex justify-content-center align-items-center border">
                            <input type="text" class="form-control border-0" id="pencarianPopupDokter" placeholder="Masukkan kata yang akan dicari">
                            <button type="submit" class="btn btn-white">
                                <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal" id="closeModalDokter" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <table class="table border" id="tablePopupDokter">
                        <thead>
                            <tr>
                                <th scope="col" class="py-4 ps-4">Kode Dokter</th>
                                <th scope="col" class="py-4" style="width: 35%;">Nama Dokter</th>
                                <th scope="col" class="py-4">Spesialis</th>
                                <th scope="col" class="py-4 pe-4">Nomo Ijin Praktek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokters as $item)
                            <?php
                            $kode = $item["kd_dokter"];
                            $nama = $item["nm_dokter"];
                            $jabatan = $item["jabatan"];
                            ?>
                            <tr>
                                <td class="py-3 ps-4">{{ $item["kd_dokter"] }}</td>
                                <td class="py-3"> <span class="text-primary hover-pointer" onclick="setValueDokter('{{$nama}}', '{{$kode}}', '{{$jabatan}}')">{{ $nama }}</span></td>
                                <td class="py-3">{{ $item["nm_sps"] }}</td>
                                <td class="py-3">{{ $item["no_ijn_praktek"] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Modal Pilih Petugas -->
    <div class="modal fade" id="showModalPilihDokters" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="col-6">
                        <div class="d-flex justify-content-center align-items-center border">
                            <input type="text" class="form-control border-0" id="pencarianPopupDokter" placeholder="Masukkan kata yang akan dicari">
                            <button type="submit" class="btn btn-white">
                                <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal" id="closeModalDokter" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <table class="table border" id="tablePopupDokter">
                        <thead>
                            <tr>
                                <th scope="col" class="py-4 ps-4">NIP</th>
                                <th scope="col" class="py-4" style="width: 35%;">Nama Petugas</th>
                                <th scope="col" class="py-4">Alamat</th>
                                <th scope="col" class="py-4 pe-4">Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($petugases)>0)
                            @foreach($petugases as $item)
                            @php
                            $nama = $item["nama"];
                            $kode= $item["nip"];
                            $jabatan = $item["nm_jbtn"];
                            @endphp
                            <tr>
                                <td class="py-3 ps-4">{{ $item["nip"] }}</td>
                                <td class="py-3"> <span class="text-primary hover-pointer" onclick="setValueDokter('{{$nama}}', '{{$kode}}', '{{$jabatan}}')">{{ $nama }}</span></td>
                                <td class="py-3">{{ $item["alamat"] }}</td>
                                <td class="py-3">{{ $item["nm_jbtn"] }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Button trigger modal Petugas Daftar Tindakan -->
    <button type="button" style="display: none;" id="buttonModalDokter" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#showModalDokter"></button>

    @if($get_user->type_user=='dokter')
    <!-- Modal Petugas Daftar Tindakan -->
    <div class="modal fade bagan-data-table" id="showModalDokter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="col-6">
                        <div class="d-flex justify-content-center align-items-center border">
                            <input type="text" class="form-control border-0 search-data-table" placeholder="Masukkan kata yang akan dicari">
                            <button type="submit" class="btn btn-white">
                                <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal" id="closeModalDokterDT" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table data-table border">
                        <thead>
                            <tr>
                                <th scope="col" class="py-4 ps-4">Kode Dokter</th>
                                <th scope="col" class="py-4" style="width: 35%;">Nama Dokter</th>
                                <th scope="col" class="py-4">Spesialis</th>
                                <th scope="col" class="py-4 pe-4">Nomo Ijin Praktek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($listDokter)>0)
                            @foreach($listDokter as $item)
                            <?php
                            $kode = $item["kd_dokter"];
                            $nama = $item["nm_dokter"];
                            $jabatan = $item["jabatan"];
                            ?>
                            <tr>
                                <td class="py-3 ps-4">{{ $item["kd_dokter"] }}</td>
                                <td class="py-3"> <span class="text-primary hover-pointer set-value-data-table-modal" data-target="#kodeDokter@val|#namaDokter@val" data-value-kode="{{ $kode }}" data-value-nama="{{ $nama }}" data-value='{{$kode}}|{{$nama}}'>{{ $nama }}</span></td>
                                <td class="py-3">{{ $item["nm_sps"] }}</td>
                                <td class="py-3">{{ $item["no_ijn_praktek"] }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="modal fade bagan-data-table" id="showModalDokter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="col-6">
                        <div class="d-flex justify-content-center align-items-center border">
                            <input type="text" class="form-control border-0" id="pencarianPopupDokter" placeholder="Masukkan kata yang akan dicari">
                            <button type="submit" class="btn btn-white">
                                <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal" id="closeModalDokter" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <table class="table border" id="tablePopupDokter">
                        <thead>
                            <tr>
                                <th scope="col" class="py-4 ps-4">NIP</th>
                                <th scope="col" class="py-4" style="width: 35%;">Nama Petugas</th>
                                <th scope="col" class="py-4">Alamat</th>
                                <th scope="col" class="py-4 pe-4">Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($listPetugas)>0)
                            @foreach($listPetugas as $item)
                            @php
                            $nama = $item["nama"];
                            $kode= $item["nip"];
                            $jabatan = $item["nm_jbtn"];
                            @endphp
                            <tr>
                                <td class="py-3 ps-4">{{ $item["nip"] }}</td>
                                <td class="py-3"> <span class="text-primary hover-pointer set-value-data-table-modal" data-target="#kodeDokter@val|#namaDokter@val" data-value-kode="{{ $kode }}" data-value-nama="{{ $nama }}">{{ $nama }}</span></td>
                                <td class="py-3">{{ $item["alamat"] }}</td>
                                <td class="py-3">{{ $item["nm_jbtn"] }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>

    
    @endif
</div>
@endsection

@push('link-script')
    <script src="{{ asset('js/resume/resume.js') }}"></script>
    <script src="{{ asset('js/globalScript.js') }}"></script>
    <script src="{{ asset('js/isiCppt2.js') }}"></script>
@endpush