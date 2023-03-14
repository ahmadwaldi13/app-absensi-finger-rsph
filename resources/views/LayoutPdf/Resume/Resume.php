<?php

namespace Resources\views\LayoutPdf\Resume;

use App\Classes\ModulPDF;
/**
 *
 */
class Resume extends ModulPDF{


    protected static function model_1_ranap($instance, $data ){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();

        $instance->Ln(7);
        // // judul berkas
        $instance->SetFontSize(14);
        $instance->SetFont($instance->pdf_config['font_family'], 'B' );
        $instance->setCellPaddings(  $left = 0,   $top = 0,   $right = 0,   $bottom = 3);
        $instance->Cell($w=0, $h = 0, $text = "RESUME MEDIS PASIEN", $border = "B", $ln = 2, $align = 'C', $fill = 0);

        // dd($data);
        // content berkas
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $instance->SetFont($instance->pdf_config['font_family'], '' );

            $html = view('berkas-digital/klaim-berkas/berkas-list/resume/model-1/pasien_data_ranap', ["resume_pasien" => $data])->render();
            $instance->writeHTMLCell(  $w=0,   $h=0,   $x='',   $y='',   $html,   $border=0,   $ln=1,   $fill = false,   $reseth = true,   $align = '',   $autopadding = false);

        // end content berkas
        // dd($data);
        // qrcode
        $instance->UnbreakableCell(function()use($data,  $instance){
            $width = 65;
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $instance->SetFont($instance->pdf_config['font_family'], '' );
            $instance->setCellPadding(1);
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
            // dd($data);
            $text = "Dikeluarkan di ".(!empty($instance->rs_settings_data->nama_instansi) ? $instance->rs_settings_data->nama_instansi : '').", Kabupaten/Kota ".(!empty($instance->rs_settings_data->kabupaten) ? $instance->rs_settings_data->kabupaten : '')."\nDitandatangani secara elektronik oleh ".(!empty($data->nm_dokter) ? $data->nm_dokter : "")."\nID ".(!empty($data->sidikjari_dokter) ? $data->sidikjari_dokter : ''). "\n ". (!empty($data->tgl_keluar) ? $data->tgl_keluar : "");
            $instance->MultiCell($width, $h=0, 'Dokter Penanggung Jawab', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
            // if(count($data) > 0){
                $instance->qrcode($text ,$x_right , '', $width, $instance->pdf_config['qrcode_size']);
    
                $instance->Ln($instance->pdf_config['qrcode_size']);
                $instance->MultiCell($width, $h=0, !empty($data->nm_dokter) ?$data->nm_dokter : "", $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
            // }
        });

    }

    protected static function model_1($instance, $data ){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
   
        $instance->KopSurat();

        $instance->Ln(7);

        // judul berkas
        $instance->SetFontSize(14);
        $instance->SetFont($instance->pdf_config['font_family'], 'B' );
        $instance->setCellPaddings(  $left = 0,   $top = 0,   $right = 0,   $bottom = 3);
        $instance->Cell($w=0, $h = 0, $text = "RESUME MEDIS PASIEN", $border = "B", $ln = 2, $align = 'C', $fill = 0);

        // content berkas
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $instance->SetFont($instance->pdf_config['font_family'], '' );

            $html = view('berkas-digital/klaim-berkas/berkas-list/resume/model-1/pasien_data', ["resume_pasien" => $data])->render();
            $instance->writeHTMLCell(  $w=0,   $h=0,   $x='',   $y='',   $html,   $border=0,   $ln=1,   $fill = false,   $reseth = true,   $align = '',   $autopadding = false);

        // end content berkas

        // qrcode
        $instance->UnbreakableCell(function()use($data,  $instance){
            $width = 65;
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $instance->SetFont($instance->pdf_config['font_family'], '' );
            $instance->setCellPadding(1);
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
            $instance->MultiCell($width, $h=0, 'Dokter Penanggung Jawab', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);

            $instance->qrcode(!empty($data->nm_dokter) ?$data->nm_dokter : "" ,$x_right , '', $width, $instance->pdf_config['qrcode_size']);

            $instance->Ln($instance->pdf_config['qrcode_size']);
            $instance->MultiCell($width, $h=0, !empty($data->nm_dokter) ?$data->nm_dokter : "", $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
        });
        // endqrcode
    }
    protected static function model_3($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
  
        // judul berkas
        $instance->SetSectionTitle("RESUME");
        // end judul berkas


        $instance->Ln(7);

        // content berkas
        $instance->SetFontSize($instance->pdf_config['content_font_size']);
        $html = view('berkas-digital/klaim-berkas/berkas-list/resume/table_data', ["resume_pasien" => $data])->render();
        // $instance->writeHTML($html, true, false, true, false, '');
        $instance->writeHTMLCell(  $w=0,   $h=0,   $x='',   $y='',   $html,   $border=1,   $ln=1,   $fill = false,   $reseth = true,   $align = '',   $autopadding = false);
        // end content berkas



        // qrcode
        $instance->UnbreakableCell(function() use($data,  $instance){
            $width = 65;
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
            $text_qrcode = (!empty($data->nm_dokter) ? $data->nm_dokter : "");

            $instance->MultiCell($width, $h=0, 'Dokter Penanggung Jawab', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);

            $instance->qrcode("DPJP: ".$text_qrcode,$x_right , '', $width, $instance->pdf_config['qrcode_size']);
            $instance->Ln($instance->pdf_config['qrcode_size']);
            $instance->MultiCell($width, $h=0, $text_qrcode, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
        });
        // endqrcode
    }
}