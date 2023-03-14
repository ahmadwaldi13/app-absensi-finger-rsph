<?php
    if (!empty(Session::get('data_feedback'))) {
        $data_feedback_item=Session::get('data_feedback');
    }

    $check_registrasi=(new \App\Http\Traits\ItemPasienFunction)->cariRegistrasi($model->no_rawat);
    $allow_btn_simpan=0;
    if($check_registrasi>0){
        $allow_btn_simpan=1;
    }

?>

<form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}" id="formIsiResep">
    @csrf
    <input type="hidden" name="key_old" value="{{ !empty($kode_key_old) ? $kode_key_old : ''  }}"  >
    <input type="hidden" class="form-control" name="fr" value="{{ !empty($model->fr) ? $model->fr : '' }}">
    <input type="hidden" class="form-control" name="no_rm" value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
    <input type="hidden" class="form-control" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
    <input type="text" class="form-control" hidden name="status" value="{{ ($model->fr=='rj') ? 'ralan' : '' }}">

    <div id="resultObat">
    </div>

    <div id="resultPrice">
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="norawat" class="form-label">No.Rawat</label>
                <input type="text" class="form-control" id="norawat" readonly disabled required  value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($model->no_rm) ? $model->no_rm : '' }} {{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='input-date-time-bagan'>
                <label for="tanggal" class="form-label">Tanggal Peresepan : <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-daterange input-date-time" id='tanggal' autocomplete="off">
                <input type="hidden" id="tgl" required name="tgl_peresepan" value="{{ !empty($model->tgl_peresepan) ? $model->tgl_peresepan : date('Y-m-d') }}">
                <input type="hidden" id="jam" required name="jam_peresepan" value="{{ !empty($model->jam_peresepan) ? $model->jam_peresepan : date('H:i') }}">
            </div>
        </div>
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
                <label class="form-label">Total :</label>
                <h6 class="text-primary pt-2">Rp <span id="total_harga_resep">0</span></h6>
                <div class="message"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="kd_dokter" class="form-label">Peresep <span class="text-danger">*</span></label>
                <input type="text" class="form-control kode-dokter readonly" id="kd_dokter" name="kd_dokter" readonly  placeholder="Peresep" required value='{{ !empty($model->kd_dokter) ? $model->kd_dokter :  "" }}'>
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <div class="button-icon-inside">
                    <input type="text" class="input-text" id='nm_dokter' name="nm_dokter" required readonly disabled value="{{ !empty($model->nm_dokter) ? $model->nm_dokter : '' }}" />
                    @if($get_user->type_user!=='dokter' && $model->fr=='ri')
                        <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_dokterPJ') }}" data-modal-key="{{$model->no_rawat}}" data-modal-pencarian='true' data-modal-title='Dokter' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#kd_dokter|#nm_dokter|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
                            <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                        </span>
                    @endif
                </div>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="no_resep" class="form-label">No. Resep <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="no_resep" readonly required name='no_resep' value="{{ !empty($model->no_resep) ? $model->no_resep : '' }}">
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
                <label class="form-label">Total + PPN :</label>
                <h6 class="text-primary pt-2">Rp <span id="total_harga_ppn">0</span></h6>
                <div class="message"></div>
            </div>
        </div>

    </div>
    <hr class="mb-5">
    <?php
        $tampung_check=0;
        if (!empty($data_feedback_item)) {
            $tampung_check=1;
        }
    ?>
    <ul id='tampung_data' data-check='{{ $tampung_check }}' style="display: none;">
        <?php
            $data_feedback = [];
            if (!empty($data_feedback_item)) {
                $data_feedbacks = $data_feedback_item;
                if($data_feedbacks){
                    foreach($data_feedbacks as $value){
                        $data=$value;
                        $value=json_decode($value);
        ?>
                        <li id='{{ $value->id_tr }}'><textarea class="item" name="list_obat[]">{{ $data }}</textarea></li>
        <?php
                    }
                }

            }
        ?>
    </ul>
    <div id="bagan-barang-terpilih" style="display: none;">
        <div class="row justify-content-start align-items-end mb-2">
            <span>Obat Yang Terpilih</span>
        </div>

        <div class="table-responsive" style="overflow-x: auto; max-width: auto;" class="border mb-5">
            <table class="table border table-responsive-tablet" id="tableObatSelected">
                <thead>
                    <tr>
                        <th scope="col" class="py-4">k</th>
                        <th scope="col" class="py-4">Jumlah <span class="text-danger">*</span></th>
                        <th scope="col" class="py-4">Kode Barang</th>
                        <th scope="col" class="py-4">Nama Barang</th>
                        <th scope="col" class="py-4">Satuan</th>
                        <th scope="col" class="py-4">Harga</th>
                        <th scope="col" class="py-4">Aturan Pakai <span class="text-danger">*</span></th>
                        <th scope="col" class="py-4" style="width: 100px !important">Stok</th>
                        <th scope="col" class="py-4"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <div class='bagan-data-table'>
        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-4 col-md-10 mb-3">
                <label for="cari_keyword" class="form-label">Pencarian Obat Dengan Keyword</label>
                <input type="text" class="form-control search-data-table" id="cari_keyword" placeholder="Masukkan Kata">
            </div>
        </div>
        <div style="overflow-x: auto; max-width: auto;" class="border table-responsive fixed-header-50vh">
            <table class="table border table-responsive-tablet data-table">
                <thead>
                    <tr>
                        <th class="py-3">K</th>
                        <th class="py-2" style="width: 15px !important">Jumlah <span class="text-danger">*</span></th>
                        <th class="py-3">Kode Barang</th>
                        <th class="py-3" style="width: 250px !important">Nama Barang</th>
                        <th class="py-3">Satuan</th>
                        <th class="py-3">Harga(Rp)</th>
                        <th class="py-3">Jenis Obat</th>
                        <th class="py-3" style="width: 400px !important">Aturan Pakai <span class="text-danger">*</span></th>
                        <th class="py-3">Stok</th>
                        <th class="py-3">Kps</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($list_barang))
                        @foreach($list_barang as $key => $item)
                            <?php
                                $harga=!empty($item->h_beli) ? $item->h_beli  : 0;
                                $stok=!empty($item->stok) ? $item->stok  : 0;
                                $kapasitas=!empty($item->kapasitas_brng) ? $item->kapasitas_brng  : 0;

                                $get_data=[
                                    'kode_barang'=>!empty($item->kode_brng) ? $item->kode_brng : '',
                                    'nm_barang'=>!empty($item->nama_brng) ? $item->nama_brng : '',
                                    'satuan'=>!empty($item->kode_sat) ? $item->kode_sat : '',
                                    'harga'=>(new \App\Http\Traits\GlobalFunction)->formatMoney($harga),
                                    'harga_real'=>$harga,
                                    'stok'=>$stok,
                                    'kapasitas'=>$kapasitas
                                ];

                                $get_data=json_encode($get_data);

                                $kode_barang=!empty($item->kode_brng) ? $item->kode_brng : '';

                            ?>
                            <tr class='list-aturan' data-id='{{ $item->kode_brng }}' data-key='{{ $get_data }}' >
                                <td class="py-3 px-3 text-center">
                                    <input class="form-check-input hover-pointer change-key" style="border-radius: 0px;" type="checkbox" value="">
                                </td>
                                <td>
                                    <input type="number" step="any" class="form-control change-key jlh_obat" data-form-key='{{ $kode_barang }}' style="width: 100px">
                                </td>
                                <td>{{ $kode_barang }}</td>
                                <td>{{ !empty($item->nama_brng) ? $item->nama_brng : '' }}</td>
                                <td>{{ !empty($item->kode_sat) ? $item->kode_sat : '' }}</td>
                                <td>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($harga) }}</td>
                                <td>{{ !empty($item->nama) ? $item->nama : '' }}</td>
                                <td class="py-3">
                                    <div class='bagan_form'>
                                        <select class="get-aturan-pakai change-key" style="width: 100%">
                                            <option selected></option>
                                        </select>
                                        <div class="message"></div>
                                    </div>
                                </td>
                                <td>{{ $stok }}</td>
                                <td>{{ $kapasitas }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mt-5">
        <div class="col-lg-2 mb-3">
            <div class="d-grid gap-2">
                @if(empty($allow_btn_simpan))
                    <button class="btn btn-primary submit_confirmasi" data-action='target=#check_submit@action=click' type="submit">{{ !empty($kode_key_old) ? 'Ubah' : 'Simpan'  }}</button>
                    <button type="submit" id='check_submit' style='display:none'></button>
                @else
                    <button class="btn btn-primary disabled" type="button">Simpan</button>
                @endif
            </div>
        </div>
    </div>
</form>