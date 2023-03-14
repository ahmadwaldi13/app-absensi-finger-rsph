<table class="table data-table-2 border">
    <thead>
        <tr>
            <th scope="col" class="py-4 ps-4">Tanggal</th>
            <th scope="col" class="py-4" style="width: 35%;">Jam</th>
            <th scope="col" class="py-4">Obat Yang Diberikan</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($list_data))
            @foreach($list_data as $item)
            <?php 
                $jml=(new \App\Http\Traits\GlobalFunction)->formatMoney($item["jml"]);
                $text = ( !empty($item["nama_brng"]) ? $item["nama_brng"] : '') .' : '.$jml.' '.(!empty($item["kode_sat"]) ? $item["kode_sat"] : '') ; 
            ?>
            <tr>
                <td class="py-3 ps-4">{{ $item["tgl_perawatan"] }}</td>
                <td class="py-3">{{ $item["jam"] }}</td>
                <td class="py-3"> <a href='#' class="pil text-primary hover-pointer" data-item='{{ $text }}' >{{ $text }}</a></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>