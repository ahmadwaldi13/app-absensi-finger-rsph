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
                    <input type="text" class="input-text" id="nama_dokter" readonly placeholder="Nama Dokter" required  value='{{ !empty($model->nm_dokter) ? $model->nm_dokter :  "" }}' />
                    @if($get_user->type_user!='dokter')
                        <span id="modalDokter">
                            <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
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

    @include('racikan.form_layout_racikan')

    <div class="body-racikan">
        @if (!empty($data_feedback_item['data_racikan'])) 
            <?php  
                $json_data_racikan=json_encode($data_feedback_item['data_racikan']); 
            ?>
            <textarea id='data_racikan_feedback' style="display: none;">{{ $json_data_racikan }}</textarea>
        @endif
        <div class='bagan-form-racikan' data-key='1'>
            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-4 mb-3">
                    <div class='bagan_form'>
                        <label for="nm_racikan" class="form-label">Nama Racikan <span class="text-danger">*</span></label>
                        <select class="get-nm-racikan" name='nama_racikan[]' required style="width: 100%">
                            <option selected></option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                
                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="metode_racik" class="form-label">Metode Racik <span class="text-danger">*</span></label>
                        <div class="button-icon-inside bagan-metode-racik">
                            <input type="text" class="input-text nm_racik" name="nm_racik[]" required readonly value="" />
                            <input type="hidden" class="kd_racik" name="kd_racik[]" value="" />
                            <span class="modal-remote-data form-motede-racikan" data-modal-src="{{ url('racikan/ajax?action=metode_racik') }}" data-modal-key="" data-modal-pencarian='true' data-modal-action-change="function=.get-metode-racik@data-target=.nm_racik|.kd_racik@data-key-bagan=1@data-btn-close=#closeModalData">
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
                        <input type="number" step="any" class="form-control" name='jml_dr[]' required value="">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='bagan_form'>
                        <label for="aturan_pakai" class="form-label">Aturan Pakai <span class="text-danger">*</span></label>
                        <select class="get-aturan-pakai" name='aturan_pakai[]' required style="width: 100%">
                            <option selected></option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-7 mb-3">
                    <div class='bagan_form'>
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" required name='keterangan[]' rows="1"></textarea>
                        <div class="message"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row justify-content-end align-items-end my-1">
        <div class="col-lg-2 mb-3">
            <div class="d-grid gap-2">
                <a href="#" class='btn btn-warning' id='btn-tambah-racikan'>
                    <!-- <span class="iconify" style="font-size: 28px;" data-icon="el:file-edit-alt"></span> -->
                    <img src="{{ asset('') }}icon/edit_white.png" alt="">
                    Tambah Racikan
                </a>
            </div>
        </div>
    </div>

    <hr class="mb-2">

    <?php 
        $tampung_check=0;
        if (!empty($data_feedback_item['list_obat'])) {
            $tampung_check=1;
        }
    ?>
    <ul id='tampung_data' data-check='{{ $tampung_check }}' style="display: none;">
        <?php
            $data_feedback = [];
            if (!empty($data_feedback_item['list_obat'])) {
                $data_feedbacks = $data_feedback_item['list_obat'];
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
        
        <div style="overflow-x: auto; max-width: auto;" class="border mb-5">
            <table class="table border table-responsive-tablet" id="tableObatSelected">
                <thead>
                    <tr>
                        <th scope="col" class="py-4">Kode Barang</th>
                        <th scope="col" class="py-4">Nama Barang</th>
                        <th scope="col" class="py-4">Satuan</th>
                        <th scope="col" class="py-4">Harga</th>
                        <th scope="col" class="py-4">Jenis Obat</th>
                        <th scope="col" class="py-4">Stok</th>
                        <th scope="col" class="py-4">Jumlah</th>
                        <th scope="col" class="py-4">P1/P2</th>
                        <th scope="col" class="py-4">Kandungan</th>
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
        <div style="overflow-x: auto; max-width: auto;" class="border fixed-header">
            <table class="table border table-responsive-tablet data-table" data-scrollx='true' cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Kode Barang/Nama Barang</th>
                        <th rowspan="2" class="py-2 text-center" style='vertical-align: middle'>Satuan</th>
                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Harga(Rp)</th>
                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Jenis/Komposisi</th>
                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Stok</th>
                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Kapasitas</th>
                        <th rowspan="2" class="py-2 text-center" style="width: 15px !important; vertical-align: middle">Jumlah <span class="text-danger">*</span></th>
                        <th colspan="3" class="py-3 text-center">P1/P2</th>
                        <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Kandungan</th>
                    </tr>
                    <tr>
                        <th class="py-3 text-center" style="width: 15px !important">P1</th>
                        <th></th>
                        <th class="py-3 text-center" style="width: 15px !important">P2</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($list_barang))
                        @foreach($list_barang as $key => $item)
                            <?php 
                                $harga=!empty($item->h_beli) ? $item->h_beli  : 0;
                                $stok=!empty($item->stok) ? $item->stok  : 0;
                                $kapasitas=!empty($item->kapasitas) ? $item->kapasitas  : 0;

                                $get_data=[
                                    'kode_barang'=>!empty($item->kode_brng) ? $item->kode_brng : '',
                                    'nm_barang'=>!empty($item->nama_brng) ? $item->nama_brng : '',
                                    'satuan'=>!empty($item->kode_sat) ? $item->kode_sat : '',
                                    'harga'=>(new \App\Http\Traits\GlobalFunction)->formatMoney($harga),
                                    'harga_real'=>$harga,
                                    'jenis_obat'=>!empty($item->nama) ? $item->nama : '',
                                    'stok'=>$stok,
                                    'kapasitas'=>$kapasitas
                                ];

                                $get_data=json_encode($get_data);
                            
                            ?>
                            <tr class='list-aturan' data-id='{{ $item->kode_brng }}' data-key='{{ $get_data }}' >
                                <td>{{ !empty($item->kode_brng) ? $item->kode_brng : '' }} {{ !empty($item->nama_brng) ? $item->nama_brng : '' }}</td>
                                <td>{{ !empty($item->kode_sat) ? $item->kode_sat : '' }}</td>
                                <td>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($harga) }}</td>
                                <td>{{ !empty($item->nama) ? $item->nama : '' }}<br>( {{ !empty($item->letak_barang) ? $item->letak_barang : '' }} )</td>
                                <td>{{ $stok }}</td>
                                <td>{{ $kapasitas }}</td>
                                <td style="width: 15px">
                                    <input type="number" step="any" style="width: 100px" class="form-control change-key jlh_obat">
                                </td>
                                <td style="width: 15px">
                                    <input type="number" step="any" style="width: 100px" class="form-control change-key jlh_p1" value='1'>
                                </td>
                                <td>/</td>
                                <td style="width: 15px">
                                    <input type="number" step="any" style="width: 100px" class="form-control change-key jlh_p2" value='1'>
                                </td>
                                <td>
                                    <input type="text" style="width: 200px" maxlength="10" class="form-control change-key kandungan">
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>  
            </table>
        </div>
    </div>


    <div class="row justify-content-start align-items-end my-5">
        <div class="col-lg-2 mb-2">
            <div class="d-grid gap-2">
                @if(empty($allow_btn_simpan))
                    <button class="btn btn-primary submit_confirmasi" data-action='target=#check_submit@action=click' type="submit">{{ !empty($kode_key_old) ? 'Ubah' : 'Simpan'  }}</button>
                    <button type="submit" id='check_submit' style='display: none'></button>
                @endif
            </div>
        </div>
    </div>
</form>