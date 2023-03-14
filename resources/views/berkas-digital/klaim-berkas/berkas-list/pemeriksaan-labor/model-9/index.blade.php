@php
    $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
@endphp
<section id="pemeriksaan-labor-9" >
        
            @include('berkas-digital.klaim-berkas.berkas-kop')
   
        <div class="section-header">
            <p class="font-lg">Hasil Pemeriksaan Labor </p>
        </div>
        <div class="section-body">
            <div>
                @include("berkas-digital.klaim-berkas.berkas-list.pemeriksaan-labor.model-9.pasien_data")
        
                @include("berkas-digital.klaim-berkas.berkas-list.pemeriksaan-labor.model-9.hasil_pemeriksaan")
                <div>
                    <p class="border-bottom">Kesan      : {{!empty($hasil_pemeriksaan_lab_pk->kesan) ? $hasil_pemeriksaan_lab_pk->kesan : ""}}</p>
                    <p class="border-bottom">Saran      : {{!empty($hasil_pemeriksaan_lab_pk->saran) ? $hasil_pemeriksaan_lab_pk->saran : ""}}</p>
                </div>
            </div>
        </div>
        <div class="section-footer">
            <table class="table_equal_column_half page-break-inside-avoid">
                <tr>
                    <td></td>
                    <td>{{!empty($settings->kabupaten) ? $settings->kabupaten : "-"}}, {{(!empty($hasil_pemeriksaan_lab_pk->tgl_periksa) && !empty($hasil_pemeriksaan_lab_pk->jam_periksa)) ? date('d F Y H:i:s', strtotime($hasil_pemeriksaan_lab_pk->tgl_periksa." ".$hasil_pemeriksaan_lab_pk->jam_periksa))  : "-"}} </td>
                </tr>
                <tr>
                    <td>
                        Petugas Laboratorium
                        
                    </td>
                    <td>
                        Penanggung Jawab
                    </td>
                </tr>
                <tr>
                    <td>
                        @if(!empty($hasil_pemeriksaan_lab_pk->sidikjari_pl) || !empty($hasil_pemeriksaan_lab_pk->nip))
                            <div class="qrCode" >
                                <?php 
                                    $id = (isset($hasil_pemeriksaan_lab_pk->sidikjari_pl)) ? $hasil_pemeriksaan_lab_pk->sidikjari_pl : $hasil_pemeriksaan_lab_pk->nip;

                                    $text = "Dikeluarkan di ".(!empty($settings->nama_instansi) ? $settings->nama_instansi : '').", Kabupaten/Kota ".(!empty($settings->kabupaten) ? $settings->kabupaten : '')."\nDitandatangani secara elektronik oleh ".$hasil_pemeriksaan_lab_pk->nama_petugas."\nID ".$id. "\n ". $hasil_pemeriksaan_lab_pk->tgl_periksa;
                                ?>
                                <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                            </div>
                        @endif
                    </td>
                    <td>
                        @if(!empty($hasil_pemeriksaan_lab_pk->sidikjari_pj) || !empty($hasil_pemeriksaan_lab_pk->nip))
                            <div class="qrCode">
                                <?php 
                                    $id = (isset($hasil_pemeriksaan_lab_pk->sidkjari_pj)) ? $hasil_pemeriksaan_lab_pk->sidkjari_pj : $hasil_pemeriksaan_lab_pk->kd_dokter;

                                    $text = "Dikeluarkan di ".(!empty($settings->nama_instansi) ? $settings->nama_instansi : '').", Kabupaten/Kota ".(!empty($settings->kabupaten) ? $settings->kabupaten : '')."\nDitandatangani secara elektronik oleh ".$hasil_pemeriksaan_lab_pk->dokter_pj."\nID ".$id. "\n ". $hasil_pemeriksaan_lab_pk->tgl_periksa;
                                ?>
                                <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{!empty($hasil_pemeriksaan_lab_pk->nama_petugas) ? $hasil_pemeriksaan_lab_pk->nama_petugas : "-"}}</td>
                    <td>{{!empty($hasil_pemeriksaan_lab_pk->dokter_pj) ? $hasil_pemeriksaan_lab_pk->dokter_pj : "-"}}</td>
                </tr>
            </table>
 
        </div>
</section>