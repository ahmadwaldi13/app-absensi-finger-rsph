<div class="row justify-content-start align-items-end mb-3">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="norawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="norawat" readonly disabled required  value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($model->no_rm) ? $model->no_rm : '' }} {{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($model->no_rm) ? $model->no_rm : '' }} {{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='input-date-time-bagan'>
            <label for="tanggal_permintaan" class="form-label">Tanggal Lahir :</label>
            <input type="text" class="form-control" id="tanggal" readonly disabled required name="tanggal" value="{{ !empty($model->tgl_lahir) ? $model->tgl_lahir : '' }}">
        </div>
    </div>
</div>

<div class="row justify-content-start align-items-end mb-4">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="norawat" class="form-label">J.K. :</label>
            <input type="text" class="form-control" id="norawat" readonly disabled required  value="{{ !empty($model->jk) ? $model->jk : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
        <label for="kd_dokter" class="form-label">Kode Dokter <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kd_dokter" name='kd_dokter' readonly required value="{{ !empty($model->nip) ? $model->nip : '' }}">
            <div class="message"></div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="nm_dokter_anestesi" class="form-label">Dokter<span class="text-danger">*</span></label>
            <div class="button-icon-inside">
                <input type="text" class="input-text" id='nm_dokter_anestesi' name="nm_dokter_anestesi" readonly disabled value="{{ !empty($model->nm_pegawai) ? $model->nm_pegawai : '' }}" />
                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_dokter') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Data Dokter' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#kd_dokter|#nm_dokter_anestesi|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                </span>
                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
            </div>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='input-date-time-bagan'>
            <label for="tanggal_permintaan" class="form-label">Tanggal : <span class="text-danger">*</span></label>
            <input type="text" class="form-control input-daterange input-date-time" id='tanggal' autocomplete="off">
            <input type="hidden" id="tgl" required name="tanggal" value="{{ !empty($model->tgl_permintaan) ? $model->tgl_permintaan : date('Y-m-d') }}">
        </div>
    </div>
</div>
