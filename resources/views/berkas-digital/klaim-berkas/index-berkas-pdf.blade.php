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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berkas Digital</title>
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
        ], "exist");


    ?>

    @isset($dataShown["1"])
        @include('berkas-digital.klaim-berkas.berkas-list.sep.model-3.index',['sep_data'=>$sep_data])
        @if(!(array_key_last($section) == '1'))
        <br pagebreak="true"/>
        @endif
    @endisset

    @isset($dataShown["10"])
        @include('berkas-digital.klaim-berkas.berkas-list.spri.index', ['spri_data' => $spri_data])
    @endisset


    @isset($dataShown["2"])
        @include('berkas-digital.klaim-berkas.berkas-list.soap-cppt.index', $soap_data)
        @if(!(array_key_last($section) == '2'))
        <br pagebreak="true"/>
        @endif
    @endisset

    @isset($dataShown["3"])
        @include('berkas-digital.klaim-berkas.berkas-list.billing.index')
        @if(!(array_key_last($section) == '3'))
        <br pagebreak="true"/>
        @endif
    @endisset

    @isset($dataShown["4"])
        @foreach($resume_data as $key => $resume_pasien)
            @include('berkas-digital.klaim-berkas.berkas-list.resume.model-1.index')
            @if(!(array_key_last($section) == '4'))
            <br pagebreak="true"/>
            @endif
        @endforeach
    @endisset

    @isset($dataShown["5"])

        @include('berkas-digital.klaim-berkas.berkas-list.resume-lapop.model-2.index', ["laporan_operasi"=>$resume_laporan_operasi_data])
        @if(!(array_key_last($section) == '5'))
        <br pagebreak="true"/>
        @endif
    @endisset

    @isset($dataShown["6"])
        @foreach($hasil_pemeriksaan_lab_pk_data as $key => $hasil_pemeriksaan_lab_pk)
            @include('berkas-digital.klaim-berkas.berkas-list.pemeriksaan-labor.model-1.index')
            @if(!(array_key_last($section) == '6'))
                <br pagebreak="true"/>
            @endif
        @endforeach
    @endisset

    @isset($dataShown["7"])
        @foreach($hasil_pemeriksaan_lab_pk_data as $key => $hasil_pemeriksaan_lab_pk)
            @include('berkas-digital.klaim-berkas.berkas-list.pemeriksaan-labor.model-9.index')
            @if((int)$key < count($hasil_pemeriksaan_lab_pk_data)-1 || !(array_key_last($section) == '7'))
                <br pagebreak="true"/>
            @endif
        @endforeach
    @endisset

    @isset($dataShown["8"])
        @foreach($hasil_pemeriksaan_radiologi_data as $key => $hasil_pemeriksaan_radiologi)
            @include('berkas-digital.klaim-berkas.berkas-list.pemeriksaan-radiologi.index' )
            @if((int)$key < count($hasil_pemeriksaan_radiologi_data)-1)
                <br pagebreak="true"/>
            @endif
        @endforeach
    @endisset

    @isset($dataShown["9"])
        @foreach($skdp_data as $skdp)
            @include('berkas-digital.klaim-berkas.berkas-list.skdp.index' )
        @endforeach
    @endisset
    
    @section("additional-section")

    @show
    @section("additional-scripts")
    @show
</body>
</html>