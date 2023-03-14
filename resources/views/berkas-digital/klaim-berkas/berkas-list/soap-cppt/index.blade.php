<section id="soap">
@include('berkas-digital.klaim-berkas.berkas-kop')
            <div class="section-header">
                <p class="font-lg text-center">SOAP dan Riwayat Perawatan</p>
            </div>
            
            <div class="section-body">
                @include("berkas-digital.klaim-berkas.berkas-list.soap-cppt.table_data")
            </div>
            <div class="section-footer text-end">
                <div class="d-inline-block  text-center page-break-inside-avoid">
                    <h5>Dokter Penanggung Jawab</h5>
                    @if(!empty($reg_periksa) && $reg_periksa->status_lanjut === 'Ralan')
                        <div class="qrCode">
                            <?php $text = "DPJP: ".$reg_periksa->nm_dokter;?>
                            <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                        </div>
                        <p>{{!empty($reg_periksa->nm_dokter) ? $reg_periksa->nm_dokter : ""}}</p>
                    @else
                        @foreach($dpjp_ranap as $value)
                            <div>
                                <?php $text = "DPJP: ".$value["nm_dokter"];?>
                                <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                            </div>
                            {{!empty($value["nm_dokter"]) ? $value["nm_dokter"] : ""}}<br>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

