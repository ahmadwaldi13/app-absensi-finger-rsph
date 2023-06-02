@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
@include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')

@include('data-user-mesin.tab_user_mesin', ["active"=>3])

<div>
    <br>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-3 col-md-10">
                            <div class='bagan_form'>
                                <label for="ip_mesin_tujuan" class="form-label">Pilih Data Mesin Tujuan<span class="text-danger">*</span></label>
                                <div class="button-icon-inside">
                                    <input type="text" class="input-text" id='ip_mesin_tujuan' required value="" />
                                    <input type="hidden" id="id_mesin_tujuan" name="id_mesin_tujuan" value="" />
                                    <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_mesih_absensi') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#id_mesin_tujuan|#ip_mesin_tujuan|null|#nama_mesin_tujuan|#lokasi_mesin_tujuan@data-key-bagan=0@data-btn-close=#closeModalData">
                                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                    </span>
                                    <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                                </div>
                                <div class="message"></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-10">
                            <div class='bagan_form'>
                            <label for="nama_mesin_tujuan" class="form-label">Nama Mesin Tujuan</label>
                                <input type="text" class="form-control" id="nama_mesin_tujuan" readonly value="">
                                <div class="message"></div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-10">
                            <div class='bagan_form'>
                            <label for="lokasi_mesin_tujuan" class="form-label">Lokasi Mesin Tujuan</label>
                                <input type="text" class="form-control" id="lokasi_mesin_tujuan" readonly value="">
                                <div class="message"></div>
                            </div>
                        </div>
                        
                        @if( (new \App\Http\Traits\AuthFunction)->checkAkses($router_name->uri.'/update') )
                            <div class="col-lg-1 col-md-1">
                                <div class="d-grid grap-2">
                                    <button type="submit" name='proses' class="btn btn-primary" value=1>
                                        <span>Proses</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
