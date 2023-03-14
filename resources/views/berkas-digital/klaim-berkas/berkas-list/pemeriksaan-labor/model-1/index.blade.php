<section id="pemeriksaan-labor-1" >
@include('berkas-digital.klaim-berkas.berkas-kop')
        <div class="section-header">
            <p class="font-lg">Hasil Pemeriksaan Labor </p>
            <small>( Model 1 )</small>
        </div>
        <div class="section-body">
            <div>
                @include("berkas-digital.klaim-berkas.berkas-list.pemeriksaan-labor.model-1.pasien_data")
        
                @include("berkas-digital.klaim-berkas.berkas-list.pemeriksaan-labor.model-1.hasil_pemeriksaan")
                <small>
                    <b>Catatan</b>
                    Jika ada Keragu-raguan Pemeriksaan, diharapakan segera menghubungi laboratorium
                </small>
            </div>
        </div>
        <div class="section-footer">
            <table class="table_equal_column_half page-break-inside">
                <tr >
                    <td></td>
                    <td>Tgl. Cetak : {{date("d/m/y h:i:s")}}</td>
                </tr>
                <tr >
                    <td>
                        Penanggung Jawab
                    </td>
                    <td>
                        Petugas Laboratorium
                    </td>
                </tr>
                <tr >
                    <td>
                        @if(!empty($v))
                            <div class="qrCode">
                                <?php 
                                    $id = (isset($hasil_pemeriksaan_lab_pk->sidkjari_pj)) ? $hasil_pemeriksaan_lab_pk->sidkjari_pj : $hasil_pemeriksaan_lab_pk->kd_dokter;

                                    $text = "Dikeluarkan di ".(!empty($settings->nama_instansi) ? $settings->nama_instansi : '').", Kabupaten/Kota ".(!empty($settings->kabupaten) ? $settings->kabupaten : '')."\nDitandatangani secara elektronik oleh ".$hasil_pemeriksaan_lab_pk->nm_dokter."\nID ".$id. "\n ". $hasil_pemeriksaan_lab_pk->tgl_periksa;
                                ?>
                                <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                            </div>
                        @endif
                    </td>
                    <td>
                        @if(!empty($v))
                            <div class="qrCode" >
                                <?php
                                    $id = (isset($hasil_pemeriksaan_lab_pk->sidikjari_pl)) ? $hasil_pemeriksaan_lab_pk->sidikjari_pl : $hasil_pemeriksaan_lab_pk->nip;

                                    $text = "Dikeluarkan di ".(!empty($settings->nama_instansi) ? $settings->nama_instansi : '').", Kabupaten/Kota ".(!empty($settings->kabupaten) ? $settings->kabupaten : '')."\nDitandatangani secara elektronik oleh ".$hasil_pemeriksaan_lab_pk->nama_petugas."\nID ".$id. "\n ". $hasil_pemeriksaan_lab_pk->tgl_periksa;
                                ?>
                                <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                            </div>
                        @endif
                    </td>
                </tr>
                <tr >
                    
                    <td>{{!empty($hasil_pemeriksaan_lab_pk->nm_dokter) ? $hasil_pemeriksaan_lab_pk->nm_dokter : "-"}}</td>
                    <td>{{!empty($hasil_pemeriksaan_lab_pk->nama_petugas) ? $hasil_pemeriksaan_lab_pk->nama_petugas : "-"}}</td>
                </tr>
            </table>

        </div>
</section>