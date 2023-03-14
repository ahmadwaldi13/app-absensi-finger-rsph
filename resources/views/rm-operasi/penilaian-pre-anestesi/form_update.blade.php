<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form id="formIsiResume" action="{{url('/rmoperasi-nilai-pre-anestesi/update')}}" method="post" id="check_list_pre_operasi">
    @csrf
    <input type="hidden" class="form-control" name="no_rawat" value="{{ !empty($form_header->no_rawat) ? $form_header->no_rawat : '' }}">
    @include('rm-operasi.penilaian_header_update',[
        "data_pasien"=>$data_pasien,
        "form_header" => $form_header
    ])
<hr>
<div class="row justify-content-start align-items-end">
    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="diagnosa" class="form-label">Diagnosa :</label>
            <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="{{ !empty($data_pasien->diagnosa) ? $data_pasien->diagnosa : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <div class='bagan_form'>
            <label for="rencana_tindakan" class="form-label">Rencana Tindakan :</label>
            <input type="text" class="form-control" id="rencana_tindakan" name="rencana_tindakan" value="{{ !empty($data_pasien->rencana_tindakan) ? $data_pasien->rencana_tindakan : '' }}">
            <div class="message"></div>
        </div>
    </div>
    <div class="col-lg-3 mb-3">
        <div class='input-date-time-bagan'>
            <label for="tanggal_operasi" class="form-label">Tanggal : <span class="text-danger">*</span></label>
            <input type="text" class="form-control input-daterange input-date-time" id='tanggal_operasi' autocomplete="off">
            <input type="hidden" id="tgl" required name="tanggal_operasi" value="{{ !empty($data_pasien->tanggal) ? $data_pasien->tanggal : '' }}">
        </div>
    </div>
