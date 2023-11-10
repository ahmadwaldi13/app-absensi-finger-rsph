<?php 

    $header_tgl='';
    $header_hari='';
    foreach($list_tgl as $key_tgl => $item_tgl){
        $tgl_format_tmp = new \DateTime($item_tgl);
        $tgl_format=$tgl_format_tmp->format('d/m');
        $hari_format=$tgl_format_tmp->format('D');

        $hari_format_indo=(new \App\Http\Traits\GlobalFunction)->hari($hari_format);
        $data_tgl[$key_tgl]=$tgl_format;
        $data_hari_e[$key_tgl]=$hari_format;
        $data_hari_indo[$key_tgl]=(new \App\Http\Traits\GlobalFunction)->hari($hari_format,1);

        $nm_hari=!empty($data_hari_indo[$key_tgl]) ? $data_hari_indo[$key_tgl] : '';

        if(!empty($hari_kerja[$hari_format])){
            $jml_hari_kerja_bulan++;
        }else{
            $get_hari_minggu[$item_tgl]=1;
            $hari_minggu[(new \App\Http\Traits\GlobalFunction)->hari($hari_format)]=(new \App\Http\Traits\GlobalFunction)->hari($hari_format);
        }

        if(!empty($list_hari_libur[$item_tgl])){
            $jml_hari_libur++;
        }

        $header_tgl.='<th class="py-3" style="width: 1%">'.$tgl_format.'</th>';
        $header_hari.='<th class="py-3" style="width: 1%">'.$nm_hari.'</th>';
    }

    if(!empty($list_shift['item'])){
        $list_shift['item']=json_decode($list_shift['item'],true);
    }

    $template_list_shift=!empty($list_shift['item']) ? $list_shift['item'] : [];

?>
<style>
    .box_waktu{
        padding:10px;
    }
</style>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <input type="text" name='data_sent' value='{{ !empty($data_sent) ? $data_sent : '' }}'>
                <input type="text" name='params' value='{{ !empty($params_json) ? $params_json : '' }}'>

                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3">
                        <div class='bagan_form'>
                            <div class='input-month-year-bagan'>
                                <label for="filter_tahun_bulan" class="form-label">Tahun & Bulan</label>
                                <span class='icon-bagan-date'></span>
                                <input type="text" class="form-control input-month" id="filter_tahun_bulan" name='filter_tahun_bulan' placeholder="tahun & bulan" value="{{ !empty(Request::get('filter_tahun_bulan')) ? Request::get('filter_tahun_bulan') : date('Y-m') }}">
                            </div>
                            <div class="message"></div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-1">
                        <div class="d-grid grap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet" style="width:100%">
                    <thead>
                        <tr>
                            <th style='width:10%'>*</th>
                            <th>Uraian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_tgl))
                            @foreach($list_tgl as $key_date => $value_date)
                            <?php
                                $tgl= $key_date+1;
                                
                                $list_shift=[];
                                if( !empty($template_list_shift[$tgl])) {
                                    
                                    if( !empty( $template_list_shift[$tgl]['data_jadwal_waktu'])  ){
                                        $tmp=$template_list_shift[$tgl]['data_jadwal_waktu'];
                                        foreach( $tmp as $item ){
                                            $item=json_decode($item);
                                            $text="<span class='box_waktu' style='background:".$item->bg_color.";'>".$item->title."</span>";
                                            if($item->type_jadwal==2){
                                                $text="<span class='box_waktu' style='background:".$item->bg_color."; display:block; width:20%;'>".$item->title."</span>";
                                            }
                                            $list_shift[]=$text;
                                        }
                                    }
                                }
                                if($list_shift){
                                    $list_shift=implode('',$list_shift);
                                }else{
                                    $list_shift='';
                                }

                            ?>
                            <tr style='border-bottom:1px solid #ccc;'>
                                <td>
                                    <div>{{ $value_date }}</div>
                                </td>
                                <td>
                                    <div>{!! $list_shift !!}</div>
                                </td>
                            </tr>
                            @endforeach        
                        @endif                  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>