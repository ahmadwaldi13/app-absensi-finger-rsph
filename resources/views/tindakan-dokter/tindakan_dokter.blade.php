@extends('layouts.master')

@section('title-header', '')

@section('breadcrumbs')
    @include('layouts.breadcrumbs_dokter_petugas')
@endsection

@php
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
    
    $link_param=[
        'no_rawat'=>(!empty($item_pasien->no_rawat) ? $item_pasien->no_rawat : ''),
        'no_rm'=>(!empty($item_pasien->no_rm) ? $item_pasien->no_rm : ''),
        'fr'=>(!empty($item_pasien->no_fr) ? $item_pasien->no_fr : ''),
    ];
    $tabLink=(new \App\Http\Traits\GlobalFunction)->generateLink($link_param);
    $tabs = !empty($_GET["tab"]) ? $_GET["tab"] : null;
@endphp

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
</style>
@endpush

@push('link')
<script type="text/javascript" src="{{ asset('libs\jquery\latest\jquery.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\jquery\latest\moment.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\daterangepicker\3.1.0\js\daterangepicker.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\jquery.dataTables.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\dataTables.buttons.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs\daterangepicker\3.1.0\css\daterangepicker.css' )}}" />

@endpush

@section('content')
<div>
    <div id="tindakan-pasien">
        <ul class="nav nav-tabs">
            <li class="nav-item border-radius-top text-center" style="width: 300px; background-color: #F5F5F5;">
                <a class="nav-link border-radius-top tabs text-muted {{ ($tabs==null) ? 'active' : '' }}" id="tabs-daftar" aria-current="page" id="tabs-daftar" href="{{ $tabLink }}">Daftar Tindakan / Tagihan</a>
            </li>
            <li class="nav-item border-radius-top text-center mx-2" style="width: 300px; background-color: #F5F5F5;">
                <a class="nav-link border-radius-top tabs text-muted {{ $tabs=='tindakan' ? 'active' : '' }}" id="tabs-tindakan" href="{{ $tabLink }}&tab=tindakan">Tindakan Dilakukan @if($jmlTindakan > 0)<span>({{ $jmlTindakan }})</span>@endif</span></a>
            </li>
        </ul>
        <div class="card border-top-0 px-4 py-5">

            <?= $html_tab ?>

        </div>
    </div>

</div>

@endsection

@push('link-script')
<script src="{{ asset('js/globalScript.js') }}"></script>
@endpush