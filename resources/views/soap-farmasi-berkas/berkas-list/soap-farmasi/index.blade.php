<?php
function qrcode($str){
    return QrCode::size(300)->generate($str)->toHtml();
}
function barcode($str, $w, $h){
    $pdf = new TCPDFBarcode($str, 'C39');
    return $pdf->getBarcodeSVGcode(2,30 , 'black');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAP Farmasi</title>
    @section("header")
    @show
    <style>
        @font-face {
            font-family: 'open-sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{asset('public/fonts/open-sans/OpenSans-Medium.ttf')}}") format('truetype');
        }

    </style>
    <link rel="stylesheet" href="{{asset('css/berkas_digital/pdf2.css')}}">

</head>

<body>
    <section id="pemeriksaan-labor-1">
        @include('berkas-digital.klaim-berkas.berkas-kop')


        <div class="section-header">
            <p class="font-lg">Hasil SOAP Farmasi </p>
        </div>
        <div class="section-body">
            <div>
                @include('soap-farmasi-berkas.berkas-list.soap-farmasi.hasil-soap')
            </div>
        </div>
        <div class="section-footer">
            <table class="table_equal_column_half page-break-inside">
                <tr>
                    <td></td>
                    <td>Tgl. Cetak : {{date("d/m/y h:i:s")}}</td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td>
                        Penanggung Jawab
                    </td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td>
                        @if(!empty($dataSoap))
                        <div class="qrCode">
                            <?php
                                $id = (isset($PJSOAPFarmasi)) ? $PJSOAPFarmasi->nik : '';
                                $nama = (isset($PJSOAPFarmasi)) ? $PJSOAPFarmasi->nama : '';

                                $text = "Dikeluarkan di ".$settings->nama_instansi.", Kabupaten/Kota ".$settings->kabupaten."\nDitandatangani secara elektronik oleh ".$nama."\nID ".$id. "\n ";
                            ?>
                            @if(isset($PJSOAPFarmasi))
                            <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}" width="100"
                                height="100" />
                            @endif
                            
                            
                        </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{$nama}}
                    </td>
                </tr>
            </table>
            <form action="{{ url('/soap-farmasi-berkas/unduh_soap_farmasi') }}">
                @csrf
                <input type="text" name="no_rm" value="{{$no_rm}}" hidden>
                <input type="text" name="no_rawat" value="{{$no_rawat}}" hidden>
                <input type="text" name="fr" value="{{$fr}}" hidden>

                <div class="d-flex justify-content-end mt-1">
                    <button type="submit" class="btn btn-primary">Unduh</button>
                </div>
            </form>
        </div>



    </section>
    @section("additional-section")

    @show
    @section("additional-scripts")
    @show
</body>

</html>
