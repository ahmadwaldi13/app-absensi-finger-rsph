<section id="laporan_operasi">
@include('berkas-digital.klaim-berkas.berkas-kop')
                <div class="section-header">
                    <p class="font-lg">Resume Laporan Operasi</p>
                </div>
                <div class="section-body" style="border:1px solid;">
                    @include("berkas-digital.klaim-berkas.berkas-list.resume-lapop.table_data")
                </div>
                
                <div class="text-end" >
                    <div class="text-center d-inline-block page-break-inside-avoid">
                            <h5>Dokter Penanggung Jawab</h5>
                            @if(!empty($resume_pasien["nm_dokter"]))
                                <div class="qrCode">
                                    <?php 
                                    $text = "DPJP: ".$resume_pasien['nm_dokter'];?>
                                    <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                                </div>
                                <p>{{!empty($resume_pasien["nm_dokter"]) ? $resume_pasien["nm_dokter"] : ""}}<p>
                            @endif
                    </div>
                </div>

        </section>