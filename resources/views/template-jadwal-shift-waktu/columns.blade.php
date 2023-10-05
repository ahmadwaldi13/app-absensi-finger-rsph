<style>
    .box_waktu{
        padding:10px;
    }
</style>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet" style="width:100%">
                    <thead>
                        <tr>
                            <th style='width:10%'>*</th>
                            <th>Uraian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $jml_periode=$item_template_shift->jml_periode;
                            $type_periode = (new \App\Models\RefTemplateJadwalShift())->list_type_periode_system($item_template_shift->type_periode);
                        
                            $tgl_start=new \DateTime($item_template_shift->tgl_mulai);
                            $tgl_start_tmp=new \DateTime($item_template_shift->tgl_mulai);

                            $rumus_tmp="+".$jml_periode." ".$type_periode;
                            $tgl_end = $tgl_start_tmp->modify($rumus_tmp);
                            
                            $tgl_start_text = $tgl_start->format('Y-m-d');
                            $tgl_end_text = $tgl_end->format('Y-m-d');

                            $looping_range_date = new DatePeriod($tgl_start, DateInterval::createFromDateString('1 day'), $tgl_end);

                            $data_shift[0][0]=[
                                'start'=>'08:00',
                                'end'=>'09:00',
                                'besok'=>0,
                                'nm_shift'=>'pagi',
                                'bgcolor'=>"#dc9090",
                            ];

                            $data_shift[0][1]=[
                                'start'=>'14:00',
                                'end'=>'16:00',
                                'besok'=>0,
                                'nm_shift'=>'siang',
                                'bgcolor'=>"#ede",
                            ];

                            $data_shift[0][2]=[
                                'start'=>'14:00',
                                'end'=>'16:00',
                                'besok'=>0,
                                'nm_shift'=>'siang',
                                'bgcolor'=>"#ede",
                            ];

                            $data_shift[1][0]=[
                                'start'=>'14:00',
                                'end'=>'16:00',
                                'besok'=>0,
                                'nm_shift'=>'siang',
                                'bgcolor'=>"#ede",
                            ];

                            $data_shift[1][2]=[
                                'start'=>'20:00',
                                'end'=>'09:00',
                                'besok'=>1,
                                'nm_shift'=>'malam',
                                'bgcolor'=>"#ccc",
                            ];

                            $data_shift[5][0]=[
                                'start'=>'20:00',
                                'end'=>'09:00',
                                'besok'=>1,
                                'nm_shift'=>'malam',
                                'bgcolor'=>"#ccc",
                            ];

                            $list_data_besok=[];
                        ?>
                        @foreach($looping_range_date as $key_date => $valeu_date)
                            <?php 
                                $single_date=$valeu_date->format('D');
                                $nm_hari=(new \App\Http\Traits\GlobalFunction)->hari($single_date);
                            ?>
                            <tr>
                                <td>
                                    <div>Hari Ke {{ ($key_date+1) }}</div>
                                    <hr style="margin:0px">
                                    <div>{{ $nm_hari }}</div>
                                </td>
                                <td>
                                    <?php 
                                        $list_shift=[];
                                        if(!empty($data_shift[$key_date])){
                                            foreach($data_shift[$key_date] as $key_list => $value){
                                                $value=(object)$value;
                                                $text="
                                                    <span class='box_waktu' style='background:".$value->bgcolor.";'>"
                                                        .$value->nm_shift." : ".$value->start.' s/d '.$value->end.
                                                    "</span>
                                                ";
                                                
                                                if(!empty($value->besok)){
                                                    $text="
                                                        <span class='box_waktu' style='background:".$value->bgcolor.";'>"
                                                            .$value->nm_shift." : ".$value->start.' s/d '.
                                                        "</span>
                                                    ";

                                                    $text_next="
                                                        <span class='box_waktu' style='background:".$value->bgcolor.";'>"
                                                            .$value->nm_shift." : ".' s/d '.$value->end.
                                                        "</span>
                                                    ";
                                                    $list_data_besok[$key_date+1][]=$text_next;
                                                }
                                                $list_shift[]=$text;
                                            }
                                        }
                                        if(!empty($list_shift)){
                                            $list_shift=implode(' ',$list_shift);
                                        }else{
                                            $list_shift='';
                                        }

                                        $list_shift_besok='';
                                        if(!empty($list_data_besok[$key_date])){
                                            $list_shift_besok=implode(' ',$list_data_besok[$key_date]);
                                        }
                                    ?>
                                    {!! $list_shift_besok !!}
                                    {!! $list_shift !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>