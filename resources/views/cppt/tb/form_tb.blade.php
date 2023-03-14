<h5 class="text-danger"><strong>Penting !!!</strong> </h5>
<p>Jika pasien terduga/teridentifikasi tuberculosis diharapkan melengkapi data pasien TB. Silahkan membuka form Pasien
    TB</p>

<div class="collapse mb-2" id="bagan-form-tambah-collapse">
    <div class="card card-body" style='background:#f2f2f2'>
        <form action="TB/create" method="POST" name="form1" onsubmit="return required(this)">
            @csrf
            <input type="text" value="{{ !empty($model->fr) ? $model->fr : $item_pasien->no_fr }}" hidden name="fr">
            <input type="text" value="{{ !empty($model->no_rm) ? $model->no_rm : $item_pasien->no_rm }}" hidden name="no_rm">
            <input type="text" value="{{ !empty($model->no_rawat) ? $model->no_rawat : $item_pasien->no_rawat }}" hidden name="no_rawat">

            
            <div class="row justify-content-start align-items-end table-responsive">
                <div class="col-lg-2 mb-3">
                    <label for="kodeDokter" class="form-label">Dilakukan</label>
                    <input type="text" aria-label="readonly input kodeDokter" readonly class="form-control readonly" id="kodeDokter" value="{{ $kode_first }}" name="nip">
                </div>
                <div class="col-lg-4 mb-3">
                    <input type="text" readonly class="form-control readonly" id="namaDokter" value="{{ $nama_first }}">
                </div>
                <div class="col mb-3">
                    <label for="profesi" class="form-label">Profesi / Jabatan / Departemen :</label>
                    <input type="text" readonly class="form-control readonly" id="profesi" value="{{ $jabatan_first }}">
                </div>
            </div>

            <div class="row justify-content-start align-items-end ">
                
                <div class="col-lg-4 mb-3">
                    <div class='input-date-time-bagan'>
                        @php
                            $tgl_default=!empty($singleDataTb->tanggal_mulai_pengobatan) ? $singleDataTb->tanggal_mulai_pengobatan : date('Y-m-d');
                        @endphp
                        <label for="tanggal" class="form-label">Tanggal Mulai Pengobatan : <span class="text-danger">*</span></label>
                        <input type="date" id="start" class="form-control form-duplicate"  name="tanggal_mulai_pengobatan"  required
                        value='{{ $tgl_default }}'
                        >
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class='bagan_form'>
                        <label for="icd_x" class="form-label">Kode Diagnosa : <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-duplicate" data-target='.confirm_icd_x'
                            name="icd_x" hidden id="icd_x" required
                            value='{{ !empty($singleDataTb->nm_penyakit) ? $singleDataTb->nm_penyakit : "" }}'>
                        <select class="get-diagnosa" data-target-text='#icd_x|.confirm_icd_x'
                            data-target-kode='#kd_icd_x|.confirm_kd_icd_x'>
                            <option value='{{ !empty($singleDataTb->nm_penyakit) ? $singleDataTb->nm_penyakit : "" }}'>
                                {{ !empty($singleDataTb->nm_penyakit) ? $singleDataTb->nm_penyakit : "" }}</option>
                        </select>
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 mb-3">
                    <label for="kd_icd_x" class="form-label">Kode ICD <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-duplicate" data-target='.confirm_kd_icd_x'
                        name="kode_icd_x" id="kd_icd_x" required
                        value='{{ !empty($singleDataTb->kode_icd_x) ? $singleDataTb->kode_icd_x : "" }}'>
                </div>
            </div>

            <div class="row justify-content-start align-items-end ">

                <div class="col-lg-6 mb-3">
                    <label for="sebelum_pengobatan_hasil_mikroskopis" class="form-label">Hasil Lab Sebelum Pengobatan  <span class="text-danger">*</span></label>
                    <select class="form-select input-dropdown" aria-label="Default select example"
                        id="sebelum_pengobatan_hasil_mikroskopis" name="sebelum_pengobatan_hasil_mikroskopis" required>
                        <option value=""></option>
                        <option value="neg" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_mikroskopis== 'neg'?'selected':''):''}}>Negatif</option>
                        <option value="1-9" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_mikroskopis== '1-9'?'selected':''):''}}>1-9</option>
                        <option value="1+" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_mikroskopis== '1+'?'selected':''):''}}>1+</option>
                        <option value="2+" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_mikroskopis== '2+'?'selected':''):''}}>2+</option>
                        <option value="3+" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_mikroskopis== '3+'?'selected':''):''}}>3+</option>
                        <option value="Tidak Dilakukan" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_mikroskopis== 'Tidak Dilakukan'?'selected':''):''}}>Tidak Dilakukan</option>
                    </select>
                    
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="kesadaran" class="form-label">Klasifikasi Lokasi Anatomi</label>
                    <select class="form-select input-dropdown" aria-label="Default select example" id="kesadaran"
                        name="klasifikasi_lokasi_anatomi">
                        <option></option>
                        <option value="1" {{ $singleDataTb?($singleDataTb->klasifikasi_lokasi_anatomi== '1'?'selected':''):''}}>Paru</option>
                        <option value="2" {{ $singleDataTb?($singleDataTb->klasifikasi_lokasi_anatomi== '2'?'selected':''):''}}>Ekstraparu</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-start align-items-end ">
                <div class="col-lg-4 mb-3">
                    <label for="kesadaran" class="form-label">Klasifikasi Riwayat Pengobatan</label>
                    <select class="form-select input-dropdown" aria-label="Default select example" id="kesadaran"
                        name="klasifikasi_riwayat_pengobatan">
                        <option value=""></option>
                        <option value="1" {{ $singleDataTb?($singleDataTb->klasifikasi_riwayat_pengobatan== 1?'selected':''):''}}>Baru</option>
                        <option value="2" {{ $singleDataTb?($singleDataTb->klasifikasi_riwayat_pengobatan== 2?'selected':''):''}}>Kambuh</option>
                        <option value="3" {{ $singleDataTb?($singleDataTb->klasifikasi_riwayat_pengobatan== 3?'selected':''):''}}>Diobati setelah gagal kategori 1</option>
                        <option value="4" {{ $singleDataTb?($singleDataTb->klasifikasi_riwayat_pengobatan== 4?'selected':''):''}}>Diobati setelah gagal kategori 2</option>
                        <option value="5" {{ $singleDataTb?($singleDataTb->klasifikasi_riwayat_pengobatan== 5?'selected':''):''}}>Diobati setelah putus berobat</option>
                        <option value="6" {{ $singleDataTb?($singleDataTb->klasifikasi_riwayat_pengobatan== 6?'selected':''):''}}>Diobati setelah gagal pengobatan lini 2</option>
                        <option value="7" {{ $singleDataTb?($singleDataTb->klasifikasi_riwayat_pengobatan== 7?'selected':''):''}}>Pernah diobati tidak diketahui hasilnya</option>
                        <option value="8" {{ $singleDataTb?($singleDataTb->klasifikasi_riwayat_pengobatan== 8?'selected':''):''}}>Tidak diketahui</option>
                        <option value="9" {{ $singleDataTb?($singleDataTb->klasifikasi_riwayat_pengobatan== 9?'selected':''):''}}>Lain-lain</option>

                    </select>
                </div>
                
                <div class="col-lg-4 mb-3">
                    
                    <label for="tipe_diagnosis" class="form-label">Tipe Diagnosis</label>

                    <select class="form-select input-dropdown" aria-label="Default select example" id="kesadaran"
                        name="tipe_diagnosis">
                        <option value=""></option>
                        <option value="1" {{ $singleDataTb?($singleDataTb->tipe_diagnosis== 1?'selected':''):''}} >Terkonfirmasi Bakteriologis</option>
                        <option value="2" {{ $singleDataTb?($singleDataTb->tipe_diagnosis== 2?'selected':''):''}}>Terdiagnosis Klinis</option>
                    </select>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="kesadaran" class="form-label">Sebelum Pengobatan Hasil Tes Cepat</label>

                    <select class="form-select input-dropdown" aria-label="Default select example" id="kesadaran"
                        name="sebelum_pengobatan_hasil_tes_cepat">
                        <option value=""></option>
                        <option value="Neg" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_tes_cepat == 'Neg'?'selected':''):''}}>Neg</option>
                        <option value="Rif Sen" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_tes_cepat == 'Rif Sen'?'selected':''):''}}>Rif Sen</option>
                        <option value="Rif Res" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_tes_cepat == 'Rif Res'?'selected':''):''}}>Rif Res</option>
                        <option value="Rif Indet" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_tes_cepat == 'Rif Indet'?'selected':''):''}}>Rif Indet</option>
                        <option value="INVALID" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_tes_cepat == 'INVALID'?'selected':''):''}}>INVALID</option>
                        <option value="ERROR" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_tes_cepat == 'ERROR'?'selected':''):''}}>ERROR</option>
                        <option value="NO RESULT" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_tes_cepat == 'NO RESULT'?'selected':''):''}}>NO RESULT</option>
                        <option value="Tidak Dilakukan" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_tes_cepat == 'Tidak Dilakukan'?'selected':''):''}}>Tidak Dilakukan</option>
                    </select>
                </div>

            </div>
            <div class="row justify-content-start align-items-end ">
                <div class="col-lg-4 mb-3">
                    <label for="kesadaran" class="form-label">Sebelum Pengobatan Hasil Biakan</label>
                    <select class="form-select input-dropdown" aria-label="Default select example" id="kesadaran"
                        name="sebelum_pengobatan_hasil_biakan">
                        <option value=""></option>
                        <option value="Negatif" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_biakan == 'Negatif'?'selected':''):''}}>Negatif</option>
                        <option value="1-9 BTA" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_biakan == '1-9 BTA'?'selected':''):''}}>1-9 BTA</option>
                        <option value="1+" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_biakan == '1+'?'selected':''):''}}>1+</option>
                        <option value="2+" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_biakan == '2+'?'selected':''):''}}>2+</option>
                        <option value="3+" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_biakan == '3+'?'selected':''):''}}>3+</option>
                        <option value="4+" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_biakan == '4+'?'selected':''):''}}>4+</option>
                        <option value="NTM" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_biakan == 'NTM'?'selected':''):''}}>NTM</option>
                        <option value="Kontaminasi" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_biakan == 'Kontaminasi'?'selected':''):''}}>Kontaminasi</option>
                        <option value="TidakDilakukan" {{ $singleDataTb?($singleDataTb->sebelum_pengobatan_hasil_biakan == 'TidakDilakukan'?'selected':''):''}}>TidakDilakukan</option>

                    </select>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="sebelum_pengobatan_hasil_mikroskopis" class="form-label">Hasil Mikroskopis Bulan
                        2</label>
                    <select class="form-select input-dropdown" aria-label="Default select example"
                        id="sebelum_pengobatan_hasil_mikroskopis" name="hasil_mikroskopis_bulan_2">
                        <option value="" ></option>
                        <option value="neg" {{ $singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_2 == 'neg'?'selected':''):''}}>Negatif</option>
                        <option value="1-9" {{ $singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_2 == '1-9'?'selected':''):''}}>1-9</option>
                        <option value="1+" {{ $singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_2 == '1+'?'selected':''):''}}>1+</option>
                        <option value="2+" {{ $singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_2 == '2+'?'selected':''):''}}>2+</option>
                        <option value="3+" {{ $singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_2 == '3+'?'selected':''):''}}>3+</option>
                        <option value="Tidak Dilakukan" {{ $singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_2 == 'Tidak Dilakukan'?'selected':''):''}}>Tidak Dilakukan</option>
                    </select>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="sebelum_pengobatan_hasil_mikroskopis" class="form-label">Hasil Mikroskopis Bulan
                        3</label>
                    <select class="form-select input-dropdown" aria-label="Default select example"
                        id="sebelum_pengobatan_hasil_mikroskopis" name="hasil_mikroskopis_bulan_3">
                        <option value="" ></option>
                        <option value="neg" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_3 == 'neg'?'selected':''):''}}>Negatif</option>
                        <option value="1-9" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_3 == '1-9'?'selected':''):''}}>1-9</option>
                        <option value="1+" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_3 == '1+'?'selected':''):''}}>1+</option>
                        <option value="2+" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_3 == '2+'?'selected':''):''}}>2+</option>
                        <option value="3+" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_3 == '3+'?'selected':''):''}}>3+</option>
                        <option value="Tidak Dilakukan" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_3 == 'Tidak Dilakukan'?'selected':''):''}}>Tidak Dilakukan</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-start align-items-end ">
                <div class="col-lg-3 mb-3">
                    <label for="sebelum_pengobatan_hasil_mikroskopis" class="form-label">Hasil Mikroskopis Bulan
                        5</label>
                    <select class="form-select input-dropdown" aria-label="Default select example"
                        id="sebelum_pengobatan_hasil_mikroskopis" name="hasil_mikroskopis_bulan_5">
                        <option value=""></option>
                        <option value="neg" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_5 == 'neg'?'selected':''):''}}>Negatif</option>
                        <option value="1-9" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_5 == '1-9'?'selected':''):''}}>1-9</option>
                        <option value="1+" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_5 == '1+'?'selected':''):''}}>1+</option>
                        <option value="2+" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_5 == '2+'?'selected':''):''}}>2+</option>
                        <option value="3+" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_5 == '3+'?'selected':''):''}}>3+</option>
                        <option value="Tidak Dilakukan" {{$singleDataTb?($singleDataTb->hasil_mikroskopis_bulan_5 == 'Tidak Dilakukan'?'selected':''):''}}>Tidak Dilakukan</option>
                    </select>
                </div>
                <div class="col-lg-3 mb-3">
                    <label for="sebelum_pengobatan_hasil_mikroskopis" class="form-label">Akhir Pengobatan Hasil
                        Mikroskopis</label>
                    <select class="form-select input-dropdown" aria-label="Default select example"
                        id="sebelum_pengobatan_hasil_mikroskopis" name="akhir_pengobatan_hasil_mikroskopis">
                        <option value=""></option>
                        <option value="neg" {{$singleDataTb?($singleDataTb->akhir_pengobatan_hasil_mikroskopis == 'neg'?'selected':''):''}}>Negatif</option>
                        <option value="1-9" {{$singleDataTb?($singleDataTb->akhir_pengobatan_hasil_mikroskopis == '1-9'?'selected':''):''}}>1-9</option>
                        <option value="1+" {{$singleDataTb?($singleDataTb->akhir_pengobatan_hasil_mikroskopis == '1+'?'selected':''):''}}>1+</option>
                        <option value="2+" {{$singleDataTb?($singleDataTb->akhir_pengobatan_hasil_mikroskopis == '2+'?'selected':''):''}}>2+</option>
                        <option value="3+" {{$singleDataTb?($singleDataTb->akhir_pengobatan_hasil_mikroskopis == '3+'?'selected':''):''}}>3+</option>
                        <option value="Tidak Dilakukan" {{$singleDataTb?($singleDataTb->akhir_pengobatan_hasil_mikroskopis == 'Tidak Dilakukan'?'selected':''):''}}>Tidak Dilakukan</option>
                    </select>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class='input-date-time-bagan'>
                        <label for="tanggal" class="form-label">Tanggal Hasil Akhir Pengobatan : </label>
                        <input type="date" id="myDate" max="<?= date('Y-m-d'); ?>" class="form-control form-duplicate" value="{{$singleDataTb?$singleDataTb->tanggal_hasil_akhir_pengobatan:''}}" name="tanggal_hasil_akhir_pengobatan" 
                        >
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <label for="sebelum_pengobatan_hasil_mikroskopis" class="form-label">Hasil Akhir Pengobatan</label>
                    <select class="form-select input-dropdown" aria-label="Default select example"
                        id="sebelum_pengobatan_hasil_mikroskopis" name="hasil_akhir_pengobatan">
                        <option value=""></option>
                        <option value="1" {{$singleDataTb?($singleDataTb->hasil_akhir_pengobatan == '1'?'selected':''):''}}>Sembuh</option>
                        <option value="2" {{$singleDataTb?($singleDataTb->hasil_akhir_pengobatan == '2'?'selected':''):''}}>Pengobatan lengkap</option>
                        <option value="3" {{$singleDataTb?($singleDataTb->hasil_akhir_pengobatan == '3'?'selected':''):''}}>Putus berobat</option>
                        <option value="4" {{$singleDataTb?($singleDataTb->hasil_akhir_pengobatan == '4'?'selected':''):''}}>Meninggal</option>
                        <option value="5" {{$singleDataTb?($singleDataTb->hasil_akhir_pengobatan == '5'?'selected':''):''}}>Gagal</option>
                        <option value="6" {{$singleDataTb?($singleDataTb->hasil_akhir_pengobatan == '6'?'selected':''):''}}>Tidak dievaluasi/pindah</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-start align-items-end table-responsive">
                <div class="col-lg-2 mb-3">
                    <div class="d-grid gap-2" >
                        <button class="btn btn-primary" data-confirm-message="Apakah anda yakin menghapus data ini ?" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        <h5 class="fw-bold">Riwayat Tuberculosis</h5>
        @include('cppt.tb.columns_tb')
    </div>
</div>
<div class="d-flex justify-content-end ">
    <a class="btn btn-info collapse-cus" style='color:#fff' data-bs-toggle="collapse" href="#bagan-form-tambah-collapse"
        role="button" aria-expanded="false" aria-controls="bagan-form-tambah-collapse">
        <span id='collapse-open'><i class="fa-solid fa-angles-down"></i> Buka Form Pasien TB</span>
        <span id='collapse-closed'><i class="fa-solid fa-angles-up"></i> Tutup Form Pasien TB</span>
    </a>
</div>

<script>
   function required()
    {
        var empt = document.forms["form1"]["tanggal_hasil_akhir_pengobatan"].value;
        if (empt !== "")
        {
            return confirm("Jika Tanggal Hasil Akhir Pengobatan telah diisi maka data tidak dapat dilakukan pengeditan lagi!!!, apakah anda setuju untuk melanjutkan?");
        }
    }
</script>

