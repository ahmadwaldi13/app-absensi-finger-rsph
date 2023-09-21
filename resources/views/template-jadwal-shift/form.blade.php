<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php
        $kode=!empty($model->id_jadwal) ? $model->id_jadwal : '';
    ?>  
    <input type="hidden" name="key_old" value="{{ $kode }}">

    <div class="row d-flex justify-content-between">
        <div class="col-md-12">
            <div class="row justify-content-start align-items-end mb-3">

                <div class="col-lg-4">
                    <div class='bagan_form'>
                        <label for="nm_shift" class="form-label">Nama Shift <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nm_shift" name='nm_shift' required value="{{ !empty($model->nm_shift) ? $model->nm_shift : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
                
                <div class="col-lg-3">
                    <div class='bagan_form'>
                        <div class='input-date-bagan'>
                            <label for="tgl_mulai" class="form-label">Tgl. Mulai <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-daterange input-date" id='tgl_mulai' autocomplete="off">
                            <input type="hidden" id="tgl" required name="tgl_mulai" value="{{ !empty($model->tgl_mulai) ? $model->tgl_mulai : date('Y-m-d') }}">
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class='bagan_form'>
                        <label for="jumlah_periode" class="form-label">Periode<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="jumlah_periode" name="jumlah_periode" min='1' required value="{{ !empty($model->jumlah_periode) ? $model->jumlah_periode : 1 }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class='bagan_form'>
                        <label for="type_jenis" class="form-label">Unit Periode<span class="text-danger">*</span></label>
                        <select class="form-select" id="type_jenis" name="type_jenis" required aria-label="Default select ">
                            @if(!empty($type_jenis_jadwal))
                                @foreach($type_jenis_jadwal as $key => $val)
                                    <?php
                                        $model_type_jenis_jadwal=!empty($model->type_jenis) ? $model->type_jenis : 2;
                                    ?>
                                    <option value='{{ $key }}' {{ ($model_type_jenis_jadwal==$key) ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            @endif
                        </select>
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
