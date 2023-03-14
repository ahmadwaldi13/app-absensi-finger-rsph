<form action="{{ url('/penilaian-medis-geriatri/update') }}" method="post">
    @csrf
    <div class="row mb-3">
        @include('penilaian.form_header', [
            "pj_form_type"=>"dokter",
            "nama_pj" => $penilaian->nm_dokter,
            "kode_pj" => $penilaian->kd_dokter,
            "readonly" => true
        ])
        <div class="col mb-2">
            <label for="tanggal" class="form-label">Tanggal : </label>
            <input  readonly type="text" class="form-control input-daterange input-date-time" name="tanggal" value="{{!empty($penilaian->tanggal) ? $penilaian->tanggal : ''}}" id="tanggal"  required autocomplete="off">
        </div>
        <div class="col mb-2">
            <label for="informasi" class="form-label">Informasi didapat dari : </label>
            <select class="form-select" id="anamnesis" readonly name="anamnesis" value="{{$penilaian->anamnesis}}" aria-label="Default select ">
                <option value="-" {{$penilaian->anamnesis === "-" ? 'selected' : ''}}>Pilih Informasi</option>
                <option value="Autoanamnesis" {{$penilaian->anamnesis === 'Autoanamnesis' ? 'selected' : '' }} >Autoanamnesis</option>
                <option value="Alloanamnesis" {{$penilaian->anamnesis === 'Alloanamnesis' ? 'selected' : ''}} >Alloanamnesis</option>
            </select>
        </div>
    </div>

    <hr class="mb-5">

    <div>
        <h5 class="text-start">I. RIWAYAT KESEHATAN</h5>
        <div class="row align-items-end">
            <div class="col-6 mb-2">
                <label for="keluhan_utama" class="form-label">Keluhan Utama</label>
                <textarea class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{!empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : ''}}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rps" class="form-label">Riwayat Penyakit Sekarang</label>
                <textarea class="form-control" id="rps" name="rps" rows="3">{{!empty($penilaian->rps) ? $penilaian->rps : ''}}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
                <textarea class="form-control" id="rpo" name="rpo" rows="3">{{!empty($penilaian->rpo) ? $penilaian->rpo : ''}}</textarea>
            </div>
            <div class="col-6 mb-2">
                <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
                <textarea class="form-control" id="rpd" name="rpd" rows="3">{{!empty($penilaian->rpd) ? $penilaian->rpd : ''}}</textarea>
            </div>
            <div class="col-6 mb-2 ">
                <label for="alergi" class="form-label">Riwayat Alergi</label>
                <input type="text" class="form-control" name="alergi" id='alergi' value="{{!empty($penilaian->alergi) ? $penilaian->alergi : ''}}">
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
                            <input type="text" name="td" id="td" class="form-control" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}">
                            <span class="input-group-text" id="ModalPetugas">mmHg</span>
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="nadi" class="form-label">Nadi : </label>
                        <div class="input-group">
                            <input type="text" id="nadi" name="nadi" class="form-control" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}">
                            <span class="input-group-text" id="ModalPetugas">x / Menit</span>
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="suhu" class="form-label">Suhu : </label>
                        <div class="input-group">
                            <input type="text" id="suhu" name="suhu" class="form-control" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}">
                            <span class="input-group-text" id="ModalPetugas">&#8451;</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mb-2">
                        <label for="rr" class="form-label">RR : </label>
                        <div class="input-group">
                            <input type="text" id="rr" name="rr" class="form-control" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}">
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
                <textarea class="form-control w-100 h-75" id="kondisi_umum" name="kondisi_umum" rows="5">{{!empty($penilaian->kondisi_umum) ? $penilaian->kondisi_umum : ''}}</textarea>
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
                            <option value="-" {{ $penilaian->kepala === '-' ? 'selected' : '' }}>Pilih status
                            </option>
                            <option value="Normal" {{ $penilaian->kepala === 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Abnormal" {{ $penilaian->kepala === 'Abnormal' ? 'selected' : '' }}>Abnormal
                            </option>
                            <option value="Tidak Diperiksa"
                                {{ $penilaian->kepala === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa</option>
                        </select>
                        <input type="text" class="form-control w-75" name="keterangan_kepala"
                            id='keterangan_kepala' value="{{!empty($penilaian->keterangan_kepala) ? $penilaian->keterangan_kepala : ''}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="thoraks" class="form-label">Thoraks :</label>
                    <div class="d-flex">
                        <select class="form-select w-25" id="thoraks" name="thoraks"
                            aria-label="Default select example">
                            <option value="-" {{ $penilaian->thoraks === '-' ? 'selected' : '' }}>Pilih status
                            </option>
                            <option value="Normal" {{ $penilaian->thoraks === 'Normal' ? 'selected' : '' }}>Normal
                            </option>
                            <option value="Abnormal" {{ $penilaian->thoraks === 'Abnormal' ? 'selected' : '' }}>Abnormal
                            </option>
                            <option value="Tidak Diperiksa"
                                {{ $penilaian->thoraks === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa</option>
                        </select>
                        <input type="text" class="form-control w-75" name="keterangan_thoraks"
                            id='keterangan_thoraks' value="{{!empty($penilaian->keterangan_thoraks) ? $penilaian->keterangan_thoraks : ''}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="abdomen" class="form-label">Abdomen :</label>
                    <div class="d-flex">
                        <select class="form-select w-25" id="abdomen" name="abdomen"
                            aria-label="Default select example">
                            <option value="-" {{ $penilaian->abdomen === '-' ? 'selected' : '' }}>Pilih status
                            </option>
                            <option value="Normal" {{ $penilaian->abdomen === 'Normal' ? 'selected' : '' }}>Normal
                            </option>
                            <option value="Abnormal" {{ $penilaian->abdomen === 'Abnormal' ? 'selected' : '' }}>Abnormal
                            </option>
                            <option value="Tidak Diperiksa"
                                {{ $penilaian->abdomen === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa</option>
                        </select>
                        <input type="text" class="form-control w-75" name="keterangan_abdomen"
                            id='keterangan_abdomen' value="{{!empty($penilaian->keterangan_abdomen) ? $penilaian->keterangan_abdomen : ''}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="ekstremitas" class="form-label">Ekstremitas:</label>
                    <div class="d-flex">
                        <select class="form-select w-25" id="ekstremitas" name="ekstremitas"
                            aria-label="Default select example">
                            <option value="-" {{ $penilaian->ekstremitas === '-' ? 'selected' : '' }}>Pilih status
                            </option>
                            <option value="Normal" {{ $penilaian->ekstremitas === 'Normal' ? 'selected' : '' }}>Normal
                            </option>
                            <option value="Abnormal" {{ $penilaian->ekstremitas === 'Abnormal' ? 'selected' : '' }}>
                                Abnormal</option>
                            <option value="Tidak Diperiksa"
                                {{ $penilaian->ekstremitas === 'Tidak Diperiksa' ? 'selected' : '' }}>Tidak Diperiksa
                            </option>
                        </select>
                        <input type="text" class="form-control w-75" name="keterangan_ekstremitas"
                            id='keterangan_ekstremitas' value="{{!empty($penilaian->keterangan_ekstremitas) ? $penilaian->keterangan_ekstremitas : ''}}">
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="lainnya" class="form-label">Lainnya :</label>
                    <textarea class="form-control" id="lainnya" name="lainnya" rows="3">{{!empty($penilaian->lainnya) ? $penilaian->lainnya : ''}}</textarea>
                </div>
            </div>
            <div class="col-6 ">
                <h5 class="text-center">Integument</h5>
                <div class="row mb-2">
                    <label for="Integument_kebersihan" class="form-label">Kebersihan :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="Integument_kebersihan" name="Integument_kebersihan"
                            aria-label="Default select example">
                            <option value="-" {{ $penilaian->Integument_kebersihan === '-' ? 'selected' : '' }}>Pilih status</option>
                            <option value="Normal" {{ $penilaian->Integument_kebersihan === 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Abnormal" {{ $penilaian->Integument_kebersihan === 'Abnormal' ? 'selected' : '' }}>Abnormal</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="Integument_warna" class="form-label">Warna :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="Integument_warna" name="Integument_warna"
                            aria-label="Default select example">
                            <option value="-" {{ $penilaian->Integument_warna === '-' ? 'selected' : '' }}>Pilih status</option>
                            <option value="Tidak Ada" {{ $penilaian->Integument_warna === 'Tidak Ada' ? 'selected' : '' }}>Normal</option>
                            <option value="Pucat" {{ $penilaian->Integument_warna === 'Pucat' ? 'selected' : '' }}>Pucat</option>
                            <option value="Sianosis" {{ $penilaian->Integument_warna === 'Sianosis' ? 'selected' : '' }}>Sianosis</option>
                            <option value="Lain-lain" {{ $penilaian->Integument_warna === 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="Integument_kelembaban" class="form-label">Kelembaban :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="Integument_kelembaban" name="Integument_kelembaban"
                            aria-label="Default select example">
                            <option value="-" {{ $penilaian->Integument_kelembaban === '-' ? 'selected' : '' }}>Pilih status</option>
                            <option value="Kering" {{ $penilaian->Integument_kelembaban === 'Kering' ? 'selected' : '' }}>Kering</option>
                            <option value="Lembab" {{ $penilaian->Integument_kelembaban === 'Lembab' ? 'selected' : '' }}>Lembab</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="Integument_gangguan_kulit" class="form-label">Gangguan Kulit :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="Integument_gangguan_kulit"
                            name="Integument_gangguan_kulit" aria-label="Default select example">
                            <option value="-" {{ $penilaian->Integument_gangguan_kulit === '-' ? 'selected' : '' }}>Pilih status</option>
                            <option value="Normal" {{ $penilaian->Integument_gangguan_kulit === 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Rash" {{ $penilaian->Integument_gangguan_kulit === 'Rash' ? 'selected' : '' }}>Rash</option>
                            <option value="Luka" {{ $penilaian->Integument_gangguan_kulit === 'Luka' ? 'selected' : '' }}>Luka</option>
                            <option value="Memar" {{ $penilaian->Integument_gangguan_kulit === 'Memar' ? 'selected' : '' }}>Memar</option>
                            <option value="Ptekie" {{ $penilaian->Integument_gangguan_kulit === 'Ptekie' ? 'selected' : '' }}>Ptekie</option>
                            <option value="Bula" {{ $penilaian->Integument_gangguan_kulit === 'Bula' ? 'selected' : '' }}>Bula</option>
                        </select>
                    </div>
                </div>
                <div class="col mb-2">
                    <label for="kondisi_sosial" class="form-label">Kondisi Sosial :</label>
                    <textarea class="form-control" id="kondisi_sosial" name="kondisi_sosial" rows="3">{{!empty($penilaian->kondisi_sosial) ? $penilaian->kondisi_sosial : ''}}</textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="row mb-2">
                    <label for="status_psikologis_gds" class="form-label">Psikologis (GDS) :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="status_psikologis_gds" name="status_psikologis_gds"
                            aria-label="Default select example">
                            <option value="-" {{ $penilaian->status_psikologis_gds === '-' ? 'selected' : '' }}>Pilih status</option>
                            <option value="Skor 1-4 Tidak Ada Depresi" {{ $penilaian->status_psikologis_gds === 'Skor 1-4 Tidak Ada Depresi' ? 'selected' : '' }}>Skor 1-4 Tidak Ada Depresi</option>
                            <option value="Skor Antara 5-9 Menunjukkan Kemungkinan Besar Depresi" {{ $penilaian->status_psikologis_gds === 'Skor Antara 5-9 Menunjukkan Kemungkinan Besar Depresi' ? 'selected' : '' }}>Skor Antara 5-9
                                Menunjukkan Kemungkinan Besar Depresi</option>
                            <option value="Skor 10 Atau Lebih Menunjukkan Depresi" {{ $penilaian->status_psikologis_gds === 'Skor 10 Atau Lebih Menunjukkan Depresi' ? 'selected' : '' }}>Skor 10 Atau Lebih Menunjukkan
                                Depresi</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="status_kognitif_mmse" class="form-label">Kognitif (MMSE) :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="status_kognitif_mmse" name="status_kognitif_mmse"
                            aria-label="Default select example">
                            <option value="-" {{ $penilaian->status_kognitif_mmse === '-' ? 'selected' : '' }}>Pilih status</option>
                            <option value="24-30 : Tidak Ada Gangguan Kognitif" {{ $penilaian->status_kognitif_mmse === '24-30 : Tidak Ada Gangguan Kognitif' ? 'selected' : '' }}>24-30 : Tidak Ada Gangguan Kognitif
                            </option>
                            <option value="18-23 : Gangguan Kognitif Sedang" {{ $penilaian->status_kognitif_mmse === '18-23 : Gangguan Kognitif Sedang' ? 'selected' : '' }}>18-23 : Gangguan Kognitif Sedang</option>
                            <option value="0-17 : Gangguan Kognitif Berat" {{ $penilaian->status_kognitif_mmse === '0-17 : Gangguan Kognitif Berat' ? 'selected' : '' }}>0-17 : Gangguan Kognitif Berat</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="status_nutrisi" class="form-label">Nutrisi (MNA) :</label>
                    <div class="d-flex">
                        <select class="form-select w-100" id="status_nutrisi" name="status_nutrisi"
                            aria-label="Default select example">
                            <option value="-" {{ $penilaian->status_nutrisi === '-' ? 'selected' : '' }}>Pilih status</option>
                            <option value="Skor 12-14 : Status Gizi Normal" {{ $penilaian->status_nutrisi === 'Skor 12-14 : Status Gizi Normal' ? 'selected' : '' }}>Skor 12-14 : Status Gizi Normal</option>
                            <option value="Skor 8-11 : Berisiko Malnutrisi" {{ $penilaian->status_nutrisi === 'Skor 8-11 : Berisiko Malnutrisi' ? 'selected' : '' }}>Skor 8-11 : Berisiko Malnutrisi</option>
                            <option value="Skor 0-7 : Malnutrisi" {{ $penilaian->status_nutrisi === 'Skor 0-7 : Malnutrisi' ? 'selected' : '' }}>Skor 0-7 : Malnutrisi</option>
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
                            <option value="-" {{ $penilaian->skrining_jatuh === '-' ? 'selected' : '' }}>Pilih status</option>
                            <option value="Risiko Rendah Skor 0-5" {{ $penilaian->skrining_jatuh === 'Risiko Rendah Skor 0-5' ? 'selected' : '' }}>Risiko Rendah Skor 0-5</option>
                            <option value="Risiko Sedang Skor 6-16" {{ $penilaian->skrining_jatuh === 'Risiko Sedang Skor 6-16' ? 'selected' : '' }}>Risiko Sedang Skor 6-16</option>
                            <option value="Risiko Tinggi Skor 17-30" {{ $penilaian->skrining_jatuh === 'Risiko Tinggi Skor 17-30' ? 'selected' : '' }}>Risiko Tinggi Skor 17-30</option>
                        </select>
                    </div>
                    <div class="row mb-2">
                        <label for="status_fungsional" class="form-label">Status Fungsional (ADL:BARTHEL INDEX)
                            :</label>
                        <div class="d-flex">
                            <select class="form-select w-100" id="status_fungsional" name="status_fungsional"
                                aria-label="Default select example">
                                <option value="-" {{ $penilaian->status_fungsional === '-' ? 'selected' : '' }}>Pilih status</option>
                                <option value="20 : Mandiri (A)" {{ $penilaian->status_fungsional === '20 : Mandiri (A)' ? 'selected' : '' }}>20 : Mandiri (A)</option>
                                <option value="12-19 : Ketergantungan Ringan (B)" {{ $penilaian->status_fungsional === '12-19 : Ketergantungan Ringan (B)' ? 'selected' : '' }}>12-19 : Ketergantungan Ringan (B)
                                </option>
                                <option value="9-11 : Ketergantungan Sedang (B)" {{ $penilaian->status_fungsional === '9-11 : Ketergantungan Sedang (B)' ? 'selected' : '' }}>9-11 : Ketergantungan Sedang (B)
                                </option>
                                <option value="5-8 : Ketergantungan Berat (C)" {{ $penilaian->status_fungsional === '5-8 : Ketergantungan Berat (C)' ? 'selected' : '' }}>5-8 : Ketergantungan Berat (C)</option>
                                <option value="0-4 : Ketergantungan Total (C)" {{ $penilaian->status_fungsional === '0-4 : Ketergantungan Total (C)' ? 'selected' : '' }}>0-4 : Ketergantungan Total (C)</option>
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
                <textarea class="form-control" id="lab" name="lab" rows="3">{{!empty($penilaian->lab) ? $penilaian->lab : ''}}</textarea>
            </div>
            <div class="col">
                <label for="rad" class="form-label">Radiologi :</label>
                <textarea class="form-control" id="rad" name="rad" rows="3">{{!empty($penilaian->rad) ? $penilaian->rad : ''}}</textarea>
            </div>
            <div class="col">
                <label for="pemeriksaan" class="form-label">Penunjang Lainya :</label>
                <textarea class="form-control" id="pemeriksaan" name="pemeriksaan" rows="3">{{!empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : ''}}</textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">V. DIAGNOSIS/ASESMEN</h5>
        <div class="row mb-2">
            <div class="col">
                <label for="diagnosis" class="form-label">Asesmen Kerja :</label>
                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3">{{!empty($penilaian->diagnosis) ? $penilaian->diagnosis : ''}}</textarea>
            </div>
            <div class="col">
                <label for="diagnosis2" class="form-label">Asesmen Banding :</label>
                <textarea class="form-control" id="diagnosis2" name="diagnosis2" rows="3">{{!empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : ''}}</textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">VI. PERMASALAHAN & TATALAKSANA</h5>
        <div class="row mb-2">
            <div class="col-6">
                <label for="permasalahan" class="form-label">Permasalahan :</label>
                <textarea class="form-control" id="permasalahan" name="permasalahan" rows="3">{{!empty($penilaian->permasalahan) ? $penilaian->permasalahan : ''}}</textarea>
            </div>
            <div class="col-6">
                <label for="terapi" class="form-label">Terapi/Pengobatan :</label>
                <textarea class="form-control" id="terapi" name="terapi" rows="3">{{!empty($penilaian->terapi) ? $penilaian->terapi : ''}}</textarea>
            </div>
            <div class="col-12">
                <label for="tindakan" class="form-label">Tindakan/Rencana Pengobatan :</label>
                <textarea class="form-control" id="tindakan" name="tindakan" rows="3">{{!empty($penilaian->tindakan) ? $penilaian->tindakan : ''}}</textarea>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div>
        <h5 class="text-start">VII. EDUKASI</h5>
        <div class="row mb-2">
            <div class="col">
                <textarea class="form-control" id="edukasi" name="edukasi" rows="3">{{!empty($penilaian->edukasi) ? $penilaian->edukasi : ''}}</textarea>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
