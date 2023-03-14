<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>

            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control" name='form_filter_text' value="{{ Request::get('form_filter_text') }}" id='filter_search_text' placeholder="Masukkan Kata">
                    </div>


                    <div class="col-lg-3 col-md-10">
                        <div class='input-date-range-bagan'>
                            <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                            <span class='icon-bagan-date'></span>
                            <input type="text" class="form-control input-date-range" id="tanggal_pengajuan" placeholder="Tanggal">
                            <input type="hidden" id="tgl_start" name="form_filter_date_start" value="{{ Request::get('form_filter_date_start') }}">
                            <input type="hidden" id="tgl_end" name="form_filter_date_end" value="{{ Request::get('form_filter_date_end') }}">
                        </div>
                    </div>

                    @if(!empty($get_status_verifikasi->status_verifikasi))
                        <div class="col-lg-3 col-md-10">
                            <label for="form_filter_status" class="form-label">Status Data</label>
                            <select class='form-control' id='form_filter_status' name="form_filter_status">
                                <option value="all" {{ (Request::get('form_filter_status') == 'all') ? 'selected' : '' }} >Semua</option>
                                @foreach ($get_status_verifikasi->status_verifikasi as $key => $value)
                                    <option value="{{ $key }}" {{ (Request::get('form_filter_status') == (string)$key) ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

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
                            <th class="py-3" style="width: 10%">Tanggal</th>
                            <th class="py-3" style="width: 10%">No.Permintaan</th>
                            <th class="py-3" style="width: 25%">Pegawai</th>
                            <th class="py-3" style="width: 10%">Jabatan</th>
                            <th class="py-3" style="width: 15%">Departemen</th>
                            <th class="py-3" style="width: 15%">Ruangan</th>
                            <th class="py-3" style="width: 15%">Status</th>
                            <th class="py-3" style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                <?php
                                    $check_status=(new \App\Models\UxuiPermintaanBarangNonMedisStatus)->get_status_verifikasi($item->status_veri,$item->status);
                                    $status_verifikasi=!empty($check_status->status_verifikasi) ? $check_status->status_verifikasi : '';
                                    // echo "<pre>";
                                    // print_r($status_verifikasi);
                                    // print_r($item->status);
                                    // print_r($item->status_veri);
                                    // print_r("----------------");
                                    $paramater_url=[
                                        'data_sent'=>$item->no_permintaan
                                    ];
                                ?>

                                <tr>
                                    <td>{{ !empty($item->tanggal) ? $item->tanggal : ''  }}</td>
                                    <td>{{ !empty($item->no_permintaan) ? $item->no_permintaan : ''  }}</td>
                                    <td>
                                        <div>( {{ !empty($item->nip) ? $item->nip : ''  }} )</div>
                                        <div>{{ !empty($item->nama) ? $item->nama : ''  }}</div>
                                    </td>
                                    <td>{{ !empty($item->jnj_jabatan) ? $item->jnj_jabatan : ''  }}</td>
                                    <td>
                                        <div>( {{ !empty($item->departemen) ? $item->departemen : ''  }} )</div>
                                        <div>{{ !empty($item->nama_departemen) ? $item->nama_departemen : ''  }}</div>
                                    </td>
                                    <td>{{ !empty($item->ruang) ? $item->ruang : ''  }}</td>
                                    <td>{{ !empty($status_verifikasi) ? $status_verifikasi : ''  }}</td>
                                    <td class='text-right'>
                                        {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/view',$paramater_url,'view',[ 'style'=>'color:#fff;' ]],['modal',['data-modal-width'=>'90%']  ]) !!}

                                        @if( $check_status->status == 0)
                                            {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/update',$paramater_url,'update']) !!}
                                            {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/delete',$paramater_url,'delete'],['modal']) !!}
                                            
                                        @endif

                                        @if (!empty($get_status_verifikasi->status_verifikasi))
                                           {{-- @if (preg_match('(0|1|2|3|4)',$item->status_veri))
                                                <a href='{{$router_name->uri.'/unduh_berkas?data_sent='.$item->no_permintaan}}' target="_blank" class='btn btn-kecil' style="color:#fff;background-color:#7912e0;" ><i class="fa-solid fa-print"></i></i></a>
                                           @endif --}}
                                           @if ($check_status->status == 2)
                                                {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/verifikasi',$paramater_url,'update','','Verifikasi'],'') !!}
                                              {{-- <button>verifikasi</button>  --}}
                                           @endif
                                           @if (isset($item->status_veri))
                                            {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/unduh_berkas',
                                                                                                                $paramater_url,
                                                                                                                'view',
                                                                                                                [ 'style'=>'color:#fff;background-color:#7912e0;', 
                                                                                                                    'target' => "_blank"
                                                                                                                ], 
                                                                                                                '<i class="fa-solid fa-print"></i>'
                                                                                                        ]) !!}
                                               
                                           @endif
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
