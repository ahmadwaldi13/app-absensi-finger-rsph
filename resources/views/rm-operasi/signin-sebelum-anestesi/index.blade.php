@extends('layouts.master2')
@section('title-header', '')
@section('breadcrumbs')
    @include('layouts.breadcrumbs_dokter_petugas')
@endsection


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
    }
</style>
@endpush

@section('content')
    <div>
        @include('layouts.tab_rmoperasi',['active'=>2])
        <div class="card border-top-0 px-4 py-5">
            @include('rm-operasi.signin-sebelum-anestesi.form')
            @include('rm-operasi.columns',["list_data"=> $penilaian,
            "base_route"=>$base_route])
        </div>
    </div>
@endsection