</div>
<hr>
    <div class="row justify-content-start align-items-end mb-3">
        <p><span class="fw-bold me-2">&#8544;</span> Asesmen Fisik :</p>
        <div class="col-lg-3 mb-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input  type="text" name="tb" name="tb" value="{{ !empty($data_pasien->tb) ? $data_pasien->tb : '' }}"  id="td" class="form-control">
                <span class="input-group-text">Cm</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="bb" class="form-label">Bb : </label>
            <div class="input-group">
                <input  type="text" id="bb" name="bb" value="{{ !empty($data_pasien->bb) ? $data_pasien->bb : '' }}"  class="form-control">
                <span class="input-group-text">Kg</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input  type="text" id="td" name="td" value="{{ !empty($data_pasien->td) ? $data_pasien->td : '' }}"  class="form-control">
                <span class="input-group-text">mmHg</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="io2" class="form-label">IO2 : </label>
            <div class="input-group">
                <input  type="text" id="io2" name="io2" value="{{ !empty($data_pasien->io2) ? $data_pasien->io2 : '' }}"  class="form-control">
                <span class="input-group-text">%</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input  type="text" id="nadi" name="nadi" value="{{ !empty($data_pasien->nadi) ? $data_pasien->nadi : '' }}"  class="form-control">
                <span class="input-group-text">x/menit</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input  type="text" id="suhu" name="suhu" value="{{ !empty($data_pasien->suhu) ? $data_pasien->suhu : '' }}"  class="form-control">
                <span class="input-group-text">&#111;C</span>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <label for="pernapasan" class="form-label">Pernapasan : </label>
            <div class="input-group">
                <input  type="text" id="pernapasan" name="pernapasan" value="{{ !empty($data_pasien->pernapasan) ? $data_pasien->pernapasan : '' }}"  class="form-control">
                <span class="input-group-text">x/menit</span>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_cardiovasculer" class="form-label">Cardiovasculer : </label>
            <div class="input-group">
                <input  type="text" id="fisik_cardiovasculer" name="fisik_cardiovasculer" value="{{ !empty($data_pasien->fisik_cardiovasculer) ? $data_pasien->fisik_cardiovasculer : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_paru" class="form-label">Paru : </label>
            <div class="input-group">
                <input  type="text" id="fisik_paru" name="fisik_paru" value="{{ !empty($data_pasien->fisik_paru) ? $data_pasien->fisik_paru : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_abdomen" class="form-label">Abdomen : </label>
            <div class="input-group">
                <input  type="text" id="fisik_abdomen" name="fisik_abdomen" value="{{ !empty($data_pasien->fisik_abdomen) ? $data_pasien->fisik_abdomen : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_extrimitas" class="form-label">Exrimitas : </label>
            <div class="input-group">
                <input  type="text" id="fisik_extrimitas" name="fisik_extrimitas" value="{{ !empty($data_pasien->fisik_extrimitas) ? $data_pasien->fisik_extrimitas : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_endokrin" class="form-label">Endokrin : </label>
            <div class="input-group">
                <input  type="text" id="fisik_endokrin" name="fisik_endokrin" value="{{ !empty($data_pasien->fisik_endokrin) ? $data_pasien->fisik_endokrin : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_ginjal" class="form-label">Ginjal : </label>
            <div class="input-group">
                <input  type="text" id="fisik_ginjal" name="fisik_ginjal" value="{{ !empty($data_pasien->fisik_ginjal) ? $data_pasien->fisik_ginjal : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_obatobatan" class="form-label">Obat-obatan : </label>
            <div class="input-group">
                <input  type="text" id="fisik_obatobatan" name="fisik_obatobatan" value="{{ !empty($data_pasien->fisik_obatobatan) ? $data_pasien->fisik_obatobatan : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_laborat" class="form-label">Laboratorium : </label>
            <div class="input-group">
                <input  type="text" id="fisik_laborat" name="fisik_laborat" value="{{ !empty($data_pasien->fisik_laborat) ? $data_pasien->fisik_laborat : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="fisik_penunjang" class="form-label">Penunjang : </label>
            <div class="input-group">
                <input  type="text" id="fisik_penunjang" name="fisik_penunjang" value="{{ !empty($data_pasien->fisik_penunjang) ? $data_pasien->fisik_penunjang : '' }}"  class="form-control">
            </div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p><span class="fw-bold me-2">&#8545;</span> Riwayat Penyakit :</p>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_penyakit_alergiobat" class="form-label">Alergi Obat : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_penyakit_alergiobat" name="riwayat_penyakit_alergiobat" value="{{ !empty($data_pasien->riwayat_penyakit_alergiobat) ? $data_pasien->riwayat_penyakit_alergiobat : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_penyakit_alergilainnya" class="form-label">Alergi Lainnya : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_penyakit_alergilainnya" name="riwayat_penyakit_alergilainnya" value="{{ !empty($data_pasien->riwayat_penyakit_alergilainnya) ? $data_pasien->riwayat_penyakit_alergilainnya : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_penyakit_terapi" class="form-label">Terapi : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_penyakit_terapi" name="riwayat_penyakit_terapi" value="{{ !empty($data_pasien->riwayat_penyakit_terapi) ? $data_pasien->riwayat_penyakit_terapi : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="riwayat_kebiasaan_merokok" class="form-label">Merokok :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="riwayat_kebiasaan_merokok"  name="riwayat_kebiasaan_merokok" aria-label="Default select example">
                    <option value="Tidak" {{$data_pasien->riwayat_kebiasaan_merokok === 'Tidak' ? 'selected' : '' }} >Tidak</option>
                    <option value="Ya" {{$data_pasien->riwayat_kebiasaan_merokok === 'Ya' ? 'selected' : '' }} >Ya</option>
                </select>
                <input  type="text" class="form-control w-75" name="riwayat_kebiasaan_ket_merokok"  id='riwayat_kebiasaan_ket_merokok' value="{{ !empty($data_pasien->riwayat_kebiasaan_ket_merokok) ? $data_pasien->riwayat_kebiasaan_ket_merokok : '' }}"><span class="mt-2 ms-1">batang/hari</span>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="riwayat_kebiasaan_alkohol" class="form-label">Alkohol :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="riwayat_kebiasaan_alkohol"  name="riwayat_kebiasaan_alkohol" aria-label="Default select example">
                    <option value="Tidak" {{$data_pasien->riwayat_kebiasaan_alkohol === 'Tidak' ? 'selected' : '' }} >Tidak</option>
                    <option value="Ya" {{$data_pasien->riwayat_kebiasaan_alkohol === 'Ya' ? 'selected' : '' }} >Ya</option>
                </select>
                <input  type="text" class="form-control w-75" name="riwayat_kebiasaan_ket_alkohol"  id='riwayat_kebiasaan_ket_alkohol' value="{{ !empty($data_pasien->riwayat_kebiasaan_ket_alkohol) ? $data_pasien->riwayat_kebiasaan_ket_alkohol : '' }}"><span class="mt-2 ms-1">gelas/hari</span>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_kebiasaan_obat" class="form-label">Pengunaan Obat :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="riwayat_kebiasaan_obat"  name="riwayat_kebiasaan_obat" aria-label="Default select example">
                    <option value="-" {{$data_pasien->riwayat_kebiasaan_obat === '-' ? 'selected' : '' }} >-</option>
                    <option value="Obat-Obatan" {{$data_pasien->riwayat_kebiasaan_obat === 'Obat-Obatan' ? 'selected' : '' }} >Obat-Obatan</option>
                    <option value="Vitamin" {{$data_pasien->riwayat_kebiasaan_obat === 'Vitamin' ? 'selected' : '' }} >Vitamin</option>
                    <option value="Jamu Jamuan" {{$data_pasien->riwayat_kebiasaan_obat === 'Jamu Jamuan' ? 'selected' : '' }} >Jamu Jamuan</option>
                </select>
                <input  type="text" class="form-control w-75" name="riwayat_kebiasaan_ket_obat"  id='riwayat_kebiasaan_ket_obat' value="{{ !empty($data_pasien->riwayat_kebiasaan_ket_obat) ? $data_pasien->riwayat_kebiasaan_ket_obat : '' }}">
            </div>
        </div>
    </div>
    <div class="row justify-content-start align-items-end mb-3">
        <p><span class="fw-bold me-2">&#8546;</span> Riwayat Medis :</p>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_cardiovasculer" class="form-label">Cardiovasculer : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_cardiovasculer" name="riwayat_medis_cardiovasculer" value="{{ !empty($data_pasien->riwayat_medis_cardiovasculer) ? $data_pasien->riwayat_medis_cardiovasculer : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_respiratory" class="form-label">Respiratory : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_respiratory" name="riwayat_medis_respiratory" value="{{ !empty($data_pasien->riwayat_medis_respiratory) ? $data_pasien->riwayat_medis_respiratory : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_endocrine" class="form-label">Endocrine : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_endocrine" name="riwayat_medis_endocrine" value="{{ !empty($data_pasien->riwayat_medis_endocrine) ? $data_pasien->riwayat_medis_endocrine : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <label for="riwayat_medis_lainnya" class="form-label">Lainnya : </label>
            <div class="input-group">
                <input  type="text" id="riwayat_medis_lainnya" name="riwayat_medis_lainnya" value="{{ !empty($data_pasien->riwayat_medis_lainnya) ? $data_pasien->riwayat_medis_lainnya : '' }}"  class="form-control">
            </div>
        </div>
        <hr>
        <div class="col-lg-4 mb-2">
            <label for="rencana_anestesi" class="form-label">Rencana Anestesi :</label>
                <select class="form-select" id="rencana_anestesi"  name="rencana_anestesi" aria-label="Default select example">
                    <option value="GA" {{$data_pasien->rencana_anestesi === 'GA' ? 'selected' : '' }} >GA</option>
                    <option value="RA Spinal" {{$data_pasien->rencana_anestesi === 'RA Spinal' ? 'selected' : '' }} >RA Spinal</option>
                    <option value="RA Epidural" {{$data_pasien->rencana_anestesi === 'RA Epidural' ? 'selected' : '' }} >RA Epidural</option>
                    <option value="RA Combined" {{$data_pasien->rencana_anestesi === 'RA Combined' ? 'selected' : '' }} >RA Combined</option>
                    <option value="Blok Syaraf" {{$data_pasien->rencana_anestesi === 'Blok Syaraf' ? 'selected' : '' }} >Blok Syaraf</option>
                </select>
        </div>
        <div class="col-lg-4 mb-2">
            <label for="asa" class="form-label">Angka Asa :</label>
                <select class="form-select" id="asa"  name="asa" aria-label="Default select example">
                    <option value="1"{{$data_pasien->rencana_anestesi === '1' ? 'selected' : '' }}>1</option>
                    <option value="2"{{$data_pasien->rencana_anestesi === '2' ? 'selected' : '' }}>2</option>
                    <option value="3"{{$data_pasien->rencana_anestesi === '3' ? 'selected' : '' }}>3</option>
                    <option value="4"{{$data_pasien->rencana_anestesi === '4' ? 'selected' : '' }}>4</option>
                    <option value="5"{{$data_pasien->rencana_anestesi === '5' ? 'selected' : '' }}>5</option>
                    <option value="E"{{$data_pasien->rencana_anestesi === 'E' ? 'selected' : '' }}>E</option>
                </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="puasa" class="form-label">Puasa :</label>
            <input  type="text" class="form-control input-daterange input-date-time" name="puasa" value="{{!empty($data_pasien->puasa) ? $data_pasien->puasa : ''}}" id="puasa"  required autocomplete="off">
        </div>
        <div class="col-lg-6 mb-2">
            <label for="rencana_perawatan" class="form-label">Rencana Perawatan : </label>
            <div class="input-group">
                <input  type="text" id="rencana_perawatan" name="rencana_perawatan" value="{{ !empty($data_pasien->rencana_perawatan) ? $data_pasien->rencana_perawatan : '' }}"  class="form-control">
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <label for="catatan_khusus" class="form-label">Catatan Khusus : </label>
            <div class="input-group">
                <input  type="text" id="catatan_khusus" name="catatan_khusus" value="{{ !empty($data_pasien->catatan_khusus) ? $data_pasien->catatan_khusus : '' }}"  class="form-control">
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
