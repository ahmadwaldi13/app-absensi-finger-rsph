<div class='body-racikan-copy' data-key='0' style="display: none;">
    <hr class="mb-2">
    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="nm_racikan" class="form-label">Nama Racikan <span class="text-danger">*</span></label>
                <select class="form-nm-racikan required-form" name='nama_racikan[]' style="width: 100%">
                    <option selected></option>
                </select>
                <div class="message"></div>
            </div>
        </div>
        
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="metode_racik" class="form-label">Metode Racik <span class="text-danger">*</span></label>
                <div class="button-icon-inside bagan-metode-racik">
                    <input type="text" class="input-text nm_racik required-form" name="nm_racik[]" readonly value="" />
                    <input type="hidden" class="kd_racik" name="kd_racik[]" value="" />
                    <span class="modal-remote-data form-motede-racikan" data-modal-src="{{ url('racikan/ajax?action=metode_racik') }}" data-modal-key="" data-modal-pencarian='true' data-modal-action-change="function=.get-metode-racik@data-target=.nm_racik|.kd_racik@data-key-bagan=0@data-btn-close=#closeModalData">
                        <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                    </span>
                </div>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="jml_dr" class="form-label">Jumlah Racik <span class="text-danger">*</span></label>
                <input type="number" step="any" class="form-control required-form" name='jml_dr[]' value="">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="aturan_pakai" class="form-label">Aturan Pakai <span class="text-danger">*</span></label>
                <select class="form-aturan-pakai required-form" name='aturan_pakai[]' style="width: 100%">
                    <option selected></option>
                </select>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-7 mb-3">
            <div class='bagan_form'>
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control required-form" name='keterangan[]' rows="1"></textarea>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-2 mb-3">
            <a href="#" class='btn btn-danger btn-hapus-racikan'><span class="iconify" style="font-size: 28px;" data-icon="el:trash-alt"></span> Hapus</a>
        </div>

    </div>
</div>