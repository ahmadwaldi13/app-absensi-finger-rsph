
<?php
function qrcode($str){
    return QrCode::size(300)->generate($str)->toHtml();
}
function source_static($url){
    global $source;
    if ($source == "public_path") return public_path($url);
    return asset($url);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Berkas Digital</title>
        @section("header")
        <?php $source = "public_path"?>
        @show
        <style>
            @font-face {
            font-family: 'open-sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{source_static('public/fonts/open-sans/OpenSans-Medium.ttf')}}") format('truetype');
        }
        </style>
        <link rel="stylesheet" href="{{source_static('css/berkas_digital/pdf.css')}}">

    </head>
    <body>
        <?php
            function exist($sec) {return $sec;}
            $section = array_filter([
                "1" => !empty($dataShown["1"]),
                "2" => !empty($dataShown["2"]),
                "3" => !empty($dataShown["3"]),
                "4" => !empty($dataShown["4"]),
                "5" => !empty($dataShown["5"]),
                "6" => !empty($dataShown["6"]),
                "7" => !empty($dataShown["7"]),
                "8" => !empty($dataShown["8"])
            ], "exist") ;
        ?>

        @isset($dataShown["1"])
            @include('berkas-digital.klaim-berkas.berkas-list.sep')
            @if(!(array_key_last($section) == '1'))
            <div class="page-break"></div>
            @endif
        @endisset

        @isset($dataShown["2"])
            @include('berkas-digital.klaim-berkas.berkas-list.soap-cppt')
            @if(!(array_key_last($section) == '2'))
            <div class="page-break"></div>
            @endif
        @endisset

        @isset($dataShown["3"])
            @include('berkas-digital.klaim-berkas.berkas-list.billing')
            @if(!(array_key_last($section) == '3'))
            <div class="page-break"></div>
            @endif
        @endisset

        @isset( $dataShown["4"])
            @include('berkas-digital.klaim-berkas.berkas-list.resume-perawatan')
            @if(!(array_key_last($section) == '4'))
            <div class="page-break"></div>
            @endif
        @endisset

        @isset($dataShown["5"])
            @include('berkas-digital.klaim-berkas.berkas-list.resume-laporan-operasi')
            @if(!(array_key_last($section) == '5'))
            <div class="page-break"></div>
            @endif
        @endisset

        @foreach($hasil_pemeriksaan_lab as $key => $v)
            @isset($dataShown["6"])
                @include('berkas-digital.klaim-berkas.berkas-list.pemeriksaan-labor-1')
                @if(!(array_key_last($section) == '6'))
                    <div class="page-break"></div>
                @endif
            @endisset
        @endforeach

        @foreach($hasil_pemeriksaan_lab as $key => $v)
            @isset($dataShown["7"])
                @include('berkas-digital.klaim-berkas.berkas-list.pemeriksaan-labor-9')
                @if((int)$key < count($hasil_pemeriksaan_lab)-1 || !(array_key_last($section) == '7'))
                    <div class="page-break"></div>
                @endif
            @endisset
        @endforeach



        @isset($dataShown["8"])
            @foreach($hasil_pasien_periksa_radiologi as $key => $v)
                @include('berkas-digital.klaim-berkas.berkas-list.pemeriksaan_radiologi' )
                @if((int)$key < count($hasil_pasien_periksa_radiologi)-1)
                    <div class="page-break"></div>
                @endif
            @endforeach
        @endisset

        @section("additional-section")

        @show

        @section("additional-scripts")
        @show

    </body>
</html>