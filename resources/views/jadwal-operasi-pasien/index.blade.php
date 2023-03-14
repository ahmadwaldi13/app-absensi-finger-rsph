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
    padding-top: 4px;
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
@endpush

@section('content')
<div>
    <div id="jadwal-operasi-pasien">
        <ul class="nav nav-tabs">
            <li class="nav-item border-radius-top text-center" style="width: 240px; background-color: #F5F5F5;">
                <a class="nav-link hover-pointer border-radius-top tabs text-muted active" id="tabs-soap" href="{{ (new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('soal-farmasi')) }}">Jadwal Operasi Pasien</a>
            </li>
        </ul>

        <div class="card border-top-0 px-4 py-5">
            <div id="jadwal-operasi-pasien">
                
                    <form action="{{ $action_form }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
                        @csrf
                        <input type="text" value="{{ !empty($model->fr) ? $model->fr : $item_pasien->no_fr }}" hidden name="fr">
                        <input type="text" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }}" hidden name="no_rm">
                        <div class="row justify-content-start align-items-end">
                            <div class="col-lg-2 mb-3">
                                <label for="no_rawat" class="form-label">No.Rawat</label>
                                <input type="text" class="form-control" id="no_rawat" readonly name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : $item_pasien->no_rawat }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" class="form-control" readonly id="name" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }} {{ $dataPasien['nm_pasien'] }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class='input-date-time-bagan'>
                                    <label for="no_peserta" class="form-label">No.Kartu </label>
                                    <input type="text" class="form-control kode-dokter" id="no_peserta" name="no_peserta" readonly  placeholder="Nomor Kartu" required value='{{ !empty($dataPasien->no_peserta) ? $dataPasien->no_peserta :  "" }}' readonly>
                                    <div class="message"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-6 mb-3">
                                <div class='bagan_form'>
                                    <label for="dokter_perujuk" class="form-label">Operator <span class="text-danger">*</span></label>
                                    <div class="button-icon-inside">
                                        <input type="text" class="input-text" id='nm_dokter' name="nm_dokter" value="{{ !empty($model->nm_dokter) ? $model->nm_dokter : '' }}" />
                                        <input type="hidden" id="kd_dokter" name="kd_dokter" value="{{ !empty($model->kd_dokter) ? $model->kd_dokter : '' }}" />
                                        <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_dokter') }}" data-modal-pencarian='true' data-modal-title='Pilih Dokter' data-modal-width='50%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nm_dokter|#kd_dokter@data-key-bagan=0@data-btn-close=#closeModalData">
                                            <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                        </span>
                                        <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                                    </div>
                                    <div class="message"></div>
                                </div>
                            </div>
                            
                        </div>

                        <hr class="mb-4"> 

                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-3 mb-3">
                                <label for="subjek" class="form-label">Tanggal :<span class="text-danger">*</span></label>
                                <span class='icon-bagan-date'></span>
                                    <input type="text" class="form-control daterangePatient" id="tanggal" name='tanggal' required>
                                <div class="message"></div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai :<span class="text-danger">*</span></label>
                                    <input type="time" class="form-control input-daterange" id='jam_mulai' name="jam_mulai" value="{{ !empty($model->jam_mulai) ? $model->jam_mulai : '00:00' }}" />
                                <div class="message"></div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai :<span class="text-danger">*</span></label>
                                    <input type="time" class="form-control input-daterange" id='jam_selesai' name="jam_selesai" value="{{ !empty($model->jam_mulai) ? $model->jam_mulai : '00:00' }}" />
                                <div class="message"></div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="objek" class="form-label">Status :<span class="text-danger">*</span></label>
                                <select class="form-select" name="status" id="status" required>
                                    @foreach($jadwalOperasiStatuses as $items => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="objek" class="form-label">Operasi :<span class="text-danger">*</span></label>
                                <div class="button-icon-inside">
                                    <input type="text" class="input-text" id='nm_perawatan' name="nm_perawatan" value="{{ !empty($model->nm_perawatan) ? $model->nm_perawatan : '' }}" />
                                        <input type="hidden" id="kode_paket" name="kode_paket" value="{{ !empty($model->kode_paket) ? $model->kode_paket : '' }}" />
                                        <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_paket_operasi') }}" data-modal-pencarian='true' data-modal-title='Pilih Paket Operasi' data-modal-width='50%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#kode_paket|#nm_perawatan|#kategori|#operator1@data-key-bagan=0@data-btn-close=#closeModalData">
                                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                    </span>
                                    <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                                </div>
                                <div class="message"></div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="objek" class="form-label">Ruang OK :<span class="text-danger">*</span></label>
                                <select class="form-control ruang" name="kd_ruang_ok" id="kd_ruang_ok" required>
                                    @foreach($ruangOK as $items => $value)
                                        <option value="{{ $value['kd_ruang_ok'] }}">{{ $value['nm_ruang_ok'] }}</option>
                                    @endforeach
                                </select>
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
                

                <div class="mt-5">
                    @include('jadwal-operasi-pasien.columns')
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

{{-- @push('link-script')
    <script src="{{ asset('js/globalScript.js') }}"></script>
    <script src="{{ asset('js/jadwal-operasi/form.js') }}"></script>
@endpush --}}

@push('custom-script')
    <script src="{{ asset('js/globalScript.js') }}"></script>
    {{-- <script src="{{ asset('js/jadwal-operasi/form.js') }}"></script> --}}
    <script>
        $("#tanggal")
            .daterangepicker({
            singleDatePicker: true,
            startDate: new Date(),
            locale: {
                format: "YYYY-MM-DD",
            },
            timePicker: false,
            showDropdowns: true,
            linkedCalendars: false,
        });
            
        $(document).ready(function() {
            $("#tanggal").on("change keyup", function () {
                let date = $(this).val();
                let tgl = date.substring(0, 10);
            
                $("#tgl").val(tgl);
            });
        });

        $(document).ready(function() {
            $('.ruang').select2();
        });
    </script>
@endpush
