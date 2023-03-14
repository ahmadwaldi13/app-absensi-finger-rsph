@php
    $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
@endphp
<table >
    @if(!empty($hasil_pemeriksaan_lab_pk->noorder))
    <tbody>
        <tr>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "No. RM",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->no_rkm_medis) ? $hasil_pemeriksaan_lab_pk->no_rkm_medis : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "No.Permintaan Lab",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->noorder) ? $hasil_pemeriksaan_lab_pk->noorder : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Nama Pasien",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->nm_pasien) ? $hasil_pemeriksaan_lab_pk->nm_pasien : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Tgl.Permintaan",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->tgl_permintaan) ? $hasil_pemeriksaan_lab_pk->tgl_permintaan : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "JK/Umur",
                    "data" => (!empty($hasil_pemeriksaan_lab_pk->jk) ? $hasil_pemeriksaan_lab_pk->jk : "-")." / ".(!empty($hasil_pemeriksaan_lab_pk->umur) ? $hasil_pemeriksaan_lab_pk->umur : "-")
                ])
            </td>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Jam Permintaan",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->jam_permintaan) ? $hasil_pemeriksaan_lab_pk->jam_permintaan : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Alamat",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->alamat) ? $hasil_pemeriksaan_lab_pk->alamat : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Tgl. Keluar Hasil",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->tgl_periksa) ? $hasil_pemeriksaan_lab_pk->tgl_periksa : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "No.Periksa",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->no_rawat) ? $hasil_pemeriksaan_lab_pk->no_rawat : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Jam Keluar Hasil",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->jam_periksa) ? $hasil_pemeriksaan_lab_pk->jam_periksa : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Dokter Pengirim",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->nm_dokter) ? $hasil_pemeriksaan_lab_pk->nm_dokter : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
                @if($fr == "rj")
                    @include('berkas-digital.klaim-berkas.components.column', [
                        "title" => "Poli",
                        "data" => !empty($hasil_pemeriksaan_lab_pk->nm_poli) ? $hasil_pemeriksaan_lab_pk->nm_poli : "-"
                    ])
                @elseif ($fr =="ri")
                    @include('berkas-digital.klaim-berkas.components.column', [
                        "title" => "Kamar",
                        "data" => !empty($hasil_pemeriksaan_lab_pk->nama_kamar) ? $hasil_pemeriksaan_lab_pk->nama_kamar : "-"
                    ])
                @endif
            </td>
        </tr>
    </tbody>
    @else
    <tbody>
        <tr>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "No. RM",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->no_rkm_medis) ? $hasil_pemeriksaan_lab_pk->no_rkm_medis : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Penanggung Jawab",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->dokter_pj) ? $hasil_pemeriksaan_lab_pk->dokter_pj : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Nama Pasien",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->nm_pasien) ? $hasil_pemeriksaan_lab_pk->nm_pasien : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Dokter Pengirim",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->nm_dokter) ? $hasil_pemeriksaan_lab_pk->nm_dokter : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "JK/Umur",
                    "data" => (!empty($hasil_pemeriksaan_lab_pk->jk) ? $hasil_pemeriksaan_lab_pk->jk : "-")." / ".(!empty($hasil_pemeriksaan_lab_pk->umur) ? $hasil_pemeriksaan_lab_pk->umur : "-")
                ])
            </td>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Tgl Pemeriksaan",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->tgl_periksa) ? $hasil_pemeriksaan_lab_pk->tgl_periksa : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Alamat",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->alamat) ? $hasil_pemeriksaan_lab_pk->alamat : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Jam Pemeriksaan",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->jam_periksa) ? $hasil_pemeriksaan_lab_pk->jam_periksa : "-"
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "No.Periksa",
                    "data" => !empty($hasil_pemeriksaan_lab_pk->no_rawat) ? $hasil_pemeriksaan_lab_pk->no_rawat : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
                @if($fr == "rj")
                    @include('berkas-digital.klaim-berkas.components.column', [
                        "title" => "Poli",
                        "data" => !empty($hasil_pemeriksaan_lab_pk->nm_poli) ? $hasil_pemeriksaan_lab_pk->nm_poli : "-"
                    ])
                @elseif ($fr =="ri")
                    @include('berkas-digital.klaim-berkas.components.column', [
                        "title" => "Kamar",
                        "data" => !empty($hasil_pemeriksaan_lab_pk->nama_kamar) ? $hasil_pemeriksaan_lab_pk->nama_kamar : "-"
                    ])
                @endif
            </td>
        </tr>
    </tbody>
    @endif
</table>