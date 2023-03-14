<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <style>
        .container,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xl,
        .container-xxl {
            /* max-width: 1320px; */
            width: 100%;
            padding-right: 1rem;
            padding-left: 1rem;
            margin-right: auto;
            margin-left: auto;
        }

        body {
            margin: 0;
            margin-right: 0px;
            margin-left: 0px;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: .75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(0 * -1);
            margin-right: calc(1.5rem* -.5);
            margin-left: calc(1.5rem* -.5);
        }

        .text-center {
            text-align: center !important;
        }

        .my-0 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .my-1 {
            margin-top: 0.25rem !important;
            margin-bottom: 0.25rem !important;
        }

        .my-2 {
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }

        .my-3 {
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
        }

        .my-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1.5rem !important;
        }

        .col {
            flex: 1 0 0%;
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(1.5rem * .5);
            padding-left: calc(1.5rem * .5);
            margin-top: 0;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        table {
            caption-side: bottom;
            border-collapse: collapse;
        }

        .table-success {
            color: #000;
            border-color: #bcd0c7;
        }

        .table> :not(:last-child)> :last-child>* {
            border-bottom-color: currentColor;
        }

        .table> :not(caption)>*>* {
            padding: .5rem .5rem;
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px transparent;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-bottom-color: inherit;
            border-style: solid;
            border-width: 0;
            border-bottom-width: 1px;
        }

        th {
            text-align: inherit;
            text-align: -webkit-match-parent;
            background-color: #d1e7dd;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }
    </style>
</head>

<body class="container-xl">

    <!-- Dummy Data, nanti pindahkan ke server / backend -->
    <?php
    // $data = [
    //     ['kd_barang' => 'kdbrg', 'nm_barang' => 'barang', 'harga' => '20000', 'satuan' => 'TAB', 'tanggal' => '14/01/2020', 'stok' => 1.0, 'real' => 5.0, 'selisih' => 0.0, 'lebih' => 0.0, 'total_real' => 100000, 'nominal_hilang' => 0, 'nominal_lebih' => 100, 'lokasi' => 'ANGGREK'],
    //     ['kd_barang' => 'kdbrg2', 'nm_barang' => 'barang', 'harga' => '20000', 'satuan' => 'TAB', 'tanggal' => '14/01/2020', 'stok' => 1.0, 'real' => 5.0, 'selisih' => 0.0, 'lebih' => 0.0, 'total_real' => 100000, 'nominal_hilang' => 0, 'nominal_lebih' => 100, 'lokasi' => 'ANGGREK'],
    //     ['kd_barang' => 'kdbrg3', 'nm_barang' => 'barang', 'harga' => '20000', 'satuan' => 'TAB', 'tanggal' => '14/01/2020', 'stok' => 1.0, 'real' => 5.0, 'selisih' => 0.0, 'lebih' => 0.0, 'total_real' => 100000, 'nominal_hilang' => 0, 'nominal_lebih' => 100, 'lokasi' => 'ANGGREK'],
    //     ['kd_barang' => 'kdbrg4', 'nm_barang' => 'barang', 'harga' => '20000', 'satuan' => 'TAB', 'tanggal' => '14/01/2020', 'stok' => 1.0, 'real' => 5.0, 'selisih' => 0.0, 'lebih' => 0.0, 'total_real' => 100000, 'nominal_hilang' => 0, 'nominal_lebih' => 100, 'lokasi' => 'ANGGREK'],
    //     ['kd_barang' => 'kdbrg5', 'nm_barang' => 'barang', 'harga' => '20000', 'satuan' => 'TAB', 'tanggal' => '14/01/2020', 'stok' => 1.0, 'real' => 5.0, 'selisih' => 0.0, 'lebih' => 0.0, 'total_real' => 100000, 'nominal_hilang' => 0, 'nominal_lebih' => 100, 'lokasi' => 'ANGGREK'],
    //     ['kd_barang' => 'kdbrg6', 'nm_barang' => 'barang', 'harga' => '20000', 'satuan' => 'TAB', 'tanggal' => '14/01/2020', 'stok' => 1.0, 'real' => 5.0, 'selisih' => 0.0, 'lebih' => 0.0, 'total_real' => 100000, 'nominal_hilang' => 0, 'nominal_lebih' => 100, 'lokasi' => 'ANGGREK'],
    // ];

    // $title = 'Transaksi Stok Opname';
    $tanggal = '14/01/2020';
    $totalRecord = sizeof($data);
    $totalReal = 0;
    $totalHilang = 0;
    $totalLebih = 0;

    // foreach ($data as $rowData) {
    //     $totalReal += $rowData['total_real'];
    //     $totalHilang += $rowData['nominal_hilang'];
    //     $totalLebih += $rowData['nominal_lebih'];
    // }

    ?>
    <!-- ----------------------------------- -->
    <div class="row">
        <div class="col">
            <div class="text-center">
                <h2>{{ $title }}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="table-success">
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Beli</th>
                            <th>Satuan</th>
                            <th>Tanggal</th>
                            <th>Stok</th>
                            <th>Real</th>
                            <th>Selisih</th>
                            <th>Lebih</th>
                            <th>Total Real(Rp)</th>
                            <th>Nominal Hilang(Rp)</th>
                            <th>Nominal Lebih(Rp)</th>
                            @if (!$nonMedis)
                            <th>Lokasi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $rowData)
                        <tr>
                            <td>{{ $rowData['kode_brng'] }}</td>
                            <td>{{ $rowData['nama_brng'] }}</td>
                            <td>{{ number_format($rowData['h_beli'],0,',','.') }}</td>
                            <td>{{ $rowData['kode_sat'] }}</td>
                            <td>{{ $rowData['tanggal'] }}</td>
                            <td>{{ $rowData['stok'] }}</td>
                            <td>{{ $rowData['real'] }}</td>
                            <td>{{ $rowData['selisih'] }}</td>
                            <td>{{ $rowData['lebih'] }}</td>
                            <td>{{ number_format($rowData['totalreal'],0,',','.') }}</td>
                            <td>{{ number_format($rowData['nomihilang'],0,',','.') }}</td>
                            <td>{{ number_format($rowData['nomilebih'],0,',','.') }}</td>
                            @if (!$nonMedis)
                            <td>{{ $rowData['nm_bangsal'] }}</td>
                            @endif

                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>{{$tanggal}}</td>
                            <td colspan="4">Record : {{$rowTotal}}</td>
                            <td colspan="4">Total : </td>
                            <td>{{ number_format($realTotal,0,',','.') }}</td>
                            <td>{{ number_format($hilangTotal,0,',','.') }}</td>
                            <td colspan="2">{{ number_format($lebihTotal,0,',','.') }}</td>
                        </tr>
                    </tfoot>
                </table>

                <!-- <table class="table-success">
                    <tbody>
                        <tr>
                            <td>{{$tanggal}}</td>
                            <td>{{$totalRecord}}</td>
                            <td>{{$totalReal}}</td>
                            <td>{{$totalHilang}}</td>
                            <td>{{$totalLebih}}</td>
                        </tr>
                    </tbody>
                </table> -->
            </div>

        </div>
    </div>
</body>

</html>