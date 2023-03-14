<?php

namespace App\Library\TCPDF\Templates;
namespace Resources\views\LayoutPdf\HasilRadiologi;

use App\Classes\ModulPDF;
/**
 * 
 */
class HasilRadiologi extends ModulPDF{
    
    protected static function model_1($instance, $data){
        $instance->AddPage($instance->pdf_config['layout_orientation'], $instance->pdf_config['paper_size']);
        $instance->KopSurat();

        $instance->Ln(7);
        // judul berkas
        $instance->SetSectionTitle("HASIL PEMERIKSAAN RADIOLOGI");
        // end judul berkas

        $instance->Ln(7);

        // content berkas
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $html = view('berkas-digital/klaim-berkas/berkas-list/pemeriksaan-radiologi/pasien_data', ['hasil_pemeriksaan_radiologi'=>$data ])->render();
            $instance->writeHTML($html, true, false, true, false, '');
            $hasil_pemeriksaan = !empty($data->hasil) ? $data->hasil : "";

            $instance->Write($h=10,"Hasil Pemeriksaan : ", $link = '', $fill = 0, $align = 'L', $ln = true);

            // $instance->setCellPadding(5);
            $instance->MultiCell($w=0, $h=0,$hasil_pemeriksaan , $border = 1, $align = 'L', $fill = 0, $ln = 1, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);
        //  end content berkas

        $instance->Ln(7);
        
        // qrcode
        $instance->UnbreakableCell(function() use($data, $instance){
            $width = 90;
            $instance->SetFontSize($instance->pdf_config['content_font_size']);
            $x_right = $instance->getPageWidth()-$width-$instance->pdf_config['marginx'];
            
            $tanggal = "Tgl Cetak : ".((!empty($data->tgl_periksa) && !empty($data->jam)) ? date('d F Y H:i:s', strtotime($data->tgl_periksa." ".$data->jam))  : "-");
            
            $text_qrcode_pasien_pl = "";
            $text_qrcode_pasien_pj = "";
            $nama_pl = "";
            $nama_pj = "";

            if(!empty($data->finger_pj) || !empty($data->kd_dokter)){
                $id_pj = (isset($data->finger_pj)) ? $data->finger_pj : $data->kd_dokter;
                $text_qrcode_pasien_pj = "Dikeluarkan di ".$instance->rs_settings_data->nama_instansi.", Kabupaten/Kota ".$instance->rs_settings_data->kabupaten."\nDitandatangani secara elektronik oleh ".(!empty($data->nm_dokter) ? $data->nm_dokter : "")."\nID ".$id_pj. "\n ". (!empty($data->tgl_periksa) ? $data->tgl_periksa : "");
                $nama_pj = !empty($data->nm_dokter) ? $data->nm_dokter : "-";
    
    
                $id_pl = (isset($data->finger_pl)) ? $data->finger_pl : $data->petugas_nip;
                $text_qrcode_pasien_pl = "Dikeluarkan di ".$instance->rs_settings_data->nama_instansi.", Kabupaten/Kota ".$instance->rs_settings_data->kabupaten."\nDitandatangani secara elektronik oleh ".(!empty($data->nama_petugas) ? $data->nama_petugas : "")."\nID ".$id_pl. "\n ". (!empty($data->tgl_periksa) ? $data->tgl_periksa : "");
                $nama_pl = !empty($data->nama_petugas) ? $data->nama_petugas : "-";
            }
    
            $instance->MultiCell($width, $h=0, $tanggal, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
    
            $instance->MultiCell($width, $h=0, 'Penanggung Jawab', $border = 0, $align = 'C', $fill = 0, $ln = 0, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            $instance->MultiCell($width, $h=0, 'Petugas Radiologi', $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
    
            if(!empty($data)){
                $instance->qrcode($text_qrcode_pasien_pj,'' , '', $width, $instance->pdf_config['qrcode_size']);
                $instance->qrcode($text_qrcode_pasien_pl,$x_right , '', $width, $instance->pdf_config['qrcode_size']);
                
                $instance->Ln($instance->pdf_config['qrcode_size']);
                $instance->MultiCell($width, $h=0, $nama_pj, $border = 0, $align = 'C', $fill = 0, $ln = 0, $x='', $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
                $instance->MultiCell($width, $h=0, $nama_pl, $border = 0, $align = 'C', $fill = 0, $ln = 1, $x=$x_right, $y='', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0);
            }
        });
        // endqrcode
    }
    
}