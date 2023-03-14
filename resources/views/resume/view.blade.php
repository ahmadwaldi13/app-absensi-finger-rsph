<div class="container">
    <ul class="list-group list-group-horizontal border-0">
        <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">No.Rawat</li>
        <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->no_rawat) ? $model->no_rawat : "" }}</li>
    </ul>
    <ul class="list-group list-group-horizontal border-0">
        <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Nama Pasien</li>
        <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->nm_pasien) ? $model->nm_pasien : "" }}</li>
    </ul>
    <ul class="list-group list-group-horizontal border-0">
        <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Dokter P.J</li>
        <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->kd_dokter) ? $model->kd_dokter :  "" }} - {{ !empty($model->nm_dokter) ? $model->nm_dokter :  "" }}</li>
    </ul>
    <ul class="list-group list-group-horizontal border-0">
        <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Kondisi Pasien Pulang</li>
        <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->kondisi_pulang) ? $model->kondisi_pulang : "" }}</li>
    </ul>

    <div class="my-5">
        <h5>Keluhan utama riwayat penyakit yang positif :</h5>
        <p>{{ !empty($model->keluhan_utama) ? $model->keluhan_utama : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Jalannya penyakit selama perawatan :</h5>
        <p>{{ !empty($model->jalannya_penyakit) ? $model->jalannya_penyakit : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Pemeriksaan penunjang yang positif :</h5>
        <p>{{ !empty($model->pemeriksaan_penunjang) ? $model->pemeriksaan_penunjang : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Hasil laboratorium yang positif :</h5>
        <p>{{ !empty($model->hasil_laborat) ? $model->hasil_laborat : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Diagnosa Utama : </h5>
        <p>{{ !empty($model->diagnosa_utama) ? $model->diagnosa_utama : "" }}</p>
        <p>Kode ICD : {{ !empty($model->kd_diagnosa_utama) ? $model->kd_diagnosa_utama : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Diagnosa Sekunder 1 : </h5>
        <p>{{ !empty($model->diagnosa_sekunder) ? $model->diagnosa_sekunder : "" }}</p>
        <p>Kode ICD : {{ !empty($model->kd_diagnosa_sekunder) ? $model->kd_diagnosa_sekunder : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Diagnosa Sekunder 2 : </h5>
        <p>{{ !empty($model->diagnosa_sekunder2) ? $model->diagnosa_sekunder2 : "" }}</p>
        <p>Kode ICD : {{ !empty($model->kd_diagnosa_sekunder2) ? $model->kd_diagnosa_sekunder2 : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Diagnosa Sekunder 3 : </h5>
        <p>{{ !empty($model->diagnosa_sekunder3) ? $model->diagnosa_sekunder3 : "" }}</p>
        <p>Kode ICD : {{ !empty($model->kd_diagnosa_sekunder3) ? $model->kd_diagnosa_sekunder3 : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Diagnosa Sekunder 4 : </h5>
        <p>{{ !empty($model->diagnosa_sekunder4) ? $model->diagnosa_sekunder4 : "" }}</p>
        <p>Kode ICD : {{ !empty($model->kd_diagnosa_sekunder4) ? $model->kd_diagnosa_sekunder4 : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Prosedur Utama : </h5>
        <p>{{ !empty($model->prosedur_utama) ? $model->prosedur_utama : "" }}</p>
        <p>Kode ICD : {{ !empty($model->kd_prosedur_utama) ? $model->kd_prosedur_utama : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Prosedur Sekunder 1 : </h5>
        <p>{{ !empty($model->prosedur_sekunder) ? $model->prosedur_sekunder : "" }}</p>
        <p>Kode ICD : {{ !empty($model->kd_prosedur_sekunder) ? $model->kd_prosedur_sekunder : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Prosedur Sekunder 2 : </h5>
        <p>{{ !empty($model->prosedur_sekunder2) ? $model->prosedur_sekunder2 : "" }}</p>
        <p>Kode ICD : {{ !empty($model->kd_prosedur_sekunder2) ? $model->kd_prosedur_sekunder2 : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Prosedur Sekunder 3 : </h5>
        <p>{{ !empty($model->prosedur_sekunder3) ? $model->prosedur_sekunder3 : "" }}</p>
        <p>Kode ICD : {{ !empty($model->kd_prosedur_sekunder3) ? $model->kd_prosedur_sekunder3 : "" }}</p>
    </div>
    <div class="my-5">
        <h5>Obat-obatan waktu pulang / nasihat :</h5>
        <p>{{ !empty($model->obat_pulang) ? $model->obat_pulang : "" }}</p>
    </div>
</div>