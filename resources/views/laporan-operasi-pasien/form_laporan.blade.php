<form id='form-laporan-operasi-pasien' action="{{ $action_form }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" class="form-control" name="fr" value="{{ $model->fr ?? '' }}">
    <input type="hidden" class="form-control" name="no_rm" value="{{ $model->no_rm ?? '' }}">
    <input type="hidden" class="form-control" name="no_rawat" value="{{ $model->no_rawat ?? '' }}">
    <input type="hidden" class="form-control" name="tanggal" value="{{ $model->tanggal ?? '' }}">
    
    <div class="row justify-content-start align-items-start mb-3">
        <div class="col-lg-4">
            <div class='input-date-time-bagan mb-3'>
                <label for="tanggal" class="form-label">Selesai :</label>
                <input type="text" class="form-control input-daterange input-date-time" id='tanggal' autocomplete="off">
                <input type="hidden" id="tgl" required name="tgl_selesai" value="{{ !empty($model->tgl_selesai) ? $model->tgl_selesai : date('Y-m-d') }}">
                <input type="hidden" id="jam" required name="jam_selesai" value="{{ !empty($model->jam_selesai) ? $model->jam_selesai : date('H:i:s') }}">
            </div>
            
            <div class='mb-3'>
                <label for="form-1" class="form-label">Diagnosis pre-operatif :</label>
                <input type="text" class="form-control" maxlength="100" name="diagnosa_preop" id="form-1" value="{{ !empty($model->diagnosa_preop) ? $model->diagnosa_preop : '' }}">
            </div>

            <div class='mb-3'>
                <label for="form-2" class="form-label">Diagnosis post-operatif :</label>
                <input type="text" class="form-control" maxlength="100" name="diagnosa_postop" id="form-2" value="{{ !empty($model->diagnosa_postop) ? $model->diagnosa_postop : '' }}">
            </div>
            
            <div class='mb-3'>
                <label for="form-3" class="form-label">Jaringan di-Eksisi / -Insisi : </label>
                <input type="text" class="form-control" maxlength="100" name="jaringan_dieksekusi" id="form-3" value="{{ !empty($model->jaringan_dieksekusi) ? $model->jaringan_dieksekusi : '' }}">
            </div>
            
            <div class='mb-3'>
                <label for="form-4" class="form-label">Dikirim Pemeriksaan PA :</label>
                <select class="form-select input-dropdown" name="permintaan_pa" aria-label="Default select example" id="form-4">
                    @foreach ($data_permintaan_pa as $key => $value)
                        <option value="{{ $value }}" {{ strtolower($value)==(!empty($model->permintaan_pa) ? strtolower($model->permintaan_pa) : '' ) ? 'selected' : '' }} >{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-8">
            <label for="form-5" class="form-label">Laporan : </label>
            <textarea class="form-control" id="form-5" name="laporan_operasi" rows="25">{{ !empty($model->laporan_operasi) ? $model->laporan_operasi : '' }}</textarea>
        </div>
    </div>

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-2 mb-3">
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
        <div class="col-lg-2 mb-3">
            <div class="d-grid gap-2">
                <button class="btn btn-danger" data-bs-dismiss='modal' type="button">Batal</button>
            </div>
        </div>
    </div>
</form>
<script>
$(document).find('.input-date-time').each(function () {

let parent=$(this).parent('.input-date-time-bagan');
let form_tgl=( typeof parent.find('#tgl')) ? parent.find('#tgl').val() : null ;
let form_jam=( typeof parent.find('#jam')) ? parent.find('#jam').val() : null ;

let date_this='';
if( (!form_tgl) || (!form_jam) ){
    date_this=new Date();
}else{
    date_this=form_tgl+' - '+form_jam;
}

$(this).daterangepicker({
    singleDatePicker: true,
    startDate: date_this,
    locale: {
        format: "YYYY-MM-DD - HH:mm",
    },
    timePicker: true,
    showDropdowns: true,
    linkedCalendars: false,
});
});


$(document).find(".input-date-time").on("change keyup", function () {
    let parent=$(this).parent('.input-date-time-bagan');
    let form_tgl=( typeof parent.find('#tgl')) ? parent.find('#tgl') : null ;
    let form_jam=( typeof parent.find('#jam')) ? parent.find('#jam') : null ;

    if(form_tgl.length && form_jam.length){
        let date = $(this).val();
        let tgl = date.substring(0, 10);
        let jam = date.substring(13);

        parent.find("#tgl").val(tgl);
        parent.find("#jam").val(jam);
    }
});
</script>