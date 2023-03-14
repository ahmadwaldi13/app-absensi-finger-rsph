<div class="row mb-3">
    @include('penilaian.form_header', [
        "pj_form_type"=>"dokter", 
        "nama_pj" => $penilaian->nm_dokter,
        "kode_pj" => $penilaian->kd_dokter, 
        "readonly" => true
    ])
    <div class="col mb-2">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input readonly type="text" class="form-control input-daterange input-date-time" name="tanggal" id="tanggal" value="{{!empty($penilaian->tanggal) ? $penilaian->tanggal : ''}}"  required autocomplete="off" >
    </div>
    <div class="col mb-2">
        <label for="informasi" class="form-label">Informasi didapat dari : </label>
        <input readonly type="text" id="anamnesis" name="anamnesis" class="form-control" value="{{!empty($penilaian->anamnesis) ? $penilaian->anamnesis : ''}}">
    </div>
</div>


<hr class="mb-5">

<div>
    <h5 class="text-start">I. RIWAYAT KESEHATAN</h5>
    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="keluhan_utama" class="form-label">Keluhan Utama</label>
            <textarea readonly class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{!empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rps" class="form-label">Riwayat Penyakit Sekarang</label>
            <textarea readonly class="form-control" id="rps" name="rps" rows="3">{{!empty($penilaian->rps) ? $penilaian->rps : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpk" class="form-label">Riwayat Penyakit Keluarga</label>
            <textarea readonly class="form-control" id="rpk" name="rpk" rows="3">{{!empty($penilaian->rpk) ? $penilaian->rpk : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea readonly class="form-control" id="rpd" name="rpd" rows="3">{{!empty($penilaian->rpd) ? $penilaian->rpd : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
            <textarea readonly class="form-control" id="rpo" name="rpo" rows="3">{{!empty($penilaian->rpo) ? $penilaian->rpo : ''}}</textarea>
        </div>
        <div class="col-6 mb-2 ">
            <label for="alergi" class="form-label">Riwayat Alergi</label>
            <input readonly type="text" class="form-control" name="alergi" value="{{!empty($penilaian->alergi) ? $penilaian->alergi : ''}}"  id='alergi' value="">
        </div>
    </div>
</div>


<hr class="mb-5">

<div>
    <h5 class="text-start">II. PEMERIKSAAN FISIK</h5>
    <div class="row align-items-end">
        <div class="col-3 mb-2">
            <label for="keadaan" class="form-label">Keadaan Umum : </label>
            <input type="text" class="form-control" readonly value="{{!empty($penilaian->keadaan) ? $penilaian->keadaan : ''}}">
            
        </div>
        <div class="col-3 mb-2">
            <label for="kesadaran" class="form-label">Kesadaran : </label>
            <input type="text" class="form-control" readonly value="{{!empty($penilaian->kesadaran) ? $penilaian->kesadaran : ''}}">
            
        </div>
        <div class="col-3 mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input readonly type="text" name="td" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}"  id="td" class="form-control">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input readonly type="text" id="nadi" name="nadi" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="rr" class="form-label">RR : </label>
            <div class="input-group">
                <input readonly type="text" id="rr" name="rr" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input readonly type="text" id="suhu" name="suhu" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>

        <div class="col-3 mb-2">
            <label for="gcs" class="form-label">GCS(E, V, M) : </label>
            <div class="input-group">
                <input readonly type="text" id="gcs" name="gcs" value="{{!empty($penilaian->gcs) ? $penilaian->gcs : ''}}"  class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="bb" class="form-label">BB : </label>
            <div class="input-group">
                <input readonly type="text" id="bb" name="bb" value="{{!empty($penilaian->bb) ? $penilaian->bb : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">Kg</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input readonly type="text" id="tb" name="tb" value="{{!empty($penilaian->tb) ? $penilaian->tb : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="spo" class="form-label">SpO2 : </label>
            <div class="input-group">
                <input readonly type="text" id="spo" name="spo" value="{{!empty($penilaian->spo) ? $penilaian->spo : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">%</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 row">
            <div class="col-6 mb-2">
                <label for="kepala" class="form-label">Kepala : </label>
                <input type="text" class="form-control" readonly value="{{!empty($penilaian->kepala) ? $penilaian->kepala : ''}}">
                
            </div>
            <div class="col-6 mb-2">
                <label for="abdomen" class="form-label">Abdomen : </label>
                <input type="text" class="form-control" readonly value="{{!empty($penilaian->abdomen) ? $penilaian->abdomen : ''}}">
                
            </div>
            <div class="col-6 mb-2">
                <label for="gigi" class="form-label">Gigi & Mulut : </label>
                <input type="text" class="form-control" readonly value="{{!empty($penilaian->gigi) ? $penilaian->gigi : ''}}">
                
            </div>
            <div class="col-6 mb-2">
                <label for="genital" class="form-label">Genital & Anus : </label>
                <input type="text" class="form-control" readonly value="{{!empty($penilaian->genital) ? $penilaian->genital : ''}}">
                
            </div>
            <div class="col-6 mb-2">
                <label for="mata" class="form-label">Mata: </label>
                <input type="text" class="form-control" readonly value="{{!empty($penilaian->mata) ? $penilaian->mata : ''}}">
                
            </div>
            <div class="col-6 mb-2">
                <label for="ekstremitas" class="form-label">Ekstremitas: </label>
                <input type="text" class="form-control" readonly value="{{!empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : ''}}">
                
            </div>
            <div class="col-6 mb-2">
                <label for="thoraks" class="form-label">Thoraks : </label>
                <input type="text" class="form-control" readonly value="{{!empty($penilaian->thoraks) ? $penilaian->thoraks : ''}}">
                
            </div>
            <div class="col-6 mb-2">
                <label for="leher" class="form-label">Leher : </label>
                <input type="text" class="form-control" readonly value="{{!empty($penilaian->leher) ? $penilaian->leher : ''}}">
                
            </div>
        </div>
        <div class="col-6">
            <label for="ket_fisik" class="form-label">Keterangan</label>
            <textarea readonly class="form-control" id="ket_fisik" name="ket_fisik" rows="5">{{!empty($penilaian->ket_fisik) ? $penilaian->ket_fisik : ''}}</textarea>
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">III. STATUS LOKALIS</h5>
    <div class="d-flex justify-content-center mb-5">
        <img src="{{asset('icon/semua.png')}}" width="600" alt="">
    </div>
    <div class="row mb-2">
        <label for="ket_lokalis" class="form-label">Keterangan</label>
        <textarea readonly class="form-control" id="ket_lokalis" name="ket_lokalis" rows="3">{{!empty($penilaian->ket_lokalis) ? $penilaian->ket_lokalis : ''}}</textarea>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">IV. PEMERIKSAAN PENUNJANGAN</h5>
    <div class="row mb-2">
        <div class="col">
            <label for="ekg" class="form-label">EKG : </label>
            <textarea readonly class="form-control" id="ekg" name="ekg" rows="3">{{!empty($penilaian->ekg) ? $penilaian->ekg : ''}}</textarea>
        </div>
        <div class="col">
            <label for="rad" class="form-label">Radiologi</label>
            <textarea readonly class="form-control" id="rad" name="rad" rows="3">{{!empty($penilaian->rad) ? $penilaian->rad : ''}}</textarea>
        </div>
        <div class="col">
            <label for="lab" class="form-label">Laborat</label>
            <textarea readonly class="form-control" id="lab" name="lab" rows="3">{{!empty($penilaian->lab) ? $penilaian->lab : ''}}</textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. DIAGNOSIS ASSESMEN</h5>

    <div class="row mb-2">
        <label for="diagnosis" class="form-label">Keterangan</label>
        <textarea readonly class="form-control" id="diagnosis" name="diagnosis" rows="3">{{!empty($penilaian->diagnosis) ? $penilaian->diagnosis : ''}}</textarea>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VI. TATALAKSANA</h5>

    <div class="row mb-2">
        <label for="tata" class="form-label">Keterangan</label>
        <textarea readonly class="form-control" id="tata" name="tata" rows="3">{{!empty($penilaian->tata) ? $penilaian->tata : ''}}</textarea>
    </div>
</div>
