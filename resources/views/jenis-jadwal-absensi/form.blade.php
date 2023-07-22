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

        <div class="col-lg-12">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-3">
                    <div class='bagan_form'>
                        <label for="masuk_kerja" class="form-label">Jam Masuk Kerja</label>
                        <input type="time" class="form-control input-daterange" id="masuk_kerja" name='masuk_kerja' required value="{{ !empty($model->masuk_kerja) ? $model->masuk_kerja : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class='bagan_form'>
                        <label for="pulang_kerja" class="form-label">Jam Pulang Kerja</label>
                        <input type="time" class="form-control input-daterange" id="pulang_kerja" name='pulang_kerja' required value="{{ !empty($model->pulang_kerja) ? $model->pulang_kerja : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class='bagan_form'>
                        <label for="awal_istirahat" class="form-label">Awal Istirahat</label>
                        <input type="time" class="form-control input-daterange" id="awal_istirahat" name='awal_istirahat' required value="{{ !empty($model->awal_istirahat) ? $model->awal_istirahat : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class='bagan_form'>
                        <label for="akhir_istirahat" class="form-label">Akhir Istirahat</label>
                        <input type="time" class="form-control input-daterange" id="akhir_istirahat" name='akhir_istirahat' required value="{{ !empty($model->akhir_istirahat) ? $model->akhir_istirahat : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-5">
            <button class="btn btn-primary validate_submit" type="submit">{{ !empty($kode) ? 'Ubah' : 'Simpan'  }}</button>
        </div>
    </div>
</form>
