<table class="table border table-responsive-tablet">
    <thead>
        <tr>
            <th class="py-3" style="width: 10%">Jumlah <br> Permintaan</th>
            <th class="py-3" style="width: 8%">Kode Barang</th>
            <th class="py-3" style="width: 15%">Nama Barang</th>
            <th class="py-3" style="width: 5%">Satuan</th>
            <th class="py-3" style="width: 15%">Jenis</th>
            <th class="py-3" style="width: 20%">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($list_data))
            @foreach($list_data as $key => $item)
                <?php
                    $jumlah=!empty($item->jumlah) ? $item->jumlah : 0;
                    $jumlah=(new \App\Http\Traits\GlobalFunction)->formatMoney($jumlah);
                ?>

                <tr>
                    <td>{{ !empty($jumlah) ? $jumlah : ''  }}</td>
                    <td>{{ !empty($item->kode_brng) ? $item->kode_brng : ''  }}</td>
                    <td>{{ !empty($item->nama_brng) ? $item->nama_brng : ''  }}</td>
                    <td>{{ !empty($item->satuan) ? $item->satuan : ''  }}</td>
                    <td>{{ !empty($item->nm_jenis) ? $item->nm_jenis : ''  }}</td>
                    <td>{{ !empty($item->keterangan) ? $item->keterangan : ''  }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>