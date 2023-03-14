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
            <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
            <textarea readonly class="form-control" id="rpo" name="rpo" rows="3">{{!empty($penilaian->rpo) ? $penilaian->rpo : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea readonly class="form-control" id="rpd" name="rpd" rows="3">{{!empty($penilaian->rpd) ? $penilaian->rpd : ''}}</textarea>
        </div>
        <div class="col-6 mb-2 ">
            <label for="alergi" class="form-label">Riwayat Alergi</label>
            <input readonly type="text" class="form-control" name="alergi" id='alergi' value="{{!empty($penilaian->alergi) ? $penilaian->alergi : ''}}">
        </div>
    </div>
</div>


<hr class="mb-5">

<div>
    <h5 class="text-start">II. PEMERIKSAAN FISIK</h5>
    <div class="row align-items-end">
       
        <div class="col-2 mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input readonly type="text" name="td" id="td" class="form-control" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input readonly type="text" id="tb" name="tb" class="form-control" value="{{!empty($penilaian->tb) ? $penilaian->tb : ''}}">
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
     
        <div class="col-2 mb-2">
            <label for="bb" class="form-label">BB : </label>
            <div class="input-group">
                <input readonly type="text" id="bb" name="bb" class="form-control" value="{{!empty($penilaian->bb) ? $penilaian->bb : ''}}">
                <span class="input-group-text" id="ModalPetugas">Kg</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input readonly type="text" id="suhu" name="suhu" class="form-control" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}">
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input readonly type="text" id="nadi" name="nadi" class="form-control" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="rr" class="form-label">RR : </label>
            <div class="input-group">
                <input readonly type="text" id="rr" name="rr" class="form-control" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-6 mb-2 ">
            <label for="nyeri" class="form-label">Nyeri</label>
            <input readonly type="text" class="form-control" name="nyeri" id='nyeri' value="{{!empty($penilaian->nyeri) ? $penilaian->nyeri : ''}}">
        </div>
        <div class="col-6 mb-2 ">
            <label for="status_nutrisi" class="form-label">Status Nutrisi</label>
            <input readonly type="text" class="form-control" name="status_nutrisi" id='status_nutrisi' value="{{!empty($penilaian->status_nutrisi) ? $penilaian->status_nutrisi : ''}}">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="kondisi" class="form-label">Kondisi Umum</label>
            <textarea readonly class="form-control" id="kondisi" name="kondisi" rows="5">{{!empty($penilaian->kondisi) ? $penilaian->kondisi : ''}}</textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">III. STATUS LOKALIS</h5>
    <div class="d-flex justify-content-center mb-4">
        <img src="{{asset('icon/tht.png')}}" width="700" alt="">
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
        <div class="col-6">
            <label for="lab" class="form-label">Laboratorium</label>
            <textarea readonly class="form-control" id="lab" name="lab" rows="3">{{!empty($penilaian->lab) ? $penilaian->lab : ''}}</textarea>
        </div>
         <div class="col-6">
            <label for="rad" class="form-label">Radiologi</label>
            <textarea readonly class="form-control" id="rad" name="rad" rows="3">{{!empty($penilaian->rad) ? $penilaian->rad : ''}}</textarea>
        </div>
        <div class="col-6">
            <label for="tes_pendengaran" class="form-label">Tes Pendengaran</label>
            <textarea readonly class="form-control" id="tes_pendengaran" name="tes_pendengaran" rows="3">{{!empty($penilaian->tes_pendengaran) ? $penilaian->tes_pendengaran : ''}}</textarea>
        </div>
       
        <div class="col-6">
            <label for="penunjang" class="form-label">Penunjang lainnya</label>
            <textarea readonly class="form-control" id="penunjang" name="penunjang" rows="3">{{!empty($penilaian->penunjang) ? $penilaian->penunjang : ''}}</textarea>
        </div>
        
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. DIAGNOSIS/ASESMEN</h5>
    <div class="row mb-2">
        <div class="col">
            <label for="diagnosis" class="form-label">Asesmen Kerja</label>
            <textarea readonly class="form-control" id="diagnosis" name="diagnosis" rows="3">{{!empty($penilaian->diagnosis) ? $penilaian->diagnosis : ''}}</textarea>
        </div>
         <div class="col">
            <label for="diagnosisbanding" class="form-label">Asesmen Banding</label>
            <textarea readonly class="form-control" id="diagnosisbanding" name="diagnosisbanding" rows="3">{{!empty($penilaian->diagnosisbanding) ? $penilaian->diagnosisbanding : ''}}</textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VI. PERMASALAHAN & TATALAKSANA</h5>
    <div class="row mb-2">
        <div class="col-6">
            <label for="permasalahan" class="form-label">Permasalahan</label>
            <textarea readonly class="form-control" id="permasalahan" name="permasalahan" rows="3">{{!empty($penilaian->permasalahan) ? $penilaian->permasalahan : ''}}</textarea>
        </div>
         <div class="col-6">
            <label for="terapi" class="form-label">Terapi/Pengobatan</label>
            <textarea readonly class="form-control" id="terapi" name="terapi" rows="3">{{!empty($penilaian->terapi) ? $penilaian->terapi : ''}}</textarea>
        </div>
        <div class="col-6">
            <label for="tindakan" class="form-label">Tindakan/Rencana Pengobatan</label>
            <textarea readonly class="form-control" id="tindakan" name="tindakan" rows="3">{{!empty($penilaian->tindakan) ? $penilaian->tindakan : ''}}</textarea>
        </div>
       
        <div class="col-6">
            <label for="tatalaksana" class="form-label">Tatalaksana lainnya</label>
            <textarea readonly class="form-control" id="tatalaksana" name="tatalaksana" rows="3">{{!empty($penilaian->tatalaksana) ? $penilaian->tatalaksana : ''}}</textarea>
        </div>
        
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VII. EDUKASI</h5>
    <div class="row mb-2">
        <div class="col">
            <textarea readonly class="form-control" id="edukasi" name="edukasi" rows="3">{{!empty($penilaian->edukasi) ? $penilaian->edukasi : ''}}</textarea>
        </div>
    </div>
</div>