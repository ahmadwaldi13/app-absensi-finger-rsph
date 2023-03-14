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
                        <div class='bagan_form'>
                            <label for="filter_nm_jenis" class="form-label">Jenis</label>
                            <div class="button-icon-inside">
                                <input type="text" class="input-text" id='filter_nm_jenis' name="filter_nm_jenis" value="{{ Request::get('filter_nm_jenis') }}" />
                                <input type="hidden" id="filter_kd_jenis" name="filter_kd_jenis" value="{{ Request::get('filter_kd_jenis') }}" />
                                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=jenis_barang') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_nm_jenis|#filter_kd_jenis@data-key-bagan=0@data-btn-close=#closeModalData">
                                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                </span>
                                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
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
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 15%">Kode Barang</th>
                            <th class="py-3" style="width: 15%">Nama Barang</th>
                            <th class="py-3" style="width: 15%">Satuan</th>
                            <th class="py-3" style="width: 15%">Jenis</th>
                            <th class="py-3" style="width: 15%">Stok</th>
                            <th class="py-3" style="width: 15%">Harga</th>
                            <th class="py-3" style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                <?php
                                    $stok=!empty($item->stok) ? $item->stok : 0;
                                    $stok=number_format($stok,2,',','.');

                                    $harga=!empty($item->harga) ? $item->harga : 0;
                                    $harga=(new \App\Http\Traits\GlobalFunction)->formatMoney($harga);

                                    $paramater_url=[
                                        'data_sent'=>$item->kode_brng
                                    ];
                                ?>

                                <tr>
                                    <td>{{ !empty($item->kode_brng) ? $item->kode_brng : ''  }}</td>
                                    <td>{{ !empty($item->nama_brng) ? $item->nama_brng : ''  }}</td>
                                    <td>{{ !empty($item->satuan) ? $item->satuan : ''  }}</td>
                                    <td>{{ !empty($item->nm_jenis) ? $item->nm_jenis : ''  }}</td>
                                    <td>{{ !empty($stok) ? $stok : ''  }}</td>
                                    <td class='text-right'>{{ !empty($harga) ? $harga : ''  }}</td>
                                    <td class='text-right'>
                                        {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/update',$paramater_url,'update']) !!}
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