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
                            <th class="py-3">Kode</th>
                            <th class="py-3" style="text-align: center">Template</th>
                            <th class="py-3">Poliklinik</th>
                            <th class="py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                <tr>
                                    <?php
                                        $values = !empty(str_replace(',',' ', $item->item_poli)) ? str_replace(',',', ',$item->item_poli) : '';
                                        $paramater_url=[
                                            'data_sent'=>$item->kode_setting
                                        ];
                                    ?>
                                    <td>{{ !empty($item->kode_setting) ? $item->kode_setting : ''  }}</td>
                                    @if ($item->kode_template==1)
                                        <td style="text-align: center">{{ !empty(str_replace('1','Default', ($item->kode_template=1))) ? str_replace('1','Default', ($item->kode_template=1)) : ''  }}</td>
                                    @else   
                                        <td style="text-align: center">{{ !empty(str_replace('2','Tema Dua', ($item->kode_template=2))) ? str_replace('2','Tema Dua', ($item->kode_template=2)) : '' }}</td>
                                    @endif
                                    <td>{{ !empty($values) ? $values : ''  }}</td>
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
        </div>
    </div>
</div>