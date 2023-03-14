<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php
    $kode = !empty($model->kode) ? $model->kode : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">

    <div class="row justify-content-start align-items-end mb-3">

        <div class="col-lg-3">
            <div class='bagan_form'>
                <label for="kode" class="form-label">Penyakit<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="kode" name='kode' required
                    value="{{ !empty($model->kode) ? $model->kode : '' }}">
                <input type="text" hidden value="testsenyap">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class='bagan_form'>
                <label for="nama" class="form-label">Tarif Grouper<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama" name='nama' required
                    value="{{ !empty($model->nama) ? $model->nama : '' }}">
                <div class="message"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-5">
            <button class="btn btn-primary" type="submit">{{ !empty($kode) ? 'Ubah' : 'Simpan' }}</button>
        </div>
    </div>
</form>
