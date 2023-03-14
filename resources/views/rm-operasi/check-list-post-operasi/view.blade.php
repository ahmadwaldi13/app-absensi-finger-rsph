<div class="row justify-content-start align-items-end mb-3">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="no_rawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="no_rawat" readonly disabled required  value="{{ !empty($form_header->no_rawat) ? $form_header->no_rawat : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($form_header->no_rm) ? $form_header->no_rm : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($form_header->nm_pasien) ? $form_header->nm_pasien : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='input-date-time-bagan'>
            <label for="tanggal_permintaan" class="form-label">Tanggal Lahir :</label>
            <input type="text" class="form-control" id="tanggal" readonly disabled required name="tanggal" value="{{ !empty($form_header->tgl_lahir) ? $form_header->tgl_lahir : '' }}">
        </div>
    </div>
</div>

<div class="row justify-content-start align-items-end mb-4">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Tanggal :<span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->tanggal) ? $data_pasien->tanggal : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">SN/CN : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->sncn) ? $data_pasien->sncn : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Kode Dokter : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->kd_dokter_bedah) ? $data_pasien->kd_dokter_bedah : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Dokter Bedah : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->dokter_bedah) ? $data_pasien->dokter_bedah : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class='bagan_form'>
            <label for="tindakan" class="form-label">Tindakan : <span class="text-danger">*</span></label>
            <input type="text" class="form-control" readonly name="tindakan" id="tindakan"  value="{{ !empty($data_pasien->tindakan) ? $data_pasien->tindakan : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Kode Dokter : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->kd_dokter_anestesi) ? $data_pasien->kd_dokter_anestesi : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">Dokter Anestesi : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->dokter_anestesi) ? $data_pasien->dokter_anestesi : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
