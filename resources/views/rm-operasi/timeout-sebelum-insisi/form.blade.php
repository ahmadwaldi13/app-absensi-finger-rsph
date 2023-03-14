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
        <p>Konfirmasi Dipimpin Oleh Salah Satu Anggota Tim, Semua Kegiatan Ditangguhkan Kecuali Jika Mengancam Jiwa :</p>
        <div class="col-lg-6">
            <p>Verbalisasi Tim :</p>
        </div>
        <div class="col-lg-6">
            <div class="d-flex align-items-end justify-content-start">
                <label for="penandaan_area_operasi" class="form-label w-50">Penandaan Area Operasi : </label>
                <select class="form-select w-50" id="penandaan_area_operasi"  name="penandaan_area_operasi" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                    <option value="Tidak Diperlukan" >Tidak Diperlukan</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_identitas" class="form-label">Indentitas : </label>
            <select class="form-select" id="verbal_identitas" name="verbal_identitas" aria-label="Default select ">
                <option value="Ya"  >Ya</option>
                <option value="tidak" >Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_tindakan" class="form-label">Tindakan : </label>
            <select class="form-select" id="verbal_tindakan" name="verbal_tindakan" aria-label="Default select ">
                <option value="Ya"  >Ya</option>
                <option value="tidak" >Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="verbal_area_insisi" class="form-label">Area Insisi :</label>
                <select class="form-select" id="verbal_area_insisi" name="verbal_area_insisi" aria-label="Default select ">
                    <option value="Ya"  >Ada</option>
                    <option value="tidak" >Tidak Ada</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="lama_operasi" class="form-label">Pekiraan Lama : </label>
            <input type="text" class="form-control" id="lama_operasi" name="lama_operasi" value="">
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-4">
        <p>PenaYangan Hasil Pemeriksaan Penunjang :</p>
        <div class="col-lg-4 mb-3">
            <label for="penaYangan_radiologi" class="form-label">Radiologi : </label>
            <select class="form-select" id="penaYangan_radiologi" name="penaYangan_radiologi" aria-label="Default select ">
                <option value="DitaYangkan"  >DitaYangkan</option>
                <option value="Benar" >Benar</option>
                <option value="Tidak diperlukan" >Tidak diperlukan</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="penaYangan_ctscan" class="form-label">CT Scan : </label>
            <select class="form-select" id="penaYangan_ctscan" name="penaYangan_ctscan" aria-label="Default select ">
                <option value="DitaYangkan"  >DitaYangkan</option>
                <option value="Benar" >Benar</option>
                <option value="Tidak diperlukan" >Tidak diperlukan</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="penaYangan_mri" class="form-label">MRI :</label>
                <select class="form-select" id="penaYangan_mri" name="penaYangan_mri" aria-label="Default select ">
                    <option value="DitaYangkan"  >DitaYangkan</option>
                    <option value="Benar" >Benar</option>
                    <option value="Tidak diperlukan" >Tidak diperlukan</option>
            </select>
                </select>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class='bagan_form '>
                <label for="antibiotik_profilaks" class="form-label">Pemberian Antibiotik Profilaksis :</label>
                <div class="d-flex ">
                    <select class="form-select" style="width: 15%;" id="antibiotik_profilaks"  name="antibiotik_profilaks" aria-label="Default select example">
                        <option value="Ya"  >Ya</option>
                        <option value="Tidak" >Tidak</option>
                    </select>
                    <p class="ms-2">, Jika diberikan :</p>
                    <input  type="text" class="ms-2 form-control" style="width: 44%" name="nama_antibiotik" value=""  id='nama_antibiotik' value="">
                    <p class="ms-2">, Jam Pemberian :</p>
                    <input type="text" class="form-control" name="jam_pemberian" style="width: 15%;" id="jam_pemberian" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class="d-flex justify-content-start align-items-center">
                <label for="antisipasi_kehilangan_darah" class="form-label">Antisipasi Kehilangan Darah > 500 ml (7ml/kg BB Untuk Anak) : </label>
                <input type="text" class="form-control ms-2" style="width: 56%" id="antisipasi_kehilangan_darah" name="antisipasi_kehilangan_darah" value="">
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="hal_khusus" class="form-label">Hal Yang Khusus Yang Perlu Perhatian : </label>
            <div class="d-flex align-items-center">
                <select class="form-select w-25" id="hal_khusus" name="hal_khusus" aria-label="Default select ">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                </select>
                <p class="ms-2">, Jika Ada :</p>
                <input type="text" class="form-control ms-2" style="width: 65%" id="hal_khusus_diperhatikan" name="hal_khusus_diperhatikan" value="">
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="tanggal_steril" class="form-label">Tanggal : </label>
            <input type="text" class="form-control input-daterange input-date-time" name="tanggal_steril" value="" id="tanggal"  required autocomplete="off">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="petujuk_sterilisasi" class="form-label">Petunjuk Sterilisasi Telah Dikonfirmasi : </label>
            <select class="form-select" id="petujuk_sterilisasi" name="petujuk_sterilisasi" aria-label="Default select ">
                <option value="Ya"  >Ya</option>
                <option value="Tidak" >Tidak</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="verifikasi_preoperatif" class="form-label">Veritifikasi Pre Operatif Telah Dilakukan :</label>
            <select class="form-select" id="verifikasi_preoperatif" name="verifikasi_preoperatif" aria-label="Default select ">
                <option value="Ya"  >Ya</option>
                <option value="Tidak" >Tidak</option>
            </select>
        </div>
    </div>

<hr>
<div class="row justify-content-start align-items-end mb-3">
    <div class="row justify-content-left">
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
            <label for="nip_perawat_ok" class="form-label">NIP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nip_perawat_ok" name='nip_perawat_ok' readonly required value="{{ !empty($model->nip) ? $model->nip : '' }}">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="nm_perawat_ok" class="form-label">Petugas Kamar Operasi <span class="text-danger">*</span></label>
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
