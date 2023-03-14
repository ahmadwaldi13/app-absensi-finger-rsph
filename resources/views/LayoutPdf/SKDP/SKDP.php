<?php

namespace Resources\views\LayoutPdf\SKDP;

use App\Classes\ModulPDF;
/**
 * 
 */
class SKDP extends ModulPDF{
    
    protected static function model_1($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->SetTopMargin($instance->pdf_config['margintop']);
        $instance->SetFontSize($instance->pdf_config['content_font_size']);
        $html = view('berkas-digital/klaim-berkas/berkas-list/skdp/pasien_data', ["skdp" => $data, "settings"=>$instance->rs_settings_data, "is_pdf" => 1])->render();
        $instance->writeHTML($html, true, false, true, false, '');

        $barcode_width = 100;
        $barcode_text = !empty($data->no_surat) ? $data->no_surat : "N/A";
        $instance->write1DBarcode( $barcode_text,  'C39',  $x = $instance->getPageWidth()-$barcode_width-$instance->pdf_config['marginx'],   $y = 25,   $w = $barcode_width,   $h = 8,   $xres = '',   $style = array(),   $align = '') ;
        
        // // qrcode
        $instance->UnbreakableCell(function() use($instance){
            $width = 35;
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx']-10;
            $tanggal = "Tgl Cetak : ".date("d/m/y h:i:s A");    
    
            $instance->MultiCell($width, $h=0, 'Mengetahui', $border=0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            $instance->Ln(13);
            $instance->SetFontSize(8);
            $instance->MultiCell(50, $h=0, $tanggal, $border=0, $align = 'L', $fill = 0, $ln = 0, $x=15, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            $instance->writeHTMLCell(  $w=$width,   $h=0,   $x=$x_right,   $y='',   $html ="<hr>",  $border=0,   $ln=1,   $fill = false,   $reseth = true,   $align = '',   $autopadding = false);
        });
        // endqrcode

    }
    
}