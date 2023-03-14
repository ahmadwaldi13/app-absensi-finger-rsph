<table class="table data-table-2 border">
    <thead>
        <tr>
            <th scope="col" class="py-4 ps-4">Tanggal</th>
            <th scope="col" class="py-4" style="width: 35%;">Waktu</th>
            <th scope="col" class="py-4">Diet</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($list_data))
            @foreach($list_data as $item)
            <?php 
                $text = !empty($item["nama_diet"]) ? $item["nama_diet"] : ''; 
            ?>
            <tr>
                <td class="py-3 ps-4">{{ $item["tanggal"] }}</td>
                <td class="py-3">{{ $item["waktu"] }}</td>
                <td class="py-3"> <a href='#' class="pil text-primary hover-pointer" data-item='{{ $text }}' >{{ $text }}</a></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>