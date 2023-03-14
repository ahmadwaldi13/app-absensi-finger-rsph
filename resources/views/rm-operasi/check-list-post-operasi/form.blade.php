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
        <p>Serah Terima Perawat kamar Operasi Dengan Anestesi/Intensif/Ruangan. Perawat Melakukan Serah Terima Secara Verbal :</p>
        <div class="col-lg-4 mb-3">
            <label for="keadaan_umum" class="form-label">Keadaan Umum : </label>
            <select class="form-select" id="keadaan_umum" name="keadaan_umum" aria-label="Default select ">
                <option value="Sadar"  >Sadar</option>
                <option value="Tidur" >Tidur</option>
                <option value="Terindubasi" >Terindubasi</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="jenis_cairan_infus" class="form-label">Jenis Cairan Infus : </label>
            <input type="text" class="form-control" id="jenis_cairan_infus" name="jenis_cairan_infus" value="">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="jaringan_pa" class="form-label">Jaringan/Organ Tubuh PA/VC : </label>
            <select class="form-select" id="jaringan_pa" name="jaringan_pa" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="kateter_urine" class="form-label">Keteter Urine : </label>
            <select class="form-select" id="kateter_urine" name="kateter_urine" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="tanggal_pemasangan_kateter" class="form-label">Jika ada, Tgl.Pemasangan :</label>
            <input  type="text" class="form-control input-daterange input-date-time" name="tanggal_pemasangan_kateter" value="" id="tanggal_pemasangan_kateter"  required autocomplete="off">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="warna_kateter" class="form-label">, Warna : </label>
            <select class="form-select" id="warna_kateter" name="warna_kateter" aria-label="Default select ">
                <option value="Jernih"  >Jernih</option>
                <option value="Keruh" >Keruh</option>
                <option value="-" >-</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="jumlah_kateter" class="form-label">, jumlah :</label>
                <input type="text" class="form-control" id="jumlah_kateter"  name="jumlah_kateter" required  value="">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="drain" class="form-label">Drain : </label>
            <select class="form-select" id="drain" name="drain" aria-label="Default select ">
                <option value="Ada"  >Ada</option>
                <option value="Tidak Ada" >Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="jumlah_drain" class="form-label">Jika ada, Jumlah :</label>
                <input type="text" class="form-control" id="jumlah_drain"  name="jumlah_drain"  value="">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="letak_drain" class="form-label">Letak :</label>
                <input type="text" class="form-control" id="letak_drain"  name="letak_drain"  value="">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="warna_drain" class="form-label">, Warna/Produksi :</label>
                <input type="text" class="form-control" id="warna_drain"  name="warna_drain"  value="">
                <div class="message"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p>Kelengkapan Penunjang :</p>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_rontgen" class="form-label">Radiologi : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_rontgen"  name="pemeriksaan_penunjang_rontgen" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_rontgen" value=""  id='keterangan_pemeriksaan_penunjang_rontgen' value="">
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_ekg" class="form-label">EKG : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_ekg"  name="pemeriksaan_penunjang_ekg" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ekg" value=""  id='keterangan_pemeriksaan_penunjang_ekg' value="">
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_mri" class="form-label">MRI : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_mri"  name="pemeriksaan_penunjang_mri" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                </select>
                <input  type="text" placeholder="keterangan_pemeriksaan_penunjang_mri" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_mri" value=""  id='keterangan_pemeriksaan_penunjang_mri' value="">
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_usg" class="form-label">USG : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_usg"  name="pemeriksaan_penunjang_usg" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_usg" value=""  id='keterangan_pemeriksaan_penunjang_usg' value="">
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_ctscan" class="form-label">CT Scan : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_ctscan"  name="pemeriksaan_penunjang_ctscan" aria-label="Default select example">
                    <option value="Ada"  >Ada</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ctscan" value=""  id='keterangan_pemeriksaan_penunjang_ctscan' value="">
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class='bagan_form'>
                <label for="area_luka_operasi" class="form-label">Area Luka Operasi :</label>
                <input type="text" class="form-control" id="area_luka_operasi" name="area_luka_operasi"  value="">
                <div class="message"></div>
            </div>
        </div>
    </div>
<hr>
<div class="row justify-content-start align-items-end mb-3">
    <div class="row justify-content-left">
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
            <label for="nip_perawat_anestesi" class="form-label">NIP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nip_perawat_anestesi" name='nip_perawat_anestesi' readonly required value="{{ !empty($model->nip) ? $model->nip : '' }}">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="nm_r" class="form-label">Petugas Anestesi <span class="text-danger">*</span></label>
                <div class="button-icon-inside">
                    <input type="text" class="input-text" id='nm_r' name="nm_r" readonly disabled value="{{ !empty($model->nm_pegawai) ? $model->nm_pegawai : '' }}" />
                    <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_petugas') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Pegawai' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nip_perawat_anestesi|#nm_r|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
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
