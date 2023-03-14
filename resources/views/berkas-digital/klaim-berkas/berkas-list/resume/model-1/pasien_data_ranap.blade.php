<?php
    function space($int){
        return str_repeat("&nbsp;", $int);
    }     
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
        <td border="0" colspan="4" height="10">Diagnosa Awal Masuk {!! space(2) !!}:{!! space(2) !!} {{!empty($resume_pasien->diagnosa_awal) ? $resume_pasien->diagnosa_awal : ""}}</td>
    </tr>
    <tr>
        <td border="0" colspan="4" height="30">Alasan Masuk Dirawat {!! space(2) !!}:{!! space(2) !!} <br> {{!empty($resume_pasien->alasan)  ? $resume_pasien->alasan : ""}}</td>
    </tr>
    <tr>
        <td border="0" colspan="4" height="80"> Keluhan Utama Riwayat Penyakit {!! space(2) !!}: <br> {!! space(4) !!} {{!empty($resume_pasien->keluhan_utama) ? $resume_pasien->keluhan_utama : ""}}</td>
    </tr>
    <tr>
        <td border="0" colspan="4" height="80"> Pemeriksaan Fisik  {!! space(2) !!}: <br> {!! space(4) !!} {{!empty($resume_pasien->pemeriksaan_fisik) ? $resume_pasien->pemeriksaan_fisik : ""}}</td>
    </tr>
    <tr>
        <td border="0" colspan="4" height="110">Jalannya Penyakit Selama Perawatan    {!! space(2) !!}: <br> {!! space(4) !!} {{!empty($resume_pasien->jalannya_penyakit) ? $resume_pasien->jalannya_penyakit : ""}}</td>
    </tr>
    <tr>
    <tr>
        <td border="0" colspan="4" height="110">Pemeriksaan Penunjang Radiologi Terpenting   {!! space(2) !!}: <br> {!! space(4) !!} {{!empty($resume_pasien->pemeriksaan_penunjang) ? $resume_pasien->pemeriksaan_penunjang : ""}}</td>
    </tr>
    <tr>
        <td border="0" colspan="4" height="110">Pemeriksaan Penunjang Laboratorium Terpenting   {!! space(2) !!}: <br> {!! space(4) !!} {{!empty($resume_pasien->hasil_laborat) ? $resume_pasien->hasil_laborat : ""}}</td>
    </tr>
    <tr>
        <td border="0" colspan="4" height="110">Tindakan/Operasi Selama Perawatan   {!! space(2) !!}: <br> {!! space(4) !!} {{!empty($resume_pasien->tindakan_dan_operasi) ?$resume_pasien->tindakan_dan_operasi : ""   }}</td>
    </tr>
    <tr>
        <td border="0" colspan="4" height="110"> Obat-obatan Selama Perawatan  {!! space(2) !!}: <br> {!! space(4) !!} {{!empty($resume_pasien->obat_di_rs) ? $resume_pasien->obat_di_rs : ""}}</td>
    </tr>


    <tr>
        <td border="0" width="82%" colspan="3"  >Diagnosa Akhir :</td>
        <td border="0" width="18%" align="center" >Kode ICD</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;Diagnosa Utama</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="56%">{{!empty($resume_pasien->diagnosa_utama) ? $resume_pasien->diagnosa_utama : ""}}</td>
        <td border="0" width="18%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_utama)) {{$resume_pasien->kd_diagnosa_utama}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;Diangosa Sekunder</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="56%">1. {{!empty($resume_pasien->diagnosa_sekunder) ? $resume_pasien->diagnosa_sekunder : ""}}</td>
        <td border="0" width="18%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_sekunder)) {{$resume_pasien->kd_diagnosa_sekunder}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="56%">2. {{!empty($resume_pasien->diagnosa_sekunder2) ? $resume_pasien->diagnosa_sekunder2 : ""}}</td>
        <td border="0" width="18%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_sekunder2)) {{$resume_pasien->kd_diagnosa_sekunder2}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="56%">3. {{!empty($resume_pasien->diagnosa_sekunder3) ? $resume_pasien->diagnosa_sekunder3 : ""}}</td>
        <td border="0" width="18%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_sekunder3)) {{$resume_pasien->kd_diagnosa_sekunder3}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="56%">4. {{!empty($resume_pasien->diagnosa_sekunder4) ? $resume_pasien->diagnosa_sekunder4 : ""}}</td>
        <td border="0" width="18%" align="center">{ @if(!empty($resume_pasien->kd_diagnosa_sekunder4)) {{$resume_pasien->kd_diagnosa_sekunder4}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;Prosedur / Tindakan Utama</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="56%">{{!empty($resume_pasien->prosedur_utama) ? $resume_pasien->prosedur_utama : ""}}</td>
        <td border="0" width="18%" align="center">{ @if(!empty($resume_pasien->kd_prosedur_utama)) {{$resume_pasien->kd_prosedur_utama}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;Prosuder / Tindakan Sekunder</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="56%">1. {{!empty($resume_pasien->prosedur_sekunder) ? $resume_pasien->prosedur_sekunder : ""}}</td>
        <td border="0" width="18%" align="center">{ @if(!empty($resume_pasien->kd_prosedur_sekunder)) {{$resume_pasien->kd_prosedur_sekunder}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="56%">2. {{!empty($resume_pasien->prosedur_sekunder2) ? $resume_pasien->prosedur_sekunder2 : ""}}</td>
        <td border="0" width="18%" align="center">{ @if(!empty($resume_pasien->kd_prosedur_sekunder2)) {{$resume_pasien->kd_prosedur_sekunder2}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <tr>
        <td border="0" width="25%">&nbsp;&nbsp;</td>
        <td border="0" width="1%">:</td>
        <td border="0" width="56%">3. {{!empty($resume_pasien->prosedur_sekunder3) ? $resume_pasien->prosedur_sekunder3 : ""}}</td>
        <td border="0" width="18%" align="center">{ @if(!empty($resume_pasien->kd_prosedur_sekunder3)) {{$resume_pasien->kd_prosedur_sekunder3}} @else {!! $tab4 !!} @endif}</td>
    </tr>
    <br>
    <tr>
        <td border="0" colspan="4" >Alergi / Reaksi Obat : {{!empty($resume_pasien->alergi) ? $resume_pasien->alergi : ''}}</td>
    </tr>
    <tr>
        <td border="0" colspan="4" height="30">Diet Selama Perawatan : <br>{{!empty($resume_pasien->diet) ? $resume_pasien->diet : ""}}</td>
    </tr>
    <br>
    <tr>
        <td border="0" colspan="4" height="30">Hasil Lab Yang Belum Selesai (Pending) : <br>{{!empty($resume_pasien->lab_belum) ? $resume_pasien->lab_belum : ""}}</td>
    </tr>
    <br>
    <tr>
        <td border="0" colspan="4" height="30">Instruksi/Anjuran Dan Edukasi (Follow Up) : <br>{{!empty($resume_pasien->edukasi) ? $resume_pasien->edukasi : ""}}</td>
    </tr>
    <br>
    <tr cellpadding="0">
        <td colspan="2" width="50%" ><table>
                <tr>
                    <td width="30%">Keadaan Pulang </td>
                    <td width="2%">:</td>
                    <td width="58%">{{!empty($resume_pasien->keadaan) ? $resume_pasien->keadaan : ""}}</td>
                </tr>
            </table>
        </td>
        <td colspan="2" width="50%" ><table>
                <tr>
                    <td width="30%">Cara Keluar </td>
                    <td width="2%">:</td>
                    <td width="58%">{{!empty($resume_pasien->cara_keluar) ? $resume_pasien->cara_keluar : ""}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" width="50%" ><table>
                <tr>
                    <td width="30%">Dilanjutkan </td>
                    <td width="2%">:</td>
                    <td width="58%">{{!empty($resume_pasien->dilanjutkan) ? $resume_pasien->dilanjutkan : ""}}</td>
                </tr>
            </table>
        </td>
        <td colspan="2" width="50%" ><table>
                <tr>
                    <td width="30%">Tanggal Kontrol </td>
                    <td width="2%">:</td>
                    <td width="58%">{{!empty($resume_pasien->kontrol) ? $resume_pasien->kontrol : ""}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" width="50%" >Obat-obatan waktu pulang : <br>{{!empty($resume_pasien->obat_pulang) ? $resume_pasien->obat_pulang : ""}}</td>
    </tr>
</table>

