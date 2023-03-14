<form id="formPindahKamar" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" id='key_data' name="key_data" value="{{ !empty($kode_send) ? $kode_send : '' }}">
    <input type="hidden" name="no_rm" value="{{ !empty($model->no_rkm_medis) ? $model->no_rkm_medis : '' }}">
    <input type="hidden" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
    <input type="hidden" name="params_parent_json" value="{{ !empty($params_parent_json) ? $params_parent_json : '' }}">
    <input type="hidden" id='kamar_awal_default' value="{{ !empty($get_kd_kamar_pasien) ? $get_kd_kamar_pasien : '' }}">

    <div class="row mb-3">
        <div class="col-md-12">
            <span>Tampilkan Semua Kamar/Ruang Awal &nbsp;</span>
            <input type="checkbox" class="form-check-input" id='tmp_semua_kawal' style="border-radius: 0px;">
        </div>
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-6 col-md-12">
            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6">
                    <div class='bagan_form'>
                        <label for="nm_bangsal_awal" class="form-label">Kamar/Ruangan Awal</label>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id='nm_bangsal_awal' name="nm_bangsal_awal" required value="{{ !empty($model->nm_bangsal_awal) ? $model->nm_bangsal_awal : '' }}" />
                            <input type="hidden" id="kd_kamar_awal" name="kd_kamar_awal" value="{{ !empty($model->kd_kamar_awal) ? $model->kd_kamar_awal : '' }}" />
                            <input type="hidden" id="kd_bangsal_awal" name="kd_bangsal_awal" value="{{ !empty($model->kd_bangsal_awal) ? $model->kd_bangsal_awal : '' }}" />
                            <span class="modal-remote-data" id='form_kamar_awal' data-modal-src="{{ url('ajax?action=kamar_bangsal_inap_harga') }}" data-modal-key="{{ !empty($get_kd_kamar_pasien) ? $get_kd_kamar_pasien : '' }}" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal-custome-me@data-target=#kd_kamar_awal|#kd_bangsal_awal|#nm_bangsal_awal|#trf_kamar_awal@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                        </div>
                        <div class="message"></div>
                    </div>
                </div>  
                
                <div class="col-lg-6">
                    <div class='bagan_form'>
                        <label for="nm_bangsal_pindah" class="form-label">Kamar/Ruangan Pindah</label>
                        <div class="button-icon-inside">
                            <input type="text" class="input-text" id='nm_bangsal_pindah' name="nm_bangsal_pindah" required value="{{ !empty($model->nm_bangsal_pindah) ? $model->nm_bangsal_pindah : '' }}" />
                            <input type="hidden" id="kd_kamar_pindah" name="kd_kamar_pindah" value="{{ !empty($model->kd_kamar_pindah) ? $model->kd_kamar_pindah : '' }}" />
                            <input type="hidden" id="kd_bangsal_pindah" name="kd_bangsal_pindah" value="{{ !empty($model->kd_bangsal_pindah) ? $model->kd_bangsal_pindah : '' }}" />
                            <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=kamar_bangsal_inap_harga') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='80%' data-modal-action-change="function=.set-data-list-from-modal-custome-me@data-target=#kd_kamar_pindah|#kd_bangsal_pindah|#nm_bangsal_pindah|#trf_kamar_pindah@data-key-bagan=0@data-btn-close=#closeModalData">
                                <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                            </span>
                            <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                        </div>
                        <div class="message"></div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-lg-6 col-md-12">
            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6">
                    <div class='bagan_form'>
                        <div class='input-date-time-bagan'>
                            <label for="tgl_masuk" class="form-label">Waktu Masuk : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-daterange input-date-time input-date-time-cus-me" id='tgl_masuk' autocomplete="off">
                            <?php 
                                $tanggal='';
                                $jam='';
                                if(!empty($model->waktu_masuk)){
                                    $waktu=new \DateTime($model->waktu_masuk);
                                    $tanggal=$waktu->format('Y-m-d');
                                    $jam=$waktu->format('H:i');
                                }
                            ?>
                            <input type="hidden" id="tgl" required name="tgl_masuk" value="{{ !empty($tanggal) ? $tanggal : date('Y-m-d') }}">
                            <input type="hidden" id="jam" required name="jam_masuk" value="{{ !empty($jam) ? $jam : date('H:i') }}">
                        </div>
                        <div class="message"></div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class='bagan_form'>
                        <div class='input-date-time-bagan'>
                            <label for="tgl_keluar" class="form-label">Waktu Keluar : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-daterange input-date-time input-date-time-cus-me" id='tgl_keluar' autocomplete="off">
                            <?php 
                                $tanggal='';
                                $jam='';
                                if(!empty($model->waktu_keluar)){
                                    $waktu=new \DateTime($model->waktu_keluar);
                                    $tanggal=$waktu->format('Y-m-d');
                                    $jam=$waktu->format('H:i');
                                }
                            ?>
                            <input type="hidden" id="tgl" required name="tgl_keluar" value="{{ !empty($tanggal) ? $tanggal : date('Y-m-d') }}">
                            <input type="hidden" id="jam" required name="jam_keluar" value="{{ !empty($jam) ? $jam : date('H:i') }}">
                        </div>
                        <div class="message"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th style="width: 19%" class='text-end'>Tarif Kamar Awal</th>
                            <th style="width: 1%" class='text-center'></th>
                            <th style="width: 19%" class='text-end'>Tarif Kamar Pindah</th>
                            <th style="width: 1%" class='text-center'></th>
                            <th style="width: 19%" class='text-end'>Selisih</th>
                            <th style="width: 1%" class='text-center'></th>
                            <th style="width: 19%" class='text-end'>Lama Inap</th>
                            <th style="width: 1%" class='text-center'></th>
                            <th style="width: 20%" class='text-end'>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class='bagan_form'>
                                    <input type="text" class="form-control money" readonly id="trf_kamar_awal" name='trf_kamar_awal' required value="{{ !empty($model->trf_kamar_awal) ? $model->trf_kamar_awal : '' }}">
                                    <div class="message"></div>
                                </div>
                            </td>
                            <td style='vertical-align: middle; font-size:20px'>-</td>
                            <td>
                                <div class='bagan_form'>
                                    <input type="text" class="form-control money" readonly id="trf_kamar_pindah" name='trf_kamar_pindah' required value="{{ !empty($model->trf_kamar_pindah) ? $model->trf_kamar_pindah : '' }}">
                                    <div class="message"></div>
                                </div>
                            </td>
                            <td style='vertical-align: middle; font-size:20px'>=</td>
                            <td>
                                <div class='bagan_form'>
                                    <input type="text" disabled class="form-control money" id="selisih" value="">
                                    <div class="message"></div>
                                </div>
                            </td>
                            <td style='vertical-align: middle; font-size:20px'>X</td>
                            <td>
                                <div class='bagan_form'>
                                    <input type="text" class="form-control money" disabled id="lama_nginap" name='lama' required value="{{ !empty($model->lama) ? $model->lama : '' }}">
                                    <div class="message"></div>
                                </div>
                            </td>
                            <td style='vertical-align: middle; font-size:20px'>=</td>
                            <td>
                                <div class='bagan_form'>
                                    <input type="text" disabled class="form-control money" id="total" value="">
                                    <div class="message"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-5">
            <button class="btn btn-primary" id='btn_save' type="submit">{{ !empty($kode_send) ? 'Ubah' : 'Simpan'  }}</button>
            @if(!empty($kode_send))
                <a href="{{ url($url_clear_form) }}" class="btn btn-default">Batal</a>
            @endif
        </div>
    </div>
</form>

@push('script-end-2')
<script src="{{ asset('js/pindah-kamar-pasien-ranap/form.js') }}"></script>
@endpush