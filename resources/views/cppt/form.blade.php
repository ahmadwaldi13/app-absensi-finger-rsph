<?php
    $get_user=(new \App\Http\Traits\AuthFunction)->getUser();
?>
<form action="{{ $action_form }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" name="key_old" value="{{ !empty($kode_key_old) ? $kode_key_old : ''  }}"  >
    <input type="hidden" value="{{ !empty($model->fr) ? $model->fr : ''  }}"  name="fr">
    <input type="hidden" value="{{ !empty($model->no_rm) ? $model->no_rm : ''  }}"  name="no_rm">

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-2 mb-3">
            <label for="norawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" readonly id="norawat" required name="no_rawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : ''  }}">
        </div>
        <div class="col-lg-4 mb-3">
            <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($model->no_rm) ? $model->no_rm : ''  }} {{ !empty($model->nm_pasien) ? $model->nm_pasien : ''  }}">
        </div>
        <div class="col-lg-4 mb-3">
            <div class='input-date-time-bagan'>
                <label for="tanggal" class="form-label">Tanggal : <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-daterange input-date-time" id='tanggal' autocomplete="off">
                @php
                    $tgl_default=!empty($model->tgl_perawatan) ? $model->tgl_perawatan : date('Y-m-d');
                    $jam_default=!empty($model->jam_rawat) ? $model->jam_rawat : date('H:i');
                @endphp
                <input type="text" hidden id="tgl" required name="tgl_perawatan" value='{{ $tgl_default }}'>
                <input type="text" hidden id="jam" required name="jam_rawat" value='{{ $jam_default }}'>
            </div>
        </div>
    </div>

    <hr class="mb-5">
    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-2 mb-3">
            <label for="kodeDokter" class="form-label">Dilakukan</label>
            <input type="text" aria-label="readonly input" readonly class="form-control readonly" id="kodeDokter" value="{{ !empty($model->nip) ? $model->nip : ''  }}" name="nip">
        </div>
        <div class="col-lg-4 mb-3">
            <div class="button-icon-inside">
                <input type="text" readonly class="input-text" id="namaDokter" value="{{ !empty($model->nama) ? $model->nama : ''  }}" />
                @if($get_user->type_user!='dokter')
                    <span class='ModalDokter' id="ModalDokter">
                        <span class="iconify hover-pointer text-primary" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                    </span>
                @endif
            </div>
        </div>
        <div class="col mb-3">
            <label for="profesi" class="form-label">Profesi / Jabatan / Departemen :</label>
            <input type="text" readonly class="form-control readonly" id="profesi" value="{{ !empty($data_dilakukan->jabatan) ? $data_dilakukan->jabatan : '' }}">
        </div>
    </div>

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-2 mb-3">
            <label for="gcs" class="form-label">GCS (E,V,M)</label>
            <input type="text" class="form-control" id="gcs" name="gcs" value="{{ !empty($model->gcs) ? $model->gcs : ''  }}">
        </div>
        <div class="col-lg-2 mb-3">
            <label for="kesadaran" class="form-label">Kesadaran</label>
            <select class="form-select input-dropdown" aria-label="Default select example" id="kesadaran" name="kesadaran">
                <option value=""></option>
                @php
                    $dipilih=!empty($model->kesadaran) ? $model->kesadaran : '';
                @endphp
                @foreach($kesadarans as $key => $item)
                    @php
                        $selected='';
                        if(strtolower($dipilih)==strtolower($item)){
                            $selected='selected';
                        }
                    @endphp
                    <option value="{{ $item }}" {{ $selected }} >{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="col mb-3">
            <label for="alergi" class="form-label">Alergi : </label>
            <input type="text" class="form-control" id="alergi" name="alergi" value="{{ !empty($model->alergi) ? $model->alergi : ''  }}">
        </div>
        @if($model->fr!='ri')
            <div class="col mb-3">
                <label for="lingkar_perut" class="form-label">Lingkar Perut ( Cm ) : </label>
                <input type="text" class="form-control" id="lingkar_perut" name="lingkar_perut" value="{{ !empty($model->lingkar_perut) ? $model->lingkar_perut : ''  }}">
            </div>
        @endif
    </div>

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-6 mb-3">
            <label for="subjek" class="form-label">Subjek :<span class="text-danger">*</span></label>
            <textarea class="form-control" id="subjek" name="keluhan" rows="3" required>{{ !empty($model->keluhan) ? $model->keluhan : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="asesmen" class="form-label">Asesmen : <span class="text-danger">*</span></label>
            <textarea class="form-control" id="asesmen" rows="3" required name="penilaian">{{ !empty($model->penilaian) ? $model->penilaian : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="objek" class="form-label">Objek :<span class="text-danger">*</span></label>
            <textarea class="form-control" id="objek" name="pemeriksaan" rows="3" required>{{ !empty($model->pemeriksaan) ? $model->pemeriksaan : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="plan" class="form-label">Plan : </label>
            <textarea class="form-control" id="plan" rows="3" name="rtl">{{ !empty($model->rtl) ? $model->rtl : '' }}</textarea>
        </div>
    </div>

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-3 mb-3">
            <label for="suhu" class="form-label">Suhu (*C)</label>
            <input type="number" class="form-control" id="suhu" name="suhu_tubuh" step=0.01 value="{{ !empty($model->suhu_tubuh) ? $model->suhu_tubuh : ''  }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="tinggiBadan" class="form-label">Tinggi Badan</label>
            <input type="number" class="form-control" id="tinggiBadan" name="tinggi" value="{{ !empty($model->tinggi) ? $model->tinggi : ''  }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="beratBadan" class="form-label">Berat Badan</label>
            <input type="number" class="form-control" id="beratBadan" name="berat" value="{{ !empty($model->berat) ? $model->berat : ''  }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="tensi" class="form-label">Tensi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tensi" name="tensi" value="{{ !empty($model->tensi) ? $model->tensi : ''  }}" required>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="resporasi" class="form-label">Respirasi (/menit)</label>
            <input type="number" class="form-control" id="resporasi" name="respirasi" value="{{ !empty($model->respirasi) ? $model->respirasi : ''  }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="nadi" class="form-label">Nadi (/menit)<span class="text-danger"></span></label>
            <input type="number" class="form-control" id="nadi" name="nadi" value="{{ !empty($model->nadi) ? $model->nadi : ''  }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="spo2" class="form-label">SpO2 (%)</label>
            <input type="number" class="form-control" id="spo2" name="spo2" value="{{ !empty($model->spo2) ? $model->spo2 : ''  }}">
        </div>
    </div>
    
    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-6 mb-3">
            <label for="intruksi" class="form-label">Instruksi :</label>
            <textarea class="form-control" id="intruksi" name="instruksi" rows="3">{{ !empty($model->instruksi) ? $model->instruksi : '' }}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="evaluasi" class="form-label">Evaluasi :</label>
            <textarea class="form-control" id="evaluasi" name="evaluasi" rows="3">{{ !empty($model->evaluasi) ? $model->evaluasi : '' }}</textarea>
        </div>
    </div>

    <div class="row justify-content-start align-items-end table-responsive">
        <div class="col-lg-2 mb-3">
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">{{ !empty($kode_key_old) ? 'Ubah' : 'Simpan'  }}</button>
            </div>
        </div>
    </div>

</form>

<script>
    $("#tanggal")
        .daterangepicker({
            singleDatePicker: true,
            startDate: `${$("#tgl").val()} - ${$("#jam").val()}`,
            locale: {
                format: "YYYY-MM-DD - HH:mm:ss",
            },
            timePicker: true,
            showDropdowns: true,
            linkedCalendars: false,
            timePickerSeconds: true,
        });
    
    $("#tanggal").on("change keyup", function () {
        let date = $(this).val();
        let tgl = date.substring(0, 10);
        let jam = date.substring(13);

        $("#tgl").val(tgl);
        $("#jam").val(jam);
    });
</script>