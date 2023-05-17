<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-3 col-md-10">
            <div class='bagan_form'>
                <label for="filter_ip_mesin" class="form-label">Pilih Data Mesin <span class="text-danger">*</span></label>
                <div class="button-icon-inside">
                    <input type="text" class="input-text" id='filter_ip_mesin' required value="{{ !empty($data_mesin->ip_address) ? $data_mesin->ip_address : '' }}" />
                    <input type="hidden" id="filter_id_mesin" name="filter_id_mesin" value="{{ Request::get('filter_id_mesin') }}" />
                    <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_mesih_absensi') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_id_mesin|#filter_ip_mesin|null|#filter_nama_mesin|#filter_lokasi_mesin@data-key-bagan=0@data-btn-close=#closeModalData">
                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                    </span>
                    <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                </div>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-3 col-md-10">
            <div class='bagan_form'>
            <label for="filter_nama_mesin" class="form-label">Nama Mesin</label>
                <input type="text" class="form-control" id="filter_nama_mesin" readonly value="{{ !empty($data_mesin->nm_mesin) ? $data_mesin->nm_mesin : '' }}">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-5 col-md-10">
            <div class='bagan_form'>
            <label for="filter_lokasi_mesin" class="form-label">Lokasi Mesin</label>
                <input type="text" class="form-control" id="filter_lokasi_mesin" readonly value="{{ !empty($data_mesin->lokasi_mesin) ? $data_mesin->lokasi_mesin : '' }}">
                <div class="message"></div>
            </div>
        </div>
    </div>
<textarea id='item_list_terpilih' name='item_list_terpilih' style='display:none'>{{ !empty($item_list_terpilih) ? $item_list_terpilih : '' }}</textarea>
    <hr>
    <div class="card card-body" style='background:#bbe7fa'>
        <div id="data-terpilih">
            <h4>List Data Terpilih</h4>
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 4%">Aksi</th>
                            <th class="py-3" style="width: 8%">Id Karyawan</th>
                            <th class="py-3" style="width: 13%">Nama Karyawan</th>
                            <th class="py-3" style="width: 10%">Alamat</th>
                            <th class="py-3" style="width: 4%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="row justify-content-end align-items-end mt-1">
        <div class="col-md-3 text-center">
            <button class="btn btn-primary btn-block" id='btn_save' type="submit">Simpan Perubahan</button>
        </div>
    </div>
</form>

<div class="card card-body mt-5">
    <h4>List Data Karyawan</h4>
    <div id="list-data">
        @include('upload-nama-user.columns')
    </div>
</div>

@push('script-end-2')
    <script src="{{ asset('js/upload-nama-user/form.js') }}"></script>
@endpush
