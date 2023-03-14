<?php
    // dd($model);
?>
<form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" name="key_data" value="{{ !empty($kode) ? $kode : '' }}">

    <div class="row justify-content-start align-items-end mb-3">

        

        <div class="col-lg-3 col-md-10">
            <div class='bagan_form'>
                <label for="form_filter_kamar" class="form-label">Kamar/Ruangan</label>
                <div class="button-icon-inside">
                    <input type="text" class="input-text" id='form_filter_kamar' name="form_filter_kamar" value="{{ Request::get('form_filter_kamar') }}" />
                    <input type="text" id="form_filter_kd_kamar" name="form_filter_kd_kamar" value="{{ Request::get('form_filter_kd_kamar') }}" />
                    <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=kamar_bangsal_inap_harga') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#form_filter_kamar|#form_filter_kd_kamar@data-key-bagan=0@data-btn-close=#closeModalData">
                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                    </span>
                    <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                </div>
                <div class="message"></div>
            </div>
        </div>


    </div>
</form>