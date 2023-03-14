<div class="row mb-3">
    @include('penilaian.form_header', [
        "pj_form_type"=>"petugas", 
        "nama_pj" => $penilaian->nama,
        "kode_pj" => $penilaian->nip, 
        "readonly" => true
    ])
    <div class="col mb-2">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input readonly type="text" class="form-control input-daterange input-date-time" name="tanggal" id="tanggal" value="{{!empty($penilaian->tanggal) ? $penilaian->tanggal : ''}}"  required autocomplete="off" >
    </div>
    <div class="col mb-2">
        <label for="informasi" class="form-label">Informasi didapat dari : </label>
        <input readonly type="text" id="informasi" name="informasi" class="form-control" value="{{!empty($penilaian->informasi) ? $penilaian->informasi : ''}}">
    </div>
</div>
<hr class="mb-5">

<div>
    <h5 class="text-start">I. KEADAAN UMUM</h5>
    <div class="row align-items-end">
        <div class="col mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input readonly type="text" class="form-control" id="td" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input readonly type="text" class="form-control" id="nadi" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="rr" class="form-label">RR : </label>
            <div class="input-group">
                <input readonly type="text" class="form-control" id="rr" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}">
                
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input readonly type="text" class="form-control" id="suhu" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}">
                
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>

    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">II. STATUS NUTRISI</h5>
    <div class="row align-items-end">
        <div class="col mb-2">
            <label for="bb" class="form-label">BB : </label>
            <div class="input-group">
                <input readonly type="text" class="form-control" id="bb" value="{{!empty($penilaian->bb) ? $penilaian->bb : ''}}">
                
                <span class="input-group-text" id="ModalPetugas">Kg</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input readonly type="text" class="form-control" id="tb" value="{{!empty($penilaian->tb) ? $penilaian->tb : ''}}">
                
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="bmi" class="form-label">BMI : </label>
            <div class="input-group">
                <input readonly type="text" class="form-control" id="bmi" value="{{!empty($penilaian->bmi) ? $penilaian->bmi : ''}}">
                
                <span class="input-group-text" id="ModalPetugas">Kg / m&#178;</span>
            </div>
        </div>

    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">III. RIWAYAT KESEHATAN</h5>
    <div class="row">
        <div class="col">
            <div class="row">
                <label for="keluhan_utama" class="form-label">Keluhan Utama</label>
                <textarea class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{!empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : ''}}</textarea>
            </div>
            <div class="row">
                <label for="alergi" class="form-label">Riwayat Alergi</label>

                <input readonly type="text" class="form-control" id="alergi" value="{{!empty($penilaian->alergi) ? $penilaian->alergi : ''}}">
                
            </div>
            <div class="row">
                <label for="kebiasaan_sikat_gigi" class="form-label">Kebiasaan Sikat Gigi : </label>
                <input readonly type="text" class="form-control" id="kebiasaan_sikat_gigi" value="{{!empty($penilaian->kebiasaan_sikat_gigi) ? $penilaian->kebiasaan_sikat_gigi : ''}}">
                {{-- <select class="form-select" id="kebiasaan_sikat_gigi" name="kebiasaan_sikat_gigi" aria-label="Default select "> --}}
                    {{-- <option value="-" selected>Pilih Kebiasaan</option> --}}
                    {{-- <option value="1x" >1x</option> --}}
                    {{-- <option value="2x">2x</option> --}}
                    {{-- <option value="3x" >3x</option> --}}
                    {{-- <option value="Mandi">Mandi</option> --}}
                    {{-- <option value="Setelah Makan" >Setelah Makan</option> --}}
                    {{-- <option value="Sebelum Tidur" >Sebelum Tidur</option> --}}
                {{-- </select> --}}
            </div>
        </div>
        <div class="col">
            <div class="row">
                <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit:</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="riwayat_penyakit" value="{{!empty($penilaian->riwayat_penyakit) ? $penilaian->riwayat_penyakit : ''}}">
                    {{-- <select class="form-select w-25" id="riwayat_penyakit"  name="riwayat_penyakit" aria-label="Default select example"> --}}
                        {{-- <option value="-" selected>Pilih status</option> --}}
                        {{-- <option value="Tidak Ada" >Tidak Ada</option> --}}
                        {{-- <option value="Diabetes Melitus" >Diabetes Melitus</option> --}}
                        {{-- <option value="Hipertensi" >Hipertensi</option> --}}
                        {{-- <option value="Penyakit Jantung" >Penyakit Jantung</option> --}}
                        {{-- <option value="HIV" >HIV</option> --}}
                        {{-- <option value="Hepatitis" >Hepatitis</option> --}}
                        {{-- <option value="Haemophilia" >Haemophilia</option> --}}
                        {{-- <option value="Lain-lain" >Lain-lain</option> --}}
                    {{-- </select> --}}
                    <input readonly type="text" class="form-control" id="ket_riwayat_penyakit" value="{{!empty($penilaian->ket_riwayat_penyakit) ? $penilaian->ket_riwayat_penyakit : ''}}">
                    
                </div>
            </div>
            <div class="row">
                <label for="riwayat_perawatan_gigi" class="form-label">Riwayat Perawatan Gigi:</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="riwayat_perawatan_gigi" value="{{!empty($penilaian->riwayat_perawatan_gigi) ? $penilaian->riwayat_perawatan_gigi : ''}}">
                    {{-- <select class="form-select w-25" id="riwayat_perawatan_gigi"  name="riwayat_perawatan_gigi" aria-label="Default select example"> --}}
                        {{-- <option value="-" selected>Pilih status</option> --}}
                        {{-- <option value="Tidak Ada" >Tidak Ada</option> --}}
                        {{-- <option value="Ya, Kapan">Ya, Kapan</option> --}}
                    {{-- </select> --}}
                    <input readonly type="text" class="form-control" id="ket_riwayat_perawatan_gigi" value="{{!empty($penilaian->ket_riwayat_perawatan_gigi) ? $penilaian->ket_riwayat_perawatan_gigi : ''}}">
                    
                </div>
            </div>
            <div class="row">
                <label for="kebiasaan_lain" class="form-label">Kebiasaan Lain:</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="kebiasaan_lain" value="{{!empty($penilaian->kebiasaan_lain) ? $penilaian->kebiasaan_lain : ''}}">
                    {{-- <select class="form-select w-25" id="kebiasaan_lain"  name="kebiasaan_lain" aria-label="Default select example"> --}}
                        {{-- <option value="-" selected>Pilih status</option> --}}
                        {{-- <option value="Tidak Ada" >Tidak Ada</option> --}}
                        {{-- <option value="Minum kopi/teh" >Minum kopi/teh</option> --}}
                        {{-- <option value="Minum alkohol" >Minum alkohol</option> --}}
                        {{-- <option value="Bruxism" >Bruxism</option> --}}
                        {{-- <option value="Menggigit pensil" >Menggigit pensil</option> --}}
                        {{-- <option value="Menguyah 1 sisi rahang" >Menguyah 1 sisi rahang</option> --}}
                        {{-- <option value="Merokok" >Merokok</option>  --}}
                        {{-- <option value="Lain-lain" >Lain-lain</option> --}}
                    {{-- </select> --}}
                    <input readonly type="text" class="form-control" id="ket_kebiasaan_lain" value="{{!empty($penilaian->ket_kebiasaan_lain) ? $penilaian->ket_kebiasaan_lain : ''}}">
                    
                </div>
            </div>
            <div class="row">
                <label for="obat_yang_diminum_saatini" class="form-label">Obat Yang Diminum Saat ini:</label>
                <input readonly type="text" class="form-control" id="obat_yang_diminum_saatini" value="{{!empty($penilaian->obat_yang_diminum_saatini) ? $penilaian->obat_yang_diminum_saatini : ''}}">
                
            </div>
        </div>
    </div>

