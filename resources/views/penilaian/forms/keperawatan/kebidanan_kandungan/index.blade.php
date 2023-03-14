<form action="{{url('/penilaian-perawat-kebidanan/create')}}" method="post" id="penilaian_perawat_kandungan">
@csrf
<div class="row mb-3">
    @include('penilaian.form_header', ["pj_form_type"=>"bidan"])
    <div class="col mb-2">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input type="text" class="form-control input-daterange input-date-time" name="tanggal" id="tanggal"  required autocomplete="off" >
    </div>
    <div class="col mb-2">
        <label for="informasi" class="form-label">Informasi didapat dari : </label>
        <select class="form-select" id="informasi" name="informasi" aria-label="Default select " >
            <option value="-" selected>Pilih Informasi</option>
            <option value="Autoanamnesis" >Autoanamnesis</option>
            <option value="Alloanamnesis">Alloanamnesis</option>
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
                <input type="text" name="td" id="td" class="form-control">
                <span class="input-group-text">mmHg</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input type="text" id="nadi" name="nadi" class="form-control">
                <span class="input-group-text">x / Menit</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="rr" class="form-label">RR : </label>
            <div class="input-group">
                <input type="text" id="rr" name="rr" class="form-control">
                <span class="input-group-text">x / Menit</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input type="text" id="suhu" name="suhu" class="form-control">
                <span class="input-group-text">&#8451;</span>
            </div>
        </div>

        <div class="col mb-2">
            <label for="gcs" class="form-label">GCS(E, V, M) : </label>
            <div class="input-group">
                <input type="text" id="gcs" name="gcs" class="form-control">
            </div>
        </div>
    </div>

    <div class="row align-items-end">
        <div class="col mb-2">
            <label for="bb" class="form-label">BB : </label>
            <div class="input-group">
                <input type="text" id="bb" name="bb" class="form-control">
                <span class="input-group-text">Kg</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input type="text" id="tb" name="tb" class="form-control">
                <span class="input-group-text">cm</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="lila" class="form-label">LILA : </label>
            <div class="input-group">
                <input type="text" id="lila" name="lila" class="form-control">
                <span class="input-group-text">cm</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="bmi" class="form-label">BMI : </label>
            <div class="input-group">
                <input type="text" id="bmi" name="bmi" class="form-control">
                <span class="input-group-text">Kg / m&#178;</span>
            </div>
        </div>

    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">II. PEMMERIKSAAN KEBIDANAN</h5>
    <div class="row align-items-end">
        <div class="col-4 mb-2">
            <label for="tfu" class="form-label">TFU : </label>
            <div class="input-group">
                <input type="text" name="tfu" id="tfu" class="form-control">
                <span class="input-group-text">cm</span>
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="tbj" class="form-label">TBJ : </label>
            <div class="input-group">
                <input type="text" id="tbj" name="tbj" class="form-control">
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="letak" class="form-label">Letak : </label>
            <div class="input-group">
                <input type="text" id="letak" name="letak" class="form-control">
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="presentasi" class="form-label">Presentasi : </label>
            <div class="input-group">
                <input type="text" id="presentasi" name="presentasi" class="form-control">
            </div>
        </div>

        <div class="col-4 mb-2">
            <label for="penurunan" class="form-label">Penurunan : </label>
            <div class="input-group">
                <input type="text" id="penurunan" name="penurunan" class="form-control">
            </div>
        </div>

        <div class="col-4 mb-2">
            <label for="his" class="form-label">Kontraksi/HIS : </label>
            <div class="input-group me-2">
                <input type="text" id="his" name="his" class="form-control">
                <span class="input-group-text">x/10</span>
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="kekuatan" class="form-label">Kekuatan : </label>
            <div class="input-group">
                <input type="text" name="kekuatan" id="kekuatan" class="form-control">
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="lamanya" class="form-label">Lamanya : </label>
            <div class="input-group">
                <input type="text" name="lamanya" id="lamanya" class="form-control">
                <span class="input-group-text">detik</span>
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="bjj" class="form-label">Gerak Janin x/30 menit, DJJ : </label>
            <div class="d-flex">
                <div class="input-group w-50 me-2">
                    <input type="text" id="bjj" name="bjj" class="form-control">
                    <span class="input-group-text" >/mnt</span>
                </div>
                <select class="form-select w-50" id="ket_bjj"  name="ket_bjj" aria-label="Default select example">
                    <option value="-" selected>Pilih Status</option>
                    <option value="Teratur" >Teratur</option>
                    <option value="Tidak Teratur">Tidak Teratur</option>
                </select>
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="portio" class="form-label">Portio : </label>
            <div class="input-group">
                <input type="text" name="portio" id="portio" class="form-control">
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="serviks" class="form-label">Pembukaan Serviks : </label>
            <div class="input-group">
                <input type="text" name="serviks" id="serviks" class="form-control">
                <span class="input-group-text">cm</span>
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="ketuban" class="form-label">Ketuban : </label>
            <div class="input-group">
                <input type="text" name="ketuban" id="ketuban" class="form-control">
                <span class="input-group-text">kep/bok</span>
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="hodge" class="form-label">Hodge : </label>
            <div class="input-group">
                <input type="text" name="hodge" id="hodge" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <p class="text-start fs-6 m-0">Pemeriksaan Penunjang : </p>
        <div class="row ms-4 align-items-end">
            <div class="col mb-2">
                <label for="inspekulo" class="form-label">Inspekulo : </label>
                <div class="d-flex">
                    <select class="form-select " id="inspekulo"  name="inspekulo" aria-label="Default select example">
                    <option value="-" selected>Pilih </option>
                        <option value="Dilakukan" >Dilakukan</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                    <input type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_inspekulo" id='ket_inspekulo' value="">
                </div>
            </div>
            <div class="col mb-2">
                <label for="ctg" class="form-label">CTG : </label>
                <div class="d-flex">
                    <select class="form-select " id="ctg"  name="ctg" aria-label="Default select example">
                    <option value="-" selected>Pilih </option>
                        <option value="Dilakukan" >Dilakukan</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                    <input type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_ctg" id='ket_ctg' value="">
                </div>
            </div>

        </div>
        <div class="row ms-4 align-items-end">
            <div class="col mb-2">
                <label for="lab" class="form-label">Laboratorium : </label>
                <div class="d-flex">
                    <select class="form-select " id="lab"  name="lab" aria-label="Default select example">
                    <option value="-" selected>Pilih </option>
                        <option value="Dilakukan" >Dilakukan</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                    <input type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_lab" id='ket_lab' value="">
                </div>
            </div>
            <div class="col mb-2">
                <label for="usg" class="form-label">USG : </label>
                <div class="d-flex">
                    <select class="form-select " id="usg"  name="usg" aria-label="Default select example">
                    <option value="-" selected>Pilih </option>
                        <option value="Dilakukan" >Dilakukan</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                    <input type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_usg" id='ket_usg' value="">
                </div>
            </div>

        </div>
        <div class="row ms-4 align-items-end">
            <div class="col mb-2">
                <label for="lakmus" class="form-label">Lakmus : </label>
                <div class="d-flex">
                    <select class="form-select " id="lakmus"  name="lakmus" aria-label="Default select example">
                    <option value="-" selected>Pilih </option>
                        <option value="Dilakukan" >Dilakukan</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                    <input type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_lakmus" id='ket_lakmus' value="">
                </div>
            </div>
            <div class="col mb-2">
                <label for="panggul" class="form-label">Pemeriksaan Panggul : </label>
                <div class="d-flex">
                    <select class="form-select " id="panggul"  name="panggul" aria-label="Default select example">
                    <option value="-" selected>Pilih </option>
                        <option value="Luas" >Luas</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Sempit">Sempit</option>
                        <option value="Tidak Dilakukan Pemeriksaan">Tidak Dilakukan Pemeriksaan</option>
                    </select>
                </div>
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
            <textarea class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3"></textarea>
        </div>
    </div>

    <div class="row">
        <label class="form-label">Riwayat Mensturasi</label>
        <div class="ms-2 row">
            <div class="col-3">
                <label for="umur" class="form-label">Umur Menarche : </label>
                <div class="input-group  me-2">
                    <input type="text" id="umur" name="umur" class="form-control">
                    <span class="input-group-text">tahun</span>
                </div>
            </div>
            <div class="col-3">
                <label for="lama" class="form-label">Lamanya : </label>
                <div class="input-group  me-2">
                    <input type="text" id="lama" name="lama" class="form-control">
                    <span class="input-group-text">hari</span>
                </div>
            </div>
            <div class="col-3">
                <label for="banyaknya" class="form-label">Banyaknya : </label>
                <div class="input-group  me-2">
                    <input type="text" id="banyaknya" name="banyaknya" class="form-control">
                    <span class="input-group-text">pembalut</span>
                </div>
            </div>  
            

            <div class="col-3">
                <label for="haid" class="form-label">Haid Terakhir : </label>
                <input type="text" id="haid" name="haid" class="form-control">
            </div>

            <div class="col-6 mb-2">
                <label for="siklus" class="form-label">Siklus : </label>
                <div class="d-flex">
                    <div class="input-group w-50 me-2">
                        <input type="text" id="siklus" name="siklus" class="form-control">
                        <span class="input-group-text" >hari</span>
                    </div>
                    <select class="form-select w-50" id="ket_siklus"  name="ket_siklus" aria-label="Default select example">
                        <option value="-" selected>Pilih Status</option>
                        <option value="Teratur" >Teratur</option>
                        <option value="Tidak Teratur">Tidak Teratur</option>
                    </select>
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="ket_siklus1" class="form-label">Masalah Yang dirasakan saat mensturasi : </label>
                <select class="form-select" id="ket_siklus1"  name="ket_siklus1" aria-label="Default select example">
                    <option value="-" selected>Pilih Status</option>
                    <option value="Tidak Ada Masalah" >Tidak Ada Masalah</option>
                    <option value="Dismenorhea">Dismenorhea</option>
                    <option value="Spotting">Spotting</option>
                    <option value="Menorhagia">Menorhagia</option>
                    <option value="PMS">PMS</option>
                </select>
            
            </div>
        </div>
    </div>
    <div class="row">
        <label class="form-label">Riwayat Perkawinan</label>
        <div class="ms-2 row">
            <div class="col-6 mb-2">
                <label for="status" class="form-label">Status Menikah : </label>
                <div class="d-flex">
                    <select class="form-select w-75" id="status"  name="status" aria-label="Default select example">
                        <option value="-" selected>Pilih Status</option>
                        <option value="Menikah" >Menikah</option>
                        <option value="Tidak / Belum Menikah">Tidak / Belum Menikah</option>
                    </select>
                    <div class="input-group w-25 me-2">
                        <input type="text" id="kali" name="kali" class="form-control">
                        <span class="input-group-text" >kali</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="ms-2 row ">
            <div class="col-6 mb-2">
                <label for="usia1" class="form-label">Usia Perkawinan 1 : </label>
                <div class="d-flex">
                    <input type="text" placeholder="Hasil" class="form-control" name="usia1" id='usia1' value="">
                    <select class="form-select " id="ket1"  name="ket1" aria-label="Default select example">
                        <option value="-" selected>Status </option>
                        <option value="Masih Menikah" >Masih Menikah</option>
                        <option value="Cerai">Cerai</option>
                        <option value="Meninggal">Meninggal</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="ms-2 row ">
            <div class="col-6 mb-2">
                <label for="usia2" class="form-label">Usia Perkawinan 2 : </label>
                <div class="d-flex">
                    <input type="text" placeholder="Hasil" class=" form-control" name="usia2" id='usia2' value="">
                    <select class="form-select " id="ket2"  name="ket2" aria-label="Default select example">
                        <option value="-" selected>Status </option>
                        <option value="Masih Menikah" >Masih Menikah</option>
                        <option value="Cerai">Cerai</option>
                        <option value="Meninggal">Meninggal</option>
                    </select>
                </div>
            </div>
        </div>        <div class="ms-2 row ">
            <div class="col-6 mb-2">
                <label for="usia3" class="form-label">Usia Perkawinan 3 : </label>
                <div class="d-flex">
                    <input type="text" placeholder="Hasil" class=" form-control" name="usia3" id='usia3' value="">
                    <select class="form-select " id="ket3"  name="ket3" aria-label="Default select example">
                        <option value="-" selected>Status </option>
                        <option value="Masih Menikah" >Masih Menikah</option>
                        <option value="Cerai">Cerai</option>
                        <option value="Meninggal">Meninggal</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <label class="form-label">Riwayat Kehamilan Tetap</label>
        <div class="ms-2 row">
            <div class="col-4 mb-2"> 
                <label for="hpht" class="form-label">HPHT : </label>
                <input type="text" class="form-control input-daterange input-date-time" name="hpht" id="hpht" value="" required autocomplete="off">

            </div>
            <div class="col-4 mb-2"> 
                <label for="usia_kehamilan" class="form-label">Usia Hamil : </label>
                <div class="input-group me-2">
                    <input type="text" id="usia_kehamilan" name="usia_kehamilan" class="form-control">
                    <span class="input-group-text">bln/mgg</span>
                </div>
            </div>
            <div class="col-4 mb-2"> 
                <label for="tp" class="form-label">TP : </label>
                <div class="input-group me-2">
                    <input type="text" class="form-control input-daterange input-date-time" name="tp" id="tp" value="" required autocomplete="off">
                </div>
            </div>
            <div class="col-4 mb-2"> 
                <label for="imunisasi" class="form-label">Riwayat Imunisasi : </label>
                <select class="form-select " id="imunisasi"  name="imunisasi" aria-label="Default select example">
                    <option value="-" selected>Pilih Status</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
            <div class="col-4 mb-2"> 
                <label for="ket_imunisasi" class="form-label">Imunisasi : </label>
                <div class="input-group me-2">
                    <input type="text" id="ket_imunisasi" name="ket_imunisasi" class="form-control">
                    <span class="input-group-text">kali</span>
                </div>
            </div>
            <div class="col-4 mb-2"> 
                <label for="g" class="form-label">G : </label>
                <div class="input-group me-2">
                    <input type="text" id="g" name="g" class="form-control">
                </div>
            </div>
            <div class="col-4 mb-2"> 
                <label for="p" class="form-label">P : </label>
                <div class="input-group me-2">
                    <input type="text" id="p" name="p" class="form-control">
                </div>
            </div>
            <div class="col-4 mb-2"> 
                <label for="a" class="form-label">A : </label>
                <div class="input-group me-2">
                    <input type="text" id="a" name="a" class="form-control">
                </div>
            </div>
            <div class="col-4 mb-2"> 
                <label for="hidup" class="form-label">Hidup : </label>
                <div class="input-group me-2">
                    <input type="text" id="hidup" name="hidup" class="form-control">
                </div>
            </div>
            <div class="col-12 mt-2 mb-2 overflow-auto border rounded p-3">
                <div class="d-flex mb-2 justify-content-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#persalinanPasien">
                        Tambah Riwayat Persalinan
                    </button>
                </div>
                <table class="table auto-number-table" id="tabelRiwayatPersalinan">
                    <thead align="center">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tgl/Tahun</th>
                            <th scope="col">Tempat Persalinan</th>
                            <th scope="col">Usia Hamil</th>
                            <th scope="col">Jenis Persalinan</th>
                            <th scope="col">Penolong</th>
                            <th scope="col">Penyulit</th>
                            <th scope="col">J.K</th>
                            <th scope="col">BB/PB</th>
                            <th scope="col">Keadaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row ms-2">
        </div>
        <label class="form-label">Riwayat KB</label>
        <div class="ms-2 row">
            <div class="col-3 mb-2"> 
                <label for="kb" class="form-label">Status Riwayat KB : </label>
                <select class="form-select " id="kb"  name="kb" aria-label="Default select example">
                    <option value="-" selected>Pilih Status</option>
                    <option value="Belum Pernah" >Belum Pernah</option>
                    <option value="Suntik" >Suntik</option>
                    <option value="Pil" >Pil</option>
                    <option value="AKDR" >AKDR</option>
                    <option value="MOW" >MOW</option>
                </select>
            </div>
            <div class="col-3 mb-2">
                <label for="ket_kb" class="form-label">Lamanya</label>
                <input type="text" class="form-control" name="ket_kb" id='ket_kb' >
            </div>
            <div class="col-6 mb-2">
                <label for="komplikasi" class="form-label">Komplikasi : </label>
                <div class="d-flex">
                    <select class="form-select " id="komplikasi"  name="komplikasi" aria-label="Default select example">
                    <option value="-" selected>Pilih Status</option>
                        <option value="Tidak Ada" >Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select>
                    <input type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_komplikasi" id='ket_komplikasi' value="">
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="berhenti" class="form-label">Kapan Berhenti KB : </label>
                <input type="text" placeholder="Hasil" class="form-control" id="berhenti"  name="berhenti" value="">
            </div>
            <div class="col-4 mb-2">
                <label for="alasan" class="form-label">Alasan : </label>
                <input type="text" placeholder="alasan" class="form-control" id="alasan"  name="alasan" value="">
            </div>
            <div class="col-4 mb-2">
                <label for="ginekologi" class="form-label">ginekologi : </label>
                <select class="form-select " id="ginekologi"  name="ginekologi" aria-label="Default select example">
                    <option value="-" selected>Pilih Status</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                    <option value="Infertilitas">Infertilitas</option>
                    <option value="Infeksi Virus" >Infeksi Virus</option>
                    <option value="PMS" >PMS</option>
                    <option value="Cervisitis" >Cervisitis</option>
                    <option value="Endometriosis" >Endometriosis</option>
                    <option value="Mioma" >Mioma</option>
                    <option value="Polip Cervix" >Polip Cervix</option>
                    <option value="Kanker Kandungan" >Kanker Kandungan</option>
                    <option value="Operasi Kandungan" >Operasi Kandungan</option>
                </select>
            </div>
        </div>
        <label class="form-label">Riwayat Kebiasaan</label>
        <div class="ms-2 row">
            <div class="col-12 mb-2">
                <label for="kebiasaan" class="form-label">Obat/Vitamin : </label>
                <div class="d-flex">
                    <select class="form-select w-25" id="kebiasaan"  name="kebiasaan" aria-label="Default select example">
                        <option value="-" selected>Pilih Status</option>
                        <option value="Obat Obatan" >Obat Obatan</option>
                        <option value="Vitamin" >Vitamin</option>
                        <option value="Jamu Jamuan">Jamu Jamuan</option>
                    </select>
                    <input type="text" placeholder="Keterangan" class="ms-2 form-control w-75" name="ket_kebiasaan" id='ket_kebiasaan' value="">
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="kebiasaan1" class="form-label">Merokok : </label>
                <div class="d-flex">
                    <select class="form-select me-2" id="kebiasaan1"  name="kebiasaan1" aria-label="Default select example">
                        <option value="-" selected>Pilih Status</option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ada">Ada</option>
                    </select>
                    <div class="input-group  me-2">
                        <input type="text" id="ket_kebiasaan1" name="ket_kebiasaan1" class="form-control">
                        <span class="input-group-text">batang/hari</span>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="kebiasaan2" class="form-label">Alkohol : </label>
                <div class="d-flex">
                    <select class="form-select me-2" id="kebiasaan2"  name="kebiasaan2" aria-label="Default select example">
                        <option value="-" selected>Pilih Status</option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ada">Ada</option>
                    </select>
                    <div class="input-group  me-2">
                        <input type="text" id="ket_kebiasaan2" name="ket_kebiasaan2" class="form-control">
                        <span class="input-group-text">gelas/hari</span>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="kebiasaan3" class="form-label">Obat Tidur/ Narkoba : </label>
                <select class="form-select me-2" id="kebiasaan3"  name="kebiasaan3" aria-label="Default select example">
                    <option value="-" selected>Pilih Status</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ada">Ada</option>
                </select>
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
                <select class="form-select w-25" id="alat_bantu"  name="alat_bantu" aria-label="Default select example">
                    <option value="-" selected>Pilih Alat Bantu</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_bantu" id='ket_bantu' value="">
            </div>
            
        </div>
        <div class="col mb-2">
            <label for="prothesa" class="form-label">Prothesa</label>
            <div class="d-flex">
                <select class="form-select w-25" id="prothesa"  name="prothesa" aria-label="Default select example">
                    <option value="-" selected>Pilih Prothesa</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_pro" id='ket_pro' value="">
            </div>
            
        </div>
    </div>

    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="cacat_fisik" class="form-label">Cacat Fisik</label>
            <input type="text" class="form-control" id="cacat_fisik"   value="-" readonly>
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
    <h5 class="text-start">V. RIWAYAT PSIKO SOSIAL, SPIRITUAL DAN BUDAYA </h5>
    <div class="row align-items-end">
        <div class="col mb-2">
            <label for="status_psiko" class="form-label">Status Psikologi</label>
            <div class="d-flex">
                <select class="form-select w-25" id="status_psiko"  name="status_psiko" aria-label="Default select example">
                    <option value="-" selected>Pilih Status Psikologi</option>
                    <option value="Tenang" >Tenang</option>
                    <option value="Takut">Takut</option>
                    <option value="Cemas">Cemas</option>
                    <option value="Depresi">Depresi</option>
                    <option value="Lain-Lain">Lain-Lain</option>
                </select>
                <input  type="text" class="form-control w-75" name="ket_psiko" id='ket_psiko' value="">
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
                    <select class="form-select " id="hub_keluarga"  name="hub_keluarga" aria-label="Default select example">
                        <option value="-" selected>Pilih Hub Keluarga</option>
                        <option value="Baik" >Baik</option>
                        <option value="Tidak Baik">Tidak Baik</option>
                    </select>
                </div>
            </div>
            <div class="col mb-2">
                <label for="tinggal_dengan" class="form-label">Tinggal dengan : </label>
                <div class="d-flex">
                    <select class="form-select " id="tinggal_dengan"  name="tinggal_dengan" aria-label="Default select example">
                    <option value="-" selected>Pilih Tinggal Dengan</option>
                        <option value="Sendiri" >Sendiri</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Suami / Istri" >Suami / Istri</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <input type="text" class="form-control" name="ket_tinggal" id='ket_tinggal' value="">
                </div>
            </div>
            <div class="col mb-2">
                <label for="ekonomi" class="form-label">Ekonomi :</label>
                <div class="d-flex">
                    <select class="form-select " id="ekonomi"  name="ekonomi" aria-label="Default select example">
                    <option value="-" selected>Pilih Status Ekonomi</option>

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
                    <option value="-" selected>Pilih Budaya</option>
                    <option value="Tidak Ada" >Tidak Ada</option>
                    <option value="Ada">Ada</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_budaya" id='ket_budaya' value="">
            </div>
            
        </div>
        <div class="col mb-2">
            <label for="edukasi" class="form-label">Edukasi diberikan kepada : </label>
            <div class="d-flex">
                <select class="form-select w-25" id="edukasi"  name="edukasi" aria-label="Default select example">
                <option value="-" selected>Pilih Edukasi</option>

                    <option value="Pasien" >Pasien</option>
                    <option value="Kelurga">Kelurga</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_edukasi" id='ket_edukasi' value="">
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
                        <select class="form-select" id="berjalan_a"  name="berjalan_a" aria-label="Default select example">
                        <option value="-" selected>Pilih Cara Berjalan</option>

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
                        <option value="-" selected>Pilih Alat Bantu</option>

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
            <label for="berjalan_c" class="form-label">b. Menopang Saat Akan Duduk, Tampak Memegang Kursi atau Meja/ benda lagi sebagai penopang :</label>
            <select class="form-select " id="berjalan_c"  name="berjalan_c" aria-label="Default select example">
                <option value="-" selected>Pilih Alat Bantu</option>

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
                <option value="-" selected>Pilih Hasil</option>
                    <option value="Tidak Beresiko (Tidak Ditemukan A Dan B)" >Tidak Berisiko (Tidak ditemukan a dan b) </option>
                    <option value="Resiko rendah (ditemukan A/B)" >Resiko Rendah (Ditemukan a / b) </option>
                    <option value="Resiko tinggi (ditemukan A dan B)" >Resiko Tinggi (Ditemukan a dan b) </option>
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
            <input type="text" class="form-control" name="ket_lapor" id="ket_lapor" value="">
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">VII. SKRINNING GIZI</h5>
    <div class="row mb-2">
        <label for="sg1" class="form-label">Apakah ada penurunan berat badan yang tidak diinginkan selamat 6 bulan terakhir ?</label>
        <div class="d-flex">
            <select class="form-select w-25 me-4" id="sg1"  name="sg1" aria-label="Default select example">
                <option value="-" selected>Pilih Status</option>
                <option value="Tidak">Tidak</option>
                <option value="Tidak Yakin">Tidak Yakin</option>
                <option value="Ya, 1-5 Kg">Ya, 1-5 Kg</option>
                <option value="Ya, 6-10 Kg">Ya, 6-10 Kg</option>
                <option value="Ya, 11-15 Kg">Ya, 11-15 Kg</option>
                <option value="Ya, >15 Kg">Ya, >15 Kg</option>
            </select>
            <select class="form-select w-25 me-4" id="nilai1"  name="nilai1" aria-label="Default select example">
                <option value="-" selected>Pilih Nilai</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        
    </div>
    <div class="row mb-2">
        <label for="sg2" class="form-label">Apakah asupan makan berkurang karena tidak nafsu makan ? </label>
        <div class="d-flex">
            <select class="form-select w-25 me-4" id="sg2"  name="sg2" aria-label="Default select example">
            <option value="-" selected>Pilih Status</option>
                <option value="Tidak" >Tidak</option>
                <option value="Ya">Ya</option>
            </select>
            <select class="form-select w-25 me-4" id="nilai2"  name="nilai2" aria-label="Default select example">
                <option value="-" selected>Pilih Nilai</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
    </div>

    <div class="row mb-2">
        <label for="total_hasil" class="form-label">Total Skor</label>
        <div class="d-flex">
            <input type="text" class="w-25 form-control" name="total_hasil" id="total_hasil" placeholder="Nilai" >
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
                    <select class="form-select"  id="nyeri"  name="nyeri" aria-label="Default select example">
                    <option value="-" selected>Pilih Rasa Nyeri</option>

                        <option value="Tidak Ada Nyeri" >Tidak Ada Nyeri</option>
                        <option value="Nyeri Akut">Nyeri Akut</option>
                        <option value="Nyeri Kronis">Nyeri Kronis</option>
                    </select>
                </div>
                <div class="col-8">
                    <label for="provokes" class="form-label">Penyebab</label>
                    <div class="d-flex">
                        <select id="provokes"  name="provokes" class="form-select w-50 me-2" aria-label="Default select example">
                        <option value="-" selected>Pilih Penyebab</option>

                            <option value="Proses Penyakit" >Proses Penyakit</option>
                            <option value="Benturan">Benturan</option>
                            <option value="Lain-Lain">Lain-Lain</option>
                        </select>
                        <input type="text" class=" form-control" name="ket_provokes" id="ket_provokes" placeholder="Nilai" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="quality" class="form-label">Kualitas:</label>
                    <div class="d-flex">
                        <select class="w-25 me-2 form-select" id="quality"  name="quality" aria-label="Default select example">
                        <option value="-" selected>Pilih Kualitas</option>

                            <option value="Seperti Tertusuk" >Seperti Tertusuk</option>
                            <option value="Berdenyut">Berdenyut</option>
                            <option value="Teriris">Teriris</option>
                            <option value="Tertindih">Tertindih</option>
                            <option value="Tertiban">Tertiban</option>
                            <option value="Lain-Lain">Lain-Lain</option>
                        </select>
                        <input type="text" class="w-75 form-control" name="ket_quality" id="ket_quality"  placeholder="Nilai" >
                    </div>
                </div>
            </div>

            <div class="row">
                <label for="" class="form-label">Wilayah:</label>
                <div class="col ms-4">
                    <label for="lokasi" class="form-label">Lokasi:</label>
                    <input type="text" id="lokasi"  name="lokasi" class=" form-control" name=""  placeholder="Nilai" >
                </div>
                <div class="col">
                    <label for="menyebar" class="form-label">Menyebar:</label>
                    <select class=" form-select"  id="menyebar"  name="menyebar" aria-label="Default select example">
                    <option value="-" selected>Pilih Status Menyebar</option>

                        <option value="Tidak" >Tidak</option>
                        <option value="Ya">Ya</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <label for="" class="form-label">Severity:</label>                
                <div class="col ms-4    ">
                    <label for="skala_nyeri" class="form-label">Skala Nyeri:</label>
                    <select class=" form-select" id="skala_nyeri"  name="skala_nyeri" aria-label="Default select example">
                    <option value="-" selected>Pilih Skala Nyeri</option>
                        @for($i=0; $i <=10 ;$i++)
                            <option value="{{$i}}" >{{$i}}</option>
                        @endfor
                    </select>
                </div>

                <div class="col ">
                    <label for="durasi" class="form-label">Waktu / Durasi:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="durasi"  name="durasi">
                        <span class="input-group-text">Menit</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label for="nyeri_hilang" class="form-label">Nyeri Hilang Bila:</label>
                    <div class="d-flex">
                        <select class="form-select me-2" id="nyeri_hilang"  name="nyeri_hilang" aria-label="Default select example">
                        <option value="-" selected>Pilih </option>

                            <option value="Istirahat" >Istirahat</option>
                            <option value="Mendengar Musik">Mendengar Musik</option>
                            <option value="Minum Obat">Minum Obat</option>
                        </select>
                        <input type="text" class=" form-control" name="ket_nyeri" id="ket_nyeri" placeholder="Nilai" >
                    </div>
                </div>
                <div class="col-8">
                    <label for="pada_dokter" class="form-label">Diberitahukan Kepada Dokter ?</label>
                    <div class="row">
                        <div class="col-4">
                            <select class=" form-select" id="pada_dokter"  name="pada_dokter" aria-label="Default select example">
                            <option value="-" selected>Pilih </option>

                                <option value="Tidak" >Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <label for="ket_dokter" class="form-label m-0 me-2">Jam:</label>
                            <input type="text" name="ket_dokter" id="ket_dokter" class="form-control">
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
        <div class="col-6  border-end" >
            <h5 class="text-center">MASALAH KEBIDANAN </h5>
            <hr class="mb-2">
            <div class="overflow-auto h-75 alternate_child_color  px-3" >
                <label for="rencana" class="form-label">Masalah</label>
                <textarea class="form-control" id="masalah" name="masalah" rows="5"></textarea>
            </div>
        </div>
        <div class="col-6 " >
            <h5 class="text-center">TINDAKAN</h5>
            <hr class="mb-2">
            <div class="overflow-auto h-75 alternate_child_color  px-3" >
                <div class="mb-3">
                    <label for="tindakan" class="form-label">Tindakan</label>
                    <textarea class="form-control" id="tindakan" name="tindakan" rows="5"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
