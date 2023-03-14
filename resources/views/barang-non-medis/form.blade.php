<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <?php 
        $kode=!empty($model->kode_brng) ? $model->kode_brng : '';
    ?>
    <input type="hidden" name="key_old" value="{{ $kode }}">

    <div class="row justify-content-start mb-3">
        <div class="col-lg-6">
            <div class="col-lg-12 mb-3">
                <div class='bagan_form'>
                    <label for="nm_jenis" class="form-label">Jenis</label>
                    <div class="button-icon-inside">
                        <input type="text" class="input-text" id='nm_jenis' name="nm_jenis" value="{{ !empty($model->nm_jenis) ? $model->nm_jenis : '' }}" />
                        <input type="hidden" id="jenis" name="jenis" value="{{ !empty($model->jenis) ? $model->jenis : '' }}" />
                        <span class="modal-remote-data" id='pil_jenis' data-modal-src="{{ url('ajax?action=jenis_barang') }}" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-table-page='500' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nm_jenis|#jenis@data-key-bagan=0@data-btn-close=#closeModalData">
                            <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                        </span>
                        <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                    </div>
                    <div class="message"></div>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <div class='bagan_form '>
                    <label for="kode_brng" class="form-label">Kode Barang</label>
                    <input type="text" class="form-control" id="kode_brng" name='kode_brng' required value="{{ !empty($model->kode_brng) ? $model->kode_brng : '' }}">
                    <div class="message"></div>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <div class='bagan_form '>
                    <label for="nama_brng" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_brng" name='nama_brng' required value="{{ !empty($model->nama_brng) ? $model->nama_brng : '' }}">
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="col-lg-12 mb-3">
                <div class='bagan_form'>
                    <label for="satuan" class="form-label">Satuan</label>
                    <div class="button-icon-inside">
                        <input type="text" class="input-text" id='satuan' name="satuan" value="{{ !empty($model->satuan) ? $model->satuan : '' }}" />
                        <input type="hidden" id="kode_sat" name="kode_sat" value="{{ !empty($model->kode_sat) ? $model->kode_sat : '' }}" />
                        <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=kode_satuan') }}" data-modal-pencarian='true' data-modal-title='Satuan' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#satuan|#kode_sat@data-key-bagan=0@data-btn-close=#closeModalData">
                            <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                        </span>
                        <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                    </div>
                    <div class="message"></div>
                </div>
            </div>


            <div class="col-lg-12 mb-3">
                <div class='bagan_form '>
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="text" class="form-control money" id="harga" name='harga' required value="{{ !empty($model->harga) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($model->harga) : '' }}">
                    <div class="message"></div>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <div class='bagan_form '>
                    <label for="stok" class="form-label">Stok</label>
                    <input type="text" class="form-control money" id="stok" readonly disabled value="{{ !empty($model->stok) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($model->stok) : '' }}">
                    <div class="message"></div>
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


@push('script-end-2')
<script src="{{ asset('js/barang-non-medis/form.js') }}"></script>
@endpush