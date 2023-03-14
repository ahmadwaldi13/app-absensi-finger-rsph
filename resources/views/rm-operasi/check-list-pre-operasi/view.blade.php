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
            <label for="identitas" class="form-label">Indentitas : </label>
            <input type="text" class="form-control"  id="identitas" name="identitas" required  value="{{!empty($data_pasien->identitas) ? $data_pasien->identitas : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="keadaan_umum" class="form-label">Keadaan Umum Pasien : </label>
            <input type="text" class="form-control"  id="keadaan_umum" name="keadaan_umum" required  value="{{!empty($data_pasien->keadaan_umum) ? $data_pasien->keadaan_umum : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="penandaan_area_operasi" class="form-label">Penandaan Area Operasi : </label>
            <input type="text" class="form-control"  id="penandaan_area_operasi" name="penandaan_area_operasi" required  value="{{!empty($data_pasien->penandaan_area_operasi) ? $data_pasien->penandaan_area_operasi : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="surat_ijin_bedah" class="form-label">Surat Izin Bedah : </label>
            <input type="text" class="form-control"  id="surat_ijin_bedah" name="surat_ijin_bedah" required  value="{{!empty($data_pasien->surat_ijin_bedah) ? $data_pasien->surat_ijin_bedah : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="surat_ijin_anestesi" class="form-label">Surat Izin Anestesi : </label>
            <input type="text" class="form-control"  id="surat_ijin_anestesi" name="surat_ijin_anestesi" required  value="{{!empty($data_pasien->surat_ijin_anestesi) ? $data_pasien->surat_ijin_anestesi : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="surat_ijin_transfusi" class="form-label">Surat Izin Transfusi : </label>
            <input type="text" class="form-control"  id="surat_ijin_transfusi" name="surat_ijin_transfusi" required  value="{{!empty($data_pasien->surat_ijin_transfusi) ? $data_pasien->surat_ijin_transfusi : ''}}" readonly>
            <div class="message"></div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="persiapan_darah" class="form-label">Persiapan Darah : </label>
            <div class="d-flex">
                <input type="text" class="form-control"  id="persiapan_darah" name="persiapan_darah" required  value="{{!empty($data_pasien->persiapan_darah) ? $data_pasien->persiapan_darah : ''}}" readonly>
                <div class="message"></div>
                <input  type="text" placeholder="keterangan_persiapan_darah" class="ms-2 form-control" name="keterangan_persiapan_darah"   id='ket_inspekulo' readonly value="{{ !empty($data_pasien->keterangan_persiapan_darah) ? $data_pasien->keterangan_persiapan_darah : '' }}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="perlengkapan_khusus" class="form-label">Perlengkapan Khusus, Alat/Implan : </label>
            <input type="text" class="form-control"  id="perlengkapan_khusus" name="perlengkapan_khusus" required  value="{{!empty($data_pasien->perlengkapan_khusus) ? $data_pasien->perlengkapan_khusus : ''}}" readonly>
            <div class="message"></div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p>Hasil Pemeriksaan Penunjang :</p>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_rontgen" class="form-label">Radiologi : </label>
            <div class="d-flex">
                <input type="text" class="form-control"  id="perlengkapan_khusus" name="perlengkapan_khusus" required  value="{{!empty($data_pasien->pemeriksaan_penunjang_rontgen) ? $data_pasien->pemeriksaan_penunjang_rontgen : ''}}" readonly>
                <input  type="text" readonly class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_rontgen"   id='ket_inspekulo' value="{{ !empty($data_pasien->keterangan_pemeriksaan_penunjang_rontgen) ? $data_pasien->keterangan_pemeriksaan_penunjang_rontgen : '' }}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_ekg" class="form-label">EKG : </label>
            <div class="d-flex">
                <input type="text" class="form-control"  id="pemeriksaan_penunjang_ekg" name="pemeriksaan_penunjang_ekg" required  value="{{!empty($data_pasien->pemeriksaan_penunjang_ekg) ? $data_pasien->pemeriksaan_penunjang_ekg : ''}}" readonly>
                <input  type="text" readonly class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ekg"   id='ket_inspekulo' value="{{ !empty($data_pasien->keterangan_pemeriksaan_penunjang_ekg) ? $data_pasien->keterangan_pemeriksaan_penunjang_ekg : '' }}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_usg" class="form-label">USG : </label>
            <div class="d-flex">
                <input type="text" class="form-control"  id="pemeriksaan_penunjang_usg" name="pemeriksaan_penunjang_usg" required  value="{{!empty($data_pasien->pemeriksaan_penunjang_usg) ? $data_pasien->pemeriksaan_penunjang_usg : ''}}" readonly>
                <input  type="text" readonly class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_usg"   id='ket_inspekulo' value="{{ !empty($data_pasien->keterangan_pemeriksaan_penunjang_usg) ? $data_pasien->keterangan_pemeriksaan_penunjang_usg : '' }}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_ctscan" class="form-label">CT Scan : </label>
            <div class="d-flex">
                <input type="text" class="form-control"  id="pemeriksaan_penunjang_ctscan" name="pemeriksaan_penunjang_ctscan" required  value="{{!empty($data_pasien->pemeriksaan_penunjang_ctscan) ? $data_pasien->pemeriksaan_penunjang_ctscan : ''}}" readonly>
                <input  type="text" readonly class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_ctscan"   id='ket_inspekulo' value="{{ !empty($data_pasien->keterangan_pemeriksaan_penunjang_ctscan) ? $data_pasien->keterangan_pemeriksaan_penunjang_ctscan : '' }}">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="pemeriksaan_penunjang_mri" class="form-label">MRI : </label>
            <div class="d-flex">
                <input type="text" class="form-control"  id="pemeriksaan_penunjang_mri" name="pemeriksaan_penunjang_mri" required  value="{{!empty($data_pasien->pemeriksaan_penunjang_mri) ? $data_pasien->pemeriksaan_penunjang_mri : ''}}" readonly>
                <input  type="text" readonly class="ms-2 form-control" name="keterangan_pemeriksaan_penunjang_mri"   id='ket_inspekulo' value="{{ !empty($data_pasien->keterangan_pemeriksaan_penunjang_mri) ? $data_pasien->keterangan_pemeriksaan_penunjang_mri : '' }}">
            </div>
        </div>
    </div>
<hr>
    <div class="row justify-content-start align-items-end mb-3">
        <div class="row justify-content-left">
            <div class="col-lg-2 mb-3">
                <div class='bagan_form'>
                <label for="nip_petugas_ruangan" class="form-label">NIP <span class="text-danger">*</span></label>
                <input type="text" class="form-control"  id="nip_petugas_ruangan" name="nip_petugas_ruangan" required  value="{{!empty($data_pasien->nip_petugas_ruangan) ? $data_pasien->nip_petugas_ruangan : ''}}" readonly>
                <div class="message"></div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                    <div class='bagan_form'>
                        <label for="nip_petugas_ruangan" class="form-label">Petugas Ruangan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  id="nip_petugas_ruangan" name="nip_petugas_ruangan" required  value="{{!empty($data_pasien->petugas_ruangan) ? $data_pasien->petugas_ruangan : ''}}" readonly>
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
