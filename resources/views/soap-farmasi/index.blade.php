@extends('layouts.master')

@section('title-header', '')

@section('breadcrumbs')
@include('layouts.breadcrumbs_dokter_petugas')
@endsection

    

<?php
$get_user = (new \App\Http\Traits\AuthFunction)->getUser();
$item_pasien = (new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));


$link_param = [
    'no_rawat' => (!empty($item_pasien->no_rawat) ? $item_pasien->no_rawat : ''),
    'no_rm' => (!empty($item_pasien->no_rm) ? $item_pasien->no_rm : ''),
    'fr' => (!empty($item_pasien->no_fr) ? $item_pasien->no_fr : ''),
];

?>

@push('custom-style')
<style>
    .nav-tabs {
        border-radius: 10px 10px 0px 0px !important;
    }

    .border-radius-top {
        border-radius: 10px 10px 0px 0px !important;
    }

    .input-daterange {
        background-image: url("{{ asset('icon/date.png') }}");
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

    input.form-control {
        background-color: #FCFCFD !important;
    }

    /* Customize modal box */
    @media (min-width: 1200px) {
        div.modal-xl {
            max-width: 1540px !important;
        }
    }

    @media (min-width: 992px) {
        div.modal-xl {
            max-width: 1340px !important;
        }
    }
</style>
@endpush

@push('link')
<script type="text/javascript" src="{{ asset('libs\jquery\latest\jquery.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\jquery\latest\moment.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\daterangepicker\3.1.0\js\daterangepicker.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs\daterangepicker\3.1.0\css\daterangepicker.css' )}}" />

<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\jquery.dataTables.min.js' )}}"></script>
<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\js\dataTables.buttons.min.js' )}}"></script>

<script type="text/javascript" src="{{ asset('libs\datatables\1.10.11\buttons\1.1.2\js\buttons.html5.min.js' )}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs\datatables\1.10.11\css\jquery.dataTables.min.css' )}}">
<link rel="stylesheet" type="text/css" href="{{ asset('libs\datatables\1.10.11\buttons\1.1.2\css\buttons.dataTables.min.css' )}}">
@endpush

@section('content')
<div>
    <div id="soap-farmasi">
        <ul class="nav nav-tabs">
            <li class="nav-item border-radius-top text-center" style="width: 240px; background-color: #F5F5F5;">
                <a class="nav-link hover-pointer border-radius-top tabs text-muted active" id="tabs-soap" href="{{ (new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('soal-farmasi')) }}">SOAP Farmasi</a>
            </li>
        </ul>
        </div>
            <div id="soap-farmasi">
                @if ($item_pasien->no_fr=='ri')
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success px-4 my-2" href="riwayat-pasien/detail?no_rm={{Request::get('no_rm')}}&fr={{Request::get('fr')}}&semua=true" target="_blank">Lihat Riwayat Pasien</a>
                </div>
                <?php if( (new \App\Http\Traits\AuthFunction)->checkAkses('soap-farmasi/create') ){ ?>
                    <form action="{{ $action_form }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
                        @csrf
                        <input type="text" value="{{ !empty($model->fr) ? $model->fr : $item_pasien->no_fr }}" hidden name="fr">
                        <input type="text" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }}" hidden name="no_rm">
                        <div class="row justify-content-start align-items-end">
                            <div class="col-lg-2 mb-3 mt-3">
                                <label for="norawat" class="form-label">No.Rawat</label>
                                <input type="text" class="form-control" id="norawat" readonly required name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : $item_pasien->no_rawat }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }} {{ $dataPasien['nm_pasien'] }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="daterange" class="form-label">Tanggal Pemeriksaan : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-daterange" required id="daterange" autocomplete="off">
                                <input type="text" hidden id="tgl" required name="tgl_perawatan">
                                <input type="text" hidden id="jam" required name="jam_rawat">
                            </div>
                        </div>
                        {{-- @php
                            dd($get_user);
                        @endphp --}}
                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-4 mb-3">
                                <label for="kodeDokter" class="form-label">Dilakukan</label>
                                <input type="text" aria-label=" input kodeDokter" readonly  class="form-control readonly" id="nik" name="nik" value="{{$get_user->pegawai?$get_user->pegawai['nik']:''}}">
                            </div>
                            <div class="col-lg-8 mb-3">
                                <div class="button-icon-inside d-flex justify-content-between pe-4">
                                    {{-- <div class="col-10"> --}}
                                        <input type="text" readonly class="input-text" id="namaPetugas" value="{{$get_user->pegawai?$get_user->pegawai['nama']:''}}"/>
                                    {{-- </div> --}}
                                    {{-- <span  class="modal-remote-data col-2 text-end" data-modal-src="{{ url('ajax?action=get_list_pegawai') }}" data-modal-key="{{ $model->fr.'@'.$model->no_rawat }}" data-modal-pencarian='true' data-modal-title='daftar petugas' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nik|#namaPetugas@data-btn-close=#closeModalData">
                                        <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                                    </span> --}}
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4"> 

                        {{-- @php
                        dd($model);
                    @endphp --}}
                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-6 mb-3">
                                <label for="subjek" class="form-label">Subjek :<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="subjek" name="subjek" rows="3" required>{{ !empty($model->subjek) ? $model->subjek : '' }}</textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="objek" class="form-label">Objek :<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="objek" name="objek" rows="3" required>{{ !empty($model->objek) ? $model->objek : '' }}</textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="asesmen" class="form-label">Assessment : <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="assessment" rows="3" required name="assessment">{{ !empty($model->assessment) ? $model->assessment : '' }}</textarea>
                            </div>
                            
                            <div class="col-lg-6 mb-3">
                                <label for="plan" class="form-label">Plan :</label>
                                <textarea class="form-control" id="plan" rows="3" name="plan">{{ !empty($model->plan) ? $model->plan : '' }}</textarea>
                            </div>
                        </div>

                        
                        <div class="row justify-content-start align-items-end table-responsive">
                            <div class="col-lg-2 mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>

                    </form>
                <?php } ?>

                <div class="mt-5">
                    <form action="{{ $action_form }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
                        <input type="hidden" name="no_rawat" value="{{ $item_pasien->no_rawat }}">
                        <input type="hidden" name="no_rm" value="{{ $item_pasien->no_rm }}">
                        <input type="hidden" name="tab" value="{{ Request::get('tab') }}">
                        <input type="hidden" name="fr" value="{{ $item_pasien->no_fr }}">

                        <div class="row justify-content-start align-items-end mb-3">
                            <div class="col-lg-4 col-md-10 my-2">
                                <label for="tgl_rawat" class="form-label">Tanggal Pemeriksaan</label>
                                <div class='input-date-range-bagan'>
                                    <input type="text" class="form-control input-daterange input-date-range" id="tgl_rawat" placeholder="Tanggal">
                                    <input type="hidden" id="tgl_start" name="form_filter_start" value="{{ !empty($item_pasien->filter_start) ? $item_pasien->filter_start : Request::get('form_filter_start') }}">
                                    <input type="hidden" id="tgl_end" name="form_filter_end" value="{{ !empty($item_pasien->filter_end) ? $item_pasien->filter_end : Request::get('form_filter_end') }}">
                                </div>
                            </div>

                            <div class="col-md-1 my-2">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        <!-- <span class="iconify" style="font-size: 24px;" data-icon="fe:search"></span> -->
                                        <img src="{{ asset('') }}icon/search.png" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div style="overflow-x: auto; max-width: auto;">
                        <table class="table border table-responsive-tablet">
                            <thead>
                                <tr>
                                    <th class="py-3" style="width: 8%">No Rawat</th>
                                    <th class="py-3" style="width: 5%;">No.RM</th>
                                    <th class="py-3" style="width: 15%;">Nama Pasien</th>
                                    <th class="py-3" style="width: 9%;">Tgl.Pemeriksaan</th>
                                    <th class="py-3" style="width: 9%;">Jam</th>
                                    <th class="py-3" style="width: 15%;">Subjek</th>
                                    <th class="py-3" style="width: 15%;">Objek</th>
                                    <th class="py-3 text-center" style="width: 18%;">Action</th>
                                </tr>
                            </thead>
                            <tbody data-jml="{{ count($list) }}">
                                @foreach($list as $key => $item)
                                <?php
                                $kode = $item_pasien->no_fr . '@' . $item['no_rawat'] . '@' . date('Y-m-d',strtotime($item->created_at)) . '@' . date('H:i:s',strtotime($item->created_at)) . '@' . $item_pasien->no_rm . '@' . $item['id_soap_farmasi'];
                                $kode_lama = '@' . $item_pasien->no_rawat . '$$' . $item_pasien->no_rm;
                                ?>
                                <tr>
                                    <td>{{$item["no_rawat"]}}</td>
                                    <td>{{$item["no_rkm_medis"]}}</td>
                                    <td>{{$item["nm_pasien"]}}</td>
                                    
                                    <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                                    <td>{{date('H:i',strtotime($item->created_at))}}</td>
                                    <td>{{$item->subjek}}</td>
                                    <td>{!! str_replace("\n","<br/>",$item->objek) !!}</td>
                                    <td class="text-center">
                                        <a href='soap-farmasi/view' class='modal-remote btn btn-primary' data-modal-key='{{ $kode }}' data-modal-title='View SOAP Farmasi'>
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href='soap-farmasi/form_update' class='modal-remote modal-edit btn btn-warning' data-modal-row="{{ $key }}" data-modal-key='{{ $kode }}' data-modal-title='Ubah SOAP Farmasi'>
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href='soap-farmasi/delete' class='modal-remote-delete btn btn-danger' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @else
            <h2 class="mt-3">Halaman Hanya dapat Diakses Pada Rawat Inap</h2>
        @endif
    </div>

</div>
@endsection

@push('link-script')
<script src="{{ asset('js/globalScript.js') }}"></script>
<script src="{{ asset('js/isiCppt2.js') }}"></script>
@endpush

