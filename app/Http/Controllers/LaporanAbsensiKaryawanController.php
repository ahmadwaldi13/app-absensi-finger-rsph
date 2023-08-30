<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Services\GlobalService;
use App\Services\DataLaporanPresensiService;

class LaporanAbsensiKaryawanController extends \App\Http\Controllers\MyAuthController
{
    public $part_view, $url_index, $url_name, $title, $breadcrumbs, $globalService;
    public $dataLaporanPresensiService;

    public function __construct()
    {
        $router_name = (new \App\Http\Traits\GlobalFunction)->getRouterIndex();
        $this->part_view = $router_name->path_base;
        $this->url_index = $router_name->uri;
        $this->url_name = $router_name->router_name;

        $this->title = 'Report Absensi Jadwal Rutin';
        $this->breadcrumbs = [
            ['title' => 'Manajemen Absensi', 'url' => url('/') . "/sub-menu?type=5"],
            ['title' => $this->title, 'url' => url('/') . "/" . $this->url_index],
        ];

        $this->globalService = new GlobalService;
        $this->dataLaporanPresensiService = new DataLaporanPresensiService;
    }

    function actionIndex(Request $request){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        $form_filter_text=!empty($request->form_filter_text) ? $request->form_filter_text : '';
        $filter_tahun_bulan=!empty($request->filter_tahun_bulan) ? $request->filter_tahun_bulan : date('Y-m');

        $get_tgl_per_bulan=(new \App\Http\Traits\AbsensiFunction)->get_tgl_per_bulan($filter_tahun_bulan);
        $list_tgl=!empty($get_tgl_per_bulan->list_tgl) ? $get_tgl_per_bulan->list_tgl : [];

        $filter_tgl=!empty($get_tgl_per_bulan->tgl_start_end) ? $get_tgl_per_bulan->tgl_start_end : [];
        $filter_tgl[0]=!empty($filter_tgl[0]) ? $filter_tgl[0] : date('Y-m-d');
        $filter_tgl[1]=!empty($filter_tgl[1]) ? $filter_tgl[1] : date('Y-m-d');

        /*simpan data jika bulan dan tahun berbeda---------------------*/
        if(!empty($request->cari_data)){
            
            $paramter_search=[
                'filter_date_start'=>$filter_tgl[0],
                'filter_date_end'=>$filter_tgl[1]
            ];
            $get_data_query=(new \App\Services\DataPresensiRutinService)->getDataRumus3($paramter_search);
            $list_db=!empty($get_data_query->list_db) ? $get_data_query->list_db : [];
            $save_update=(new \App\Services\DataPresensiService)->save_update_rekap($list_db);
        }
        
        /*------------------------------------------*/
        
        $list_data=$collection = collect([]);
        if(!empty($request->cari_data)){
            $parameter_where=[
                'search'=>$form_filter_text,
                'tanggal'=>[$filter_tgl[0],$filter_tgl[1]],
                'id_jenis_jadwal'=>1,
            ];

            $filter_id_departemen=!empty($request->filter_id_departemen) ? $request->filter_id_departemen : '';
            if(!empty($filter_id_departemen)){
                $parameter_where['id_departemen']=$filter_id_departemen;
            }

            $list_data=$this->dataLaporanPresensiService->getRekapPresensi($parameter_where,1)
            ->orderBy('id_departemen','ASC')
            ->orderBy('id_ruangan','ASC')
            ->get();
        }

        $page = isset($request->page) ? $request->page : 1;
        $option=['path' => $request->url(), 'query' => $request->query()];
        $max_page=!empty($list_data->count()) ? $list_data->count() : 2;
        $list_data = (new \App\Http\Traits\GlobalFunction)->paginate($list_data,$max_page,$page,$option);

        $get_presensi_masuk=(new \App\Http\Traits\AbsensiFunction)->get_list_data_presensi(1);
        $get_presensi_istirahat=(new \App\Http\Traits\AbsensiFunction)->get_list_data_presensi(2);
        $get_presensi_pulang=(new \App\Http\Traits\AbsensiFunction)->get_list_data_presensi(4);

        $paramater_where=[
            'tanggal'=>[$filter_tgl[0],$filter_tgl[1]],
        ];

        $list_hari_libur=(new \App\Services\DataPresensiService)->get_data_hari_libur($paramater_where);

        $data_jadwal_rutin=(new \App\Http\Traits\PresensiHitungRutinFunction)->get_jadwal_rutin();

        $parameter_view = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'get_presensi_masuk'=>$get_presensi_masuk,
            'get_presensi_istirahat'=>$get_presensi_istirahat,
            'get_presensi_pulang'=>$get_presensi_pulang,
            'list_tgl'=>$list_tgl,
            'list_data'=>$list_data,
            'list_hari_libur'=>$list_hari_libur,
            'data_jadwal_rutin'=>$data_jadwal_rutin,

        ];