</form> 


<!-- Modal Petugas Daftar Tindakan -->
<div class="modal fade bagan-data-table" id="showModalPetugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content overflow-auto">
                <div class="modal-header border-0 pb-0">
                    <div class="col-6">
                        <div class="d-flex justify-content-center align-items-center border">
                            <input type="text" class="form-control border-0 search-data-table" placeholder="Masukkan kata yang akan dicari">
                            <button type="submit" class="btn btn-white">
                                <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal" id="closeModalPetugasDT" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table data-table border" >
                        <thead>
                            <tr>
                                <th scope="col" class="py-4 ps-4">NIP</th>
                                <th scope="col" class="py-4" style="width: 35%;">Nama Petugas</th>
                                <th scope="col" class="py-4">Alamat</th>
                                <th scope="col" class="py-4 pe-4">Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petugas_list as $petugas)
                                @php 
                                    $nama = $petugas["nama"]; 
                                    $nip= $petugas["nip"];
                                @endphp
                                <tr>
                                    <td class="py-3 ps-4">{{ $petugas["nip"] }}</td>
                                    <td class="py-3"> <span class="text-primary hover-pointer set-value-data-table" data-target="#nip@val|#namaPetugas@val" data-value='{{$nip}}|{{$nama}}'>{{ $nama }}</span></td>
                                    <td class="py-3">{{ $petugas["alamat"] }}</td>
                                    <td class="py-3">{{ $petugas["nm_jbtn"] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- modal riwayat Persalinan Pasien--}}
