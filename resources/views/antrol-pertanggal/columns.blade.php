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
                        <label for="daterange" class="form-label">Tanggal <span class="text-danger">*</span></label>
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
                            <th class="py-3" style="width: 2%">No</th>
                            <th class="py-3" style="width: 10%">No.Rawat</th>
                            <th class="py-3" style="width: 10%">No.Rekam Medis</th>
                            <th class="py-3" style="width: 10%">Nama Pasien</th>
                            <th class="py-3" style="width: 10%">Poliklinik</th>
                            <th class="py-3" style="width: 10%; text-align: center;">Status Add Antrean</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                <tr>
                                    <td class="py-3">{{ (($list_data->currentPage() * 20) - 20) + $loop->iteration }}.</td>
                                    <td>{{ !empty($item['no_rawat']) ? $item['no_rawat'] : '' }}</td>
                                    <td>{{ !empty($item['no_rkm_medis']) ? $item['no_rkm_medis'] : '' }}</td>
                                    <td>{{ !empty($item['nm_pasien']) ? $item['nm_pasien'] : '' }}</td>
                                    <td>{{ !empty($item['nm_poli']) ? $item['nm_poli'] : '' }}</td>
                                    @if($item['kd_poli'] == 'IGDK')
                                        <td style="text-align: center;"><span class="badge" style="background-color: darkorange">Tidak Dihitung</span></td>
                                    @elseif ($item['antrean'] == null)
                                        <td style="text-align: center;"><span class="badge bg-danger">Gagal</span></td>
                                    @else
                                        <td style="text-align: center;"><span class="badge bg-success">Berhasil</span></td>
                                    @endif
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
</div>