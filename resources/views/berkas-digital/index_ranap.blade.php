@extends('layouts.master')

@section('title-header', 'Berkas Digital')

<?php
function formatMoney($nominal, $currency = "")
{
    $hasil = $currency . number_format($nominal, 0, '', '.');
    echo $hasil;
}

$base_url =explode("&tab=", url()->full());
$current_url = $base_url[0];

?>
@push('link')
<script src="{{ asset('libs/jquery/3.2.1/jquery.min.js' )}}"></script>
<script src="{{ asset('libs/jquery/latest/3.2.1/jquery.min.js') }}"></script>
<script src="{{ asset('libs/moment/2.18.1/moment.min.js') }}"></script>
<script src="{{ asset('libs/daterangepicker/3.1.0/js/daterangepicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('libs/daterangepicker/3.1.0/css/daterangepicker.css') }}" />

<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script> -->
<script src="{{ asset('libs/datatables/1.10.11/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('libs/datatables/1.10.11/buttons/1.1.2/js/dataTables.buttons.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\buttons\1.1.2\js\buttons.html5.min.js' )}}"></script>
<link rel="stylesheet" href="{{ asset('libs/datatables/1.10.11/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/datatables/1.10.11/buttons/1.1.2/css/buttons.dataTables.min.css') }}">
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
    .kamera-container, .user-data{
        height:500px;
    }
 
    .user-data{
        width:400px;
        border-right: 1px solid gray;
        display: flex;
        flex-direction: column;
        justify-content:center;
        align-items:center;
        text-align:center;
    }
    #kamera{
        display:flex;
        justify-content: center;
        align-items:center
    }
    #kamera video, #kamera canvas{
        width:100%;
        height:100%;
    }
    #kamera-button{
        z-index:1;
        position:absolute;
        bottom: 0px;
        border-top:1px solid white;
        padding: 20px 0px;
        width:100%;
        display:flex;
        justify-content: center;
        align-items:center
    }
    
    #kamera-button > button{
        border-radius:50px;
        height:50px;
        width: 50px;
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
    <!-- ===== Tabs bar navigation ===== -->
    <form action="" method="GET">
        <ul class="nav nav-tabs">
            <li class="nav-item border-radius-top text-center button-tabs me-2">
                <a href="{{$current_url}}&tab=rj" class="nav-link border-radius-top tabs text-muted hover-pointer {{ ($tab == '' || $tab == 'rj') ? 'active' :'' }} " id="tabs-klinis" aria-current="page">Rawat Jalan</a>
            </li>
            <li class="nav-item border-radius-top text-center button-tabs me-2">
                <a href="{{$current_url}}&tab=ri" class="nav-link border-radius-top tabs text-muted hover-pointer {{ $tab == 'ri' ? 'active' :'' }}" id="tabs-anatomi">Rawat Inap</a>
            </li>
        </ul>
    
        <!-- =====[ Section page content ]===== -->
        <div class="card border-top-0 px-4 py-5">
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
                <div class="col-xl-2 col-12 my-3">
                    <label for="pencarianralan" class="form-label">Pencarian Keyword</label>
                    <input type="text" class="form-control" id="pencarianralan" value="" placeholder="Masukkan Kata" name="search" />
                </div>
                <div class="col-xl-2 col-12 my-3">
                    <label for="exampleFormControlInput3" class="form-label">Jenis Bayar</label>
                    <select class="form-select input-dropdown" name="penjab" aria-label="Default select example" id="exampleFormControlInput3">
                        <option value="">Semua</option>
                        @foreach ($jenisBayar as $key => $item)
                            @php
                                $selected='';
                                if(!empty($penjab_pil)){
                                    if( strtolower($penjab_pil)==strtolower($item->png_jawab) ){
                                        $selected='selected';
                                    }
                                }
                            @endphp
                            <option {{ $selected }} value="{{$item->png_jawab}}">{{$item->png_jawab}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-3 col-10 my-3">
                    <label for="daterangeRanap" class="form-label">Periode Waktu</label>
                    <input type="text" class="form-control input-daterange" id="daterangeRanap" placeholder="Masukkan Tanggal">
                    <input type="text" hidden id="start" name="start">
                    <input type="text" hidden id="end" name="end">
                </div>
                <div class="col-md-2 col-2 col">
                    <input name="tab" type="text" value="{{$tab}}" hidden>
                    <button type="submit" id="submit" class="btn btn-primary mb-3">
                        <img src="{{ asset('') }}icon/search.png" alt="">
                    </button>
                </div>
            </div>
            
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-striped table-responsive-tablet" id="tableRawatJalan">
                    <thead>
                        <tr>
                            <th span="2" class="py-4">Data Pasien</th>
                            <th span="2"  class="py-4">Data Registrasi</th>
                            <th span="2"  class="py-4">Data Kunjungan</th>
                            <th span="2"  class="py-4">Aksi dan Proses</th>
                        </tr>
                    </thead>
                    <tbody>     
                        @foreach($berkasDigital as $item) 
                        <tr {{!empty($item['no_sep']) ?'style=background:#51a159;color:#fff;'  : '' }}>
                            <td>
                                <table>
                                <tr>
                                    <td>No.Rawat</td><td>: {{ $item["no_rawat"] }}</td>
                                </tr>
                                <tr>
                                    <td>No.RM</td><td>: {{ $item["no_rkm_medis"] }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Pasien</td><td>: {{ $item["nm_pasien"] }}</td>
                                </tr>
                                <tr>
                                    <td>Umur</td><td>: {{ $item["umur"] }} {{$item["sttsumur"]}}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td><td>: {{ $item["jk"] }} </td>
                                </tr>
                                <tr>
                                    <td>Alamat Pasien</td><td>: {{ $item["alamat"] }}</td>
                                </tr>
                                </table>
                            </td>
                            <td>
                                <table>
                                <tr>
                                    <td>Tgl.Registrasi</td><td>: {{ $item["tgl_registrasi"] }} {{ $item["jam_reg"] }}  </td>
                                </tr>
                                <tr>
                                    <td>Poliklinik</td><td>: {{ $item["nm_poli"] }} </td>
                                </tr>
                                <tr>
                                    <td>Dokter</td><td>: {{ $item["nm_dokter"] }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td><td>: {{ $item["status_lanjut"] }} ({{ $item["png_jawab"] }})</td>
                                </tr>
                                <tr>
                                    <td>No. SEP</td> <td>: {{ !empty($item["no_sep"]) ? $item["no_sep"] : '-' }} </td>
                                </tr>
                                </table>
                            </td>
                            <td>
                                <table>
                                <tr>
                                    <td>No. Kunjungan</td><td>:{{ $item["no_rujukan"] }}</td>
                                </tr>
                                <tr>
                                    <td>No. Kartu</td><td>: {{ $item["no_peserta"] }}</td>
                                </tr>
                                <tr>
                                    <td>Dx. Utama</td><td>:{{ $item["kd_penyakit"] }}</td>
                                </tr>
                                </table>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                
                                    <div class="py-1 pe-4 text-primary" style="text-align: center;">
                                        <a href="{{ url('/') }}/berkas-digital/data-klaim?no_rawat={{ $item['no_rawat'] }}&no_rm={{ $item['no_rkm_medis'] }}&fr=ri" target="_blank" class="btn btn-primary">Lihat Data Klaim</a>
                                    </div>
                                    <div class="py-1 pe-4 text-primary" style="text-align: center;">
                                        <a onclick='UnggahBerkas(<?=json_encode($item)?>)' class="btn btn-primary">Unggah Berkas Pasien</a>
                                    </div>
                                </div>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="d-flex flex-row align-items-center"></div>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-end">
                        {{ $berkasDigital->withQueryString()->onEachSide(0)->links() }}
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
        </div>
    </form>
    <!-- Modal Unggah Berkas -->
    <x-berkas-digital.upload-file-modal :berkasList="$berkas_list"/>

</div>
@endsection

@push('link-script')
<script src="{{ asset('js/rawatInap.js') }}"></script>
<script src="{{ asset('js/berkasDigital/berkasDigital.js') }}"></script>
@endpush