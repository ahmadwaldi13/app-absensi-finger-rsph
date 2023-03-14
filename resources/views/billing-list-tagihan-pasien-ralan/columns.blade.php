<div class="card border-top-0 px-4 py-4">
    <div>
        <div class="row d-flex justify-content-between">
            <div>
                <form action="" method="GET">
                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-3 col-md-10">
                            <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                            <input type="text" class="form-control" name='form_filter_text' value="{{ Request::get('form_filter_text') }}" id='filter_search_text' placeholder="Masukkan Kata">
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
                                <th class="py-3" style="width: 15%">NIP</th>
                                <th class="py-3" style="width: 15%">Nama</th>
                                <th class="py-3" style="width: 3%">Jenis Kelamin</th>
                                <th class="py-3" style="width: 15%">Jabatan</th>
                                <th class="py-3" style="width: 15%">Bidang</th>
                                <th class="py-3" style="width: 20%">Departemen</th>
                                <th class="py-3" style="width: 7%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($list_data))
                                @foreach($list_data as $key => $item)
                                    <?php
                                        $paramater_url=[
                                            'data_sent'=>$item->nip
                                        ];
                                    ?>
                                    <tr>
                                        <td>{{ !empty($item->nip) ? $item->nip : ''  }}</td>
                                        <td>{{ !empty($item->nama_pegawai) ? $item->nama_pegawai : ''  }}</td>
                                        <td>{{ !empty($item->jk) ? $item->jk : ''  }}</td>
                                        <td>{{ !empty($item->jbtn) ? $item->jbtn : ''  }}</td>
                                        <td>{{ !empty($item->bidang) ? $item->bidang : ''  }}</td>
                                        <td>{{ !empty($item->list_departemen) ? $item->list_departemen : ''  }}</td>
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
</div>