<div class="container">
    @php
        // dd($model);
    @endphp
    <h5 class="fw-bold">Informasi Pasien TB</h5>
    <hr>
    <div class="fw-bold">
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">No Rekam Medis</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->no_rkm_medis) ? $model->no_rkm_medis : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Nama Pasien</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->nm_pasien) ? $model->nm_pasien : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Tanggal Mulai Pengobatan</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->tanggal_mulai_pengobatan) ? $model->tanggal_mulai_pengobatan : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Tanggal Akhir Pengobatan</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->tanggal_hasil_akhir_pengobatan) ? $model->tanggal_hasil_akhir_pengobatan : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Penginput</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->penginput) ? $model->penginput :  ""  }}</li>
        </ul>
    </div>
    <br>
    <h5 class="fw-bold">Informasi Data TB</h5>
    <hr>

    <div class="">
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Diagnosa</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->nm_penyakit) ? $model->nm_penyakit : "" }} ({{ !empty($model->kode_icd_x) ? $model->kode_icd_x : "" }})</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Hasil Lab Sebelum Pengobatan</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->sebelum_pengobatan_hasil_mikroskopis) ? $model->sebelum_pengobatan_hasil_mikroskopis : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Klasifikasi Lokasi Anatomi</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{view_data_tb( 'klasifikasi_lokasi_anatomi',(!empty($model->klasifikasi_lokasi_anatomi) ? $model->klasifikasi_lokasi_anatomi :  ""))}}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Klasifikasi Riwayat Pengobatan</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ view_data_tb('klasifikasi_riwayat_pengobatan',(!empty($model->klasifikasi_riwayat_pengobatan) ? $model->klasifikasi_riwayat_pengobatan : ""))}}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Tipe Diagnosis</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ view_data_tb('tipe_diagnosis',(!empty($model->tipe_diagnosis) ? $model->tipe_diagnosis : "" ))}}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Sebelum Pengobatan Hasil Tes Cepat</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->sebelum_pengobatan_hasil_tes_cepat) ? $model->sebelum_pengobatan_hasil_tes_cepat : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Sebelum Pengobatan Hasil Biakan</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->sebelum_pengobatan_hasil_biakan) ? $model->sebelum_pengobatan_hasil_biakan : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Hasil Mikroskopis Bulan 2</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->hasil_mikroskopis_bulan_2) ? $model->hasil_mikroskopis_bulan_2 : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Hasil Mikroskopis Bulan 3</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->hasil_mikroskopis_bulan_3) ? $model->hasil_mikroskopis_bulan_3 : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Hasil Mikroskopis Bulan 5</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->hasil_mikroskopis_bulan_5) ? $model->hasil_mikroskopis_bulan_5 : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Akhir Pengobatan Hasil Mikroskopis</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->akhir_pengobatan_hasil_mikroskopis) ? $model->akhir_pengobatan_hasil_mikroskopis : "" }}</li>
        </ul>
        <ul class="list-group list-group-horizontal border-0">
            <li class="list-group-item border-0 px-0 py-1" style="width: 400px;">Hasil Akhir Pengobatan</li>
            <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ view_data_tb('hasil_akhir_pengobatan',(!empty($model->hasil_akhir_pengobatan) ? $model->hasil_akhir_pengobatan : "" ))}}</li>
        </ul>
    </div>
</div>