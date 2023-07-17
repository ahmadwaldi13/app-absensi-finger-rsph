<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php
        $kode=!empty($model->id_jadwal) ? $model->id_jadwal : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">


    <div class="row d-flex justify-content-between">
        <div class="col-md-8">
            <div class="row justify-content-start align-items-end mb-3">

                <div class="col-lg-3 col-md-10">
                    <div class='bagan_form'>
                        <label for="jenis_jadwal" class="form-label">Pilih Jenis Jadwal<span class="text-danger">*</span></label>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id='jenis_jadwal' required value="{{ !empty($model->nm_jenis_jadwal) ? $model->nm_jenis_jadwal : '' }}" />
                            <input type="hidden" id="id_jenis_jadwal" name="id_jenis_jadwal" value="{{ !empty($model->id_jenis_jadwal) ? $model->id_jenis_jadwal : '' }}" />
                            {{--
                            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_jenis_jadwal') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#id_jenis_jadwal|#jenis_jadwal@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                            --}}
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class='bagan_form'>
                        <label for="uraian" class="form-label">Nama Jadwal</label>
                        <input type="text" class="form-control" id="uraian" name='uraian' required value="{{ !empty($model->uraian) ? $model->uraian : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-4 mb-3">
                    <div class='bagan_form'>
                        <label for="jam_awal" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control input-daterange" id="jam_awal" name='jam_awal' required value="{{ !empty($model->jam_awal) ? $model->jam_awal : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-4 mb-3">
                    <div class='bagan_form'>
                        <label for="jam_akhir" class="form-label">s/d Jam</label>
                        <input type="time" class="form-control input-daterange" id="jam_akhir" name='jam_akhir' required value="{{ !empty($model->jam_akhir) ? $model->jam_akhir : '' }}">
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
