<style>
    .file-upload-modern {
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        background: #f9fafb;
        cursor: pointer;
        transition: 0.3s;
    }

    .file-upload-modern:hover {
        background: #eef2ff;
        border-color: #6366f1;
    }

    .file-upload-modern input {
        display: none;
    }

    .file-upload-modern label {
        cursor: pointer;
    }

    .file-upload-modern i {
        font-size: 28px;
        color: #6366f1;
        display: block;
        margin-bottom: 8px;
    }

    .file-upload-modern span {
        font-weight: 600;
        display: block;
    }

    .file-upload-modern small {
        color: #6b7280;
    }

    .file-name {
        margin-top: 10px;
        font-size: 14px;
        color: #16a34a;
        font-weight: 600;
        display: none;
        word-break: break-all;
    }
</style>
<form action="{{ url($action_form) }}" method="POST"
    enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="key_old" value="{{ $model->id_karyawan ?? '' }}">

    <div class="row g-3">

        {{-- NIP & Nama --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <label class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip" required value="{{ $model->nip ?? '' }}">
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <label class="form-label">Nama Karyawan</label>
            <input type="text" class="form-control" name="nm_karyawan" required
                value="{{ $model->nm_karyawan ?? '' }}">
        </div>

        {{-- Keterangan --}}
        <div class="col-12">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" rows="2"></textarea>
        </div>

        {{-- Jenis & Tanggal --}}
        <div class="col-lg-4 col-md-6 col-sm-12">
            <label class="form-label">Jenis Pengajuan</label>
            <select name="jenis_izin" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
            </select>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tgl_mulai" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <label class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" name="tgl_selesai" value="{{ date('Y-m-d') }}" required>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12">
            <label class="form-label">File Pendukung</label>

            <div class="file-upload-modern">
                <input type="file" name="file_pendukung" id="fileUpload" accept=".pdf,.jpg,.jpeg,.png">

                <label for="fileUpload">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span id="uploadText">Pilih atau drop file di sini</span>
                    <small id="uploadHint">PDF / JPG / PNG (Max 2MB)</small>
                </label>

                <!-- PENANDA FILE -->
                <div class="file-name" id="fileName"></div>
            </div>

        </div>



        <div class="col-lg-12 d-none">
            <div class="row justify-content-start align-items-end">
                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id='nm_jabatan' name="nm_jabatan" disabled required
                                value="{{ !empty($model->nm_jabatan) ? $model->nm_jabatan : '' }}" />
                            <input type="hidden" id="id_jabatan" name='id_jabatan' required
                                value="{{ !empty($model->id_jabatan) ? $model->id_jabatan : '' }}">
                            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_jabatan') }}"
                                data-modal-key="" data-modal-pencarian='true' data-modal-title='Jabatan'
                                data-modal-width='30%'
                                data-modal-action-change="function=.set-data-list-from-modal@data-target=#id_jabatan|#nm_jabatan@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary"
                                    src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_departemen" class="form-label">Departemen <span
                                class="text-danger">*</span></label>
                        <div class="button-icon-inside" id='tes'>
                            <input type="text" class="input-text" id='nm_departemen' name="nm_departemen" readonly
                                disabled value="{{ !empty($model->nm_departemen) ? $model->nm_departemen : '' }}" />
                            <input type="hidden" id="id_departemen" name='id_departemen' required
                                value="{{ !empty($model->id_departemen) ? $model->id_departemen : '' }}">
                            <span class="modal-remote-data"
                                data-modal-src="{{ url('ajax?action=get_list_departemen') }}" data-modal-key=""
                                data-modal-pencarian='true' data-modal-title='Departemen' data-modal-width='50%'
                                data-modal-action-change="function=.set-data-list-from-modal@data-target=#id_departemen|#nm_departemen@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary"
                                    src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_ruangan" class="form-label">Ruangan <span class="text-danger">*</span></label>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id='nm_ruangan' name="nm_ruangan" readonly
                                disabled value="{{ !empty($model->nm_ruangan) ? $model->nm_ruangan : '' }}" />
                            <input type="hidden" id="id_ruangan" name='id_ruangan'
                                value="{{ !empty($model->id_ruangan) ? $model->id_ruangan : '' }}">
                            <span class="modal-remote-data"
                                data-modal-src="{{ url('ajax?action=get_list_ruangan') }}"
                                data-modal-key-with-form="#id_departemen" data-modal-pencarian='true'
                                data-modal-title='Departemen' data-modal-width='70%'
                                data-modal-action-change="function=.set-data-list-from-modal@data-target=#id_ruangan|#nm_ruangan@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary"
                                    src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                
            </div>
        </div>

        {{-- Submit --}}
        <div class="col-12 mt-3">
            <button class="btn btn-primary px-4">
                Simpan
            </button>
        </div>

    </div>
</form>

<script>
    document.getElementById('fileUpload').addEventListener('change', function() {
        const fileName = this.files[0]?.name;
        const fileNameEl = document.getElementById('fileName');
        const uploadText = document.getElementById('uploadText');

        if (fileName) {
            fileNameEl.style.display = 'block';
            fileNameEl.innerHTML = '✔ File dipilih: ' + fileName;
            uploadText.innerHTML = 'Ganti file';
        }
    });
</script>
