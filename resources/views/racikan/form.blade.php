<?php 
    $data_form_obat='';

    if(!empty($kode_key_old)){
        $data_form_obat=!empty($data_list_edit) ? $data_list_edit : '';
    };

    if(!empty($data_feedback_item)){
        $data_form_obat=!empty($data_feedback_item) ? $data_feedback_item : '';
    }

    if (!empty(Session::get('data_feedback'))) {
        $data_form_obat=Session::get('data_feedback');
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
    <textarea hidden id="data_form_obat" name="data_form_obat" style='width:100%; height:300px'>{{ !empty($data_form_obat) ? $data_form_obat : '' }}</textarea>

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
{{--         
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
        </div> --}}

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
                        <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_dokterPJ') }}" data-modal-key="{{$model->no_rawat}}"  data-modal-pencarian='true' data-modal-title='Dokter' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#kd_dokter|#nm_dokter|#departemen|#ruang@data-key-bagan=0@data-btn-close=#closeModalData">
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

    @include('racikan.form_layout_racikan')

    <div class="body-racikan"></div>

    <hr class="mb-2">

    <div class="row justify-content-end align-items-end my-1">
        <div class="col-lg-3 mb-3" style='width:17%'>
            <a href="#" class='btn btn-warning' id='btn-tambah-racikan'>
                <span class="iconify" style="font-size: 28px;" data-icon="el:plus"></span> Tambah Form Racikan
            </a>
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