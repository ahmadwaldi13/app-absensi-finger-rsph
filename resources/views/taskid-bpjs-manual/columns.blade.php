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
                <table class="table border table-striped table-responsive">
                    <thead>
                        <tr>
                            <th class="py-3">No</th>
                            <th class="py-3">No.RM</th>
                            <th class="py-3">Kode Booking</th>
                            <th class="py-3">Nama Pasien</th>
                            <th class="py-3">Poliklinik</th>
                            <th class="py-3">Dokter</th>
                            <th class="py-3">No.Rujukan</th>
                            <th class="py-3">Status</th>
                            <th class="py-3" style="text-align: center">Aksi Jkn</th>
                            <th class="py-3" style="text-align: center">Aksi</th>
                            <th class="py-3" style="text-align: center">All</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            @foreach($list_data as $key => $item)
                                <?php 
                                    if ($item["nobooking"] == null) {
                                        $code = $item["no_rawat"];
                                    } else {
                                        $code = $item["nobooking"];
                                    }
                                    $poliNot = $item['kd_poli'] == 'IGDK' || $item['kd_poli'] == 'FIS' || $item['kd_poli'] == 'FOR' || $item['kd_poli'] == 'HDL';
                                    $taksid = App\Models\ReferensiMobilejknBpjsTaskid::where([['referensi_mobilejkn_bpjs_taskid.no_rawat',$item["no_rawat"]],['referensi_mobilejkn_bpjs_taskid.taskid',1]])->count();
                                ?>
                                <tr>
                                    <td class="py-3">{{ (($list_data->currentPage() * 20) - 20) + $loop->iteration }}.</td>
                                    <td class="py-3">{{ !empty($item["no_rkm_medis"]) ? $item["no_rkm_medis"] : ''  }}</td>
                                    <td class="py-3">{{ !empty($code) ? $code : ''  }}</td>
                                    <td class="py-3">{{ !empty($item["nm_pasien"]) ? $item["nm_pasien"] : ''  }}</td>
                                    <td class="py-3">{{ !empty($item["nm_poli"]) ?  $item["nm_poli"] : ''  }}</td>
                                    <td class="py-3">{{ !empty($item["nm_dokter"]) ? $item["nm_dokter"] : ''  }}</td>
                                    <td class="py-3">{{ !empty($item["no_rujukan"]) ? $item["no_rujukan"] : ''  }}</td>
                                    @if (!empty($item["task_id"][2]['taskid']) == '5')
                                        <td class="py-3 text-success"><b>Selesai dilayani</b></td>
                                    @elseif($poliNot)
                                        <td class="py-3" style="color: chocolate"><b>Pasien {{ $item['nm_poli'] }}</b></td> 
                                    @else
                                        <td class="py-3 text-danger"><b>Belum dilayani</b></td>    
                                    @endif
                                    @if ($poliNot)
                                        <td class="py-3 text-center">-</td>
                                    @else
                                        <td class="py-3">
                                            <a href='#jkn_online' class="btn btn-sm text-white" style="background-color: darkorange;" id='no_sep' data-bs-toggle='modal' data-id="{{ $item['no_peserta'] }}"><i class="fa-solid fa-circle-up"></i> Jkn Online</a>
                                        </td>
                                    @endif
                                    @if ($poliNot)
                                        <td class="py-3 text-center">-</td>
                                    @else
                                        <td style="text-align: center">
                                            @if (!empty($item["task_id"][0]['taskid']) == '3') 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary disabled modal-remote-delete' data-modal-key='{{ $code . '@' . '3' }}' data-confirm-message="Kirim Taskid 3?">3</a> 
                                            @else 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary modal-remote-delete' data-modal-key='{{ $code . '@' . '3' }}' data-confirm-message="Kirim Taskid 3?">3</a> 
                                            @endif
                                            @if (!empty($item["task_id"][1]['taskid']) == '4') 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary disabled modal-remote-delete' data-modal-key='{{ $code . '@' . '4' }}' data-confirm-message="Kirim Taskid 4?">4</a> 
                                            @else 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary modal-remote-delete' data-modal-key='{{ $code . '@' . '4' }}' data-confirm-message="Kirim Taskid 4?">4</a> 
                                            @endif
                                            @if (!empty($item["task_id"][2]['taskid']) == '5') 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary disabled modal-remote-delete' data-modal-key='{{ $code . '@' . '5' }}' data-confirm-message="Kirim Taskid 5?">5</a> 
                                            @else 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary modal-remote-delete' data-modal-key='{{ $code . '@' . '5' }}' data-confirm-message="Kirim Taskid 5?">5</a> 
                                            @endif
                                            @if (!empty($item["task_id"][3]['taskid']) == '6') 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary disabled modal-remote-delete' data-modal-key='{{ $code . '@' . '6' }}' data-confirm-message="Kirim Taskid 6?">6</a> 
                                            @else 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary modal-remote-delete' data-modal-key='{{ $code . '@' . '6' }}' data-confirm-message="Kirim Taskid 6?">6</a> 
                                            @endif
                                            @if (!empty($item["task_id"][4]['taskid']) == '7') 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary disabled modal-remote-delete' data-modal-key='{{ $code . '@' . '7' }}' data-confirm-message="Kirim Taskid 7?">7</a> 
                                            @else 
                                                <a href='taskid-bpjs-manual/kirim' class='btn btn-primary modal-remote-delete' data-modal-key='{{ $code . '@' . '7' }}' data-confirm-message="Kirim Taskid 7?">7</a> 
                                            @endif
                                        </td>
                                    @endif
                                    @if ($poliNot)
                                        <td class="py-3 text-center">-</td>
                                    @else
                                        <td><a href='taskid-bpjs-manual/form_taskid_all' class='btn btn-kecil btn-success modal-remote modal-edit' data-modal-row="{{ $key }}" data-modal-key='{{ $code. '@' . $item["no_rkm_medis"] }}' data-modal-title='Update TaskID BPJS'><i class="fa-solid fa-bolt"></i></a></td>
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

