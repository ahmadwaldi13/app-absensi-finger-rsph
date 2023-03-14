<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Services\GlobalService;

class ModulPDF extends \TCPDF {
    public $pdf_config  = [
      'marginx'=> 10,
      'margintop'=> 2,
      'font_family' => 'helvetica',
      'paper_size'=> "A4",
      'layout_orientation'=> "P",
      'content_font_size'=>9,
      'qrcode_size'=>20,
      'kop_logo_size'=>23
    ];
    public $default_model = "1";
    public $default_pdf_config = [];
    public function __construct(array $pdf_config= []){
        parent::__construct();
        $this->rs_settings_data = (new GlobalService)->getSettingsKhanza();

        if(!empty($pdf_config)){
        foreach($pdf_config as $k=> $v){
            $this->pdf_config[$k] = $v;
        }
        }
        $this->default_pdf_config = $this->pdf_config;

        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        $this->SetMargins($this->pdf_config['marginx'], $this->pdf_config['margintop'], $this->pdf_config['marginx'], true);
        $this->SetFont($this->pdf_config['font_family'], '' );
    }
    function KopSurat(){
        $imgdata = base64_decode($this->rs_settings_data->logo);
        $this->Image('@'.$imgdata, 15, 4, $this->pdf_config['kop_logo_size'], $this->pdf_config['kop_logo_size']);

        $this->SetFont($this->pdf_config['font_family'], 'B' );
        $this->SetFontSize(18);
        $this->SetCellPadding(1);
        // nama instansi
        $this->Write($h=5,$this->rs_settings_data->nama_instansi, $link = '', $fill = 0, $align = 'C', $ln = true);

        $this->SetFont($this->pdf_config['font_family'], '' );
        $this->SetFontSize(10);
        $this->SetCellPadding(0.5);
        // alamat instansi
        $this->Write($h=5,$this->rs_settings_data->alamat_instansi." ".$this->rs_settings_data->kabupaten." ".$this->rs_settings_data->propinsi, $link = '', $fill = 0, $align = 'C', $ln = true);
        // kontank instansi
        $this->Write($h=5,$this->rs_settings_data->kontak, $link = '', $fill = 0, $align = 'C', $ln = true);
        // email instansi
        $this->Write($h=5,"E-mail : ".$this->rs_settings_data->email, $link = '', $fill = 0, $align = 'C', $ln = true);
        $this->Cell(0,0,"", array(
            'B' => array('width' => 0.2, 'color' => array(0,0,0), 'dash' => 0, 'cap' => 'square')
         ));
    }
    function UnbreakableCell($function){
        $this->startTransaction();
        $start_page = $this->getPage();

        $function();
        $end_page = $this->getPage();
        if  ($end_page != $start_page) {
            $this->rollbackTransaction(true); // don't forget the true
            $this->AddPage();
            $function();
        }else{
            $this->commitTransaction();
        }
    }
    function qrcode($str, $x='', $y='', $w, $h, $qrcode_style = []){
        // return QrCode::size(300)->generate($str)->toHtml();
        // write RAW 2D Barcode
        $default_style = array(
            'border' => 0,
            'vpadding' => 0,
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1, // height of a single module in points
            // 'position' => $position

        );
        $style= array_merge($default_style, $qrcode_style);
        $this->write2DBarcode($str, 'QRCODE,L', $x, $y, $w, $h,  $style, 'T');

    }
    function svgQrCode($str, $w= 30, $h = 30){
        $pdf = new \TCPDF2DBarcode($str, 'QRCODE');
        return $pdf->getBarcodeSVGcode($w,$h , 'black');
    }
    function SetSectionTitle(String $txt, $fontSize = 17, $border=0){
        $this->SetFontSize($fontSize);
        $this->SetCellPadding(1);
        $this->Cell($w=0, $h = 0, $txt, $border, $ln = 2, $align = 'C', $fill = 0);
    }
    public function writeHTMLCellCustom(array $params){
        $p =[
            !empty($params['width']) ? $params['width'] : 0,
            !empty($params['height']) ? $params['height'] : 0,
            !empty($params['pos_x']) ? $params['pos_x'] : '',
            !empty($params['pos_y']) ? $params['pos_y'] : '',
            !empty($params['html']) ? $params['html'] : '',
            !empty($params['border']) ? $params['border'] : 0,
            !empty($params['next_line']) ? $params['next_line'] : 0,
            !empty($params['fill_color']) ? $params['fill_color'] : false,
            !empty($params['reset_height']) ? $params['reset_height'] : true,
            !empty($params['align']) ? $params['align'] : '',
            !empty($params['autopadding']) ? $params['autopadding'] : true,
        ];
        $this->writeHTMLCell(...$p) ;
    }
    public function makePDF($data, $model =null){
        call_user_func_array(get_called_class()."::addPDF",[$this,$data, $model,[]] );
        return $this;
    }
    public static function addPDF($instance,$data,$model=null, $custom_config=null){
        if(is_array($custom_config) || is_object($custom_config)){
        foreach($custom_config as $k=> $v){
            $instance->pdf_config[$k] = $v;
        }
        }else {
            $instance->pdf_config = $instance->default_pdf_config;
            $instance->SetMargins($instance->pdf_config['marginx'], $instance->pdf_config['margintop'], $instance->pdf_config['marginx'], true);
            $instance->SetFont($instance->pdf_config['font_family'], '' );
        }
        $model_number = !empty($model) ? $model : $instance->default_model;
        if($model_number === "-") return;
        try {
            call_user_func_array(get_called_class()."::model_$model_number",[$instance, $data] );
        } catch (\Exception $e) {
            if(str_contains($e->getMessage(), 'call_user_func_array()')){
                $message =  "Model '$model' Tidak Tersedia, Tambah Model Baru di '". get_called_class()."' atau gunakan model yang sudah ada";
                print_r($message."<br>");
                die;
            }else{
                dd($e);
            }
        }
    }
    public function makePdfWithHTML($view_route){
       $html = view($view_route, [])->render();
        $this->writeHTMLCellCustom([
            "html" => $html
        ]);
    }
}