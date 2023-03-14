@php
    $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
@endphp
<table class="mb pemeriksaan-pasien table-double-column">
    <tbody>
        <tr valign="top">
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "No. RM",
                    "data" => !empty($hasil_pemeriksaan_radiologi->no_rkm_medis) ? $hasil_pemeriksaan_radiologi->no_rkm_medis : "-"
                ])
            </td>
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Penanggung Jawab",
                    "data" => !empty($hasil_pemeriksaan_radiologi->nm_dokter) ? $hasil_pemeriksaan_radiologi->nm_dokter : ""
                ])
            </td>
        </tr>
        <tr valign="top">
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Nama Pasien",
                    "data" => !empty($hasil_pemeriksaan_radiologi->nm_pasien) ? $hasil_pemeriksaan_radiologi->nm_pasien : ""
                ])
            </td>
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Dokter Pengirim",
                    "data" => !empty($hasil_pemeriksaan_radiologi->dokter_pengirim) ? $hasil_pemeriksaan_radiologi->dokter_pengirim : ""
                ])
            </td>
        </tr>
        <tr valign="top">
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "JK/Umur",
                    "data" => (!empty($hasil_pemeriksaan_radiologi->jk) ? $hasil_pemeriksaan_radiologi->jk : "")." / ".(!empty($hasil_pemeriksaan_radiologi->umur) ? $hasil_pemeriksaan_radiologi->umur : "")
                ])
            </td>
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Tgl.Pemeriksaan",
                    "data" => !empty($hasil_pemeriksaan_radiologi->tgl_periksa) ? $hasil_pemeriksaan_radiologi->tgl_periksa : ""
                ])
            </td>
        </tr>
        <tr valign="top">
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Alamat",
                    "data" => !empty($hasil_pemeriksaan_radiologi->alamat) ? $hasil_pemeriksaan_radiologi->alamat : ""
                ])
            </td>
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Jam Pemeriksaan",
                    "data" => !empty($hasil_pemeriksaan_radiologi->jam) ? $hasil_pemeriksaan_radiologi->jam : ""
                ])
            </td>
        </tr>
        <tr valign="top">
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "No.Periksa",
                    "data" => !empty($hasil_pemeriksaan_radiologi->no_rawat) ? $hasil_pemeriksaan_radiologi->no_rawat : ""
                ])
            </td>
            <td class="pdf-row">
                @if($fr == "rj")
                    @include('berkas-digital.klaim-berkas.components.column', [
                        "title" => "Poli",
                        "data" => !empty($hasil_pemeriksaan_radiologi->nm_poli) ? $hasil_pemeriksaan_radiologi->nm_poli : ""
                    ])
                @elseif ($fr =="ri")
                    @include('berkas-digital.klaim-berkas.components.column', [
                        "title" => "Kamar",
                        "data" => !empty($hasil_pemeriksaan_radiologi->nama_kamar) ? $hasil_pemeriksaan_radiologi->nama_kamar : ""
                    ])
                @endif
            </td>
        </tr>
        <tr valign="top">
            <td class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Pemeriksaan",
                    "data" => !empty($hasil_pemeriksaan_radiologi->nm_perawatan) ? $hasil_pemeriksaan_radiologi->nm_perawatan : ""
                ])
            </td>
        </tr>
    </tbody>
</table>