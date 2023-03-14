<form action="{{url('/penilaian-perawat-psikiatri/create')}}" method="POST" id="penilaian_perawat_bayi_anak">
@csrf
<div class="row mb-3">
    @include('penilaian.form_header', ["pj_form_type"=>"petugas"])
    <div class="col mb-2">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input type="text" class="form-control input-daterange input-date-time" name="tanggal" id="tanggal"  required autocomplete="off" >
    </div>
    <div class="col mb-2">
        <label for="informasi" class="form-label">Informasi didapat dari : </label>
        <select class="form-select" id="informasi" name="informasi" aria-label="Default select " >
            <option value="-" selected>Pilih Informasi</option>
            <option value="Autoanamnesis" >Autoanamnesis</option>
            <option value="Alloanamnesis">Alloanamnesis</option>
        </select>
    </div>
</div>
<hr class="mb-5">
<div>
    <h5 class="text-start">I. RIWAYAT KESEHATAN</h5>
    <div class="row align-items-end">
        <div class="col-6 mb-2">
            <label for="keluhan_utama" class="form-label">Keluhan Utama</label>
            <textarea class="form-control" id="keluhan_utama" name="keluhan_utama" rows="3"></textarea>
        </div>
        <div class="col-6 mb-2">
            <label for="rkd_keluhan" class="form-label">Riwayat Penyakit Dahulu</label>
            <textarea class="form-control" id="rkd_keluhan" name="rkd_keluhan" rows="3"></textarea>
        </div>
        <div class="col-4 mb-2">
            <label for="rkd_sakit_sejak" class="form-label">Sakit Sejak</label>
            <input type="text" class="form-control w-75" name="rkd_sakit_sejak" id="rkd_sakit_sejak" value="">
        </div>
        <div class="col-4 mb-2">
            <label for="rkd_berobat" class="form-label">Berobat :  </label>
            <div class="d-flex">
                <select class="form-select " id="rkd_berobat"  name="rkd_berobat" aria-label="Default select example">
                <option value="-" selected>Pilih </option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya, Alternatif" >Ya, Alternatif</option>
                    <option value="Ya, RS">Ya, RS</option>
                    <option value="Ya, Puskesmas" >Ya, Puskesmas</option>
                </select>
        </div>
    </div>
    <div class="col-4 mb-2">
        <label for="rkd_hasil_pengobatan" class="form-label">Hasil Pengobatan :  </label>
        <div class="d-flex">
            <select class="form-select " id="rkd_hasil_pengobatan"  name="rkd_hasil_pengobatan" aria-label="Default select example">
            <option value="-" selected>Pilih </option>
                <option value="Berhasil" >Berhasil</option>
                <option value="Tidak Berhasil" >Tidak Berhasil</option>
            </select>
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
                <select class="form-select w-25 me-2" id="fp_putus_obat"  name="fp_putus_obat" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_putus_obat" id='ket_putus_obat' value="">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="fp_ekonomi" class="form-label">Masalah Ekonomi :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="fp_ekonomi"  name="fp_ekonomi" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_masalah_ekonomi" id='ket_masalah_ekonomi' value="">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="fp_masalah_fisik" class="form-label">Masalah Fisik :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="fp_masalah_fisik"  name="fp_masalah_fisik" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_masalah_fisik" id='ket_masalah_fisik' value="">
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="fp_masalah_psikososial" class="form-label">Masalah Psikososial :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="fp_masalah_psikososial"  name="fp_masalah_psikososial" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_masalah_psikososial" id='ket_masalah_psikososial' value="">
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
                <select class="form-select" id="rh_keluarga"  name="rh_keluarga" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="ket_rh_keluarga" class="form-label">Jika ya, Sebutkan : </label>
            <input type="text" class="form-control" name="ket_rh_keluarga" id='ket_rh_keluarga' value="">
        </div>
    </div>
    <div class="row">
        <div class="col-2 mb-2 ">
            <label for="resiko_bunuh_diri" class="form-label">Resiko Bunuh Diri : </label>
            <div class="d-flex">
                <select class="form-select" id="resiko_bunuh_diri"  name="resiko_bunuh_diri" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>
        <div class="col-5 mb-2">
            <label for="rbd_ide" class="form-label">Ada Ide :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="rbd_ide"  name="rbd_ide" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_rbd_ide" id='ket_rbd_ide' value="">
            </div>
        </div>
        <div class="col-5 mb-2">
            <label for="rbd_rencana" class="form-label">Ada Rencana :</label>
            <div class="d-flex">
                <select class="form-select w-25" id="rbd_rencana"  name="rbd_rencana" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_rbd_rencana" id='ket_rbd_rencana' value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-5 mb-2">
            <label for="rbd_alat" class="form-label">Mempersiapkan Alat : </label>
            <div class="d-flex">
                <select class="form-select w-25" id="rbd_alat"  name="rbd_alat" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_rbd_alat" id='ket_rbd_alat' value="">
            </div>
        </div>
        <div class="col-3 mb-2 ">
            <label for="rbd_percobaan" class="form-label">Pernah Mencoba Bunuh Diri : </label>
            <div class="d-flex">
                <select class="form-select" id="rbd_percobaan"  name="rbd_percobaan" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>
        <div class="col-4 mb-2">
            <label for="ket_rbd_percobaan" class="form-label">Kapan :</label>
            <div class="d-flex">
                <input type="text" class="form-control" name="ket_rbd_percobaan" id='ket_rbd_percobaan' value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-2 ">
            <label for="rbd_keinginan" class="form-label">Saat Ini Masih Ada Keinginan Untuk Bunuh Diri : </label>
            <div class="d-flex">
                <select class="form-select" id="rbd_keinginan"  name="rbd_keinginan" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="ket_rbd_keinginan" class="form-label">Jika ya, Dengan Cara : </label>
            <input type="text" class="form-control" name="ket_rbd_keinginan" id='ket_rbd_keinginan' value="">
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
                <select class="form-select w-25 me-2" id="rpo_penggunaan"  name="rpo_penggunaan" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_rpo_penggunaan" id='ket_rpo_penggunaan' value="">
            </div>
        </div>
        <div class="col">
            <label for="rpo_penggunaan_obat_lainnya" class="form-label">Penggunaan Obat Lainya : </label>
            <div class="d-flex">
                <select class="form-select w-25 me-2" id="rpo_penggunaan_obat_lainnya"  name="rpo_penggunaan_obat_lainnya" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_penggunaan_obat_lainnya" id='ket_penggunaan_obat_lainnya' value="">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <label for="rpo_efek_samping" class="form-label">Efek Samping Obat Psikiatri : </label>
            <div class="d-flex">
                <select class="form-select w-25 me-2" id="rpo_efek_samping"  name="rpo_efek_samping" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_rpo_efek_samping" id='ket_rpo_efek_samping' value="">
            </div>
        </div>
        <div class="col">
            <label for="ket_alasan_penggunaan" class="form-label">Alasan Penggunaan : </label>
            <div class="d-flex">
                <input type="text" class="form-control" name="ket_alasan_penggunaan" id='ket_alasan_penggunaan' value="">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <label for="rpo_napza" class="form-label">Riwayat Pengguaan Napza : </label>
            <div class="d-flex">
                <select class="form-select w-25 me-2" id="rpo_napza"  name="rpo_napza" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_rpo_napza" id='ket_rpo_napza' value="">
            </div>
        </div>
        <div class="col">
            <label for="rpo_alergi_obat" class="form-label">Riwayat Alergi Obat : </label>
            <div class="d-flex">
                <select class="form-select w-25 me-2" id="rpo_alergi_obat"  name="rpo_alergi_obat" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_alergi_obat" id='ket_alergi_obat' value="">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3">
            <label for="ket_lama_pemakaian" class="form-label">Lama : </label>
            <div class="d-flex">
                <input type="text" class="form-control" name="ket_lama_pemakaian" id='ket_lama_pemakaian' value="">
            </div>
        </div>
        <div class="col-3">
            <label for="ket_cara_pemakaian" class="form-label">Cara Pakai : </label>
            <div class="d-flex">
                <input type="text" class="form-control" name="ket_cara_pemakaian" id='ket_cara_pemakaian' value="">
            </div>
        </div>
        <div class="col-6">
            <label for="rpo_merokok" class="form-label">Merokok : </label>
            <div class="d-flex">
                <select class="form-select w-25 me-2" id="rpo_merokok"  name="rpo_merokok" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-50" name="ket_merokok" id='ket_merokok' value=""><span class="mt-2">Batang/Hari</span>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <label for="ket_latar_belakang_pemakaian" class="form-label">Latar Belakang : </label>
            <div class="d-flex">
                <input type="text" class="form-control" name="ket_latar_belakang_pemakaian" id='ket_latar_belakang_pemakaian' value="">
            </div>
        </div>
        <div class="col-6">
            <label for="rpo_minum_kopi" class="form-label">Minum Kopi : </label>
            <div class="d-flex">
                <select class="form-select w-25 me-2" id="rpo_minum_kopi"  name="rpo_minum_kopi" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-50" name="ket_minum_kopi" id='ket_minum_kopi' value=""><span class="mt-2">Gelas/Hari</span>
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
                <select class="form-select w-25 me-2" id="pf_keluhan_fisik"  name="pf_keluhan_fisik" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <input type="text" class="form-control w-75" name="ket_keluhan_fisik" id='ket_keluhan_fisik' value="">
            </div>
        </div>
    </div>
    <div class="row  mb-2">
        <div class="col-3">
            <label for="td" class="form-label">TD : </label>
            <div class="input-group">
                <input type="text" name="td" id="td" class="form-control">
                <span class="input-group-text" id="ModalPetugas">mmHg</span>
            </div>
        </div>
        <div class="col-2">
            <label for="nadi" class="form-label">Nadi : </label>
            <div class="input-group">
                <input type="text" id="nadi" name="nadi" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-2">
            <label for="rr" class="form-label">RR : </label>
            <div class="input-group">
                <input type="text" id="rr" name="rr" class="form-control">
                <span class="input-group-text" id="ModalPetugas">x / Menit</span>
            </div>
        </div>
        <div class="col-2">
            <label for="suhu" class="form-label">Suhu : </label>
            <div class="input-group">
                <input type="text" id="suhu" name="suhu" class="form-control">
                <span class="input-group-text" id="ModalPetugas">&#8451;</span>
            </div>
        </div>
        <div class="col-3">
            <label for="gcs" class="form-label">GCS(E, V, M) : </label>
            <div class="input-group">
                <input type="text" id="gcs" name="gcs" class="form-control">
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
                    <select class="form-select w-25 me-2" id="nyeri_hilang"  name="nyeri_hilang" aria-label="Default select example">
                        <option value="-" selected>Pilih</option>
                        <option value="Istirahat" >Istirahat</option>
                        <option value="Medengar Musik" >Medengar Musik</option>
                        <option value="Tidak" >Minum Obat</option>
                    </select>
                    <input type="text" class="form-control w-75" name="ket_nyeri" id='ket_nyeri' value="">
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="row">
                <div class="col-4 mt-4">
                    <div class="d-flex">
                        <select class="form-select me-2" id="nyeri"  name="nyeri" aria-label="Default select example">
                            <option value="-" selected>Tingkatan Nyeri</option>
                            <option value="Tidak Ada Nyeri" >Tidak Ada Nyeri</option>
                            <option value="Nyeri Akut">Nyeri Akut</option>
                            <option value="Nyeri Kronis">Nyeri Kronis</option>
                        </select>
                    </div>
                </div>
                <div class="col-8">
                    <label for="provokes" class="form-label">Penyebab : </label>
                    <div class="d-flex">
                        <select class="form-select w-25 me-2" id="provokes"  name="provokes" aria-label="Default select example">
                            <option value="-" selected>Pilih</option>
                            <option value="Proses Penyakit" >Proses Penyakit</option>
                            <option value="Benturan">Benturan</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                        <input type="text" class="form-control w-75" name="ket_provokes" id='ket_provokes' value="">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="quality" class="form-label">Kualitas : </label>
                    <div class="d-flex">
                        <select class="form-select w-25 me-2" id="quality"  name="quality" aria-label="Default select example">
                            <option value="-" selected>Pilih</option>
                            <option value="Seperti Tertusuk" >Seperti Tertusuk</option>
                            <option value="Berdenyut">Berdenyut</option>
                            <option value="Teriris">Teriris</option>
                            <option value="Tertindih">Tertindih</option>
                            <option value="Tertiban">Tertiban</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                        <input type="text" class="form-control w-75" name="ket_quality" id='ket_quality' value="">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <span>Wilayah :</span>
                <div class="col-6">
                    <label for="lokasi" class="form-label ms-5">Lokasi : </label>
                    <div class="d-flex">
                        <input type="text" class="form-control" name="lokasi" id='lokasi' value="">
                    </div>
            </div>
            <div class="col-6">
                <label for="menyebar" class="form-label">Menyebar : </label>
                <div class="d-flex">
                    <select class="form-select me-2" id="menyebar"  name="menyebar" aria-label="Default select example">
                        <option value="-" selected>Pilih</option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ya">Ya</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="skala_nyeri" class="form-label">Severity : Skala Nyeri</label>
                <div class="d-flex">
                    <select class=" form-select" id="skala_nyeri"  name="skala_nyeri" aria-label="Default select example">
                        <option value="-" selected>Pilih Skala Nyeri</option>
                            @for($i=0; $i <=10 ;$i++)
                                <option value="{{$i}}" >{{$i}}</option>
                            @endfor
                        </select>
                </div>
            </div>
            <div class="col">
                <label for="durasi" class="form-label">Waktu/Durasi : </label>
                <div class="input-group">
                    <input type="text" id="durasi" name="durasi" class="form-control">
                    <span class="input-group-text" id="ModalPetugas">Menit</span>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="pada_dokter" class="form-label">Diberitahukan Pada Dokter ?</label>
                <div class="d-flex">
                    <select class="form-select" id="pada_dokter"  name="pada_dokter" aria-label="Default select example">
                        <option value="-" selected>Pilih</option>
                        <option value="Tidak" >Tidak</option>
                        <option value="Ya">Ya</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <label for="ket_dokter" class="form-label">Jam : </label>
                <div class="input-group">
                    <input type="text" id="ket_dokter" name="ket_dokter" class="form-control">
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
                <input type="text" id="bb" name="bb" class="form-control">
                <span class="input-group-text" >Kg</span>
            </div>
        </div>
        <div class="col-2">
            <label for="tb" class="form-label">TB : </label>
            <div class="input-group">
                <input type="text" id="tb" name="tb" class="form-control">
                <span class="input-group-text" >cm</span>
            </div>
        </div>
        <div class="col-2">
            <label for="bmi" class="form-label">BMI : </label>
            <div class="input-group">
                <input type="text" id="bmi" name="bmi" class="form-control">
                <span class="input-group-text" >Kg / m&#178;</span>
            </div>
        </div>
        <div class="col-3">
            <label for="lapor_status_nutrisi" class="form-label">Dilaporkan Kepada DPJP ?</label>
            <div class="d-flex">
                <select class="form-select" id="lapor_status_nutrisi"  name="lapor_status_nutrisi" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>
        <div class="col-3">
            <label for="ket_lapor_status_nutrisi" class="form-label">Jam Dilaporkan : </label>
            <div class="input-group">
                <input type="text" id="ket_lapor_status_nutrisi" name="ket_lapor_status_nutrisi" class="form-control">
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
                <select class="form-select w-25 me-3" id="sg1"  name="sg1" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Tidak Yakin">Tidak Yakin</option>
                    <option value="Ya, 1-5 Kg" >Ya, 1-5 Kg</option>
                    <option value="Ya, 6-10 Kg" >Ya, 6-10 Kg</option>
                    <option value="Ya, 11-15 Kg" >Ya, 11-15 Kg</option>
                    <option value="Ya, >15 Kg" >Ya, >15 Kg</option>
                </select>
                <span class="mt-2" style="width: 5%">Nilai :</span>
                <select class=" form-select w-25" id="nilai1"  name="nilai1" aria-label="Default select example">
                    <option value="-" selected>Pilih Nilai</option>
                        @for($i=0; $i <=4 ;$i++)
                            <option value="{{$i}}" >{{$i}}</option>
                        @endfor
                    </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mb-2">
            <div class="d-flex">
                <label for="sg2" class="form-label mt-2">2. Apakah nafsu makan berkurang, karena tidak nafsu makan ?</label>
                <select class="form-select w-25 me-3" id="sg2"  name="sg2" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >0</option>
                    <option value="Ya">Ya</option>
                </select>
                <span class="mt-2" style="width: 5%">Nilai :</span>
                <select class="form-select w-25" id="nilai2"  name="nilai2" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="0" >0</option>
                    <option value="0">1</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row position-relative">
        <div class="col-5 position-absolute top-0 end-0">
            <div class="d-flex">
                <label for="total_hasil" class="form-label w-50">Total Skor : </label>
                <div class="input-group">
                    <input type="text" id="total_hasil" name="total_hasil" class="form-control">
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
                <select class="form-select w-25" id="resikojatuh"  name="resikojatuh" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>
        <div class="col-7 mt-4">
            <div class="d-flex">
                <label for="bjm" class="form-label mt-1 me-1 w-75">2. Jalan dengan menggunakan alat bantu(kruk,tripot,kursi roda,orang lain) :</label>
                <select class="form-select w-25" id="bjm"  name="bjm" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-2 mb-2">
        <div class="col mb-2">
            <div class="d-flex">
                <label for="msa" class="form-label mt-2">b. Menopang saat akan duduk, tampak memegang pinggiran kursi atau meja/benda lain sebagai penopang :</label>
                <select class="form-select w-25 me-3" id="msa"  name="msa" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-5">
            <div class="d-flex">
                <label for="hasil" class="form-label mt-2 me-1">Hasil:</label>
                <select class="form-select ms-2" id="hasil"  name="hasil" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak beresiko (tidak ditemukan a dan b)" >Tidak beresiko (tidak ditemukan a dan b)</option>
                    <option value="Resiko rendah (ditemukan a/b)" >Resiko rendah (ditemukan a/b)</option>
                    <option value="Resiko tinggi (ditemukan a dan b)" >Resiko tinggi (ditemukan a dan b)</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex">
                <label for="lapor" class="form-label mt-2 me-1">Dilaporkan kepada dokter ?</label>
                <select class="form-select ms-2 w-25" id="lapor"  name="lapor" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex">
                <label for="ket_lapor" class="form-label mt-2 me-1">Jam dilaporkan:</label>
                <input type="text" id="ket_lapor" name="ket_lapor" class="form-control w-50">
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
            <select class="form-select ms-2" id="adl_mandi"  name="adl_mandi" aria-label="Default select example">
                <option value="-" selected>Pilih</option>
                <option value="Mandiri" >Mandiri</option>
                <option value="Bantuan Minimal" >Bantuan Minimal</option>
                <option value="Bantuan Total">Bantuan Total</option>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="d-flex">
            <label for="adl_sosialisasi" class="form-label mt-2 me-1">Sosialisasi:</label>
            <select class="form-select ms-2 w-25" id="adl_sosialisasi"  name="adl_sosialisasi" aria-label="Default select example">
                <option value="-" selected>Pilih</option>
                <option value="Tidak" >Tidak</option>
                <option value="Ya">Ya</option>
            </select>
            <input type="text" id="ket_adl_sosialisasi" name="ket_adl_sosialisasi" class="form-control w-50 ms-1">
        </div>
    </div>
    <div class="col-3">
        <div class="d-flex">
            <label for="adl_berpakaian" class="form-label mt-2 me-1">Berpakaian:</label>
            <select class="form-select ms-2" id="adl_berpakaian"  name="adl_berpakaian" aria-label="Default select example">
                <option value="-" selected>Pilih</option>
                <option value="Mandiri" >Mandiri</option>
                <option value="Bantuan Minimal" >Bantuan Minimal</option>
                <option value="Bantuan Total">Bantuan Total</option>
            </select>
        </div>
    </div>
   </div>
   <div class="row mb-2">
    <div class="col-3">
        <div class="d-flex">
            <label for="adl_bak" class="form-label mt-2 me-1">Bak:</label>
            <select class="form-select ms-2" id="adl_bak"  name="adl_bak" aria-label="Default select example">
                <option value="-" selected>Pilih</option>
                <option value="Mandiri" >Mandiri</option>
                <option value="Bantuan Minimal" >Bantuan Minimal</option>
                <option value="Bantuan Total">Bantuan Total</option>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="d-flex">
            <label for="adl_hobi" class="form-label mt-2 w-25">Melakukan Hobi:</label>
            <select class="form-select ms-2 w-25" id="adl_hobi"  name="adl_hobi" aria-label="Default select example">
                <option value="-" selected>Pilih</option>
                <option value="Tidak" >Tidak</option>
                <option value="Ya">Ya</option>
            </select>
            <input type="text" id="ket_adl_hobi" name="ket_adl_hobi" class="form-control w-50 ms-1">
        </div>
    </div>
    <div class="col-3">
        <div class="d-flex">
            <label for="adl_makan" class="form-label mt-2 me-1">Makan/Minum:</label>
            <select class="form-select ms-2" id="adl_makan"  name="adl_makan" aria-label="Default select example">
                <option value="-" selected>Pilih</option>
                <option value="Mandiri" >Mandiri</option>
                <option value="Bantuan Minimal" >Bantuan Minimal</option>
                <option value="Bantuan Total">Bantuan Total</option>
            </select>
        </div>
    </div>
   </div>
   <div class="row mb-2">
    <div class="col-3">
        <div class="d-flex">
            <label for="adl_bab" class="form-label mt-2 me-1">BAB:</label>
            <select class="form-select ms-2" id="adl_bab"  name="adl_bab" aria-label="Default select example">
                <option value="-" selected>Pilih</option>
                <option value="Mandiri" >Mandiri</option>
                <option value="Bantuan Minimal" >Bantuan Minimal</option>
                <option value="Bantuan Total">Bantuan Total</option>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="d-flex">
            <label for="adl_kegiatan" class="form-label mt-2 me-1">Kegiatan RT:</label>
            <select class="form-select ms-2 w-25" id="adl_kegiatan"  name="adl_kegiatan" aria-label="Default select example">
                <option value="-" selected>Pilih</option>
                <option value="Tidak" >Tidak</option>
                <option value="Ya">Ya</option>
            </select>
            <input type="text" id="ket_adl_kegiatan" name="ket_adl_kegiatan" class="form-control w-50 ms-1">
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
                <select class="form-select" id="sk_penampilan"  name="sk_penampilan" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Bersih" >Bersih</option>
                    <option value="Rapi" >Rapi</option>
                    <option value="Tidak Rapi" >Tidak Rapi</option>
                    <option value="Kotor" >Kotor</option>
                    <option value="Tidak Seperti Biasanya" >Tidak Seperti Biasanya</option>
                    <option value="Pakaian Tidak Sesuai">Pakaian Tidak Sesuai</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <label for="sk_pembicaraan" class="form-label">Pembicara :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_pembicaraan"  name="sk_pembicaraan" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Sesuai" >Sesuai</option>
                    <option value="Cepat" >Cepat</option>
                    <option value="Lambat" >Lambat</option>
                    <option value="Membisu" >Membisu</option>
                    <option value="Mendominasi" >Mendominasi</option>
                    <option value="Mengancam" >Mengancam</option>
                    <option value="Inkoheren" >Inkoheren</option>
                    <option value="Apatis" >Apatis</option>
                    <option value="Keras" >Keras</option>
                    <option value="Tidak Mampu Memulai Pembicaraan">Tidak Mampu Memulai Pembicaraan</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <label for="sk_alam_perasaan" class="form-label">Alam Perasaan :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_alam_perasaan"  name="sk_alam_perasaan" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Sesuai" >Sesuai</option>
                    <option value="Marah" >Marah</option>
                    <option value="Putus Asa" >Putus Asa</option>
                    <option value="Tertekan" >Tertekan</option>
                    <option value="Sedih" >Sedih</option>
                    <option value="Labil" >Labil</option>
                    <option value="Malu" >Malu</option>
                    <option value="Khawatir" >Khawatir</option>
                    <option value="Gembira Berlebihan" >Gembira Berlebihan</option>
                    <option value="Merasa Tidak Mampu" >Merasa Tidak Mampu</option>
                    <option value="Ketakutan" >Ketakutan</option>
                    <option value="Tidak Berguna" >Tidak Berguna</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-4">
            <label for="sk_afek" class="form-label">Afek :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_afek"  name="sk_afek" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Sesuai" >Sesuai</option>
                    <option value="Datar" >Datar</option>
                    <option value="Tumpul" >Tumpul</option>
                    <option value="Labil" >Labil</option>
                    <option value="Tidak Sesuai" >Tidak Sesuai</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <label for="sk_aktifitas_motorik" class="form-label">Aktivitas Motorik/Prilaku :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_aktifitas_motorik"  name="sk_aktifitas_motorik" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    'Normal','Tegang','Gelisah','Lesuh','Grimasem','TIK','Tremor','Agitasi','Konfulsif','Melamun','Sulit Diarahkan'
                    <option value="Normal" >Normal</option>
                    <option value="Tegang" >Tegang</option>
                    <option value="Gelisah" >Gelisah</option>
                    <option value="Grimasem" >Grimasem</option>
                    <option value="TIK" >TIK</option>
                    <option value="Tremor" >Tremor</option>
                    <option value="Agitasi" >Agitasi</option>
                    <option value="Konfulsif" >Konfulsif</option>
                    <option value="Melamun" >Melamun</option>
                    <option value="Sulit Diarahkan">Sulit Diarahkan</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <label for="sk_interaksi" class="form-label">Interaksi Selama Wawancara :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_interaksi"  name="sk_interaksi" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Kooperatif" >Kooperatif</option>
                    <option value="Tidak Kooperatif" >Tidak Kooperatif</option>
                    <option value="Bermusuhan" >Bermusuhan</option>
                    <option value="Mudah Tersinggung" >Mudah Tersinggung</option>
                    <option value="Curiga">Curiga</option>
                    <option value="Defensif">Defensif</option>
                    <option value="Kontak Mata Kurang">Kontak Mata Kurang</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-5">
            <label for="sk_proses_pikir" class="form-label">Proses Pikir :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_proses_pikir"  name="sk_proses_pikir" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Sesuai" >Sesuai</option>
                    <option value="Sirkumsial" >Sirkumsial</option>
                    <option value="Kehilangan Asosiasi" >Kehilangan Asosiasi</option>
                    <option value="Flight Of Ideas" >Flight Of Ideas</option>
                    <option value="Bloking" >Bloking</option>
                    <option value="Pengulangan Pembicaraan" >Pengulangan Pembicaraan</option>
                    <option value="Tangensial" >Tangensial</option>
                </select>
            </div>
        </div>
        <div class="col-7">
            <label for="sk_daya_tilik_diri" class="form-label">Daya Tilik Diri :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_daya_tilik_diri"  name="sk_daya_tilik_diri" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Mengingkari Penyakit Yang Diderita" >Mengingkari Penyakit Yang Diderita</option>
                    <option value="Menyalahkan Hal-hal Diluar Dirinya">Menyalahkan Hal-hal Diluar Dirinya</option>
                </select>
                <input type="text" id="ket_sk_daya_tilik_diri" name="ket_sk_daya_tilik_diri" class="form-control w-100 ms-1">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <label for="sk_memori" class="form-label">Memori :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_memori"  name="sk_memori" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Ganguan Daya Ingat Jangka Pendek" >Ganguan Daya Ingat Jangka Pendek</option>
                    <option value="Ganguan Daya Ingat Jangka Panjang">Ganguan Daya Ingat Jangka Panjang</option>
                    <option value="Ganguan Daya Ingat Saat Ini">Ganguan Daya Ingat Saat Ini'</option>
                    <option value="Konfabulasi">Konfabulasi</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <label for="sk_konsentrasi" class="form-label">Tingkat Konsentrasi & Berhitung :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_konsentrasi"  name="sk_konsentrasi" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Konsentrasi Baik" >Konsentrasi Baik</option>
                    <option value="Mudah Beralih" >Mudah Beralih</option>
                    <option value="Tidak Mampu Berkonsentrasi" >Tidak Mampu Berkonsentrasi</option>
                    <option value="Tidak Mampu Berhitung Sederhana" >Tidak Mampu Berhitung Sederhana</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <label for="sk_persepsi" class="form-label">Persepsi :</label>
            <div class="d-flex">
                <select class="form-select w-50" id="sk_persepsi"  name="sk_persepsi" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Halusinasi" >Halusinasi</option>
                    <option value="Pendengaran" >Pendengaran</option>
                    <option value="Penghidung" >Penghidung</option>
                    <option value="Penglihatan" >Penglihatan</option>
                    <option value="Pengecapan" >Pengecapan</option>
                    <option value="Perabaan" >Perabaan</option>
                </select>
                <input type="text" id="ket_sk_persepsi" name="ket_sk_persepsi" class="form-control ms-1">
            </div>
        </div>
        <div class="col-6">
            <label for="sk_orientasi" class="form-label">Tingkat Kesadaran :</label>
            <div class="d-flex">
                <span class="me-2 mt-2">Orientasi:</span>
                <select class="form-select" id="sk_orientasi"  name="sk_orientasi" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <span class="me-2 mt-2">Ya:</span>
                <select class="form-select" id="sk_tingkat_kesadaran_orientasi"  name="sk_tingkat_kesadaran_orientasi" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Bingung" >Bingung</option>
                    <option value="Sedasi" >Sedasi</option>
                    <option value="Waktu" >Waktu</option>
                    <option value="Stupor" >Stupor</option>
                    <option value="Tidak" >Tempat</option>
                    <option value="Ya">Orang</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3">
            <label for="sk_isi_pikir" class="form-label">Isi Pikir :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_isi_pikir"  name="sk_isi_pikir" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Sesuai" >Sesuai</option>
                    <option value="Obsesi" >Obsesi</option>
                    <option value="Fobia" >Fobia</option>
                    <option value="Hipokondria" >Hipokondria</option>
                    <option value="Depersonalisasi" >Depersonalisasi</option>
                    <option value="Pikiran Magis" >Pikiran Magis</option>
                    <option value="Ide Yang Terkait" >Ide Yang Terkait</option>
                    <option value="Waham" >Waham</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <label for="sk_waham" class="form-label">Waham :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_waham"  name="sk_waham" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Kebesaran" >Kebesaran</option>
                    <option value="Curiga" >Curiga</option>
                    <option value="Agama" >Agama</option>
                    <option value="Nihilistik" >Nihilistik</option>
                </select>
                <input type="text" id="ket_sk_waham" name="ket_sk_waham" class="form-control ms-1">
            </div>
        </div>
        <div class="col-3">
            <label for="sk_gangguan_ringan" class="form-label">Kemampuan Penilaian :</label>
            <div class="d-flex">
                <select class="form-select" id="sk_gangguan_ringan"  name="sk_gangguan_ringan" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Gangguan Ringan" >Gangguan Ringan</option>
                    <option value="Gangguan Bermakna">Gangguan Bermakna</option>
                </select>
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
                <select class="form-select me-3 w-25" id="kk_pembelajaran"  name="kk_pembelajaran" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <span class="mt-2">Jika, ya:</span>
                <select class="form-select me-3 w-25" id="ket_kk_pembelajaran"  name="ket_kk_pembelajaran" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Pendengaran" >Pendengaran</option>
                    <option value="Penglihatan" >Penglihatan</option>
                    <option value="Kognitif" >Kognitif</option>
                    <option value="Fisik" >Fisik</option>
                    <option value="Budaya" >Budaya</option>
                    <option value="Emosi" >Emosi</option>
                    <option value="Bahasa" >Bahasa</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="col-2">
            <span>Lainnya :</span>
            <input type="text" id="ket_kk_pembelajaran_lainnya" name="ket_kk_pembelajaran_lainnya" class="form-control ms-1 w-100">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-8 mt-4">
            <div class="d-flex">
                <label for="kk_Penerjamah" class="form-label mt-2">Dibutuhkan Penerjemah :</label>
                <select class="form-select me-3 w-25" id="kk_Penerjamah"  name="kk_Penerjamah" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Tidak" >Tidak</option>
                    <option value="Ya">Ya</option>
                </select>
                <span class="mt-2">Jika, ya:</span>
                <input type="text" id="ket_kk_penerjamah_Lainnya" name="ket_kk_penerjamah_Lainnya" class="form-control ms-1 w-25">
            </div>
        </div>
        <div class="col-4">
            <span>Lainnya :</span>
            <select class="form-select me-3" id="kk_bahasa_isyarat"  name="kk_bahasa_isyarat" aria-label="Default select example">
                <option value="-" selected>Pilih</option>
                <option value="Tidak" >Tidak</option>
                <option value="Ya">Ya</option>
            </select>
        </div>
    </div>
    <div class="row mb-2 mt-4">
        <div class="col-6">
            <label for="kk_kebutuhan_edukasi" class="form-label">Kebutuhan Edukasi(Pilih Topik Edukasi Pada Kolom Yang tersedia) :</label>
            <div class="d-flex">
                <select class="form-select" id="kk_kebutuhan_edukasi"  name="kk_kebutuhan_edukasi" aria-label="Default select example">
                    <option value="-" selected>Pilih</option>
                    <option value="Diagnosa Dan Manajemen Penyakit" >Diagnosa Dan Manajemen Penyakit</option>
                    <option value="Obat-obatan/Terapi" >Obat-obatan/Terapi</option>
                    <option value="Diet Dan Nutrisi" >Diet Dan Nutrisi</option>
                    <option value="Tindakan Keperawatan" >Tindakan Keperawatan</option>
                    <option value="Rehabilitasi" >Rehabilitasi</option>
                    <option value="Manajemen Nyeri" >Manajemen Nyeri</option>
                    <option value="Lain-lain" >Lain-lain</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <label for="ket_kk_kebutuhan_edukasi" class="form-label">Lainya</label>
            <div class="d-flex">
                <input type="text" class="form-control" name="ket_kk_kebutuhan_edukasi" id='ket_kk_kebutuhan_edukasi' value="">
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
                    @foreach($masalah_keperawatan_list as $v)
                        <div class="form-check d-flex justify-content-between mb-2 align-items-center">
                            <input class="form-check-input" type="checkbox" value="{{$v->kode_masalah}}" id="m_{{$v->kode_masalah}}" name="mslh_{{$v->kode_masalah}}">
                            <label class="form-check-label  w-100 text-end" for="m_{{$v->kode_masalah}}" >
                                {{$v->nama_masalah}}
                            </label>
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
                        <textarea class="form-control" id="rencana" name="rencana" rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>


