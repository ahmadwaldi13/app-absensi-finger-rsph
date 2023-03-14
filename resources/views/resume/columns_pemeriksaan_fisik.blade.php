<table class="table data-table-2 border">
    <thead>
        <tr>
            <th scope="col" class="py-4 ps-4">Tanggal</th>
            <th scope="col" class="py-4" style="width: 35%;">Jam</th>
            <th scope="col" class="py-4">Pemeriksaan</th>
            <th scope="col" class="py-4">Dilakukan</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($list_data))
            @foreach($list_data as $item)
            <?php $pemeriksaan = $item["pemeriksaan"] ?>
            <tr>
                <td class="py-3 ps-4">{{ $item["tgl_perawatan"] }}</td>
                <td class="py-3">{{ $item["jam_rawat"] }}</td>
                <td class="py-3"> <a href='#' class="pil text-primary hover-pointer" data-item='{{ $pemeriksaan }}' >{{ $pemeriksaan }}</a></td>
                <td class="py-3">{{ !empty($item["nama"]) ? $item["nama"] : '-' }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>