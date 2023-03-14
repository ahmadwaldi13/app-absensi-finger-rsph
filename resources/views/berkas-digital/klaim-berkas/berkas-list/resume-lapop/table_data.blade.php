<table class="table">
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Nomor Rawat",
                    "data" => !empty($laporan_operasi['no_rawat']) ? $laporan_operasi['no_rawat'] : ""
                ])
        </td>  
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Operasi Mulai",
                    "data" => !empty($laporan_operasi['tanggal']) ? $laporan_operasi['tanggal'] : ""
                ])
        </td>  
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Selesai Operasi",
                    "data" => !empty($laporan_operasi['selesaioperasi']) ? $laporan_operasi['selesaioperasi'] : ""
                ])
        </td>  
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Diagnosa Preop",
                    "data" => !empty($laporan_operasi['diagnosa_preop']) ? $laporan_operasi['diagnosa_preop'] : ""
                ])
        </td>  
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Diagnosa Postop",
                    "data" => !empty($laporan_operasi['diagnosa_postop']) ? $laporan_operasi['diagnosa_postop'] : ""
                ])
        </td>  
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Jaringan Eksekusi",
                    "data" => !empty($laporan_operasi['jaringan_dieksekusi']) ? $laporan_operasi['jaringan_dieksekusi'] : ""
                ])
        </td>  
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Perimintaan PA",
                    "data" => !empty($laporan_operasi['permintaan_pa']) ? $laporan_operasi['permintaan_pa'] : ""
                ])
        </td>  
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Laporan Operasi",
                    "data" => !empty($laporan_operasi['laporan_operasi']) ? $laporan_operasi['laporan_operasi'] : ""
                ])
        </td>  
    </tr>
</table>
