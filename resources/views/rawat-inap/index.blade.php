@extends('layouts.master')

@section('title-header', 'Data Pasien Rawat Inap')

<?php

function formatMoney($nominal, $currency = "")
{
    $hasil = $currency . number_format($nominal, 0, '', '.');
    echo $hasil;
}

$get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>

@push('link')
<script type="text/javascript" src="{{ asset('libs\jquery\latest\jquery.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\jquery\latest\moment.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\daterangepicker\3.1.0\js\daterangepicker.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs\daterangepicker\3.1.0\css\daterangepicker.css' )}}" />

<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script> -->
<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\jquery.dataTables.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\dataTables.buttons.min.js' )}}"></script>

<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\buttons\1.1.2\js\buttons.html5.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs\datatables\1.10.11\css\jquery.dataTables.min.css' )}}">
<link rel="stylesheet" type="text/css" href="{{ asset('libs\datatables\1.10.11\buttons\1.1.2\css\buttons.dataTables.min.css' )}}">
@endpush

@push('custom-style')
<style>
    a {
        text-decoration: none;
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

    .current {
        background-color: #3B95FF !important;
        color: #ffffff !important;
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

    .select2-container .select2-selection--multiple {
        min-height: 37px;
        border-radius: 2px;
        border: 1px solid #ced4da;
    }

    .select2-search__field::placeholder {
        font-family: "Poppins", sans-serif !important;
    }

    .hide {
        display: none !important;
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
                <label for="kamar" class="label-input mb-2">Pilih Kamar</label>
                <div class="button-icon-inside">
                    <input type="text" class="input-text" id="kamar" placeholder="Masukan Nama Kamar" />
                    <input type="hidden" name="room" id="valueRoom" />
                    <span id="modalKamar">
                        <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                    </span>
                </div>
            </div>
            <div class="col-xl-3 col-12 my-3">
                <label for="pencarianranap" class="form-label">Pencarian Keyword</label>
                <input type="text" class="form-control" id="pencarianranap" placeholder="Pencarian" name="search" value="" />
            </div>
            <div class="col-xl-5 col-12 my-3">
                <div class="row d-flex align-items-end">
                    <div class="col-md-4 my-3">
                        <label for="daterangeRanap" class="form-label">Periode Waktu</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ranap-radio filter-waktu-bp" {{ ($kondisi_waktu==1) ? 'checked' : '' }} type="radio" name="kondisi_waktu" id="inlineRadio1" value="1">
                            <label class="form-check-label ps-1" for="inlineRadio1">Belum Pulang</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ranap-radio" {{ ($kondisi_waktu==2) ? 'checked' : '' }} type="radio" name="kondisi_waktu" id="inlineRadio2" value="2">
                            <label class="form-check-label ps-1" for="inlineRadio2">Tgl.Masuk</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ranap-radio" {{ ($kondisi_waktu==3) ? 'checked' : '' }} type="radio" name="kondisi_waktu" id="inlineRadio3" value="3">
                            <label class="form-check-label ps-1" for="inlineRadio3">Pulang</label>
                        </div>
                        <div class='input-date-range-bagan my-1'>
                            <input type="text" class="form-control input-daterange input-date-range" id='filter-waktu' placeholder="Tanggal">
                            <input type="text" hidden name="form_start" id="tgl_start" value="{{ !empty($tanggal_filter[0]) ? $tanggal_filter[0] : date('Y-m-d') }}">
                            <input type="text" hidden name="form_end" id="tgl_end" value="{{ !empty($tanggal_filter[1]) ? $tanggal_filter[1] : date('Y-m-d') }}">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-1 col-1 my-1">
                <button type="submit" class="btn btn-primary mb-3">
                    <!-- <span class="iconify" style="font-size: 24px;" data-icon="fe:search"></span> -->
                    <img src="{{ asset('') }}icon/search.png" alt="">
                </button>
            </div>
        </div>
    </form>

    <div style="overflow-x: auto; max-width: auto;">
        <table class="table border table-responsive-tablet" id="tableRawatInap">
            <thead>
                <tr>
                    <!-- <th class="py-4 ps-4">Kode Dokter</th> -->
                    <th class="py-4">No.Rawat</th>
                    <th class="py-4">No.RM</th>
                    <th class="py-4">Dokter P.J</th>
                    <th class="py-4">Pasien</th>
                    <th class="py-4">Kamar</th>
                    <th class="py-4" style="text-align: center;">Jenis Bayar</th>
                    <th class="py-4">Status Pulang</th>
                    <?php if($get_user->type_user=='dokter'){ ?>
                        <th class="py-4" style="text-align: center;">Operasi/Vk</th>
                    <?php } ?>
                    <th class="py-4 pe-4" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rawatInaps as $item)
                @php
                    $dokter_pj=!empty($item_dr_pj[$item->no_rawat]) ? $item_dr_pj[$item->no_rawat] : '';
                @endphp
                <?php
                    $dty_pasien_dokter = !empty($item->tindakan_pasien) ? $item->tindakan_pasien : '';
                    $dty_pasien_perawat = !empty($item->tindakan_pasien_perawat) ? '-'.$item->tindakan_pasien_perawat : '';

                    $dty_pasien = $dty_pasien_dokter.$dty_pasien_perawat;
                    $dty_pasien_exp = !empty($dty_pasien) ? explode('-', $dty_pasien) : 0;
                    $jlh_tindakan = 0;
                    if (!empty($dty_pasien_exp)) {
                        $jlh_tindakan = array_sum($dty_pasien_exp);
                    }
                    $style_tr = !empty($jlh_tindakan) ? "style=background:#51a159;color:#fff;" : '';
                    if($item->tindakan_pasien_perawat == "1" && empty($item->tindakan_pasien) ){
                        $style_tr = !empty($jlh_tindakan) ? "style=background:#e8d610;color:#555;" : '';
                    }
                    $style_link = !empty($jlh_tindakan) ? "style=color:#fff;text-decoration:revert;" : '';

                    $check_operasi=!empty($norawat_operasi[$item["no_rawat"]]) ? $norawat_operasi[$item["no_rawat"]] : '';
                    ?>
                    <tr {{ $style_tr }}>
                        <td class="py-3">{{ $item["no_rawat"] }}</td>
                        <td class="py-3">{{ $item["no_rkm_medis"] }}</td>
                        <td class="py-3">{{ $dokter_pj }}</td>
                        <td class="py-3">{{ $item["nm_pasien"] }}</td>
                        <!-- <td class="py-3">{{ $item["nm_bangsal"] }}</td> -->
                        <td class="py-3">{{ $item["kamar"] }}</td>
                        <td class="py-3" style="text-align: center;">{{ $item["png_jawab"] }}</td>
                        <td class="py-3">{{ $item["stts_pulang"] }}</td>
                        <?php if($get_user->type_user=='dokter'){ ?>
                            <td class="py-3" style="text-align: center;">{{ $check_operasi }}</td>
                        <?php } ?>
                        
                        <?php $url_tindakan_rekam_medis='tindakan-rekam-medis/ranap' ?>
                        @if( (new \App\Http\Traits\AuthFunction)->checkAkses($url_tindakan_rekam_medis) )
                            <?php 
                                $parameter_tindakan=[
                                    'no_rm'=>$item['no_rkm_medis'],
                                    'no_rawat'=>$item['no_rawat'],
                                    'fr'=>'rj',
                                ];
                                $url_tindakan_rekam_medis=(new \App\Http\Traits\GlobalFunction)->set_paramter_url($url_tindakan_rekam_medis,$parameter_tindakan);
                            ?>
                            <td class="py-3 pe-4 text-primary" style="text-align: center;"> <a {{ $style_link }} href="{{ url($url_tindakan_rekam_medis) }}" class="tindakanRj">Tindakan dan Pemeriksaan</a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-end">
            {{ $rawatInaps->withQueryString()->onEachSide(0)->links() }}
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" style="display: none;" id="showModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="col-10">
                        <div class="d-flex justify-content-center align-items-center border">
                            <input type="text" class="form-control border-0" id="pencarianKamar" placeholder="Masukkan kata yang akan dicari">
                            <button type="submit" class="btn btn-white">
                                <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive pt-0">
                    <table class="table border display nowrap" id="tableKamar">
                        <thead>
                            <tr>
                                <th scope="col" class="py-4 ps-4">Kode Kamar</th>
                                <th scope="col" class="py-4 pe-4">Nama Kamar</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($bansals as $key => $item) <tr>
                                <?php
                                $name = $item["nm_bangsal"];
                                $room = $item["kd_bangsal"];
                                ?>
                                <td class="py-3 ps-4">{{ $item["kd_bangsal"] }}</td>
                                <td class="py-3"> <span class="text-primary hover-pointer" onclick="setValue('{{ $room }}', '{{ $name }}')">{{ $name }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer" style="display: none;">
                    <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('link-script')
<script src="{{ asset('js/globalScript.js') }}"></script>
<script src="{{ asset('js/rawatInap.js') }}"></script>
@endpush