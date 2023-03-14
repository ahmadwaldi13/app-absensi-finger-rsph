@extends('layouts.master')

@section('title-header', 'Data Pasien Rujukan Poli')

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
                <label for="poliklinik" class="label-input">Pilih Poliklinik</label>
                <div class="button-icon-inside">
                    <input type="text" class="input-text" id="poliklinik" value="" placeholder="Masukan Nama Poliklinik" />
                    <input type="text" hidden name="poli" id="valuePoli" />
                    <span id="modalKlinik">
                        <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                    </span>
                </div>
            </div>
            <div class="col-xl-2 col-12 my-3">
                <label for="pencarianralan" class="form-label">Pencarian Keyword</label>
                <input type="text" class="form-control" id="pencarianralan" value="" placeholder="Masukkan Kata" name="search" />
                <!-- <select class="js-example-basic-multiple form-control" style="height: 10p;" multiple="multiple" name="city" id="city">
                    <option disabled value="">Masukkan Kata</option>
                    @foreach($cities as $key => $value)
                    <option value="{{ $key }}">{{ $value->nm_kab }}</option>
                    @endforeach
                </select> -->
            </div>
            <div class="col-xl-2 col-12 my-3">
                <label for="exampleFormControlInput3" class="form-label">Berdasarkan Status</label>
                <select class="form-select input-dropdown" name="status" aria-label="Default select example" id="exampleFormControlInput3">
                    <option value="">Semua</option>
                    @foreach($statuses as $items => $value)
                    <option value="{{$value}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-2 col-10 my-3">
                <label for="daterangeRalan" class="form-label">Periode Waktu</label>
                <input type="text" class="form-control input-daterange" id="daterangeRalan" placeholder="Masukkan Nama Poliklinik">
                <input type="text" hidden id="start" name="start">
                <input type="text" hidden id="end" name="end">
            </div>
            <div class="col-md-2 col-2">
                <button type="submit" id="submit" class="btn btn-primary mb-3">
                    <!-- <span class="iconify" style="font-size: 24px;" data-icon="fe:search"></span> -->
                    <img src="{{ asset('') }}icon/search.png" alt="">
                </button>
            </div>
        </div>

        <div style="overflow-x: auto; max-width: auto;">
            <table class="table border table-responsive-tablet" id="tableRawatJalan">

                <thead>
                    <tr>
                        <th class="py-4 ps-4">No Rawat</th>
                        <th class="py-4 ps-4">Kode Dokter</th>
                        <th class="py-4">Dokter Dituju</th>
                        <th class="py-4">Nama Poli</th>
                        <th class="py-4">No.RM</th>
                        <th class="py-4">Pasien</th>
                        <th class="py-4" style="text-align: center;">Jenis Bayar</th>
                        <?php if($get_user->type_user=='dokter'){ ?>
                            <th class="py-4" style="text-align: center;">Operasi/Vk</th>
                        <?php } ?>
                        <th class="py-4 pe-4" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rawatJalans as $item)
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
                        <td class="py-3 ps-4">{{ $item["no_rawat"] }}</td>
                        <td class="py-3 ps-4">{{ $item["kd_dokter"] }}</td>
                        <td class="py-3">{{ $item["nm_dokter"] }}</td>
                        <td class="py-3">{{ $item["nm_poli"] }}</td>
                        <td class="py-3">{{ $item["no_rkm_medis"] }}</td>
                        <td class="py-3">{{ $item["nm_pasien"] }}</td>
                        <td class="py-3" style="text-align: center;">{{ $item["png_jawab"] }}</td>
                        <?php if($get_user->type_user=='dokter'){ ?>
                            <td class="py-3" style="text-align: center;">{{ $check_operasi }}</td>
                        <?php } ?>
                        
                        <?php $url_tindakan_rekam_medis='tindakan-rekam-medis/rujukan-poli' ?>
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
                {{ $rawatJalans->withQueryString()->onEachSide(0)->links() }}
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" style="display: none;" id="showModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <!-- <div class="col-12> -->
                        <h5 class="modal-title mx-4 mt-4" id="exampleModalLabel">Pilih Poliklinik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <!-- </div> -->
                    </div>
                    <div class="col-10 mx-3">
                        <div class="d-flex justify-content-center align-items-center border">
                            <input type="text" class="form-control border-0" id="pencarianPoliklinik" placeholder="Masukkan kata yang akan dicari">
                            <button type="submit" class="btn btn-white">
                                <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body table-responsive pt-0">

                        <table class="table border display nowrap" id="tablePoliklinik">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-4 ps-4">Kode Unit</th>
                                    <th scope="col" class="py-4" style="width: 35%;">Nama Unit</th>
                                    <th scope="col" class="py-4">Registrasi Baru</th>
                                    <th scope="col" class="py-4 pe-4">Registrasi Lama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($poliKliniks as $key => $item) <tr>
                                    <?php
                                    $name = $item["nm_poli"];
                                    $poli = $item["kd_poli"];
                                    ?>
                                    <td class="py-3 ps-4">{{ $item["kd_poli"] }}</td>
                                    <td class="py-3"> <span class="text-primary hover-pointer" onclick="setValue('{{ $poli }}', '{{ $name }}')">{{ $name }}</span></td>
                                    <td class="py-3"><?php formatMoney($item["registrasi"]); ?></td>
                                    <td class="py-3"><?php formatMoney($item["registrasilama"]); ?></td>
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

    </form>
</div>
@endsection

@push('link-script')
<script src="{{ asset('js/rawatJalan.js') }}"></script>
@endpush