<!-- Modal JKN Online -->
<div class="modal fade bs-example-modal-lg" id="jkn_online" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-4" id="modalListMonitorLabel">Insert Bridging JKN Online BPJS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('taskid-bpjs-manual/insert') }}">
                @csrf
                <input type="hidden" value="{{ date('Y-m-d') }}" id="dateSep">
                <div class="modal-body">
                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-6">
                            <label for="jkn_noKartu" class="form-label">No. Peserta</label>
                            <input type="text" class="form-control" name="jkn_noKartu" id="jkn_noKartu" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label for="jkn_nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" name="jkn_nik" id="jkn_nik" readonly>        
                        </div>
                    </div>
                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-6">
                            <label for="jkn_norm" class="form-label">No.RM</label>
                            <input type="text" class="form-control" name="jkn_norm" id="jkn_norm" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label for="jkn_hp" class="form-label">No. Telp</label>
                            <input type="text" class="form-control" name="jkn_hp" id="jkn_hp" readonly>        
                        </div>
                    </div>
                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-6">
                            <label for="jkn_nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="jkn_nama" id="jkn_nama" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label for="skdp_diagnosa" class="form-label">Jenis Pasien <span class="text-danger">*</span></label>
                            <select class='form-control form-select' name="jkn_jenispasien" required>
                                <option value="JKN">JKN</option>
                                <option value="NON JKN">NON JKN</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-6">
                            <label for="skdp_tgl_surat" class="form-label">Rujukan <span class="text-danger">*</span></label>
                            <select name="jkn_jeniskunjungan" id="jkn_jeniskunjungan" class="form-control form-select">
                                <option value="">Pilih Asal Rujukan</option>
                                <option value="1">Rujukan FKTP</option>
                                <option value="4">Rujukan Antar RS</option>
                                <option value="3">Kontrol</option>
                                <option value="2">Rujukan Internal</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="jkn_no_referensi" class="form-label">Nomor Rujukan <span class="text-danger">*</span></label>
                            <select name="jkn_no_referensi" id="jkn_no_referensi" class="jkn_no_referensi form-control form-select">
                                <option value="0">No Referensi / Rujukan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-start align-items-end mb-3">
                        <div class="col-lg-6">
                            <label for="jkn_kodepoli" class="form-label">Poliklinik <span class="text-danger">*</span></label>
                            <select class="jkn_kodepoli form-control" name="jkn_kodepoli" id="jkn_kodepoli">
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="skdp_tgl_kontrol" class="form-label">Dokter DPJP <span class="text-danger">*</span></label>
                            <select name="jkn_dpjp" id="jkn_dpjp" class="jkn_dpjp form-select">
                                <option value="0">Pilih DPJP</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" closeListMonitorLabel btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>
</div>