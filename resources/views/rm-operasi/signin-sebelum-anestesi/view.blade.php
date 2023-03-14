<div class="row justify-content-start align-items-end mb-3">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="no_rawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="no_rawat" readonly disabled required  value="{{ !empty($form_header->no_rawat) ? $form_header->no_rawat : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($form_header->no_rm) ? $form_header->no_rm : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($form_header->nm_pasien) ? $form_header->nm_pasien : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='input-date-time-bagan'>
            <label for="tanggal_permintaan" class="form-label">Tanggal Lahir :</label>
            <input type="text" class="form-control" id="tanggal" readonly disabled required name="tanggal" value="{{ !empty($form_header->tgl_lahir) ? $form_header->tgl_lahir : '' }}">
        </div>
    </div>
</div>

<div class="row justify-content-start align-items-end mb-4">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Tanggal :<span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->tanggal) ? $data_pasien->tanggal : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">SN/CN : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->sncn) ? $data_pasien->sncn : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Kode Dokter : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->kd_dokter_bedah) ? $data_pasien->kd_dokter_bedah : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Dokter Bedah : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->dokter_bedah) ? $data_pasien->dokter_bedah : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class='bagan_form'>
            <label for="tindakan" class="form-label">Tindakan : <span class="text-danger">*</span></label>
            <input type="text" class="form-control" readonly name="tindakan" id="tindakan"  value="{{ !empty($data_pasien->tindakan) ? $data_pasien->tindakan : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Kode Dokter : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->kd_dokter_anestesi) ? $data_pasien->kd_dokter_anestesi : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Dokter Anestesi : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->dokter_anestesi) ? $data_pasien->dokter_anestesi : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
</div>
<hr class="mb-5">
    <div class="row justify-content-start align-items-end mb-4">
        <p>Perawat OK & Tim Anestesi Mengkonfirmasi :</p>
        <div class="col-lg-4 mb-3">
            <label for="identitas" class="form-label">Indentitas : </label>
            <input type="text" class="form-control"  id="identitas" name="identitas" required  value="{{!empty($data_pasien->identitas) ? $data_pasien->identitas : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="alergi" class="form-label">Alergi : </label>
            <input type="text" class="form-control"  id="alergi" name="alergi" required  value="{{!empty($data_pasien->alergi) ? $data_pasien->alergi : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="penandaan_area_operasi" class="form-label">Penandaan Area Operasi : </label>
            <input type="text" class="form-control"  id="penandaan_area_operasi" name="penandaan_area_operasi" required  value="{{!empty($data_pasien->penandaan_area_operasi) ? $data_pasien->penandaan_area_operasi : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="resiko_aspirasi" class="form-label">Resiko Aspirasi & Faktor Penyulit : </label>
            <input type="text" class="form-control"  id="resiko_aspirasi" name="resiko_aspirasi" required  value="{{!empty($data_pasien->resiko_aspirasi) ? $data_pasien->resiko_aspirasi : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="resiko_aspirasi_rencana_antisipasi" class="form-label">Bila Ada Resiko, Rencana Antisipasi :</label>
            <input type="text" class="form-control"  id="resiko_aspirasi_rencana_antisipasi" name="resiko_aspirasi_rencana_antisipasi" required  value="{{!empty($data_pasien->resiko_aspirasi_rencana_antisipasi) ? $data_pasien->resiko_aspirasi_rencana_antisipasi : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="resiko_kehilangan_darah" class="form-label">Resiko Kehilangan Darah > 500 ml(7ml/Kg Berat badan untuk anak) : </label>
            <input type="text" class="form-control"  id="resiko_kehilangan_darah" name="resiko_kehilangan_darah" required  value="{{!empty($data_pasien->resiko_kehilangan_darah) ? $data_pasien->resiko_kehilangan_darah : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="resiko_kehilangan_darah_line" class="form-label">Jika Ada, Jalur IV Line :</label>
            <input type="text" class="form-control"  id="resiko_kehilangan_darah_line" name="resiko_kehilangan_darah_line" required  value="{{!empty($data_pasien->resiko_kehilangan_darah_line) ? $data_pasien->resiko_kehilangan_darah_line : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class='bagan_form'>
                <label for="resiko_kehilangan_darah_rencana_antisipasi" class="form-label">Jika Ada Resiko Kehilangan Darah, Rencana Antisipasi :</label>
                <input type="text" class="form-control" readonly id="resiko_kehilangan_darah_rencana_antisipasi" name="resiko_kehilangan_darah_rencana_antisipasi" value="{{!empty($data_pasien->resiko_kehilangan_darah_rencana_antisipasi) ? $data_pasien->resiko_kehilangan_darah_rencana_antisipasi : ''}}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="resiko_kehilangan_darah_line" class="form-label">Kesiapan Alat & Obat Anestesi : </label>
            <input type="text" class="form-control"  id="resiko_kehilangan_darah_line" name="resiko_kehilangan_darah_line" required  value="{{!empty($data_pasien->resiko_kehilangan_darah_line) ? $data_pasien->resiko_kehilangan_darah_line : ''}}" readonly>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="kesiapan_alat_obat_anestesi" class="form-label">Bila Tidak Lengkap, Rencana Antisipasi :</label>
            <input type="text" class="form-control"  id="kesiapan_alat_obat_anestesi" name="kesiapan_alat_obat_anestesi" required  value="{{!empty($data_pasien->kesiapan_alat_obat_anestesi) ? $data_pasien->kesiapan_alat_obat_anestesi : ''}}" readonly>
            <div class="message"></div>
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
                    <label for="nip_perawat_ok" class="form-label">Petugas Kamar Operasi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  id="nip_perawat_ok" name="nip_perawat_ok" required  value="{{!empty($data_pasien->petugas_ok) ? $data_pasien->petugas_ok : ''}}" readonly>
                        <div class="message"></div>
                    </div>
            </div>
    </div>
</div>
