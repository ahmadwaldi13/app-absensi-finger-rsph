<?php 
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
?>
<div>

    <x-set-form-request></x-set-form-request>

    <div class="row justify-content-start align-items-end">
        <div class="col-lg-2 mb-3">
            <label for="no_rawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control" name="no_rawat" readonly id='no_rawat' value="{{ $item_pasien->no_rawat }}">
        </div>
        <div class="col-lg-5 mb-3">
            <input type="text" class="form-control" readonly value="{{ $item_pasien->no_rm }} {{ $dataPasien['nm_pasien'] }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="no_rm" class="form-label">No.RM</label>
            <input type="text" class="form-control" id="no_rm" readonly value="{{ $item_pasien->no_rm }}">
        </div>
    </div>

    <hr class="mb-5">

    <div class='bagan-data-table'>
        <form action="" method="GET">
            <input type="hidden"  name="no_rawat" value="{{ $item_pasien->no_rawat }}">
            <input type="hidden"  name="no_rm" value="{{ $item_pasien->no_rm }}">
            <input type="hidden"  name="tab" value="{{ Request::get('tab') }}">
            <input type="hidden"  name="fr" value="{{ $item_pasien->no_fr }}">

            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-4 col-md-10">
                    <label for="filter_search_text" class="form-label">Pencarian Dengan Keyword</label>
                    <input type="text" class="form-control" name='form_filter_text' value="{{ Request::get('form_filter_text') }}" id='filter_search_text' placeholder="Masukkan Kata">
                </div>
                <div class="col-lg-4 col-md-10">
                    <label for="tgl_rawat" class="form-label">Tanggal Rawat</label>
                    <div class='input-date-range-bagan'>
                        <input type="text" class="form-control input-daterange input-date-range" id="tgl_rawat" placeholder="Tanggal">
                        <input type="hidden" id="tgl_start" name="form_filter_start" value="{{ Request::get('form_filter_start') }}">
                        <input type="hidden" id="tgl_end" name="form_filter_end" value="{{ Request::get('form_filter_end') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">
                        <span class="iconify" style="font-size: 24px;" data-icon="fe:search"></span>
                    </button>
                </div>
            </div>
        </form>

        <div>
            <form action="tindakan-dokter/tindakan-action" method="POST">
                @csrf
                <input type="hidden"  name="get_request" value="{{ json_encode( Request::all() ) }}">

                <div style="overflow-x: auto; max-width: auto; max-height: 500px;" class="mb-3">
                    <table class="table border data-table table-responsive-tablet gsf_kode_item" data-gsf-type='table'>
                        <thead>
                            <tr>
                                <th scope="col" class="py-3"></th>
                                <th scope="col" class="py-3">Kode</th>
                                <th scope="col" class="py-3">Nama Perawatan</th>
                                <th scope="col" class="py-3">Kode Dokter</th>
                                <th scope="col" class="py-3">Dokter Yg Menangani</th>
                                <th scope="col" class="py-3">Tgl.Rawat</th>
                                <th scope="col" class="py-3">Jam Rawat</th>
                                <th scope="col" class="py-3">Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tindakaPetugasList as $item)
                                @php
                                    $biaya_rawat=(new \App\Http\Traits\GlobalFunction)->formatMoney($item["biaya_rawat"]);
                                    $kode=$item['no_rawat'].'@'.$item['kd_jenis_prw'].'@'.$item['kd_dokter'].'@'.$item['tgl_perawatan'].'@'.$item['jam_rawat'];
                                @endphp
                                <tr>
                                    <td class="py-3 px-3 texter"><input class="form-check-input gsf_set_kode_item" data-gsf-nilai="{{ $kode }}" style="border-radius: 0px;" type="checkbox" name="kode_item[]" value="{{ $kode }}" id="flexCheckDefault"/></td> 
                                    <td class="py-3 px-0">{{ $item["kd_jenis_prw"] }}</td>
                                    <td class="py-3">{{ $item["nm_perawatan"] }}</td>
                                    <td class="py-3">{{ $item["kd_dokter"] }}</td>
                                    <td class="py-3">{{ $item["nm_dokter"] }}</td>
                                    <td class="py-3">{{ $item["tgl_perawatan"] }}</td>
                                    <td class="py-3">{{ $item["jam_rawat"] }}</td>
                                    <td class="py-3">{{ $biaya_rawat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if(count($tindakaPetugasList))
                    <div class="row justify-content-start align-items-end my-5">
                        <div class="col-lg-2 mb-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-danger" type="submit" name='action' value='delete' >Hapus</button>
                            </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>