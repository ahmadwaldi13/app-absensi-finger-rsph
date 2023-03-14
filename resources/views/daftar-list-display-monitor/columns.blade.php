<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>
            
            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-striped table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Link/URL dan Display</th>
                            <th class="py-3">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                <?php
                                    $item=(object)$item;
                                ?>

                                <tr>
                                    <td>{{ !empty($item->nama) ? $item->nama : ''  }}</td>
                                    <td>
                                        @if(!empty($item->link))
                                            <a class="btn btn-primary" target="_blank" href="{{ url('/').'/'.$item->link }}"><i class="fa-solid fa-desktop"></i> Lihat</a>
                                        @endif
                                    </td>
                                    <td>{{ !empty($item->keterangan) ? $item->keterangan : ''  }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>