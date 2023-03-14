<?php

namespace Resources\views\LayoutPdf\SOAPFarmasi;

use App\Classes\ModulPDF;
/**
 * 
 */
class SOAPFarmasi extends ModulPDF{
    
   protected static function model_1($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();
        $instance->Ln(7);
        // judul berkas
        $instance->SetSectionTitle("SOAP FARMASI");


        // isi berkas
        $instance->SetFontSize($instance->pdf_config['content_font_size']);
        $instance->Ln(4);
        $html = view('soap-farmasi-berkas/berkas-list/soap-farmasi/hasil-soap', $data)->render();
        
        $instance->writeHTML($html, true, false, true, false, '');

        // qrcode
        if($data["PJSOAPFarmasi"]){
            $instance->UnbreakableCell(function() use( $instance, $data){
                $width = 60;
                $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];

                
                $instance->MultiCell($width, $h=0, 'Penanggung Jawab', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
                
                $nama = !empty($data["PJSOAPFarmasi"]) ? $data["PJSOAPFarmasi"]->nama : "";
                $nik = !empty($data["PJSOAPFarmasi"]) ? $data["PJSOAPFarmasi"]-> nik : "";
                $text_qrcode = "Dikeluarkan di ".$data['settings']->nama_instansi.", Kabupaten/Kota ".$data['settings']->kabupaten."\nDitandatangani secara elektronik oleh ".$nama."\nID ".$nik. "\n ";

                $instance->qrcode($text_qrcode,$x_right , '', $width, $instance->pdf_config['qrcode_size']);
                $instance->Ln($instance->pdf_config['qrcode_size']);
                
                $instance->MultiCell($width, $h=0, $nama, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right+9, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
            });
        }
    }
}