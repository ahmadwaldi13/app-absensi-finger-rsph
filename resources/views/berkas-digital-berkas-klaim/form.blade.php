<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php
    $kode = !empty($model->id) ? $model->id : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-4">
            <div class='bagan_form'>
                <label for="kd_jenis" class="form-label">Nama Berkas Klaim<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama" name='nama' required
                    value="{{ !empty($model->nama) ? $model->nama : '' }} " disabled>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class='bagan_form'>
                <label for="prefix" class="form-label">Status Aktif</label>
                <div class="form-check form-switch">
                    <?php $checked=!empty($model->status) ? ($model->status == 1 ? 'checked' : '') : ''; ?>
                    <input class="form-check-input" type="checkbox" name="status" value="1" {{ $checked }} id="flexSwitchCheckChecked">
                    <div class="message"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-5">
            <button class="btn btn-primary" type="submit">{{ !empty($kode) ? 'Ubah' : 'Simpan' }}</button>
        </div>
    </div>
</form>
