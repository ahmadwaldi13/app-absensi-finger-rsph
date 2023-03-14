<section id="eligibilitas">
    <div class="section-header">
        <table >

            <tr>
                <td rowspan="2" width="30%"><img src="{{ asset('icon/bpjslogo.png')}}" alt="Image" width="300" height="50">  </td>
                <td width="40%" style="font-size:xx-large">SURAT ELEGIBILITAS PESERTA</td>
                <td width="30%"></td>
            </tr>
            <tr>
                <td width="40%" style="font-size:x-large">{{(!empty($settings->nama_instansi) ? $settings->nama_instansi : '')}}</td>
                <td width="30%"></td>
            </tr>
        </table>

    </div>
    
    <div class="section-body">
        <table>
            <tr>
                <td width="50%">
                    @include("berkas-digital.klaim-berkas.berkas-list.sep.model-3.data_pasien_1")
                </td>
                <td width="50%" valign="top" align="center">
                    <?php 
                        $barcode = barcode(!empty($sep_data->no_sep) ? $sep_data->no_sep : "N/A", 30, 30);
                    ?>
                    <img class="mb-2" src="data:image/svg+xml;base64,{{base64_encode($barcode)}}"  width="450" height="45" />
                    @include("berkas-digital.klaim-berkas.berkas-list.sep.model-3.data_pasien_2")
                </td>
            </tr>
        </table>

    </div>

    <div class="bottom_eligibilitas section-footer">
        <table>
            <tr>
                <td class="agreement ">
                    <p>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan.</p>
                    <p>**SEP bukan sebagai bukti penjaminan peserta</p>
                    <p>Cetakan ke 1 {{(!empty($sep_data->tgl_registrasi) ? $sep_data->tgl_registrasi : "")." ".(!empty($sep_data->jam_reg) ? $sep_data->jam_reg : "")}} </p>
                    <p>Masa berlaku {{isset($sep_data->tglrujukan) ? $sep_data->tglrujukan : ""}} s/d {{isset($sep_data->batas_rujukan) ? $sep_data->batas_rujukan : ""}}</p>
                </td>
                <td class=" text-end">
                    <div class="d-inline-block text-center page-break-inside-avoid">
                        <p>Pasien/Keluarga Pasien</p>
                        <div class="qrCode">
                            <?php $text = "No SEP: ".(isset($sep_data->no_sep) ? $sep_data->no_sep : "");?>
                            <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                        </div>
                        <p>@isset($sep_data->nama_pasien) {{$sep_data->nama_pasien}} @endisset</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</section>