<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
    $check_status=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)->get_status_verifikasi($model_permintaan->status_veri,$model_permintaan->status,$model_permintaan->no_permintaan);
    $status_verifikasi=!empty($check_status->status_verifikasi) ? $check_status->status_verifikasi : '';
    $list_verifikasi=!empty($check_status->list_verifikasi) ? $check_status->list_verifikasi : '';
    $check_status_diterima=($check_status->status==1) ? 1 : 0;

    $status_permintaan=!empty($model_permintaan->status) ? strtolower($model_permintaan->status)  : '';
    $check_action=0;
    if($status_permintaan=='baru'){
        $check_action=1;
    }
?>

@push('custom-style')
    <style>
        .form-show{
            display: none;
        }

        #bagan_question_2,
        #bagan-form-setujuh,
        #bagan-form-tolak{
            display: none;
        }
    </style>
@endpush

<div class="card card-body">
    <div class="row justify-content-start">
        <div class="card card-body mb-3" style='background:#b1d5ff;'>
            <div class="row justify-content-start">
                <h4>Informasi</h4>
                <div class="col-lg-6 ">
                    <table class="table border table-responsive-tablet">
                        <tbody>
                            <tr>
                                <td style="width: 5%">No.Permintaan</td>
                                <td style="width: 1%">:</td>
                                <td style="width: 94%">{{ !empty($model_permintaan->no_permintaan) ? $model_permintaan->no_permintaan : ''  }}</td>
                            </tr>

                            <tr>
                                <td style="width: 5%">Tanggal</td>
                                <td style="width: 1%">:</td>
                                <td style="width: 94%">{{ !empty($model_permintaan->tanggal) ? $model_permintaan->tanggal : '' }}</td>
                            </tr>

                            <tr>
                                <td style="width: 5%">Pegawai</td>
                                <td style="width: 1%">:</td>
                                <td style="width: 94%">( {{ !empty($model_permintaan->nip) ? $model_permintaan->nip : ''  }} ) {{ !empty($model_permintaan->nama) ? $model_permintaan->nama : ''  }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-6 ">
                    <table class="table border table-responsive-tablet">
                        <tbody>
                            <tr>
                                <td style="width: 5%">Departemen</td>
                                <td style="width: 1%">:</td>
                                <td style="width: 94%">( {{ !empty($model_permintaan->departemen) ? $model_permintaan->departemen : ''  }} ) {{ !empty($model_permintaan->nama_departemen) ? $model_permintaan->nama_departemen : ''  }}</td>
                            </tr>

                            <tr>
                                <td style="width: 30%">Ruangan</td>
                                <td style="width: 1%">:</td>
                                <td style="width: 69%">{{ !empty($model_permintaan->ruang) ? $model_permintaan->ruang : ''  }}</td>
                            </tr>
                            
                            <tr>
                                <td style="width: 30%">Status</td>
                                <td style="width: 1%">:</td>
                                <td style="width: 69%">{{ !empty($status_verifikasi) ? $status_verifikasi : ''  }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            @if(!empty($model->no_keluar))
                <div class="row justify-content-start">
                    <div class="col-lg-12">
                        <table class="table border table-responsive-tablet">
                            <tbody>
                                <tr>
                                    <td style="width: 15%">No.Keluar</td>
                                    <td style="width: 1%">:</td>
                                    <td style="width: 84%">{{ !empty($model->no_keluar) ? $model->no_keluar : ''  }}</td>
                                </tr>

                                <tr>
                                    <td style="width: 15%">Tanggal Keluar</td>
                                    <td style="width: 1%">:</td>
                                    <td style="width: 84%">{{ !empty($model->tanggal_keluar) ? $model->tanggal_keluar : '' }}</td>
                                </tr>

                                <tr>
                                    <td style="width: 15%">Pegawai </td>
                                    <td style="width: 1%">:</td>
                                    <td style="width: 84%">( {{ !empty($model->nip_inven) ? $model->nip_inven : ''  }} ) {{ !empty($model->nama_inven) ? $model->nama_inven : ''  }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        @if(!empty($list_verifikasi))
            <div class="col-lg-12 mb-3">
                <h4>Histori Verifikasi</h4>
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th style="width: 10%">Verifikasi ke</th>
                            <th style="width: 40%">Nama</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 40%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_verifikasi as $item)
                            <?php  $item=(object)$item; ?>
                            <tr>
                                <td>{{ $item->verifikasi_ke }}</td>
                                <td>( {{ $item->nip }} ) {{ $item->nm_pegawai }}</td>
                                <td>{{ $item->verifikasi_status }}</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div>
        <div class="row d-flex justify-content-between">
            <div class='col-md-6'><h4>List Data Barang Permintaan</h4></div>
            <div class='col-md-6'>
                @if($check_action==1)
                    <form action="" method="GET" style='text-align:right;'>
                        <input type="hidden" name='check_data' value={{ !empty($model_permintaan->no_permintaan) ? $model_permintaan->no_permintaan : ''  }}>
                        <button type="submit" name='button_check_data' value=1 class="btn btn-kecil btn-info">
                            <i class="fa-sharp fa-solid fa-magnifying-glass"></i> <span>Periksa Data Gudang</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
        
        <div>
            @if(!empty($get_data_gudang))
                <div>
                    <div id='bagan_question_1' style='background: #3a95ff78;padding: 20px 10px;'>    
                        <div class='row'>
                            <div class='d-flex justify-content-end'>
                                <div class="col-md-2" style='text-align:right;'>
                                    <a href="#" id='btn-setujuh' class="btn btn-success" >Disetujui</a>
                                </div>
                                <div class="col-md-1" style='text-align:right;'>
                                    <a href="#" id='btn-tolak' class="btn btn-danger" >Ditolak</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3 mb-3" id=bagan_question_2>
                        <div class="card-body">
                            <div id='bagan-form-setujuh'>
                                @include($router_name->path_base.'.form_verifikasi_terima')
                            </div>
                            
                            <div id='bagan-form-tolak'>
                                @include($router_name->path_base.'.form_verifikasi_tolak')
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div style="overflow-x: auto; max-width: auto;">
                @if(!empty($get_data_gudang))
                    @include($router_name->path_base.'.columns_list_barang_verifikasi')
                @else
                    @include($router_name->path_base.'.columns_list_barang')
                @endif
            </div>
        </div>
    </div>
</div>

@push('script-end-2')
    <script src="{{ asset('js/verifikasi-inventori-permintaan-barang-non-medis/form_verifikasi.js') }}"></script>
@endpush