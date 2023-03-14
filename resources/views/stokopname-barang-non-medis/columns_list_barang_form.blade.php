<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div class='bagan-data-table-cus' data-url="{{ url('stokopname-barang-non-medis/ajax?action=list_barang_master_form') }}">
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control" name='form_filter_text' value="{{ Request::get('form_filter_text') }}" id='filter_search_text' placeholder="Masukkan Kata">
                    </div>

                    <div class="col-lg-3 col-md-10">
                        <div class='bagan_form'>
                            <label for="filter_nm_jenis" class="form-label">Jenis</label>
                            <div class="button-icon-inside">
                                <input type="text" class="input-text" id='filter_nm_jenis' name="filter_nm_jenis" value="{{ Request::get('filter_nm_jenis') }}" />
                                <input type="hidden" id="filter_kd_jenis" name="filter_kd_jenis" value="{{ Request::get('filter_kd_jenis') }}" />
                                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=jenis_barang') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_nm_jenis|#filter_kd_jenis@data-key-bagan=0@data-btn-close=#closeModalData">
                                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                </span>
                                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                            </div>
                            <div class="message"></div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1">
                        <div class="d-grid grap-2">
                            <button class="btn btn-primary">
                                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet data-table-cus">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 10%">Real</th>
                            <th class="py-3" style="width: 8%">Kode Barang</th>
                            <th class="py-3" style="width: 15%">Nama Barang</th>
                            <th class="py-3" style="width: 5%">Kategori</th>
                            <th class="py-3" style="width: 15%">Satuan</th>
                            <th class="py-3" style="width: 15%">Harga</th>
                            <th class="py-3" style="width: 15%">Stok</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
