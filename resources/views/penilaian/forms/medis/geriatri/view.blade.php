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
            <textarea readonly class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{!empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : ''}}</textarea readonly>
        </div>
        <div class="col-6 mb-2">
            <label for="rps" class="form-label">Riwayat Penyakit Sekarang</label>
            <textarea readonly class="form-control" id="rps" name="rps" rows="3">{{!empty($penilaian->rps) ? $penilaian->rps : ''}}</textarea readonly>
        </div>
        <div class="col-6 mb-2">
            <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
            <textarea readonly class="form-control" id="rpo" name="rpo" rows="3">{{!empty($penilaian->rpo) ? $penilaian->rpo : ''}}</textarea readonly>
        </div>
        <div class="col-6 mb-2">
            <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea readonly class="form-control" id="rpd" name="rpd" rows="3">{{!empty($penilaian->rpd) ? $penilaian->rpd : ''}}</textarea readonly>
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
        <div class="col-6">
            <div class="row">
                <div class="col-4 mb-2">
                    <label for="td" class="form-label">TD : </label>
                    <div class="input readonly-group">
                        <input readonly type="text" name="td" id="td" class="form-control" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}">
                        <span class="input readonly-group-text" id="ModalPetugas">mmHg</span>
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <label for="nadi" class="form-label">Nadi : </label>
                    <div class="input readonly-group">
                        <input readonly type="text" id="nadi" name="nadi" class="form-control" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}">
                        <span class="input readonly-group-text" id="ModalPetugas">x / Menit</span>
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <label for="suhu" class="form-label">Suhu : </label>
                    <div class="input readonly-group">
                        <input readonly type="text" id="suhu" name="suhu" class="form-control" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}">
                        <span class="input readonly-group-text" id="ModalPetugas">&#8451;</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-2">
                    <label for="rr" class="form-label">RR : </label>
                    <div class="input readonly-group">
                        <input readonly type="text" id="rr" name="rr" class="form-control" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}">
                        <span class="input readonly-group-text" id="ModalPetugas">x / Menit</span>
                    </div>
                </div>
                <div class="col-8">
                    <label for="tulang_belakang" class="form-label">Postur Tulang Belakang :</label>
                    <input readonly type="text" id="rr" name="rr" class="form-control" value="{{!empty($penilaian->tulang_belakang) ? $penilaian->tulang_belakang : ''}}">
                </div>
            </div>
        </div>

        <div class="col-6">
            <label for="kondisi_umum" class="form-label">Kondisi Umum</label>
            <textarea readonly class="form-control w-100 h-75" id="kondisi_umum" name="kondisi_umum" rows="5">{{!empty($penilaian->kondisi_umum) ? $penilaian->kondisi_umum : ''}}</textarea readonly>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">III. STATUS KELAINAN</h5>
    <div class="row align-items-end ">
        <div class="col-6">
            <div class="row mb-2">
                <label for="kepala" class="form-label">Kepala :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="anamnesis" name="anamnesis" class="form-control w-25"
            value="{{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}">
                    <input readonly type="text" class="form-control w-75" name="keterangan_kepala"
                        id='keterangan_kepala' value="{{!empty($penilaian->keterangan_kepala) ? $penilaian->keterangan_kepala : ''}}">
                    </div>
            </div>
            <div class="row mb-2">
                <label for="thoraks" class="form-label">Thoraks :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="thoraks" name="thoraks" class="form-control w-25"
                    value="{{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}">
                    <input readonly type="text" class="form-control w-75" name="keterangan_thoraks"
                        id='keterangan_thoraks' value="{{!empty($penilaian->keterangan_thoraks) ? $penilaian->keterangan_thoraks : ''}}">
                </div>
            </div>
            <div class="row mb-2">
                <label for="abdomen" class="form-label">Abdomen :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="abdomen" name="abdomen" class="form-control w-25"
            value="{{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}">
                    <input readonly type="text" class="form-control w-75" name="keterangan_abdomen"
                        id='keterangan_abdomen' value="{{!empty($penilaian->keterangan_abdomen) ? $penilaian->keterangan_abdomen : ''}}">
                </div>
            </div>
            <div class="row mb-2">
                <label for="ekstremitas" class="form-label">Ekstremitas:</label>
                <div class="d-flex">
                    <input  readonly type="text" id="ekstremitas" name="ekstremitas" class="form-control w-25"
            value="{{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}">
                    <input readonly type="text" class="form-control w-75" name="keterangan_ekstremitas"
                        id='keterangan_ekstremitas' value="{{!empty($penilaian->keterangan_ekstremitas) ? $penilaian->keterangan_ekstremitas : ''}}">
                </div>
            </div>
            <div class="col mb-2">
                <label for="lainnya" class="form-label">Lainnya :</label>
                <textarea readonly class="form-control" id="lainnya" name="lainnya" rows="3">{{!empty($penilaian->lainnya) ? $penilaian->lainnya : ''}}</textarea readonly>
            </div>
        </div>
        <div class="col-6 ">
            <h5 class="text-center">Integument</h5>
            <div class="row mb-2">
                <label for="Integument_kebersihan" class="form-label">Kebersihan :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="Integument_kebersihan" name="Integument_kebersihan" class="form-control"
            value="{{ !empty($penilaian->Integument_kebersihan) ? $penilaian->Integument_kebersihan : '' }}">
                </div>
            </div>
            <div class="row mb-2">
                <label for="Integument_warna" class="form-label">Warna :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="Integument_warna" name="Integument_warna" class="form-control"
            value="{{ !empty($penilaian->Integument_warna) ? $penilaian->Integument_warna : '' }}">
                </div>
            </div>
            <div class="row mb-2">
                <label for="Integument_kelembaban" class="form-label">Kelembaban :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="Integument_kelembaban" name="Integument_kelembaban" class="form-control"
            value="{{ !empty($penilaian->Integument_kelembaban) ? $penilaian->Integument_kelembaban : '' }}">
                </div>
            </div>
            <div class="row mb-2">
                <label for="Integument_gangguan_kulit" class="form-label">Gangguan Kulit :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="Integument_gangguan_kulit" name="Integument_gangguan_kulit" class="form-control"
            value="{{ !empty($penilaian->Integument_gangguan_kulit) ? $penilaian->Integument_gangguan_kulit : '' }}">
                </div>
            </div>
            <div class="col mb-2">
                <label for="kondisi_sosial" class="form-label">Kondisi Sosial :</label>
                <textarea readonly class="form-control" id="kondisi_sosial" name="kondisi_sosial" rows="3">{{!empty($penilaian->kondisi_sosial) ? $penilaian->kondisi_sosial : ''}}</textarea readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="row mb-2">
                <label for="status_psikologis_gds" class="form-label">Psikologis (GDS) :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="status_psikologis_gds" name="status_psikologis_gds" class="form-control"
                    value="{{ !empty($penilaian->status_psikologis_gds) ? $penilaian->status_psikologis_gds : '' }}">
                </div>
            </div>
            <div class="row mb-2">
                <label for="status_kognitif_mmse" class="form-label">Kognitif (MMSE) :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="status_kognitif_mmse" name="status_kognitif_mmse" class="form-control"
                    value="{{ !empty($penilaian->status_kognitif_mmse) ? $penilaian->status_kognitif_mmse : '' }}">
                </div>
            </div>
            <div class="row mb-2">
                <label for="status_nutrisi" class="form-label">Nutrisi (MNA) :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="status_nutrisi" name="status_nutrisi" class="form-control"
                    value="{{ !empty($penilaian->status_nutrisi) ? $penilaian->status_nutrisi : '' }}">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row mb-2">
                <label for="skrining_jatuh" class="form-label">Skrinning Risiko Jatuh (OMS) :</label>
                <div class="d-flex">
                    <input  readonly type="text" id="skrining_jatuh" name="skrining_jatuh" class="form-control"
            value="{{ !empty($penilaian->skrining_jatuh) ? $penilaian->skrining_jatuh : '' }}">
                </div>
                <div class="row mb-2">
                    <label for="status_fungsional" class="form-label">Status Fungsional (ADL:BARTHEL INDEX)
                        :</label>
                    <div class="d-flex">
                        <input  readonly type="text" id="anamnesis" name="anamnesis" class="form-control"
                        value="{{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">IV. PEMERIKSAAN PENUNJANG</h5>
    <div class="row mb-2">
        <div class="col">
            <label for="lab" class="form-label">Laboratorium :</label>
            <textarea readonly class="form-control" id="lab" name="lab" rows="3">{{!empty($penilaian->lab) ? $penilaian->lab : ''}}</textarea readonly>
        </div>
        <div class="col">
            <label for="rad" class="form-label">Radiologi :</label>
            <textarea readonly class="form-control" id="rad" name="rad" rows="3">{{!empty($penilaian->rad) ? $penilaian->rad : ''}}</textarea readonly>
        </div>
        <div class="col">
            <label for="pemeriksaan" class="form-label">Penunjang Lainya :</label>
            <textarea readonly class="form-control" id="pemeriksaan" name="pemeriksaan" rows="3">{{!empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : ''}}</textarea readonly>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. DIAGNOSIS/ASESMEN</h5>
    <div class="row mb-2">
        <div class="col">
            <label for="diagnosis" class="form-label">Asesmen Kerja :</label>
            <textarea readonly class="form-control" id="diagnosis" name="diagnosis" rows="3">{{!empty($penilaian->diagnosis) ? $penilaian->diagnosis : ''}}</textarea readonly>
        </div>
        <div class="col">
            <label for="diagnosis2" class="form-label">Asesmen Banding :</label>
            <textarea readonly class="form-control" id="diagnosis2" name="diagnosis2" rows="3">{{!empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : ''}}</textarea readonly>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VI. PERMASALAHAN & TATALAKSANA</h5>
    <div class="row mb-2">
        <div class="col-6">
            <label for="permasalahan" class="form-label">Permasalahan :</label>
            <textarea readonly class="form-control" id="permasalahan" name="permasalahan" rows="3">{{!empty($penilaian->permasalahan) ? $penilaian->permasalahan : ''}}</textarea readonly>
        </div>
        <div class="col-6">
            <label for="terapi" class="form-label">Terapi/Pengobatan :</label>
            <textarea readonly class="form-control" id="terapi" name="terapi" rows="3">{{!empty($penilaian->terapi) ? $penilaian->terapi : ''}}</textarea readonly>
        </div>
        <div class="col-12">
            <label for="tindakan" class="form-label">Tindakan/Rencana Pengobatan :</label>
            <textarea readonly class="form-control" id="tindakan" name="tindakan" rows="3">{{!empty($penilaian->tindakan) ? $penilaian->tindakan : ''}}</textarea readonly>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VII. EDUKASI</h5>
    <div class="row mb-2">
        <div class="col">
            <textarea readonly class="form-control" id="edukasi" name="edukasi" rows="3">{{!empty($penilaian->edukasi) ? $penilaian->edukasi : ''}}</textarea readonly>
        </div>
    </div>
</div>
