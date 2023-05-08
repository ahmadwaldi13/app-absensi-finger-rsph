<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    {{-- <div class="row justify-content-start align-items-end mb-2">
        <div class="col-6 mb-2">
            <label for="no_rawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="no_rawat" readonly name="no_rawat"  value="{{!empty($no_rawat) ? $no_rawat : ''}}">
        </div>
        <div class="col-6 mb-2">
            <label for="no_rawat" class="form-label">No.RM</label>
            <input type="text" class="form-control" name="no_rm" id="no_rm" readonly value="{{!empty($dataPasien->no_rkm_medis) ? $dataPasien->no_rkm_medis : ''}}">
        </div>
        <div class="col-6 mb-2">
            <label for="no_rawat" class="form-label">Pasien</label>
            <input type="text" class="form-control" id="nm_pasien" readonly value="{{!empty($dataPasien->nm_pasien) ? $dataPasien->nm_pasien : ''}}">
        </div>
        <div class="col-6 mb-2">
            <label for="no_rawat" class="form-label">Tgl.Rawat</label>
            <input type="text" class="form-control" id="nm_pasien" readonly value="{{!empty($dataPasien->tgl_rawat) ? $dataPasien->tgl_rawat : ''}}">
        </div>
</div> --}}
<textarea id='item_list_terpilih' name='item_list_terpilih' style='display:none'>{{ !empty($item_list_terpilih) ? $item_list_terpilih : '' }}</textarea>
    <hr>
    <div class="card card-body" style='background:#bbe7fa'>
        <div id="data-terpilih">
            <h4>List Data Terpilih</h4>
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 4%">Aksi</th>
                            <th class="py-3" style="width: 8%">Id Karyawan</th>
                            <th class="py-3" style="width: 13%">Nama Karyawan</th>
                            <th class="py-3" style="width: 10%">Alamat</th>
                            <th class="py-3" style="width: 4%">Opsi</th>
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
    <h4>List Data Karyawan</h4>
    <div id="list-data">
        @include('upload-data.columns')
    </div>
</div>

@push('script-end-2')
    <script src="{{ asset('js/upload-data/form.js') }}"></script>
@endpush
