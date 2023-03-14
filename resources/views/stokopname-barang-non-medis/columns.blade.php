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
                            <label for="tanggal_pengajuan" class="form-label">Tanggal</label>
                            <span class='icon-bagan-date'></span>
                            <input type="text" class="form-control input-date-range" id="tanggal_pengajuan" placeholder="Tanggal">
                            <input type="hidden" id="tgl_start" name="form_filter_date_start" value="{{ Request::get('form_filter_date_start') }}">
                            <input type="hidden" id="tgl_end" name="form_filter_date_end" value="{{ Request::get('form_filter_date_end') }}">
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
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 4%">Tanggal</th>
                            <th class="py-3" style="width: 10%">Keterangan</th>
                            <th class="py-3" style="width: 4%">Jumlah Item</th>
                            <th class="py-3" style="width: 8%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                        @foreach($list_data as $key => $item)
                        <?php
                        $paramater_url=[
                            'data_sent'=>$item->tanggal
                        ];
                    ?>
                                <tr>
                                    <td>{{ !empty($item->tanggal) ? $item->tanggal : ''  }}</td>
                                    <td>{{ !empty($item->keterangan) ? $item->keterangan : ''  }}</td>
                                    <td>{{ !empty($item->jml) ? $item->jml : ''  }}</td>
                                    <td class='text-right'>
                                        {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/view',$paramater_url,'view',[ 'style'=>'color:#fff;' ]]) !!}
                                        {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/delete',$paramater_url,'delete'],['modal']) !!}
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
