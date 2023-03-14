<?php

namespace Resources\views\LayoutPdf\HasilLaborPK;

use App\Classes\ModulPDF;
/**
 * 
 */
class HasilLaborPK extends ModulPDF{
    
    protected static function model_1($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();

        $instance->Ln(7);

        // judul berkas
        $instance->SetSectionTitle("HASIL PEMERIKSAAN LABOR");
        // end judul berkas

        $instance->Ln(7);
        // content berkas
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $html = view('berkas-digital/klaim-berkas/berkas-list/pemeriksaan-labor/model-9/pasien_data', ['hasil_pemeriksaan_lab_pk'=>$data, 'settings'=> $instance->rs_settings_data])->render();
            $instance->writeHTML($html, true, false, true, false, '');

            $instance->Ln(2);

            $html = view('berkas-digital/klaim-berkas/berkas-list/pemeriksaan-labor/model-9/hasil_pemeriksaan', ['hasil_pemeriksaan_lab_pk'=>$data])->render();
            $instance->writeHTML($html, true, false, true, false, '');

            $instance->UnbreakableCell(function() use($data, $instance){
                $instance->Cell(0,0,"Kesan      :".(!empty($data->kesan) ? $data->kesan : ""), array(
                    'B' => array('width' => 0.2, 'color' => array(0,0,0), 'dash' => 0, 'cap' => 'square')
                ), $ln=1);
                $instance->Cell(0,0,"Saran      : ".(!empty($data->saran) ? $data->saran : ""), array(
                    'B' => array('width' => 0.2, 'color' => array(0,0,0), 'dash' => 0, 'cap' => 'square')
                ), $ln=1);
            });

        //  end content berkas

        $instance->Ln(7);
        // qrcode
        $instance->UnbreakableCell(function() use($data, $instance){
            $width = 80;
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
            $text_qrcode_pasien_pl = "";
            $text_qrcode_pasien_pj = "";
            $nama_pl = "";
            $nama_pj = "";
            $tanggal = (!empty($instance->rs_settings_data->kabupaten) ? $instance->rs_settings_data->kabupaten : "-").", ".((!empty($data->tgl_periksa) && !empty($data->jam_periksa)) ? date('d F Y H:i:s', strtotime($data->tgl_periksa." ".$data->jam_periksa))  : "-");
            if((!empty($data->sidikjari_pl)) || !empty($data->nip)){
                $id_pl = (!empty($data->sidikjari_pl)) ? $data->sidikjari_pl : (!empty($data->nip) ? $data->nip : '');
                $text_qrcode_pasien_pl = "Dikeluarkan di ".$instance->rs_settings_data->nama_instansi.", Kabupaten/Kota ".$instance->rs_settings_data->kabupaten."\nDitandatangani secara elektronik oleh ".(!empty($data->nama_petugas) ? $data->nama_petugas : "")."\nID ".$id_pl. "\n ". (!empty($data->tgl_periksa) ? $data->tgl_periksa : "");
                $nama_pl = !empty($data->nama_petugas) ? $data->nama_petugas : "-";
    
                $id_pj = (isset($data->sidikjari_pl)) ? $data->sidikjari_pl : $data->nip;
                $text_qrcode_pasien_pj = "Dikeluarkan di ".$instance->rs_settings_data->nama_instansi.", Kabupaten/Kota ".$instance->rs_settings_data->kabupaten."\nDitandatangani secara elektronik oleh ".(!empty($data->dokter_pj) ? $data->dokter_pj : "")."\nID ".$id_pj. "\n ". (!empty($data->tgl_periksa) ? $data->tgl_periksa : "");
                $nama_pj = !empty($data->dokter_pj) ? $data->dokter_pj : "-";
            }

            $instance->MultiCell($width, $h=0, $tanggal, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);

            $instance->MultiCell($width, $h=0, 'Petugas Laboratorium', $border = 0, $align = 'C', $fill = 0, $ln = 0, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            $instance->MultiCell($width, $h=0, 'Penanggung Jawab', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);

            if(!empty($data)){
                $instance->qrcode($text_qrcode_pasien_pl,'' , '', $width, $instance->pdf_config['qrcode_size']);
                $instance->qrcode($text_qrcode_pasien_pj,$x_right , '', $width, $instance->pdf_config['qrcode_size']);
                
                $instance->Ln($instance->pdf_config['qrcode_size']);
                $instance->MultiCell($width, $h=0, $nama_pl, $border = 0, $align = 'C', $fill = 0, $ln = 0, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                $instance->MultiCell($width, $h=0, $nama_pj, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            }
        });
        // endqrcode
    }
    
}