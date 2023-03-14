<table class="table data-table-2 border">
    <thead>
        <tr>
            <th scope="col" class="py-4 ps-4">Kode Dokter</th>
            <th scope="col" class="py-4" style="width: 35%;">Nama Dokter</th>
            <th scope="col" class="py-4">Spesialis</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($list_data))
            @foreach($list_data as $item)
            <?php 
                $kode = $item->kd_dokter.'@'.$item->nm_dokter;
            ?>
            <tr>
                <td class="py-3">{{ $item->kd_dokter }}</td>
                <td class="py-3"> <a href='#' class="pil text-primary hover-pointer" data-item='{{ $kode }}' >{{ $item->nm_dokter }}</a></td>
                <td class="py-3">{{ $item->nm_sps }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>