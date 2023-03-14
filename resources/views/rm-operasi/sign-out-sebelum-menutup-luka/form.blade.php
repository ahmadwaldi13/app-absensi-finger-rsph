<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" name="key_old" value="{{ !empty($kode_key_old) ? $kode_key_old : ''  }}"  >
    <input type="hidden" class="form-control" name="fr" value="{{ !empty($model->fr) ? $model->fr : '' }}">
    <input type="hidden" class="form-control" name="no_rm" value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
    <input type="hidden" class="form-control" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">

    @include('rm-operasi.form_header')
<hr class="mb-4">
    <div class="row justify-content-start align-items-end mb-3">
        <p>Sebelum Menutup Luka & Meninggalkan Kamar Operasi :</p>
        <p>Perawat Melakukan Konfirmasi Secara Verbal :</p>
        <div class="col-lg-3 mb-3">
            <label for="verbal_tindakan" class="form-label">Tidakan : </label>
            <select class="form-select" id="verbal_tindakan" name="verbal_tindakan" aria-label="Default select ">
                <option value="Ya"  >Ya</option>
                <option value="Tidak" >Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_kelengkapan_kasa" class="form-label">Kelengkapan Kasa : </label>
            <select class="form-select" id="verbal_kelengkapan_kasa" name="verbal_kelengkapan_kasa" aria-label="Default select ">
                <option value="Ya"  >Ya</option>
                <option value="Tidak" >Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_instrumen" class="form-label">Instrumen : </label>
            <select class="form-select" id="verbal_instrumen" name="verbal_instrumen" aria-label="Default select ">
                <option value="Ya"  >Ya</option>
                <option value="Tidak" >Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_alat_tajam" class="form-label">Alat Tajam : </label>
            <select class="form-select" id="verbal_alat_tajam" name="verbal_alat_tajam" aria-label="Default select ">
                <option value="Ya"  >Ya</option>
                <option value="Tidak" >Tidak</option>
            </select>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p>Kelengkapan Spesiemen Jika Ada :</p>
        <div class="col-lg-6 mb-3">
            <label for="kelengkapan_specimen_label" class="form-label">Label : </label>
            <div class="d-flex">
                <select class="form-select " id="kelengkapan_specimen_label"  name="kelengkapan_specimen_label" aria-label="Default select example">
                    <option value="Lengkap"  >Lengkap</option>
                    <option value="Tidak Lengkap" >Tidak Lengkap</option>
                    <option value="Tidak Ada Pemeriksaan Spesiemen" >Tidak Ada Pemeriksaan Spesiemen</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="kelengkapan_specimen_formulir" class="form-label">Formulir : </label>
            <div class="d-flex">
                <select class="form-select " id="kelengkapan_specimen_formulir"  name="kelengkapan_specimen_formulir" aria-label="Default select example">
                    <option value="Lengkap"  >Lengkap</option>
                    <option value="Tidak Lengkap" >Tidak Lengkap</option>
                    <option value="Tidak Ada Pemeriksaan Spesiemen" >Tidak Ada Pemeriksaan Spesiemen</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p>Peninjauan Kembali Kegiatan :</p>
        <div class="col-lg-4 mb-3">
            <label for="peninjauan_kegiatan_dokter_bedah" class="form-label">Dokter Bedah : </label>
            <div class="d-flex">
                <select class="form-select " id="peninjauan_kegiatan_dokter_bedah"  name="peninjauan_kegiatan_dokter_bedah" aria-label="Default select example">
                    <option value="Ya"  >Ya</option>
                    <option value="Tidak" >Tidak</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="peninjauan_kegiatan_dokter_anestesi" class="form-label">Dokter Anestesi : </label>
            <div class="d-flex">
                <select class="form-select " id="peninjauan_kegiatan_dokter_anestesi"  name="peninjauan_kegiatan_dokter_anestesi" aria-label="Default select example">
                    <option value="Ya"  >Ya</option>
                <option value="Tidak" >Tidak</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="peninjauan_kegiatan_perawat_kamar_ok" class="form-label">Perawat Kamar Operasi : </label>
            <div class="d-flex">
                <select class="form-select " id="peninjauan_kegiatan_perawat_kamar_ok"  name="peninjauan_kegiatan_perawat_kamar_ok" aria-label="Default select example">
                    <option value="Ya"  >Ya</option>
                <option value="Tidak" >Tidak</option>
                </select>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="perhatian_utama_fase_pemulihan" class="form-label">Perhatian Utama Fase Pemulihan : </label>
            <input type="text" class="form-control" id="perhatian_utama_fase_pemulihan" name="perhatian_utama_fase_pemulihan">
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
                <label for="nm_perawat_ok" class="form-label">Perawat Kamar Operasi :<span class="text-danger">*</span></label>
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
