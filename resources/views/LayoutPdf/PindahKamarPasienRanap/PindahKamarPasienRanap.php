<?php

namespace Resources\views\LayoutPdf\PindahKamarPasienRanap;
use App\Classes\ModulPDF;
/**
 * 
 */
class PindahKamarPasienRanap extends ModulPDF{
    
    protected static function model_1($instance, $data){
        $instance->AddPage("L", [210, 140]);
        $instance->setFontSize(9);
        $html = view('pindah-kamar-pasien-ranap/cetak_billing_pdf',['bill_tagihan_ranap' =>$data])->render();
        $instance->writeHTML($html, true, false, true, false, '');   
    }
}