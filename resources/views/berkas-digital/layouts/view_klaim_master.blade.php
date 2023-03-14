
<?php
function qrcode($str){
    return QrCode::size(300)->generate($str)->toHtml();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berkas Digital</title>
    @section("header")
    <?php $source = "public_path"?>
    @show
    <?php 
        function source_static($url){
            global $source;
            if ($source == "public_path") return public_path($url);
            return asset($url);
        }
    ?>
    <link rel="stylesheet" href="{{source_static('css/berkas_digital/pdf.css')}}">
</head>
<body>
    
    <header>
        <img src="{{ source_static('icon/bpjslogo.png')}}" alt="Image" width="400" height="68">
    </header>
    @isset($dataShown["1"])
        <section id="eligibilitas">
            <div class="section-header">
                <h1 class="fw-bold text-center">SURAT ELEGIBILITAS PESERTA</h1>
                <h2 class="fw-lighter text-center">{{$settings["nama_instansi"]}}</h2>
            </div>
            
            <div class="section-body">
                <b><u>PRB : @isset($print_sep["bpjs_prb"]) {{$print_sep["bpjs_prb"]["prb"]}} @endisset</u></b>
                <table>
                    <tr>
                        <td width="50%" colspan="2">
                            <span>No. SEP</span>: @isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["no_sep"]}} @endisset
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" colspan="2">
                            <span>Tgl. SEP</span>: @isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["tglsep"]}} @endisset
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <span>No. Kartu</span>: @isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["no_kartu"]}} @endisset
                        </td>
                        <td width="50%">
                            <span>Peserta</span>:  @isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["peserta"]}} @endisset
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%">
                            <span>Nama Peserta</span>: @isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["nama_pasien"]}} @endisset
                        </td>
                        <td width="50%">
                            <span>COB</span>: @isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["cob"]}} @endisset
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" >
                            <span>Tgl. Lahir</span>: @isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["tanggal_lahir"]}} @endisset
                                                            Kelamin: @isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["jkel"]}} @endisset 
                        </td>
                        <td width="50%" >
                            <span>Jns. Rawat</span>: 
                            @isset($print_sep["bridging_sep"]) 
                                @if($print_sep["bridging_sep"]["jnspelayanan"] == 2) 
                                    R.Jalan
                                @else
                                    R.Inap
                                @endif
                            @endisset 
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <span>No. Telepon</span>:  @isset($print_sep["bridging_sep"]["notelep"]){{ $print_sep["bridging_sep"]["notelep"]}} @endisset
                        </td>
                        <td width="50%">
                            <span>Kls. Rawat</span>:  
                            @isset($print_sep["bridging_sep"]) 
                                @if($print_sep["bridging_sep"]["klsrawat"] == 1) 
                                Kelas 1
                                @elseif($print_sep["bridging_sep"]["klsrawat"] == 2)
                                Kelas 2
                                @else
                                Kelas 3
                                @endif
                            @endisset
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" >
                            <span>Spesialis/Sub Spesialis</span>: @isset($print_sep["bridging_sep"]["nmpolitujuan"]){{ $print_sep["bridging_sep"]["nmpolitujuan"] }}@endisset
                        </td>
                        <td width="50%" >
                            <span>Penjamin</span>: @isset($print_sep["bridging_sep"]["penjamin"] ){{ $print_sep["bridging_sep"]["penjamin"] }}@endisset
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%" colspan="2">
                            <span>DPJP Yg Melayani</span>: @isset($print_sep["bridging_sep"]["nmdpdjp"]) {{$print_sep["bridging_sep"]["nmdpdjp"] }}@endisset
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%" colspan="2">
                            <span>Faskes Perujuk</span>: @isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["nmppkrujukan"]}} @endisset
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%" colspan="2">
                            <span>Diagnosa Awal</span>: @isset($print_sep["bridging_sep"]){{ $print_sep["bridging_sep"]["nmdiagnosaawal"] }}@endisset
                        </td>
                    </tr>
        
                    <tr>
                        <td width="50%" colspan="2">
                            <span>Catatan</span>: @isset($print_sep["bridging_sep"]){{ $print_sep["bridging_sep"]["catatan"] }}@endisset
                        </td>
                    </tr>
                </table>
            </div>

            <div class="bottom_eligibilitas section-footer">
                <table>
                    <tr>
                        <td class="agreement ">
                            <p>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan.</p>
                            <p>**SEP bukan sebagai bukti penjaminan peserta</p>
                            <p>Cetakan ke 1 <?= date("d/m/Y H:i:s A")?></p>
                            <p>Masa berlaku {{isset($print_sep["bridging_sep"]) ? $print_sep["bridging_sep"]["tglrujukan"] : ""}} s/d {{isset($print_sep["batas_rujukan"]) ? $print_sep["bridging_sep"] : ""}}</p>
                        </td>
                        <td class=" text-end">
                            <div class="d-inline-block text-center page-break-inside-avoid">
                                <p>Pasien/Keluarga Pasien</p>
                                <div class="qrCode">
                                    <?php $text = "No SEP: ".(isset($print_sep["bridging_sep"]) ? $print_sep["bridging_sep"]["no_sep"] : "");?>
                                    <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                                </div>
                                <p>@isset($print_sep["bridging_sep"]) {{$print_sep["bridging_sep"]["nama_pasien"]}} @endisset</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        </section>
        @isset($dataShown["2"])
            <div class="page-break"></div>
        @endisset
    @endisset

    @isset($dataShown["2"])
        <section id="soap">
            <div class="section-header">
                <h1 class="fw-bold text-center">SOAP dan Riwayat Perawatan</h1>
            </div>
            
            <div class="section-body">
                <table id="table_soap">
                    <tbody>
                        <tr>
                            <td>No. RM</td> 
                            <td>:</td>
                            <td>{{ $dataPasien["no_rkm_medis"]}} </td>  
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td>{{ $dataPasien["nm_pasien"]}} </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $dataPasien["alamat"]}} </td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>{{ $dataPasien["umur"]}} ({{$dataPasien["jk"] == 'L' ? 'Laki-Laki' : 'Perempuan'}})</td>
                        </tr>
                        <tr>
                            <td>Tempat & Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ $dataPasien["tmp_lahir"]}} / {{ $dataPasien["tgl_lahir"]}} </td>
                        </tr>
                        <tr>
                            <td>Ibu Kandung</td>
                            <td>:</td>
                            <td>{{ $dataPasien["nm_ibu"]}} </td>
                        </tr>
                        <tr>
                            <td>Golongan Darah</td>
                            <td>:</td>
                            <td>{{ $dataPasien["gol_darah"]}} </td></tr>
                        <tr>
                            <td>Status Nikah</td>
                            <td>:</td>
                            <td>{{ $dataPasien["stts_nikah"]}}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>{{ $dataPasien["agama"]}} </td>
                        </tr>
                        <tr>
                            <td>Pendidikan Terakhir</td>
                            <td>:</td>
                            <td>{{ $dataPasien["pnd"]}} </td>
                        </tr>
                        <tr>
                            <td>Pertama Daftar</td>
                            <td>:</td>
                            <td>{{ $dataPasien["tgl_daftar"]}} </td>
                        </tr>
                        <tr>
                            <td>No.Rawat</td>
                            <td>:</td>
                            <td>{{ $reg_periksa["no_rawat"]}} </td>
                        </tr>
                        <tr>
                            <td>No.Registrasi</td>
                            <td>:</td>
                            <td>{{ $reg_periksa["no_reg"]}} </td>
                        </tr>
                        <tr>
                            <td>Tanggal Registrasi</td>
                            <td>:</td>
                            <td>{{ $reg_periksa["tgl_registrasi"]}} {{ $reg_periksa["jam_reg"]}}</td>
                        </tr>
                        <tr>
                            <td>Unit/Poliklinik</td>
                            <td>:</td>
                            <td>{{ $reg_periksa["nm_poli"]}}, {{ $rujukan_internal["nm_poli"]}}</td>
                        </tr>
                        <tr>
                            <td>Dokter</td>
                            <td>:</td>
                            <td>
                                @if($reg_periksa["status_lanjut"] === 'Ralan')
                                    {{$reg_periksa["nm_dokter"]}} <br>
                                    {{$rujukan_internal["nm_dokter"]}}
                                @else
                                    tes
                                @endif
                
                            </td>
                        </tr>
                        <tr>
                            <td>Cara Bayar</td>
                            <td>:</td>
                            <td>{{ $reg_periksa["png_jawab"]}} </td>
                        </tr>
                        <tr>
                            <td>Penanggung Jawab</td>
                            <td>:</td>
                            <td>{{ $reg_periksa["p_jawab"]}} </td>
                        </tr>
                        <tr>
                            <td>Alamat P.J.</td>
                            <td>:</td>
                            <td>{{ $reg_periksa["almt_pj"]}} </td>
                        </tr>
                        <tr>
                            <td>Hubungan P.J.</td>
                            <td>:</td>
                            <td>{{ $reg_periksa["hubunganpj"]}} </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>{{ $reg_periksa["status_lanjut"]}} </td>
                        </tr>
                        <tr>
                            <td>Diagnosa/Penyakit/ICD 10</td>
                            <td>:</td>
                            <td>
                                <table width="100%" cellpadding="3px" cellspacing="0" class="tbl_form">
                                    <tr>
                                        <td valign="top" width="24%" >Kode</td>
                                        <td valign="top" width="55%" >Nama Penyakit</td>
                                        <td valign="top" width="23%" >Status</td>
                                    </tr>
                                    @foreach($diagnosa_pasien as $v)
                                    <tr>
                                        <td valign="top">{{$v["kd_penyakit"]}}</td>
                                        <td valign="top">{{$v["nm_penyakit"]}}</td>
                                        <td valign="top">{{$v["status"]}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Prosedur Tindakan/ICD 9</td>
                            <td>:</td>
                            <td>
                            <table width="100%" cellpadding="3px" cellspacing="0" class="tbl_form">
                                    <tr>
                                        <td valign="top" width="24%" >Kode</td>
                                        <td valign="top" width="55%" >Nama Penyakit</td>
                                        <td valign="top" width="23%" >Status</td>
                                    </tr>
                                    @foreach($prosedur_pasien as $v)
                                    <tr>
                                        <td valign="top">{{$v["kode"]}}</td>
                                        <td valign="top">{{$v["deskripsi_panjang"]}}</td>
                                        <td valign="top">{{$v["status"]}}</td>
                                    </tr>
                                    @endforeach
                                </table>
            
                            </td>
                        </tr>
                        
                        @if(count($pemeriksaan_ralan) > 0)
                        <tr>
                            <td>Pemeriksaan Rawat Jalan</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td width="9%" valign="top" >Tanggal</td>
                                        <td width="9%" valign="top" >Sudu (C)</td>
                                        <td width="9%" valign="top" >Tensi</td>
                                        <td width="9%" valign="top" >Nadi (/menit)</td>
                                        <td width="9%" valign="top" >RR (/menit)</td>
                                        <td width="9%" valign="top" >Tinggi (Cm)</td>
                                        <td width="9%" valign="top" >Berat (Kg)</td>
                                        <td width="9%" valign="top" >GCS (E,V,M)</td>
                                        <td width="9%" valign="top" >Kesadaran</td>
                                    </tr>
                                    @foreach($pemeriksaan_ralan as $p)
                                        <tr>
                                            <td valign="top">{{$p["tgl_perawatan"]}} {{$p["jam_rawat"]}}</td>
                                            <td valign="top">{{$p["suhu_tubuh"]}}</td>
                                            <td valign="top">{{$p["tensi"]}}</td>
                                            <td valign="top">{{$p["nadi"]}}</td>
                                            <td valign="top">{{$p["respirasi"]}}</td>
                                            <td valign="top">{{$p["tinggi"]}}</td>
                                            <td valign="top">{{$p["berat"]}}</td>
                                            <td valign="top">{{$p["gcs"]}}</td>
                                            <td valign="top">{{$p["kesadaran"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Subjek</td>
                                            <td valign="top" colspan="7"> : {{$p["keluhan"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Objek</td>
                                            <td valign="top" colspan="7"> : {{$p["pemeriksaan"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Asesmen</td>
                                            <td valign="top" colspan="7"> : {{$p["penilaian"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Plan</td>
                                            <td valign="top" colspan="7"> : {{$p["rtl"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Alergi</td>
                                            <td valign="top" colspan="7"> : {{$p["alergi"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
            
                            </td>
                        </tr>
                        @endif
                        @if(count($pemeriksaan_ranap) > 0)
                        <tr>
                            <td>Pemeriksaan Rawat Inap</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td width="9%" valign="top" >Tanggal</td>
                                        <td width="9%" valign="top" >Sudu (C)</td>
                                        <td width="9%" valign="top" >Tensi</td>
                                        <td width="9%" valign="top" >Nadi (/menit)</td>
                                        <td width="9%" valign="top" >RR (/menit)</td>
                                        <td width="9%" valign="top" >Tinggi (Cm)</td>
                                        <td width="9%" valign="top" >Berat (Kg)</td>
                                        <td width="9%" valign="top" >GCS (E,V,M)</td>
                                        <td width="9%" valign="top" >Kesadaran</td>
                                    </tr>
                                    @foreach($pemeriksaan_ralan as $p)
                                        <tr>
                                            <td valign="top">{{$p["tgl_perawatan"]}} {{$p["jam_rawat"]}}</td>
                                            <td valign="top">{{$p["suhu_tubuh"]}}</td>
                                            <td valign="top">{{$p["tensi"]}}</td>
                                            <td valign="top">{{$p["nadi"]}}</td>
                                            <td valign="top">{{$p["respirasi"]}}</td>
                                            <td valign="top">{{$p["tinggi"]}}</td>
                                            <td valign="top">{{$p["berat"]}}</td>
                                            <td valign="top">{{$p["gcs"]}}</td>
                                            <td valign="top">{{$p["kesadaran"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Subjek</td>
                                            <td valign="top" colspan="7"> : {{$p["keluhan"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Objek</td>
                                            <td valign="top" colspan="7"> : {{$p["pemeriksaan"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Asesmen</td>
                                            <td valign="top" colspan="7"> : {{$p["penilaian"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Plan</td>
                                            <td valign="top" colspan="7"> : {{$p["rtl"]}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2">Alergi</td>
                                            <td valign="top" colspan="7"> : {{$p["alergi"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
            
                            </td>
                        </tr>
                        @endif
            
                        @if(count($rawat_jl_dr) > 0)
                        <tr>
                            <td>Tindakan Rawat Jalan Dokter</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td valign='top' width='10%'>Tanggal</td>
                                        <td valign='top' width='10%'>Kode</td>
                                        <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
                                        <td valign='top' width='20%'>Dokter</td>
                                    </tr>
                                    @foreach($rawat_jl_dr as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_perawatan"]}}</td>
                                            <td valign="top">{{$v["kd_jenis_prw"]}}</td>
                                            <td valign="top">{{$v["nm_perawatan"]}}</td>
                                            <td valign="top">{{$v["nm_dokter"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                        @if(count($rawat_jl_pr) > 0)
                        <tr>
                            <td>Tindakan Rawat Jalan Paramedis</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                    <td valign='top' width='10%'>Tanggal</td>
                        <td valign='top' width='10%'>Kode</td>
                        <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
                        <td valign='top' width='20%'>Perawat</td>
                                    </tr>
                                    @foreach($rawat_jl_pr as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_perawatan"]}}</td>
                                            <td valign="top">{{$v["kd_jenis_prw"]}}</td>
                                            <td valign="top">{{$v["nm_perawatan"]}}</td>
                                            <td valign="top">{{$v["nm_dokter"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                        @if(count($rawat_jl_drpr) > 0)
                        <tr>
                            <td>Tindakan Rawat Jalan Dokter & Perawat</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                    <td valign='top' width='10%'>Tanggal</td>
                        <td valign='top' width='10%'>Kode</td>
                        <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
                        <td valign='top' width='15%'>Dokter</td>
                        <td valign='top' width='15%'>Petugas</td>
                                    </tr>
                                    @foreach($rawat_jl_drpr as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_perawatan"]}}</td>
                                            <td valign="top">{{$v["kd_jenis_prw"]}}</td>
                                            <td valign="top">{{$v["nm_perawatan"]}}</td>
                                            <td valign="top">{{$v["nm_dokter"]}}</td>
                                            <td valign="top">{{$v["nama"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                        @if(count($rawat_inap_dr) > 0)
                        <tr>
                            <td>Tindakan Rawat Inap Dokter</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                    <td valign='top' width='10%'>Tanggal</td>
                        <td valign='top' width='10%'>Kode</td>
                        <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
                        <td valign='top' width='20%'>Dokter</td>
                                    </tr>
                                    @foreach($rawat_inap_dr as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_perawatan"]}}</td>
                                            <td valign="top">{{$v["kd_jenis_prw"]}}</td>
                                            <td valign="top">{{$v["nm_perawatan"]}}</td>
                                            <td valign="top">{{$v["nm_dokter"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                        @if(count($rawat_inap_pr) > 0)
                        <tr>
                            <td>Tindakan Rawat Inap Perawat</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                    <td valign='top' width='10%'>Tanggal</td>
                        <td valign='top' width='10%'>Kode</td>
                        <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
                        <td valign='top' width='20%'>Petugas</td>
                                    </tr>
                                    @foreach($rawat_inap_pr as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_perawatan"]}}</td>
                                            <td valign="top">{{$v["kd_jenis_prw"]}}</td>
                                            <td valign="top">{{$v["nm_perawatan"]}}</td>
                                            <td valign="top">{{$v["nm_dokter"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                        @if(count($rawat_inap_drpr) > 0)
                        <tr>
                            <td>Tindakan Rawat Inap Dokter & Perawat</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                    <td valign='top' width='10%'>Tanggal</td>
                        <td valign='top' width='10%'>Kode</td>
                        <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
                        <td valign='top' width='15%'>Dokter</td>
                        <td valign='top' width='15%'>Petugas</td>
                                    </tr>
                                    @foreach($rawat_inap_drpr as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_perawatan"]}}</td>
                                            <td valign="top">{{$v["kd_jenis_prw"]}}</td>
                                            <td valign="top">{{$v["nm_perawatan"]}}</td>
                                            <td valign="top">{{$v["nm_dokter"]}}</td>
                                            <td valign="top">{{$v["nama"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                        @if(count($kamar_inap) > 0)
                        <tr>
                            <td>Kamar Inap</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td valign='top' width='15%'>Tanggal Masuk</td>
                                        <td valign='top' width='15%'>Tanggak Keluar</td>
                                        <td valign='top' width='10%'>Lama Inap</td>
                                        <td valign='top' width='35%'>Kamar</td>
                                        <td valign='top' width='10%'>Status</td>
                                    </tr>
                                    @foreach($kamar_inap as $v)
                                        <tr>
                                            <td valign="top">{{$v["jam_masuk"]}}</td>
                                            <td valign="top">{{$v["tgl_keluar"]}} {{$v["jam_keluar"]}}</td>
                                            <td valign="top">{{$v["lama"]}}</td>
                                            <td valign="top">{{$v["kd_kamar"]}} {{$v["nm_bangsal"]}}</td>
                                            <td valign="top">{{$v["stts_pulang"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                        @if(count($operasi) > 0)
                        <tr>
                            <td>Operasi</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td valign='top' width='10%' >Tanggal</td>
                                        <td valign='top' width='10%' >Kode</td>
                                        <td valign='top' width='45%' >Nama Tindakan/Perawatan</td>
                                        <td valign='top' width='20%' >Anastesi</td>
                                    </tr>
                                    @foreach($operasi as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_operasi"]}}</td>
                                            <td valign="top">{{$v["kode_paket"]}} </td>
                                            <td valign="top">{{$v["nm_perawatan"]}}</td>
                                            <td valign="top">{{$v["jenis_anasthesi"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                        @if(count($tindakan_radiologi) > 0)
                        <tr>
                            <td>Tindakan Radiologi</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td valign='top' width='10%'>Tanggal</td>
                                        <td valign='top' width='10%'>Kode</td>
                                        <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
                                        <td valign='top' width='20%'>Dokter</td>
                                        <td valign='top' width='10%'>Petugas</td>
                                    </tr>
                                    @foreach($tindakan_radiologi as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_periksa"]}} {{$v["jam"]}}</td>
                                            <td valign="top">{{$v["kd_jenis_prw"]}} </td>
                                            <td valign="top">{{$v["nm_perawatan"]}}</td>
                                            <td valign="top">{{$v["nm_dokter"]}}</td>
                                            <td valign="top">{{$v["nama"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                        @if(count($hasil_radiologi) > 0)
                        <tr>
                            <td>Hasil Radiologi</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td valign='top' width='10%' >Tanggal</td>
                                        <td valign='top' width='90%' >Hasil Pemeriksaan</td>
                                    </tr>
                                    @foreach($hasil_radiologi as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_periksa"]}} {{$v["jam"]}}</td>
                                            <td valign="top">{{$v["hasil"]}} </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
            
                        @if(count($pemeriksaan_laboratorium) > 0)
                        <tr>
                            <td>Pemeriksaan Laboratorium </td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td valign="top" width="20%" >Tanggal</td>
                                        <td valign="top" width="20%" >Nama Tindakan</td>
                                        <td valign="top" width="20%" >Hasil</td>
                                        <td valign="top" width="20%" >Nilai Rujukan</td>
                                        <td valign="top" width="20%" >Keterangan</td>
                                    </tr>
                                    @foreach($pemeriksaan_laboratorium as $v)
                                        <tr>
                                            <th valign="top" width="20%">{{$v["tgl_periksa"]}}</th>
                                            <th colspan="4" valign="top" width="80%">{{$v["nm_perawatan"]}}</th>
                                        </tr>
                                        @foreach($v["detail_periksa_lab"] as $d)
                                        <tr>
                                            <td valign="top"></td>
                                            <td valign="top">{{$d["Pemeriksaan"]}} </td>
                                            <td valign="top">{{$d["nilai"]}} {{$d["satuan"]}}</td>
                                            <td valign="top">{{$d["nilai_rujukan"]}}</td>
                                            <td valign="top"><?= nl2br($d["keterangan"]) ?></td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
            
                        @if(count($pemberian_obat) > 0)
                        <tr>
                            <td>Pemberian Obat</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td valign='top' width='10%'>Tanggal</td>
                                        <td valign='top' width='10%'>Kode</td>
                                        <td valign='top' width='45%'>Nama Obat</td>
                                        <td valign='top' width='20%'>Jumlah</td>
                                    </tr>
                                    @foreach($pemberian_obat as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_perawatan"]}} {{$v["jam"]}}</td>
                                            <td valign="top">{{$v["kode_brng"]}} </td>
                                            <td valign="top">{{$v["nama_brng"]}}</td>
                                            <td valign="top">{{$v["jml"]}} {{$v["kode_sat"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
            
                        @if(count($obat_operasi) > 0)
                        <tr>
                            <td>Obat Operasi</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td valign='top' width='10%'>Tanggal</td>
                                        <td valign='top' width='10%'>Kode</td>
                                        <td valign='top' width='45%'>Nama Obat</td>
                                        <td valign='top' width='20%'>Jumlah</td>
                                    </tr>
                                    @foreach($obat_operasi as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_perawatan"]}} {{$v["jam"]}}</td>
                                            <td valign="top">{{$v["kode_brng"]}} </td>
                                            <td valign="top">{{$v["nama_brng"]}}</td>
                                            <td valign="top">{{$v["jumlah"]}} {{$v["kode_sat"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
            
                        @if(count($resep_pulang) > 0)
                        <tr>
                            <td>Obat Operasi</td>
                            <td>:</td>
                            <td>
                                <table class="pemeriksaan">
                                    <tr>
                                        <td valign='top' width='10%'>Tanggal</td>
                                        <td valign='top' width='10%'>Kode</td>
                                        <td valign='top' width='45%'>Nama Obat</td>
                                        <td valign='top' width='10%'>Jumlah</td>
                                        <td valign='top' width='20%'>Dosis</td>
                                    </tr>
                                    @foreach($resep_pulang as $v)
                                        <tr>
                                            <td valign="top">{{$v["tgl_perawatan"]}} {{$v["jam"]}}</td>
                                            <td valign="top">{{$v["kode_brng"]}} </td>
                                            <td valign="top">{{$v["nama_brng"]}}</td>
                                            <td valign="top">{{$v["jumlah"]}} {{$v["kode_sat"]}}</td>
                                            <td valign="top">{{$v["dosis"]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="section-footer text-end">
                <div class="d-inline-block  text-center page-break-inside-avoid">
                    <h5>Dokter Penanggung Jawab</h5>
                    @if($reg_periksa["status_lanjut"] == 'Ralan')
                        <div class="qrCode">
                            <?php $text = "DPJP: ".$reg_periksa['nm_dokter'];?>
                            <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                        </div>
                        <p>{{$reg_periksa["nm_dokter"]}}</p>
                    @else
                        @foreach($dpjp_ranap as $value)
                            <div>
                                <?php $text = "DPJP: ".$value['nm_dokter'];?>
                                <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                            </div>
                            {{$value['nm_dokter']}}<br>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        @isset($dataShown["3"])
            <div class="page-break"></div>
        @endisset
    @endisset

    @isset($dataShown["3"])
        <section id="billing">
            <div class="section-header">
                <h1 class="fw-bold">Billing</h1>
                <h6>{{$settings["nama_instansi"]}}</h6>
                <small>{{$settings["alamat"]}}, {{$settings["kabupaten"]}}, {{$settings["propinsi"]}}</small><br>
                <small>Telepon: {{$settings["kontak"]}} - e-Mail : {{$settings["email"]}}</small>
            </div>

            <div class="section-body">
                <table class="">
                @foreach($billing as $value)
                    <?php
                        $value = array_values($value);
                    ?>
                    <tr class="isi12" padding="0">
                        <td padding="0" width="18%"><font color="111111" size="1"  face="Tahoma">{{$value[0]}}</td>
                        <td padding="0" width="40%"><font color="111111" size="1"  face="Tahoma">{{$value[1]}}</td>
                        <td padding="0" width="2%"><font color="111111" size="1"  face="Tahoma">{{$value[2]}}</td>
                        <td padding="0" width="10%" align="right"><font color="111111" size="1"  face="Tahoma">{{$value[3]}}</td>
                        <td padding="0" width="5%" align="right"><font color="111111" size="1"  face="Tahoma">{{$value[4]}}</td>
                        <td padding="0" width="10%" align="right"><font color="111111" size="1"  face="Tahoma">{{$value[5]}}</td>
                        <td padding="0" width="15%" align="right"><font color="111111" size="1"  face="Tahoma">{{$value[6]}}</td>
                    </tr>
                    @endforeach
                    <tr class="isi12" padding="0">
                        <td padding="0" width="18%"><font color="111111" size="1"  face="Tahoma"><b>TOTAL BIAYA</b></td>
                        <td padding="0" width="40%"><font color="111111" size="1"  face="Tahoma"><b>:</b></td>
                        <td padding="0" width="2%"><font color="111111" size="1"  face="Tahoma"></td>
                        <td padding="0" width="10%" align="right"><font color="111111" size="1"  face="Tahoma"></td>
                        <td padding="0" width="5%" align="right"><font color="111111" size="1"  face="Tahoma"></td>
                        <td padding="0" width="10%" align="right"><font color="111111" size="1"  face="Tahoma"></td>
                        <td padding="0" width="15%" align="right"><font color="111111" size="1"  face="Tahoma"><b>{{$total}}</b></td>
                    </tr>
                </table>
            </div>
            <div class="section-footer">
                <table>
                    <td class="w-50 text-center page-break-inside-avoid">
                        <p class="text-center">Keluarga Pasien</p>
                        <div class="qrCode">
                            <?php $text = "Nama Pasien: ".(isset($print_sep["bridging_sep"]) ? $print_sep["bridging_sep"]["nama_pasien"] : "");?>
                            <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                        </div>
                    </td>
                    <td class="w-50 text-center page-break-inside-avoid">
                        <p class="text-center">Kasir</p>
                        <div class="qrCode" >
                            <?php $text = "Kasir: KASIR RS AURA SYIFA";?>
                            <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                        </div>
                    </td>
                </table>
            </div>

        </section>
        @isset($resume_pasien, $dataShown["4"])
            <div class="page-break"></div>
        @endisset
    @endisset
    
    @isset($resume_pasien, $dataShown["4"])
        <section id="resume">
                            
                <div class="section-header">
                    <h1 class="fw-bold">RESUME PERAWATAN</h1>
                </div>
                <div class="section-body">

                    <table class="table border">
                        <tr>
                            <td width="30%">Dokter DPJP</td>
                            <td width="70%"> : {{$resume_pasien["nm_dokter"]}}</td>
                        </tr>
                        <tr>
                            <td width="30%">Nomor Rawat</td>
                            <td width="70%"> : {{$resume_pasien["no_rawat"]}}</td>
                        </tr>
                        <tr>
                            <td>Kondisi Pulang</td>
                            <td> : {{$resume_pasien["kondisi_pulang"]}}</td>
                        </tr>
                        <tr>
                            <td>Keluhan Utama Riwayat Penyakit Yang Positif</td>
                            <td> : {{$resume_pasien["keluhan_utama"]}}</td>
                        </tr>
                        <tr>
                            <td>Jalannya Penyakit Selama Perawatan</td>
                            <td> : {{$resume_pasien["jalannya_penyakit"]}}</td>
                        </tr>
                        <tr>
                            <td>Pemeriksaan Penunjang Yang Positif</td>
                            <td> : {{$resume_pasien["pemeriksaan_penunjang"]}}</td>
                        </tr>
                        <tr>
                            <td>Hasil Laboratorium Yang Positif</td>
                            <td> : {{$resume_pasien["hasil_laborat"]}}</td>
                        </tr>
                        <tr align="left">
                            <td width="20%">Diagnosa Utama</td><td width="70%">: {{$resume_pasien["diagnosa_utama"]}}</td><td width="10%"> {{$resume_pasien["kd_diagnosa_utama"]}}</td>
                        </tr>
                        <tr align="left">
                            <td width="20%">Diagnosa Sekunder 1</td><td width="70%">: {{$resume_pasien["diagnosa_sekunder"]}}</td><td width="10%"> {{$resume_pasien["kd_diagnosa_sekunder"]}}</td>
                        </tr>
                        <tr align="left">
                            <td width="20%">Diagnosa Sekunder 2</td><td width="70%">: {{$resume_pasien["diagnosa_sekunder2"]}}</td><td width="10%"> {{$resume_pasien["kd_diagnosa_sekunder2"]}}</td>
                        </tr>
                        <tr align="left">
                            <td width="20%">Diagnosa Sekunder 3</td><td width="70%">: {{$resume_pasien["diagnosa_sekunder3"]}}</td><td width="10%"> {{$resume_pasien["kd_diagnosa_sekunder3"]}}</td>
                        </tr>
                        <tr align="left">
                            <td width="20%">Diagnosa Sekunder 4</td><td width="70%">: {{$resume_pasien["diagnosa_sekunder4"]}}</td><td width="10%"> {{$resume_pasien["kd_diagnosa_sekunder4"]}}</td>
                        </tr>
                        <tr align="left">
                            <td width="20%">Prosedur Utama</td><td width="70%">: {{$resume_pasien["prosedur_utama"]}}</td><td width="10%"> {{$resume_pasien["kd_prosedur_utama"]}}</td>
                        </tr>
                        <tr align="left">
                            <td width="20%">Prosedur Sekunder 1</td><td width="70%">: {{$resume_pasien["prosedur_sekunder"]}}</td><td width="10%"> {{$resume_pasien["kd_prosedur_sekunder"]}}</td>
                        </tr>
                        <tr align="left">
                            <td width="20%">Prosedur Sekunder 2</td><td width="70%">: {{$resume_pasien["prosedur_sekunder2"]}}</td><td width="10%"> {{$resume_pasien["kd_prosedur_sekunder2"]}}</td>
                        </tr>
                        <tr align="left">
                            <td width="20%">Prosedur Sekunder 3</td><td width="70%">: {{$resume_pasien["prosedur_sekunder3"]}}</td><td width="10%"> {{$resume_pasien["kd_prosedur_sekunder3"]}}</td>
                        </tr>
                        <tr>
                            <td>Obat-obatan Waktu Pulang/Nasihat</td>
                            <td> : {{$resume_pasien["obat_pulang"]}}</td>
                        </tr>
                    </table>
                </div>

                    
                <div class="section-footer text-end">
                    <div class="text-center d-inline-block page-break-inside-avoid">
                        <h5>Dokter Penanggung Jawab</h5>
                        <div class="qrCode">
                            <?php $text = "DPJP: ".$resume_pasien['nm_dokter'];?>
                            <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                        </div>
                        <p>{{$resume_pasien["nm_dokter"]}}<p>
                    </div>
                </div>
        </section>
        @isset($laporan_operasi, $dataShown["5"])
            <div class="page-break"></div>
        @endisset
    @endisset

    @isset($laporan_operasi, $dataShown["5"])
        <section id="laporan_operasi">
                <div class="section-header">
                    <h1 class="fw-bold">Resume Laporan Operasi</h1>
                </div>
                <div class="section-body">
                    <table class="table">
                        <tr>
                            <td width="30%">Nomor Rawat</td>
                            <td width="70%"> : {{$laporan_operasi['no_rawat']}}</td>
                        </tr>
                        <tr>
                            <td>Operasi Mulai</td>
                            <td> : {{$laporan_operasi['tanggal']}}</td>
                        </tr>
                        <tr>
                            <td>Selesai Operasi</td>
                            <td> : {{$laporan_operasi['selesaioperasi']}}</td>
                        </tr>
                        <tr>
                            <td>Diagnosa Preop</td>
                            <td> : {{$laporan_operasi['diagnosa_preop']}}</td>
                        </tr>
                        <tr>
                            <td>Diagnosa Postop</td>
                            <td> : {{$laporan_operasi['diagnosa_postop']}}</td>
                        </tr>
                        <tr>
                            <td>Jaringan Eksekusi</td>
                            <td> : {{$laporan_operasi['jaringan_dieksekusi']}}</td>
                        </tr>
                        <tr>
                            <td>Perimintaan PA</td>
                            <td> : {{$laporan_operasi['permintaan_pa']}}</td>
                        </tr>
                        <tr>
                            <td>Laporan Operasi</td>
                            <td> : {{$laporan_operasi['laporan_operasi']}}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="text-end" >
                    <div class="text-center d-inline-block page-break-inside-avoid">
                            <h5>Dokter Penanggung Jawab</h5>
                            <div class="qrCode">
                                <?php $text = "DPJP: ".$resume_pasien['nm_dokter'];?>
                                <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                            </div>
                            <p>{{$resume_pasien["nm_dokter"]}}<p>

                    </div>
                </div>

        </section>
    @endisset

    @section("additional-section")

    @show
    
    @section("additional-scripts")
    @show

</body>
</html>