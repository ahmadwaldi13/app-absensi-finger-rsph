<table class="table data-table-2 border">
    <thead>
        <tr>
            <th scope="col" class="py-4">Kode</th>
            <th scope="col" class="py-4">Metode Racik</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($list_data))
            @foreach($list_data as $item)
            <?php $text = $item["kd_racik"].'@'.$item["nm_racik"] ?>
            <tr>
                <td class="py-3">{{ $item["kd_racik"] }}</td>
                <td class="py-3"> <a href='#' class="pil text-primary hover-pointer" data-item='{{ $text }}' >{{ $item["nm_racik"] }}</a></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>