<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model->id_variable) ? $model->id_variable : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">

    <div class="row justify-content-start mb-3">
        <div class="col-lg-6 mb-3">
            <div class='bagan_form '>
                <label for="nm_variable" class="form-label">Nama Variabel <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nm_variable" name='nm_variable' required value="{{ !empty($model->nm_variable) ? $model->nm_variable : '' }}">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-6 mb-3">
            <div class='bagan_form '>
                <label for="value_variable" class="form-label">Nilai Variabel</label>
                <input type="text" class="form-control" id="value_variable" name='value_variable' value="{{ !empty($model->value_variable) ? $model->value_variable : '' }}">
                <div class="message"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-end ">
        <div class="col-lg-1">
            <button class="btn btn-primary" type="submit">{{ !empty($kode) ? 'Ubah' : 'Simpan'  }}</button>
        </div>
    </div>
</form>