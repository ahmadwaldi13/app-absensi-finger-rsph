<tr class="isi">
    <td valign='top' width='2%'></td>
    <td valign='top' width='18%'>perencanaan pemulangan</td>
    <td valign='top' width='1%' align='center'>:</td>
    <td valign='top' width='79%'>

       
        <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form table table-bordered'>

            @foreach($rawat->perencanaan_pemulangan as $pemulangan)
             <tbody>
                <tr>
                    <td valign='top'>
                        YANG MELAKUKAN PENGKAJIAN
                        <table width='100%' border='1' align='center' cellspacing='0px' class='tbl_form table table-bordered'>
                            <tbody>
                                <tr class="isi">
                                    <td valign='top'>Rencana Pulang :&nbsp; {{$pemulangan->rencana_pulang}}</td>
                                    <td valign='top'>Perawat/Petugas :&nbsp; {{$pemulangan->nip}}&nbsp;{{$pemulangan->nama}}</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' width='50%'>Diagnosa Medis :&nbsp; {{$pemulangan->diagnosa_medis}}</td>
                                    <td valign='top' width='50%'>Alasan Masuk/Dirawat :&nbsp; {{$pemulangan->alasan_masuk}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign='top'>
                        PENGKAJIAN
                        <table width='100%' border='1' align='center' cellspacing='0px' class='tbl_form table table-bordered'>
                            <tbody>
                                <tr class="isi">
                                    <td valign='top' align="left">1.Pengaruh Rawat Inap Terhadap :</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp; Pasien & Keluarga Pasien : &nbsp;  {{$pemulangan->pengaruh_ri_pasien_dan_keluarga}} {{ empty($pemulangan->keterangan_pengaruh_ri_pasien_dan_keluarga) ? '' : ','.$pemulangan->keterangan_pengaruh_ri_pasien_dan_keluarga }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp; Pekerjaan / Sekolah : &nbsp;  {{$pemulangan->pengaruh_ri_pekerjaan_sekolah}} {{ empty($pemulangan->keterangan_pengaruh_ri_pekerjaan_sekolah) ? '' : ','.$pemulangan->keterangan_pengaruh_ri_pekerjaan_sekolah }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp; Keuangan : &nbsp;  {{$pemulangan->pengaruh_ri_keuangan}} {{ empty($pemulangan->keterangan_pengaruh_ri_keuangan) ? '' : ','.$pemulangan->keterangan_pengaruh_ri_keuangan }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">2.Antisipasi Terhadap Masalah Saat Pulang ? </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->antisipasi_masalah_saat_pulang}} {{ empty($pemulangan->keterangan_antisipasi_masalah_saat_pulang) ? '' : ','.$pemulangan->keterangan_antisipasi_masalah_saat_pulang }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">3.Bantuan Diperlukan Dalam Hal ? </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->bantuan_diperlukan_dalam}} {{ empty($pemulangan->keterangan_bantuan_diperlukan_dalam) ? '' : ','.$pemulangan->keterangan_bantuan_diperlukan_dalam }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">4.Adakah Yang Membantu Keperluan Di Atas ?</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->adakah_yang_membantu_keperluan}} {{ empty($pemulangan->keterangan_adakah_yang_membantu_keperluan) ? '' : ','.$pemulangan->keterangan_adakah_yang_membantu_keperluan }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">5.Apakah Pasien Tinggal Sendiri Setelah Keluar Dari Rumah Sakit ?</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->pasien_tinggal_sendiri}} {{ empty($pemulangan->keterangan_pasien_tinggal_sendiri) ? '' : ','.$pemulangan->keterangan_pasien_tinggal_sendiri }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">6.Apakah Pasien Menggunakan Peralatan Medis (Kateter, NGT, Oksigen, Dll) Di Rumah Setelah Keluar / Pulang ?</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->pasien_menggunakan_peralatan_medis}} {{ empty($pemulangan->keterangan_pasien_menggunakan_peralatan_medis) ? '' : ','.$pemulangan->keterangan_pasien_menggunakan_peralatan_medis }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">7.Apakah Pasien Memerlukan Alat Bantu (Tongkat, Kursi Roda, Walker, Dll) Setelah Keluar Keluar / Pulang ?</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->pasien_memerlukan_alat_bantu}} {{ empty($pemulangan->keterangan_pasien_memerlukan_alat_bantu) ? '' : ','.$pemulangan->keterangan_pasien_memerlukan_alat_bantu }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">8.Apakah Memerlukan Bantuan / Perawatan Khusus (Homecare, Home Visit) Di Rumah Setelah Keluar / Pulang ?</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->memerlukan_perawatan_khusus}} {{ empty($pemulangan->keterangan_memerlukan_perawatan_khusus) ? '' : ','.$pemulangan->keterangan_memerlukan_perawatan_khusus }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">9.Apakah Pasien Bermasalah Dalam Memenuhi Kebutuhan Pribadinya (Makan, Minum, BAK, BAB, Dll) Setelah Keluar / Pulang ?</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->bermasalah_memenuhi_kebutuhan}} {{ empty($pemulangan->keterangan_bermasalah_memenuhi_kebutuhan) ? '' : ','.$pemulangan->keterangan_bermasalah_memenuhi_kebutuhan }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">10.Apakah Pasien Memiliki Nyeri Kronis Dan Kelelahan Setelah Keluar / Pulang ?</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->memiliki_nyeri_kronis}} {{ empty($pemulangan->keterangan_memiliki_nyeri_kronis) ? '' : ','.$pemulangan->keterangan_memiliki_nyeri_kronis }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">11.Apakah Pasien & Keluarga Memerlukan Edukasi Kesehatan (Obatan-obatan, Efek Samping Obat, Nyeri Diit, Mencari Pertolongan, Follow Up, Dll) Setelah Keluar / Pulang ?</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->memerlukan_edukasi_kesehatan}} {{ empty($pemulangan->keterangan_memerlukan_edukasi_kesehatan) ? '' : ','.$pemulangan->keterangan_memerlukan_edukasi_kesehatan }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left">12. Apakah Pasien Dan Keluarga Memerlukan Keterampilan Khusus (Perawatan Luka, Injeksi, Perawatan Bayi, Dll) Setelah Keluar / Pulang ?</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="left" width=''>&nbsp;  {{$pemulangan->memerlukan_keterampilkan_khusus}} {{ empty($pemulangan->keterangan_memerlukan_keterampilkan_khusus) ? '' : ','.$pemulangan->keterangan_memerlukan_keterampilkan_khusus }} </td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top' align="lef">&nbsp;DILAKUKAN KONFIRMASI KEPADA</td>
                                </tr>
                                <tr class="isi">
                                    <td valign='top'>&nbsp;Pasien/Keluarga :&nbsp; {{$pemulangan->nama_pasien_keluarga}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
             </tbody>
            @endforeach
        </table>
</tr>
