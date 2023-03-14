<form action="{{url('/penilaian-medis-kebidanan/create')}}" method="post" id="penilaian_perawat_umum">
@csrf
<div class="row mb-3">
    @include('penilaian.form_header', ["pj_form_type"=>"dokter"])
    <div class="col mb-2">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input type="text" class="form-control input-daterange input-date-time" name="tanggal" id="tanggal"  required autocomplete="off" >
    </div>
    <div class="col mb-2">
        <label for="informasi" class="form-label">Informasi didapat dari : </label>
        <select class="form-select" id="anamnesis" name="anamnesis" aria-label="Default select " >
            <option value="-" selected>Pilih Informasi</option>
            <option value="Autoanamnesis" >Autoanamnesis</option>
            <option value="Alloanamnesis">Alloanamnesis</option>
        </select>
    </div>
</div>


<hr class="mb-5">

<div>
    <h5 class="text-start">I. RIWAYAT KESEHATAN</h5>
    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="keluhan_utama" class="form-label">Keluhan Utama</label>
            <textarea class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3"></textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rps" class="form-label">Riwayat Penyakit Sekarang</label>
            <textarea class="form-control" id="rps" name="rps" rows="3"></textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpk" class="form-label">Riwayat Penyakit Keluarga</label>
            <textarea class="form-control" id="rpk" name="rpk" rows="3"></textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea class="form-control" id="rpd" name="rpd" rows="3"></textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
            <textarea class="form-control" id="rpo" name="rpo" rows="3"></textarea>
        </div>
        <div class="col-6 mb-2 ">
            <label for="alergi" class="form-label">Riwayat Alergi</label>
            <input type="text" class="form-control" name="alergi" id='alergi' value="">
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
                <option value="-" selected>Pilih Keadaan</option>
                <option value="Sehat" >Sehat</option>
                <option value="Sakit Ringan">Sakit Ringan</option>
                <option value="Sakit Sedang">Sakit Sedang</option>
                <option value="Sakit Berat">Sakit Berat</option>
            </select>
        </div>
        <div class="col-3 mb-2">
            <label for="kesadaran" class="form-label">Kesadaran : </label>
            <select class="form-select" id="kesadaran" name="kesadaran" aria-label="Default select ">
                <option value="-" selected>Pilih Kesadaran</option>
                <option value="Compos Mentis" >Compos Mentis</option>
                <option value="Apatis">Apatis</option>
                <option value="Somnolen">Somnolen</option>
                <option value="Sopor">Sopor</option>
                <option value="Koma">Koma</option>
            </select>
        </div>
        <div class="col-3 mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input type="text" name="td" id="td" class="form-control">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input type="text" id="nadi" name="nadi" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="rr" class="form-label">RR : </label>
            <div class="input-group">
                <input type="text" id="rr" name="rr" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input type="text" id="suhu" name="suhu" class="form-control">
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>

        <div class="col-3 mb-2">
            <label for="gcs" class="form-label">GCS(E, V, M) : </label>
            <div class="input-group">
                <input type="text" id="gcs" name="gcs" class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="bb" class="form-label">BB : </label>
            <div class="input-group">
                <input type="text" id="bb" name="bb" class="form-control">
                <span class="input-group-text" id="ModalPetugas">Kg</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input type="text" id="tb" name="tb" class="form-control">
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="spo" class="form-label">SpO2 : </label>
            <div class="input-group">
                <input type="text" id="spo" name="spo" class="form-control">
                <span class="input-group-text" id="ModalPetugas">%</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 row">
            <div class="col-6 mb-2">
                <label for="kepala" class="form-label">Kepala : </label>
                <select class="form-select" id="kepala" name="kepala" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Normal" >Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="abdomen" class="form-label">Abdomen : </label>
                <select class="form-select" id="abdomen" name="abdomen" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Normal" >Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="mata" class="form-label">Mata : </label>
                <select class="form-select" id="mata" name="mata" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Normal" >Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="gigi" class="form-label">Gigi & Mulut : </label>
                <select class="form-select" id="gigi" name="gigi" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Normal" >Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="genital" class="form-label">Genital & Anus : </label>
                <select class="form-select" id="genital" name="genital" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Normal" >Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="tht" class="form-label">THT: </label>
                <select class="form-select" id="tht" name="tht" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Normal" >Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="ekstremitas" class="form-label">Ekstremitas: </label>
                <select class="form-select" id="ekstremitas" name="ekstremitas" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Normal" >Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="thoraks" class="form-label">Thoraks : </label>
                <select class="form-select" id="thoraks" name="thoraks" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Normal" >Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="kulit" class="form-label">Kulit : </label>
                <select class="form-select" id="kulit" name="kulit" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Normal" >Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <label for="ket_fisik" class="form-label">Keterangan</label>
            <textarea class="form-control" id="ket_fisik" name="ket_fisik" rows="5"></textarea>
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
                <input type="text" name="tfu" id="tfu" class="form-control">
                <span class="input-group-text" id="ModalPetugas">Cm</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="tbj" class="form-label">TBJ : </label>
            <div class="input-group">
                <input type="text" name="tbj" id="tbj" class="form-control">
                <span class="input-group-text" id="ModalPetugas">gram</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="his" class="form-label">His : </label>
            <div class="input-group">
                <input type="text" name="his" id="his" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / 10 Menit</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="kontraksi" class="form-label">Kontraksi : </label>
            <select class="form-select" id="kontraksi" name="kontraksi" aria-label="Default select ">
                <option value="-" selected>Pilih Kesadaran</option>
                <option value="Ada" >Ada</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>
        <div class="col mb-2">
            <label for="djj" class="form-label">DJJ : </label>
            <div class="input-group">
                <input type="text" name="djj" id="djj" class="form-control">
                <span class="input-group-text" id="ModalPetugas">Dpm</span>
            </div>
        </div>
        <!-- <label for="ket_lokalis" class="form-label">Keterangan</label>
        <textarea class="form-control" id="ket_lokalis" name="ket_lokalis" rows="3"></textarea> -->
    </div>
    <div class="row">
        <div class="col-6">
            <label for="inspeksi" class="form-label">Inspeksi : </label>
            <textarea class="form-control" id="inspeksi" name="inspeksi" rows="5"></textarea>
        </div>
        <div class="col-6">
            <label for="vt" class="form-label">VT : </label>
            <textarea class="form-control" id="vt" name="vt" rows="5"></textarea>
        </div>
        <div class="col-6">
            <label for="inspekulo" class="form-label">Inspekulo : </label>
            <textarea class="form-control" id="inspekulo" name="inspekulo" rows="5"></textarea>
        </div>
        <div class="col-6">
            <label for="rt" class="form-label">RT : </label>
            <textarea class="form-control" id="rt" name="rt" rows="5"></textarea>
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">IV. PEMERIKSAAN PENUNJANGAN</h5>

    <div class="row mb-2">
        <div class="col-4">
            <label for="ultra" class="form-label">Ultrasonografi : </label>
            <textarea class="form-control" id="ultra" name="ultra" rows="5"></textarea>
        </div>
        <div class="col-4">
            <label for="kardio" class="form-label">Kardiotografi : </label>
            <textarea class="form-control" id="kardio" name="kardio" rows="5"></textarea>
        </div>
        <div class="col-4">
            <label for="lab" class="form-label">Laboratorium : </label>
            <textarea class="form-control" id="lab" name="lab" rows="5"></textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. DIAGNOSIS ASSESMEN</h5>

    <div class="row mb-2">
        <label for="diagnosis" class="form-label">Keterangan</label>
        <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3"></textarea>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VI. TATALAKSANA</h5>

    <div class="row mb-2">
        <label for="tata" class="form-label">Keterangan</label>
        <textarea class="form-control" id="tata" name="tata" rows="3"></textarea>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">VII. KONSUL / RUJUK</h5>

    <div class="row mb-2">
        <label for="konsul" class="form-label">Keterangan</label>
        <textarea class="form-control" id="konsul" name="konsul" rows="3"></textarea>
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
                                <th scope="col" class="py-4 ps-4">Kode Dokter</th>
                                <th scope="col" class="py-4" style="width: 35%;">Nama Dokter</th>
                                <th scope="col" class="py-4">Spesialis</th>
                                <th scope="col" class="py-4 pe-4">No Ijin Praktek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petugas_list as $item)
                                @php 
                                    $nama = $item["nm_dokter"]; 
                                    $kode= $item["kd_dokter"];
                                @endphp
                                <tr>
                                    <td class="py-3 ps-4">{{ $item["kd_dokter"] }}</td>
                                    <td class="py-3"> <span class="text-primary hover-pointer set-value-data-table" data-target="#kd_dokter@val|#namaPetugas@val" data-value='{{$kode}}|{{$nama}}'>{{ $nama }}</span></td>
                                    <td class="py-3">{{ $item["almt_tgl"] }}</td>
                                    <td class="py-3">{{ $item["noo_ijin_praktek"] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>