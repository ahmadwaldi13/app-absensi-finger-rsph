<section id="pemeriksaan-radiologi" >
@include('berkas-digital.klaim-berkas.berkas-kop')
        <div class="section-header">
            <p class="font-lg">Hasil Pemeriksaan Radiologi</p>
        </div>
        <div class="section-body">
            <div>
            @include("berkas-digital.klaim-berkas.berkas-list.pemeriksaan-radiologi.pasien_data")
                <div >
                    <p>Hasil Pemeriksaan :</p>
                        <pre class="p-default border-3 ">{{!empty($hasil_pemeriksaan_radiologi->hasil) ? $hasil_pemeriksaan_radiologi->hasil : ""}}</pre>
                    
                </div>

            </div>
        </div>
        <div class="section-footer ">
            <table class="table_equal_column_half page-break-inside-avoid">
                <tr>
                    <td></td>
                    <td>Tgl. Cetak : {{(!empty($hasil_pemeriksaan_radiologi->tgl_periksa) && !empty($hasil_pemeriksaan_radiologi->jam)) ? date('d F Y H:i:s', strtotime($hasil_pemeriksaan_radiologi->tgl_periksa." ".$hasil_pemeriksaan_radiologi->jam))  : "-"}}</td>
                </tr>
                <tr>
                    <td>
                        Penanggung Jawab
                    </td>
                    <td>
                        Petugas Laboratorium
                    </td>
                </tr>
                <tr>
                    <td>
                        @if(!empty($hasil_pemeriksaan_radiologi->finger_pj) || !empty($hasil_pemeriksaan_radiologi->kd_dokter) )
                            <div class="qrCode">
                                <?php 
                                    $id = (isset($hasil_pemeriksaan_radiologi->finger_pj)) ? $hasil_pemeriksaan_radiologi->finger_pj : $hasil_pemeriksaan_radiologi->kd_dokter;
                                    $text = "Dikeluarkan di ".(!empty($settings->nama_instansi) ? $settings->nama_instansi : '').", Kabupaten/Kota ".(!empty($settings->kabupaten) ? $settings->kabupaten : '')."\nDitandatangani secara elektronik oleh ".$hasil_pemeriksaan_radiologi->nm_dokter."\nID ".$id. "\n ". $hasil_pemeriksaan_radiologi->tgl_periksa;
                                ?>
                                <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                            </div>
                        @endif
                    </td>
                    <td>
                        @if(!empty($hasil_pemeriksaan_radiologi->finger_pj) || !empty($hasil_pemeriksaan_radiologi->kd_dokter) )
                            <div class="qrCode" >
                                <?php 
                                    $id = (isset($hasil_pemeriksaan_radiologi->finger_pl)) ? $hasil_pemeriksaan_radiologi->finger_pl : $hasil_pemeriksaan_radiologi->petugas_nip;

                                    $text = "Dikeluarkan di ".(!empty($settings->nama_instansi) ? $settings->nama_instansi : '').", Kabupaten/Kota ".(!empty($settings->kabupaten) ? $settings->kabupaten : '')."\nDitandatangani secara elektronik oleh ".$hasil_pemeriksaan_radiologi->nama_petugas."\nID ".$id. "\n ". $hasil_pemeriksaan_radiologi->tgl_periksa;
                                ?>
                                <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{!empty($hasil_pemeriksaan_radiologi->nm_dokter) ? $hasil_pemeriksaan_radiologi->nm_dokter : ""}}</td>
                    <td>{{!empty($hasil_pemeriksaan_radiologi->nama_petugas) ? $hasil_pemeriksaan_radiologi->nama_petugas : ""}}</td>
                </tr>
            </table>

        </div>
</section>