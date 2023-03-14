<div class="row mb-3">

    @include('penilaian.form_header_ranap', [
            "pj_form_type"=>"petugas", 
            "nama_pj" => $penilaian->nama_petugas_1,
            "kode_pj" => $penilaian->nip1, 
            "nama_pj_2" => $penilaian->nama_petugas_2,
            "kode_pj_2" => $penilaian->nip2, 
            "nama_dpjp" => $penilaian->nama_dpjp,
            "kode_dpjp" => $penilaian->kd_dokter, 
            "readonly" => true
        ])
    <div class="col-3 mb-2">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input readonly type="text" class="form-control input-daterange input-date-time" name="tanggal" value="{{!empty($penilaian->tanggal) ? $penilaian->tanggal : ''}}"  id="tanggal"  required autocomplete="off" >
    </div>
    <div class="col-3 mb-2">
        <label for="tiba" class="form-label">Macam Kasus : </label>
        <select disabled class="form-select" id="kasus_trauma" name="kasus_trauma" aria-label="Default select " >
            @foreach (['Trauma', 'Non Trauma'] as $item)
                <option  {{!empty($penilaian->kasus_trauma) ? ($penilaian->kasus_trauma === $item ? 'selected' : '') : ''}} value="{{$item}}" >{{$item}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3 mb-2">
        <label for="informasi" class="form-label">Informasi didapat dari : </label>
        <select disabled class="form-select" id="informasi" name="informasi" aria-label="Default select " >
            
            @foreach (['Autoanamnessi', 'Alloanamnesis'] as $item)
                <option {{!empty($penilaian->informasi) ? ($penilaian->informasi === $item ? 'selected' : '') : ''}}  value="{{$item}}" >{{$item}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3 mb-2">
        <label for="tiba" class="form-label">Tiba di Ruang Rawat : </label>
        <select disabled class="form-select" id="tiba_diruang_rawat" name="tiba_diruang_rawat" aria-label="Default select " >
            
            @foreach (['Jalan Tanpa Bantuan', 'Kursi Roda', 'Brankar'] as $item)
                <option {{!empty($penilaian->tiba_diruang_rawat) ? ($penilaian->tiba_diruang_rawat === $item ? 'selected' : '') : ''}} value="{{$item}}" >{{$item}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3 mb-2">
        <label for="informasi" class="form-label">Cara Masuk : </label>
        <select disabled class="form-select" id="cara_masuk" name="cara_masuk" aria-label="Default select " >
            
            @foreach (['Poli', 'IGD', 'Lain-lain'] as $item)
                <option {{!empty($penilaian->cara_masuk) ? ($penilaian->cara_masuk === $item ? 'selected' : '') : ''}} value="{{$item}}" >{{$item}}</option>
            @endforeach
        </select>
    </div>
</div>


<hr class="mb-5">

<div>
    <h5 class="text-start">I. RIWAYAT KESEHATAN</h5>
    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="rps" class="form-label">Riwayat Penyakit Sekarang</label>
            <textarea readonly class="form-control" id="rps" name="rps" rows="3">{{!empty($penilaian->rps) ? $penilaian->rps : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpk" class="form-label">Riwayat Penyakit Keluarga</label>
            <textarea readonly class="form-control" id="rpk" name="rpk" rows="3">{{!empty($penilaian->rpk) ? $penilaian->rpk : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpd" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea readonly class="form-control" id="rpd" name="rpd" rows="3">{{!empty($penilaian->rpd) ? $penilaian->rpd : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpo" class="form-label">Riwayat Penggunaan Obat</label>
            <textarea readonly class="form-control" id="rpo" name="rpo" rows="3">{{!empty($penilaian->rpo) ? $penilaian->rpo : ''}}</textarea>
        </div>
        <div class="col-6 mb-2 ">
            <label for="riwayat_pembedahan" class="form-label">Riwayat Pembedahan</label>
            <input readonly type="text" class="form-control" name="riwayat_pembedahan" value="{{!empty($penilaian->riwayat_pembedahan) ? $penilaian->riwayat_pembedahan : ''}}"  id='riwayat_pembedahan' value="">
        </div>
        <div class="col-6 mb-2 ">
            <label for="riwayat_dirawat_dirs" class="form-label">Riwayat Dirawat RS</label>
            <input readonly type="text" class="form-control" name="riwayat_dirawat_dirs" value="{{!empty($penilaian->riwayat_dirawat_dirs) ? $penilaian->riwayat_dirawat_dirs : ''}}"  id='riwayat_dirawat_dirs' value="">
        </div>
        <div class="col-6 mb-2">
            <label for="alat_bantu_dipakai" class="form-label">Alat Bantu Yang Dipakai : </label>
            <select disabled class="form-select" id="alat_bantu_dipakai" name="alat_bantu_dipakai" aria-label="Default select ">
                @foreach (['Kacamata', 'Prothesa', 'Alat Bantu Dengar', 'Lain-lain'] as $item)
                   <option  {{!empty($penilaian->alat_bantu_dipakai) ? ($penilaian->alat_bantu_dipakai === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                @endforeach
            </select>
        </div>
        <div class="col mb-2">
            <label for="riwayat_kehamilan" class="form-label">Apakah Dalam Keadaan Hamil/ Sedang Menyusui</label>
            <div class="d-flex">
                <select disabled class="form-select w-25" id="riwayat_kehamilan"  name="riwayat_kehamilan" aria-label="Default select example">
                    @foreach (['Tidak', 'Ya'] as $item)
                        <option   {{!empty($penilaian->riwayat_kehamilan) ? ($penilaian->riwayat_kehamilan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select>
                <input readonly type="text" class="form-control w-75" name="riwayat_kehamilan_perkiraan" value="{{!empty($penilaian->riwayat_kehamilan_perkiraan) ? $penilaian->riwayat_kehamilan_perkiraan : ''}}"  id='riwayat_kehamilan_perkiraan' value="">
            </div>
            
        </div>
        <div class="col-6 mb-2 ">
            <label for="riwayat_tranfusi" class="form-label">Riwayat Transfusi Darah</label>
            <input readonly type="text" class="form-control" name="riwayat_tranfusi" value="{{!empty($penilaian->riwayat_tranfusi) ? $penilaian->riwayat_tranfusi : ''}}"  id='riwayat_transfusi' value="">
        </div>
        <div class="col-6 mb-2 ">
            <label for="riwayat_alergi" class="form-label">Riwayat Alergi</label>
            <input readonly type="text" class="form-control" name="riwayat_alergi" value="{{!empty($penilaian->riwayat_alergi) ? $penilaian->riwayat_alergi : ''}}"  id='riwayat_alergi' value="">
        </div>
        <label class="form-label">Riwayat Kebiasaan</label>
        <div class="ms-2 row">
            <div class="col-6 mb-2">
                <label for="riwayat_merokok" class="form-label">Merokok : </label>
                <div class="d-flex">
                    <select disabled class="form-select me-2" id="riwayat_merokok"  name="riwayat_merokok" aria-label="Default select example">
                        
                        @foreach (['Tidak', 'Ya'] as $item)
                            <option {{!empty($penilaian->riwayat_merokok) ? ($penilaian->riwayat_merokok === $item ? 'selected' : '') : ''}}  value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                    <div class="input-group  me-2">
                        <input readonly  type="text" id="riwayat_merokok_jumlah" name="riwayat_merokok_jumlah" value="{{!empty($penilaian->riwayat_merokok_jumlah) ? $penilaian->riwayat_merokok_jumlah : ''}}"    class="form-control">
                        <span class="input-group-text">batang/hari</span>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_alkohol" class="form-label">Alkohol : </label>
                <div class="d-flex">
                    <select disabled class="form-select me-2" id="riwayat_alkohol"  name="riwayat_alkohol" aria-label="Default select example">
                        
                        @foreach (['Tidak', 'Ya'] as $item)
                            <option {{!empty($penilaian->riwayat_alkohol) ? ($penilaian->riwayat_alkohol === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                    <div class="input-group  me-2">
                        <input readonly  type="text" id="riwayat_alkohol_jumlah" name="riwayat_alkohol_jumlah" value="{{!empty($penilaian->riwayat_alkohol_jumlah) ? $penilaian->riwayat_alkohol_jumlah : ''}}"    class="form-control">
                        <span class="input-group-text">gelas/hari</span>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_narkoba" class="form-label">Riwayat Obat Tidur : </label>
                <div class="d-flex">
                    <select disabled class="form-select me-2" id="riwayat_narkoba"  name="riwayat_narkoba" aria-label="Default select example">
                        
                        @foreach (['Tidak', 'Ya'] as $item)
                            <option {{!empty($penilaian->riwayat_narkoba) ? ($penilaian->riwayat_narkoba === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_olahraga" class="form-label">Riwayat Obat Tidur : </label>
                <div class="d-flex">
                    <select disabled class="form-select me-2" id="riwayat_olahraga"  name="riwayat_olahraga" aria-label="Default select example">
                        
                        @foreach (['Tidak', 'Ya'] as $item)
                            <option {{!empty($penilaian->riwayat_olahraga) ? ($penilaian->riwayat_olahraga === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                </div>
            </div>
        </div>
        
    </div>
</div>


<hr class="mb-5">

<div>
    <h5 class="text-start">II. PEMERIKSAAN FISIK</h5>
    <div class="row align-items-end">
        <div class="col-3 mb-2">
            <label for="pemeriksaan_mental" class="form-label">Pemeriksaan Mental : </label>
            <input readonly type="text" name="pemeriksaan_mental" value="{{!empty($penilaian->pemeriksaan_mental) ? $penilaian->pemeriksaan_mental : ''}}"  id="pemeriksaan_mental" class="form-control">
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_keadaan_umum" class="form-label">keadaan Umum : </label>
            <select disabled class="form-select" id="pemeriksaan_keadaan_umum" name="pemeriksaan_keadaan_umum" aria-label="Default select ">
                
                @foreach (['Baik', 'Sedang', 'Buruk'] as $item)
                   <option {{!empty($penilaian->pemeriksaan_keadaan_umum) ? ($penilaian->pemeriksaan_keadaan_umum === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                @endforeach
            </select>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_td" class="form-label">TD : </label>
            <div class="input-group">
                <input readonly type="text" name="pemeriksaan_td" value="{{!empty($penilaian->pemeriksaan_td) ? $penilaian->pemeriksaan_td : ''}}"  id="pemeriksaan_td" class="form-control">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input readonly type="text" id="pemeriksaan_nadi" name="pemeriksaan_nadi" value="{{!empty($penilaian->pemeriksaan_nadi) ? $penilaian->pemeriksaan_nadi : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_rr" class="form-label">rr : </label>
            <div class="input-group">
                <input readonly type="text" id="pemeriksaan_rr" name="pemeriksaan_rr" value="{{!empty($penilaian->pemeriksaan_rr) ? $penilaian->pemeriksaan_rr : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input readonly type="text" id="pemeriksaan_suhu" name="pemeriksaan_suhu" value="{{!empty($penilaian->pemeriksaan_suhu) ? $penilaian->pemeriksaan_suhu : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>

        <div class="col-3 mb-2">
            <label for="pemeriksaan_gcs" class="form-label">GCS(E, V, M) : </label>
            <div class="input-group">
                <input readonly type="text" id="pemeriksaan_gcs" name="pemeriksaan_gcs" value="{{!empty($penilaian->pemeriksaan_gcs) ? $penilaian->pemeriksaan_gcs : ''}}"  class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_bb" class="form-label">BB : </label>
            <div class="input-group">
                <input readonly type="text" id="pemeriksaan_bb" name="pemeriksaan_bb" value="{{!empty($penilaian->pemeriksaan_bb) ? $penilaian->pemeriksaan_bb : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">Kg</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_tb" class="form-label">TB : </label>
            <div class="input-group">
                <input readonly type="text" id="pemeriksaan_tb" name="pemeriksaan_tb" value="{{!empty($penilaian->pemeriksaan_tb) ? $penilaian->pemeriksaan_tb : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_spo" class="form-label">SpO2 : </label>
            <div class="input-group">
                <input readonly type="text" id="pemeriksaan_spo" name="pemeriksaan_spo" value="{{!empty($penilaian->pemeriksaan_spo) ? $penilaian->pemeriksaan_spo : ''}}"  class="form-control">
                <span class="input-group-text" id="ModalPetugas">%</span>
            </div>
        </div>
    </div>
    <label class="form-label">Sistem Susunan Saraf Pusat : </label>
    <div class="ms-2 row">
        <div class="col-6 mb-2">
            <label for="pemeriksaan_susunan_kepala" class="form-label">Kepala : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_susunan_kepala"  name="pemeriksaan_susunan_kepala" aria-label="Default select example">
                    
                    @foreach (['TAK','Hydrocephalus','Hematoma','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_susunan_kepala) ? ($penilaian->pemeriksaan_susunan_kepala === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_susunan_kepala_keterangan" name="pemeriksaan_susunan_kepala_keterangan" value="{{!empty($penilaian->pemeriksaan_susunan_kepala_keterangan) ? $penilaian->pemeriksaan_susunan_kepala_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_susunan_wajah" class="form-label">Wajah : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_susunan_wajah"  name="pemeriksaan_susunan_wajah" aria-label="Default select example">
                    
                    @foreach (['TAK','Asimetris','Kelainan Kongenital'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_susunan_wajah) ? ($penilaian->pemeriksaan_susunan_wajah === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_susunan_wajah_keterangan" name="pemeriksaan_susunan_wajah_keterangan" value="{{!empty($penilaian->pemeriksaan_susunan_wajah_keterangan) ? $penilaian->pemeriksaan_susunan_wajah_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_susunan_leher" class="form-label">Leher : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_susunan_leher"  name="pemeriksaan_susunan_leher" aria-label="Default select example">
                    
                    @foreach (['TAK','Kaku Kuduk','Pembesaran Thyroid','Pembesaran KGB'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_susunan_leher) ? ($penilaian->pemeriksaan_susunan_leher === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_susunan_kejang" class="form-label">Kejang : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_susunan_kejang"  name="pemeriksaan_susunan_kejang" aria-label="Default select example">
                    
                    @foreach (['TAK','Kuat','Ada'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_susunan_kejang) ? ($penilaian->pemeriksaan_susunan_kejang === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_susunan_kejang_keterangan" name="pemeriksaan_susunan_kejang_keterangan" value="{{!empty($penilaian->pemeriksaan_susunan_kejang_keterangan) ? $penilaian->pemeriksaan_susunan_kejang_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_susunan_sensorik" class="form-label">Sensorik : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_susunan_sensorik"  name="pemeriksaan_susunan_sensorik" aria-label="Default select example">
                    
                    @foreach (['TAK','Sakit Nyeri','Rasa kebas'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_susunan_sensorik) ? ($penilaian->pemeriksaan_susunan_sensorik === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        
    </div>
    <label class="form-label">KardioVaskuler : </label>
    <div class="ms-2 row">
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kardiovaskuler_pulsasi" class="form-label">Pulsasi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_kardiovaskuler_pulsasi"  name="pemeriksaan_kardiovaskuler_pulsasi" aria-label="Default select example">
                    
                    @foreach (['Kuat', "Lemah", 'Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_kardiovaskuler_pulsasi) ? ($penilaian->pemeriksaan_kardiovaskuler_pulsasi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_kardiovaskuler_sirkulasi" class="form-label">Sirkulasi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_kardiovaskuler_sirkulasi"  name="pemeriksaan_kardiovaskuler_sirkulasi" aria-label="Default select example">
                    
                    @foreach (['Akral Hangat','Akral Dingin','Edema'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_kardiovaskuler_sirkulasi) ? ($penilaian->pemeriksaan_kardiovaskuler_sirkulasi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_kardiovaskuler_sirkulasi_keterangan" name="pemeriksaan_kardiovaskuler_sirkulasi_keterangan" value="{{!empty($penilaian->pemeriksaan_kardiovaskuler_sirkulasi_keterangan) ? $penilaian->pemeriksaan_kardiovaskuler_sirkulasi_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kardiovaskuler_denyut_nadi" class="form-label">Denyu Nadi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_kardiovaskuler_denyut_nadi"  name="pemeriksaan_kardiovaskuler_denyut_nadi" aria-label="Default select example">
                    
                    @foreach (['Teratur','Tidak Teratur'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_kardiovaskuler_denyut_nadi) ? ($penilaian->pemeriksaan_kardiovaskuler_denyut_nadi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
    </div>

    <label class="form-label">Respirasi : </label>
    <div class="ms-2 row">
        <div class="col-3 mb-2">
            <label for="pemeriksaan_respirasi_retraksi" class="form-label">Retraksi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_respirasi_retraksi"  name="pemeriksaan_respirasi_retraksi" aria-label="Default select example">
                    
                    @foreach (['Tidak Ada','Ringan','Berat'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_respirasi_retraksi) ? ($penilaian->pemeriksaan_respirasi_retraksi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_respirasi_pola_nafas" class="form-label">Pola Nafas : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_respirasi_pola_nafas"  name="pemeriksaan_respirasi_pola_nafas" aria-label="Default select example">
                    
                    @foreach (['Normal','Bradipnea','Tachipnea'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_respirasi_pola_nafas) ? ($penilaian->pemeriksaan_respirasi_pola_nafas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_respirasi_suara_nafas" class="form-label">Suara Nafas  : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_respirasi_suara_nafas"  name="pemeriksaan_respirasi_suara_nafas" aria-label="Default select example">
                    
                    @foreach(['Vesikuler','Wheezing','Rhonki'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_respirasi_suara_nafas) ? ($penilaian->pemeriksaan_respirasi_suara_nafas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_respirasi_batuk" class="form-label">Batuk & Sekresi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_respirasi_batuk"  name="pemeriksaan_respirasi_batuk" aria-label="Default select example">
                    
                    @foreach(['Tidak','Ya : Produktif','Ya : Non Produktif'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_respirasi_batuk) ? ($penilaian->pemeriksaan_respirasi_batuk === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_respirasi_volume_pernafasan" class="form-label">Volume : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_respirasi_volume_pernafasan"  name="pemeriksaan_respirasi_volume_pernafasan" aria-label="Default select example">
                    
                    @foreach(['Normal','Hiperventilasi','Hipoventilasi'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_respirasi_volume_pernafasan) ? ($penilaian->pemeriksaan_respirasi_volume_pernafasan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_kardiovaskuler_sirkulasi" class="form-label">Jenis Pernafasan : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_kardiovaskuler_sirkulasi"  name="pemeriksaan_kardiovaskuler_sirkulasi" aria-label="Default select example">
                    
                    @foreach(['Pernafasan Dada','Alat Bantu Pernafasaan'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_kardiovaskuler_sirkulasi) ? ($penilaian->pemeriksaan_kardiovaskuler_sirkulasi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_kardiovaskuler_sirkulasi_keterangan" name="pemeriksaan_kardiovaskuler_sirkulasi_keterangan" value="{{!empty($penilaian->pemeriksaan_kardiovaskuler_sirkulasi_keterangan) ? $penilaian->pemeriksaan_kardiovaskuler_sirkulasi_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_respirasi_irama_nafas" class="form-label">Irama : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_respirasi_irama_nafas"  name="pemeriksaan_respirasi_irama_nafas" aria-label="Default select example">
                    
                    @foreach(['Teratur','Tidak Teratur'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_respirasi_irama_nafas) ? ($penilaian->pemeriksaan_respirasi_irama_nafas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
    </div>
    
    <label class="form-label">Gastrointestinal : </label>
    <div class="ms-2 row">
        <div class="col-6 mb-2">
            <label for="pemeriksaan_gastrointestinal_mulut" class="form-label">Mulut : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_gastrointestinal_mulut"  name="pemeriksaan_gastrointestinal_mulut" aria-label="Default select example">
                    
                    @foreach(['TAK','Stomatitis','Mukosa Kering','Bibir Pucat','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_gastrointestinal_mulut) ? ($penilaian->pemeriksaan_gastrointestinal_mulut === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_gastrointestinal_mulut_keterangan" name="pemeriksaan_gastrointestinal_mulut_keterangan" value="{{!empty($penilaian->pemeriksaan_gastrointestinal_mulut_keterangan) ? $penilaian->pemeriksaan_gastrointestinal_mulut_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_gastrointestinal_tenggorokan" class="form-label">Tenggorokan : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_gastrointestinal_tenggorokan"  name="pemeriksaan_gastrointestinal_tenggorokan" aria-label="Default select example">
                    
                    @foreach(['TAK','Gangguan Menelan','Sakit Menelan','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_gastrointestinal_tenggorokan) ? ($penilaian->pemeriksaan_gastrointestinal_tenggorokan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_gastrointestinal_tenggorokan_keterangan" name="pemeriksaan_gastrointestinal_tenggorokan_keterangan" value="{{!empty($penilaian->pemeriksaan_gastrointestinal_tenggorokan_keterangan) ? $penilaian->pemeriksaan_gastrointestinal_tenggorokan_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_gastrointestinal_lidah" class="form-label">Lidah : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_gastrointestinal_lidah"  name="pemeriksaan_gastrointestinal_lidah" aria-label="Default select example">
                    
                    @foreach(['TAK','Kotor','Gerak Asimetris','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_gastrointestinal_lidah) ? ($penilaian->pemeriksaan_gastrointestinal_lidah === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_gastrointestinal_lidah_keterangan" name="pemeriksaan_gastrointestinal_lidah_keterangan" value="{{!empty($penilaian->pemeriksaan_gastrointestinal_lidah_keterangan) ? $penilaian->pemeriksaan_gastrointestinal_lidah_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_gastrointestinal_abdomen" class="form-label">Abdomen : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_gastrointestinal_abdomen"  name="pemeriksaan_gastrointestinal_abdomen" aria-label="Default select example">
                    
                    @foreach(['Supel','Asictes',' Tegang','Nyeri Tekan/Lepas','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_gastrointestinal_abdomen) ? ($penilaian->pemeriksaan_gastrointestinal_abdomen === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_gastrointestinal_abdomen_keterangan" name="pemeriksaan_gastrointestinal_abdomen_keterangan" value="{{!empty($penilaian->pemeriksaan_gastrointestinal_abdomen_keterangan) ? $penilaian->pemeriksaan_gastrointestinal_abdomen_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_gastrointestinal_gigi" class="form-label">Gigi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_gastrointestinal_gigi"  name="pemeriksaan_gastrointestinal_gigi" aria-label="Default select example">
                    
                    @foreach(['TAK','Karies','Goyang','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_gastrointestinal_gigi) ? ($penilaian->pemeriksaan_gastrointestinal_gigi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_gastrointestinal_gigi_keterangan" name="pemeriksaan_gastrointestinal_gigi_keterangan" value="{{!empty($penilaian->pemeriksaan_gastrointestinal_gigi_keterangan) ? $penilaian->pemeriksaan_gastrointestinal_gigi_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_gastrointestinal_peistatik_usus" class="form-label">Peistatik Usus : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_gastrointestinal_peistatik_usus"  name="pemeriksaan_gastrointestinal_peistatik_usus" aria-label="Default select example">
                    
                    @foreach(['TAK','Tidak Ada Bising Usus','Hiperistaltik'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_gastrointestinal_peistatik_usus) ? ($penilaian->pemeriksaan_gastrointestinal_peistatik_usus === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_gastrointestinal_anus" class="form-label">Anus : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_gastrointestinal_anus"  name="pemeriksaan_gastrointestinal_anus" aria-label="Default select example">
                    
                    @foreach(['TAK','Atresia Ani'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_gastrointestinal_anus) ? ($penilaian->pemeriksaan_gastrointestinal_anus === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
    </div>
    <label class="form-label">Neurologi : </label>
    <div class="ms-2 row">
        <div class="col-3 mb-2">
            <label for="pemeriksaan_neurologi_sensorik" class="form-label">Sensorik : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_neurologi_sensorik"  name="pemeriksaan_neurologi_sensorik" aria-label="Default select example">
                    
                    @foreach(['TAK','Sakit Nyeri','Rasa Kebas','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_neurologi_sensorik) ? ($penilaian->pemeriksaan_neurologi_sensorik === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_neurologi_pengelihatan" class="form-label">Penglihatan : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_neurologi_pengelihatan"  name="pemeriksaan_neurologi_pengelihatan" aria-label="Default select example">
                    
                    @foreach(['TAK','Ada Kelainan'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_neurologi_pengelihatan) ? ($penilaian->pemeriksaan_neurologi_pengelihatan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_neurologi_pengelihatan_keterangan" name="pemeriksaan_neurologi_pengelihatan_keterangan" value="{{!empty($penilaian->pemeriksaan_neurologi_pengelihatan_keterangan) ? $penilaian->pemeriksaan_neurologi_pengelihatan_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_neurologi_alat_bantu_penglihatan" class="form-label">Alat Bantu Penglihatan : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_neurologi_alat_bantu_penglihatan"  name="pemeriksaan_neurologi_alat_bantu_penglihatan" aria-label="Default select example">
                    
                    @foreach(['Tidak','Kacamata','Lensa Kontak'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_neurologi_alat_bantu_penglihatan) ? ($penilaian->pemeriksaan_neurologi_alat_bantu_penglihatan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_neurologi_motorik" class="form-label">motorik : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_neurologi_motorik"  name="pemeriksaan_neurologi_motorik" aria-label="Default select example">
                    
                    @foreach(['TAK','Hemiparese','Tetraparese','Tremor','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_neurologi_motorik) ? ($penilaian->pemeriksaan_neurologi_motorik === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_neurologi_pendengaran" class="form-label">Pendengaran : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_neurologi_pendengaran"  name="pemeriksaan_neurologi_pendengaran" aria-label="Default select example">
                    
                    @foreach(['TAK','Berdengung','Nyeri','Tuli','Keluar Cairan','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_neurologi_pendengaran) ? ($penilaian->pemeriksaan_neurologi_pendengaran === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_neurologi_bicara" class="form-label">Bicara : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_neurologi_bicara"  name="pemeriksaan_neurologi_bicara" aria-label="Default select example">
                    
                    @foreach(['Jelas','Tidak Jelas'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_neurologi_bicara) ? ($penilaian->pemeriksaan_neurologi_bicara === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_neurologi_bicara_keterangan" name="pemeriksaan_neurologi_bicara_keterangan" value="{{!empty($penilaian->pemeriksaan_neurologi_bicara_keterangan) ? $penilaian->pemeriksaan_neurologi_bicara_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_neurologi_kekuatan_otot" class="form-label">Otot : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_neurologi_kekuatan_otot"  name="pemeriksaan_neurologi_kekuatan_otot" aria-label="Default select example">
                    
                    @foreach(['Kuat','Lemah'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_neurologi_kekuatan_otot) ? ($penilaian->pemeriksaan_neurologi_kekuatan_otot === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
    </div>
    
    <label class="form-label">Integumen</label>
    <div class="ms-2 row">
        <div class="col-3 mb-2">
            <label for="pemeriksaan_integument_kulit" class="form-label">Kulit : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_integument_kulit"  name="pemeriksaan_integument_kulit" aria-label="Default select example">
                    
                    @foreach(['Normal','Rash/Kemerahan','Luka','Memar','Ptekie','Bula'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_integument_kulit) ? ($penilaian->pemeriksaan_integument_kulit === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_integument_warnakulit" class="form-label">Warna Kulit : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_integument_warnakulit"  name="pemeriksaan_integument_warnakulit" aria-label="Default select example">
                    
                    @foreach(['Pucat','Sianosis','Normal','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_integument_warnakulit) ? ($penilaian->pemeriksaan_integument_warnakulit === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_integument_turgor" class="form-label">Turgor : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_integument_turgor"  name="pemeriksaan_integument_turgor" aria-label="Default select example">
                    
                    @foreach(['Baik','Sedang','Buruk'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_integument_turgor) ? ($penilaian->pemeriksaan_integument_turgor === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_integument_dekubitas" class="form-label">Resiko Decubi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_integument_dekubitas"  name="pemeriksaan_integument_dekubitas" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada','Usia > 65 tahun','Obesitas','Imobilisasi','Paraplegi/Vegetative State','Dirawat Di HCU','Penyakit Kronis (DM, CHF, CKD)','Inkontinentia Uri/Alvi'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_integument_dekubitas) ? ($penilaian->pemeriksaan_integument_dekubitas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
    </div>

    <label for="" class="form-label">muskuloskletal</label>
    <div class="ms-2 row">
        <div class="col-6 mb-2">
            <label for="pemeriksaan_muskuloskletal_oedema" class="form-label">Oedema : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_muskuloskletal_oedema"  name="pemeriksaan_muskuloskletal_oedema" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada','Ada'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_muskuloskletal_oedema) ? ($penilaian->pemeriksaan_muskuloskletal_oedema === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_muskuloskletal_oedema_keterangan" name="pemeriksaan_muskuloskletal_oedema_keterangan" value="{{!empty($penilaian->pemeriksaan_muskuloskletal_oedema_keterangan) ? $penilaian->pemeriksaan_muskuloskletal_oedema_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_muskuloskletal_pergerakan_sendi" class="form-label">Pregerakan Sendi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_muskuloskletal_pergerakan_sendi"  name="pemeriksaan_muskuloskletal_pergerakan_sendi" aria-label="Default select example">
                    
                    @foreach(['Bebas','Terbatas'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_muskuloskletal_pergerakan_sendi) ? ($penilaian->pemeriksaan_muskuloskletal_pergerakan_sendi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_muskuloskletal_kekauatan_otot" class="form-label">Kekuatan Otot : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_muskuloskletal_kekauatan_otot"  name="pemeriksaan_muskuloskletal_kekauatan_otot" aria-label="Default select example">
                    
                    @foreach(['Baik','Lemah','Tremor'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_muskuloskletal_kekauatan_otot) ? ($penilaian->pemeriksaan_muskuloskletal_kekauatan_otot === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_muskuloskletal_fraktur" class="form-label">Fraktur : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_muskuloskletal_fraktur"  name="pemeriksaan_muskuloskletal_fraktur" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada','Ada'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_muskuloskletal_fraktur) ? ($penilaian->pemeriksaan_muskuloskletal_fraktur === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_muskuloskletal_fraktur_keterangan" name="pemeriksaan_muskuloskletal_fraktur_keterangan" value="{{!empty($penilaian->pemeriksaan_muskuloskletal_fraktur_keterangan) ? $penilaian->pemeriksaan_muskuloskletal_fraktur_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_muskuloskletal_nyeri_sendi" class="form-label">Nyeri Sendi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pemeriksaan_muskuloskletal_nyeri_sendi"  name="pemeriksaan_muskuloskletal_nyeri_sendi" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada','Ada'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_muskuloskletal_nyeri_sendi) ? ($penilaian->pemeriksaan_muskuloskletal_nyeri_sendi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="keterangan" type="text" id="pemeriksaan_muskuloskletal_nyeri_sendi_keterangan" name="pemeriksaan_muskuloskletal_nyeri_sendi_keterangan" value="{{!empty($penilaian->pemeriksaan_muskuloskletal_nyeri_sendi_keterangan) ? $penilaian->pemeriksaan_muskuloskletal_nyeri_sendi_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        
        
    </div>

    <label for="" class="form-label">Eliminasi</label>
    <div class="ms-2 row">
        <div class="col-12 mb-2">
            <label for="" class="form-label">BAB</label>
            <div class="ms-2 row">
                <div class="col-4 mb-2">
                    <label for="pemeriksaan_eliminasi_bab" class="form-label"> Frekuensi : </label>
                    <div class="d-flex align-items-center">
                        <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_eliminasi_bab_jumlah" name="pemeriksaan_eliminasi_bab_jumlah" value="{{!empty($penilaian->pemeriksaan_eliminasi_bab_jumlah) ? $penilaian->pemeriksaan_eliminasi_bab_jumlah : ''}}"    class="form-control">
                        <span class="mx-2">X/</span>
                        <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_eliminasi_bab_durasi" name="pemeriksaan_eliminasi_bab_durasi" value="{{!empty($penilaian->pemeriksaan_eliminasi_bab_durasi) ? $penilaian->pemeriksaan_eliminasi_bab_durasi : ''}}"    class="form-control">
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <label for="pemeriksaan_eliminasi_bab_" class="form-label"> Konsistensi : </label>
                    <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_eliminasi_bab_konsistensi" name="pemeriksaan_eliminasi_bab_konsistensi" value="{{!empty($penilaian->pemeriksaan_eliminasi_bab_konsistensi) ? $penilaian->pemeriksaan_eliminasi_bab_konsistensi : ''}}"    class="form-control">
                </div>
                <div class="col-4 mb-2">
                    <label for="pemeriksaan_eliminasi_bab_" class="form-label"> Warna : </label>
                    <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_eliminasi_bab_warna" name="pemeriksaan_eliminasi_bab_warna" value="{{!empty($penilaian->pemeriksaan_eliminasi_bab_warna) ? $penilaian->pemeriksaan_eliminasi_bab_warna : ''}}"    class="form-control">
                </div>
            </div>
        </div>
        <div class="col-12 mb-2">
            <label for="" class="form-label">BAK</label>
            <div class="ms-2 row">
                <div class="col-4 mb-2">
                    <label for="pemeriksaan_eliminasi_bak" class="form-label"> Frekuensi : </label>
                    <div class="d-flex align-items-center">
                        <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_eliminasi_bak_jumlah" name="pemeriksaan_eliminasi_bak_jumlah" value="{{!empty($penilaian->pemeriksaan_eliminasi_bak_jumlah) ? $penilaian->pemeriksaan_eliminasi_bak_jumlah : ''}}"    class="form-control">
                        <span class="mx-2">X/</span>
                        <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_eliminasi_bak_durasi" name="pemeriksaan_eliminasi_bak_durasi" value="{{!empty($penilaian->pemeriksaan_eliminasi_bak_durasi) ? $penilaian->pemeriksaan_eliminasi_bak_durasi : ''}}"    class="form-control">
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <label for="pemeriksaan_eliminasi_bak_" class="form-label"> Warna : </label>
                    <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_eliminasi_bak_warna" name="pemeriksaan_eliminasi_bak_warna" value="{{!empty($penilaian->pemeriksaan_eliminasi_bak_warna) ? $penilaian->pemeriksaan_eliminasi_bak_warna : ''}}"    class="form-control">
                </div>
                <div class="col-4 mb-2">
                    <label for="pemeriksaan_eliminasi_bak_" class="form-label"> Lain-lain : </label>
                    <input readonly  placeholder="Keterangan" type="text" id="pemeriksaan_eliminasi_bak_lainlain" name="pemeriksaan_eliminasi_bak_lainlain" value="{{!empty($penilaian->pemeriksaan_eliminasi_bak_lainlain) ? $penilaian->pemeriksaan_eliminasi_bak_lainlain : ''}}"    class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">III. POLA KEHIDUPAN SEHAR-HARI</h5>

    <label for="" class="form-label">a. Pola Aktifitas</label>
    <div class="ms-2 row">
        <div class="col-4 mb-2">
            <label for="pola_aktifitas_mandi" class="form-label">Mandi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pola_aktifitas_mandi"  name="pola_aktifitas_mandi" aria-label="Default select example">
                    
                    @foreach(['Mandiri','Bantuan Orang Lain'] as $item)
                       <option {{!empty($penilaian->pola_aktifitas_mandi) ? ($penilaian->pola_aktifitas_mandi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pola_aktifitas_makanminum" class="form-label">Makan/Minum : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pola_aktifitas_makanminum"  name="pola_aktifitas_makanminum" aria-label="Default select example">
                    
                    @foreach(['Mandiri','Bantuan Orang Lain'] as $item)
                       <option {{!empty($penilaian->pola_aktifitas_makanminum) ? ($penilaian->pola_aktifitas_makanminum === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pola_aktifitas_berpakaian" class="form-label">Berpakaian : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pola_aktifitas_berpakaian"  name="pola_aktifitas_berpakaian" aria-label="Default select example">
                    
                    @foreach(['Mandiri','Bantuan Orang Lain'] as $item)
                       <option {{!empty($penilaian->pola_aktifitas_berpakaian) ? ($penilaian->pola_aktifitas_berpakaian === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pola_aktifitas_eliminasi" class="form-label">Eliminasi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pola_aktifitas_eliminasi"  name="pola_aktifitas_eliminasi" aria-label="Default select example">
                    
                    @foreach(['Mandiri','Bantuan Orang Lain'] as $item)
                       <option {{!empty($penilaian->pola_aktifitas_eliminasi) ? ($penilaian->pola_aktifitas_eliminasi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pola_aktifitas_berpindah" class="form-label">Berpindah : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pola_aktifitas_berpindah"  name="pola_aktifitas_berpindah" aria-label="Default select example">
                    
                    @foreach(['Mandiri','Bantuan Orang Lain'] as $item)
                       <option {{!empty($penilaian->pola_aktifitas_berpindah) ? ($penilaian->pola_aktifitas_berpindah === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
    </div>

    <label for="" class="form-label">b. Pola Nutrisi</label>
    <div class="ms-2 row">
       <div class="col-3">
            <label for="pola_nutrisi_makan" class="form-label">Porsi Makan</label>
            <div class="input-group  me-2">
                <input readonly  type="text" id="pola_nutrisi_makan" name="pola_nutrisi_makan" value="{{!empty($penilaian->pola_nutrisi_makan) ? $penilaian->pola_nutrisi_makan : ''}}"    class="form-control">
                <span class="input-group-text">porsi</span>
            </div>
        </div> 
       <div class="col-3">
            <label for="pola_nutrisi_frekuensi_makan" class="form-label">Frekuensi Makan</label>
            <div class="input-group  me-2">
                <input readonly  type="text" id="pola_nutrisi_frekuensi_makan" name="pola_nutrisi_frekuensi_makan" value="{{!empty($penilaian->pola_nutrisi_frekuensi_makan) ? $penilaian->pola_nutrisi_frekuensi_makan : ''}}"    class="form-control">
                <span class="input-group-text">x/hari</span>
            </div>
        </div> 
       <div class="col-6">
            <label for="pola_nutrisi_jenis_makanan" class="form-label">Jenis Makanan</label>
            <input readonly  type="text" id="pola_nutrisi_jenis_makanan" name="pola_nutrisi_jenis_makanan" value="{{!empty($penilaian->pola_nutrisi_jenis_makanan) ? $penilaian->pola_nutrisi_jenis_makanan : ''}}"    class="form-control">
        </div> 
    </div>

    <label for="" class="form-label">Pola Tidur</label>
    <div class="ms-2 row">
       <div class="col-6">
            <label for="pola_tidur_lama_tidur" class="form-label">Lama Tidur</label>
            <div class="d-flex ">
                <div class="input-group  me-2">
                    <input readonly  type="text" id="pola_tidur_lama_tidur" name="pola_tidur_lama_tidur" value="{{!empty($penilaian->pola_tidur_lama_tidur) ? $penilaian->pola_tidur_lama_tidur : ''}}"    class="form-control">
                    <span class="input-group-text">jam/hari</span>
                </div>
                <select disabled class="form-select me-2" id="pola_tidur_gangguan"  name="pola_tidur_gangguan" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada Gangguan','Insomia'] as $item)
                        <option {{!empty($penilaian->pola_tidur_gangguan) ? ($penilaian->pola_tidur_gangguan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select>
            </div>
            
        </div> 
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">IV. PENGKAJIAN FUNGSI</h5>

    <div class="row">
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_kemampuan_sehari" class="form-label">a. Kemampuan Aktifitas Sehari-hari : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pengkajian_fungsi_kemampuan_sehari"  name="pengkajian_fungsi_kemampuan_sehari" aria-label="Default select example">
                    
                    @foreach(['Mandiri','Bantuan Minimal','Bantuann Sebagian','Ketergantungan Total'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_kemampuan_sehari) ? ($penilaian->pengkajian_fungsi_kemampuan_sehari === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_berjalan" class="form-label">b. Berjalan : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pengkajian_fungsi_berjalan"  name="pengkajian_fungsi_berjalan" aria-label="Default select example">
                    
                    @foreach(['TAK','Penurunan Kekuatan/ROM','Paralisis','Sering Jatuh','Deformitas','Hilang Keseimbangan','Riwayat Patah Tulang','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_berjalan) ? ($penilaian->pengkajian_fungsi_berjalan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pengkajian_fungsi_berjalan_keterangan" name="pengkajian_fungsi_berjalan_keterangan" value="{{!empty($penilaian->pengkajian_fungsi_berjalan_keterangan) ? $penilaian->pengkajian_fungsi_berjalan_keterangan : ''}}"    class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_aktifitas" class="form-label">c. Aktifitas : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pengkajian_fungsi_aktifitas"  name="pengkajian_fungsi_aktifitas" aria-label="Default select example">
                    
                    @foreach(['Tirah Baring','Duduk','Berjalan'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_aktifitas) ? ($penilaian->pengkajian_fungsi_aktifitas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_ambulani" class="form-label">d. Alat Ambulansi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pengkajian_fungsi_ambulani"  name="pengkajian_fungsi_ambulani" aria-label="Default select example">
                    
                    @foreach(['Walker','Tongkat','Kursi Roda','Tidak Menggunakan'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_ambulani) ? ($penilaian->pengkajian_fungsi_ambulani === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_ekstrimitas_atas" class="form-label">e. ekstrimitas Atas : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pengkajian_fungsi_ekstrimitas_atas"  name="pengkajian_fungsi_ekstrimitas_atas" aria-label="Default select example">
                    
                    @foreach(['TAK','Lemah','Oedema','Tidak Simetris','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_ekstrimitas_atas) ? ($penilaian->pengkajian_fungsi_ekstrimitas_atas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pengkajian_fungsi_ekstrimitas_atas_keterangan" name="pengkajian_fungsi_ekstrimitas_atas_keterangan" value="{{!empty($penilaian->pengkajian_fungsi_ekstrimitas_atas_keterangan) ? $penilaian->pengkajian_fungsi_ekstrimitas_atas_keterangan : ''}}"    class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_ekstrimitas_bawah" class="form-label">f. ekstrimitas Bawah : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pengkajian_fungsi_ekstrimitas_bawah"  name="pengkajian_fungsi_ekstrimitas_bawah" aria-label="Default select example">
                    
                    @foreach(['TAK','Varises','Oedema','Tidak Simetris','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_ekstrimitas_bawah) ? ($penilaian->pengkajian_fungsi_ekstrimitas_bawah === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pengkajian_fungsi_ekstrimitas_bawah_keterangan" name="pengkajian_fungsi_ekstrimitas_bawah_keterangan" value="{{!empty($penilaian->pengkajian_fungsi_ekstrimitas_bawah_keterangan) ? $penilaian->pengkajian_fungsi_ekstrimitas_bawah_keterangan : ''}}"    class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_menggenggam" class="form-label">g. Kemampuan Menggenggam : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pengkajian_fungsi_menggenggam"  name="pengkajian_fungsi_menggenggam" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada Kesulitan','Terakhir','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_menggenggam) ? ($penilaian->pengkajian_fungsi_menggenggam === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pengkajian_fungsi_menggenggam_keterangan" name="pengkajian_fungsi_menggenggam_keterangan" value="{{!empty($penilaian->pengkajian_fungsi_menggenggam_keterangan) ? $penilaian->pengkajian_fungsi_menggenggam_keterangan : ''}}"    class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_koordinasi" class="form-label">h. Kemampuan Koordinasi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pengkajian_fungsi_koordinasi"  name="pengkajian_fungsi_koordinasi" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada Kesulitan','Ada Masalah'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_koordinasi) ? ($penilaian->pengkajian_fungsi_koordinasi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="pengkajian_fungsi_koordinasi_keterangan" name="pengkajian_fungsi_koordinasi_keterangan" value="{{!empty($penilaian->pengkajian_fungsi_koordinasi_keterangan) ? $penilaian->pengkajian_fungsi_koordinasi_keterangan : ''}}"    class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_kesimpulan" class="form-label">i. Kesimpulan Gangguan Fungsi : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="pengkajian_fungsi_kesimpulan"  name="pengkajian_fungsi_kesimpulan" aria-label="Default select example">
                    
                    @foreach(['Ya (Co DPJP)','Tidak (Tidak Perlu Co DPJP)'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_kesimpulan) ? ($penilaian->pengkajian_fungsi_kesimpulan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
    </div> 
        
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. RIWAYAT PSIKOLOGIS - SOSIAL - EKONOMI - BUDAYA - SPIRITUAL</h5>

    <div class="row">
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_kondisi_psiko" class="form-label">a. Kondisi Psikologis : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="riwayat_psiko_kondisi_psiko"  name="riwayat_psiko_kondisi_psiko" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada Masalah','Marah','Takut','Depresi','Cepat Lelah','Cemas','Gelisah','Sulit Tidur','Lain-lain'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_kondisi_psiko) ? ($penilaian->riwayat_psiko_kondisi_psiko === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_perilaku" class="form-label">b. Adakah Perilaku : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="riwayat_psiko_perilaku"  name="riwayat_psiko_perilaku" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada Masalah','Perilaku Kekerasan','Gangguan Efek','Gangguan Memori','Halusinasi','Kecenderungan Percobaan Bunuh Diri','Lain-lain'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_perilaku) ? ($penilaian->riwayat_psiko_perilaku === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="riwayat_psiko_perilaku_keterangan" name="riwayat_psiko_perilaku_keterangan" value="{{!empty($penilaian->riwayat_psiko_perilaku_keterangan) ? $penilaian->riwayat_psiko_perilaku_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_gangguan_jiwa" class="form-label">c. Gangguan Jiwa di Masa Lalu  : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="riwayat_psiko_gangguan_jiwa"  name="riwayat_psiko_gangguan_jiwa" aria-label="Default select example">
                    
                    @foreach(['Ya','Tidak'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_gangguan_jiwa) ? ($penilaian->riwayat_psiko_gangguan_jiwa === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_hubungan_keluarga" class="form-label">d. Hubungan Pasien dengan Anggota Keluarga : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="riwayat_psiko_hubungan_keluarga"  name="riwayat_psiko_hubungan_keluarga" aria-label="Default select example">
                    
                    @foreach(['Harmonis','Kurang Harmonis','Tidak Harmonis','Konflik Besar'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_hubungan_keluarga) ? ($penilaian->riwayat_psiko_hubungan_keluarga === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="" class="form-label">e. Agama : </label>
            <input readonly  placeholder="Keterangan" type="text" id="" name=""   class= "form-control">
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_tinggal" class="form-label">f. Tinggal Dengan  : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="riwayat_psiko_tinggal"  name="riwayat_psiko_tinggal" aria-label="Default select example">
                    
                    @foreach(['Sendiri','Orang Tua','Suami/Istri','Keluarga','Lain-lain'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_tinggal) ? ($penilaian->riwayat_psiko_tinggal === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="riwayat_psiko_tinggal_keterangan" name="riwayat_psiko_tinggal_keterangan" value="{{!empty($penilaian->riwayat_psiko_tinggal_keterangan) ? $penilaian->riwayat_psiko_tinggal_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="" class="form-label">g. Pekerjaan : </label>
            <input readonly  placeholder="Keterangan" type="text" id="" name="form-control">
        </div>
        <div class="col-6 mb-2">
            <label for="" class="form-label">h. Pembayaran : </label>
            <input readonly  placeholder="Keterangan" type="text" id="" name=""   class="form-control">
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_nilai_kepercayaan" class="form-label">i. Nilai-nila Kepercayaan/Budaya Yang Perlu Diperhatikan : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="riwayat_psiko_nilai_kepercayaan"  name="riwayat_psiko_nilai_kepercayaan" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada','Ada'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_nilai_kepercayaan) ? ($penilaian->riwayat_psiko_nilai_kepercayaan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="riwayat_psiko_kepercayaan_keterangan" name="riwayat_psiko_kepercayaan_keterangan" value="{{!empty($penilaian->riwayat_psiko_kepercayaan_keterangan) ? $penilaian->riwayat_psiko_kepercayaan_keterangan : ''}}"    class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="" class="form-label">j. Bahasa Sehari-hari : </label>
            <input readonly  placeholder="Keterangan" type="text" id="" name=""   class="form-control">
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko" class="form-label">k. Pendidikan Pasien : </label>
            <input readonly  placeholder="Keterangan" type="text" id="" name=""   class="form-control">
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_pendidikan_pj" class="form-label">l Pendidikan P.J : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="riwayat_psiko_pendidikan_pj"  name="riwayat_psiko_pendidikan_pj" aria-label="Default select example">
                    
                    @foreach(['-','TS','TK','SD','SMP','SMA','SLTA/SEDERAJAT','D1','D2','D3','D4','S1','S2','S3'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_pendidikan_pj) ? ($penilaian->riwayat_psiko_pendidikan_pj === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_edukasi_diberikan" class="form-label">m. Eukasi Diberikan Kepada : </label>
            <div class="d-flex">
                <select disabled class="form-select me-2" id="riwayat_psiko_edukasi_diberikan"  name="riwayat_psiko_edukasi_diberikan" aria-label="Default select example">
                    
                    @foreach(['Pasien','Keluarga'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_edukasi_diberikan) ? ($penilaian->riwayat_psiko_edukasi_diberikan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  placeholder="Keterangan" type="text" id="riwayat_psiko_edukasi_keterangan" name="riwayat_psiko_edukasi_keterangan" value="{{!empty($penilaian->riwayat_psiko_edukasi_keterangan) ? $penilaian->riwayat_psiko_edukasi_keterangan : ''}}"    class="form-control">
            </div>
        </div>
    </div>
       
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VI. PENILAIAN TINGKAT NYERI</h5>
    <div class="d-flex justify-content-center mb-5">
        <img src="{{asset('icon/nyeri.png')}}" width="600" alt="">
    </div>
    <div class="row">
        <div class="mb-2 ">
            <div class="row">
                <div class="col-4">
                    <label for="penilaian_nyeri" class="form-label">Rasa Nyeri:</label>
                    <select disabled class="form-select"  id="penilaian_nyeri"  name="penilaian_nyeri" aria-label="Default select example">
                        @foreach (['Tidak Ada Nyeri', 'Nyeri Akut', 'Nyeri Kronis'] as $item)
                           <option value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="col-8">
                    <label for="penilaian_nyeri_penyebab" class="form-label">Penyebab</label>
                    <div class="d-flex">
                        <select disabled id="penilaian_nyeri_penyebab"  name="penilaian_nyeri_penyebab" class="form-select me-2" aria-label="Default select example">
                            @foreach (['Proses Penyakit', 'Benturan', 'Lain-lain'] as $item)
                            <option value="{{$item}}">{{$item}}</option> 
                            @endforeach
                        </select>
                        <input readonly type="text" class=" form-control" name="penilaian_nyeri_ket_penyebab" value="{{!empty($penilaian->penilaian_nyeri_ket_penyebab) ? $penilaian->penilaian_nyeri_ket_penyebab : ''}}"  id="penilaian_nyeri_ket_penyebab" placeholder="Keterangan" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="penilaian_nyeri_kualitas" class="form-label">Kualitas:</label>
                    <div class="d-flex">
                        <select disabled class="w-25 me-2 form-select" id="penilaian_nyeri_kualitas"  name="penilaian_nyeri_kualitas" aria-label="Default select example">
                            @foreach (['Seperti Tertusuk','Berdenyut','Teriris','Tertindih','Tertiban','Lain-lain'] as $item)
                            <option value="{{$item}}">{{$item}}</option> 
                            @endforeach
                        </select>
                        <input readonly type="text" class="w-75 form-control" name="penilaian_nyeri_ket_kualitas" value="{{!empty($penilaian->penilaian_nyeri_ket_kualitas) ? $penilaian->penilaian_nyeri_ket_kualitas : ''}}"  id="penilaian_nyeri_ket_kualitas"  placeholder="Keterangan" >
                    </div>
                </div>
            </div>

            <div class="row">
                <label for="" class="form-label">Wilayah:</label>
                <div class="col ms-4">
                    <label for="penilaian_nyeri_lokasi" class="form-label">Lokasi:</label>
                    <input readonly type="text" id="penilaian_nyeri_lokasi"  name="penilaian_nyeri_lokasi" value="{{!empty($penilaian->penilaian_nyeri_lokasi) ? $penilaian->penilaian_nyeri_lokasi : ''}}"  class=" form-control"   placeholder="Nilai" >
                </div>
                <div class="col">
                    <label for="penilaian_nyeri_menyebar" class="form-label">Menyebar:</label>
                    <select disabled class=" form-select"  id="penilaian_nyeri_menyebar"  name="penilaian_nyeri_menyebar" aria-label="Default select example">
                            @foreach (['Tidak','Ya'] as $item)
                            <option value="{{$item}}">{{$item}}</option> 
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <label for="" class="form-label">Severity:</label>                
                <div class="col ms-4    ">
                    <label for="penilaian_nyeri_menyebar" class="form-label">Skala Nyeri:</label>
                    <select disabled class=" form-select" id="penilaian_nyeri_menyebar"  name="penilaian_nyeri_menyebar" aria-label="Default select example">
                    
                        @for($i=0; $i <=10 ;$i++)
                            <option value="{{$i}}" >{{$i}}</option>
                        @endfor
                    </select>
                </div>

                <div class="col ">
                    <label for="penilaian_nyeri_waktu" class="form-label">Waktu / Durasi:</label>
                    <div class="input-group">
                        <input readonly type="text" class="form-control" id="penilaian_nyeri_waktu"  name="penilaian_nyeri_waktu" value="{{!empty($penilaian->penilaian_nyeri_waktu) ? $penilaian->penilaian_nyeri_waktu : ''}}" >
                        <span class="input-group-text" >Menit</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label for="penilaian_nyeri_hilang" class="form-label">Nyeri Hilang Bila:</label>
                    <div class="d-flex">
                        <select disabled class="form-select me-2" id="penilaian_nyeri_hilang"  name="penilaian_nyeri_hilang" aria-label="Default select example">
                            @foreach (['Istirahat','Medengar Musik','Minum Obat'] as $item)
                                <option value="{{$item}}">{{$item}}</option> 
                            @endforeach
                        </select>
                        <input readonly type="text" class=" form-control" name="penilaian_nyeri_ket_hilang" value="{{!empty($penilaian->penilaian_nyeri_ket_hilang) ? $penilaian->penilaian_nyeri_ket_hilang : ''}}"  id="penilaian_nyeri_ket_hilang" placeholder="Nilai" >
                    </div>
                </div>
                <div class="col-8">
                    <label for="penilaian_nyeri_diberitahukan_dokter" class="form-label">Diberitahukan Kepada Dokter ?</label>
                    <div class="row">
                        <div class="col-4">
                            <select disabled class=" form-select" id="penilaian_nyeri_diberitahukan_dokter"  name="penilaian_nyeri_diberitahukan_dokter" aria-label="Default select example">
                                @foreach (['Tidak','Ya'] as $item)
                                    <option value="{{$item}}">{{$item}}</option> 
                                @endforeach
                            </select>
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <label for="ket_dokter" class="form-label m-0 me-2">Jam:</label>
                            <input readonly type="text" name="penilaian_nyeri_jam_diberitahukan_dokter" value="{{!empty($penilaian->penilaian_nyeri_jam_diberitahukan_dokter) ? $penilaian->penilaian_nyeri_jam_diberitahukan_dokter : ''}}"  id="penilaian_nyeri_jam_diberitahukan_dokter" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">V. PENILAIAN RESIKO JATUH</h5>
    <label for="" class="form-label">Skala Morse :</label>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">1. Riwayat Jatuh</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhmorse_skala1" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhmorse_skala1"  name="penilaian_jatuhmorse_skala1" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhmorse_skala1) ? ($penilaian->penilaian_jatuhmorse_skala1 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhmorse_nilai1" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhmorse_nilai1" value="{{!empty($penilaian->penilaian_jatuhmorse_nilai1) ? $penilaian->penilaian_jatuhmorse_nilai1 : ''}}"  id="penilaian_jatuhmorse_nilai1" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">2. Diagnosis Sekunder (&GreaterEqual; 2 Diagnose Medis)</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhmorse_skala2" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhmorse_skala2"  name="penilaian_jatuhmorse_skala2" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhmorse_skala2) ? ($penilaian->penilaian_jatuhmorse_skala2 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhmorse_nilai2" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhmorse_nilai2" value="{{!empty($penilaian->penilaian_jatuhmorse_nilai2) ? $penilaian->penilaian_jatuhmorse_nilai2 : ''}}"  id="penilaian_jatuhmorse_nilai2" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">3. Alat Bantu</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhmorse_skala3" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhmorse_skala3"  name="penilaian_jatuhmorse_skala3" aria-label="Default select example">
                
                @foreach (['Tidak Ada/Kursi Roda/Perawat/Tirah Baring','Tongkat/Alat Penopang','Berpegangan Pada Perabot'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhmorse_skala3) ? ($penilaian->penilaian_jatuhmorse_skala3 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhmorse_nilai3" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhmorse_nilai3" value="{{!empty($penilaian->penilaian_jatuhmorse_nilai3) ? $penilaian->penilaian_jatuhmorse_nilai3 : ''}}"  id="penilaian_jatuhmorse_nilai3" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">4. Terpasang Infuse</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhmorse_skala4" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhmorse_skala4"  name="penilaian_jatuhmorse_skala4" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhmorse_skala4) ? ($penilaian->penilaian_jatuhmorse_skala4 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhmorse_nilai4" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhmorse_nilai4" value="{{!empty($penilaian->penilaian_jatuhmorse_nilai4) ? $penilaian->penilaian_jatuhmorse_nilai4 : ''}}"  id="penilaian_jatuhmorse_nilai4" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">5. Gaya Berjalan</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhmorse_skala5" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhmorse_skala5"  name="penilaian_jatuhmorse_skala5" aria-label="Default select example">
                
                @foreach (['Normal/Tirah Baring/Imobilisasi','Lemah','Terganggu'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhmorse_skala5) ? ($penilaian->penilaian_jatuhmorse_skala5 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhmorse_nilai5" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhmorse_nilai5" value="{{!empty($penilaian->penilaian_jatuhmorse_nilai5) ? $penilaian->penilaian_jatuhmorse_nilai5 : ''}}"  id="penilaian_jatuhmorse_nilai5" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">6. Status Mental</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhmorse_skala6" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhmorse_skala6"  name="penilaian_jatuhmorse_skala6" aria-label="Default select example">
                
                @foreach (['Sadar Akan Kemampuan Diri Sendiri','Sering Lupa Akan Keterbatasan Yang Dimiliki'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhmorse_skala6) ? ($penilaian->penilaian_jatuhmorse_skala6 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhmorse_nilai6" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhmorse_nilai6" value="{{!empty($penilaian->penilaian_jatuhmorse_nilai6) ? $penilaian->penilaian_jatuhmorse_nilai6 : ''}}"  id="penilaian_jatuhmorse_nilai6" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">Tingkat resiko: Risiko Rendah (0-24), Tindakan : Intervensi pencegahan risiko jatuh standar</span>
        <div class="d-flex w-50 align-items-center justify-content-end">
        
            <label for="penilaian_jatuhmorse_totalnilai" class="form-label m-0 mx-3">Total:</label>
            <input readonly type="number" name="penilaian_jatuhmorse_totalnilai" value="{{!empty($penilaian->penilaian_jatuhmorse_totalnilai) ? $penilaian->penilaian_jatuhmorse_totalnilai : ''}}"  id="penilaian_jatuhmorse_totalnilai" class="w-25 form-control">
        </div>
    </div>
    
    <label for="" class="form-label">Skala Sydney :</label>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">1. Gangguan Gaya Berjalan(Diseret, Menghentak, Dayun)</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala1" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala1"  name="penilaian_jatuhsydney_skala1" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala1) ? ($penilaian->penilaian_jatuhsydney_skala1 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai1" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai1" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai1) ? $penilaian->penilaian_jatuhsydney_nilai1 : ''}}"  id="penilaian_jatuhsydney_nilai1" class="w-25 form-control">
        </div>
    </div>

    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">2. Pusing/ Pingsan Pada Posisi Tegak</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala2" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala2"  name="penilaian_jatuhsydney_skala2" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala2) ? ($penilaian->penilaian_jatuhsydney_skala2 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai2" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai2" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai2) ? $penilaian->penilaian_jatuhsydney_nilai2 : ''}}"  id="penilaian_jatuhsydney_nilai2" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">3. Kebingunan Setiap Saat</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala3" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala3"  name="penilaian_jatuhsydney_skala3" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala3) ? ($penilaian->penilaian_jatuhsydney_skala3 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai3" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai3" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai3) ? $penilaian->penilaian_jatuhsydney_nilai3 : ''}}"  id="penilaian_jatuhsydney_nilai3" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">4. Noktuna / Inkontinen</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala4" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala4"  name="penilaian_jatuhsydney_skala4" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala4) ? ($penilaian->penilaian_jatuhsydney_skala4 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai4" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai4" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai4) ? $penilaian->penilaian_jatuhsydney_nilai4 : ''}}"  id="penilaian_jatuhsydney_nilai4" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">5. Kebingungan Intermiten</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala5" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala5"  name="penilaian_jatuhsydney_skala5" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala5) ? ($penilaian->penilaian_jatuhsydney_skala5 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai5" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai5" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai5) ? $penilaian->penilaian_jatuhsydney_nilai5 : ''}}"  id="penilaian_jatuhsydney_nilai5" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">6. Kelemahan Umum</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala6" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala6"  name="penilaian_jatuhsydney_skala6" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala6) ? ($penilaian->penilaian_jatuhsydney_skala6 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai6" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai6" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai6) ? $penilaian->penilaian_jatuhsydney_nilai6 : ''}}"  id="penilaian_jatuhsydney_nilai6" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">7. Obat-obat Beresiko Tinggi (Diuretic, Narkotik, Sedativ, Anti Psikotik, Laksatif, Vasodiilator, Antiaritmia, Antihipertensi, Obat Hipoglikemik, Anti Depresan, Neuroleptik, NSAID)</span> <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala7" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala7"  name="penilaian_jatuhsydney_skala7" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala7) ? ($penilaian->penilaian_jatuhsydney_skala7 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai7" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai7" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai7) ? $penilaian->penilaian_jatuhsydney_nilai7 : ''}}"  id="penilaian_jatuhsydney_nilai7" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">8. Riwayat Jatuh dalam  12 Bulan Seelumnya </span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala8" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala8"  name="penilaian_jatuhsydney_skala8" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala8) ? ($penilaian->penilaian_jatuhsydney_skala8 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai8" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai8" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai8) ? $penilaian->penilaian_jatuhsydney_nilai8 : ''}}"  id="penilaian_jatuhsydney_nilai8" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">Osteoporosis</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala9" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala9"  name="penilaian_jatuhsydney_skala9" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala9) ? ($penilaian->penilaian_jatuhsydney_skala9 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai9" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai9" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai9) ? $penilaian->penilaian_jatuhsydney_nilai9 : ''}}"  id="penilaian_jatuhsydney_nilai9" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">10. Gangguan Pendengaran Dan Atau Penglihatan</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala10" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala10"  name="penilaian_jatuhsydney_skala10" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala10) ? ($penilaian->penilaian_jatuhsydney_skala10 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai10" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai10" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai10) ? $penilaian->penilaian_jatuhsydney_nilai10 : ''}}"  id="penilaian_jatuhsydney_nilai10" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">11. Usia 70 tahun ke atas</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_skala11" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhsydney_skala11"  name="penilaian_jatuhsydney_skala11" aria-label="Default select example">
                
                @foreach (['Tidak', 'Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhsydney_skala11) ? ($penilaian->penilaian_jatuhsydney_skala11 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhsydney_nilai11" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_nilai11" value="{{!empty($penilaian->penilaian_jatuhsydney_nilai11) ? $penilaian->penilaian_jatuhsydney_nilai11 : ''}}"    id="penilaian_jatuhsydney_nilai11" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">Tingkat Resiko: Resiko Rendah (1-3), Tindakan : Intervensi pencegahan risiko jatuh standar</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhsydney_totalnilai" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhsydney_totalnilai" value="{{!empty($penilaian->penilaian_jatuhsydney_totalnilai) ? $penilaian->penilaian_jatuhsydney_totalnilai : ''}}"  id="penilaian_jatuhsydney_totalnilai" class="w-25 form-control">
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">VIII. SKRINNING GIZI</h5>

    <div class=" d-flex align-items-center justify-content-between mb-4">
        <span class="">1. Apakah ada penurunan BB yang tidak diinginkan selama 6 bulan terakhir?</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhmorse_skala1" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhmorse_skala1"  name="penilaian_jatuhmorse_skala1" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhmorse_skala1) ? ($penilaian->penilaian_jatuhmorse_skala1 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhmorse_nilai1" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhmorse_nilai1" value="{{!empty($penilaian->penilaian_jatuhmorse_nilai1) ? $penilaian->penilaian_jatuhmorse_nilai1 : ''}}"  id="penilaian_jatuhmorse_nilai1" class="w-25 form-control">
        </div>
    </div>
    <div class=" d-flex align-items-center justify-content-between mb-4">
        <span class="">2. Apakah asupan makan berkurang karena tidak nafsu makan ? </span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuhmorse_skala1" class="form-label m-0 mx-3">Skala:</label>
            <select disabled class="w-75 form-select" id="penilaian_jatuhmorse_skala1"  name="penilaian_jatuhmorse_skala1" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuhmorse_skala1) ? ($penilaian->penilaian_jatuhmorse_skala1 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuhmorse_nilai1" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly type="number" name="penilaian_jatuhmorse_nilai1" value="{{!empty($penilaian->penilaian_jatuhmorse_nilai1) ? $penilaian->penilaian_jatuhmorse_nilai1 : ''}}"  id="penilaian_jatuhmorse_nilai1" class="w-25 form-control">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="skrining_gizi_diagnosa_khusus" class="form-label">Pasien dengan diagnosis khusus:</label>
            <div class="d-flex">
                <select disabled class="w-25 me-2 form-select" id="skrining_gizi_diagnosa_khusus"  name="skrining_gizi_diagnosa_khusus" aria-label="Default select example">
                    
                    @foreach (['Tidak', 'Ya'] as $item)
                        <option {{!empty($penilaian->skrining_gizi_diagnosa_khusus) ? ($penilaian->skrining_gizi_diagnosa_khusus === $item ? 'selected' : '') : ''}} value="{{$item}}" >{{$item}}</option>
                    @endforeach
                </select>
                <input readonly type="text" class="w-75 form-control" name="skrining_gizi_ket_diagnosa_khusus" value="{{!empty($penilaian->skrining_gizi_ket_diagnosa_khusus) ? $penilaian->skrining_gizi_ket_diagnosa_khusus : ''}}"  id="skrining_gizi_ket_diagnosa_khusus"  placeholder="Keterangan" >
            </div>
        </div>
        <div class="col">
            <label for="skrining_gizi_diketahui_dietisen" class="form-label">Sudah dibaca dan diketahui oleh Dietisen:</label>
            <div class="d-flex align-items-end">
                <select disabled class="w-25 me-2 form-select" id="skrining_gizi_diketahui_dietisen"  name="skrining_gizi_diketahui_dietisen" aria-label="Default select example">
                    
                    @foreach (['Tidak', 'Ya'] as $item)
                        <option {{!empty($penilaian->skrining_gizi_diketahui_dietisen) ? ($penilaian->skrining_gizi_diketahui_dietisen === $item ? 'selected' : '') : ''}} value="{{$item}}" >{{$item}}</option>
                    @endforeach
                </select>
                    <label for="skrining_gizi_jam_diketahui_dietisen" class="form-label mx-3">Jam</label>
                    <input readonly type="text" class="w-75 form-control" name="skrining_gizi_jam_diketahui_dietisen" value="{{!empty($penilaian->skrining_gizi_jam_diketahui_dietisen) ? $penilaian->skrining_gizi_jam_diketahui_dietisen : ''}}"  id="skrining_gizi_jam_diketahui_dietisen"  placeholder="Keterangan" >
            </div>
        </div>
    </div>    
</div>

<hr class="mb-5">
<div>
    <div class="row">
        <div class="col-6  border-end" style="height:400px">
            <h5 class="text-center">MASALAH KEPERAWATAN</h5>
            <hr class="mb-2">
            <div class="overflow-auto h-75 alternate_child_color  px-3" >
                @foreach($masalah as $v)
                    <div class="form-check d-flex justify-content-between mb-2 align-items-center">
                        <div>
                            {{!empty($v->kode_masalah) ? $v->kode_masalah :'' }}
                        </div>
                        <div>
                            {{!empty($v->nama_masalah) ? $v->nama_masalah : ''}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-6 " >
            <h5 class="text-center">RENCANA KEPERAWATAN</h5>
            <hr class="mb-2">
            <div class="overflow-auto h-75 alternate_child_color  px-3" >
                <div class="mb-3">
                    <label for="rencana" class="form-label">Rencana Keperawatan</label>
                    <textarea readonly class="form-control" id="rencana" name="rencana" rows="5">{{!empty($penilaian->rencana) ? $penilaian->rencana : ''}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
