<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{url('/check-list-pre-operasi/update')}}" method="post" id="check_list_pre_operasi">
    @csrf
    @include('rm-operasi.form_header_update',[
        "data_pasien"=>$data_pasien,
        "form_header" => $form_header
    ])
<hr class="mb-5">
    <div class="row justify-content-start align-items-end mb-4">
        <p>Perawat Melakukan Konfirmasi :</p>
        <div class="col-lg-4 mb-3">
            <label for="identitas" class="form-label">Indentitas : </label>
            <select class="form-select" id="identitas" name="identitas" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->identitas === 'Ya' ? 'selected' : '' }} >Ya</option>
                <option value="Tidak Diperlukan" {{$data_pasien->identitas === 'Tidak Diperlukan' ? 'selected' : '' }} >Tidak</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="keadaan_umum" class="form-label">Keadaan Umum Pasien : </label>
            <select class="form-select" id="keadaan_umum" name="keadaan_umum" aria-label="Default select ">
                <option value="Baik" {{$data_pasien->keadaan_umum === 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Sedang" {{$data_pasien->keadaan_umum === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="Lemah" {{$data_pasien->keadaan_umum === 'Lemah' ? 'selected' : '' }}>Lemah</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="penandaan_area_operasi" class="form-label">Penandaan Area Operasi : </label>
            <select class="form-select" id="penandaan_area_operasi" name="penandaan_area_operasi" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->penandaan_area_operasi === 'Ya' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->penandaan_area_operasi === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="surat_ijin_bedah" class="form-label">Surat Izin Bedah : </label>
            <select class="form-select" id="surat_ijin_bedah" name="surat_ijin_bedah" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->surat_ijin_bedah === 'Ya' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->surat_ijin_bedah === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="surat_ijin_anestesi" class="form-label">Surat Izin Anestesi : </label>
            <select class="form-select" id="surat_ijin_anestesi" name="surat_ijin_anestesi" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->surat_ijin_anestesi === 'Ya' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->surat_ijin_anestesi === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="surat_ijin_transfusi" class="form-label">Surat Izin Transfusi : </label>
            <select class="form-select" id="surat_ijin_transfusi" name="surat_ijin_transfusi" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->surat_ijin_transfusi === 'Ya' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->surat_ijin_transfusi === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                <option value="Tidak Diperlukan" {{$data_pasien->surat_ijin_transfusi === 'Tidak Diperlukan' ? 'selected' : '' }}>Tidak Diperlukan</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="persiapan_darah" class="form-label">Persiapan Darah : </label>
            <div class="d-flex">
                <select class="form-select " id="persiapan_darah"  name="persiapan_darah" aria-label="Default select example">
                    <option value="Ya" {{$data_pasien->persiapan_darah === 'Ya' ? 'selected' : '' }} >Ada</option>
                    <option value="Tidak Ada" {{$data_pasien->persiapan_darah === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="Tidak Diperlukan" {{$data_pasien->persiapan_darah === 'Tidak Diperlukan' ? 'selected' : '' }}>Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="keterangan_persiapan_darah" class="ms-2 form-control" name="keterangan_persiapan_darah"   id='ket_inspekulo' value="{{!empty($data_pasien->keterangan_persiapan_darah) ? $data_pasien->keterangan_persiapan_darah : ''}}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="perlengkapan_khusus" class="form-label">Perlengkapan Khusus, Alat/Implan : </label>
            <select class="form-select" id="perlengkapan_khusus" name="perlengkapan_khusus" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->perlengkapan_khusus === 'Ya' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->perlengkapan_khusus === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                <option value="Tidak Diperlukan" {{$data_pasien->perlengkapan_khusus === 'Tidak Diperlukan' ? 'selected' : '' }} >Tidak Diperlukan</option>
            </select>
        </div>
    </div>
   <div class="row justify-content-start align-items-end mb-3">
        <p>Hasil Pemeriksaan Penunjang :</p>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_rontgen" class="form-label">Radiologi : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_rontgen"  name="pemeriksaan_penunjang_rontgen" aria-label="Default select example">
                    <option value="Ya" {{$data_pasien->pemeriksaan_penunjang_rontgen === 'Ya' ? 'selected' : '' }} >Ada</option>
                    <option value="Tidak Ada" {{$data_pasien->pemeriksaan_penunjang_rontgen === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="Tidak Diperlukan" {{$data_pasien->perlengkapan_khusus === 'Tidak Diperlukan' ? 'selected' : '' }} >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_rontgen"   id='ket_inspekulo' value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_rontgen) ? $data_pasien->keterangan_pemeriksaan_penunjang_rontgen : ''}}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_ekg" class="form-label">EKG : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_ekg"  name="pemeriksaan_penunjang_ekg" aria-label="Default select example">
                    <option value="Ya" {{$data_pasien->identitas === 'Ya' ? 'selected' : '' }} >Ada</option>
                    <option value="Tidak Ada" {{$data_pasien->penandaan_area_operasi === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="Tidak Diperlukan" {{$data_pasien->pemeriksaan_penunjang_ekg === 'Tidak Diperlukan' ? 'selected' : '' }} >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ekg"   id='ket_inspekulo' value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_ekg) ? $data_pasien->keterangan_pemeriksaan_penunjang_ekg : ''}}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_usg" class="form-label">USG : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_usg"  name="pemeriksaan_penunjang_usg" aria-label="Default select example">
                    <option value="Ya" {{$data_pasien->pemeriksaan_penunjang_usg === 'Ya' ? 'selected' : '' }} >Ada</option>
                    <option value="Tidak Ada" {{$data_pasien->pemeriksaan_penunjang_usg === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="Tidak Diperlukan" {{$data_pasien->pemeriksaan_penunjang_usg === 'Tidak Diperlukan' ? 'selected' : '' }} >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_usg"   id='ket_inspekulo' value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_usg) ? $data_pasien->keterangan_pemeriksaan_penunjang_usg : ''}}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_ctscan" class="form-label">CT Scan : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_ctscan"  name="pemeriksaan_penunjang_ctscan" aria-label="Default select example">
                    <option value="Ya" {{$data_pasien->pemeriksaan_penunjang_ctscan === 'Ya' ? 'selected' : '' }} >Ada</option>
                    <option value="Tidak Ada" {{$data_pasien->pemeriksaan_penunjang_ctscan === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="Tidak Diperlukan" {{$data_pasien->pemeriksaan_penunjang_ctscan === 'Tidak Diperlukan' ? 'selected' : '' }} >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ctscan"   id='ket_inspekulo' value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_ctscan) ? $data_pasien->keterangan_pemeriksaan_penunjang_ctscan : ''}}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_mri" class="form-label">MRI : </label>
            <div class="d-flex">
                <select class="form-select " id="pemeriksaan_penunjang_mri"  name="pemeriksaan_penunjang_mri" aria-label="Default select example">
                    <option value="Ya" {{$data_pasien->pemeriksaan_penunjang_mri === 'Ya' ? 'selected' : '' }} >Ada</option>
                    <option value="Tidak Ada" {{$data_pasien->pemeriksaan_penunjang_mri === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="Tidak Diperlukan" {{$data_pasien->pemeriksaan_penunjang_mri === 'Tidak Diperlukan' ? 'selected' : '' }} >Tidak Diperlukan</option>
                </select>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_mri"   id='ket_inspekulo' value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_mri) ? $data_pasien->keterangan_pemeriksaan_penunjang_mri : ''}}">
            </div>
        </div>
    </div>
<hr>
<div class="row justify-content-start align-items-end mb-3">
    <div class="row justify-content-left">
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
            <label for="nip_petugas_ruangan" class="form-label">NIP <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="nip_petugas_ruangan" name="nip_petugas_ruangan" required  value="{{!empty($data_pasien->nip_petugas_ruangan) ? $data_pasien->nip_petugas_ruangan : ''}}" readonly>
            <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <label for="nip_petugas_ruangan" class="form-label">Petugas Ruangan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  id="nip_petugas_ruangan" required  value="{{!empty($data_pasien->petugas_ruangan) ? $data_pasien->petugas_ruangan : ''}}" readonly>
                    <div class="message"></div>
                    </div>
        </div>
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
            <label for="nip_perawat_ok" class="form-label">NIP <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="nip_perawat_ok" name="nip_perawat_ok" required  value="{{!empty($data_pasien->nip_perawat_ok) ? $data_pasien->nip_perawat_ok : ''}}" readonly>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="nip_perawat_ok" class="form-label">Petugas OK <span class="text-danger">*</span></label>
                <input type="text" class="form-control"  id="nip_perawat_ok" required  value="{{!empty($data_pasien->petugas_ok) ? $data_pasien->petugas_ok : ''}}" readonly>
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
