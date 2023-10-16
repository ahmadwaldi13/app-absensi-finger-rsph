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
    $data_tanggal=[];
    foreach($looping_range_date as $key_date => $valeu_date){
        $tgl_date=(int)$valeu_date->format('d');
        $single_date=$valeu_date->format('D');
        $month_date=(int)$valeu_date->format('m');
        $nm_hari=(new \App\Http\Traits\GlobalFunction)->hari($single_date);
        $nm_bulan=(new \App\Http\Traits\GlobalFunction)->get_bulan($month_date);

        $data_tanggal[$month_date][]=[
            'tgl'=>$tgl_date,
            'nm_hari'=>$nm_hari,
            'month_date'=>$month_date,
            'nm_bulan'=>$nm_bulan
        ];
    }
?>

<hr>
<style>
    .list_jadwal_style{
        display: table-cell;
    }
</style>
<form action="{{ url($action_form) }}" method="{{ !empty($method_form) ? $method_form : 'POST' }}">
    @csrf
    <input type="hidden" name="key_old" value="{{ !empty($item_template_shift->id_template_jadwal_shift) ? $item_template_shift->id_template_jadwal_shift : 0 }}">
    <input type="hidden" id='id_jenis_jadwal'>
    <textarea style="display:none" id="list_tgl_terpilih" name=list_tgl_terpilih>{{ !empty($list_data_json) ? $list_data_json : '{}' }}</textarea>
    
    <div class="row d-flex justify-content-between">
        <div class="col-lg-4 p-0">
            <div class="card">
                <div class="card-body" style="padding:7px;">
                    <h5>Daftar List Jadwal Shift</h5>
                    <hr style="margin:3px 0px;">
                    <div style="overflow-x: auto; max-width: auto;">
                        <table class="table border table-responsive-tablet">
                            <tbody>
                                @foreach($data_jadwal as $key_jadwal => $item_jadwal)
                                    <?php 
                                        $kode_uniq=$item_jadwal->id_jenis_jadwal;
                                        $nm_kode_uniq='pil_'.$kode_uniq;
                                        $bgcolor=!empty($item_jadwal->bg_color) ? $item_jadwal->bg_color : "#fff";
                                    ?>
                                    <tr style="border-bottom:1px solid; background:{{ $bgcolor }}">
                                        <td>      
                                            <div class="custom-control custom-radio" style="display:table;">
                                                <input type="radio" id="{{ $nm_kode_uniq }}" name='pil_jadwal' class="custom-control-input list_jadwal_style radio_pil" value='{{ $item_jadwal->id_jenis_jadwal }}'>
                                                <input type="hidden" class="radio_pil_nama" value='{{ !empty($item_jadwal->nm_jenis_jadwal) ? $item_jadwal->nm_jenis_jadwal : '' }}'>
                                                
                                                <label class="custom-control-label list_jadwal_style" for="{{ $nm_kode_uniq }}" style="width:100%">
                                                    <div class="list_jadwal_style" style="width:43%;">{{ !empty($item_jadwal->nm_jenis_jadwal) ? $item_jadwal->nm_jenis_jadwal : '' }}</div>
                                                    <div class="list_jadwal_style" style="width:70%;">
                                                        {{ !empty($item_jadwal->masuk_kerja) ? $item_jadwal->masuk_kerja : '' }}
                                                        S/D
                                                        {{ !empty($item_jadwal->pulang_kerja) ? $item_jadwal->pulang_kerja : '' }}
                                                    </div>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
        
        <div class="col-lg-8 p-0">
            <div class="card">
                <div class="card-body" style="padding:7px;">
                    <label id='title_jadwal'></label>
                    <h5 style="border-top:1px solid;">Daftar hari</h5>
                    <hr style="margin:3px 0px;">
                    <div id='list_hari' style='display:none'>
                        <div style="overflow:auto; max-height: 1900px; padding:5px;">
                            <?php 
                                $urutan_bulan=0;
                            ?>
                            @foreach($data_tanggal as $key_bulan => $value_bulan)
                                <?php 
                                    $is_bulan=($type_periode=='month') ? 1 : 0;
                                    $jml_hari=count($value_bulan);
                                    $urutan_bulan++;
                                ?>
                                @if($urutan_bulan>1)
                                    <hr>
                                @endif
                                @if(!empty($is_bulan))
                                    <h5>Bulan {{ $urutan_bulan }}</h5>
                                @endif

                                <div class="row d-flex justify-content-start">
                                    <?php 
                                        
                                        $total_looping=1;
                                        $max_hari=7;
                                        if($jml_hari>=($max_hari*1)){
                                            $total_looping=2;
                                        }
                                        if($jml_hari>=($max_hari*2)){
                                            $total_looping=3;
                                        }
                                        if($jml_hari>=($max_hari*3)){
                                            $total_looping=4;
                                        }
                                        $i_awal=0;
                                        $i_end=7;
                                    ?>
                                    @for($j=0; $j<=$total_looping; $j++)
                                        <?php 
                                            if($j>0){
                                                $i_awal=$i_end;
                                                $i_end=$i_end+$max_hari;
                                                if($i_end>$jml_hari){
                                                    $i_end=$jml_hari;
                                                }
                                            }
                                        ?>    
                                    
                                        <div class="col-sm p-0">
                                            <table class="table border table-responsive-tablet">
                                                <tbody> 
                                                    @for($i=$i_awal; $i<$i_end; $i++)   
                                                        <?php 
                                                            $data_tgl=$data_tanggal[$key_bulan];
                                                            $hasil_data_tgl=[];
                                                            $kode='';
                                                            if(!empty($data_tgl[$i])){
                                                                $hasil_data_tgl=$data_tgl[$i];
                                                                $kode=$hasil_data_tgl['month_date'].'_'.$hasil_data_tgl['tgl'];
                                                            }
                                                            $hasil_data_tgl=(object)$hasil_data_tgl;

                                                            $nm_kode='pil_'.$kode;
                                                            $value_hari=!empty($hasil_data_tgl->tgl) ? $hasil_data_tgl->tgl : 0;
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input class="form-check-input checkbox_hari" type="checkbox" value="{{ $value_hari }}" id="{{ $nm_kode }}">
                                                                    <label class="form-check-label" style='margin-top: 7px;margin-left: 5px;' for="{{ $nm_kode }}">
                                                                        <div>Hari Ke {{ $value_hari }}</div>
                                                                        <hr style="margin:0px">
                                                                        <div>{{ !empty($hasil_data_tgl->nm_hari) ? $hasil_data_tgl->nm_hari : '' }}</div>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    @endfor
                                </div>
                            @endforeach
                        </div>

                        <div class="row justify-content-end align-items-end mt-1">
                            <div class="col-md-2 text-center">
                                <button class="btn btn-primary btn-block" id='btn_save' type="submit">Ubah</button>
                            </div>
                        </div>
                    </div>
                    <div id='list_hari_non_change'>
                        <h5 class="text-center">Silahkan Pilih jadwal shift terlebih dahulu</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('script-end-2')
    <script src="{{ asset('js/template-jadwal-shift-waktu/form.js') }}"></script>
@endpush