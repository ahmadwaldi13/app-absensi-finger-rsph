@push('custom-style')
<style>
    .table-bg-d{
        background: #aff5de !important;
    }

    .table-bg-w-i{
        background: #fff !important;
    }

    .table-border-c{
        border: 1px solid #b1d5ff;
    }

    .form-active{
        color: #212529;
        background-color: #fff;
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
    }

</style>
@endpush

<table class="table border table-responsive-tablet">
    <thead class='table-border-c'>
        <tr class='form-show'>
            <td colspan='8' style='text-align:right; font-size:24px; font-weight:700;'>
                <span>Jumlah item yang di berikan : </span><span class='total-jml'></span>&nbsp;&nbsp;&nbsp;&nbsp;
                <span>Total harga item : Rp. </span><span class='total-total'></span>
            </th>
        </tr>
        <tr>
            <th class="py-3 table-border-c" style="width: 1%">No</th>
            <th class="py-3 table-border-c" style="width: 25%">Kode Barang</th>
            <th colspan=2 class="py-3 table-border-c" style="width: 25%">Nama Barang</th>
            <th class="py-3 table-border-c" style="width: 1%">Satuan</th>
            <th colspan=2 class="py-3 table-border-c" style="width: 20%">Jenis</th>
            <th class="py-3 table-border-c form-show" style="width: 5%">Status</th>
            <th class="py-3 table-border-c form-show" style="width: 25%">Keterangan Barang</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($list_data))
            @foreach($list_data as $key => $item)
                <?php
                    $jumlah=!empty($item->jumlah) ? $item->jumlah : 0;
                    $jumlah_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($jumlah);

                    if(array_key_exists($item->kode_brng,$get_data_gudang)){
                        $item_gudang=$get_data_gudang[$item->kode_brng];

                        $stok=!empty($item_gudang->stok) ? $item_gudang->stok : 0;
                        $stok_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($stok);

                        $harga=!empty($item_gudang->harga) ? $item_gudang->harga : 0;
                        $harga_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($harga);
                    }
                ?>

                <tr style='border-bottom: 1px solid;' class='item-barang-data-top' data-uniq='{{ !empty($item->kode_brng) ? $item->kode_brng : ""  }}'>
                    <td rowspan="3" class='table-border-c table-bg-w-i' style='vertical-align: middle;'>{{ $key+1  }}</td>
                    <td class='table-bg-d'>{{ !empty($item->kode_brng) ? $item->kode_brng : ''  }}</td>
                    <td colspan=2 class='table-bg-d'>{{ !empty($item->nama_brng) ? $item->nama_brng : ''  }}</td>
                    <td class='table-bg-d'>{{ !empty($item->satuan) ? $item->satuan : ''  }}</td>
                    <td colspan=2 class='table-bg-d'>{{ !empty($item->nm_jenis) ? $item->nm_jenis : ''  }}</td>
                    <td rowspan=3 class='table-border-c table-bg-w-i form-show' style='text-align:center; vertical-align: middle;'>
                        <span class='status-text'></span>
                    </td>
                    <td rowspan=3 class="form-show bg-white">
                        <textarea class="form-control ket-barang-inventori" data-key='{{ $item->kode_brng }}' id="" cols="30" rows="5"></textarea>
                    </td>
                </tr>

                <tr style='border-bottom: 1px solid;' class='item-barang-header' data-uniq='{{ !empty($item->kode_brng) ? $item->kode_brng : ""  }}'>
                    <td class="py-3 table-border-c" style="width: 20%">Keterangan Permintaan</td>
                    <td class="py-3 table-border-c" style="width: 1%">Jlh.Permintaan</td>
                    <td class="py-3 table-border-c form-show" style="width: 20%">Jumlah</td>
                    <td class="py-3 table-border-c" style="width: 10%">Stok</td>
                    <td class="py-3 table-border-c" style="width: 10%">Harga</td>
                    <td class="py-3 table-border-c form-show" style="width: 10%">Total</td>
                    
                </tr>

                <tr style='border-bottom: 1px solid;' class='item-barang' data-uniq='{{ !empty($item->kode_brng) ? $item->kode_brng : ""  }}'>
                    <td class='table-border-c' style='vertical-align: middle;'>{{ !empty($item->keterangan) ? $item->keterangan : ''  }}</td>
                    <td class='table-border-c' style='text-align:right; vertical-align: middle;'>{{ !empty($jumlah_text) ? $jumlah_text : ''  }}</td>
                    <td class='table-border-c form-show' style='text-align:right; vertical-align: middle;'>
                        <input type="text" class="form-control money jml-text" data-key='{{ $item->kode_brng }}' value="{{ !empty($jumlah_text) ? $jumlah_text : ''  }}">
                        <input type='hidden' class='jml-permintaan'  value='{{ !empty($jumlah_text) ? $jumlah_text : ''  }}'>
                        <input type="hidden" class="jml-value" data-key='{{ $item->kode_brng }}' value="{{ !empty($jumlah) ? $jumlah : ''  }}">
                    </td>
                    <td class='table-border-c' style='text-align:right; vertical-align: middle;'>
                        <span class='stok-text'>{{ $stok_text }}</span>
                        <input type='hidden' class='stok-dasar'  value='{{ !empty($stok) ? $stok : 0  }}'>
                        <input type='hidden' class='stok-value'  value='{{ !empty($stok) ? $stok : 0  }}'>
                    </td>
                    <td class='table-border-c' style='text-align:right; vertical-align: middle;'>
                        <span class='harga-text'>{{ $harga_text }}</span>
                        <input type='hidden' class='harga-value'  value='{{ !empty($harga) ? $harga : 0  }}'>
                    </td>
                    <td class='table-border-c form-show' style='text-align:right; vertical-align: middle;'>
                        <span class='total-text'></span>
                        <input type='hidden' class='total-value'  value=''>
                    </td>
                </tr>

                <tr>
                    <td colspan="4"></td> 
                </tr>
            @endforeach
            <tr class='form-show'>
                <td colspan='8' style='text-align:right; font-size:24px; font-weight:700;'>
                    <span>Jumlah item yang di berikan : </span><span class='total-jml'></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>Total harga item : Rp. </span><span class='total-total'></span>
                </td>
            </tr>
        @endif
    </tbody>
</table>