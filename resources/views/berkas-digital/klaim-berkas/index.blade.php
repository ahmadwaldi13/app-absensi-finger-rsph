@extends('berkas-digital.klaim-berkas.index-berkas-pdf')

@section('header')
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <script>var base_url = "{{url('/')}}/";
    </script>
    <script src="{{ asset('libs/jquery/3.2.1/jquery.min.js' )}}"></script>
    <script src="{{ asset('libs/jquery/jquery-qrcode/jquery.qrcode.js' )}}"></script>
    <script src="{{ asset('libs/jquery/jquery-qrcode/qrcode.js' )}}"></script>
    
@endsection
@section('additional-section')
@php
    $link_params=[
        'no_rawat'=>!empty(Request::get('no_rawat')) ? Request::get('no_rawat') : '',
        'no_rm'=>!empty(Request::get('no_rm')) ? Request::get('no_rm') : '',
        'fr'=>!empty(Request::get('fr')) ? Request::get('fr') : '',
    ];
@endphp
    @if(!empty($dataShown["1"]) or 
        !empty($dataShown["2"]) or 
        !empty($dataShown["3"]) or 
        (!empty($dataShown["4"]) and !empty($resume_pasien))  or 
        (!empty($dataShown["5"]) and !empty($laporan_operasi)) or
        !empty($dataShown["7"]) or 
        !empty($dataShown["8"]) or 
        !empty($dataShown["9"]) or 
        !empty($dataShown["10"]) 
        )

        <?php $klaimButton = true;?>
        <div class="d-flex justify-content-end mb-2 ">
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#optionDownload" style="margin-right:40px;margin-top:30px;">
                Unduh Berkas Klaim
            </button>
        </div>
    @endisset
    @isset($dataShown["100"])
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
                    <?php $url = url('/berkas-digital/unduh_berkas?no_rm='.$link_params['no_rm'].'&no_rw='.$link_params['no_rawat']);?>
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#optionDownloadBerkasUnggah">
                        Unduh Berkas
                    </button>
                </div>
                @else
                    <div class="text-center p-10">
                        <div class="alert alert-secondary" role="alert">
                            Pasien ini tidak memiliki berkas yang tersimpan
                        </div>
                    </div>
                @endif
            </div>
        </section>

        
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
        

        <!-- modal tampilkan optional download berkas klaim -->
        <div class="modal fade" id="optionDownload" tabindex="-1" aria-labelledby="optionDownloadLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="optionDownloadLabel">Opsi Unduh Berkas Klaim</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <div class="d-flex justify-content-between px-2 py-2 berkas_unduh_opsi_container">
                            <label class="d-block w-100" for="berkas_unduh_semua">Semua</label>
                            <input class="form-check-input" type="checkbox" id="berkas_unduh_semua" value="" checked>
                        </div>
                        <?php $pdf_url = url('/berkas-digital/unduh_klaim_berkas');?>
                        <form action="{{ $pdf_url }}" target="_blank">
                            @csrf
                            <input type="text" name="no_rm" value="{{$link_params['no_rm']}}" hidden>
                            <input type="text" name="no_rawat" value="{{$link_params['no_rawat']}}" hidden>
                            <input type="text" name="fr" value="{{$link_params['fr']}}" hidden>

                            <?php
                                $dataShownKey = "";
                                $skdp_keys = [];
                                
                                foreach($dataShown as $key => $value){
                                    if($key != "100"){
                                        if($key == "9" ){
                                            $loop_sub_data = ($key == "9") ? $skdp_data : $spri_data; 
                                            foreach($loop_sub_data as $key_skdp => $val_skdp){
                                                $tgl_surat = !empty($val_skdp->tgl_surat) ? $val_skdp->tgl_surat : "";
                                                array_push($skdp_keys, (string)$key."_".$tgl_surat);
                                            }  
                                            $dataShownKey .= join(",", $skdp_keys).",";
                                        }else {
                                            $dataShownKey .= (string)$key."_,";
                                        }
                                        
                                    }
                                }
                            ?>

                            <input type="text" id="option_download_list" name="option_download_list" value="{{$dataShownKey }}" hidden>
                            @foreach($dataShown as $key=> $value)
                                @if($key != "100")
                                    @if($key == "9")
                                        @php
                                            $loop_sub_data = $skdp_data;
                                        @endphp
                                        <div class="option_checkbox_sub">
                                            <div class="d-flex justify-content-between px-2 py-2 berkas_unduh_opsi_container">
                                                <label class="d-block w-100 " for="berkas_{{$key}}">{{$value}}</label>
                                                <button class="border-0 {{count($loop_sub_data) > 1 ? 'dropdown-toggle' : 'disabled bg-transparent'}}  text-primary me-2" {{count($loop_sub_data) > 1 ? '' : 'disabled'}} type="button" data-bs-toggle="collapse" data-bs-target="#berkas_{{$key}}_sub" aria-expanded="false" aria-controls="berkas_{{$key}}_sub"></button>
                                                <input class="form-check-input" id="berkas_unduh_semua_sub" id="berkas_{{$key}}" type="checkbox"  value="{{$key}}_" checked>
                                            </div>
                                            <div class="ms-5 collapse" id="berkas_{{$key}}_sub">
                                                @foreach($loop_sub_data as $val_sub_data)
                                                    @php 
                                                        $sub_key = !empty($val_sub_data->tgl_surat) ? $val_sub_data->tgl_surat : "";
                                                    @endphp
                                                    <div class="d-flex justify-content-between px-2 py-2 berkas_unduh_opsi_container {{count($loop_sub_data) == 0 ? 'd-none' : ''}}">
                                                        <label class="d-block w-100" for="berkas_{{$key}}_$sub_key">{{!empty($val_sub_data->tgl_rencana) ? date("d F Y", strtotime($val_sub_data->tgl_rencana)) : "N/A"}}</label>
                                                        <input class="berkas_unduh_opsi form-check-input" id="berkas_{{$key}}_$sub_key" type="checkbox"  value="{{$key}}_{{$sub_key}}" checked>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-between px-2 py-2 berkas_unduh_opsi_container">
                                            <label class="d-block w-100" for="berkas_{{$key}}">{{$value}}</label>
                                            <input class="berkas_unduh_opsi form-check-input" type="checkbox" id="berkas_{{$key}}" value="{{$key}}_" checked>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                            

                            
                            
                            <div class="d-flex justify-content-end mt-5">
                                <button type="submit" class="btn btn-primary">Unduh</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

            <!-- modal tampilkan optional download berkas  unggah klaim -->
            <div class="modal fade" id="optionDownloadBerkasUnggah" tabindex="-1" aria-labelledby="optionDownloadBerkasUnggahLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="optionDownloadBerkasUnggahLabel">Opsi Unduh Berkas Unggah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between px-2 py-2 berkas_unduh_opsi_container">
                            <label class="d-block w-100" for="berkas_unduh_semua">Semua</label>
                            <input class="form-check-input" type="checkbox" id="berkas_unduh_semua" value="" checked>
                        </div>
                        <?php $berkas_unggah_url = url('/berkas-digital/unduh_berkas');?>
                        <form action="{{ $berkas_unggah_url }}" target="_blank">
                            @csrf
                            <input type="text" name="no_rm" value="{{$link_params['no_rm']}}" hidden>
                            <input type="text" name="no_rw" value="{{$link_params['no_rawat']}}" hidden>
                            <input type="text" name="fr" value="{{$link_params['fr']}}" hidden>
                            <?php
                                $berkasListKeys = "";
                                foreach($berkas_list as $val){
                                    $berkasListKeys .= (string)$val["id"]." ";
                                }
                                $berkasListKeys = str_replace([" "], ",", trim($berkasListKeys));
                            ?>
                            <input type="text" id="option_download_list" name="option_download_list" value="{{$berkasListKeys }}" hidden>
                            @foreach($berkas_list as $b)
                                <div class="d-flex justify-content-between px-2 py-2 berkas_unduh_opsi_container">
                                    <label class="d-block w-100">{{$b["name"]}}</label>
                                    <input class="berkas_unduh_opsi form-check-input" type="checkbox"  value="{{$b['id']}}" checked>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-end mt-5">
                                <button type="submit" class="btn btn-primary">Unduh</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- modal tampilkan optional download berkas  semus-->
        <div class="modal fade" id="optionDownloadAll" tabindex="-1" aria-labelledby="optionDownloadAllLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered  ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="optionDownloadAllLabel">Opsi Unduh Semua Berkas </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <form action="{{ url('/berkas-digital/unduh_semua_berkas') }}" target="_blank">
                            @csrf
                            <input type="text" name="no_rm" value="{{$link_params['no_rm']}}" hidden>
                            <input type="text" name="no_rawat" value="{{$link_params['no_rawat']}}" hidden>
                            <input type="text" name="fr" value="{{$link_params['fr']}}" hidden>
                            <div class="d-flex">
                                <div id="opsi-semua-klaim" class="w-50 border-end border-gray pe-4">
                                    <p class="text-center font-md">
                                        Berkas Klaim
                                    </p>
                                    <div class="d-flex justify-content-between px-2 py-2 ">
                                        <label class="d-block w-100" for="berkas_unduh_semua">Semua</label>
                                        <input class="form-check-input" type="checkbox" id="berkas_unduh_semua" value="" checked>
                                    </div>
                                        <?php
                                            $dataShownKey = "";
                                            foreach($dataShown as $key => $value){
                                                if($key != "100") $dataShownKey .= (string)$key.",";
                                            }
                                        ?>
                                        <input type="text" id="option_download_list" name="option_download_list_klaim" value="{{$dataShownKey }}" hidden>
                                        @foreach($dataShown as $key=> $value)
                                            @if($key != "100")
                                            <div class="d-flex justify-content-between px-2 py-2 berkas_unduh_opsi_container">
                                                <label class="d-block w-100" for="berkas_{{$key}}">{{$value}}</label>
                                                <input class="berkas_unduh_opsi form-check-input" type="checkbox"  value="{{$key}}" checked>
                                            </div>
                                            @endif
                                        @endforeach
                                    
                                </div>
                                <div id="opsi-semua-unggah" class="w-50 ps-4">
                                    <p class="font-md text-center">
                                        Berkas Unggah
                                    </p>
                                    <div class="d-flex justify-content-between px-2 py-2 ">
                                        <label class="d-block w-100" for="berkas_unduh_semua">Semua</label>
                                        <input class="form-check-input" type="checkbox" id="berkas_unduh_semua" value="" checked>
                                    </div>
                                        <?php
                                            $berkasListKeys = "";
                                            foreach($berkas_list as $val){
                                                $berkasListKeys .= (string)$val["id"]." ";
                                            }
                                            $berkasListKeys = str_replace([" "], ",", trim($berkasListKeys));
                                        ?>
                                        <input type="text" id="option_download_list" name="option_download_list_unggah" value="{{$berkasListKeys }}" hidden>
                                        @foreach($berkas_list as $b)
                                            <div class="d-flex justify-content-between px-2 py-2 berkas_unduh_opsi_container">
                                                <label class="d-block w-100">{{$b["name"]}}</label>
                                                <input class="berkas_unduh_opsi form-check-input" type="checkbox"  value="{{$b['id']}}" checked>
                                            </div>
                                        @endforeach
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-1">
                                <button type="submit" class="btn btn-primary">Unduh</button>
                            </div>
                        </form>                  
                    </div>

                </div>
            </div>
        </div>
    @endisset


@endsection


@section("additional-scripts")
    <script src="{{ asset('bootstrap/js/bootstrap.js' )}}"></script>   
    <script src="{{asset('js/berkasDigital/pdfView.js')}}"></script>
@endsection

