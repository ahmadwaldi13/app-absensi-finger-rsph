<div class="row justify-content-start align-items-end mb-3">
    <input type="hidden" class="form-control" id="no_rawat" name="no_rawat" value="{{ !empty($data_pasien->no_rawat) ? $data_pasien->no_rawat : '' }}">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="no_rawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="no_rawat" readonly disabled required name="no_rawat" value="{{ !empty($data_pasien->no_rawat) ? $data_pasien->no_rawat : '' }}">
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
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input  readonly type="text" class="form-control input-daterange input-date-time" name="tanggal" value="{{!empty($data_pasien->tanggal) ? $data_pasien->tanggal : ''}}" id="tanggal"  required autocomplete="off">
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">SN/CN : <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="sncn" name="sncn" required  value="{{!empty($data_pasien->sncn) ? $data_pasien->sncn : ''}}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
            <label for="kd_dokter_bedah" class="form-label">Kode Dokter : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="kd_dokter_bedah" name="kd_dokter_bedah" required  value="{{!empty($data_pasien->kd_dokter_bedah) ? $data_pasien->kd_dokter_bedah : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Dokter Bedah : <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required  value="{{!empty($data_pasien->dokter_bedah) ? $data_pasien->dokter_bedah : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class='bagan_form'>
            <label for="tindakan" class="form-label">Tindakan : <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="tindakan" id="tindakan"  value="{{!empty($data_pasien->tindakan) ? $data_pasien->tindakan : ''}}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
            <label for="kd_dokter_anestesi" class="form-label">Kode Dokter : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="kd_dokter_anestesi" name="kd_dokter_anestesi" required  value="{{!empty($data_pasien->kd_dokter_anestesi) ? $data_pasien->kd_dokter_anestesi : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="kd_dokter_anestesi" class="form-label">Dokter Anestesi : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  required  value="{{!empty($data_pasien->dokter_anestesi) ? $data_pasien->dokter_anestesi : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
</div>
