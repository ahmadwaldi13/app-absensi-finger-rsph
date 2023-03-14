<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{url('/timeout-sebelum-insisi/update')}}" method="post" id="timeout-sebelum-insisi">
    @csrf
     @include('rm-operasi.form_header_update',[
        "data_pasien"=>$data_pasien,
        "form_header" => $form_header
    ])

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
                    <option value="Ada"  {{$data_pasien->penandaan_area_operasi === 'Ada' ? 'selected' : '' }}>Ada</option>
                    <option value="Tidak Ada" {{$data_pasien->penandaan_area_operasi === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="Tidak Diperlukan" {{$data_pasien->penandaan_area_operasi === 'Tidak Diperlukan' ? 'selected' : '' }}>Tidak Diperlukan</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_identitas" class="form-label">Indentitas : </label>
            <select class="form-select" id="verbal_identitas" name="verbal_identitas" aria-label="Default select ">
                <option value="Ya"  {{$data_pasien->verbal_identitas === 'Ya' ? 'selected' : '' }}>Ya</option>
                <option value="Tidak" {{$data_pasien->verbal_identitas === 'Ada' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_tindakan" class="form-label">Tindakan : </label>
            <select class="form-select" id="verbal_tindakan" name="verbal_tindakan" aria-label="Default select ">
                <option value="Ya"  {{$data_pasien->verbal_tindakan === 'Ya' ? 'selected' : '' }}>Ya</option>
                <option value="Tidak" {{$data_pasien->verbal_tindakan === 'Ada' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="verbal_area_insisi" class="form-label">Area Insisi :</label>
                <select class="form-select" id="verbal_area_insisi" name="verbal_area_insisi" aria-label="Default select ">
                    <option value="Ya"  {{$data_pasien->verbal_identitas === 'Ya' ? 'selected' : '' }}>Ada</option>
                    <option value="Tidak" {{$data_pasien->verbal_identitas === 'Ada' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="lama_operasi" class="form-label">Pekiraan Lama : </label>
            <input type="text" class="form-control" id="lama_operasi" name="lama_operasi" value="{{!empty($data_pasien->lama_operasi) ? $data_pasien->lama_operasi : ''}}">
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-4">
        <p>PenaYangan Hasil Pemeriksaan Penunjang :</p>
        <div class="col-lg-4 mb-3">
            <label for="penayangan_radiologi" class="form-label">Radiologi : </label>
            <select class="form-select" id="penayangan_radiologi" name="penayangan_radiologi" aria-label="Default select ">
                <option value="Ditayangkan"  {{$data_pasien->penayangan_radiologi === 'Ditayangkan' ? 'selected' : '' }}>Ditayangkan</option>
                <option value="Benar" {{$data_pasien->penayangan_radiologi === 'Benar' ? 'selected' : '' }}>Benar</option>
                <option value="Tidak diperlukan" {{$data_pasien->penayangan_radiologi === 'Tidak diperlukan' ? 'selected' : '' }}>Tidak diperlukan</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="penayangan_ctscan" class="form-label">CT Scan : </label>
            <select class="form-select" id="penayangan_ctscan" name="penayangan_ctscan" aria-label="Default select ">
                <option value="Ditayangkan"  {{$data_pasien->penayangan_ctscan === 'Ditayangkan' ? 'selected' : '' }}>Ditayangkan</option>
                <option value="Benar" {{$data_pasien->penayangan_ctscan === 'Benar' ? 'selected' : '' }}>Benar</option>
                <option value="Tidak diperlukan" {{$data_pasien->penayangan_ctscan === 'Tidak diperlukan' ? 'selected' : '' }}>Tidak diperlukan</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="penayangan_mri" class="form-label">MRI :</label>
                <select class="form-select" id="penayangan_mri" name="penayangan_mri" aria-label="Default select ">
                    <option value="Ditayangkan"  {{$data_pasien->penayangan_mri === 'Ditayangkan' ? 'selected' : '' }}>Ditayangkan</option>
                <option value="Benar" {{$data_pasien->penayangan_mri === 'Benar' ? 'selected' : '' }}>Benar</option>
                <option value="Tidak diperlukan" {{$data_pasien->penayangan_mri === 'Tidak diperlukan' ? 'selected' : '' }}>Tidak diperlukan</option>
            </select>
                </select>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class='bagan_form '>
                <label for="antibiotik_profilaks" class="form-label">Pemberian Antibiotik Profilaksis :</label>
                <div class="d-flex ">
                    <select class="form-select" style="width: 15%;" id="antibiotik_profilaks"  name="antibiotik_profilaks" aria-label="Default select example">
                        <option value="Ya"  {{$data_pasien->antibiotik_profilaks === 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{$data_pasien->antibiotik_profilaks === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    <p class="ms-2">, Jika diberikan :</p>
                    <input  type="text" class="ms-2 form-control" style="width: 44%" name="nama_antibiotik" value="{{!empty($data_pasien->nama_antibiotik) ? $data_pasien->nama_antibiotik : ''}}"  id='nama_antibiotik'>
                    <p class="ms-2">, Jam Pemberian :</p>
                    <input type="text" class="form-control" name="jam_pemberian" style="width: 15%;" id="jam_pemberian" value="{{!empty($data_pasien->jam_pemberian) ? $data_pasien->jam_pemberian : ''}}">
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class="d-flex justify-content-start align-items-center">
                <label for="antisipasi_kehilangan_darah" class="form-label">Antisipasi Kehilangan Darah > 500 ml (7ml/kg BB Untuk Anak) : </label>
                <input type="text" class="form-control ms-2" style="width: 56%" id="antisipasi_kehilangan_darah" name="antisipasi_kehilangan_darah" value="{{!empty($data_pasien->antisipasi_kehilangan_darah) ? $data_pasien->antisipasi_kehilangan_darah : ''}}">
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="hal_khusus" class="form-label">Hal Yang Khusus Yang Perlu Perhatian : </label>
            <div class="d-flex align-items-center">
                <select class="form-select w-25" id="hal_khusus" name="hal_khusus" aria-label="Default select ">
                    <option value="Ada"  {{$data_pasien->hal_khusus === 'Ada' ? 'selected' : '' }}>Ada</option>
                    <option value="Tidak Ada" {{$data_pasien->hal_khusus === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                </select>
                <p class="ms-2">, Jika Ada :</p>
                <input type="text" class="form-control ms-2" style="width: 65%" id="hal_khusus_diperhatikan" name="hal_khusus_diperhatikan" value="{{!empty($data_pasien->hal_khusus_diperhatikan) ? $data_pasien->hal_khusus_diperhatikan : ''}}">
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="tanggal_steril" class="form-label">Tanggal : </label>
            <input type="text" class="form-control input-daterange input-date-time" name="tanggal_steril" value="{{!empty($data_pasien->tanggal_steril) ? $data_pasien->tanggal_steril : ''}}" id="tanggal"  required autocomplete="off">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="petujuk_sterilisasi" class="form-label">Petunjuk Sterilisasi Telah Dikonfirmasi : </label>
            <select class="form-select" id="petujuk_sterilisasi" name="petujuk_sterilisasi" aria-label="Default select ">
                <option value="Ya"  {{$data_pasien->petujuk_sterilisasi === 'Ya' ? 'selected' : '' }}>Ya</option>
                <option value="Tidak" {{$data_pasien->petujuk_sterilisasi === 'Tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="verifikasi_preoperatif" class="form-label">Veritifikasi Pre Operatif Telah Dilakukan :</label>
            <select class="form-select" id="verifikasi_preoperatif" name="verifikasi_preoperatif" aria-label="Default select ">
                <option value="Ya"  {{$data_pasien->verifikasi_preoperatif === 'Ya' ? 'selected' : '' }}>Ya</option>
                <option value="Tidak" {{$data_pasien->verifikasi_preoperatif === 'Tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
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
                <label for="nm_perawat_ok" class="form-label">Petugas Kamar Operasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" required  value="{{!empty($data_pasien->petugas_ok) ? $data_pasien->petugas_ok : ''}}" readonly>
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
