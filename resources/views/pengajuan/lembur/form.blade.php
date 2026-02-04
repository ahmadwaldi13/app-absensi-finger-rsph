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
    <input type="hidden" id="id_ruangan" name='id_ruangan' value="{{ !empty($model->id_ruangan) ? $model->id_ruangan : '' }}">
    <input type="hidden" id="id_departemen" name='id_departemen' required value="{{ !empty($model->id_departemen) ? $model->id_departemen : '' }}">
    <input type="hidden" id="id_jabatan" name='id_jabatan' required value="{{ !empty($model->id_jabatan) ? $model->id_jabatan : '' }}">

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
        <div class="col-lg-3 col-md-6 col-sm-12">
            <label class="form-label">Jenis Lembur</label>
            <select name="jenis_lembur" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="Bayar">Bayar</option>
                <option value="Deposit">Deposit</option>
            </select>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <label class="form-label">Tanggal Lembur</label>
            <input type="date" class="form-control" name="tgl_lembur"
                value="{{ now()->toDateString() }}" required>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <label class="form-label">Jam Mulai</label>
            <input type="time" class="form-control" name="jam_mulai"
                value="{{ now()->format('H:i') }}" required>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <label class="form-label">Jam Selesai</label>
            <input type="time" class="form-control" name="jam_selesai"
                value="{{ now()->addHours(1)->format('H:i') }}" required>
        </div>



        <div class="col-lg-12 col-md-12 col-sm-12">
            <label class="form-label">Dokumen/gambar</label>

            <div class="file-upload-modern">
                <input type="file" name="file_dokumen" id="file_dokumen" accept=".pdf,.jpg,.jpeg,.png">

                <label for="file_dokumen">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span id="uploadText">Pilih atau drop file di sini</span>
                    <small id="uploadHint">PDF / JPG / PNG (Max 2MB)</small>
                </label>

                <!-- PENANDA FILE -->
                <div class="file-name" id="fileName"></div>
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
