<?php 
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
?>
<hr>
<div>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-3 col-md-10">
                        <div class='input-date-range-bagan'>
                            <label for="tanggal_antrian" class="form-label">Periode Waktu</label>
                            <span class='icon-bagan-date'></span>
                            <input type="text" class="form-control input-date-range" id="tanggal_antrian" placeholder="Tanggal">
                            <input type="hidden" id="tgl_start" name="form_filter_date_start" value="{{ Request::get('form_filter_date_start') }}">
                            <input type="hidden" id="tgl_end" name="form_filter_date_end" value="{{ Request::get('form_filter_date_end') }}">
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control" name='form_filter_text' value="{{ Request::get('form_filter_text') }}" id='filter_search_text' placeholder="Masukkan Kata">
                    </div>

                    <div class="col-lg-3 col-md-10">
                        <div class='bagan_form'>
                            <label for="filter_nm_poli" class="form-label">Pilih Poliklinik</label>
                            <div class="button-icon-inside">
                                <input type="text" class="input-text" id='filter_nm_poli' readonly name="filter_nm_poli" value="{{ Request::get('filter_nm_poli') }}" />
                                <input type="hidden" id="filter_kd_poli" name="filter_kd_poli" value="{{ Request::get('filter_kd_poli') }}" />
                                <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_poliklinik') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Pilih Poliklinik' data-modal-width='50%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_nm_poli|#filter_kd_poli@data-key-bagan=0@data-btn-close=#closeModalData">
                                    <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                </span>
                                <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                            </div>
                            <div class="message"></div>
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
                <table class="table border table-responsive-tablet table-striped" id="tableRawatJalan">
                    <thead>
                        <tr>
                            <th class="py-3">No</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3">No.Reg</th>
                            <th class="py-3">No.Rawat</th>
                            <th class="py-3">Nama Pasien</th>
                            <th class="py-3">Poli</th>
                            <th class="py-3">Dokter di tuju</th>
                            <th class="py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                <?php
                                    $paramater_url=[
                                        'data_sent'=>$item['no_rawat']
                                    ];
                                ?>
                                <tr>
                                    <td class="py-3">{{ (($list_data->currentPage() * 20) - 20) + $loop->iteration }}.</td>
                                    <td class="py-3">{{ $item["tgl_registrasi"] }}</td>
                                    <td class="py-3">{{ $item["no_reg"] }}
                                    </td>
                                    <td class="py-3"><span class="badge bg-primary">{{ $item["no_rkm_medis"] }}</span> <span class="badge" style="background-color: darkorange">{{ $item["no_rawat"] }}</span></td>
                                    <td class="py-3">{{ $item["nm_pasien"] }}</td>
                                    <td class="py-3">{{ $item["nm_poli"] }}</td>
                                    <td class="py-3">({{ $item["kd_dokter"] }}) {{$item["nm_dokter"]}}</td>
                                    <td class="py-3 pe-4">
                                        @if ($item->tindakan_pasien_perawat == 1)
                                            <button type="button" name="delete" class="btn btn-danger buttonModalListMonitor" onclick='ListMonitor(<?=json_encode($item)?>)'><i class="fa-solid fa-volume-xmark"></i> mute</button>
                                        @elseif($item->tindakan_pasien_perawat == 0)
                                            <button type="button" class="btn btn-primary buttonModalListMonitor" onclick='ListMonitor(<?=json_encode($item)?>)'><i class="fa-solid fa-microphone"></i> Panggil</button>
                                        @endif
                                            <a href='antrian-poliklinik-petugas/update' class='btn btn-success modal-remote-delete' data-modal-key='{{ $item["no_rawat"] }}' data-confirm-message="Terima Berkas pasien? dan langsung diperiksa petugas"><i class="fa-solid fa-check"></i> Hadir</a>
                                    </td>
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

 <!-- Modal List Monitor -->
 <div class="modal fade " id="modalListMonitor" tabindex="-1" aria-labelledby="modalListMonitorLabel" aria-hidden="true">
    <div class="modal-dialog">
    @csrf
    <?php 
        $kode=!empty($model->no_rawat) ? $model->no_rawat : '';
    ?>
    
    <input type="hidden" name="key_old" value="{{ $kode }}">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-4" id="modalListMonitorLabel">Panggil/mute Pasien Ini?</h5>
                <button type="button" class="btn-close closeListMonitorLabel" ></button>
            </div>
            <div class="modal-body text-center">
                <table class="table border ">
                    <thead>
                        <tr>
                            <th span="2" class="py-4">No Rawat</th>
                            <th span="2"  class="py-4">Nama Pasien</th>
                            <th span="2"  class="py-4">Poli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="list-nrwt" class="py-3"></td>
                            <td id="list-nm" class="py-3"></td>
                            <td id="list-np" class="py-3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class=" closeListMonitorLabel btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="submitListMonitor" class="btn btn-primary">Ya</button>
            </div>
        </div>
    </div>
</div>
