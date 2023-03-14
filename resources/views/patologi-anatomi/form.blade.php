<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
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
                <label for="tanggal_permintaan" class="form-label">Tanggal Permintaan : <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-daterange input-date-time" id='tanggal_permintaan' autocomplete="off">
                <input type="hidden" id="tgl" required name="tgl_permintaan" value="{{ !empty($model->tgl_permintaan) ? $model->tgl_permintaan : date('Y-m-d') }}">
                <input type="hidden" id="jam" required name="jam_permintaan" value="{{ !empty($model->jam_permintaan) ? $model->jam_permintaan : date('H:i') }}">
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="kd_dokter" class="form-label">Dokter Perujuk <span class="text-danger">*</span></label>
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
                <label for="nomor_permintaan" class="form-label">Nomor Permintaan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nomor_permintaan" disabled placeholder="Nomor Permintaan" required value='{{ !empty($model->no_order) ? $model->no_order :  "" }}'>
                <div class="message"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-6 mb-3">
            <div class='bagan_form'>
                <label for="indikasi" class="form-label">Indikasi / Klinis <span class="text-danger">*</span></label>
                <textarea class="form-control" id="indikasi" name="diagnosa_klinis" required rows="3">{{ !empty($model->diagnosa_klinis) ? $model->diagnosa_klinis :  "" }}</textarea>
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class='bagan_form'>
                <label for="informasi_tambahan" class="form-label">Informasi Tambahan</label>
                <textarea class="form-control" id="informasi_tambahan" name="informasi_tambahan" rows="3">{{ !empty($model->informasi_tambahan) ? $model->informasi_tambahan :  "" }}</textarea>
                <div class="message"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-4">
            <div class='input-date-bagan'>
                <label for="tanggal_bahan" class="form-label">Pengambilan bahan : </label>
                <input type="text" class="form-control input-daterange input-date" id='tanggal_bahan' autocomplete="off">
                <input type="hidden" id="tgl" required name="pengambilan_bahan" value="{{ !empty($model->pengambilan_bahan) ? $model->pengambilan_bahan : date('Y-m-d') }}">
            </div>
        </div>
        <div class="col-lg-8">
            <div class='bagan_form'>
                <label for="diperolehAnatomi" class="form-label">Diperoleh dengan : </label>
                <input type="text" class="form-control" name="diperoleh_dengan" id="diperolehAnatomi" value="{{ !empty($model->diperoleh_dengan) ? $model->diperoleh_dengan : '' }}">
                <div class="message"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-8">
            <div class='bagan_form'>
                <label for="lokasi_jaringan" class="form-label">Lokasi pengambilan jaringan :</label>
                <input type="text" class="form-control" name="lokasi_jaringan" id="lokasi_jaringan" value="{{ !empty($model->lokasi_jaringan) ? $model->lokasi_jaringan : '' }}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class='bagan_form'>
                <label for="diawetkan_dengan" class="form-label">Diawetkan/Direndam dengan :</label>
                <input type="text" class="form-control" name="diawetkan_dengan" id="diawetkan_dengan" value="{{ !empty($model->diawetkan_dengan) ? $model->diawetkan_dengan : '' }}">
                <div class="message"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-8">
            <div class='bagan_form'>
                <label for="pernah_dilakukan_di" class="form-label">Pernah Dilakukan PA Di :</label>
                <input type="text" class="form-control" name="pernah_dilakukan_di" id="pernah_dilakukan_di" value="{{ !empty($model->pernah_dilakukan_di) ? $model->pernah_dilakukan_di : '' }}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class='input-date-bagan'>
                <label for="tanggal_pa_sebelumnya" class="form-label">Pada Tanggal : </label>
                <input type="text" class="form-control input-daterange input-date" id='tanggal_pa_sebelumnya' autocomplete="off">
                <input type="hidden" id="tgl" required name="tanggal_pa_sebelumnya" value="{{ !empty($model->tanggal_pa_sebelumnya) ? $model->tanggal_pa_sebelumnya : date('Y-m-d') }}">
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-4">
            <div class='bagan_form'>
                <label for="nomor_pa_sebelumnya" class="form-label">Dengan Nomor PA :</label>
                <input type="text" class="form-control" name="nomor_pa_sebelumnya" id="nomor_pa_sebelumnya" value="{{ !empty($model->nomor_pa_sebelumnya) ? $model->nomor_pa_sebelumnya : '' }}">
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class='bagan_form'>
                <label for="diagnosa_pa_sebelumnya" class="form-label">Dengan Diagnosa PA :</label>
                <input type="text" class="form-control" name="diagnosa_pa_sebelumnya" id="diagnosa_pa_sebelumnya" value="{{ !empty($model->diagnosa_pa_sebelumnya) ? $model->diagnosa_pa_sebelumnya : '' }}">
                <div class="message"></div>
            </div>
        </div>
    </div>

    <div>
        <hr class='mt-5'>
        <div class='bagan-data-table'>
            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-4 col-md-10 mb-3">
                    <label for="cari_keyword" class="form-label">Pencarian Permintaan</label>
                    <input type="text" class="form-control search-data-table" id="cari_keyword" placeholder="Masukkan Kata">
                </div>
            </div>
            <div style="overflow-x: auto; max-width: auto;" class="border table-responsive fixed-header-50vh">
                <table class="table border table-responsive-tablet data-table">
                    <thead>
                        <tr>
                            <th scope="col" class="py-4"></th>
                            <th scope="col" class="py-4">Kode Periksa <span class="text-danger">*</span></th>
                            <th scope="col" class="py-4">Nama Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody id="data-pemeriksaan">
                        @if(!empty($pemeriksaan_list1))
                            @foreach($pemeriksaan_list1 as $key => $item)
                            <?php 
                                $kode = $item->kd_jenis_prw; 
                            ?>
                            <tr>
                                <td class="py-3 px-3 text-center">
                                    <input type="checkbox" class="form-check-input checkboxes hover-pointer pil_p1" name="periksa[]" value="{{ $kode }}" style="border-radius: 0px;">
                                </td>
                                <td class="py-3 px-0">{{ $kode }}</td>
                                <td class="py-3" style="width: 75%">{{ $item->nm_perawatan }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <input type="hidden" id="periksa_tmp" value="{{ !empty(Request::get('pdt')) ? Request::get('pdt') : '' }}"  >
        <div class="row justify-content-start align-items-end my-5" id='bagan-save'>
            <div class="col-lg-2  mb-3">
                <div class="d-grid gap-2">
                    @if(empty($allow_btn_save))
                        <button class="btn btn-primary" id='btn_submit' type="submit">Simpan</button>
                    @endif
                </div>
            </div>
        </div>
    </div>


</form>