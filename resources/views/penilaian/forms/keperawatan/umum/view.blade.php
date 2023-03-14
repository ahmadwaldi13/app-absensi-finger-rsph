<div>
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
                    <input readonly type="text" name="td" value="{{$penilaian->td}}" id="td" class="form-control">
                    <span class="input-group-text" >mmHg</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="nadi" class="form-label">Nadi : </label>
                <div class="input-group">
                    <input readonly type="text" id="nadi" name="nadi" value="{{$penilaian->nadi}}" class="form-control">
                    <span class="input-group-text" >x / Menit</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="rr" class="form-label">RR : </label>
                <div class="input-group">
                    <input readonly type="text" id="rr" name="rr" value="{{$penilaian->rr}}" class="form-control">
                    <span class="input-group-text" >x / Menit</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="suhu" class="form-label">Suhu : </label>
                <div class="input-group">
                    <input readonly type="text" id="suhu" name="suhu" value="{{$penilaian->suhu}}" class="form-control">
                    <span class="input-group-text" >&#8451;</span>
                </div>
            </div>
    
            <div class="col mb-2">
                <label for="gcs" class="form-label">GCS(E, V, M) : </label>
                <div class="input-group">
                    <input readonly type="text" id="gcs" name="gcs" value="{{$penilaian->gcs}}" class="form-control">
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
                    <input readonly type="text" id="bb" name="bb" value="{{$penilaian->bb}}" class="form-control">
                    <span class="input-group-text" >Kg</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="tb" class="form-label">TB : </label>
                <div class="input-group">
                    <input readonly type="text" id="tb" name="tb" value="{{$penilaian->tb}}" class="form-control">
                    <span class="input-group-text" >cm</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="bmi" class="form-label">BMI : </label>
                <div class="input-group">
                    <input readonly type="text" id="bmi" name="bmi" value="{{$penilaian->bmi}}" class="form-control">
                    <span class="input-group-text" >Kg / m&#178;</span>
                </div>
            </div>
    
        </div>
    </div>
    
    <hr class="mb-5">
    <div>
        <h5 class="text-start">III. RIWAYAT KESEHATAN</h5>
        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="keluhan_utama" class="form-label">Keluhan Utama</label>
                <textarea readonly class="form-control" id="keluhan_utama" name="keluhan_utama" value="{{$penilaian->keluhan_utama}}" rows="3">{{$penilaian->keluhan_utama}}</textarea>
            </div>
            <div class="col mb-2">
                <label for="rpk" class="form-label">Riwayat Penyakit Keluarga</label>
                <textarea readonly class="form-control" id="rpk" name="rpk" value="{{$penilaian->rpk}}" rows="3">{{$penilaian->rpk}}</textarea>
            </div>
        </div>
        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
                <textarea readonly class="form-control" id="rpd" name="rpd" value="{{$penilaian->rpd}}" rows="3">{{$penilaian->rpd}}</textarea>
            </div>
            <div class="col mb-2">
                <label for="rpo" class="form-label">Riwayat Pengobatan</label>
                <textarea readonly class="form-control" id="rpo" name="rpo" value="{{$penilaian->rpo}}" rows="3">{{$penilaian->rpo}}</textarea>
            </div>
        </div>
        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="alergi" class="form-label">Riwayat Alergi</label>
                <input readonly type="text" class="form-control" name="alergi" value="{{$penilaian->alergi}}" id='alergi' >
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
                    <input readonly type="text" class="form-control" id="alat_bantu" value="{{$penilaian->alat_bantu}}">
                    {{-- <select class="form-select w-25" id="alat_bantu"  name="alat_bantu" value="{{$penilaian->alat_bantu}}" aria-label="Default select example">
                        <option value="-" selected>Pilih Alat Bantu</option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ya">Ya</option>
                    </select> --}}
                    <input readonly type="text" class="form-control w-75" name="ket_bantu" value="{{$penilaian->ket_bantu}}" id='ket_bantu' >
                </div>
                
            </div>
            <div class="col mb-2">
                <label for="prothesa" class="form-label">Prothesa</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="prothesa" value="{{$penilaian->prothesa}}">
                    {{-- <select class="form-select w-25" id="prothesa"  name="prothesa" value="{{$penilaian->prothesa}}" aria-label="Default select example">
                        <option value="-" selected>Pilih Prothesa</option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ya">Ya</option>
                    </select> --}}
                    <input readonly type="text" class="form-control w-75" name="ket_pro" value="{{$penilaian->ket_pro}}" id='ket_pro' >
                </div>
                
            </div>
        </div>
    
        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="cacat_fisik" class="form-label">Cacat Fisik</label>
                <input readonly type="text" class="form-control" id="cacat_fisik"  name="" >
            </div>
            <div class="col-6 mb-2">
                <label for="adl" class="form-label">Aktivitas Kehidupan Sehari-hari (ADL)</label>
                <input readonly type="text" class="form-control" id="adl" value="{{$penilaian->adl}}">
                {{-- <select class="form-select" id="adl"  name="adl" value="{{$penilaian->adl}}" aria-label="Default select example">
                    <option value="-">Pilih Aktivitas</option>
    
                    <option value="Mandiri" >Mandiri</option>
                    <option value="Dibantu">Dibantu</option>
                </select> --}}
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
                    <input readonly type="text" class="form-control" id="status_psiko" value="{{$penilaian->status_psiko}}">
                    {{-- <select class="form-select w-25" id="status_psiko"  name="status_psiko" value="{{$penilaian->status_psiko}}" aria-label="Default select example">
                        <option value="-" selected>Pilih Status Psikologi</option>
                        <option value="Tenang" >Tenang</option>
                        <option value="Takut">Takut</option>
                        <option value="Cemas">Cemas</option>
                        <option value="Depresi">Depresi</option>
                        <option value="Lain-Lain">Lain-Lain</option>
                    </select> --}}
                    <input readonly  type="text" class="form-control w-75" name="ket_psiko" value="{{$penilaian->ket_psiko}}" id='ket_psiko' >
                </div>
                
            </div>
            <div class="col mb-2">
                <label for="" class="form-label">Bahasa Yang Digunakan sehari-hari</label>
                <input readonly type="text" class="form-control" name="" id="" value="{{!empty($data_pasien->nama_bahasa) ? $data_pasien->nama_bahasa : ''}}" >
            </div>
        </div>
        <div class="row">
            <p class="text-start fs-6 m-0">Status Sosial dan Ekonomi : </p>
            <div class="row ms-4 align-items-end">
                <div class="col mb-2">
                    <label for="hub_keluarga" class="form-label">Hubungan Pasien dengan Anggota Keluarga :</label>
                    <div class="d-flex">
                        <input readonly type="text" class="form-control" id="hub_keluarga" value="{{$penilaian->hub_keluarga}}">
                        {{-- <select class="form-select " id="hub_keluarga"  name="hub_keluarga" value="{{$penilaian->hub_keluarga}}" aria-label="Default select example">
                            <option value="-" selected>Pilih Hub Keluarga</option>
                            <option value="Baik" >Baik</option>
                            <option value="Tidak Baik">Tidak Baik</option>
                        </select> --}}
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="tinggal_dengan" class="form-label">Tinggal dengan : </label>
                    <div class="d-flex">
                        <input readonly type="text" class="form-control" id="tinggal_dengan" value="{{$penilaian->tinggal_dengan}}">
                        {{-- <select class="form-select " id="tinggal_dengan"  name="tinggal_dengan" value="{{$penilaian->tinggal_dengan}}" aria-label="Default select example">
                        <option value="-" selected>Pilih Tinggal Dengan</option>
                            <option value="Sendiri" >Sendiri</option>
                            <option value="Orang Tua">Orang Tua</option>
                            <option value="Suami / Istri" >Suami / Istri</option>
                            <option value="Lainnya">Lainnya</option>
                        </select> --}}
                        <input readonly type="text" class="form-control" name="ket_tinggal" value="{{$penilaian->ket_tinggal}}" id='ket_tinggal' >
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="ekonomi" class="form-label">Ekonomi :</label>
                    <div class="d-flex">
                        <input readonly type="text" class="form-control" id="ekonomi" value="{{$penilaian->ekonomi}}">
                        {{-- <select class="form-select " id="ekonomi"  name="ekonomi" value="{{$penilaian->ekonomi}}" aria-label="Default select example">
                        <option value="-" selected>Pilih Status Ekonomi</option>
    
                            <option value="Baik" >Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select> --}}
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="budaya" class="form-label">Kepercayaan / Budaya / Nilai-nilai khusus yang perlu diperlukan :</label>
                <div class="d-flex">
                    <input readonly type="text" class="w-25 form-control" id="budaya" value="{{$penilaian->budaya}}">
                    {{-- <select class="form-select w-25" id="budaya"  name="budaya" value="{{$penilaian->budaya}}" aria-label="Default select example">
                        <option value="-" selected>Pilih Budaya</option>
                        <option value="Tidak Ada" >Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select> --}}
                    <input readonly type="text" class="form-control w-75" name="ket_budaya" value="{{$penilaian->ket_budaya}}" id='ket_budaya' >
                </div>
                
            </div>
            <div class="col mb-2">
                <label for="edukasi" class="form-label">Edukasi diberikan kepada : </label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="edukasi" value="{{$penilaian->edukasi}}">
                    {{-- <select class="form-select w-25" id="edukasi"  name="edukasi" value="{{$penilaian->edukasi}}" aria-label="Default select example">
                    <option value="-" selected>Pilih Edukasi</option>
    
                        <option value="Pasien" >Pasien</option>
                        <option value="Kelurga">Kelurga</option>
                    </select> --}}
                    <input readonly type="text" class="form-control w-75" name="ket_edukasi" value="{{$penilaian->ket_edukasi}}" id='ket_edukasi' >
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
                            <input readonly type="text" class="form-control" id="berjalan_a" value="{{$penilaian->berjalan_a}}">
                            {{-- <select class="form-select" id="berjalan_a"  name="berjalan_a" aria-label="Default select example">
                            <option value="-" selected>Pilih Cara Berjalan</option>
    
                                <option value="Tidak" >Tidak</option>
                                <option value="Ya">Ya</option>
                            </select> --}}
                        </div>
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col-6 mb-2">
                        <label for="berjalan_b" class="form-label">2. Jalan Dengan Menggunakan Alat Bantu (Kruk , Tripot, Kursi Roda, Orang Lain):</label>
                        <div class="d-flex">
                            <input readonly type="text" class="form-control" id="berjalan_b" value="{{$penilaian->berjalan_b}}">
                            {{-- <select class="form-select " id="berjalan_b"  name="berjalan_b" value="{{$penilaian->berjalan_b}}" aria-label="Default select example">
                            <option value="-" selected>Pilih Alat Bantu</option>
    
                                <option value="Tidak" >Tidak</option>
                                <option value="Ya">Ya</option>
                            </select> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="berjalan_c" class="form-label">b. Menopang Saat Akan Duduk, Tampak Memegang Kursi atau Meja/ benda lagi sebagai penopang :</label>
                <input readonly type="text" class="form-control" id="berjalan_c" value="{{$penilaian->berjalan_c}}">
                {{-- <select class="form-select " id="berjalan_c"  name="berjalan_c" value="{{$penilaian->berjalan_c}}" aria-label="Default select example">
                    <option value="-" selected>Pilih Alat Bantu</option>
    
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select> --}}
            </div>
        </div>
    
        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="hasil" class="form-label">Hasil </label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="hasil" value="{{$penilaian->hasil}}">
                    {{-- <select class="form-select " id="hasil"  name="hasil" value="{{$penilaian->hasil}}" aria-label="Default select example">
                    <option value="-" selected>Pilih Hasil</option>
                        <option value="Tidak beresiko (tidak ditemukan a dan b)" >Tidak Berisiko (Tidak ditemukan a dan b) </option>
                        <option value="Resiko rendah (ditemukan a/b)" >Resiko Rendah (Ditemukan a / b) </option>
                        <option value="Resiko tinggi (ditemukan a dan b)" >Resiko Tinggi (Ditemukan a dan b) </option>
                    </select> --}}
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="lapor" class="form-label">Dilaporkan ke Dokter ? </label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="lapor" value="{{$penilaian->lapor}}">
                    {{-- <select class="form-select " id="lapor"  name="lapor" value="{{$penilaian->lapor}}" aria-label="Default select example">
                        <option value="-">Pilih </option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ya">Ya</option>
                    </select> --}}
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="ket_lapor" class="form-label">Jam Dilaporkan :</label>
                <input readonly type="time" class="form-control" name="ket_lapor" value="{{$penilaian->ket_lapor}}" id="ket_lapor" >
            </div>
        </div>
    </div>
    
    <hr class="mb-5">
    <div>
        <h5 class="text-start">VII. SKRINNING GIZI</h5>
        <div class="row mb-2">
            <label for="sg1" class="form-label">Apakah ada penurunan berat badan yang tidak diinginkan selamat 6 bulan terakhir ?</label>
            <div class="d-flex">
                <input readonly type="text" class="w-25 me-4 form-control" id="sg1" value="{{$penilaian->sg1}}">
                {{-- <select class="form-select w-25 me-4" id="sg1"  name="sg1" value="{{$penilaian->sg1}}" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Status</option> --}}
                    {{-- <option value="Tidak">Tidak</option> --}}
                    {{-- <option value="Tidak Yakin">Tidak Yakin</option> --}}
                    {{-- <option value="Ya, 1-5 Kg">Ya, 1-5 Kg</option> --}}
                    {{-- <option value="Ya, 6-10 Kg">Ya, 6-10 Kg</option> --}}
                    {{-- <option value="Ya, 11-15 Kg">Ya, 11-15 Kg</option> --}}
                    {{-- <option value="Ya, >15 Kg">Ya, >15 Kg</option> --}}
                {{-- </select> --}}
                <input readonly type="text" class="w-25 me-4 form-control" id="nilai1" value="{{$penilaian->nilai1}}">
                {{-- <select class="form-select w-25 me-4" id="nilai1"  name="nilai1" value="{{$penilaian->nilai1}}" aria-label="Default select example"> --}}
                    {{-- <option value="-" selected>Pilih Nilai</option> --}}
                    {{-- <option value="0">0</option> --}}
                    {{-- <option value="1">1</option> --}}
                    {{-- <option value="2">2</option> --}}
                    {{-- <option value="3">3</option> --}}
                    {{-- <option value="4">4</option> --}}
                {{-- </select> --}}
            </div>
            
        </div>
        <div class="row mb-2">
            <label for="sg2" class="form-label">Apakah nafsu makan berkurang karena tidak nafsu makan</label>
            <div class="d-flex">
                <input readonly type="text" class="w-25 me-4 form-control" id="sg2" value="{{$penilaian->sg2}}">
                {{-- <select class="form-select w-25 me-4" id="sg2"  name="sg2" value="{{$penilaian->sg2}}" aria-label="Default select example"> --}}
                {{-- <option value="-" selected>Pilih Nafsu Makan</option> --}}
                    {{-- <option value="Tidak" >Tidak</option> --}}
                    {{-- <option value="Ya">Ya</option> --}}
                {{-- </select> --}}
                <input readonly type="text" class="w-25 form-control" name="nilai2" value="{{$penilaian->nilai2}}" id="nilai2"  placeholder="Nilai" >
            </div>
        </div>
    
        <div class="row mb-2">
            <label for="total_hasil" class="form-label">Total Skor</label>
            <div class="d-flex">
                <input readonly type="text" class="w-25 form-control" name="total_hasil" value="{{$penilaian->total_hasil}}" id="total_hasil" placeholder="Hasil" >
            </div>
        </div>
    </div>
    
    <hr class="mb-5">
    <div>
        <h5 class="text-start">VIII. PENILAIAN TINGKAT NYERI</h5>
        <div class="d-flex justify-content-center mb-5">
            <img src="{{asset('icon/nyeri.png')}}" width="600" alt="">
        </div>
        <div class="row">
            <div class="mb-2 ">
                <div class="row">
                    <div class="col-4">
                        <label for="nyeri" class="form-label">Rasa Nyeri:</label>
                        <input readonly type="text" class="form-control" id="nyeri" value="{{$penilaian->nyeri}}">
                        {{-- <select class="form-select"  id="nyeri"  name="nyeri" value="{{$penilaian->nyeri}}" aria-label="Default select example"> --}}
                        {{-- <option value="-" selected>Pilih Rasa Nyeri</option> --}}
    {{--  --}}
                            {{-- <option value="Tidak Ada Nyeri" >Tidak Ada Nyeri</option> --}}
                            {{-- <option value="Nyeri Akut">Nyeri Akut</option> --}}
                            {{-- <option value="Nyeri Kronis">Nyeri Kronis</option> --}}
                        {{-- </select> --}}
                    </div>
                    <div class="col-8">
                        <label for="provokes" class="form-label">Penyebab</label>
                        <div class="d-flex">
                            <input readonly type="text" class="w-50 me-2 form-control" id="provokes" value="{{$penilaian->provokes}}">
                            {{-- <select class="form-select w-50 me-2" id="provokes"  name="provokes" value="{{$penilaian->provokes}}"  aria-label="Default select example"> --}}
                            {{-- <option value="-" selected>Pilih Penyebab</option> --}}
    {{--  --}}
                                {{-- <option value="Proses Penyakit" >Proses Penyakit</option> --}}
                                {{-- <option value="Benturan">Benturan</option> --}}
                                {{-- <option value="Lain-Lain">Lain-Lain</option> --}}
                            {{-- </select> --}}
                            <input readonly type="text" class=" form-control" name="ket_provokes" value="{{$penilaian->ket_provokes}}" id="ket_provokes" placeholder="Keterangan" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="quality" class="form-label">Kualitas:</label>
                        <div class="d-flex">
                            <input readonly type="text" class="form-control" id="quality" value="{{$penilaian->quality}}">
                            {{-- <select class="w-25 me-2 form-select" id="quality"  name="quality" value="{{$penilaian->quality}}" aria-label="Default select example"> --}}
                            {{-- <option value="-" selected>Pilih Kualitas</option> --}}
    {{--  --}}
                                {{-- <option value="Seperti Tertusuk" >Seperti Tertusuk</option> --}}
                                {{-- <option value="Berdenyut">Berdenyut</option> --}}
                                {{-- <option value="Teriris">Teriris</option> --}}
                                {{-- <option value="Tertindih">Tertindih</option> --}}
                                {{-- <option value="Tertiban">Tertiban</option> --}}
                                {{-- <option value="Lain-Lain">Lain-Lain</option> --}}
                            {{-- </select> --}}
                            <input readonly type="text" class="w-75 form-control" name="ket_quality" value="{{$penilaian->ket_quality}}" id="ket_quality"  placeholder="Keterangan" >
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <label for="" class="form-label">Wilayah:</label>
                    <div class="col ms-4">
                        <label for="lokasi" class="form-label">Lokasi:</label>
                        <input readonly type="text" id="lokasi"  name="lokasi" value="{{$penilaian->lokasi}}" class=" form-control"   placeholder="Nilai" >
                    </div>
                    <div class="col">
                        <label for="menyebar" class="form-label">Menyebar:</label>
                        <input readonly type="text" class="form-control" id="menyebar" value="{{$penilaian->menyebar}}">
                        {{-- <select class=" form-select"  id="menyebar"  name="menyebar" value="{{$penilaian->menyebar}}" aria-label="Default select example"> --}}
                        {{-- <option value="-" selected>Pilih Status Menyebar</option> --}}
    {{--  --}}
                            {{-- <option value="Tidak" >Tidak</option> --}}
                            {{-- <option value="Ya">Ya</option> --}}
                        {{-- </select> --}}
                    </div>
                </div>
    
                <div class="row">
                    <label for="" class="form-label">Severity:</label>                
                    <div class="col ms-4    ">
                        <label for="skala_nyeri" class="form-label">Skala Nyeri:</label>
                        <input readonly type="text" class="form-control" id="skala_nyeri" value="{{$penilaian->skala_nyeri}}">
                        {{-- <select class=" form-select" id="skala_nyeri"  name="skala_nyeri" value="{{$penilaian->skala_nyeri}}" aria-label="Default select example"> --}}
                        {{-- <option value="-" selected>Pilih Skala Nyeri</option> --}}
                            {{-- @for($i=0; $i <=10 ;$i++) --}}
                                {{-- <option value="{{$i}}" >{{$i}}</option> --}}
                            {{-- @endfor --}}
                        {{-- </select> --}}
                    </div>
    
                    <div class="col ">
                        <label for="durasi" class="form-label">Waktu / Durasi:</label>
                        <div class="input-group">
                            <input readonly type="text" class="form-control" id="durasi"  name="durasi" value="{{$penilaian->durasi}}">
                            <span class="input-group-text" >Menit</span>
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-4">
                        <label for="nyeri_hilang" class="form-label">Nyeri Hilang Bila:</label>
                        <div class="d-flex">
                            <input readonly type="text" class="me-2 form-control" id="nyeri_hilang" value="{{$penilaian->nyeri_hilang}}">
                            {{-- <select class="form-select me-2" id="nyeri_hilang"  name="nyeri_hilang" value="{{$penilaian->nyeri_hilang}}" aria-label="Default select example"> --}}
                            {{-- <option value="-" selected>Pilih </option> --}}
    {{--  --}}
                                {{-- <option value="Istirahat" >Istirahat</option> --}}
                                {{-- <option value="Mendengar Musik">Mendengar Musik</option> --}}
                                {{-- <option value="Minum Obat">Minum Obat</option> --}}
                            {{-- </select> --}}
                            <input readonly type="text" class=" form-control" name="ket_nyeri" value="{{$penilaian->ket_nyeri}}" id="ket_nyeri" placeholder="Nilai" >
                        </div>
                    </div>
                    <div class="col-8">
                        <label for="pada_dokter" class="form-label">Diberitahukan Kepada Dokter ?</label>
                        <div class="row">
                            <div class="col-4">
                                <input readonly type="text" class="form-control" id="pada_dokter" value="{{$penilaian->pada_dokter}}">
                                {{-- <select class=" form-select" id="pada_dokter"  name="pada_dokter" value="{{$penilaian->pada_dokter}}" aria-label="Default select example"> --}}
                                {{-- <option value="-" selected>Pilih </option> --}}
    {{--  --}}
                                    {{-- <option value="Tidak" >Tidak</option> --}}
                                    {{-- <option value="Ya">Ya</option> --}}
                                {{-- </select> --}}
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <label for="ket_dokter" class="form-label m-0 me-2">Jam:</label>
                                <input readonly type="text" name="ket_dokter" value="{{$penilaian->ket_dokter}}" id="ket_dokter" class="form-control">
                            </div>
                        </div>
                    </div>
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
                        <textarea readonly class="form-control" id="rencana" name="rencana" value="{{$penilaian->rencana}}" rows="5">{{$penilaian->rencana}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>