<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
    $check_status=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)->get_status_verifikasi($model->status_veri,$model->status,$model->no_permintaan);
    $status_verifikasi=!empty($check_status->status_verifikasi) ? $check_status->status_verifikasi : '';
    $list_verifikasi=!empty($check_status->list_verifikasi) ? $check_status->list_verifikasi : '';
    $check_status_diterima=($check_status->status==1) ? 1 : 0;
?>

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
                                <td style="width: 94%">{{ !empty($model->no_permintaan) ? $model->no_permintaan : ''  }}</td>
                            </tr>

                            <tr>
                                <td style="width: 5%">Tanggal</td>
                                <td style="width: 1%">:</td>
                                <td style="width: 94%">{{ !empty($model->tanggal) ? $model->tanggal : '' }}</td>
                            </tr>

                            <tr>
                                <td style="width: 5%">Pegawai</td>
                                <td style="width: 1%">:</td>
                                <td style="width: 94%">( {{ !empty($model->nip) ? $model->nip : ''  }} ) {{ !empty($model->nama) ? $model->nama : ''  }}</td>
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
                                <td style="width: 94%">( {{ !empty($model->departemen) ? $model->departemen : ''  }} ) {{ !empty($model->nama_departemen) ? $model->nama_departemen : ''  }}</td>
                            </tr>

                            <tr>
                                <td style="width: 30%">Ruangan</td>
                                <td style="width: 1%">:</td>
                                <td style="width: 69%">{{ !empty($model->ruang) ? $model->ruang : ''  }}</td>
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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#tab-1-pane" type="button" role="tab" aria-controls="tab-1-pane" aria-selected="true">Permintaan Barang</button>
            </li>
            @if(!empty($list_data_keluar[0]))
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#tab-2-pane" type="button" role="tab" aria-controls="tab-2-pane" aria-selected="false">Barang Di Terima</button>
                </li>
            @endif
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-1-pane" role="tabpanel" aria-labelledby="tab-1" tabindex="0">
                
                <div class="row d-flex justify-content-between">
                    <div style="overflow-x: auto; max-width: auto;">
                        <table class="table border table-responsive-tablet data-table-cus">
                            <thead>
                                <tr>
                                    <th class="py-3" style="width: 1%">No</th>
                                    <th class="py-3" style="width: 5%">Jumlah <br> Permintaan</th>
                                    <th class="py-3" style="width: 8%">Kode Barang</th>
                                    <th class="py-3" style="width: 15%">Nama Barang</th>
                                    <th class="py-3" style="width: 5%">Stok</th>
                                    <th class="py-3" style="width: 5%">Satuan</th>
                                    <th class="py-3" style="width: 15%">Jenis</th>
                                    <th class="py-3" style="width: 20%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($list_data))
                                    @foreach($list_data as $key => $item)
                                        <?php
                                            $jumlah=!empty($item->jumlah) ? $item->jumlah : 0;
                                            $jumlah=(new \App\Http\Traits\GlobalFunction)->formatMoney($jumlah);
                                        ?>

                                        <tr>
                                            <td style='text-align:center'>{{ $key+1 }}</td>
                                            <td style='text-align:right'>{{ !empty($jumlah) ? $jumlah : ''  }}</td>
                                            <td>{{ !empty($item->kode_brng) ? $item->kode_brng : ''  }}</td>
                                            <td>{{ !empty($item->nama_brng) ? $item->nama_brng : ''  }}</td>
                                            <td>{{ isset($item->stok) ? (int)$item->stok : ''  }}</td>
                                            <td>{{ !empty($item->satuan) ? $item->satuan : ''  }}</td>
                                            <td>{{ !empty($item->nm_jenis) ? $item->nm_jenis : ''  }}</td>
                                            <td>{{ !empty($item->keterangan) ? $item->keterangan : ''  }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            @if(!empty($list_data_keluar[0]))
                <div class="tab-pane fade" id="tab-2-pane" role="tabpanel" aria-labelledby="tab-2" tabindex="0">
                    
                    <div class="row d-flex justify-content-between">
                        <div style="overflow-x: auto; max-width: auto;">
                            <table class="table border table-responsive-tablet data-table-cus">
                                <thead>
                                    <tr>
                                        <th class="py-3" style="width: 1%">No</th>
                                        <th class="py-3" style="width: 5%">Jumlah <br> Permintaan</th>
                                        <th class="py-3" style="width: 5%">Jumlah <br> Keluar</th>
                                        <th class="py-3" style="width: 8%">Kode Barang</th>
                                        <th class="py-3" style="width: 15%">Nama Barang</th>
                                        <th class="py-3" style="width: 5%">Satuan</th>
                                        <th class="py-3" style="width: 15%">Jenis</th>
                                        <th class="py-3" style="width: 10%">Harga</th>
                                        <th class="py-3" style="width: 10%">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($list_data_keluar))
                                        @foreach($list_data_keluar as $key => $item)
                                            <?php
                                                $jumlah=!empty($item->jumlah) ? $item->jumlah : 0;
                                                $jumlah=(new \App\Http\Traits\GlobalFunction)->formatMoney($jumlah);

                                                $jumlah_permintaan=!empty($item->jumlah_permintaan) ? $item->jumlah_permintaan : 0;
                                                $jumlah_permintaan=(new \App\Http\Traits\GlobalFunction)->formatMoney($jumlah_permintaan);

                                                $harga=!empty($item->harga) ? $item->harga : 0;
                                                $harga=(new \App\Http\Traits\GlobalFunction)->formatMoney($harga);

                                                $total=!empty($item->total) ? $item->total : 0;
                                                $total=(new \App\Http\Traits\GlobalFunction)->formatMoney($total);
                                            ?>

                                            <tr>
                                                <td style='text-align:center'>{{ $key+1 }}</td>
                                                <td style='text-align:right'>{{ !empty($jumlah_permintaan) ? $jumlah_permintaan : ''  }}</td>
                                                <td style='text-align:right'>{{ !empty($jumlah) ? $jumlah : ''  }}</td>
                                                <td>{{ !empty($item->kode_brng) ? $item->kode_brng : ''  }}</td>
                                                <td>{{ !empty($item->nama_brng) ? $item->nama_brng : ''  }}</td>
                                                <td>{{ !empty($item->satuan) ? $item->satuan : ''  }}</td>
                                                <td>{{ !empty($item->nm_jenis) ? $item->nm_jenis : ''  }}</td>
                                                <td style='text-align:right'>{{ !empty($harga) ? $harga : ''  }}</td>
                                                <td style='text-align:right'>{{ !empty($total) ? $total : ''  }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>

    @if(!empty($bagan_sisip))
        {!! $bagan_sisip  !!}
    @endif
</div>