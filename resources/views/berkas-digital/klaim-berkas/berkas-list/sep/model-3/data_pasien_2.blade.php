@php
    $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
@endphp
<table width="100%" cellpadding="2.5">
    <tr>
        <td align="center">
            {{!empty($sep_data->prb) ? $sep_data->prb : "\n"}}
        </td>
    </tr>
    <tr>
        <td>
            <?php
                    if(!empty($sep_data->jnspelayanan)){
                        $data = $sep_data->jnspelayanan == 2 ? "R.Jalan" : "R.Inap";
                    } else $data ="";
                ?>
                @include('berkas-digital.klaim-berkas.components.column', [
                        "title" => "Jns. Rawat",
                        "data" => $data
                    ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "No. Reg",
                "data" => !empty($sep_data->no_reg) ? $sep_data->no_reg : ""
            ])
        </td>
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title"=> "Peserta",
                "data" => !empty($sep_data->peserta) ?  $sep_data->peserta : ""
            ])
        </td>
    </tr>
    <tr>
        <td>
            <?php
                if(!empty($sep_data->jnspelayanan)){
                    $data = $sep_data->jnspelayanan == 2 ? "R.Jalan" : "R.Inap";
                } else $data =""; 
            ?>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Jns. Rawat",
                    "data" => $data
                ])
        </td>
    </tr>
    <tr>
        <td>
            <?php
                if(isset($sep_data->tujuankunjungan)){
                    $tujuanKunjungan = $sep_data->tujuankunjungan == "0" ? "Konsultasi dokter(pertama)" : "Kunjungan Kontrol(ulangan)";
                } else $tujuanKunjungan ="";
            ?>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Jns. Kunjungan",
                    "data" =>  $tujuanKunjungan 
                ])
        </td>
    </tr>
    <br>
    <tr>
        <td>
            @if($fr == "rj")
                @include('berkas-digital.klaim-berkas.components.column', [
                        "title" => "Poli Perujuk",
                        "data" => !empty($sep_data->nm_poli) ? $sep_data->nm_poli : ''
                    ])
            @else
                @include('berkas-digital.klaim-berkas.components.column', [
                        "title" => "Kamar",
                        "data" => !empty($sep_data->nama_kamar) ? $sep_data->nama_kamar : ''
                    ])
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <?php
                if(!empty($sep_data->klsrawat)){
                    $kelasrawat = $sep_data->klsrawat == "1" ? "Kelas 1" : $sep_data->klsrawat == "2" ? "Kelas 2" : "Kelas 3";
                } else $kelasrawat ="";
            ?>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Kls. Hak",
                    "data" => $kelasrawat
                ])
        </td>
    </tr>
    <tr>
        <td>
            <?php
                if(!empty($sep_data->klsrawat)){
                    $data = $sep_data->klsrawat == 1 ? "Kelas 1" : $sep_data->klsrawat == 2 ? "Kelas 2" : "Kelas 3";
                }else $data ="";
            ?>
            @include('berkas-digital.klaim-berkas.components.column', [
                    "title" => "Kls. Rawat",
                    "data" => $data 
            ])
        </td>
        
    </tr>
    <tr>
        <td>
            @include('berkas-digital.klaim-berkas.components.column', [
                "title" => "Penjamin",
                "data" => !empty($sep_data->pembiayaan) ? 
                            ($sep_data->pembiayaan == "1" ? "Pribadi":
                                $sep_data->pembiayaan == "2" ? "Pemberi Kerja" : "Asuransi Lain"  ) : ""
            ])
        </td>
    </tr>
</table>


<table>
    
</table>