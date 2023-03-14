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
            <input type="text" class="form-control" readonly  id="sncn" name="sncn" required  value="{{!empty($data_pasien->tanggal) ? $data_pasien->tanggal : ''}}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="sncn" class="form-label">SN/CN : <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  id="sncn" name="sncn" required  value="{{!empty($data_pasien->sncn) ? $data_pasien->sncn : ''}}" >
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
        <p>Konfirmasi Dipimpin Oleh Salah Satu Anggota Tim, Semua Kegiatan Ditangguhkan Kecuali Jika Mengancam Jiwa :</p>
        <div class="col-lg-6">
            <p>Verbalisasi Tim :</p>
        </div>
        <div class="col-lg-6">
            <label for="penandaan_area_operasi" class="form-label">Penandaan Area Operasi : </label>
            <input type="text" class="form-control"  id="penandaan_area_operasi" name="penandaan_area_operasi" required  value="{{!empty($data_pasien->penandaan_area_operasi) ? $data_pasien->penandaan_area_operasi : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_identitas" class="form-label">Indentitas : </label>
            <input type="text" class="form-control"  id="verbal_identitas" name="verbal_identitas" required  value="{{!empty($data_pasien->verbal_identitas) ? $data_pasien->verbal_identitas : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="verbal_tindakan" class="form-label">Tindakan : </label>
            <input type="text" class="form-control"  id="verbal_tindakan" name="verbal_tindakan" required  value="{{!empty($data_pasien->verbal_tindakan) ? $data_pasien->verbal_tindakan : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class='bagan_form'>
                <label for="verbal_area_insisi" class="form-label">Area Insisi :</label>
                <input type="text" class="form-control"  id="verbal_area_insisi" name="verbal_area_insisi" required  value="{{!empty($data_pasien->verbal_area_insisi) ? $data_pasien->verbal_area_insisi : ''}}" readonly>
            <div class="message"></div>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="lama_operasi" class="form-label">Pekiraan Lama : </label>
            <input type="text" class="form-control" id="lama_operasi" name="lama_operasi" value="{{!empty($data_pasien->lama_operasi) ? $data_pasien->lama_operasi : ''}}" readonly>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-4">
        <p>Penayangan Hasil Pemeriksaan Penunjang :</p>
        <div class="col-lg-4 mb-3">
            <label for="penayangan_radiologi" class="form-label">Radiologi : </label>
            <input type="text" class="form-control"  id="penayangan_radiologi" name="penayangan_radiologi" required  value="{{!empty($data_pasien->penayangan_radiologi) ? $data_pasien->penayangan_radiologi : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="penayangan_ctscan" class="form-label">CT Scan : </label>
            <input type="text" class="form-control"  id="penayangan_ctscan" name="penayangan_ctscan" required  value="{{!empty($data_pasien->penayangan_ctscan) ? $data_pasien->penayangan_ctscan : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class='bagan_form'>
                <label for="penayangan_mri" class="form-label">MRI :</label>
                <input type="text" class="form-control"  id="penayangan_mri" name="penayangan_mri" required  value="{{!empty($data_pasien->penayangan_mri) ? $data_pasien->penayangan_mri : ''}}" readonly>
                <div class="message"></div>
                </select>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class='bagan_form '>
                <label for="antibiotik_profilaks" class="form-label">Pemberian Antibiotik Profilaksis :</label>
                <div class="d-flex ">
                    <input type="text" class="form-control" style="width: 15%"  id="antibiotik_profilaks" name="antibiotik_profilaks" required  value="{{!empty($data_pasien->antibiotik_profilaks) ? $data_pasien->antibiotik_profilaks : ''}}" readonly>
            <div class="message"></div>
                    <p class="ms-2">, Jika diberikan :</p>
                    <input  type="text" class="ms-2 form-control" style="width: 42%" name="nama_antibiotik" id='nama_antibiotik' value="{{!empty($data_pasien->nama_antibiotik) ? $data_pasien->nama_antibiotik : ''}}" readonly>
                    <p class="ms-2">, Jam Pemberian :</p>
                    <input type="text" class="form-control" name="jam_pemberian" style="width: 15%;" id="jam_pemberian" value="{{!empty($data_pasien->jam_pemberian) ? $data_pasien->jam_pemberian : ''}}" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class="d-flex justify-content-start align-items-center">
                <label for="antisipasi_kehilangan_darah" class="form-label">Antisipasi Kehilangan Darah > 500 ml (7ml/kg BB Untuk Anak) : </label>
                <input type="text" class="form-control ms-2" style="width: 56%" id="antisipasi_kehilangan_darah" name="antisipasi_kehilangan_darah" value="{{!empty($data_pasien->antisipasi_kehilangan_darah) ? $data_pasien->antisipasi_kehilangan_darah : ''}}" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <label for="hal_khusus" class="form-label">Hal Yang Khusus Yang Perlu Perhatian : </label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control"style="width: 24%"  id="hal_khusus" name="hal_khusus" required  value="{{!empty($data_pasien->hal_khusus) ? $data_pasien->hal_khusus : ''}}" readonly>
                <div class="message"></div>
                <p class="ms-2">, Jika Ada :</p>
                <input type="text" class="form-control ms-2" style="width: 65%" id="hal_khusus_diperhatikan" name="hal_khusus_diperhatikan" value="{{!empty($data_pasien->hal_khusus_diperhatikan) ? $data_pasien->hal_khusus_diperhatikan : ''}}" readonly>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="tanggal_steril" class="form-label">Tanggal : </label>
            <input type="text" class="form-control input-daterange input-date-time" name="tanggal_steril" value="{{!empty($data_pasien->tanggal_steril) ? $data_pasien->tanggal_steril : ''}}" readonly id="tanggal"  required autocomplete="off">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="petujuk_sterilisasi" class="form-label">Petunjuk Sterilisasi Telah Dikonfirmasi : </label>
            <input type="text" class="form-control"  id="hal_khusus" name="hal_khusus" required  value="{{!empty($data_pasien->petujuk_sterilisasi) ? $data_pasien->petujuk_sterilisasi : ''}}" readonly>
                <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="verifikasi_preoperatif" class="form-label">Veritifikasi Pre Operatif Telah Dilakukan :</label>
            <input type="text" class="form-control"  id="hal_khusus" name="hal_khusus" required  value="{{!empty($data_pasien->verifikasi_preoperatif) ? $data_pasien->verifikasi_preoperatif : ''}}" readonly>
                <div class="message"></div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-start align-items-end mb-3">
        <div class="row justify-content-left">
            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                <label for="nip_perawat_ok" class="form-label">NIP <span class="text-danger">*</span></label>
                <input type="text" class="form-control"  id="nip_perawat_ok" name="nip_perawat_ok" required  value="{{!empty($data_pasien->nip_perawat_ok) ? $data_pasien->nip_perawat_ok : ''}}" readonly>
                    <div class="message"></div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class='bagan_form'>
                    <label for="nip_perawat_ok" class="form-label">Petugas Kamar Operasi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  id="nip_perawat_ok" name="nip_perawat_ok" required  value="{{!empty($data_pasien->petugas_ok) ? $data_pasien->petugas_ok : ''}}" readonly>
                        <div class="message"></div>
                    </div>
            </div>
    </div>
</div>
