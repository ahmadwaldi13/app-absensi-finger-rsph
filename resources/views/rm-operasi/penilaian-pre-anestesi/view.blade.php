<div class="row justify-content-start align-items-end mb-3">
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="norawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" id="norawat" readonly disabled required  value="{{ !empty($form_header->no_rawat) ? $form_header->no_rawat : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value=" {{ !empty($form_header->no_rm) ? $form_header->no_rm : '' }}">
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
        <div class='bagan_form'>
            <label for="tanggal_permintaan" class="form-label">Tanggal Lahir :</label>
            <input type="text" class="form-control" id="no_rm" readonly disabled required  value="{{ !empty($form_header->tgl_lahir) ? $form_header->tgl_lahir : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
            <label for="norawat" class="form-label">J.K. :</label>
            <input type="text" class="form-control" id="norawat" readonly disabled required  value="{{ !empty($form_header->jk) ? $form_header->jk : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-2 mb-3">
        <div class='bagan_form'>
        <label for="kd_dokter" class="form-label">Kode Dokter <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kd_dokter" name='kd_dokter' readonly required value="{{ !empty($data_pasien->kd_dokter) ? $data_pasien->kd_dokter : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
        <label for="nama_dokter" class="form-label">Dokter <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_dokter" name='nama_dokter' readonly required value="{{ !empty($data_pasien->nama_dokter) ? $data_pasien->nama_dokter : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='bagan_form'>
        <label for="kd_dokter" class="form-label">Tanggal :<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="Tanggal" name='Tanggal' readonly required value="{{ !empty($data_pasien->tanggal) ? $data_pasien->tanggal : '' }}">
            <div class="message"></div>
        </div>
    </div>
</div>

<hr>
<div class="row justify-content-start align-items-end">
    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="diagnosa" class="form-label">Diagnosa :</label>
            <input type="text" class="form-control" id="diagnosa" name='diagnosa' readonly required value="{{ !empty($data_pasien->diagnosa) ? $data_pasien->diagnosa : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="rencana_tindakan" class="form-label">Rencana Tindakan :</label>
            <input type="text" class="form-control" id="Tanggal" name='Tanggal' readonly required value="{{ !empty($data_pasien->rencana_tindakan) ? $data_pasien->rencana_tindakan : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='input-date-time-bagan'>
            <label for="tanggal_operasi" class="form-label">Tgl.Operasi : <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="Tanggal" name='Tanggal' readonly required value="{{ !empty($data_pasien->tanggal_operasi) ? $data_pasien->tanggal_operasi : '' }}">
            <div class="message"></div>
        </div>
    </div>
</div>

<hr class="mb-4">
    <div class="row justify-content-start align-items-end mb-3">
        <p><span class="fw-bold me-2">&#8544;</span> Asesmen Fisik :</p>
        <div class="col-lg-3 mb-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input type="text" class="form-control" id="tb" name='tb' readonly required value="{{ !empty($data_pasien->tb) ? $data_pasien->tb : '' }}">
                <div class="message"></div>
                <span class="input-group-text">Cm</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="bb" class="form-label">Bb : </label>
            <div class="input-group">
                <input type="text" class="form-control" id="Tanggal" name='Tanggal' readonly required value="{{ !empty($data_pasien->bb) ? $data_pasien->bb : '' }}">
            <div class="message"></div>
                <span class="input-group-text">Kg</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input type="text" class="form-control" id="Tanggal" name='Tanggal' readonly required value="{{ !empty($data_pasien->td) ? $data_pasien->td : '' }}">
            <div class="message"></div>
                <span class="input-group-text">mmHg</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="io2" class="form-label">IO2 : </label>
            <div class="input-group">
                <input type="text" class="form-control" id="Tanggal" name='Tanggal' readonly required value="{{ !empty($data_pasien->io2) ? $data_pasien->io2 : '' }}">
            <div class="message"></div>
                <span class="input-group-text">%</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input  type="text" id="nadi" name="nadi" value="{{ !empty($data_pasien->nadi) ? $data_pasien->nadi : '' }}"  class="form-control" readonly>
                <span class="input-group-text">x/menit</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input  type="text" id="suhu" name="suhu" value="{{ !empty($data_pasien->suhu) ? $data_pasien->suhu : '' }}"  class="form-control" readonly>
                <span class="input-group-text">&#111;C</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="pernapasan" class="form-label">Pernapasan : </label>
            <div class="input-group">
                <input  type="text" id="pernapasan" name="pernapasan" value="{{ !empty($data_pasien->pernapasan) ? $data_pasien->pernapasan : '' }}"  class="form-control" readonly>
                <span class="input-group-text">x/menit</span>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_cardiovasculer" class="form-label">Cardiovasculer : </label>
            <div class="input-group">
                <input  type="text" id="fisik_cardiovasculer" name="fisik_cardiovasculer" value="{{ !empty($data_pasien->fisik_cardiovasculer) ? $data_pasien->fisik_cardiovasculer : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_paru" class="form-label">Paru : </label>
            <div class="input-group">
                <input  type="text" id="fisik_paru" name="fisik_paru" value="{{ !empty($data_pasien->fisik_paru) ? $data_pasien->fisik_paru : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_abdomen" class="form-label">Abdomen : </label>
            <div class="input-group">
                <input  type="text" id="fisik_abdomen" name="fisik_abdomen" value="{{ !empty($data_pasien->fisik_abdomen) ? $data_pasien->fisik_abdomen : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_extrimitas" class="form-label">Exrimitas : </label>
            <div class="input-group">
                <input  type="text" id="fisik_extrimitas" name="fisik_extrimitas" value="{{ !empty($data_pasien->fisik_extrimitas) ? $data_pasien->fisik_extrimitas : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_endokrin" class="form-label">Endokrin : </label>
            <div class="input-group">
                <input  type="text" id="fisik_endokrin" name="fisik_endokrin" value="{{ !empty($data_pasien->fisik_endokrin) ? $data_pasien->fisik_endokrin : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_ginjal" class="form-label">Ginjal : </label>
            <div class="input-group">
                <input  type="text" id="fisik_ginjal" name="fisik_ginjal" value="{{ !empty($data_pasien->fisik_ginjal) ? $data_pasien->fisik_ginjal : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_obatobatan" class="form-label">Obat-obatan : </label>
            <div class="input-group">
                <input  type="text" id="fisik_obatobatan" name="fisik_obatobatan" value="{{ !empty($data_pasien->fisik_obatobatan) ? $data_pasien->fisik_obatobatan : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_laborat" class="form-label">Laboratorium : </label>
            <div class="input-group">
                <input  type="text" id="fisik_laborat" name="fisik_laborat" value="{{ !empty($data_pasien->fisik_laborat) ? $data_pasien->fisik_laborat : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_penunjang" class="form-label">Penunjang : </label>
            <div class="input-group">
                <input  type="text" id="fisik_penunjang" name="fisik_penunjang" value="{{ !empty($data_pasien->fisik_penunjang) ? $data_pasien->fisik_penunjang : '' }}"  class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p><span class="fw-bold me-2">&#8545;</span> Riwayat Penyakit :</p>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_penyakit_alergiobat" class="form-label">Alergi Obat : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_penyakit_alergiobat" name="riwayat_penyakit_alergiobat" value="{{ !empty($data_pasien->riwayat_penyakit_alergiobat) ? $data_pasien->riwayat_penyakit_alergiobat : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_penyakit_alergilainnya" class="form-label">Alergi Lainnya : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_penyakit_alergilainnya" name="riwayat_penyakit_alergilainnya" value="{{ !empty($data_pasien->riwayat_penyakit_alergilainnya) ? $data_pasien->riwayat_penyakit_alergilainnya : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_penyakit_terapi" class="form-label">Terapi : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_penyakit_terapi" name="riwayat_penyakit_terapi" value="{{ !empty($data_pasien->riwayat_penyakit_terapi) ? $data_pasien->riwayat_penyakit_terapi : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="riwayat_kebiasaan_merokok" class="form-label">Merokok :</label>
            <div class="d-flex">
                <input  type="text" id="riwayat_kebiasaan_merokok" name="riwayat_kebiasaan_merokok" value="{{ !empty($data_pasien->riwayat_kebiasaan_merokok) ? $data_pasien->riwayat_kebiasaan_merokok : '' }}"  class="form-control" readonly>
                <input  type="text" class="form-control w-75" name="riwayat_kebiasaan_ket_merokok"  id='riwayat_kebiasaan_ket_merokok' value="{{ !empty($data_pasien->riwayat_kebiasaan_ket_merokok) ? $data_pasien->riwayat_kebiasaan_ket_merokok : '' }}"><span class="mt-2 ms-1">batang/hari</span>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="riwayat_kebiasaan_alkohol" class="form-label">Alkohol :</label>
            <div class="d-flex">
                <input  type="text" id="riwayat_penyakit_terapi" name="riwayat_penyakit_terapi" value="{{ !empty($data_pasien->riwayat_kebiasaan_alkohol) ? $data_pasien->riwayat_kebiasaan_alkohol : '' }}"  class="form-control" readonly>
                <input  type="text" class="form-control w-75" name="riwayat_kebiasaan_ket_alkohol"  id='riwayat_kebiasaan_ket_alkohol' value="{{ !empty($data_pasien->riwayat_kebiasaan_ket_alkohol) ? $data_pasien->riwayat_kebiasaan_ket_alkohol : '' }}"><span class="mt-2 ms-1">gelas/hari</span>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_kebiasaan_obat" class="form-label">Pengunaan Obat :</label>
            <div class="d-flex">
                <input  type="text" id="riwayat_penyakit_terapi" name="riwayat_penyakit_terapi" value="{{ !empty($data_pasien->riwayat_kebiasaan_obat) ? $data_pasien->riwayat_kebiasaan_obat : '' }}"  class="form-control" readonly>
                <input  type="text" class="form-control w-75" name="riwayat_kebiasaan_ket_obat"  id='riwayat_kebiasaan_ket_obat' value="{{ !empty($data_pasien->riwayat_kebiasaan_ket_obat) ? $data_pasien->riwayat_kebiasaan_ket_obat : '' }}">
            </div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p><span class="fw-bold me-2">&#8546;</span> Riwayat Medis :</p>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_cardiovasculer" class="form-label">Cardiovasculer : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_cardiovasculer" name="riwayat_medis_cardiovasculer" value="{{ !empty($data_pasien->riwayat_medis_cardiovasculer) ? $data_pasien->riwayat_medis_cardiovasculer : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_respiratory" class="form-label">Respiratory : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_respiratory" name="riwayat_medis_respiratory" value="{{ !empty($data_pasien->riwayat_medis_respiratory) ? $data_pasien->riwayat_medis_respiratory : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_endocrine" class="form-label">Endocrine : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_endocrine" name="riwayat_medis_endocrine" value="{{ !empty($data_pasien->riwayat_medis_endocrine) ? $data_pasien->riwayat_medis_endocrine : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_lainnya" class="form-label">Lainnya : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_lainnya" name="riwayat_medis_lainnya" value="{{ !empty($data_pasien->riwayat_medis_lainnya) ? $data_pasien->riwayat_medis_lainnya : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <hr>
        <div class="col-lg-4 mb-2">
            <label for="rencana_anestesi" class="form-label">Rencana Anestesi :</label>
            <input  type="text" id="riwayat_medis_lainnya" name="riwayat_medis_lainnya" value="{{ !empty($data_pasien->rencana_anestesi) ? $data_pasien->rencana_anestesi : '' }}"  class="form-control" readonly>
        </div>
        <div class="col-lg-4 mb-2">
            <label for="asa" class="form-label">Angka Asa :</label>
            <input  type="text" id="asa" name="asa" value="{{ !empty($data_pasien->asa) ? $data_pasien->asa : '' }}"  class="form-control" readonly>
        </div>
        <div class="col-lg-4 mb-2">
            <div class='input-date-time-bagan'>
                <label for="puasa" class="form-label">Puasa : <span class="text-danger">*</span></label>
                <input  type="text" id="asa" name="asa" value="{{ !empty($data_pasien->puasa) ? $data_pasien->puasa : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="rencana_perawatan" class="form-label">Rencana Perawatan : </label>
            <div class="input-group">
                <input  type="text" id="rencana_perawatan" name="rencana_perawatan" value="{{ !empty($data_pasien->rencana_perawatan) ? $data_pasien->rencana_perawatan : '' }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="catatan_khusus" class="form-label">Catatan Khusus : </label>
            <div class="input-group">
                <input  type="text" id="catatan_khusus" name="catatan_khusus" value="{{ !empty($data_pasien->catatan_khusus) ? $data_pasien->catatan_khusus : '' }}"  class="form-control" readonly>
            </div>
        </div>
    </div>
