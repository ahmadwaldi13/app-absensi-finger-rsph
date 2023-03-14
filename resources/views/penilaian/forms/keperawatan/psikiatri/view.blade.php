<div class="row mb-3">
    @include('penilaian.form_header', [
        "pj_form_type"=>"petugas",
        "nama_pj" => $penilaian->nama,
        "kode_pj" => $penilaian->nip,
        "readonly" => true
    ])
    <div class="col mb-2">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input readonly type="text" class="form-control input-daterange input-date-time" name="tanggal" id="tanggal" value="{{!empty($penilaian->tanggal) ? $penilaian->tanggal : ''}}"  required autocomplete="off" >
    </div>
    <div class="col mb-2">
        <label for="informasi" class="form-label">Informasi didapat dari : </label>
        <input readonly type="text" id="informasi" name="informasi" class="form-control" value="{{!empty($penilaian->informasi) ? $penilaian->informasi : ''}}">
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">I. RIWAYAT KESEHATAN</h5>
    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="keluhan_utama" class="form-label">Keluhan Utama</label>
            <textarea readonly class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3">{{!empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : ''}}</textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rkd_keluhan" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea readonly class="form-control" id="rkd_keluhan" name="rkd_keluhan" rows="3">{{!empty($penilaian->rkd_keluhan) ? $penilaian->rkd_keluhan : ''}}</textarea>
        </div>
        <div class="col-4 mb-2">
            <label for="rkd_sakit_sejak" class="form-label">Sakit Sejak</label>
            <input readonly type="text" class="form-control w-75" name="rkd_sakit_sejak" id="rkd_sakit_sejak" value="{{!empty($penilaian->rkd_sakit_sejak) ? $penilaian->rkd_sakit_sejak : ''}}">
        </div>
        <div class="col-4 mb-2">
            <label for="rkd_berobat" class="form-label">Berobat :  </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="rkd_berobat" value="{{!empty($penilaian->rkd_berobat) ? $penilaian->rkd_berobat : ''}}">
                {{-- <select class="form-select " id="rkd_berobat"  name="rkd_berobat" aria-label="Default select example">
                <option value="-" {{$penilaian->rkd_berobat === "-" ? 'selected' : ''}}>Pilih </option>
                    <option value="Tidak" {{$penilaian->fp_putus_obat === "Tidak" ? 'selected' : ''}} {{$penilaian->rkd_berobat === "Tidak" ? 'selected' : ''}}>Tidak</option>
                    <option value="Ya, Alternatif" {{$penilaian->rkd_berobat === "Ya, Alternatif" ? 'selected' : ''}}>Ya, Alternatif</option>
                    <option value="Ya, RS" {{$penilaian->rkd_berobat === "Ya, RS" ? 'selected' : ''}}>Ya, RS</option>
                    <option value="Ya, Puskesmas" {{$penilaian->rkd_berobat === "Ya, Puskesmas" ? 'selected' : ''}}>Ya, Puskesmas</option>
                </select> --}}
        </div>
    </div>
    <div class="col-4 mb-2">
        <label for="rkd_hasil_pengobatan" class="form-label">Hasil Pengobatan :  </label>
        <div class="d-flex">
            <input readonly type="text" class="form-control" id="rkd_hasil_pengobatan" value="{{!empty($penilaian->rkd_hasil_pengobatan) ? $penilaian->rkd_hasil_pengobatan : ''}}">
            {{-- <select class="form-select " id="rkd_hasil_pengobatan"  name="rkd_hasil_pengobatan" aria-label="Default select example">
            <option value="-" {{$penilaian->rkd_hasil_pengobatan === "-" ? 'selected' : ''}}>Pilih </option>
                <option value="Berhasil" {{$penilaian->rkd_hasil_pengobatan === "Berhasil" ? 'selected' : ''}}>Berhasil</option>
                <option value="Tidak Berhasil" {{$penilaian->rkd_hasil_pengobatan === "" ? 'selected' : ''}}>Tidak Berhasil</option>
            </select> --}}
    </div>
