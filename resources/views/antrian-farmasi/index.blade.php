@extends('layouts.master')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

<?php
function formatmoney($nominal, $currency = "")
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
<script>
    var base_url = "{{url('/')}}/";
</script>
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
        background-color: #3b95ff !important;
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
        font-family: "poppins", sans-serif !important;
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
<hr class="mt-2">
<div>
    <form action="" method="GET">
        <ul class="nav nav-tabs">
            <li class="nav-item border-radius-top text-center button-tabs me-2">

                <a href="{{$current_url}}&tab=rj" class="nav-link border-radius-top tabs text-muted hover-pointer {{ ($tab == '' || $tab == 'rj') ? 'active' :'' }} "  id="tabs-klinis" aria-current="page">rawat jalan</a>
            </li>
            <li class="nav-item border-radius-top text-center button-tabs me-2">
                <a href="{{$current_url}}&tab=ri" class="nav-link border-radius-top tabs text-muted hover-pointer {{ $tab == 'ri' ? 'active' :'' }} "  id="tabs-anatomi" >rawat inap</a  >
            </li>
        </ul>
        <div class="row d-flex align-items-end">
            <div class="col-xl-3 col-12 my-3">
                <label for="poliklinik" class="label-input">Pilih Poliklinik</label>
                <div class="d-flex">
                    <input type="text" class="input-text" id="poliklinik" value="" placeholder="Masukan Nama Poliklinik" />
                    <input type="text" hidden name="poli" id="valuePoli" />
                    <button type="button" id="showModal" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                    </button>
                </div>
            </div>
            <div class="col-xl-2 col-12 my-3">
                <label for="pencarianralan" class="form-label">pencarian keyword</label>
                <input type="text" class="form-control" id="pencarianralan" value="" placeholder="masukkan kata" name="search" />
            </div>
            <div class="col-xl-2 col-10 my-3">
                <label for="dateRange" class="form-label">periode waktu</label>
                <input type="text" class="form-control input-daterange" id="dateRange" placeholder="masukkan nama poliklinik">
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
            <table class="table border table-responsive-tablet" id="tabelAntrianFarmasi">
                <thead>
                    <tr>
                        <th span="2" class="py-4">pasien</th>
                        <th span="2"  class="py-4">poli</th>
                        <th span="2"  class="py-4">dokter</th>
                        <th span="2"  class="py-4">no resep</th>
                        <th span="2"  class="py-4">tanggal verifikasi</th>
                        <th class="py-4">loket</th>
                        <th class="py-4">panggil</th>
                        <th class="py-4  pe-4">penyerahan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @include('antrian-farmasi.components.table') --}}
                    @foreach($data_antrian as $item)
                    <?php $item = (array)$item; ?>
                    <tr>
                        <td class="py-3 ps-4"><span>{{ $item["no_rawat"] }}</span> <span class="p-2" id="p-{{$item['no_resep']}}-nm_pasien" contenteditable="true">{{ ucwords(strtolower($item["nm_pasien"])) }}</span></td>
                        <td id="p-{{$item['no_resep']}}-from" class="py-3">{{ $item["nm_poli"] }}</td>
                        <td class="py-3">{{ $item["nm_dokter"] }}</td>
                        <td class="py-3">{{ $item["no_resep"] }}</td>
                        <td class="py-3">{{ $item["tgl_perawatan"] }}</td>
                        <td class="py-3">
                            <select id="p-{{$item['no_resep']}}-konter_no" class="form-select" aria-label="Default select example">
                                <option {{count($konters) > 1 ? 'selected': ''}}>Pilih No</option>
                                @foreach($konters as $konter)
                                <option {{count($konters) > 1 ? '': 'selected'}} value="{{$konter['konter_no']}}">{{$konter['konter_no']}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="py-3 pe-4 text-primary" style="text-align: center;">
                                <button id="speak" type="button" class="btn btn-primary" onclick="getPasien('p-{{$item['no_resep']}}')">
                                Panggil
                                </button>
                                <button id="cancel_speak" type="button" class="btn btn-danger d-none" onclick="stopSpeak('p-{{$item['no_resep']}}')">
                                    Stop
                                </button>
                        </td>
                        <td class="py-3 pe-4 text-primary" style="text-align: center;">
                            <button type="button" onclick='PenyerahanResep(<?=json_encode($item)?>)' class="btn btn-success buttonModalPenyerahan">
                                Penyerahan
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="d-flex flex-row align-items-center"></div>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                {{ $data_antrian->withQueryString()->onEachSide(0)->links() }}
            </div>
        </div>

        <!-- Modal Poliklinik -->
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
                        </div>
                    </div>
                    <div class="modal-body table-responsive pt-0">

                        <table class="table border display nowrap" id="tablePoliklinik">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-4 ps-4">Kode Unit</th>
                                    <th scope="col" class="py-4" style="width: 35%;">Nama Unit</th>
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

        <!-- Modal Penyerahan -->
    </form>
    <div class="modal fade " id="modalPenyerahan" tabindex="-1" aria-labelledby="modalPenyerahanLabel" aria-hidden="true">
        <form id="modalPenyerahanForm" action="{{url('/antrian-farmasi-petugas/penyerahan-resep')}}" method="post" class="modal-dialog modal-dialog-centered modal-lg">
                @csrf
                <input type="hidden" id="patient_data" name="patient_data" value="">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title mx-4" id="modalPenyerahanLabel">Penyerahan Resep Obat Rawat Jalan</h5>
                        <button type="button" class="btn-close closePenyerahanLabel" ></button>
                    </div>
                    <div class="modal-body text-center">
                        <table class="table border ">
                            <thead>
                                <tr>
                                    <th span="2" class="py-4">No Rawat</th>
                                    <th span="2"  class="py-4">Nama Pasien</th>
                                    <th span="2"  class="py-4">No Resep</th>
                                    <th span="2"  class="py-4">Poli</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="pyrh-nrwt" class="py-3"></td>
                                    <td id="pyrh-nm" class="py-3"></td>
                                    <td id="pyrh-nrsp" class="py-3"></td>
                                    <td id="pyrh-np" class="py-3"></td>
                                </tr>
                            </tbody>
                        </table>
                        <p>Anda yakin ingin menyerahkan obat ke pasien ini</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="closePenyerahanLabel btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="submitPenyerahanResep" class="btn btn-primary">Ya</button>
                    </div>
                </div>
        </form>
    </div>
    
</div>

@endsection

@push('link-script')
<script src="{{ asset('js/antrian_farmasi/antrian_farmasi.js') }}"></script>
<script src="{{ asset('js/antrian_farmasi/antrian_farmasi_ralan.js') }}"></script>
<script src="{{ asset('js/antrian_farmasi/responsiveVoice.js') }}"></script>
@endpush