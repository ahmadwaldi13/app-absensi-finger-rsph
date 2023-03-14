<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model_permintaan->no_permintaan) ? $model_permintaan->no_permintaan : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">
    
    <div class="row justify-content-start mb-3">
        <div class="row justify-content-left">
            <div class="col-lg-4 mb-3">
                <div class='input-date-bagan'>
                    <label for="tanggal" class="form-label">Pada Tanggal : <span class="text-danger">*</span></label>
                    <span class='icon-bagan-date'></span>
                    <input type="text" class="form-control input-date get-data-by-date" id='tanggal' autocomplete="off" data-url="{{ url('permintaan-barang-non-medis/ajax?action=no_permintaan') }}" data-value='tanggal@.tgl_me' data-target='#no_permintaan' >
                    <input type="hidden" class='tgl_me' id="tgl" required name="tanggal" value="{{ !empty($model->tanggal) ? $model->tanggal : date('Y-m-d') }}">
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nip" name='nip' readonly required value="{{ !empty($user_verifikasi->nip) ? $user_verifikasi->nip : '' }}">
                    <div class="message"></div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <label for="nm_pegawai" class="form-label">Pegawai <span class="text-danger">*</span></label>
                    <div class="button-icon-inside">
                        <input type="text" class="input-text" id='nm_pegawai' name="nm_pegawai" readonly disabled value="{{ !empty($user_verifikasi->nm_pegawai) ? $user_verifikasi->nm_pegawai : '' }}" />
                    </div>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-left">
            <div class="col-lg-12 mb-3">
                <div class='bagan_form'>
                    <label for="keterangan" class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="keterangan" name="keterangan" required rows="3">{{ !empty($model->keterangan) ? $model->keterangan :  "" }}</textarea>
                    <div class="message"></div>
                </div>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='d-flex justify-content-end' style='background: #82b1e778;padding: 10px 10px;'>
            <div class="col-lg-6" style='text-align:right;'>
                <span style='position: relative; top: 8px;'>Tolak Permintaan ini ?</span>
            </div>
            <div class="col-lg-1" style='text-align:right;'>
                <button class="btn btn-primary" type="submit" name='type_submit' value='3'>Ya</button>
            </div>
            <div class="col-lg-1" style='text-align:right;'>
                <a href="#" class="btn btn-danger btn-batal" >Tidak</a>
            </div>
        </div>
    </div>
</form>