
<form action="{{url('/penilaian-medis-mata/create')}}" method="post" id="penilaian_perawat_umum">
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
        <div class="col-3 mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input type="text" name="td" id="td" class="form-control">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="bb" class="form-label">BB : </label>
            <div class="input-group">
                <input type="text" id="bb" name="bb" class="form-control">
                <span class="input-group-text" id="ModalPetugas">Kg</span>
            </div>
        </div>
        <div class="col-2 mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input type="text" id="suhu" name="suhu" class="form-control">
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>
        <div class="col-2 mb-2">
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
        <div class="col-6 mb-2 ">
            <label for="nyeri" class="form-label">Nyeri</label>
            <input type="text" class="form-control" name="nyeri" id='nyeri' value="">
        </div>
        <div class="col-6 mb-2 ">
            <label for="status" class="form-label">Status Nutrisi</label>
            <input type="text" class="form-control" name="status" id='status' value="">
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">III. STATUS OFTAMOLOGIS</h5>
     <div class="row align-items-end ">
        <div class="col-6 mb-3 text-center">
            <label for="nyeri" class="form-label text-start">OD : Mata Kanan</label>
            <img src="{{asset('icon/mata.png')}}" alt="">
        </div>
        <div class="col-6 mb-3 text-center">
            <label for="status_nutrisi" class="form-label text-start">OS : Mata Kiri</label>
            <img src="{{asset('icon/mata.png')}}" alt="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="visuskanan" id='visuskanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Visus SC</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="visuskiri" id='visuskiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="cckanan" id='cckanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">CC</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="cckiri" id='cckiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="palkanan" id='palkanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Palebra</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="palkiri" id='palkiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="conkanan" id='conkanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Conjungtiva</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="conkiri" id='conkiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="corneakanan" id='corneakanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Cornea</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="corneakiri" id='corneakiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="coakanan" id='coakanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Coa</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="coakiri" id='coakiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="pupilkanan" id='pupilkanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Pupil</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="pupilkiri" id='pupilkiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="lensakanan" id='lensakanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Lensa</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="lensakiri" id='lensakiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="funduskanan" id='funduskanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Fundus Media</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="funduskiri" id='funduskiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="papilkanan" id='papilkanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Papil</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="papilkiri" id='papilkiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="retinakanan" id='retinakanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Retina</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="retinakiri" id='retinakiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="makulakanan" id='makulakanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">Makula</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="makulakiri" id='makulakiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="tiokanan" id='tiokanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">TIO</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="tiokiri" id='tiokiri' value="">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="mbokanan" id='mbokanan' value="">
        </div>
        <div class="col-2 mb-3 text-center">
            <label for="">MBO</label>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" name="mbokiri" id='mbokiri' value="">
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
            <label for="penunjang" class="form-label">Penunjang lainnya</label>
            <textarea class="form-control" id="penunjang" name="penunjang" rows="3"></textarea>
        </div>
        <div class="col-6">
            <label for="tes" class="form-label">Tes Penglihatan</label>
            <textarea class="form-control" id="tes" name="tes" rows="3"></textarea>
        </div>
        <div class="col-6">
            <label for="pemeriksaan" class="form-label">Pemeriksa Lainnya</label>
            <textarea class="form-control" id="pemeriksaan" name="pemeriksaan" rows="3"></textarea>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. DIAGNOSIS/ASESMEN</h5>
    <div class="row mb-2">
        <div class="col">
            <label for="diagnosis" class="form-label">Asesmen Kerja</label>
            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3"></textarea>
        </div>
         <div class="col">
            <label for="diagnosisbdg" class="form-label">Asesmen Banding</label>
            <textarea class="form-control" id="diagnosisbdg" name="diagnosisbdg" rows="3"></textarea>
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
