<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{url('/check-list-post-operasi/update')}}" method="post" id="check-list-post-operasi">
    @csrf
    @include('rm-operasi.form_header_update',[
        "data_pasien"=>$data_pasien,
        "form_header" => $form_header
    ])
<hr class="mb-5">
 <div class="row justify-content-start align-items-end mb-4">
    <p>Serah Terima Perawat kamar Operasi Dengan Anestesi/Intensif/Ruangan. Perawat Melakukan Serah Terima Secara Verbal :</p>
    <div class="col-lg-4 mb-3">
        <label for="keadaan_umum" class="form-label">Keadaan Umum : </label>
        <select class="form-select" id="keadaan_umum" name="keadaan_umum" aria-label="Default select ">
            <option value="Sadar" {{$data_pasien->keadaan_umum === 'Sadar' ? 'selected' : '' }} >Sadar</option>
            <option value="Tidur" {{$data_pasien->keadaan_umum === 'Tidur' ? 'selected' : '' }} >Tidur</option>
            <option value="Terindubasi" {{$data_pasien->keadaan_umum === 'Terindubasi' ? 'selected' : '' }} >Terindubasi</option>
        </select>
    </div>
    <div class="col-lg-4 mb-3">
        <label for="jenis_cairan_infus" class="form-label">Jenis Cairan Infus : </label>
        <input type="text" class="form-control"  id="jenis_cairan_infus" name="jenis_cairan_infus"  value="{{!empty($data_pasien->jenis_cairan_infus) ? $data_pasien->jenis_cairan_infus : ''}}">
        <div class="message"></div>
    </div>
    <div class="col-lg-4 mb-3">
        <label for="jaringan_pa" class="form-label">Jaringan/Organ Tubuh PA/VC : </label>
        <select class="form-select" id="jaringan_pa" name="jaringan_pa" aria-label="Default select ">
            <option value="Ada" {{$data_pasien->jaringan_pa === 'Ada' ? 'selected' : '' }} >Ada</option>
            <option value="Tidak Ada" {{$data_pasien->jaringan_pa === 'Tidak Ada' ? 'selected' : '' }} >Tidak Ada</option>
        </select>
    </div>
    <div class="col-lg-3 mb-3">
        <label for="kateter_urine" class="form-label">Keteter Urine : </label>
        <select class="form-select" id="kateter_urine" name="kateter_urine" aria-label="Default select ">
            <option value="Ada" {{$data_pasien->kateter_urine === 'Ada' ? 'selected' : '' }} >Ada</option>
            <option value="Tidak Ada" {{$data_pasien->kateter_urine === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
        </select>
    </div>
    <div class="col-lg-3 mb-3">
        <label for="tanggal_pemasangan_kateter" class="form-label">Jika ada, Tgl.Pemasangan :</label>
        <input  type="text" class="form-control input-daterange input-date-time" name="tanggal_pemasangan_kateter" value="{{!empty($data_pasien->tanggal_pemasangan_kateter) ? $data_pasien->tanggal_pemasangan_kateter : ''}}" id="tanggal_pemasangan_kateter"  required autocomplete="off">
    </div>
    <div class="col-lg-3 mb-3">
        <label for="warna_kateter" class="form-label">, Warna : </label>
        <select class="form-select" id="warna_kateter" name="warna_kateter" aria-label="Default select ">
            <option value="Jernih"  {{$data_pasien->warna_kateter === 'Jernih' ? 'selected' : '' }} >Jernih</option>
            <option value="Keruh"  {{$data_pasien->warna_kateter === 'Keruh' ? 'selected' : '' }} >Keruh</option>
            <option value="-"  {{$data_pasien->warna_kateter === '-' ? 'selected' : '' }} >-</option>
        </select>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="jumlah_kateter" class="form-label">, jumlah :</label>
            <input type="text" class="form-control" id="jumlah_kateter"  name="jumlah_kateter"  value="{{!empty($data_pasien->jumlah_kateter) ? $data_pasien->jumlah_kateter : ''}}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <label for="drain" class="form-label">Drain : </label>
        <select class="form-select" id="drain" name="drain" aria-label="Default select ">
            <option value="Ada" {{$data_pasien->drain === 'Ada' ? 'selected' : '' }} >Ada</option>
            <option value="Tidak Ada" {{$data_pasien->drain === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
        </select>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="jumlah_drain" class="form-label">Jika ada, Jumlah :</label>
            <input type="text" class="form-control" id="jumlah_drain"  name="jumlah_drain"  value="{{!empty($data_pasien->jumlah_drain) ? $data_pasien->jumlah_drain : ''}}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="letak_drain" class="form-label">Letak :</label>
            <input type="text" class="form-control" id="letak_drain"  name="letak_drain"  value="{{!empty($data_pasien->letak_drain) ? $data_pasien->letak_drain : ''}}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="warna_drain" class="form-label">, Warna/Produksi :</label>
            <input type="text" class="form-control" id="warna_drain"  name="warna_drain"  value="{{!empty($data_pasien->warna_drain) ? $data_pasien->warna_drain : ''}}">
            <div class="message"></div>
        </div>
    </div>
</div>
<div class="row justify-content-start align-items-end mb-3">
    <p>Kelengkapan Penunjang :</p>
    <div class="col-lg-4 mb-3">
        <label for="pemeriksaan_penunjang_rontgen" class="form-label">Radiologi : </label>
        <div class="d-flex">
            <select class="form-select " id="pemeriksaan_penunjang_rontgen"  name="pemeriksaan_penunjang_rontgen" aria-label="Default select example">
                <option value="Ada" {{$data_pasien->pemeriksaan_penunjang_rontgen === 'Ada' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->pemeriksaan_penunjang_rontgen === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
            <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_rontgen" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_rontgen) ? $data_pasien->keterangan_pemeriksaan_penunjang_rontgen : ''}}"  id='keterangan_pemeriksaan_penunjang_rontgen'>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <label for="pemeriksaan_penunjang_ekg" class="form-label">EKG : </label>
        <div class="d-flex">
            <select class="form-select " id="pemeriksaan_penunjang_ekg"  name="pemeriksaan_penunjang_ekg" aria-label="Default select example">
                <option value="Ada" {{$data_pasien->pemeriksaan_penunjang_ekg === 'Ada' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->pemeriksaan_penunjang_ekg === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
            <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ekg" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_ekg) ? $data_pasien->keterangan_pemeriksaan_penunjang_ekg : ''}}"  id='keterangan_pemeriksaan_penunjang_ekg'>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <label for="pemeriksaan_penunjang_mri" class="form-label">MRI : </label>
        <div class="d-flex">
            <select class="form-select " id="pemeriksaan_penunjang_mri"  name="pemeriksaan_penunjang_mri" aria-label="Default select example">
                <option value="Ada" {{$data_pasien->pemeriksaan_penunjang_mri === 'Ada' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->pemeriksaan_penunjang_mri === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
            <input  type="text" placeholder="keterangan_pemeriksaan_penunjang_mri" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_mri" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_mri) ? $data_pasien->keterangan_pemeriksaan_penunjang_mri : ''}}"  id='keterangan_pemeriksaan_penunjang_mri' >
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <label for="pemeriksaan_penunjang_usg" class="form-label">USG : </label>
        <div class="d-flex">
            <select class="form-select " id="pemeriksaan_penunjang_usg"  name="pemeriksaan_penunjang_usg" aria-label="Default select example">
                <option value="Ada" {{$data_pasien->pemeriksaan_penunjang_usg === 'Ada' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->pemeriksaan_penunjang_usg === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
            <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_usg" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_usg) ? $data_pasien->keterangan_pemeriksaan_penunjang_usg : ''}}"  id='keterangan_pemeriksaan_penunjang_usg'>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <label for="pemeriksaan_penunjang_ctscan" class="form-label">CT Scan : </label>
        <div class="d-flex">
            <select class="form-select " id="pemeriksaan_penunjang_ctscan"  name="pemeriksaan_penunjang_ctscan" aria-label="Default select example">
                <option value="Ada" {{$data_pasien->pemeriksaan_penunjang_ctscan === 'Ada' ? 'selected' : '' }} >Ada</option>
                <option value="Tidak Ada" {{$data_pasien->pemeriksaan_penunjang_ctscan === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
            <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ctscan" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_ctscan) ? $data_pasien->keterangan_pemeriksaan_penunjang_ctscan : ''}}"  id='keterangan_pemeriksaan_penunjang_ctscan' >
        </div>
    </div>
    <div class="col-lg-12 mb-3">
        <div class='bagan_form'>
            <label for="area_luka_operasi" class="form-label">Area Luka Operasi :</label>
            <input type="text" class="form-control" id="area_luka_operasi" name="area_luka_operasi"  value="{{!empty($data_pasien->area_luka_operasi) ? $data_pasien->area_luka_operasi : ''}}">
            <div class="message"></div>
        </div>
    </div>
</div>
<hr>
<div class="row justify-content-start align-items-end mb-3">
    <div class="row justify-content-left">
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
            <label for="nip_perawat_anestesi" class="form-label">NIP <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="nip_perawat_anestesi" name="nip_perawat_anestesi" required  value="{{!empty($data_pasien->nip_perawat_anestesi) ? $data_pasien->nip_perawat_anestesi : ''}}" readonly>
            <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <label for="petugas_anestesi" class="form-label">Petugas Anestesi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  id="petugas_anestesi" required  value="{{!empty($data_pasien->petugas_anestesi) ? $data_pasien->petugas_anestesi : ''}}" readonly>
                    <div class="message"></div>
                    </div>
        </div>
        <div class="col-lg-2 mb-3">
            <div class='bagan_form'>
            <label for="nip_perawat_ok" class="form-label">NIP <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="nip_perawat_ok" name="nip_perawat_ok" required  value="{{!empty($data_pasien->nip_perawat_ok) ? $data_pasien->nip_perawat_ok : ''}}" readonly>
                <div class="message"></div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="nip_perawat_ok" class="form-label">Petugas OK <span class="text-danger">*</span></label>
                <input type="text" class="form-control"  id="nip_perawat_ok" required  value="{{!empty($data_pasien->petugas_ok) ? $data_pasien->petugas_ok : ''}}" readonly>
                    <div class="message"></div>
                </div>
        </div>
</div>
</div>
        <div class="row justify-content-start align-items-end my-5" id='bagan-save'>
            <div class="col-lg-2  mb-3">
                <div class="d-grid gap-2">
                    @if(empty($allow_btn_save))
                        <button class="btn btn-primary" id='btn_submit' type="submit">Simpan</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
