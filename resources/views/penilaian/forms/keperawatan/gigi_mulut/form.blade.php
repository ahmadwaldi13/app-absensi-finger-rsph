
<form action="{{url('/penilaian-perawat-gigi/update')}}" method="post" id="penilaian_perawat_gigi">
    @csrf
    <div class="row mb-3">
        @include('penilaian.form_header', [
            "pj_form_type"=>"petugas",
            "nama_pj" => $penilaian->nama,
            "kode_pj" => $penilaian->nip,
            "readonly" => true
        ])
        <div class="col mb-2">
            <label for="tanggal" class="form-label">Tanggal : </label>
            <input  readonly type="text" class="form-control input-daterange input-date-time" name="tanggal" value="{{!empty($penilaian->tanggal) ? $penilaian->tanggal : ''}}" id="tanggal"  required autocomplete="off">
        </div>
        <div class="col mb-2">
            <label for="informasi" class="form-label">Informasi didapat dari : </label>
            <select class="form-select" id="informasi" readonly name="informasi" value="{{$penilaian->informasi}}" aria-label="Default select ">
                <option value="-" {{$penilaian->informasi === "-" ? 'selected' : ''}}>Pilih Informasi</option>
                <option value="Autoanamnesis" {{$penilaian->informasi === 'Autoanamnesis' ? 'selected' : '' }} >Autoanamnesis</option>
                <option value="Alloanamnesis" {{$penilaian->informasi === 'Alloanamnesis' ? 'selected' : ''}} >Alloanamnesis</option>
            </select>
        </div>
    </div>
    <hr class="mb-5">

    <div>
        <h5 class="text-start">I. KEADAAN UMUM</h5>
        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="td" class="form-label">TD : </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="td" name="td" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}">
                    <span class="input-group-text" id="ModalPetugas">mmHg</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="nadi" class="form-label">Nadi : </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="nadi" name="nadi" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}">
                    <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="rr" class="form-label">RR : </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="rr" name="rr" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}">

                    <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="suhu" class="form-label">Suhu : </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="suhu" name="suhu" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}">

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
                    <input type="text" class="form-control" id="bb" name="bb" value="{{!empty($penilaian->bb) ? $penilaian->bb : ''}}">

                    <span class="input-group-text" id="ModalPetugas">Kg</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="tb" class="form-label">TB : </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="tb" name="tb" value="{{!empty($penilaian->tb) ? $penilaian->tb : ''}}">

                    <span class="input-group-text" id="ModalPetugas">cm</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="bmi" class="form-label">BMI : </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="bmi" name="bmi" value="{{!empty($penilaian->bmi) ? $penilaian->bmi : ''}}">

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

                    <input type="text" class="form-control" id="alergi" name="alergi" value="{{!empty($penilaian->alergi) ? $penilaian->alergi : ''}}">

                </div>
                <div class="row">
                    <label for="kebiasaan_sikat_gigi" class="form-label">Kebiasaan Sikat Gigi : </label>
                    <select class="form-select" id="kebiasaan_sikat_gigi" name="kebiasaan_sikat_gigi" aria-label="Default select ">
                        <option value="-" {{$penilaian->kebiasaan_sikat_gigi === "-" ? 'selected' : ''}} >Pilih Kebiasaan</option>
                        <option value="1x" {{$penilaian->kebiasaan_sikat_gigi === "1x" ? 'selected' : ''}} >1x</option>
                        <option value="2x" {{$penilaian->kebiasaan_sikat_gigi === "2x" ? 'selected' : ''}}>2x</option>
                        <option value="3x" {{$penilaian->kebiasaan_sikat_gigi === "3x" ? 'selected' : ''}} >3x</option>
                        <option value="Mandi" {{$penilaian->kebiasaan_sikat_gigi === "Mandi" ? 'selected' : ''}}>Mandi</option>
                        <option value="Setelah Makan" {{$penilaian->kebiasaan_sikat_gigi === "Setelah Makan" ? 'selected' : ''}} >Setelah Makan</option>
                        <option value="Sebelum Tidur" {{$penilaian->kebiasaan_sikat_gigi === "Sebelum Tidur" ? 'selected' : ''}} >Sebelum Tidur</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit:</label>
                    <div class="d-flex">
                        <select class="form-select w-50" id="riwayat_penyakit"  name="riwayat_penyakit" aria-label="Default select example">
                            <option value="-" {{$penilaian->riwayat_penyakit === "-" ? 'selected' : ''}} >Pilih status</option>
                            <option value="Tidak Ada" {{$penilaian->riwayat_penyakit === "Tidak Ada" ? 'selected' : ''}} >Tidak Ada</option>
                            <option value="Diabetes Melitus" {{$penilaian->riwayat_penyakit === "Diabetes Melitus" ? 'selected' : ''}} >Diabetes Melitus</option>
                            <option value="Hipertensi" {{$penilaian->riwayat_penyakit === "Hipertensi" ? 'selected' : ''}} >Hipertensi</option>
                            <option value="Penyakit Jantung" {{$penilaian->riwayat_penyakit === "Penyakit Jantung" ? 'selected' : ''}} >Penyakit Jantung</option>
                            <option value="HIV" {{$penilaian->riwayat_penyakit === "HIV" ? 'selected' : ''}} >HIV</option>
                            <option value="Hepatitis" {{$penilaian->riwayat_penyakit === "Hepatitis" ? 'selected' : ''}} >Hepatitis</option>
                            <option value="Haemophilia" {{$penilaian->riwayat_penyakit === "Haemophilia" ? 'selected' : ''}} >Haemophilia</option>
                            <option value="Lain-lain" {{$penilaian->riwayat_penyakit === "Lain-lain" ? 'selected' : ''}} >Lain-lain</option>
                        </select>
                        <input type="text" class="form-control" id="ket_riwayat_penyakit" name="ket_riwayat_penyakit" value="{{!empty($penilaian->ket_riwayat_penyakit) ? $penilaian->ket_riwayat_penyakit : ''}}">

                    </div>
                </div>
                <div class="row">
                    <label for="riwayat_perawatan_gigi" class="form-label">Riwayat Perawatan Gigi:</label>
                    <div class="d-flex">
                        <select class="form-select w-50" id="riwayat_perawatan_gigi"  name="riwayat_perawatan_gigi" aria-label="Default select example">
                            <option value="-" {{$penilaian->riwayat_perawatan_gigi === "-" ? 'selected' : ''}} >Pilih status</option>
                            <option value="Tidak Ada" {{$penilaian->riwayat_perawatan_gigi === "Tidak Ada" ? 'selected' : ''}} >Tidak Ada</option>
                            <option value="Ya, Kapan" {{$penilaian->riwayat_perawatan_gigi === "Ya, Kapan" ? 'selected' : ''}}>Ya, Kapan</option>
                        </select>
                        <input type="text" class="form-control" id="ket_riwayat_perawatan_gigi" name="ket_riwayat_perawatan_gigi" value="{{!empty($penilaian->ket_riwayat_perawatan_gigi) ? $penilaian->ket_riwayat_perawatan_gigi : ''}}">

                    </div>
                </div>
                <div class="row">
                    <label for="kebiasaan_lain" class="form-label">Kebiasaan Lain:</label>
                    <div class="d-flex">
                        <select class="form-select w-50" id="kebiasaan_lain"  name="kebiasaan_lain" aria-label="Default select example">
                            <option value="-" {{$penilaian->kebiasaan_lain === "-" ? 'selected' : ''}} >Pilih status</option>
                            <option value="Tidak Ada" {{$penilaian->kebiasaan_lain === "Tidak Ada" ? 'selected' : ''}} >Tidak Ada</option>
                            <option value="Minum kopi/teh" {{$penilaian->kebiasaan_lain === "Minum kopi/teh" ? 'selected' : ''}} >Minum kopi/teh</option>
                            <option value="Minum alkohol" {{$penilaian->kebiasaan_lain === "Minum alkohol" ? 'selected' : ''}} >Minum alkohol</option>
                            <option value="Bruxism" {{$penilaian->kebiasaan_lain === "Bruxism" ? 'selected' : ''}} >Bruxism</option>
                            <option value="Menggigit pensil" {{$penilaian->kebiasaan_lain === "Menggigit pensil" ? 'selected' : ''}} >Menggigit pensil</option>
                            <option value="Menguyah 1 sisi rahang" {{$penilaian->kebiasaan_lain === "Menguyah 1 sisi rahang" ? 'selected' : ''}} >Menguyah 1 sisi rahang</option>
                            <option value="Merokok" {{$penilaian->kebiasaan_lain === "Merokok" ? 'selected' : ''}} >Merokok</option>
                            <option value="Lain-lain" {{$penilaian->kebiasaan_lain === "Lain-lain" ? 'selected' : ''}} >Lain-lain</option>
                        </select>
                        <input type="text" class="form-control" id="ket_kebiasaan_lain" name="ket_kebiasaan_lain" value="{{!empty($penilaian->ket_kebiasaan_lain) ? $penilaian->ket_kebiasaan_lain : ''}}">

                    </div>
                </div>
                <div class="row">
                    <label for="obat_yang_diminum_saatini" class="form-label">Obat Yang Diminum Saat ini:</label>
                    <input type="text" class="form-control" id="obat_yang_diminum_saatini" name="obat_yang_diminum_saatini" value="{{!empty($penilaian->obat_yang_diminum_saatini) ? $penilaian->obat_yang_diminum_saatini : ''}}">

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
                    <select class="form-select w-50" id="alat_bantu"  name="alat_bantu" aria-label="Default select example">
                        <option value="-" {{$penilaian->alat_bantu === "-" ? 'selected' : ''}} >Pilih Alat Bantu</option>
                        <option value="Tidak" {{$penilaian->alat_bantu === "Tidak" ? 'selected' : ''}} >Tidak</option>
                        <option value="Ya" {{$penilaian->alat_bantu === "Ya" ? 'selected' : ''}}>Ya</option>
                    </select>
                    <input type="text" class="form-control" id="ket_alat_bantu" name="ket_alat_bantu" value="{{!empty($penilaian->ket_alat_bantu) ? $penilaian->ket_alat_bantu : ''}}">

                </div>

            </div>
            <div class="col mb-2">
                <label for="prothesa" class="form-label">Prothesa</label>
                <div class="d-flex">
                    <select class="form-select w-50" id="prothesa"  name="prothesa" aria-label="Default select example">
                        <option value="-" {{$penilaian->prothesa === "-" ? 'selected' : ''}} >Pilih Prothesa</option>
                        <option value="Tidak" {{$penilaian->prothesa === "Tidak" ? 'selected' : ''}} >Tidak</option>
                        <option value="Ya" {{$penilaian->prothesa === "Ya" ? 'selected' : ''}}>Ya</option>
                    </select>
                    <input type="text" class="form-control" id="ket_pro" name="ket_pro" value="{{!empty($penilaian->ket_pro) ? $penilaian->ket_pro : ''}}">

                </div>

            </div>
        </div>

        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="cacat_fisik" class="form-label">Cacat Fisik</label>
                <input type="text" class="form-control" id="value" value="-">

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
                    <select class="form-select w-50" id="status_psiko"  name="status_psiko" aria-label="Default select example">
                        <option value="-" {{$penilaian->status_psiko === "-" ? 'selected' : ''}} >Pilih Status Psikologi</option>
                        <option value="Tenang" {{$penilaian->status_psiko === "Tenang" ? 'selected' : ''}} >Tenang</option>
                        <option value="Takut" {{$penilaian->status_psiko === "Takut" ? 'selected' : ''}}>Takut</option>
                        <option value="Cemas" {{$penilaian->status_psiko === "Cemas" ? 'selected' : ''}}>Cemas</option>
                        <option value="Depresi" {{$penilaian->status_psiko === "Depresi" ? 'selected' : ''}}>Depresi</option>
                        <option value="Lain-Lain" {{$penilaian->status_psiko === "Lain-Lain" ? 'selected' : ''}}>Lain-Lain</option>
                    </select>
                    <input type="text" class="form-control w-75" id="ket_psiko" name="ket_psiko" value="{{!empty($penilaian->ket_psiko) ? $penilaian->ket_psiko : ''}}">
                </div>

            </div>
            <div class="col mb-2">
                <label for="" class="form-label">Bahasa Yang Digunakan sehari-hari</label>
                <input type="text" class="form-control" name="" id="" value="{{!empty($data_pasien->nama_bahasa) ? $data_pasien->nama_bahasa : ''}}" readonly>

            </div>
        </div>
        <div class="row">
            <p class="text-start fs-6 m-0">Status Sosial dan Ekonomi : </p>
            <div class="row ms-4 align-items-end">
                <div class="col mb-2">
                    <label for="hub_keluarga" class="form-label">Hubungan Pasien dengan Anggota Keluarga :</label>
                    <div class="d-flex">
                        <select class="form-select " i50hub_keluarga"  name="hub_keluarga" aria-label="Default select example">
                            <option value="-" {{$penilaian->hub_keluarga === "-" ? 'selected' : ''}} >Pilih Hub Keluarga</option>
                            <option value="Baik" {{$penilaian->hub_keluarga === "Baik" ? 'selected' : ''}} >Baik</option>
                            <option value="Tidak Baik" {{$penilaian->hub_keluarga === "Tidak Baik" ? 'selected' : ''}}>Tidak Baik</option>
                        </select>
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="tinggal_dengan" class="form-label">Tinggal dengan : </label>
                    <div class="d-flex">
                        <select class="form-select " i50tinggal_dengan"  name="tinggal_dengan" aria-label="Default select example">
                        <option value="-" {{$penilaian->tinggal_dengan === "-" ? 'selected' : ''}} >Pilih Tinggal Dengan</option>
                            <option value="Sendiri" {{$penilaian->tinggal_dengan === "Sendiri" ? 'selected' : ''}} >Sendiri</option>
                            <option value="Orang Tua" {{$penilaian->tinggal_dengan === "Orang Tua" ? 'selected' : ''}}>Orang Tua</option>
                            <option value="Suami / Istri" {{$penilaian->tinggal_dengan === "Suami / Istri" ? 'selected' : ''}} >Suami / Istri</option>
                            <option value="Lainnya" {{$penilaian->tinggal_dengan === "Lainnya" ? 'selected' : ''}}>Lainnya</option>
                        </select>
                        <input type="text" class="form-control" id="ket_tinggal" name="ket_tinggal" value="{{!empty($penilaian->ket_tinggal) ? $penilaian->ket_tinggal : ''}}">

                    </div>
                </div>
                <div class="col mb-2">
                    <label for="ekonomi" class="form-label">Ekonomi :</label>
                    <div class="d-flex">
                        <select class="form-select " i50ekonomi"  name="ekonomi" aria-label="Default select example">
                        <option value="-" {{$penilaian->ekonomi === "-" ? 'selected' : ''}} >Pilih Status Ekonomi</option>

                            <option value="Baik" {{$penilaian->ekonomi === "Baik" ? 'selected' : ''}} >Baik</option>
                            <option value="Cukup" {{$penilaian->ekonomi === "Cukup" ? 'selected' : ''}}>Cukup</option>
                            <option value="Kurang" {{$penilaian->ekonomi === "Kurang" ? 'selected' : ''}}>Kurang</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="budaya" class="form-label">Kepercayaan / Budaya / Nilai-nilai khusus yang perlu diperlukan :</label>
                <div class="d-flex">
                    <select class="form-select w-50" id="budaya"  name="budaya" aria-label="Default select example">
                        <option value="-" {{$penilaian->budaya === "-" ? 'selected' : ''}} >Pilih Budaya</option>
                        <option value="Tidak Ada" {{$penilaian->budaya === "Tidak Ada" ? 'selected' : ''}} >Tidak Ada</option>
                        <option value="Ada" {{$penilaian->budaya === "Ada" ? 'selected' : ''}}>Ada</option>
                    </select>
                    <input type="text" class="form-control" id="ket_budaya" name="ket_budaya" value="{{!empty($penilaian->ket_budaya) ? $penilaian->ket_budaya : ''}}">

                </div>

            </div>
            <div class="col mb-2">
                <label for="edukasi" class="form-label">Edukasi diberikan kepada : </label>
                <div class="d-flex">
                    <select class="form-select w-50" id="edukasi"  name="edukasi" aria-label="Default select example">
                    <option value="-" {{$penilaian->edukasi === "-" ? 'selected' : ''}} >Pilih Edukasi</option>

                        <option value="Pasien" {{$penilaian->edukasi === "Pasien" ? 'selected' : ''}} >Pasien</option>
                        <option value="Kelurga" {{$penilaian->edukasi === "Kelurga" ? 'selected' : ''}}>Kelurga</option>
                    </select>
                    <input type="text" class="form-control" id="ket_edukasi" name="ket_edukasi" value="{{!empty($penilaian->ket_edukasi) ? $penilaian->ket_edukasi : ''}}">

                </div>

            </div>
        </div>

        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="" class="form-label">Agama</label>
                <input readonly type="text" class="form-control"  id="" value="{{!empty($data_pasien->agama) ? $data_pasien->agama : ''}}" >

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
                            <select class="form-select" id="berjalan_a"  name="berjalan_a" aria-label="Default select example">
                            <option value="-" {{$penilaian->berjalan_a === "-" ? 'selected' : ''}} >Pilih Cara Berjalan</option>

                                <option value="Tidak" {{$penilaian->berjalan_a === "Tidak" ? 'selected' : ''}} >Tidak</option>
                                <option value="Ya" {{$penilaian->berjalan_a === "Ya" ? 'selected' : ''}}>Ya</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col-6 mb-2">
                        <label for="berjalan_b" class="form-label">2. Jalan Dengan Menggunakan Alat Bantu (Kruk , Tripot, Kursi Roda, Orang Lain):</label>
                        <div class="d-flex">
                            <select class="form-select " id="berjalan_b"  name="berjalan_b" aria-label="Default select example">
                            <option value="-" {{$penilaian->berjalan_b === "-" ? 'selected' : ''}} >Pilih Alat Bantu</option>

                                <option value="Tidak" {{$penilaian->berjalan_b === "Tidak" ? 'selected' : ''}} >Tidak</option>
                                <option value="Ya" {{$penilaian->berjalan_b === "Ya" ? 'selected' : ''}}>Ya</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="berjalan_c" class="form-label">b. Menopang Saat Akan Duduk, Tampak Memegang Kursi atau Meja/ benda lagi sebagai penopang :</label>
                <select class="form-select " id="berjalan_c"  name="berjalan_c" aria-label="Default select example">
                    <option value="-" {{$penilaian->berjalan_c === "-" ? 'selected' : ''}} >Pilih Alat Bantu</option>

                    <option value="Tidak" {{$penilaian->berjalan_c === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->berjalan_c === "Ya" ? 'selected' : ''}}>Ya</option>
                </select>
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="hasil" class="form-label">Hasil </label>
                <div class="d-flex">
                    <select class="form-select " id="hasil"  name="hasil" aria-label="Default select example">
                    <option value="-" {{$penilaian->hasil === "-" ? 'selected' : ''}} >Pilih Hasil</option>
                        <option value="Tidak beresiko (tidak ditemukan a dan b)" {{$penilaian->hasil === "Tidak beresiko (tidak ditemukan a dan b)" ? 'selected' : ''}} >Tidak Berisiko (Tidak ditemukan a dan b) </option>
                        <option value="Resiko rendah (ditemukan a/b)" {{$penilaian->hasil === "Resiko rendah (ditemukan a/b)" ? 'selected' : ''}} >Resiko Rendah (Ditemukan a / b) </option>
                        <option value="Resiko tinggi (ditemukan a dan b)" {{$penilaian->hasil === "Resiko tinggi (ditemukan a dan b)" ? 'selected' : ''}} >Resiko Tinggi (Ditemukan a dan b) </option>
                    </select>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="lapor" class="form-label">Dilaporkan ke Dokter ? </label>
                <div class="d-flex">
                    <select class="form-select " id="lapor"  name="lapor" aria-label="Default select example">
                        <option value="-" {{$penilaian->lapor === "-" ? 'selected' : ''}}>Pilih </option>
                        <option value="Tidak" {{$penilaian->lapor === "Tidak" ? 'selected' : ''}} >Tidak</option>
                        <option value="Ya" {{$penilaian->lapor === "Ya" ? 'selected' : ''}}>Ya</option>
                    </select>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="ket_lapor" class="form-label">Jam Dilaporkan :</label>
                <input type="text" class="form-control" id="ket_lapor" name="ket_lapor" value="{{!empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : ''}}">
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
                        <select class="form-select"  id="nyeri"  name="nyeri" aria-label="Default select example">
                        <option value="-" {{$penilaian->nyeri === "-" ? 'selected' : ''}} >Pilih Rasa Nyeri</option>

                            <option value="Tidak Ada Nyeri" {{$penilaian->nyeri === "Tidak Ada Nyeri" ? 'selected' : ''}} >Tidak Ada Nyeri</option>
                            <option value="Nyeri Akut" {{$penilaian->nyeri === "Nyeri Akut" ? 'selected' : ''}}>Nyeri Akut</option>
                            <option value="Nyeri Kronis" {{$penilaian->nyeri === "Nyeri Kronis" ? 'selected' : ''}}>Nyeri Kronis</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="skala_nyeri" class="form-label">Skala Nyeri:</label>
                        <select class=" form-select" id="skala_nyeri"  name="skala_nyeri" aria-label="Default select example">
                        <option value="-" {{$penilaian->skala_nyeri === "-" ? 'selected' : ''}} >Pilih Skala Nyeri</option>
                            @for($i=0; $i <=10 ;$i++)
                                <option value="{{$i}}" {{$penilaian->skala_nyeri === "$i" ? 'selected' : ''}} >{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="lokasi" class="form-label">Lokasi:</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{!empty($penilaian->lokasi) ? $penilaian->lokasi : ''}}">

                    </div>
                </div>
                <div class="row">
                    <div class="col ">
                        <label for="durasi" class="form-label">Waktu / Durasi:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="durasi" name="durasi" value="{{!empty($penilaian->durasi) ? $penilaian->durasi : ''}}">

                            <span class="input-group-text" id="ModalPetugas">Menit</span>
                        </div>
                    </div>
                    <div class="col ">
                        <label for="frekuensi" class="form-label">Frekuensi:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="frekuensi" name="frekuensi" value="{{!empty($penilaian->frekuensi) ? $penilaian->frekuensi : ''}}">

                            <span class="input-group-text" id="ModalPetugas">X</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label for="nyeri_hilang" class="form-label">Nyeri Hilang Bila:</label>
                        <div class="d-flex">
                            <select class="form-select me-2" id="nyeri_hilang"  name="nyeri_hilang" aria-label="Default select example">
                                <option value="-" {{$penilaian->nyeri_hilang === "-" ? 'selected' : ''}} >Pilih </option>
                                <option value="Istirahat" {{$penilaian->nyeri_hilang === "Istirahat" ? 'selected' : ''}} >Istirahat</option>
                                <option value="Mendengar Musik" {{$penilaian->nyeri_hilang === "Mendengar Musik" ? 'selected' : ''}}>Mendengar Musik</option>
                                <option value="Minum Obat" {{$penilaian->nyeri_hilang === "Minum Obat" ? 'selected' : ''}}>Minum Obat</option>
                                <option value="Tidak ada nyeri" {{$penilaian->nyeri_hilang === "Tidak ada nyeri" ? 'selected' : ''}}>Tidak ada nyeri</option>
                            </select>
                            <input type="text" class="form-control" id="ket_nyeri" name="ket_nyeri" value="{{!empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : ''}}">

                        </div>
                    </div>
                    <div class="col-8">
                        <label for="pada_dokter" class="form-label">Diberitahukan Kepada Dokter ?</label>
                        <div class="row">
                            <div class="col-4">
                                <select class=" form-select" id="pada_dokter"  name="pada_dokter" aria-label="Default select example">
                                <option value="-" {{$penilaian->pada_dokter === "-" ? 'selected' : ''}} >Pilih </option>

                                    <option value="Tidak" {{$penilaian->pada_dokter === "Tidak" ? 'selected' : ''}} >Tidak</option>
                                    <option value="Ya" {{$penilaian->pada_dokter === "Ya" ? 'selected' : ''}}>Ya</option>
                                </select>
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <label for="ket_dokter" class="form-label m-0 me-2">Jam:</label>
                                <input type="text" class="form-control" id="ket_dokter" name="ket_dokter" value="{{!empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : ''}}">

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
                    <select class="form-select " id="kebersihan_mulut"  name="kebersihan_mulut" aria-label="Default select example">
                        <option value="-" {{$penilaian->kebersihan_mulut === "-" ? 'selected' : ''}} >Pilih Status</option>
                        <option value="Baik" {{$penilaian->kebersihan_mulut === "Baik" ? 'selected' : ''}} >Baik</option>
                        <option value="Cukup" {{$penilaian->kebersihan_mulut === "Cukup" ? 'selected' : ''}}>Cukup</option>
                        <option value="Kurang" {{$penilaian->kebersihan_mulut === "Kurang" ? 'selected' : ''}}>Kurang</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <label for="karies" class="form-label">Karies :</label>
                <div class="d-flex">
                    <select class="form-select " id="karies"  name="karies" aria-label="Default select example">
                        <option value="-" {{$penilaian->karies === "-" ? 'selected' : ''}} >Pilih Status</option>
                        <option value="Baik" {{$penilaian->karies === "Baik" ? 'selected' : ''}} >Baik</option>
                        <option value="Cukup" {{$penilaian->karies === "Cukup" ? 'selected' : ''}}>Cukup</option>
                        <option value="Kurang" {{$penilaian->karies === "Kurang" ? 'selected' : ''}}>Kurang</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <label for="gingiva" class="form-label">Gingiva :</label>
                <div class="d-flex">
                    <select class="form-select " id="gingiva"  name="gingiva" aria-label="Default select example">
                        <option value="-" {{$penilaian->gingiva === "-" ? 'selected' : ''}} >Pilih Status</option>
                        <option value="Normal" {{$penilaian->gingiva === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Radang" {{$penilaian->gingiva === "Radang" ? 'selected' : ''}}>Radang</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="mukosa_mulut" class="form-label">Mukosa Mulut :</label>
                <div class="d-flex">
                    <select class="form-select " id="mukosa_mulut"  name="mukosa_mulut" aria-label="Default select example">
                        <option value="-" {{$penilaian->mukosa_mulut === "-" ? 'selected' : ''}} >Pilih Status</option>
                        <option value="Normal" {{$penilaian->mukosa_mulut === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Pigmentasi" {{$penilaian->mukosa_mulut === "Pigmentasi" ? 'selected' : ''}}>Pigmentasi</option>
                        <option value="Radang" {{$penilaian->mukosa_mulut === "Radang" ? 'selected' : ''}}>Radang</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <label for="karang_gigi" class="form-label">Karang Gigi :</label>
                <div class="d-flex">
                    <select class="form-select " id="karang_gigi"  name="karang_gigi" aria-label="Default select example">
                        <option value="-" {{$penilaian->karang_gigi === "-" ? 'selected' : ''}} >Pilih Status</option>
                        <option value="Ada" {{$penilaian->karang_gigi === "Ada" ? 'selected' : ''}} >Ada</option>
                        <option value="Tidak" {{$penilaian->karang_gigi === "Tidak" ? 'selected' : ''}}>Tidak</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <label for="palatum" class="form-label">Palatum :</label>
                <div class="d-flex">
                    <select class="form-select " id="palatum"  name="palatum" aria-label="Default select example">
                        <option value="-" {{$penilaian->palatum === "-" ? 'selected' : ''}} >Pilih Status</option>
                        <option value="Normal" {{$penilaian->palatum === "Normal" ? 'selected' : ''}} >Normal</option>
                        <option value="Radang" {{$penilaian->palatum === "Radang" ? 'selected' : ''}}>Radang</option>
                    </select>
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
                        @php
                            function getKodeMasalah($v){ return $v->kode_masalah; }
                            $masalah = array_map("getKodeMasalah", $masalah);
                        @endphp
                        @foreach($master_masalah as $v)
                            <div class="form-check d-flex justify-content-between mb-2 align-items-center">
                                <input {{in_array($v->kode_masalah, (array)$masalah) ? 'checked' : ''}} class="form-check-input" type="checkbox" value="{{$v->kode_masalah}}" id="m_{{$v->kode_masalah}}" name="mslh_{{$v->kode_masalah}}">
                                <label class="form-check-label  w-100 text-end" for="m_{{$v->kode_masalah}}" >
                                    {{$v->nama_masalah}}
                                </label>
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
                        <textarea  class="form-control" id="rencana" name="rencana" rows="5">{{!empty($penilaian->rencana) ? $penilaian->rencana : ''}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
