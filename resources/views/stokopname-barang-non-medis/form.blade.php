<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <div class="row justify-content-start mb-3">
        <div class="row justify-content-left">
            {{-- @if ($data_check == date('Y-m-d'))
            <div class="col-md-12">
                <div class="alert alert-warning py-2" role="alert">
                    <svg class="fa fa-fw fa-exclamation-circle" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill"></use>
                    </svg>
                    Data hari ini sudah Disimpan !
                </div>
            </div>
            @endif --}}
            <div class="col-lg-4 mb-3">
                <div class='input-date-bagan'>
                    <label for="tanggal" class="form-label">Pada Tanggal : <span class="text-danger">*</span></label>
                    <span class='icon-bagan-date'></span>
                    <input type="hidden" name="key_old" value="{{ !empty($model->kode_brng) ? $model->kode_brng : '' }}">
                    <input type="text" class='tgl_me form-control input-date' id="tgl" required name="tanggal" value="{{ !empty($model->tanggal) ? $model->tanggal : date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-lg-8 mb-3">
                <div class='input-date-bagan'>
                <label for="ket" class="form-label">Keterangan : <span class="text-danger">*</span></label>
                <textarea class="form-control" id="ket" required name="ket" rows="3"></textarea>
                </div>
              </div>
        </div>
    </div>
    <textarea id='item_list_terpilih' name='item_list_terpilih' style='display:none'>{{ !empty($item_list_terpilih) ? $item_list_terpilih : '' }}</textarea>

    <hr>
    <div class="card card-body" style='background:#bbe7fa'>
        <div id="data-terpilih">
            <h4>List Data Terpilih</h4>
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 10%">Real</th>
                            <th class="py-3" style="width: 8%">Kode Barang</th>
                            <th class="py-3" style="width: 15%">Nama Barang</th>
                            <th class="py-3" style="width: 5%">Kategori</th>
                            <th class="py-3" style="width: 5%">Satuan</th>
                            <th class="py-3" style="width: 7%">Harga</th>
                            <th class="py-3" style="width: 6%">Stok</th>
                            <th class="py-3" style="width: 8%">Selisih</th>
                            <th class="py-3" style="width: 12%">Nominal Hilang(Rp)</th>
                            <th class="py-3" style="width: 8%">Lebih</th>
                            <th class="py-3" style="width: 12%">Nominal Lebih(Rp)</th>
                            <th class="py-3" style="width: 1%">action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="row justify-content-end align-items-end mt-1">
        <div class="col-md-3 text-center">
            <button class="btn btn-primary btn-block" id='btn_save' type="submit">Simpan Perubahan</button>
        </div>
    </div>
</form>

<div class="card card-body mt-5">
    <h4>List Data Barang</h4>
    <div id="list-data">
        @include($router_name->path_base.'.columns_list_barang_form')
    </div>
</div>

@push('script-end-2')
    <script src="{{ asset('js/stokopname-barang-non-medis/form.js') }}"></script>
@endpush
