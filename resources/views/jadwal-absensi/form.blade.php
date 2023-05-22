<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model->id_jadwal) ? $model->id_jadwal : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-6">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="uraian" class="form-label">Nama Uraian</label>
                        <input type="text" class="form-control" id="uraian" name='uraian' required value="{{ !empty($model->uraian) ? $model->uraian : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="jam_awal" class="form-label">Jam Masuk</label>
                        <input type="time" class="form-control" id="jam_awal" name='jam_awal' required value="{{ !empty($model->jam_awal) ? $model->jam_awal : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="jam_akhir" class="form-label">Jam Keluar</label>
                        <input type="time" class="form-control" id="jam_akhir" name='jam_akhir' required value="{{ !empty($model->jam_akhir) ? $model->jam_akhir : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="alias" class="form-label">Alias Folder</label>
                        <input type="text" class="form-control" id="alias" name='alias' required value="{{ !empty($model->alias) ? $model->alias : '' }}">
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
