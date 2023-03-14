<table width="90%" cellpadding="" >
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Dokter DPJP",
                    "data" => !empty($resume_pasien->nm_dokter) ? $resume_pasien->nm_dokter : ""
                ])
        <br>
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Nomor Rawat",
                    "data" => !empty($resume_pasien->no_rawat) ? $resume_pasien->no_rawat : ""
                ])
        <br>
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Kondisi Pulang",
                    "data" => !empty($resume_pasien->kondisi_pulang) ? $resume_pasien->kondisi_pulang : ""
                ])
        <br>
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Keluhan Utama Riwayat Penyakit Yang Positif",
                    "data" => !empty($resume_pasien->keluhan_utama) ? $resume_pasien->keluhan_utama : ""
                ])
        <br>
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Jalannya Penyakit Selama Perawatan",
                    "data" => !empty($resume_pasien->jalannya_penyakit) ? $resume_pasien->jalannya_penyakit : ""
                ])
        <br>
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Pemeriksaan Penunjang Yang Positif",
                    "data" => !empty($resume_pasien->pemeriksaan_penunjang) ? $resume_pasien->pemeriksaan_penunjang : ""
                ])
        <br>
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Hasil Laboratorium Yang Positif",
                    "data" => !empty($resume_pasien->hasil_laborat) ? $resume_pasien->hasil_laborat : ""
                ])
        <br>
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Diagnosa Utama",
                    "data" => !empty($resume_pasien->diagnosa_utama) ? $resume_pasien->diagnosa_utama : ""
                ])
        <br>
        </td>   
        <td width="10%"> {{!empty($resume_pasien->kd_diagnosa_utama) ? $resume_pasien->kd_diagnosa_utama : ""}}</td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Diagnosa Sekunder 1",
                    "data" => !empty($resume_pasien->diagnosa_sekunder) ? $resume_pasien->diagnosa_sekunder : ""
                ])
        <br>
        </td>  
        <td width="10%"> {{!empty($resume_pasien->kd_diagnosa_sekunder) ? $resume_pasien->kd_diagnosa_sekunder : ""}}</td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Diagnosa Sekunder 2",
                    "data" => !empty($resume_pasien->diagnosa_sekunder2) ? $resume_pasien->diagnosa_sekunder2 : ""
                ])
        <br>
        </td>  
        <td width="10%"> {{!empty($resume_pasien->kd_diagnosa_sekunder2) ? $resume_pasien->kd_diagnosa_sekunder2 : ""}}</td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Diagnosa Sekunder 3",
                    "data" => !empty($resume_pasien->diagnosa_sekunder3) ? $resume_pasien->diagnosa_sekunder3 : ""
                ])
        <br>
        </td>  
        <td width="10%"> {{!empty($resume_pasien->kd_diagnosa_sekunder3) ? $resume_pasien->kd_diagnosa_sekunder3 : ""}}</td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Diagnosa Sekunder 4",
                    "data" => !empty($resume_pasien->diagnosa_sekunder4) ? $resume_pasien->diagnosa_sekunder4 : ""
                ])
        <br>
        </td>  
        <td width="10%"> {{!empty($resume_pasien->kd_diagnosa_sekunder4) ? $resume_pasien->kd_diagnosa_sekunder4 : ""}}</td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Prosedur Utama",
                    "data" => !empty($resume_pasien->prosedur_utama) ? $resume_pasien->prosedur_utama : ""
                ])
        <br>
        </td>  
        <td width="10%"> {{!empty($resume_pasien->kd_prosedur_utama) ? $resume_pasien->kd_prosedur_utama : ""}}</td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Prosedur Sekunder 1",
                    "data" => !empty($resume_pasien->prosedur_sekunder) ? $resume_pasien->prosedur_sekunder : ""
                ])
        <br>
        </td>  
        <td width="10%"> {{!empty($resume_pasien->kd_prosedur_sekunder) ? $resume_pasien->kd_prosedur_sekunder : ""}}</td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Prosedur Sekunder 2",
                    "data" => !empty($resume_pasien->prosedur_sekunder2) ? $resume_pasien->prosedur_sekunder2 : ""
                ])
        <br>
        </td>  
        <td width="10%"> {{!empty($resume_pasien->kd_prosedur_sekunder2) ? $resume_pasien->kd_prosedur_sekunder2 : ""}}</td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Prosedur Sekunder 3",
                    "data" => !empty($resume_pasien->prosedur_sekunder3) ? $resume_pasien->prosedur_sekunder3 : ""
                ])
        <br>
        </td>  
        <td width="10%"> {{!empty($resume_pasien->kd_prosedur_sekunder3) ? $resume_pasien->kd_prosedur_sekunder3 : ""}}</td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Obat-obatan Waktu Pulang/Nasihat",
                    "data" => !empty($resume_pasien->obat_pulang) ? $resume_pasien->obat_pulang : ""
                ])
        <br>
        </td> 
    </tr>
</table>