<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
 <!-- ===== Tabs bar navigation ===== -->
 <form action="" method="GET">
    <ul class="nav nav-tabs">
        <li class="nav-item border-radius-top text-center button-tabs me-2">
            <a href="{{$current_url}}?&tab=rj"
                class="nav-link border-radius-top tabs text-muted hover-pointer {{ ($tab == '' || $tab == 'rj') ? 'active' :'' }}"
                id="tabs-klinis" aria-current="page">Rawat Jalan</a>
        </li>
        <li class="nav-item border-radius-top text-center button-tabs me-2">
            <a href="{{ $current_url }}?&tab=ri"
                class="nav-link border-radius-top tabs text-muted hover-pointer {{ $tab == 'ri' ? 'active' :'' }}"
                id="tabs-anatomi">Rawat Inap</a>
        </li>
    </ul>
<div class="card border-top-0 px-4 py-5">
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control" name='form_filter_text' value="{{ Request::get('form_filter_text') }}" id='filter_search_text' placeholder="Masukkan Kata">
                    </div>

                    <div class="col-lg-2 col-md-10">
                        <label for="exampleFormControlInput3" class="form-label">Status</label>
                        <select class="form-select input-dropdown" name="penjab" aria-label="Default select example" id="exampleFormControlInput3">
                            <option value="">Semua</option>
                            <option value="">Rugi</option>
                            <option value="">Pass</option>
                            <option value="">Kelebihan Profit</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-10">
                        <div class='input-date-range-bagan'>
                            <label for="tanggal_pengajuan" class="form-label">Tanggal</label>
                            <span class='icon-bagan-date'></span>
                            <input type="text" class="form-control input-date-range" id="tanggal_pengajuan" placeholder="Tanggal">
                            <input type="hidden" id="tgl_start" name="form_filter_date_start" value="{{ Request::get('form_filter_date_start') }}">
                            <input type="hidden" id="tgl_end" name="form_filter_date_end" value="{{ Request::get('form_filter_date_end') }}">
                        </div>
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
                <table class="table table-bordered table-responsive-tablet">
                    <thead class="table-light">
                        <tr>
                            <th colspan="7"></th>
                            <th colspan="17" class="text-center">Detail Tarif RS</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th class="py-3">Nama Pasien</th>
                            <th class="py-3 text-center">Jenis Pembayaran</th>
                            <th class="py-3 text-center">Kelas Rawayat</th>
                            <th class="py-3 text-center">Code</th>
                            <th class="py-3 text-center">Deskripsi</th>
                            <th class="py-3 text-center">Tarif Grouper</th>
                            <th class="py-3 text-center">Tarif RS</th>
                            <th class="py-3 text-center">P Non Bedah</th>
                            <th class="py-3 text-center">P Bedah</th>
                            <th class="py-3 text-center">Konsultasi</th>
                            <th class="py-3 text-center">Tenaga Ahli</th>
                            <th class="py-3 text-center">Keperawatan</th>
                            <th class="py-3 text-center">Penunjang</th>
                            <th class="py-3 text-center">Radiologi</th>
                            <th class="py-3 text-center">Laboratorium</th>
                            <th class="py-3 text-center">Pelayanan darah</th>
                            <th class="py-3 text-center">Rehabilitas</th>
                            <th class="py-3 text-center">Kamar</th>
                            <th class="py-3 text-center">Kamar Intensif</th>
                            <th class="py-3 text-center">Obat</th>
                            <th class="py-3 text-center">Obat Aemoterapi</th>
                            <th class="py-3 text-center">Alkes</th>
                            <th class="py-3 text-center">Bmhp</th>
                            <th class="py-3 text-center">Sewa Alat</th>
                            <th class="py-3 text-center">Status Klaim</th>
                        </tr>
                    </thead>
                    <tbody>
                                <tr>
                                    <td>Baihaqi</td>
                                    <td>Ralan</td>
                                    <td>C00</td>
                                    <td>3</td>
                                    <td>Penyakit Akut kecil lain-lain</td>
                                    <td>Rp,200.000,00</td>
                                    <td>Rp,160.000,00</td>
                                    <td>Rp,60.000,00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,50.000,00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td>Rp,0.00</td>
                                    <td class='text-right'>
                                       sdhbjk
                                    </td>
                                </tr>
                    </tbody>
                </table>
            </div>
            {{-- @if(!empty($list_data))
                <div class="d-flex justify-content-end">
                    {{ $list_data->withQueryString()->onEachSide(0)->links() }}
                </div>
            @endif --}}
        </div>
    </div>
</div>
