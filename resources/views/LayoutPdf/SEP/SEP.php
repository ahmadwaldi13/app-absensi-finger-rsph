<?php

namespace Resources\views\LayoutPdf\SEP;

use App\Classes\ModulPDF;
/**
 *
 */
class SEP extends ModulPDF{

    protected static function model_1($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        // judul berkas

        // logo bpjs
        $image_width = 50;
        $logo_position =  ( $instance->getPageWidth() -$image_width) / 2;
        $instance->Image(public_path('icon/bpjslogo.png'), $x = '', $y = 6, $w = $image_width, $h = 9, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 1, $fitbox = false, $hidden = false, $fitonpage = false);
        // end logo bpjs

        // // judul berkas
        // $instance->SetSectionTitle("SURAT ELEGIBILITAS PESERTA");
        // $instance->SetSectionTitle($this->sep_data['settings']["nama_instansi, 14);
        $instance->SetFontSize(15);
        $instance->SetCellPadding(1);
        $instance->Write($h=5,"SURAT ELEGIBILITAS PESERTA", $link = '', $fill = 0, $align = 'C', $ln = true);
        $instance->SetFontSize(12);
        $instance->SetCellPadding(1);
        $instance->Write($h=5,$instance->rs_settings_data->nama_instansi, $link = '', $fill = 0, $align = 'C', $ln = true);
        // end judul berkas

        $instance->Ln(7);

        $html_width = ($instance->getPageWidth()-$instance->pdf_config['marginx']*2) * 60/100;
        $instance->SetFontSize($instance->pdf_config['content_font_size']);

        $html = view('berkas-digital/klaim-berkas/berkas-list/sep/model-3/data_pasien_1', ['sep_data' =>$data])->render();


        $instance->writeHTMLCell(  $w=$html_width,   $h=0,   $x='',   $y='',   $html,   $border=0,   $ln=0,   $fill = false,   $reseth = true,   $align = '',   $autopadding = true) ;


        $html_2_width = ($instance->getPageWidth()-$instance->pdf_config['marginx']*2) * 45/100;
        $style = array(
            'align' => 'C',
            'stretch' => true,
            'fitwidth' => false,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 8,
            'vpadding' => 0,
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
        );
        $text_barcode = !empty($data->no_sep) ? $data->no_sep : "N/A";
        $instance->write1DBarcode($text_barcode,  'C39',   $x = '',   $y = '',   $w = 0,   $h = 12,   $xres = '',   $style,   $align = 'N');


        $html_2 = view('berkas-digital/klaim-berkas/berkas-list/sep/model-3/data_pasien_2', ['sep_data'=>$data])->render();
        $instance->writeHTMLCell(  $w=$html_2_width,   $h=0,   $x=$html_width +$instance->pdf_config['marginx'],   $y='',   $html_2,   $border=0,   $ln=1,   $fill = false,   $reseth = true,   $align = '',   $autopadding = true) ;

        $instance->Ln(15);

        // peringatan
        $peringatan_date = (!empty($data->tgl_registrasi) ? $data->tgl_registrasi : "")." ".(!empty($data->jam_reg) ? $data->jam_reg : "");
        $date_now = date("d/m/Y H:i:s A");
        $masa_berlaku = (!empty($data->tglrujukan) ? $data->tglrujukan : "")." s/d ".(!empty($data->batas_rujukan) ? $data->batas_rujukan : "");
        $text = <<<EOD
        *Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan.
        **SEP bukan sebagai bukti penjaminan peserta
        Cetakan ke 1 $peringatan_date
        Masa berlaku $masa_berlaku
        EOD;

        $instance->setFontSize(7);
        $instance->SetFont($instance->pdf_config['font_family'], 'I' );
        $instance->setCellPadding(0);
        $instance->MultiCell($w, $h=45, $text, $border = 0, $align = 'L', $fill = 0, $ln = 0, $x = '', $y = '', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 45, $valign='M');
        // end peringatan



        // qrcode
        $instance->UnbreakableCell(function()use($instance){
            $width = 65;
            $instance->SetFontSize(12);
            $instance->SetFont($instance->pdf_config['font_family'], '' );
            $instance->setCellPadding(1);
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
            $name = !empty($data->nama_pasien) ? $data->nama_pasien : "";
            $text_qrcode = "No SEP: ".(!empty($data->no_sep) ? $data->no_sep : "");

            $instance->MultiCell($width, $h=0, 'Pasien / Keluarga Pasien', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);

            $instance->qrcode($text_qrcode,$x_right , '', $width, $instance->pdf_config['qrcode_size']);

            $instance->Ln($instance->pdf_config['qrcode_size']);
            $instance->MultiCell($width, $h=0, $name, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
        });
    }
    protected static function model_2($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        // judul berkas

        // logo bpjs
        $image_width = 100;
        $logo_position =( $instance->getPageWidth() -$image_width) / 2;
        $instance->Image(public_path('icon/bpjslogo.png'), $x = $logo_position, $y = '', $w = $image_width, $h = 15, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false);
        // end logo bpjs


        $instance->Ln(14);

        // judul berkas
        $instance->SetSectionTitle("SURAT ELEGIBILITAS PESERTA");
        $instance->SetSectionTitle($instance->rs_settings_data->nama_instansi, 14);
        // end judul berkas

        $instance->Ln(7);

        // content berkas
        $instance->SetFontSize(12);
        $html = view('berkas-digital/klaim-berkas/berkas-list/sep/table_data', $data)->render();
        $instance->writeHTML($html, true, false, true, false, '');

        // end content berkas

        $instance->Ln(10);

        // peringatan
        $date_now = date("d/m/Y H:i:s A");
        $masa_berlaku = (!empty($data->tglrujukan) ? $data->tglrujukan : "")." s/d ".(!empty($data->batas_rujukan) ? $data->batas_rujukan : "");
        $text = <<<EOD
        *Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan.
        **SEP bukan sebagai bukti penjaminan peserta
        Cetakan ke 1 $date_now
        Masa berlaku $masa_berlaku
        EOD;

        $instance->setFontSize(7);
        $instance->SetFont($instance->pdf_config['font_family'], 'I' );
        $instance->setCellPadding(0);
        $instance->MultiCell($w, $h=45, $text, $border = 0, $align = 'L', $fill = 0, $ln = 0, $x = '', $y = '', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 45, $valign='M');
        // end peringatan


        // qrcode
        $instance->UnbreakableCell(function()use($instance){
            $width = 65;
            $instance->SetFontSize(12);
            $instance->SetFont($instance->pdf_config['font_family'], '' );
            $instance->setCellPadding(1);
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
            $name = !empty($data->nama_pasien) ? $data->nama_pasien : "";
            $text_qrcode = "No SEP: ".(!empty($data->no_sep) ? $data->no_sep : "");

            $instance->MultiCell($width, $h=0, 'Pasien / Keluarga Pasien', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);

            $instance->qrcode($text_qrcode,$x_right , '', $width, $instance->pdf_config['qrcode_size']);

            $instance->Ln($instance->pdf_config['qrcode_size']);
            $instance->MultiCell($width, $h=0, $name, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
        });
    }
}