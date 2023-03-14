<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model->no_permintaan) ? $model->no_permintaan : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">
    <div class="row justify-content-start mb-3">
        <div class="row justify-content-left">
            <div class="col-lg-4 mb-3">
                <div class='input-date-bagan'>
                    <label for="tanggal" class="form-label">Pada Tanggal : <span class="text-danger">*</span></label>
                    <span class='icon-bagan-date'></span>
                    <input type="text" class="form-control input-date get-data-by-date" id='tanggal' autocomplete="off" data-url="{{ url('permintaan-barang-non-medis/ajax?action=no_permintaan') }}" data-value='tanggal@.tgl_me' data-target='#no_permintaan' >
                    <input type="hidden" class='tgl_me' id="tgl" required name="tanggal" value="{{ !empty($model->tanggal) ? $model->tanggal : date('Y-m-d') }}">
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <label for="no_permintaan" class="form-label">No.Permintaaan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="no_permintaan" name='no_permintaan' readonly required value="{{ !empty($model->no_permintaan) ? $model->no_permintaan : '' }}">
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row justify-content-left">
                <div class="col-lg-2 mb-3">
                    <div class='bagan_form'>
                    <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nip" name='nip' readonly required value="{{ !empty($model->nip) ? $model->nip : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-4 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_pegawai" class="form-label">Pegawai <span class="text-danger">*</span></label>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id='nm_pegawai' name="nm_pegawai" readonly disabled value="{{ !empty($model->nm_pegawai) ? $model->nm_pegawai : '' }}" />
                            @if( (new \App\Http\Traits\AuthFunction)->checkAkses($router_name->uri.'/fullAkses') )
                                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_pegawai') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Pegawai' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nip|#nm_pegawai|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
                                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                </span>
                                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                            @endif
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-2 mb-3">
                    <div class='bagan_form'>
                    <label for="departemen" class="form-label">Departemen <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="departemen" name='departemen' readonly disabled required value="{{ !empty($model->departemen) ? $model->departemen : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="ruang" class="form-label">Ruangan </label>
                        <input type="text" class="form-control" id="ruang" name='ruang' required value="{{ !empty($model->ruang) ? $model->ruang : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
        
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
                            <th class="py-3" style="width: 10%">Jumlah</th>
                            <th class="py-3" style="width: 8%">Kode Barang</th>
                            <th class="py-3" style="width: 15%">Nama Barang</th>
                            <th class="py-3" style="width: 5%">Stok</th>
                            <th class="py-3" style="width: 5%">Selisih</th>
                            <th class="py-3" style="width: 5%">Satuan</th>
                            <th class="py-3" style="width: 15%">Jenis</th>
                            <th class="py-3" style="width: 20%">Keterangan</th>
                            <th class="py-3" style="width: 1%">action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            
        </div>
    </div>

    <div class="row justify-content-end align-items-end mt-1">
        <div class="col-md-3 text-center">
            <button class="btn btn-primary btn-block" id='btn_save' type="submit">Simpan Pengajuan</button>
        </div>
    </div>
</form>

<div class="card card-body mt-5">
    <h4>List Data Barang</h4>
    <div id="list-data">
        @include($router_name->path_base.'.columns_list_barang_form')
    </div>
</div>

@push('script-end-2')
    <script src="{{ asset('js/permintaan-barang-non-medis/form.js') }}"></script>
@endpush