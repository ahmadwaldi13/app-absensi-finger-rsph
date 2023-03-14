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
            <textarea readonly readonly readonly class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</textarea readonly readonly readonly>
        </div>
        <div class="col-6 mb-2">
            <label for="rps" class="form-label">Riwayat Penyakit Sekarang</label>
            <textarea readonly readonly readonly class="form-control" id="rps" name="rps" rows="3">{{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</textarea readonly readonly readonly>
        </div>
        <div class="col-6 mb-2">
            <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
            <textarea readonly readonly readonly class="form-control" id="rpo" name="rpo" rows="3">{{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</textarea readonly readonly readonly>
        </div>
        <div class="col-6 mb-2">
            <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea readonly readonly readonly class="form-control" id="rpd" name="rpd" rows="3">{{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</textarea readonly readonly readonly>
        </div>
        <div class="col-6 mb-2 ">
            <label for="alergi" class="form-label">Riwayat Alergi</label>
            <input readonly type="text" class="form-control" name="alergi" id='alergi' value="{{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}">
        </div>
    </div>
</div>


<hr class="mb-5">

<div>
    <h5 class="text-start">II. PEMERIKSAAN FISIK</h5>
    <div class="row align-items-end">

        <div class="col-3 mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input readonly-group">
                <input readonly type="text" name="td" id="td" class="form-control" value="{{ !empty($penilaian->td) ? $penilaian->td : '' }}">
                <span class="input readonly-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="bb" class="form-label">BB : </label>
            <div class="input readonly-group">
                <input readonly type="text" id="bb" name="bb" class="form-control" value="{{ !empty($penilaian->bb) ? $penilaian->bb : '' }}">
                <span class="input readonly-group-text" id="ModalPetugas">Kg</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input readonly-group">
                <input readonly type="text" id="suhu" name="suhu" class="form-control" value="{{ !empty($penilaian->suhu) ? $penilaian->suhu : 'jhon' }}">
                <span class="input readonly-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input readonly-group">
                <input readonly type="text" id="nadi" name="nadi" class="form-control" value="{{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }}">
                <span class="input readonly-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="rr" class="form-label">RR : </label>
            <div class="input readonly-group">
                <input readonly type="text" id="rr" name="rr" class="form-control" value="{{ !empty($penilaian->rr) ? $penilaian->rr : '' }}">
                <span class="input readonly-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-6 mb-2 ">
            <label for="nyeri" class="form-label">Nyeri</label>
            <input readonly type="text" class="form-control" name="nyeri" id='nyeri' value="{{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}">
        </div>
        <div class="col-6 mb-2 ">
            <label for="status" class="form-label">Status Nutrisi</label>
            <input readonly type="text" class="form-control" name="status" id='status' value="{{ !empty($penilaian->status) ? $penilaian->status : '' }}">
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">III. STATUS OFTAMOLOGIS</h5>
     <div class="row align-items-end ">
        <div class="col-6 mb-3 text-center">
            <label for="nyeri" class="form-label text-start">OD : Mata Kanan</label>
            <img src="{{asset('icon/mata.png')}}" alt="">
        </div>
        <div class="col-6 mb-3 text-center">
            <label for="status_nutrisi" class="form-label text-start">OS : Mata Kiri</label>
            <img src="{{asset('icon/mata.png')}}" alt="">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="visuskanan" id='visuskanan' value="{{ !empty($penilaian->visuskanan) ? $penilaian->visuskanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Visus SC</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="visuskiri" id='visuskiri' value="{{ !empty($penilaian->visuskiri) ? $penilaian->visuskiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="cckanan" id='cckanan' value="{{ !empty($penilaian->cckanan) ? $penilaian->cckanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">CC</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="cckiri" id='cckiri' value="{{ !empty($penilaian->cckiri) ? $penilaian->cckiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="palkanan" id='palkanan' value="{{ !empty($penilaian->palkanan) ? $penilaian->palkanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Palebra</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="palkiri" id='palkiri' value="{{ !empty($penilaian->palkiri) ? $penilaian->palkiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="conkanan" id='conkanan' value="{{ !empty($penilaian->conkanan) ? $penilaian->conkanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Conjungtiva</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="conkiri" id='conkiri' value="{{ !empty($penilaian->conkiri) ? $penilaian->conkiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="corneakanan" id='corneakanan' value="{{ !empty($penilaian->corneakanan) ? $penilaian->corneakanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Cornea</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="corneakiri" id='corneakiri' value="{{ !empty($penilaian->corneakiri) ? $penilaian->corneakiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="coakanan" id='coakanan' value="{{ !empty($penilaian->coakanan) ? $penilaian->coakanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Coa</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="coakiri" id='coakiri' value="{{ !empty($penilaian->coakiri) ? $penilaian->coakiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="pupilkanan" id='pupilkanan' value="{{ !empty($penilaian->pupilkanan) ? $penilaian->pupilkanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Pupil</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="pupilkiri" id='pupilkiri' value="{{ !empty($penilaian->pupilkiri) ? $penilaian->pupilkiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="lensakanan" id='lensakanan' value="{{ !empty($penilaian->lensakanan) ? $penilaian->lensakanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Lensa</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="lensakiri" id='lensakiri' value="{{ !empty($penilaian->lensakiri) ? $penilaian->lensakiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="funduskanan" id='funduskanan' value="{{ !empty($penilaian->funduskanan) ? $penilaian->funduskanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Fundus Media</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="funduskiri" id='funduskiri' value="{{ !empty($penilaian->funduskiri) ? $penilaian->funduskiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="papilkanan" id='papilkanan' value="{{ !empty($penilaian->papilkanan) ? $penilaian->papilkanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Papil</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="papilkiri" id='papilkiri' value="{{ !empty($penilaian->papilkiri) ? $penilaian->papilkiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="retinakanan" id='retinakanan' value="{{ !empty($penilaian->retinakanan) ? $penilaian->retinakanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Retina</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="retinakiri" id='retinakiri' value="{{ !empty($penilaian->retinakiri) ? $penilaian->retinakiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="makulakanan" id='makulakanan' value="{{ !empty($penilaian->makulakanan) ? $penilaian->makulakanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Makula</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="makulakiri" id='makulakiri' value="{{ !empty($penilaian->makulakiri) ? $penilaian->makulakiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="tiokanan" id='tiokanan' value="{{ !empty($penilaian->tiokanan) ? $penilaian->tiokanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">TIO</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="tiokiri" id='tiokiri' value="{{ !empty($penilaian->tiokiri) ? $penilaian->tiokiri : '' }}">
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="mbokanan" id='mbokanan' value="{{ !empty($penilaian->mbokanan) ? $penilaian->mbokanan : '' }}">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">MBO</label>
        </div>
        <div class="col-5 mb-2">
            <input readonly type="text" class="form-control" name="mbokiri" id='mbokiri' value="{{ !empty($penilaian->mbokiri) ? $penilaian->mbokiri : '' }}">
        </div>
     </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">IV. PEMERIKSAAN PENUNJANGAN</h5>
    <div class="row mb-2">
        <div class="col-4">
            <label for="lab" class="form-label">Laboratorium</label>
            <textarea readonly readonly readonly class="form-control" id="lab" name="lab" rows="3">{{ !empty($penilaian->lab) ? $penilaian->lab : '' }}</textarea readonly readonly readonly>
        </div>
         <div class="col-4">
            <label for="rad" class="form-label">Radiologi</label>
            <textarea readonly readonly readonly class="form-control" id="rad" name="rad" rows="3">{{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</textarea readonly readonly readonly>
        </div>
        <div class="col-4">
            <label for="penunjang" class="form-label">Penunjang lainnya</label>
            <textarea readonly readonly readonly class="form-control" id="penunjang" name="penunjang" rows="3">{{ !empty($penilaian->penunjang) ? $penilaian->penunjang : '' }}</textarea readonly readonly readonly>
        </div>
        <div class="col-6">
            <label for="tes" class="form-label">Tes Penglihatan</label>
            <textarea readonly readonly readonly class="form-control" id="tes" name="tes" rows="3">{{ !empty($penilaian->tes) ? $penilaian->tes : '' }}</textarea readonly readonly readonly>
        </div>
        <div class="col-6">
            <label for="pemeriksaan" class="form-label">Pemeriksa Lainnya</label>
            <textarea readonly readonly readonly class="form-control" id="pemeriksaan" name="pemeriksaan" rows="3">{{ !empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : '' }}</textarea readonly readonly readonly>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. DIAGNOSIS/ASESMEN</h5>
    <div class="row mb-2">
        <div class="col">
            <label for="diagnosis" class="form-label">Asesmen Kerja</label>
            <textarea readonly readonly readonly class="form-control" id="diagnosis" name="diagnosis" rows="3">{{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</textarea readonly readonly readonly>
        </div>
         <div class="col">
            <label for="diagnosisbdg" class="form-label">Asesmen Banding</label>
            <textarea readonly readonly readonly class="form-control" id="diagnosisbdg" name="diagnosisbdg" rows="3">{{ !empty($penilaian->diagnosisbdg) ? $penilaian->diagnosisbdg : '' }}</textarea readonly readonly readonly>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VI. PERMASALAHAN & TATALAKSANA</h5>
    <div class="row mb-2">
        <div class="col-6">
            <label for="permasalahan" class="form-label">Permasalahan</label>
            <textarea readonly readonly class="form-control" id="permasalahan" name="permasalahan" rows="3">{{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</textarea readonly readonly>
        </div>
         <div class="col-6">
            <label for="terapi" class="form-label">Terapi/Pengobatan</label>
            <textarea readonly readonly class="form-control" id="terapi" name="terapi" rows="3">{{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</textarea readonly readonly>
        </div>
        <div class="col-12">
            <label for="tindakan" class="form-label">Tindakan/Rencana Pengobatan</label>
            <textarea readonly readonly class="form-control" id="tindakan" name="tindakan" rows="3">{{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</textarea readonly readonly>
        </div>
    </div>
</div>
<hr class="mb-5">

<div>
    <h5 class="text-start">VII. EDUKASI</h5>
    <div class="row mb-2">
        <div class="col">
            <textarea readonly readonly readonly readonly class="form-control" id="edukasi" name="edukasi" rows="3">{{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</textarea readonly readonly readonly>
        </div>
    </div>
</div>
