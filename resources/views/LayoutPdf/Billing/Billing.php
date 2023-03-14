<?php

namespace Resources\views\LayoutPdf\Billing;
use App\Classes\ModulPDF;
/**
 * 
 */
class Billing extends ModulPDF{
    
    protected static function model_1($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();
        $instance->Ln(7);

        // judul berkas
        $instance->SetSectionTitle("BILLING");
        // end judul berkas

        // content berkas
        $instance->SetFontSize(7);
        $html = view('berkas-digital/klaim-berkas/berkas-list/billing/table_data',['billing_data' =>$data])->render();
        $instance->writeHTML($html, true, false, true, false, '');
        // end content berkas

            // qrcode
        $instance->UnbreakableCell(function()use ($data, $instance){
            if($data->count() > 0){
                $matches = array();
                preg_match('/:(.*)\(/', $data[4]->nm_perawatan, $matches);
                $name = $matches[1]; 
            }
            $width = 65;
            $instance->SetFontSize(12);
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];

            $text_qrcode_pasien = "Nama Pasien: ".(!empty($name) ? $name : "");
            $instance->MultiCell($width, $h=0, 'Keluarga Pasien', $border = 0, $align = 'C', $fill = 0, $ln = 0, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
            $instance->MultiCell($width, $h=0, 'Kasir', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);

            $instance->qrcode($text_qrcode_pasien,'' , '', $width, $instance->pdf_config['qrcode_size']);
            $instance->qrcode("Kasir: KASIR ".$instance->rs_settings_data->nama_instansi,$x_right , '', $width, $instance->pdf_config['qrcode_size']);


        });
        // endqrcode
    }
    
}