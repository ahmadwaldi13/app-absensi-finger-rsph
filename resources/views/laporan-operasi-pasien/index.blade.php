@extends('layouts.master')

@section('breadcrumbs')
    @include('layouts.breadcrumbs_dokter_petugas')
@endsection

<?php
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
?>


@push('link')
<script type="text/javascript" src="{{ asset('libs/jquery/latest/3.2.1/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/moment/2.18.1/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/daterangepicker/3.1.0/js/daterangepicker.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs/daterangepicker/3.1.0/css/daterangepicker.css') }}" />

<script type="text/javascript" src="{{ asset('libs/datatables/1.10.11/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/datatables/1.10.11/buttons/1.1.2/js/dataTables.buttons.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\buttons\1.1.2\js\buttons.html5.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/1.10.11/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/1.10.11/buttons/1.1.2/css/buttons.dataTables.min.css') }}">

<link href="{{ asset('libs/select2/4.1.0/css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('libs/select2/4.1.0/js/select2.min.js') }}"></script>
@endpush

@push('custom-style')
@endpush

@section('content')
<div id="isi-cppt">
    <div class="card p-3 pb-5">
        <form action="" method="GET">
            <input type="hidden"  name="no_rawat" value="{{ $item_pasien->no_rawat }}">
            <input type="hidden"  name="no_rm" value="{{ $item_pasien->no_rm }}">
            <input type="hidden"  name="fr" value="{{ $item_pasien->no_fr }}">

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-2 mb-3">
                    <div class='bagan_form'>
                        <label for="norawat" class="form-label">No.Rawat</label>
                        <input type="text" class="form-control" id="norawat" readonly disabled required  value="{{ !empty($item_pasien->no_rawat) ? $item_pasien->no_rawat : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 mb-3">
                    <div class='bagan_form'>
                        <input type="text" class="form-control " id="name" readonly disabled required  value="{{ !empty($data_pasien->no_rkm_medis) ? $data_pasien->no_rkm_medis : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <input type="text" class="form-control " readonly disabled required value="{{ !empty($data_pasien->nm_pasien) ? $data_pasien->nm_pasien : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-10 my-3">
                    <label for="tgl_rawat" class="form-label">Tanggal Operasi</label>
                    <div class='input-date-range-bagan'>
                        <input type="text" class="form-control input-daterange input-date-range" id="tgl_rawat" placeholder="Tanggal">
                        <input type="hidden" id="tgl_start" name="form_filter_start" value="{{ !empty($item_pasien->filter_start) ? $item_pasien->filter_start : Request::get('form_filter_start') }}">
                        <input type="hidden" id="tgl_end" name="form_filter_end" value="{{ !empty($item_pasien->filter_end) ? $item_pasien->filter_end : Request::get('form_filter_end') }}">
                    </div>
                </div>

                <div class="col-md-1 my-3">
                    <div class="d-grid grap-2">
                        <button type="submit" class="btn btn-primary">
                            <!-- <span class="iconify" style="font-size: 24px;" data-icon="fe:search"></span> -->
                            <img src="{{ asset('') }}icon/search.png" alt="">
                        </button>
                    </div>
                </div>
            </div>

            <div class="row justify-content-start align-items-end mb-3">

            </div>
        </form>

        <div style="overflow-x: auto; max-width: auto;">
            <table class="table border table-responsive-tablet">
                <thead>
                    <tr>
                        <th class="py-3" style="width: 15%">Tgl.Operasi</th>
                        <th class="py-3" style="width: 7%;">No.Rawat</th>
                        <th class="py-3" style="width: 20%;">Nama Pasien</th>
                        <th class="py-3" style="width: 15%;">Jenis.Ans</th>
                        <th class="py-3" style="width: 15%;">Perawatan</th>
                        <th colspan='2' class="py-6 text-center" style="width: 15%;"></th>
                    </tr>
                </thead>
                <tbody data-jml="">
                    @if(!empty($data_list))
                        @foreach($data_list as $item)
                            <?php
                                $kode_tanggal=strtotime($item->tgl_operasi);
                                $kode=$item_pasien->no_fr.'@'.$item->no_rawat.'@'.$item->no_rkm_medis.'@'.$kode_tanggal;
                                $check_akses=(new \App\Http\Traits\GlobalFunction)->check_akses($item->operator1);
                            ?>
                            <tr>
                                <td class="py-3 px-0">{{ !empty($item->tgl_operasi) ? $item->tgl_operasi : '' }}</td>
                                <td class="py-3">{{ !empty($item->no_rawat) ? $item->no_rawat : '' }}</td>
                                <td class="py-3">{{ !empty($item->no_rkm_medis) ? $item->no_rkm_medis : '' }} {{ !empty($item->nm_pasien) ? $item->nm_pasien : '' }}</td>
                                <td class="py-3">{{ !empty($item->jenis_anasthesi) ? $item->jenis_anasthesi : '' }}</td>
                                <td class="py-3">{{ !empty($item->item_paket) ? $item->item_paket : '' }}</td>
                                <td class="py-3">
                                    <a href="{{ url('operasi-vk/view') }}" class='modal-remote' data-modal-width='80%' data-modal-key='{{ $kode }}' data-modal-title='View Laporan Operasi/VK'>
                                        <img src="{{ asset('') }}icon/info.png" alt="">&nbsp;
                                    </a>
                                    @if($check_akses)
                                        <a href="{{ url('operasi-vk/form-laporan-operasi') }}" class='modal-remote' data-modal-width='80%' data-modal-key='{{ $kode }}' data-modal-title='Laporan Operasi'>
                                            <!-- <span class="iconify text-primary" style="font-size: 28px;" data-icon="bx:bxs-info-circle"></span> -->
                                            <img src="{{ asset('') }}icon/edit.png" alt="">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @if(!empty($data_list_detail[$item->no_rawat][$item->no_rkm_medis][$item->tgl_operasi]))
                                <?php
                                    $get_list_detail=$data_list_detail[$item->no_rawat][$item->no_rkm_medis][$item->tgl_operasi];
                                ?>
                                <tr>
                                    <td colspan=10>
                                        <div style="overflow-x: auto; max-width: auto;">
                                            <table class="table border table-responsive-tablet" style='background:#e9e9e9'>
                                                <thead>
                                                    <tr>
                                                        <th class="py-3" style="width: 15%">Perawatan</th>
                                                        <th class="py-3" style="width: 15%">Operator 1</th>
                                                        <th class="py-3" style="width: 15%">Operator 2</th>
                                                        <th class="py-3" style="width: 15%">Operator 3</th>
                                                        <th class="py-3" style="width: 15%">Asisten Operator 1</th>
                                                        <th class="py-3" style="width: 15%">Asisten Operator 2</th>
                                                        <th class="py-3" style="width: 15%">Asisten Operator 3</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($get_list_detail as $item_detail)
                                                        <tr>
                                                            <td>{{ !empty($item_detail->nm_perawatan) ? $item_detail->nm_perawatan : '-' }}</td>
                                                            <td>{{ !empty($item_detail->nm_operator1) ? $item_detail->nm_operator1 : '-' }}</td>
                                                            <td>{{ !empty($item_detail->nm_operator2) ? $item_detail->nm_operator2 : '-' }}</td>
                                                            <td>{{ !empty($item_detail->nm_operator3) ? $item_detail->nm_operator3 : '-' }}</td>
                                                            <td>{{ !empty($item_detail->nm_asisten_operator1) ? $item_detail->nm_asisten_operator1 : '-' }}</td>
                                                            <td>{{ !empty($item_detail->nm_asisten_operator2) ? $item_detail->nm_asisten_operator2 : '-' }}</td>
                                                            <td>{{ !empty($item_detail->nm_asisten_operator3) ? $item_detail->nm_asisten_operator3 : '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @if(!empty($data_list))
            <div class="row">
                <div class="col-12 col-md-12 d-flex justify-content-end">
                    {{ $data_list->withQueryString()->onEachSide(0)->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

@endsection

@push('link-script')
    <script src="{{ asset('js/globalScript.js') }}"></script>
@endpush