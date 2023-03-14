<?php
function formatMoney2($nominal, $currency = "")
{
    $hasil = $currency . " " . number_format($nominal, 0, '', ',');
    echo $hasil;
}

?>

<div id="operasi" style="display: none;">
    @if($message = Session::get('success-jadwaloperasi'))
        <div class="row">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
            </svg>
            <div class="col-md-12">
                <div class="alert alert-info py-2" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    {{$message}}
                </div>
            </div>
        </div>
    @endif
    
    @if($message = Session::get('fail-jadwaloperasi'))
        <div class="row">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            <div class="col-md-12">
                <div class="alert alert-danger py-2" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    {{$message}}
                </div>
            </div>
        </div>
    @endif

    @if($message = Session::get('failed-jadwaloperasi'))
        <div class="row">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            <div class="col-md-12">
                <div class="alert alert-danger py-2" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    {{$message}}
                </div>
            </div>
        </div>
    @endif

    @if($message = Session::get('success-update-jadwaloperasi'))
        <div class="row">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
            </svg>
            <div class="col-md-12">
                <div class="alert alert-info py-2" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    {{$message}}
                </div>
            </div>
        </div>
    @endif

    <form id="formJO" action="permintaan/jadwal_operasi/create?no_rm={{Request::get('no_rm')}}&no_rawat={{Request::get('no_rawat')}}" method="POST">
        @csrf
        <input type="text" hidden class="form-control" name="fr" value="{{ Request::get('fr') }}">
        <input type="text" hidden id="jam" required name="kode_paket" value="M5025">
        <input type="text" hidden id="jam" required name="kd_dokter" value="D0000038">

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 bagan_form">
                <label for="norawatOperasi" class="form-label">No.Rawat</label>
                <input type="text" class="form-control error-border-form" id="norawatOperasi" required name="no_rawat" value="{{ Request::get('no_rawat') }}">
                <span class="error-message text-danger"></span>
            </div>
            <div class="col-lg-4">
                <input type="text" class="form-control readonly" readonly id="nameOperasi" value="{{ $jadwalOperasiPasien['nm_pasien'] }}">
            </div>
            <div class="col-lg-3">
                <input type="text" class="form-control readonly" readonly id="kamarOperasi" value="{{ $jadwalOperasiPasien['nm_poli'] }}">
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2">
                <label for="tanggalOperasi" class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-daterange" autocomplete="off" required name="tanggal" value="" id="tanggalOperasi">
            </div>
            <!-- <div class="col-lg-2">
                <label for="mulaiOperasi" class="form-label">Mulai <span class="text-danger">*</span></label>
                <input type="time" class="form-control input-time" id="jam_mulai" required name="jam_mulai" step="1" id="">
            </div> -->


            <!-- jiwana:kamar operasi -->
            <div class="col-lg-2 bagan_form">
                <label for="kamarOperasi" class="form-label">Kamar Operasi <span class="text-danger">*</span></label>
                <div class="button-icon-inside-col-2 kamarOperasiPasienJO error-border-form">
                    <input type="text" class="input-text" readonly required id="namaKamarOperasiPasien" />
                    <input type="hidden" id="kd_kamar_operasi" name='kd_kamar_operasi' />
                    <span id="modalKamarOperasiPasien">
                        <span class="iconify text-primary hover-pointer" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                    </span>
                </div>
                <span id="errorNamaKamarOperasiPasien" class="text-danger error-message"></span>
            </div>
            <!-- jiwana:end kamar operasi -->

            <!-- jiwana:jadwal operasi -->
            <div class="col-lg-2 bagan_form">
                <label for="" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                <div class="button-icon-inside-col-2 jadwalOperasiJO error-border-form">
                    <input type="text" class="input-text" readonly required id="jadwalOperasi" />
                    <input type="hidden" id="jam_mulai" name='jam_mulai' />
                    <input type="hidden" id="jam_selesai" name='jam_selesai' />
                    <span id="modalJadwalOperasi">
                        <span class="iconify text-primary hover-pointer" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                    </span>
                </div>
                <span id="errorJadwalOperasi" class="text-danger error-message"></span>
            </div>
            <!-- jiwana:end jadwal operasi -->



            <!-- <div class="col-lg-2">
                <label for="selesaiOperasi" class="form-label">Selesai <span class="text-danger">*</span></label>
                <input type="time" class="form-control input-time" id="jam_selesai" required name="jam_selesai" step="1" id="">
            </div> -->
            <div class="col-xl-3 col-4">
                <label for="exampleFormControlInput3" class="form-label">Berdasarkan Status <span class="text-danger">*</span></label>
                <select class="form-select input-dropdown" required aria-label="Default select example" name="status" id="exampleFormControlInput3">
                    @foreach($jadwalOperasiStatuses as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 bagan_form">
                <label class="form-label">Operator <span class="text-danger">*</span></label>
                <input type="text" class="form-control readonly readonly-operator error-border-form" readonly required autocomplete="off" name="kd_dokter" required id="kodeDokterOperatorOperasi" value="{{ $dokterLogin->kd_dokter }}">
                <span id="errorOperator" class="text-danger error-message"></span>
            </div>
            <div class="col-lg-4 bagan_form">
                <div class="button-icon-inside namaOperatorJO error-border-form">
                    <input type="text" class="input-text" id="namaDokterOperatorOperasi" readonly required value="{{ $dokterLogin->nm_dokter }}" />
                    <span id="modalOperator">
                        <span class="iconify text-primary hover-pointer" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                    </span>
                </div>
                <span id="errorNamaOperator" class="text-danger error-message "></span>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-lg-2 bagan_form">
                <label for="kodePaketOperasi" class="form-label">Operasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control readonly readonly-operasi error-border-form" readonly required autocomplete="off" name="kode_paket" required id="kodePaketOperasi">
                <span id="errorOperasi" class="text-danger error-message"></span>
            </div>
            <div class="col-lg-4 bagan_form">
                <div class="button-icon-inside namaOperasiJO error-border-form">
                    <input type="text" class="input-text" readonly required id="namaOperasi" />
                    <span id="modalOperasi">
                        <span class="iconify text-primary hover-pointer" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                    </span>
                </div>
                <span id="errorNamaOperasi" class="text-danger error-message"></span>
            </div>
        </div>

        <div class="row justify-content-start align-items-end mt-5">
            <div class="col-lg-2 mb-3">
                <div class="d-grid gap-2">
                    <button class="btn btn-warning btn-shadow" type="submit">Simpan</button>
                </div>
            </div>
        </div>

    </form>

    <hr class="mb-5">
    
    <div class="mt-5">

        <form action="" method="GET">
            <input type="hidden" name="no_rawat" value="{{ Request::get('no_rawat') }}">
            <input type="hidden" name="no_rm" value="{{ Request::get('no_rm') }}">
            <input type="hidden" name="tab" value="{{ Request::get('tab') }}">
            <input type="hidden" name="fr" value="{{ Request::get('fr') }}">

            <div class="row justify-content-start align-items-end mb-3">
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

        <div style="overflow-x: auto; max-width: auto;">
            <table class="table border table-responsive-tablet">
                <thead>
                    <tr>
                        <th class="py-3" style="width: 9%">No.Rawat</th>
                        <th class="py-3" style="width: 10%;">Nama Pasien</th>
                        <th class="py-3" style="width: 9%;">Waktu</th>
                        <th class="py-3" style="width: 9%;">Kamar Operasi</th>
                        <th class="py-3" style="width: 9%;">Mulai</th>
                        <th class="py-3" style="width: 9%;">Selesai</th>
                        <th class="py-3" style="width: 9%;">Status</th>
                        <th class="py-3" style="width: 10%;">Rujukan Dari</th>
                        <th class="py-3" style="width: 8%;">Diagnosa</th>
                        <th class="py-3" style="width: 10%;">Operasi</th>
                        <th class="py-3" style="width: 10%;">Operator</th>
                        <th class="py-3" style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody id="jadwal-operasi" data-jml-jo="{{ count($jadwalOperasiLists2) }}">
                    @foreach($jadwalOperasiLists2 as $key => $item)
                    <tr>
                        <td>{{ $item["no_rawat"] }}</td>
                        <td>{{ $item["nm_pasien"] }}</td>
                        <td>{{ $item["tanggal"] }}</td>
                        <td>{{ !empty($item["nm_kamar_operasi"]) ? $item["nm_kamar_operasi"] : '-' }}</td>
                        <td>{{ $item["jam_mulai"] }}</td>
                        <td>{{ $item["jam_selesai"] }}</td>
                        <td>{{ $item["status"] }}</td>
                        <td>{{ $item["nm_poli"] }}</td>
                        <td>{{ $item["diagnosa"] }}</td>
                        <td>{{ $item["nm_perawatan"] }}</td>
                        <td>{{ $item["nm_dokter"] }}</td>
                        <td>
                            <span class="ms-2 me-1 hover-pointer" id="modalEdit{{ $key }}">
                                <span class="iconify text-primary" style="font-size: 24px;" data-icon="el:file-edit-alt"></span>
                            </span>
                            <button type="button" class="btn-icon mx-1 hover-pointer" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $key }}"><span class="iconify text-danger" style="font-size: 24px;" data-icon="el:trash-alt"></span></button>
                            <!-- <span class="ms-1 me-2 hover-pointer">
                                <span class="iconify text-danger" style="font-size: 24px;" data-icon="el:trash-alt"></span>
                            </span> -->
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $key }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="permintaan/jadwal_operasi/delete" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="text" hidden class="form-control" name="fr" value="{{ Request::get('fr') }}">

                                    <input type="text" class="form-control" name="no_rawat" value="{{ $item['no_rawat'] }}" hidden>
                                    <input type="text" class="form-control" name="kode_paket" value="{{ $item['kode_paket'] }}" hidden>
                                    <input type="text" class="form-control" name="tanggal" value="{{ $item['tanggal'] }}" hidden>
                                    <input type="text" class="form-control" name="jam_mulai" value="{{ $item['jam_mulai'] }}" hidden>
                                    <input type="text" class="form-control" name="jam_selesai" value="{{ $item['jam_selesai'] }}" hidden>
                                    <input type="text" class="form-control" name="status" value="{{$item['status']}}" hidden>
                                    <input type="text" class="form-control" name="kd_dokter" value="{{ $item['kd_dokter'] }}" hidden>
                                    <input type="text" class="form-control" name="no_rm" value="{{Request::get('no_rm')}}" hidden>
                                    <input type="text" class="form-control" name="kd_kamar_operasi" value="{{ $item['kd_kamar_operasi'] }}" hidden>

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin menghapus data ini ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-primary">Ya</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-end">
                {{ $jadwalOperasiLists2->withQueryString()->onEachSide(1)->links() }}
            </div>
            <div class="justify-content-start align-items-end">
                <div class="col-lg-2 mb-3">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-shadow" id="next" type="button">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- jiwana: Button trigger modal pilih kamar operasi -->
