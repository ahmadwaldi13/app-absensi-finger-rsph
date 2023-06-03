@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
@include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')

@include('absensi-karyawan.tab_absensi', ["active"=>1])

<div>
    <br>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <div class='input-date-bagan'>
                            <label for="tanggal" class="form-label">Tanggal : <span class="text-danger">*</span></label>
                            <span class='icon-bagan-date'></span>
                            <input type="text" class='tgl_me form-control input-date' id="tgl" required name="tanggal" value="{{ !empty($tanggal_filter) ? $tanggal_filter : date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-1">
                        <div class="d-grid grap-2">
                            <button type="submit" name='search' id='proses' class="btn btn-primary" value=1>
                                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <?php
                    $url_get_mesin=$router_name->uri.'/ajax?action=get_data_mesin'; 
                    $url_proses=$router_name->uri.'/ajax?action=get_data_log'; 
                ?>
                <input type="hidden" id='url_get_mesin' value='{{ $url_get_mesin }}'>
                <input type="hidden" id='url_proses' value='{{ $url_proses }}'>
                
                <div id='progress-item'>
                    
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script-end-2')
    <script src="{{ asset('js/tarik-data-absensi-karyawan/form.js') }}"></script>
@endpush