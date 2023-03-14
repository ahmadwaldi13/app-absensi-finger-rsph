<div class="container">
    <div class="row justify-content-start align-items-end">
        <div class="col-lg-6">
            <ul class="list-group list-group-horizontal border-0">
                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">No.Rawat</li>
                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->no_rawat) ? $model->no_rawat : "" }}</li>
            </ul>
            <ul class="list-group list-group-horizontal border-0">
                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">No.RM</li>
                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->no_rkm_medis) ? $model->no_rkm_medis : "" }}</li>
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
                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Dokter Pengirim</li>
                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->kodepengirim) ? $model->kodepengirim :  "" }} - {{ !empty($model->pengirim) ? $model->pengirim :  "" }}</li>
            </ul>
        </div>

        <div class="col-lg-6">
            <ul class="list-group list-group-horizontal border-0">
                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Kamar/Ruang/Bangsal</li>
                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($kamarInap->kd_kamar) ? $kamarInap->kd_kamar :  "" }} - {{ !empty($kamarInap->nm_bangsal) ? $kamarInap->nm_bangsal :  "" }}</li>
            </ul>
            <ul class="list-group list-group-horizontal border-0">
                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Tanggal Masuk</li>
                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->tgl_registrasi) ? $model->tgl_registrasi :  "" }} - {{ !empty($model->jam_reg) ? $model->jam_reg :  "" }}</li>
            </ul>
            <ul class="list-group list-group-horizontal border-0">
                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Tanggal Keluar</li>
                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($kamarInap->tgl_keluar) ? $kamarInap->tgl_keluar :  "" }} - {{ !empty($kamarInap->jam_keluar) ? $kamarInap->jam_keluar :  "" }}</li>
            </ul>

            <ul class="list-group list-group-horizontal border-0">
                <li class="list-group-item border-0 px-0 py-1" style="width: 250px;">Cara Bayar</li>
                <li class="list-group-item border-0 px-0 py-1" style="width: 100%">: {{ !empty($model->kd_pj) ? $model->kd_pj :  "" }} - {{ !empty($model->png_jawab) ? $model->png_jawab :  "" }}</li>
            </ul>
        </div>
    </div>

    <div class="my-5">
        <h5>Diagnosa Awal Masuk :</h5>
        <p>{{ !empty($model->diagnosa_awal) ? $model->diagnosa_awal : "" }}</p>
    </div>

    <div class="my-5">
        <h5>Alasan Masuk Dirawat :</h5>
        <p>{{ !empty($model->alasan) ? $model->alasan : "" }}</p>
    </div>

    <div class="my-5">
        <h5>Keluhan Utama Riwayat Penyakit :</h5>
        <p>{{ !empty($model->keluhan_utama) ? $model->keluhan_utama : "" }}</p>
    </div>

    <div class="my-5">
        <h5>Jalannya Penyakit Selama Perawatan :</h5>
        <p>{{ !empty($model->jalannya_penyakit) ? $model->jalannya_penyakit : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Pemeriksaan Penunjang Rad Terpenting :</h5>
        <p>{{ !empty($model->pemeriksaan_penunjang) ? $model->pemeriksaan_penunjang : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Pemeriksaan Penunjang Lab Terpenting :</h5>
        <p>{{ !empty($model->hasil_laborat) ? $model->hasil_laborat : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Tindakan/Operasi Selama Perawatan :</h5>
        <p>{{ !empty($model->tindakan_dan_operasi) ? $model->tindakan_dan_operasi : "" }}</p>
    </div>

    <div class="my-5">
        <h5>Obat-obatan Selama Perawatan :</h5>
        <p>{{ !empty($model->obat_di_rs) ? $model->obat_di_rs : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Diagnosa Utama :</h5>
        <p>{{ !empty($model->kd_diagnosa_utama) ? $model->kd_diagnosa_utama : "" }} - {{ !empty($model->diagnosa_utama) ? $model->diagnosa_utama : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Diagnosa Sekunder 1 :</h5>
        <p>{{ !empty($model->kd_diagnosa_sekunder) ? $model->kd_diagnosa_sekunder : "" }} - {{ !empty($model->diagnosa_sekunder) ? $model->diagnosa_sekunder : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Diagnosa Sekunder 2 :</h5>
        <p>{{ !empty($model->kd_diagnosa_sekunder2) ? $model->kd_diagnosa_sekunder2 : "" }} - {{ !empty($model->diagnosa_sekunder2) ? $model->diagnosa_sekunder2 : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Diagnosa Sekunder 3 :</h5>
        <p>{{ !empty($model->kd_diagnosa_sekunder3) ? $model->kd_diagnosa_sekunder3 : "" }} - {{ !empty($model->diagnosa_sekunder3) ? $model->diagnosa_sekunder3 : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Diagnosa Sekunder 4 :</h5>
        <p>{{ !empty($model->kd_diagnosa_sekunder4) ? $model->kd_diagnosa_sekunder4 : "" }} - {{ !empty($model->diagnosa_sekunder4) ? $model->diagnosa_sekunder4 : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Prosedur Utama :</h5>
        <p>{{ !empty($model->kd_prosedur_utama) ? $model->kd_prosedur_utama : "" }} - {{ !empty($model->prosedur_utama) ? $model->prosedur_utama : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Prosedur Sekunder 1 :</h5>
        <p>{{ !empty($model->kd_prosedur_sekunder) ? $model->kd_prosedur_sekunder : "" }} - {{ !empty($model->prosedur_sekunder) ? $model->prosedur_sekunder : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Prosedur Sekunder 2 :</h5>
        <p>{{ !empty($model->kd_prosedur_sekunder2) ? $model->kd_prosedur_sekunder2 : "" }} - {{ !empty($model->prosedur_sekunder2) ? $model->prosedur_sekunder2 : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Prosedur Sekunder 3 :</h5>
        <p>{{ !empty($model->kd_prosedur_sekunder3) ? $model->kd_prosedur_sekunder3 : "" }} - {{ !empty($model->prosedur_sekunder3) ? $model->prosedur_sekunder3 : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Alergi Obat :</h5>
        <p>{{ !empty($model->alergi) ? $model->alergi : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Diet :</h5>
        <p>{{ !empty($model->diet) ? $model->diet : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Hasil Lab Yang Belum Selesai (Pending) :</h5>
        <p>{{ !empty($model->lab_belum) ? $model->lab_belum : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Instruksi/Anjuran Dan Edukasi :</h5>
        <p>{{ !empty($model->edukasi) ? $model->edukasi : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Keadaan Pulang :</h5>
        <p>{{ !empty($model->keadaan) ? $model->keadaan : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Ket.Keadaan Pulang :</h5>
        <p>{{ !empty($model->ket_keadaan) ? $model->ket_keadaan : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Cara Keluar :</h5>
        <p>{{ !empty($model->cara_keluar) ? $model->cara_keluar : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Ket.Cara Keluar :</h5>
        <p>{{ !empty($model->ket_keluar) ? $model->ket_keluar : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Dilanjutkan :</h5>
        <p>{{ !empty($model->dilanjutkan) ? $model->dilanjutkan : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Ket.Dilanjutkan :</h5>
        <p>{{ !empty($model->ket_dilanjutkan) ? $model->ket_dilanjutkan : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Kontrol Kembali :</h5>
        <p>{{ !empty($model->kontrol) ? $model->kontrol : "" }}</p>
    </div>
    
    <div class="my-5">
        <h5>Obat Pulang :</h5>
        <p>{{ !empty($model->obat_pulang) ? $model->obat_pulang : "" }}</p>
    </div>
</div>