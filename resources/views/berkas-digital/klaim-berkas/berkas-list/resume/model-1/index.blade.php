@php
    $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
@endphp
<section id="resume">
@include('berkas-digital.klaim-berkas.berkas-kop') 
        <div class="section-header">
            <p class="font-lg fw-bold">RESUME MEDIS PERAWATAN</p>
        </div>
        <div class="section-body" >
            @if ($fr == "rj")
                @include("berkas-digital.klaim-berkas.berkas-list.resume.model-1.pasien_data")
            @else
                @include("berkas-digital.klaim-berkas.berkas-list.resume.model-1.pasien_data_ranap")
            @endif
        </div>

            
        <div class="section-footer text-end">
            <div class="text-center d-inline-block page-break-inside-avoid">
                <h5>Dokter Penanggung Jawab</h5>
                @if(!empty($resume_pasien->nm_dokter))
                    <div class="qrCode">
                        <?php 
                            if($fr === "rj"){
                                $text = "DPJP: ".!empty($resume_pasien->nm_dokter) ? $resume_pasien->nm_dokter : "" ;
                            }else{
                                $text = "Dikeluarkan di ".(!empty($settings->nama_instansi) ? $settings->nama_instansi : '').", Kabupaten/Kota ".(!empty($settings->kabupaten) ? $settings->kabupaten : '')."\nDitandatangani secara elektronik oleh ".(!empty($resume_pasien->nm_dokter) ? $resume_pasien->nm_dokter : "")."\nID ".(!empty($resume_pasien->sidikjari_dokter) ? $resume_pasien->sidikjari_dokter : ''). "\n ". (!empty($resume_pasien->tgl_keluar) ? $resume_pasien->tgl_keluar : "");
                            }
                        ?>
                        <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                    </div>
                    <p>{{!empty($resume_pasien->nm_dokter) ? $resume_pasien->nm_dokter : ""}}<p>
                @endif
            </div>
        </div>
</section>