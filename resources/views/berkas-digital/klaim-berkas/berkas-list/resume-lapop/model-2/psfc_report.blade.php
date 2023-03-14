<table  width="100%" style="min-height:400px">
    <tr >
        <td width="80%" valign="top">
            {{!empty($laporan_operasi->laporan_operasi) ? $laporan_operasi->laporan_operasi : ""}}
        </td>
        @empty($is_pdf)
            <td align="center" valign="bottom">
                <p class="m-0">{{!empty($laporan_operasi->tgl_operasi) ? date('d/m/Y', strtotime(explode(" ", $laporan_operasi->tgl_operasi)[0])) : "-"}}</p>
                <p class="m-0">Dokter Bedah</p>
                <div class="qrCode">
                    <?php
                        $id = !empty($laporan_operasi->sidikjari) ? $laporan_operasi->sidikjari : (!empty($laporan_operasi->kode_operator) ? $laporan_operasi->kode_operator : "") ;
                        $nama_pj = !empty($laporan_operasi->operator1) ? $laporan_operasi->operator1 : "";
                        $text = "Dikeluarkan di ".(!empty($settings->nama_instansi) ? $settings->nama_instansi : '').", Kabupaten/Kota ".(!empty($settings->kabupaten) ? $settings->kabupaten : '')."\nDitandatangani secara elektronik oleh ".$nama_pj."\nID ".$id. "\n ". (!empty($laporan_operasi->tgl_operasi) ? $laporan_operasi->tgl_operasi : "");
                    ?>
                    <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                </div>
                <p class="m-0">{{!empty($laporan_operasi->operator1) ? $laporan_operasi->operator1 : ""}}</p>
            </td>
        @endempty
    </tr>
</table>