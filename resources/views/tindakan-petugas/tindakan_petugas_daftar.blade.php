<?php 
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
?>

<div>

    <x-set-form-request></x-set-form-request>

    <form action="{{ url('/') }}/tindakan-petugas/create" method="POST">
        @csrf
        
        <input type="text" hidden class="form-control" name="no_rm" value="{{ $item_pasien->no_rm }}">
        <input type="text" hidden class="form-control" name="fr" value="{{ $item_pasien->no_fr }}">
        <div class="row justify-content-start align-items-end">
            <div class="col-lg-2 mb-3">
                <label for="no_rawat" class="form-label">No.Rawat</label>
                <input type="text" class="form-control" name="no_rawat" id='no_rawat' readonly value="{{ $item_pasien->no_rawat }}">
            </div>
            <div class="col-lg-5 mb-3">
                <input type="text" class="form-control" readonly value="{{ $item_pasien->no_rm }} {{ $dataPasien['nm_pasien'] }}">
            </div>
            <div class="col-lg-5 mb-3">
                <div class='input-date-time-bagan'>
                    <label for="tanggal" class="form-label">Tanggal : </label>
                    <input type="text" class="form-control input-daterange input-date-time" id='tanggal' required autocomplete="off">
                    @php
                        $tgl_default=date('Y-m-d');
                        $jam_default=date('H:i');
                    @endphp
                    <input type="hidden" id="tgl" required name="tgl_perawatan" value='{{ $tgl_default }}'>
                    <input type="hidden" id="jam" required name="jam_rawat" value='{{ $jam_default }}'>
                </div>
            </div>
        </div>
    
        <div class="row justify-content-start align-items-end mb-3">
            <div class="col-2 mb-2">
                <label for="nip" class="form-label">Petugas</label>
                <input type="text" class="form-control" name='nip' readonly id="nip" value="" required>
            </div>
            <div class="col-5 mb-2">
                <div class="input-group">
                    <input type="text" class="form-control" id="namaPetugas" required>
                    <span class="input-group-text show-modal" id="ModalPetugas" class=''>
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
            </div>

            <div class="col-lg-5 mb-2">
                <label for="no_rm" class="form-label">No.RM</label>
                <input type="text" class="form-control" id="no_rm" readonly value="{{ $item_pasien->no_rm }}">
            </div>
        </div>
        <hr class="mb-5">

        <div class='bagan-data-table'>
            <div class="row justify-content-start align-items-end mb-3">
                <div class="col-lg-4 col-md-10">
                    <label for="pencarianDT" class="form-label">Pencarian Dengan Keyword</label>
                    <input type="text" class="form-control search-data-table" placeholder="Masukkan Kata">
                </div>
            </div>

            <div style="overflow-x: auto; max-width: auto; max-height: 500px;" class="mb-3">
                <table class="table border data-table table-responsive-tablet gsf_kd_jenis_prw" data-gsf-type='table'>
                    <thead>
                        <tr>
                            <th scope="col" class="py-3"></th>
                            <th scope="col" class="py-3">Kode</th>
                            <th scope="col" class="py-3">Nama Perawatan</th>
                            <th scope="col" class="py-3">Kategori Perawatan</th>
                            <th scope="col" class="py-3">Tarif / Biaya</th>
                            @if ($model->fr=='ri')
                            <th scope="col" class="py-3">Kelas</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listTindakan as $item)
                            @php
                                $item=(array)$item;
                                $total_byrpr=(new \App\Http\Traits\GlobalFunction)->formatMoney($item["total_byrpr"]);
                            @endphp
                            <tr>
                                <td class="py-3 px-3 texter"><input class="form-check-input gsf_set_kd_jenis_prw"  data-gsf-nilai="{{ $item['kd_jenis_prw'] }}" style="border-radius: 0px;" type="checkbox" name="kd_jenis_prw[]" value="{{ $item['kd_jenis_prw'] }}" id="flexCheckDefault"/></td>
                                <td class="py-3 px-0">{{ $item["kd_jenis_prw"] }}</td>
                                <td class="py-3">{{ $item["nm_perawatan"] }}</td>
                                <td class="py-3">{{ $item["nm_kategori"] }}</td>
                                <td class="py-3">{{ $total_byrpr }}</td>
                                @if ($model->fr=='ri')
                                <td class="py-3">{{ $item["kelas"] }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-start align-items-end table-responsive">
            <div class="col-lg-2 mb-3">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Simpan Tindakan</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Button trigger modal Petugas Daftar Tindakan -->
    <button type="button" style="display: none;" id="buttonModalPetugas" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModalPetugas"></button>
    

    <!-- Modal Petugas Daftar Tindakan -->
    <div class="modal fade bagan-data-table" id="showModalPetugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content overflow-auto">
                <div class="modal-header border-0 pb-0">
                    <div class="col-6">
                        <div class="d-flex justify-content-center align-items-center border">
                            <input type="text" class="form-control border-0 search-data-table" placeholder="Masukkan kata yang akan dicari">
                            <button type="submit" class="btn btn-white">
                                <span class="iconify" style="font-size: 24px; color: #CFD0D7;" data-icon="fe:search"></span>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal" id="closeModalPetugasDT" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table data-table border" >
                        <thead>
                            <tr>
                                <th scope="col" class="py-4 ps-4">NIP</th>
                                <th scope="col" class="py-4" style="width: 35%;">Nama Petugas</th>
                                <th scope="col" class="py-4">Alamat</th>
                                <th scope="col" class="py-4 pe-4">Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petugases as $petugas)
                                @php 
                                    $nama = $petugas["nama"]; 
                                    $nip= $petugas["nip"];
                                @endphp
                                <tr>
                                    <td class="py-3 ps-4">{{ $petugas["nip"] }}</td>
                                    <td class="py-3"> <span class="text-primary hover-pointer set-value-data-table" data-target="#nip@val|#namaPetugas@val" data-value='{{$nip}}|{{$nama}}'>{{ $nama }}</span></td>
                                    <td class="py-3">{{ $petugas["alamat"] }}</td>
                                    <td class="py-3">{{ $petugas["nm_jbtn"] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        
</div>