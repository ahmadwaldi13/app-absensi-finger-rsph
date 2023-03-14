<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>

    <form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
        @csrf
        <input type="hidden" name="id_resume" value="{{ !empty($model->id_resume_ranap) ? $model->id_resume_ranap : ''  }}"  >
        <input type="hidden" name="key_old" value="{{ !empty($kode_key_old) ? $kode_key_old : ''  }}"  >
        <input type="hidden" class="form-control" name="fr" value="{{ !empty($model->fr) ? $model->fr : '' }}">
        <input type="hidden" class="form-control" name="no_rm" value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
        <input type="hidden" class="form-control" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                    <label for="norawat" class="form-label">No.Rawat</label>
                    <input type="text" class="form-control" id="norawat" readonly disabled required  value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
                    <div class="message"></div>
                </div>
            </div>
            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                    <input type="text" class="form-control " id="name" readonly disabled required  value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
                    <div class="message"></div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <input type="text" class="form-control " readonly disabled required value="{{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}">
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            

            <div class="col-lg-3 mb-3">
                <div class='bagan_form'>
                    <label for="kd_dokter" class="form-label">Dokter P.J <span class="text-danger">*</span></label>
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
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-3 mb-3">
                <label class="form-label">Dokter Pengirim</label>
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->kd_dokter) ? $data_ranap->kd_dokter :  "" }}'>
            </div>
            <div class="col-lg-5 mb-3">
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->nm_dokter) ? $data_ranap->nm_dokter :  "" }}'>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            
            <div class="col-lg-2 mb-3">
                <label class="form-label">Tanggal & Jam Masuk</label>
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->tgl_registrasi) ? $data_ranap->tgl_registrasi :  "" }}'>
            </div>
            <div class="col-lg-2 mb-3">
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->jam_reg) ? $data_ranap->jam_reg :  "" }}'>
            </div>
            
            <div class="col-lg-2 mb-3">
                <label class="form-label">Tanggal & Jam Keluar</label>
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->tgl_keluar) ? $data_ranap->tgl_keluar :  "" }}'>
            </div>
            <div class="col-lg-2 mb-3">
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->jam_keluar) ? $data_ranap->jam_keluar :  "" }}'>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 mb-3">
                <label class="form-label">Bangsal/Kamar</label>
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->kd_kamar) ? $data_ranap->kd_kamar :  "" }}'>
            </div>
            <div class="col-lg-2 mb-3">
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->nm_bangsal) ? $data_ranap->nm_bangsal :  "" }}'>
            </div>

            <div class="col-lg-2 mb-3">
                <label class="form-label">Cara Bayar</label>
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->kd_pj) ? $data_ranap->kd_pj :  "" }}'>
            </div>
            <div class="col-lg-2 mb-3">
                <input type="text" class="form-control" disabled value='{{ !empty($data_ranap->png_jawab) ? $data_ranap->png_jawab :  "" }}'>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-4 mb-3">
                <label class="form-label">Diagnosa Awal Masuk</label>
                <textarea class="form-control form-duplicate" data-target='.confirm_diagnosa_awal' name="diagnosa_awal" rows="3">{{ !empty($model->diagnosa_awal) ? $model->diagnosa_awal : "" }}</textarea>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="form-label">Alasan Masuk Dirawat</label>
                <textarea class="form-control form-duplicate" data-target='.confirm_alasan' name="alasan" rows="3">{{ !empty($model->alasan) ? $model->alasan : "" }}</textarea>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="textarea_keluhan_utama" class="form-label">Keluhan utama riwayat penyakit : <span class="text-danger">*</span></label>
                    <div class="textarea-button-inside">
                        <textarea class="form-control form-duplicate" data-target='.confirm_keluhan_utama' id="textarea_keluhan_utama" name="keluhan_utama" rows="3" required >{{ !empty($model->keluhan_utama) ? $model->keluhan_utama : "" }}</textarea>
                        <span class="textarea-button modal-remote-data" data-table-checkbox="true" data-modal-src="{{ url('isi-resume/ajax?action=pemeriksaan_keluhan') }}" data-modal-key="{{ $model->fr.'@'.$model->no_rawat }}" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_keluhan_utama@data-target2=.confirm_keluhan_utama@data-btn-close=#closeModalData">
                            <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                        </span>
                    </div>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="textarea_pemeriksaan_fisik" class="form-label">Pemeriksaan Fisik :</label>
                    <div class="textarea-button-inside">
                        <textarea class="form-control form-duplicate" data-target='.confirm_pemeriksaan_fisik' id="textarea_pemeriksaan_fisik" name="pemeriksaan_fisik" rows="3" >{{ !empty($model->pemeriksaan_fisik) ? $model->pemeriksaan_fisik : "" }}</textarea>
                        <span class="textarea-button modal-remote-data" data-table-checkbox="true" data-modal-src="{{ url('isi-resume/ajax?action=pemeriksaan_fisik') }}" data-modal-key="{{ $model->fr.'@'.$model->no_rawat }}" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_pemeriksaan_fisik@data-target2=.confirm_pemeriksaan_fisik@data-btn-close=#closeModalData">
                            <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                        </span>
                    </div>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <label for="textarea_jalannya_penyakit" class="form-label">Jalannya penyakit selama perawatan :</label>
                <textarea class="form-control form-duplicate" data-target='.confirm_jalannya_penyakit' id="textarea_jalannya_penyakit" name="jalannya_penyakit" rows="3">{{ !empty($model->jalannya_penyakit) ? $model->jalannya_penyakit : "" }}</textarea>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="textarea_pemeriksaan_penunjang" class="form-label">Pemeriksaan Penunjang Rad Terpenting :</label>
                    <div class="textarea-button-inside">
                        <textarea class="form-control form-duplicate" data-target='.confirm_pemeriksaan_penunjang' id="textarea_pemeriksaan_penunjang" name="pemeriksaan_penunjang" rows="3" >{{ !empty($model->pemeriksaan_penunjang) ? $model->pemeriksaan_penunjang : "" }}</textarea>
                        <span class="textarea-button modal-remote-data" data-table-checkbox="true" data-modal-src="{{ url('isi-resume/ajax?action=pemeriksaan_radiologi') }}" data-modal-key="{{ $model->no_rawat }}" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_pemeriksaan_penunjang@data-target2=.confirm_pemeriksaan_penunjang@data-btn-close=#closeModalData">
                            <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                        </span>
                    </div>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="textarea_hasil_laborat" class="form-label">Pemeriksaan Penunjang Lab Terpenting :</label>
                    <div class="textarea-button-inside">
                        <textarea class="form-control form-duplicate" data-target='.confirm_hasil_laborat' id="textarea_hasil_laborat" name="hasil_laborat" rows="3" >{{ !empty($model->hasil_laborat) ? $model->hasil_laborat : "" }}</textarea>
                        <span class="textarea-button modal-remote-data" data-table-checkbox="true" data-modal-src="{{ url('isi-resume/ajax?action=pemeriksaan_lab') }}" data-modal-key="{{ $model->no_rawat }}" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_hasil_laborat@data-target2=.confirm_hasil_laborat@data-btn-close=#closeModalData">
                            <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                        </span>
                    </div>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="textarea_tindakan_dan_operasi" class="form-label">Tindakan/Operasi Selama Perawatan :</label>
                    <div class="textarea-button-inside">
                        <textarea class="form-control form-duplicate" data-target='.confirm_tindakan_dan_operasi' id="textarea_tindakan_dan_operasi" name="tindakan_dan_operasi" rows="3" >{{ !empty($model->tindakan_dan_operasi) ? $model->tindakan_dan_operasi : "" }}</textarea>
                        <span class="textarea-button modal-remote-data" data-table-checkbox="true" data-modal-src="{{ url('isi-resume/ajax?action=riwayat_tindakan_operasi') }}" data-modal-key="{{ $model->no_rawat }}" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_tindakan_dan_operasi@data-target2=.confirm_tindakan_dan_operasi@data-btn-close=#closeModalData">
                            <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                        </span>
                    </div>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="textarea_obat_di_rs" class="form-label">Obat-obatan Selama Perawatan :</label>
                    <div class="textarea-button-inside">
                        <textarea class="form-control form-duplicate" data-target='.confirm_obat_di_rs' id="textarea_obat_di_rs" name="obat_di_rs" rows="3" >{{ !empty($model->obat_di_rs) ? $model->obat_di_rs : "" }}</textarea>
                        <span class="textarea-button modal-remote-data" data-table-checkbox="true" data-modal-src="{{ url('isi-resume/ajax?action=obat_rs') }}" data-modal-key="{{ $model->no_rawat }}" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_obat_di_rs@data-target2=.confirm_obat_di_rs@data-btn-close=#closeModalData">
                            <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                        </span>
                    </div>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div>
            <legend>Diagnosa Akhir</legend>
            <hr class="mb-5">

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="diagnosa_utama" class="form-label">Diagnosa Utama : <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-duplicate" data-target='.confirm_diagnosa_utama'  name="diagnosa_utama" hidden id="diagnosa_utama" required  value='{{ !empty($model->diagnosa_utama) ? $model->diagnosa_utama : "" }}'>
                        <select class="get-diagnosa" data-target-text='#diagnosa_utama|.confirm_diagnosa_utama' data-target-kode='#kd_diagnosa_utama|.confirm_kd_diagnosa_utama'>
                            <option value='{{ !empty($model->diagnosa_utama) ? $model->diagnosa_utama : "" }}'>{{ !empty($model->diagnosa_utama) ? $model->diagnosa_utama : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_diagnosa_utama" class="form-label">Kode ICD</label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_diagnosa_utama' name="kd_diagnosa_utama" id="kd_diagnosa_utama" value='{{ !empty($model->kd_diagnosa_utama) ? $model->kd_diagnosa_utama : "" }}'>
                </div>
            </div>

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="diagnosa_sekunder" class="form-label">Diagnosa Sekunder 1 :</label>
                        <input type="text" class="form-control form-duplicate" data-target='.confirm_diagnosa_sekunder' name="diagnosa_sekunder" hidden id="diagnosa_sekunder" value='{{ !empty($model->diagnosa_sekunder) ? $model->diagnosa_sekunder : "" }}'>
                        <select class="get-diagnosa" data-target-text='#diagnosa_sekunder|.confirm_diagnosa_sekunder' data-target-kode='#kd_diagnosa_sekunder|.confirm_kd_diagnosa_sekunder'>
                            <option value='{{ !empty($model->diagnosa_sekunder) ? $model->diagnosa_sekunder : "" }}'>{{ !empty($model->diagnosa_sekunder) ? $model->diagnosa_sekunder : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_diagnosa_sekunder" class="form-label">Kode ICD</label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_diagnosa_sekunder' name="kd_diagnosa_sekunder" id="kd_diagnosa_sekunder" value='{{ !empty($model->kd_diagnosa_sekunder) ? $model->kd_diagnosa_sekunder : "" }}'>
                </div>
            </div>

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="diagnosa_sekunder2" class="form-label">Diagnosa Sekunder 2 :</label>
                        <input type="text" class="form-control  form-duplicate" data-target='.confirm_diagnosa_sekunder2' name="diagnosa_sekunder2" hidden id="diagnosa_sekunder2" value='{{ !empty($model->diagnosa_sekunder2) ? $model->diagnosa_sekunder2 : "" }}'>
                        <select class="get-diagnosa" data-target-text='#diagnosa_sekunder2|.confirm_diagnosa_sekunder2' data-target-kode='#kd_diagnosa_sekunder2|.confirm_kd_diagnosa_sekunder2'>
                            <option value='{{ !empty($model->diagnosa_sekunder2) ? $model->diagnosa_sekunder2 : "" }}'>{{ !empty($model->diagnosa_sekunder2) ? $model->diagnosa_sekunder2 : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_diagnosa_sekunder2" class="form-label">Kode ICD</label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_diagnosa_sekunder2' name="kd_diagnosa_sekunder2" id="kd_diagnosa_sekunder2" value='{{ !empty($model->kd_diagnosa_sekunder2) ? $model->kd_diagnosa_sekunder2 : "" }}'>
                </div>
            </div>

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="diagnosa_sekunder3" class="form-label">Diagnosa Sekunder 3 :</label>
                        <input type="text" class="form-control form-duplicate" data-target='.confirm_diagnosa_sekunder3' name="diagnosa_sekunder3" hidden id="diagnosa_sekunder3" value='{{ !empty($model->diagnosa_sekunder3) ? $model->diagnosa_sekunder3 : "" }}'>
                        <select class="get-diagnosa" data-target-text='#diagnosa_sekunder3|.confirm_diagnosa_sekunder3' data-target-kode='#kd_diagnosa_sekunder3|.confirm_kd_diagnosa_sekunder3'>
                            <option value='{{ !empty($model->diagnosa_sekunder3) ? $model->diagnosa_sekunder3 : "" }}'>{{ !empty($model->diagnosa_sekunder3) ? $model->diagnosa_sekunder3 : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_diagnosa_sekunder3" class="form-label">Kode ICD</label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_diagnosa_sekunder3' name="kd_diagnosa_sekunder3" id="kd_diagnosa_sekunder3" value='{{ !empty($model->kd_diagnosa_sekunder3) ? $model->kd_diagnosa_sekunder3 : "" }}'>
                </div>
            </div>

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="diagnosa_sekunder4" class="form-label">Diagnosa Sekunder 4 :</label>
                        <input type="text" class="form-control form-duplicate" data-target='.confirm_diagnosa_sekunder4' name="diagnosa_sekunder4" hidden id="diagnosa_sekunder4" value='{{ !empty($model->diagnosa_sekunder4) ? $model->diagnosa_sekunder4 : "" }}'>
                        <select class="get-diagnosa" data-target-text='#diagnosa_sekunder4|.confirm_diagnosa_sekunder4' data-target-kode='#kd_diagnosa_sekunder4|.confirm_kd_diagnosa_sekunder4'>
                            <option value='{{ !empty($model->diagnosa_sekunder4) ? $model->diagnosa_sekunder4 : "" }}'>{{ !empty($model->diagnosa_sekunder4) ? $model->diagnosa_sekunder4 : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_diagnosa_sekunder4" class="form-label">Kode ICD</label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_diagnosa_sekunder4' name="kd_diagnosa_sekunder4" id="kd_diagnosa_sekunder4" value='{{ !empty($model->kd_diagnosa_sekunder4) ? $model->kd_diagnosa_sekunder4 : "" }}'>
                </div>
            </div>
        </div>

        <div>
            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="prosedur_utama" class="form-label">Prosedur Utama : </label>
                        <input type="text" class="form-control form-duplicate" data-target='.confirm_prosedur_utama' name="prosedur_utama" hidden id="prosedur_utama" value='{{ !empty($model->prosedur_utama) ? $model->prosedur_utama : "" }}'>
                        <select class="get-prosedur" data-target-text='#prosedur_utama|.confirm_prosedur_utama' data-target-kode='#kd_prosedur_utama|.confirm_kd_prosedur_utama'>
                            <option value='{{ !empty($model->prosedur_utama) ? $model->prosedur_utama : "" }}'>{{ !empty($model->prosedur_utama) ? $model->prosedur_utama : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_prosedur_utama" class="form-label">Kode ICD</label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_prosedur_utama' name="kd_prosedur_utama" id="kd_prosedur_utama" value='{{ !empty($model->kd_prosedur_utama) ? $model->kd_prosedur_utama : "" }}'>
                </div>
            </div>

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="prosedur_sekunder" class="form-label">Prosedur Sekunder 1 :</label>
                        <input type="text" class="form-control form-duplicate" data-target='.confirm_prosedur_sekunder' name="prosedur_sekunder" hidden id="prosedur_sekunder" value='{{ !empty($model->prosedur_sekunder) ? $model->prosedur_sekunder : "" }}'>
                        <select class="get-prosedur" data-target-text='#prosedur_sekunder|.confirm_prosedur_sekunder' data-target-kode='#kd_prosedur_sekunder|.confirm_kd_prosedur_sekunder'>
                            <option value='{{ !empty($model->prosedur_sekunder) ? $model->prosedur_sekunder : "" }}'>{{ !empty($model->prosedur_sekunder) ? $model->prosedur_sekunder : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_prosedur_sekunder" class="form-label">Kode ICD</label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_prosedur_sekunder' name="kd_prosedur_sekunder" id="kd_prosedur_sekunder" value='{{ !empty($model->kd_prosedur_sekunder) ? $model->kd_prosedur_sekunder : "" }}'>
                </div>
            </div>

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="prosedur_sekunder2" class="form-label">Prosedur Sekunder 2 :</label>
                        <input type="text" class="form-control form-duplicate" data-target='.confirm_prosedur_sekunder2' name="prosedur_sekunder2" hidden id="prosedur_sekunder2" value='{{ !empty($model->prosedur_sekunder2) ? $model->prosedur_sekunder2 : "" }}'>
                        <select class="get-prosedur" data-target-text='#prosedur_sekunder2|.confirm_prosedur_sekunder2' data-target-kode='#kd_prosedur_sekunder2|.confirm_kd_prosedur_sekunder2'>
                            <option value='{{ !empty($model->prosedur_sekunder2) ? $model->prosedur_sekunder2 : "" }}'>{{ !empty($model->prosedur_sekunder2) ? $model->prosedur_sekunder2 : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_prosedur_sekunder2" class="form-label">Kode ICD</label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_prosedur_sekunder2' name="kd_prosedur_sekunder2" id="kd_prosedur_sekunder2" value='{{ !empty($model->kd_prosedur_sekunder2) ? $model->kd_prosedur_sekunder2 : "" }}'>
                </div>
            </div>

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="prosedur_sekunder3" class="form-label">Prosedur Sekunder 3 :</label>
                        <input type="text" class="form-control form-duplicate" data-target='.confirm_prosedur_sekunder3' name="prosedur_sekunder3" hidden id="prosedur_sekunder3" value='{{ !empty($model->prosedur_sekunder3) ? $model->prosedur_sekunder3 : "" }}'>
                        <select class="get-prosedur" data-target-text='#prosedur_sekunder3|.confirm_prosedur_sekunder3' data-target-kode='#kd_prosedur_sekunder3|.confirm_kd_prosedur_sekunder3'>
                            <option value='{{ !empty($model->prosedur_sekunder3) ? $model->prosedur_sekunder3 : "" }}'>{{ !empty($model->prosedur_sekunder3) ? $model->prosedur_sekunder3 : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_prosedur_sekunder3" class="form-label">Kode ICD</label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_prosedur_sekunder3' name="kd_prosedur_sekunder3" id="kd_prosedur_sekunder3" value='{{ !empty($model->kd_prosedur_sekunder3) ? $model->kd_prosedur_sekunder3 : "" }}'>
                </div>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <label class="form-label">Alergi Obat</label>
                <input type="text" class="form-control  form-duplicate" data-target='.confirm_alergi' name='alergi' value='{{ !empty($model->alergi) ? $model->alergi : "" }}'>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="textarea_diet" class="form-label">Diet :</label>
                    <div class="textarea-button-inside">
                        <textarea class="form-control form-duplicate" data-target='.confirm_diet' id="textarea_diet" name="diet" rows="3" >{{ !empty($model->diet) ? $model->diet : "" }}</textarea>
                        <span class="textarea-button modal-remote-data" data-table-checkbox="true" data-modal-src="{{ url('isi-resume/ajax?action=riwayat_diet') }}" data-modal-key="{{ $model->no_rawat }}" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_diet@data-target2=.confirm_diet@data-btn-close=#closeModalData">
                            <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                        </span>
                    </div>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="textarea_lab_belum" class="form-label">Hasil Lab Yang Belum Selesai (Pending) :</label>
                    <div class="textarea-button-inside">
                        <textarea class="form-control form-duplicate" data-target='.confirm_lab_belum' id="textarea_lab_belum" name="lab_belum" rows="3" >{{ !empty($model->lab_belum) ? $model->lab_belum : "" }}</textarea>
                        <span class="textarea-button modal-remote-data" data-table-checkbox="true" data-modal-src="{{ url('isi-resume/ajax?action=hasil_lab_belum') }}" data-modal-key="{{ $model->no_rawat }}" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_lab_belum@data-target2=.confirm_lab_belum@data-btn-close=#closeModalData">
                            <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                            <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                        </span>
                    </div>
                    <div class="message"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <label for="textarea_edukasi" class="form-label">Instruksi/Anjuran Dan Edukasi ( Follow Up ) :</label>
                <textarea class="form-control form-duplicate" data-target='.confirm_edukasi' id="textarea_edukasi" name="edukasi" rows="3">{{ !empty($model->edukasi) ? $model->edukasi : "" }}</textarea>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                    <label for="keadaan" class="form-label">Keadaan Pulang</label>
                    <select class="form-select input-dropdown form-duplicate" data-target='.confirm_keadaan' name="keadaan" aria-label="Default select example" id="keadaan">
                        @php
                            $dipilih=!empty($model->keadaan) ? $model->keadaan : "";
                        @endphp
                        @foreach($keadaan_pulang_pasien as $key => $item)
                            @php
                                $selected='';
                                if(strtolower($dipilih)==strtolower($item)){
                                    $selected='selected';
                                }
                            @endphp
                            <option value="{{ $item }}" {{ $selected }} >{{ $item }}</option>
                        @endforeach
                    </select>
                    <div class="message"></div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <label for="ket_keadaan" class="form-label">Keterangan :</label>
                <input type="text" class="form-control form-duplicate" data-target='.confirm_ket_keadaan' name="ket_keadaan" value='{{ !empty($model->ket_keadaan) ? $model->ket_keadaan : "" }}'>
            </div>
        </div>
        
        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                    <label for="cara_keluar" class="form-label">Cara Keluar :</label>
                    <select class="form-select input-dropdown form-duplicate" data-target='.confirm_cara_keluar' name="cara_keluar" aria-label="Default select example" id="cara_keluar">
                        @php
                            $dipilih=!empty($model->cara_keluar) ? $model->cara_keluar : "";
                        @endphp
                        @foreach($cara_keluar_pasien as $key => $item)
                            @php
                                $selected='';
                                if(strtolower($dipilih)==strtolower($item)){
                                    $selected='selected';
                                }
                            @endphp
                            <option value="{{ $item }}" {{ $selected }} >{{ $item }}</option>
                        @endforeach
                    </select>
                    <div class="message"></div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <label for="ket_keluar" class="form-label">Keterangan :</label>
                <input type="text" class="form-control form-duplicate" data-target='.confirm_ket_keluar' name="ket_keluar" value='{{ !empty($model->ket_keluar) ? $model->ket_keluar : "" }}'>
            </div>
        </div>
        
        
        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                    <label for="dilanjutkan" class="form-label">Dilanjutkan :</label>
                    <select class="form-select input-dropdown form-duplicate" data-target='.confirm_dilanjutkan' name="dilanjutkan" aria-label="Default select example" id="dilanjutkan">
                        @php
                            $dipilih=!empty($model->dilanjutkan) ? $model->dilanjutkan : "";
                        @endphp
                        @foreach($pasien_dilanjutkan as $key => $item)
                            @php
                                $selected='';
                                if(strtolower($dipilih)==strtolower($item)){
                                    $selected='selected';
                                }
                            @endphp
                            <option value="{{ $item }}" {{ $selected }} >{{ $item }}</option>
                        @endforeach
                    </select>
                    <div class="message"></div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <label for="ket_dilanjutkan" class="form-label">Keterangan :</label>
                <input type="text" class="form-control form-duplicate" data-target='.confirm_ket_dilanjutkan' name="ket_dilanjutkan" value='{{ !empty($model->ket_dilanjutkan) ? $model->ket_dilanjutkan : "" }}'>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-4 mb-3">
                <div class='input-date-time-bagan'>
                    <label for="tanggal" class="form-label">Tanggal & Jam Kontrol :</label>
                    <input type="text" class="form-control input-daterange input-date-time" id='tanggal' autocomplete="off">
                    @php
                        $tgl_default=!empty($model->tanggal_kontrol) ? $model->tanggal_kontrol : date('Y-m-d');
                        $jam_default=!empty($model->jam_kontrol) ? $model->jam_kontrol : date('H:i');
                    @endphp
                    <input type="text" class=" form-duplicate" data-target='.confirm_tanggal_kontrol' hidden id="tgl" required name="tanggal_kontrol" value='{{ $tgl_default }}'>
                    <input type="text" class=" form-duplicate" data-target='.confirm_jam_kontrol' hidden id="jam" required name="jam_kontrol" value='{{ $jam_default }}'>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <label for="textarea_obat_pulang" class="form-label">Obat Pulang :</label>
                <div class="textarea-button-inside">
                    <textarea class="form-control form-duplicate" data-target='.confirm_obat_pulang' id="textarea_obat_pulang" name="obat_pulang" rows="3">{{ !empty($model->obat_pulang) ? $model->obat_pulang : "" }}</textarea>
                    <span class="textarea-button modal-remote-data" data-table-checkbox="true" data-modal-src="{{ url('isi-resume/ajax?action=obat_rs') }}" data-modal-key="{{ $model->no_rawat }}" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_obat_pulang@data-target2=.confirm_obat_pulang@data-btn-close=#closeModalData">
                        <!-- <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span> -->
                        <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                    </span>
                </div>
                <span class="errorMessageObat text-danger"></span>
            </div>
        </div>
        

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 mb-3">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary submit_confirmasi" data-action='target=#show_modal_confir_ranap@action=click' type="button">{{ !empty($kode_key_old) ? 'Ubah' : 'Simpan'  }}</button>
                    <button hidden id="done_submit_ranap" type="submit"></button>
                </div>
            </div>
        </div>
    </form>