<button type="button" style="display: none;" id="showModalKamarOperasiPasien" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalKamarOperasiPasien">
    </button>

<!-- jiwana: Button trigger modal pilih jadwal operasi -->
<button type="button" style="display: none;" id="showModalJadwalOperasi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalJadwalOperasi">
</button>


<!-- jiwana: Modal Kamar Operasi -->
<div class="modal fade" id="exampleModalKamarOperasiPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="col-6">
                    <div class="d-flex justify-content-center align-items-center border">
                        <input type="text" class="form-control border-0" id="pencarianKamarOperasiJO" placeholder="Masukkan kata yang akan dicari">
                        <button type="button" class="btn btn-white">
                            <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeModalKamarOperasiPasien" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">

                <table class="table border" id="kamarOperasiDataTable">
                    <thead>
                        <tr>
                            <th scope="col" class="py-4 ps-4">Kamar Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kamarOperasiList as $item) <tr>
                            <?php $kode = $item["kd_kamar_operasi"] ?>
                            <?php $nama = $item["nm_kamar_operasi"] ?>
                            <td class="py-3 ps-4"> <span class="text-primary hover-pointer setValueKamarOperasi" data-value='{{$kode}}|{{$nama}}'>{{ $item["nm_kamar_operasi"] }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="display: none;">
                <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- jiwana: End Modal Kamar Operasi -->


<!-- jiwana: Modal Jadwal Operasi -->
<div class="modal fade" id="exampleModalJadwalOperasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="col-6">
                    <div class="d-flex justify-content-center align-items-center border">
                        <input type="text" class="form-control border-0" id="pencarianJadwalOperasiJO" placeholder="Masukkan kata yang akan dicari">
                        <button type="button" class="btn btn-white">
                            <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeModalJadwalOperasi" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">

                <table class="table border" id="jadwalOperasiDataTable">
                    <thead>
                        <tr>
                            <th scope="col" class="py-4 ps-4">Ketersediaan</th>
                            <th scope="col" class="py-4 ps-4">Jam Mulai</th>
                            <th scope="col" class="py-4 ps-4">Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="display: none;">
                <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- jiwana: End Modal Jadwal Operasi -->



<!--  form edit    -->
<!-- End Modal Oprasi -->
@for($i = 0; $i < count($jadwalOperasiLists2); $i++) <!-- Button trigger modal For edit data {{ $i }} -->
        <!-- Button trigger modal -->
        <button type="button" style="display: none;" class="btn btn-primary" id="showModalEdit{{ $i }}" data-bs-toggle="modal" data-bs-target="#staticBackdropModalEdit{{$i}}">
            Launch static backdrop modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdropModalEdit{{$i}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Jadwal Operasi</h5>
                        <button type="button" class="btn-close" onclick="clearCookiesJO('{{$i}}')" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="permintaan/jadwal_operasi/update" method="POST" id='form-edit-jadwal-operasi{{ $i }}' class='form-edit-jadwal-operasi'>
                                @method('PUT')
                                @csrf
                                <input type="text" hidden class="form-control" name="fr" value="{{ Request::get('fr') }}">
                                {{-- contoh --}}
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsOld[no_rm]" value="{{ Request::get('no_rm') }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsOld[no_rawat]" value="{{ $jadwalOperasiLists2[$i]['no_rawat'] }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsOld[kode_paket]" value="{{ $jadwalOperasiLists2[$i]['kode_paket'] }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsOld[tanggal]" value="{{ $jadwalOperasiLists2[$i]['tanggal'] }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsOld[jam_mulai]" value="{{ $jadwalOperasiLists2[$i]['jam_mulai'] }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsOld[jam_selesai]" value="{{ $jadwalOperasiLists2[$i]['jam_selesai'] }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsOld[status]" value="{{$jadwalOperasiLists2[$i]['status']}}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsOld[kd_dokter]" value="{{ $jadwalOperasiLists2[$i]['kd_dokter'] }}">

                                {{-- <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsNew[no_rawat]" value="{{ $jadwalOperasiLists2[$i]['no_rawat'] }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsNew[kode_paket]" value="{{ $jadwalOperasiLists2[$i]['kode_paket'] }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsNew[tanggal]" value="{{ $jadwalOperasiLists2[$i]['tanggal'] }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsNew[jam_mulai]" value="11:11:11">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsNew[jam_selesai]" value="{{ $jadwalOperasiLists2[$i]['jam_selesai'] }}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsNew[status]" value="{{$jadwalOperasiLists2[$i]['status']}}">
                                <input type="text" hidden class="form-control" id="norawatOperasi" name="fieldsNew[kd_dokter]" value="{{ $jadwalOperasiLists2[$i]['kd_dokter'] }}"> --}}

                                {{-- end contoh --}}

                                <div class="row justify-content-start align-items-end mb-3">
                                    <div class="col-lg-3 bagan_form">
                                        <label for="norawatOperasi" class="form-label">No.Rawat</label>
                                        <input type="text" class="form-control error-border-form" id="norawatOperasi" required name="fieldsNew[no_rawat]" value="{{ $jadwalOperasiLists2[$i]['no_rawat'] }}">
                                        <span class="error-message text-danger"></span>
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control readonly" id="nameOperasi" readonly value="{{ $jadwalOperasiLists2[$i]['nm_pasien'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control readonly" id="kamarOperasi" readonly value="{{ $jadwalOperasiPasien['nm_poli'] }}">
                                    </div>
                                </div>

                                <div class="row justify-content-start align-items-end mb-3">
                                    <div class="col-lg-3">
                                        <label for="tanggalOperasi" class="form-label">Tanggal</label>
                                        <input type="text" class="form-control input-daterange" autocomplete="off" name="fieldsNew[tanggal]" id="tanggalOperasiEdit{{$i}}" value="{{ $jadwalOperasiLists2[$i]['tanggal'] }}">
                                    </div>
                                    <!-- <div class="col-lg-3">
                                        <label for="mulaiOperasi" class="form-label">Mulai</label>
                                        <input type="time" class="form-control input-time" name="fieldsNew[jam_mulai]" step="1" id="" value="{{ $jadwalOperasiLists2[$i]['jam_mulai'] }}">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="selesaiOperasi" class="form-label">Selesai</label>
                                        <input type="time" class="form-control input-time" name="fieldsNew[jam_selesai]" step="1" id="" value="{{ $jadwalOperasiLists2[$i]['jam_selesai'] }}">
                                    </div> -->

                                    <!-- jiwana:kamar operasi edit -->
                                    <div class="col-lg-3 bagan_form">
                                        <label for="kamarOperasi" class="form-label">Kamar Operasi <span class="text-danger">*</span></label>
                                        <div class="button-icon-inside-col-2 kamarOperasiPasienJO error-border-form">
                                            <input type="text" class="input-text" readonly id="namaKamarOperasiPasien" required value="{{ $jadwalOperasiLists2[$i]['nm_kamar_operasi'] }}" />
                                            <input type="hidden" id="kd_kamar_operasi" name='kd_kamar_operasi' value="{{ $jadwalOperasiLists2[$i]['kd_kamar_operasi'] }}" />
                                            <input type="hidden" name='fieldsOld[kd_kamar_operasi]' value="{{ $jadwalOperasiLists2[$i]['kd_kamar_operasi'] }}" />
                                            <span id="modalKamarOperasiPasienEdit" data-key='{{ $i }}'>
                                                <span class="iconify text-primary hover-pointer" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                                            </span>
                                        </div>
                                        <span id="errorNamaKamarOperasiPasien" class="text-danger error-message"></span>
                                    </div>
                                    <!-- jiwana:end kamar operasi edit-->


                                    <!-- jiwana:jadwal operasi edit -->
                                    <div class="col-lg-3 bagan_form">
                                        <label for="" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                                        <div class="button-icon-inside-col-2 jadwalOperasiJO error-border-form">
                                            <input type="text" class="input-text" readonly id="jadwalOperasi" required value="{{ $jadwalOperasiLists2[$i]['jam_mulai'] }}" />
                                            <input type="hidden" id="jam_mulai" name='jam_mulai' value="{{ $jadwalOperasiLists2[$i]['jam_mulai'] }}" />
                                            <input type="hidden" id="jam_selesai" name='jam_selesai' value="{{ $jadwalOperasiLists2[$i]['jam_selesai'] }}" />

                                            <input type="hidden" name='fieldsOld[jam_mulai]' value="{{ $jadwalOperasiLists2[$i]['jam_mulai'] }}" />
                                            <input type="hidden" name='fieldsOld[jam_selesai]' value="{{ $jadwalOperasiLists2[$i]['jam_selesai'] }}" />
                                            <span id="modalJadwalOperasiEdit" data-key='{{ $i }}'>
                                                <span class="iconify text-primary hover-pointer" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                                            </span>
                                        </div>
                                        <span id="errorJadwalOperasi" class="text-danger error-message"></span>
                                    </div>
                                    <!-- jiwana:end jadwal operasi edit -->

                                    <div class="col-xl-3 col-5">
                                        <label for="exampleFormControlInput3" class="form-label">Berdasarkan Status</label>
                                        <select class="form-select input-dropdown" name="fieldsNew[status]" aria-label="Default select example" id="exampleFormControlInput3">
                                            @foreach($jadwalOperasiStatuses as $item)
                                            <option value="{{ $item }}" <?= $jadwalOperasiLists2[$i]["status"] == $item ? 'selected' : '' ?>>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row justify-content-start align-items-end mb-3">
                                    <div class="col-lg-3 bagan_form">
                                        <label for="kodeDokterOperatorEdit{{ $i }}" class="form-label">Operator</label>
                                        <input type="text" class="form-control readonly error-border-form" name="fieldsNew[kd_dokter]" required readonly id="kodeDokterOperatorEdit{{ $i }}" value="{{ $jadwalOperasiLists2[$i]['kd_dokter'] }}">
                                        <span class="text-danger error-message"></span>
                                    </div>
                                    <div class="col-lg-6 bagan_form">
                                        <div class="button-icon-inside error-border-form">
                                            <input type="text" class="input-text" readonly id="namaDokterOperatorEdit{{ $i }}" required value="{{ $jadwalOperasiLists2[$i]['nm_dokter'] }}" />
                                            <span id="modalOperatorEdit{{ $i }}">
                                                <span class="iconify text-primary hover-pointer" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                                            </span>
                                        </div>
                                        <span class="text-danger error-message "></span>
                                    </div>
                                </div>

                                <div class="row justify-content-start align-items-end mb-3">
                                    <div class="col-lg-3 bagan_form">
                                        <label for="kodePaketOperasiEdit{{ $i }}" class="form-label">Operasi</label>
                                        <input type="text" class="form-control readonly error-border-form" name="fieldsNew[kode_paket]" required readonly id="kodePaketOperasiEdit{{ $i }}" value="{{ $jadwalOperasiLists2[$i]['kode_paket'] }}">
                                        <span class="text-danger error-message"></span>
                                    </div>
                                    <div class="col-lg-6 bagan_form">
                                        <div class="button-icon-inside error-border-form">
                                            <input type="text" class="input-text" readonly id="namaOperasiEdit{{ $i }}" required value="{{ $jadwalOperasiLists2[$i]['nm_perawatan'] }}" />
                                            <span id="modalOperasiEdit{{ $i }}">
                                                <span class="iconify text-primary hover-pointer" style="font-size: 24px;" data-icon="ant-design:select-outlined" data-rotate="270deg"></span>
                                            </span>
                                        </div>
                                        <span class="text-danger error-message "></span>
                                    </div>
                                </div>

                                <div class="row justify-content-start align-items-end my-5">
                                    <div class="col-lg-3 mb-3">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-danger" onclick="clearCookiesJO('{{$i}}')" data-bs-dismiss="modal" type="button">Batal</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div> -->
                </div>
            </div>
        </div>

        {{-- <button type="button" style="display: none;" id="showModalEdit{{ $i }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $i }}">
        </button> --}}

        <!-- Modal Edit Data ke {{ $i }} -->
        {{-- <div class="modal fade" id="exampleModalEdit{{ $i }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title mx-2 mt-4" id="exampleModalLabel">Jadwal Operasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearStorage('{{ $i }}')" id="closeModalOperasi" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer" style="display: none;">
                        <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- End Modal Edit ke {{ $i }} -->


        <!-- ============== -->
        <!-- Button trigger modal For data operator -->
        <button type="button" style="display: none;" id="showModalOperatorEdit{{ $i }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $i }}">
        </button>

        <!-- Modal Operator -->
        <div class="modal fade" id="exampleModal{{ $i }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <div class="col-6">
                            <div class="d-flex justify-content-center align-items-center border">
                                <input type="text" class="form-control border-0" id="pencarianOperatorEditJO{{$i}}" placeholder="Masukkan kata yang akan dicari">
                                <button type="button" class="btn btn-white">
                                    <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn-close" id="closeModalOperatorEdit{{ $i }}" onclick="backFirstModal('{{ $i }}')" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-0">

                        <table class="table border" id="operatorDataTableEdit{{$i}}">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-4 ps-4">Kode Dokter</th>
                                    <th scope="col" class="py-4" style="width: 35%;">Nama Dokter</th>
                                    <th scope="col" class="py-4">Spesialis</th>
                                    <th scope="col" class="py-4 pe-4">Nomor Ijin Praktek</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwalOperasiOperatorLists as $key => $item) <tr>
                                    <?php $kode = $item["kd_dokter"] ?>
                                    <?php $name = $item["nm_dokter"] ?>
                                    <td class="py-3 ps-4">{{ $item["kd_dokter"] }}</td>
                                    <td class="py-3"> <span class="text-primary hover-pointer" onclick="setValueOperatorEdit('{{$kode}}', '{{ $name }}', '{{ $i }}')">{{ $name }}</span></td>
                                    <td class="py-3">{{ $item["nm_sps"] }}</td>
                                    <td class="py-3">{{ $item["no_ijn_praktek"] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer" style="display: none;">
                        <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Operator -->

        <!-- Button trigger modal For data operasi ke {{ $i }} -->
        <button type="button" style="display: none;" id="showModalOperasiEdit{{ $i }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalOperasiEdit{{ $i }}">
        </button>

        <!-- Modal Operasi Edit ke {{ $i }} -->
        <div class="modal fade" id="ModalOperasiEdit{{ $i }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <div class="col-6">
                            <div class="d-flex justify-content-center align-items-center border">
                                <input type="text" class="form-control border-0" id="pencarianOperasiEditJO{{$i}}" placeholder="Masukkan kata yang akan dicari">
                                <button type="button" class="btn btn-white">
                                    <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn-close" id="closeModalOperasiEdit{{ $i }}" onclick="backFirstModal('{{ $i }}')" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-0">

                        <table class="table border" id="operasiDataTableEdit{{$i}}">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-4 ps-4">Kode Paket</th>
                                    <th scope="col" class="py-4" style="width: 35%;">Nama Operasi</th>
                                    <th scope="col" class="py-4">Kategori</th>
                                    <th scope="col" class="py-4 pe-4">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwalOperasiOperasiList as $key => $item) <tr>
                                    <?php $kode = $item["kode_paket"] ?>
                                    <?php $name = $item["nm_perawatan"] ?>
                                    <td class="py-3 ps-4">{{ $item["kode_paket"] }}</td>
                                    <td class="py-3"> <span class="text-primary hover-pointer" onclick="setValueOperasiEdit('{{$kode}}', '{{ $name }}', '{{ $i }}')">{{ $name }}</span></td>
                                    <td class="py-3">{{ $item["kategori"] }}</td>
                                    <td class="py-3">{{ formatMoney2($item["jumlah"]) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer" style="display: none;">
                        <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    @endfor