<!-- Modal Petugas Daftar Tindakan -->
<div class="modal fade bagan-data-table" id="showModalPetugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content overflow-auto">
                <div class="modal-header border-0 pb-0">
                    <div class="col-6">
                        <div class="d-flex justify-content-center align-items-center border">
                            <input type="text" class="form-control border-0 search-data-table" placeholder="Masukkan kata yang akan dicari">
                            <button type="submit" class="btn btn-white">
                                <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal" id="closeModalPetugasDT" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table data-table border" >
                        <thead>
                            <tr>
                                <th scope="col" class="py-4 ps-4">NIP</th>
                                <th scope="col" class="py-4" style="width: 35%;">Nama Petugas</th>
                                <th scope="col" class="py-4">Alamat</th>
                                <th scope="col" class="py-4 pe-4">Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petugas_list as $petugas)
                                @php
                                    $nama = $petugas["nama"];
                                    $nip= $petugas["nip"];
                                @endphp
                                <tr>
                                    <td class="py-3 ps-4">{{ $petugas["nip"] }}</td>
                                    <td class="py-3"> <span class="text-primary hover-pointer set-value-data-table" data-target="#nip@val|#namaPetugas@val" data-value='{{$nip}}|{{$nama}}'>{{ $nama }}</span></td>
                                    <td class="py-3">{{ $petugas["alamat"] }}</td>
                                    <td class="py-3">{{ $petugas["nm_jbtn"] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
