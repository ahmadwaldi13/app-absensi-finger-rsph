<style>
    .label_status_ab_yes,.label_status_ab_no{
        padding:5px;
        color:444;
    }

    .label_status_ab_yes{
        background-color:#00ff71 ;
    }

    .label_status_ab_no{
        background-color:#ec051e ;
        color:#fff ;
    }

    .label_status_ab_unow{
        background-color:#716f6f17 ;
    }

    .absensi_style{
        padding:10px;
        border-radius:5px;
    }

    .absensi_green{
        background-color: #79fb96 !important;
    }

    .absensi_red{
        background-color: #f39791 !important;
    }

    .absensi_yellow{
        background-color: #f7d44e !important;
    }

    .absensi_gray{
        background-color: #e6e6e6 !important;
    }

    .absensi_green_color{
        color: #039c04;
    }

    .absensi_red_color{
        color: #ff1000;
    }

    .absensi_yellow_color{
        color: #eebd02;
    }

    .absensi_gray_color{
        color: #e6e6e6;
    }
</style>
<hr style="margin-top:0px">
<div>
    <div class="row d-flex justify-content-between">
        <div>
            <form action="" method="GET">
                <input type="hidden" id="filter_id_mesin" name="filter_id_mesin" value="{{ Request::get('filter_id_mesin') }}" />

                <div class="row justify-content-start align-items-end mb-3">
                    <div class="col-lg-12 col-md-12">
                        <div class="row justify-content-start align-items-end mb-3">

                            <div class="col-lg-3 col-md-10">
                                <div class='input-date-range-bagan'>
                                    <label for="tanggal_data" class="form-label">Tanggal</label>
                                    <span class='icon-bagan-date'></span>
                                    <input type="text" class="form-control input-date-range" id="tanggal_data" placeholder="Tanggal">
                                    <input type="hidden" id="tgl_start" name="filter_date_start" value="{{ Request::get('filter_date_start') }}">
                                    <input type="hidden" id="tgl_end" name="filter_date_end" value="{{ Request::get('filter_date_end') }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-10">
                                <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                                <input type="text" class="form-control" name='form_filter_text' value="{{ Request::get('form_filter_text') }}" id='filter_search_text' placeholder="Masukkan Kata">
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="row justify-content-start align-items-end mb-3">

                            <div class="col-lg-5 col-md-10">
                                <div class='bagan_form'>
                                    <label for="filter_nm_jabatan" class="form-label">Jabatan </label>
                                    <div class="button-icon-inside">
                                        <input type="text" class="input-text" id='filter_nm_jabatan' name="filter_nm_jabatan" readonly value="{{ Request::get('filter_nm_jabatan') }}" />
                                        <input type="hidden" id="filter_id_jabatan" name='filter_id_jabatan' readonly required value="{{ Request::get('filter_id_jabatan') }}">
                                        <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_jabatan') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jabatan' data-modal-width='30%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_id_jabatan|#filter_nm_jabatan@data-key-bagan=0@data-btn-close=#closeModalData">
                                            <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                        </span>
                                        <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                                    </div>
                                    <div class="message"></div>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-10">
                                <div class='bagan_form'>
                                    <label for="filter_nm_departemen" class="form-label">Departemen </label>
                                    <div class="button-icon-inside">
                                        <input type="text" class="input-text" id='filter_nm_departemen' name="filter_nm_departemen" readonly value="{{ Request::get('filter_nm_departemen') }}" />
                                        <input type="hidden" id="filter_id_departemen" name='filter_id_departemen' readonly required value="{{ Request::get('filter_id_departemen') }}">
                                        <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=get_list_departemen') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Departemen' data-modal-width='30%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#filter_id_departemen|#filter_nm_departemen@data-key-bagan=0@data-btn-close=#closeModalData">
                                            <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                        </span>
                                        <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                                    </div>
                                    <div class="message"></div>
                                </div>
                            </div>

                            {{--
                            <div class="col-lg-2 col-md-10">
                                <div class='bagan_form'>
                                    <label for="filter_status_absensi" class="form-label">Status Absensi : </label>
                                    <select class="form-select" id="filter_status_absensi" name="filter_status_absensi"  aria-label="Default select ">
                                        <option value=""  {{ (Request::get('filter_status_absensi')=='') ? 'selected' : '' }}>Semua</option>
                                        <option value="1" {{ (Request::get('filter_status_absensi')=='1') ? 'selected' : '' }}>Tepat Waktu</option>
                                        <option value="2" {{ (Request::get('filter_status_absensi')=='2') ? 'selected' : '' }}>Terlambat</option>
                                    </select>
                                    <div class="message"></div>
                                </div>
                            </div>
                            --}}

                            {{--
                            <div class="col-lg-2 col-md-10">
                                <div class='bagan_form'>
                                    <label for="filter_cara_absensi" class="form-label">Cara Absen : </label>
                                    <select class="form-select" id="filter_cara_absensi" name="filter_cara_absensi"  aria-label="Default select ">
                                        <option value=""  {{ (Request::get('filter_cara_absensi')=='') ? 'selected' : '' }}>Semua</option>
                                        <option value="1" {{ (Request::get('filter_cara_absensi')=='1') ? 'selected' : '' }}>Finger</option>
                                        <option value="3" {{ (Request::get('filter_cara_absensi')=='3') ? 'selected' : '' }}>Password</option>
                                    </select>
                                    <div class="message"></div>
                                </div>
                            </div>
                            --}}
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-1">
                        <div class="d-grid grap-2">
                            <button type="submit" name='searchbydb' class="btn btn-primary" value=1>
                                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div style="overflow-x: auto; max-width: auto;">
                <table class="table table-bordered-bottom table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 10%">Tanggal</th>
                            <th class="py-3" style="width: 20%">Nama</th>
                            <th class="py-3" style="width: 10%">Bidang/Ruangan</th>
                            <th class="py-3" style="width: 5%">Jabatan</th>
                            <th class="py-3" style="width: 15%">Log Absensi</th>
                            <th class="py-3" style="width: 25%">Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            <?php
                                $no_item_collapse=0;
                            ?>
                            @foreach($list_data as $key => $item)
                                <?php
                                    $tgl_user_presensi=(new \App\Http\Traits\GlobalFunction)->set_format_tanggal($item->tgl_presensi);
                                    $tgl_user_presensi=!empty($tgl_user_presensi->tanggal) ? $tgl_user_presensi->tanggal : '';

                                    $pre_tmp=!empty($item->presensi) ? $item->presensi : '';
                                    $set_presensi=(new \App\Http\Traits\AbsensiFunction)->set_list_log_text($pre_tmp,3);

                                    $item_kerja=(object)$item->status_nilai_kerja;
                                    $get_data_waktu_kerja=!empty($item_kerja->jadwal_kerja) ? $item_kerja->jadwal_kerja : '';
                                    $get_total_kerja=!empty($get_data_waktu_kerja->total_kerja) ? $get_data_waktu_kerja->total_kerja : '00:00:00';
                                    $get_total_kerja_text=(new \App\Http\Traits\AbsensiFunction)->set_format_waktu_indo($get_total_kerja);
                                    $get_total_kerja_sec=!empty($get_data_waktu_kerja->total_kerja_sec) ? $get_data_waktu_kerja->total_kerja_sec : '';
                                    
                                    $get_data_user_presensi=!empty($item_kerja->hasil_hitung_kerja) ? $item_kerja->hasil_hitung_kerja : '';
                                    $get_total_kerja_user=!empty($get_data_user_presensi->total_kerja) ? $get_data_user_presensi->total_kerja : '00:00:00';
                                    $get_total_kerja_user_text=(new \App\Http\Traits\AbsensiFunction)->set_format_waktu_indo($get_total_kerja_user);
                                    $get_total_kerja_user_sec=(new \App\Http\Traits\AbsensiFunction)->his_to_seconds($get_total_kerja_user);
                                    
                                    $get_status_kerja_user=!empty($get_data_user_presensi->status_kerja_text) ? $get_data_user_presensi->status_kerja_text : '';
                                    $get_status_kerja_user_alias=!empty($get_status_kerja_user->alias) ? $get_status_kerja_user->alias : '';
                                    $get_status_kerja_user_alias_class='';
                                    if($get_status_kerja_user_alias=='A'){
                                        $get_status_kerja_user_alias_class='absensi_red';
                                    }

                                    $selisih_kurang_kerja_sec=$get_total_kerja_sec-$get_total_kerja_user_sec;
                                    $selisih_kurang_kerja_text='';
                                    if($selisih_kurang_kerja_sec>0){
                                        $selisih_kurang_kerja_text=(new \App\Http\Traits\AbsensiFunction)->set_format_waktu_indo(gmdate("H:i:s", $selisih_kurang_kerja_sec));
                                    }
                                    
                                ?>
                                <tr>
                                    <td style='vertical-align: middle;'>{{ $tgl_user_presensi }}</td>
                                    <td style='vertical-align: middle;'>{{ !empty($item->nm_karyawan) ? $item->nm_karyawan : '' }}</td>
                                    <td style='vertical-align: middle;'>
                                        <div>{{ !empty($item->nm_departemen) ? $item->nm_departemen : '' }}</div>
                                        <div><hr style='margin:0px;'></div>
                                        <div>{{ !empty($item->nm_ruangan) ? $item->nm_ruangan : '' }}</div>
                                    </td>
                                    <td style='vertical-align: middle;'>{{ !empty($item->nm_jabatan) ? $item->nm_jabatan : '' }}</td>
                                    <td style='vertical-align: middle;'>
                                        {!! $set_presensi !!}
                                    </td>
                                    <td style='vertical-align: middle;'>
                                        @if($item_kerja)
                                            <?php

                                                $jadwal_open_mesin=!empty($item_kerja->jadwal_open_mesin) ? $item_kerja->jadwal_open_mesin : [];

                                                $style_max_tbl_jadwal=100;
                                                $jml_open_jadwal=count($jadwal_open_mesin);
                                                if($jml_open_jadwal<=0){
                                                    $jml_open_jadwal=1;
                                                }

                                                $col_width_tbl_jadwal=round($style_max_tbl_jadwal/$jml_open_jadwal);
                                                $col_width_tbl_jadwal_akhir=$style_max_tbl_jadwal-($col_width_tbl_jadwal*($jml_open_jadwal-1));

                                                $jml_loop_tbl_jadwal=0;

                                                $btn_item_collapse="btn-collapse-data-".($no_item_collapse++);

                                            ?>
                                            @if($jadwal_open_mesin)
                                                <table class="table table-no-bordered table-responsive-tablet" style='width:100%'>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan={{ $jml_open_jadwal }} style='vertical-align: middle;' class="{{ $get_status_kerja_user_alias_class }}" >
                                                                <div>
                                                                    <div>Total Kerja :</div> 
                                                                    <div>{{ $get_total_kerja_user_text }}</div> 
                                                                </div>
                                                                <hr style='margin:2px 0px'>
                                                                <div>
                                                                    <div>Kekurangan :</div> 
                                                                    <div>{{ $selisih_kurang_kerja_text }}</div> 
                                                                </div>
                                                                <hr style='margin:2px 0px'>
                                                                <div>( {{ $get_status_kerja_user_alias }} ) {{ !empty($get_status_kerja_user->text) ? $get_status_kerja_user->text : '' }}</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            @foreach($jadwal_open_mesin as $key_oj => $val_oj)
                                                            <?php
                                                                $jml_loop_tbl_jadwal++;
                                                                $width_td_tbl='width:';
                                                                if($jml_loop_tbl_jadwal==$jml_open_jadwal){
                                                                    $width_td_tbl.=$col_width_tbl_jadwal_akhir.'%;';
                                                                }else{
                                                                    $width_td_tbl.=$col_width_tbl_jadwal.'%;';
                                                                }

                                                                $style_absensi='absensi_gray';

                                                                $get_data_user_presensi=!empty($val_oj->user_presensi) ? (object)$val_oj->user_presensi : [];
                                                                $check_type_waktu=!empty($get_data_user_presensi->type_waktu) ? $get_data_user_presensi->type_waktu : '';

                                                                if($check_type_waktu=='h'){
                                                                    $style_absensi='absensi_green';
                                                                }elseif($check_type_waktu=='-'){
                                                                    $style_absensi='absensi_yellow';
                                                                }elseif($check_type_waktu=='+'){
                                                                    $style_absensi='absensi_red';
                                                                }elseif($check_type_waktu=='a'){
                                                                    $style_absensi='absensi_gray';
                                                                }
                                                            ?>
                                                                <td style='{!! $width_td_tbl !!}'>
                                                                    <div class='absensi_style {!! $style_absensi !!}'>
                                                                        <div>{{ !empty($val_oj->uraian) ? $val_oj->uraian : '' }}</div>
                                                                        <div></div>
                                                                    </div>
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td colspan={{ $jml_open_jadwal }} style="width: 15%; vertical-align: middle;" >
                                                                <div>
                                                                    <a class="btn btn-info btn-sm collapse-cus" style='color:#fff' data-bs-toggle="collapse" href="#{{ $btn_item_collapse }}" role="button" aria-expanded="false" aria-controls="{{ $btn_item_collapse }}">
                                                                        <span id='collapse-open'><i class="fa-solid fa-angles-down"></i> Tampil Detail</span>
                                                                        <span id='collapse-closed'><i class="fa-solid fa-angles-up"></i> Tutup Detail</span>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr style='padding:0px;'>
                                    <td colspan=20 style='padding:0px;'>
                                        <div class="collapse mb-2" id="{{ $btn_item_collapse }}">
                                            <?php
                                                $jam_kerja=!empty($item_kerja->jadwal_kerja) ? $item_kerja->jadwal_kerja : [];
                                                $jadwal_open_mesin=!empty($item_kerja->jadwal_open_mesin) ? $item_kerja->jadwal_open_mesin : [];

                                                $total_kerja_sec=!empty($jam_kerja->total_kerja_sec) ? $jam_kerja->total_kerja_sec : 0;
                                                $total_kerja=(new \App\Http\Traits\AbsensiFunction)->hitung_waktu_by_seccond($total_kerja_sec);
                                                $total_kerja_text='';
                                                $total_kerja_text.=(!empty($total_kerja->jam) ? $total_kerja->jam : 0).' Jam ';
                                                $total_kerja_text.=(!empty($total_kerja->menit) ? $total_kerja->menit : 0).' Menit ';
                                                $total_kerja_text.=(!empty($total_kerja->detik) ? $total_kerja->detik : 0).' Detik ';
                                            ?>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-md-12">
                                                            <div class="row d-flex justify-content-between">
                                                                <div class="col-lg-6">
                                                                    <h4 style='margin:0px;'>Jam Kerja</h4>
                                                                    <table class="table table-bordered table-responsive-tablet">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 20%">Mulai Kerja</td>
                                                                                <td style="width: 1%">:</td>
                                                                                <td style="width: 50%">{{ !empty($jam_kerja->masuk_kerja) ? $jam_kerja->masuk_kerja : '00:00:00'  }}</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td style="width: 20%">Istirahat</td>
                                                                                <td style="width: 1%">:</td>
                                                                                <td style="width: 50%">
                                                                                    <span>
                                                                                        {{ !empty($jam_kerja->awal_istirahat) ? $jam_kerja->awal_istirahat : '00:00:00'  }}
                                                                                        s/d
                                                                                        {{ !empty($jam_kerja->akhir_istirahat) ? $jam_kerja->akhir_istirahat : '00:00:00'  }}
                                                                                    </span>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td style="width: 20%">Pulang Kerja</td>
                                                                                <td style="width: 1%">:</td>
                                                                                <td style="width: 50%">{{ !empty($jam_kerja->pulang_kerja) ? $jam_kerja->pulang_kerja : '00:00:00'  }}</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td style="width: 20%">Total Kerja</td>
                                                                                <td style="width: 1%">:</td>
                                                                                <td style="width: 50%">{{ $total_kerja_text }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <h4 style='margin:0px;'>Jam Presensi Mesin</h4>
                                                                    <table class="table table-bordered table-responsive-tablet">
                                                                        <tbody>
                                                                            @if($jadwal_open_mesin)
                                                                                @foreach($jadwal_open_mesin as $key_oj => $val_oj)
                                                                                    <tr>
                                                                                        <td style="width: 20%">{{ !empty($val_oj->uraian) ? $val_oj->uraian : '' }}</td>
                                                                                        <td style="width: 1%">:</td>
                                                                                        <td style="width: 50%">
                                                                                            <span>
                                                                                                {{ !empty($val_oj->jam_awal) ? $val_oj->jam_awal : '00:00:00'  }}
                                                                                                s/d
                                                                                                {{ !empty($val_oj->jam_akhir) ? $val_oj->jam_akhir : '00:00:00'  }}
                                                                                            </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @endif

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @if($jadwal_open_mesin)
                                                            <div class="col-md-12">
                                                                <table class="table table-bordered table-responsive-tablet">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan=2 class="py-3" style="width: 15%">Uraian</th>
                                                                            <th class="py-3" style="width: 20%">Presensi</th>
                                                                            <th class="py-3" style="width: 15%">Status</th>
                                                                            <th class="py-3" style="width: 50%">Ket. Waktu</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($jadwal_open_mesin as $key_oj => $val_oj)
                                                                            <?php 
                                                                                $get_user_presensi=!empty($val_oj->user_presensi) ? (object)$val_oj->user_presensi : '';
                                                                                $type_waktu_presensi=!empty($get_user_presensi->type_waktu) ? $get_user_presensi->type_waktu : '';

                                                                                $style_column_t='absensi_gray';

                                                                                $type_waktu_presensi_text='Alpa';
                                                                                if($type_waktu_presensi=='h'){
                                                                                    $style_column_t='absensi_green';
                                                                                    $type_waktu_presensi_text='Tepat Waktu';
                                                                                }elseif($type_waktu_presensi=='-'){
                                                                                    $style_column_t='absensi_yellow';
                                                                                    $type_waktu_presensi_text='Cepat';
                                                                                }elseif($type_waktu_presensi=='+'){
                                                                                    $style_column_t='absensi_red';
                                                                                    $type_waktu_presensi_text='Telat';
                                                                                }
                                                                                $selisih_waktu=!empty($get_user_presensi->selisih_waktu) ? (object)$get_user_presensi->selisih_waktu : [];
                                                                                $selisih_waktu_text='';
                                                                                $selisih_waktu_text.=(!empty($selisih_waktu->jam) ? $selisih_waktu->jam : 0).' Jam ';
                                                                                $selisih_waktu_text.=(!empty($selisih_waktu->menit) ? $selisih_waktu->menit : 0).' Menit ';
                                                                                $selisih_waktu_text.=(!empty($selisih_waktu->detik) ? $selisih_waktu->detik : 0).' Detik ';
                                                                            ?>
                                                                            <tr class='{{ $style_column_t }}'>
                                                                                <td>{{ !empty($val_oj->uraian) ? $val_oj->uraian : '' }}</td>
                                                                                <td>:</td>
                                                                                <td>{{ !empty($get_user_presensi->user_presensi) ? $get_user_presensi->user_presensi : '00:00:00'  }}</td>
                                                                                <td>{{ $type_waktu_presensi_text  }}</td>
                                                                                <td>{{ $selisih_waktu_text  }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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