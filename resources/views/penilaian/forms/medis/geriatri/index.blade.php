<form action="{{ url('/penilaian-medis-geriatri/create') }}" method="post" id="penilaian_perawat_umum">
    @csrf
    <div class="row mb-3">
        @include('penilaian.form_header', ['pj_form_type' => 'dokter'])
        <div class="col mb-2">
            <label for="tanggal" class="form-label">Tanggal : </label>
            <input type="text" class="form-control input-daterange input-date-time" name="tanggal" id="tanggal"
                required autocomplete="off">
        </div>
        <div class="col mb-2">
            <label for="informasi" class="form-label">Informasi didapat dari : </label>
            <select class="form-select" id="anamnesis" name="anamnesis" aria-label="Default select ">
                <option value="-" selected>Pilih Informasi</option>
                <option value="Autoanamnesis">Autoanamnesis</option>
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
        <div class="row align-items-end">
            <div class="col-6">
                <div class="row">
                    <div class="col-4 mb-2">
                        <label for="td" class="form-label">TD : </label>
                        <div class="input-group">
                            <input type="text" name="td" id="td" class="form-control">
                            <span class="input-group-text" id="ModalPetugas">mmHg</span>
                        </div>
                    </div>
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
                </div>
                <div class="row">
                    <div class="col-4 mb-2">
                        <label for="rr" class="form-label">RR : </label>
                        <div class="input-group">
                            <input type="text" id="rr" name="rr" class="form-control">
                            <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                        </div>
                    </div>
                    <div class="col-8">
                        <label for="tulang_belakang" class="form-label">Postur Tulang Belakang :</label>
                        <select class="form-select" id="tulang_belakang" name="tulang_belakang"
                            aria-label="Default select ">
                            <option value="-" selected>Pilih Postur</option>
                            <option value="Tegap">Tegap</option>
                            <option value="Membungkuk">Membungkuk</option>
                            <option value="Kifosis">Kifosis</option>
                            <option value="Skoliosis">Skoliosis</option>
                            <option value="Lordosis">Lordosis</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <label for="kondisi_umum" class="form-label">Kondisi Umum</label>
                <textarea class="form-control w-100 h-75" id="kondisi_umum" name="kondisi_umum" rows="5"></textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">III. STATUS KELAINAN</h5>
        <div class="row align-items-end ">
            <div class="col-6">
                <div class="row mb-2">
                    <label for="kepala" class="form-label">Kepala :</label>
                    <div class="d-flex">
                        <select class="form-select w-25" id="kepala" name="kepala"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Normal">Normal</option>
                            <option value="Abnormal">Abnormal</option>
                            <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                        </select>
                        <input type="text" class="form-control w-75" name="keterangan_kepala"
                            id='keterangan_kepala' value="">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="thoraks" class="form-label">Thoraks :</label>
                    <div class="d-flex">
                        <select class="form-select w-25" id="thoraks" name="thoraks"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Normal">Normal</option>
                            <option value="Abnormal">Abnormal</option>
                            <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                        </select>
                        <input type="text" class="form-control w-75" name="keterangan_thoraks"
                            id='keterangan_thoraks' value="">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="abdomen" class="form-label">Abdomen :</label>
                    <div class="d-flex">
                        <select class="form-select w-25" id="abdomen" name="abdomen"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Normal">Normal</option>
                            <option value="Abnormal">Abnormal</option>
                            <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                        </select>
                        <input type="text" class="form-control w-75" name="keterangan_abdomen"
                            id='keterangan_abdomen' value="">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="ekstremitas" class="form-label">Ekstremitas:</label>
                    <div class="d-flex">
                        <select class="form-select w-25" id="ekstremitas" name="ekstremitas"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Normal">Normal</option>
                            <option value="Abnormal">Abnormal</option>
                            <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                        </select>
                        <input type="text" class="form-control w-75" name="keterangan_ekstremitas"
                            id='keterangan_ekstremitas' value="">
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="lainnya" class="form-label">Lainnya :</label>
                    <textarea class="form-control" id="lainnya" name="lainnya" rows="3"></textarea>
                </div>
            </div>
            <div class="col-6 ">
                <h5 class="text-center">Integument</h5>
                <div class="row mb-2">
                    <label for="Integument_kebersihan" class="form-label">Kebersihan :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="Integument_kebersihan" name="Integument_kebersihan"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Normal">Normal</option>
                            <option value="Abnormal">Abnormal</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="Integument_warna" class="form-label">Warna :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="Integument_warna" name="Integument_warna"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Tidak Ada">Normal</option>
                            <option value="Pucat">Pucat</option>
                            <option value="Sianosis">Sianosis</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="Integument_kelembaban" class="form-label">Kelembaban :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="Integument_kelembaban" name="Integument_kelembaban"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Kering">Kering</option>
                            <option value="Lembab">Lembab</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="Integument_gangguan_kulit" class="form-label">Gangguan Kulit :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="Integument_gangguan_kulit"
                            name="Integument_gangguan_kulit" aria-label="Default select example">
                            '','','','','',''
                            <option value="-" selected>Pilih status</option>
                            <option value="Normal">Normal</option>
                            <option value="Rash">Rash</option>
                            <option value="Luka">Luka</option>
                            <option value="Memar">Memar</option>
                            <option value="Ptekie">Ptekie</option>
                            <option value="Bula">Bula</option>
                        </select>
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="kondisi_sosial" class="form-label">Kondisi Sosial :</label>
                    <textarea class="form-control" id="kondisi_sosial" name="kondisi_sosial" rows="3"></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="row mb-2">
                    <label for="status_psikologis_gds" class="form-label">Psikologis (GDS) :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="status_psikologis_gds" name="status_psikologis_gds"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Skor 1-4 Tidak Ada Depresi">Skor 1-4 Tidak Ada Depresi</option>
                            <option value="Skor Antara 5-9 Menunjukkan Kemungkinan Besar Depresi">Skor Antara 5-9
                                Menunjukkan Kemungkinan Besar Depresi</option>
                            <option value="Skor 10 Atau Lebih Menunjukkan Depresi">Skor 10 Atau Lebih Menunjukkan
                                Depresi</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="status_kognitif_mmse" class="form-label">Kognitif (MMSE) :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="status_kognitif_mmse" name="status_kognitif_mmse"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="24-30 : Tidak Ada Gangguan Kognitif">24-30 : Tidak Ada Gangguan Kognitif
                            </option>
                            <option value="18-23 : Gangguan Kognitif Sedang">18-23 : Gangguan Kognitif Sedang</option>
                            <option value="0-17 : Gangguan Kognitif Berat">0-17 : Gangguan Kognitif Berat</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="status_nutrisi" class="form-label">Nutrisi (MNA) :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="status_nutrisi" name="status_nutrisi"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Skor 12-14 : Status Gizi Normal">Skor 12-14 : Status Gizi Normal</option>
                            <option value="Skor 8-11 : Berisiko Malnutrisi">Skor 8-11 : Berisiko Malnutrisi</option>
                            <option value="Skor 0-7 : Malnutrisi">Skor 0-7 : Malnutrisi</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row mb-2">
                    <label for="skrining_jatuh" class="form-label">Skrinning Risiko Jatuh (OMS) :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="skrining_jatuh" name="skrining_jatuh"
                            aria-label="Default select example">
                            <option value="-" selected>Pilih status</option>
                            <option value="Risiko Rendah Skor 0-5">Risiko Rendah Skor 0-5</option>
                            <option value="Risiko Sedang Skor 6-16">Risiko Sedang Skor 6-16</option>
                            <option value="Risiko Tinggi Skor 17-30">Risiko Tinggi Skor 17-30</option>
                        </select>
                    </div>
                    <div class="row mb-2">
                        <label for="status_fungsional" class="form-label">Status Fungsional (ADL:BARTHEL INDEX)
                            :</label>
                        <div class="d-flex">
                            <select class="form-select w-100" id="status_fungsional" name="status_fungsional"
                                aria-label="Default select example">
                                <option value="-" selected>Pilih status</option>
                                <option value="20 : Mandiri (A)">20 : Mandiri (A)</option>
                                <option value="12-19 : Ketergantungan Ringan (B)">12-19 : Ketergantungan Ringan (B)
                                </option>
                                <option value="9-11 : Ketergantungan Sedang (B)">9-11 : Ketergantungan Sedang (B)
                                </option>
                                <option value="5-8 : Ketergantungan Berat (C)">5-8 : Ketergantungan Berat (C)</option>
                                <option value="0-4 : Ketergantungan Total (C)">0-4 : Ketergantungan Total (C)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">IV. PEMERIKSAAN PENUNJANG</h5>
        <div class="row mb-2">
            <div class="col">
                <label for="lab" class="form-label">Laboratorium :</label>
                <textarea class="form-control" id="lab" name="lab" rows="3"></textarea>
            </div>
            <div class="col">
                <label for="rad" class="form-label">Radiologi :</label>
                <textarea class="form-control" id="rad" name="rad" rows="3"></textarea>
            </div>
            <div class="col">
                <label for="pemeriksaan" class="form-label">Penunjang Lainya :</label>
                <textarea class="form-control" id="pemeriksaan" name="pemeriksaan" rows="3"></textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">V. DIAGNOSIS/ASESMEN</h5>
        <div class="row mb-2">
            <div class="col">
                <label for="diagnosis" class="form-label">Asesmen Kerja :</label>
                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3"></textarea>
            </div>
            <div class="col">
                <label for="diagnosis2" class="form-label">Asesmen Banding :</label>
                <textarea class="form-control" id="diagnosis2" name="diagnosis2" rows="3"></textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">VI. PERMASALAHAN & TATALAKSANA</h5>
        <div class="row mb-2">
            <div class="col-6">
                <label for="permasalahan" class="form-label">Permasalahan :</label>
                <textarea class="form-control" id="permasalahan" name="permasalahan" rows="3"></textarea>
            </div>
            <div class="col-6">
                <label for="terapi" class="form-label">Terapi/Pengobatan :</label>
                <textarea class="form-control" id="terapi" name="terapi" rows="3"></textarea>
            </div>
            <div class="col-12">
                <label for="tindakan" class="form-label">Tindakan/Rencana Pengobatan :</label>
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
<div class="modal fade bagan-data-table" id="showModalPetugas" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content overflow-auto">
            <div class="modal-header border-0 pb-0">
                <div class="col-6">
                    <div class="d-flex justify-content-center align-items-center border">
                        <input type="text" class="form-control border-0 search-data-table"
                            placeholder="Masukkan kata yang akan dicari">
                        <button type="submit" class="btn btn-white">
                            <span class="iconify" style="font-size: 24px; color: #CFD0D7;"
                                data-icon="fe:search"></span>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn-close me-4" data-bs-dismiss="modal" id="closeModalPetugasDT"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table data-table border">
                    <thead>
                        <tr>
                            <th scope="col" class="py-4 ps-4">Kode Dokter</th>
                            <th scope="col" class="py-4" style="width: 35%;">Nama Dokter</th>
                            <th scope="col" class="py-4">Spesialis</th>
                            <th scope="col" class="py-4 pe-4">No Ijin Praktek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petugas_list as $item)
                            @php
                                $nama = $item['nm_dokter'];
                                $kode = $item['kd_dokter'];
                            @endphp
                            <tr>
                                <td class="py-3 ps-4">{{ $item['kd_dokter'] }}</td>
                                <td class="py-3"> <span class="text-primary hover-pointer set-value-data-table"
                                        data-target="#kd_dokter@val|#namaPetugas@val"
                                        data-value='{{ $kode }}|{{ $nama }}'>{{ $nama }}</span>
                                </td>
                                <td class="py-3">{{ $item['almt_tgl'] }}</td>
                                <td class="py-3">{{ $item['noo_ijin_praktek'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
