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
<div class="row justify-content-start align-items-end mb-3">
    <p>Sebelum Menutup Luka & Meninggalkan Kamar Operasi :</p>
    <p>Perawat Melakukan Konfirmasi Secara Verbal :</p>
    <div class="col-lg-3 mb-3">
        <label for="verbal_tindakan" class="form-label">Tidakan : </label>
        <input type="text" class="form-control"  id="verbal_tindakan" name="verbal_tindakan" required  value="{{!empty($data_pasien->verbal_tindakan) ? $data_pasien->verbal_tindakan : ''}}" readonly>
            <div class="message"></div>
    </div>
    <div class="col-lg-3 mb-3">
        <label for="verbal_kelengkapan_kasa" class="form-label">Kelengkapan Kasa : </label>
        <input type="text" class="form-control"  id="verbal_kelengkapan_kasa" name="verbal_kelengkapan_kasa" required  value="{{!empty($data_pasien->verbal_kelengkapan_kasa) ? $data_pasien->verbal_kelengkapan_kasa : ''}}" readonly>
        <div class="message"></div>
    </div>
    <div class="col-lg-3 mb-3">
        <label for="verbal_instrumen" class="form-label">Instrumen : </label>
        <input type="text" class="form-control"  id="verbal_instrumen" name="verbal_instrumen" required  value="{{!empty($data_pasien->verbal_instrumen) ? $data_pasien->verbal_instrumen : ''}}" readonly>
        <div class="message"></div>
    </div>
    <div class="col-lg-3 mb-3">
        <label for="verbal_alat_tajam" class="form-label">Alat Tajam : </label>
        <input type="text" class="form-control"  id="verbal_alat_tajam" name="verbal_alat_tajam" required  value="{{!empty($data_pasien->verbal_alat_tajam) ? $data_pasien->verbal_alat_tajam : ''}}" readonly>
        <div class="message"></div>
    </div>
</div>
<div class="row justify-content-start align-items-end mb-3">
    <p>Kelengkapan Spesiemen Jika Ada :</p>
    <div class="col-lg-6 mb-3">
        <label for="kelengkapan_specimen_label" class="form-label">Label : </label>
        <div class="d-flex">
            <input type="text" class="form-control"  id="kelengkapan_specimen_label" name="kelengkapan_specimen_label" required  value="{{!empty($data_pasien->kelengkapan_specimen_label) ? $data_pasien->kelengkapan_specimen_label : ''}}" readonly>
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <label for="kelengkapan_specimen_formulir" class="form-label">Formulir : </label>
        <div class="d-flex">
            <input type="text" class="form-control"  id="kelengkapan_specimen_formulir" name="kelengkapan_specimen_formulir" required  value="{{!empty($data_pasien->kelengkapan_specimen_formulir) ? $data_pasien->kelengkapan_specimen_formulir : ''}}" readonly>
        </div>
    </div>
</div>
<div class="row justify-content-start align-items-end mb-3">
    <p>Peninjauan Kembali Kegiatan :</p>
    <div class="col-lg-4 mb-3">
        <label for="peninjauan_kegiatan_dokter_bedah" class="form-label">Dokter Bedah : </label>
        <div class="d-flex">
            <input type="text" class="form-control"  id="peninjauan_kegiatan_dokter_bedah" name="peninjauan_kegiatan_dokter_bedah" required  value="{{!empty($data_pasien->peninjauan_kegiatan_dokter_bedah) ? $data_pasien->peninjauan_kegiatan_dokter_bedah : ''}}" readonly>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <label for="peninjauan_kegiatan_dokter_anestesi" class="form-label">Dokter Anestesi : </label>
        <div class="d-flex">
            <input type="text" class="form-control"  id="peninjauan_kegiatan_dokter_anestesi" name="peninjauan_kegiatan_dokter_anestesi" required  value="{{!empty($data_pasien->peninjauan_kegiatan_dokter_anestesi) ? $data_pasien->peninjauan_kegiatan_dokter_anestesi : ''}}" readonly>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <label for="peninjauan_kegiatan_perawat_kamar_ok" class="form-label">Perawat Kamar Operasi : </label>
        <div class="d-flex">
            <input type="text" class="form-control"  id="peninjauan_kegiatan_perawat_kamar_ok" name="peninjauan_kegiatan_perawat_kamar_ok" required  value="{{!empty($data_pasien->peninjauan_kegiatan_perawat_kamar_ok) ? $data_pasien->peninjauan_kegiatan_perawat_kamar_ok : ''}}" readonly>
        </div>
    </div>
    <div class="col-lg-12 mb-3">
        <label for="perhatian_utama_fase_pemulihan" class="form-label">Perhatian Utama Fase Pemulihan : </label>
        <input type="text" readonly class="form-control" id="perhatian_utama_fase_pemulihan" value="{{!empty($data_pasien->perhatian_utama_fase_pemulihan) ? $data_pasien->perhatian_utama_fase_pemulihan : ''}}" name="perhatian_utama_fase_pemulihan">
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
                <label for="nip_perawat_ok" class="form-label">Perawat Kamar Operasi :<span class="text-danger">*</span></label>
                <input type="text" class="form-control"  id="nip_perawat_ok" name="nip_perawat_ok" required  value="{{!empty($data_pasien->petugas_ok) ? $data_pasien->petugas_ok : ''}}" readonly>
                    <div class="message"></div>
                </div>
        </div>
</div>
</div>
