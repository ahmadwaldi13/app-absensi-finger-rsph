<!-- Button trigger modal pilih dokter -->
<button type="button" style="display: none;" id="showModalPilihDokter" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModalPilihDokters">
    </button>
<!-- Modal Pilih Dokter -->
<div class="modal fade" id="showModalPilihDokters" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="col-6">
                    <div class="d-flex justify-content-center align-items-center border">
                        <input type="text" class="form-control border-0" id="pencarianPilihDokter" placeholder="Masukkan kata yang akan dicari">
                        <button type="submit" class="btn btn-white">
                            <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn-close me-4" data-bs-dismiss="modal" id="closeModalDokter" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive pt-0">
                <table class="table border display nowrap" id="tablePilihDokter">
                    <thead>
                        <tr>
                            <th scope="col" class="py-4 ps-4">Kode Dokter</th>
                            <th scope="col" class="py-4" style="width: 35%;">Nama Dokter</th>
                            <th scope="col" class="py-4">Spesialis</th>
                            <th scope="col" class="py-4 pe-4">Nomo Ijin Praktek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($dokters))
                            @foreach($dokters as $item)
                                <?php
                                    $kode = $item["kd_dokter"];
                                    $nama = $item["nm_dokter"];
                                ?>
                                <tr>
                                    <td class="py-3 ps-4">{{ $item["kd_dokter"] }}</td>
                                    <td class="py-3"> <span class="text-primary hover-pointer" onclick="setValueDokter('{{$nama}}', '{{$kode}}')">{{ $nama }}</span></td>
                                    <td class="py-3">{{ $item["nm_sps"] }}</td>
                                    <td class="py-3">{{ $item["no_ijn_praktek"] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal konfirmasi Ralan -->
<button type="button" style="display: none;" id="show_modal_confir_ralan" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_confir_ralan">
</button>
<!-- Modal Konfirmasi Ralan -->
<div class="modal fade" id="modal_confir_ralan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close me-4 mt-3" data-bs-dismiss="modal" id="close_modal_confir_ralan" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h5 class="mb-4">Mohon periksa data terlebih dahulu, sebelum anda mengkonfirmasi data telah sesuai ...</h5>
                    <ul class="list-group list-group-horizontal border-0">
                        <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">No.Rawat</li>
                        <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->no_rawat) ? $model->no_rawat : '' }}</li>
                    </ul>
                    <ul class="list-group list-group-horizontal border-0">
                        <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Nama Pasien</li>
                        <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}</li>
                    </ul>
                    <ul class="list-group list-group-horizontal border-0">
                        <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Dokter P.J</li>
                        <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: <span id="nomor_dokter">{{ !empty($model->kd_dokter) ? $model->kd_dokter :  "" }}</span> - <span id="nama_dokter">{{ !empty($model->nm_dokter) ? $model->nm_dokter :  "" }}</span></li>
                    </ul>
                    <ul class="list-group list-group-horizontal border-0">
                        <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Kondisi Pasien Pulang</li>
                        <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: <span class='confirm_kondisi_pulang'>Hidup</span></li>
                    </ul>
                
                    <div class="my-5">
                        <h5>Keluhan utama riwayat penyakit yang positif :</h5>
                        <p class="confirm_keluhan_utama"></p>
                    </div>
                    <div class="my-5">
                        <h5>Jalannya penyakit selama perawatan :</h5>
                        <p class="confirm_jalannya_penyakit"></p>
                    </div>
                    <div class="my-5">
                        <h5>Pemeriksaan penunjang yang positif :</h5>
                        <p class="confirm_pemeriksaan_penunjang"></p>
                    </div>
                    <div class="my-5">
                        <h5>Hasil laboratorium yang positif :</h5>
                        <p class="confirm_hasil_laborat"></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Utama : </h5>
                        <p class="confirm_diagnosa_utama"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_utama"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Sekunder 1 : </h5>
                        <p class="confirm_diagnosa_sekunder"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_sekunder"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Sekunder 2 : </h5>
                        <p class="confirm_diagnosa_sekunder2"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_sekunder2"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Sekunder 3 : </h5>
                        <p class="confirm_diagnosa_sekunder3"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_sekunder3"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Sekunder 4 : </h5>
                        <p class="confirm_diagnosa_sekunder4"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_sekunder4"></span></p>
                    </div>
                
                    <div class="my-5">
                        <h5>Prosedur Utama : </h5>
                        <p class="confirm_prosedur_utama"></p>
                        <p>Kode ICD : <span class="confirm_kd_prosedur_utama"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Prosedur Sekunder 1 : </h5>
                        <p class="confirm_prosedur_sekunder"></p>
                        <p>Kode ICD : <span class="confirm_kd_prosedur_sekunder"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Prosedur Sekunder 2 : </h5>
                        <p class="confirm_prosedur_sekunder2"></p>
                        <p>Kode ICD : <span class="confirm_kd_prosedur_sekunder2"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Prosedur Sekunder 3 : </h5>
                        <p class="confirm_prosedur_sekunder3"></p>
                        <p>Kode ICD : <span class="confirm_kd_prosedur_sekunder3"></span></p>
                    </div>
                
                    <div class="my-5">
                        <h5>Obat-obatan waktu pulang / nasihat :</h5>
                        <p class="confirm_obat_pulang"></p>
                    </div>

                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-2 mb-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary send_resume" data-target='#done_submit_ralan' type="submit">{{ !empty($kode_key_old) ? 'Ubah' : 'Simpan'  }}</button>
                            </div>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="close_modal_confir_ralan" type="button">Batal</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal konfirmasi Ranap -->
