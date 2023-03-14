<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>
            
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-2 col-md-10">
                        <label for="poli" class="form-label">Poliklinik</label>
                        <select class="poli form-control" name="poli" id="poli" required>
                            <option>Pilih Poliklinik</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-10">
                        <label for="daterange" class="form-label">Tanggal</label>
                        <input type="text" class="form-control input-daterange" required id="daterange">
                        <input type="text" hidden id="tgl" required name="tanggal">
                    </div>

                    <div class="col-lg-1 col-md-1">
                        <div class="d-grid grap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>


            <div style="overflow-x: auto; max-width: auto;">
                <table class="table border table-responsive-tablet table-striped">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 10%">Kode</th>
                            <th class="py-3" style="width: 10%">Poliklinik</th>
                            <th class="py-3" style="width: 5%">Kode Dokter</th>
                            <th class="py-3" style="width: 15%">Nama Dokter</th>
                            <th class="py-3" style="width: 10%">Hari Kerja</th>
                            <th class="py-3" style="width: 10%">Jadwal</th>
                            <th class="py-3" style="width: 5%">Kuota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                <tr>
                                    <td>{{ !empty($item['kodepoli']) ? $item['kodepoli'] : ''  }}</td>
                                    <td>{{ !empty($item['namapoli']) ? $item['namapoli'] : ''  }}</td>
                                    <td>{{ !empty($item['kodedokter']) ? $item['kodedokter'] : ''  }}</td>
                                    <td>{{ !empty($item['namadokter']) ? $item['namadokter'] : ''  }}</td>
                                    <td>{{ !empty($item['namahari']) ? $item['namahari'] : ''  }}</td>
                                    <td>{{ !empty($item['jadwal']) ? $item['jadwal'] : ''  }}</td>
                                    <td>{{ !empty($item['kapasitaspasien']) ? $item['kapasitaspasien'] : ''  }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>