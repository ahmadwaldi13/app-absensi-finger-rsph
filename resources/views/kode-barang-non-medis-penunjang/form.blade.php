<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model->kd_jenis) ? $model->kd_jenis : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-4">
            <div class='bagan_form'>
                <label for="kd_jenis" class="form-label">Kode Jenis</label>
                <input type="text" class="form-control" id="kd_jenis" name='kd_jenis' required
                    value="{{ !empty($model->kd_jenis) ? $model->kd_jenis : '' }}">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class='bagan_form'>
                <label for="nm_jenis" class="form-label">Jenis Barang</label>
                <input type="text" class="form-control" id="nm_jenis" name='nm_jenis' required
                    value="{{ !empty($model->nm_jenis) ? $model->nm_jenis : '' }}">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class='bagan_form'>
                <label for="prefix" class="form-label">Prefix/Kode Barang</label>
                <input type="text" class="form-control" id="prefix" name='prefix' required
                    value="{{ !empty($model->prefix) ? $model->prefix : '' }}">
                <div class="message"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-5">
            <button class="btn btn-primary" type="submit">{{ !empty($kode) ? 'Ubah' : 'Simpan'  }}</button>
        </div>
    </div>
</form>
