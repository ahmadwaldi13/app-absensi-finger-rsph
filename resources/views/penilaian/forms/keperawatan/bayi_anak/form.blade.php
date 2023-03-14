<form action="{{url('/penilaian-perawat-bayi-anak/update')}}" method="post" id="penilaian_perawat_bayi_anak">
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
        <div class="row ">
            <div class="col-2 mb-2">
                <label for="td" class="form-label">TD : </label>
                <div class="input-group">
                    <input  type="text" name="td" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}"  id="td" class="form-control">
                    <span class="input-group-text" >mmHg</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="nadi" class="form-label">Nadi : </label>
                <div class="input-group">
                    <input  type="text" id="nadi" name="nadi" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}"  class="form-control">
                    <span class="input-group-text" >x / Menit</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="rr" class="form-label">RR : </label>
                <div class="input-group">
                    <input  type="text" id="rr" name="rr" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}"  class="form-control">
                    <span class="input-group-text" >x / Menit</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="suhu" class="form-label">Suhu : </label>
                <div class="input-group">
                    <input  type="text" id="suhu" name="suhu" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}"  class="form-control">
                    <span class="input-group-text" >&#8451;</span>
                </div>
            </div>

            <div class="col-2 mb-2">
                <label for="gcs" class="form-label">GCS(E, V, M) : </label>
                <div class="input-group">
                    <input  type="text" id="gcs" name="gcs" value="{{!empty($penilaian->gcs) ? $penilaian->gcs : ''}}"  class="form-control">
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="bb" class="form-label">BB : </label>
                <div class="input-group">
                    <input  type="text" name="bb" value="{{!empty($penilaian->bb) ? $penilaian->bb : ''}}"  id="bb" class="form-control">
                    <span class="input-group-text" >Kg</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="tb" class="form-label">TB : </label>
                <div class="input-group">
                    <input  type="text" name="tb" value="{{!empty($penilaian->tb) ? $penilaian->tb : ''}}"  id="tb" class="form-control">
                    <span class="input-group-text" >cm</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="lp" class="form-label">LP : </label>
                <div class="input-group">
                    <input  type="text" name="lp" value="{{!empty($penilaian->lp) ? $penilaian->lp : ''}}"  id="lp" class="form-control">
                    <span class="input-group-text" >cm</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="lk" class="form-label">LK : </label>
                <div class="input-group">
                    <input  type="text" name="lk" value="{{!empty($penilaian->lk) ? $penilaian->lk : ''}}"  id="lk" class="form-control">
                    <span class="input-group-text" >cm</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="LD" class="form-label">LD : </label>
                <div class="input-group">
                    <input  type="text" name="ld" value="{{!empty($penilaian->ld) ? $penilaian->ld : ''}}"  id="ld" class="form-control">
                </div>
            </div>
        </div>  
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">II. RIWAYAT KESEHATAN DAHULU </h5>
        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="keluhan_utama" class="form-label">Keluhan Utama</label>
                <textarea  class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{!empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : ''}}</textarea>
            </div>
            <div class="col mb-2">
                <label for="rpk" class="form-label">Riwayat Penyakit Keluarga</label>
                <textarea  class="form-control" id="rpk" name="rpk" rows="3">{{!empty($penilaian->rpk) ? $penilaian->rpk : ''}}</textarea>
            </div>
        </div>
        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
                <textarea  class="form-control" id="rpd" name="rpd" rows="3">{{!empty($penilaian->rpd) ? $penilaian->rpd : ''}}</textarea>
            </div>
            <div class="col mb-2">
                <label for="rpo" class="form-label">Riwayat Pengobatan</label>
                <textarea  class="form-control" id="rpo" name="rpo" rows="3">{{!empty($penilaian->rpo) ? $penilaian->rpo : ''}}</textarea>
            </div>
        </div>
        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="alergi" class="form-label">Riwayat Alergi</label>
                <input  type="text" class="form-control" name="alergi" value="{{!empty($penilaian->alergi) ? $penilaian->alergi : ''}}"  id='alergi' value="">
            </div>
        </div>
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">III. RIWAYAT TUMBUH KEMBANG DAN PERINTAL CARE</h5>
        <div class="row ">
            <div class="col-6 mb-2 ">
                <label for="" class="form-label">Riwayat Kelahiran :  </label>
                <div class="ms-2 d-flex justify-content-between align-items-center">
                    <label for="anakke" class="form-label">Anak Ke :  </label>
                    <input  type="number" placeholder="" class="ms-2 w-25 form-control" name="anakke" value="{{!empty($penilaian->anakke) ? $penilaian->anakke : ''}}"  id='anakke' value="">
                    <label for="darisaudara" class="form-label">Dari :  </label>
                    <input  type="number" placeholder="" class="ms-2 w-25 form-control" name="darisaudara" value="{{!empty($penilaian->darisaudara) ? $penilaian->darisaudara : ''}}"  id='darisaudara' value="">
                    <span>Saudara</span>
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="caralahir" class="form-label">Cara Kelahiran :  </label>
                <div class="d-flex">
                    <select class="form-select " id="caralahir"  name="caralahir" aria-label="Default select example">
                    <option value="-" >Pilih </option>
                        <option value="Spontan" >Spontan</option>
                        <option value="Sectio Caesaria" >Sectio Caesaria</option>
                        <option value="Lain-Lain">Lain-Lain</option>
                    </select>
                    <input  type="text" placeholder="keterangan kelahiran" class="ms-2 form-control" name="ket_caralahir" value="{{!empty($penilaian->ket_caralahir) ? $penilaian->ket_caralahir : ''}}"  id='ket_caralahir' value="">
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="umurkelahiran" class="form-label">Umur Kelahiran  :  </label>
                <select class="form-select " id="umurkelahiran"  name="umurkelahiran" aria-label="Default select example">
                    <option value="-" >Pilih </option>
                    <option value="Cukup Bulan" >Cukup Bulan</option>
                    <option value="Kurang Bulan">Kurang Bulan</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="kelainanbawaan" class="form-label">Kelainan Bawaan :  </label>
                <div class="d-flex">
                    <select class="form-select " id="kelainanbawaan"  name="kelainanbawaan" aria-label="Default select example">
                    <option value="-" >Pilih </option>
                        <option value="Tidak Ada" >Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select>
                    <input  type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_kelainan_bawaan" value="{{!empty($penilaian->ket_kelainan_bawaan) ? $penilaian->ket_kelainan_bawaan : ''}}"  id='ket_kelainan_bawaan' value="">
                </div>
            </div>
        </div>

    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">IV. RIWAYAT IMUNISASI</h5>
        <div class="row ">
            <div class="col-12 mt-2 mb-2 overflow-auto border rounded p-3">
                <div class="d-flex mb-2 justify-content-end">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImunisasiForm" aria-expanded="false" aria-controls="collapseImunisasiForm">
                        Tambah Riwayat Imunisasi
                    </button>
                </div>
                <div class="collapse" id="collapseImunisasiForm">
                    <div class="card card-body">
                        <div  id="editImunisasiForm">
                            <div class="row">
                                <div class="col-7 mb-2">
                                    <label for="kode_imunisasi" class="form-label">Imunisasi:</label>
                                    <select class="form-select" id="kode_imunisasi" name="kode_imunisasi" aria-label="Default select ">
                                        <option value="" selected>Pilih Jenis Imunisasi</option>
                                        @foreach($master_imunisasi as $v)
                                            <option value="{{$v->kode_imunisasi}}_{{$v->nama_imunisasi}}" >{{$v->nama_imunisasi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4 mb-2">
                                    <label for="no_imunisasi" class="form-label">Yang Ke:</label>
                                    <select class="form-select" id="no_imunisasi"  aria-label="Default select ">
                                        <option value="" selected>Pilih No Imunisasi</option>
                                        <option value="1" >1</option>
                                        <option value="2" >2</option>
                                        <option value="3" >3</option>
                                        <option value="4" >4</option>
                                        <option value="5" >5</option>
                                        <option value="6" >6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImunisasiForm" aria-expanded="false" aria-controls="collapsePersalinanForm">
                                    Batal
                                </button>
                                <button type="button" onclick="tambahEditDataImunisasi()"  class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table auto-number-table" id="tabelimunisasiPasien">
                    <thead align="center">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col-3">Nama Imunisasi</th>
                            <th scope="col">Ke 1</th>
                            <th scope="col">Ke 2</th>
                            <th scope="col">Ke 3</th>
                            <th scope="col">Ke 4</th>
                            <th scope="col">Ke 5</th>
                            <th scope="col">Ke 6</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($imunisasi as $key => $value)
                            <tr id='imunisasi_{{$key}}'>
                                <td><input  type="text" hidden name="imunisasi_{{$key}}" value="{{json_encode($value)}}"></td>
                                <td>{{$value->nama_imunisasi}}</td>
                                @for ($i = 1; $i <= 6; $i++)
                                    <td><input  type="radio" onclick="updateImunisasi('{{$key}}', '{{$i}}')"  {{$i === $value->no_imunisasi ? 'checked' : ''}}></td>
                                @endfor
                                <td><button type="button" class="btn btn-danger" onclick="hapusDataRiwayat('imunisasi_{{$key}}')">Hapus</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">V. RIWAYAT TUMBUH KEMBANG ANAK</h5>
        <div class="row ">
            <div class="col-4 mb-2">
                <label for="usiatengkurap" class="form-label">a. Tengkurap, Usia</label>
                <input  type="text" class="form-control w-75" name="usiatengkurap" value="{{!empty($penilaian->usiatengkurap) ? $penilaian->usiatengkurap : ''}}"  id='usiatengkurap' value="">
            </div>
            <div class="col-4 mb-2">
                <label for="usiaduduk" class="form-label">b. Duduk, Usia</label>
                <input  type="text" class="form-control w-75" name="usiaduduk" value="{{!empty($penilaian->usiaduduk) ? $penilaian->usiaduduk : ''}}"  id='usiaduduk' value="">
            </div>
            <div class="col-4 mb-2">
                <label for="usiaberdiri" class="form-label">c. Berdiri, Usia</label>
                <input  type="text" class="form-control w-75" name="usiaberdiri" value="{{!empty($penilaian->usiaberdiri) ? $penilaian->usiaberdiri : ''}}"  id='usiaberdiri' value="">
            </div>
            <div class="col-4 mb-2">
                <label for="usiagigipertama" class="form-label">d. Gigi Pertama, Usia</label>
                <input  type="text" class="form-control w-75" name="usiagigipertama" value="{{!empty($penilaian->usiagigipertama) ? $penilaian->usiagigipertama : ''}}"  id='usiagigipertama' value="">
            </div>
            <div class="col-4 mb-2">
                <label for="usiaberjalan" class="form-label">e. Berjalan, Usia</label>
                <input  type="text" class="form-control w-75" name="usiaberjalan" value="{{!empty($penilaian->usiaberjalan) ? $penilaian->usiaberjalan : ''}}"  id='usiaberjalan' value="">
            </div>
            <div class="col-4 mb-2">
                <label for="usiabicara" class="form-label">f. Bicara Usia, Usia</label>
                <input  type="text" class="form-control w-75" name="usiabicara" value="{{!empty($penilaian->usiabicara) ? $penilaian->usiabicara : ''}}"  id='usiabicara' value="">
            </div>
            <div class="col-4 mb-2">
                <label for="usiamembaca" class="form-label">g. Mulai bisa Membaca, Usia</label>
                <input  type="text" class="form-control w-75" name="usiamembaca" value="{{!empty($penilaian->usiamembaca) ? $penilaian->usiamembaca : ''}}"  id='usiamembaca' value="">
            </div>
            <div class="col-4 mb-2">
                <label for="usiamenulis" class="form-label">h. Mulai Bisa Menulisa, Usia</label>
                <input  type="text" class="form-control w-75" name="usiamenulis" value="{{!empty($penilaian->usiamenulis) ? $penilaian->usiamenulis : ''}}"  id='usiamenulis' value="">
            </div>
            <div class="col-4 mb-2">
                <label for="gangguanemosi" class="form-label">Gangguan Perkembangan Mental/ emosi, bila ada , jelaskan j</label>
                <textarea  class="form-control" id="gangguanemosi" name="gangguanemosi" rows="3">{{!empty($penilaian->gangguanemosi) ? $penilaian->gangguanemosi : ''}}</textarea>
            </div>
        </div>

    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">VI. FUNGSIONAL</h5>
        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="alat_bantu" class="form-label">Alat Bantu</label>
                <div class="d-flex">
                    <select class="form-select w-25 me-2" id="alat_bantu"  name="alat_bantu" aria-label="Default select example">
                        <option value="-" >Pilih Alat Bantu</option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ya">Ya</option>
                    </select>
                    <input  type="text" class="form-control w-75" name="ket_bantu" value="{{!empty($penilaian->ket_bantu) ? $penilaian->ket_bantu : ''}}"  id='ket_bantu' value="">
                </div>
                
            </div>
            <div class="col mb-2">
                <label for="prothesa" class="form-label">Prothesa</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="prothesa"  name="prothesa" aria-label="Default select example">
                        <option value="-" >Pilih Prothesa</option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ya">Ya</option>
                    </select>
                    <input  type="text" class="form-control w-75" name="ket_pro" value="{{!empty($penilaian->ket_pro) ? $penilaian->ket_pro : ''}}"  id='ket_pro' value="">
                </div>
                
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="cacat_fisik" class="form-label">Cacat Fisik</label>
                <input  type="text" class="form-control" id="cacat_fisik"  name=""   value="-" >
            </div>
            <div class="col-6 mb-2">
                <label for="adl" class="form-label">Aktivitas Kehidupan Sehari-hari (ADL)</label>
                <select class="form-select" id="adl"  name="adl" aria-label="Default select example">
                    <option value="-">Pilih Aktivitas</option>

                    <option value="Mandiri" >Mandiri</option>
                    <option value="Dibantu">Dibantu</option>
                </select>
            </div>
        </div>
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">VII. RIWAYAT PSIKO SOSIAL, SPIRITUAL DAN BUDAYA </h5>
        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="status_psiko" class="form-label">Status Psikologi</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="status_psiko"  name="status_psiko" aria-label="Default select example">
                        <option value="-" >Pilih Status Psikologi</option>
                        <option value="Tenang" >Tenang</option>
                        <option value="Takut">Takut</option>
                        <option value="Cemas">Cemas</option>
                        <option value="Depresi">Depresi</option>
                        <option value="Lain-Lain">Lain-Lain</option>
                    </select>
                    <input   type="text" class="form-control w-75" name="ket_psiko" value="{{!empty($penilaian->ket_psiko) ? $penilaian->ket_psiko : ''}}"  id='ket_psiko' value="">
                </div>
                
            </div>
            <div class="col mb-2">
                <label for="" class="form-label">Bahasa Yang Digunakan sehari-hari</label>
                <input  type="text" class="form-control" name="" id="" value="{{!empty($data_pasien->nama_bahasa) ? $data_pasien->nama_bahasa : ''}}" >
            </div>
        </div>
        <div class="row">
            <p class="text-start fs-6 m-0">Status Sosial dan Ekonomi : </p>
            <div class="row ms-4 align-items-end">
                <div class="col mb-2">
                    <label for="hub_keluarga" class="form-label">Hubungan Pasien dengan Anggota Keluarga :</label>
                    <div class="d-flex">
                        <select class="form-select " id="hub_keluarga"  name="hub_keluarga" aria-label="Default select example">
                            <option value="-" >Pilih Hub Keluarga</option>
                            <option value="Baik" >Baik</option>
                            <option value="Tidak Baik">Tidak Baik</option>
                        </select>
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="pengasuh" class="form-label">Pengasuh : </label>
                    <div class="d-flex">
                        <select class="form-select " id="pengasuh"  name="pengasuh" aria-label="Default select example">
                        <option value="-" >Pilih Pengasuh</option>
                            <option value="Orang Tua">Orang Tua</option>
                            <option value="Kakek/Nenek" >Kakek/Nenek</option>
                            <option value="Keluarga Lainnya">Keluarga Lainnya</option>
                        </select>
                        <input  type="text" class="form-control" name="ket_pengasuh" value="{{!empty($penilaian->ket_pengasuh) ? $penilaian->ket_pengasuh : ''}}"  id='ket_pengasuh' value="">
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="ekonomi" class="form-label">Ekonomi :</label>
                    <div class="d-flex">
                        <select class="form-select " id="ekonomi"  name="ekonomi" aria-label="Default select example">
                        <option value="-" >Pilih Status Ekonomi</option>

                            <option value="Baik" >Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="budaya" class="form-label">Kepercayaan / Budaya / Nilai-nilai khusus yang perlu diperlukan :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="budaya"  name="budaya" aria-label="Default select example">
                        <option value="-" >Pilih Budaya</option>
                        <option value="Tidak Ada" >Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select>
                    <input  type="text" class="form-control w-75" name="ket_budaya" value="{{!empty($penilaian->ket_budaya) ? $penilaian->ket_budaya : ''}}"  id='ket_budaya' value="">
                </div>
                
            </div>
            <div class="col mb-2">
                <label for="edukasi" class="form-label">Edukasi diberikan kepada : </label>
                <div class="d-flex">
                    <select class="form-select w-25" id="edukasi"  name="edukasi" aria-label="Default select example">
                    <option value="-" >Pilih Edukasi</option>
                        <option value="Orang Tua" >Orang Tua</option>
                        <option value="Kelurga">Kelurga</option>
                    </select>
                    <input  type="text" class="form-control w-75" name="ket_edukasi" value="{{!empty($penilaian->ket_edukasi) ? $penilaian->ket_edukasi : ''}}"  id='ket_edukasi' value="">
                </div>
                
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="" class="form-label">Agama</label>
                <input  type="text" class="form-control"  id="" value="{{!empty($data_pasien->agama) ? $data_pasien->agama : ''}}" >
            </div>
        </div>
    </div>



    <hr class="mb-5">
    <div>
        <h5 class="text-start">VIII. PENILAIAN RESIKO JATUH </h5>
        <div class="row">
            <p class="text-start fs-6 m-0">a. Cara Berjalan (Salah Satu atau Lebih ): </p>
            <div class="ms-4">
                <div class="row align-items-end">
                    <div class="col-6 mb-2">
                        <label for="berjalan_a" class="form-label">1. Tidak Seimbang / Sempoyong / Limbung :</label>
                        <div class="d-flex">
                            <select class="form-select" id="berjalan_a"  name="berjalan_a" value="{{!empty($penilaian->berjalan_a) ? $penilaian->berjalan_a : ''}}"  aria-label="Default select example">
                            <option value="-" >Pilih Cara Berjalan</option>

                                <option value="Tidak" >Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col-6 mb-2">
                        <label for="berjalan_b" class="form-label">2. Jalan Dengan Menggunakan Alat Bantu (Kruk , Tripot, Kursi Roda, Orang Lain):</label>
                        <div class="d-flex">
                            <select class="form-select " id="berjalan_b"  name="berjalan_b" aria-label="Default select example">
                            <option value="-" >Pilih Alat Bantu</option>

                                <option value="Tidak" >Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="berjalan_c" class="form-label">b. Duduk di kursi tanpa menggunakan tangan sebagai penopang (tampa memegang kursi atau meja/ benda lain) :</label>
                <select class="form-select " id="berjalan_c"  name="berjalan_c" aria-label="Default select example">
                    <option value="-" >Pilih Alat Bantu</option>

                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="hasil" class="form-label">Hasil </label>
                <div class="d-flex">
                    <select class="form-select " id="hasil"  name="hasil" aria-label="Default select example">
                    <option value="-" >Pilih Hasil</option>
                        <option value="Tidak beresiko (tidak ditemukan a dan b)" >Tidak Berisiko (Tidak ditemukan a dan b) </option>
                        <option value="Resiko rendah (ditemukan a/b)" >Resiko Rendah (Ditemukan a / b) </option>
                        <option value="Resiko tinggi (ditemukan a dan b)" >Resiko Tinggi (Ditemukan a dan b) </option>
                    </select>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="lapor" class="form-label">Dilaporkan ke Dokter ? </label>
                <div class="d-flex">
                    <select class="form-select " id="lapor"  name="lapor" aria-label="Default select example">
                        <option value="-">Pilih </option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ya">Ya</option>
                    </select>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="ket_lapor" class="form-label">Jam Dilaporkan :</label>
                <input  type="text" class="form-control" name="ket_lapor" value="{{!empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : ''}}"  id="ket_lapor" value="">
            </div>
        </div>
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">IX. SKRINNING GIZI</h5>
        <div class="row mb-2">
            <label for="sg1" class="form-label">1. Apakah Pasien Tampak Kurus ?</label>
            <div class="d-flex">
                <select class="form-select w-25 me-4" id="sg1"  name="sg1" aria-label="Default select example">
                    <option value="-" >Pilih Status</option>
                    <option value="Tidak">Tidak</option>
                    <option value="Ada">Ada</option>
                </select>
                <select class="form-select w-25 me-4" id="nilai1"  name="nilai1" aria-label="Default select example">
                    <option value="-" >Pilih Nilai</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label for="sg2" class="form-label">2. Apakah terdapat penurunan berat badan selama satu bulan terakhir? (berdasarkan penilaian objektif data berat badan bila ada atau untuk bayi < 1 tahun; berat bdan tidak naik selamat 3 bulan terakhir)</label>
            <div class="d-flex">
                <select class="form-select w-25 me-4" id="sg2"  name="sg2" aria-label="Default select example">
                <option value="-" >Pilih Nafsu Makan</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <select class="form-select w-25 me-4" id="nilai2"  name="nilai2" aria-label="Default select example">
                    <option value="-" >Pilih Nilai</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <label for="sg3" class="form-label">3. Apakah teradpat salah satu dari kondisi tersebut? Diare > 5 kali/hari dan/muntah > 3 kali/hari selama seminggu terakhir; Asupan makanan berkurang selama 1 minggu terakhir</label>
            <div class="d-flex">
                <select class="form-select w-25 me-4" id="sg3"  name="sg3" aria-label="Default select example">
                <option value="-" >Pilih Nafsu Makan</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <select class="form-select w-25 me-4" id="nilai3"  name="nilai3" aria-label="Default select example">
                    <option value="-" >Pilih Nilai</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label for="sg4" class="form-label">4. Apakah terdapat penyakit atau keadaan yang menyebabkan pasien beresiko mengalami malnutrisi?</label>
            <div class="d-flex">
                <select class="form-select w-25 me-4" id="sg4"  name="sg4" aria-label="Default select example">
                <option value="-" >Pilih Nafsu Makan</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <select class="form-select w-25 me-4" id="nilai4"  name="nilai4" aria-label="Default select example">
                    <option value="-" >Pilih Nilai</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label for="total_hasil" class="form-label">Total Skor</label>
            <div class="d-flex">
                <input  type="text" class="w-25 form-control" name="total_hasil" value="{{!empty($penilaian->total_hasil) ? $penilaian->total_hasil : ''}}"  id="total_hasil" placeholder="Nilai" >
            </div>
        </div>
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">X. PENILAIAN TINGKAT NYERI</h5>
        <div class="row mb-4">
            <label  class="form-label">Skala FLACCS:</label>
            <div class="ms-2 row">
                <div class="col-6">
                    <label for="wajah" class="form-label">Wajah: </label>
                    <div class="d-flex">
                        <select id="wajah"  name="wajah" class="form-select w-75 me-2" aria-label="Default select example">
                        <option value="-" >Pilih </option>
                            <option value="Tersenyum/tidak ada ekspresi khusus">Tersenyum/tidak ada ekspresi khusus</option>
                            <option value="Terkadang meringis/menarik diri" >Terkadang meringis/menarik diri</option>
                            <option value="Sering menggetarkan dagu dan mengatupkan rahang">Sering menggetarkan dagu dan mengatupkan rahang</option>
                        </select>
                        <input  type="text" class="w-25 form-control" name="nilaiwajah" value="{{!empty($penilaian->nilaiwajah) ? $penilaian->nilaiwajah : ''}}"  id="nilaiwajah" placeholder="Nilai" >
                    </div>
                </div>
                <div class="col-6">
                    <label for="menangis" class="form-label">Menangis: </label>
                    <div class="d-flex">
                        <select id="menangis"  name="menangis" class="form-select w-75 me-2" aria-label="Default select example">
                        <option value="-" >Pilih </option>
                            <option value="Tidak menangis (mudah bergerak)">Tidak menangis (mudah bergerak)</option>
                            <option value="Mengerang/merengek" >Mengerang/merengek</option>
                            <option value="Menangis terus menerus, terisak, menjerit">Menangis terus menerus, terisak, menjerit</option>
                        </select>
                        <input  type="text" class="w-25 form-control" name="nilaimenangis" value="{{!empty($penilaian->nilaimenangis) ? $penilaian->nilaimenangis : ''}}"  id="nilaimenangis" placeholder="Nilai" >
                    </div>
                </div>
                <div class="col-6">
                    <label for="kaki" class="form-label">Kaki: </label>
                    <div class="d-flex">
                        <select id="kaki"  name="kaki" class="form-select w-75 me-2" aria-label="Default select example">
                        <option value="-" >Pilih </option>
                            <option value="Gerakan normal/relaksasi">Gerakan normal/relaksasi</option>
                            <option value="Tidak tenang/tegang" >Tidak tenang/tegang</option>
                            <option value="Kaki dibuat menendang/menarik">Kaki dibuat menendang/menarik</option>
                        </select>
                        <input  type="text" class="w-25 form-control" name="nilaikaki" value="{{!empty($penilaian->nilaikaki) ? $penilaian->nilaikaki : ''}}"  id="nilaikaki" placeholder="Nilai" >
                    </div>
                </div>
                <div class="col-6">
                    <label for="bersuara" class="form-label">Bersuara: </label>
                    <div class="d-flex">
                        <select id="bersuara"  name="bersuara" class="form-select w-75 me-2" aria-label="Default select example">
                        <option value="-" >Pilih </option>
                            <option value="Bersuara normal/tenang">Bersuara normal/tenang</option>
                            <option value="Tenang bila dipeluk, digendong/diajak bicara" >Tenang bila dipeluk, digendong/diajak bicara</option>
                            <option value="Sulit untuk menenangkan">Sulit untuk menenangkan</option>
                        </select>
                        <input  type="text" class="w-25 form-control" name="nilaibersuara" value="{{!empty($penilaian->nilaibersuara) ? $penilaian->nilaibersuara : ''}}"  id="nilaibersuara" placeholder="Nilai" >
                    </div>
                </div>
                <div class="col-6">
                    <label for="aktifitas" class="form-label">Aktifitas: </label>
                    <div class="d-flex">
                        <select id="aktifitas"  name="aktifitas" class="form-select w-75 me-2" aria-label="Default select example">
                        <option value="-" >Pilih </option>
                            <option value="Tidur posisi normal, mudah bergerak">Tidur posisi normal, mudah bergerak</option>
                            <option value="Gerakan menggeliat/berguling, kaku" >Gerakan menggeliat/berguling, kaku</option>
                            <option value="Melengkungkan punggung/kaku menghentak">Melengkungkan punggung/kaku menghentak</option>
                        </select>
                        <input  type="text" class="w-25 form-control" name="nilaiaktifitas" value="{{!empty($penilaian->nilaiaktifitas) ? $penilaian->nilaiaktifitas : ''}}"  id="nilaiaktifitas" placeholder="Nilai" >
                    </div>
                </div>
                <div class="col-6">
                    <label for="hasilnyeri" class="form-label">Skala Nyeri: </label>
                    <input  type="text" class="w-25 form-control" name="hasilnyeri" value="{{!empty($penilaian->hasilnyeri) ? $penilaian->hasilnyeri : ''}}"  id="hasilnyeri" placeholder="Nilai" >
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mb-5">
            <img src="{{asset('icon/nyeri.png')}}" width="600" alt="">
        </div>
        <div class="row">
            <div class="col-6 mb-2">
                <label for="nyeri" class="form-label">Rasa Nyeri:</label>
                <select class="form-select"  id="nyeri"  name="nyeri" aria-label="Default select example">
                    <option value="-" >Pilih Rasa Nyeri</option>
                    <option value="Tidak Ada Nyeri" >Tidak Ada Nyeri</option>
                    <option value="Nyeri Akut">Nyeri Akut</option>
                    <option value="Nyeri Kronis">Nyeri Kronis</option>
                </select>
            </div>
            <div class="col-6 mb-2 ">
                <label for="lokasi" class="form-label">Lokasi:</label>
                <input  type="text" id="lokasi"  name="lokasi" value="{{!empty($penilaian->lokasi) ? $penilaian->lokasi : ''}}"  class=" form-control" name=""  placeholder="Nilai" >
            </div>
            <div class="col-6 mb-2 ">
                <label for="durasi" class="form-label">Waktu / Durasi:</label>
                <div class="input-group">
                    <input  type="text" class="form-control" id="durasi"  name="durasi" value="{{!empty($penilaian->durasi) ? $penilaian->durasi : ''}}" >
                    <span class="input-group-text" >Menit</span>
                </div>
            </div>
            <div class="col-6 mb-2 ">
                <label for="frekuensi" class="form-label">Frekuensi :</label>
                <div class="input-group">
                    <input  type="text" class="form-control" id="frekuensi"  name="frekuensi" value="{{!empty($penilaian->frekuensi) ? $penilaian->frekuensi : ''}}" >
                    <span class="input-group-text" >Menit</span>
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="nyeri_hilang" class="form-label">Nyeri Hilang Bila:</label>
                <div class="d-flex">
                    <select class="form-select me-2" id="nyeri_hilang"  name="nyeri_hilang" aria-label="Default select example">
                    <option value="-" >Pilih </option>

                        <option value="Istirahat" >Istirahat</option>
                        <option value="Mendengar Musik">Mendengar Musik</option>
                        <option value="Minum Obat">Minum Obat</option>
                    </select>
                    <input  type="text" class=" form-control" name="ket_nyeri" value="{{!empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : ''}}"  id="ket_nyeri" placeholder="Nilai" >
                </div>
            </div>
            <div class="col-8 mb-2">
                <label for="pada_dokter" class="form-label">Diberitahukan Kepada Dokter ?</label>
                <div class="row">
                    <div class="col-4">
                        <select class=" form-select" id="pada_dokter"  name="pada_dokter" aria-label="Default select example">
                        <option value="-" >Pilih </option>

                            <option value="Tidak" >Tidak</option>
                            <option value="Ya">Ya</option>
                        </select>
                    </div>
                    <div class="col-8 d-flex align-items-center">
                        <label for="ket_dokter" class="form-label m-0 me-2">Jam:</label>
                        <input  type="text" name="ket_dokter" value="{{!empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : ''}}"  id="ket_dokter" class="form-control">
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