<div class="modal fade" id="persalinanPasien" tabindex="-1" aria-labelledby="persalinanPasien" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <form onsubmit="event.preventDefault()" >
            <div class="modal-header">
              <h5 class="modal-title" id="persalinanPasienLabel">Tambah Riwayat Persalinan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8 mb-2">
                        <label for="tempat_persalinan" class="form-label">Tempat Persalinan</label>
                        <input type="text" class="form-control" name="tempat_persalinan"  id='tempat_persalinan' >
                    </div>
                    <div class="col-4 mb-2">
                        <label for="tgl_thn" class="form-label">Tanggal/Tahun</label>
                        <input type="text" class="form-control input-daterange input-date" name="tgl_thn"  id="tgl_thn" value="" required autocomplete="off">
                    </div>
                    <div class="col-8 mb-2">
                        <label for="jenis_persalinan" class="form-label">Jenis Persalinan</label>
                        <input type="text" class="form-control"  id='jenis_persalinan'  name="jenis_persalinan">
                    </div>
                    <div class="col-4 mb-2">
                        <label for="usia_hamil" class="form-label">Usia Hamil</label>
                        <input type="text" class="form-control"  id='usia_hamil' name="usia_hamil">
                    </div>
                    <div class="col-8 mb-2">
                        <label for="penolong" class="form-label">Penolong</label>
                        <input type="text" class="form-control"  id='penolong' name="penolong">
                    </div>
                    <div class="col-4 mb-2">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jk" name="jk" aria-label="Default select ">
                            <option value="" selected>Pilih Jenis Kelamin</option>
                            <option value="L" >Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-8 mb-2">
                        <label for="penyulit" class="form-label">Penyulit</label>
                        <input type="text" class="form-control"  id='penyulit' name="penyulit">
                    </div>
                    <div class="col-4 mb-2">
                        <label for="bbpb" class="form-label">BB/PB</label>
                        <input type="text" class="form-control"  id='bbpb' name="bbpb">
                    </div>
                    <div class="col-8 mb-2">
                        <label for="keadaan" class="form-label">Keadaan</label>
                        <input type="text" class="form-control"  id='keadaan' name="keadaan">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
  </div>
</div>
    {{-- <div>Penilaian Keperawatan Kebidanan Kandungan</div> --}}