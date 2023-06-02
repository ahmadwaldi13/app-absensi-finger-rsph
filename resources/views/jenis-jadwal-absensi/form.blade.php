<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model->id_jenis_jadwal) ? $model->id_jenis_jadwal : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-6">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_jenis_jadwal" class="form-label">Nama Jadwal</label>
                        <input type="text" class="form-control" id="nm_jenis_jadwal" name='nm_jenis_jadwal' required value="{{ !empty($model->nm_jenis_jadwal) ? $model->nm_jenis_jadwal : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-5">
            <button class="btn btn-primary" type="submit">{{ !empty($kode) ? 'Ubah' : 'Simpan'  }}</button>
        </div>
    </div>
</form>
