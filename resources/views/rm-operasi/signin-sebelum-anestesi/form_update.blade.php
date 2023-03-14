<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{url('/signin-sebelum-anestesi/update')}}" method="post" id="signin-sebelum-anestesi">
    @csrf
     @include('rm-operasi.form_header_update',[
        "data_pasien"=>$data_pasien,
        "form_header" => $form_header
    ])

<hr class="mb-5">
    <div class="row justify-content-start align-items-end mb-4">
        <p>Perawat OK & Tim Anestesi Mengkonfirmasi :</p>
        <div class="col-lg-4 mb-3">
            <label for="identitas" class="form-label">Indentitas : </label>
            <select class="form-select" id="identitas" name="identitas" aria-label="Default select ">
                <option value="Ya" {{$data_pasien->identitas === 'Ya' ? 'selected' : '' }} >Ya</option>
                <option value="Tidak" {{$data_pasien->identitas === 'Tidak' ? 'selected' : '' }} >Tidak</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="alergi" class="form-label">Alergi :</label>
                <input type="text" class="form-control" id="alergi" name="alergi" value="{{!empty($data_pasien->alergi) ? $data_pasien->alergi : ''}}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="penandaan_area_operasi" class="form-label">Penandaan Area Operasi : </label>
            <select class="form-select" id="penandaan_area_operasi" name="penandaan_area_operasi" aria-label="Default select ">
                <option value="Ada" {{$data_pasien->penandaan_area_operasi === 'Tidak Ada' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->penandaan_area_operasi === 'Tidak Diperlukan' ? 'selected' : '' }}>Tidak Ada</option>
                <option value="Tidak Diperlukan" {{$data_pasien->penandaan_area_operasi === 'Tidak Diperlukan' ? 'selected' : '' }} >Tidak Diperlukan</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="resiko_aspirasi" class="form-label">Resiko Aspirasi & Faktor Penyulit : </label>
            <select class="form-select" id="resiko_aspirasi" name="resiko_aspirasi" aria-label="Default select ">
                <option value="Ada" {{$data_pasien->resiko_aspirasi === 'Ada' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->resiko_aspirasi === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <div class='bagan_form'>
                <label for="resiko_aspirasi_rencana_antisipasi" class="form-label">Bila Ada Resiko, Rencana Antisipasi :</label>
                <input type="text" class="form-control" id="resiko_aspirasi_rencana_antisipasi" name="resiko_aspirasi_rencana_antisipasi" value="{{!empty($data_pasien->resiko_aspirasi_rencana_antisipasi) ? $data_pasien->resiko_aspirasi_rencana_antisipasi : ''}}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="resiko_kehilangan_darah" class="form-label">Resiko Kehilangan Darah > 500 ml(7ml/Kg Berat badan untuk anak) : </label>
            <select class="form-select" id="resiko_kehilangan_darah" name="resiko_kehilangan_darah" aria-label="Default select ">
                <option value="Tidak Ada" {{$data_pasien->resiko_kehilangan_darah === 'Tidak Ada' ? 'selected' : '' }} >Ada</option>
                <option value="Ada" {{$data_pasien->resiko_kehilangan_darah === 'Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <div class='bagan_form'>
                <label for="resiko_kehilangan_darah_line" class="form-label">Jika Ada, Jalur IV Line :</label>
                <input type="text" class="form-control" id="resiko_kehilangan_darah_line" name="resiko_kehilangan_darah_line" value="{{!empty($data_pasien->resiko_kehilangan_darah_line) ? $data_pasien->resiko_kehilangan_darah_line : ''}}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class='bagan_form'>
                <label for="resiko_kehilangan_darah_rencana_antisipasi" class="form-label">Jika Ada Resiko Kehilangan Darah, Rencana Antisipasi :</label>
                <input type="text" class="form-control" id="resiko_kehilangan_darah_rencana_antisipasi" name="resiko_kehilangan_darah_rencana_antisipasi" value="{{!empty($data_pasien->resiko_kehilangan_darah_rencana_antisipasi) ? $data_pasien->resiko_kehilangan_darah_rencana_antisipasi : ''}}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="kesiapan_alat_obat_anestesi" class="form-label">Kesiapan Alat & Obat Anestesi : </label>
            <select class="form-select" id="kesiapan_alat_obat_anestesi" name="kesiapan_alat_obat_anestesi" aria-label="Default select ">
                <option value="Lengkap"  {{$data_pasien->kesiapan_alat_obat_anestesi === 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
                <option value="Pulsa Oximetri" {{$data_pasien->kesiapan_alat_obat_anestesi === 'Pulsa Oximetri' ? 'selected' : '' }}>Pulsa Oximetri</option>
                <option value="Tidak Lengkap" {{$data_pasien->kesiapan_alat_obat_anestesi === 'Tidak Lengkap' ? 'selected' : '' }}>Tidak Lengkap</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <div class='bagan_form'>
                <label for="kesiapan_alat_obat_anestesi_rencana_antisipasi" class="form-label">Bila Tidak Lengkap, Rencana Antisipasi :</label>
                <input type="text" class="form-control" name="kesiapan_alat_obat_anestesi_rencana_antisipasi" id="kesiapan_alat_obat_anestesi_rencana_antisipasi" value="{{!empty($data_pasien->kesiapan_alat_obat_anestesi_rencana_antisipasi) ? $data_pasien->kesiapan_alat_obat_anestesi_rencana_antisipasi : ''}}">
                <div class="message"></div>
            </div>
        </div>
    </div>

<hr>
    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
            <label for="nip_perawat_ok" class="form-label">NIP <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="nip_perawat_ok" name="nip_perawat_ok" required  value="{{!empty($data_pasien->nip_perawat_ok) ? $data_pasien->nip_perawat_ok : ''}}" readonly>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="nip_perawat_ok" class="form-label">Petugas Kamar Operasi <span class="text-danger">*</span></label>
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

