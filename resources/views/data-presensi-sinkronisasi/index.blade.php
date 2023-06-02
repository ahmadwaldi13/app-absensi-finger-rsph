@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
@include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')

@include('data-presensi.tab_user_presensi', ["active"=>1])

<div>
    <br>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <div class='bagan_form'>
                            <label for="filter_ip_mesin" class="form-label">Pilih Data Mesin <span class="text-danger">*</span></label>
                            <div class="button-icon-inside">
                                <input type="text" class="input-text" id='filter_ip_mesin' required value="{{ !empty($data_mesin->ip_address) ? $data_mesin->ip_address : '' }}" />
                                <input type="hidden" id="filter_id_mesin" name="filter_id_mesin" value="{{ Request::get('filter_id_mesin') }}" />
                                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_mesih_absensi') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_id_mesin|#filter_ip_mesin|null|#filter_nama_mesin|#filter_lokasi_mesin@data-key-bagan=0@data-btn-close=#closeModalData">
                                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                </span>
                                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                            </div>
                            <div class="message"></div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-10">
                        <div class='bagan_form'>
                        <label for="filter_nama_mesin" class="form-label">Nama Mesin</label>
                            <input type="text" class="form-control" id="filter_nama_mesin" readonly value="{{ !empty($data_mesin->nm_mesin) ? $data_mesin->nm_mesin : '' }}">
                            <div class="message"></div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-10">
                        <div class='bagan_form'>
                        <label for="filter_lokasi_mesin" class="form-label">Lokasi Mesin</label>
                            <input type="text" class="form-control" id="filter_lokasi_mesin" readonly value="{{ !empty($data_mesin->lokasi_mesin) ? $data_mesin->lokasi_mesin : '' }}">
                            <div class="message"></div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-1">
                        <div class="d-grid grap-2">
                            <button type="submit" name='searchbymesin' class="btn btn-primary" value=1>
                                <i class="fa-solid fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include($router_name->path_base.'.columns')

@endsection
