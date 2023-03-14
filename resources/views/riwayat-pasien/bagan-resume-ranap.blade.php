@if(!empty($model))
    @foreach($model as $key => $item)
        <tr class='isi'>
            <td valign='top' width='2%'></td>
            <td valign='top' width='18%'>Resume Pasien Ranap</td>
            <td valign='top' width='1%' align='center'>:</td>
            <td valign='top' width='79%'>
                <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                    <tr align='center'>
                        <td valign='top' width='6%' bgcolor='#FFFAF8'>Status</td>
                        <td valign='top' width='15%' bgcolor='#FFFAF8'>Kode Dokter</td>
                        <td valign='top' width='27%' bgcolor='#FFFAF8'>Nama Dokter</td>
                        <td valign='top' width='13%' bgcolor='#FFFAF8'>Keadaan Pulang</td>
                        <td valign='top' width='13%' bgcolor='#FFFAF8'>Cara Keluar</td>
                        <td valign='top' width='13%' bgcolor='#FFFAF8'>Dilanjutkan</td>
                        <td valign='top' width='13%' bgcolor='#FFFAF8'>Tgl.Kontrol</td>
                    </tr>

                    <tr>
                        <td valign='top' align='center'>{{ !empty( $rawat->status_lanjut) ? $rawat->status_lanjut : '' }}</td>
                        <td valign='top' align='center'>{{ !empty( $item->kd_dokter) ? $item->kd_dokter : '' }}</td>
                        <td valign='top'>{{ !empty( $item->nm_dokter) ? $item->nm_dokter : '' }}</td>
                        <td valign='top' align='center'>{{ !empty( $item->keadaan) ? $item->keadaan : '' }} <br> {{ !empty( $item->ket_keadaan) ? '( '.$item->ket_keadaan.' )' : '' }}</td>
                        <td valign='top' align='center'>{{ !empty( $item->cara_keluar) ? $item->cara_keluar : '' }} <br> {{ !empty( $item->ket_keluar ) ? '( '.$item->ket_keluar.' )' : '' }}</td>
                        
                        <td valign='top' align='center'>{{ !empty( $item->dilanjutkan) ? $item->dilanjutkan : '' }} <br> {{ !empty( $item->ket_dilanjutkan) ? '( '.$item->ket_dilanjutkan.' )' : '' }}</td>
                        <td valign='top' align='center'>{{ !empty( $item->kontrol) ? $item->kontrol : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Diagnosa Awal Masuk :<br>{{ !empty( $item->diagnosa_awal) ? $item->diagnosa_awal : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Alasan Masuk Dirawat :<br>{{ !empty( $item->alasan) ? $item->alasan : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Keluhan Utama Riwayat Penyakit :<br>{{ !empty( $item->keluhan_utama) ? $item->keluhan_utama : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Pemeriksaan Fisik :<br>{{ !empty( $item->pemeriksaan_fisik) ? $item->pemeriksaan_fisik : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Jalannya Penyakit Selama Perawatan :<br>{{ !empty( $item->jalannya_penyakit) ? $item->jalannya_penyakit : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Pemeriksaan Penunjang Rad Terpenting :<br>{{ !empty( $item->pemeriksaan_penunjang) ? $item->pemeriksaan_penunjang : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Pemeriksaan Penunjang Lab Terpenting :<br>{{ !empty( $item->hasil_laborat) ? $item->hasil_laborat : '' }}</td>
                    <tr>
                        <td valign='top' colspan='7'>Tindakan/Operasi Selama Perawatan :<br>{{ !empty( $item->tindakan_dan_operasi) ? $item->tindakan_dan_operasi : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Obat-obatan Selama Perawatan :<br>{{ !empty( $item->obat_di_rs) ? $item->obat_di_rs : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Diagnosa Akhir :<br>
                            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                                <tr align='left' border='0'>
                                    <td valign='top' width='20%' border='0'>Diagnosa Utama</td>
                                    <td valign='top' width='60%' border='0'>:&nbsp;{{ $item->diagnosa_utama }}</td>
                                    <td valign='top' width='20%' border='0'>&nbsp;{{ $item->kd_diagnosa_utama }}</td>
                                </tr>
                                <tr align='left' border='0'>
                                    <td valign='top' width='20%' border='0'>Diagnosa Sekunder 1</td>
                                    <td valign='top' width='60%' border='0'>:&nbsp;{{ $item->diagnosa_sekunder }}</td>
                                    <td valign='top' width='20%' border='0'>&nbsp;{{ $item->kd_diagnosa_sekunder }}</td>
                                </tr>
                                <tr align='left' border='0'>
                                    <td valign='top' width='20%' border='0'>Diagnosa Sekunder 2</td>
                                    <td valign='top' width='60%' border='0'>:&nbsp;{{ $item->diagnosa_sekunder2 }}</td>
                                    <td valign='top' width='20%' border='0'>&nbsp;{{ $item->kd_diagnosa_sekunder2 }}</td>
                                </tr>
                                <tr align='left' border='0'>
                                    <td valign='top' width='20%' border='0'>Diagnosa Sekunder 3</td>
                                    <td valign='top' width='60%' border='0'>:&nbsp;{{ $item->diagnosa_sekunder3 }}</td>
                                    <td valign='top' width='20%' border='0'>&nbsp;{{ $item->kd_diagnosa_sekunder3 }}</td>
                                </tr>
                                <tr align='left' border='0'>
                                    <td valign='top' width='20%' border='0'>Diagnosa Sekunder 4</td>
                                    <td valign='top' width='60%' border='0'>:&nbsp;{{ $item->diagnosa_sekunder4 }}</td>
                                    <td valign='top' width='20%' border='0'>&nbsp;{{ $item->kd_diagnosa_sekunder4 }}</td>
                                </tr>
                                <tr align='left' border='0'>
                                    <td valign='top' width='20%' border='0'>Prosedur Utama</td>
                                    <td valign='top' width='60%' border='0'>:&nbsp;{{ $item->prosedur_utama }}</td>
                                    <td valign='top' width='20%' border='0'>&nbsp;{{ $item->kd_prosedur_utama }}</td>
                                </tr>
                                <tr align='left' border='0'>
                                    <td valign='top' width='20%' border='0'>Prosedur Sekunder 1</td>
                                    <td valign='top' width='60%' border='0'>:&nbsp;{{ $item->prosedur_sekunder }}</td>
                                    <td valign='top' width='20%' border='0'>&nbsp;{{ $item->kd_prosedur_sekunder }}</td>
                                </tr>
                                <tr align='left' border='0'>
                                    <td valign='top' width='20%' border='0'>Prosedur Sekunder 2</td>
                                    <td valign='top' width='60%' border='0'>:&nbsp;{{ $item->prosedur_sekunder2 }}</td>
                                    <td valign='top' width='20%' border='0'>&nbsp;{{ $item->kd_prosedur_sekunder2 }}</td>
                                </tr>
                                <tr align='left' border='0'>
                                    <td valign='top' width='20%' border='0'>Prosedur Sekunder 3</td>
                                    <td valign='top' width='60%' border='0'>:&nbsp;{{ $item->prosedur_sekunder3 }}</td>
                                    <td valign='top' width='20%' border='0'>&nbsp;{{ $item->kd_prosedur_sekunder3 }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Alergi Obat :<br>{{ !empty( $item->alergi) ? $item->alergi : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Diet :<br>{{ !empty( $item->diet) ? $item->diet : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Hasil Lab Yang Belum Selesai (Pending) :<br>{{ !empty( $item->lab_belum) ? $item->lab_belum : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Instruksi/Anjuran Dan Edukasi (Follow Up) :<br>{{ !empty( $item->edukasi) ? $item->edukasi : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='7'>Obat-obatan Waktu Pulang :<br>{{ !empty( $item->obat_pulang) ? $item->obat_pulang : '' }}</td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    @endforeach
@endif