<?php

use Illuminate\Support\Facades\Session;
?>

@extends('layouts.master')

@section('breadcrumbs')
@include('layouts.breadcrumbs_dokter_petugas')
@endsection


<?php
$get_user = (new \App\Http\Traits\AuthFunction)->getUser();
$check_registrasi = (new \App\Http\Traits\ItemPasienFunction)->cariRegistrasi($model->no_rawat);
$allow_btn_simpan = 0;
if ($check_registrasi > 0) {
    $allow_btn_simpan = 1;
}

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
</style>
@endpush

@section('content')
<div>
    @include('layouts.tab_resep',['active'=>3])

    <div class="card border-top-0 px-4 py-5">
        <div>
            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="norawat" class="form-label">No.Rawat</label>
                        <input type="text" class="form-control" id="norawat" readonly disabled value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class='bagan_form'>
                        <input type="text" class="form-control" id="no_rm" readonly disabled value="{{ !empty($model->no_rm) ? $model->no_rm : '' }} {{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="kd_dokter" class="form-label">Peresep <span class="text-danger">*</span></label>
                        <input type="text" class="form-control kode-dokter readonly" id="kd_dokter" readonly placeholder="Peresep" value='{{ !empty($model->kd_dokter) ? $model->kd_dokter :  "" }}'>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class='bagan_form'>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id="nama_dokter" readonly disabled placeholder="Nama Dokter" value='{{ !empty($model->nm_dokter) ? $model->nm_dokter :  "" }}' />
                        </div>
                        <div class="message"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-top-0 px-4 py-5">
        <div class="mt-1">
            <form action="" method="GET">
                <input type="hidden" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
                <input type="hidden" name="no_rm" value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
                <input type="hidden" name="fr" value="{{ !empty($model->fr) ? $model->fr : '' }}">

                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group row">
                            <div class="col-2 mb-3">
                                <label for="pil_tgl" class="form-label">&nbsp;</label>
                                <input class="form-check-input" id='pil_tgl' {{ !empty(Request::get('pil_tgl')) ? 'checked' : '' }} name='pil_tgl' style="border-radius: 0px;" type="checkbox" value="1">
                            </div>
                            <div class="col-10 mb-3">
                                <label for="tgl_rawat" class="form-label">Tanggal Peresepan</label>
                                <div class='input-date-range-bagan'>
                                    <input type="text" class="form-control input-daterange input-date-range" id="tgl_rawat" placeholder="Tanggal">
                                    <input type="hidden" id="tgl_start" name="form_filter_start" value="{{ Request::get('form_filter_start') }}">
                                    <input type="hidden" id="tgl_end" name="form_filter_end" value="{{ Request::get('form_filter_end') }}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-4 mb-3">
                        <label for="search" class="form-label">Pencarian Keyword</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ Request::get('search') }}" />
                    </div>

                    <div class="col-md-1 mb-3">
                        <div class="d-grid grap-2">
                            <button type="submit" class="btn btn-primary">
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
                            <th class="py-3" >Asal</th>
                            <th class="py-3" >Nm. Dokter</th>
                            <th class="py-3" >No.Resep</th>
                            <th class="py-3" >waktu Peresepan</th>
                            <th class="py-3" >Status</th>
                            <th class="py-3" >Waktu Validasi</th>
                            <th id='title_action'>Action</th>
                        </tr>
                    </thead>
                    <tbody data-jml="">
                        <?php $jlh_action=0; ?>
                        @if(!empty($data_list))
                            @foreach($data_list as $item)
                                <?php
                                    $link_param = [
                                        // 'no_rawat' => (!empty($model->nm_dokter) ? $model->nm_dokter :  ''),
                                        'no_rawat' => (!empty($model->no_rawat) ? $model->no_rawat : ''),
                                        'no_rm' => (!empty($model->no_rm) ? $model->no_rm : ''),
                                        'fr' => (!empty($model->fr) ? $model->fr : 'rj'),
                                        'cresep' => $item->no_resep
                                    ];
                                    $url_target = '';
                                    $data_from = '';
                                    if (!empty($item->item_obat)) {
                                        $url_target = (new \App\Http\Traits\GlobalFunction)->generateLink($link_param, url('resep'));
                                        $data_from = "<span class='text-purple' style='font-weight:700'>Resep</span>";
                                    } else {
                                        $url_target = (new \App\Http\Traits\GlobalFunction)->generateLink($link_param, url('racikan'));
                                        $data_from = "<span class='text-green' style='font-weight:700'>Racikan</span>";
                                    }
                                    $kode = $item_pasien->no_fr . '@' . $item->no_rawat . '@' . $item->no_rkm_medis . '@' . $item->no_resep;
                                ?>
                                <tr>
                                    <td class="py-3">{!! $data_from !!}</td>
                                    <td class="py-3">{{  $item->nm_dokter  }}</td>
                                    <td class="py-3">{{ $item->no_resep }}</td>

                                    <td class="py-3">{{ $item->tgl_peresepan }}/{{ $item->jam_peresepan }}</td>
                                    <td class="py-3">{{ $item->status }}</td>
                                    <td class="py-3">{{ $item->tgl_perawatan }}/{{ $item->jam }}</td>
                                    <td rowspan='2' id='isi_action' style='vertical-align: middle;'>
                                        @if(empty($allow_btn_simpan))
                                            <?php $jlh_action++; ?>
                                            <div>
                                                <a href="{{ $url_target }}">
                                                    <i class="fa-solid fa-copy" style="font-size: 24px;"></i><span>Salin Resep</span>
                                                </a>
                                            </div>
                                        @endif
                                        @if(!empty($item->kd_dokter))
                                            @if($item->kd_dokter==$get_user->id_user)
                                                <?php $jlh_action++; ?>
                                                <div class="mt-3">
                                                    <a href='copy-resep/delete' class='modal-remote-delete' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?">
                                                        <i class="fa-solid fa-trash" style="font-size: 24px;color:RED;"></i><span style='color:RED'> Hapus</span>
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='6'>
                                        <div class="card border-top-0">
                                            <table class="table bg-info">
                                                @if( !empty($item->item_obat) )
                                                <thead>
                                                    <tr>
                                                        <th class="py-3" style="width: 20%">Jumlah</th>
                                                        <th class="py-3" style="width: 20%;">Kode Obat</th>
                                                        <th class="py-3" style="width: 20%;">Nama Obat</th>
                                                        <th class="py-3" style="width: 40%;">Aturan Pakai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($item->item_obat as $key_b => $item_b)
                                                    <tr>
                                                        <td>{{ !empty($item_b->jml) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($item_b->jml) : ''  }} {{ !empty($item_b->kode_sat) ? $item_b->kode_sat : ''  }}</td>
                                                        <td>{{ !empty($item_b->kode_brng) ? $item_b->kode_brng : ''  }}</td>
                                                        <td>{{ !empty($item_b->nama_brng) ? $item_b->nama_brng : ''  }}</td>
                                                        <td>{{ !empty($item_b->aturan_pakai) ? $item_b->aturan_pakai : ''  }}</td>
                                                    <tr>
                                                        @endforeach
                                                </tbody>
                                                @endif

                                                @if( !empty($item->item_resep_racikan) or !empty($item->item_resep_racikan_detail) )
                                                <thead>
                                                    <tr>
                                                        <th class="py-3" style="width: 20%">Jumlah</th>
                                                        <th class="py-3" style="width: 20%;">Kode Obat</th>
                                                        <th class="py-3" style="width: 20%;">Nama Obat</th>
                                                        <th class="py-3" style="width: 20%;">Aturan Pakai</th>
                                                        <th class="py-3" style="width: 20%;">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if( !empty($item->item_resep_racikan) )
                                                    @foreach($item->item_resep_racikan as $key_2 => $item_2)
                                                    <tr>
                                                        <td>{{ !empty($item_2->jml_dr) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($item_2->jml_dr) : ''  }} {{ !empty($item_2->metode) ? $item_2->metode : ''  }}</td>
                                                        <td>No Racik : {{ !empty($item_2->no_racik) ? $item_2->no_racik : ''  }}</td>
                                                        <td>{{ !empty($item_2->nama_racik) ? $item_2->nama_racik : ''  }}</td>
                                                        <td>{{ !empty($item_2->aturan_pakai) ? $item_2->aturan_pakai : ''  }}</td>
                                                        <td>{{ !empty($item_2->keterangan) ? $item_2->keterangan : ''  }}</td>
                                                    <tr>
                                                        @endforeach
                                                        @endif

                                                        @if( !empty($item->item_resep_racikan_detail) )
                                                        @foreach($item->item_resep_racikan_detail as $key_2 => $item_2)
                                                    <tr>
                                                        <td>{{ !empty($item_2->jml) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($item_2->jml) : ''  }} {{ !empty($item_2->kode_sat) ? $item_2->kode_sat : ''  }}</td>
                                                        <td>{{ !empty($item_2->kode_brng) ? $item_2->kode_brng : ''  }}</td>
                                                        <td>{{ !empty($item_2->nama_brng) ? $item_2->nama_brng : ''  }}</td>
                                                        <td colspan='2'></td>
                                                    <tr>
                                                        @endforeach
                                                        @endif
                                                </tbody>
                                                @endif
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        @if(empty($jlh_action))
                            <script>
                                $('#title_action').hide();
                                $('#isi_action').hide();
                            </script>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')
<script src="{{ asset('js/globalScript.js') }}"></script>
<script src="{{ asset('js/copy-resep/form.js') }}"></script>
@endpush