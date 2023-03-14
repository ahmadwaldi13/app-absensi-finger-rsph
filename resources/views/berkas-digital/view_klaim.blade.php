@extends('berkas-digital.layouts.view_klaim_master')

@section('header')
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <script>var base_url = "{{url('/')}}/";
    </script>
    <script src="{{ asset('libs/jquery/3.2.1/jquery.min.js' )}}"></script>
    <script src="{{ asset('libs/jquery/jquery-qrcode/jquery.qrcode.js' )}}"></script>
    <script src="{{ asset('libs/jquery/jquery-qrcode/qrcode.js' )}}"></script>
    <?php $source = "asset"?>
@endsection

@section('additional-section')

    @if(!empty($dataShown["1"]) or 
        !empty($dataShown["2"]) or 
        !empty($dataShown["3"]) or 
        (!empty($dataShown["4"]) and !empty($resume_pasien))  or 
        (!empty($dataShown["5"]) and !empty($laporan_operasi)) )
        <?php $klaimButton = true;?>
        <div class="d-flex justify-content-end mb-2 ">
            <?php $pdf_url = url('/berkas-digital/unduh_klaim_berkas?no_rm='.$dataPasien['no_rkm_medis'].'&no_rw='.$reg_periksa['no_rawat']);?>
            <a class="btn btn-lg btn-primary  p-2" href="{{ $pdf_url }}" target="_blank" role="button" style="margin-right:40px;margin-top:-30px;">
                Unduh Berkas Klaim
            </a>
        </div>
    @endisset
                            
    @isset($dataShown["6"])
        <?php $berkasButton = true;?>
        <section id="berkas">
            <h3 class="fw-bold text-center">BERKAS UNGGAH</h3>
            @if ($message = Session::get('success_del'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            @if ($message = Session::get('error_del'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="mt-1 d-flex justify-content-center align-items-center flex-column ">
                @if(count($berkas_list) > 0)
                
                <table class="table  w-75 border">
                    <thead>
                        <tr>
                            <th class="text-start">Jenis Berkas</th>
                            <th>Nama File</th>
                            <th>Ukuran File</th>
                            <th  class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($berkas_list as $b)
                            @if($b["id_jenis_bdig"] == "1")
                                <tr style="background-color:#eee">
                            @else
                                <tr style="background-color:white"> 
                            @endif
                                <td>{{$b["jenis_file"]}}</td>
                                <td>{{$b["name"]}}</td>
                                <td>{{isset($b["file_size"]) ? $b["file_size"] : "" }}</td>
                                <td class="d-flex justify-content-end">
                                    <a class="btn btn-primary me-3" href="{{ asset('public/upload/berkas_digital/'.$b['url'])}}" target="_blank" role="button">Lihat</a>
                                    <button type="button" class="btn btn-danger" onclick="openDeleteConfirm('{{$b['jenis_file']}}','{{$b['id']}}', '{{$b['url']}}')">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <div class="d-flex justify-content-end w-75 mb-2">
                    <?php $url = url('/berkas-digital/unduh_berkas?no_rm='.$dataPasien['no_rkm_medis'].'&no_rw='.$reg_periksa['no_rawat']);?>
                    <a class="btn btn-sm btn-primary  p-2" href="{{ $url }}" target="_blank" role="button">
                        Unduh Berkas
                    </a>
                </div>
                @else
                    <div class="text-center p-10">
                        <div class="alert alert-secondary" role="alert">
                            Pasien ini tidak memiliki berkas yang tersimpan
                        </div>
                    </div>
                @endif
            </div>
        
            <!-- modal tampilkan gambar -->
            <div class="modal fade" id="viewImageModal" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg ">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewImageModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-item-center">
                        <img id="modal_image" src="" alt="" width="60%">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- modal konfirmasi hapus gambar -->
            <div class="modal fade" id="deleteImage" tabindex="-1" aria-labelledby="deleteImageLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form >
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteImageLabel">
                                    Hapus Berkas 
                                    <span></span> 
                                    <div class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda Yakin Menghapus Berkas Ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </section>

        @isset($klaimButton, $berkasButton)
            <div class="d-flex justify-content-end my-5 ">
                <?php $unduh_semua_url = url('/berkas-digital/unduh_semua_berkas?no_rm='.$dataPasien['no_rkm_medis'].'&no_rw='.$reg_periksa['no_rawat']);?>
                <a class="btn btn-lg btn-primary  p-2" href="{{ $unduh_semua_url }}" target="_blank" role="button" style="margin-right:40px;margin-top:-30px;">
                    Unduh Semua Berkas
                </a>
            </div>
        @endisset
    @endisset
@endsection

@section("additional-scripts")
    <script src="{{ asset('bootstrap/js/bootstrap.js' )}}"></script>   
    <script src="{{asset('js/berkasDigital/pdfView.js')}}"></script>
@endsection
