
<table>
    <tbody>
        <tr>
            @php
                $image_width = !empty($is_pdf) ? "170" :"350";
                $image_height = !empty($is_pdf) ? "27" : "50";
            @endphp
            <td  width="33%" >
                <img src="{{asset('icon/bpjslogo.png')}}"  width="{{$image_width}}" height="{{$image_height}}" />
            </td>
            <td  width="43%" >
                <span style="font-size:{{!empty($is_pdf) ? 'large' : 'x-large'}}">SURAT RENCANA KONTROL</span><br>
                <span>{{(!empty($settings->nama_instansi) ? $settings->nama_instansi : '')}}</span>
            </td>
            <td  width="23%">
                <span>No. {{!empty($skdp->no_surat) ? $skdp->no_surat : ""}}</span><br>
                <span>Tgl. {{!empty($skdp->tgl_rencana) ? date("d F Y", strtotime($skdp->tgl_rencana))  : ""}} </span>    
            </td>
        </tr>


    </tbody>
</table> 
<br> @if(!empty($is_pdf)) <br> @endif

<table >
    <tr>
        <td width="50%">
            <table cellpadding="2" cellspacing="0">
                <tbody>
                    <tr>
                        <td width="100%">@include('berkas-digital.klaim-berkas.components.column', [
                                "title" => "Kepada YTH",
                                "data" => !empty($skdp->nm_dokter_bpjs) ? $skdp->nm_dokter_bpjs : ""
                            ])</td>
                    </tr>
                
                    <tr>
                        <td width="100%">@include('berkas-digital.klaim-berkas.components.column', [
                                "title" => "",
                                "data" =>!empty($skdp->nm_poli_bpjs) ? $skdp->nm_poli_bpjs : ""
                            ])</td>
                    </tr>
                    <tr>
                        <td width="100%">Mohon Pemeriksaan dan Penanganan Lebih Lanjut :</td>
                    </tr>
                    <tr>
                        <td width="100%">@include('berkas-digital.klaim-berkas.components.column', [
                                "title" => "No. Kartu",
                                "data" => !empty($skdp->no_kartu) ? $skdp->no_kartu : ""
                            ])</td>
                    </tr>
                    <tr>
                        <td width="100%">@include('berkas-digital.klaim-berkas.components.column', [
                                "title" => "Nama Peserta",
                                "data" => !empty($skdp->nama_pasien) ? $skdp->nama_pasien : ""
                            ])</td>
                    </tr>
                    <tr>
                        <td width="100%">@include('berkas-digital.klaim-berkas.components.column', [
                                "title" => "Tgl Lahir",
                                "data" => !empty($skdp->tanggal_lahir) ? date("d F Y", strtotime($skdp->tanggal_lahir)) : ""
                            ])</td>
                    </tr>
                    <tr>
                        <td width="100%">@include('berkas-digital.klaim-berkas.components.column', [
                                "title" => "Diagnosa Awal",
                                "data" => !empty($skdp->nmdiagnosaawal) ? $skdp->nmdiagnosaawal : ""
                            ])</td>
                    </tr>
                    <tr>
                        <td width="100%">@include('berkas-digital.klaim-berkas.components.column', [
                                "title" => "Tgl. Entri",
                                "data" => !empty($skdp->tgl_surat) ? date("d F Y", strtotime($skdp->tgl_surat)) : ""
                            ])
                        </td>
                        
                    </tr>
                    <tr>
                        <td width="100%">Demikian atas bantuannya, diucapkan banyak terima kasih</td>
                    </tr>
                    
                </tbody>
            </table>
        </td>
        <td  valign="top" align="center">
            @empty($is_pdf)
                @php
                    $barcode = barcode(!empty($skdp->no_surat) ? $skdp->no_surat : "N/A", 30, 30);
                @endphp
                <img class="mb-2" src="data:image/svg+xml;base64,{{base64_encode($barcode)}}"  width="450" height="40" />
            @endempty
        </td>
    </tr>

</table>