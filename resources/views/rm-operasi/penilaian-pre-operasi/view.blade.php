<div class="row justify-content-start align-items-end mb-3">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="norawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="norawat" readonly disabled required  value="{{ !empty($form_header->no_rawat) ? $form_header->no_rawat : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value=" {{ !empty($form_header->no_rm) ? $form_header->no_rm : '' }}">
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
        <div class='bagan_form'>
            <label for="tanggal_permintaan" class="form-label">Tanggal Lahir :</label>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($form_header->tgl_lahir) ? $form_header->tgl_lahir : '' }}">
            <div class="message"></div>
        </div>
    </div>
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
        <div class='bagan_form'>
        <label for="kd_dokter" class="form-label">Tanggal :<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="Tanggal" name='Tanggal' readonly required value="{{ !empty($data_pasien->tanggal) ? $data_pasien->tanggal : '' }}">
            <div class="message"></div>
        </div>
    </div>
</div>

<div class="row justify-content-start align-items-end mb-4">

</div>

<hr class="mb-4">
<div class="row justify-content-start align-items-end mb-3">
    <div class="col-lg-12 mb-3">
        <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8544;</span> Ringkasan Klinik : </label>
        <textarea class="form-control" id="ringkasan_klinik" name="ringkasan_klinik" readonly>{{ !empty($data_pasien->ringkasan_klinik) ? $data_pasien->ringkasan_klinik : '' }}</textarea>
    </div>
    <div class="col-lg-12 mb-3">
        <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8545;</span> Pemeriksaan Fisik : </label>
        <textarea class="form-control" id="pemeriksaan_fisik" name="pemeriksaan_fisik" readonly>{{ !empty($data_pasien->pemeriksaan_fisik) ? $data_pasien->pemeriksaan_fisik : '' }}</textarea>
    </div>
    <div class="col-lg-12 mb-3">
        <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8546;</span> Pemeriksaan Diagnostik : </label>
        <textarea class="form-control" id="pemeriksaan_diagnostik" name="pemeriksaan_diagnostik" readonly>{{ !empty($data_pasien->pemeriksaan_diagnostik) ? $data_pasien->pemeriksaan_diagnostik : '' }}</textarea>
    </div>
    <div class="col-lg-12 mb-3">
        <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8547;	</span> Diagnosa Pre operasi : </label>
        <textarea class="form-control" id="diagnosa_pre_operasi" name="diagnosa_pre_operasi" readonly>{{ !empty($data_pasien->diagnosa_pre_operasi) ? $data_pasien->diagnosa_pre_operasi : '' }}</textarea>
    </div>
    <div class="col-lg-12 mb-3">
        <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8548;</span> Rencana Tidakan Bedah : </label>
        <textarea class="form-control" id="rencana_tindakan_bedah" name="rencana_tindakan_bedah" readonly>{{ !empty($data_pasien->rencana_tindakan_bedah) ? $data_pasien->rencana_tindakan_bedah : '' }}</textarea>
    </div>
    <div class="col-lg-12 mb-3">
        <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8549;</span> Hal-hal Yang Perlu Dipersiapkan : </label>
        <textarea class="form-control" id="hal_hal_yang_perludi_persiapkan" name="hal_hal_yang_perludi_persiapkan" readonly>{{ !empty($data_pasien->hal_hal_yang_perludi_persiapkan) ? $data_pasien->hal_hal_yang_perludi_persiapkan : '' }}</textarea>
    </div>
    <div class="col-lg-12 mb-3">
        <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8550;</span> Terapi Pre Operasi : </label>
        <textarea class="form-control" id="terapi_pre_operasi" name="terapi_pre_operasi" readonly>{{ !empty($data_pasien->terapi_pre_operasi) ? $data_pasien->terapi_pre_operasi : '' }}</textarea>
    </div>
</div>
