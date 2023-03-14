
<form action="{{ $action_form }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <div class="row justify-content-start align-items-end">
        <div class="col-lg-3 mb-3">
            <label for="no_rawat" class="form-label">Kode Booking</label>
            <input type="text" class="form-control" id="no_rawat" readonly required name="no_rawat" value="{{ $no_rawat }}">
        </div>
        <div class="col-lg-4 mb-3">
            <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($dataPasien['no_rkm_medis']) ? $dataPasien['no_rkm_medis'] : '' }} {{ $dataPasien['nm_pasien'] }}">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="no_rawat" class="form-label">No. Peserta</label>
            <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($dataPasien['no_peserta']) ? $dataPasien['no_peserta'] : ''}}">
        </div>
    </div>


    <hr class="mb-4"> 

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="" id="checkAll">
                <label class="form-check-label mt-1 ms-3" for="checkAll">
                    Kirim semua ?
                </label>
            </div>
        </div>
        {{-- <div class="col-sm-2 mb-3 ms">
            <input class="form-check-input" type="checkbox" name="task_1" value="1" id="checkItem">
            <label class="form-check-label mt-1 ms-3">
                TaskID 1
            </label>
        </div>
        <div class="col-sm-2 mb-3">
            <input class="form-check-input" type="checkbox" name="task_2" value="2" id="checkItem">
            <label class="form-check-label mt-1 ms-3">
                TaskID 2
            </label>
        </div>
        <div class="col-sm-2 mb-3">
            <input class="form-check-input" type="checkbox" name="task_3" value="3" id="checkItem">
            <label class="form-check-label mt-1 ms-3">
                TaskID 3
            </label>
        </div> --}}
        <div class="col-sm-12 mb-3 ms">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="task_4" value="4" id="checkItem">
                <label class="form-check-label mt-1 ms-3">
                    TaskID 4
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="task_5" value="5" id="checkItem">
                <label class="form-check-label mt-1 ms-3">
                    TaskID 5
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="task_6" value="6" id="checkItem">
                <label class="form-check-label mt-1 ms-3">
                    TaskID 6
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="task_7" value="7" id="checkItem">
                <label class="form-check-label mt-1 ms-3">
                    TaskID 7
                </label>
            </div>
        </div>
    </div>

    
    <div class="row justify-content-end align-items-end table-responsive">
        <div class="col-lg-2 mt-3">
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </div>

</form>

<script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>