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
                    <input type="text" class="form-control input-date get-data-by-date" id='tanggal' autocomplete="off" data-url="{{ url('verifikasi-inventori-permintaan-barang-non-medis/ajax?action=no_keluar') }}" data-value='tanggal@.tgl_me' data-target='#no_keluar' >
                    <input type="hidden" class='tgl_me' id="tgl" required name="tanggal" value="{{ !empty($model_pengeluaran->tanggal) ? $model_pengeluaran->tanggal : date('Y-m-d') }}">
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <label for="no_keluar" class="form-label">No.Keluar <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="no_keluar" name='no_keluar' readonly required value="{{ !empty($model_pengeluaran->no_keluar) ? $model_pengeluaran->no_keluar : '' }}">
                    <div class="message"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start mb-3">
        <div class="row justify-content-left">
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
    </div>

    <div class="row justify-content-left">
        <div class="col-lg-12 mb-3">
            <div class='bagan_form'>
                <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="keterangan" name="keterangan" required rows="1">{{ !empty($model_pengeluaran->keterangan) ? $model_pengeluaran->keterangan :  "" }}</textarea>
                <div class="message"></div>
            </div>
        </div>
    </div>

    <?php 
        $set_item_terpilih=!empty( Request::get('item_list_terpilih') ) ? Request::get('item_list_terpilih') : '{}';
     ?>
    <textarea id='item_list_terpilih' class='form-control' style='display:none' name='item_list_terpilih'>{{ $set_item_terpilih }}</textarea>

    <div class='row'>
        <div class='d-flex justify-content-end' style='background: #82b1e778;padding: 10px 10px;'>
            <div class="col-lg-6" style='text-align:right;'>
                <span style='position: relative; top: 8px;'>Apakah anda setujuh dengan permintaan ini ?</span>
            </div>
            <div class="col-lg-1" style='text-align:right;'>
                <button class="btn btn-primary" type="submit" name='type_submit' value='2'>Ya</button>
            </div>
            <div class="col-lg-1" style='text-align:right;'>
                <a href="#" class="btn btn-danger btn-batal" >Tidak</a>
            </div>
        </div>
    </div>
</form>