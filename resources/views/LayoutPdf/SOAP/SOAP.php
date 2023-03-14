<?php

namespace Resources\views\LayoutPdf\SOAP;

use App\Classes\ModulPDF;
/**
 * 
 */
class SOAP extends ModulPDF{
    
   protected static function model_1($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();
        $instance->Ln(7);
        // judul berkas
        $instance->SetSectionTitle("SOAP DAN RIWAYAT PERAWATAN");


        // isi berkas
        $instance->SetFontSize($instance->pdf_config['content_font_size']);
        $instance->Ln(4);
        $html = view('berkas-digital/klaim-berkas/berkas-list/soap-cppt/table_data', $data)->render();
        $instance->writeHTML($html, true, false, true, false, '');

        // qrcode
        if($data["reg_periksa"]->status_lanjut == 'Ralan'){
            $instance->UnbreakableCell(function() use( $instance, $data){
                $width = 65;
                $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
                $text_qrcode = !empty($data["reg_periksa"]) ? $data["reg_periksa"]->nm_dokter : "";
                $instance->MultiCell($width, $h=0, 'Dokter Penanggung Jawab', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
                
                $instance->qrcode($text_qrcode,$x_right , '', $width, $instance->pdf_config['qrcode_size']);
                $instance->Ln($instance->pdf_config['qrcode_size']);
                $instance->MultiCell($width, $h=0, $text_qrcode, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
            });
        }else{
            foreach($data["dpjp_ranap"] as $value){
                $instance->UnbreakableCell(function() use($value, $instance){
                    $width = 65;
                    $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
                    $text_qrcode = !empty($value['nm_dokter']) ? $value['nm_dokter'] : "";
                    $instance->MultiCell($width, $h=0, 'Dokter Penanggung Jawab', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
                   
                    $instance->qrcode($text_qrcode,$x_right , '', $width, $instance->pdf_config['qrcode_size']);
                    $instance->Ln($instance->pdf_config['qrcode_size']);
                    $instance->MultiCell($width, $h=0, $text_qrcode, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
                });
            }
        }
    }
}