</div>

 <hr class="mb-5">
    <div class="row justify-content-start align-items-end mb-4">
        <p>Perawat Melakukan Konfirmasi :</p>
        <div class="col-lg-4 mb-3">
            <label for="keadaan_umum" class="form-label">Keadaan Umum : </label>
            <input type="text" class="form-control"  id="keadaan_umum" name="keadaan_umum" required  value="{{!empty($data_pasien->keadaan_umum) ? $data_pasien->keadaan_umum : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="jenis_cairan_infus" class="form-label">Jenis Cairan Infus : </label>
            <input type="text" class="form-control" id="jenis_cairan_infus" name="jenis_cairan_infus" value="{{!empty($data_pasien->jenis_cairan_infus) ? $data_pasien->jenis_cairan_infus : ''}} " readonly>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="jaringan_pa" class="form-label">Jaringan/Organ Tubuh PA/VC : </label>
            <input type="text" class="form-control"  id="jaringan_pa" name="jaringan_pa" required  value="{{!empty($data_pasien->jaringan_pa) ? $data_pasien->jaringan_pa : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="kateter_urine" class="form-label">Keteter Urine : </label>
            <input type="text" class="form-control"  id="kateter_urine" name="kateter_urine" required  value="{{!empty($data_pasien->kateter_urine) ? $data_pasien->kateter_urine : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="tanggal_pemasangan_kateter" class="form-label">Jika ada, Tgl.Pemasangan :</label>
            <input type="text" class="form-control" id="tanggal_pemasangan_kateter"  name="tanggal_pemasangan_kateter"  value="{{!empty($data_pasien->tanggal_pemasangan_kateter) ? $data_pasien->tanggal_pemasangan_kateter : ''}}" readonly>
                <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="warna_kateter" class="form-label">, Warna : </label>
            <input type="text" class="form-control"  id="keadaan_umum" name="keadaan_umum" required  value="{{!empty($data_pasien->warna_kateter) ? $data_pasien->warna_kateter : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="jumlah_kateter" class="form-label">, jumlah :</label>
                <input type="text" class="form-control" id="jumlah_kateter"  name="jumlah_kateter"   value="{{!empty($data_pasien->jumlah_kateter) ? $data_pasien->jumlah_kateter : ''}}" readonly>
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="drain" class="form-label">Drain : </label>
            <input type="text" class="form-control" id="drain"  name="drain" readonly  value="{{!empty($data_pasien->drain) ? $data_pasien->drain : ''}}">
                <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="jumlah_drain" class="form-label">Jika ada, Jumlah :</label>
                <input type="text" class="form-control" id="jumlah_drain"  name="jumlah_drain"  value="{{!empty($data_pasien->jumlah_drain) ? $data_pasien->jumlah_drain : ''}}" readonly>
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="letak_drain" class="form-label">Letak :</label>
                <input type="text" class="form-control" id="letak_drain"  name="letak_drain"  value="{{!empty($data_pasien->letak_drain) ? $data_pasien->letak_drain : ''}}" readonly>
                <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="warna_drain" class="form-label">, Warna/Produksi :</label>
                <input type="text" class="form-control" id="warna_drain"  name="warna_drain"  value="{{!empty($data_pasien->warna_drain) ? $data_pasien->warna_drain : ''}}" readonly>
                <div class="message"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <p>Kelengkapan Penunjang :</p>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_rontgen" class="form-label">Radiologi : </label>
            <div class="d-flex">
                <input type="text" class="form-control" id="pemeriksaan_penunjang_rontgen"  name="pemeriksaan_penunjang_rontgen"  value="{{!empty($data_pasien->pemeriksaan_penunjang_rontgen) ? $data_pasien->pemeriksaan_penunjang_rontgen : ''}}" readonly>
                <div class="message"></div>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_rontgen" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_rontgen) ? $data_pasien->keterangan_pemeriksaan_penunjang_rontgen : ''}}"  id='keterangan_pemeriksaan_penunjang_rontgen' readonly>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_ekg" class="form-label">EKG : </label>
            <div class="d-flex">
                <input type="text" class="form-control" id="pemeriksaan_penunjang_ekg"  name="pemeriksaan_penunjang_ekg"  value="{{!empty($data_pasien->pemeriksaan_penunjang_ekg) ? $data_pasien->pemeriksaan_penunjang_ekg : ''}}" readonly>
                <div class="message"></div>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ekg" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_ekg) ? $data_pasien->keterangan_pemeriksaan_penunjang_ekg : ''}}"  id='keterangan_pemeriksaan_penunjang_ekg' readonly >
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_mri" class="form-label">MRI : </label>
            <div class="d-flex">
                <input type="text" class="form-control" id="warna_drain"  name="warna_drain"  value="{{!empty($data_pasien->pemeriksaan_penunjang_mri) ? $data_pasien->pemeriksaan_penunjang_mri : ''}}" readonly>
                <div class="message"></div>
                <input  type="text" placeholder="keterangan_pemeriksaan_penunjang_mri" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_mri" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_mri) ? $data_pasien->keterangan_pemeriksaan_penunjang_mri : ''}}"  id='keterangan_pemeriksaan_penunjang_mri' readonly>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_usg" class="form-label">USG : </label>
            <div class="d-flex">
                <input type="text" class="form-control" id="pemeriksaan_penunjang_usg"  name="pemeriksaan_penunjang_usg"  value="{{!empty($data_pasien->pemeriksaan_penunjang_usg) ? $data_pasien->pemeriksaan_penunjang_usg : ''}}" readonly>
                <div class="message"></div>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_usg" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_usg) ? $data_pasien->keterangan_pemeriksaan_penunjang_usg : ''}}"  id='keterangan_pemeriksaan_penunjang_usg' readonly>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="pemeriksaan_penunjang_ctscan" class="form-label">CT Scan : </label>
            <div class="d-flex">
                <input type="text" class="form-control" id="pemeriksaan_penunjang_ctscan"  name="pemeriksaan_penunjang_ctscan"  value="{{!empty($data_pasien->pemeriksaan_penunjang_ctscan) ? $data_pasien->pemeriksaan_penunjang_ctscan : ''}}" readonly>
                <div class="message"></div>
                <input  type="text" placeholder="Keterangan" class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ctscan" value="{{!empty($data_pasien->keterangan_pemeriksaan_penunjang_ctscan) ? $data_pasien->keterangan_pemeriksaan_penunjang_ctscan : ''}}"  id='keterangan_pemeriksaan_penunjang_ctscan' readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class='bagan_form'>
                <label for="area_luka_operasi" class="form-label">Area Luka Operasi :</label>
                <input type="text" class="form-control" id="area_luka_operasi" name="area_luka_operasi"  value="{{!empty($data_pasien->area_luka_operasi) ? $data_pasien->area_luka_operasi : ''}}" readonly>
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
                        <label for="petugas_anestesi" class="form-label">Petugas Anestesi  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  id="petugas_anestesi" name="petugas_anestesi" required  value="{{!empty($data_pasien->petugas_anestesi) ? $data_pasien->petugas_anestesi : ''}}" readonly>
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
                    <input type="text" class="form-control"  id="nip_perawat_ok" name="nip_perawat_ok" required  value="{{!empty($data_pasien->petugas_ok) ? $data_pasien->petugas_ok : ''}}" readonly>
                        <div class="message"></div>
                    </div>
            </div>
    </div>
</div>
