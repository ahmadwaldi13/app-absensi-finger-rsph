<form action="{{url('/penilaian-medis-kebidanan/update')}}" method="post">
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
                <textarea  class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{!empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : ''}}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rps" class="form-label">Riwayat Penyakit Sekarang</label>
                <textarea  class="form-control" id="rps" name="rps" rows="3">{{!empty($penilaian->rps) ? $penilaian->rps : ''}}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rpk" class="form-label">Riwayat Penyakit Keluarga</label>
                <textarea  class="form-control" id="rpk" name="rpk" rows="3">{{!empty($penilaian->rpk) ? $penilaian->rpk : ''}}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
                <textarea  class="form-control" id="rpd" name="rpd" rows="3">{{!empty($penilaian->rpd) ? $penilaian->rpd : ''}}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
                <textarea  class="form-control" id="rpo" name="rpo" rows="3">{{!empty($penilaian->rpo) ? $penilaian->rpo : ''}}</textarea>
            </div>
            <div class="col-6 mb-2 ">
                <label for="alergi" class="form-label">Riwayat Alergi</label>
                <input  type="text" class="form-control" name="alergi" value="{{!empty($penilaian->alergi) ? $penilaian->alergi : ''}}"  id='alergi' value="">
            </div>
        </div>
    </div>


    <hr class="mb-5">

    <div>
        <h5 class="text-start">II. PEMERIKSAAN FISIK</h5>
        <div class="row align-items-end">
            <div class="col-3 mb-2">
                <label for="keadaan" class="form-label">Keadaan Umum : </label>
                <select class="form-select" id="keadaan" name="keadaan" aria-label="Default select ">
                    <option value="-" {{$penilaian->keadaan === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                    <option value="Sehat" {{$penilaian->keadaan === "Sehat" ? 'selected' : ''}} >Sehat</option>
                    <option value="Sakit Ringan" {{$penilaian->keadaan === "Sakit Ringan" ? 'selected' : ''}}>Sakit Ringan</option>
                    <option value="Sakit Sedang" {{$penilaian->keadaan === "Sakit Sedang" ? 'selected' : ''}}>Sakit Sedang</option>
                    <option value="Sakit Berat" {{$penilaian->keadaan === "Sakit Berat" ? 'selected' : ''}}>Sakit Berat</option>
                </select>
            </div>
            <div class="col-3 mb-2">
                <label for="kesadaran" class="form-label">Kesadaran : </label>
                <select class="form-select" id="kesadaran" name="kesadaran" aria-label="Default select ">
                    <option value="-" {{$penilaian->kesadaran === "-" ? 'selected' : ''}} >Pilih Kesadaran</option>
                    <option value="Compos Mentis" {{$penilaian->kesadaran === "Compos Mentis" ? 'selected' : ''}} >Compos Mentis</option>
                    <option value="Apatis" {{$penilaian->kesadaran === "Apatis" ? 'selected' : ''}}>Apatis</option>
                    <option value="Somnolen" {{$penilaian->kesadaran === "Somnolen" ? 'selected' : ''}}>Somnolen</option>
                    <option value="Sopor" {{$penilaian->kesadaran === "Sopor" ? 'selected' : ''}}>Sopor</option>
                    <option value="Koma" {{$penilaian->kesadaran === "Koma" ? 'selected' : ''}}>Koma</option>
                </select>
            </div>
            <div class="col-3 mb-2">
                <label for="td" class="form-label">TD : </label>
                <div class="input-group">
                    <input  type="text" name="td" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}"  id="td" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">mmHg</span>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="nadi" class="form-label">Nadi : </label>
                <div class="input-group">
                    <input  type="text" id="nadi" name="nadi" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}"  class="form-control">
                    <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="rr" class="form-label">RR : </label>
                <div class="input-group">
                    <input  type="text" id="rr" name="rr" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}"  class="form-control">
                    <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="suhu" class="form-label">Suhu : </label>
                <div class="input-group">
                    <input  type="text" id="suhu" name="suhu" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}"  class="form-control">
                    <span class="input-group-text" id="ModalPetugas">&#8451;</span>
                </div>
            </div>

            <div class="col-3 mb-2">
                <label for="gcs" class="form-label">GCS(E, V, M) : </label>
                <div class="input-group">
                    <input  type="text" id="gcs" name="gcs" value="{{!empty($penilaian->gcs) ? $penilaian->gcs : ''}}"  class="form-control">
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="bb" class="form-label">BB : </label>
                <div class="input-group">
                    <input  type="text" id="bb" name="bb" value="{{!empty($penilaian->bb) ? $penilaian->bb : ''}}"  class="form-control">
                    <span class="input-group-text" id="ModalPetugas">Kg</span>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="tb" class="form-label">TB : </label>
                <div class="input-group">
                    <input  type="text" id="tb" name="tb" value="{{!empty($penilaian->tb) ? $penilaian->tb : ''}}"  class="form-control">
                    <span class="input-group-text" id="ModalPetugas">cm</span>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="spo" class="form-label">SpO2 : </label>
                <div class="input-group">
                    <input  type="text" id="spo" name="spo" value="{{!empty($penilaian->spo) ? $penilaian->spo : ''}}"  class="form-control">
                    <span class="input-group-text" id="ModalPetugas">%</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 row">
                <div class="col-6 mb-2">
                    <label for="kepala" class="form-label">Kepala : </label>
                    <select class="form-select" id="kepala" name="kepala" aria-label="Default select ">
                        <option value="-" {{$penilaian->kepala === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                        <option value="Normal" {{$penilaian->kepala === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Abnormal" {{$penilaian->kepala === "Abnormal" ? 'selected' : ''}}>Abnormal</option>
                        <option value="Tidak Diperiksa" {{$penilaian->kepala === "Tidak Diperiksa" ? 'selected' : ''}}>Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="abdomen" class="form-label">Abdomen : </label>
                    <select class="form-select" id="abdomen" name="abdomen" aria-label="Default select ">
                        <option value="-" {{$penilaian->abdomen === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                        <option value="Normal" {{$penilaian->abdomen === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Abnormal" {{$penilaian->abdomen === "Abnormal" ? 'selected' : ''}}>Abnormal</option>
                        <option value="Tidak Diperiksa" {{$penilaian->abdomen === "Tidak Diperiksa" ? 'selected' : ''}}>Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="mata" class="form-label">Mata : </label>
                    <select class="form-select" id="mata" name="mata" aria-label="Default select ">
                        <option value="-" {{$penilaian->mata === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                        <option value="Normal" {{$penilaian->mata === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Abnormal" {{$penilaian->mata === "Abnormal" ? 'selected' : ''}}>Abnormal</option>
                        <option value="Tidak Diperiksa" {{$penilaian->mata === "Tidak Diperiksa" ? 'selected' : ''}}>Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="gigi" class="form-label">Gigi & Mulut : </label>
                    <select class="form-select" id="gigi" name="gigi" aria-label="Default select ">
                        <option value="-" {{$penilaian->gigi === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                        <option value="Normal" {{$penilaian->gigi === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Abnormal" {{$penilaian->gigi === "Abnormal" ? 'selected' : ''}}>Abnormal</option>
                        <option value="Tidak Diperiksa" {{$penilaian->gigi === "Tidak Diperiksa" ? 'selected' : ''}}>Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="genital" class="form-label">Genital & Anus : </label>
                    <select class="form-select" id="genital" name="genital" aria-label="Default select ">
                        <option value="-" {{$penilaian->genital === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                        <option value="Normal" {{$penilaian->genital === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Abnormal" {{$penilaian->genital === "Abnormal" ? 'selected' : ''}}>Abnormal</option>
                        <option value="Tidak Diperiksa" {{$penilaian->genital === "Tidak Diperiksa" ? 'selected' : ''}}>Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="tht" class="form-label">THT: </label>
                    <select class="form-select" id="tht" name="tht" aria-label="Default select ">
                        <option value="-" {{$penilaian->tht === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                        <option value="Normal" {{$penilaian->tht === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Abnormal" {{$penilaian->tht === "Abnormal" ? 'selected' : ''}}>Abnormal</option>
                        <option value="Tidak Diperiksa" {{$penilaian->tht === "Tidak Diperiksa" ? 'selected' : ''}}>Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="ekstremitas" class="form-label">Ekstremitas: </label>
                    <select class="form-select" id="ekstremitas" name="ekstremitas" aria-label="Default select ">
                        <option value="-" {{$penilaian->ekstremitas === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                        <option value="Normal" {{$penilaian->ekstremitas === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Abnormal" {{$penilaian->ekstremitas === "Abnormal" ? 'selected' : ''}}>Abnormal</option>
                        <option value="Tidak Diperiksa" {{$penilaian->ekstremitas === "Tidak Diperiksa" ? 'selected' : ''}}>Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="thoraks" class="form-label">Thoraks : </label>
                    <select class="form-select" id="thoraks" name="thoraks" aria-label="Default select ">
                        <option value="-" {{$penilaian->thoraks === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                        <option value="Normal" {{$penilaian->thoraks === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Abnormal" {{$penilaian->thoraks === "Abnormal" ? 'selected' : ''}}>Abnormal</option>
                        <option value="Tidak Diperiksa" {{$penilaian->thoraks === "Tidak Diperiksa" ? 'selected' : ''}}>Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="kulit" class="form-label">Kulit : </label>
                    <select class="form-select" id="kulit" name="kulit" aria-label="Default select ">
                        <option value="-" {{$penilaian->kulit === "-" ? 'selected' : ''}} >Pilih Keadaan</option>
                        <option value="Normal" {{$penilaian->kulit === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Abnormal" {{$penilaian->kulit === "Abnormal" ? 'selected' : ''}}>Abnormal</option>
                        <option value="Tidak Diperiksa" {{$penilaian->kulit === "Tidak Diperiksa" ? 'selected' : ''}}>Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <label for="ket_fisik" class="form-label">Keterangan</label>
                <textarea  class="form-control" id="ket_fisik" name="ket_fisik" rows="5">{{!empty($penilaian->ket_fisik) ? $penilaian->ket_fisik : ''}}</textarea>
            </div>
        </div>
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">III. STATUS OBSTETRI / GINEKOLOGI</h5>

        <div class="row mb-2">
            <div class="col mb-2">
                <label for="tfu" class="form-label">TFU : </label>
                <div class="input-group">
                    <input  type="text" name="tfu" value="{{!empty($penilaian->tfu) ? $penilaian->tfu : ''}}"  id="tfu" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">Cm</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="tbj" class="form-label">TBJ : </label>
                <div class="input-group">
                    <input  type="text" name="tbj" value="{{!empty($penilaian->tbj) ? $penilaian->tbj : ''}}"  id="tbj" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">gram</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="his" class="form-label">His : </label>
                <div class="input-group">
                    <input  type="text" name="his" value="{{!empty($penilaian->his) ? $penilaian->his : ''}}"  id="his" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">x / 10 Menit</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="kontraksi" class="form-label">Kontraksi : </label>
                <select class="form-select" id="kontraksi" name="kontraksi" aria-label="Default select ">
                    <option value="-" {{$penilaian->kontraksi === "-" ? 'selected' : ''}} >Pilih Kesadaran</option>
                    <option value="Ada" {{$penilaian->kontraksi === "Ada" ? 'selected' : ''}} >Ada</option>
                    <option value="Tidak" {{$penilaian->kontraksi === "Tidak" ? 'selected' : ''}}>Tidak</option>
                </select>
            </div>
            <div class="col mb-2">
                <label for="djj" class="form-label">DJJ : </label>
                <div class="input-group">
                    <input  type="text" name="djj" value="{{!empty($penilaian->djj) ? $penilaian->djj : ''}}"  id="djj" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">Dpm</span>
                </div>
            </div>
            <!-- <label for="ket_lokalis" class="form-label">Keterangan</label>
            <textarea  class="form-control" id="ket_lokalis" name="ket_lokalis" rows="3"></textarea> -->
        </div>
        <div class="row">
            <div class="col-6">
                <label for="inspeksi" class="form-label">Inspeksi : </label>
                <textarea  class="form-control" id="inspeksi" name="inspeksi" rows="5">{{!empty($penilaian->inspeksi) ? $penilaian->inspeksi : ''}}</textarea>
            </div>
            <div class="col-6">
                <label for="vt" class="form-label">VT : </label>
                <textarea  class="form-control" id="vt" name="vt" rows="5">{{!empty($penilaian->vt) ? $penilaian->vt : ''}}</textarea>
            </div>
            <div class="col-6">
                <label for="inspekulo" class="form-label">Inspekulo : </label>
                <textarea  class="form-control" id="inspekulo" name="inspekulo" rows="5">{{!empty($penilaian->inspekulo) ? $penilaian->inspekulo : ''}}</textarea>
            </div>
            <div class="col-6">
                <label for="rt" class="form-label">RT : </label>
                <textarea  class="form-control" id="rt" name="rt" rows="5">{{!empty($penilaian->rt) ? $penilaian->rt : ''}}</textarea>
            </div>
        </div>
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">IV. PEMERIKSAAN PENUNJANGAN</h5>

        <div class="row mb-2">
            <div class="col-4">
                <label for="ultra" class="form-label">Ultrasonografi : </label>
                <textarea  class="form-control" id="ultra" name="ultra" rows="5">{{!empty($penilaian->ultra) ? $penilaian->ultra : ''}}</textarea>
            </div>
            <div class="col-4">
                <label for="kardio" class="form-label">Kardiotografi : </label>
                <textarea  class="form-control" id="kardio" name="kardio" rows="5">{{!empty($penilaian->kardio) ? $penilaian->kardio : ''}}</textarea>
            </div>
            <div class="col-4">
                <label for="lab" class="form-label">Laboratorium : </label>
                <textarea  class="form-control" id="lab" name="lab" rows="5">{{!empty($penilaian->lab) ? $penilaian->lab : ''}}</textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">V. DIAGNOSIS ASSESMEN</h5>

        <div class="row mb-2">
            <label for="diagnosis" class="form-label">Keterangan</label>
            <textarea  class="form-control" id="diagnosis" name="diagnosis" rows="3">{{!empty($penilaian->diagnosis) ? $penilaian->diagnosis : ''}}</textarea>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">VI. TATALAKSANA</h5>

        <div class="row mb-2">
            <label for="tata" class="form-label">Keterangan</label>
            <textarea  class="form-control" id="tata" name="tata" rows="3">{{!empty($penilaian->tata) ? $penilaian->tata : ''}}</textarea>
        </div>
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">VII. KONSUL / RUJUK</h5>

        <div class="row mb-2">
            <label for="konsul" class="form-label">Keterangan</label>
            <textarea  class="form-control" id="konsul" name="konsul" rows="3">{{!empty($penilaian->konsul) ? $penilaian->konsul : ''}}</textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
</form>