<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{url('/sign-out-sebelum-menutup-luka/update')}}" method="post" id="sign-out-sebelum-menutup-luka">
    @csrf
    @include('rm-operasi.form_header_update',[
        "data_pasien"=>$data_pasien,
        "form_header" => $form_header
    ])
<hr class="mb-5">
    <div class="row justify-content-start align-items-end mb-4">
        <p>Perawat Melakukan Konfirmasi :</p>
        <div class="col-lg-4 mb-3">
            <label for="verbal_tindakan" class="form-label">Tidakan : </label>
            <select class="form-select" id="verbal_tindakan" name="verbal_tindakan" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->verbal_tindakan === 'Ya' ? 'selected' : '' }} >Ya</option>
                <option value="Tidak" {{$data_pasien->verbal_tindakan === 'Tidak' ? 'selected' : '' }} >Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_kelengkapan_kasa" class="form-label">Kelengkapan Kasa : </label>
            <select class="form-select" id="verbal_kelengkapan_kasa" name="verbal_kelengkapan_kasa" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->verbal_kelengkapan_kasa === 'Ya' ? 'selected' : '' }} >Ya</option>
                <option value="Tidak" {{$data_pasien->verbal_kelengkapan_kasa === 'Tidak' ? 'selected' : '' }} >Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_instrumen" class="form-label">Instrumen : </label>
            <select class="form-select" id="verbal_instrumen" name="verbal_instrumen" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->verbal_instrumen === 'Ya' ? 'selected' : '' }} >Ya</option>
                <option value="Tidak" {{$data_pasien->verbal_instrumen === 'Tidak' ? 'selected' : '' }} >Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_alat_tajam" class="form-label">Alat Tajam : </label>
            <select class="form-select" id="verbal_alat_tajam" name="verbal_alat_tajam" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->verbal_alat_tajam === 'Ya' ? 'selected' : '' }} >Ya</option>
                <option value="Tidak" {{$data_pasien->verbal_alat_tajam === 'Tidak' ? 'selected' : '' }} >Tidak</option>
            </select>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p>Kelengkapan Spesiemen Jika Ada :</p>
        <div class="col-lg-6 mb-3">
            <label for="kelengkapan_specimen_label" class="form-label">Label : </label>
            <div class="d-flex">
                <select class="form-select " id="kelengkapan_specimen_label"  name="kelengkapan_specimen_label" aria-label="Default select example">
                    <option value="Lengkap" {{$data_pasien->kelengkapan_specimen_label === 'Lengkap' ? 'selected' : '' }} >Lengkap</option>
                    <option value="Tidak Lengkap" {{$data_pasien->kelengkapan_specimen_label === 'Tidak Lengkap' ? 'selected' : '' }}>Tidak Lengkap</option>
                    <option value="Tidak Ada Pemeriksaan Spesiemen" {{$data_pasien->kelengkapan_specimen_label === 'Tidak Ada Pemeriksaan Spesiemen' ? 'selected' : '' }}>Tidak Ada Pemeriksaan Spesiemen</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="kelengkapan_specimen_formulir" class="form-label">Formulir : </label>
            <div class="d-flex">
                <select class="form-select " id="kelengkapan_specimen_formulir"  name="kelengkapan_specimen_formulir" aria-label="Default select example">
                    <option value="Lengkap" {{$data_pasien->kelengkapan_specimen_formulir === 'Lengkap' ? 'selected' : '' }} >Lengkap</option>
                    <option value="Tidak Lengkap" {{$data_pasien->kelengkapan_specimen_formulir === 'Tidak Lengkap' ? 'selected' : '' }}>Tidak Lengkap</option>
                    <option value="Tidak Ada Pemeriksaan Spesiemen" {{$data_pasien->kelengkapan_specimen_formulir === 'Tidak Ada Pemeriksaan Spesiemen' ? 'selected' : '' }}>Tidak Ada Pemeriksaan Spesiemen</option>
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
                    <option value="Ya" {{$data_pasien->peninjauan_kegiatan_dokter_bedah === 'Ya' ? 'selected' : '' }} >Ya</option>
                    <option value="Tidak" {{$data_pasien->peninjauan_kegiatan_dokter_bedah === 'Tidak' ? 'selected' : '' }} >Tidak</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="peninjauan_kegiatan_dokter_anestesi" class="form-label">Dokter Anestesi : </label>
            <div class="d-flex">
                <select class="form-select " name="peninjauan_kegiatan_dokter_anestesi" id="peninjauan_kegiatan_dokter_anestesi">
                <option value="Ya" {{$data_pasien->peninjauan_kegiatan_dokter_anestesi === 'Ya' ? 'selected' : '' }} >Ya</option>
                <option value="Tidak" {{$data_pasien->peninjauan_kegiatan_dokter_anestesi === 'Tidak' ? 'selected' : '' }} >Tidak</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="peninjauan_kegiatan_perawat_kamar_ok" class="form-label">Perawat Kamar Operasi : </label>
            <div class="d-flex">
                <select class="form-select " name="peninjauan_kegiatan_perawat_kamar_ok" id="peninjauan_kegiatan_perawat_kamar_ok">
                <option value="Ya" {{$data_pasien->peninjauan_kegiatan_perawat_kamar_ok === 'Ya' ? 'selected' : '' }} >Ya</option>
                <option value="Tidak" {{$data_pasien->peninjauan_kegiatan_perawat_kamar_ok === 'Tidak' ? 'selected' : '' }} >Tidak</option>
            </select>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="perhatian_utama_fase_pemulihan" class="form-label">Perhatian Utama Fase Pemulihan : </label>
            <input type="text" class="form-control" id="perhatian_utama_fase_pemulihan" value="{{!empty($data_pasien->perhatian_utama_fase_pemulihan) ? $data_pasien->perhatian_utama_fase_pemulihan : ''}}" name="perhatian_utama_fase_pemulihan">
        </div>
    </div>
<hr>
<div class="row justify-content-start align-items-end mb-3">
    <div class="row justify-content-left">
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
            <label for="nip_perawat_ok" class="form-label">NIP <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="nip_perawat_ok" name="nip_perawat_ok" required  value="{{!empty($data_pasien->nip_perawat_ok) ? $data_pasien->nip_perawat_ok : ''}}" readonly>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="nm_perawat_ok" class="form-label">Perawat Kamar Operasi :<span class="text-danger">*</span></label>
                <input type="text" class="form-control"  id="nm_perawat_ok" required  value="{{!empty($data_pasien->petugas_ok) ? $data_pasien->petugas_ok : ''}}" readonly>
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
