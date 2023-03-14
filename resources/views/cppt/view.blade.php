
<div>
    <div class="row justify-content-start align-items-end">
        <div class="col-lg-2 mb-3">
            <label for="norawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control readonly" readonly id="norawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
        </div>
        <div class="col-lg-4 mb-3">
            <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($model->no_rkm_medis) ? $model->no_rkm_medis : '' }} {{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="daterangereview" class="form-label">Tanggal :</label>
            <input type="text" class="form-control readonly input-daterange" readonly value="{{ !empty($model->tgl_perawatan) ? $model->tgl_perawatan : '' }} - {{ !empty($model->jam_rawat) ? $model->jam_rawat : '' }}">
        </div>
    </div>
    <hr class="mb-5">
    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-2 mb-3">
            <label for="dilakukan" class="form-label">Dilakukan</label>
            <input type="text" class="form-control readonly" readonly id="dilakukan" value="{{ !empty($model->nip) ? $model->nip : '' }}">
        </div>
        <div class="col-lg-4 mb-3">
            <input type="text" class="form-control readonly" readonly id="namaDilakukan" value="{{ !empty($model->nama) ? $model->nama : '' }}">
        </div>
        <div class="col mb-3">
            <label for="profesi" class="form-label">Profesi / Jabatan / Departemen :</label>
            <input type="text" class="form-control readonly" readonly id="profesi" value="{{ !empty($data_dilakukan->jabatan) ? $data_dilakukan->jabatan : '' }}">
        </div>
    </div>
    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-2 mb-3">
            <label for="gcs" class="form-label">GCS (E,V,M)</label>
            <input type="text" class="form-control readonly" readonly id="gcs" value="{{ !empty($model->gcs) ? $model->gcs : '' }}">
        </div>
        <div class="col-lg-2 mb-3">
            <label for="kesadaran" class="form-label">Kesadaran</label>
            <select class="form-select input-dropdown" disabled aria-label="Default select example" id="kesadaran">
                <option value="" selected>{{ !empty($model->kesadaran) ? $model->kesadaran : '' }}</option>
            </select>
        </div>
        <div class="col mb-3">
            <label for="alergi" class="form-label">Alergi :</label>
            <input type="text" class="form-control readonly" readonly id="alergi" value="{{ !empty($model->alergi) ? $model->alergi : '' }}">
        </div>
        @if($type_akses!='ri')
            <div class="col mb-3">
                <label for="lingkar_perut" class="form-label">Lingkar Perut ( Cm ) : </label>
                <input type="text" class="form-control readonly" readonly id="lingkar_perut" name="lingkar_perut" value="{{ !empty($model->lingkar_perut) ? $model->lingkar_perut : ''  }}">
            </div>
        @endif
    </div>
    <div class="row justify-content-start align-items-end table-responsive" id="mulkan" mulkan-for="40">
        <div class="col-lg-6 mb-3">
            <label for="subjek" class="form-label">Subjek :</label>
            <textarea class="form-control readonly" readonly id="subjek" rows="3">{{ !empty($model->keluhan) ? $model->keluhan : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="asesmen" class="form-label">Asesmen :</label>
            <textarea class="form-control readonly" readonly id="asesmen" rows="3">{{ !empty($model->penilaian) ? $model->penilaian : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="objek" class="form-label">Objek :</label>
            <textarea class="form-control readonly" readonly id="objek" rows="3">{{ !empty($model->pemeriksaan) ? $model->pemeriksaan : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="plan" class="form-label">Plan :</label>
            <textarea class="form-control readonly" readonly id="plan" rows="3">{{ !empty($model->rtl) ? $model->rtl : '' }}</textarea>
        </div>
    </div>
    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-3 mb-3">
            <label for="suhu" class="form-label">Suhu (*C)</label>
            <input type="number" class="form-control readonly" readonly id="suhu" step=0.01  value="{{ !empty($model->suhu_tubuh) ? $model->suhu_tubuh : '' }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="tinggiBadan" class="form-label">Tinggi Badan</label>
            <input type="number" class="form-control readonly" readonly id="tinggiBadan" value="{{ !empty($model->tinggi) ? $model->tinggi : '' }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="beratBadan" class="form-label">Berat Badan</label>
            <input type="number" class="form-control readonly" readonly id="beratBadan" value="{{ !empty($model->berat) ? $model->berat : '' }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="tensi" class="form-label">Tensi</label>
            <input type="text" class="form-control readonly" readonly id="tensi" value="{{ !empty($model->tensi) ? $model->tensi : '' }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="resporasi" class="form-label">Resporansi (/menit)</label>
            <input type="number" class="form-control readonly" readonly id="resporasi" value="{{ !empty($model->respirasi) ? $model->respirasi : '' }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="nadi" class="form-label">Nadi (/menit)</label>
            <input type="number" class="form-control readonly" readonly id="nadi" value="{{ !empty($model->nadi) ? $model->nadi : '' }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="spo2" class="form-label">SpO2 (%)</label>
            <input type="number" class="form-control readonly" readonly id="spo2" name="spo2" value="{{ !empty($model->spo2) ? $model->spo2 : ''  }}">
        </div>
    </div>
    
    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-6 mb-3">
            <label for="intruksi" class="form-label">Intruksi :</label>
            <textarea class="form-control readonly" readonly id="intruksi" rows="3">{{ !empty($model->instruksi) ? $model->instruksi : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="evaluasi" class="form-label">Evaluasi :</label>
            <textarea class="form-control readonly" readonly id="evaluasi" name="evaluasi" rows="3">{{ !empty($model->evaluasi) ? $model->evaluasi : '' }}</textarea>
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
                    $kode = $type_akses . '@' . $model->no_rawat . '@' . $model->tgl_perawatan . '@' . $model->jam_rawat . '@' . $model->no_rkm_medis;
                    $link_param = [
                        'no_rawat' => (!empty($model->no_rawat) ? $model->no_rawat : ''),
                        'no_rm' => (!empty($model->no_rkm_medis) ? $model->no_rkm_medis : ''),
                        'fr' => $type_akses,
                        'cdata'=>$kode
                    ];

                    $url_target=(new \App\Http\Traits\GlobalFunction)->generateLink($link_param,url('isi-cppt'));
                
                ?>
    
                <a href="{{ $url_target }}" class="btn btn-primary">Salin Data</a>
            </div>
        </div>
    </div>
    
</div>
