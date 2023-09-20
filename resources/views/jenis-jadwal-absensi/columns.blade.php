<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control" name='form_filter_text'
                            value="{{ Request::get('form_filter_text') }}" id='filter_search_text'
                            placeholder="Masukkan Kata">
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
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 3%">Kel. Jadwal</th>
                            <th class="py-3" style="width: 10%">Nama Jenis Jadwal</th>
                            <th class="py-3" style="width: 5%">Jam Masuk Kerja</th>
                            <th class="py-3" style="width: 5%">Jam Pulang Kerja</th>
                            <th class="py-3" style="width: 5%">Istirahat</th>
                            <th class="py-3" style="width: 5%">Akhir Istirahat</th>
                            <th class="py-3" style="width: 12%">Total Jam Kerja</th>
                            <th class="py-3" style="width: 20%">Hari Kerja</th>
                            <th class="py-3" style="width: 5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                            <?php
                                $disable_button=0;
                                if($item->id_jenis_jadwal==1){
                                    $disable_button=1;
                                }

                                $paramater_url=[
                                    'data_sent'=>$item->id_jenis_jadwal
                                ];

                                $waktu_masuk=(new \App\Http\Traits\AbsensiFunction)->his_to_seconds($item->masuk_kerja);
                                $waktu_pulang=(new \App\Http\Traits\AbsensiFunction)->his_to_seconds($item->pulang_kerja);

                                $mulai_istirahat=(new \App\Http\Traits\AbsensiFunction)->his_to_seconds($item->awal_istirahat);
                                $akhir_istirahat=(new \App\Http\Traits\AbsensiFunction)->his_to_seconds($item->akhir_istirahat);

                                $total_istirahat=$akhir_istirahat-$mulai_istirahat;

                                $total_waktu_kerja=($waktu_pulang-$waktu_masuk)-$total_istirahat;
                                $total_waktu_kerja=(new \App\Http\Traits\AbsensiFunction)->hitung_waktu_by_seccond($total_waktu_kerja);
                                $total_waktu_kerja_text=$total_waktu_kerja->jam.' jam'.', '.$total_waktu_kerja->menit.' Menit'.', '.$total_waktu_kerja->detik.' Detik';

                                $get_hari_kerja_tmp=!empty($item->hari_kerja) ? $item->hari_kerja : '';
                                $get_hari_kerja_tmp=!empty($get_hari_kerja_tmp) ? explode(',',$get_hari_kerja_tmp) : [];
                                $hari_kerja=[];
                                if(!empty($get_hari_kerja_tmp)){
                                    foreach($get_hari_kerja_tmp as $value){
                                        $hari_kerja[]=(new \App\Http\Traits\GlobalFunction)->hari($value);
                                    }
                                }
                                $hari_kerja=!empty($hari_kerja) ? implode(',',$hari_kerja) : '';

                                $nm_type_jenis = (new \App\Models\RefJenisJadwal())->type_jenis_jadwal($item->type_jenis);
                            ?>
                            <tr>
                                <td>{{ $nm_type_jenis  }}</td>
                                <td>{{ !empty($item->nm_jenis_jadwal) ? $item->nm_jenis_jadwal : ''  }}</td>
                                <td>{{ !empty($item->masuk_kerja) ? $item->masuk_kerja : ''  }}</td>
                                <td>{{ !empty($item->pulang_kerja) ? $item->pulang_kerja : ''  }}</td>
                                <td>{{ !empty($item->awal_istirahat) ? $item->awal_istirahat : ''  }}</td>
                                <td>{{ !empty($item->akhir_istirahat) ? $item->akhir_istirahat : ''  }}</td>
                                <td>{{ $total_waktu_kerja_text  }}</td>
                                <td>{{ $hari_kerja  }}</td>
                                <td class='text-right'>
                                    {!! (new
                                    \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/update',$paramater_url,'update'])
                                    !!}
                                    @if(empty($disable_button))
                                        {!! (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/delete',$paramater_url,'delete'],['modal'])!!}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @if(!empty($list_data))
            <div class="d-flex justify-content-end">
                {{ $list_data->withQueryString()->onEachSide(0)->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
