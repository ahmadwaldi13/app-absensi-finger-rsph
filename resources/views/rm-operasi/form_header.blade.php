<div class="row justify-content-start align-items-end mb-3">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="no_rawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="no_rawat" readonly disabled required  value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" readonly disabled required  value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control"  readonly disabled required  value="{{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='input-date-time-bagan'>
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir :</label>
            <input type="text" class="form-control" readonly disabled required value="{{ !empty($model->tgl_lahir) ? $model->tgl_lahir : '' }}">
        </div>
    </div>
</div>

<div class="row justify-content-start align-items-end mb-4">
    <div class="col-lg-3 mb-3">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input  readonly type="text" class="form-control input-daterange input-date-time" name="tanggal" value="{{!empty($data_pasien->tanggal) ? $penilaian->tanggal : ''}}" id="tanggal"  required autocomplete="off">
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">SN/CN : <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="sncn" name="sncn" required  value="{{!empty($sncn->tanggal) ? $sncn->tanggal : ''}}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
        <label for="kd_dokter_bedah" class="form-label">Kode Dokter <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kd_dokter_bedah" name='kd_dokter_bedah' readonly required value="{{ !empty($model->nip) ? $model->nip : '' }}">
            <div class="message"></div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="nm_dokter_bedah" class="form-label">Dokter Bedah <span class="text-danger">*</span></label>
            <div class="button-icon-inside">
                <input type="text" class="input-text" id='nm_dokter_bedah' name="nm_dokter_bedah" readonly disabled value="{{ !empty($model->nm_pegawai) ? $model->nm_pegawai : '' }}" />
                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_dokter') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Data Dokter' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#kd_dokter_bedah|#nm_dokter_bedah|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                </span>
                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
            </div>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class='bagan_form'>
            <label for="tindakan" class="form-label">Tindakan : <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="tindakan" id="tindakan"  value="{{!empty($data_pasien->tanggal) ? $penilaian->tanggal : ''}}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
        <label for="kd_dokter_anestesi" class="form-label">Kode Dokter <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kd_dokter_anestesi" name='kd_dokter_anestesi' readonly required value="{{ !empty($model->nip) ? $model->nip : '' }}">
            <div class="message"></div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="nm_dokter_anestesi" class="form-label">Dokter Anestesi <span class="text-danger">*</span></label>
            <div class="button-icon-inside">
                <input type="text" class="input-text" id='nm_dokter_anestesi' name="nm_dokter_anestesi" readonly disabled value="{{ !empty($model->nm_pegawai) ? $model->nm_pegawai : '' }}" />
                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_dokter') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Data Dokter' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#kd_dokter_anestesi|#nm_dokter_anestesi|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                </span>
                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
            </div>
            <div class="message"></div>
        </div>
    </div>
</div>
