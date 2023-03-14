@extends('layouts.master')

@section('title-header', 'Jadwal Operasi')

<?php

function formatMoney($nominal, $currency = "")
{
    $hasil = $currency . number_format($nominal, 0, '', '.');
    echo $hasil;
}
?>

@push('link')
<script type="text/javascript" src="{{ asset('libs\jquery\latest\jquery.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\jquery\latest\moment.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\daterangepicker\3.1.0\js\daterangepicker.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs\daterangepicker\3.1.0\css\daterangepicker.css' )}}" />
@endpush

@push('custom-style')
<style>
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

    li.active {
        width: 38px;
        text-align: center;
    }

    .page-link {
        background-color: #cee5ff;
    }

    .page-item {
        margin: 0px 5px 0px 5px;
    }

    @media (max-width: 575.98px) {
        .page-item {
            margin: 0px;
            margin-top: 20px;
        }
    }
</style>
@endpush

@section('content')
<div>
    <form action="" method="GET">
        <div class="row d-flex align-items-end">
            <div class="col-xl-3 col-12 my-3">
                <label for="form-search" class="form-label">Pencarian Keyword</label>
                <input type="text" class="form-control" id="form-search" name='form_search' value="{{ $item_search['form_search'] }}" placeholder="Masukkan Keyword">
            </div>

            <div class="col-xl-2 col-12 my-3">
                <label for="form-status" class="form-label">Berdasarkan Status</label>
                <select class="form-select input-dropdown" id="form-status" name="form_status" aria-label="Default select example" >
                    @foreach($jadwalOperasiStatuses as $item)
                        <option value="{{ $item }}" <?= (strtolower($item)==strtolower($item_search['form_status'])) ? 'selected' : '' ?> >{{ $item }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xl-3 col-10 my-3">
                <label for="daterangejo" class="form-label">Periode Waktu</label>
                <div class='input-date-range-bagan'>
                    <input type="text" class="form-control input-daterange input-date-range" id="daterangejo" placeholder="Tanggal">
                    <input type="hidden" id="tgl_start" name="form_start" value="{{ $item_search['form_start'] }}">
                    <input type="hidden" id="tgl_end" name="form_end" value="{{ $item_search['form_end'] }}">
                </div>
            </div>

            <div class="col-md-2 col-2">
                <button type="submit" class="btn btn-primary mb-3">
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
                    <th class="py-4 ps-4">No. Rawat</th>
                    <th class="py-4">Nama Pasien</th>
                    <th class="py-4">Waktu</th>
                    <th class="py-4">Kamar Operasi</th>
                    <th class="py-4">Mulai</th>
                    <th class="py-4">Selesai</th>
                    <th class="py-4">Status</th>
                    <th class="py-4">Rujukan dari</th>
                    <th class="py-4">Diagnosa</th>
                    <th class="py-4">Operasi</th>
                    <th class="py-4 pe-4">Operator</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwalOperasiLists as $key => $item)
                    <tr>
                        <td class="py-3 ps-4">{{ $item["no_rawat"] }}</td>
                        <td class="py-3">{{ $item["nm_pasien"] }}</td>
                        <td class="py-3">{{ $item["tanggal"] }}</td>
                        <td class="py-3">{{ !empty($item["nm_kamar_operasi"]) ? $item["nm_kamar_operasi"] : '-' }}</td>
                        <td class="py-3">{{ $item["jam_mulai"] }}</td>
                        <td class="py-3">{{ $item["jam_selesai"] }}</td>
                        <td class="py-3">{{ $item["status"] }}</td>
                        <td class="py-3">{{ $item["nm_poli"] }}</td>
                        <td class="py-3">{{ $item["diagnosa"] }}</td>
                        <td class="py-3">{{ $item["nm_perawatan"] }}</td>
                        <td class="py-3 pe-4">{{ $item["nm_dokter"] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
            {{-- <div class="col">
                <div class="d-flex flex-row align-items-center">
                    <span>Tampilkan Row Data</span>
                    <select class="form-select ms-3" name="per_page" id="per_page" onchange="doSubmit(this)" aria-label="Default select example" style="width: 100px;" id="row-data">
                        @foreach($perPageList as $raw)
                        <option @if($loop->first) selected @endif value="{{ number_format($raw) }}" class="raw-data">{{ $raw }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
            <div class="col d-flex justify-content-end">
                {{ $jadwalOperasiLists->withQueryString()->onEachSide(0)->links() }}
            </div>
        </div>
</div>
@endsection

@push('custom-script')
    <script src="{{ asset('js/globalScript.js') }}"></script>
@endpush