<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form action="{{ $action_form }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="text" value="{{ !empty($model->fr) ? $model->fr : $item_pasien->no_fr }}" hidden name="fr">
    <input type="text" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }}" hidden name="no_rm">

    {{-- <input type="text" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}" hidden name="no_rawat"> --}}
    <div class="row justify-content-start align-items-end">
        <div class="col-lg-2 mb-3">
            <label for="no_rawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="no_rawat" readonly required name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : $item_pasien->no_rawat }}">
        </div>
        <div class="col-lg-4 mb-3">
            <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }} {{ $dataPasien['nm_pasien'] }}">
        </div>
        <div class="col-lg-2 mb-3">
            <label for="kodeDokter" class="form-label">Operator</label>
            <input type="text" aria-label=" input kodeDokter" readonly  class="form-control readonly" id="kd_dokter" name="kd_dokter" value="{{ !empty($model->kd_dokter) ? $model->kd_dokter : ''  }}">
        </div>
        <div class="col-lg-4 mb-3">
            <div class="button-icon-inside d-flex justify-content-between pe-4">
                <input type="text" readonly class="input-text" id="nm_dokter" value="{{ !empty($model->nm_dokter) ? $model->nm_dokter : ''  }}"/>
            </div>
        </div>
    </div>


    <hr class="mb-4"> 

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-3 mb-3">
            <label for="subjek" class="form-label">Tanggal :<span class="text-danger">*</span></label>
            <span class='icon-bagan-date'></span>
                <input type="text" class="form-control daterangePatient" id="tanggal" name='tanggal' required value="{{ !empty($model->tanggal) ? $model->tanggal : ''  }}">
            <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai :<span class="text-danger">*</span></label>
                <input type="time" class="form-control input-daterange" id='jam_mulai' name="jam_mulai" value="{{ !empty($model->jam_mulai) ? $model->jam_mulai : '00:00' }}" />
            <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai :<span class="text-danger">*</span></label>
                <input type="time" class="form-control input-daterange" id='jam_selesai' name="jam_selesai" value="{{ !empty($model->jam_mulai) ? $model->jam_mulai : '00:00' }}" />
            <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="objek" class="form-label">Status :<span class="text-danger">*</span></label>
            <select class="form-select" name="status" id="status" required>
                <option value="Menunggu" {{($model->status === 'Menunggu') ? 'Selected' : 'Menunggu'}}>Menunggu</option>
                <option value="Proses Operasi" {{($model->status === 'Proses Operasi') ? 'Selected' : 'Proses Operasi'}}>Proses Operasi</option>
                <option value="Selesai" {{($model->status === 'Selesai') ? 'Selected' : 'Selesai'}}>Selesai</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="asesmen" class="form-label">Operasi : <span class="text-danger">*</span></label>
            <input type="hidden" class="form-control" id="kode_paket" name='kode_paket' required value="{{ !empty($model->kode_paket) ? $model->kode_paket : ''  }}">
            <input type="text" class="form-control" id="nm_perawatan" name='nm_perawatan' required value="{{ !empty($model->nm_perawatan) ? $model->nm_perawatan : ''  }}" readonly>
        </div>
        
        <div class="col-lg-6 mb-3">
            <label for="plan" class="form-label">Ruang OK : <span class="text-danger">*</span></label>
            <select class="form-select" name="kd_ruang_ok" id="kd_ruang_ok" required>
                @foreach($ruangOK as $items => $value)
                    <option value="{{ $value['kd_ruang_ok'] }}" {{ $value['kd_ruang_ok'] == $model->kd_ruang_ok ? 'selected' : '' }}>{{ $value['nm_ruang_ok'] }}</option>
                @endforeach
            </select>
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
    // $("#tanggal")
    //     .daterangepicker({
    //         singleDatePicker: true,
    //         startDate: `${$("#tgl").val()} - ${$("#jam").val()}`,
    //         locale: {
    //             format: "YYYY-MM-DD - HH:mm:ss",
    //         },
    //         timePicker: true,
    //         showDropdowns: true,
    //         linkedCalendars: false,
    //         timePickerSeconds: true,
    //     });
    
    // $("#tanggal").on("change keyup", function () {
    //     let date = $(this).val();
    //     let tgl = date.substring(0, 10);
    //     let jam = date.substring(13);

    //     $("#tgl").val(tgl);
    //     $("#jam").val(jam);
    // });
</script>