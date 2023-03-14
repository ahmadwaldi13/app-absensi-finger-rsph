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
<hr class="mb-5">
    <div class="row justify-content-start align-items-end mb-4">
        <p>Perawat Melakukan Konfirmasi :</p>
        <div class="col-lg-4 mb-3">
            <label for="identitas" class="form-label">Indentitas : </label>
            <select class="form-select" id="identitas" name="identitas" aria-label="Default select ">
                <option value="Ya"  >Ya</option>
                <option value="Tidak" >Tidak</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="keadaan_umum" class="form-label">Keadaan Umum Pasien : </label>
            <select class="form-select" id="keadaan_umum" name="keadaan_umum" aria-label="Default select ">
                <option value="Baik" >Baik</option>
                <option value="Sedang" >Sedang</option>
                <option value="Lemah" >Lemah</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="penandaan_area_operasi" class="form-label">Penandaan Area Operasi : </label>
            <select class="form-select" id="penandaan_area_operasi" name="penandaan_area_operasi" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="surat_ijin_bedah" class="form-label">Surat Izin Bedah : </label>
            <select class="form-select" id="surat_ijin_bedah" name="surat_ijin_bedah" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="surat_ijin_anestesi" class="form-label">Surat Izin Anestesi : </label>
            <select class="form-select" id="surat_ijin_anestesi" name="surat_ijin_anestesi" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="surat_ijin_transfusi" class="form-label">Surat Izin Transfusi : </label>
            <select class="form-select" id="surat_ijin_transfusi" name="surat_ijin_transfusi" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
                <option value="Tidak Diperlukan" >Tidak Diperlukan</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="persiapan_darah" class="form-label">Persiapan Darah : </label>
            <div class="d-flex">
                <select class="form-select " id="persiapan_darah"  name="persiapan_darah" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                    <option value="Tidak Diperlukan" >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="keterangan_persiapan_darah" class="ms-2 form-control" name="keterangan_persiapan_darah"   id='ket_inspekulo' value="">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="perlengkapan_khusus" class="form-label">Perlengkapan Khusus, Alat/Implan : </label>
            <select class="form-select" id="perlengkapan_khusus" name="perlengkapan_khusus" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
                <option value="Tidak" >Tidak Diperlukan</option>
            </select>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p>Hasil Pemeriksaan Penunjang :</p>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_rontgen" class="form-label">Radiologi : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_rontgen"  name="pemeriksaan_penunjang_rontgen" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                    <option value="Tidak" >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_rontgen"   id='ket_inspekulo' value="">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_ekg" class="form-label">EKG : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_ekg"  name="pemeriksaan_penunjang_ekg" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                    <option value="Tidak Diperlukan" >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ekg"   id='ket_inspekulo' value="">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_usg" class="form-label">USG : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_usg"  name="pemeriksaan_penunjang_usg" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                    <option value="Tidak Diperlukan" >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_usg"   id='ket_inspekulo' value="">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_ctscan" class="form-label">CT Scan : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_ctscan"  name="pemeriksaan_penunjang_ctscan" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                    <option value="Tidak Diperlukan" >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ctscan"   id='ket_inspekulo' value="">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_mri" class="form-label">MRI : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_mri"  name="pemeriksaan_penunjang_mri" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                    <option value="Tidak Diperlukan" >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_mri"   id='ket_inspekulo' value="">
            </div>
        </div>
    </div>
<hr>
    <div class="row justify-content-start align-items-end mb-3">
        <div class="row justify-content-left">
            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                <label for="nip_petugas_ruangan" class="form-label">NIP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nip_petugas_ruangan" name='nip_petugas_ruangan' readonly required value="{{ !empty($model->nip) ? $model->nip : '' }}">
                    <div class="message"></div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <label for="nm_r" class="form-label">Petugas Ruangan <span class="text-danger">*</span></label>
                    <div class="button-icon-inside">
                        <input type="text" class="input-text" id='nm_r' name="nm_r" readonly disabled value="{{ !empty($model->nm_pegawai) ? $model->nm_pegawai : '' }}" />
                        <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_petugas') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Pegawai' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nip_petugas_ruangan|#nm_r|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
                            <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                        </span>
                        <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                    </div>
                    <div class="message"></div>
                </div>
            </div>
            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                <label for="nip_perawat_ok" class="form-label">NIP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nip_perawat_ok" name='nip_perawat_ok' readonly required value="{{ !empty($model->nip) ? $model->nip : '' }}">
                    <div class="message"></div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <label for="nm_perawat_ok" class="form-label">Petugas OK <span class="text-danger">*</span></label>
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
