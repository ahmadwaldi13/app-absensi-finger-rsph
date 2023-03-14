<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form action="{{ $action_form }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="text" value="{{ !empty($model->fr) ? $model->fr : $item_pasien->no_fr }}" hidden name="fr">
    <input type="text" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }}" hidden name="no_rm">

    <input type="text" value="{{ !empty($model->id_soap_farmasi) ? $model->id_soap_farmasi : '' }}" hidden name="id_soap_farmasi">
    <div class="row justify-content-start align-items-end">
        <div class="col-lg-2 mb-3">
            <label for="norawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="norawat" readonly required name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : $item_pasien->no_rawat }}">
        </div>
        <div class="col-lg-4 mb-3">
            <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }} {{ $dataPasien['nm_pasien'] }}">
        </div>
        <div class="col-lg-2 mb-3">
            <label for="kodeDokter" class="form-label">Dilakukan</label>
            <input type="text" aria-label=" input kodeDokter" readonly  class="form-control readonly" id="nik" name="nik" value="{{$get_user->pegawai['nik']}}">
        </div>
        <div class="col-lg-4 mb-3">
            <div class="button-icon-inside d-flex justify-content-between pe-4">
                <input type="text" readonly class="input-text" id="namaPetugas" value="{{$get_user->pegawai['nama']}}"/>
            </div>
        </div>
    </div>


    <hr class="mb-4"> 

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-6 mb-3">
            <label for="subjek" class="form-label">Subjek :<span class="text-danger">*</span></label>
            <textarea class="form-control" id="subjek" name="subjek" rows="3" required>{{ !empty($model->subjek) ? $model->subjek : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="objek" class="form-label">Objek :<span class="text-danger">*</span></label>
            <textarea class="form-control" id="objek" name="objek" rows="3" required>{{ !empty($model->objek) ? $model->objek : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="asesmen" class="form-label">Assessment : <span class="text-danger">*</span></label>
            <textarea class="form-control" id="assessment" rows="3" required name="assessment">{{ !empty($model->assessment) ? $model->assessment : '' }}</textarea>
        </div>
        
        <div class="col-lg-6 mb-3">
            <label for="plan" class="form-label">Plan :</label>
            <textarea class="form-control" id="plan" rows="3" name="plan">{{ !empty($model->plan) ? $model->plan : '' }}</textarea>
        </div>
    </div>

    
    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-2 mb-3">
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </div>

</form>

<script>
    $("#tanggal")
        .daterangepicker({
            singleDatePicker: true,
            startDate: `${$("#tgl").val()} - ${$("#jam").val()}`,
            locale: {
                format: "YYYY-MM-DD - HH:mm:ss",
            },
            timePicker: true,
            showDropdowns: true,
            linkedCalendars: false,
            timePickerSeconds: true,
        });
    
    $("#tanggal").on("change keyup", function () {
        let date = $(this).val();
        let tgl = date.substring(0, 10);
        let jam = date.substring(13);

        $("#tgl").val(tgl);
        $("#jam").val(jam);
    });
</script>