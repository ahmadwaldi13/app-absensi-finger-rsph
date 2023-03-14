<?php
    use Illuminate\Support\Facades\Session;
?>

@extends('layouts.master')

@if(empty($kode_key_old))
    @section('breadcrumbs')
        @include('layouts.breadcrumbs_dokter_petugas')
    @endsection
@else
    @section('title-header', 'Ubah Racikan')
@endif


<?php
    $get_user = (new \App\Http\Traits\AuthFunction)->getUser();
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
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

        .body-racikan-copy,#check_submit,#data_racikan_feedback{
            display: none;
        }
    </style>
@endpush

@section('content')
<div>
    @include('layouts.tab_resep',['active'=>2])

    <div class="card border-top-0 px-4 py-5">
        @if(!empty($url_back_index))
            <div class="text-primary mb-3">
                <a href="{{ url($url_back_index) }}" class="hover-pointer btn-back">
                    <span class="iconify" data-icon="vaadin:backwards" style="font-size: 20px;"></span>
                    <span class="mx-2">Kembali Ke Data Racikan</span>
                </a>
            </div>
        @endif

        @include('racikan.form')

        @if(empty($kode_key_old))
            <div class="mt-5">
                <form action="" method="GET">
                    <input type="hidden" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
                    <input type="hidden" name="no_rm" value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
                    <input type="hidden" name="fr" value="{{ !empty($model->fr) ? $model->fr : '' }}">

                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-4 col-md-10">
                            <label for="tgl_rawat" class="form-label">Tanggal Peresepan</label>
                            <div class='input-date-range-bagan'>
                                <input type="text" class="form-control input-daterange input-date-range" id="tgl_rawat" placeholder="Tanggal">
                                <input type="hidden" id="tgl_start" name="form_filter_start" value="{{ !empty($item_pasien->filter_start) ? $item_pasien->filter_start : Request::get('form_filter_start') }}">
                                <input type="hidden" id="tgl_end" name="form_filter_end" value="{{ !empty($item_pasien->filter_end) ? $item_pasien->filter_end : Request::get('form_filter_end') }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                <!-- <span class="iconify" style="font-size: 24px;" data-icon="fe:search"></span> -->
                                <img src="{{ asset('') }}icon/search.png" alt="">
                            </button>
                        </div>
                    </div>
                </form>
                <div style="overflow-x: auto; max-width: auto;">
                    <table class="table border table-responsive-tablet">
                        <thead>
                            <tr>
                                <th class="py-3" style="width: 8%">No.Resep</th>
                                <th class="py-3" style="width: 5%;">waktu Peresepan</th>
                                <th class="py-3" style="width: 9%;">No Rawat</th>
                                <th class="py-3" style="width: 9%;">No.Rm</th>
                                <th class="py-3" style="width: 10%;">Pasien</th>
                                <th class="py-3" style="width: 10%;">Dokter Peresep</th>
                                <th class="py-3" style="width: 10%;">Poli/Unit</th>
                                <th class="py-3" style="width: 10%;">Status</th>
                                <th class="py-3" style="width: 10%;">Waktu Validasi</th>
                                <th class="py-3" style="width: 8%;">Action</th>
                            </tr>
                        </thead>
                        <tbody data-jml="">
                            @if(!empty($data_list))
                                @foreach($data_list as $item)
                                    <?php
                                        $kode = $item_pasien->no_fr . '@' . $item->no_rawat . '@' . $item->no_rkm_medis . '@' . $item->no_resep;
                                        $check_akses=(new \App\Http\Traits\GlobalFunction)->check_akses($item->kd_dokter);
                                        if( (new \App\Http\Traits\AuthFunction)->checkAkses('racikan/fullAkses') ){
                                            $check_akses=1;
                                        }
                                    ?>
                                    <tr>
                                        <td class="py-3">{{ $item->no_resep }}</td>
                                        <td class="py-3">{{ $item->tgl_peresepan }}/{{ $item->jam_peresepan }}</td>
                                        <td class="py-3">{{ $item->no_rawat }}</td>
                                        <td class="py-3">{{ $item->no_rkm_medis }}</td>
                                        <td class="py-3">{{ $item->nm_pasien }}</td>
                                        <td class="py-3">{{ $item->nm_dokter }}</td>
                                        <td class="py-3">{{ $item->nm_poli }}</td>
                                        <td class="py-3">{{ $item->status }}</td>
                                        <td class="py-3">{{ $item->tgl_perawatan }}/{{ $item->jam }}</td>
                                        <td>
                                            @if( (new \App\Http\Traits\AuthFunction)->checkAkses('racikan/view') )
                                                <a href="{{ url('racikan/view') }}" class='modal-remote' data-modal-key='{{ $kode }}' data-modal-title='View Isi Racikan'>
                                                    <img src="{{ asset('') }}icon/info.png" alt="">
                                                </a>
                                            @endif
                                            @if($check_akses)
                                                @if( (new \App\Http\Traits\AuthFunction)->checkAkses('racikan/update') )
                                                    <a href="{{ url('racikan/form_update?data_sent='.$kode) }}">
                                                        <img src="{{ asset('') }}icon/edit.png" alt="">
                                                    </a>
                                                @endif

                                                @if( (new \App\Http\Traits\AuthFunction)->checkAkses('racikan/delete') )
                                                    <a href="{{ url('racikan/delete') }}" class='modal-remote-delete' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?">
                                                        <img src="{{ asset('') }}icon/delete.png" alt="">
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

@push('custom-script')
<script src="{{ asset('js/globalScript.js') }}"></script>
<script src="{{ asset('js/racikan/racikan_function.js') }}"></script>
<script src="{{ asset('js/racikan/racikan.js') }}"></script>
@endpush