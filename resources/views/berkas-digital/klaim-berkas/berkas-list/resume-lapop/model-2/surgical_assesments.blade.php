<table style="border-bottom:1px solid black;"  cellpadding="0">
    <tbody>
    <tr>
            <td valign="top" width="43%">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Tanggal",
                    "data" => !empty($laporan_operasi->tgl_perawatan) ? $laporan_operasi->tgl_perawatan : "-"
                ])
            </td>
            <td valign="top" width="30%">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Waktu",
                    "data" => !empty($laporan_operasi->jam_rawat) ? $laporan_operasi->jam_rawat : "-"
                ])
            </td>
            <td valign="top" width="27%">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Alergi",
                    "data" => !empty($laporan_operasi->alergi) ? $laporan_operasi->alergi : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="3" width="43%">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Dokter Bedah",
                    "data" => !empty($laporan_operasi->operator1) ? $laporan_operasi->operator1 : "-"
                ])
            </td>
        </tr>
    </tbody>
</table>

<table cellpadding="2">
    <tr>
        <td style="border-right:1px solid black;">
            <table>
                <tr>
                    <td>Keluhan : <br>&nbsp; {{!empty($laporan_operasi->keluhan) ? $laporan_operasi->keluhan : "-"}}</td>
                </tr>
                <tr>
                    <td>Pemeriksaan:&nbsp; {{!empty($laporan_operasi->pemeriksaan) ? $laporan_operasi->pemeriksaan : "-"}}</td>
                </tr>
                <tr>
                    <td width="40%">&nbsp; Suhu Tubuh.(C)</td>
                    <td width="10%">{{!empty($laporan_operasi->suhu_tubuh) ? $laporan_operasi->suhu_tubuh : "-"}}</td>
                    <td width="40%">&nbsp; Nadi (/Mnt).</td>
                    <td width="10%">{{!empty($laporan_operasi->nadi) ? $laporan_operasi->nadi : "-"}}</td>
                </tr>
                <tr>
                    <td width="40%">&nbsp; Tensi.</td>
                    <td width="10%">{{!empty($laporan_operasi->tensi) ? $laporan_operasi->tensi : "-"}}</td>
                    <td width="40%">&nbsp; Respirasi (/Mnt).</td>
                    <td width="10%">{{!empty($laporan_operasi->respirasi) ? $laporan_operasi->respirasi : "-"}}</td>
                </tr>
                <tr>
                    <td width="40%">&nbsp; Tinggi (Cm).</td>
                    <td width="10%">{{!empty($laporan_operasi->tinggi) ? $laporan_operasi->tinggi : "-"}}</td>
                    <td width="40%">&nbsp; GCS (E,V,M).</td>
                    <td width="10%">{{!empty($laporan_operasi->keluhan) ? $laporan_operasi->keluhan : "-"}}</td>
                </tr>
                <tr>
                    <td width="40%">&nbsp; GCS (E,V,M).</td>
                    <td width="10%">{{!empty($laporan_operasi->gcs) ? $laporan_operasi->gcs : "-"}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table>
                <tr>
                    <td>Penilaian : <br>&nbsp; {{!empty($laporan_operasi->penilaian) ? $laporan_operasi->penilaian : "-"}}</td>
                </tr>
                <tr>
                    <td>Tindak Lanjut : <br>&nbsp; {{!empty($laporan_operasi->rtl) ? $laporan_operasi->rtl : "-"}}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>