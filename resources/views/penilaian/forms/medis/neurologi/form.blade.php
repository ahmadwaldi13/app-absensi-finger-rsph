<form action="{{ url('/penilaian-medis-neurologi/update') }}" method="post">
    @csrf
    <div class="row mb-3">
        @include('penilaian.form_header', [
            "pj_form_type"=>"dokter",
            "nama_pj" => $penilaian->nm_dokter,
            "kode_pj" => $penilaian->kd_dokter,
            "readonly" => true
        ])
        <div class="col mb-2">
            <label for="tanggal" class="form-label">Tanggal : </label>
            <input  readonly type="text" class="form-control input-daterange input-date-time" name="tanggal" value="{{!empty($penilaian->tanggal) ? $penilaian->tanggal : ''}}" id="tanggal"  required autocomplete="off">
        </div>
        <div class="col mb-2">
            <label for="informasi" class="form-label">Informasi didapat dari : </label>
            <select class="form-select" id="anamnesis" readonly name="anamnesis" value="{{$penilaian->anamnesis}}" aria-label="Default select ">
                <option value="-" {{$penilaian->anamnesis === "-" ? 'selected' : ''}}>Pilih Informasi</option>
                <option value="Autoanamnesis" {{$penilaian->anamnesis === 'Autoanamnesis' ? 'selected' : '' }} >Autoanamnesis</option>
                <option value="Alloanamnesis" {{$penilaian->anamnesis === 'Alloanamnesis' ? 'selected' : ''}} >Alloanamnesis</option>
            </select>
        </div>
    </div>
    <hr class="mb-5">

    <div>
        <h5 class="text-start">I. RIWAYAT KESEHATAN</h5>
        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="keluhan_utama" class="form-label">Keluhan Utama</label>
                <textarea class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rps" class="form-label">Riwayat Penyakit Sekarang</label>
                <textarea class="form-control" id="rps" name="rps" rows="3">{{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
                <textarea class="form-control" id="rpo" name="rpo" rows="3">{{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
                <textarea class="form-control" id="rpd" name="rpd" rows="3">{{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</textarea>
            </div>
            <div class="col-6 mb-2 ">
                <label for="alergi" class="form-label">Riwayat Alergi</label>
                <input type="text" class="form-control" name="alergi" id='alergi'
                    value="{{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}">
            </div>
        </div>
    </div>

    <hr class="mb-5">

    <div>
        <h5 class="text-start">II. PEMERIKSAAN FISIK</h5>
        <div class="row align-items-end">

            <div class="col-3 mb-2">
                <label for="kesadaran" class="form-label">Kesadaran :</label>
                <div class="input-group">
                    <select class="form-select w-25" id="kesadaran" name="kesadaran"
                        aria-label="Default select example">
                        <option value="-" {{ $penilaian->kesadaran === '-' ? 'selected' : '' }}>Pilih status
                        </option>
                        <option value="Compos Mentis"
                            {{ $penilaian->kesadaran === 'Compos Mentis' ? 'selected' : '' }}>Compos Mentis</option>
                        <option value="Apatis" {{ $penilaian->kesadaran === 'Apatis' ? 'selected' : '' }}>Apatis
                        </option>
                        <option value="Delirum" {{ $penilaian->kesadaran === 'Delirum' ? 'selected' : '' }}>Delirum
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="td" class="form-label">TD : </label>
                <div class="input-group">
                    <input type="text" name="td" id="td" class="form-control"
                        value="{{ !empty($penilaian->td) ? $penilaian->td : '' }}">
                    <span class="input-group-text" id="ModalPetugas">mmHg</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="nadi" class="form-label">Nadi : </label>
                <div class="input-group">
                    <input type="text" id="nadi" name="nadi" class="form-control"
                        value="{{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }}">
                    <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="suhu" class="form-label">Suhu : </label>
                <div class="input-group">
                    <input type="text" id="suhu" name="suhu" class="form-control"
                        value="{{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }}">
                    <span class="input-group-text" id="ModalPetugas">&#8451;</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="rr" class="form-label">RR : </label>
                <div class="input-group">
                    <input type="text" id="rr" name="rr" class="form-control"
                        value="{{ !empty($penilaian->rr) ? $penilaian->rr : '' }}">
                    <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="status" class="form-label">Status Nutrisi :</label>
                <div class="input-group">
                    <select class="form-select w-25" id="status" name="status"
                        aria-label="Default select example">
                        <option value="-" {{ $penilaian->status === '-' ? 'selected' : '' }}>Pilih status
                        </option>
                        <option value="Skor < 2" {{ $penilaian->status === 'Skor < 2' ? 'selected' : '' }}>Skor <
                                2</option>
                        <option value="Skor >= 2" {{ $penilaian->status === '-' ? 'Skor >= 2' : '' }}>Skor >= 2
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="bb" class="form-label">BB : </label>
                <div class="input-group">
                    <input type="text" id="bb" name="bb" class="form-control"
                        value="{{ !empty($penilaian->bb) ? $penilaian->bb : '' }}">
                    <span class="input-group-text" id="ModalPetugas">Kg</span>
                </div>
            </div>

            <div class="col-4 mb-2 ">
                <label for="nyeri" class="form-label">Nyeri</label>
                <input type="text" class="form-control" name="nyeri" id='nyeri'
                    value="{{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}">
            </div>
            <div class="col-2 mb-2">
                <label for="gcs" class="form-label">GCS(E, V, M) : </label>
                <div class="input-group">
                    <input type="text" id="gcs" name="gcs" class="form-control"
                        value="{{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}">
                </div>
            </div>
        </div>
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">III. STATUS KELAINAN</h5>
        <div class="row">
        <div class="col-6">
            <div class="col-12 mb-2">
                <label for="kepala" class="form-label">Kepala :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="kepala" name="kepala"
                        aria-label="Default select example">
                        <option value="-" {{ $penilaian->kepala === '-' ? 'selected' : '' }}>Pilih status
                        </option>
                        <option value="Normal" {{ $penilaian->kepala === 'Normal' ? 'selected' : '' }}>Normal</option>
                        <option value="Abnormal" {{ $penilaian->kepala === 'Abnormal' ? 'selected' : '' }}>Abnormal
                        </option>
                        <option value="Tidak Diperiksa"
                            {{ $penilaian->kepala === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_kepala" id='keterangan_kepala'
                        value="{{ !empty($penilaian->keterangan_kepala) ? $penilaian->keterangan_kepala : '' }}">
                </div>
            </div>
            <div class="col-12 mb-2">
                <label for="thoraks" class="form-label">Thoraks :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="thoraks" name="thoraks"
                        aria-label="Default select example">
                        <option value="-" {{ $penilaian->thoraks === '-' ? 'selected' : '' }}>Pilih status
                        </option>
                        <option value="Normal" {{ $penilaian->thoraks === 'Normal' ? 'selected' : '' }}>Normal
                        </option>
                        <option value="Abnormal" {{ $penilaian->thoraks === 'Abnormal' ? 'selected' : '' }}>Abnormal
                        </option>
                        <option value="Tidak Diperiksa"
                            {{ $penilaian->thoraks === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_thoraks"
                        id='keterangan_thoraks'
                        value="{{ !empty($penilaian->keterangan_thoraks) ? $penilaian->keterangan_thoraks : '' }}">
                </div>
            </div>
            <div class="col-12 mb-2">
                <label for="abdomen" class="form-label">Abdomen :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="abdomen" name="abdomen"
                        aria-label="Default select example">
                        <option value="-" {{ $penilaian->abdomen === '-' ? 'selected' : '' }}>Pilih status
                        </option>
                        <option value="Normal" {{ $penilaian->abdomen === 'Normal' ? 'selected' : '' }}>Normal
                        </option>
                        <option value="Abnormal" {{ $penilaian->abdomen === 'Abnormal' ? 'selected' : '' }}>Abnormal
                        </option>
                        <option value="Tidak Diperiksa"
                            {{ $penilaian->abdomen === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_abdomen"
                        id='keterangan_abdomen'
                        value="{{ !empty($penilaian->keterangan_abdomen) ? $penilaian->keterangan_abdomen : '' }}">
                </div>
            </div>
            <div class="col-12 mb-2">
                <label for="ekstremitas" class="form-label">Ekstremitas :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="ekstremitas" name="ekstremitas"
                        aria-label="Default select example">
                        <option value="-" {{ $penilaian->ekstremitas === '-' ? 'selected' : '' }}>Pilih status
                        </option>
                        <option value="Normal" {{ $penilaian->ekstremitas === 'Normal' ? 'selected' : '' }}>Normal
                        </option>
                        <option value="Abnormal" {{ $penilaian->ekstremitas === 'Abnormal' ? 'selected' : '' }}>
                            Abnormal</option>
                        <option value="Tidak Diperiksa"
                            {{ $penilaian->ekstremitas === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa
                        </option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_ekstremitas"
                        id='keterangan_ekstremitas'
                        value="{{ !empty($penilaian->keterangan_abdomen) ? $penilaian->keterangan_abdomen : '' }}">
                </div>
            </div>
            <div class="col-12 mb-2">
                <label for="columna" class="form-label">Columna Verbralis :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="columna" name="columna"
                        aria-label="Default select example">
                        <option value="-" {{ $penilaian->columna === '-' ? 'selected' : '' }}>Pilih status
                        </option>
                        <option value="Normal" {{ $penilaian->columna === 'Normal' ? 'selected' : '' }}>Normal
                        </option>
                        <option value="Abnormal" {{ $penilaian->columna === 'Abnormal' ? 'selected' : '' }}>Abnormal
                        </option>
                        <option value="Tidak Diperiksa"
                            {{ $penilaian->columna === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_columna"
                        id='keterangan_columna'
                        value="{{ !empty($penilaian->keterangan_columna) ? $penilaian->keterangan_columna : '' }}">
                </div>
            </div>
            <div class="col-12 mb-2">
                <label for="muskulos" class="form-label">Muskoloskeletal :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="muskulos" name="muskulos"
                        aria-label="Default select example">
                        <option value="-" {{ $penilaian->muskulos === '-' ? 'selected' : '' }}>Pilih status
                        </option>
                        <option value="Normal" {{ $penilaian->muskulos === 'Normal' ? 'selected' : '' }}>Normal
                        </option>
                        <option value="Abnormal" {{ $penilaian->muskulos === 'Abnormal' ? 'selected' : '' }}>Abnormal
                        </option>
                        <option value="Tidak Diperiksa"
                            {{ $penilaian->muskulos === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_muskulos"
                        id='keterangan_muskulos'
                        value="{{ !empty($penilaian->keterangan_muskulos) ? $penilaian->keterangan_muskulos : '' }}">
                </div>
            </div>
        </div>
        <div class="col-6">
            <h5 class="text-center">Lainnya</h5>
            <textarea class="form-control h-75" id="lainnya" name="lainnya" rows="5">{{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}</textarea>
        </div>
    </div>

    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">IV. PEMERIKSAAN PENUNJANGAN</h5>
        <div class="row mb-2">
            <div class="col-4">
                <label for="lab" class="form-label">Laboratorium</label>
                <textarea class="form-control" id="lab" name="lab" rows="3">{{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}</textarea>
            </div>
            <div class="col-4">
                <label for="rad" class="form-label">Radiologi</label>
                <textarea class="form-control" id="rad" name="rad" rows="3">{{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}</textarea>
            </div>
            <div class="col-4">
                <label for="penunjanglain" class="form-label">Penunjang lainnya</label>
                <textarea class="form-control" id="penunjanglain" name="penunjanglain" rows="3">{{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}</textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">V. DIAGNOSIS/ASESMEN</h5>
        <div class="row mb-2">
            <div class="col">
                <label for="diagnosis" class="form-label">Asesmen Kerja</label>
                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3">{{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</textarea>
            </div>
            <div class="col">
                <label for="diagnosis2" class="form-label">Asesmen Banding</label>
                <textarea class="form-control" id="diagnosis2" name="diagnosis2" rows="3">{{ !empty($penilaian->diagnosis2) ? $penilaian->lainnya : '' }}</textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">VI. PERMASALAHAN & TATALAKSANA</h5>
        <div class="row mb-2">
            <div class="col-6">
                <label for="permasalahan" class="form-label">Permasalahan</label>
                <textarea class="form-control" id="permasalahan" name="permasalahan" rows="3">{{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</textarea>
            </div>
            <div class="col-6">
                <label for="terapi" class="form-label">Terapi/Pengobatan</label>
                <textarea class="form-control" id="terapi" name="terapi" rows="3">{{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</textarea>
            </div>
            <div class="col-12">
                <label for="tindakan" class="form-label">Tindakan/Rencana Pengobatan</label>
                <textarea class="form-control" id="tindakan" name="tindakan" rows="3">{{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">VII. EDUKASI</h5>
        <div class="row mb-2">
            <div class="col">
                <textarea class="form-control" id="edukasi" name="edukasi" rows="3">{{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</textarea>
            </div>
        </div>
    </div>
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
