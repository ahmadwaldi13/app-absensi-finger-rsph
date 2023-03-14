<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" name="key_old" value="{{ !empty($kode_key_old) ? $kode_key_old : ''  }}"  >
    <input type="hidden" class="form-control" name="fr" value="{{ !empty($model->fr) ? $model->fr : '' }}">
    <input type="hidden" class="form-control" name="no_rm" value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
    <input type="hidden" class="form-control" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">

    @include('rm-operasi.penilaian_header')
<hr class="mb-4">
    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-12 mb-3">
            <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8544;</span> Ringkasan Klinik : </label>
            <textarea class="form-control" id="ringkasan_klinik" name="ringkasan_klinik"></textarea>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8545;</span> Pemeriksaan Fisik : </label>
            <textarea class="form-control" id="pemeriksaan_fisik" name="pemeriksaan_fisik"></textarea>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8546;</span> Pemeriksaan Diagnostik : </label>
            <textarea class="form-control" id="pemeriksaan_diagnostik" name="pemeriksaan_diagnostik"></textarea>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8547;	</span> Diagnosa Pre operasi : </label>
            <textarea class="form-control" id="diagnosa_pre_operasi" name="diagnosa_pre_operasi"></textarea>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8548;</span> Rencana Tidakan Bedah : </label>
            <textarea class="form-control" id="rencana_tindakan_bedah" name="rencana_tindakan_bedah"></textarea>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8549;</span> Hal-hal Yang Perlu Dipersiapkan : </label>
            <textarea class="form-control" id="hal_hal_yang_perludi_persiapkan" name="hal_hal_yang_perludi_persiapkan"></textarea>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="abdomen" class="form-label"><span class=" me-2 fw-bold">&#8550;</span> Terapi Pre Operasi : </label>
            <textarea class="form-control" id="terapi_pre_operasi" name="terapi_pre_operasi"></textarea>
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
