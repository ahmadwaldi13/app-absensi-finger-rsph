<?php
    $form_filter_kondisi_waktu=!empty(Request::get('form_filter_kondisi_waktu')) ? Request::get('form_filter_kondisi_waktu') : 1;
    
    $params_json=json_encode(Request::all());
?>

<div class="card border-top-0 px-4 py-4">
    <div>
        <div class="row d-flex justify-content-between">
            <div>
                <form action="" method="GET">
                    <div class="row justify-content-start align-items-end mb-3">

                        <div class="col-lg-6 col-md-10">
                            <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                            <input type="text" class="form-control" name='form_filter_text' value="{{ Request::get('form_filter_text') }}" id='filter_search_text' placeholder="Masukkan Kata">
                        </div>

                        <div class="col-lg-3 col-md-10">
                            <div class='bagan_form'>
                                <label for="form_filter_kamar" class="form-label">Kamar/Ruangan</label>
                                <div class="button-icon-inside">
                                    <input type="text" class="input-text" id='form_filter_kamar' name="form_filter_kamar" value="{{ Request::get('form_filter_kamar') }}" />
                                    <input type="hidden" id="form_filter_kd_kamar" name="form_filter_kd_kamar" value="{{ Request::get('form_filter_kd_kamar') }}" />
                                    <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=kamar_bangsal') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#form_filter_kamar|#form_filter_kd_kamar@data-key-bagan=0@data-btn-close=#closeModalData">
                                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                    </span>
                                    <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                                </div>
                                <div class="message"></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-10">
                            <label for="form_filter_stts_bayar" class="form-label">Berdasarkan Status</label>
                            <select class="form-select input-dropdown" name="form_filter_stts_bayar" id="form_filter_stts_bayar">
                                <option value="">Semua</option>
                                @foreach($get_stts_bayar as $items => $value)
                                    <option {{ (Request::get('form_filter_stts_bayar')==$value) ? 'selected' : '' }} value="{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    
                    </div>
                    
                    <div class="row justify-content-start align-items-end mb-3">    

                    <div class="col-lg-3 col-md-10">
                            <div class='bagan_form'>
                                <label for="form_filter_jb" class="form-label">Jenis Bayar</label>
                                <div class="button-icon-inside">
                                    <input type="text" class="input-text" id='form_filter_jb' name="form_filter_jb" value="{{ Request::get('form_filter_jb') }}" />
                                    <input type="hidden" id="form_filter_kd_jb" name="form_filter_kd_jb" value="{{ Request::get('form_filter_kd_jb') }}" />
                                    <span class="modal-remote-data" data-modal-src="{{ url('ajax?action=data_penjab') }}" data-modal-key="" data-modal-pencarian='true' data-modal-title='Jenis' data-modal-width='40%' data-modal-action-change="function=.set-data-list-from-modal@data-target=#form_filter_jb|#form_filter_kd_jb@data-key-bagan=0@data-btn-close=#closeModalData">
                                        <img class="iconify hover-pointer text-primary" src="{{ asset('') }}icon/selected.png" alt="">
                                    </span>
                                    <a href="#" id='reset_input'><i class="fa-solid fa-square-xmark"></i></a>
                                </div>
                                <div class="message"></div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-10">
                            <div class="row d-flex align-items-end">
                                <div class="col-md-4">
                                    <label for="daterangeRanap" class="form-label">Periode Waktu</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ranap-radio filter-waktu-bp" {{ ($form_filter_kondisi_waktu==1) ? 'checked' : '' }} type="radio" name="form_filter_kondisi_waktu" id="inlineRadio1" value="1">
                                        <label class="form-check-label ps-1" for="inlineRadio1">Belum Pulang</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ranap-radio" {{ ($form_filter_kondisi_waktu==2) ? 'checked' : '' }} type="radio" name="form_filter_kondisi_waktu" id="inlineRadio2" value="2">
                                        <label class="form-check-label ps-1" for="inlineRadio2">Tgl.Masuk</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ranap-radio" {{ ($form_filter_kondisi_waktu==3) ? 'checked' : '' }} type="radio" name="form_filter_kondisi_waktu" id="inlineRadio3" value="3">
                                        <label class="form-check-label ps-1" for="inlineRadio3">Pulang</label>
                                    </div>
                                    <div class='input-date-range-bagan my-1'>
                                        <input type="text" class="form-control input-daterange input-date-range" id='filter-waktu' placeholder="Tanggal">
                                        <input type="hidden" id="tgl_start" name="form_filter_date_start" value="{{ Request::get('form_filter_date_start') }}">
                                        <input type="hidden" id="tgl_end" name="form_filter_date_end" value="{{ Request::get('form_filter_date_end') }}">
                                    </div>
                                </div>
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
                    <table class="table border table-responsive-tablet">
                        <thead>
                            <tr>
                                <th class="py-3" style="width: 15%">No.Rawat</th>
                                <th class="py-3" style="width: 15%">No.RM</th>
                                <th class="py-3" style="width: 3%">Dokter P.J</th>
                                <th class="py-3" style="width: 15%">Pasien</th>
                                <th class="py-3" style="width: 15%">Kamar</th>
                                <th class="py-3" style="width: 20%">Jenis Bayar</th>
                                <th class="py-3" style="width: 7%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($list_data))
                                @foreach($list_data as $key => $item)

                                    <?php
                                        // echo "<pre>";
                                        // print_r($item);
                                        $dokter_pj=!empty($item_dr_pj[$item->no_rawat]) ? $item_dr_pj[$item->no_rawat] : '';
                                        $paramater_url=[
                                            'data_sent'=>$item->no_rawat,
                                            'params_json'=>$params_json,
                                        ];
                                    ?>
                                    <tr>
                                        <td>{{ !empty($item->no_rawat) ? $item->no_rawat : ''  }}</td>
                                        <td>{{ !empty($item->no_rkm_medis) ? $item->no_rkm_medis : ''  }}</td>
                                        <td>{{ !empty($dokter_pj) ? $dokter_pj : ''  }}</td>
                                        <td>{{ !empty($item->nm_pasien) ? $item->nm_pasien : ''  }}</td>
                                        <td>{{ !empty($item->kamar) ? $item->kamar : ''  }}</td>
                                        <td>{{ !empty($item->png_jawab) ? $item->png_jawab : ''  }}</td>
                                        <td>{{ !empty($item->status_bayar) ? $item->status_bayar : ''  }}</td>
                                        <td>
                                            <?php 
                                                $icon='<i class="fa-solid fa-circle-info"></i>Billing';
                                            ?>
                                            {!!  (new \App\Http\Traits\AuthFunction)->setPermissionButton([$router_name->uri.'/view',$paramater_url,'view',[ 'style'=>'color:#fff;' ],$icon]) !!}
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
</div>

@push('script-end-2')
<script src="{{ asset('js/rawat-inap/index.js') }}"></script>
@endpush