<?php
    $item_pasien = (new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
?>

<div class="mt-5">
    <form action="" method="GET">
        <input type="hidden" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
        <input type="hidden" name="no_rm" value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
        <input type="hidden" name="fr" value="{{ !empty($model->fr) ? $model->fr : '' }}">

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-4 col-md-10 my-3">
                <label for="tgl_rawat" class="form-label">Tanggal Permintaan</label>
                <div class='input-date-range-bagan'>
                    <input type="text" class="form-control input-daterange input-date-range" id="tgl_rawat" placeholder="Tanggal">
                    <input type="hidden" id="tgl_start" name="form_filter_start" value="{{ !empty($item_pasien->filter_start) ? $item_pasien->filter_start : Request::get('form_filter_start') }}">
                    <input type="hidden" id="tgl_end" name="form_filter_end" value="{{ !empty($item_pasien->filter_end) ? $item_pasien->filter_end : Request::get('form_filter_end') }}">
                </div>
            </div>

            <div class="col-md-1 my-3">
                <div class="d-grid grap-2">
                    <button type="submit" class="btn btn-primary">
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
                    <th class="py-3" style="width: 15%">No Permintaan</th>
                    <th class="py-3" style="width: 9%;">Permintaan</th>
                    <th class="py-3" style="width: 9%;">Jam</th>
                    <th class="py-3" style="width: 15%;">Dokter Perujuk</th>
                    <?php 
                        $jenis=$item_pasien->no_fr;
                    ?>
                    @if($jenis=='ri')
                        <th class="py-3" style="width: 15%;">Kamar Terakhir</th>
                    @else
                        <th class="py-3" style="width: 15%;">Poli Registrasi</th>
                    @endif
                    <th class="py-3" style="width: 15%;">Sampel</th>
                    <th class="py-3" style="width: 15%;">Hasil</th>
                    <th class="py-3" style="width: 8%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($list_data))
                    @foreach($list_data as $key => $item)
                        <?php
                            $tgl_sampel = !empty($item->tgl_sampel) ? $item->tgl_sampel : '';
                            $tgl_sampel = ($tgl_sampel == '0000-00-00') ? '' : $tgl_sampel;

                            $tgl_hasil = !empty($item->tgl_hasil) ? $item->tgl_hasil : '';
                            $tgl_hasil = ($tgl_hasil == '0000-00-00') ? '' : $tgl_hasil;

                            $waktu_sampel=$tgl_sampel.( !empty($item->jam_sampel) ? $item->jam_sampel : '' );
                            $waktu_hasil=$tgl_hasil.( !empty($item->jam_hasil) ? $item->jam_hasil : '' );

                            $custome_1 = '';
                            if ($item_pasien->no_fr == 'ri') {
                                $custome_1 = !empty($item->nm_bangsal) ? $item->nm_bangsal : '';
                            } else {
                                $custome_1 = !empty($item->nm_poli) ? $item->nm_poli : '';
                            }
                            $kode = $item_pasien->no_fr . '@' . $item->noorder . '@' . $item->no_rkm_medis . '@' . $item->no_rawat;
                            $check_akses = (new \App\Http\Traits\GlobalFunction)->check_akses($item->dokter_perujuk);
                            if( (new \App\Http\Traits\AuthFunction)->checkAkses('patologi-klinis/fullAkses') ){
                                $check_akses=1;
                            }
                        ?>

                        <tr>
                            <td>{{ !empty($item->noorder) ? $item->noorder : ''  }}</td>
                            <td>{{ !empty($item->tgl_permintaan) ? $item->tgl_permintaan : ''  }}</td>
                            <td>{{ !empty($item->jam_permintaan) ? $item->jam_permintaan : ''  }}</td>
                            <td>{{ !empty($item->nm_dokter) ? $item->nm_dokter : ''  }}</td>
                            <td>{{ $custome_1  }}</td>
                            <td>{{ $waktu_sampel  }}</td>
                            <td>{{ $waktu_hasil  }}</td>
                            <td>
                                <a href='patologi-klinis/view' class='btn btn-kecil btn-info modal-remote' data-modal-key='{{ $kode }}' data-modal-width='90%' data-modal-title='View Patologi Klinis'><i style='color:#fff;' class="fa-solid fa-circle-info"></i></a>
                                @if($check_akses)
                                    <a href='patologi-klinis/delete' class='btn btn-kecil btn-danger modal-remote-delete' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?"><i class="fa-solid fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-12 col-md-6 d-flex justify-content-end">

    </div>
</div>
