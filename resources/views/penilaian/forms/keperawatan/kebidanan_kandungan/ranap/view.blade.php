<div class="row mb-3">
    @include('penilaian.form_header_ranap', [
                "pj_form_type"=>"petugas", 
                "nama_pj" => $penilaian->pengkaji1,
                "kode_pj" => $penilaian->nip1, 
                "nama_pj_2" => $penilaian->pengkaji2,
                "kode_pj_2" => $penilaian->nip2, 
                "nama_dpjp" => $penilaian->nm_dokter,
                "kode_dpjp" => $penilaian->kd_dokter, 
                "readonly" => true
            ])
    <div class="col-3 mb-2">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input readonly  type="text" class="form-control input-daterange input-date-time" name="tanggal" value="{{!empty($penilaian->tanggal) ? $penilaian->tanggal : ''}}" id="tanggal"  required autocomplete="off" >
    </div>
    <div class="col-3 mb-2">
        <label for="informasi" class="form-label">Anamnesis : </label>
        <select disabled  class="form-select" id="informasi" name="informasi" aria-label="Default select " >
            @foreach (['Autoanamnessi', 'Alloanamnesis'] as $item)
                <option {{!empty($penilaian->informasi) ? ($penilaian->informasi === $item ? 'selected' : '') : ''}}  value="{{$item}}" >{{$item}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3 mb-2">
        <label for="tiba" class="form-label">Tiba di Ruang Rawat : </label>
        <select disabled  class="form-select" id="tiba_diruang_rawat" name="tiba_diruang_rawat" aria-label="Default select " >
            
            @foreach (['Jalan Tanpa Bantuan', 'Kursi Roda', 'Brankar'] as $item)
                <option {{!empty($penilaian->tiba_diruang_rawat) ? ($penilaian->tiba_diruang_rawat === $item ? 'selected' : '') : ''}} value="{{$item}}" >{{$item}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3 mb-2">
        <label for="informasi" class="form-label">Cara Masuk : </label>
        <select disabled  class="form-select" id="cara_masuk" name="cara_masuk" aria-label="Default select " >
            
            @foreach (['Poli','IGD','VK','OK','Lain-lain'] as $item)
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
            <label for="keluhan" class="form-label">Keluhan Utama</label>
            <textarea readonly  class="form-control" id="keluhan" name="keluhan" rows="3">{{!empty($penilaian->keluhan) ? $penilaian->keluhan : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rpk" class="form-label">Riwayat Penyakit Keluarga</label>
            <textarea readonly  class="form-control" id="rpk" name="rpk" rows="3">{{!empty($penilaian->rpk) ? $penilaian->rpk : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="psk" class="form-label">Penyakit Selama Kehamilan</label>
            <textarea readonly  class="form-control" id="psk" name="psk" rows="3">{{!empty($penilaian->psk) ? $penilaian->psk : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rp" class="form-label">Riwayat Pembedahan</label>
            <textarea readonly  class="form-control" id="rp" name="rp" rows="3">{{!empty($penilaian->rp) ? $penilaian->rp : ''}}</textarea>
        </div>
        <div class="col-6 mb-2 ">
            <label for="alergi" class="form-label">Riwayat Alergi</label>
            <input readonly  type="text" class="form-control" name="alergi" value="{{!empty($penilaian->alergi) ? $penilaian->alergi : ''}}" id='alergi' value="">
        </div>
        <div class="col mb-2">
            <label for="komplikasi_sebelumnya" class="form-label">Komplikasi dalam Kehamilan Sebelumnya</label>
            <div class="d-flex">
                <select disabled  class="form-select w-25" id="komplikasi_sebelumnya"  name="komplikasi_sebelumnya" aria-label="Default select example">
                    @foreach (['Tidak','HAP','HPP','PEB/PER/Eklamsi','Lain-lain'] as $item)
                        <option {{!empty($penilaian->komplikasi_sebelumnya) ? ($penilaian->komplikasi_sebelumnya === $item ? 'selected' : '') : ''}}   value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select>
                <input readonly  type="text" class="form-control w-75" name="keterangan_komplikasi_sebelumnya" value="{{!empty($penilaian->keterangan_komplikasi_sebelumnya) ? $penilaian->keterangan_komplikasi_sebelumnya : ''}}" id='keterangan_komplikasi_sebelumnya' value="">
            </div>
            
        </div>
        
        <label class="form-label">Riwayat Menstruasi</label>
        <div class="ms-2 row">
            <div class="col-4 mb-2">
                <label for="riwayat_mens_umur" class="form-label">Umum Menarche: </label>
                <div class="input-group  me-2">
                    <input readonly   type="text" id="riwayat_mens_umur" name="riwayat_mens_umur" value="{{!empty($penilaian->riwayat_mens_umur) ? $penilaian->riwayat_mens_umur : ''}}"   class="form-control">
                    <span class="input-group-text">tahun</span>
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="riwayat_mens_lamanya" class="form-label">Lamanya: </label>
                <div class="input-group  me-2">
                    <input readonly   type="text" id="riwayat_mens_lamanya" name="riwayat_mens_lamanya" value="{{!empty($penilaian->riwayat_mens_lamanya) ? $penilaian->riwayat_mens_lamanya : ''}}"   class="form-control">
                    <span class="input-group-text">hari</span>
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="riwayat_mens_banyaknya" class="form-label">Banyaknya: </label>
                <div class="input-group  me-2">
                    <input readonly   type="text" id="riwayat_mens_banyaknya" name="riwayat_mens_banyaknya" value="{{!empty($penilaian->riwayat_mens_banyaknya) ? $penilaian->riwayat_mens_banyaknya : ''}}"   class="form-control">
                    <span class="input-group-text">pembalut</span>
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_mens_siklus" class="form-label">Siklus: </label>
                <div class="d-flex">
                    <div class="input-group  me-2">
                        <input readonly   type="text" id="riwayat_mens_siklus" name="riwayat_mens_siklus" value="{{!empty($penilaian->riwayat_mens_siklus) ? $penilaian->riwayat_mens_siklus : ''}}"   class="form-control">
                        <span class="input-group-text">hari</span>
                    </div>,
                    <select disabled  class="form-select me-2" id="riwayat_mens_siklus"  name="riwayat_mens_siklus" aria-label="Default select example">
                        @foreach (['Teratur','Tidak Teratur'] as $item)
                            <option {{!empty($penilaian->riwayat_mens_siklus) ? ($penilaian->riwayat_mens_siklus === $item ? 'selected' : '') : ''}}  value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_mens_dirasakan" class="form-label">Dirasakan saat mentruasi: </label>
                <select disabled  class="form-select me-2" id="riwayat_mens_dirasakan"  name="riwayat_mens_dirasakan" aria-label="Default select example">
                    @foreach (['Tidak Ada Masalah','Dismenorhea','Spotting','Menorhagia','PMS'] as $item)
                        <option {{!empty($penilaian->riwayat_mens_dirasakan) ? ($penilaian->riwayat_mens_dirasakan === $item ? 'selected' : '') : ''}}  value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <label class="form-label">Riwayat Perkawinan</label>
        <div class="ms-2 row">
            <div class="col-6 mb-2">
                <label for="riwayat_perkawinan_status" class="form-label">Status Menikah: </label>
                <div class="d-flex">
                    <select disabled  class="form-select w-75 me-2" id="riwayat_perkawinan_status"  name="riwayat_perkawinan_status" aria-label="Default select example">
                        @foreach (['Tidak', 'Ya'] as $item)
                            <option {{!empty($penilaian->riwayat_perkawinan_status) ? ($penilaian->riwayat_perkawinan_status === $item ? 'selected' : '') : ''}}  value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                    <div class="input-group  w-25 me-2">
                        <input readonly   type="text" id="riwayat_perkawinan_ket_status" name="riwayat_perkawinan_ket_status" value="{{!empty($penilaian->riwayat_perkawinan_ket_status) ? $penilaian->riwayat_perkawinan_ket_status : ''}}"   class="form-control">
                        <span class="input-group-text">kali</span>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_perkawinan_usia1" class="form-label">Usia Perkawinan Ke 1: </label>
                <div class="d-flex align-items-center">
                    <div class="input-group  w-25 me-2">
                        <input readonly   type="text" id="riwayat_perkawinan_usia1" name="riwayat_perkawinan_usia1" value="{{!empty($penilaian->riwayat_perkawinan_usia1) ? $penilaian->riwayat_perkawinan_usia1 : ''}}"   class="form-control">
                        <span class="input-group-text">kali</span>
                    </div>
                    <span class="mx-1">, Status: </span>
                    <select disabled  class="form-select w-50 me-2" id="riwayat_perkawinan_ket_usia1"  name="riwayat_perkawinan_ket_usia1" aria-label="Default select example">
                        @foreach (['-','Masih Menikah','Cerai','Meninggal'] as $item)
                            <option {{!empty($penilaian->riwayat_perkawinan_ket_usia1) ? ($penilaian->riwayat_perkawinan_ket_usia1 === $item ? 'selected' : '') : ''}}  value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                    
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_perkawinan_usia2" class="form-label">Usia Perkawinan Ke 2: </label>
                <div class="d-flex align-items-center">
                    <div class="input-group  w-25 me-2">
                        <input readonly   type="text" id="riwayat_perkawinan_usia2" name="riwayat_perkawinan_usia2" value="{{!empty($penilaian->riwayat_perkawinan_usia2) ? $penilaian->riwayat_perkawinan_usia2 : ''}}"   class="form-control">
                        <span class="input-group-text">kali</span>
                    </div>
                    <span class="mx-1">, Status: </span>
                    <select disabled  class="form-select w-50 me-2" id="riwayat_perkawinan_ket_usia2"  name="riwayat_perkawinan_ket_usia2" aria-label="Default select example">
                        @foreach (['-','Masih Menikah','Cerai','Meninggal'] as $item)
                            <option {{!empty($penilaian->riwayat_perkawinan_ket_usia2) ? ($penilaian->riwayat_perkawinan_ket_usia2 === $item ? 'selected' : '') : ''}}  value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                    
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_perkawinan_usia3" class="form-label">Usia Perkawinan Ke 3: </label>
                <div class="d-flex align-items-center">
                    <div class="input-group  w-25 me-2">
                        <input readonly   type="text" id="riwayat_perkawinan_usia3" name="riwayat_perkawinan_usia3" value="{{!empty($penilaian->riwayat_perkawinan_usia3) ? $penilaian->riwayat_perkawinan_usia3 : ''}}"   class="form-control">
                        <span class="input-group-text">kali</span>
                    </div>
                    <span class="mx-1">, Status: </span>
                    <select disabled  class="form-select w-50 me-2" id="riwayat_perkawinan_ket_usia3"  name="riwayat_perkawinan_ket_usia3" aria-label="Default select example">
                        @foreach (['-','Masih Menikah','Cerai','Meninggal'] as $item)
                            <option {{!empty($penilaian->riwayat_perkawinan_ket_usia3) ? ($penilaian->riwayat_perkawinan_ket_usia3 === $item ? 'selected' : '') : ''}}  value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                    
                </div>
            </div>

        </div>
        <label for="" class="form-label">Riwayat Persalinan & Nifas</label>
        <div class="ms-2 row">
            <div class="col-3 mb-2">
                <label for="riwayat_persalinan_g" class="form-label">G:</label>
                <input readonly id="riwayat_persalinan_g" name="riwayat_persalinan_g" value="{{!empty($penilaian->riwayat_persalinan_g) ? $penilaian->riwayat_persalinan_g : ''}}" type="text" class="form-control">
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_persalinan_p" class="form-label">P:</label>
                <input readonly id="riwayat_persalinan_p" name="riwayat_persalinan_p" value="{{!empty($penilaian->riwayat_persalinan_p) ? $penilaian->riwayat_persalinan_p : ''}}" type="text" class="form-control">
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_persalinan_a" class="form-label">A:</label>
                <input readonly id="riwayat_persalinan_a" name="riwayat_persalinan_a" value="{{!empty($penilaian->riwayat_persalinan_a) ? $penilaian->riwayat_persalinan_a : ''}}" type="text" class="form-control">
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_persalinan_hidup" class="form-label">Anak Yang Hidup:</label>
                <input readonly id="riwayat_persalinan_hidup" name="riwayat_persalinan_hidup" value="{{!empty($penilaian->riwayat_persalinan_hidup) ? $penilaian->riwayat_persalinan_hidup : ''}}" type="text" class="form-control">
            </div>
            <div class="col-12 mb-2">
                <div class="col-12 mt-2 mb-2 overflow-auto border rounded p-3">
                    <table class="table auto-number-table" id="tabelEditRiwayatPersalinan">
                        <thead align="center">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Tgl/Tahun</th>
                                <th scope="col">Tempat Persalinan</th>
                                <th scope="col">Usia Hamil</th>
                                <th scope="col">Jenis Persalinan</th>
                                <th scope="col">Penolong</th>
                                <th scope="col">Penyulit</th>
                                <th scope="col">J.K</th>
                                <th scope="col">BB/PB</th>
                                <th scope="col">Keadaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persalinan as $key => $value)
                                <tr id='persalinan_{{$key}}'>
                                    <td><input readonly  type="text" hidden name="persalinan_table_{{$key}}" value='{{json_encode($value)}}'></td>
                                    <td>{{$value->tgl_thn}}</td>
                                    <td>{{$value->tempat_persalinan}}</td>
                                    <td>{{$value->usia_hamil}}</td>
                                    <td>{{$value->jenis_persalinan}}</td>
                                    <td>{{$value->penolong}}</td>
                                    <td>{{$value->penyulit}}</td>
                                    <td>{{$value->jk}}</td>
                                    <td>{{$value->bbpb}}</td>
                                    <td>{{$value->keadaan}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <label for="" class="form-label">Riwayat Hamil Sekarang</label>
        <div class="ms-2 row">
            <div class="col-3 mb-2">
                <label for="riwayat_hamil_hpht" class="form-label">HPHT :</label>
                <input readonly  type="text" class="form-control input-daterange input-date-time" name="riwayat_hamil_hpht" value="{{!empty($penilaian->riwayat_hamil_hpht) ? $penilaian->riwayat_hamil_hpht : ''}}" id="riwayat_hamil_hpht"  required autocomplete="off" >
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_hamil_usiahamil" class="form-label">Usia Hamil :</label>
                <div class="input-group">
                    <input readonly  type="text" name="riwayat_hamil_usiahamil" value="{{!empty($penilaian->riwayat_hamil_usiahamil) ? $penilaian->riwayat_hamil_usiahamil : ''}}" id="riwayat_hamil_usiahamil" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">bln/mgg</span>
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_hamil_tp" class="form-label">TP :</label>
                <input readonly  type="text" class="form-control input-daterange input-date-time" name="riwayat_hamil_tp" value="{{!empty($penilaian->riwayat_hamil_tp) ? $penilaian->riwayat_hamil_tp : ''}}" id="riwayat_hamil_tp"  required autocomplete="off" >
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_hamil_imunisasi" class="form-label">Riwayat Imunisasi : </label>
                <select disabled  class="form-select" id="riwayat_hamil_imunisasi" name="riwayat_hamil_tp" ariaimunisasi="Default select ">
                    @foreach (['Tidak Pernah','T I','TT II','TT III','TT IV'] as $item)
                        <option {{!empty($penilaian->riwayat_hamil_tp) ? ($penilaian->riwayat_hamil_tp === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select>
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_hamil_anc" class="form-label">ANC :</label>
                <div class="input-group">
                    <input readonly  type="text" name="riwayat_hamil_anc" value="{{!empty($penilaian->riwayat_hamil_anc) ? $penilaian->riwayat_hamil_anc : ''}}" id="riwayat_hamil_anc" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">X</span>
                </div>
            </div>

            <div class="col-3 mb-2">
                <label for="riwayat_hamil_anc_ke" class="form-label">Ke :</label>
                <div class="d-flex">
                    <input readonly   placeholder="Keterangan" type="text" id="riwayat_hamil_ancke" name="riwayat_hamil_ancke" value="{{!empty($penilaian->riwayat_hamil_ancke) ? $penilaian->riwayat_hamil_ancke : ''}}"   class="form-control">
                    <select disabled  class="form-select me-2" id="riwayat_hamil_ancke"  name="riwayat_hamil_ancke" aria-labe="Default select example">
                        @foreach(['Teratur','Tidak Teratur'] as $item)
                        <option {{!empty($penilaian->riwayat_hamil_ancke) ? ($penilaian->riwayat_hamil_ancke === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                </div>
            </div>

            <div class="col-3 mb-2">
                <label for="riwayat_hamil_keluhan_hamil_muda" class="form-label">Keluhan Hamil Muda : </label>
                <select disabled  class="form-select" id="riwayat_hamil_keluhan_hamil_muda" name="riwayat_hamil_keluhan_hamil_muda" aria-label="Default select ">
                    @foreach (['Tidak Ada','Mual','Muntah','Perdarahan','Lain–lain'] as $item)
                    <option {{!empty($penilaian->riwayat_hamil_keluhan_hamil_muda) ? ($penilaian->riwayat_hamil_keluhan_hamil_muda === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select>
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_hamil_keluhan_hamil_tua" class="form-label">Keluhan Hamil Tua : </label>
                <select disabled  class="form-select" id="riwayat_hamil_keluhan_hamil_tua" name="riwayat_hamil_keluhan_hamil_tua" aria-label="Default select ">
                    @foreach (['Tidak Ada','Mual','Muntah','Perdarahan','Lain–lain'] as $item)
                    <option {{!empty($penilaian->riwayat_hamil_keluhan_hamil_tua) ? ($penilaian->riwayat_hamil_keluhan_hamil_tua === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_kb" class="form-label">Riwayat Keluarga Bencana : </label>
                <div class="d-flex align-items-center">
                    <select disabled  class="form-select me-2" id="riwayat_kb"  name="riwayat_kb" aria-label="Default select example">
                        @foreach(['Belum Pernah','Suntik','Pil','AKDR','MOW'] as $item)
                        <option {{!empty($penilaian->riwayat_kb) ? ($penilaian->riwayat_kb === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                    <span class="mx-3">Lamanya</span>
                    <input readonly   placeholder="Keterangan" type="text" id="riwayat_kb_lamanya" name="riwayat_kb_lamanya" value="{{!empty($penilaian->riwayat_kb_lamanya) ? $penilaian->riwayat_kb_lamanya : ''}}"   class="form-control">
                </div>
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_kb_komplikasi" class="form-label">Komplikasi : </label>
                <div class="d-flex ">
                    <input readonly   placeholder="Keterangan" type="text" id="riwayat_kb_komplikasi" name="riwayat_kb_komplikasi" value="{{!empty($penilaian->riwayat_kb_komplikasi) ? $penilaian->riwayat_kb_komplikasi : ''}}"   class="form-control">
                    <select disabled  class="form-select w-75 me-2" id="riwayat_kb_ket_komplikasi"  name="riwayat_kb_ket_komplikasi" aria-label="Default select example">
                        @foreach(['Tidak Ada','Ada'] as $item)
                        <option {{!empty($penilaian->riwayat_kb_ket_komplikasi) ? ($penilaian->riwayat_kb_ket_komplikasi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                </div>
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_kb_kapaberhenti" class="form-label">Kapan Berhenti KB:</label>
                <input readonly id="riwayat_kb_kapaberhenti" name="riwayat_kb_kapaberhenti" value="{{!empty($penilaian->riwayat_kb_kapaberhenti) ? $penilaian->riwayat_kb_kapaberhenti : ''}}" type="text" class="form-control">
            </div>
            <div class="col-3 mb-2">
                <label for="riwayat_kb_alasanberhenti" class="form-label">Alasan:</label>
                <input readonly id="riwayat_kb_alasanberhenti" name="riwayat_kb_alasanberhenti" value="{{!empty($penilaian->riwayat_kb_alasanberhenti) ? $penilaian->riwayat_kb_alasanberhenti : ''}}" type="text" class="form-control">
            </div>
            <div class="col-6 mb-2">
                <label for="riwayat_genekologi" class="form-label">Riwayat Ginekologi : </label>
                <select disabled  class="form-select w-75 me-2" id="riwayat_genekologi"  name="riwayat_genekologi" aria-label="Default select example">
                    @foreach(['Tidak Ada','Infertilitas','Infeksi Virus','PMS','Cervisitis Kronis','Endometriosis','Mioma','Polip Cervix','Kanker Kandungan','Operasi Kandungan'] as $item)
                    <option {{!empty($penilaian->riwayat_genekologi) ? ($penilaian->riwayat_genekologi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>

        <label for="" class="form-label">Riwayat Kebiasaan</label>
        <div class="ms-2 row">
            <div class="col-12 mb-2">
                <label for="riwayat_kebiasaan_obat" class="form-label">Obat/Vitamin : </label>
                <div class="d-flex ">
                    <select disabled  class="form-select w-75 me-2" id="riwayat_kebiasaan_obat"  name="riwayat_kebiasaan_obat" aria-label="Default select example">
                        @foreach(['-','Obat Obatan','Vitamin','Jamu Jamuan'] as $item)
                            <option {{!empty($penilaian->riwayat_kebiasaan_obat) ? ($penilaian->riwayat_kebiasaan_obat === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                    <input readonly   placeholder="Keterangan" type="text" id="riwayat_kebiasaan_ket_obat" name="riwayat_kebiasaan_ket_obat" value="{{!empty($penilaian->riwayat_kebiasaan_ket_obat) ? $penilaian->riwayat_kebiasaan_ket_obat : ''}}""   class="form-control">
                </div>
            </div>

            <div class="col-4 mb-2">
                <label for="riwayat_kebiasaan_merokok" class="form-label">Merokok : </label>
                <div class="d-flex ">
                    <select disabled  class="form-select w-75 me-2" id="riwayat_kebiasaan_merokok"  name="riwayat_kebiasaan_merokok" aria-label="Default select example">
                        @foreach(['Tidak','Ya'] as $item)
                        <option {{!empty($penilaian->riwayat_kebiasaan_merokok) ? ($penilaian->riwayat_kebiasaan_merokok === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                    <div class="input-group">
                        <input readonly  type="text" name="riwayat_kebiasaan_ket_merokok" value="{{!empty($penilaian->riwayat_kebiasaan_ket_merokok) ? $penilaian->riwayat_kebiasaan_ket_merokok : ''}}" id="riwayat_kebiasaan_ket_merokok" class="form-control">
                        <span class="input-group-text" id="ModalPetugas">batang/hari</span>
                    </div>
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="riwayat_kebiasaan_alkohol" class="form-label">Alkohol : </label>
                <div class="d-flex ">
                    <select disabled  class="form-select me-2" id="riwayat_kebiasaan_alkohol"  name="riwayat_kebiasaan_alkohol" aria-label="Default select example">
                        @foreach(['Tidak','Ya'] as $item)
                        <option {{!empty($penilaian->riwayat_kebiasaan_alkohol) ? ($penilaian->riwayat_kebiasaan_alkohol === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                </div>
                <div class="input-group">
                    <input readonly  type="text" name="riwayat_kebiasaan_ket_alkohol" value="{{!empty($penilaian->riwayat_kebiasaan_ket_alkohol) ? $penilaian->riwayat_kebiasaan_ket_alkohol : ''}}" id="riwayat_kebiasaan_ket_merokok" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">batang/hari</span>
                </div>
            </div>
            <div class="col-4 mb-2">
                <label for="riwayat_kebiasaan_narkoba" class="form-label">Obat Tidur/Narkoba : </label>
                <div class="d-flex ">
                    <select disabled  class="form-select me-2" id="riwayat_kebiasaan_narkoba"  name="riwayat_kebiasaan_narkoba" aria-label="Default select example">
                        @foreach(['Tidak','Ya'] as $item)
                        <option {{!empty($penilaian->riwayat_kebiasaan_narkoba) ? ($penilaian->riwayat_kebiasaan_narkoba === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select> 
                </div>
            </div>
        </div>
    </div>
</div>


<hr class="mb-5">

<div>
    <h5 class="text-start">II. PEMERIKSAAN KEBIDANAN</h5>
    <div class="row align-items-end">
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_mental" class="form-label">Kesadaran Mental : </label>
            <input readonly  type="text" name="pemeriksaan_kebidanan_mental" value="{{!empty($penilaian->pemeriksaan_kebidanan_mental) ? $penilaian->pemeriksaan_kebidanan_mental : ''}}" id="pemeriksaan_kebidanan_mental" class="form-control">
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_keadaan_umum" class="form-label">keadaan Umum : </label>
            <select disabled  class="form-select" id="pemeriksaan_kebidanan_keadaan_umum" name="pemeriksaan_kebidanan_keadaan_umum" keadaan_umumaria-label="Default select ">
                
                @foreach (['Baik','Sedang','Buruk'] as $item)
                   <option {{!empty($penilaian->pemeriksaan_kebidanan_keadaan_umum) ? ($penilaian->pemeriksaan_kebidanan_keadaan_umum === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                @endforeach
            </select>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_td" class="form-label">TD : </label>
            <div class="input-group">
                <input readonly  type="text" name="pemeriksaan_kebidanan_td" value="{{!empty($penilaian->pemeriksaan_kebidanan_td) ? $penilaian->pemeriksaan_kebidanan_td : ''}}" id="pemeriksaan_kebidanan_td" class="form-control">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_nadi" name="pemeriksaan_kebidanan_nadi" value="{{!empty($penilaian->pemeriksaan_kebidanan_nadi) ? $penilaian->pemeriksaan_kebidanan_nadi : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_rr" class="form-label">rr : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_rr" name="pemeriksaan_kebidanan_rr" value="{{!empty($penilaian->pemeriksaan_kebidanan_rr) ? $penilaian->pemeriksaan_kebidanan_rr : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_suhu" name="pemeriksaan_kebidanan_suhu" value="{{!empty($penilaian->pemeriksaan_kebidanan_suhu) ? $penilaian->pemeriksaan_kebidanan_suhu : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>

        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_gcs" class="form-label">GCS(E, V, M) : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_gcs" name="pemeriksaan_kebidanan_gcs" value="{{!empty($penilaian->pemeriksaan_kebidanan_gcs) ? $penilaian->pemeriksaan_kebidanan_gcs : ''}}" class="form-control">
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_bb" class="form-label">BB : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_bb" name="pemeriksaan_kebidanan_bb" value="{{!empty($penilaian->pemeriksaan_kebidanan_bb) ? $penilaian->pemeriksaan_kebidanan_bb : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">Kg</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_tb" class="form-label">TB : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_tb" name="pemeriksaan_kebidanan_tb" value="{{!empty($penilaian->pemeriksaan_kebidanan_tb) ? $penilaian->pemeriksaan_kebidanan_tb : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_spo2" class="form-label">SpO2 : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_spo2" name="pemeriksaan_kebidanan_spo2" value="{{!empty($penilaian->pemeriksaan_kebidanan_spo2) ? $penilaian->pemeriksaan_kebidanan_spo2 : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">%</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_lila" class="form-label">LILA : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_lila" name="pemeriksaan_kebidanan_lila" value="{{!empty($penilaian->pemeriksaan_kebidanan_lila) ? $penilaian->pemeriksaan_kebidanan_lila : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_tfu" class="form-label">TFU : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_tfu" name="pemeriksaan_kebidanan_tfu" value="{{!empty($penilaian->pemeriksaan_kebidanan_tfu) ? $penilaian->pemeriksaan_kebidanan_tfu : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_tbj" class="form-label"> TBJ: </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_tbj" name="pemeriksaan_kebidanan_tbj" value="{{!empty($penilaian->pemeriksaan_kebidanan_tbj) ? $penilaian->pemeriksaan_kebidanan_tbj : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">gr</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="" class="form-label"> GD: </label>
            <input readonly  type="text" id="" name="" class="form-control" value="{{!empty($penilaian->class) ? $penilaian->class : ''}}">
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_letak" class="form-label"> Letak: </label>
            <input readonly  type="text" id="pemeriksaan_kebidanan_letak" name="pemeriksaan_kebidanan_letak" value="{{!empty($penilaian->pemeriksaan_kebidanan_letak) ? $penilaian->pemeriksaan_kebidanan_letak : ''}}" class="form-control">
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_presentasi" class="form-label"> Presentasi: </label>
            <input readonly  type="text" id="pemeriksaan_kebidanan_presentasi" name="pemeriksaan_kebidanan_presentasi" value="{{!empty($penilaian->pemeriksaan_kebidanan_presentasi) ? $penilaian->pemeriksaan_kebidanan_presentasi : ''}}" class="form-control">
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_penurunan" class="form-label"> Penurunan: </label>
            <input readonly  type="text" id="pemeriksaan_kebidanan_penurunan" name="pemeriksaan_kebidanan_penurunan" value="{{!empty($penilaian->pemeriksaan_kebidanan_penurunan) ? $penilaian->pemeriksaan_kebidanan_penurunan : ''}}" class="form-control">
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_his" class="form-label"> Kontraksi/HIS: </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_his" name="pemeriksaan_kebidanan_his" value="{{!empty($penilaian->pemeriksaan_kebidanan_his) ? $penilaian->pemeriksaan_kebidanan_his : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x/10</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_kekuatan" class="form-label"> Kekuatan: </label>
            <input readonly  type="text" id="pemeriksaan_kebidanan_kekuatan" name="pemeriksaan_kebidanan_kekuatan" value="{{!empty($penilaian->pemeriksaan_kebidanan_kekuatan) ? $penilaian->pemeriksaan_kebidanan_kekuatan : ''}}" class="form-control">
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_lamanya" class="form-label"> Lamanya: </label>
            <input readonly  type="text" id="pemeriksaan_kebidanan_lamanya" name="pemeriksaan_kebidanan_lamanya" value="{{!empty($penilaian->pemeriksaan_kebidanan_lamanya) ? $penilaian->pemeriksaan_kebidanan_lamanya : ''}}" class="form-control">
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_kebidanan_djj" class="form-label"> Gerak janin x/30 menit, DJJ: </label>
            <div class="d-flex">
                <div class="input-group">
                    <input readonly  type="text" id="pemeriksaan_kebidanan_djj" name="pemeriksaan_kebidanan_djj" value="{{!empty($penilaian->pemeriksaan_kebidanan_djj) ? $penilaian->pemeriksaan_kebidanan_djj : ''}}" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">/mnt</span>
                </div>
                <select disabled  class="form-select mx-2" id=""  name="" aria-label="Default select example">
                    @foreach (['Teratur','Tidak Teratur'] as $item)
                       <option {{!empty($penilaian->aria) ? ($penilaian->aria === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_portio" class="form-label"> Portio: </label>
            <input readonly  type="text" id="pemeriksaan_kebidanan_portio" name="pemeriksaan_kebidanan_portio" value="{{!empty($penilaian->pemeriksaan_kebidanan_portio) ? $penilaian->pemeriksaan_kebidanan_portio : ''}}" class="form-control">
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_pembukaan" class="form-label"> Pembukaan Serviks : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_pembukaan" name="pemeriksaan_kebidanan_pembukaan" value="{{!empty($penilaian->pemeriksaan_kebidanan_pembukaan) ? $penilaian->pemeriksaan_kebidanan_pembukaan : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">cm</span>
            </div>
        </div>
        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_ketuban" class="form-label"> Ketuban : </label>
            <div class="input-group">
                <input readonly  type="text" id="pemeriksaan_kebidanan_ketuban" name="pemeriksaan_kebidanan_ketuban" value="{{!empty($penilaian->pemeriksaan_kebidanan_ketuban) ? $penilaian->pemeriksaan_kebidanan_ketuban : ''}}" class="form-control">
                <span class="input-group-text" id="ModalPetugas">kep/bok</span>
            </div>
        </div>

        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_hodge" class="form-label"> Hodge: </label>
            <input readonly  type="text" id="pemeriksaan_kebidanan_hodge" name="pemeriksaan_kebidanan_hodge" value="{{!empty($penilaian->pemeriksaan_kebidanan_hodge) ? $penilaian->pemeriksaan_kebidanan_hodge : ''}}" class="form-control">
        </div>

        <div class="col-3 mb-2">
            <label for="pemeriksaan_kebidanan_panggul" class="form-label"> Panggul: </label>
            <select disabled  class="form-select me-2" id="pemeriksaan_kebidanan_panggul"  name="pemeriksaan_kebidanan_panggul" aria-label="Default select example">
                @foreach (['Dilakukan','Tidak'] as $item)
                    <option {{!empty($penilaian->pemeriksaan_kebidanan_panggul) ? ($penilaian->pemeriksaan_kebidanan_panggul === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                @endforeach
            </select> 
        </div>

        <div class="col-6 mb-2">
            <label for="pemeriksaan_kebidanan_inspekulo" class="form-label"> Inspekulo: </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_kebidanan_inspekulo"  name="pemeriksaan_kebidanan_inspekulo" aria-label="Default select example">
                    @foreach (['Dilakukan','Tidak'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_kebidanan_inspekulo) ? ($penilaian->pemeriksaan_kebidanan_inspekulo === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  type="text" id="pemeriksaan_kebidanan_ket_inspekulo" name="pemeriksaan_kebidanan_ket_inspekulo" value="{{!empty($penilaian->pemeriksaan_kebidanan_ket_inspekulo) ? $penilaian->pemeriksaan_kebidanan_ket_inspekulo : ''}}" class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="pemeriksaan_kebidanan_lakmus" class="form-label"> Lakmus: </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_kebidanan_lakmus"  name="pemeriksaan_kebidanan_lakmus" aria-label="Default select example">
                    @foreach (['Dilakukan','Tidak'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_kebidanan_lakmus) ? ($penilaian->pemeriksaan_kebidanan_lakmus === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  type="text" id="pemeriksaan_kebidanan_ket_lakmus" name="pemeriksaan_kebidanan_ket_lakmus" value="{{!empty($penilaian->pemeriksaan_kebidanan_ket_lakmus) ? $penilaian->pemeriksaan_kebidanan_ket_lakmus : ''}}" class="form-control">
            </div>
        </div>

        <div class="col-6 mb-2">
            <label for="pemeriksaan_kebidanan_ctg" class="form-label"> CTG: </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_kebidanan_ctg"  name="pemeriksaan_kebidanan_ctg" aria-label="Default select example">
                    @foreach (['Dilakukan','Tidak'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_kebidanan_ctg) ? ($penilaian->pemeriksaan_kebidanan_ctg === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly  type="text" id="pemeriksaan_kebidanan_ket_ctg" name="pemeriksaan_kebidanan_ket_ctg" value="{{!empty($penilaian->pemeriksaan_kebidanan_ket_ctg) ? $penilaian->pemeriksaan_kebidanan_ket_ctg : ''}}" class="form-control">
            </div>
        </div>

    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">III. PEMERIKSAAN UMUM</h5>
    <div class="row">
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_kepala" class="form-label">Kepala  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_kepala"  name="pemeriksaan_umum_kepala" aria-label="Default select example">
                    @foreach (['Normocephale','Hydrocephalus','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_kepala) ? ($penilaian->pemeriksaan_umum_kepala === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_muka" class="form-label">Muka  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_muka"  name="pemeriksaan_umum_muka" aria-label="Default select example">
                    @foreach (['Normal','Pucat','Oedem','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_muka) ? ($penilaian->pemeriksaan_umum_muka === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_mata" class="form-label">Mata  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_mata"  name="pemeriksaan_umum_mata" aria-label="Default select example">
                    @foreach (['Conjungtiva Merah Muda','Conjungtiva Pucat','Sklera Ikterik','Pandangan Kabur','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_mata) ? ($penilaian->pemeriksaan_umum_mata === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_hidung" class="form-label">Hidung  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_hidung"  name="pemeriksaan_umum_hidung" aria-label="Default select example">
                    @foreach (['Normal','Sekret','Polip','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_hidung) ? ($penilaian->pemeriksaan_umum_hidung === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_telinga" class="form-label">Telinga  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_telinga"  name="pemeriksaan_umum_telinga" aria-label="Default select example">
                    @foreach (['Bersih','Serumen','Polip','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_telinga) ? ($penilaian->pemeriksaan_umum_telinga === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_mulut" class="form-label">Mulut  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_mulut"  name="pemeriksaan_umum_mulut" aria-label="Default select example">
                    @foreach (['Bersih','Kotor','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_mulut) ? ($penilaian->pemeriksaan_umum_mulut === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_leher" class="form-label">Leher  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_leher"  name="pemeriksaan_umum_leher" aria-label="Default select example">
                    @foreach (['Normal','Pembesaran KGB','Pembesaran Kelenjar Tiroid','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_leher) ? ($penilaian->pemeriksaan_umum_leher === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_dada" class="form-label">Dada  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_dada"  name="pemeriksaan_umum_dada" aria-label="Default select example">
                    @foreach (['Mamae Simetris','Mamae Asimetris','Aerola Hiperpigmentasi','Kolustrum (+)','Tumor','Puting Susu Menonjol'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_dada) ? ($penilaian->pemeriksaan_umum_dada === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_perut" class="form-label">Perut  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_perut"  name="pemeriksaan_umum_perut" aria-label="Default select example">
                    @foreach (['Luka Bekas Operasi','Nyeri Tekan (Ya)','Nyeri Tekan (Tidak)','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_perut) ? ($penilaian->pemeriksaan_umum_perut === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_genitalia" class="form-label">Genitalia  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_genitalia"  name="pemeriksaan_umum_genitalia" aria-label="Default select example">
                    @foreach (['Bersih','Kotor','Varises','Oedem','Hematoma','Hemoroid','Lain-lain'] as $item)
                       <option {{!empty($penilaipemeriksaan_kebidanan_panggulan->pemeriksaan_umum_genitalia) ? ($penilaian->pemeriksaan_umum_genitalia === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="pemeriksaan_umum_ekstrimitas" class="form-label">Ekstremitas  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pemeriksaan_umum_ekstrimitas"  name="pemeriksaan_umum_ekstrimitas" aria-label="Default select example">
                    @foreach (['Normal','Oedem','Refleks Patella Ada','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pemeriksaan_umum_ekstrimitas) ? ($penilaian->pemeriksaan_umum_ekstrimitas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
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
            <label for="pengkajian_fungsi_kemampuan_aktifitas" class="form-label">a. Kemampuan Aktifitas Sehari-hari : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pengkajian_fungsi_kemampuan_aktifitas"  name="pengkajian_fungsi_kemampuan_aktifitas" aria-label="Default select example">
                    
                    @foreach(['Mandiri','Bantuan Minimal','Bantuann Sebagian','Ketergantungan Total'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_kemampuan_aktifitas) ? ($penilaian->pengkajian_fungsi_kemampuan_aktifitas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_berjalan" class="form-label">b. Berjalan : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pengkajian_fungsi_berjalan"  name="pengkajian_fungsi_berjalan" aria-label="Default select example">
                    
                    @foreach(['TAK','Penurunan Kekuatan/ROM','Paralisis','Sering Jatuh','Deformitas','Hilang Keseimbangan','Riwayat Patah Tulang','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_berjalan) ? ($penilaian->pengkajian_fungsi_berjalan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly   placeholder="Keterangan" type="text" id="pengkajian_fungsi_ket_berjalan" name="pengkajian_fungsi_ket_berjalan" value="{{!empty($penilaian->pengkajian_fungsi_ket_berjalan) ? $penilaian->pengkajian_fungsi_ket_berjalan : ''}}"   class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_aktivitas" class="form-label">c. Aktivitas : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pengkajian_fungsi_aktivitas"  name="pengkajian_fungsi_aktivitas" aria-label="Default select example">
                    
                    @foreach(['Tirah Baring','Duduk','Berjalan'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_aktivitas) ? ($penilaian->pengkajian_fungsi_aktivitas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_ambulasi" class="form-label">d. Alat Ambulansi : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pengkajian_fungsi_ambulasi"  name="pengkajian_fungsi_ambulasi" aria-label="Default select example">
                    
                    @foreach(['Walker','Tongkat','Kursi Roda','Tidak Menggunakan'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_ambulasi) ? ($penilaian->pengkajian_fungsi_ambulasi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_ekstrimitas_atas" class="form-label">e. ekstrimitas Atas : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pengkajian_fungsi_ekstrimitas_atas"  name="pengkajian_fungsi_ekstrimitas_atas" aria-label="Default select example">
                    
                    @foreach(['TAK','Lemah','Oedema','Tidak Simetris','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_ekstrimitas_atas) ? ($penilaian->pengkajian_fungsi_ekstrimitas_atas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly   placeholder="Keterangan" type="text" id="pengkajian_fungsi_ket_ekstrimitas_atas" name="pengkajian_fungsi_ket_ekstrimitas_atas" value="{{!empty($penilaian->pengkajian_fungsi_ket_ekstrimitas_atas) ? $penilaian->pengkajian_fungsi_ket_ekstrimitas_atas : ''}}"   class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_ekstrimitas_bawah" class="form-label">f. ekstrimitas Bawah : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pengkajian_fungsi_ekstrimitas_bawah"  name="pengkajian_fungsi_ekstrimitas_bawah" aria-label="Default select example">
                    
                    @foreach(['TAK','Varises','Oedema','Tidak Simetris','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_ekstrimitas_bawah) ? ($penilaian->pengkajian_fungsi_ekstrimitas_bawah === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly   placeholder="Keterangan" type="text" id="pengkajian_fungsi_ket_ekstrimitas_bawah" name="pengkajian_fungsi_ket_ekstrimitas_bawah" value="{{!empty($penilaian->pengkajian_fungsi_ket_ekstrimitas_bawah) ? $penilaian->pengkajian_fungsi_ket_ekstrimitas_bawah : ''}}"   class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_kemampuan_menggenggam" class="form-label">g. Kemampuan Menggenggam : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pengkajian_fungsi_kemampuan_menggenggam"  name="pengkajian_fungsi_kemampuan_menggenggam" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada Kesulitan','Terakhir','Lain-lain'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_kemampuan_menggenggam) ? ($penilaian->pengkajian_fungsi_kemampuan_menggenggam === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly   placeholder="Keterangan" type="text" id="pengkajian_fungsi_ket_kemampuan_menggenggam" name="pengkajian_fungsi_ket_kemampuan_menggenggam" value="{{!empty($penilaian->pengkajian_fungsi_ket_kemampuan_menggenggam) ? $penilaian->pengkajian_fungsi_ket_kemampuan_menggenggam : ''}}"   class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_koordinasi" class="form-label">h. Kemampuan Koordinasi : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pengkajian_fungsi_koordinasi"  name="pengkajian_fungsi_koordinasi" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada Kesulitan','Ada Masalah'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_koordinasi) ? ($penilaian->pengkajian_fungsi_koordinasi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly   placeholder="Keterangan" type="text" id="pengkajian_fungsi_ket_koordinasi" name="pengkajian_fungsi_ket_koordinasi" value="{{!empty($penilaian->pengkajian_fungsi_ket_koordinasi) ? $penilaian->pengkajian_fungsi_ket_koordinasi : ''}}"   class="form-control">
            </div>
        </div>
       <div class="col-6 mb-2">
            <label for="pengkajian_fungsi_gangguan_fungsi" class="form-label">i. Kesimpulan Gangguan Fungsi : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="pengkajian_fungsi_gangguan_fungsi"  name="pengkajian_fungsi_gangguan_fungsi" aria-label="Default select example">
                    
                    @foreach(['Ya (Co DPJP)','Tidak (Tidak Perlu Co DPJP)'] as $item)
                       <option {{!empty($penilaian->pengkajian_fungsi_gangguan_fungsi) ? ($penilaian->pengkajian_fungsi_gangguan_fungsi === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
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
            <label for="riwayat_psiko_kondisipsiko" class="form-label">a. Kondisi Psikologis : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="riwayat_psiko_kondisipsiko"  name="riwayat_psiko_kondisipsiko" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada Masalah','Marah','Takut','Depresi','Cepat Lelah','Cemas','Gelisah','Sulit Tidur','Lain-lain'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_kondisipsiko) ? ($penilaian->riwayat_psiko_kondisipsiko === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_adakah_prilaku" class="form-label">b. Adakah Prilaku : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="riwayat_psiko_adakah_prilaku"  name="riwayat_psiko_adakah_prilaku" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada Masalah','Prilaku Kekerasan','Gangguan Efek','Gangguan Memori','Halusinasi','Kecenderungan Percobaan Bunuh Diri','Lain-lain'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_adakah_prilaku) ? ($penilaian->riwayat_psiko_adakah_prilaku === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly   placeholder="Keterangan" type="text" id="riwayat_psiko_ket_adakah_prilaku" name="riwayat_psiko_ket_adakah_prilaku" value="{{!empty($penilaian->riwayat_psiko_ket_adakah_perilaku) ? $penilaian->riwayat_psiko_ket_adakah_perilaku : ''}}"   class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_gangguan_jiwa" class="form-label">c. Gangguan Jiwa di Masa Lalu  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="riwayat_psiko_gangguan_jiwa"  name="riwayat_psiko_gangguan_jiwa" aria-label="Default select example">
                    
                    @foreach(['Ya','Tidak'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_gangguan_jiwa) ? ($penilaian->riwayat_psiko_gangguan_jiwa === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_hubungan_pasien" class="form-label">d. Hubungan Pasien dengan Anggota Keluarga : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="riwayat_psiko_hubungan_pasien"  name="riwayat_psiko_hubungan_pasien" aria-label="Default select example">
                    
                    @foreach(['Harmonis','Kurang Harmonis','Tidak Harmonis','Konflik Besar'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_hubungan_pasien) ? ($penilaian->riwayat_psiko_hubungan_pasien === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="" class="form-label">e. Agama : </label>
            <input readonly   placeholder="Keterangan" type="text" id="" name=""   class="form-control" value="{{!empty($penilaian->class) ? $penilaian->class : ''}}">
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_tinggal_dengan" class="form-label">f. Tinggal Dengan  : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="riwayat_psiko_tinggal_dengan"  name="riwayat_psiko_tinggal_dengan" aria-label="Default select example">
                    
                    @foreach(['Sendiri','Orang Tua','Suami/Istri','Keluarga','Lain-lain'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_tinggal_dengan) ? ($penilaian->riwayat_psiko_tinggal_dengan === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly   placeholder="Keterangan" type="text" id="riwayat_psiko_ket_tinggal_dengan" name="riwayat_psiko_ket_tinggal_dengan" value="{{!empty($penilaian->riwayat_psiko_ket_tinggal_dengan) ? $penilaian->riwayat_psiko_ket_tinggal_dengan : ''}}"   class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="" class="form-label">g. Pekerjaan : </label>
            <input readonly   placeholder="Keterangan" type="text" id="" class="form-control">
        </div>
        <div class="col-6 mb-2">
            <label for="" class="form-label">h. Pembayaran : </label>
            <input readonly   placeholder="Keterangan" type="text" id="" name=""   class="form-control" value="{{!empty($penilaian->class) ? $penilaian->class : ''}}">
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_budaya" class="form-label">i. Nilai-nila Kepercayaan/Budaya Yang Perlu Diperhatikan : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="riwayat_psiko_budaya"  name="riwayat_psiko_budaya" aria-label="Default select example">
                    
                    @foreach(['Tidak Ada','Ada'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_budaya) ? ($penilaian->riwayat_psiko_budaya === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly   placeholder="Keterangan" type="text" id="riwayat_psiko_ket_tinggal_dengan" name="riwayat_psiko_ket_tinggal_dengan" value="{{!empty($penilaian->riwayat_psiko_ket_tinggal_dengan) ? $penilaian->riwayat_psiko_ket_tinggal_dengan : ''}}"   class="form-control">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="" class="form-label">j. Bahasa Sehari-hari : </label>
            <input readonly   placeholder="Keterangan" type="text" id="" name=""   class="form-control" value="{{!empty($penilaian->class) ? $penilaian->class : ''}}">
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko" class="form-label">k. Pendidikan Pasien : </label>
            <input readonly   placeholder="Keterangan" type="text" id="" name=""   class="form-control" value="{{!empty($penilaian->class) ? $penilaian->class : ''}}">
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_pend_pj" class="form-label">l Pendidikan P.J : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="riwayat_psiko_pend_pj"  name="riwayat_psiko_pend_pj" aria-label="Default select example">
                    
                    @foreach(['-','TS','TK','SD','SMP','SMA','SLTA/SEDERAJAT','D1','D2','D3','D4','S1','S2','S3'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_pend_pj) ? ($penilaian->riwayat_psiko_pend_pj === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="riwayat_psiko_edukasi_pada" class="form-label">m. Eukasi Diberikan Kepada : </label>
            <div class="d-flex">
                <select disabled  class="form-select me-2" id="riwayat_psiko_edukasi_pada"  name="riwayat_psiko_edukasi_pada" aria-label="Default select example">
                    
                    @foreach(['Pasien','Keluarga'] as $item)
                    <option {{!empty($penilaian->riwayat_psiko_edukasi_pada) ? ($penilaian->riwayat_psiko_edukasi_pada === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                    @endforeach
                </select> 
                <input readonly   placeholder="Keterangan" type="text" id="riwayat_psiko_ket_edukasi_pada" name="riwayat_psiko_ket_edukasi_pada" value="{{!empty($penilaian->riwayat_psiko_ket_edukasi_pada) ? $penilaian->riwayat_psiko_ket_edukasi_pada : ''}}"   class="form-control">
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
                    <label for="penilaian_nyeri_hilang" class="form-label">Rasa Nyeri:</label>
                    <select disabled  class="form-select"  id="penilaian_nyeri_hilang"  name="penilaian_nyeri_hilang" aria-label="Default select example">
                        @foreach (['Tidak Ada Nyeri', 'Nyeri Akut', 'Nyeri Kronis'] as $item)
                           <option {{!empty($penilaian->penilaian_nyeri_hilang) ? ($penilaian->penilaian_nyeri_hilang === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="col-8">
                    <label for="penilaian_nyeri_penyebab" class="form-label">Penyebab</label>
                    <div class="d-flex">
                        <select disabled  id="penilaian_nyeri_penyebab"  name="penilaian_nyeri_penyebab" class="form-select me-2" aria-label="Default select example">
                            @foreach (['Proses Penyakit', 'Benturan', 'Lain-lain'] as $item)
                            <option {{!empty($penilaian->penilaian_nyeri_penyebab) ? ($penilaian->penilaian_nyeri_penyebab === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                            @endforeach
                        </select>
                        <input readonly  type="text" class=" form-control" name="penilaian_nyeri_ket_penyebab" value="{{!empty($penilaian->penilaian_nyeri_ket_penyebab) ? $penilaian->penilaian_nyeri_ket_penyebab : ''}}" id="penilaian_nyeri_ket_penyebab" placeholder="Keterangan" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="penilaian_nyeri_kualitas" class="form-label">Kualitas:</label>
                    <div class="d-flex">
                        <select disabled  class="w-25 me-2 form-select" id="penilaian_nyeri_kualitas"  name="penilaian_nyeri_kualitas" aria-label="Default select example">
                            @foreach (['Seperti Tertusuk','Berdenyut','Teriris','Tertindih','Tertiban','Lain-lain'] as $item)
                            <option {{!empty($penilaian->penilaian_nyeri_kualitas) ? ($penilaian->penilaian_nyeri_kualitas === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                            @endforeach
                        </select>
                        <input readonly  type="text" class="w-75 form-control" name="penilaian_nyeri_ket_kualitas" value="{{!empty($penilaian->penilaian_nyeri_ket_kualitas) ? $penilaian->penilaian_nyeri_ket_kualitas : ''}}" id="penilaian_nyeri_ket_kualitas"  placeholder="Keterangan" >
                    </div>
                </div>
            </div>

            <div class="row">
                <label for="" class="form-label">Wilayah:</label>
                <div class="col ms-4">
                    <label for="penilaian_nyeri_lokasi" class="form-label">Lokasi:</label>
                    <input readonly  type="text" id="penilaian_nyeri_lokasi"  name="penilaian_nyeri_lokasi" value="{{!empty($penilaian->penilaian_nyeri_lokasi) ? $penilaian->penilaian_nyeri_lokasi : ''}}" class=" form-control"   placeholder="Nilai" >
                </div>
                <div class="col">
                    <label for="penilaian_nyeri_menyebar" class="form-label">Menyebar:</label>
                    <select disabled  class=" form-select"  id="penilaian_nyeri_menyebar"  name="penilaian_nyeri_menyebar" aria-label="Default select example">
                            @foreach (['Tidak','Ya'] as $item)
                            <option {{!empty($penilaian->penilaian_nyeri_menyebar) ? ($penilaian->penilaian_nyeri_menyebar === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <label for="" class="form-label">Severity:</label>                
                <div class="col ms-4    ">
                    <label for="penilaian_nyeri_skala" class="form-label">Skala Nyeri:</label>
                    <select disabled  class=" form-select" id="penilaian_nyeri_skala"  name="penilaian_nyeri_skala" aria-label="Default select example">
                    
                        @for($i=0; $i <=10 ;$i++)
                            <option value="{{$i}}" >{{$i}}</option>
                        @endfor
                    </select>
                </div>

                <div class="col ">
                    <label for="penilaian_nyeri_waktu" class="form-label">Waktu / Durasi:</label>
                    <div class="input-group">
                        <input readonly  type="text" class="form-control" id="penilaian_nyeri_waktu"  name="penilaian_nyeri_waktu" value="{{!empty($penilaian->penilaian_nyeri_waktu) ? $penilaian->penilaian_nyeri_waktu : ''}}">
                        <span class="input-group-text" >Menit</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label for="penilaian_nyeri_hilang" class="form-label">Nyeri Hilang Bila:</label>
                    <div class="d-flex">
                        <select disabled  class="form-select me-2" id="penilaian_nyeri_hilang"  name="penilaian_nyeri_hilang" aria-label="Default select example">
                            @foreach (['Istirahat','Medengar Musik','Minum Obat'] as $item)
                                <option {{!empty($penilaian->penilaian_nyeri_hilang) ? ($penilaian->penilaian_nyeri_hilang === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                            @endforeach
                        </select>
                        <input readonly  type="text" class=" form-control" name="penilaian_nyeri_ket_hilang" value="{{!empty($penilaian->penilaian_nyeri_ket_hilang) ? $penilaian->penilaian_nyeri_ket_hilang : ''}}" id="penilaian_nyeri_ket_hilang" placeholder="Nilai" >
                    </div>
                </div>
                <div class="col-8">
                    <label for="penilaian_nyeri_diberitahukan_dokter" class="form-label">Diberitahukan Kepada Dokter ?</label>
                    <div class="row">
                        <div class="col-4">
                            <select disabled  class=" form-select" id="penilaian_nyeri_diberitahukan_dokter"  name="penilaian_nyeri_diberitahukan_dokter" aria-label="Default select example">
                                @foreach (['Tidak','Ya'] as $item)
                                    <option {{!empty($penilaian->penilaian_nyeri_diberitahukan_dokter) ? ($penilaian->penilaian_nyeri_diberitahukan_dokter === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option> 
                                @endforeach
                            </select>
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <label for="ket_dokter" class="form-label m-0 me-2">Jam:</label>
                            <input readonly  type="text" name="penilaian_nyeri_jam_diberitahukan_dokter" value="{{!empty($penilaian->penilaian_nyeri_jam_diberitahukan_dokter) ? $penilaian->penilaian_nyeri_jam_diberitahukan_dokter : ''}}" id="penilaian_nyeri_jam_diberitahukan_dokter" class="form-control">
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
            <label for="penilaian_jatuh_skala1" class="form-label m-0 mx-3">Skala:</label>
            <select disabled  class="w-75 form-select" id="penilaian_jatuh_skala1"  name="penilaian_jatuh_skala1" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuh_skala1) ? ($penilaian->penilaian_jatuh_skala1 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuh_nilai1" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly  type="number" name="penilaian_jatuh_nilai1" value="{{!empty($penilaian->penilaian_jatuh_nilai1) ? $penilaian->penilaian_jatuh_nilai1 : ''}}" id="penilaian_jatuh_nilai1" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">2. Diagnosis Sekunder (&GreaterEqual; 2 Diagnose Medis)</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuh_skala2" class="form-label m-0 mx-3">Skala:</label>
            <select disabled  class="w-75 form-select" id="penilaian_jatuh_skala2"  name="penilaian_jatuh_skala2" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuh_skala2) ? ($penilaian->penilaian_jatuh_skala2 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuh_nilai2" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly  type="number" name="penilaian_jatuh_nilai2" value="{{!empty($penilaian->penilaian_jatuh_nilai2) ? $penilaian->penilaian_jatuh_nilai2 : ''}}" id="penilaian_jatuh_nilai2" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">3. Alat Bantu</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuh_skala3" class="form-label m-0 mx-3">Skala:</label>
            <select disabled  class="w-75 form-select" id="penilaian_jatuh_skala3"  name="penilaian_jatuh_skala3" aria-label="Default select example">
                
                @foreach (['Tidak Ada/Kursi Roda/Perawat/Tirah Baring','Tongkat/Alat Penopang','Berpegangan Pada Perabot'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuh_skala3) ? ($penilaian->penilaian_jatuh_skala3 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuh_nilai3" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly  type="number" name="penilaian_jatuh_nilai3" value="{{!empty($penilaian->penilaian_jatuh_nilai3) ? $penilaian->penilaian_jatuh_nilai3 : ''}}" id="penilaian_jatuh_nilai3" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">4. Terpasang Infuse</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuh_skala4" class="form-label m-0 mx-3">Skala:</label>
            <select disabled  class="w-75 form-select" id="penilaian_jatuh_skala4"  name="penilaian_jatuh_skala4" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuh_skala4) ? ($penilaian->penilaian_jatuh_skala4 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuh_nilai4" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly  type="number" name="penilaian_jatuh_nilai4" value="{{!empty($penilaian->penilaian_jatuh_nilai4) ? $penilaian->penilaian_jatuh_nilai4 : ''}}" id="penilaian_jatuh_nilai4" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">5. Gaya Berjalan</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuh_skala5" class="form-label m-0 mx-3">Skala:</label>
            <select disabled  class="w-75 form-select" id="penilaian_jatuh_skala5"  name="penilaian_jatuh_skala5" aria-label="Default select example">
                
                @foreach (['Normal/Tirah Baring/Imobilisasi','Lemah','Terganggu'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuh_skala5) ? ($penilaian->penilaian_jatuh_skala5 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuh_nilai5" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly  type="number" name="penilaian_jatuh_nilai5" value="{{!empty($penilaian->penilaian_jatuh_nilai5) ? $penilaian->penilaian_jatuh_nilai5 : ''}}" id="penilaian_jatuh_nilai5" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">6. Status Mental</span>
        <div class="d-flex w-50 align-items-center">
            <label for="penilaian_jatuh_skala6" class="form-label m-0 mx-3">Skala:</label>
            <select disabled  class="w-75 form-select" id="penilaian_jatuh_skala6"  name="penilaian_jatuh_skala6" aria-label="Default select example">
                
                @foreach (['Sadar Akan Kemampuan Diri Sendiri','Sering Lupa Akan Keterbatasan Yang Dimiliki'] as $item)
                    <option {{!empty($penilaian->penilaian_jatuh_skala6) ? ($penilaian->penilaian_jatuh_skala6 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="penilaian_jatuh_nilai6" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly  type="number" name="penilaian_jatuh_nilai6" value="{{!empty($penilaian->penilaian_jatuh_nilai6) ? $penilaian->penilaian_jatuh_nilai6 : ''}}" id="penilaian_jatuh_nilai6" class="w-25 form-control">
        </div>
    </div>
    <div class="ms-5  d-flex align-items-center justify-content-between mb-4">
        <span class="">Tingkat resiko: Risiko Rendah (0-24), Tindakan : Intervensi pencegahan risiko jatuh standar</span>
        <div class="d-flex w-50 align-items-center justify-content-end">
        
            <label for="penilaian_jatuh_totalnilai" class="form-label m-0 mx-3">Total:</label>
            <input readonly  type="number" name="penilaian_jatuh_totalnilai" value="{{!empty($penilaian->penilaian_jatuh_totalnilai) ? $penilaian->penilaian_jatuh_totalnilai : ''}}" id="penilaian_jatuh_totalnilai" class="w-25 form-control">
        </div>
    </div>
    
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">VIII. SKRINNING GIZI</h5>

    <div class=" d-flex align-items-center justify-content-between mb-4">
        <span class="">1. Apakah ada penurunan BB yang tidak diinginkan selama 6 bulan terakhir?</span>
        <div class="d-flex w-50 align-items-center">
            <label for="skrining_gizi1" class="form-label m-0 mx-3">Skala:</label>
            <select disabled  class="w-75 form-select" id="skrining_gizi1"  name="skrining_gizi1" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->skrining_gizi1) ? ($penilaian->skrining_gizi1 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="nilai_gizi1" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly  type="number" name="nilai_gizi1" value="{{!empty($penilaian->nilai_gizi1) ? $penilaian->nilai_gizi1 : ''}}" id="nilai_gizi1" class="w-25 form-control">
        </div>
    </div>
    <div class="form-control d-flex align-items-center justify-content-between mb-4">
        <span class="">2. Apakah asupan makan berkurang karena tidak nafsu makan ? </span>
        <div class="d-flex w-50 align-items-center">
            <label for="skrining_gizi1" class="form-label m-0 mx-3">Skala:</label>
            <select disabled  class="w-75 form-select" id="skrining_gizi1"  name="skrining_gizi1" aria-label="Default select example">
                
                @foreach (['Tidak','Ya'] as $item)
                    <option {{!empty($penilaian->skrining_gizi1) ? ($penilaian->skrining_gizi1 === $item ? 'selected' : '') : ''}} value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        
            <label for="nilai_gizi1" class="form-label m-0 mx-3">Nilai:</label>
            <input readonly  type="number" name="nilai_gizi1" value="{{!empty($penilaian->nilai_gizi1) ? $penilaian->nilai_gizi1 : ''}}" id="nilai_gizi1" class="w-25 form-control">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="skrining_gizi_diagnosa_khusus" class="form-label">Pasien dengan diagnosis khusus:</label>
            <div class="d-flex">
                <select disabled  class="w-25 me-2 form-select" id="skrining_gizi_diagnosa_khusus"  name="skrining_gizi_diagnosa_khusus" aria-label="Default select example">
                    
                    @foreach (['Tidak', 'Ya'] as $item)
                        <option {{!empty($penilaian->skrining_gizi_diagnosa_khusus) ? ($penilaian->skrining_gizi_diagnosa_khusus === $item ? 'selected' : '') : ''}} value="{{$item}}" >{{$item}}</option>
                    @endforeach
                </select>
                <input readonly  type="text" class="w-75 form-control" name="skrining_gizi_ket_diagnosa_khusus" value="{{!empty($penilaian->skrining_gizi_ket_diagnosa_khusus) ? $penilaian->skrining_gizi_ket_diagnosa_khusus : ''}}" id="skrining_gizi_ket_diagnosa_khusus"  placeholder="Keterangan" >
            </div>
        </div>
        <div class="col">
            <label for="skrining_gizi_diketahui_dietisen" class="form-label">Sudah dibaca dan diketahui oleh Dietisen:</label>
            <div class="d-flex align-items-end">
                <select disabled  class="w-25 me-2 form-select" id="skrining_gizi_diketahui_dietisen"  name="skrining_gizi_diketahui_dietisen" aria-label="Default select example">
                    
                    @foreach (['Tidak', 'Ya'] as $item)
                        <option {{!empty($penilaian->skrining_gizi_diketahui_dietisen) ? ($penilaian->skrining_gizi_diketahui_dietisen === $item ? 'selected' : '') : ''}} value="{{$item}}" >{{$item}}</option>
                    @endforeach
                </select>
                    <label for="skrining_gizi_jam_diketahui_dietisen" class="form-label mx-3">Jam</label>
                    <input readonly  type="text" class="w-75 form-control" name="skrining_gizi_jam_diketahui_dietisen" value="{{!empty($penilaian->skrining_gizi_jam_diketahui_dietisen) ? $penilaian->skrining_gizi_jam_diketahui_dietisen : ''}}" id="skrining_gizi_jam_diketahui_dietisen"  placeholder="Keterangan" >
            </div>
        </div>
    </div>    
</div>
<hr class="mb-5">
<div>
    <div class="row">
        <div class="col-6  border-end" style="height:200px">
            <h5 class="text-center">ASSESMEN/ PENILAIAN KEBIDANAN</h5>
            <hr class="mb-2">
            <div class="overflow-auto h-75 alternate_child_color  px-3" >
                <div class="mb-3">
                    <textarea readonly class="form-control" id="masalah" name="masalah" rows="5">{{!empty($penilaian->masalah) ? $penilaian->masalah : ''}}</textarea>
                </div>
            </div>
        </div>
        <div class="col-6 " >
           <h5 class="text-center">RENCANA KEBIDANAN</h5>
            <hr class="mb-2">
            <div class="overflow-auto h-100 alternate_child_color  px-3" >
                <div class="mb-3">
                    <textarea readonly class="form-control" id="rencana" name="rencana" rows="5">{{!empty($penilaian->rencana) ? $penilaian->rencana : ''}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>