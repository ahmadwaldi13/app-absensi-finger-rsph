
<div>
    {{-- <input type="text" value="{{ !empty($model->fr) ? $model->fr : $item_pasien->no_fr }}" hidden name="fr">
    <input type="text" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }}" hidden name="no_rm"> --}}

    <input type="text" value="{{ !empty($model->id_soap_farmasi) ? $model->id_soap_farmasi : '' }}" hidden name="id_soap_farmasi">
    <div class="row justify-content-start align-items-end">
        <div class="col-lg-2 mb-3">
            <label for="norawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="norawat" readonly required name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : $model->no_rawat }}">
        </div>
        <div class="col-lg-4 mb-3">
            <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($model->no_rm) ? $model->no_rm : $model->no_rm_medis }} {{ $model->nm_pasien }}">
        </div>
        <div class="col-lg-2 mb-3">
            <label for="kodeDokter" class="form-label">Dilakukan</label>
            <input type="text" aria-label=" input kodeDokter" readonly  class="form-control readonly" id="nik" name="nik" value="{{$model->nik}}">
        </div>
        <div class="col-lg-4 mb-3">
            <div class="button-icon-inside d-flex justify-content-between pe-4">
                {{-- <div class="col-10"> --}}
                    <input type="text" readonly class="input-text" id="namaPetugas" value="{{$model->nama}}"/>
                {{-- </div> --}}
                {{-- <span  class="modal-remote-data col-2 text-end" data-modal-src="{{ url('ajax?action=get_list_pegawai') }}" data-modal-key="{{ $model->fr.'@'.$model->no_rawat }}" data-modal-pencarian='true' data-modal-title='daftar petugas' data-modal-action-change="function=.set-data-list-from-modal@data-target=#nik|#namaPetugas@data-btn-close=#closeModalData">
                    <img src="{{ asset('') }}icon/selected.png" class="hover-pointer" alt="">
                </span> --}}
            </div>
        </div>
    </div>


    <hr class="mb-4"> 

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-6 mb-3">
            <textarea class="form-control readonly" id="subjek" readonly name="subjek" rows="3"  required>{{ !empty($model->subjek) ? $model->subjek : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <textarea class="form-control readonly" id="objek" readonly name="objek" rows="3" required>{{ !empty($model->objek) ? $model->objek : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="asesmen" class="form-label">Assessment : <span class="text-danger">*</span></label>
            <textarea class="form-control readonly" id="assessment" readonly rows="3" required name="assessment">{{ !empty($model->assessment) ? $model->assessment : '' }}</textarea>
        </div>
        
        <div class="col-lg-6 mb-3">
            <label for="plan" class="form-label">Plan :</label>
            <textarea class="form-control readonly" id="plan" readonly rows="3" name="plan">{{ !empty($model->plan) ? $model->plan : '' }}</textarea>
        </div>
    </div>

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-2 mb-3">
            <div class="d-grid gap-2">
                <button class="btn btn-danger" data-bs-dismiss="modal" type="button">Tutup</button>
            </div>
        </div>

        <div class="col-lg-2 mb-3">
            <div class="d-grid gap-2">
                <?php 
                    $kode = $type_akses . '@' . $model->no_rawat . '@' . date('Y-m-d',strtotime($model->created_at)) . '@' . date('H:i:s',strtotime($model->created_at)) . '@' . $model->no_rkm_medis . '@' . $model->id_soap_farmasi;
                    $link_param = [
                        'no_rawat' => (!empty($model->no_rawat) ? $model->no_rawat : ''),
                        'no_rm' => (!empty($model->no_rkm_medis) ? $model->no_rkm_medis : ''),
                        'fr' => $type_akses,
                        'cdata'=>$kode
                    ];

                    $url_target=(new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('soap-farmasi'));
                
                ?>
                <a href="{{ $url_target }}" class="btn btn-primary">Salin Data</a>
            </div>
        </div>
    </div>
    
</div>
