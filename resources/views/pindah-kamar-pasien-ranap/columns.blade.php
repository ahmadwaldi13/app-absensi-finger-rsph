<?php

?>

<div class="card border-top-0 px-4 py-4">
    <div>
        <div class="row d-flex justify-content-between">
            <div>
                <div style="overflow-x: auto; max-width: auto;">
                    <table class="table border table-responsive-tablet">
                        <thead>
                            <tr>
                                <th class="py-3" style="width: 15%">Tgl Masuk</th>
                                <th class="py-3" style="width: 15%">Kamar Awal</th>
                                <th class="py-3 text-end" style="width: 10%">Tarif</th>
                                <th class="py-3" style="width: 15%">Kamar Pindah</th>
                                <th class="py-3 text-end" style="width: 10%">Tarif</th>
                                <th class="py-3 text-end" style="width: 10%">Selisih</th>
                                <th class="py-3 text-center" style="width: 5%">Lama Inap</th>
                                <th class="py-3 text-end" style="width: 15%">Total</th>
                                <th class="py-3" style="width: 15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($list_data))
                                @foreach($list_data as $key => $item)
                                    <?php
                                        $waktu_masuk=!empty($item->waktu_masuk) ? (new \App\Http\Traits\GlobalFunction)->set_format_tanggal($item->waktu_masuk) : 0;
                                        $waktu_masuk=!empty($waktu_masuk->tanggal_jam) ? $waktu_masuk->tanggal_jam : '';

                                        $kamar_awal=!empty($item->kd_kamar_awal) ? $item->kd_kamar_awal : '';
                                        if($kamar_awal){
                                            $kamar_awal.=!empty($item->nm_bangsal_awal) ? ",".$item->nm_bangsal_awal : '';
                                        }

                                        $kamar_pindah=!empty($item->kd_kamar_pindah) ? $item->kd_kamar_pindah : '';
                                        if($kamar_pindah){
                                            $kamar_pindah.=!empty($item->nm_bangsal_pindah) ? ",".$item->nm_bangsal_pindah : '';
                                        }

                                        $trf_kamar_awal=!empty($item->trf_kamar_awal) ? $item->trf_kamar_awal : 0;
                                        $trf_kamar_awal_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($trf_kamar_awal);

                                        $trf_kamar_pindah=!empty($item->trf_kamar_pindah) ? $item->trf_kamar_pindah : 0;
                                        $trf_kamar_pindah_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($trf_kamar_pindah);

                                        $selisih_kamar=$trf_kamar_pindah-$trf_kamar_awal;

                                        $selisih_kamar_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($selisih_kamar);

                                        $biaya=!empty($selisih_kamar) ? $selisih_kamar : 0;
                                        $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                        $qty=!empty($item->lama_inap) ? $item->lama_inap : 0;
                                        $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                        $total_form=$biaya*$qty;
                                        $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);
                                    ?>
                                    <tr>
                                        <td>{!! $waktu_masuk !!}</td>
                                        <td>{!! $kamar_awal !!}</td>
                                        <td class='text-end'>{{ $trf_kamar_awal_text  }}</td>
                                        <td>{!! $kamar_pindah !!}</td>
                                        <td class='text-end'>{{ $trf_kamar_pindah_text  }}</td>
                                        <td class='text-end'>{{ $selisih_kamar_text  }}</td>
                                        <td class='text-center'>{{ $qty_text  }}</td>
                                        <td class='text-end'>{{ $total_form_text  }}</td>
                                        <td class='text-right'>
                                            <?php
                                                $paramater_update=[
                                                    'data_sent'=>$item->no_rkm_medis.'@'.$item->no_rawat,
                                                    'params_json'=>$params_parent_json,
                                                    'kode_send'=>$item->no_rkm_medis.'@'.$item->no_rawat.'@'.$item->id_pindah_kamar,
                                                ];

                                                $tmp_para=[];
                                                foreach($paramater_update as $key => $value){
                                                    $tmp_para[]=$key.'='.$value;
                                                }
                                                $paramater_update=implode('&',$tmp_para);
                                                $url=$router_name->uri.'?'.$paramater_update;

                                            ?>
                                            <a href="{{ url($url) }}" class="btn btn-kecil btn-warning"><i class="fa-solid fa-pencil"></i></a>
                                            <?php
                                                $url_pindah_kamar_cetak=$router_name->uri.'/cetak';
                                            ?>
                                            <?php
                                                $paramater_delete=[
                                                    'data_sent'=>$item->no_rkm_medis.'@'.$item->no_rawat.'@'.$item->id_pindah_kamar,
                                                    'params_json'=>$params_parent_json,
                                                ];

                                                $tmp_para=[];
                                                foreach($paramater_delete as $key => $value){
                                                    $tmp_para[]=$key.'='.$value;
                                                }
                                                $paramater_delete=implode('&',$tmp_para);
                                                $url=$router_name->uri.'?'.$paramater_delete;
                                            ?>
                                            <a href="{{ url($url) }}" class="btn btn-kecil btn-danger modal-remote-delete" data-modal-width="50%" data-modal-title="Hapus Data" data-confirm-message="Apakah anda yakin menghapus data ini ?"><i class="fa-solid fa-trash"></i></a>
                                            @if( (new \App\Http\Traits\AuthFunction)->checkAkses($url_pindah_kamar_cetak) )
                                                <?php
                                                    $url_pindah_kamar_cetak=$router_name->uri.'/cetak';

                                                    $paramater_cetak=[
                                                        'pindah_kamar_params'=>json_encode(['key_me'=>$item->id_pindah_kamar]),
                                                    ];
    
                                                    $tmp_para=[];
                                                    foreach($paramater_cetak as $key => $value){
                                                        $tmp_para[]=$key.'='.$value;
                                                    }
                                                    $paramater_cetak=implode('&',$tmp_para);
                                                    $url_pindah_kamar_cetak=$url_pindah_kamar_cetak.'?'.$paramater_cetak;
                                                ?>
                                                <a href="{{url($url_pindah_kamar_cetak)}}" target="_blank" class='btn btn-kecil btn-warning' style="color:#fff;background-color:#7912e0;"><i class="fa-solid fa-print"></i> </a>
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
</div>

@push('script-end-2')
<script src="{{ asset('js/rawat-inap/index.js') }}"></script>
@endpush