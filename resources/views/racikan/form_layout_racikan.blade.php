<div class='body-racikan-copy' data-key='0' style="display: none;">
    <hr class="mb-5">
    <div class="card" style='background: #eaeaea;'>
        <div class="card-body">
            <div class="row justify-content-end align-items-end mb-3">
                <div class="d-grid col-lg-3 mb-3 bagan-hapus-racikan">
                    <a href="#" class='btn btn-danger btn-hapus-racikan'><span class="iconify" style="font-size: 16px;" data-icon="el:trash-alt"></span> Hapus Form</a>
                </div>
            </div>

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
                
                <div class="col-lg-4 mb-3">
                    <div class='bagan_form'>
                        <label for="metode_racik" class="form-label">Metode Racik <span class="text-danger">*</span></label>
                        <div class="button-icon-inside bagan-metode-racik" style='background:#fff'>
                            <input type="text" class="input-text nm_racik required-form" name="nm_racik[]" readonly value="" />
                            <input type="hidden" class="kd_racik" name="kd_racik[]" value="" />
                            <span class="modal-remote-data form-motede-racikan" data-modal-src="{{ url('racikan/ajax?action=metode_racik') }}" data-modal-key="" data-modal-pencarian='true' data-modal-action-change="function=.get-metode-racik@data-target=.nm_racik|.kd_racik@data-key-bagan=0@data-btn-close=#closeModalData">
                                <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                                <img src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="jml_dr" class="form-label">Jumlah Racik <span class="text-danger">*</span></label>
                        <input type="number" step="any" class="jml_rc form-control required-form" name='jml_dr[]' value="">
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

                <div class="col-lg-8 mb-3">
                    <div class='bagan_form'>
                        <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                        <textarea class="ket form-control required-form" name='keterangan[]' rows="1"></textarea>
                        <div class="message"></div>
                    </div>
                </div>
                
                <hr class="mb-5">

                <div class="col-lg-12 mb-3 obat-terpilih">
                    <textarea hidden class='obat_json' style='width:100%; height:300px'></textarea>

                    <div class="row d-flex justify-content-between align-items-end mb-2">
                        <div class="col-lg-3 mb-3">
                            <h4>Obat Yang Terpilih</h4>
                        </div>

                        <div class="d-grid col-lg-3 mb-3">
                            <a href='#' class='btn-tambah-obat btn btn-info' style='color:#383838'><span class="iconify" style="font-size: 20px;" data-icon="el:plus"></span><span> Tambah Data Obat</span></a>
                            <a hidden class="lok-racikan-click modal-remote-data" data-modal-src="{{ url('racikan/ajax?action=list_obat') }}" data-modal-tmp="{{ $model->fr.'@'.$model->no_rawat }}" data-modal-key="{{ $model->fr.'@'.$model->no_rawat }}" data-modal-pencarian='true' data-modal-width='100%' data-modal-action-change="data-btn-close=#closeModalData">tes</a>
                        </div>
                    </div>

                    <div class="bagan-barang-terpilih">
                        <div style="overflow-x: auto; max-width: auto;" class="border mb-5">
                            <table class="table border table-responsive-tablet border" id="tableObatSelected">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Kode Barang/Nama Barang</th>
                                        <th rowspan="2" class="py-2 text-center" style='vertical-align: middle'>Satuan</th>
                                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Harga(Rp)</th>
                                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Jenis/Komposisi</th>
                                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Stok</th>
                                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Kapasitas</th>
                                        <th colspan="3" class="py-3 text-center">P1/P2</th>
                                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Kandungan</th>
                                        <th rowspan="2" class="py-2 text-center" style="width: 15px !important; vertical-align: middle">Jumlah <span class="text-danger">*</span></th>
                                        <th colspan="2" class="py-3 text-center">#</th>
                                    </tr>
                                    <tr>
                                        <th class="py-3 text-center" style="width: 10px !important">P1</th>
                                        <th></th>
                                        <th class="py-3 text-center" style="width: 10px !important">P2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan=15>
                                            <h5 class='text-center'>Tidak ada obat terpilih, Silahkan Klik tambah data obat</h5>
                                        </td> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>