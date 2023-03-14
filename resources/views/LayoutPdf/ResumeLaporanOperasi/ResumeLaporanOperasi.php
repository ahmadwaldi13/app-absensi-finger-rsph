<?php

namespace Resources\views\LayoutPdf\ResumeLaporanOperasi;

use App\Classes\ModulPDF;
/**
 * 
 */
class ResumeLaporanOperasi extends ModulPDF{
    
    protected static function model_1($instance, $data ){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();

        $instance->Ln(7);
        // judul berkas
        $instance->SetFontSize(!empty($instance->pdf_config['content_font_size']) ? $instance->pdf_config['content_font_size'] : 12);
        $instance->setCellPaddings(  $left = 0,   $top = 0,   $right = 0,   $bottom = 3);
        $instance->Cell($w=0, $h = 0, $text = "LAPORAN OPERASI", $border = "B", $ln = 2, $align = 'L', $fill = 0);
        // end judul berkas

        // content berkas
            // pasien-data
                $instance->SetFontSize($instance->pdf_config['content_font_size']);
                $html = view('berkas-digital/klaim-berkas/berkas-list/resume-lapop/model-2/pasien_data', ["laporan_operasi"=>$data])->render();
                $instance->writeHTML($html, true, false, true, false, '');
            // end pasien data
            // pre surgical assesment
                // title
                    $instance->SetFillColor(200,200,200);
                    $instance->Cell(0,0,"PRE SURGICAL ASSESMENT", $border=1, $ln=1, $align = 'C',   $fill = true,   $link = '',   $stretch=0,   $ignore_min_height = false,   $calign = 'T',   $valign = 'M');
                // end title
                // data
                    $instance->SetFontSize($instance->pdf_config['content_font_size']);
                    $html = view('berkas-digital/klaim-berkas/berkas-list/resume-lapop/model-2/surgical_assesments', ["laporan_operasi"=>$data])->render();
                    $instance->writeHTMLCell( $w=0,   $h=0,   $x='',   $y='',   $html,  $border=0,   $ln=1,   $fill = false,   $reseth = true,   $align = '',   $autopadding = false);

                // end data

            // end POST SURGICAL REPORT

            // POST SURGICAL REPORT
                // title
                    $instance->SetFillColor(200,200,200);
                    $instance->Cell(0,0,"POST SURGICAL REPORT", $border=1, $ln=1, $align = 'C',   $fill = true,   $link = '',   $stretch=0,   $ignore_min_height = false,   $calign = 'T',   $valign = 'M');
                // end title
                // data
                    $instance->SetFontSize($instance->pdf_config['content_font_size']);
                    $html = view('berkas-digital/klaim-berkas/berkas-list/resume-lapop/model-2/surgical_report', ["laporan_operasi"=>$data])->render();
                    $instance->writeHTMLCell( $w=0,   $h=0,   $x='',   $y='',   $html,  $border=0,   $ln=1,   $fill = false,   $reseth = true,   $align = '',   $autopadding = false);
                // end data

            // end POST SURGICAL REPORT

            // psfc report
                // title
                    $instance->SetFillColor(200,200,200);
                    $instance->Cell(0,0,"REPORT ( PROCEDURES, SPECIFIC FINDINGS AND COMPLICATIONS )", $border=1, $ln=1, $align = 'C',   $fill = true,   $link = '',   $stretch=0,   $ignore_min_height = false,   $calign = 'T',   $valign = 'M');
                // end title

                // data
                    $instance->SetFontSize($instance->pdf_config['content_font_size']);
                    $html = view('berkas-digital/klaim-berkas/berkas-list/resume-lapop/model-2/psfc_report', array_merge(["laporan_operasi"=>$data], ["is_pdf" => 1]))->render();
                    $width = ($instance->getPageWidth()) - $instance->pdf_config['marginx']*2;
                    $instance->writeHTMLCell( $w=$width,   $h=0,   $x='',   $y='',   $html,  $border=0,   $ln=0,   $fill = false,   $reseth = true,   $align = '',   $autopadding = false);

                    // qrcode
                    $instance->UnbreakableCell(function() use ($data, $instance){
                        $width = 50;
                        $instance->SetFontSize($instance->pdf_config['content_font_size']);
                        $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
                        $y_right = 229;
                        $tanggal = (!empty($instance->rs_settings_data->kabupaten) ? $instance->rs_settings_data->kabupaten : "-")." ".(!empty($data->tgl_operasi) ? date('d/m/Y', strtotime(explode(" ", $data->tgl_operasi)[0])) : "-");


                        $id_operator = !empty($data->sidikjari) ? $data->sidikjari : (!empty($data->kode_operator) ? $data->kode_operator : '');
                    
                        $nama_pj = !empty($data->operator1) ? $data->operator1 : "";
                        $text_qrcode_pasien_pj = "Dikeluarkan di ".$instance->rs_settings_data->nama_instansi.", Kabupaten/Kota ".$instance->rs_settings_data->kabupaten."\nDitandatangani secara elektronik oleh ".$nama_pj."\nID ".$id_operator. "\n ". (!empty($instance->data['laporan_operasi']['tgl_operasi']) ? $instance->data['laporan_operasi']['tgl_operasi'] : "");
                        
                        // tanggal
                        $tgl_y_position = $y_right;
                        $instance->MultiCell($width, $h=0, (!empty($data->tgl_operasi) ? date('d/m/Y', strtotime(explode(" ", $data->tgl_operasi)[0])) : "-"), $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y=$tgl_y_position, $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                        
                        // jenis dokter
                        $dokter_y_position = $tgl_y_position + 4;
                        $instance->MultiCell($width, $h=0, 'Dokter Bedah', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y=$dokter_y_position , $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                        
                        // qrcode
                        $qrcode_y_position = $dokter_y_position + 4;
                        $instance->qrcode($text_qrcode_pasien_pj,$x_right , $qrcode_y_position, $width, $instance->pdf_config['qrcode_size']);
                        
                        // nama dokter
                        $nmdokter_y_position = $qrcode_y_position + $instance->pdf_config['qrcode_size'];
                        $instance->MultiCell($width, $h=0, $nama_pj, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y=$nmdokter_y_position, $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                        
                    });
                    // endqrcode
                // end data
            // end psfc report

        /* end content berkas */}
    protected static function model_2($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();

        $instance->Ln(7);

        // judul berkas
        $instance->SetSectionTitle("RESUME LAPORAN OPERASI");
        // end judul berkas

        $instance->Ln(7);

        // content berkas
        $instance->SetFontSize($instance->pdf_config['content_font_size']);
        $html = view('berkas-digital/klaim-berkas/berkas-list/resume-lapop/table_data', $data)->render();
        // $instance->writeHTML($html, true, false, true, false, '');
        $instance->writeHTMLCell(  $w=0,   $h=0,   $x='',   $y='',   $html,   $border=1,   $ln=1,   $fill = false,   $reseth = true,   $align = '',   $autopadding = false);
        // end content berkas
        
        $instance->Ln(7);

        // qrcode
        $instance->UnbreakableCell(function()use( $instance, $data){
            $width = 65;
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
            $text_qrcode = !empty($data->nm_dokter) ? $data->nm_dokter : "";

            $instance->MultiCell($width, $h=0, 'Dokter Penanggung Jawab', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
            
            $instance->qrcode("DPJP: ".$text_qrcode,$x_right , '', $width, $instance->pdf_config['qrcode_size']);
            $instance->Ln($instance->pdf_config['qrcode_size']);
            $instance->MultiCell($width, $h=0, $text_qrcode, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
        });
        // endqrcode

    }

}