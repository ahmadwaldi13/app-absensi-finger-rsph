<form action="{{url('/penilaian-medis-penyakit-dalam/create')}}" method="post" id="penilaian_penyakit_umum">
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
            <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
            <textarea class="form-control" id="rpo" name="rpo" rows="3"></textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea class="form-control" id="rpd" name="rpd" rows="3"></textarea>
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
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-7 mb-2 ">
                    <label for="status" class="form-label">Status Nutrisi</label>
                    <input type="text" class="form-control" name="status" id='status' value="">
                </div>
                <div class="col-5 mb-2">
                    <label for="td" class="form-label">TD : </label>
                    <div class="input-group">
                        <input type="text" name="td" id="td" class="form-control">
                        <span class="input-group-text" id="ModalPetugas">mmHg</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-2">
                    <label for="nadi" class="form-label">Nadi : </label>
                    <div class="input-group">
                        <input type="text" id="nadi" name="nadi" class="form-control">
                        <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <label for="suhu" class="form-label">Suhu : </label>
                    <div class="input-group">
                        <input type="text" id="suhu" name="suhu" class="form-control">
                        <span class="input-group-text" id="ModalPetugas">&#8451;</span>
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <label for="rr" class="form-label">RR : </label>
                    <div class="input-group">
                        <input type="text" id="rr" name="rr" class="form-control">
                        <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3 mb-2">
                    <label for="bb" class="form-label">BB : </label>
                    <div class="input-group">
                        <input type="text" id="bb" name="bb" class="form-control">
                        <span class="input-group-text" id="ModalPetugas">Kg</span>
                    </div>
                </div>
                <div class="col-6 mb-2 ">
                    <label for="nyeri" class="form-label">Nyeri</label>
                    <input type="text" class="form-control" name="nyeri" id='nyeri' value="">
                </div>
                <div class="col-3 mb-2">
                    <label for="gcs" class="form-label">GCS(E, V, M) : </label>
                    <div class="input-group">
                        <input type="text" id="gcs" name="gcs" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <label for="kondisi" class="form-label">Kondisi Umum</label>
            <textarea class="form-control h-75 w-100" id="kondisi" name="kondisi" rows="3"></textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">III. STATUS KELAINAN</h5>
     <div class="row">
        <div class="col-6">
            <div class="row">
                <label for="kepala" class="form-label">Kepala :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="kepala"  name="kepala" aria-label="Default select example">
                        <option value="-" selected>Pilih status</option>
                        <option value="Normal" >Normal</option>
                        <option value="Abnormal" >Abnormal</option>
                        <option value="Tidak Diperiksa" >Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_kepala" id='keterangan_kepala' value="">
                </div>
            </div>
            <div class="row">
                <label for="thoraks" class="form-label">Thoraks :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="thoraks"  name="thoraks" aria-label="Default select example">
                        <option value="-" selected>Pilih status</option>
                        <option value="Normal" >Normal</option>
                        <option value="Abnormal" >Abnormal</option>
                        <option value="Tidak Diperiksa" >Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_thorak" id='keterangan_thorak' value="">
                </div>
            </div>
            <div class="row">
                <label for="abdomen" class="form-label">Abdomen :</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="abdomen"  name="abdomen" aria-label="Default select example">
                        <option value="Normal" >Normal</option>
                        <option value="Abnormal" >Abnormal</option>
                        <option value="Tidak Diperiksa" >Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_abdomen" id='keterangan_abdomen' value="">
                </div>
            </div>
            <div class="row">
                <label for="ekstremitas" class="form-label">Ekstremitas:</label>
                <div class="d-flex">
                    <select class="form-select w-25" id="ekstremitas"  name="ekstremitas" aria-label="Default select example">
                        <option value="Normal" >Normal</option>
                        <option value="Abnormal" >Abnormal</option>
                        <option value="Tidak Diperiksa" >Tidak Diperiksa</option>
                    </select>
                    <input type="text" class="form-control w-75" name="keterangan_ekstremitas" id='keterangan_ekstremitas' value="">
                </div>
            </div>
        </div>
        <div class="col-6 " >
            <h5 class="text-center">Kondisi Umum</h5>
                    <textarea class="form-control w-100 h-75" id="lainnya" name="lainnya" rows="5"></textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">IV. PEMERIKSAAN PENUNJANGAN</h5>
    <div class="row mb-2">
        <div class="col-4">
            <label for="lab" class="form-label">Laboratorium</label>
            <textarea class="form-control" id="lab" name="lab" rows="3"></textarea>
        </div>
         <div class="col-4">
            <label for="rad" class="form-label">Radiologi</label>
            <textarea class="form-control" id="rad" name="rad" rows="3"></textarea>
        </div>
        <div class="col-4">
            <label for="penunjanglain" class="form-label">Penunjang lainnya</label>
            <textarea class="form-control" id="penunjanglain" name="penunjanglain" rows="3"></textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. DIAGNOSIS/ASESMEN</h5>
    <div class="row mb-2">
        <div class="col">
            <label for="diagnosis" class="form-label">Asesmen Kerja</label>
            <textarea class="form-control" id="lab" name="diagnosis" rows="3"></textarea>
        </div>
         <div class="col">
            <label for="diagnosis2" class="form-label">Asesmen Banding</label>
            <textarea class="form-control" id="diagnosis2" name="diagnosis2" rows="3"></textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VI. PERMASALAHAN & TATALAKSANA</h5>
    <div class="row mb-2">
        <div class="col-6">
            <label for="permasalahan" class="form-label">Permasalahan</label>
            <textarea class="form-control" id="permasalahan" name="permasalahan" rows="3"></textarea>
        </div>
         <div class="col-6">
            <label for="terapi" class="form-label">Terapi/Pengobatan</label>
            <textarea class="form-control" id="terapi" name="terapi" rows="3"></textarea>
        </div>
        <div class="col-12">
            <label for="tindakan" class="form-label">Tindakan/Rencana Pengobatan</label>
            <textarea class="form-control" id="tindakan" name="tindakan" rows="3"></textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VII. EDUKASI</h5>
    <div class="row mb-2">
        <div class="col">
            <textarea class="form-control" id="edukasi" name="edukasi" rows="3"></textarea>
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
