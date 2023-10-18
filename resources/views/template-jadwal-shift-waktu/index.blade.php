@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
@include('layouts.breadcrumbs')
@endsection

<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
    $nm_type_periode = (new \App\Models\RefTemplateJadwalShiftDetail())->list_type_periode(1);
?>

@section('content')

@if (!empty($url_back_index))
    <div class="text-warning">
        <a href="{{ url($url_back_index) }}" class="hover-pointer btn-back">
            <span class="hover-pointer btn-back text-warning">
                <img src="{{ asset('') }}icon/backwards.png" alt="">
                <span class="mx-2">Kembali ke Halaman Sebelumnya</span>
            </span>
        </a>    
    </div>
@endif

<hr>
<div class="row d-flex justify-content-between">
    <form action="" method="GET">
        <div class="col-lg-6">
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet">
                    <tbody>
                        <tr>
                            <td style='width: 20%; vertical-align: middle;'>Nama Shift</td>
                            <td style='width: 1%; vertical-align: middle;'>:</td>
                            <td style='width: 69%; vertical-align: middle;'>{{ !empty($item_template_shift->nm_shift) ? $item_template_shift->nm_shift : '' }}</td>
                        </tr>

                        <tr>
                            <td style='width: 20%; vertical-align: middle;'>Periode</td>
                            <td style='width: 1%; vertical-align: middle;'>:</td>
                            <td style='width: 69%; vertical-align: middle;'>
                                <div class='bagan_form'>
                                    <select class="form-select" id="data_key" name="data_key" required aria-label="Default select ">
                                        @if(!empty($get_list_template_shift_detail))
                                            @foreach($get_list_template_shift_detail as $key => $val)
                                                <?php
                                                    $model_type_periode=!empty($get_template_shift_detail->id_template_jadwal_shift_detail) ? $get_template_shift_detail->id_template_jadwal_shift_detail : '';
                                                ?>
                                                <option value='{{ $val->id_template_jadwal_shift_detail }}' {{ ($model_type_periode==$val->id_template_jadwal_shift_detail) ? 'selected' : '' }}>{{ $val->jml_periode }} hari</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="message"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="hidden" name="data_sent" value="{{ !empty($item_template_shift->id_template_jadwal_shift) ? $item_template_shift->id_template_jadwal_shift : 0 }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i><span> Ambil Data</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

<div id="bagan_data">
    @if( (new \App\Http\Traits\AuthFunction)->checkAkses($router_name->uri.'/update') )
        <div class="collapse mb-2" id="bagan-form-tambah-collapse">
            <div class="card card-body" style='background:#f2f2f2'>
                <?php
                    $parameter=[
                        'id_template_jadwal_shift_detail' => $get_template_shift_detail->id_template_jadwal_shift_detail,
                    ];

                    $bagan_form=\App::call($router_name->base_controller.'@actionUpdate',[
                        'request' => request()->merge($parameter)
                    ]);
                ?>
                @if(!empty($bagan_form))
                    {!! $bagan_form !!}
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a class="btn btn-info collapse-cus" style='color:#fff' data-bs-toggle="collapse" href="#bagan-form-tambah-collapse"
                role="button" aria-expanded="false" aria-controls="bagan-form-tambah-collapse">
                <span id='collapse-open'><i class="fa-solid fa-angles-down"></i> Buka Form Ubah</span>
                <span id='collapse-closed'><i class="fa-solid fa-angles-up"></i> Tutup Form ubah</span>
            </a>
        </div>
    @endif

    @include($router_name->path_base.'.columns')
</div>


@endsection

@push('script-end-2')
    <script src="{{ asset('js/template-jadwal-shift-waktu/index.js') }}"></script>
@endpush
