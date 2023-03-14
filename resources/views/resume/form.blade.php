<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>

    <form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
        @csrf
        <input type="hidden" name="id_resume" value="{{ !empty($model->id_resume) ? $model->id_resume : ''  }}"  >
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
                    <label for="kd_dokter" class="form-label">Dokter <span class="text-danger">*</span></label>
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

            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                    <label for="kondisi_pulang" class="form-label">Kondisi Pasien Pulang <span class="text-danger">*</span></label>
                    <select class="form-select input-dropdown form-duplicate" data-target='.confirm_kondisi_pulang' required  name="kondisi_pulang" aria-label="Default select example" id="kondisi_pulang">
                        @php
                            $dipilih=!empty($model->kondisi_pulang) ? $model->kondisi_pulang : "";
                        @endphp
                        @foreach($kondisiPasienPulang as $key => $item)
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
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="textarea_keluhan_utama" class="form-label">Keluhan utama riwayat penyakit yang positif : <span class="text-danger">*</span></label>
                    <div class="textarea-button-inside">
                        <textarea class="form-control form-duplicate" data-target='.confirm_keluhan_utama' id="textarea_keluhan_utama" name="keluhan_utama" rows="3" required >{{ !empty($model->keluhan_utama) ? $model->keluhan_utama : "" }}</textarea>
                        <span class="textarea-button modal-remote-data" data-modal-src="{{ url('isi-resume/ajax?action=pemeriksaan_keluhan') }}" data-modal-key="{{ $model->fr.'@'.$model->no_rawat }}" data-modal-pencarian='true' data-table-checkbox="true" data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_keluhan_utama@data-target2=.confirm_keluhan_utama@data-btn-close=#closeModalData">
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
            <label for="textarea_pemeriksaan_penunjang" class="form-label">Pemeriksaan penunjang yang positif :</label>
                <div class="textarea-button-inside">
                    <textarea class="form-control form-duplicate" data-target='.confirm_pemeriksaan_penunjang' id="textarea_pemeriksaan_penunjang" name="pemeriksaan_penunjang" rows="3">{{ !empty($model->pemeriksaan_penunjang) ? $model->pemeriksaan_penunjang : "" }}</textarea>
                    <span class="textarea-button modal-remote-data" data-modal-src="{{ url('isi-resume/ajax?action=pemeriksaan_radiologi') }}" data-modal-key="{{ $model->no_rawat }}" data-modal-pencarian='true' data-table-checkbox="true" data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_pemeriksaan_penunjang@data-target2=.confirm_pemeriksaan_penunjang@data-btn-close=#closeModalData">
                        <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                    </span>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
            <label for="textarea_hasil_laborat" class="form-label">Hasil Tindakan/Hasil laboratorium yang positif :</label>
                <div class="textarea-button-inside">
                    <textarea class="form-control form-duplicate" data-target='.confirm_hasil_laborat' id="textarea_hasil_laborat" name="hasil_laborat" rows="3">{{ !empty($model->hasil_laborat) ? $model->hasil_laborat : "" }}</textarea>
                    <span class="textarea-button modal-remote-data" data-modal-src="{{ url('isi-resume/ajax?action=pemeriksaan_lab') }}" data-modal-key="{{ $model->no_rawat }}" data-modal-pencarian='true' data-table-checkbox="true" data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_hasil_laborat@data-target2=.confirm_hasil_laborat@data-btn-close=#closeModalData">
                        <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                    </span>
                </div>
            </div>
        </div>

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

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <div class='bagan_form'>
                    <label for="prosedur_utama" class="form-label">Prosedur Utama :</label>
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

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-6 mb-3">
                <label for="textarea_obat_pulang" class="form-label">Obat-obatan waktu pulang / nasihat :</label>
                <div class="textarea-button-inside">
                    <textarea class="form-control form-duplicate" data-target='.confirm_obat_pulang' id="textarea_obat_pulang" name="obat_pulang" rows="3">{{ !empty($model->obat_pulang) ? $model->obat_pulang : "" }}</textarea>
                    <span class="textarea-button modal-remote-data" data-modal-src="{{ url('isi-resume/ajax?action=obat_rs') }}" data-modal-key="{{ $model->no_rawat }}" data-table-checkbox="true" data-modal-pencarian='true' data-modal-action-change="function=.get-data-list-from-modal@data-target=#textarea_obat_pulang@data-target2=.confirm_obat_pulang@data-btn-close=#closeModalData">
                        <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                    </span>
                </div>
                <span class="errorMessageObat text-danger"></span>
            </div>
        </div>
        
        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 mb-3">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary submit_confirmasi" data-action='target=#show_modal_confir_ralan@action=click' type="button">{{ !empty($kode_key_old) ? 'Ubah' : 'Simpan'  }}</button>
                    <button hidden id="done_submit_ralan" type="submit"></button>
                </div>
            </div>
        </div>
    </form>
