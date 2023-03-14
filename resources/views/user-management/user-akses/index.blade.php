@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

@section('content')
<div>
    <div class="row d-flex justify-content-between">
        <div class='bagan-data-table'>
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_level_akses" class="form-label">Level Akses</label>
                        <select id="filter_level_akses" class="form-select" name='form_level_akses' value="{{ Request::get('form_level_akses') }}">
                            <option value="">Semua Data</option>
                            @foreach ($level_akses_list as $key => $value)
                                <option value="{{ $value->alias }}" {{ Request::get('form_level_akses') == $value->alias ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-10">
                        <label for="filter_jenis_akun" class="form-label">Jenis Akun</label>
                        <select id="filter_jenis_akun" class="form-select" name='form_jenis_akun'>
                            <option value="">Semua Data</option>
                            @foreach ($jenis_akun_list as $key => $value)
                                <option value="{{ $key }}" {{ Request::get('form_jenis_akun') == $key ? 'selected' : '' }} >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control search-data-table" name='form_search_text' value="{{ Request::get('form_search_text') }}" id='form_search_text' placeholder="Masukkan Kata">
                    </div>

                    <div class="col-lg-3 col-md-10">
                    <button type="submit" id="submit" class="btn btn-primary">
                            <img src="{{ asset('') }}icon/search.png" alt="">
                        </button>
                    </div>
                </div>
            </form>

            @include('user-management.user-akses.columns')
        </div>
    </div>
</div>
@endsection

@push('link-end-1')
    <link rel="stylesheet" type="text/css" href="{{ asset('libs\datatables\1.10.11\css\jquery.dataTables.min.css' )}}">
@endpush

@push('script-end-1')
    <script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\jquery.dataTables.min.js' )}}"></script>    
@endpush