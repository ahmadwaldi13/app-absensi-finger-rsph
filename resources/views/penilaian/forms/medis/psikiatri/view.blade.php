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
            <textarea readonly class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rps" class="form-label">Riwayat Penyakit Sekarang</label>
            <textarea readonly class="form-control" id="rps" name="rps" rows="3">{{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpk" class="form-label">Riwayat Penyakit Keluarga</label>
            <textarea readonly class="form-control" id="rpk" name="rpk" rows="3">{{ !empty($penilaian->rpk) ? $penilaian->rpk : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea readonly class="form-control" id="rpd" name="rpd" rows="3">{{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
            <textarea readonly class="form-control" id="rpo" name="rpo" rows="3">{{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</textarea>
        </div>
        <div class="col-6 mb-2 ">
            <label for="alergi" class="form-label">Riwayat Alergi</label>
            <input readonly type="text" class="form-control" name="alergi" id='alergi'
                value="{{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}">
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">II. STATUS PSIKIATRIK</h5>

    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="penampilan" class="form-label">Penampilan</label>
            <textarea readonly class="form-control" id="penampilan" name="penampilan" rows="3">{{ !empty($penilaian->penampilan) ? $penilaian->penampilan : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="gangguan_persepsi" class="form-label">Ganguan Persepsi</label>
            <textarea readonly class="form-control" id="gangguan_persepsi" name="gangguan_persepsi" rows="3">{{ !empty($penilaian->gangguan_persepsi) ? $penilaian->gangguan_persepsi : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="pembicaraan" class="form-label">Pembicaraan</label>
            <textarea readonly class="form-control" id="pembicaraan" name="pembicaraan" rows="3">{{ !empty($penilaian->pembicaraan) ? $penilaian->pembicaraan : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="proses_pikir" class="form-label">Proses Pikir & Isi Pikir</label>
            <textarea readonly class="form-control" id="proses_pikir" name="proses_pikir" rows="3">{{ !empty($penilaian->proses_pikir) ? $penilaian->proses_pikir : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="psikomotor" class="form-label">Psikomotor</label>
            <textarea readonly class="form-control" id="psikomotor" name="psikomotor" rows="3">{{ !empty($penilaian->psikomotor) ? $penilaian->psikomotor : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="pengendalian_impuls" class="form-label">Pengendalian Implus</label>
            <textarea readonly class="form-control" id="pengendalian_impuls" name="pengendalian_impuls" rows="3">{{ !empty($penilaian->pengendalian_impuls) ? $penilaian->pengendalian_impuls : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="sikap" class="form-label">Sikap</label>
            <textarea readonly class="form-control" id="sikap" name="sikap" rows="3">{{ !empty($penilaian->sikap) ? $penilaian->sikap : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="tilikan" class="form-label">Tilikan</label>
            <textarea readonly class="form-control" id="tilikan" name="tilikan" rows="3">{{ !empty($penilaian->tilikan) ? $penilaian->tilikan : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="mood" class="form-label">Mood/Afek</label>
            <textarea readonly class="form-control" id="mood" name="mood" rows="3">{{ !empty($penilaian->mood) ? $penilaian->mood : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rta" class="form-label">Reality Testing Ability</label>
            <textarea readonly class="form-control" id="rta" name="rta" rows="3">{{ !empty($penilaian->rta) ? $penilaian->rta : '' }}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="fungsi_kognitif" class="form-label">Fungsi Kognitif</label>
            <textarea readonly class="form-control" id="fungsi_kognitif" name="fungsi_kognitif" rows="3">{{ !empty($penilaian->fungsi_kognitif) ? $penilaian->fungsi_kognitif : '' }}</textarea>
        </div>
    </div>
</div>

<hr class="mb-5">

<div>
    <h5 class="text-start">III. PEMERIKSAAN FISIK</h5>
    <div class="row align-items-end">
        <div class="col-3 mb-2">
            <label for="keadaan" class="form-label">Keadaan Umum : </label>
            <input readonly type="text" name="keadaan"
                value="{{ !empty($penilaian->keadaan) ? $penilaian->keadaan : '' }}" id="td"
                class="form-control">
        </div>
        <div class="col-3 mb-2">
            <label for="kesadaran" class="form-label">Kesadaran : </label>
            <input readonly type="text" name="kesadaran"
                value="{{ !empty($penilaian->kesadaran) ? $penilaian->kesadaran : '' }}" id="td"
                class="form-control">
        </div>
        <div class="col-2 mb-2">
            <label for="gcs" class="form-label">GCS(E, V, M) : </label>
            <div class="input-group">
                <input readonly type="text" id="gcs" name="gcs"
                    value="{{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}" class="form-control">
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input readonly type="text" id="tb" name="tb"
                    value="{{ !empty($penilaian->tb) ? $penilaian->tb : '' }}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="bb" class="form-label">BB : </label>
            <div class="input-group">
                <input readonly type="text" id="bb" name="bb"
                    value="{{ !empty($penilaian->bb) ? $penilaian->bb : '' }}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">Kg</span>
            </div>
        </div>

        <div class="col-2 mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input readonly type="text" name="td"
                    value="{{ !empty($penilaian->td) ? $penilaian->td : '' }}" id="td" class="form-control">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input readonly type="text" id="nadi" name="nadi"
                    value="{{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="rr" class="form-label">RR : </label>
            <div class="input-group">
                <input readonly type="text" id="rr" name="rr"
                    value="{{ !empty($penilaian->rr) ? $penilaian->rr : '' }}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input readonly type="text" id="suhu" name="suhu"
                    value="{{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="spo" class="form-label">SpO2 : </label>
            <div class="input-group">
                <input readonly type="text" id="spo" name="spo"
                    value="{{ !empty($penilaian->spo) ? $penilaian->spo : '' }}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">%</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 row">
            <div class="col-6 mb-2">
                <label for="kepala" class="form-label">Kepala : </label>
                <input readonly type="text" id="kepala" name="kepala"
                    value="{{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}" class="form-control">
            </div>
            <div class="col-6 mb-2">
                <label for="abdomen" class="form-label">Abdomen : </label>
                <input readonly type="text" id="abdomen" name="abdomen"
                    value="{{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}" class="form-control">
            </div>
            <div class="col-6 mb-2">
                <label for="gigi" class="form-label">Gigi & Mulut : </label>
                <input readonly type="text" id="gigi" name="gigi"
                    value="{{ !empty($penilaian->gigi) ? $penilaian->gigi : '' }}" class="form-control">
            </div>
            <div class="col-6 mb-2">
                <label for="genital" class="form-label">Genital & Anus : </label>
                <input readonly type="text" id="genital" name="genital"
                    value="{{ !empty($penilaian->genital) ? $penilaian->genital : '' }}" class="form-control">
            </div>
            <div class="col-6 mb-2">
                <label for="tht" class="form-label">THT: </label>
                <input readonly type="text" id="tht" name="tht"
                    value="{{ !empty($penilaian->tht) ? $penilaian->tht : '' }}" class="form-control">
            </div>
            <div class="col-6 mb-2">
                <label for="ekstremitas" class="form-label">Ekstremitas: </label>
                <input readonly type="text" id="ekstremitas" name="ekstremitas"
                    value="{{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}"
                    class="form-control">
            </div>
            <div class="col-6 mb-2">
                <label for="thoraks" class="form-label">Thoraks : </label>
                <input readonly type="text" id="thoraks" name="thoraks"
                    value="{{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}" class="form-control">
            </div>
            <div class="col-6 mb-2">
                <label for="kulit" class="form-label">Kulit : </label>
                <input readonly type="text" id="kulit" name="kulit"
                    value="{{ !empty($penilaian->kulit) ? $penilaian->kulit : '' }}" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <label for="ket_fisik" class="form-label">Keterangan</label>
            <textarea readonly class="form-control" id="ket_fisik" name="ket_fisik" rows="5">{{ !empty($penilaian->ket_fisik) ? $penilaian->ket_fisik : '' }}</textarea>
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">IV. PEMERIKSAAN PENUNJANGAN</h5>

    <div class="row mb-2">
        <label for="penunjang" class="form-label">Penunjang</label>
        <textarea readonly class="form-control h-75" id="penunjang" name="penunjang" rows="3">{{ !empty($penilaian->penunjang) ? $penilaian->penunjang : '' }}</textarea>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. DIAGNOSIS ASSESMEN</h5>

    <div class="row mb-2">
        <label for="diagnosis" class="form-label">Keterangan</label>
        <textarea readonly class="form-control" id="diagnosis" name="diagnosis" rows="3">{{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</textarea>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VI. TATALAKSANA</h5>

    <div class="row mb-2">
        <label for="tata" class="form-label">Keterangan</label>
        <textarea readonly class="form-control" id="tata" name="tata" rows="3">{{ !empty($penilaian->tata) ? $penilaian->tata : '' }}</textarea>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">VII. KONSUL / RUJUK</h5>

    <div class="row mb-2">
        <label for="konsulrujuk" class="form-label">Keterangan</label>
        <textarea readonly class="form-control" id="konsulrujuk" name="konsulrujuk" rows="3">{{ !empty($penilaian->konsulrujuk) ? $penilaian->konsulrujuk : '' }}</textarea>
    </div>
</div>
