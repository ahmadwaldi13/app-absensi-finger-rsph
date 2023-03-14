@php
    
function barcode($str, $w, $h){
    $pdf = new TCPDF2DBarcode($str, 'QRCODE,H');
    return $pdf->getBarcodeSVGcode($w,$h , 'black');
}


@endphp
<table>
    <tr>
        <td cellpadding="0" cellspacing="0"  width="60%">
            <table>
                <tr>
                    <td width="25%" cellspacing="0">Nomor</td>
                    <td width="2%">:</td>
                    <td width="73%">{{!empty($data->no_permintaan) ? $data->no_permintaan : ''}}</td>
                </tr>
                <tr>
                    <td width="25%" cellspacing="0">Lampiran</td>
                    <td width="2%">:</td>
                    <td width="73%"></td>
                </tr>
                <tr>
                    <td width="25%" cellspacing="0">Perihal</td>
                    <td width="2%">:</td>
                    <td width="73%">Permohonan Amprahan Barang</td>
                </tr>
            </table>
        </td>
        <td  width="40%" >
                Karang Baru, <br>
                Kepada Yth, <br>
                Direktur Rumah Sakit  Umum Daerah <br>
                Kabupaten Aceh Tamiang <br>
                C/q Bendaharawan Rutin <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;di - <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat 
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:justify">Untuk memenuhi kebutuhan Pengendali Medis pada Rumah Sakit Umum Daerah Kabupaten Aceh Tamiang, bulan ............................., maka dengan ini kami mohon amprahan barang berupa:</td>
    </tr>
    <br>
    <tr >
        <td colspan="2" width="100%"  align="left">
            <table >
                <thead>
                    <tr align="center" >
                        <th width="5%" border="1" rowspan="2">No</th>
                        <th width="30%" border="1"rowspan="2">Nama Barang</th>
                        <th width="34%" border="1" colspan="2">Jumlah</th>
                        <th width="30%" border="1"rowspan="2">Keterangan</th>
                    </tr>
                    <tr align="center" valign="middle">
                        <th width="17%" border="1">Permintaan</th>
                        <th width="17%" border="1">Diberikan</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data->nama_penerima))
                        @foreach ($data->list_data as $key => $value )
                            <tr>
                                <td align="center" border="1" align="center" cellpadding="5" style="height:14px">{{$key+1}}</td>
                                <td align="center" border="1"style="height:14px">{{!empty($value->nama_brng) ? $value->nama_brng :'' }}</td>
                                <td align="center" border="1"style="height:14px">{{!empty($value->jumlah_permintaan) ? $value->jumlah_permintaan :'' }}</td>
                                <td align="center" border="1"style="height:14px">{{!empty($value->jumlah) ? $value->jumlah :'' }}</td>
                                <td align="center" border="1"style="height:14px">{{!empty($value->keterangan_permintaan) ? $value->keterangan_permintaan :'' }}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($data->list_data as $key => $value )
                            <tr>
                                <td align="center" border="1" align="center" cellpadding="5" style="height:14px">{{$key+1}}</td>
                                <td align="center" border="1"style="height:14px">{{!empty($value->nama_brng) ? $value->nama_brng :'' }}</td>
                                <td align="center" border="1"style="height:14px">{{!empty($value->jumlah) ? $value->jumlah :'' }}</td>
                                <td align="center" border="1"style="height:14px">-</td>
                                <td align="center" border="1"style="height:14px">{{!empty($value->keterangan) ? $value->keterangan :'' }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </td>
    </tr>
    <br>
    <tr>
        <td colspan="2" style="text-align:justify">Demikianlah kami sampaiakn untuk dapat dipertimbangkan selanjutnya dan terima kasih.</td>
    </tr>
    <br>
    <tr>
        <td  width="70%">
            <table >
                <tr><td>Pemohon</td></tr>
                <tr><td>Ka. Ruang</td></tr>
                {{-- @php
                 $qrcode =  barcode($data->finger_pemohon,30, 30);   
                @endphp
                <img src="@{{$qrcode}}" alt=""> --}}
                <tr><td><tcpdf method="write2DBarcode" params="{{$qrcodes->pemohon}}" /></td></tr>
                @for ($i = 1; $i < 4; $i++)
                    <tr><td></td></tr>
                @endfor
                <tr><td>{{!empty($data->nama_pemohon) ? $data->nama_pemohon : '....................................'}}</td></tr>
                <tr><td>NIP {{!empty($data->nip_pemohon) ? $data->nip_pemohon : ''}}</td></tr>
            </table>
        </td>
        <td  width="30%" >
            <table >
                <tr><td>Yang Menerima</td></tr>

                <tr><td><tcpdf method="write2DBarcode" params="{{$qrcodes->penerima}}" /></td></tr>
                @for ($i = 1; $i < 4; $i++)
                    <tr><td></td></tr>
                @endfor
                <tr><td>{{!empty($data->nama_penerima) ? $data->nama_penerima : '....................................'}}</td></tr>
                <tr><td>NIP {{!empty($data->nip_penerima) ? $data->nip_penerima : ''}}</td></tr>
            </table>
        </td>
    </tr>
    <br>
    <tr>
        <td align="center" colspan="2">
            <table >
                <tr><td>Mengetahui</td></tr>
                <tr><td>Kabid Penunjang Medis</td></tr>
                <tr><td><tcpdf method="write2DBarcode" params="{{$qrcodes->kabid}}" /></td></tr>
                @for ($i = 1; $i < 2; $i++)
                    <tr><td></td></tr>
                @endfor
                <tr><td>{{!empty($data->nama_kabid) ? $data->nama_kabid : '....................................'}}</td></tr>
                <tr><td>NIP {{!empty($data->nip_kabid) ? $data->nip_kabid : ''}}</td></tr>
            </table>
        </td>
    </tr>
</table>