</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">IV. FUNGSIONAL</h5>
    <div class="row align-items-end">
        <div class="col mb-2">
            <label for="alat_bantu" class="form-label">Alat Bantu</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="alat_bantu" value="{{!empty($penilaian->alat_bantu) ? $penilaian->alat_bantu : ''}}">
                {{-- <select class="form-select w-25" id="alat_bantu"  name="alat_bantu" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Alat Bantu</option> --}}
                    {{-- <option value="Tidak" >Tidak</option> --}}
                    {{-- <option value="Ya">Ya</option> --}}
                {{-- </select> --}}
                <input readonly type="text" class="form-control" id="ket_alat_bantu" value="{{!empty($penilaian->ket_alat_bantu) ? $penilaian->ket_alat_bantu : ''}}">
                
            </div>
            
        </div>
        <div class="col mb-2">
            <label for="prothesa" class="form-label">Prothesa</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="prothesa" value="{{!empty($penilaian->prothesa) ? $penilaian->prothesa : ''}}">
                {{-- <select class="form-select w-25" id="prothesa"  name="prothesa" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Prothesa</option> --}}
                    {{-- <option value="Tidak" >Tidak</option> --}}
                    {{-- <option value="Ya">Ya</option> --}}
                {{-- </select> --}}
                <input readonly type="text" class="form-control" id="ket_pro" value="{{!empty($penilaian->ket_pro) ? $penilaian->ket_pro : ''}}">
                
            </div>
            
        </div>
    </div>

    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="cacat_fisik" class="form-label">Cacat Fisik</label>
            <input readonly type="text" class="form-control" id="value" value="{{!empty($penilaian->value) ? $penilaian->value : ''}}">
            
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">V. RIWAYAT PSIKO SOSIAL, SPIRITUAL DAN BUDAYA </h5>
    <div class="row align-items-end">
        <div class="col mb-2">
            <label for="status_psiko" class="form-label">Status Psikologi</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="status_psiko" value="{{!empty($penilaian->status_psiko) ? $penilaian->status_psiko : ''}}">
                {{-- <select class="form-select w-25" id="status_psiko"  name="status_psiko" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Status Psikologi</option> --}}
                    {{-- <option value="Tenang" >Tenang</option> --}}
                    {{-- <option value="Takut">Takut</option> --}}
                    {{-- <option value="Cemas">Cemas</option> --}}
                    {{-- <option value="Depresi">Depresi</option> --}}
                    {{-- <option value="Lain-Lain">Lain-Lain</option> --}}
                {{-- </select> --}}
                <input readonly type="text" class="form-control" id="ket_psiko" value="{{!empty($penilaian->ket_psiko) ? $penilaian->ket_psiko : ''}}">
                <input  type="text" class="form-control w-75" name="ket_psiko" id='ket_psiko' value="">
            </div>
            
        </div>
        <div class="col mb-2">
            <label for="" class="form-label">Bahasa Yang Digunakan sehari-hari</label>
            <input readonly type="text" class="form-control" id="id" value="{{!empty($penilaian->id) ? $penilaian->id : ''}}">
            
        </div>
    </div>
    <div class="row">
        <p class="text-start fs-6 m-0">Status Sosial dan Ekonomi : </p>
        <div class="row ms-4 align-items-end">
            <div class="col mb-2">
                <label for="hub_keluarga" class="form-label">Hubungan Pasien dengan Anggota Keluarga :</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="hub_keluarga" value="{{!empty($penilaian->hub_keluarga) ? $penilaian->hub_keluarga : ''}}">
                    {{-- <select class="form-select " id="hub_keluarga"  name="hub_keluarga" aria-label="Default select example"> --}}
                        {{-- <option value="-" selected>Pilih Hub Keluarga</option> --}}
                        {{-- <option value="Baik" >Baik</option> --}}
                        {{-- <option value="Tidak Baik">Tidak Baik</option> --}}
                    {{-- </select> --}}
                </div>
            </div>
            <div class="col mb-2">
                <label for="tinggal_dengan" class="form-label">Tinggal dengan : </label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="tinggal_dengan" value="{{!empty($penilaian->tinggal_dengan) ? $penilaian->tinggal_dengan : ''}}">
                    {{-- <select class="form-select " id="tinggal_dengan"  name="tinggal_dengan" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Tinggal Dengan</option> --}}
                        {{-- <option value="Sendiri" >Sendiri</option> --}}
                        {{-- <option value="Orang Tua">Orang Tua</option> --}}
                        {{-- <option value="Suami / Istri" >Suami / Istri</option> --}}
                        {{-- <option value="Lainnya">Lainnya</option> --}}
                    {{-- </select> --}}
                    <input readonly type="text" class="form-control" id="ket_tinggal" value="{{!empty($penilaian->ket_tinggal) ? $penilaian->ket_tinggal : ''}}">
                    
                </div>
            </div>
            <div class="col mb-2">
                <label for="ekonomi" class="form-label">Ekonomi :</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="ekonomi" value="{{!empty($penilaian->ekonomi) ? $penilaian->ekonomi : ''}}">
                    {{-- <select class="form-select " id="ekonomi"  name="ekonomi" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Status Ekonomi</option> --}}

                        {{-- <option value="Baik" >Baik</option> --}}
                        {{-- <option value="Cukup">Cukup</option> --}}
                        {{-- <option value="Kurang">Kurang</option> --}}
                    {{-- </select> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-end">
        <div class="col mb-2">
            <label for="budaya" class="form-label">Kepercayaan / Budaya / Nilai-nilai khusus yang perlu diperlukan :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="budaya" value="{{!empty($penilaian->budaya) ? $penilaian->budaya : ''}}">
                {{-- <select class="form-select w-25" id="budaya"  name="budaya" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Budaya</option> --}}
                    {{-- <option value="Tidak Ada" >Tidak Ada</option> --}}
                    {{-- <option value="Ada">Ada</option> --}}
                {{-- </select> --}}
                <input readonly type="text" class="form-control" id="ket_budaya" value="{{!empty($penilaian->ket_budaya) ? $penilaian->ket_budaya : ''}}">
                
            </div>
            
        </div>
        <div class="col mb-2">
            <label for="edukasi" class="form-label">Edukasi diberikan kepada : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="edukasi" value="{{!empty($penilaian->edukasi) ? $penilaian->edukasi : ''}}">
                {{-- <select class="form-select w-25" id="edukasi"  name="edukasi" aria-label="Default select example"> --}}
                {{-- <option value="-" selected>Pilih Edukasi</option> --}}

                    {{-- <option value="Pasien" >Pasien</option> --}}
                    {{-- <option value="Kelurga">Kelurga</option> --}}
                {{-- </select> --}}
                <input readonly type="text" class="form-control" id="ket_edukasi" value="{{!empty($penilaian->ket_edukasi) ? $penilaian->ket_edukasi : ''}}">
                
            </div>
            
        </div>
    </div>

    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="" class="form-label">Agama</label>
            <input readonly type="text" class="form-control" name="" id="" value="{{!empty($data_pasien->agama) ? $data_pasien->agama : ''}}">
            
        </div>
    </div>
</div>



<hr class="mb-5">
<div>
    <h5 class="text-start">VI. PENILAIAN RESIKO JATUH </h5>
    <div class="row">
        <p class="text-start fs-6 m-0">a. Cara Berjalan : </p>
        <div class="ms-4">
            <div class="row align-items-end">
                <div class="col-6 mb-2">
                    <label for="berjalan_a" class="form-label">1. Tidak Seimbang / Sempoyong / Limbung :</label>
                    <div class="d-flex">
                        <input readonly type="text" class="form-control" id="berjalan_a" value="{{!empty($penilaian->berjalan_a) ? $penilaian->berjalan_a : ''}}">
                        {{-- <select class="form-select" id="berjalan_a"  name="berjalan_a" aria-label="Default select example"> --}}
                        {{-- <option value="-" selected>Pilih Cara Berjalan</option> --}}

                            {{-- <option value="Tidak" >Tidak</option> --}}
                            {{-- <option value="Ya">Ya</option> --}}
                        {{-- </select> --}}
                    </div>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-6 mb-2">
                    <label for="berjalan_b" class="form-label">2. Jalan Dengan Menggunakan Alat Bantu (Kruk , Tripot, Kursi Roda, Orang Lain):</label>
                    <div class="d-flex">
                        <input readonly type="text" class="form-control" id="berjalan_b" value="{{!empty($penilaian->berjalan_b) ? $penilaian->berjalan_b : ''}}">
                        {{-- <select class="form-select " id="berjalan_b"  name="berjalan_b" aria-label="Default select example"> --}}
                        {{-- <option value="-" selected>Pilih Alat Bantu</option> --}}

                            {{-- <option value="Tidak" >Tidak</option> --}}
                            {{-- <option value="Ya">Ya</option> --}}
                        {{-- </select> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="berjalan_c" class="form-label">b. Menopang Saat Akan Duduk, Tampak Memegang Kursi atau Meja/ benda lagi sebagai penopang :</label>
            <input readonly type="text" class="form-control" id="berjalan_c" value="{{!empty($penilaian->berjalan_c) ? $penilaian->berjalan_c : ''}}">
            {{-- <select class="form-select " id="berjalan_c"  name="berjalan_c" aria-label="Default select example"> --}}
                {{-- <option value="-" selected>Pilih Alat Bantu</option> --}}

                {{-- <option value="Tidak" >Tidak</option> --}}
                {{-- <option value="Ya">Ya</option> --}}
            {{-- </select> --}}
        </div>
    </div>

    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="hasil" class="form-label">Hasil </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="hasil" value="{{!empty($penilaian->hasil) ? $penilaian->hasil : ''}}">
                {{-- <select class="form-select " id="hasil"  name="hasil" aria-label="Default select example"> --}}
                {{-- <option value="-" selected>Pilih Hasil</option> --}}
                    {{-- <option value="Tidak beresiko (tidak ditemukan a dan b)" >Tidak Berisiko (Tidak ditemukan a dan b) </option> --}}
                    {{-- <option value="Resiko rendah (ditemukan a/b)" >Resiko Rendah (Ditemukan a / b) </option> --}}
                    {{-- <option value="Resiko tinggi (ditemukan a dan b)" >Resiko Tinggi (Ditemukan a dan b) </option> --}}
                {{-- </select> --}}
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="lapor" class="form-label">Dilaporkan ke Dokter ? </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="lapor" value="{{!empty($penilaian->lapor) ? $penilaian->lapor : ''}}">
                {{-- <select class="form-select " id="lapor"  name="lapor" aria-label="Default select example"> --}}
                    {{-- <option value="-">Pilih </option> --}}
                    {{-- <option value="Tidak" >Tidak</option> --}}
                    {{-- <option value="Ya">Ya</option> --}}
                {{-- </select> --}}
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="ket_lapor" class="form-label">Jam Dilaporkan :</label>
            <input readonly type="text" class="form-control" id="ket_lapor" value="{{!empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : ''}}">
        </div>
    </div>
</div>


<hr class="mb-5">
<div>
    <h5 class="text-start">VII. PENILAIAN TINGKAT NYERI</h5>
    <div class="d-flex justify-content-center mb-5">
        <img src="{{asset('icon/nyeri.png')}}" width="600" alt="">
    </div>
    <div class="row">
        <div class="mb-2 ">
            <div class="row">
                <div class="col-4">
                    <label for="nyeri" class="form-label">Rasa Nyeri:</label>
                    <input readonly type="text" class="form-control" id="nyeri" value="{{!empty($penilaian->nyeri) ? $penilaian->nyeri : ''}}">
                    {{-- <select class="form-select"  id="nyeri"  name="nyeri" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Rasa Nyeri</option> --}}

                        {{-- <option value="Tidak Ada Nyeri" >Tidak Ada Nyeri</option> --}}
                        {{-- <option value="Nyeri Akut">Nyeri Akut</option> --}}
                        {{-- <option value="Nyeri Kronis">Nyeri Kronis</option> --}}
                    {{-- </select> --}}
                </div>
                <div class="col-4">
                    <label for="skala_nyeri" class="form-label">Skala Nyeri:</label>
                    <input readonly type="text" class="form-control" id="skala_nyeri" value="{{!empty($penilaian->skala_nyeri) ? $penilaian->skala_nyeri : ''}}">
                    {{-- <select class=" form-select" id="skala_nyeri"  name="skala_nyeri" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Skala Nyeri</option> --}}
                        @for($i=0; $i <=10 ;$i++)
                            {{-- <option value="{{$i}}" >{{$i}}</option> --}}
                        @endfor
                    {{-- </select> --}}
                </div>
                <div class="col-4">
                    <label for="lokasi" class="form-label">Lokasi:</label>
                    <input readonly type="text" class="form-control" id="lokasi" value="{{!empty($penilaian->lokasi) ? $penilaian->lokasi : ''}}">
                    
                </div>
            </div>
            <div class="row">
                <div class="col ">
                    <label for="durasi" class="form-label">Waktu / Durasi:</label>
                    <div class="input-group">
                        <input readonly type="text" class="form-control" id="durasi" value="{{!empty($penilaian->durasi) ? $penilaian->durasi : ''}}">
                        
                        <span class="input-group-text" id="ModalPetugas">Menit</span>
                    </div>
                </div>
                <div class="col ">
                    <label for="frekuensi" class="form-label">Frekuensi:</label>
                    <div class="input-group">
                        <input readonly type="text" class="form-control" id="frekuensi" value="{{!empty($penilaian->frekuensi) ? $penilaian->frekuensi : ''}}">
                        
                        <span class="input-group-text" id="ModalPetugas">X</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label for="nyeri_hilang" class="form-label">Nyeri Hilang Bila:</label>
                    <div class="d-flex">
                        <input readonly type="text" class="form-control" id="nyeri_hilang" value="{{!empty($penilaian->nyeri_hilang) ? $penilaian->nyeri_hilang : ''}}">
                        {{-- <select class="form-select me-2" id="nyeri_hilang"  name="nyeri_hilang" aria-label="Default select example"> --}}
                            {{-- <option value="-" selected>Pilih </option> --}}
                            {{-- <option value="Istirahat" >Istirahat</option> --}}
                            {{-- <option value="Mendengar Musik">Mendengar Musik</option> --}}
                            {{-- <option value="Minum Obat">Minum Obat</option> --}}
                            {{-- <option value="Tidak ada nyeri">Tidak ada nyeri</option> --}}
                        {{-- </select> --}}
                        <input readonly type="text" class="form-control" id="ket_nyeri" value="{{!empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : ''}}">
                        
                    </div>
                </div>
                <div class="col-8">
                    <label for="pada_dokter" class="form-label">Diberitahukan Kepada Dokter ?</label>
                    <div class="row">
                        <div class="col-4">
                            <input readonly type="text" class="form-control" id="pada_dokter" value="{{!empty($penilaian->pada_dokter) ? $penilaian->pada_dokter : ''}}">
                            {{-- <select class=" form-select" id="pada_dokter"  name="pada_dokter" aria-label="Default select example"> --}}
                            {{-- <option value="-" selected>Pilih </option> --}}

                                {{-- <option value="Tidak" >Tidak</option> --}}
                                {{-- <option value="Ya">Ya</option> --}}
                            {{-- </select> --}}
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <label for="ket_dokter" class="form-label m-0 me-2">Jam:</label>
                            <input readonly type="text" class="form-control" id="ket_dokter" value="{{!empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : ''}}">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<hr class="mb-5">
<div>
    <h5 class="text-start">VII. PENILAIAN INTRAORAL</h5>
    <div class="row">
        <div class="col">
            <label for="kebersihan_mulut" class="form-label">Kebersihan Mulut :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="kebersihan_mulut" value="{{!empty($penilaian->kebersihan_mulut) ? $penilaian->kebersihan_mulut : ''}}">
                {{-- <select class="form-select " id="kebersihan_mulut"  name="kebersihan_mulut" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Status</option> --}}
                    {{-- <option value="Baik" >Baik</option> --}}
                    {{-- <option value="Cukup">Cukup</option> --}}
                    {{-- <option value="Kurang">Kurang</option> --}}
                {{-- </select> --}}
            </div>
        </div>
        <div class="col">
            <label for="karies" class="form-label">Karies :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="karies" value="{{!empty($penilaian->karies) ? $penilaian->karies : ''}}">
                {{-- <select class="form-select " id="karies"  name="karies" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Status</option> --}}
                    {{-- <option value="Baik" >Baik</option> --}}
                    {{-- <option value="Cukup">Cukup</option> --}}
                    {{-- <option value="Kurang">Kurang</option> --}}
                {{-- </select> --}}
            </div>
        </div>
        <div class="col">
            <label for="gingiva" class="form-label">Gingiva :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="gingiva" value="{{!empty($penilaian->gingiva) ? $penilaian->gingiva : ''}}">
                {{-- <select class="form-select " id="gingiva"  name="gingiva" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Status</option> --}}
                    {{-- <option value="Normal" >Normal</option> --}}
                    {{-- <option value="Radang">Radang</option> --}}
                {{-- </select> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="mukosa_mulut" class="form-label">Mukosa Mulut :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="mukosa_mulut" value="{{!empty($penilaian->mukosa_mulut) ? $penilaian->mukosa_mulut : ''}}">
                {{-- <select class="form-select " id="mukosa_mulut"  name="mukosa_mulut" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Status</option> --}}
                    {{-- <option value="Normal" >Normal</option> --}}
                    {{-- <option value="Pigmentasi">Pigmentasi</option> --}}
                    {{-- <option value="Radang">Radang</option> --}}
                {{-- </select> --}}
            </div>
        </div>
        <div class="col">
            <label for="karang_gigi" class="form-label">Karang Gigi :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="karang_gigi" value="{{!empty($penilaian->karang_gigi) ? $penilaian->karang_gigi : ''}}">
                {{-- <select class="form-select " id="karang_gigi"  name="karang_gigi" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Status</option> --}}
                    {{-- <option value="Ada" >Ada</option> --}}
                    {{-- <option value="Tidak">Tidak</option> --}}
                {{-- </select> --}}
            </div>
        </div>
        <div class="col">
            <label for="palatum" class="form-label">Palatum :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="palatum" value="{{!empty($penilaian->palatum) ? $penilaian->palatum : ''}}">
                {{-- <select class="form-select " id="palatum"  name="palatum" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Status</option> --}}
                    {{-- <option value="Normal" >Normal</option> --}}
                    {{-- <option value="Radang">Radang</option> --}}
                {{-- </select> --}}
            </div>
        </div>
    </div>
</div>


<hr class="mb-5">
<div>
    

    <div class="row">

        <div class="col-6  border-end" style="height:400px">
            <h5 class="text-center">MASALAH KEPERAWATAN</h5>
            <hr class="mb-2">
            <div class="overflow-auto h-75 alternate_child_color  px-3" >
                    @foreach($masalah as $v)
                        <div class="form-check d-flex justify-content-between mb-2 align-items-center">
                            <div>
                                {{$v->kode_masalah}}
                            </div>
                            <div>
                                {{$v->nama_masalah}}
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
        <div class="col-6 " >
            <h5 class="text-center">RENCANA KEPERAWATAN</h5>
            <hr class="mb-2">
            <div class="overflow-auto h-75 alternate_child_color  px-3" >
                <div class="mb-3">
                    <label for="rencana" class="form-label">Rencana Keperawatan</label>
                    <textarea  readonly class="form-control" id="rencana" name="rencana" rows="5">{{!empty($penilaian->rencana) ? $penilaian->rencana : ''}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
