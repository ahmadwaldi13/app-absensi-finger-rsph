<?php
    $tab4 = str_repeat("&nbsp;", 10);
    $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
?>

<table style="border-bottom:1px solid black;border-top:1px solid black;">
    <tr>
        <td>

            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Nama Pasien",
                "data" => !empty($resume_pasien->nm_pasien) ? $resume_pasien->nm_pasien : ""
            ])
        </td>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "No Rekam Medis",
                "data" => !empty($resume_pasien->no_rkm_medis) ? $resume_pasien->no_rkm_medis : ""
            ]) 
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Umur",
                "data" => !empty($resume_pasien->umur) ? $resume_pasien->umur : ""
            ])
        </td>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => $fr == "ri" ? "Ruang" : "Poli",
                "data" =>$fr == "rj" ? (!empty($resume_pasien->nm_poli) ? $resume_pasien->nm_poli : "") : (!empty($resume_pasien->kamar) ? $resume_pasien->kamar : '')
            ]) 
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Tgl Lahir",
                "data" => !empty($resume_pasien->tgl_lahir) ? $resume_pasien->tgl_lahir : ""
            ])
        </td>
        <td>
            <?php 
                $jk = !empty($resume_pasien->jk) ? $resume_pasien->jk : "";
                $jk_pasien = $jk === "L" ? "Laki-Laki" : $jk === "P" ? "Perempuan" : "";
            ?>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Jenis Kelamin",
                "data" => $jk_pasien
            ]) 
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Pekerjaan",
                "data" => !empty($resume_pasien->pekerjaan) ? $resume_pasien->pekerjaan : ""
            ])
        </td>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Tgl. Masuk",
                "data" => !empty($resume_pasien->tgl_registrasi) ? $resume_pasien->tgl_registrasi : ""
            ]) 
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Alamat",
                "data" => !empty($resume_pasien->alamat) ? $resume_pasien->alamat : ""
            ])
        </td>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [ 
                "title" => "Tgl. Keluar",
                "data" => !empty($resume_pasien->tgl_keluar) ? $resume_pasien->tgl_keluar : ""
            ]) 
        </td>
        
    </tr>

</table>

<table>
    <tr>
        <td border="0" colspan="4" height="60">Jalannya Penyakit Selama Perawatan : <br>{{!empty($resume_pasien->jalannya_penyakit) ? $resume_pasien->jalannya_penyakit : ""}}</td>
    </tr>


    <tr>
        <td border="0" colspan="4" height="60">Keluhan Utama Riwayat Penyakit Yang Positif : <br>{{!empty($resume_pasien->keluhan_utama) ? $resume_pasien->keluhan_utama : ""}}</td>
    </tr>
    
    <tr>
        <td border="0" colspan="4" height="60">Pemeriksaan Penunjang Yang Positif : <br>{{!empty($resume_pasien->pemeriksaan_penunjang) ? $resume_pasien->pemeriksaan_penunjang : ""}}</td>
    </tr>

    <tr>
        <td border="0" colspan="4" height="60">Tindakan yang dilakukan / Hasil Laboratorium Yang Positif : <br>{{!empty($resume_pasien->hasil_laborat) ? $resume_pasien->hasil_laborat : ""}}</td>
    </tr>



    <tr>
        <td border="0" width="91%" colspan="3"  >Diagnosa Akhir :</td>
        <td border="0" width="9%" align="center" >Kode ICD</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;Diagnosa Utama</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="65%">{{!empty($resume_pasien->diagnosa_utama) ? $resume_pasien->diagnosa_utama : ""}}</td>
        <td border="0" width="9%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_utama)) {{$resume_pasien->kd_diagnosa_utama}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;Diangosa Sekunder</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="65%">1. {{!empty($resume_pasien->diagnosa_sekunder) ? $resume_pasien->diagnosa_sekunder : ""}}</td>
        <td border="0" width="9%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_sekunder)) {{$resume_pasien->kd_diagnosa_sekunder}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="65%">2. {{!empty($resume_pasien->diagnosa_sekunder2) ? $resume_pasien->diagnosa_sekunder2 : ""}}</td>
        <td border="0" width="9%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_sekunder2)) {{$resume_pasien->kd_diagnosa_sekunder2}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="65%">3. {{!empty($resume_pasien->diagnosa_sekunder3) ? $resume_pasien->diagnosa_sekunder3 : ""}}</td>
        <td border="0" width="9%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_sekunder3)) {{$resume_pasien->kd_diagnosa_sekunder3}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="65%">4. {{!empty($resume_pasien->diagnosa_sekunder4) ? $resume_pasien->diagnosa_sekunder4 : ""}}</td>
        <td border="0" width="9%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_sekunder4)) {{$resume_pasien->kd_diagnosa_sekunder4}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;Prosedur / Tindakan Utama</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="65%">{{!empty($resume_pasien->prosedur_utama) ? $resume_pasien->prosedur_utama : ""}}</td>
        <td border="0" width="9%" align="center">{ @if(!empty($resume_pasien->kd_prosedur_utama)) {{$resume_pasien->kd_prosedur_utama}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;Prosuder / Tindakan Sekunder</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="65%">1. {{!empty($resume_pasien->prosedur_sekunder) ? $resume_pasien->prosedur_sekunder : ""}}</td>
        <td border="0" width="9%" align="center">{ @if(!empty($resume_pasien->kd_prosedur_sekunder)) {{$resume_pasien->kd_prosedur_sekunder}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="65%">2. {{!empty($resume_pasien->prosedur_sekunder2) ? $resume_pasien->prosedur_sekunder2 : ""}}</td>
        <td border="0" width="9%" align="center">{ @if(!empty($resume_pasien->kd_prosedur_sekunder2)) {{$resume_pasien->kd_prosedur_sekunder2}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="65%">3. {{!empty($resume_pasien->prosedur_sekunder3) ? $resume_pasien->prosedur_sekunder3 : ""}}</td>
        <td border="0" width="9%" align="center">{ @if(!empty($resume_pasien->kd_prosedur_sekunder3)) {{$resume_pasien->kd_prosedur_sekunder3}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <br>
    <tr>
        <td border="0" colspan="4" height="10">Kondisi Pasien Pulang : {{!empty($resume_pasien->keadaan) ? $resume_pasien->keadaan : ""}}</td>
    </tr>
    <br>
    <tr>
        <td border="0" colspan="4" height="60">Obat-obatan Waktu Pulang/Nasihat : <br>{{!empty($resume_pasien->obat_pulang) ? $resume_pasien->obat_pulang : ""}}</td>
    </tr>
</table>