</div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">II. FAKTOR PRESIPITASI </h5>
    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="fp_putus_obat" class="form-label">Putus Obat :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="fp_putus_obat" value="{{!empty($penilaian->fp_putus_obat) ? $penilaian->fp_putus_obat : ''}}">
                {{-- <select class="form-select w-25 me-2" id="fp_putus_obat"  name="fp_putus_obat" aria-label="Default select example">
                    <option value="-" {{$penilaian->fp_putus_obat === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->fp_putus_obat === "Tidak" ? 'selected' : ''}} {{$penilaian->fp_putus_obat === "Tidak" ? 'selected' : ''}}>Tidak</option>
                    <option value="Ya" {{$penilaian->fp_putus_obat === "Ya" ? 'selected' : ''}} {{$penilaian->fp_putus_obat === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_putus_obat" id='ket_putus_obat' value="{{!empty($penilaian->ket_putus_obat) ? $penilaian->ket_putus_obat : ''}}">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="fp_ekonomi" class="form-label">Masalah Ekonomi :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="fp_ekonomi" value="{{!empty($penilaian->fp_ekonomi) ? $penilaian->fp_ekonomi : ''}}">
                {{-- <select class="form-select w-25" id="fp_ekonomi"  name="fp_ekonomi" aria-label="Default select example">
                    <option value="-" {{$penilaian->fp_ekonomi === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->fp_ekonomi === "Tidak" ? 'selected' : ''}} {{$penilaian->fp_putus_obat === "Tidak" ? 'selected' : ''}}>Tidak</option>
                    <option value="Ya" {{$penilaian->fp_ekonomi === "Ya" ? 'selected' : ''}} {{$penilaian->fp_putus_obat === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_masalah_ekonomi" id='ket_masalah_ekonomi' value="{{!empty($penilaian->ket_masalah_ekonomi) ? $penilaian->ket_masalah_ekonomi : ''}}">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="fp_masalah_fisik" class="form-label">Masalah Fisik :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="fp_masalah_fisik" value="{{!empty($penilaian->fp_masalah_fisik) ? $penilaian->fp_masalah_fisik : ''}}">
                {{-- <select class="form-select w-25" id="fp_masalah_fisik"  name="fp_masalah_fisik" aria-label="Default select example">
                    <option value="-" {{$penilaian->fp_masalah_fisik === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->fp_masalah_fisik === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->fp_masalah_fisik === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_masalah_fisik" id='ket_masalah_fisik' value="{{!empty($penilaian->ket_masalah_fisik) ? $penilaian->ket_masalah_fisik : ''}}">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="fp_masalah_psikososial" class="form-label">Masalah Psikososial :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="fp_masalah_psikososial" value="{{!empty($penilaian->fp_masalah_psikososial) ? $penilaian->fp_masalah_psikososial : ''}}">
                {{-- <select class="form-select w-25" id="fp_masalah_psikososial"  name="fp_masalah_psikososial" aria-label="Default select example">
                    <option value="-" {{$penilaian->fp_masalah_psikososial === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->fp_masalah_psikososial === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->fp_masalah_psikososial === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_masalah_psikososial" id='ket_masalah_psikososial' value="{{!empty($penilaian->ket_masalah_psikososial) ? $penilaian->ket_masalah_psikososial : ''}}">
            </div>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">III. FAKTOR RISIKO</h5>
    <p>Resiko Herediter :</p>
    <div class="row">
        <div class="col-6 mb-2 ">
            <label for="rh_keluarga" class="form-label">Keluarga Dengan Penyakit Jiwa : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="rh_keluarga" value="{{!empty($penilaian->rh_keluarga) ? $penilaian->rh_keluarga : ''}}">
                {{-- <select class="form-select" id="rh_keluarga"  name="rh_keluarga" aria-label="Default select example">
                    <option value="-" {{$penilaian->rh_keluarga === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rh_keluarga === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rh_keluarga === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="ket_rh_keluarga" class="form-label">Jika ya, Sebutkan : </label>
            <input readonly type="text" class="form-control" name="ket_rh_keluarga" id='ket_rh_keluarga' value="{{!empty($penilaian->ket_rh_keluarga) ? $penilaian->ket_rh_keluarga : ''}}">
        </div>
    </div>
    <div class="row">
        <div class="col-2 mb-2 ">
            <label for="resiko_bunuh_diri" class="form-label">Resiko Bunuh Diri : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="resiko_bunuh_diri" value="{{!empty($penilaian->resiko_bunuh_diri) ? $penilaian->resiko_bunuh_diri : ''}}">
                {{-- <select class="form-select" id="resiko_bunuh_diri"  name="resiko_bunuh_diri" aria-label="Default select example">
                    <option value="-" {{$penilaian->fp_putus_obat === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->fp_putus_obat === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->fp_putus_obat === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
            </div>
        </div>
        <div class="col-5 mb-2">
            <label for="rbd_ide" class="form-label">Ada Ide :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rbd_ide" value="{{!empty($penilaian->rbd_ide) ? $penilaian->rbd_ide : ''}}">
                {{-- <select class="form-select w-25" id="rbd_ide"  name="rbd_ide" aria-label="Default select example">
                    <option value="-" {{$penilaian->rbd_ide === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rbd_ide === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rbd_ide === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_rbd_ide" id='ket_rbd_ide' value="{{!empty($penilaian->ket_rbd_ide) ? $penilaian->ket_rbd_ide : ''}}">
            </div>
        </div>
        <div class="col-5 mb-2">
            <label for="rbd_rencana" class="form-label">Ada Rencana :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rbd_rencana" value="{{!empty($penilaian->rbd_rencana) ? $penilaian->rbd_rencana : ''}}">
                {{-- <select class="form-select w-25" id="rbd_rencana"  name="rbd_rencana" aria-label="Default select example">
                    <option value="-" {{$penilaian->rbd_rencana === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rbd_rencana === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rbd_rencana === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_rbd_rencana" id='ket_rbd_rencana' value="{{!empty($penilaian->ket_rbd_rencana) ? $penilaian->ket_rbd_rencana : ''}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-5 mb-2">
            <label for="rbd_alat" class="form-label">Mempersiapkan Alat : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rbd_alat" value="{{!empty($penilaian->rbd_alat) ? $penilaian->rbd_alat : ''}}">
                {{-- <select class="form-select w-25" id="rbd_alat"  name="rbd_alat" aria-label="Default select example">
                    <option value="-" {{$penilaian->rbd_alat === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rbd_alat === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rbd_alat === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_rbd_alat" id='ket_rbd_alat' value="{{!empty($penilaian->ket_rbd_alat) ? $penilaian->ket_rbd_alat : ''}}">
            </div>
        </div>
        <div class="col-3 mb-2 ">
            <label for="rbd_percobaan" class="form-label">Pernah Mencoba Bunuh Diri : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="rbd_percobaan" value="{{!empty($penilaian->rbd_percobaan) ? $penilaian->rbd_percobaan : ''}}">
                {{-- <select class="form-select" id="rbd_percobaan"  name="rbd_percobaan" aria-label="Default select example">
                    <option value="-" {{$penilaian->rbd_percobaan === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rbd_percobaan === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rbd_percobaan === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="ket_rbd_percobaan" class="form-label">Kapan :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" name="ket_rbd_percobaan" id='ket_rbd_percobaan' value="{{!empty($penilaian->ket_rbd_percobaan) ? $penilaian->ket_rbd_percobaan : ''}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-2 ">
            <label for="rbd_keinginan" class="form-label">Saat Ini Masih Ada Keinginan Untuk Bunuh Diri : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="rbd_keinginan" value="{{!empty($penilaian->rbd_keinginan) ? $penilaian->rbd_keinginan : ''}}">
                {{-- <select class="form-select" id="rbd_keinginan"  name="rbd_keinginan" aria-label="Default select example">
                    <option value="-" {{$penilaian->rbd_keinginan === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rbd_keinginan === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rbd_keinginan === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="ket_rbd_keinginan" class="form-label">Jika ya, Dengan Cara : </label>
            <input readonly type="text" class="form-control" name="ket_rbd_keinginan" id='ket_rbd_keinginan' value="{{!empty($penilaian->ket_rbd_keinginan) ? $penilaian->ket_rbd_keinginan : ''}}">
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">IV. RIWAYAT PENGOBATAN </h5>
    <div class="row mb-2">
        <div class="col">
            <label for="rpo_penggunaan" class="form-label">Penggunaan Obat Psikiatri : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rpo_penggunaan" value="{{!empty($penilaian->rpo_penggunaan) ? $penilaian->rpo_penggunaan : ''}}">
                {{-- <select class="form-select w-25 me-2" id="rpo_penggunaan"  name="rpo_penggunaan" aria-label="Default select example">
                    <option value="-" {{$penilaian->rpo_penggunaan === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rpo_penggunaan === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rpo_penggunaan === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_rpo_penggunaan" id='ket_rpo_penggunaan' value="{{!empty($penilaian->ket_rpo_penggunaan) ? $penilaian->ket_rpo_penggunaan : ''}}">
            </div>
        </div>
        <div class="col">
            <label for="rpo_penggunaan_obat_lainnya" class="form-label">Penggunaan Obat Lainya : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rpo_penggunaan_obat_lainnya" value="{{!empty($penilaian->rpo_penggunaan_obat_lainnya) ? $penilaian->rpo_penggunaan_obat_lainnya : ''}}">
                {{-- <select class="form-select w-25 me-2" id="rpo_penggunaan_obat_lainnya"  name="rpo_penggunaan_obat_lainnya" aria-label="Default select example">
                    <option value="-" {{$penilaian->rpo_penggunaan_obat_lainnya === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rpo_penggunaan_obat_lainnya === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rpo_penggunaan_obat_lainnya === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_penggunaan_obat_lainnya" id='ket_penggunaan_obat_lainnya' value="{{!empty($penilaian->ket_penggunaan_obat_lainnya) ? $penilaian->ket_penggunaan_obat_lainnya : ''}}">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <label for="rpo_efek_samping" class="form-label">Efek Samping Obat Psikiatri : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rpo_efek_samping" value="{{!empty($penilaian->rpo_efek_samping) ? $penilaian->rpo_efek_samping : ''}}">
                {{-- <select class="form-select w-25 me-2" id="rpo_efek_samping"  name="rpo_efek_samping" aria-label="Default select example">
                    <option value="-" {{$penilaian->rpo_efek_samping === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rpo_efek_samping === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rpo_efek_samping === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_rpo_efek_samping" id='ket_rpo_efek_samping' value="{{!empty($penilaian->ket_rpo_efek_samping) ? $penilaian->ket_rpo_efek_samping : ''}}">
            </div>
        </div>
        <div class="col">
            <label for="ket_alasan_penggunaan" class="form-label">Alasan Penggunaan : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" name="ket_alasan_penggunaan" id='ket_alasan_penggunaan' value="{{!empty($penilaian->ket_alasan_penggunaan) ? $penilaian->ket_alasan_penggunaan : ''}}">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <label for="rpo_napza" class="form-label">Riwayat Pengguaan Napza : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rpo_napza" value="{{!empty($penilaian->rpo_napza) ? $penilaian->rpo_napza : ''}}">
                {{-- <select class="form-select w-25 me-2" id="rpo_napza"  name="rpo_napza" aria-label="Default select example">
                    <option value="-" {{$penilaian->rpo_napza === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rpo_napza === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rpo_napza === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_rpo_napza" id='ket_rpo_napza' value="{{!empty($penilaian->ket_rpo_napza) ? $penilaian->ket_rpo_napza : ''}}">
            </div>
        </div>
        <div class="col">
            <label for="rpo_alergi_obat" class="form-label">Riwayat Alergi Obat : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rpo_alergi_obat" value="{{!empty($penilaian->rpo_alergi_obat) ? $penilaian->rpo_alergi_obat : ''}}">
                {{-- <select class="form-select w-25 me-2" id="rpo_alergi_obat"  name="rpo_alergi_obat" aria-label="Default select example">
                    <option value="-" {{$penilaian->rpo_alergi_obat === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rpo_alergi_obat === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rpo_alergi_obat === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_alergi_obat" id='ket_alergi_obat' value="{{!empty($penilaian->ket_alergi_obat) ? $penilaian->ket_alergi_obat : ''}}">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3">
            <label for="ket_lama_pemakaian" class="form-label">Lama : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" name="ket_lama_pemakaian" id='ket_lama_pemakaian' value="{{!empty($penilaian->ket_lama_pemakaian) ? $penilaian->ket_lama_pemakaian : ''}}">
            </div>
        </div>
        <div class="col-3">
            <label for="ket_cara_pemakaian" class="form-label">Cara Pakai : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" name="ket_cara_pemakaian" id='ket_cara_pemakaian' value="{{!empty($penilaian->ket_cara_pemakaian) ? $penilaian->ket_cara_pemakaian : ''}}">
            </div>
        </div>
        <div class="col-6">
            <label for="rpo_merokok" class="form-label">Merokok : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rpo_merokok" value="{{!empty($penilaian->rpo_merokok) ? $penilaian->rpo_merokok : ''}}">
                {{-- <select class="form-select w-25 me-2" id="rpo_merokok"  name="rpo_merokok" aria-label="Default select example">
                    <option value="-" {{$penilaian->rpo_merokok === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rpo_merokok === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rpo_merokok === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-50" name="ket_merokok" id='ket_merokok' value="{{!empty($penilaian->ket_merokok) ? $penilaian->ket_merokok : ''}}"><span class="mt-2">Batang/Hari</span>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <label for="ket_latar_belakang_pemakaian" class="form-label">Latar Belakang : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" name="ket_latar_belakang_pemakaian" id='ket_latar_belakang_pemakaian' value="{{!empty($penilaian->ket_latar_belakang_pemakaian) ? $penilaian->ket_latar_belakang_pemakaian : ''}}">
            </div>
        </div>
        <div class="col-6">
            <label for="rpo_minum_kopi" class="form-label">Minum Kopi : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="rpo_minum_kopi" value="{{!empty($penilaian->rpo_minum_kopi) ? $penilaian->rpo_minum_kopi : ''}}">
                {{-- <select class="form-select w-25 me-2" id="rpo_minum_kopi"  name="rpo_minum_kopi" aria-label="Default select example">
                    <option value="-" {{$penilaian->rpo_minum_kopi === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->rpo_minum_kopi === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->rpo_minum_kopi === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-50" name="ket_minum_kopi" id='ket_minum_kopi' value="{{!empty($penilaian->ket_minum_kopi) ? $penilaian->ket_minum_kopi : ''}}"><span class="mt-2">Gelas/Hari</span>
            </div>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">V. Pemeriksaan Fisik </h5>
    <div class="row  mb-2">
        <div class="col">
            <label for="pf_keluhan_fisik" class="form-label">Apakah Terdapat Keluhan Fisik : </label>
            <div class="d-flex">
                <input readonly type="text" class="form-control w-25" id="pf_keluhan_fisik" value="{{!empty($penilaian->pf_keluhan_fisik) ? $penilaian->pf_keluhan_fisik : ''}}">
                {{-- <select class="form-select w-25 me-2" id="pf_keluhan_fisik"  name="pf_keluhan_fisik" aria-label="Default select example">
                    <option value="-" {{$penilaian->pf_keluhan_fisik === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->pf_keluhan_fisik === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->pf_keluhan_fisik === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <input readonly type="text" class="form-control w-75" name="ket_keluhan_fisik" id='ket_keluhan_fisik' value="{{!empty($penilaian->ket_keluhan_fisik) ? $penilaian->ket_keluhan_fisik : ''}}">
            </div>
        </div>
    </div>
    <div class="row  mb-2">
        <div class="col-3">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input readonly type="text" name="td" id="td" class="form-control" value="{{!empty($penilaian->td) ? $penilaian->td : ''}}">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input readonly type="text" id="nadi" name="nadi" class="form-control" value="{{!empty($penilaian->nadi) ? $penilaian->nadi : ''}}">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-2">
            <label for="rr" class="form-label">RR : </label>
            <div class="input-group">
                <input readonly type="text" id="rr" name="rr" class="form-control" value="{{!empty($penilaian->rr) ? $penilaian->rr : ''}}">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input readonly type="text" id="suhu" name="suhu" class="form-control" value="{{!empty($penilaian->suhu) ? $penilaian->suhu : ''}}">
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>
        <div class="col-3">
            <label for="gcs" class="form-label">GCS(E, V, M) : </label>
            <div class="input-group">
                <input readonly type="text" id="gcs" name="gcs" class="form-control" value="{{!empty($penilaian->gcs) ? $penilaian->gcs : ''}}">
            </div>
        </div>
    </div>
</div>
<hr class="mb-5">

<div>
    <h5 class="text-start">VI. Penilaian Tingkat Nyeri</h5>
    <div class="row mb-2">
        <div class="col-5">
            <div class="row mb-5">
                <img src="{{asset('icon/nyeri.png')}}" height="280" alt="">
            </div>
            <div class="mt-5">
                <label for="nyeri_hilang" class="form-label">Nyeri Hilang Bila : </label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control w-25" id="nyeri_hilang" value="{{!empty($penilaian->nyeri_hilang) ? $penilaian->nyeri_hilang : ''}}">
                    {{-- <select class="form-select w-25 me-2" id="nyeri_hilang"  name="nyeri_hilang" aria-label="Default select example">
                        <option value="-" {{$penilaian->nyeri_hilang === "-" ? 'selected' : ''}}>Pilih</option>
                        <option value="Istirahat" {{$penilaian->nyeri_hilang === "Istirahat" ? 'selected' : ''}}>Istirahat</option>
                        <option value="Medengar Musik" {{$penilaian->nyeri_hilang === "Medengar Musik" ? 'selected' : ''}}>Medengar Musik</option>
                        <option value="Tidak" {{$penilaian->nyeri_hilang === "Tidak" ? 'selected' : ''}} >Minum Obat</option>
                    </select> --}}
                    <input readonly type="text" class="form-control w-75" name="ket_nyeri" id='ket_nyeri' value="{{!empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : ''}}">
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="row">
                <div class="col-4 mt-4">
                    <div class="d-flex">
                        <input readonly type="text" class="form-control" id="nyeri" value="{{!empty($penilaian->nyeri) ? $penilaian->nyeri : ''}}">
                        {{-- <select class="form-select me-2" id="nyeri"  name="nyeri" aria-label="Default select example">
                            <option value="-" {{$penilaian->nyeri === "-" ? 'selected' : ''}}>Tingkatan Nyeri</option>
                            <option value="Tidak Ada Nyeri" >{{$penilaian->nyeri === "Tidak Ada Nyeri" ? 'selected' : ''}}Tidak Ada Nyeri</option>
                            <option value="Nyeri Akut" {{$penilaian->nyeri === "Nyeri Akut" ? 'selected' : ''}}>Nyeri Akut</option>
                            <option value="Nyeri Kronis" {{$penilaian->nyeri === "Nyeri Kronis" ? 'selected' : ''}}>Nyeri Kronis</option>
                        </select> --}}
                    </div>
                </div>
                <div class="col-8">
                    <label for="provokes" class="form-label">Penyebab : </label>
                    <div class="d-flex">
                        <input readonly type="text" class="form-control w-25" id="provokes" value="{{!empty($penilaian->provokes) ? $penilaian->provokes : ''}}">
                        {{-- <select class="form-select w-25 me-2" id="provokes"  name="provokes" aria-label="Default select example">
                            <option value="-" {{$penilaian->provokes === "-" ? 'selected' : ''}}>Pilih</option>
                            <option value="Proses Penyakit" {{$penilaian->provokes === "Proses Penyakit" ? 'selected' : ''}}>Proses Penyakit</option>
                            <option value="Benturan" {{$penilaian->provokes === "Benturan" ? 'selected' : ''}}>Benturan</option>
                            <option value="Lain-lain" {{$penilaian->provokes === "Lain-lain" ? 'selected' : ''}}>Lain-lain</option>
                        </select> --}}
                        <input readonly type="text" class="form-control w-75" name="ket_provokes" id='ket_provokes' value="{{!empty($penilaian->ket_provokes) ? $penilaian->ket_provokes : ''}}">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="quality" class="form-label">Kualitas : </label>
                    <div class="d-flex">
                        <input readonly type="text" class="form-control w-25 me-2" id="quality" value="{{!empty($penilaian->quality) ? $penilaian->quality : ''}}">
                        {{-- <select class="form-select w-25 me-2" id="quality"  name="quality" aria-label="Default select example">
                            <option value="-" {{$penilaian->quality === "-" ? 'selected' : ''}}>Pilih</option>
                            <option value="Seperti Tertusuk" {{$penilaian->quality === "Seperti Tertusuk" ? 'selected' : ''}}>Seperti Tertusuk</option>
                            <option value="Berdenyut" {{$penilaian->quality === "Berdenyut" ? 'selected' : ''}}>Berdenyut</option>
                            <option value="Teriris" {{$penilaian->quality === "Teriris" ? 'selected' : ''}}>Teriris</option>
                            <option value="Tertindih" {{$penilaian->quality === "Tertindih" ? 'selected' : ''}}>Tertindih</option>
                            <option value="Tertiban" {{$penilaian->quality === "Tertiban" ? 'selected' : ''}}>Tertiban</option>
                            <option value="Lain-lain" {{$penilaian->quality === "Lain-lain" ? 'selected' : ''}}>Lain-lain</option>
                        </select> --}}
                        <input readonly type="text" class="form-control w-75" name="ket_quality" id='ket_quality' value="{{!empty($penilaian->ket_quality) ? $penilaian->ket_quality : ''}}">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <span>Wilayah :</span>
                <div class="col-6">
                    <label for="lokasi" class="form-label ms-5">Lokasi : </label>
                    <div class="d-flex">
                        <input readonly type="text" class="form-control" name="lokasi" id='lokasi' value="{{!empty($penilaian->lokasi) ? $penilaian->lokasi : ''}}">
                    </div>
            </div>
            <div class="col-6">
                <label for="menyebar" class="form-label">Menyebar : </label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="menyebar" value="{{!empty($penilaian->menyebar) ? $penilaian->menyebar : ''}}">
                    {{-- <select class="form-select me-2" id="menyebar"  name="menyebar" aria-label="Default select example">
                        <option value="-" {{$penilaian->menyebar === "-" ? 'selected' : ''}}>Pilih</option>
                        <option value="Tidak" {{$penilaian->menyebar === "Tidak" ? 'selected' : ''}} >Tidak</option>
                        <option value="Ya" {{$penilaian->menyebar === "Ya" ? 'selected' : ''}}>Ya</option>
                    </select> --}}
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="skala_nyeri" class="form-label">Severity : Skala Nyeri</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="menyebar" value="{{!empty($penilaian->skala_nyeri) ? $penilaian->skala_nyeri : ''}}">
                    {{-- <select class=" form-select" id="skala_nyeri"  name="skala_nyeri" aria-label="Default select example">
                        <option value="-" {{$penilaian->skala_nyeri === "-" ? 'selected' : ''}} >Pilih Skala Nyeri</option>
                            @for($i=0; $i <=10 ;$i++)
                                <option value="{{$i}}" {{$penilaian->skala_nyeri === "$i" ? 'selected' : ''}} >{{$i}}</option>
                            @endfor
                        </select> --}}
                </div>
            </div>
            <div class="col">
                <label for="durasi" class="form-label">Waktu/Durasi : </label>
                <div class="input-group">
                    <input readonly type="text" id="durasi" name="durasi" class="form-control" value="{{!empty($penilaian->durasi) ? $penilaian->durasi : ''}}">
                    <span class="input-group-text" id="ModalPetugas">Menit</span>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="pada_dokter" class="form-label">Diberitahukan Pada Dokter ?</label>
                <div class="d-flex">
                    <input readonly type="text" class="form-control" id="pada_dokter" value="{{!empty($penilaian->pada_dokter) ? $penilaian->pada_dokter : ''}}">
                    {{-- <select class="form-select" id="pada_dokter"  name="pada_dokter" aria-label="Default select example">
                        <option value="-" {{$penilaian->pada_dokter === "-" ? 'selected' : ''}}>Pilih</option>
                        <option value="Tidak" {{$penilaian->pada_dokter === "Tidak" ? 'selected' : ''}} >Tidak</option>
                        <option value="Ya" {{$penilaian->pada_dokter === "Ya" ? 'selected' : ''}}>Ya</option>
                    </select> --}}
                </div>
            </div>
            <div class="col">
                <label for="ket_dokter" class="form-label">Jam : </label>
                <div class="input-group">
                    <input readonly type="text" id="ket_dokter" name="ket_dokter" class="form-control" value="{{!empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : ''}}">
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">VII. STATUS NUTRISI</h5>
    <div class="row mb-2">
        <div class="col-2">
            <label for="bb" class="form-label">BB : </label>
            <div class="input-group">
                <input readonly type="text" id="bb" name="bb" class="form-control" value="{{!empty($penilaian->bb) ? $penilaian->bb : ''}}">
                <span class="input-group-text" >Kg</span>
            </div>
        </div>
        <div class="col-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input readonly type="text" id="tb" name="tb" class="form-control" value="{{!empty($penilaian->tb) ? $penilaian->tb : ''}}">
                <span class="input-group-text" >cm</span>
            </div>
        </div>
        <div class="col-2">
            <label for="bmi" class="form-label">BMI : </label>
            <div class="input-group">
                <input readonly type="text" id="bmi" name="bmi" class="form-control" value="{{!empty($penilaian->bmi) ? $penilaian->bmi : ''}}">
                <span class="input-group-text" >Kg / m&#178;</span>
            </div>
        </div>
        <div class="col-3">
            <label for="lapor_status_nutrisi" class="form-label">Dilaporkan Kepada DPJP ?</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="lapor_status_nutrisi" value="{{!empty($penilaian->lapor_status_nutrisi) ? $penilaian->lapor_status_nutrisi : ''}}">
                {{-- <select class="form-select" id="lapor_status_nutrisi"  name="lapor_status_nutrisi" aria-label="Default select example">
                    <option value="-" {{$penilaian->lapor_status_nutrisi === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->lapor_status_nutrisi === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->lapor_status_nutrisi === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
            </div>
        </div>
        <div class="col-3">
            <label for="ket_lapor_status_nutrisi" class="form-label">Jam Dilaporkan : </label>
            <div class="input-group">
                <input readonly type="text" id="ket_lapor_status_nutrisi" name="ket_lapor_status_nutrisi" class="form-control" value="{{!empty($penilaian->ket_lapor_status_nutrisi) ? $penilaian->ket_lapor_status_nutrisi : ''}}">
            </div>
        </div>
    </div>
</div>

<hr class="mb-5">
<div>
    <h5 class="text-start">VIII. SKRINING GIZI</h5>
    <div class="row">
        <div class="col mb-2">
            <div class="d-flex">
                <label for="sg1" class="form-label mt-2">1. Apakah ada penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir ?</label>
                <input readonly type="text" class="form-control w-25" id="sg1" value="{{!empty($penilaian->sg1) ? $penilaian->sg1 : ''}}">
                {{-- <select class="form-select w-25 me-3" id="sg1"  name="sg1" aria-label="Default select example">
                    <option value="-" {{$penilaian->sg1 === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->sg1 === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Tidak Yakin" {{$penilaian->sg1 === "Tidak Yakin" ? 'selected' : ''}}>Tidak Yakin</option>
                    <option value="Ya, 1-5 Kg" {{$penilaian->sg1 === "Ya, 1-5 Kg" ? 'selected' : ''}}>Ya, 1-5 Kg</option>
                    <option value="Ya, 6-10 Kg" {{$penilaian->sg1 === "Ya, 6-10 Kg" ? 'selected' : ''}}>Ya, 6-10 Kg</option>
                    <option value="Ya, 11-15 Kg" {{$penilaian->sg1 === "Ya, 11-15 Kg" ? 'selected' : ''}}>Ya, 11-15 Kg</option>
                    <option value="Ya, >15 Kg" {{$penilaian->sg1 === "Ya, >15 Kg" ? 'selected' : ''}}>Ya, >15 Kg</option>
                </select> --}}
                <span class="mt-2" style="width: 5%">Nilai :</span>
                <input readonly type="text" class="form-control w-25" id="nilai1" value="{{!empty($penilaian->nilai1) ? $penilaian->nilai1 : ''}}">
                {{-- <select class=" form-select w-25" id="nilai1"  name="nilai1" aria-label="Default select example">
                    <option value="-" {{$penilaian->nilai1 === "-" ? 'selected' : ''}}>Pilih Nilai</option>
                        @for($i=0; $i <=4 ;$i++)
                            <option value="{{$i}}" {{$penilaian->nilai1 === "$i" ? 'selected' : ''}}>{{$i}}</option>
                        @endfor
                    </select> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mb-2">
            <div class="d-flex">
                <label for="sg2" class="form-label mt-2">2. Apakah nafsu makan berkurang, karena tidak nafsu makan ?</label>
                <input readonly type="text" class="form-control w-25" id="sg2" value="{{!empty($penilaian->sg2) ? $penilaian->sg2 : ''}}">
                {{-- <select class="form-select w-25 me-3" id="sg2"  name="sg2" aria-label="Default select example">
                    <option value="-" {{$penilaian->sg2 === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->sg2 === "Tidak" ? 'selected' : ''}} >0</option>
                    <option value="Ya" {{$penilaian->sg2 === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <span class="mt-2" style="width: 5%">Nilai :</span>
                <input readonly type="text" class="form-control w-25" id="nilai2" value="{{!empty($penilaian->nilai2) ? $penilaian->nilai2 : ''}}">
                {{-- <select class="form-select w-25" id="nilai2"  name="nilai2" aria-label="Default select example">
                    <option value="-" {{$penilaian->nilai2 === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="0" {{$penilaian->nilai2 === "0" ? 'selected' : ''}}>0</option>
                    <option value="1" {{$penilaian->nilai2 === "1" ? 'selected' : ''}}>1</option>
                </select> --}}
            </div>
        </div>
    </div>
    <div class="row position-relative">
        <div class="col-5 position-absolute top-0 end-0">
            <div class="d-flex">
                <label for="total_hasil" class="form-label w-50">Total Skor : </label>
                <div class="input-group">
                    <input readonly type="text" id="total_hasil" name="total_hasil" class="form-control" value="{{!empty($penilaian->total_hasil) ? $penilaian->total_hasil : ''}}">
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="mb-5 mt-5">
<div>
    <h5 class="text-start">IX. PENILAIAN RESIKO JATUH</h5>
    <div class="row ">
        <div class="col-5">
            <span class="">a. Cara Berjalan :</span>
            <div class="d-flex">
                <label for="resikojatuh" class="form-label mt-2 me-1">1. Tidak seimbang/Sempoyongan/limbung :</label>
                <input readonly type="text" class="form-control w-25" id="resikojatuh" value="{{!empty($penilaian->resikojatuh) ? $penilaian->resikojatuh : ''}}">
                {{-- <select class="form-select w-25" id="resikojatuh"  name="resikojatuh" aria-label="Default select example">
                    <option value="-" {{$penilaian->resikojatuh === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->resikojatuh === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->resikojatuh === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
            </div>
        </div>
        <div class="col-7 mt-4">
            <div class="d-flex">
                <label for="bjm" class="form-label mt-1 me-1 w-75">2. Jalan dengan menggunakan alat bantu(kruk,tripot,kursi roda,orang lain) :</label>
                <input readonly type="text" class="form-control w-25" id="bjm" value="{{!empty($penilaian->bjm) ? $penilaian->bjm : ''}}">
                {{-- <select class="form-select w-25" id="bjm"  name="bjm" aria-label="Default select example">
                    <option value="-" {{$penilaian->bjm === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->bjm === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->bjm === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
            </div>
        </div>
    </div>
    <div class="row mt-2 mb-2">
        <div class="col mb-2">
            <div class="d-flex">
                <label for="msa" class="form-label mt-2">b. Menopang saat akan duduk, tampak memegang pinggiran kursi atau meja/benda lain sebagai penopang :</label>
                <input readonly type="text" class="form-control w-25" id="msa" value="{{!empty($penilaian->msa) ? $penilaian->msa : ''}}">
                {{-- <select class="form-select w-25 me-3" id="msa"  name="msa" aria-label="Default select example">
                    <option value="-" {{$penilaian->msa === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->msa === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->msa === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-5">
            <div class="d-flex">
                <label for="hasil" class="form-label mt-2 me-1">Hasil:</label>
                <input readonly type="text" class="form-control" id="hasil" value="{{!empty($penilaian->hasil) ? $penilaian->hasil : ''}}">
                {{-- <select class="form-select ms-2" id="hasil"  name="hasil" aria-label="Default select example">
                    <option value="-" {{$penilaian->hasil === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak beresiko (tidak ditemukan a dan b)" {{$penilaian->hasil === "Tidak beresiko (tidak ditemukan a dan b)" ? 'selected' : ''}}>Tidak beresiko (tidak ditemukan a dan b)</option>
                    <option value="Resiko rendah (ditemukan a/b)" {{$penilaian->hasil === "Resiko rendah (ditemukan a/b)" ? 'selected' : ''}}>Resiko rendah (ditemukan a/b)</option>
                    <option value="Resiko tinggi (ditemukan a dan b)" {{$penilaian->hasil === "Resiko tinggi (ditemukan a dan b)" ? 'selected' : ''}}>Resiko tinggi (ditemukan a dan b)</option>
                </select> --}}
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex">
                <label for="lapor" class="form-label mt-2 me-1">Dilaporkan kepada dokter ?</label>
                <input readonly type="text" class="form-control ms-2 w-25" id="lapor" value="{{!empty($penilaian->lapor) ? $penilaian->lapor : ''}}">
                {{-- <select class="form-select ms-2 w-25" id="lapor"  name="lapor" aria-label="Default select example">
                    <option value="-" {{$penilaian->lapor === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->lapor === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->lapor === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex">
                <label for="ket_lapor" class="form-label mt-2 me-1">Jam dilaporkan:</label>
                <input readonly type="text" id="ket_lapor" name="ket_lapor" class="form-control w-50" value="{{!empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : ''}}">
            </div>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">IX. STATUS FUNGSIONAL</h5>
   <div class="row mb-2 mt-2">
    <div class="col-3">
        <div class="d-flex">
            <label for="adl_mandi" class="form-label mt-2 me-1">Mandi:</label>
            <input readonly type="text" class="form-control ms-2" id="adl_mandi" value="{{!empty($penilaian->adl_mandi) ? $penilaian->adl_mandi : ''}}">
            {{-- <select class="form-select ms-2" id="adl_mandi"  name="adl_mandi" aria-label="Default select example">
                <option value="-" {{$penilaian->adl_mandi === "-" ? 'selected' : ''}}>Pilih</option>
                <option value="Mandiri" {{$penilaian->adl_mandi === "Mandiri" ? 'selected' : ''}}>Mandiri</option>
                <option value="Bantuan Minimal" {{$penilaian->adl_mandi === "Bantuan Minimal" ? 'selected' : ''}}>Bantuan Minimal</option>
                <option value="Bantuan Total" {{$penilaian->adl_mandi === "Bantuan Total" ? 'selected' : ''}}>Bantuan Total</option>
            </select> --}}
        </div>
    </div>
    <div class="col-6">
        <div class="d-flex">
            <label for="adl_sosialisasi" class="form-label mt-2 me-1">Sosialisasi:</label>
            <input readonly type="text" class="form-control ms-2 w-25" id="adl_sosialisasi" value="{{!empty($penilaian->adl_sosialisasi) ? $penilaian->adl_sosialisasi : ''}}">
            {{-- <select class="form-select ms-2 w-25" id="adl_sosialisasi"  name="adl_sosialisasi" aria-label="Default select example">
                <option value="-" {{$penilaian->adl_sosialisasi === "-" ? 'selected' : ''}}>Pilih</option>
                <option value="Tidak" {{$penilaian->adl_sosialisasi === "Tidak" ? 'selected' : ''}} >Tidak</option>
                <option value="Ya" {{$penilaian->adl_sosialisasi === "Ya" ? 'selected' : ''}}>Ya</option>
            </select> --}}
            <input readonly type="text" id="ket_adl_sosialisasi" name="ket_adl_sosialisasi" class="form-control w-50 ms-1" value="{{!empty($penilaian->ket_adl_sosialisasi) ? $penilaian->ket_adl_sosialisasi : ''}}">
        </div>
    </div>
    <div class="col-3">
        <div class="d-flex">
            <label for="adl_berpakaian" class="form-label mt-2 me-1">Berpakaian:</label>
            <input readonly type="text" class="form-control ms-2" id="adl_berpakaian" value="{{!empty($penilaian->adl_berpakaian) ? $penilaian->adl_berpakaian : ''}}">
            {{-- <select class="form-select ms-2" id="adl_berpakaian"  name="adl_berpakaian" aria-label="Default select example">
                <option value="-" {{$penilaian->adl_berpakaian === "-" ? 'selected' : ''}}>Pilih</option>
                <option value="Mandiri" {{$penilaian->adl_berpakaian === "Mandiri" ? 'selected' : ''}}>Mandiri</option>
                <option value="Bantuan Minimal" {{$penilaian->adl_berpakaian === "Bantuan Minimal" ? 'selected' : ''}}>Bantuan Minimal</option>
                <option value="Bantuan Total" {{$penilaian->adl_berpakaian === "Bantuan Total" ? 'selected' : ''}}>Bantuan Total</option>
            </select> --}}
        </div>
    </div>
   </div>
   <div class="row mb-2">
    <div class="col-3">
        <div class="d-flex">
            <label for="adl_bak" class="form-label mt-2 me-1">Bak:</label>
            <input readonly type="text" class="form-control ms-2" id="adl_bak" value="{{!empty($penilaian->adl_bak) ? $penilaian->adl_bak : ''}}">
            {{-- <select class="form-select ms-2" id="adl_bak"  name="adl_bak" aria-label="Default select example">
                <option value="-" {{$penilaian->adl_bak === "-" ? 'selected' : ''}}>Pilih</option>
                <option value="Mandiri" {{$penilaian->adl_bak === "Mandiri" ? 'selected' : ''}}>Mandiri</option>
                <option value="Bantuan Minimal" {{$penilaian->adl_bak === "Bantuan Minimal" ? 'selected' : ''}}>Bantuan Minimal</option>
                <option value="Bantuan Total" {{$penilaian->adl_bak === "Bantuan Total" ? 'selected' : ''}}>Bantuan Total</option>
            </select> --}}
        </div>
    </div>
    <div class="col-6">
        <div class="d-flex">
            <label for="adl_hobi" class="form-label mt-2 w-25">Melakukan Hobi:</label>
            <input readonly type="text" class="form-control ms- w-25" id="adl_hobi" value="{{!empty($penilaian->adl_hobi) ? $penilaian->adl_hobi : ''}}">
            {{-- <select class="form-select ms-2 w-25" id="adl_hobi"  name="adl_hobi" aria-label="Default select example">
                <option value="-" {{$penilaian->adl_hobi === "-" ? 'selected' : ''}}>Pilih</option>
                <option value="Tidak" {{$penilaian->adl_hobi === "Tidak" ? 'selected' : ''}} >Tidak</option>
                <option value="Ya" {{$penilaian->adl_hobi === "Ya" ? 'selected' : ''}}>Ya</option>
            </select> --}}
            <input readonly type="text" id="ket_adl_hobi" name="ket_adl_hobi" class="form-control w-50 ms-1" value="{{!empty($penilaian->ket_adl_hobi) ? $penilaian->ket_adl_hobi : ''}} ">
        </div>
    </div>
    <div class="col-3">
        <div class="d-flex">
            <label for="adl_makan" class="form-label mt-2 me-1">Makan/Minum:</label>
            <input readonly type="text" class="form-control ms-2" id="adl_makan" value="{{!empty($penilaian->adl_makan) ? $penilaian->adl_makan : ''}}">
            {{-- <select class="form-select ms-2" id="adl_makan"  name="adl_makan" aria-label="Default select example">
                <option value="-" {{$penilaian->adl_makan === "-" ? 'selected' : ''}}>Pilih</option>
                <option value="Mandiri" {{$penilaian->adl_makan === "Mandiri" ? 'selected' : ''}}>Mandiri</option>
                <option value="Bantuan Minimal" {{$penilaian->adl_makan === "Bantuan Minimal" ? 'selected' : ''}}>Bantuan Minimal</option>
                <option value="Bantuan Total" {{$penilaian->adl_makan === "Bantuan Total" ? 'selected' : ''}}>Bantuan Total</option>
            </select> --}}
        </div>
    </div>
   </div>
   <div class="row mb-2">
    <div class="col-3">
        <div class="d-flex">
            <label for="adl_bab" class="form-label mt-2 me-1">BAB:</label>
            <input readonly type="text" class="form-control ms-2" id="adl_bab" value="{{!empty($penilaian->adl_bab) ? $penilaian->adl_bab : ''}}">
            {{-- <select class="form-select ms-2" id="adl_bab"  name="adl_bab" aria-label="Default select example">
                <option value="-" {{$penilaian->adl_bab === "-" ? 'selected' : ''}}>Pilih</option>
                <option value="Mandiri" {{$penilaian->adl_bab === "Mandiri" ? 'selected' : ''}}>Mandiri</option>
                <option value="Bantuan Minimal" {{$penilaian->adl_bab === "Bantuan Minimal" ? 'selected' : ''}}>Bantuan Minimal</option>
                <option value="Bantuan Total" {{$penilaian->adl_bab === "Bantuan Total" ? 'selected' : ''}}>Bantuan Total</option>
            </select> --}}
        </div>
    </div>
    <div class="col-6">
        <div class="d-flex">
            <label for="adl_kegiatan" class="form-label mt-2 w-25">Kegiatan RT:</label>
            <input readonly type="text" class="form-control ms-2 w-25" id="adl_kegiatan" value="{{!empty($penilaian->adl_kegiatan) ? $penilaian->adl_kegiatan : ''}}">
            {{-- <select class="form-select ms-2 w-25" id="adl_kegiatan"  name="adl_kegiatan" aria-label="Default select example">
                <option value="-" {{$penilaian->adl_kegiatan === "-" ? 'selected' : ''}}>Pilih</option>
                <option value="Tidak" {{$penilaian->adl_kegiatan === "Tidak" ? 'selected' : ''}} >Tidak</option>
                <option value="Ya" {{$penilaian->adl_kegiatan === "Ya" ? 'selected' : ''}}>Ya</option>
            </select> --}}
            <input readonly type="text" id="ket_adl_kegiatan" name="ket_adl_kegiatan" class="form-control w-50 ms-1" value="{{!empty($penilaian->ket_adl_kegiatan) ? $penilaian->ket_adl_kegiatan : ''}}">
        </div>
    </div>
   </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">XI. STATUS KESEHATAN SAAT INI</h5>
    <div class="row mb-2">
        <div class="col-4">
            <label for="sk_penampilan" class="form-label">Penampilan :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_penampilan" value="{{!empty($penilaian->sk_penampilan) ? $penilaian->sk_penampilan : ''}}">
                {{-- <select class="form-select" id="sk_penampilan"  name="sk_penampilan" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_penampilan === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Bersih" {{$penilaian->sk_penampilan === "Bersih" ? 'selected' : ''}}>Bersih</option>
                    <option value="Rapi" {{$penilaian->sk_penampilan === "Rapi" ? 'selected' : ''}}>Rapi</option>
                    <option value="Tidak Rapi" {{$penilaian->sk_penampilan === "Tidak Rapi" ? 'selected' : ''}}>Tidak Rapi</option>
                    <option value="Kotor" {{$penilaian->sk_penampilan === "Kotor" ? 'selected' : ''}}>Kotor</option>
                    <option value="Tidak Seperti Biasanya" {{$penilaian->sk_penampilan === "Tidak Seperti Biasanya" ? 'selected' : ''}}>Tidak Seperti Biasanya</option>
                    <option value="Pakaian Tidak Sesuai" {{$penilaian->sk_penampilan === "Pakaian Tidak Sesuai" ? 'selected' : ''}}>Pakaian Tidak Sesuai</option>
                </select> --}}
            </div>
        </div>
        <div class="col-4">
            <label for="sk_pembicaraan" class="form-label">Pembicara :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_pembicaraan" value="{{!empty($penilaian->sk_pembicaraan) ? $penilaian->sk_pembicaraan : ''}}">
                {{-- <select class="form-select" id="sk_pembicaraan"  name="sk_pembicaraan" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_pembicaraan === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Sesuai" {{$penilaian->sk_pembicaraan === "Sesuai" ? 'selected' : ''}}>Sesuai</option>
                    <option value="Cepat" {{$penilaian->sk_pembicaraan === "Sesuai" ? 'selected' : ''}}>Cepat</option>
                    <option value="Lambat" {{$penilaian->sk_pembicaraan === "Sesuai" ? 'selected' : ''}}>Lambat</option>
                    <option value="Membisu" {{$penilaian->sk_pembicaraan === "Sesuai" ? 'selected' : ''}}>Membisu</option>
                    <option value="Mendominasi" {{$penilaian->sk_pembicaraan === "Mendominasi" ? 'selected' : ''}}>Mendominasi</option>
                    <option value="Mengancam" {{$penilaian->sk_pembicaraan === "Mengancam" ? 'selected' : ''}}>Mengancam</option>
                    <option value="Inkoheren" {{$penilaian->sk_pembicaraan === "Inkoheren" ? 'selected' : ''}}>Inkoheren</option>
                    <option value="Apatis" {{$penilaian->sk_pembicaraan === "Apatis" ? 'selected' : ''}}>Apatis</option>
                    <option value="Keras" {{$penilaian->sk_pembicaraan === "Keras" ? 'selected' : ''}}>Keras</option>
                    <option value="Tidak Mampu Memulai Pembicaraan" {{$penilaian->sk_pembicaraan === "Tidak Mampu Memulai Pembicaraan" ? 'selected' : ''}}>Tidak Mampu Memulai Pembicaraan</option>
                </select> --}}
            </div>
        </div>
        <div class="col-4">
            <label for="sk_alam_perasaan" class="form-label">Alam Perasaan :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_alam_perasaan" value="{{!empty($penilaian->sk_alam_perasaan) ? $penilaian->sk_alam_perasaan : ''}}">
                {{-- <select class="form-select" id="sk_alam_perasaan"  name="sk_alam_perasaan" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_alam_perasaan === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Sesuai" {{$penilaian->sk_alam_perasaan === "Sesuai" ? 'selected' : ''}}>Sesuai</option>
                    <option value="Marah" {{$penilaian->sk_alam_perasaan === "Marah" ? 'selected' : ''}}>Marah</option>
                    <option value="Putus Asa" {{$penilaian->sk_alam_perasaan === "Putus Asa" ? 'selected' : ''}}>Putus Asa</option>
                    <option value="Tertekan" {{$penilaian->sk_alam_perasaan === "Tertekan" ? 'selected' : ''}}>Tertekan</option>
                    <option value="Sedih" {{$penilaian->sk_alam_perasaan === "Sedih" ? 'selected' : ''}}>Sedih</option>
                    <option value="Labil" {{$penilaian->sk_alam_perasaan === "Labil" ? 'selected' : ''}}>Labil</option>
                    <option value="Malu" {{$penilaian->sk_alam_perasaan === "Malu" ? 'selected' : ''}}>Malu</option>
                    <option value="Khawatir" {{$penilaian->sk_alam_perasaan === "Khawatir" ? 'selected' : ''}}>Khawatir</option>
                    <option value="Gembira Berlebihan" {{$penilaian->sk_alam_perasaan === "Gembira Berlebihan" ? 'selected' : ''}}>Gembira Berlebihan</option>
                    <option value="Merasa Tidak Mampu" {{$penilaian->sk_alam_perasaan === "Merasa Tidak Mampu" ? 'selected' : ''}}>Merasa Tidak Mampu</option>
                    <option value="Ketakutan" {{$penilaian->sk_alam_perasaan === "Ketakutan" ? 'selected' : ''}}>Ketakutan</option>
                    <option value="Tidak Berguna" {{$penilaian->sk_alam_perasaan === "Tidak Berguna" ? 'selected' : ''}}>Tidak Berguna</option>
                </select> --}}
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-4">
            <label for="sk_afek" class="form-label">Afek :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_afek" value="{{!empty($penilaian->sk_afek) ? $penilaian->sk_afek : ''}}">
                {{-- <select class="form-select" id="sk_afek"  name="sk_afek" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_afek === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Sesuai" {{$penilaian->sk_afek === "Sesuai" ? 'selected' : ''}}>Sesuai</option>
                    <option value="Datar" {{$penilaian->sk_afek === "Datar" ? 'selected' : ''}}>Datar</option>
                    <option value="Tumpul" {{$penilaian->sk_afek === "Tumpul" ? 'selected' : ''}}>Tumpul</option>
                    <option value="Labil" {{$penilaian->sk_afek === "Labil" ? 'selected' : ''}}>Labil</option>
                    <option value="Tidak Sesuai" {{$penilaian->sk_afek === "Tidak Sesuai" ? 'selected' : ''}}>Tidak Sesuai</option>
                </select> --}}
            </div>
        </div>
        <div class="col-4">
            <label for="sk_aktifitas_motorik" class="form-label">Aktivitas Motorik/Prilaku :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_aktifitas_motorik" value="{{!empty($penilaian->sk_aktifitas_motorik) ? $penilaian->sk_aktifitas_motorik : ''}}">
                {{-- <select class="form-select" id="sk_aktifitas_motorik"  name="sk_aktifitas_motorik" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_aktifitas_motorik === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Normal" {{$penilaian->sk_aktifitas_motorik === "Normal" ? 'selected' : ''}}>Normal</option>
                    <option value="Tegang" {{$penilaian->sk_aktifitas_motorik === "Tegang" ? 'selected' : ''}}>Tegang</option>
                    <option value="Gelisah" {{$penilaian->sk_aktifitas_motorik === "Gelisah" ? 'selected' : ''}}>Gelisah</option>
                    <option value="Grimasem" {{$penilaian->sk_aktifitas_motorik === "Grimasem" ? 'selected' : ''}}>Grimasem</option>
                    <option value="TIK" {{$penilaian->sk_aktifitas_motorik === "TIK" ? 'selected' : ''}}>TIK</option>
                    <option value="Tremor" {{$penilaian->sk_aktifitas_motorik === "Tremor" ? 'selected' : ''}}>Tremor</option>
                    <option value="Agitasi" {{$penilaian->sk_aktifitas_motorik === "Agitasi" ? 'selected' : ''}}>Agitasi</option>
                    <option value="Konfulsif" {{$penilaian->sk_aktifitas_motorik === "Konfulsif" ? 'selected' : ''}}>Konfulsif</option>
                    <option value="Melamun" {{$penilaian->sk_aktifitas_motorik === "Melamun" ? 'selected' : ''}}>Melamun</option>
                    <option value="Sulit Diarahkan" {{$penilaian->sk_aktifitas_motorik === "Sulit Diarahkan" ? 'selected' : ''}}>Sulit Diarahkan</option>
                </select> --}}
            </div>
        </div>
        <div class="col-4">
            <label for="sk_interaksi" class="form-label">Interaksi Selama Wawancara :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_interaksi" value="{{!empty($penilaian->sk_interaksi) ? $penilaian->sk_interaksi : ''}}">
                {{-- <select class="form-select" id="sk_interaksi"  name="sk_interaksi" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_interaksi === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Kooperatif"  {{$penilaian->sk_interaksi === "Kooperatif" ? 'selected' : ''}}>Kooperatif</option>
                    <option value="Tidak Kooperatif"  {{$penilaian->sk_interaksi === "Tidak Kooperatif" ? 'selected' : ''}}>Tidak Kooperatif</option>
                    <option value="Bermusuhan"  {{$penilaian->sk_interaksi === "Bermusuhan" ? 'selected' : ''}}>Bermusuhan</option>
                    <option value="Mudah Tersinggung"  {{$penilaian->sk_interaksi === "Mudah Tersinggung" ? 'selected' : ''}}>Mudah Tersinggung</option>
                    <option value="Curiga" {{$penilaian->sk_interaksi === "Curiga" ? 'selected' : ''}}>Curiga</option>
                    <option value="Defensif" {{$penilaian->sk_interaksi === "Defensif" ? 'selected' : ''}}>Defensif</option>
                    <option value="Kontak Mata Kurang" {{$penilaian->sk_interaksi === "Kontak Mata Kurang" ? 'selected' : ''}}>Kontak Mata Kurang</option>
                </select> --}}
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-5">
            <label for="sk_proses_pikir" class="form-label">Proses Pikir :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_proses_pikir" value="{{!empty($penilaian->sk_proses_pikir) ? $penilaian->sk_proses_pikir : ''}}">
                {{-- <select class="form-select" id="sk_proses_pikir"  name="sk_proses_pikir" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_proses_pikir === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Sesuai" {{$penilaian->sk_proses_pikir === "Sesuai" ? 'selected' : ''}}>Sesuai</option>
                    <option value="Sirkumsial" {{$penilaian->sk_proses_pikir === "Sirkumsial" ? 'selected' : ''}}>Sirkumsial</option>
                    <option value="Kehilangan Asosiasi" {{$penilaian->sk_proses_pikir === "Kehilangan Asosiasi" ? 'selected' : ''}}>Kehilangan Asosiasi</option>
                    <option value="Flight Of Ideas" {{$penilaian->sk_proses_pikir === "Flight Of Ideas" ? 'selected' : ''}}>Flight Of Ideas</option>
                    <option value="Bloking" {{$penilaian->sk_proses_pikir === "Bloking" ? 'selected' : ''}}>Bloking</option>
                    <option value="Pengulangan Pembicaraan" {{$penilaian->sk_proses_pikir === "Pengulangan Pembicaraan" ? 'selected' : ''}}>Pengulangan Pembicaraan</option>
                    <option value="Tangensial" {{$penilaian->sk_proses_pikir === "Tangensial" ? 'selected' : ''}}>Tangensial</option>
                </select> --}}
            </div>
        </div>
        <div class="col-7">
            <label for="sk_daya_tilik_diri" class="form-label">Daya Tilik Diri :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_daya_tilik_diri" value="{{!empty($penilaian->sk_daya_tilik_diri) ? $penilaian->sk_daya_tilik_diri : ''}}">
                {{-- <select class="form-select" id="sk_daya_tilik_diri"  name="sk_daya_tilik_diri" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_daya_tilik_diri === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Mengingkari Penyakit Yang Diderita" {{$penilaian->sk_daya_tilik_diri === "Mengingkari Penyakit Yang Diderita" ? 'selected' : ''}}>Mengingkari Penyakit Yang Diderita</option>
                    <option value="Menyalahkan Hal-hal Diluar Dirinya" {{$penilaian->sk_daya_tilik_diri === "Menyalahkan Hal-hal Diluar Dirinya" ? 'selected' : ''}}>Menyalahkan Hal-hal Diluar Dirinya</option>
                </select> --}}
                <input readonly type="text" id="ket_sk_daya_tilik_diri" name="ket_sk_daya_tilik_diri" class="form-control w-100 ms-1" value="{{!empty($penilaian->ket_sk_daya_tilik_diri) ? $penilaian->ket_sk_daya_tilik_diri : ''}} ">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <label for="sk_memori" class="form-label">Memori :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_memori" value="{{!empty($penilaian->sk_memori) ? $penilaian->sk_memori : ''}}">
                {{-- <select class="form-select" id="sk_memori"  name="sk_memori" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_memori === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Ganguan Daya Ingat Jangka Pendek" {{$penilaian->sk_memori === "Ganguan Daya Ingat Jangka Pendek" ? 'selected' : ''}}>Ganguan Daya Ingat Jangka Pendek</option>
                    <option value="Ganguan Daya Ingat Jangka Panjang" {{$penilaian->sk_memori === "Ganguan Daya Ingat Jangka Panjang" ? 'selected' : ''}}>Ganguan Daya Ingat Jangka Panjang</option>
                    <option value="Ganguan Daya Ingat Saat Ini','Konfabulasi" {{$penilaian->sk_memori === "Ganguan Daya Ingat Saat Ini','Konfabulasi" ? 'selected' : ''}}>Ganguan Daya Ingat Saat Ini','Konfabulasi</option>
                </select> --}}
            </div>
        </div>
        <div class="col-6">
            <label for="sk_konsentrasi" class="form-label">Tingkat Konsentrasi & Berhitung :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_konsentrasi" value="{{!empty($penilaian->sk_konsentrasi) ? $penilaian->sk_konsentrasi : ''}}">
                {{-- <select class="form-select" id="sk_konsentrasi"  name="sk_konsentrasi" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_konsentrasi === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Konsentrasi Baik" {{$penilaian->sk_konsentrasi === "Konsentrasi Baik" ? 'selected' : ''}}>Konsentrasi Baik</option>
                    <option value="Mudah Beralih" {{$penilaian->sk_konsentrasi === "Mudah Beralih" ? 'selected' : ''}}>Mudah Beralih</option>
                    <option value="Tidak Mampu Berkonsentrasi" {{$penilaian->sk_konsentrasi === "Tidak Mampu Berkonsentrasi" ? 'selected' : ''}}>Tidak Mampu Berkonsentrasi</option>
                    <option value="Tidak Mampu Berhitung Sederhana" {{$penilaian->sk_konsentrasi === "Tidak Mampu Berhitung Sederhana" ? 'selected' : ''}}>Tidak Mampu Berhitung Sederhana</option>
                </select> --}}
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <label for="sk_persepsi" class="form-label">Persepsi :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_persepsi" value="{{!empty($penilaian->sk_persepsi) ? $penilaian->sk_persepsi : ''}}">
                {{-- <select class="form-select w-50" id="sk_persepsi"  name="sk_persepsi" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_persepsi === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Halusinasi" {{$penilaian->sk_persepsi === "Halusinasi" ? 'selected' : ''}}>Halusinasi</option>
                    <option value="Pendengaran" {{$penilaian->sk_persepsi === "Pendengaran" ? 'selected' : ''}}>Pendengaran</option>
                    <option value="Penghidung" {{$penilaian->sk_persepsi === "Penghidung" ? 'selected' : ''}}>Penghidung</option>
                    <option value="Penglihatan" {{$penilaian->sk_persepsi === "Penglihatan" ? 'selected' : ''}}>Penglihatan</option>
                    <option value="Pengecapan" {{$penilaian->sk_persepsi === "Pengecapan" ? 'selected' : ''}}>Pengecapan</option>
                    <option value="Perabaan" {{$penilaian->sk_persepsi === "Perabaan" ? 'selected' : ''}}>Perabaan</option>
                </select> --}}
                <input readonly type="text" id="ket_sk_persepsi" name="ket_sk_persepsi" class="form-control ms-1" value="{{!empty($penilaian->ket_sk_persepsi) ? $penilaian->ket_sk_persepsi : ''}} ">
            </div>
        </div>
        <div class="col-6">
            <label for="sk_orientasi" class="form-label">Tingkat Kesadaran :</label>
            <div class="d-flex">
                <span class="me-2 mt-2">Orientasi:</span>
                <input readonly type="text" class="form-control" id="sk_orientasi" value="{{!empty($penilaian->sk_orientasi) ? $penilaian->sk_orientasi : ''}}">
                {{-- <select class="form-select" id="sk_orientasi"  name="sk_orientasi" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_orientasi === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->sk_orientasi === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->sk_orientasi === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <span class="me-2 mt-2">Ya:</span>
                <input readonly type="text" class="form-control" id="sk_tingkat_kesadaran_orientasi" value="{{!empty($penilaian->sk_tingkat_kesadaran_orientasi) ? $penilaian->sk_tingkat_kesadaran_orientasi : ''}}">
                {{-- <select class="form-select" id="sk_tingkat_kesadaran_orientasi"  name="sk_tingkat_kesadaran_orientasi" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_tingkat_kesadaran_orientasi === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Bingung" {{$penilaian->sk_tingkat_kesadaran_orientasi === "Bingung" ? 'selected' : ''}}>Bingung</option>
                    <option value="Sedasi" {{$penilaian->sk_tingkat_kesadaran_orientasi === "Sedasi" ? 'selected' : ''}}>Sedasi</option>
                    <option value="Waktu" {{$penilaian->sk_tingkat_kesadaran_orientasi === "Waktu" ? 'selected' : ''}}>Waktu</option>
                    <option value="Stupor" {{$penilaian->sk_tingkat_kesadaran_orientasi === "Stupor" ? 'selected' : ''}}>Stupor</option>
                    <option value="Tidak" {{$penilaian->sk_tingkat_kesadaran_orientasi === "Tidak" ? 'selected' : ''}} >Tempat</option>
                    <option value="Ya" {{$penilaian->sk_tingkat_kesadaran_orientasi === "Ya" ? 'selected' : ''}}>Orang</option>
                </select> --}}
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3">
            <label for="sk_isi_pikir" class="form-label">Isi Pikir :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_isi_pikir" value="{{!empty($penilaian->sk_isi_pikir) ? $penilaian->sk_isi_pikir : ''}}">
                {{-- <select class="form-select" id="sk_isi_pikir"  name="sk_isi_pikir" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_isi_pikir === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Sesuai" {{$penilaian->sk_isi_pikir === "Sesuai" ? 'selected' : ''}}>Sesuai</option>
                    <option value="Obsesi" {{$penilaian->sk_isi_pikir === "Obsesi" ? 'selected' : ''}}>Obsesi</option>
                    <option value="Fobia" {{$penilaian->sk_isi_pikir === "Fobia" ? 'selected' : ''}}>Fobia</option>
                    <option value="Hipokondria" {{$penilaian->sk_isi_pikir === "Hipokondria" ? 'selected' : ''}}>Hipokondria</option>
                    <option value="Depersonalisasi" {{$penilaian->sk_isi_pikir === "Depersonalisasi" ? 'selected' : ''}}>Depersonalisasi</option>
                    <option value="Pikiran Magis" {{$penilaian->sk_isi_pikir === "Pikiran Magis" ? 'selected' : ''}}>Pikiran Magis</option>
                    <option value="Ide Yang Terkait" {{$penilaian->sk_isi_pikir === "Ide Yang Terkait" ? 'selected' : ''}}>Ide Yang Terkait</option>
                    <option value="Waham" {{$penilaian->sk_isi_pikir === "Waham" ? 'selected' : ''}}>Waham</option>
                </select> --}}
            </div>
        </div>
        <div class="col-6">
            <label for="sk_waham" class="form-label">Waham :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_waham" value="{{!empty($penilaian->sk_waham) ? $penilaian->sk_waham : ''}}">
                {{-- <select class="form-select" id="sk_waham"  name="sk_waham" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_waham === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Kebesaran" {{$penilaian->sk_waham === "Kebesaran" ? 'selected' : ''}}>Kebesaran</option>
                    <option value="Curiga" {{$penilaian->sk_waham === "Curiga" ? 'selected' : ''}}>Curiga</option>
                    <option value="Agama" {{$penilaian->sk_waham === "Agama" ? 'selected' : ''}}>Agama</option>
                    <option value="Nihilistik" {{$penilaian->sk_waham === "Nihilistik" ? 'selected' : ''}}>Nihilistik</option>
                </select> --}}
                <input readonly type="text" id="ket_sk_waham" name="ket_sk_waham" class="form-control ms-1" value="{{!empty($penilaian->ket_sk_waham) ? $penilaian->ket_sk_waham : ''}}">
            </div>
        </div>
        <div class="col-3">
            <label for="sk_gangguan_ringan" class="form-label">Kemampuan Penilaian :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="sk_gangguan_ringan" value="{{!empty($penilaian->sk_gangguan_ringan) ? $penilaian->sk_gangguan_ringan : ''}}">
                {{-- <select class="form-select" id="sk_gangguan_ringan"  name="sk_gangguan_ringan" aria-label="Default select example">
                    <option value="-" {{$penilaian->sk_gangguan_ringan === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Gangguan Ringan" {{$penilaian->sk_gangguan_ringan === "Gangguan Ringan" ? 'selected' : ''}}>Gangguan Ringan</option>
                    <option value="Gangguan Bermakna" {{$penilaian->sk_gangguan_ringan === "Gangguan Bermakna" ? 'selected' : ''}}>Gangguan Bermakna</option>
                </select> --}}
            </div>
        </div>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">XII. KEBUTUHAN KOMUNIKASI DAN EDUKASI</h5>
    <div class="row mb-2">
        <div class="col-10 mt-4">
            <div class="d-flex">
                <label for="kk_pembelajaran" class="form-label mt-2">Terdapat hambatan Dalam Pembelajaran :</label>
                <input readonly type="text" class="form-control w-25" id="kk_pembelajaran" value="{{!empty($penilaian->kk_pembelajaran) ? $penilaian->kk_pembelajaran : ''}}">
                {{-- <select class="form-select me-3 w-25" id="kk_pembelajaran"  name="kk_pembelajaran" aria-label="Default select example">
                    <option value="-" {{$penilaian->kk_pembelajaran === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->kk_pembelajaran === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->kk_pembelajaran === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <span class="mt-2">Jika, ya:</span>
                <input readonly type="text" class="form-control w-25" id="ket_kk_pembelajaran" value="{{!empty($penilaian->ket_kk_pembelajaran) ? $penilaian->ket_kk_pembelajaran : ''}}">
                {{-- <select class="form-select me-3 w-25" id="ket_kk_pembelajaran"  name="ket_kk_pembelajaran" aria-label="Default select example">
                    <option value="-" {{$penilaian->ket_kk_pembelajaran === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Pendengaran" {{$penilaian->ket_kk_pembelajaran === "Pendengaran" ? 'selected' : ''}}>Pendengaran</option>
                    <option value="Penglihatan" {{$penilaian->ket_kk_pembelajaran === "Penglihatan" ? 'selected' : ''}}>Penglihatan</option>
                    <option value="Kognitif" {{$penilaian->ket_kk_pembelajaran === "Kognitif" ? 'selected' : ''}}>Kognitif</option>
                    <option value="Fisik" {{$penilaian->ket_kk_pembelajaran === "Fisik" ? 'selected' : ''}}>Fisik</option>
                    <option value="Budaya" {{$penilaian->ket_kk_pembelajaran === "Budaya" ? 'selected' : ''}}>Budaya</option>
                    <option value="Emosi" {{$penilaian->ket_kk_pembelajaran === "Emosi" ? 'selected' : ''}}>Emosi</option>
                    <option value="Bahasa" {{$penilaian->ket_kk_pembelajaran === "Bahasa" ? 'selected' : ''}}>Bahasa</option>
                    <option value="Lainnya" {{$penilaian->ket_kk_pembelajaran === "Lainnya" ? 'selected' : ''}}>Lainnya</option>
                </select> --}}
            </div>
        </div>
        <div class="col-2">
            <span>Lainnya :</span>
            <input readonly type="text" id="ket_kk_pembelajaran_lainnya" name="ket_kk_pembelajaran_lainnya" class="form-control ms-1 w-100" value="{{!empty($penilaian->ket_kk_pembelajaran_lainnya) ? $penilaian->ket_kk_pembelajaran_lainnya : ''}}">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-8 mt-4">
            <div class="d-flex">
                <label for="kk_Penerjamah" class="form-label mt-2">Dibutuhkan Penerjemah :</label>
                <input readonly type="text" class="form-control me-3 w-25" id="kk_Penerjamah" value="{{!empty($penilaian->kk_Penerjamah) ? $penilaian->kk_Penerjamah : ''}}">
                {{-- <select class="form-select me-3 w-25" id="kk_Penerjamah"  name="kk_Penerjamah" aria-label="Default select example">
                    <option value="-" {{$penilaian->kk_Penerjamah === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Tidak" {{$penilaian->kk_Penerjamah === "Tidak" ? 'selected' : ''}} >Tidak</option>
                    <option value="Ya" {{$penilaian->kk_Penerjamah === "Ya" ? 'selected' : ''}}>Ya</option>
                </select> --}}
                <span class="mt-2">Jika, ya:</span>
                <input readonly type="text" id="ket_kk_penerjamah_Lainnya" name="ket_kk_penerjamah_Lainnya" class="form-control ms-1 w-25" value="{{!empty($penilaian->ket_kk_penerjamah_Lainnya) ? $penilaian->ket_kk_penerjamah_Lainnya : ''}}">
            </div>
        </div>
        <div class="col-4">
            <span>Lainnya :</span>
            <input readonly type="text" class="form-control me-3" id="kk_bahasa_isyarat" value="{{!empty($penilaian->kk_bahasa_isyarat) ? $penilaian->kk_bahasa_isyarat : ''}}">
            {{-- <select class="form-select me-3" id="kk_bahasa_isyarat"  name="kk_bahasa_isyarat" aria-label="Default select example">
                <option value="-" {{$penilaian->fp_putus_obat === "-" ? 'selected' : ''}}>Pilih</option>
                <option value="Tidak" {{$penilaian->fp_putus_obat === "Tidak" ? 'selected' : ''}} >Tidak</option>
                <option value="Ya" {{$penilaian->fp_putus_obat === "Ya" ? 'selected' : ''}}>Ya</option>
            </select> --}}
        </div>
    </div>
    <div class="row mb-2 mt-4">
        <div class="col-6">
            <label for="kk_kebutuhan_edukasi" class="form-label">Kebutuhan Edukasi(Pilih Topik Edukasi Pada Kolom Yang tersedia) :</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" id="kk_kebutuhan_edukasi" value="{{!empty($penilaian->kk_kebutuhan_edukasi) ? $penilaian->kk_kebutuhan_edukasi : ''}}">
                {{-- <select class="form-select" id="kk_kebutuhan_edukasi"  name="kk_kebutuhan_edukasi" aria-label="Default select example">
                    <option value="-" {{$penilaian->kk_kebutuhan_edukasi === "-" ? 'selected' : ''}}>Pilih</option>
                    <option value="Diagnosa Dan Manajemen Penyakit" {{$penilaian->kk_kebutuhan_edukasi === "Diagnosa Dan Manajemen Penyakit" ? 'selected' : ''}}>Diagnosa Dan Manajemen Penyakit</option>
                    <option value="Obat-obatan/Terapi" {{$penilaian->kk_kebutuhan_edukasi === "Obat-obatan/Terapi" ? 'selected' : ''}}>Obat-obatan/Terapi</option>
                    <option value="Diet Dan Nutrisi" {{$penilaian->kk_kebutuhan_edukasi === "Diet Dan Nutrisi" ? 'selected' : ''}}>Diet Dan Nutrisi</option>
                    <option value="Tindakan Keperawatan" {{$penilaian->kk_kebutuhan_edukasi === "Tindakan Keperawatan" ? 'selected' : ''}}>Tindakan Keperawatan</option>
                    <option value="Rehabilitasi" {{$penilaian->kk_kebutuhan_edukasi === "Rehabilitasi" ? 'selected' : ''}}>Rehabilitasi</option>
                    <option value="Manajemen Nyeri" {{$penilaian->kk_kebutuhan_edukasi === "Manajemen Nyeri" ? 'selected' : ''}}>Manajemen Nyeri</option>
                    <option value="Lain-lain" {{$penilaian->kk_kebutuhan_edukasi === "Lain-lain" ? 'selected' : ''}}>Lain-lain</option>
                </select> --}}
            </div>
        </div>
        <div class="col-6">
            <label for="ket_kk_kebutuhan_edukasi" class="form-label">Lainya</label>
            <div class="d-flex">
                <input readonly type="text" class="form-control" name="ket_kk_kebutuhan_edukasi" id='ket_kk_kebutuhan_edukasi' value="{{!empty($penilaian->ket_kk_kebutuhan_edukasi) ? $penilaian->ket_kk_kebutuhan_edukasi : ''}}">
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
                                    {{$v->kode_masalah}}
                                </div>
                                <div>
                                    {{$v->nama_masalah}}
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
</div>
