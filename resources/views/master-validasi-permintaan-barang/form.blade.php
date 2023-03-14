<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model->nip) ? $model->nip : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">
    <div class="row justify-content-start mb-3">
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
                            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_pegawai') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Pegawai' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nip|#nm_pegawai|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>                            
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-2 mb-3">
                    <div class='bagan_form'>
                    <label for="departemen" class="form-label">Departemen</label>
                        <input type="text" class="form-control" id="departemen" readonly disabled value="{{ !empty($model->departemen) ? $model->departemen : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="ruang" class="form-label">Ruangan </label>
                        <input type="text" class="form-control" id="ruang" value="{{ !empty($model->ruang) ? $model->ruang : '' }}">
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
                            <th class="py-3" style="width: 5%">Kode Departemen</th>
                            <th class="py-3" style="width: 20%">Nama Departemen</th>
                            <th class="py-3" style="width: 1%">action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            
        </div>
    </div>

    <div class="row justify-content-end align-items-end mt-1">
        <div class="col-md-2 text-center">
            <button class="btn btn-primary btn-block" id='btn_save' type="submit">{{ !empty($kode) ? 'Ubah' : 'Simpan'  }}</button>
        </div>
    </div>
</form>

<div class="card card-body mt-5">
    <h4>List Data Departemen</h4>
    <div id="list-data">
        @include($router_name->path_base.'.columns_list_departemen_form')
    </div>
</div>


@push('script-end-2')
    <script src="{{ asset('js/master-validasi-permintaan-barang/form.js') }}"></script>
@endpush