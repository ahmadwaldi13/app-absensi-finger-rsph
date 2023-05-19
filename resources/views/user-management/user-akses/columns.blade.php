<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_level_akses" class="form-label">Level Akses</label>
                        <select id="filter_level_akses" class="form-select" name='filter_level_akses' value="{{ Request::get('filter_level_akses') }}">
                            <option value="">Semua Data</option>
                            @foreach ($level_akses_list as $key => $value)
                                <option value="{{ $value->alias }}" {{ Request::get('filter_level_akses') == $value->alias ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-10">
                        <label for="filter_status_akses" class="form-label">Status Akses</label>
                        <select id="filter_status_akses" class="form-select" name='filter_status_akses' value="{{ Request::get('filter_status_akses') }}">
                            <option value="">Semua Data</option>
                            <?php $status_akses=[1=>'Belum',2=>'Sudah']; ?>
                            @foreach ($status_akses as $key => $value)
                                <option value="{{ $key }}" {{ Request::get('filter_status_akses') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

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
                            <th class="py-3" style="width: 15%">Nama Karyawan</th>
                            <th class="py-3" style="width: 15%">Jabatan</th>
                            <th class="py-3" style="width: 15%">Departemen</th>
                            <th class="py-3" style="width: 15%">Username</th>
                            <th class="py-3" style="width: 15%">Level Akses</th>
                            <th class="py-3" style="width: 15%">Status Users</th>
                            <th class="py-3" style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                            <?php
                                $paramater_url=[
                                    'data_sent'=>$item->id_karyawan
                                ];
                            ?>
                            <tr>
                                <td>
                                    <div>( {{ !empty($item->nip) ? $item->nip : ''  }} )</div>
                                    <div>{{ !empty($item->nm_karyawan) ? $item->nm_karyawan : ''  }}</div>
                                </td>
                                <td>{{ !empty($item->nm_jabatan) ? $item->nm_jabatan : ''  }}</td>
                                <td>{{ !empty($item->nm_departemen) ? $item->nm_departemen : ''  }}</td>
                                <td>{{ !empty($item->username) ? $item->username : ''  }}</td>
                                <td>{{ !empty($item->nama_group) ? $item->nama_group : ''  }}</td>
                                <td>{{ !empty($item->nm_status_user) ? $item->nm_status_user : ''  }}</td>
                                <td class='text-right'>
                                    {!! (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/update',$paramater_url,'update'])
                                    !!}
                                    {!! (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/delete',$paramater_url,'delete'],['modal'])
                                    !!}
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
