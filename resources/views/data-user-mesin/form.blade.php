<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    
    <input type="hidden" name="data_sent" value="{{ Request::get('data_sent') }}">
    <input type="hidden" name="id_mesin_absensi" value="{{ !empty($model->id_mesin_absensi) ? $model->id_mesin_absensi : '' }}">
    <input type="hidden" name="id_user" value="{{ !empty($model->id_user) ? $model->id_user : '' }}">
    <input type="hidden" name="id_karyawan_old" value="{{ !empty($model->id_karyawan) ? $model->id_karyawan : '' }}">

    <div class="row justify-content-start align-items-end mb-3">
        <h4>Informasi Mesin</h4>
        <div class="col-lg-12">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="ip_address" class="form-label">Ip Address Mesin</label>
                        <input type="text" class="form-control format_ip_address" id="ip_address" readonly value="{{ !empty($model->ip_address) ? $model->ip_address : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_mesin" class="form-label">Nama/Alias Mesin</label>
                        <input type="text" class="form-control" id="nm_mesin" readonly value="{{ !empty($model->nm_mesin) ? $model->nm_mesin : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
                
                <div class="col-lg-5 mb-3">
                    <div class='bagan_form'>
                        <label for="lokasi_mesin" class="form-label">Lokasi Mesin</label>
                        <textarea class="form-control" id="lokasi_mesin" readonly rows="1">{{!empty($model->lokasi_mesin) ? $model->lokasi_mesin : ''}}</textarea>
                        <div class="message"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="id_user" class="form-label">Id User Pada Mesin</label>
                        <input type="text" class="form-control" id="id_user" readonly value="{{ !empty($model->id_user) ? $model->id_user : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="name" class="form-label">Nama User Pada Mesin</label>
                        <input type="text" class="form-control" id="name" readonly value="{{ !empty($model->name) ? $model->name : '' }}">
                        <div class="message"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-5 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_karyawan" class="form-label">Pilih Karyawan <span class="text-danger">*</span></label>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id='nm_karyawan' readonly required value="{{ !empty($model->nm_karyawan) ? $model->nm_karyawan : '' }}" />
                            <input type="hidden" id="id_karyawan" name='id_karyawan' required value="{{ !empty($model->id_karyawan) ? $model->id_karyawan : '' }}">
                            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_karyawan') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Data Karyawan' data-modal-width='80%' 
                            data-modal-action-change="function=.set-data-list-from-modal@data-target=#id_karyawan|#nm_karyawan|#nik|#nip||#nm_jabatan||#nm_departemen@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>                            
                        </div>
                        <div class="message"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row justify-content-start align-items-end">

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" readonly value="{{ !empty($model->nik) ? $model->nik : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" readonly value="{{ !empty($model->nip) ? $model->nip : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="nm_jabatan" readonly value="{{ !empty($model->nm_jabatan) ? $model->nm_jabatan : '' }}">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_departemen" class="form-label">Departemen</label>
                        <input type="text" class="form-control" id="nm_departemen" readonly value="{{ !empty($model->nm_departemen) ? $model->nm_departemen : '' }}">
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
