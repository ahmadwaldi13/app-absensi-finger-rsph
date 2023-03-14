<table>
                    <tr>
                        <td>
                            <b><u>PRB : @isset($print_sep->prb) {{$print_sep->prb}} @endisset</u></b>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "No. SEP",
                                    "data" => !empty($print_sep->no_sep) ? $print_sep->no_sep : ""
                                ])
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "Tgl. SEP",
                                    "data" => !empty($print_sep->tglsep) ? $print_sep->tglsep : ""
                                ])
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "No. Kartu",
                                    "data" => !empty($print_sep->no_kartu) ? $print_sep->no_kartu : ""
                               ])
                        </td>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title"=> "Peserta",
                                    "data" => !empty($print_sep->peserta) ?  $print_sep->peserta : ""
                                ])
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%">
                            
                        </td>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "COB",
                                    "data" => !empty($print_sep->cob) ? $print_sep->cob  : ""
                                ])
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <?php 
                            $tgl_lahir = !empty($print_sep->tanggal_lahir) ? $print_sep->tanggal_lahir : "";
                            $jkel = !empty($print_sep->jkel) ? $print_sep->jkel : "";
                            $text = "$tgl_lahir Kelamin: $jkel";?>
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "Tgl. Lahir",
                                    "data" =>  $text
                                ])
                        </td>
                        <td width="50%">
                            <?php
                            if(!empty($print_sep->jnspelayanan)){
                                $data = $print_sep->jnspelayanan == 2 ? "R.Jalan" : "R.Inap";
                            } else $data ="";
                            
                            
                            ?>
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "Jns. Rawat",
                                    "data" => $data
                                ])
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "No. Telepon",
                                    "data" => !empty($print_sep->notelep) ? $print_sep->notelep : ""
                                ])
                        </td>
                        <td width="50%">
                            <?php
                                if(!empty($print_sep->klsrawat)){
                                    $data = $print_sep->klsrawat == 1 ? "Kelas 1" : $print_sep->klsrawat == 2 ? "Kelas 2" : "Kelas 3";
                                }else $data ="";
                            ?>
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "Kls. Rawat",
                                    "data" => $data 
                                ])
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "Spesialis/Sub Spesialis",
                                    "data" => !empty($print_sep->nmpolitujuan) ? $print_sep->nmpolitujuan : ""
                                ])
                        </td>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "Penjamin",
                                    "data" => !empty($print_sep->penjamin) ? $print_sep->penjamin : ""
                                ])
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "DPJP Yg Melayani",
                                    "data" => !empty($print_sep->nmdpdjp) ? $print_sep->nmdpdjp : ""
                                ])
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "Faskes Perujuk",
                                    "data" => !empty($print_sep->nmppkrujukan) ? $print_sep->nmppkrujukan : ""
                                ])
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "Diagnosa Awal",
                                    "data" => !empty($print_sep->nmdiagnosaawal) ? $print_sep->nmdiagnosaawal : ""
                                ])
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%">
                            @include('berkas-digital.klaim-berkas.components.column', [
                                    "title" => "Catatan",
                                    "data" => !empty($print_sep->catatan) ? $print_sep->catatan : ""
                                ])
                        </td>
                    </tr>
                </table>