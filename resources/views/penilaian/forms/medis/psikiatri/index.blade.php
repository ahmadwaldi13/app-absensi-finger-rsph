<form action="{{ url('/penilaian-medis-psikiatri/create') }}" method="post" id="penilaian_perawat_umum">
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
                <label for="rpk" class="form-label">Riwayat Penyakit Fisik & Neurologi</label>
                <textarea class="form-control" id="rpf" name="rpk" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
                <textarea class="form-control" id="rpd" name="rpd" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rpo" class="form-label">Riwayat Napza</label>
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
        <h5 class="text-start">II. STATUS PSIKIATRIK</h5>

        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="penampilan" class="form-label">Penampilan</label>
                <textarea class="form-control" id="penampilan" name="penampilan" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="gangguan_persepsi" class="form-label">Ganguan Persepsi</label>
                <textarea class="form-control" id="gangguan_persepsi" name="gangguan_persepsi" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="pembicaraan" class="form-label">Pembicaraan</label>
                <textarea class="form-control" id="pembicaraan" name="pembicaraan" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="proses_pikir" class="form-label">Proses Pikir & Isi Pikir</label>
                <textarea class="form-control" id="proses_pikir" name="proses_pikir" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="psikomotor" class="form-label">Psikomotor</label>
                <textarea class="form-control" id="psikomotor" name="psikomotor" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="pengendalian_impuls" class="form-label">Pengendalian Implus</label>
                <textarea class="form-control" id="pengendalian_impuls" name="pengendalian_impuls" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="sikap" class="form-label">Sikap</label>
                <textarea class="form-control" id="sikap" name="sikap" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="tilikan" class="form-label">Tilikan</label>
                <textarea class="form-control" id="tilikan" name="tilikan" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="mood" class="form-label">Mood/Afek</label>
                <textarea class="form-control" id="mood" name="mood" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rta" class="form-label">Reality Testing Ability</label>
                <textarea class="form-control" id="rta" name="rta" rows="3"></textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="fungsi_kognitif" class="form-label">Fungsi Kognitif</label>
                <textarea class="form-control" id="fungsi_kognitif" name="fungsi_kognitif" rows="3"></textarea>
            </div>

        </div>
    </div>

    <hr class="mb-5">

    <div>
        <h5 class="text-start">III. PEMERIKSAAN FISIK</h5>
        <div class="row align-items-end">
            <div class="col-3 mb-2">
                <label for="keadaan" class="form-label">Keadaan Umum : </label>
                <select class="form-select" id="keadaan" name="keadaan" aria-label="Default select ">
                    <option value="-" selected>Pilih Keadaan</option>
                    <option value="Sehat">Sehat</option>
                    <option value="Sakit Ringan">Sakit Ringan</option>
                    <option value="Sakit Sedang">Sakit Sedang</option>
                    <option value="Sakit Berat">Sakit Berat</option>
                </select>
            </div>
            <div class="col-3 mb-2">
                <label for="kesadaran" class="form-label">Kesadaran : </label>
                <select class="form-select" id="kesadaran" name="kesadaran" aria-label="Default select ">
                    <option value="-" selected>Pilih Kesadaran</option>
                    <option value="Compos Mentis">Compos Mentis</option>
                    <option value="Apatis">Apatis</option>
                    <option value="Somnolen">Somnolen</option>
                    <option value="Sopor">Sopor</option>
                    <option value="Koma">Koma</option>
                </select>
            </div>
            <div class="col-2 mb-2">
                <label for="gcs" class="form-label">GCS(E, V, M) : </label>
                <div class="input-group">
                    <input type="text" id="gcs" name="gcs" class="form-control">
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="tb" class="form-label">TB : </label>
                <div class="input-group">
                    <input type="text" id="tb" name="tb" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">cm</span>
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
                <label for="td" class="form-label">TD : </label>
                <div class="input-group">
                    <input type="text" name="td" id="td" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">mmHg</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="nadi" class="form-label">Nadi : </label>
                <div class="input-group">
                    <input type="text" id="nadi" name="nadi" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="rr" class="form-label">RR : </label>
                <div class="input-group">
                    <input type="text" id="rr" name="rr" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">x / Menit</span>
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
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="abdomen" class="form-label">Abdomen : </label>
                    <select class="form-select" id="abdomen" name="abdomen" aria-label="Default select ">
                        <option value="-" selected>Pilih Keadaan</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="gigi" class="form-label">Gigi & Mulut : </label>
                    <select class="form-select" id="gigi" name="gigi" aria-label="Default select ">
                        <option value="-" selected>Pilih Keadaan</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="genital" class="form-label">Genital & Anus : </label>
                    <select class="form-select" id="genital" name="genital" aria-label="Default select ">
                        <option value="-" selected>Pilih Keadaan</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="tht" class="form-label">THT: </label>
                    <select class="form-select" id="tht" name="tht" aria-label="Default select ">
                        <option value="-" selected>Pilih Keadaan</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="ekstremitas" class="form-label">Ekstremitas: </label>
                    <select class="form-select" id="ekstremitas" name="ekstremitas" aria-label="Default select ">
                        <option value="-" selected>Pilih Keadaan</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="thoraks" class="form-label">Thoraks : </label>
                    <select class="form-select" id="thoraks" name="thoraks" aria-label="Default select ">
                        <option value="-" selected>Pilih Keadaan</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="kulit" class="form-label">Kulit : </label>
                    <select class="form-select" id="kulit" name="kulit" aria-label="Default select ">
                        <option value="-" selected>Pilih Keadaan</option>
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <label for="ket_fisik" class="form-label">Keterangan</label>
                <textarea class="form-control h-75" id="ket_fisik" name="ket_fisik" rows="5"></textarea>
            </div>
        </div>
    </div>

    <hr class="mb-5">
    <div>
        <h5 class="text-start">IV. PEMERIKSAAN PENUNJANGAN</h5>

        <div class="row mb-2">
            <label for="penunjang" class="form-label">Penunjang</label>
            <textarea class="form-control" id="penunjang" name="penunjang" rows="3"></textarea>
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
            <label for="konsulrujuk" class="form-label">Keterangan</label>
            <textarea class="form-control" id="konsulrujuk" name="konsulrujuk" rows="3"></textarea>
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
