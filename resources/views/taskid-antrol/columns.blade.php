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
                            <label for="tanggal_pengajuan" class="form-label">Tanggal</label>
                            <span class='icon-bagan-date'></span>
                            <input type="text" class="form-control input-date-range" id="tanggal_pengajuan" placeholder="Tanggal">
                            <input type="hidden" id="tgl_start" name="form_filter_date_start" value="{{ Request::get('form_filter_date_start') }}">
                            <input type="hidden" id="tgl_end" name="form_filter_date_end" value="{{ Request::get('form_filter_date_end') }}">
                        </div>
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
                    
                    <div class="col-lg-3 col-md-10">
                        <label for="filter_search" class="form-label">Pencarian Dengan Keyword</label>
                        <input type="text" class="form-control" name='filter_search' value="{{ Request::get('filter_search') }}" id='filter_search' placeholder="Masukkan Kata">
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
                            <th class="py-3" style="width: 5%">No. Rawat</th>
                            <th class="py-3" style="width: 5%">No. RM</th>
                            <th class="py-3" style="width: 10%">Nama Pasien</th>
                            <th class="py-3" style="width: 12%">Nama Poli</th>
                            <th class="py-3" style="width: 12%">Waktu</th>
                            <th class="py-3" style="width: 12%">Waktu RS</th>
                            <th class="py-3" style="width: 20%">Task Name</th>
                            <th class="py-3" style="width: 5%">Task Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                @if ($item->kd_poli !== 'IGDK')
                                    @foreach ($item["taskidbpjs"] as $iron => $value)
                                        <tr>
                                            <td>{{ !empty($item["no_rawat"]) ? $item["no_rawat"] : ''  }}</td>
                                            <td>{{ !empty($item["no_rkm_medis"]) ? $item["no_rkm_medis"] : ''  }}</td>
                                            <td>{{ !empty($item["nm_pasien"]) ? $item["nm_pasien"] : ''  }}</td>
                                            <td>{{ !empty($item["nm_poli"]) ? $item["nm_poli"] : ''  }}</td>
                                            <td>{{ !empty($item["taskidbpjs"][$iron]['waktu']) ? $item["taskidbpjs"][$iron]['waktu'] : '' }}</td>
                                            <td>{{ !empty($item["taskidbpjs"][$iron]['wakturs']) ? $item["taskidbpjs"][$iron]['wakturs'] : '' }}</td>
                                            <td>{{ !empty($item["taskidbpjs"][$iron]['taskname']) ? $item["taskidbpjs"][$iron]['taskname'] : '' }}</td>
                                            <?php   
                                                $taskid_bpjs = !empty($item["taskidbpjs"][$iron]['taskid']) ? $item["taskidbpjs"][$iron]['taskid'] : ''; 
                                            ?>
                                                @if($taskid_bpjs == 1)
                                                    <td style="text-align: center;"><span class="badge" style="background-color: darkorange">{{ $taskid_bpjs }}</span></td>
                                                @elseif($taskid_bpjs == 2)
                                                    <td style="text-align: center;"><span class="badge bg-secondary">{{ $taskid_bpjs }}</span></td>
                                                @elseif($taskid_bpjs == 3)
                                                    <td style="text-align: center;"><span class="badge bg-primary">{{ $taskid_bpjs }}</span></td>
                                                @elseif($taskid_bpjs == 4)
                                                    <td style="text-align: center;"><span class="badge" style="background-color: blueviolet">{{ $taskid_bpjs }}</span></td>
                                                @elseif($taskid_bpjs == 5)
                                                    <td style="text-align: center;"><span class="badge bg-success">{{ $taskid_bpjs }}</span></td>
                                                @elseif($taskid_bpjs == 6)
                                                    <td style="text-align: center;"><span class="badge" style="background-color: palevioletred">{{ $taskid_bpjs }}</span></td>
                                                @elseif($taskid_bpjs == 7)
                                                    <td style="text-align: center;"><span class="badge" style="background-color: navy">{{ $taskid_bpjs }}</span></td>
                                                @else
                                                    <td style="text-align: center;"><span class="badge bg-danger">{{ $taskid_bpjs }}</span></td>
                                                @endif
                                        </tr>
                                    @endforeach
                                @endif
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