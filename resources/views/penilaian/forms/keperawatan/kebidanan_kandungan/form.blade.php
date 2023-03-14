{{-- @php
    echo "<pre>";
    print_r($penilaian);
    echo "</pre>";
@endphp  --}}
<form action="{{url('/penilaian-perawat-kebidanan/update')}}" method="post" id="penilaian_perawat_kandungan">
    @csrf
    {{-- <input type="text" hidden name="penilaian_key" value='{{json_encode($penilaian)}}'> --}}
    <div class="row mb-3">
        @include('penilaian.form_header', [
            "pj_form_type"=>"bidan", 
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
                    <input  type="text" name="td" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}"  id="td" class="form-control">
                    <span class="input-group-text">mmHg</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="nadi" class="form-label">Nadi : </label>
                <div class="input-group">
                    <input  type="text" id="nadi" name="nadi" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}"  class="form-control">
                    <span class="input-group-text">x / Menit</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="rr" class="form-label">RR : </label>
                <div class="input-group">
                    <input  type="text" id="rr" name="rr" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}"  class="form-control">
                    <span class="input-group-text">x / Menit</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="suhu" class="form-label">Suhu : </label>
                <div class="input-group">
                    <input  type="text" id="suhu" name="suhu" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}"  class="form-control">
                    <span class="input-group-text">&#8451;</span>
                </div>
            </div>

            <div class="col mb-2">
                <label for="gcs" class="form-label">GCS(E, V, M) : </label>
                <div class="input-group">
                    <input  type="text" id="gcs" name="gcs" value="{{!empty($penilaian->gcs) ? $penilaian->gcs : ''}}"  class="form-control">
                </div>
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col mb-2">
                <label for="bb" class="form-label">BB : </label>
                <div class="input-group">
                    <input  type="text" id="bb" name="bb" value="{{!empty($penilaian->bb) ? $penilaian->bb : ''}}"  class="form-control">
                    <span class="input-group-text">Kg</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="tb" class="form-label">TB : </label>
                <div class="input-group">
                    <input  type="text" id="tb" name="tb" value="{{!empty($penilaian->tb) ? $penilaian->tb : ''}}"  class="form-control">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="lila" class="form-label">LILA : </label>
                <div class="input-group">
                    <input  type="text" id="lila" name="lila" value="{{!empty($penilaian->lila) ? $penilaian->lila : ''}}"  class="form-control">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
            <div class="col mb-2">
                <label for="bmi" class="form-label">BMI : </label>
                <div class="input-group">
                    <input  type="text" id="bmi" name="bmi" value="{{!empty($penilaian->bmi) ? $penilaian->bmi : ''}}"  class="form-control">
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
                    <input  type="text" name="tfu" value="{{!empty($penilaian->tfu) ? $penilaian->tfu : ''}}"  id="tfu" class="form-control">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="tbj" class="form-label">TBJ : </label>
                <div class="input-group">
                    <input  type="text" id="tbj" name="tbj" value="{{!empty($penilaian->tbj) ? $penilaian->tbj : ''}}"  class="form-control">
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="letak" class="form-label">Letak : </label>
                <div class="input-group">
                    <input  type="text" id="letak" name="letak" value="{{!empty($penilaian->letak) ? $penilaian->letak : ''}}"  class="form-control">
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="presentasi" class="form-label">Presentasi : </label>
                <div class="input-group">
                    <input  type="text" id="presentasi" name="presentasi" value="{{!empty($penilaian->presentasi) ? $penilaian->presentasi : ''}}"  class="form-control">
                </div>
            </div>

            <div class="col-4 mb-2">
                <label for="penurunan" class="form-label">Penurunan : </label>
                <div class="input-group">
                    <input  type="text" id="penurunan" name="penurunan" value="{{!empty($penilaian->penurunan) ? $penilaian->penurunan : ''}}"  class="form-control">
                </div>
            </div>

            <div class="col-4 mb-2">
                <label for="his" class="form-label">Kontraksi/HIS : </label>
                <div class="input-group me-2">
                    <input  type="text" id="his" name="his" value="{{!empty($penilaian->his) ? $penilaian->his : ''}}"  class="form-control">
                    <span class="input-group-text">x/10</span>
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="kekuatan" class="form-label">Kekuatan : </label>
                <div class="input-group">
                    <input  type="text" name="kekuatan" value="{{!empty($penilaian->kekuatan) ? $penilaian->kekuatan : ''}}"  id="kekuatan" class="form-control">
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="lamanya" class="form-label">Lamanya : </label>
                <div class="input-group">
                    <input  type="text" name="lamanya" value="{{!empty($penilaian->lamanya) ? $penilaian->lamanya : ''}}"  id="lamanya" class="form-control">
                    <span class="input-group-text">detik</span>
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="bjj" class="form-label">Gerak Janin x/30 menit, DJJ : </label>
                <div class="d-flex">
                    <div class="input-group w-50 me-2">
                        <input  type="text" id="bjj" name="bjj" value="{{!empty($penilaian->bjj) ? $penilaian->bjj : ''}}"  class="form-control">
                        <span class="input-group-text" >/mnt</span>
                    </div>
                    <select class="form-select w-50" id="ket_bjj"  name="ket_bjj" aria-label="Default select example">
                        <option value="-"  {{$penilaian->ket_bjj === "-" ? "selected" : ""}} >Pilih Status</option>
                        <option value="Teratur"  {{$penilaian->ket_bjj === "Teratur" ? "selected" : ""}} >Teratur</option>
                        <option value="Tidak Teratur"  {{$penilaian->ket_bjj === "Tidak Teratur" ? "selected" : ""}}>Tidak Teratur</option>
                    </select> 
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="portio" class="form-label">Portio : </label>
                <div class="input-group">
                    <input  type="text" name="portio" value="{{!empty($penilaian->portio) ? $penilaian->portio : ''}}"  id="portio" class="form-control">
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="serviks" class="form-label">Pembukaan Serviks : </label>
                <div class="input-group">
                    <input  type="text" name="serviks" value="{{!empty($penilaian->serviks) ? $penilaian->serviks : ''}}"  id="serviks" class="form-control">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="ketuban" class="form-label">Ketuban : </label>
                <div class="input-group">
                    <input  type="text" name="ketuban" value="{{!empty($penilaian->ketuban) ? $penilaian->ketuban : ''}}"  id="ketuban" class="form-control">
                    <span class="input-group-text">kep/bok</span>
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="hodge" class="form-label">Hodge : </label>
                <div class="input-group">
                    <input  type="text" name="hodge" value="{{!empty($penilaian->hodge) ? $penilaian->hodge : ''}}"  id="hodge" class="form-control">
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
                        <option value="-"  {{$penilaian->inspekulo === "-" ? "selected" : ""}} >Pilih </option>
                            <option value="Dilakukan"  {{$penilaian->inspekulo === "Dilakukan" ? "selected" : ""}} >Dilakukan</option>
                            <option value="Tidak"  {{$penilaian->inspekulo === "Tidak" ? "selected" : ""}}>Tidak</option>
                        </select> 
                        <input  type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_inspekulo" value="{{!empty($penilaian->ket_inspekulo) ? $penilaian->ket_inspekulo : ''}}"  id='ket_inspekulo' value="">
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="ctg" class="form-label">CTG : </label>
                    <div class="d-flex">
                        <select class="form-select " id="ctg"  name="ctg" aria-label="Default select example">
                        <option value="-"  {{$penilaian->ctg === "-" ? "selected" : ""}} >Pilih </option>
                            <option value="Dilakukan"  {{$penilaian->ctg === "Dilakukan" ? "selected" : ""}} >Dilakukan</option>
                            <option value="Tidak"  {{$penilaian->ctg === "Tidak" ? "selected" : ""}}>Tidak</option>
                        </select> 
                        <input  type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_ctg" value="{{!empty($penilaian->ket_ctg) ? $penilaian->ket_ctg : ''}}"  id='ket_ctg' value="">
                    </div>
                </div>

            </div>
            <div class="row ms-4 align-items-end">
                <div class="col mb-2">
                    <label for="lab" class="form-label">Laboratorium : </label>
                    <div class="d-flex">
                        <select class="form-select " id="lab"  name="lab" aria-label="Default select example">
                        <option value="-"  {{$penilaian->lab === "-" ? "selected" : ""}} >Pilih </option>
                            <option value="Dilakukan"  {{$penilaian->lab === "Dilakukan" ? "selected" : ""}} >Dilakukan</option>
                            <option value="Tidak"  {{$penilaian->lab === "Tidak" ? "selected" : ""}}>Tidak</option>
                        </select> 
                        <input  type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_lab" value="{{!empty($penilaian->ket_lab) ? $penilaian->ket_lab : ''}}"  id='ket_lab' value="">
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="usg" class="form-label">USG : </label>
                    <div class="d-flex">
                        <select class="form-select " id="usg"  name="usg" aria-label="Default select example">
                        <option value="-"  {{$penilaian->usg === "-" ? "selected" : ""}} >Pilih </option>
                            <option value="Dilakukan"  {{$penilaian->usg === "Dilakukan" ? "selected" : ""}} >Dilakukan</option>
                            <option value="Tidak"  {{$penilaian->usg === "Tidak" ? "selected" : ""}}>Tidak</option>
                        </select> 
                        <input  type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_usg" value="{{!empty($penilaian->ket_usg) ? $penilaian->ket_usg : ''}}"  id='ket_usg' value="">
                    </div>
                </div>

            </div>
            <div class="row ms-4 align-items-end">
                <div class="col mb-2">
                    <label for="lakmus" class="form-label">Lakmus : </label>
                    <div class="d-flex">
                        <select class="form-select " id="lakmus"  name="lakmus" aria-label="Default select example">
                        <option value="-"  {{$penilaian->lakmus === "-" ? "selected" : ""}} >Pilih </option>
                            <option value="Dilakukan"  {{$penilaian->lakmus === "Dilakukan" ? "selected" : ""}} >Dilakukan</option>
                            <option value="Tidak"  {{$penilaian->lakmus === "Tidak" ? "selected" : ""}}>Tidak</option>
                        </select> 
                        <input  type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_lakmus" value="{{!empty($penilaian->ket_lakmus) ? $penilaian->ket_lakmus : ''}}"  id='ket_lakmus' value="">
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="panggul" class="form-label">Pemeriksaan Panggul : </label>
                    <div class="d-flex">
                        <select class="form-select " id="panggul"  name="panggul" aria-label="Default select example">
                        <option value="-"  {{$penilaian->panggul === "-" ? "selected" : ""}} >Pilih </option>
                            <option value="Luas"  {{$penilaian->panggul === "Luas" ? "selected" : ""}} >Luas</option>
                            <option value="Sedang"  {{$penilaian->panggul === "Sedang" ? "selected" : ""}}>Sedang</option>
                            <option value="Sempit"  {{$penilaian->panggul === "Sempit" ? "selected" : ""}}>Sempit</option>
                            <option value="Tidak Dilakukan Pemeriksaan"  {{$penilaian->panggul === "Tidak Dilakukan Pemeriksaan" ? "selected" : ""}}>Tidak Dilakukan Pemeriksaan</option>
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
                <textarea  class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{!empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : ''}}</textarea>
            </div>
        </div>

        <div class="row">
            <label class="form-label">Riwayat Mensturasi</label>
            <div class="ms-2 row">
                <div class="col-3">
                    <label for="umur" class="form-label">Umur Menarche : </label>
                    <div class="input-group  me-2">
                        <input  type="text" id="umur" name="umur" value="{{!empty($penilaian->umur) ? $penilaian->umur : ''}}"  class="form-control">
                        <span class="input-group-text">tahun</span>
                    </div>
                </div>
                <div class="col-3">
                    <label for="lama" class="form-label">Lamanya : </label>
                    <div class="input-group  me-2">
                        <input  type="text" id="lama" name="lama" value="{{!empty($penilaian->lama) ? $penilaian->lama : ''}}"  class="form-control">
                        <span class="input-group-text">hari</span>
                    </div>
                </div>
                <div class="col-3">
                    <label for="banyaknya" class="form-label">Banyaknya : </label>
                    <div class="input-group  me-2">
                        <input  type="text" id="banyaknya" name="banyaknya" value="{{!empty($penilaian->banyaknya) ? $penilaian->banyaknya : ''}}"  class="form-control">
                        <span class="input-group-text">pembalut</span>
                    </div>
                </div>  
                

                <div class="col-3">
                    <label for="haid" class="form-label">Haid Terakhir : </label>
                    <input  type="text" id="haid" name="haid" value="{{!empty($penilaian->haid) ? $penilaian->haid : ''}}"  class="form-control">
                </div>

                <div class="col-6 mb-2">
                    <label for="siklus" class="form-label">Siklus : </label>
                    <div class="d-flex">
                        <div class="input-group w-50 me-2">
                            <input  type="text" id="siklus" name="siklus" value="{{!empty($penilaian->siklus) ? $penilaian->siklus : ''}}"  class="form-control">
                            <span class="input-group-text" >hari</span>
                        </div>
                        <select class="form-select w-50" id="ket_siklus"  name="ket_siklus" aria-label="Default select example">
                            <option value="-"  {{$penilaian->ket_siklus === "-" ? "selected" : ""}} >Pilih Status</option>
                            <option value="Teratur"  {{$penilaian->ket_siklus === "Teratur" ? "selected" : ""}} >Teratur</option>
                            <option value="Tidak Teratur"  {{$penilaian->ket_siklus === "Tidak Teratur" ? "selected" : ""}}>Tidak Teratur</option>
                        </select> 
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <label for="ket_siklus1" class="form-label">Masalah Yang dirasakan saat mensturasi : </label>
                    <select class="form-select" id="ket_siklus1"  name="ket_siklus1" aria-label="Default select example">
                        <option value="-"  {{$penilaian->ket_siklus1 === "-" ? "selected" : ""}} >Pilih Status</option>
                        <option value="Tidak Ada Masalah"  {{$penilaian->ket_siklus1 === "Tidak Ada Masalah" ? "selected" : ""}} >Tidak Ada Masalah</option>
                        <option value="Dismenorhea"  {{$penilaian->ket_siklus1 === "Dismenorhea" ? "selected" : ""}}>Dismenorhea</option>
                        <option value="Spotting"  {{$penilaian->ket_siklus1 === "Spotting" ? "selected" : ""}}>Spotting</option>
                        <option value="Menorhagia"  {{$penilaian->ket_siklus1 === "Menorhagia" ? "selected" : ""}}>Menorhagia</option>
                        <option value="PMS"  {{$penilaian->ket_siklus1 === "PMS" ? "selected" : ""}}>PMS</option>
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
                            <option value="-"  {{$penilaian->status === "-" ? "selected" : ""}} >Pilih Status</option>
                            <option value="Menikah"  {{$penilaian->status === "Menikah" ? "selected" : ""}} >Menikah</option>
                            <option value="Tidak / Belum Menikah"  {{$penilaian->status === "Tidak / Belum Menikah" ? "selected" : ""}}>Tidak / Belum Menikah</option>
                        </select> 
                        <div class="input-group w-25 me-2">
                            <input  type="text" id="kali" name="kali" value="{{!empty($penilaian->kali) ? $penilaian->kali : ''}}"  class="form-control">
                            <span class="input-group-text" >kali</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ms-2 row ">
                <div class="col-6 mb-2">
                    <label for="usia1" class="form-label">Usia Perkawinan 1 : </label>
                    <div class="d-flex">
                        <input  type="text" placeholder="Hasil" class="form-control" name="usia1" value="{{!empty($penilaian->usia1) ? $penilaian->usia1 : ''}}"  id='usia1' value="">
                        <select class="form-select " id="ket1"  name="ket1" aria-label="Default select example">
                            <option value="-"  {{$penilaian->usia1 === "-" ? "selected" : ""}} >Status </option>
                            <option value="Masih Menikah"  {{$penilaian->usia1 === "Masih Menikah" ? "selected" : ""}} >Masih Menikah</option>
                            <option value="Cerai"  {{$penilaian->usia1 === "Cerai" ? "selected" : ""}}>Cerai</option>
                            <option value="Meninggal"  {{$penilaian->usia1 === "Meninggal" ? "selected" : ""}}>Meninggal</option>
                        </select> 
                    </div>
                </div>
            </div>
            <div class="ms-2 row ">
                <div class="col-6 mb-2">
                    <label for="usia2" class="form-label">Usia Perkawinan 2 : </label>
                    <div class="d-flex">
                        <input  type="text" placeholder="Hasil" class=" form-control" name="usia2" value="{{!empty($penilaian->usia2) ? $penilaian->usia2 : ''}}"  id='usia2' value="">
                        <select class="form-select " id="ket2"  name="ket2" aria-label="Default select example">
                            <option value="-"  {{$penilaian->ket2 === "-" ? "selected" : ""}} >Status </option>
                            <option value="Masih Menikah"  {{$penilaian->ket2 === "Masih Menikah" ? "selected" : ""}} >Masih Menikah</option>
                            <option value="Cerai"  {{$penilaian->ket2 === "Cerai" ? "selected" : ""}}>Cerai</option>
                            <option value="Meninggal"  {{$penilaian->ket2 === "Meninggal" ? "selected" : ""}}>Meninggal</option>
                        </select> 
                    </div>
                </div>
            </div>        <div class="ms-2 row ">
                <div class="col-6 mb-2">
                    <label for="usia3" class="form-label">Usia Perkawinan 3 : </label>
                    <div class="d-flex">
                        <input  type="text" placeholder="Hasil" class=" form-control" name="usia3" value="{{!empty($penilaian->usia3) ? $penilaian->usia3 : ''}}"  id='usia3' value="">
                        <input  type="text" class="form-control" id="ket3" value="{{!empty($penilaian->ket3) ? $penilaian->ket3 : ''}}">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="form-label">Riwayat Kehamilan Tetap</label>
            <div class="ms-2 row">
                <div class="col-4 mb-2"> 
                    <label for="hpht" class="form-label">HPHT : </label>
                    <input  type="text" class="form-control input-daterange input-date-time" name="hpht" value="{{!empty($penilaian->hpht) ? $penilaian->hpht : ''}}"  id="hpht" value="" required autocomplete="off">

                </div>
                <div class="col-4 mb-2"> 
                    <label for="usia_kehamilan" class="form-label">Usia Hamil : </label>
                    <div class="input-group me-2">
                        <input  type="text" id="usia_kehamilan" name="usia_kehamilan" value="{{!empty($penilaian->usia_kehamilan) ? $penilaian->usia_kehamilan : ''}}"  class="form-control">
                        <span class="input-group-text">bln/mgg</span>
                    </div>
                </div>
                <div class="col-4 mb-2"> 
                    <label for="tp" class="form-label">TP : </label>
                    <div class="input-group me-2">
                        <input  type="text" class="form-control input-daterange input-date-time" name="tp" value="{{!empty($penilaian->tp) ? $penilaian->tp : ''}}"  id="tp" value="" required autocomplete="off">
                    </div>
                </div>
                <div class="col-4 mb-2"> 
                    <label for="imunisasi" class="form-label">Riwayat Imunisasi : </label>
                    <select class="form-select " id="imunisasi"  name="imunisasi" aria-label="Default select example">
                        <option value="-"  {{$penilaian->imunisasi === "-" ? "selected" : ""}} >Pilih Status</option>
                        <option value="Tidak"  {{$penilaian->imunisasi === "Tidak" ? "selected" : ""}} >Tidak</option>
                        <option value="Ya"  {{$penilaian->imunisasi === "Ya" ? "selected" : ""}}>Ya</option>
                    </select> 
                </div>
                <div class="col-4 mb-2"> 
                    <label for="ket_imunisasi" class="form-label">Imunisasi : </label>
                    <div class="input-group me-2">
                        <input  type="text" id="ket_imunisasi" name="ket_imunisasi" value="{{!empty($penilaian->ket_imunisasi) ? $penilaian->ket_imunisasi : ''}}"  class="form-control">
                        <span class="input-group-text">kali</span>
                    </div>
                </div>
                <div class="col-4 mb-2"> 
                    <label for="g" class="form-label">G : </label>
                    <div class="input-group me-2">
                        <input  type="text" id="g" name="g" value="{{!empty($penilaian->g ? $penilaian->g : '')}}"  class="form-control">
                    </div>
                </div>
                <div class="col-4 mb-2"> 
                    <label for="p" class="form-label">P : </label>
                    <div class="input-group me-2">
                        <input  type="text" id="p" name="p" value="{{!empty($penilaian->p ? $penilaian->p : '')}}"  class="form-control">
                    </div>
                </div>
                <div class="col-4 mb-2"> 
                    <label for="a" class="form-label">A : </label>
                    <div class="input-group me-2">
                        <input  type="text" id="a" name="a" value="{{!empty($penilaian->a ? $penilaian->a : '')}}"  class="form-control">
                    </div>
                </div>
                <div class="col-4 mb-2"> 
                    <label for="hidup" class="form-label">Hidup : </label>
                    <div class="input-group me-2">
                        <input  type="text" id="hidup" name="hidup" value="{{!empty($penilaian->hidup) ? $penilaian->hidup : ''}}"  class="form-control">
                    </div>
                </div>
                <div class="col-12 mt-2 mb-2 overflow-auto border rounded p-3">
                    <div class="d-flex mb-2 justify-content-end">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePersalinanForm" aria-expanded="false" aria-controls="collapsePersalinanForm">
                            Tambah Riwayat Persalinan
                        </button>
                    </div>
                    <div class="collapse" id="collapsePersalinanForm">
                        <div class="card card-body">
                            <div  id="editPersalinanForm">
                                <div class="row">
                                    <div class="col-8 mb-2">
                                        <label for="tempat_persalinan" class="form-label">Tempat Persalinan</label>
                                        <input type="text" class="form-control"   id='tempat_persalinan' >
                                    </div>
                                    <div class="col-4 mb-2">
                                        <label for="tgl_thn" class="form-label">Tanggal/Tahun</label>
                                        <input type="date" class="form-control "   id="tgl_thn" value=""  autocomplete="off">
                                    </div>
                                    <div class="col-8 mb-2">
                                        <label for="jenis_persalinan" class="form-label">Jenis Persalinan</label>
                                        <input type="text" class="form-control"  id='jenis_persalinan'  >
                                    </div>
                                    <div class="col-4 mb-2">
                                        <label for="usia_hamil" class="form-label">Usia Hamil</label>
                                        <input type="text" class="form-control"  id='usia_hamil' >
                                    </div>
                                    <div class="col-8 mb-2">
                                        <label for="penolong" class="form-label">Penolong</label>
                                        <input type="text" class="form-control"  id='penolong' >
                                    </div>
                                    <div class="col-4 mb-2">
                                        <label for="jk" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" id="jk"  aria-label="Default select ">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="L" >Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-8 mb-2">
                                        <label for="penyulit" class="form-label">Penyulit</label>
                                        <input type="text" class="form-control"  id='penyulit' >
                                    </div>
                                    <div class="col-4 mb-2">
                                        <label for="bbpb" class="form-label">BB/PB</label>
                                        <input type="text" class="form-control"  id='bbpb' >
                                    </div>
                                    <div class="col-8 mb-2">
                                        <label for="keadaan" class="form-label">Keadaan</label>
                                        <input type="text" class="form-control"  id='keadaan' >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePersalinanForm" aria-expanded="false" aria-controls="collapsePersalinanForm">
                                        Batal
                                    </button>
                                    <button type="button" onclick="tambahEditDataRiwayat()"  class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table auto-number-table" id="tabelEditRiwayatPersalinan">
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
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persalinan as $key => $value)
                                <tr id='persalinan_{{$key}}'>
                                    <td><input  type="text" hidden name="persalinan_table_{{$key}}" value='{{json_encode($value)}}'></td>
                                    <td>{{$value->tgl_thn}}</td>
                                    <td>{{$value->tempat_persalinan}}</td>
                                    <td>{{$value->usia_hamil}}</td>
                                    <td>{{$value->jenis_persalinan}}</td>
                                    <td>{{$value->penolong}}</td>
                                    <td>{{$value->penyulit}}</td>
                                    <td>{{$value->jk}}</td>
                                    <td>{{$value->bbpb}}</td>
                                    <td>{{$value->keadaan}}</td>
                                    <td><button type="button" class="btn btn-danger" onclick="hapusDataRiwayat('persalinan_{{$key}}')">Hapus</button></td>
                                </tr>
                            @endforeach
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
                        <option value="-"  {{$penilaian->kb === "-" ? "selected" : ""}} >Pilih Status</option>
                        <option value="Belum Pernah"  {{$penilaian->kb === "Belum Pernah" ? "selected" : ""}} >Belum Pernah</option>
                        <option value="Suntik"  {{$penilaian->kb === "Suntik" ? "selected" : ""}} >Suntik</option>
                        <option value="Pil"  {{$penilaian->kb === "Pil" ? "selected" : ""}} >Pil</option>
                        <option value="AKDR"  {{$penilaian->kb === "AKDR" ? "selected" : ""}} >AKDR</option>
                        <option value="MOW"  {{$penilaian->kb === "MOW" ? "selected" : ""}} >MOW</option>
                    </select> 
                </div>
                <div class="col-3 mb-2">
                    <label for="ket_kb" class="form-label">Lamanya</label>
                    <input  type="text" class="form-control" name="ket_kb" value="{{!empty($penilaian->ket_kb) ? $penilaian->ket_kb : ''}}"  id='ket_kb' >
                </div>
                <div class="col-6 mb-2">
                    <label for="komplikasi" class="form-label">Komplikasi : </label>
                    <div class="d-flex">
                        <select class="form-select " id="komplikasi"  name="komplikasi" aria-label="Default select example">
                        <option value="-"  {{$penilaian->komplikasi === "-" ? "selected" : ""}} >Pilih Status</option>
                            <option value="Tidak Ada"  {{$penilaian->komplikasi === "Tidak Ada" ? "selected" : ""}} >Tidak Ada</option>
                            <option value="Ada"  {{$penilaian->komplikasi === "Ada" ? "selected" : ""}}>Ada</option>
                        </select> 
                        <input  type="text" placeholder="Hasil" class="ms-2 form-control" name="ket_komplikasi" value="{{!empty($penilaian->ket_komplikasi) ? $penilaian->ket_komplikasi : ''}}"  id='ket_komplikasi' value="">
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <label for="berhenti" class="form-label">Kapan Berhenti KB : </label>
                    <input  type="text" placeholder="Hasil" class="form-control" id="berhenti"  name="berhenti" value="{{!empty($penilaian->berhenti) ? $penilaian->berhenti : ''}}"  value="">
                </div>
                <div class="col-4 mb-2">
                    <label for="alasan" class="form-label">Alasan : </label>
                    <input  type="text" placeholder="alasan" class="form-control" id="alasan"  name="alasan" value="{{!empty($penilaian->alasan) ? $penilaian->alasan : ''}}"  value="">
                </div>
                <div class="col-4 mb-2">
                    <label for="ginekologi" class="form-label">ginekologi : </label>
                    <select class="form-select " id="ginekologi"  name="ginekologi" aria-label="Default select example">
                        <option value="-"  {{$penilaian->ginekologi === "-" ? "selected" : ""}} >Pilih Status</option>
                        <option value="Tidak Ada"  {{$penilaian->ginekologi === "Tidak Ada" ? "selected" : ""}} >Tidak Ada</option>
                        <option value="Infertilitas"  {{$penilaian->ginekologi === "Infertilitas" ? "selected" : ""}}>Infertilitas</option>
                        <option value="Infeksi Virus"  {{$penilaian->ginekologi === "Infeksi Virus" ? "selected" : ""}} >Infeksi Virus</option>
                        <option value="PMS"  {{$penilaian->ginekologi === "PMS" ? "selected" : ""}} >PMS</option>
                        <option value="Cervisitis"  {{$penilaian->ginekologi === "Cervisitis" ? "selected" : ""}} >Cervisitis</option>
                        <option value="Endometriosis"  {{$penilaian->ginekologi === "Endometriosis" ? "selected" : ""}} >Endometriosis</option>
                        <option value="Mioma"  {{$penilaian->ginekologi === "Mioma" ? "selected" : ""}} >Mioma</option>
                        <option value="Polip Cervix"  {{$penilaian->ginekologi === "Polip Cervix" ? "selected" : ""}} >Polip Cervix</option>
                        <option value="Kanker Kandungan"  {{$penilaian->ginekologi === "Kanker Kandungan" ? "selected" : ""}} >Kanker Kandungan</option>
                        <option value="Operasi Kandungan"  {{$penilaian->ginekologi === "Operasi Kandungan" ? "selected" : ""}} >Operasi Kandungan</option>
                    </select> 
                </div>
            </div>
            <label class="form-label">Riwayat Kebiasaan</label>
            <div class="ms-2 row">
                <div class="col-12 mb-2">
                    <label for="kebiasaan" class="form-label">Obat/Vitamin : </label>
                    <div class="d-flex">
                        <select class="form-select w-25" id="kebiasaan"  name="kebiasaan" aria-label="Default select example">
                            <option value="-"  {{$penilaian->kebiasaan === "-" ? "selected" : ""}} >Pilih Status</option>
                            <option value="Obat Obatan"  {{$penilaian->kebiasaan === "Obat Obatan" ? "selected" : ""}} >Obat Obatan</option>
                            <option value="Vitamin"  {{$penilaian->kebiasaan === "Vitamin" ? "selected" : ""}} >Vitamin</option>
                            <option value="Jamu Jamuan"  {{$penilaian->kebiasaan === "Jamu Jamuan" ? "selected" : ""}}>Jamu Jamuan</option>
                        </select> 
                        <input  type="text" placeholder="Keterangan" class="ms-2 form-control w-75" name="ket_kebiasaan" value="{{!empty($penilaian->ket_kebiasaan) ? $penilaian->ket_kebiasaan : ''}}"  id='ket_kebiasaan' value="">
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <label for="kebiasaan1" class="form-label">Merokok : </label>
                    <div class="d-flex">
                        <select class="form-select me-2" id="kebiasaan1"  name="kebiasaan1" aria-label="Default select example">
                            <option value="-"  {{$penilaian->kebiasaan1 === "-" ? "selected" : ""}} >Pilih Status</option>
                            <option value="Tidak"  {{$penilaian->kebiasaan1 === "Tidak" ? "selected" : ""}} >Tidak</option>
                            <option value="Ada"  {{$penilaian->kebiasaan1 === "Ada" ? "selected" : ""}}>Ada</option>
                        </select> 
                        <div class="input-group  me-2">
                            <input  type="text" id="ket_kebiasaan1" name="ket_kebiasaan1" value="{{!empty($penilaian->ket_kebiasaan1) ? $penilaian->ket_kebiasaan1 : ''}}"  class="form-control">
                            <span class="input-group-text">batang/hari</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <label for="kebiasaan2" class="form-label">Alkohol : </label>
                    <div class="d-flex">
                        <select class="form-select me-2" id="kebiasaan2"  name="kebiasaan2" aria-label="Default select example">
                            <option value="-"  {{$penilaian->kebiasaan2 === "-" ? "selected" : ""}} >Pilih Status</option>
                            <option value="Tidak"  {{$penilaian->kebiasaan2 === "Tidak" ? "selected" : ""}} >Tidak</option>
                            <option value="Ada"  {{$penilaian->kebiasaan2 === "Ada" ? "selected" : ""}}>Ada</option>
                        </select> 
                        <div class="input-group  me-2">
                            <input  type="text" id="ket_kebiasaan2" name="ket_kebiasaan2" value="{{!empty($penilaian->ket_kebiasaan2) ? $penilaian->ket_kebiasaan2 : ''}}"  class="form-control">
                            <span class="input-group-text">gelas/hari</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <label for="kebiasaan3" class="form-label">Obat Tidur/ Narkoba : </label>
                    <select class="form-select me-2" id="kebiasaan3"  name="kebiasaan3" aria-label="default select example">
                        <option value="-"  {{$penilaian->kebiasaan3 === "-" ? "selected" : ""}} >pilih status</option>
                        <option value="tidak"  {{$penilaian->kebiasaan3 === "tidak" ? "selected" : ""}} >tidak</option>
                        <option value="ada"  {{$penilaian->kebiasaan3 === "ada" ? "selected" : ""}}>ada</option>
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
                        <option value="-"  {{$penilaian->alat_bantu === "-" ? "selected" : ""}} >Pilih Alat Bantu</option>
                        <option value="Tidak"  {{$penilaian->alat_bantu === "Tidak" ? "selected" : ""}} >Tidak</option>
                        <option value="Ya"  {{$penilaian->alat_bantu === "Ya" ? "selected" : ""}}>Ya</option>
                    </select> 
                    <input  type="text" class="form-control w-75" name="ket_bantu" value="{{!empty($penilaian->ket_bantu) ? $penilaian->ket_bantu : ''}}"  id='ket_bantu' value="">
                </div>
                
            </div>
            <div class="col mb-2">
                <label for="prothesa" class="form-label">Prothesa</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="prothesa"  name="prothesa" aria-label="Default select example">
                        <option value="-"  {{$penilaian->prothesa === "-" ? "selected" : ""}} >Pilih Prothesa</option>
                        <option value="Tidak"  {{$penilaian->prothesa === "Tidak" ? "selected" : ""}} >Tidak</option>
                        <option value="Ya"  {{$penilaian->prothesa === "Ya" ? "selected" : ""}}>Ya</option>
                    </select> 
                    <input  type="text" class="form-control w-75" name="ket_pro" value="{{!empty($penilaian->ket_pro) ? $penilaian->ket_pro : ''}}"  id='ket_pro' value="">
                </div>
                
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="cacat_fisik" class="form-label">Cacat Fisik</label>
                <input readonly type="text" class="form-control" id="cacat_fisik"   value="-" >
            </div>
            <div class="col-6 mb-2">
                <label for="adl" class="form-label">Aktivitas Kehidupan Sehari-hari (ADL)</label>
                <select class="form-select" id="adl"  name="adl" value="{{!empty($penilaian->adl) ? $penilaian->adl : ''}}"  aria-label="Default select example">
                    <option value="-"  {{$penilaian->adl === "-" ? "selected" : ""}}>Pilih Aktivitas</option>

                    <option value="Mandiri"  {{$penilaian->adl === "Mandiri" ? "selected" : ""}} >Mandiri</option>
                    <option value="Dibantu"  {{$penilaian->adl === "Dibantu" ? "selected" : ""}}>Dibantu</option>
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
                    <select class="form-select w-25" id="status_psiko"  name="status_psiko" aria-label="default select example">
                        <option value="-"  {{$penilaian->status_psiko === "-" ? "selected" : ""}} >pilih status psikologi</option>
                        <option value="tenang"  {{$penilaian->status_psiko === "tenang" ? "selected" : ""}} >tenang</option>
                        <option value="takut"  {{$penilaian->status_psiko === "takut" ? "selected" : ""}}>takut</option>
                        <option value="cemas"  {{$penilaian->status_psiko === "cemas" ? "selected" : ""}}>cemas</option>
                        <option value="depresi"  {{$penilaian->status_psiko === "depresi" ? "selected" : ""}}>depresi</option>
                        <option value="lain-lain"  {{$penilaian->status_psiko === "lain-lain" ? "selected" : ""}}>lain-lain</option>
                    </select> 
                    <input   type="text" class="form-control w-75" name="ket_psiko" value="{{!empty($penilaian->ket_psiko) ? $penilaian->ket_psiko : ''}}"  id='ket_psiko' value="">
                </div>
                
            </div>
            <div class="col mb-2">
                <label for="" class="form-label">bahasa yang digunakan sehari-hari</label>
                <input  type="text" class="form-control" name="" id="" value="{{!empty($penilaian->nama_bahasa) ? $penilaian->nama_bahasa : ''}}" >
            </div>
        </div>
        <div class="row">
            <p class="text-start fs-6 m-0">status sosial dan ekonomi : </p>
            <div class="row ms-4 align-items-end">
                <div class="col mb-2">
                    <label for="hub_keluarga" class="form-label">hubungan pasien dengan anggota keluarga :</label>
                    <div class="d-flex">
                        <select class="form-select " id="hub_keluarga"  name="hub_keluarga" aria-label="Default select example">
                            <option value="-"  {{$penilaian->hub_keluarga === "-" ? "selected" : ""}} >Pilih Hub Keluarga</option>
                            <option value="Baik"  {{$penilaian->hub_keluarga === "Baik" ? "selected" : ""}} >Baik</option>
                            <option value="Tidak Baik"  {{$penilaian->hub_keluarga === "Tidak Baik" ? "selected" : ""}}>Tidak Baik</option>
                        </select> 
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="tinggal_dengan" class="form-label">Tinggal dengan : </label>
                    <div class="d-flex">
                        <select class="form-select " id="tinggal_dengan"  name="tinggal_dengan" aria-label="Default select example">
                        <option value="-"  {{$penilaian->tinggal_dengan === "-" ? "selected" : ""}} >Pilih Tinggal Dengan</option>
                            <option value="Sendiri"  {{$penilaian->tinggal_dengan === "Sendiri" ? "selected" : ""}} >Sendiri</option>
                            <option value="Orang Tua"  {{$penilaian->tinggal_dengan === "Orang Tua" ? "selected" : ""}}>Orang Tua</option>
                            <option value="Suami / Istri"  {{$penilaian->tinggal_dengan === "Suami / Istri" ? "selected" : ""}} >Suami / Istri</option>
                            <option value="Lainnya"  {{$penilaian->tinggal_dengan === "Lainnya" ? "selected" : ""}}>Lainnya</option>
                        </select> 
                        <input  type="text" class="form-control" name="ket_tinggal" value="{{!empty($penilaian->ket_tinggal) ? $penilaian->ket_tinggal : ''}}"  id='ket_tinggal' value="">
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="ekonomi" class="form-label">Ekonomi :</label>
                    <div class="d-flex">
                        <select class="form-select " id="ekonomi"  name="ekonomi" aria-label="Default select example">
                        <option value="-"  {{$penilaian->ekonomi === "-" ? "selected" : ""}} >Pilih Status Ekonomi</option>

                            <option value="Baik"  {{$penilaian->ekonomi === "Baik" ? "selected" : ""}} >Baik</option>
                            <option value="Cukup"  {{$penilaian->ekonomi === "Cukup" ? "selected" : ""}}>Cukup</option>
                            <option value="Kurang"  {{$penilaian->ekonomi === "Kurang" ? "selected" : ""}}>Kurang</option>
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
                        <option value="-"  {{$penilaian->budaya === "-" ? "selected" : ""}} >Pilih Budaya</option>
                        <option value="Tidak Ada"  {{$penilaian->budaya === "Tidak Ada" ? "selected" : ""}} >Tidak Ada</option>
                        <option value="Ada"  {{$penilaian->budaya === "Ada" ? "selected" : ""}}>Ada</option>
                    </select> 
                    <input  type="text" class="form-control w-75" name="ket_budaya" value="{{!empty($penilaian->ket_budaya) ? $penilaian->ket_budaya : ''}}"  id='ket_budaya' value="">
                </div>
                
            </div>
            <div class="col mb-2">
                <label for="edukasi" class="form-label">Edukasi diberikan kepada : </label>
                <div class="d-flex">
                    <select class="form-select w-25" id="edukasi"  name="edukasi" aria-label="Default select example">
                    <option value="-"  {{$penilaian->edukasi === "-" ? "selected" : ""}} >Pilih Edukasi</option>

                        <option value="Pasien"  {{$penilaian->edukasi === "Pasien" ? "selected" : ""}} >Pasien</option>
                        <option value="Kelurga"  {{$penilaian->edukasi === "Kelurga" ? "selected" : ""}}>Kelurga</option>
                    </select> 
                    <input  type="text" class="form-control w-75" name="ket_edukasi" value="{{!empty($penilaian->ket_edukasi) ? $penilaian->ket_edukasi : ''}}"  id='ket_edukasi' value="">
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
                            <option value="-"  {{$penilaian->berjalan_a === "-" ? "selected" : ""}} >Pilih Cara Berjalan</option>

                                <option value="Tidak"  {{$penilaian->berjalan_a === "Tidak" ? "selected" : ""}} >Tidak</option>
                                <option value="Ya"  {{$penilaian->berjalan_a === "Ya" ? "selected" : ""}}>Ya</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col-6 mb-2">
                        <label for="berjalan_b" class="form-label">2. Jalan Dengan Menggunakan Alat Bantu (Kruk , Tripot, Kursi Roda, Orang Lain):</label>
                        <div class="d-flex">
                            <select class="form-select " id="berjalan_b"  name="berjalan_b" aria-label="Default select example">
                            <option value="-"  {{$penilaian->berjalan_b === "-" ? "selected" : ""}} >Pilih Alat Bantu</option>

                                <option value="Tidak"  {{$penilaian->berjalan_b === "Tidak" ? "selected" : ""}} >Tidak</option>
                                <option value="Ya"  {{$penilaian->berjalan_b === "Ya" ? "selected" : ""}}>Ya</option>
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
                    <option value="-"  {{$penilaian->berjalan_c === "-" ? "selected" : ""}} >Pilih Alat Bantu</option>

                    <option value="Tidak"  {{$penilaian->berjalan_c === "Tidak" ? "selected" : ""}} >Tidak</option>
                    <option value="Ya"  {{$penilaian->berjalan_c === "Ya" ? "selected" : ""}}>Ya</option>
                </select> 
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="hasil" class="form-label">Hasil </label>
                <div class="d-flex">
                    <select class="form-select " id="hasil"  name="hasil" aria-label="Default select example">
                    <option value="-"  {{$penilaian->hasil === "-" ? "selected" : ""}} >Pilih Hasil</option>
                        <option value="Tidak Beresiko (Tidak Ditemukan A Dan B)"  {{$penilaian->hasil === "Tidak Beresiko (Tidak Ditemukan A Dan B)" ? "selected" : ""}} >Tidak Berisiko (Tidak ditemukan a dan b) </option>
                        <option value="Resiko rendah (ditemukan A/B)"  {{$penilaian->hasil === "Resiko rendah (ditemukan A/B)" ? "selected" : ""}} >Resiko Rendah (Ditemukan a / b) </option>
                        <option value="Resiko tinggi (ditemukan A dan B)"  {{$penilaian->hasil === "Resiko tinggi (ditemukan A dan B)" ? "selected" : ""}} >Resiko Tinggi (Ditemukan a dan b) </option>
                    </select> 
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="lapor" class="form-label">Dilaporkan ke Dokter ? </label>
                <div class="d-flex">
                    <select class="form-select " id="lapor"  name="lapor" aria-label="Default select example">
                        <option value="-"  {{$penilaian->lapor === "-" ? "selected" : ""}}>Pilih </option>
                        <option value="Tidak"  {{$penilaian->lapor === "Tidak" ? "selected" : ""}} >Tidak</option>
                        <option value="Ya"  {{$penilaian->lapor === "Ya" ? "selected" : ""}}>Ya</option>
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
        <h5 class="text-start">VII. SKRINNING GIZI</h5>
        <div class="row mb-2">
            <label for="sg1" class="form-label">Apakah ada penurunan berat badan yang tidak diinginkan selamat 6 bulan terakhir ?</label>
            <div class="d-flex">
                <select class="form-select w-25 me-4" id="sg1"  name="sg1" aria-label="Default select example">
                    <option value="-"  {{$penilaian->sg1 === "-" ? "selected" : ""}} >Pilih Status</option>
                    <option value="Tidak"  {{$penilaian->sg1 === "Tidak" ? "selected" : ""}}>Tidak</option>
                    <option value="Tidak Yakin"  {{$penilaian->sg1 === "Tidak Yakin" ? "selected" : ""}}>Tidak Yakin</option>
                    <option value="Ya, 1-5 Kg"  {{$penilaian->sg1 === "Ya, 1-5 Kg" ? "selected" : ""}}>Ya, 1-5 Kg</option>
                    <option value="Ya, 6-10 Kg"  {{$penilaian->sg1 === "Ya, 6-10 Kg" ? "selected" : ""}}>Ya, 6-10 Kg</option>
                    <option value="Ya, 11-15 Kg"  {{$penilaian->sg1 === "Ya, 11-15 Kg" ? "selected" : ""}}>Ya, 11-15 Kg</option>
                    <option value="Ya, >15 Kg"  {{$penilaian->sg1 === "Ya, >15 Kg" ? "selected" : ""}}>Ya, >15 Kg</option>
                </select> 
                <select class="form-select w-25 me-4" id="nilai1"  name="nilai1" aria-label="Default select example">
                    <option value="-"  {{$penilaian->nilai1 === "-" ? "selected" : ""}} >Pilih Nilai</option>
                    <option value="0"  {{$penilaian->nilai1 === "0" ? "selected" : ""}}>0</option>
                    <option value="1"  {{$penilaian->nilai1 === "1" ? "selected" : ""}}>1</option>
                    <option value="2"  {{$penilaian->nilai1 === "2" ? "selected" : ""}}>2</option>
                    <option value="3"  {{$penilaian->nilai1 === "3" ? "selected" : ""}}>3</option>
                    <option value="4"  {{$penilaian->nilai1 === "4" ? "selected" : ""}}>4</option>
                </select> 
            </div>
            
        </div>
        <div class="row mb-2">
            <label for="sg2" class="form-label">Apakah asupan makan berkurang karena tidak nafsu makan ? </label>
            <div class="d-flex">
                <select class="form-select w-25 me-4" id="sg2"  name="sg2" aria-label="Default select example">
                <option value="-"  {{$penilaian->sg2 === "-" ? "selected" : ""}} >Pilih Status</option>
                    <option value="Tidak"  {{$penilaian->sg2 === "Tidak" ? "selected" : ""}} >Tidak</option>
                    <option value="Ya"  {{$penilaian->sg2 === "Ya" ? "selected" : ""}}>Ya</option>
                </select> 
                <select class="form-select w-25 me-4" id="nilai2"  name="nilai2" aria-label="Default select example">
                    <option value="-"  {{$penilaian->nilai2 === "-" ? "selected" : ""}} >Pilih Nilai</option>
                    <option value="0"  {{$penilaian->nilai2 === "0" ? "selected" : ""}}>0</option>
                    <option value="1"  {{$penilaian->nilai2 === "1" ? "selected" : ""}}>1</option>
                    <option value="2"  {{$penilaian->nilai2 === "2" ? "selected" : ""}}>2</option>
                    <option value="3"  {{$penilaian->nilai2 === "3" ? "selected" : ""}}>3</option>
                    <option value="4"  {{$penilaian->nilai2 === "4" ? "selected" : ""}}>4</option>
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
                        <option value="-"  {{$penilaian->nyeri === "-" ? "selected" : ""}} >Pilih Rasa Nyeri</option>

                            <option value="Tidak Ada Nyeri"  {{$penilaian->nyeri === "Tidak Ada Nyeri" ? "selected" : ""}} >Tidak Ada Nyeri</option>
                            <option value="Nyeri Akut"  {{$penilaian->nyeri === "Nyeri Akut" ? "selected" : ""}}>Nyeri Akut</option>
                            <option value="Nyeri Kronis"  {{$penilaian->nyeri === "Nyeri Kronis" ? "selected" : ""}}>Nyeri Kronis</option>
                        </select> 
                    </div>
                    <div class="col-8">
                        <label for="provokes" class="form-label">Penyebab</label>
                        <div class="d-flex">
                            <select id="provokes"  name="provokes" class="form-select w-50 me-2" aria-label="Default select example">
                            <option value="-"  {{$penilaian->provokes === "-" ? "selected" : ""}} >Pilih Penyebab</option>

                                <option value="Proses Penyakit"  {{$penilaian->provokes === "Proses Penyakit" ? "selected" : ""}} >Proses Penyakit</option>
                                <option value="Benturan"  {{$penilaian->provokes === "Benturan" ? "selected" : ""}}>Benturan</option>
                                <option value="Lain-Lain"  {{$penilaian->provokes === "Lain-Lain" ? "selected" : ""}}>Lain-Lain</option>
                            </select> 
                            <input  type="text" class=" form-control" name="ket_provokes" value="{{!empty($penilaian->ket_provokes) ? $penilaian->ket_provokes : ''}}"  id="ket_provokes" placeholder="Nilai" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="quality" class="form-label">Kualitas:</label>
                        <div class="d-flex">
                            <select class="w-25 me-2 form-select" id="quality"  name="quality" aria-label="Default select example">
                            <option value="-"  {{$penilaian->quality === "-" ? "selected" : ""}} >Pilih Kualitas</option>

                                <option value="Seperti Tertusuk"  {{$penilaian->quality === "Seperti Tertusuk" ? "selected" : ""}} >Seperti Tertusuk</option>
                                <option value="Berdenyut"  {{$penilaian->quality === "Berdenyut" ? "selected" : ""}}>Berdenyut</option>
                                <option value="Teriris"  {{$penilaian->quality === "Teriris" ? "selected" : ""}}>Teriris</option>
                                <option value="Tertindih"  {{$penilaian->quality === "Tertindih" ? "selected" : ""}}>Tertindih</option>
                                <option value="Tertiban"  {{$penilaian->quality === "Tertiban" ? "selected" : ""}}>Tertiban</option>
                                <option value="Lain-Lain"  {{$penilaian->quality === "Lain-Lain" ? "selected" : ""}}>Lain-Lain</option>
                            </select> 
                            <input  type="text" class="w-75 form-control" name="ket_quality" value="{{!empty($penilaian->ket_quality) ? $penilaian->ket_quality : ''}}"  id="ket_quality"  placeholder="Nilai" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label for="" class="form-label">Wilayah:</label>
                    <div class="col ms-4">
                        <label for="lokasi" class="form-label">Lokasi:</label>
                        <input  type="text" id="lokasi"  name="lokasi" value="{{!empty($penilaian->lokasi) ? $penilaian->lokasi : ''}}"  class=" form-control" name=""  placeholder="Nilai" >
                    </div>
                    <div class="col">
                        <label for="menyebar" class="form-label">Menyebar:</label>
                        <select class=" form-select"  id="menyebar"  name="menyebar" aria-label="Default select example">
                        <option value="-"  {{$penilaian->menyebar === "-" ? "selected" : ""}} >Pilih Status Menyebar</option>

                            <option value="Tidak"  {{$penilaian->menyebar === "Tidak" ? "selected" : ""}} >Tidak</option>
                            <option value="Ya"  {{$penilaian->menyebar === "Ya" ? "selected" : ""}}>Ya</option>
                        </select> 
                    </div>
                </div>

                <div class="row">
                    <label for="" class="form-label">Severity:</label>                
                    <div class="col ms-4    ">
                        <label for="skala_nyeri" class="form-label">Skala Nyeri:</label>
                        <select class=" form-select" id="skala_nyeri"  name="skala_nyeri" aria-label="Default select example">
                        <option value="-"  {{$penilaian->skala_nyeri === "-" ? "selected" : ""}} >Pilih Skala Nyeri</option>
                            @for($i=0; $i <=10 ;$i++)
                                <option value="{{$i}}"  {{$penilaian->skala_nyeri == "$i" ? "selected" : ""}} >{{$i}}</option>
                            @endfor
                        </select> 
                    </div>

                    <div class="col ">
                        <label for="durasi" class="form-label">Waktu / Durasi:</label>
                        <div class="input-group">
                            <input  type="text" class="form-control" id="durasi"  name="durasi" value="{{!empty($penilaian->durasi) ? $penilaian->durasi : ''}}" >
                            <span class="input-group-text">Menit</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label for="nyeri_hilang" class="form-label">Nyeri Hilang Bila:</label>
                        <div class="d-flex">
                            <select class="form-select me-2" id="nyeri_hilang"  name="nyeri_hilang" aria-label="Default select example">
                            <option value="-"  {{$penilaian->nyeri_hilang === "-" ? "selected" : ""}} >Pilih </option>

                                <option value="Istirahat"  {{$penilaian->nyeri_hilang === "Istirahat" ? "selected" : ""}} >Istirahat</option>
                                <option value="Mendengar Musik"  {{$penilaian->nyeri_hilang === "Mendengar Musik" ? "selected" : ""}}>Mendengar Musik</option>
                                <option value="Minum Obat"  {{$penilaian->nyeri_hilang === "Minum Obat" ? "selected" : ""}}>Minum Obat</option>
                            </select> 
                            <input  type="text" class=" form-control" name="ket_nyeri" value="{{!empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : ''}}"  id="ket_nyeri" placeholder="Nilai" >
                        </div>
                    </div>
                    <div class="col-8">
                        <label for="pada_dokter" class="form-label">Diberitahukan Kepada Dokter ?</label>
                        <div class="row">
                            <div class="col-4">
                                <select class=" form-select" id="pada_dokter"  name="pada_dokter" aria-label="Default select example">
                                <option value="-"  {{$penilaian->pada_dokter === "-" ? "selected" : ""}} >Pilih </option>

                                    <option value="Tidak"  {{$penilaian->pada_dokter === "Tidak" ? "selected" : ""}} >Tidak</option>
                                    <option value="Ya"  {{$penilaian->pada_dokter === "Ya" ? "selected" : ""}}>Ya</option>
                                </select> 
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <label for="ket_dokter" class="form-label m-0 me-2">Jam:</label>
                                <input  type="text" name="ket_dokter" value="{{!empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : ''}}"    id="ket_dokter" class="form-control">
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
                    <textarea  class="form-control" id="masalah" name="masalah" rows="5">{{!empty($penilaian->masalah) ? $penilaian->masalah : ''}}</textarea>
                </div>
            </div>
            <div class="col-6 " >
                <h5 class="text-center">TINDAKAN</h5>
                <hr class="mb-2">
                <div class="overflow-auto h-75 alternate_child_color  px-3" >
                    <div class="mb-3">
                        <label for="tindakan" class="form-label">Tindakan</label>
                        <textarea  class="form-control" id="tindakan" name="tindakan" rows="5">{{!empty($penilaian->tindakan) ? $penilaian->tindakan : ''}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
</form> 