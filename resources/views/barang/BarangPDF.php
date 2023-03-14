<?php

namespace Resources\views\BarangA;
// namespace App\Library\TCPDF\Templates;
use App\Classes\ModulPDF;
/**
 *
 */
class BarangPDF extends ModulPDF{

    protected static function model_1($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();
        $instance->Ln(7);

        // $qr_pemohon = $instance->svgQrCode($data->finger_pemohon);
        // $params = $instance->serializeTCPDFtagParameters(array('@' . $qr_pemohon, $x='', $y='', $w=17, $h=17, $link='', $align='', $palign='', $border=0, $fitonpage=false));
        $qrcode_size = 17;
        $qr_pemohon_params = $instance->serializeTCPDFtagParameters(array($data->finger_pemohon,   $type = 'QRCODE',   $x = '',   $y = '',   $w = $qrcode_size  ,   $h = $qrcode_size,   $style = array(),   $align = '',   $distort = false));
        $qr_kabid_params = $instance->serializeTCPDFtagParameters(array($data->finger_kabid,   $type = 'QRCODE',   $x = ($instance->getPageWidth()-$qrcode_size)/2,   $y = '',   $w = $qrcode_size ,    $h = $qrcode_size,   $style = array(),   $align = 'M',   $distort = false));
        $qr_penerima_params = $instance->serializeTCPDFtagParameters(array($data->finger_penerima,   $type = 'QRCODE',   $x = '',   $y = '',   $w = $qrcode_size ,   $h = $qrcode_size,   $style = array(),   $align = '',   $distort = false));
        $qrcodes = (object)[
            'pemohon' => $qr_pemohon_params,
            'kabid' => $qr_kabid_params,
            'penerima' => $qr_penerima_params
        ];
        $html = view('barang/barang', ['data' => $data, 'qrcodes' => $qrcodes])->render();
        $instance->writeHTMLCellCustom([
            "html" => $html
        ]);
    }
}