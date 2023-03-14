<?php

namespace Resources\views\LayoutPdf\PermintaanBarangNonMedis;
// namespace App\Library\TCPDF\Templates;
use App\Classes\ModulPDF;
/**
 *
 */
class PermintaanBarangNonMedis extends ModulPDF{

    protected static function model_1($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();
        $instance->Ln(7);

        // $qr_pemohon = $instance->svgQrCode($data->finger_pemohon);
        // $params = $instance->serializeTCPDFtagParameters(array('@' . $qr_pemohon, $x='', $y='', $w=17, $h=17, $link='', $align='', $palign='', $border=0, $fitonpage=false));
        $qrcode_size = 17;
        $qr_pemohon_params = $instance->serializeTCPDFtagParameters(array((!empty($data->finger_pemohon) ? $data->finger_pemohon : ""),   $type = 'QRCODE',   $x = '',   $y = '',   $w = $qrcode_size  ,   $h = $qrcode_size,   $style = array(),   $align = '',   $distort = false));
        $qr_kabid_params = $instance->serializeTCPDFtagParameters(array((!empty($data->finger_kabid) ? $data->finger_kabid : ""),   $type = 'QRCODE',   $x = ($instance->getPageWidth()-$qrcode_size)/2,   $y = '',   $w = $qrcode_size ,    $h = $qrcode_size,   $style = array(),   $align = 'M',   $distort = false));
        $qr_penerima_params = $instance->serializeTCPDFtagParameters(array((!empty($data->finger_penerima) ? $data->finger_penerima : ""),   $type = 'QRCODE',   $x = '',   $y = '',   $w = $qrcode_size ,   $h = $qrcode_size,   $style = array(),   $align = '',   $distort = false));
        $qrcodes = (object)[
            'pemohon' => $qr_pemohon_params,
            'kabid' => $qr_kabid_params,
            'penerima' => $qr_penerima_params
        ];
        // dd($data);
        $html = view('LayoutPdf/PermintaanBarangNonMedis/template', ['data' => $data, 'qrcodes' => $qrcodes])->render();
        $instance->writeHTMLCellCustom([
            "html" => $html,
            'next_line' => 1

        ]);

        $instance->Ln(2);
        $width = 50;
        $instance->UnbreakableCell(function() use($data, $instance, $width){
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
            $x_middle = ($instance->getPageWidth()-$width-($instance->pdf_config['marginx'])/2)/2;
            // dd($x_right, $x_middle);

            if(!empty($data)){
                $text_qrcode_nama_pemohon =((!empty($data->finger_pemohon)) ? $data->finger_pemohon : "") ;
                $nama_pemohon = !empty($data->nama_pemohon) ? $data->nama_pemohon : "....................................................";
                $nip_pemohon = "NIP. ".(!empty($data->nip_pemohon) ? $data->nip_pemohon : "");

                $text_qrcode_nama_pgwai_inventori = ((!empty($data->finger_pgwai_inventori) && ($data->status_pgwai_inventori != "3")) ? $data->finger_pgwai_inventori : "");
                $nama_pgwai_inventori = (!empty($data->nama_pgwai_inventori) && ($data->status_pgwai_inventori != "3")) ? $data->nama_pgwai_inventori : "....................................................";
                $nip_pgwai_inventori = "NIP. ".((!empty($data->nip_pgwai_inventori) && ($data->status_pgwai_inventori != "3")) ? $data->nip_pgwai_inventori : "");

                $text_qrcode_nama_penerima = (!empty($data->finger_penerima) ? $data->finger_penerima : "");
                $nama_penerima = !empty($data->nama_penerima) ? $data->nama_penerima : "....................................................";
                $nip_penerima = "NIP. ".(!empty($data->nip_penerima) ? $data->nip_penerima : "");
            }

            $instance->MultiCell($width, $h=0, "Pemohon", $border=0, $align = 'L', $fill = 0, $ln = 1, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);

            $instance->MultiCell($width, $h=0, 'Ka. Ruang', $border=0, $align = 'L', $fill = 0, $ln = 0, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            $instance->MultiCell($width, $h=0, 'Inventori', $border=0, $align = 'C', $fill = 0, $ln = 0, $x=$x_middle, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            $instance->MultiCell($width, $h=0, 'Yang Menerima', $border=0, $align = 'L', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);

            if(!empty($data)){
                $instance->qrcode($text_qrcode_nama_pemohon,'' , '', 23, $instance->pdf_config['qrcode_size'], ['padding' => 0 ]);
                $instance->qrcode($text_qrcode_nama_pgwai_inventori,$x_middle , '', $width, $instance->pdf_config['qrcode_size']);
                $instance->qrcode($text_qrcode_nama_penerima,$x_right , '', 23, $instance->pdf_config['qrcode_size']);

                $instance->Ln($instance->pdf_config['qrcode_size']);
                $instance->MultiCell($width, $h=0, $nama_pemohon, $border=0, $align = '', $fill = 0, $ln = 0, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                $instance->MultiCell($width, $h=0, $nama_pgwai_inventori, $border=0, $align = 'C', $fill = 0, $ln = 0, $x=$x_middle, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                $instance->MultiCell($width, $h=0, $nama_penerima, $border=0, $align = 'L', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);


                $instance->MultiCell($width, $h=0, $nip_pemohon, $border=0, $align = 'L', $fill = 0, $ln = 0, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                $instance->MultiCell($width, $h=0, $nip_pgwai_inventori, $border=0, $align = 'C', $fill = 0, $ln = 0, $x=$x_middle, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                $instance->MultiCell($width, $h=0, $nip_penerima, $border=0, $align = 'L', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            }
        });
        $instance->Ln(7);
        $instance->UnbreakableCell(function() use($data, $instance, $width){
            $x_middle = ($instance->getPageWidth()-$width-($instance->pdf_config['marginx'])/2)/2;
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            if(!empty($data)){
                $text_qrcode_nama_kabid =((!empty($data->finger_kabid) && $data->status_kabid != "3") ? $data->finger_kabid : "") ;
                $nama_kabid = (!empty($data->nama_kabid) && $data->status_kabid != "3") ? $data->nama_kabid : "....................................................";
                $nip_kabid = "NIP. ".((!empty($data->nip_kabid) && $data->status_kabid != "3") ? $data->nip_kabid : "");
            }
            $instance->MultiCell($width, $h=0, "Mengetahui", $border=0, $align = 'C', $fill = 0, $ln = 1, $x=$x_middle, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            $instance->MultiCell($width, $h=0, 'Kabid Penunjang Medis', $border=0, $align = 'C', $fill = 0, $ln = 1, $x=$x_middle, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);

            if(!empty($data)){
                $instance->qrcode($text_qrcode_nama_kabid,$x_middle , '', $width, $instance->pdf_config['qrcode_size']);
                $instance->Ln($instance->pdf_config['qrcode_size']);
                $instance->MultiCell($width, $h=0, $nama_kabid, $border=0, $align = 'C', $fill = 0, $ln = 1, $x=$x_middle, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                $instance->MultiCell($width, $h=0, $nip_kabid, $border=0, $align = 'C', $fill = 0, $ln = 1, $x=$x_middle, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            }
        });
    }

}