<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" name="key_old" value="{{ !empty($kode_key_old) ? $kode_key_old : ''  }}"  >
    <input type="hidden" class="form-control" name="fr" value="{{ !empty($model->fr) ? $model->fr : '' }}">
    <input type="hidden" class="form-control" name="no_rm" value="{{ !empty($model->no_rm) ? $model->no_rm : '' }}">
    <input type="hidden" class="form-control" name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">

    @include('rm-operasi.penilaian_header')
<hr>
<div class="row justify-content-start align-items-end">
    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="diagnosa" class="form-label">Diagnosa :</label>
            <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="rencana_tindakan" class="form-label">Rencana Tindakan :</label>
            <input type="text" class="form-control" id="rencana_tindakan" name="rencana_tindakan" value="">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='input-date-time-bagan'>
            <label for="tanggal_operasi" class="form-label">Tanggal : <span class="text-danger">*</span></label>
            <input type="text" class="form-control input-daterange input-date-time" id='tanggal_operasi' autocomplete="off">
            <input type="hidden" id="tgl" required name="tanggal_operasi" value="{{ !empty($model->tgl_permintaan) ? $model->tgl_permintaan : date('Y-m-d') }}">
        </div>
    </div>
</div>
<hr class="mb-4">
    <div class="row justify-content-start align-items-end mb-3">
        <p><span class="fw-bold me-2">&#8544;</span> Asesmen Fisik :</p>
        <div class="col-lg-3 mb-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input  type="text" name="tb" name="tb" value=""  id="td" class="form-control">
                <span class="input-group-text">Cm</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="bb" class="form-label">Bb : </label>
            <div class="input-group">
                <input  type="text" id="bb" name="bb" value=""  class="form-control">
                <span class="input-group-text">Kg</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input  type="text" id="td" name="td" value=""  class="form-control">
                <span class="input-group-text">mmHg</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="io2" class="form-label">IO2 : </label>
            <div class="input-group">
                <input  type="text" id="io2" name="io2" value=""  class="form-control">
                <span class="input-group-text">%</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input  type="text" id="nadi" name="nadi" value=""  class="form-control">
                <span class="input-group-text">x/menit</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input  type="text" id="suhu" name="suhu" value=""  class="form-control">
                <span class="input-group-text">&#111;C</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="pernapasan" class="form-label">Pernapasan : </label>
            <div class="input-group">
                <input  type="text" id="pernapasan" name="pernapasan" value=""  class="form-control">
                <span class="input-group-text">x/menit</span>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_cardiovasculer" class="form-label">Cardiovasculer : </label>
            <div class="input-group">
                <input  type="text" id="fisik_cardiovasculer" name="fisik_cardiovasculer" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_paru" class="form-label">Paru : </label>
            <div class="input-group">
                <input  type="text" id="fisik_paru" name="fisik_paru" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_abdomen" class="form-label">Abdomen : </label>
            <div class="input-group">
                <input  type="text" id="fisik_abdomen" name="fisik_abdomen" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_extrimitas" class="form-label">Exrimitas : </label>
            <div class="input-group">
                <input  type="text" id="fisik_extrimitas" name="fisik_extrimitas" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_endokrin" class="form-label">Endokrin : </label>
            <div class="input-group">
                <input  type="text" id="fisik_endokrin" name="fisik_endokrin" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_ginjal" class="form-label">Ginjal : </label>
            <div class="input-group">
                <input  type="text" id="fisik_ginjal" name="fisik_ginjal" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_obatobatan" class="form-label">Obat-obatan : </label>
            <div class="input-group">
                <input  type="text" id="fisik_obatobatan" name="fisik_obatobatan" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_laborat" class="form-label">Laboratorium : </label>
            <div class="input-group">
                <input  type="text" id="fisik_laborat" name="fisik_laborat" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_penunjang" class="form-label">Penunjang : </label>
            <div class="input-group">
                <input  type="text" id="fisik_penunjang" name="fisik_penunjang" value=""  class="form-control">
            </div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p><span class="fw-bold me-2">&#8545;</span> Riwayat Penyakit :</p>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_penyakit_alergiobat" class="form-label">Alergi Obat : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_penyakit_alergiobat" name="riwayat_penyakit_alergiobat" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_penyakit_alergilainnya" class="form-label">Alergi Lainnya : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_penyakit_alergilainnya" name="riwayat_penyakit_alergilainnya" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_penyakit_terapi" class="form-label">Terapi : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_penyakit_terapi" name="riwayat_penyakit_terapi" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="riwayat_kebiasaan_merokok" class="form-label">Merokok :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="riwayat_kebiasaan_merokok"  name="riwayat_kebiasaan_merokok" aria-label="Default select example">
                    <option value="Tidak"  >Tidak</option>
                    <option value="Ya"  >Ya</option>
                </select>
                <input  type="text" class="form-control w-75" name="riwayat_kebiasaan_ket_merokok"  id='riwayat_kebiasaan_ket_merokok' value=""><span class="mt-2 ms-1">batang/hari</span>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="riwayat_kebiasaan_alkohol" class="form-label">Alkohol :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="riwayat_kebiasaan_alkohol"  name="riwayat_kebiasaan_alkohol" aria-label="Default select example">
                    <option value="Tidak"  >Tidak</option>
                    <option value="Ya"  >Ya</option>
                </select>
                <input  type="text" class="form-control w-75" name="riwayat_kebiasaan_ket_alkohol"  id='riwayat_kebiasaan_ket_alkohol' value=""><span class="mt-2 ms-1">gelas/hari</span>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_kebiasaan_obat" class="form-label">Pengunaan Obat :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="riwayat_kebiasaan_obat"  name="riwayat_kebiasaan_obat" aria-label="Default select example">
                    <option value="-"  >-</option>
                    <option value="Obat-Obatan"  >Obat-Obatan</option>
                    <option value="Vitamin"  >Vitamin</option>
                    <option value="Jamu Jamuan"  >Jamu Jamuan</option>
                </select>
                <input  type="text" class="form-control w-75" name="riwayat_kebiasaan_ket_obat"  id='riwayat_kebiasaan_ket_obat' value="">
            </div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p><span class="fw-bold me-2">&#8546;</span> Riwayat Medis :</p>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_cardiovasculer" class="form-label">Cardiovasculer : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_cardiovasculer" name="riwayat_medis_cardiovasculer" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_respiratory" class="form-label">Respiratory : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_respiratory" name="riwayat_medis_respiratory" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_endocrine" class="form-label">Endocrine : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_endocrine" name="riwayat_medis_endocrine" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_lainnya" class="form-label">Lainnya : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_lainnya" name="riwayat_medis_lainnya" value=""  class="form-control">
            </div>
        </div>
        <hr>
        <div class="col-lg-4 mb-2">
            <label for="rencana_anestesi" class="form-label">Rencana Anestesi :</label>
                <select class="form-select" id="rencana_anestesi"  name="rencana_anestesi" aria-label="Default select example">
                    <option value="GA"  >GA</option>
                    <option value="RA Spinal"  >RA Spinal</option>
                    <option value="RA Epidural"  >RA Epidural</option>
                    <option value="RA Combined"  >RA Combined</option>
                    <option value="Blok Syaraf"  >Blok Syaraf</option>
                </select>
        </div>
        <div class="col-lg-4 mb-2">
            <label for="asa" class="form-label">Angka Asa :</label>
                <select class="form-select" id="asa"  name="asa" aria-label="Default select example">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="E">E</option>
                </select>
        </div>
        <div class="col-lg-4 mb-2">
            <div class='input-date-time-bagan'>
                <label for="puasa" class="form-label">Puasa : <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-daterange input-date-time" id='puasa' autocomplete="off">
                <input type="hidden" id="tgl" required name="puasa" value="{{ !empty($model->tgl_permintaan) ? $model->tgl_permintaan : date('Y-m-d') }}">
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="rencana_perawatan" class="form-label">Rencana Perawatan : </label>
            <div class="input-group">
                <input  type="text" id="rencana_perawatan" name="rencana_perawatan" value=""  class="form-control">
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="catatan_khusus" class="form-label">Catatan Khusus : </label>
            <div class="input-group">
                <input  type="text" id="catatan_khusus" name="catatan_khusus" value=""  class="form-control">
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


</form>
