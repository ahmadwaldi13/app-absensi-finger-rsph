<section id="eligibilitas">

    <div class="section-header">
        <table align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <img src="{{ asset('icon/bpjslogo.png')}}" alt="Image" width="350" height="52">
                </td>
            </tr>
            <tr>
                <td style="font-size:xx-large">SURAT ELEGIBILITAS PESERTA</td>
            </tr>
            <tr>
                <td style="font-size:x-large">{{(!empty($settings->nama_instansi) ? $settings->nama_instansi : '')}}</td>
            </tr>
        </table>

    </div>

    <div class="section-body">
        @include("berkas-digital.klaim-berkas.berkas-list.sep.table_data")
    </div>

    <div class="bottom_eligibilitas section-footer">
        <table>
            <tr>
                <td class="agreement ">
                    <p>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan.</p>
                    <p>**SEP bukan sebagai bukti penjaminan peserta</p>
                    <p>Cetakan ke 1 {{(!empty($reg_periksa->tgl_registrasi) ? $reg_periksa->tgl_registrasi : "")." ".(!empty($reg_periksa->jam_reg) ? $reg_periksa->jam_reg : "")}} </p>
                    <p>Masa berlaku {{isset($print_sep->tglrujukan) ? $print_sep->tglrujukan: ""}} s/d {{isset($print_sep->batas_rujukan) ? $print_sep->batas_rujukan : ""}}</p>
                </td>
                <td class=" text-end">
                    <div class="d-inline-block text-center page-break-inside-avoid">
                        <p>Pasien/Keluarga Pasien</p>
                        <div class="qrCode">
                            <?php $text = "No SEP: ".(isset($print_sep->no_sep) ? $print_sep->no_sep : "");?>
                            <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                        </div>
                        <p>@isset($print_sep->) {{$print_sep->nama_pasien}} @endisset</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</section>