@php
    $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
@endphp
<table >
    <tbody>
        <tr>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Nama Pasien",
                    "data" => !empty($laporan_operasi->nm_pasien) ? $laporan_operasi->nm_pasien : "-"
                ])
            </td>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "No. Rekam Medis",
                    "data" => !empty($laporan_operasi->no_rkm_medis) ? $laporan_operasi->no_rkm_medis : "-" 
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Umur",
                    "data" => !empty($laporan_operasi->umurdaftar) ? $laporan_operasi->umurdaftar." ".$laporan_operasi->sttsumur : "-" 
                ])
            </td>
            <td valign="top" class="pdf-row">
                @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => $fr == "rj" ? "Poli" : "Ruang",
                    "data" => $fr == "rj" ? 
                                    (!empty($laporan_operasi->nm_poli) ? $laporan_operasi->nm_poli : "-" ) :
                                    (!empty($laporan_operasi->nama_kamar) ? $laporan_operasi->nama_kamar : "-" )
                ])
            </td>
        </tr>
        <tr>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Tgl. Lahir",
                    "data" => !empty($laporan_operasi->tgl_lahir) ? $laporan_operasi->tgl_lahir : "-" 
                ])
            </td>
            <td valign="top" class="pdf-row">
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Jenis Kelamin",
                    "data" => !empty($laporan_operasi->jk) ? ($laporan_operasi->jk == "L" ? "Laki-Laki" : "Perempuan") : "-" 
                ])
            </td>
        </tr>
    </tbody>
<table>