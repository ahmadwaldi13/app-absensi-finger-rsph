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
        background-color: #79fb96;
    }

    .absensi_red{
        background-color: #f39791;
    }

    .absensi_gray{
        background-color: #e6e6e6;
    }

    .absensi_green_color{
        color: #039c04;
    }

    .absensi_red_color{
        color: #ff1000;
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

                            <div class="col-lg-2 col-md-10">
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

                            <div class="col-lg-2 col-md-10">
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
                <table class="table border table-responsive-tablet">
                    <thead>
                        <tr>
                            <th class="py-3" style="width: 10%">Tanggal</th>
                            <th class="py-3" style="width: 10%">Nama</th>
                            <th class="py-3" style="width: 10%">Bidang/Ruangan</th>
                            <th class="py-3" style="width: 10%">Jabatan</th>
                            <th class="py-3" style="width: 70%">Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list_data))
                            <?php
                                $no_item_collapse=0;
                            ?>
                            @foreach($list_data as $key_tgl => $item_tgl)
                                <?php
                                    $item_tgl=(object)$item_tgl;
                                    $tanggal=(new \App\Http\Traits\GlobalFunction)->set_format_tanggal($item_tgl->tgl);
                                    $tanggal=!empty($tanggal->tanggal) ? $tanggal->tanggal : '';

                                    
                                ?>
                                @if(!empty($item_tgl->data))
                                    @foreach($item_tgl->data as $key => $data)
                                        <?php
                                            $data=(object)$data;
                                            $data_karyawan=!empty($data->data_karyawan) ? $data->data_karyawan : '';
                                            $data_jadwal=!empty($data->data_jadwal) ? $data->data_jadwal : [];
                                            $jml_jadwal=count($data_jadwal);
                                            if($jml_jadwal<=0){
                                                $jml_jadwal=1;
                                            }
                                            $max_width_jadwal=100;
                                            $col_width_jadwal=round($max_width_jadwal/$jml_jadwal);
                                            $col_width_jadwal_akhir=$max_width_jadwal-($col_width_jadwal*($jml_jadwal-1));
                                            $data_absensi=!empty($data->absensi) ? $data->absensi : [];
                                            $jml_j=0;

                                            $btn_item_collapse="btn-collapse-data-".($no_item_collapse++);
                                        ?>
                                        <tr>
                                            <td style='width:10%; vertical-align: middle;'>{{ $tanggal  }}</td>
                                            <td style='width:10%; vertical-align: middle;'>{{ !empty($data_karyawan->nm_karyawan) ? $data_karyawan->nm_karyawan : '' }}</td>
                                            <td style='width:10%; vertical-align: middle;'>
                                                <div>{{ !empty($data_karyawan->nm_departemen) ? $data_karyawan->nm_departemen : '' }}</div>
                                                <div><hr style='margin:0px;'></div>
                                                <div>{{ !empty($data_karyawan->nm_ruangan) ? $data_karyawan->nm_ruangan : '' }}</div>
                                            </td>
                                            <td style='width:10%; vertical-align: middle;'>{{ !empty($data_karyawan->nm_jabatan) ? $data_karyawan->nm_jabatan : '' }}</td>
                                            <td style='width:10%; vertical-align: middle;'>
                                                <table class="table table-responsive-tablet" style='width:100%'>
                                                    <tbody>
                                                        <tr>
                                                            @foreach($data_jadwal as $key_jadwal => $list_jadwal)
                                                                <?php
                                                                    $jml_j++;
                                                                    $width_td='width:';
                                                                    if($jml_j==$jml_jadwal){
                                                                        $width_td.=$col_width_jadwal_akhir.'%;';
                                                                    }else{
                                                                        $width_td.=$col_width_jadwal.'%;';
                                                                    }

                                                                    $hasil_jadwal='-';
                                                                    $style_absensi='absensi_gray';
                                                                    if(!empty($data_absensi[$key_jadwal])){
                                                                        $val_absensi=$data_absensi[$key_jadwal];
                                                                        $selisih_waktu_list=!empty($val_absensi->selisih_waktu) ? (object)$val_absensi->selisih_waktu : '';

                                                                        $selisih_waktu='';
                                                                        if($val_absensi->hasil_status_absensi==1){
                                                                            $style_absensi='absensi_green';
                                                                        }elseif($val_absensi->hasil_status_absensi==2){
                                                                            $style_absensi='absensi_red';
                                                                        }

                                                                        $selisih_waktu.=$selisih_waktu_list->jam.' jam, ';
                                                                        $selisih_waktu.=$selisih_waktu_list->menit.' menit, ';
                                                                        $selisih_waktu.=$selisih_waktu_list->detik.' detik';

                                                                        $hasil_jadwal=$selisih_waktu;
                                                                    }
                                                                ?>
                                                                <td style='{!! $width_td !!}'>
                                                                    <div class='absensi_style {!! $style_absensi !!}'>
                                                                        <div>{{ !empty($list_jadwal->uraian) ? $list_jadwal->uraian : '' }}</div>
                                                                        <div>{{ $hasil_jadwal }}</div>
                                                                    </div>
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td colspan="{{ $jml_jadwal }}" style="width: 15%; vertical-align: middle;">
                                                                <div>
                                                                    <a class="btn btn-info btn-sm collapse-cus" style='color:#fff' data-bs-toggle="collapse" href="#{{ $btn_item_collapse }}" role="button" aria-expanded="false" aria-controls="{{ $btn_item_collapse }}">
                                                                        <span id='collapse-open'><i class="fa-solid fa-angles-down"></i> Tampil Detail</span>
                                                                        <span id='collapse-closed'><i class="fa-solid fa-angles-up"></i> Tutup Detail</span>
                                                                    </a>
                                                                </div>

                                                                <div class="collapse mb-2" id="{{ $btn_item_collapse }}">
                                                                    <div class='card'>
                                                                        <div class='card-body'>
                                                                            <div style="overflow-x: auto; max-width: auto;">
                                                                                <table class="table table-bordered table-responsive-tablet">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan='2' style="vertical-align: middle; text-align: center; font-size: 25px; font-weight: 700;">Jadwal</td>
                                                                                        </tr>
                                                                                        @foreach($data_jadwal as $key_jadwal => $list_jadwal)
                                                                                            <tr style='background: #ebebeb;'>
                                                                                                <td style="width: 20%; vertical-align: middle;">{{ !empty($list_jadwal->uraian) ? $list_jadwal->uraian : '' }}</td>
                                                                                                <td style="width: 80%; vertical-align: middle;">{{ !empty($list_jadwal->jam_awal) ? $list_jadwal->jam_awal : '' }} s/d {{ !empty($list_jadwal->jam_akhir) ? $list_jadwal->jam_akhir : '' }}</td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                        <tr>
                                                                                            <td colspan='2'><hr></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='2' style="vertical-align: middle; text-align: center; font-size: 25px; font-weight: 700;">Absensi</td>
                                                                                        </tr>
                                                                                        @foreach($data_jadwal as $key_jadwal => $list_jadwal)
                                                                                            <tr style='background: #d2fffb;'>
                                                                                                <td colspan='2' style="vertical-align: middle; font-size: 20px;">{{ !empty($list_jadwal->uraian) ? $list_jadwal->uraian : '' }}</td>
                                                                                            </tr>
                                                                                            <tr style='background: #d2fffb;'>
                                                                                                <td colspan=2 style='padding:5px;'>
                                                                                                    <table class="table table-responsive-tablet" style='width:100%'>
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th class="py-3" style="width: 10%; padding:5px; font-size:18px;">Mesin</th>
                                                                                                                <th class="py-3" style="width: 10%; padding:5px; font-size:18px;">Waktu Absensi</th>
                                                                                                                <th class="py-3" style="width: 10%; padding:5px; font-size:18px;">Status</th>
                                                                                                                <th class="py-3" style="width: 10%; padding:5px; font-size:18px;">Cara Absen</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <?php
                                                                                                                $color='';
                                                                                                                $data_detail=[];
                                                                                                                $cara_absen='';
                                                                                                                if(!empty($data_absensi[$key_jadwal])){

                                                                                                                    $data_detail=$data_absensi[$key_jadwal];

                                                                                                                    if($data_detail->verified_mesin==1){
                                                                                                                        $cara_absen='Finger';
                                                                                                                    }

                                                                                                                    if($data_detail->verified_mesin==3){
                                                                                                                        $cara_absen='Password';
                                                                                                                    }

                                                                                                                    if($data_detail->hasil_status_absensi==1){
                                                                                                                        $color='absensi_green_color';
                                                                                                                    }
                                                                                                                    if($data_detail->hasil_status_absensi==2){
                                                                                                                        $color='absensi_red_color';
                                                                                                                    }
                                                                                                                    if($data_detail->hasil_status_absensi==3){
                                                                                                                        $color='absensi_gray_color';
                                                                                                                    }
                                                                                                                }
                                                                                                            ?>
                                                                                                            <tr>
                                                                                                                <td style='padding:5px;'>
                                                                                                                    <div>{{ !empty($data_detail->nm_mesin) ? $data_detail->nm_mesin : '-' }}</div>
                                                                                                                    <div><hr style='margin:0px;'></div>
                                                                                                                    <div>{{ !empty($data_detail->lokasi_mesin) ? $data_detail->lokasi_mesin : '-' }}</div>
                                                                                                                </td>
                                                                                                                <td style='padding:5px;'>{{ !empty($data_detail->jam_absensi) ? $data_detail->jam_absensi : '-' }}</td>
                                                                                                                <td class='{{ $color }}' style='padding:5px;font-weight:700;'>{{ !empty($data_detail->hasil_status_absensi_text) ? $data_detail->hasil_status_absensi_text : '-' }}</td>
                                                                                                                <td style='padding:5px;'>{{ !empty($cara_absen) ? $cara_absen : '' }}</td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
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