<?php
    $item_pasien = (new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
?>

<div class="mt-5">
    <form action="" method="GET">
        <input type="hidden" name="no_rawat" value="{{ $item_pasien->no_rawat }}">
        <input type="hidden" name="no_rm" value="{{ $item_pasien->no_rm }}">
        <input type="hidden" name="tab" value="{{ Request::get('tab') }}">
        <input type="hidden" name="fr" value="{{ $item_pasien->no_fr }}">
        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-3 col-md-10 my-3">
                <label for="tgl_rawat" class="form-label">Tanggal Permintaan</label>
                <div class='input-date-range-bagan'>
                    <input type="text" class="form-control input-daterange input-date-range" id="tgl_rawat" placeholder="Tanggal">
                    <input type="hidden" id="tgl_start" name="form_filter_start" value="{{ !empty($item_pasien->filter_start) ? $item_pasien->filter_start : Request::get('form_filter_start') }}">
                    <input type="hidden" id="tgl_end" name="form_filter_end" value="{{ !empty($item_pasien->filter_end) ? $item_pasien->filter_end : Request::get('form_filter_end') }}">
                </div>
            </div>
            <div class="col-xl-3 col-12 my-3">
                <label for="form-search" class="form-label">Pencarian Keyword</label>
                <input type="text" class="form-control" id="form-search" name='form_search' value="{{ $item_search['form_search'] }}" placeholder="Masukkan Keyword">
            </div>

            <div class="col-xl-2 col-12 my-3">
                <label for="form-status" class="form-label">Berdasarkan Status</label>
                <select class="form-select input-dropdown" id="form-status" name="form_status" aria-label="Default select example" >
                    @foreach($jadwalOperasiStatuses as $item)
                        <option value="{{ $item }}" <?= (strtolower($item)==strtolower($item_search['form_status'])) ? 'selected' : '' ?> >{{ $item }}</option>
                    @endforeach
                </select>
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
                    <th class="py-4 ps-4">No. Rawat</th>
                    <th class="py-4">Nama Pasien</th>
                    <th class="py-4">Waktu</th>
                    <th class="py-4">Kamar Operasi</th>
                    <th class="py-4">Mulai</th>
                    <th class="py-4">Selesai</th>
                    <th class="py-4">Status</th>
                    <th class="py-4">Rujukan dari</th>
                    <th class="py-4">Diagnosa</th>
                    <th class="py-4">Operasi</th>
                    <th class="py-4 pe-4">Operator</th>
                    <th class="py-4 pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwalOperasiLists as $key => $item)
                    <?php
                        $kode = $item_pasien->no_fr . '@' . $item['no_rawat'] . '@' .  $item_pasien->no_rm;
                        $kode_lama = '@' . $item_pasien->no_rawat . '@' . $item_pasien->no_rm;
                    ?>
                    <tr>
                        <td class="py-3 ps-4">{{ $item["no_rawat"] }}</td>
                        <td class="py-3">{{ $item["nm_pasien"] }}</td>
                        <td class="py-3">{{ $item["tanggal"] }}</td>
                        <td class="py-3">{{ !empty($item["nm_kamar_operasi"]) ? $item["nm_kamar_operasi"] : '-' }}</td>
                        <td class="py-3">{{ $item["jam_mulai"] }}</td>
                        <td class="py-3">{{ $item["jam_selesai"] }}</td>
                        <td class="py-3">{{ $item["status"] }}</td>
                        <td class="py-3">{{ $item["nm_poli"] }}</td>
                        <td class="py-3">{{ $item["diagnosa"] }}</td>
                        <td class="py-3">{{ $item["nm_perawatan"] }}</td>
                        <td class="py-3 pe-4">{{ $item["nm_dokter"] }}</td>
                        <td class="py-3 pe-4">
                            <a href='jadwal-operasi-pasien/form_update' class='btn btn-kecil btn-warning modal-remote modal-edit' data-modal-row="{{ $key }}" data-modal-key='{{ $kode }}' data-modal-title='Ubah Jadwal Operasi Pasien'><i class="fa-solid fa-pencil"></i></a>
                            <a href='jadwal-operasi-pasien/delete' class='btn btn-kecil btn-danger modal-remote-delete' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>