
@if(!empty($model))
    @foreach($model as $key => $item)
        <tr class='isi'>
            <td valign='top' width='2%'></td>
            <td valign='top' width='18%'>Resume Pasien</td>
            <td valign='top' width='1%' align='center'>:</td>
            <td valign='top' width='79%'>
                <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                    <tr align='center'>
                        <td valign='top' width='20%' bgcolor='#FFFAF8'>Status</td>
                        <td valign='top' width='20%' bgcolor='#FFFAF8'>Kode Dokter</td>
                        <td valign='top' width='40%' bgcolor='#FFFAF8'>Nama Dokter</td>
                        <td valign='top' width='20%' bgcolor='#FFFAF8'>Kondisi Pulang</td>
                    </tr>

                    <tr>
                        <td valign='top'>{{ $item->status_lanjut }}</td>
                        <td valign='top'>{{ $item->kd_dokter }}</td>
                        <td valign='top'>{{ $item->nm_dokter }}</td>
                        <td valign='top'>{{ $item->kondisi_pulang }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='4'>Keluhan utama riwayat penyakit yang positif :<br>{{ $item->keluhan_utama }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='4'>Jalannya penyakit selama perawatan :<br>{{ $item->jalannya_penyakit }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='4'>Pemeriksaan penunjang yang positif :<br>{{ $item->pemeriksaan_penunjang }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='4'>Hasil laboratorium yang positif :<br>{{ $item->hasil_laborat }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='4'>Diagnosa Akhir :<br>
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
                        <td valign='top' colspan='4'>Obat-obatan waktu pulang/nasihat :<br>{{ $item->obat_pulang }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    @endforeach
@endif