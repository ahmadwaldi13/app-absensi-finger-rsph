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
                <label for="tgl_rawat" class="form-label">Tanggal</label>
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
                    <th class="py-3" style="width: 3%">No.Rawat</th>
                    <th class="py-3" style="width: 3%;">No.RM</th>
                    <th class="py-3" style="width: 8%;">Nama Pasien</th>
                    <th class="py-3" style="width: 4%;">Tgl.Pemeriksaan</th>
                    <th class="py-3" style="width: 2%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($list_data))
                    @foreach($list_data as $key => $item)
                    <?php
                     $kode = $item->no_rawat.'@'.$item->tanggal.'@'.$item->no_rkm_medis.'@'. $item_pasien->no_fr;
                ?>
                        <tr>
                            <td>{{ !empty($item->no_rawat) ? $item->no_rawat : ''  }}</td>
                            <td>{{ !empty($item->no_rkm_medis) ? $item->no_rkm_medis : ''  }}</td>
                            <td>{{ !empty($item->nm_pasien) ? $item->nm_pasien : ''  }}</td>
                            <td>{{ !empty($item->tanggal) ? $item->tanggal : ''  }}</td>
                            <td>
                                <a href='{{url("$base_route/view")}}' class='modal-remote' data-modal-width="1000px" data-modal-key='{{ $kode }}' data-modal-title='View Check List Pre Operasi'>
                                    <!-- <span class="iconify text-primary" style="font-size: 28px;" data-icon="bx:bxs-info-circle"></span> -->
                                    <img src="{{ asset('') }}icon/info.png" alt="">
                                </a>
                                    <a href='{{url("$base_route/delete")}}' class='modal-remote-delete' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?">
                                        <!-- <span class="iconify text-danger" style="font-size: 24px;" data-icon="el:trash-alt"></span> -->
                                        <img src="{{ asset('') }}icon/delete.png" alt="">
                                    </a>
                                    <a href='{{url("$base_route/form_update")}}' class='modal-remote modal-edit' data-modal-row="{{ $key }}" data-modal-key='{{ $kode }}' data-modal-title='Ubah Check List Pre Operasi'>
                                        <!-- <span class="iconify text-primary" style="font-size: 28px;" data-icon="el:file-edit-alt"></span> -->
                                        <img src="{{ asset('') }}icon/edit.png" alt="">
                                    </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
