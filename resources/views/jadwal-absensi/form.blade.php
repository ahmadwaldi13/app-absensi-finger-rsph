<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model->id_karyawan) ? $model->id_karyawan : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-6">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="jam_masuk" class="form-label">Jam Masuk</label>
                        <input type="time" class="form-control" id="jam_masuk" name='jam_masuk' required value="{{ !empty($model->jam_masuk) ? $model->jam_masuk : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="jam_keluar" class="form-label">Jam Keluar</label>
                        <input type="time" class="form-control" id="jam_keluar" name='jam_keluar' required value="{{ !empty($model->jam_keluar) ? $model->jam_keluar : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
                
            </div>
        </div>

        {{-- <div class="col-lg-6">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-12 mb-3">
                    <div class='bagan_form'>
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3">{{!empty($model->alamat) ? $model->alamat : ''}}</textarea>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id='nm_jabatan' name="nm_jabatan" readonly disabled value="{{ !empty($model->nm_jabatan) ? $model->nm_jabatan : '' }}" />
                            <input type="hidden" id="id_jabatan" name='id_jabatan' readonly required value="{{ !empty($model->id_jabatan) ? $model->id_jabatan : '' }}">
                            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_jabatan') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jabatan' data-modal-width='30%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#id_jabatan|#nm_jabatan@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>                            
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_departemen" class="form-label">Departemen <span class="text-danger">*</span></label>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id='nm_departemen' name="nm_departemen" readonly disabled value="{{ !empty($model->nm_departemen) ? $model->nm_departemen : '' }}" />
                            <input type="hidden" id="id_departemen" name='id_departemen' readonly required value="{{ !empty($model->id_departemen) ? $model->id_departemen : '' }}">
                            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_departemen') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Departemen' data-modal-width='30%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#id_departemen|#nm_departemen@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>                            
                        </div>
                        <div class="message"></div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-5">
            <button class="btn btn-primary" type="submit">{{ !empty($kode) ? 'Ubah' : 'Simpan'  }}</button>
        </div>
    </div>
</form>
