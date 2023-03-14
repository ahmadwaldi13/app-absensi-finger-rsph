<div class="row justify-content-start align-items-end mb-3">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="norawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="norawat" readonly disabled required name="no_rawat"  value="{{ !empty($form_header->no_rawat) ? $form_header->no_rawat : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($form_header->no_rm) ? $form_header->no_rm : '' }} {{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($model->no_rm) ? $model->no_rm : '' }} {{ !empty($form_header->nm_pasien) ? $form_header->nm_pasien : '' }}">
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
            <label for="norawat" class="form-label">J.K. :</label>
            <input type="text" class="form-control" id="norawat" readonly disabled required  value="{{ !empty($form_header->jk) ? $form_header->jk : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
        <label for="kd_dokter" class="form-label">Kode Dokter <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kd_dokter" name='kd_dokter' readonly required value="{{ !empty($data_pasien->kd_dokter) ? $data_pasien->kd_dokter : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
        <label for="kd_dokter" class="form-label">Dokter <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kd_dokter" name='kd_dokter' readonly required value="{{ !empty($data_pasien->kd_dokter) ? $data_pasien->kd_dokter : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <label for="tanggal" class="form-label">tanggal :</label>
        <input  type="text" class="form-control input-daterange input-date-time" name="tanggal" value="{{!empty($data_pasien->tanggal) ? $data_pasien->tanggal : ''}}" id="tanggal"  required autocomplete="off">
    </div>
</div>