        return view($this->part_view . '.index', $parameter_view);
    }

    public function actionCetak(Request $request){
        ini_set("memory_limit","500M");

        $data_sent = !empty($request->data_sent) ? $request->data_sent : '';
        $data_sent = !empty($data_sent) ? json_decode($data_sent) : '';

        $form_filter_text=!empty($data_sent->form_filter_text) ? $data_sent->form_filter_text : '';
        $filter_tahun_bulan=!empty($data_sent->filter_tahun_bulan) ? $data_sent->filter_tahun_bulan : date('Y-m');

        $get_tgl_per_bulan=(new \App\Http\Traits\AbsensiFunction)->get_tgl_per_bulan($filter_tahun_bulan);
        $list_tgl=!empty($get_tgl_per_bulan->list_tgl) ? $get_tgl_per_bulan->list_tgl : [];

        $filter_tgl=!empty($get_tgl_per_bulan->tgl_start_end) ? $get_tgl_per_bulan->tgl_start_end : [];
        $filter_tgl[0]=!empty($filter_tgl[0]) ? $filter_tgl[0] : date('Y-m-d');
        $filter_tgl[1]=!empty($filter_tgl[1]) ? $filter_tgl[1] : date('Y-m-d');


        $parameter_where=[
            'search'=>$form_filter_text,
            'tanggal'=>[$filter_tgl[0],$filter_tgl[1]],
            'id_jenis_jadwal'=>1,
        ];

        $get_nm_departemen='';
        $filter_id_departemen=!empty($data_sent->filter_id_departemen) ? $data_sent->filter_id_departemen : '';
        if(!empty($filter_id_departemen)){
            $parameter_where['id_departemen']=$filter_id_departemen;
            $get_nm_departemen=(new \App\Models\RefDepartemen())->where('id_departemen',$filter_id_departemen)->first();
            $get_nm_departemen=!empty($get_nm_departemen->nm_departemen) ? $get_nm_departemen->nm_departemen : '';
        }

        $list_data=$this->dataLaporanPresensiService->getRekapPresensi($parameter_where,1)
        ->orderBy('id_departemen','ASC')
        ->orderBy('id_ruangan','ASC')
        ->get();

        $paramater_where=[
            'tanggal'=>[$filter_tgl[0],$filter_tgl[1]],
        ];

        $list_hari_libur=(new \App\Services\DataPresensiService)->get_data_hari_libur($paramater_where);

        $data_jadwal_rutin=(new \App\Http\Traits\PresensiHitungRutinFunction)->get_jadwal_rutin();

        if($list_data){

            $hari_kerja_tmp=!empty($data_jadwal_rutin->hari_kerja) ? $data_jadwal_rutin->hari_kerja : '';
            $hari_kerja=[];
        
            if(!empty($hari_kerja_tmp)){
                $hari_kerja_t=explode(',',$hari_kerja_tmp);
                if($hari_kerja_t){
                    foreach($hari_kerja_t as $hk){
                        $hari_kerja[$hk]=$hk;
                    }
                }
            }

            $jml_hari_kerja=0;
            $jml_hari_kerja=count($hari_kerja);
            $total_kerja_sec_sistem_sec=!empty($data_jadwal_rutin->total_kerja_sec) ? $data_jadwal_rutin->total_kerja_sec : 0;
            $total_kerja_sec_sistem=!empty($data_jadwal_rutin->total_kerja) ? $data_jadwal_rutin->total_kerja : '00::00:00';

            $data_libur_format=[];
            if(!empty($list_hari_libur)){
                foreach($list_hari_libur as $key_l => $val_l){
                    if(empty($data_libur_format[$val_l->asal_tanggal])){
                        $data_libur_format[$val_l->asal_tanggal]=[
                            'uraian'=>$val_l->uraian,
                            'tgl_mulai'=>$val_l->asal_tanggal,
                            'tgl_akhir'=>$val_l->asal_tanggal,
                        ];
                    }else{
                        $data_libur_format[$val_l->asal_tanggal]['tgl_akhir']=$key_l;
                    }
                }
            }

            $borders = [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ];

            $fill_solid=\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID;

            $get_tb=new \DateTime($filter_tahun_bulan.'-01');
            $tahun=$get_tb->format('Y');
            $bulan=(int)$get_tb->format('m');
            $bulan_text=(new \App\Http\Traits\GlobalFunction)->get_bulan($bulan);
            
            $file_='format_laporan_rekap_absensi_karyawan.xlsx';
            
            $nama_excel="rekap_absensi_jadwal_rutin";
            $nama_excel.="_".$tahun."_".$bulan;
            $nama_excel.=!empty($get_nm_departemen) ? "_".strtolower( str_replace(" ","_",$get_nm_departemen) ) : '';
            $nama_excel.=".xlsx";

            $objPHPExcel = IOFactory::load(resource_path('views/'.$this->part_view . '/'.$file_));

            $data_tgl=[];
            $data_hari_e=[];
            $data_hari_indo=[];
            $jml_hari_kerja_bulan=0;
            $get_hari_minggu=[];
            $hari_minggu=[];
            $jml_hari_libur=0;
            
            $column_awal_tgl='E';
            $position_awal_tgl=7;

            $column_index_tgl=[];
            $column_index_hari_libur_kerja=[];
            $column_index_hari_libur_nasional=[];
            foreach($list_tgl as $key_tgl => $item_tgl){
                $column_index_tgl[$item_tgl]=$column_awal_tgl;

                $tgl_format_tmp = new \DateTime($item_tgl);
                $tgl_format=$tgl_format_tmp->format('d/m');
                $hari_format=$tgl_format_tmp->format('D');

                $data_tgl[$key_tgl]=$tgl_format;
                $data_hari_e[$key_tgl]=$hari_format;
                $data_hari_indo[$key_tgl]=(new \App\Http\Traits\GlobalFunction)->hari($hari_format,1);

                $nm_hari=!empty($data_hari_indo[$key_tgl]) ? $data_hari_indo[$key_tgl] : '';

                if(!empty($hari_kerja[$hari_format])){
                    $jml_hari_kerja_bulan++;
                }else{
                    $get_hari_minggu[$item_tgl]=1;
                    $hari_minggu[(new \App\Http\Traits\GlobalFunction)->hari($hari_format)]=(new \App\Http\Traits\GlobalFunction)->hari($hari_format);
                    $column_index_hari_libur_kerja[$column_awal_tgl]=$column_awal_tgl;
                }

                if(!empty($list_hari_libur[$item_tgl])){
                    $jml_hari_libur++;
                    $column_index_hari_libur_nasional[$column_awal_tgl]=$column_awal_tgl;
                }
                
                if($key_tgl>=28){
                    $objPHPExcel->setActiveSheetIndex(0)->insertNewColumnBefore($column_awal_tgl);
                    $objPHPExcel->getActiveSheet()->getColumnDimension($column_awal_tgl)->setWidth(9);
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($column_awal_tgl.$position_awal_tgl, $tgl_format);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($column_awal_tgl.($position_awal_tgl+1), $nm_hari);
                $column_awal_tgl++;
            }

            $hari_libur_text=[];
            if($data_libur_format){
                foreach($data_libur_format as $val_dlf){
                    $text_hasil='';
                    $val_dlf=(object)$val_dlf;
                    $text_hasil.=$val_dlf->uraian.' : ';
                    if($val_dlf->tgl_mulai!=$val_dlf->tgl_akhir){
                        $text_hasil.=$val_dlf->tgl_mulai.' s/d '.$val_dlf->tgl_akhir;
                    }else{
                        $text_hasil.=$val_dlf->tgl_mulai;
                    }
                    $hari_libur_text[]=$text_hasil;
                }
            }
            $hari_libur_text=!empty($hari_libur_text) ? implode(', ',$hari_libur_text) : '';

            $set_end_column_index=end($column_index_tgl);
            for ($i=0; $i < 2; $i++) { 
                $set_end_column_index++;
            }

            $header_text="Rekap Absensi Karyawan Tahun ".$tahun." Bulan ".$bulan_text;
            $header_text.=" ".$get_nm_departemen;
            $header_1=strtoupper($header_text);
            $header_1_index='A';
            $header_1_posi=2;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($header_1_index.$header_1_posi,$header_1 );
            $objPHPExcel->getActiveSheet()->mergeCells($header_1_index.$header_1_posi.':'.$set_end_column_index.$header_1_posi );
            
            $total_jml_hari_kerja_bulan=$jml_hari_kerja_bulan-$jml_hari_libur;

            $total_kerja_bulan_sec=$total_kerja_sec_sistem_sec * $total_jml_hari_kerja_bulan;

            $hari_minggu=!empty($hari_minggu) ? implode(',',$hari_minggu) : '';

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D4",$total_jml_hari_kerja_bulan.' Hari' );
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D5",(new \App\Http\Traits\AbsensiFunction)->change_format_waktu_indo($total_kerja_bulan_sec) );
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J4",$hari_minggu );
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J5",$hari_libur_text );

            $position_=9;
            $position_awal_=$position_;

            $list_departemen=[];
            $list_departemen_first=[];
            $list_ruangan=[];
            $list_ruangan_first=[];

            $jml_item=0;

            $style_column_nama=[];
            foreach($list_data as $key => $item){
                $jml_item=$key+1;
                
                if(empty($list_departemen[$item->id_departemen])){
                    $list_departemen[$item->id_departemen]=1;
                    $cell_me='A';
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell_me.$position_, !empty($item->nm_departemen) ? $item->nm_departemen : '' );
                    $merge_me=$cell_me.$position_.':'.$set_end_column_index.$position_;
                    $objPHPExcel->getActiveSheet()->mergeCells($merge_me);

                    if(empty($list_departemen_first)){
                        $list_departemen_first[]=$cell_me.$position_;
                    }else{
                        $this_style=$objPHPExcel->getActiveSheet()->getStyle($list_departemen_first[0]);
                        $objPHPExcel->getActiveSheet()->duplicateStyle($this_style,$cell_me.$position_);
                    }
                    
                    $position_++;
                }

                if(empty($list_ruangan[$item->id_ruangan])){
                    $list_ruangan[$item->id_ruangan]=1;
                    $cell_me='B';
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell_me.$position_, !empty($item->nm_ruangan) ? $item->nm_ruangan : '' );
                    $merge_me=$cell_me.$position_.':'.$set_end_column_index.$position_;
                    $objPHPExcel->getActiveSheet()->mergeCells($merge_me);

                    if(empty($list_ruangan_first)){
                        $list_ruangan_first[]=$cell_me.$position_;
                    }else{
                        $this_style=$objPHPExcel->getActiveSheet()->getStyle($list_ruangan_first[0]);
                        $objPHPExcel->getActiveSheet()->duplicateStyle($this_style,$cell_me.$position_);
                    }

                    $position_++;
                }
                
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$position_,$jml_item );
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$position_, !empty($item->nm_karyawan) ? $item->nm_karyawan : '' );
                if(empty($style_column_nama)){
                    $style_column_nama[]=['B',$position_];
                }else{
                    $set_merge_='B'.$position_.':'.'D'.$position_;
                    $objPHPExcel->getActiveSheet()->mergeCells($set_merge_);
                }

                $data_presensi=!empty($item->presensi_jadwal) ? (array)json_decode($item->presensi_jadwal) : [];

                $total_waktu_kerja_user_sec=!empty($item->sum_waktu_kerja_user_sec) ? $item->sum_waktu_kerja_user_sec : 0;
                $total_waktu_kerja_user_text=(new \App\Http\Traits\AbsensiFunction)->change_format_waktu_indo($total_waktu_kerja_user_sec,':');

                $total_waktu_kerja_selisih_sec=$total_kerja_bulan_sec-$total_waktu_kerja_user_sec;
                $tanda=($total_waktu_kerja_selisih_sec<0) ? '+' : '-';
                $total_waktu_kerja_selisih_text=$tanda.' '.(new \App\Http\Traits\AbsensiFunction)->change_format_waktu_indo(abs($total_waktu_kerja_selisih_sec),':');
                
                foreach($list_tgl as $key_tgl => $item_tgl){
                    if(!empty($column_index_tgl[$item_tgl])){
                        $column_me=$column_index_tgl[$item_tgl];
                        
                        $presensi_user=!empty($data_presensi[$item_tgl]) ? $data_presensi[$item_tgl] : '';
                        $presensi_user_text=str_replace(',',','.PHP_EOL,$presensi_user);
                        
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($column_me.$position_,$presensi_user_text );
                    }
                }
                $end_index_tgl=end($column_index_tgl);
                $end_index_tgl++;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($end_index_tgl.$position_, $total_waktu_kerja_user_text );
                $end_index_tgl++;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($end_index_tgl.$position_, $total_waktu_kerja_selisih_text );
                
                $position_++;
            }

            $position_--;

            $end_position=$position_;
            $cell_t=4;

            $check_array_first=[];
            foreach($column_index_hari_libur_kerja as $item){
                if(empty($check_array_first)){
                    $check_array_first[]=[$item,$position_awal_tgl,$end_position];
                    $objPHPExcel->getActiveSheet()->getStyle($item.$position_awal_tgl.':'.$item.$end_position)
                    ->getFill()
                    ->setFillType($fill_solid)
                    ->getStartColor()
                    ->setARGB('F39791');
                }else{
                    $plus_=1;
                    $header_=$check_array_first[0][0].$check_array_first[0][1].":".$check_array_first[0][0].($check_array_first[0][1]+$plus_);
                    $data_=$check_array_first[0][0].($check_array_first[0][1]+$cell_t).":".$check_array_first[0][0].$check_array_first[0][2];
                    
                    $header_item_=$item.$check_array_first[0][1].':'.$item.($check_array_first[0][1]+$plus_);
                    $data_item_=$item.$position_awal_tgl.':'.$item.$end_position;
                    $data_item_=$item.($check_array_first[0][1]+$cell_t).":".$item.$check_array_first[0][2];

                    $this_style=$objPHPExcel->getActiveSheet()->getStyle($header_);
                    $objPHPExcel->getActiveSheet()->duplicateStyle($this_style,$header_item_);

                    $this_style=$objPHPExcel->getActiveSheet()->getStyle($data_);
                    $objPHPExcel->getActiveSheet()->duplicateStyle($this_style,$data_item_);
                }
            }

            $check_array_first=[];
            
            foreach($column_index_hari_libur_nasional as $item){
                if(empty($check_array_first)){
                    $check_array_first[]=[$item,$position_awal_tgl,$end_position];
                    $objPHPExcel->getActiveSheet()->getStyle($item.$position_awal_tgl.':'.$item.$end_position)
                    ->getFill()
                    ->setFillType($fill_solid)
                    ->getStartColor()
                    ->setARGB('F7D44D');
                }else{
                    $plus_=1;
                    $header_=$check_array_first[0][0].$check_array_first[0][1].":".$check_array_first[0][0].($check_array_first[0][1]+$plus_);
                    $data_=$check_array_first[0][0].($check_array_first[0][1]+$cell_t).":".$check_array_first[0][0].$check_array_first[0][2];
                    
                    $header_item_=$item.$check_array_first[0][1].':'.$item.($check_array_first[0][1]+$plus_);
                    $data_item_=$item.$position_awal_tgl.':'.$item.$end_position;
                    $data_item_=$item.($check_array_first[0][1]+$cell_t).":".$item.$check_array_first[0][2];

                    $this_style=$objPHPExcel->getActiveSheet()->getStyle($header_);
                    $objPHPExcel->getActiveSheet()->duplicateStyle($this_style,$header_item_);

                    $this_style=$objPHPExcel->getActiveSheet()->getStyle($data_);
                    $objPHPExcel->getActiveSheet()->duplicateStyle($this_style,$data_item_);
                }
            }

            $objWriter  = IOFactory::createWriter($objPHPExcel, "Xlsx");

            if (ob_get_contents()) ob_end_clean();
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="'.$nama_excel.'"');
            header('Cache-Control: max-age=0');
            $writer = IOFactory::createWriter($objPHPExcel, 'Xlsx');
            $writer->save('php://output');
        }else{
            die;
        }
    }
}