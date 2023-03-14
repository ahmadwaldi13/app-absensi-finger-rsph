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
    <h5 class="text-start">II. PEMERIKSAAN FISIK</h5>
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-7 mb-2 ">
                    <label for="status" class="form-label">Status Nutrisi</label>
                    <input readonly type="text" class="form-control" name="status" id='status'
                        value="{{ !empty($penilaian->status) ? $penilaian->status : '' }}">
                </div>
                <div class="col-5 mb-2">
                    <label for="td" class="form-label">TD : </label>
                    <div class="input-group">
                        <input readonly type="text" name="td" id="td" class="form-control"
                            value="{{ !empty($penilaian->td) ? $penilaian->td : '' }}">
                        <span class="input-group-text" id="ModalPetugas">mmHg</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-2">
                    <label for="nadi" class="form-label">Nadi : </label>
                    <div class="input-group">
                        <input readonly type="text" id="nadi" name="nadi" class="form-control"
                            value="{{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }}">
                        <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <label for="suhu" class="form-label">Suhu : </label>
                    <div class="input-group">
                        <input readonly type="text" id="suhu" name="suhu" class="form-control"
                            value="{{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }}">
                        <span class="input-group-text" id="ModalPetugas">&#8451;</span>
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <label for="rr" class="form-label">RR : </label>
                    <div class="input-group">
                        <input readonly type="text" id="rr" name="rr" class="form-control"
                            value="{{ !empty($penilaian->rr) ? $penilaian->rr : '' }}">
                        <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3 mb-2">
                    <label for="bb" class="form-label">BB : </label>
                    <div class="input-group">
                        <input readonly type="text" id="bb" name="bb" class="form-control"
                            value="{{ !empty($penilaian->bb) ? $penilaian->bb : '' }}">
                        <span class="input-group-text" id="ModalPetugas">Kg</span>
                    </div>
                </div>
                <div class="col-6 mb-2 ">
                    <label for="nyeri" class="form-label">Nyeri</label>
                    <input readonly type="text" class="form-control" name="nyeri" id='nyeri'
                        value="{{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}">
                </div>
                <div class="col-3 mb-2">
                    <label for="gcs" class="form-label">GCS(E, V, M) : </label>
                    <div class="input-group">
                        <input readonly type="text" id="gcs" name="gcs" class="form-control"
                            value="{{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <label for="rpd" class="form-label">Kondisi Umum</label>
            <textarea readonly class="form-control w-100 h-75" id="rpd" name="rpd" rows="3">{{ !empty($penilaian->status) ? $penilaian->status : '' }}</textarea>
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">III. STATUS KELAINAN</h5>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <label for="kepala" class="form-label">Kepala :</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control w-25" name="kepala" id='kepala'
                        value="{{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}">
                    <input readonly type="text" class="form-control w-75" name="keterangan_kepala"
                        id='keterangan_kepala'
                        value="{{ !empty($penilaian->keterangan_kepala) ? $penilaian->keterangan_kepala : '' }}">
                </div>
            </div>
            <div class="row">
                <label for="thoraks" class="form-label">Thoraks :</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control w-25" name="thoraks" id='thoraks'
                        value="{{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}">
                    <input readonly type="text" class="form-control w-75" name="keterangan_thorak"
                        id='keterangan_thorak'
                        value="{{ !empty($penilaian->keterangan_thorak) ? $penilaian->keterangan_thorak : '' }}">
                </div>
            </div>
            <div class="row">
                <label for="abdomen" class="form-label">Abdomen :</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control w-25" name="abdomen" id='abdomen'
                        value="{{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}">
                    <input readonly type="text" class="form-control w-75" name="keterangan_abdomen"
                        id='keterangan_abdomen'
                        value="{{ !empty($penilaian->keterangan_abdomen) ? $penilaian->keterangan_abdomen : '' }}">
                </div>
            </div>
            <div class="row">
                <label for="ekstremitas" class="form-label">Ekstremitas:</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control w-25" name="ekstremitas" id='ekstremitas'
                        value="{{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}">
                    <input readonly type="text" class="form-control w-75" name="keterangan_ekstremitas"
                        id='keterangan_ekstremitas'
                        value="{{ !empty($penilaian->keterangan_ekstremitas) ? $penilaian->keterangan_ekstremitas : '' }}">
                </div>
            </div>
        </div>
        <div class="col-6 ">
            <h5 class="text-center">Kondisi Umum</h5>
                    <textarea readonly class="form-control w-100 h-75" id="lainnya" name="lainnya" rows="5">{{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}</textarea>
        </div>
    </div>
</div>

</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">IV. PEMERIKSAAN PENUNJANGAN</h5>
    <div class="row mb-2">
        <div class="col-4">
            <label for="lab" class="form-label">Laboratorium</label>
            <textarea readonly class="form-control" id="lab" name="lab" rows="3">{{ !empty($penilaian->lab) ? $penilaian->lab : '' }}</textarea>
        </div>
        <div class="col-4">
            <label for="rad" class="form-label">Radiologi</label>
            <textarea readonly class="form-control" id="rad" name="rad" rows="3">{{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</textarea>
        </div>
        <div class="col-4">
            <label for="penunjanglain" class="form-label">Penunjang lainnya</label>
            <textarea readonly class="form-control" id="penunjanglain" name="penunjanglain" rows="3">{{ !empty($penilaian->penunjanglain) ? $penilaian->penunjanglain : '' }}</textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. DIAGNOSIS/ASESMEN</h5>
    <div class="row mb-2">
        <div class="col">
            <label for="diagnosis" class="form-label">Asesmen Kerja</label>
            <textarea readonly class="form-control" id="diagnosis" name="diagnosis" rows="3">{{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</textarea>
        </div>
        <div class="col">
            <label for="diagnosis2" class="form-label">Asesmen Banding</label>
            <textarea readonly class="form-control" id="diagnosis2" name="diagnosis2" rows="3">{{ !empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : '' }}</textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VI. PERMASALAHAN & TATALAKSANA</h5>
    <div class="row mb-2">
        <div class="col-6">
            <label for="permasalahan" class="form-label">Permasalahan</label>
            <textarea readonly class="form-control" id="permasalahan" name="permasalahan" rows="3">{{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</textarea>
        </div>
        <div class="col-6">
            <label for="terapi" class="form-label">Terapi/Pengobatan</label>
            <textarea readonly class="form-control" id="terapi" name="terapi" rows="3">{{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</textarea>
        </div>
        <div class="col-12">
            <label for="tindakan" class="form-label">Tindakan/Rencana Pengobatan</label>
            <textarea readonly class="form-control" id="tindakan" name="tindakan" rows="3">{{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VII. EDUKASI</h5>
    <div class="row mb-2">
        <div class="col">
            <textarea readonly class="form-control" id="edukasi" name="edukasi" rows="3">{{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</textarea>
        </div>
    </div>
</div>
</div>
