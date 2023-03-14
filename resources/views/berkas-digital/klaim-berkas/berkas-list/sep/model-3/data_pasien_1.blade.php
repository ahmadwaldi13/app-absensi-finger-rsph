<table width="100%" cellpadding="4" cellspacing="0">
    <tr>
        <td>

            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "No. SEP",
                "data" => !empty($sep_data->no_sep) ? $sep_data->no_sep : ""
            ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Tgl. SEP",
                    "data" => !empty($sep_data->tglsep) ? $sep_data->tglsep : ""
                ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "No. Kartu",
                "data" => !empty($sep_data->no_kartu) ? $sep_data->no_kartu : ""
            ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Nama Peserta",
                    "data" => !empty($sep_data->nama_pasien) ? $sep_data->nama_pasien  : ""
                ])
        </td>
    </tr>
    <tr>
        <td>
            <?php 
            $tgl_lahir = !empty($sep_data->tanggal_lahir) ? $sep_data->tanggal_lahir : "";
            $jkel = !empty($sep_data->jkel) ? $sep_data->jkel : "";
            $text = "$tgl_lahir Kelamin: $jkel";?>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Tgl. Lahir",
                    "data" =>  $text
                ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "No. Telepon",
                    "data" => !empty($sep_data->notelep) ? $sep_data->notelep : ""
                ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Sub/Spesialis",
                    "data" => !empty($sep_data->nmpolitujuan) ? $sep_data->nmpolitujuan : ""
                ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Dokter",
                "data" => !empty($sep_data->nmdpdjp) ? $sep_data->nmdpdjp : ""
            ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Faskes",
                "data" => !empty($sep_data->nmppkrujukan) ? $sep_data->nmppkrujukan : ""
            ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Diagnosa Awal",
                    "data" => !empty($sep_data->nmdiagnosaawal) ? $sep_data->nmdiagnosaawal : ""
                ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Catatan",
                    "data" => !empty($sep_data->catatan) ? $sep_data->catatan : ""
                ])
        </td>
    </tr>
</table>
