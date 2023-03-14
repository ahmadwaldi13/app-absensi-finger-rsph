@extends('layouts.master2')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>

@section('content')
<div class="text-primary mb-3">
    <a href="{{ url($url_back) }}" style="color:#f0ca3b">
        <i class="fa-solid fa-square-caret-left"></i><span class="mx-2">Kembali Ke Menu sebelumnya</span>
    </a>
</div>
<div class="row d-flex justify-content-between">
    <div>
        <div style="overflow-x: auto; max-width: auto;">
            <table class="table border table-responsive-tablet">
                <thead>
                    <tr>
                        <th class="py-3" style="width: 15%">Kode Barang</th>
                        <th class="py-3" style="width: 45%">Nama Barang</th>
                        <th class="py-3" style="width: 10%">Harga Beli</th>
                        <th class="py-3" style="width: 5%">Satuan</th>
                        <th class="py-3" style="width: 12%">Tanggal</th>
                        <th class="py-3" style="width: 7%">Stok</th>
                        <th class="py-3" style="width: 7%">Real</th>
                        <th class="py-3" style="width: 7%">Selisih</th>
                        <th class="py-3" style="width: 7%">Lebih</th>
                        <th class="py-3" style="width: 10%">Total Real</th>
                        <th class="py-3" style="width: 8%">Nominal Hilang(Rp)</th>
                        <th class="py-3" style="width: 8%">Nomial Lebih(Rp)</th>
                        <th class="py-3" style="width: 40%">Keterangan</th>
                        <th class="py-3" style="width: 8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($list_data))
                    @foreach($list_data as $key => $item)
                    <?php
                    $stok=!empty($item->stok) ? $item->stok : 0;
                    $stok=number_format($stok);

                    $REAL=!empty($item->REAL) ? $item->REAL : 0;
                    // $REAL=number_format($REAL,2,',','.');


                    $selisih=!empty($item->selisih) ? $item->selisih : 0;
                    $selisih=number_format($selisih);

                    $lebih=!empty($item->lebih) ? $item->lebih : 0;
                    $lebih=number_format($lebih);

                    $h_beli=!empty($item->h_beli) ? $item->h_beli : 0;
                    $h_beli=(new \App\Http\Traits\GlobalFunction)->formatMoney($h_beli);

                    $totalreal=!empty($item->totalreal) ? $item->totalreal : 0;
                    $totalreal=(new \App\Http\Traits\GlobalFunction)->formatMoney($totalreal);

                    $nomihilang=!empty($item->nomihilang) ? $item->nomihilang : 0;
                    $nomihilang=(new \App\Http\Traits\GlobalFunction)->formatMoney($nomihilang);

                    $nomilebih=!empty($item->nomilebih) ? $item->nomilebih : 0;
                    $nomilebih=(new \App\Http\Traits\GlobalFunction)->formatMoney($nomilebih);

                    $paramater_url=[
                        'data_sent'=>$item->kode_brng,
                        'tgl'=>$item->tanggal
                    ];
                ?>
                            <tr>
                                <td>{{ !empty($item->kode_brng) ? $item->kode_brng : ''  }}</td>
                                <td>{{ !empty($item->nama_brng) ? $item->nama_brng : ''  }}</td>
                                <td>{{ !empty($h_beli) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($h_beli, 'Rp.') : '0'  }}</td>
                                <td>{{ !empty($item->kode_sat) ? $item->kode_sat : ''  }}</td>
                                <td>{{ !empty($item->tanggal) ? $item->tanggal : ''  }}</td>
                                <td>{{ !empty($stok) ? $stok : '0'  }}</td>
                                <td>{{ !empty($REAL) ? $REAL : '0'  }}</td>
                                <td>{{ !empty($selisih) ? $selisih : '0'  }}</td>
                                <td>{{ !empty($lebih) ? $lebih : '0'  }}</td>
                                <td>{{ !empty($totalreal) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($totalreal) : '0'  }}</td>
                                <td>{{ !empty($nomihilang) ? $nomihilang : '0'  }}</td>
                                <td>{{ !empty($nomilebih) ? $nomilebih : '0'  }}</td>
                                <td>{{ !empty($item->keterangan) ? $item->keterangan : ''  }}</td>
                                {{-- <td class='text-right'>
                                    {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/update',$paramater_url,'update']) !!}
                                    {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/delete',$paramater_url,'delete'],['modal']) !!}
                                </td> --}}
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

@endsection
