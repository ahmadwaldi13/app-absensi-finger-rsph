<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" name="key_old" value="{{ !empty($kode_key_old) ? $kode_key_old : ''  }}"  >
    <input type="hidden" class="form-control" name="fr" value="{{ !empty($model->fr) ? $model->fr : '' }}">
    <input type="hidden" class="form-control" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">


    @include('rm-operasi.form_header')
<hr class="mb-5">
    <div class="row justify-content-start align-items-end mb-4">
        <p>Perawat OK & Tim Anestesi Mengkonfirmasi :</p>
        <div class="col-lg-4 mb-3">
            <label for="identitas" class="form-label">Indentitas : </label>
            <select class="form-select" id="identitas" name="identitas" aria-label="Default select ">
                <option value="ya"  >Ya</option>
                <option value="tidak" >Tidak</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="alergi" class="form-label">Alergi :</label>
                <input type="text" class="form-control" id="alergi" name="alergi" value="">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="penandaan_area_operasi" class="form-label">Penandaan Area Operasi : </label>
            <select class="form-select" id="penandaan_area_operasi" name="penandaan_area_operasi" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
                <option value="Tidak Diperlukan" >Tidak Diperlukan</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="resiko_aspirasi" class="form-label">Resiko Aspirasi & Faktor Penyulit : </label>
            <select class="form-select" id="resiko_aspirasi" name="resiko_aspirasi" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <div class='bagan_form'>
                <label for="resiko_aspirasi_rencana_antisipasi" class="form-label">Bila Ada Resiko, Rencana Antisipasi :</label>
                <input type="text" class="form-control" id="resiko_aspirasi_rencana_antisipasi" name="resiko_aspirasi_rencana_antisipasi" value="">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="resiko_kehilangan_darah" class="form-label">Resiko Kehilangan Darah > 500 ml(7ml/Kg Berat badan untuk anak) : </label>
            <select class="form-select" id="resiko_kehilangan_darah" name="resiko_kehilangan_darah" aria-label="Default select ">
                <option value="ya"  >Ada</option>
                <option value="tidak" >Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <div class='bagan_form'>
                <label for="resiko_kehilangan_darah_line" class="form-label">Jika Ada, Jalur IV Line :</label>
                <input type="text" class="form-control" id="resiko_kehilangan_darah_line" name="resiko_kehilangan_darah_line" value="">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class='bagan_form'>
                <label for="resiko_kehilangan_darah_rencana_antisipasi" class="form-label">Jika Ada Resiko Kehilangan Darah, Rencana Antisipasi :</label>
                <input type="text" class="form-control" id="resiko_kehilangan_darah_rencana_antisipasi" name="resiko_kehilangan_darah_rencana_antisipasi" value="">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="kesiapan_alat_obat_anestesi" class="form-label">Kesiapan Alat & Obat Anestesi : </label>
            <select class="form-select" id="kesiapan_alat_obat_anestesi" name="kesiapan_alat_obat_anestesi" aria-label="Default select ">
                <option value="Lengkap"  >Lengkap</option>
                <option value="Pulsa Oximetri" >Pulsa Oximetri</option>
                <option value="Tidak Lengkap" >Tidak Lengkap</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <div class='bagan_form'>
                <label for="kesiapan_alat_obat_anestesi_rencana_antisipasi" class="form-label">Bila Tidak Lengkap, Rencana Antisipasi :</label>
                <input type="text" class="form-control" name="kesiapan_alat_obat_anestesi_rencana_antisipasi" id="kesiapan_alat_obat_anestesi_rencana_antisipasi" value="">
                <div class="message"></div>
            </div>
        </div>
    </div>

<hr>
    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
            <label for="nip_perawat_ok" class="form-label">NIP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nip_perawat_ok" name='nip_perawat_ok' readonly required value="{{ !empty($model->nip) ? $model->nip : '' }}">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="nm_perawat_ok" class="form-label">Petugas Kamar Operasi :<span class="text-danger">*</span></label>
                <div class="button-icon-inside">
                    <input type="text" class="input-text" id='nm_perawat_ok' name="nm_perawat_ok" readonly disabled value="{{ !empty($model->nm_pegawai) ? $model->nm_pegawai : '' }}" />
                    <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_petugas') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Pegawai' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nip_perawat_ok|#nm_perawat_ok|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                    </span>
                    <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                </div>
                <div class="message"></div>
            </div>
        </div>
    </div>
</div>
        <div class="row justify-content-start align-items-end my-5" id='bagan-save'>
            <div class="col-lg-2  mb-3">
                <div class="d-grid gap-2">
                    @if(empty($allow_btn_save))
                        <button class="btn btn-primary" id='btn_submit' type="submit">Simpan</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