<button type="button" style="display: none;" id="show_modal_confir_ranap" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_confir_ranap">
</button>
<!-- Modal Konfirmasi Ranap -->
<div class="modal fade" id="modal_confir_ranap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close me-4 mt-3" data-bs-dismiss="modal" id="close_modal_confir_ranap" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="container">
                    <h5 class="mb-4">Mohon periksa data terlebih dahulu, sebelum anda mengkonfirmasi data telah sesuai ...</h5>
                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-6 mb-3">
                            <ul class="list-group list-group-horizontal border-0">
                                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">No.Rawat</li>
                                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->no_rawat) ? $model->no_rawat : '' }}</li>
                            </ul>
                            <ul class="list-group list-group-horizontal border-0">
                                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Nama Pasien</li>
                                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}</li>
                            </ul>
                            <ul class="list-group list-group-horizontal border-0">
                                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Dokter P.J</li>
                                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: <span>{{ !empty($model->kd_dokter) ? $model->kd_dokter :  "" }}</span> - <span>{{ !empty($model->nm_dokter) ? $model->nm_dokter :  "" }}</span></li>
                            </ul>
                            <ul class="list-group list-group-horizontal border-0">
                                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Dokter Pengirim</li>
                                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: <span>{{ !empty($data_ranap->kd_dokter) ? $data_ranap->kd_dokter :  "" }}</span> - <span>{{ !empty($data_ranap->nm_dokter) ? $data_ranap->nm_dokter :  "" }}</span></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 mb-3">
                            
                            <ul class="list-group list-group-horizontal border-0">
                                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Tanggal Masuk</li>
                                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: <span>{{ !empty($data_ranap->tgl_registrasi) ? $data_ranap->tgl_registrasi :  "" }}</span> - <span>{{ !empty($data_ranap->jam_reg) ? $data_ranap->jam_reg :  "" }}</span></li>
                            </ul>
                            <ul class="list-group list-group-horizontal border-0">
                                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Tanggal Keluar</li>
                                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: <span>{{ !empty($data_ranap->tgl_keluar) ? $data_ranap->tgl_keluar :  "" }}</span> - <span>{{ !empty($data_ranap->jam_keluar) ? $data_ranap->jam_keluar :  "" }}</span></li>
                            </ul>
                            <ul class="list-group list-group-horizontal border-0">
                                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Bangsal/Kamar</li>
                                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: <span>{{ !empty($data_ranap->kd_kamar) ? $data_ranap->kd_kamar :  "" }}</span> - <span>{{ !empty($data_ranap->nm_bangsal) ? $data_ranap->nm_bangsal :  "" }}</span></li>
                            </ul>
                            <ul class="list-group list-group-horizontal border-0">
                                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Cara Bayar</li>
                                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: <span>{{ !empty($data_ranap->kd_pj) ? $data_ranap->kd_pj :  "" }}</span> - <span>{{ !empty($data_ranap->png_jawab) ? $data_ranap->png_jawab :  "" }}</span></li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="my-5">
                        <h5>Diagnosa Awal Masuk :</h5>
                        <p class="confirm_diagnosa_awal"></p>
                    </div>
                    
                    <div class="my-5">
                        <h5>Alasan Masuk Dirawat :</h5>
                        <p class="confirm_alasan"></p>
                    </div>
                
                    <div class="my-5">
                        <h5>Keluhan utama riwayat penyakit :</h5>
                        <p class="confirm_keluhan_utama"></p>
                    </div>
                    <div class="my-5">
                        <h5>Pemeriksaan Fisik :</h5>
                        <p class="confirm_pemeriksaan_fisik"></p>
                    </div>
                    <div class="my-5">
                        <h5>Jalannya penyakit selama perawatan :</h5>
                        <p class="confirm_jalannya_penyakit"></p>
                    </div>
                    <div class="my-5">
                        <h5>Pemeriksaan Penunjang Rad Terpenting :</h5>
                        <p class="confirm_pemeriksaan_penunjang"></p>
                    </div>
                    <div class="my-5">
                        <h5>Pemeriksaan Penunjang Lab Terpenting :</h5>
                        <p class="confirm_hasil_laborat"></p>
                    </div>
                    <div class="my-5">
                        <h5>Tindakan/Operasi Selama Perawatan :</h5>
                        <p class="confirm_tindakan_dan_operasi"></p>
                    </div>
                    <div class="my-5">
                        <h5>Obat-obatan Selama Perawatan :</h5>
                        <p class="confirm_obat_di_rs"></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Utama : </h5>
                        <p class="confirm_diagnosa_utama"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_utama"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Sekunder 1 : </h5>
                        <p class="confirm_diagnosa_sekunder"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_sekunder"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Sekunder 2 : </h5>
                        <p class="confirm_diagnosa_sekunder2"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_sekunder2"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Sekunder 3 : </h5>
                        <p class="confirm_diagnosa_sekunder3"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_sekunder3"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Diagnosa Sekunder 4 : </h5>
                        <p class="confirm_diagnosa_sekunder4"></p>
                        <p>Kode ICD : <span class="confirm_kd_diagnosa_sekunder4"></span></p>
                    </div>
                
                    <div class="my-5">
                        <h5>Prosedur Utama : </h5>
                        <p class="confirm_prosedur_utama"></p>
                        <p>Kode ICD : <span class="confirm_kd_prosedur_utama"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Prosedur Sekunder 1 : </h5>
                        <p class="confirm_prosedur_sekunder"></p>
                        <p>Kode ICD : <span class="confirm_kd_prosedur_sekunder"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Prosedur Sekunder 2 : </h5>
                        <p class="confirm_prosedur_sekunder2"></p>
                        <p>Kode ICD : <span class="confirm_kd_prosedur_sekunder2"></span></p>
                    </div>
                    <div class="my-5">
                        <h5>Prosedur Sekunder 3 : </h5>
                        <p class="confirm_prosedur_sekunder3"></p>
                        <p>Kode ICD : <span class="confirm_kd_prosedur_sekunder3"></span></p>
                    </div>

                    <div class="my-5">
                        <h5>Alergi Obat :</h5>
                        <p class="confirm_alergi"></p>
                    </div>

                    <div class="my-5">
                        <h5>Diet :</h5>
                        <p class="confirm_diet"></p>
                    </div>
                    
                    <div class="my-5">
                        <h5>Hasil Lab Yang Belum Selesai (Pending) :</h5>
                        <p class="confirm_lab_belum"></p>
                    </div>
                    
                    <div class="my-5">
                        <h5>Instruksi/Anjuran Dan Edukasi ( Follow Up ) :</h5>
                        <p class="confirm_edukasi"></p>
                    </div>

                    <div class="my-5">
                        <h5>Keadaan Pulang :</h5>
                        <p class="confirm_keadaan"></p>
                        <p class="confirm_ket_keadaan"></p>
                    </div>

                    <div class="my-5">
                        <h5>Cara Keluar :</h5>
                        <p class="confirm_cara_keluar"></p>
                        <p class="confirm_ket_keluar"></p>
                    </div>
                    
                    <div class="my-5">
                        <h5>Dilanjutkan :</h5>
                        <p class="confirm_dilanjutkan"></p>
                        <p class="confirm_ket_dilanjutkan"></p>
                    </div>

                    <div class="my-5">
                        <h5>Tanggal & Jam Kontrol :</h5>
                        <div>
                            <span class="confirm_tanggal_kontrol"></span> <span class="confirm_jam_kontrol"></span>
                        </div>
                    </div>
                
                    <div class="my-5">
                        <h5>Obat Pulang :</h5>
                        <p class="confirm_obat_pulang"></p>
                    </div>

                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-2 mb-3">
                            <div class="d-grid gap-2">
                            <button class="btn btn-primary send_resume" data-target='#done_submit_ranap' type="submit">{{ !empty($kode_key_old) ? 'Ubah' : 'Simpan'  }}</button>
                            </div>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-danger" data-bs-dismiss="modal" id="close_modal_confir_ranap" type="button">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
