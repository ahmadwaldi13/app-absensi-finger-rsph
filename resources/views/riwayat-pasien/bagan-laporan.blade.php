<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pasien</title>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        table[border] {
            border: 1px solid #f0f0f0 !important;
        }
    </style>
</head>
<body>
    <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form table table-bordered'>
        @foreach ($dataRawat as $rawat)
            <div>
                <!-- Data Rawat -->
                <tr class='isi'>
                    <td valign='top' width='2%'>{{ $rawat->urutan }}</td>
                    <td valign='top' width='18%'>No.Rawat</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->no_rawat }}</td>
                </tr>
                <tr class='isi'>
                    <td valign='top' width='2%'></td>
                    <td valign='top' width='18%'>No.Registrasi</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->no_reg }}</td>
                </tr>
                <tr class='isi'>
                    <td valign='top' width='2%'></td>
                    <td valign='top' width='18%'>Tanggal Registrasi</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->tgl_registrasi . ' ' . $rawat->jam_reg }}</td>
                </tr>
                <tr class='isi'>
                    <td valign='top' width='2%'></td>
                    <td valign='top' width='18%'>Unit/Poliklinik</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->nm_poli . $rawat->poli_rujukan }}</td>
                </tr>
                <tr class='isi'>
                    <td valign='top' width='2%'></td>
                    <td valign='top' width='18%'>Dokter Poli</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->nm_dokter . $rawat->dokter_rujukan }}</td>
                </tr>
                @if (!empty($type_akses))
                    @if ($type_akses == 'ri')
                        <tr class='isi'>
                            <td valign='top' width='2%'></td>
                            <td valign='top' width='18%'>DPJP Ranap</td>
                            <td valign='top' width='1%' align='center'>:</td>
                            <td valign='top' width='79%'>{{ !empty($rawat->dpjp_dokter) ? $rawat->dpjp_dokter : '' }}
                            </td>
                        </tr>
                    @endif
                @endif
                <tr class='isi'>
                    <td valign='top' width='2%'></td>
                    <td valign='top' width='18%'>Cara Bayar</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->png_jawab }}</td>
                </tr>
                <tr class='isi'>
                    <td valign='top' width='2%'></td>
                    <td valign='top' width='18%'>Penanggung Jawab</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->p_jawab }}</td>
                </tr>
                <tr class='isi'>
                    <td valign='top' width='2%'></td>
                    <td valign='top' width='18%'>Alamat P.J.</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->almt_pj }}</td>
                </tr>
                <tr class='isi'>
                    <td valign='top' width='2%'></td>
                    <td valign='top' width='18%'>Hubungan P.J.</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->hubunganpj }}</td>
                </tr>
                <tr class='isi'>
                    <td valign='top' width='2%'></td>
                    <td valign='top' width='18%'>Status</td>
                    <td valign='top' width='1%' align='center'>:</td>
                    <td valign='top' width='79%'>{{ $rawat->status_lanjut }}</td>
                </tr>

                <!-- Data Triase Primer -->
                @if (!empty($rawat->triase_primer) and count($rawat->triase_primer) > 0)
                    <tr class='isi'>
                        <td valign='top' width='2%'></td>
                        <td valign='top' width='18%'>Triase Gawat Darurat</td>
                        <td valign='top' width='1%' align='center'>:</td>
                        <td valign='top' width='79%'>
                            <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form table table-bordered'>
                                <tbody>
                                    <tr class='isi'>
                                        <td valign='top'>Cara Masuk</td>
                                        <td valign='top'>: {{ $rawat->triase_primer->cara_masuk }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='top'>Transportasi</td>
                                        <td valign='top'>: {{ $rawat->triase_primer->alat_transportasi }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='top'>Alasan Kedatangan</td>
                                        <td valign='top'>: {{ $rawat->triase_primer->alasan_kedatangan }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='top'>Keterangan Kedatangan</td>
                                        <td valign='top'>: {{ $rawat->triase_primer->keterangan_kedatangan }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='top'>Macam Kasus</td>
                                        <td valign='top'>: {{ $rawat->triase_primer->macam_kasus }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle' bgcolor='#FFF7F3' align='center' width='35%'>Keterangan</td>
                                        <td valign='middle' bgcolor='#FFF7F3' align='center' width='65%'>Triase Primer</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle'>Keluhan Utama</td>
                                        <td valign='middle'>{{ $rawat->triase_primer->keluhan_utama }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle'>Tanda Vital</td>
                                        <td valign='middle'>Suhu (C) :
                                            {{ $rawat->triase_primer->suhu . ', Nyeri : ' . $rawat->triase_primer->nyeri . ', Tensi : ' . $rawat->triase_primer->tekanan_darah . ', Nadi(/menit) : ' . $rawat->triase_primer->nadi . ', Saturasi O²(%) : ' . $rawat->triase_primer->saturasi_o2 . ', Respirasi(/menit) : ' . $rawat->triase_primer->pernapasan }}
                                        </td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle'>Kebutuhan Khusus</td>
                                        <td valign='middle'>{{ $rawat->triase_primer->kebutuhan_khusus }}</td>
                                    </tr>

                                    @if (isset($rawat->triase_primer->master_triase_skala_1))
                                        <tr class='isi'>
                                            <td valign='middle' bgcolor='#FFF7F3' align='center'>Pemeriksaan</td>
                                            <td valign='middle' bgcolor='#AA0000' color='ffffff' align='center'>Immediate/Segera</td>
                                        </tr>
                                        @foreach ($rawat->triase_primer->master_triase_skala_1 as $masterTriase)
                                            <tr class='isi'>
                                                <td valign='middle'>{{ $masterTriase->nama_pemeriksaan }}</td>
                                                <td valign='middle' bgcolor='#AA0000' color='ffffff'>
                                                    <table width='100%' border='1' align='center' cellspacing='0'>
                                                        <tbody>
                                                            @foreach ($masterTriase->triase_skala_1 as $triaseSkala1)
                                                                <tr class='isi'>
                                                                    <td border='1' valign='middle' bgcolor='#AA0000'
                                                                        color='ffffff' width='100%'>
                                                                        {{ $triaseSkala1->pengkajian_skala1 }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    @if (isset($rawat->triase_primer->master_triase_skala_2))
                                        <tr class='isi'>
                                            <td valign='middle' bgcolor='#FFF7F3' align='center'>Pemeriksaan</td>
                                            <td valign='middle' bgcolor='#FF0000' color='ffffff' align='center'>Emergensi
                                            </td>
                                        </tr>

                                        @foreach ($rawat->triase_primer->master_triase_skala_2 as $masterTriase)
                                            <tr class='isi'>
                                                <td valign='middle'>{{ $masterTriase->nama_pemeriksaan }}</td>
                                                <td valign='middle' bgcolor='#AA0000' color='ffffff'>
                                                    <table width='100%' border='1' align='center' cellspacing='0'>
                                                        <tbody>
                                                            @foreach ($masterTriase->triase_skala_2 as $triaseSkala2)
                                                                <tr class='isi'>
                                                                    <td border='1' valign='middle' bgcolor='#AA0000'
                                                                        color='ffffff' width='100%'>
                                                                        {{ $triaseSkala2->pengkajian_skala2 }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                <tr class='isi'>
                                    <td valign='middle'>Plan/Keputusan</td>
                                    <td valign='middle' bgcolor='keputusan' color='ffffff'>Zona Merah &nbsp; {{ $rawat->triase_primer->plan }}</td>
                                </tr>
                                <tr class='isi'>
                                    <td valign='middle'>&nbsp;</td>
                                    <td valign='middle' bgcolor='#FFF7F3' align='center'>Petugas Triase Primer</td>
                                </tr>
                                <tr class='isi'>
                                    <td valign='middle'>Tanggal & Jam</td>
                                    <td valign='middle'>{{ $rawat->triase_primer->tanggaltriase }}</td>
                                </tr>
                                <tr class='isi'>
                                    <td valign='middle'>Catatan</td>
                                    <td valign='middle'>{{ $rawat->triase_primer->catatan }}</td>
                                </tr>
                                <tr class='isi'>
                                    <td valign='middle'>Dokter/Petugas IGD</td>
                                    <td valign='middle'>{{ $rawat->triase_primer->nik . ' ' . $rawat->triase_primer->nama }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif

                <!-- Data Triase Sekunder -->
                @if (!empty($rawat->triase_sekunder) and count($rawat->triase_sekunder) > 0)
                    <tr class='isi'>
                        <td valign='top' width='2%'></td>
                        <td valign='top' width='18%'>Triase Gawat Darurat</td>
                        <td valign='top' width='1%' align='center'>:</td>
                        <td valign='top' width='79%'>
                            <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form table table-bordered'>
                                <tbody>
                                    <tr class='isi'>
                                        <td valign='top'>Cara Masuk</td>
                                        <td valign='top'>: {{ $rawat->triase_sekunder->cara_masuk }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='top'>Transportasi</td>
                                        <td valign='top'>: {{ $rawat->triase_sekunder->alat_transportasi }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='top'>Alasan Kedatangan</td>
                                        <td valign='top'>: {{ $rawat->triase_sekunder->alasan_kedatangan }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='top'>Keterangan Kedatangan</td>
                                        <td valign='top'>: {{ $rawat->triase_sekunder->keterangan_kedatangan }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='top'>Macam Kasus</td>
                                        <td valign='top'>: {{ $rawat->triase_sekunder->macam_kasus }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle' bgcolor='#FFF7F3' align='center' width='35%'>Keterangan</td>
                                        <td valign='middle' bgcolor='#FFF7F3' align='center' width='65%'>Triase Sekunder</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle'>Anamnesa Singkat</td>
                                        <td valign='middle'>{{ $rawat->triase_sekunder->anamnesa_singkat }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle'>Tanda Vital</td>
                                        <td valign='middle'>Suhu (C) :
                                            {{ $rawat->triase_sekunder->suhu . ', Nyeri : ' . $rawat->triase_sekunder->nyeri . ', Tensi : ' . $rawat->triase_sekunder->tekanan_darah . ', Nadi(/menit) : ' . $rawat->triase_sekunder->nadi . ', Saturasi O²(%) : ' . $rawat->triase_sekunder->saturasi_o2 . ', Respirasi(/menit) : ' . $rawat->triase_sekunder->pernapasan }}
                                        </td>
                                    </tr>

                                    @foreach ($rawat->triase_sekunder->master_triase_skala_3 as $masterTriase)
                                        <tr class='isi'>
                                            <td valign='middle'>$masterTriase->nama_pemeriksaan</td>
                                            <td valign='middle' bgcolor='#C8C800' color='ffffff'>
                                                <table width='100%' border='1' align='center' cellspacing='0'>
                                                    <tbody>
                                                        @foreach ($masterTriase->triase_skala_3 as $triaseSkala3)
                                                            <tr class='isi'>
                                                                <td border='1' valign='middle' bgcolor='#C8C800'
                                                                    color='ffffff' width='100%'>$triaseSkala3->pengkajian_skala3
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach ($rawat->triase_sekunder->master_triase_skala_4 as $masterTriase)
                                        <tr class='isi'>
                                            <td valign='middle'>$masterTriase->nama_pemeriksaan</td>
                                            <td valign='middle' bgcolor='#C8C800' color='ffffff'>
                                                <table width='100%' border='1' align='center' cellspacing='0'>
                                                    <tbody>
                                                        @foreach ($masterTriase->triase_skala_4 as $triaseSkala4)
                                                            <tr class='isi'>
                                                                <td border='1' valign='middle' bgcolor='#C8C800'
                                                                    color='ffffff' width='100%'>$triaseSkala4->pengkajian_skala4
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach ($rawat->triase_sekunder->master_triase_skala_5 as $masterTriase)
                                        <tr class='isi'>
                                            <td valign='middle'>$masterTriase->nama_pemeriksaan</td>
                                            <td valign='middle' bgcolor='#C8C800' color='ffffff'>
                                                <table width='100%' border='1' align='center' cellspacing='0'>
                                                    <tbody>
                                                        @foreach ($masterTriase->triase_skala_5 as $triaseSkala5)
                                                            <tr class='isi'>
                                                                <td border='1' valign='middle' bgcolor='#C8C800'
                                                                    color='ffffff' width='100%'>$triaseSkala5->pengkajian_skala5
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr class='isi'>
                                        <td valign='middle'>Plan/Keputusan</td>
                                        <td valign='middle' bgcolor='keputusan' color='ffffff'>{{ $rawat->triase_sekunder->plan }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle'>&nbsp;</td>
                                        <td valign='middle' bgcolor='#FFF7F3' align='center'>Petugas Triase Sekunder</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle'>Tanggal & Jam</td>
                                        <td valign='middle'>{{ $rawat->triase_sekunder->tanggaltriase }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle'>Catatan</td>
                                        <td valign='middle'>{{ $rawat->triase_sekunder->catatan }}</td>
                                    </tr>
                                    <tr class='isi'>
                                        <td valign='middle'>Dokter/Petugas IGD</td>
                                        <td valign='middle'>{{ $rawat->triase_sekunder->nik . ' ' . $rawat->triase_sekunder->nama }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif

                <!-- Penilaian Keperawatan -->
                @if (!empty($rawat->penilaian_keperawatan) and count($rawat->penilaian_keperawatan) > 0)
                    <tr class='isi'>
                        <td valign='top' width='2%'></td>
                        <td valign='top' width='18%'>Penilaian Awal Keperawatan Rawat Jalan</td>
                        <td valign='top' width='1%' align='center'>:</td>
                        <td valign='top' width='79%'>
                            <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form table table-bordered'>
                                <tbody>
                                    @foreach ($rawat->penilaian_keperawatan as $penilaian)
                                        <tr>
                                            <td valign='top'>
                                                YANG MELAKUKAN PENGKAJIAN
                                                <table width='100%' border='1' align='center' cellspacing='0px' class='tbl_form table table-bordered'>
                                                    <tbody>
                                                        <tr>
                                                            <td width='33%' border='1'>Tanggal : &nbsp; {{ $penilaian->tanggal }}
                                                            </td>
                                                            <td width='33%' border='1'>Petugas : &nbsp; {{ $penilaian->nip . ' ' . $penilaian->nama }}</td>
                                                            <td width='33%' border='1'>Informasi didapat dari : &nbsp;{{ $penilaian->informasi }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                I. KEADAAN UMUM
                                                <table width='100%' border='1' align='center' cellspacing='0px' class='tbl_form table table-bordered'>
                                                    <tbody>
                                                        <tr>
                                                            <td width='20%' border='1'>TD : {{ $penilaian->td }} mmHg</td>
                                                            <td width='20%' border='1'>Nadi : {{ $penilaian->nadi }}
                                                                x/menit</td>
                                                            <td width='20%' border='1'>RR : {{ $penilaian->rr }} x/menit
                                                            </td>
                                                            <td width='20%' border='1'>Suhu : {{ $penilaian->suhu }} °C
                                                            </td>
                                                            <td width='20%' border='1'>GCS(E,V,M) : {{ $penilaian->gcs }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                II. STATUS NUTRISI
                                                <table width='100%' border='1' align='center' cellspacing='0px' class='tbl_form table table-bordered'>
                                                    <tbody>
                                                        <tr>
                                                            <td width='33%' border='1'>BB : {{ $penilaian->bb }} Kg</td>
                                                            <td width='33%' border='1'>TB : {{ $penilaian->tb }} Cm</td>
                                                            <td width='33%' border='1'>BMI : {{ $penilaian->bmi }} Kg/m²
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                III. RIWAYAT KESEHATAN
                                                <table width='100%' border='1' align='center' cellspacing='0px' class='tbl_form table table-bordered'>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan='2'>Keluhan Utama : {{ $penilaian->keluhan_utama }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width='50%'>Riwayat Penyakit Dahulu : {{ $penilaian->rpd }}
                                                            </td>
                                                            <td width='50%'>Riwayat Alergi : {{ $penilaian->alergi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td width='50%'>Riwayat Penyakit Keluarga : {{ $penilaian->rpk }}
                                                            </td>
                                                            <td width='50%'>Riwayat Pengobatan : {{ $penilaian->rpo }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                IV. FUNGSIONAL
                                                <table width='100%' border='1' align='center' cellspacing='0px' class='tbl_form table table-bordered'>
                                                    <tbody>
                                                        <tr>
                                                            <td width='33%' border='1'>Alat Bantu :
                                                                {{ $penilaian->alat_bantu . ' ' . $penilaian->ket_bantu . ', ' . $penilaian->ket_bantu }}
                                                            </td>
                                                            <td width='33%' border='1'>Prothesa :
                                                                {{ $penilaian->prothesa . ' ' . $penilaian->ket_pro . ', ' . $penilaian->ket_pro }}
                                                            </td>
                                                            <td width='33%' border='1'>Aktivitas Sehari-hari ( ADL ) :
                                                                {{ $penilaian->adl }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                V. RIWAYAT PSIKO-SOSIAL, SPIRITUAL DAN BUDAYA
                                                <table width='100%' border='1' align='center' cellspacing='0px'
                                                    class='tbl_form table table-bordered'>
                                                    <tr>
                                                        <td width='50%' border='1'>Status Psikologis</td>
                                                        <td width='50%' border='1'>:
                                                            {{ $penilaian->status_psiko . ' ' . $penilaian->ket_psiko . ' ' . $penilaian->ket_psiko }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td border='1' colspan='2'>Status Sosial dan ekonomi :</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;a. Hubungan
                                                            pasien dengan anggota keluarga</td>
                                                        <td width='50%' border='1'>: {{ $penilaian->hub_keluarga }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;b. Tinggal
                                                            dengan</td>
                                                        <td width='50%' border='1'>:
                                                            {{ $penilaian->tinggal_dengan . ' ' . $penilaian->ket_tinggal . ' ' . $penilaian->ket_tinggal }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;c. Ekonomi
                                                        </td>
                                                        <td width='50%' border='1'>: {{ $penilaian->ekonomi }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='50%' border='1'>Kepercayaan / Budaya / Nilai-nilai
                                                            khusus yang perlu diperhatikan</td>
                                                        <td width='50%' border='1'>:
                                                            {{ $penilaian->budaya . '' . $penilaian->ket_budaya . ' ' . $penilaian->ket_budaya }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='50%' border='1'>Edukasi diberikan kepada</td>
                                                        <td width='50%' border='1'>:
                                                            {{ $penilaian->edukasi . '' . $penilaian->ket_edukasi . ' ' . $penilaian->ket_edukasi }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                VI. PENILAIAN RESIKO JATUH
                                                <table width='100%' border='1' align='center' cellspacing='0px'
                                                    class='tbl_form table table-bordered'>
                                                    <tr>
                                                        <td colpsan='2' border='1'>a. Cara Berjalan :</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;1. Tidak
                                                            seimbang / sempoyongan / limbung</td>
                                                        <td width='25%' border='1'>: {{ $penilaian->berjalan_a }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;2. Jalan
                                                            dengan menggunakan alat bantu (kruk, tripot, kursi roda, orang lain)
                                                        </td>
                                                        <td width='25%' border='1'>: {{ $penilaian->berjalan_b }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='75%' border='1'>b. Menopang saat akan duduk, tampak
                                                            memegang pinggiran kursi atau meja / benda lain sebagai penopang
                                                        </td>
                                                        <td width='25%' border='1'>: {{ $penilaian->berjalan_c }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='2' border='1'>Hasil :
                                                            {{ $penilaian->hasil . '  Dilaporkan kepada dokter ? ' . $penilaian->lapor . ' ' . $penilaian->ket_lapor . ' Jam dilaporkan : ' . $penilaian->ket_lapor }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                VII. SKRINING GIZI
                                                <table width='100%' border='1' align='center' cellspacing='0px'
                                                    class='tbl_form table table-bordered'>
                                                    <tr>
                                                        <td valign='middle' bgcolor='#FFF7F3' align='center' width='5%'>
                                                            No</td>
                                                        <td valign='middle' bgcolor='#FFF7F3' align='center' width='70%'>
                                                            Parameter</td>
                                                        <td valign='middle' bgcolor='#FFF7F3' align='center' width='25%'
                                                            colspan='2'>Nilai</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign='top'>1</td>
                                                        <td valign='top'>Apakah ada penurunan berat badan yang tidak
                                                            diinginkan selama enam bulan terakhir ?</td>
                                                        <td valign='top' align='center' width='20%'>
                                                            {{ $penilaian->sg1 }}</td>
                                                        <td valign='top' align='right' width='5%'>
                                                            {{ $penilaian->nilai1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign='top'>2</td>
                                                        <td valign='top'>Apakah nafsu makan berkurang karena tidak nafsu
                                                            makan ?</td>
                                                        <td valign='top' align='center' width='20%'>
                                                            {{ $penilaian->sg2 }}</td>
                                                        <td valign='top' align='right' width='5%'>
                                                            {{ $penilaian->nilai2 }}&nbsp;&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign='top' align='right' colspan='2'>Total Skor</td>
                                                        <td valign='top' align='right' colspan='2'>
                                                            {{ $penilaian->total_hasil }}&nbsp;&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                VIII. PENILAIAN TINGKAT NYERI
                                                <table width='100%' border='1' align='center' cellspacing='0px'
                                                    class='tbl_form table table-bordered'>
                                                    <tr>
                                                        <td width='50%' border='1'>Tingkat Nyeri :
                                                            {{ $penilaian->nyeri . ', Waktu / Durasi : ' . $penilaian->durasi . ' Menit' }}
                                                        </td>
                                                        <td width='50%' border='1'>Penyebab :
                                                            {{ $penilaian->provokes . ' ' . $penilaian->ket_provokes . ' ' . $penilaian->ket_provokes }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='50%' border='1'>Kualitas :
                                                            {{ $penilaian->quality . ' ' . $penilaian->ket_quality . ' ' . $penilaian->ket_quality }}
                                                        </td>
                                                        <td width='50%' border='1'>Severity : Skala Nyeri
                                                            {{ $penilaian->skala_nyeri }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='0' border='1'>Wilayah :</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;Lokasi :
                                                            {{ $penilaian->lokasi }}</td>
                                                        <td width='50%' border='1'>Menyebar :
                                                            {{ $penilaian->menyebar }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='50%' border='1'>Nyeri hilang bila :
                                                            {{ $penilaian->nyeri_hilang . ' ' . $penilaian->ket_nyeri . ' ' . $penilaian->ket_nyeri }}
                                                        </td>
                                                        <td width='50%' border='1'>Diberitahukan pada dokter :
                                                            {{ $penilaian->pada_dokter . ' ' . $penilaian->ket_dokter . ' Jam : ' . $penilaian->ket_dokter }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                <table width='100%' border='1' align='center' cellspacing='0px'
                                                    class='tbl_form table table-bordered'>
                                                    <tr>
                                                        <td valign='middle' bgcolor='#FFF7F3' align='center' width='50%'>
                                                            MASALAH KEPERAWATAN :</td>
                                                        <td valign='middle' bgcolor='#FFF7F3' align='center' width='50%'>
                                                            RENCANA KEPERAWATAN :</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @foreach ($penilaian->masalah_keperawatan as $masalah)
                                                                {{ $masalah->nama_masalah }}<br>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $penilaian->rencana }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif

                <!-- Penilaian Keperawatan Rawat Jalan Gigi -->
                @if (!empty($rawat->penilaian_keperawatan_ralan_gigi) and count($rawat->penilaian_keperawatan_ralan_gigi) > 0)
                    <tr class='isi'>
                        <td valign='top' width='2%'></td>
                        <td valign='top' width='18%'>Penilaian Awal Keperawatan Rawat Jalan Gigi & Mulut</td>
                        <td valign='top' width='1%' align='center'>:</td>
                        <td valign='top' width='79%'>
                            <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form'>
                                @foreach ($rawat->penilaian_keperawatan_ralan_gigi as $penilaian)
                                    <tr>
                                        <td valign='top'>
                                            YANG MELAKUKAN PENGKAJIAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='33%' border='1'>Tanggal :
                                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }} </td>
                                                    <td width='33%' border='1'>Petugas :
                                                        {{ !empty($penilaian->nip) ? $penilaian->nip : '' }}
                                                        {{ !empty($penilaian->nama) ? $penilaian->nama : '' }}</td>
                                                    <td width='33%' border='1'>Informasi didapat dari :
                                                        {{ !empty($penilaian->informasi) ? $penilaian->informasi : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            I. KEADAAN UMUM
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='20%' border='1'>TD :
                                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                                    <td width='20%' border='1'>Nadi :
                                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                                    <td width='20%' border='1'>RR :
                                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                                    <td width='20%' border='1'>Suhu :
                                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            II. STATUS NUTRISI
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='33%' border='1'>BB :
                                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                                    <td width='33%' border='1'>TB :
                                                        {{ !empty($penilaian->tb) ? $penilaian->tb : '' }} Cm</td>
                                                    <td width='33%' border='1'>BMI :
                                                        {{ !empty($penilaian->bmi) ? $penilaian->bmi : '' }} Kg/m²</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            III. RIWAYAT KESEHATAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td colspan='2'>Keluhan Utama :
                                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%'>Riwayat Penyakit :
                                                        {{ !empty($penilaian->riwayat_penyakit) ? $penilaian->riwayat_penyakit : '' }}
                                                        {{ !empty($penilaian->ket_riwayat_penyakit) ? $penilaian->ket_riwayat_penyakit : '' }}
                                                    </td>
                                                    <td width='50%'>Riwayat Perawatan Gigi :
                                                        {{ !empty($penilaian->riwayat_perawatan_gigi) ? $penilaian->riwayat_perawatan_gigi : '' }}
                                                        {{ !empty($penilaian->ket_riwayat_perawatan_gigi) ? $penilaian->ket_riwayat_perawatan_gigi : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%'>Riwayat Alergi :
                                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                                    <td width='50%'>Kebiasaan Lain :
                                                        {{ !empty($penilaian->kebiasaan_lain) ? $penilaian->kebiasaan_lain : '' }}
                                                        {{ !empty($penilaian->ket_kebiasaan_lain) ? $penilaian->ket_kebiasaan_lain : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%'>Kebiasaan Sikat Gigi :
                                                        {{ !empty($penilaian->kebiasaan_sikat_gigi) ? $penilaian->kebiasaan_sikat_gigi : '' }}
                                                    </td>
                                                    <td width='50%'>Obat Yang Diminum Saat Ini :
                                                        {{ !empty($penilaian->obat_yang_diminum_saatini) ? $penilaian->obat_yang_diminum_saatini : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            IV. FUNGSIONAL
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='50%' border='1'>Alat Bantu :
                                                        {{ !empty($penilaian->alat_bantu) ? $penilaian->alat_bantu : '' }}
                                                        {{ !empty($penilaian->ket_alat_bantu) ? $penilaian->ket_alat_bantu : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Prothesa :
                                                        {{ !empty($penilaian->prothesa) ? $penilaian->prothesa : '' }}
                                                        {{ !empty($penilaian->ket_pro) ? $penilaian->ket_pro : '' }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            V. RIWAYAT PSIKO-SOSIAL, SPIRITUAL DAN BUDAYA
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='50%' border='1'>Status Psikologis</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->status_psiko) ? $penilaian->status_psiko : '' }}
                                                        {{ !empty($penilaian->ket_psiko) ? $penilaian->ket_psiko : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td border='1' colspan='2'>Status Sosial dan ekonomi :</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;a. Hubungan
                                                        pasien dengan anggota
                                                        keluarga</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->hub_keluarga) ? $penilaian->hub_keluarga : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;b. Tinggal
                                                        dengan</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->tinggal_dengan) ? $penilaian->tinggal_dengan : '' }}
                                                        {{ !empty($penilaian->ket_tinggal) ? $penilaian->ket_tinggal : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;c. Ekonomi
                                                    </td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->ekonomi) ? $penilaian->ekonomi : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Kepercayaan / Budaya / Nilai-nilai
                                                        khusus yang perlu diperhatikan
                                                    </td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->budaya) ? $penilaian->budaya : '' }}
                                                        {{ !empty($penilaian->ket_budaya) ? $penilaian->ket_budaya : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Edukasi diberikan kepada</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}
                                                        {{ !empty($penilaian->ket_edukasi) ? $penilaian->ket_edukasi : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VI. PENILAIAN RESIKO JATUH
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td colpsan='2' border='1'>a. Cara Berjalan :</td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;1. Tidak
                                                        seimbang / sempoyongan / limbung
                                                    </td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_a) ? $penilaian->berjalan_a : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;2. Jalan
                                                        dengan menggunakan alat bantu
                                                        (kruk, tripot, kursi roda, orang lain)
                                                    </td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_b) ? $penilaian->berjalan_b : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>b. Menopang saat akan duduk, tampak
                                                        memegang pinggiran kursi atau
                                                        meja / benda lain sebagai penopang</td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_c) ? $penilaian->berjalan_c : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2' border='1'>Hasil :
                                                        {{ !empty($penilaian->hasil) ? $penilaian->hasil : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dilaporkan
                                                        kepada dokter
                                                        {{ !empty($penilaian->lapor) ? $penilaian->lapor : '' }}
                                                        ,{{ !empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VII. PENILAIAN TINGKAT NYERI
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='50%' border='1'>Tingkat Nyeri :
                                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}</td>
                                                    <td width='50%' border='1'>Skala Nyeri :
                                                        {{ !empty($penilaian->skala_nyeri) ? $penilaian->skala_nyeri : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Lokasi :
                                                        {{ !empty($penilaian->lokasi) ? $penilaian->lokasi : '' }}</td>
                                                    <td width='50%' border='1'>Durasi :
                                                        {{ !empty($penilaian->durasi) ? $penilaian->durasi : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Frekuensi :
                                                        {{ !empty($penilaian->frekuensi) ? $penilaian->frekuensi : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Nyeri hilang bila :
                                                        {{ !empty($penilaian->nyeri_hilang) ? $penilaian->nyeri_hilang : '' }}
                                                        ,{{ !empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td border='1' colspan='2'>Diberitahukan pada dokter
                                                        {{ !empty($penilaian->pada_dokter) ? $penilaian->pada_dokter : '' }}
                                                        ,Jam
                                                        :{{ !empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VIII. PENILAIAN INTRAORAL
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='50%' border='1'>Kebersihan Mulut :
                                                        {{ !empty($penilaian->kebersihan_mulut) ? $penilaian->kebersihan_mulut : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Mukosa Mulut :
                                                        {{ !empty($penilaian->mukosa_mulut) ? $penilaian->mukosa_mulut : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Karies :
                                                        {{ !empty($penilaian->karies) ? $penilaian->karies : '' }}</td>
                                                    <td width='50%' border='1'>Karang Gigi :
                                                        {{ !empty($penilaian->karang_gigi) ? $penilaian->karang_gigi : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Gingiva :
                                                        {{ !empty($penilaian->gingiva) ? $penilaian->gingiva : '' }}</td>
                                                    <td width='50%' border='1'>Palatum :
                                                        {{ !empty($penilaian->palatum) ? $penilaian->palatum : '' }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td valign='middle' bgcolor='#FFFAF8' align='center' width='50%'>
                                                        MASALAH KEPERAWATAN :</td>
                                                    <td valign='middle' bgcolor='#FFFAF8' align='center' width='50%'>
                                                        RENCANA KEPERAWATAN :</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @foreach ($penilaian->masalah_keperawatan as $masalah)
                                                            {{ !empty($masalah->nama_masalah) ? $masalah->nama_masalah : '' }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ !empty($penilaian->rencana) ? $penilaian->rencana : '' }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endif

                <!-- Penilaian Keperawatan Rawat Jalan Psikiatri -->
                @if (!empty($rawat->penilaian_awal_keperawatan_ralan_psikiatri) and
                    count($rawat->penilaian_awal_keperawatan_ralan_psikiatri) > 0)
                    <tr class='isi'>
                        <td valign='top' width='2%'></td>
                        <td valign='top' width='18%'>Penilaian Awal Keperawatan Rawat Jalan Psikiatri</td>
                        <td valign='top' width='1%' align='center'>:</td>
                        <td valign='top' width='79%'>
                            <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form'>
                                @foreach ($rawat->penilaian_awal_keperawatan_ralan_psikiatri as $penilaian)
                                    <tr>
                                        <td valign='top'>
                                            YANG MELAKUKAN PENGKAJIAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='33%' border='1'>Tanggal :
                                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }} </td>
                                                    <td width='33%' border='1'>Petugas :
                                                        {{ !empty($penilaian->nip) ? $penilaian->nip : '' }}
                                                        {{ !empty($penilaian->nama) ? $penilaian->nama : '' }}</td>
                                                    <td width='33%' border='1'>Informasi didapat dari :
                                                        {{ !empty($penilaian->informasi) ? $penilaian->informasi : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            I. RIWAYAT KESEHATAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td colspan='2'>Keluhan Utama :
                                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                                        {{ !empty($penilaian->rkd_keluhan) ? $penilaian->rkd_keluhan : '' }}
                                                    </td>
                                                    <td width='50%'>Sakit Sejak :
                                                        {{ !empty($penilaian->rkd_sakit_sejak) ? $penilaian->rkd_sakit_sejak : '' }}, Berobat : {{ !empty($penilaian->rkd_berobat) ? $penilaian->rkd_berobat : '' }}, Hasil Pengobatan : {{ !empty($penilaian->rkd_hasil_pengobatan) ? $penilaian->rkd_hasil_pengobatan : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            II. FAKTOR PRESIPITASI
                                            <table width='100%' border='1' align='center'
                                                cellspacing='0px' class='tbl_form'>
                                                <tr>
                                                    <td width='50%'>Putus Obat :
                                                        {{ !empty($penilaian->fp_putus_obat) ? $penilaian->fp_putus_obat : '' }},
                                                        {{ !empty($penilaian->ket_putus_obat) ? $penilaian->ket_putus_obat : '' }}
                                                    </td>
                                                    <td width='50%'>Masalah Ekonomi :
                                                        {{ !empty($penilaian->fp_ekonomi) ? $penilaian->fp_ekonomi : '' }},
                                                        {{ !empty($penilaian->ket_masalah_ekonomi) ? $penilaian->ket_masalah_ekonomi : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%'>Masalah Fisik :
                                                        {{ !empty($penilaian->fp_masalah_fisik) ? $penilaian->fp_masalah_fisik : '' }},
                                                        {{ !empty($penilaian->ket_masalah_fisik) ? $penilaian->ket_masalah_fisik : '' }}
                                                    </td>
                                                    <td width='50%'>Masalah Psikososial :
                                                        {{ !empty($penilaian->fp_masalah_psikososial) ? $penilaian->fp_masalah_psikososial : '' }},
                                                        {{ !empty($penilaian->ket_masalah_psikososial) ? $penilaian->ket_masalah_psikososial : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            III. FAKTOR RISIKO
                                            <table width='100%' border='1' align='center'
                                                cellspacing='0px' class='tbl_form'>
                                                <tr>
                                                    <td colspan="2">Resiko Herediter :</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        Keluarga Dengan Penyakit Jiwa :
                                                        {{ !empty($penilaian->rh_keluarga) ? $penilaian->rh_keluarga : '' }}, Jika Ya, Sebutkan :
                                                        {{ !empty($penilaian->ket_rh_keluarga) ? $penilaian->ket_rh_keluarga : '' }}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td colspan="2">Resiko Bunuh Diri :
                                                        {{ !empty($penilaian->resiko_bunuh_diri) ? $penilaian->resiko_bunuh_diri : '' }}
                                                    </td>
                                                </tr>
                                                <tr height="55px">
                                                    <td colspan="2" style="line-height: 1.3em;">Ada Ide :
                                                        {{ !empty($penilaian->rbd_ide) ? $penilaian->rbd_ide : '' }},
                                                        {{ !empty($penilaian->ket_rbd_ide) ? $penilaian->ket_rbd_ide : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ada Rencana :  {{ !empty($penilaian->rbd_rencana) ? $penilaian->rbd_rencana : '' }},
                                                        {{ !empty($penilaian->ket_rbd_rencana) ? $penilaian->ket_rbd_rencana : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mempersiapkan Alat :  {{ !empty($penilaian->rbd_alat) ? $penilaian->rbd_alat : '' }},
                                                        {{ !empty($penilaian->ket_rbd_alat) ? $penilaian->ket_rbd_alat : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pernah Mencoba Bunuh Diri :  {{ !empty($penilaian->rbd_percobaan) ? $penilaian->rbd_percobaan : '' }}, Kapan:
                                                        {{ !empty($penilaian->ket_rbd_percobaan) ? $penilaian->ket_rbd_percobaan : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Saat Ini Masih Ada Keinginan Untuk Bunuh Diri : {{ !empty($penilaian->rbd_keinginan) ? $penilaian->rbd_keinginan : '' }} Jika ya, Dengan Cara : {{ !empty($penilaian->ket_rbd_keinginan) ? $penilaian->ket_rbd_keinginan : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            IV. RIWAYAT PENGOBATAN
                                            <table width='100%' border='1' align='center'
                                                cellspacing='0px' class='tbl_form'>
                                                <tr height="75px" >
                                                    <td colspan="2" ><p style="line-height: 1.3em;">Penggunaan Obat Psikiatri :
                                                        {{ !empty($penilaian->rpo_penggunaan) ? $penilaian->rpo_penggunaan : '' }},
                                                        {{ !empty($penilaian->ket_rpo_penggunaan) ? $penilaian->ket_rpo_penggunaan : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Efek Samping Obat Psikiatri :  {{ !empty($penilaian->rpo_efek_samping) ? $penilaian->rpo_efek_samping : '' }},
                                                        {{ !empty($penilaian->ket_rpo_efek_samping) ? $penilaian->ket_rpo_efek_samping : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Riwayat Pengguaan Napza :  {{ !empty($penilaian->rpo_napza) ? $penilaian->rpo_napza : '' }},
                                                        {{ !empty($penilaian->ket_rpo_napza) ? $penilaian->ket_rpo_napza : '' }}, Lama : {{ !empty($penilaian->ket_lama_pemakaian) ? $penilaian->ket_lama_pemakaian : '' }}, Cara Pakai : {{ !empty($penilaian->ket_cara_pemakaian) ? $penilaian->ket_cara_pemakaian : '' }}, Latar Belakang :  {{ !empty($penilaian->ket_latar_belakang_pemakaian) ? $penilaian->ket_latar_belakang_pemakaian : '' }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Penggunaan Obat Lainya :  {{ !empty($penilaian->rpo_penggunaan_obat_lainnya) ? $penilaian->rpo_penggunaan_obat_lainnya : '' }}, {{ !empty($penilaian->ket_rpo_penggunaan) ? $penilaian->ket_rpo_penggunaan : '' }}, Alasan Penggunaan :
                                                        {{ !empty($penilaian->ket_alasan_penggunaan) ? $penilaian->ket_alasan_penggunaan : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Riwayat Alergi Obat : {{ !empty($penilaian->rpo_alergi_obat) ? $penilaian->rpo_alergi_obat : '' }}, {{ !empty($penilaian->ket_alergi_obat) ? $penilaian->ket_alergi_obat : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Merokok : {{ !empty($penilaian->rpo_merokok) ? $penilaian->rpo_merokok : '' }}, {{ !empty($penilaian->ket_merokok) ? $penilaian->ket_merokok : '' }} Batang/Hari&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Minum Kopi : {{ !empty($penilaian->rpo_minum_kopi) ? $penilaian->rpo_minum_kopi : '' }},
                                                            {{ !empty($penilaian->ket_minum_kopi) ? $penilaian->ket_merokok : '' }} Gelas/Hari </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            V. Pemeriksaan Fisik
                                            <table width='100%' border='1' align='center'
                                                cellspacing='0px' class='tbl_form'>
                                                <tr>
                                                    <td colspan='5'>Apakah Terdapat Keluhan Fisik :
                                                        {{ !empty($penilaian->pf_keluhan_fisik) ? $penilaian->pf_keluhan_fisik : '' }}(
                                                        {{ !empty($penilaian->ket_keluhan_fisik) ? $penilaian->ket_keluhan_fisik : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='20%' border='1'>TD :
                                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                                    <td width='20%' border='1'>Nadi :
                                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit
                                                    </td>
                                                    <td width='20%' border='1'>RR :
                                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                                    <td width='20%' border='1'>Suhu :
                                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                                    <td width='20%' border='1'>GCS(E,V,M) :
                                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }} °C</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VI. PENILAIAN TINGKAT NYERI
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='50%' border='1'>Tingkat Nyeri :
                                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}, Waktu /
                                                        Durasi :
                                                        {{ !empty($penilaian->durasi) ? $penilaian->durasi : '' }} Menit
                                                    </td>
                                                    <td width='50%' border='1'>Penyebab :
                                                        {{ !empty($penilaian->provokes) ? $penilaian->provokes : '' }},
                                                        {{ !empty($penilaian->ket_provokes) ? $penilaian->ket_provokes : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Kualitas :
                                                        {{ !empty($penilaian->quality) ? $penilaian->quality : '' }},
                                                        {{ !empty($penilaian->ket_quality) ? $penilaian->ket_quality : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Severity : Skala Nyeri
                                                        {{ !empty($penilaian->skala_nyeri) ? $penilaian->skala_nyeri : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='0' border='1'>Wilayah :</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;Lokasi :
                                                        {{ !empty($penilaian->lokasi) ? $penilaian->lokasi : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Menyebar :
                                                        {{ !empty($penilaian->menyebar) ? $penilaian->menyebar : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Nyeri hilang bila :
                                                        {{ !empty($penilaian->nyeri_hilang) ? $penilaian->nyeri_hilang : '' }},
                                                        {{ !empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Diberitahukan pada dokter ?
                                                        {{ !empty($penilaian->pada_dokter) ? $penilaian->pada_dokter : '' }},
                                                        Jam : {{ !empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VII. STATUS NUTRISI
                                            <table width='100%' border='1' align='center'
                                                cellspacing='0px' class='tbl_form'>
                                                <tr>
                                                    <td width='20%' border='1'>BB :
                                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                                    <td width='20%' border='1'>TB :
                                                        {{ !empty($penilaian->tb) ? $penilaian->tb : '' }} Cm</td>
                                                    <td width='20%' border='1'>BMI :
                                                        {{ !empty($penilaian->bmi) ? $penilaian->bmi : '' }} Kg/m²</td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2' border='1'>Dilaporkan Kepada DPJP ?
                                                        {{ $penilaian->lapor_status_nutrisi  . $penilaian->ket_lapor_status_nutrisi . ' Jam dilaporkan : ' . $penilaian->ket_lapor_status_nutrisi }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            IX. SKRINING GIZI
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        No.</td>
                                                    <td width='75%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        Parameter</td>
                                                    <td width='20%' bgcolor='#FFFAF8' colspan='2'
                                                        align='center' valign='middle'>Nilai</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Apakah ada penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir ?</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->sg1) ? $penilaian->sg1 : '' }}</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilai1) ? $penilaian->nilai1 : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Apakah nafsu makan berkurang, karena tidak nafsu makan ?
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->sg2) ? $penilaian->sg2 : '' }}</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilai2) ? $penilaian->nilai2 : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td align='center' colspan='3'>Total Skor</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->total_hasil) ? $penilaian->total_hasil : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VIII. PENILAIAN RESIKO JATUH
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td colpsan='2' border='1'>a. Cara Berjalan :</td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;1. Tidak
                                                        seimbang / sempoyongan / limbung
                                                    </td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_a) ? $penilaian->berjalan_a : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;2. Jalan
                                                        dengan menggunakan alat bantu
                                                        (kruk, tripot, kursi roda, orang lain)
                                                    </td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_b) ? $penilaian->berjalan_b : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>b. Menopang saat akan duduk, tampak memegang pinggiran kursi atau meja/benda lain sebagai penopang</td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->msa) ? $penilaian->msa : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2' border='1'>Hasil :
                                                        {{ !empty($penilaian->hasil) ? $penilaian->hasil : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diberitahukan
                                                        ke dokter ?
                                                        {{ !empty($penilaian->lapor) ? $penilaian->lapor : '' }}{{ !empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : '' }}.equals()?:
                                                        Jam dilaporkan :
                                                        {{ !empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                        <tr>
                                            <td valign='top'>
                                                IX. STATUS FUNGSIONAL
                                                <table width='100%' border='1' align='center'
                                                    cellspacing='0px' class='tbl_form'>
                                                    <tr>
                                                        <td width='25%' >Mandi:
                                                            {{ !empty($penilaian->adl_mandi) ? $penilaian->adl_mandi : '' }}
                                                        </td>
                                                        <td width='50%'>Sosialisasi :
                                                            {{ !empty($penilaian->adl_sosialisasi) ? $penilaian->adl_sosialisasi : '' }} (
                                                                {{ !empty($penilaian->ket_adl_sosialisasi) ? $penilaian->ket_adl_sosialisasi : '' }})
                                                        </td>
                                                        <td width='25%'>Berpakaian :
                                                            {{ !empty($penilaian->adl_berpakaian) ? $penilaian->adl_berpakaian : '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='25%' >Bak:
                                                            {{ !empty($penilaian->adl_bak) ? $penilaian->adl_bak : '' }}
                                                        </td>
                                                        <td width='50%'>Melakukan Hobi :
                                                            {{ !empty($penilaian->adl_hobi) ? $penilaian->adl_hobi : '' }} (
                                                                {{ !empty($penilaian->ket_adl_hobi) ? $penilaian->ket_adl_hobi : '' }})
                                                        </td>
                                                        <td width='25%'>Makan/Minum :
                                                            {{ !empty($penilaian->adl_makan) ? $penilaian->adl_makan : '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='25%' >BAB :
                                                            {{ !empty($penilaian->adl_bab) ? $penilaian->adl_bab : '' }}
                                                        </td>
                                                        <td colspan="2">Kegiatan RT :
                                                            {{ !empty($penilaian->adl_kegiatan) ? $penilaian->adl_kegiatan : '' }} (
                                                                {{ !empty($penilaian->ket_adl_kegiatan) ? $penilaian->ket_adl_kegiatan : '' }})
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                IX. STATUS KESEHATAN SAAT INI
                                                <table width='100%' border='1' align='center' cellspacing='0px' class='tbl_form'>
                                                <tr>
                                                    <td colspan="2" ><p style="line-height: 1.3em;">Penampilan : {{ !empty($penilaian->sk_penampilan) ? $penilaian->sk_penampilan : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pembicara : {{ !empty($penilaian->sk_pembicaraan) ? $penilaian->sk_pembicaraan : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alam Perasaan : {{ !empty($penilaian->sk_alam_perasaan) ? $penilaian->sk_alam_perasaan : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Afek : {{ !empty($penilaian->sk_afek) ? $penilaian->sk_afek : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aktivitas Motorik/Prilaku : {{ !empty($penilaian->sk_aktifitas_motorik) ? $penilaian->sk_aktifitas_motorik : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Interaksi Selama Wawancara : {{ !empty($penilaian->sk_interaksi) ? $penilaian->sk_interaksi : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proses Pikir : {{ !empty($penilaian->sk_proses_pikir) ? $penilaian->sk_proses_pikir : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Daya Tilik Diri : {{ !empty($penilaian->sk_afek) ? $penilaian->sk_afek : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Afek : {{ !empty($penilaian->sk_daya_tilik_diri) ? $penilaian->sk_daya_tilik_diri : '' }}, {{ !empty($penilaian->ket_sk_daya_tilik_diri) ? $penilaian->ket_sk_daya_tilik_diri : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Memori : {{ !empty($penilaian->sk_memori) ? $penilaian->sk_memori : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tingkat Konsentrasi & Berhitung : {{ !empty($penilaian->sk_konsentrasi) ? $penilaian->sk_konsentrasi : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Persepsi : {{ !empty($penilaian->sk_persepsi) ? $penilaian->sk_persepsi : '' }}, {{ !empty($penilaian->ket_sk_persepsi) ? $penilaian->ket_sk_persepsi : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kesadaran : Orientasi : {{ !empty($penilaian->sk_orientasi) ? $penilaian->sk_orientasi : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Isi Pikir : {{ !empty($penilaian->sk_isi_pikir) ? $penilaian->sk_isi_pikir : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waham : {{ !empty($penilaian->sk_waham) ? $penilaian->sk_waham : '' }}, {{ !empty($penilaian->ket_sk_waham) ? $penilaian->ket_sk_waham : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kemampuan Penilaian : {{ !empty($penilaian->sk_gangguan_ringan) ? $penilaian->sk_gangguan_ringan :'' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                                    </td>
                                                </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                XII. KEBUTUHAN KOMUNIKASI DAN EDUKASI
                                                <table width='100%' border='1' align='center' cellspacing='0px'
                                                    class='tbl_form'>
                                                    <tr>
                                                        <td colspan="2" ><p style="line-height: 1.3em;">Terdapat hambatan Dalam Pembelajaran : {{ !empty($penilaian->kk_pembelajaran) ? $penilaian->kk_pembelajaran : '' }} Jika ya,{{ !empty($penilaian->ket_kk_pembelajaran) ? $penilaian->ket_kk_pembelajaran : '' }} Lainya : {{ !empty($penilaian->ket_kk_pembelajaran_lainnya) ? $penilaian->ket_kk_pembelajaran_lainnya : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dibutuhkan Penerjamah : {{ !empty($penilaian->kk_Penerjamah) ? $penilaian->kk_Penerjamah : '' }} Jika ya,{{ !empty($penilaian->ket_kk_penerjamah_Lainnya) ? $penilaian->ket_kk_penerjamah_Lainnya : '' }} Isyarat : {{ !empty($penilaian->kk_bahasa_isyarat) ? $penilaian->kk_bahasa_isyarat : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kebutuhan Edukasi(Pilih Topik Edukasi Pada Kolom Yang tersedia) : {{ !empty($penilaian->kk_kebutuhan_edukasi) ? $penilaian->kk_kebutuhan_edukasi : '' }} Lainya : {{ !empty($penilaian->ket_kk_kebutuhan_edukasi) ? $penilaian->ket_kk_kebutuhan_edukasi : '' }}</p>
                                                        </td>
                                                    </tr>


                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign='top'>
                                                <table width='100%' border='1' align='center' cellspacing='0px'
                                                    class='tbl_form'>
                                                    <tr>
                                                        <td valign='middle' bgcolor='#FFFAF8' align='center'
                                                            width='50%'>MASALAH KEPERAWATAN :</td>
                                                        <td valign='middle' bgcolor='#FFFAF8' align='center'
                                                            width='50%'>RENCANA KEPERAWATAN :</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @foreach ($penilaian->masalah_keperawatan as $masalah)
                                                                {{ !empty($masalah->nama_masalah) ? $masalah->nama_masalah : '' }}<br>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ !empty($penilaian->rencana) ? $penilaian->rencana : '' }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endif

                <!-- Penilaian Keperawatan Rawat Jalan Bayi -->
                @if (!empty($rawat->penilaian_keperawatan_ralan_bayi) and count($rawat->penilaian_keperawatan_ralan_bayi) > 0)
                    <tr class='isi'>
                        <td valign='top' width='2%'></td>
                        <td valign='top' width='18%'>Penilaian Awal Keperawatan Rawat Jalan Bayi/Anak</td>
                        <td valign='top' width='1%' align='center'>:</td>
                        <td valign='top' width='79%'>
                            <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form'>
                                @foreach ($rawat->penilaian_keperawatan_ralan_bayi as $penilaian)
                                    <tr>
                                        <td valign='top'>
                                            YANG MELAKUKAN PENGKAJIAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='33%' border='1'>Tanggal :
                                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                                    <td width='33%' border='1'>Petugas :
                                                        {{ !empty($penilaian->nip) ? $penilaian->nip : '' }}
                                                        {{ !empty($penilaian->nama) ? $penilaian->nama : '' }}</td>
                                                    <td width='33%' border='1'>Informasi didapat dari :
                                                        {{ !empty($penilaian->informasi) ? $penilaian->informasi : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            I. KEADAAN UMUM
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='20%' border='1'>TD :
                                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                                    <td width='20%' border='1'>Nadi :
                                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit
                                                    </td>
                                                    <td width='20%' border='1'>RR :
                                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                                    <td width='20%' border='1'>Suhu :
                                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                                    <td width='20%' border='1'>GCS(E,V,M) :
                                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }} °C</td>
                                                </tr>
                                                <tr>
                                                    <td width='20%' border='1'>BB :
                                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                                    <td width='20%' border='1'>TB :
                                                        {{ !empty($penilaian->tb) ? $penilaian->tb : '' }} Cm</td>
                                                    <td width='20%' border='1'>LP :
                                                        {{ !empty($penilaian->lp) ? $penilaian->lp : '' }} Cm</td>
                                                    <td width='20%' border='1'>LK :
                                                        {{ !empty($penilaian->lk) ? $penilaian->lk : '' }} Cm</td>
                                                    <td width='20%' border='1'>LD :
                                                        {{ !empty($penilaian->ld) ? $penilaian->ld : '' }} Cm</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            II. RIWAYAT KESEHATAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td colspan='2'>Keluhan Utama :
                                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                                    <td width='50%'>Riwayat Alergi :
                                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%'>Riwayat Penyakit Keluarga :
                                                        {{ !empty($penilaian->rpk) ? $penilaian->rpk : '' }}</td>
                                                    <td width='50%'>Riwayat Pengobatan :
                                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            III. RIWAYAT TUMBUH KEMBANG DAN PERINATAL CARE
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='50%' border='1'>Riwayat Kelahiran : Anak ke
                                                        {{ !empty($penilaian->anakke) ? $penilaian->anakke : '' }} dari
                                                        {{ !empty($penilaian->darisaudara) ? $penilaian->darisaudara : '' }}
                                                        saudara</td>
                                                    <td width='50%' border='1'>Cara kelahiran :
                                                        {{ !empty($penilaian->caralahir) ? $penilaian->caralahir : '' }}{{ !empty($penilaian->ket_caralahir) ? $penilaian->ket_caralahir : '' }}
                                                        ,
                                                        {{ !empty($penilaian->ket_caralahir) ? $penilaian->ket_caralahir : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Umur Kelahiran :
                                                        {{ !empty($penilaian->umurkelahiran) ? $penilaian->umurkelahiran : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Kelainan Bawaan :
                                                        {{ !empty($penilaian->kelainanbawaan) ? $penilaian->kelainanbawaan : '' }}{{ !empty($penilaian->ket_kelainan_bawaan) ? $penilaian->ket_kelainan_bawaan : '' }}
                                                        ,
                                                        {{ !empty($penilaian->ket_kelainan_bawaan) ? $penilaian->ket_kelainan_bawaan : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            IV. RIWAYAT IMUNISASI
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='70%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        Imunisasi</td>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        1</td>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        2</td>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        3</td>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        4</td>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        5</td>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        6</td>
                                                </tr>
                                                @foreach ($penilaian->riwayat_imunisasi as $riwayat)
                                                    <tr>
                                                        <td align='left'>
                                                            {{ !empty($riwayat->nama_imunisasi) ? $riwayat->nama_imunisasi : '' }}
                                                        </td>
                                                        @for ($a = 1; $a <= 6; $a++)
                                                            @if ($a == $riwayat->no_imunisasi)
                                                                <td align='center'>&#10003;</td>
                                                            @else
                                                                <td align='center'></td>
                                                            @endif
                                                        @endfor


                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='100%' valign='top'>
                                            V. RIWAYAT TUMBUH KEMBANG ANAK
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='25%' border='1'>a. Tengkurap, usia
                                                        {{ !empty($penilaian->usiatengkurap) ? $penilaian->usiatengkurap : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>b. Duduk, usia
                                                        {{ !empty($penilaian->usiaduduk) ? $penilaian->usiaduduk : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>c. Berdiri, usia
                                                        {{ !empty($penilaian->usiaberdiri) ? $penilaian->usiaberdiri : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>d. Pertumbuhan gigi pertama, usia
                                                        {{ !empty($penilaian->usiagigipertama) ? $penilaian->usiagigipertama : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='25%' border='1'>e. Berjalan, usia
                                                        {{ !empty($penilaian->usiaberjalan) ? $penilaian->usiaberjalan : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>f. Bicara, usia
                                                        {{ !empty($penilaian->usiabicara) ? $penilaian->usiabicara : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>g. Mulai bisa membaca, usia
                                                        {{ !empty($penilaian->usiamembaca) ? $penilaian->usiamembaca : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>h. Mulai bisa menulis, usia
                                                        {{ !empty($penilaian->usiamenulis) ? $penilaian->usiamenulis : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='100%' border='1' colspan='4'>Gangguan
                                                        perkembangan mental / emosi, bila ada,
                                                        jelaskan
                                                        {{ !empty($penilaian->gangguanemosi) ? $penilaian->gangguanemosi : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VI. FUNGSIONAL
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='33%' border='1'>Alat Bantu :
                                                        {{ !empty($penilaian->alat_bantu) ? $penilaian->alat_bantu : '' }}{{ !empty($penilaian->ket_bantu) ? $penilaian->ket_bantu : '' }}
                                                        ,
                                                        {{ !empty($penilaian->ket_bantu) ? $penilaian->ket_bantu : '' }}
                                                    </td>
                                                    <td width='33%' border='1'>Prothesa :
                                                        {{ !empty($penilaian->prothesa) ? $penilaian->prothesa : '' }}{{ !empty($penilaian->ket_pro) ? $penilaian->ket_pro : '' }}
                                                        ,
                                                        {{ !empty($penilaian->ket_pro) ? $penilaian->ket_pro : '' }}
                                                    </td>
                                                    <td width='33%' border='1'>Aktivitas Sehari-hari ( ADL ) :
                                                        {{ !empty($penilaian->adl) ? $penilaian->adl : '' }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VII. RIWAYAT PSIKO-SOSIAL, SPIRITUAL DAN BUDAYA
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='50%' border='1'>Status Psikologis</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->status_psiko) ? $penilaian->status_psiko : '' }}{{ !empty($penilaian->ket_psiko) ? $penilaian->ket_psiko : '' }}
                                                        ,
                                                        {{ !empty($penilaian->ket_psiko) ? $penilaian->ket_psiko : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td border='1' colspan='2'>Status Sosial dan Ekonomi :</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;a. Hubungan
                                                        pasien dengan anggota
                                                        keluarga</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->hub_keluarga) ? $penilaian->hub_keluarga : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;b. Pengasuh
                                                    </td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->pengasuh) ? $penilaian->pengasuh : '' }}{{ !empty($penilaian->ket_pengasuh) ? $penilaian->ket_pengasuh : '' }}
                                                        ,
                                                        {{ !empty($penilaian->ket_pengasuh) ? $penilaian->ket_pengasuh : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;c. Ekonomi
                                                        (Orang tua)</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->ekonomi) ? $penilaian->ekonomi : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Kepercayaan / Budaya / Nilai-nilai
                                                        khusus yang perlu diperhatikan
                                                    </td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->budaya) ? $penilaian->budaya : '' }}{{ !empty($penilaian->ket_budaya) ? $penilaian->ket_budaya : '' }}
                                                        ,
                                                        {{ !empty($penilaian->ket_budaya) ? $penilaian->ket_budaya : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Edukasi diberikan kepada</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}{{ !empty($penilaian->ket_edukasi) ? $penilaian->ket_edukasi : '' }}
                                                        ,
                                                        {{ !empty($penilaian->ket_edukasi) ? $penilaian->ket_edukasi : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VIII. PENILAIAN RESIKO JATUH
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td colpsan='2' border='1'>a. Cara Berjalan :</td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;1. Tidak
                                                        seimbang / sempoyongan / limbung
                                                    </td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_a) ? $penilaian->berjalan_a : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;2. Jalan
                                                        dengan menggunakan alat bantu
                                                        (kruk, tripot, kursi roda, orang lain)
                                                    </td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_b) ? $penilaian->berjalan_b : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>b. Duduk di kursi tanpa menggunakan
                                                        tangan sebagai penopang
                                                        (tampak memegang kursi atau meja/ benda lain)</td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_c) ? $penilaian->berjalan_c : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2' border='1'>Hasil :
                                                        {{ !empty($penilaian->hasil) ? $penilaian->hasil : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diberitahukan
                                                        ke dokter ?
                                                        {{ !empty($penilaian->lapor) ? $penilaian->lapor : '' }}{{ !empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : '' }}.equals()?:
                                                        Jam dilaporkan :
                                                        {{ !empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            IX. SKRINING GIZI (Strong kid)
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        No.</td>
                                                    <td width='75%' bgcolor='#FFFAF8' align='center' valign='middle'>
                                                        Parameter</td>
                                                    <td width='20%' bgcolor='#FFFAF8' colspan='2'
                                                        align='center' valign='middle'>Nilai</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Apakah pasien tampak kurus</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->sg1) ? $penilaian->sg1 : '' }}</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilai1) ? $penilaian->nilai1 : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Apakah terdapat penurunan berat badan selama satu bulan terakhir?
                                                        (berdasarkan penilaian
                                                        objektif data berat badan bila ada atau untuk bayi < 1 tahun ; berat
                                                            badan tidak naik selama 3 bulan terakhir</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->sg2) ? $penilaian->sg2 : '' }}</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilai2) ? $penilaian->nilai2 : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Apakah terdapat salah satu dari kondisi tersebut? Diare > 5
                                                        kali/hari dan/muntah > 3
                                                        kali/hari salam seminggu terakhir; Asupan makanan berkurang selama 1
                                                        minggu terakhir
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->sg3) ? $penilaian->sg3 : '' }}</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilai3) ? $penilaian->nilai3 : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Apakah terdapat penyakit atau keadaan yang menyebabkan pasien
                                                        beresiko mengalami
                                                        malnutrisi?</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->sg4) ? $penilaian->sg4 : '' }}</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilai4) ? $penilaian->nilai4 : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td align='center' colspan='3'>Total Skor</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->total_hasil) ? $penilaian->total_hasil : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            X. PENILAIAN TINGKAT NYERI (Skala FLACCS)
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='30%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle'>Pengkajian</td>
                                                    <td width='60%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle'>Parameter</td>
                                                    <td width='10%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle'>Nilai</td>
                                                </tr>
                                                <tr>
                                                    <td align='center'>Wajah</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->wajah) ? $penilaian->wajah : '' }}</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilaiwajah) ? $penilaian->nilaiwajah : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align='center'>Kaki</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->kaki) ? $penilaian->kaki : '' }}</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilaikaki) ? $penilaian->nilaikaki : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align='center'>Aktifitas</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->aktifitas) ? $penilaian->aktifitas : '' }}
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilaiaktifitas) ? $penilaian->nilaiaktifitas : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align='center'>Menangis</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->menangis) ? $penilaian->menangis : '' }}
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilaimenangis) ? $penilaian->nilaimenangis : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align='center'>Bersuara</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->bersuara) ? $penilaian->bersuara : '' }}
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->nilaibersuara) ? $penilaian->nilaibersuara : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align='left' colspan='2'>Keterangan : 0 : Nyaman 1-3 :
                                                        Kurang nyaman 4-6 : Nyeri sedang
                                                        7-10 : Nyeri berat</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->hasilnyeri) ? $penilaian->hasilnyeri : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td width='50%' border='1'>Tingkat Nyeri :
                                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}</td>
                                                    <td width='50%' border='1'>Lokasi :
                                                        {{ !empty($penilaian->lokasi) ? $penilaian->lokasi : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Durasi :
                                                        {{ !empty($penilaian->durasi) ? $penilaian->durasi : '' }}</td>
                                                    <td width='50%' border='1'>Frekuensi :
                                                        {{ !empty($penilaian->frekuensi) ? $penilaian->frekuensi : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Nyeri hilang bila :
                                                        {{ !empty($penilaian->nyeri_hilang) ? $penilaian->nyeri_hilang : '' }}{{ !empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : '' }}
                                                        ,
                                                        {{ !empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Diberitahukan pada dokter ?
                                                        {{ !empty($penilaian->pada_dokter) ? $penilaian->pada_dokter : '' }}{{ !empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : '' }}
                                                        , Jam :
                                                        {{ !empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>
                                                <tr>
                                                    <td valign='middle' bgcolor='#FFFAF8' align='center'
                                                        width='50%'>MASALAH KEPERAWATAN :</td>
                                                    <td valign='middle' bgcolor='#FFFAF8' align='center'
                                                        width='50%'>RENCANA KEPERAWATAN :</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @foreach ($penilaian->masalah_keperawatan as $masalah)
                                                            {{ !empty($masalah->nama_masalah) ? $masalah->nama_masalah : '' }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ !empty($penilaian->rencana) ? $penilaian->rencana : '' }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endif

                <!-- Penilaian Keperawatan Rawat Jalan Kandungan  -->
                @if (!empty($rawat->penilaian_keperawatan_ralan_kandungan) and
                    count($rawat->penilaian_keperawatan_ralan_kandungan) > 0)
                    <tr class='isi'>
                        <td valign='top' width='2%'></td>
                        <td valign='top' width='18%'>Penilaian Awal Keperawatan Rawat Jalan Kandungan</td>
                        <td valign='top' width='1%' align='center'>:</td>
                        <td valign='top' width='79%'>
                            <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form'>
                                @foreach ($rawat->penilaian_keperawatan_ralan_kandungan as $penilaian)
                                    <tr>
                                        <td valign='top'>
                                            YANG MELAKUKAN PENGKAJIAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='33%' border='1'>Tanggal :
                                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                                    <td width='33%' border='1'>Petugas :
                                                        {{ !empty($penilaian->nip) ? $penilaian->nip : '' }}
                                                        {{ !empty($penilaian->nama) ? $penilaian->nama : '' }}
                                                    </td>
                                                    <td width='33%' border='1'>Informasi didapat dari :
                                                        {{ !empty($penilaian->informasi) ? $penilaian->informasi : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            I. KEADAAN UMUM
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='20%' border='1'>TD :
                                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                                    <td width='20%' border='1'>Nadi :
                                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit
                                                    </td>
                                                    <td width='20%' border='1'>RR :
                                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                                    <td width='20%' border='1'>Suhu :
                                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                                    <td width='20%' border='1'>GCS(E,V,M) :
                                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }} °C</td>
                                                </tr>
                                                <tr>
                                                    <td width='20%' border='1'>BB :
                                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                                    <td width='20%' border='1'>TB :
                                                        {{ !empty($penilaian->tb) ? $penilaian->tb : '' }} Cm</td>
                                                    <td width='20%' border='1'>LILA :
                                                        {{ !empty($penilaian->lila) ? $penilaian->lila : '' }} Cm</td>
                                                    <td width='20%' border='1'>BMI :
                                                        {{ !empty($penilaian->bmi) ? $penilaian->bmi : '' }} Kg/m²</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            II. PEMERIKSAAN KEBIDANAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='20%' border='1'>TFU :
                                                        {{ !empty($penilaian->tfu) ? $penilaian->tfu : '' }} cm</td>
                                                    <td width='20%' border='1'>TBJ :
                                                        {{ !empty($penilaian->tbj) ? $penilaian->tbj : '' }}</td>
                                                    <td width='20%' border='1'>Letak :
                                                        {{ !empty($penilaian->letak) ? $penilaian->letak : '' }}</td>
                                                    <td width='20%' border='1'>Presentasi :
                                                        {{ !empty($penilaian->presentasi) ? $penilaian->presentasi : '' }}
                                                    </td>
                                                    <td width='20%' border='1'>Penurunan :
                                                        {{ !empty($penilaian->penurunan) ? $penilaian->penurunan : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='25%' border='1'>Kontraksi/HIS :
                                                        {{ !empty($penilaian->his) ? $penilaian->his : '' }} x/10’</td>
                                                    <td width='25%' border='1'>Kekuatan :
                                                        {{ !empty($penilaian->kekuatan) ? $penilaian->kekuatan : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Lamanya :
                                                        {{ !empty($penilaian->lamanya) ? $penilaian->lamanya : '' }}</td>
                                                    <td width='25%' border='1'>Gerak janin x/30 menit, BJJ :
                                                        {{ !empty($penilaian->bjj) ? $penilaian->bjj : '' }}
                                                        {{ !empty($penilaian->ket_bjj) ? $penilaian->ket_bjj : '' }}</td>
                                                </tr>
                                            </table>
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='25%' border='1'>Portio :
                                                        {{ !empty($penilaian->portio) ? $penilaian->portio : '' }}</td>
                                                    <td width='25%' border='1'>Pembukaan Serviks :
                                                        {{ !empty($penilaian->serviks) ? $penilaian->serviks : '' }} cm
                                                    </td>
                                                    <td width='25%' border='1'>Ketuban :
                                                        {{ !empty($penilaian->ketuban) ? $penilaian->ketuban : '' }}
                                                        kep/bok</td>
                                                    <td width='25%' border='1'>Hodge :
                                                        {{ !empty($penilaian->hodge) ? $penilaian->hodge : '' }}</td>
                                                </tr>
                                            </table>
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td border='1' colspan='4'>Pemeriksaan Penunjang :</td>
                                                </tr>
                                                <tr>
                                                    <td width='10%' border='1' align='right'>Inspekulo</td>
                                                    <td width='40%' border='1'>:
                                                        {{ !empty($penilaian->inspekulo) ? $penilaian->inspekulo : '' }},
                                                        Hasil :
                                                        {{ !empty($penilaian->ket_inspekulo) ? $penilaian->ket_inspekulo : '' }}
                                                    </td>
                                                    <td colspan='2' border='1'>Laboratorium :
                                                        {{ !empty($penilaian->lab) ? $penilaian->lab : '' }}, Hasil :
                                                        {{ !empty($penilaian->ket_lab) ? $penilaian->ket_lab : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='10%' border='1' align='right'>CTG</td>
                                                    <td width='40%' border='1'>:
                                                        {{ !empty($penilaian->ctg) ? $penilaian->ctg : '' }}, Hasil :
                                                        {{ !empty($penilaian->ket_ctg) ? $penilaian->ket_ctg : '' }}
                                                    </td>
                                                    <td colspan='2' border='1'>Lakmus :
                                                        {{ !empty($penilaian->lakmus) ? $penilaian->lakmus : '' }}, Hasil
                                                        :
                                                        {{ !empty($penilaian->ket_lakmus) ? $penilaian->ket_lakmus : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='10%' border='1' align='right'>USG</td>
                                                    <td width='40%' border='1'>:
                                                        {{ !empty($penilaian->usg) ? $penilaian->usg : '' }}, Hasil :
                                                        {{ !empty($penilaian->ket_usg) ? $penilaian->ket_usg : '' }}
                                                    </td>
                                                    <td colspan='2' border='1'>Pemeriksaan Panggul :
                                                        {{ !empty($penilaian->panggul) ? $penilaian->panggul : '' }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            III. RIWAYAT KESEHATAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr class='isi'>
                                                    <td width='20%' colspan='2'>Keluhan Utama :
                                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}
                                                    </td>
                                                </tr>
                                                <tr class='isi'>
                                                    <td width='20%'>Riwayat Menstruasi</td>
                                                    <td width='80%'>Umur Menarche :
                                                        {{ !empty($penilaian->umur) ? $penilaian->umur : '' }} tahun,
                                                        lamanya :
                                                        {{ !empty($penilaian->lama) ? $penilaian->lama : '' }} hari,
                                                        banyaknya :
                                                        {{ !empty($penilaian->banyaknya) ? $penilaian->banyaknya : '' }}
                                                        pembalut&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Haid
                                                        Terakhir :
                                                        {{ !empty($penilaian->haid) ? $penilaian->haid : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Siklus
                                                        :
                                                        {{ !empty($penilaian->siklus) ? $penilaian->siklus : '' }} hari, (
                                                        {{ !empty($penilaian->ket_siklus) ? $penilaian->ket_siklus : '' }}
                                                        ),
                                                        {{ !empty($penilaian->ket_siklus1) ? $penilaian->ket_siklus1 : '' }}
                                                    </td>
                                                </tr>
                                                <tr class='isi'>
                                                    <td width='20%'>Riwayat Perkawinan</td>
                                                    <td width='80%'>Status Menikah :
                                                        {{ !empty($penilaian->status) ? $penilaian->status : '' }}
                                                        {{ !empty($penilaian->kali) ? $penilaian->kali : '' }}
                                                        kali&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Usia Perkawinan
                                                        1 :
                                                        {{ !empty($penilaian->usia1) ? $penilaian->usia1 : '' }} tahun,
                                                        Status :
                                                        {{ !empty($penilaian->ket1) ? $penilaian->ket1 : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Usia
                                                        Perkawinan
                                                        2 : {{ !empty($penilaian->usia2) ? $penilaian->usia2 : '' }}
                                                        tahun, Status :
                                                        {{ !empty($penilaian->ket2) ? $penilaian->ket2 : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Usia
                                                        Perkawinan
                                                        3 : {{ !empty($penilaian->usia3) ? $penilaian->usia3 : '' }}
                                                        tahun, Status :
                                                        {{ !empty($penilaian->ket3) ? $penilaian->ket3 : '' }}</td>
                                                </tr>
                                                <tr class='isi'>
                                                    <td width='20%'>Riwayat Kehamilan Tetap</td>
                                                    <td width='80%'>HPHT :
                                                        {{ !empty($penilaian->hpht) ? $penilaian->hpht : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Usia
                                                        Kehamilan
                                                        :
                                                        {{ !empty($penilaian->usia_kehamilan) ? $penilaian->usia_kehamilan : '' }}
                                                        bln/mgg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TP :
                                                        {{ !empty($penilaian->tp) ? $penilaian->tp : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Riwayat
                                                        Imunisasi
                                                        :
                                                        {{ !empty($penilaian->imunisasi) ? $penilaian->imunisasi : '' }}({{ !empty($penilaian->ket_imunisasi ? $penilaian->ket_imunisasi : '') }},
                                                        {{ !empty($penilaian->ket_imunisasi) ? $penilaian->ket_imunisasi : '' }}
                                                        kali)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;G :
                                                        {{ !empty($penilaian->g) ? $penilaian->g : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P
                                                        :
                                                        {{ !empty($penilaian->p) ? $penilaian->p : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A
                                                        :
                                                        {{ !empty($penilaian->a) ? $penilaian->a : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hidup
                                                        :
                                                        {{ !empty($penilaian->hidup) ? $penilaian->hidup : '' }}</td>
                                                </tr>
                                            </table>
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr class='isi'>
                                                    <td width='3%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle' rowspan='2'>No</td>
                                                    <td width='8%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle' rowspan='2'>Tgl/Thn
                                                        Persalinan</td>
                                                    <td width='23%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle' rowspan='2'>Tempat
                                                        Persalinan</td>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle' rowspan='2'>Usia Hamil</td>

                                                    <td width='8%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle' rowspan='2'>Jenis
                                                        persalinan</td>
                                                    <td width='16%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle' rowspan='2'>Penolong</td>

                                                    <td width='16%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle' rowspan='2'>Penyulit</td>

                                                    <td bgcolor='#FFFAF8' align='center' valign='middle'
                                                        colspan='3'>Anak</td>
                                                </tr>
                                                <tr class='isi'>
                                                    <td width='3%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle'>JK</td>
                                                    <td width='5%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle'>BB/PB</td>
                                                    <td width='13%' bgcolor='#FFFAF8' align='center'
                                                        valign='middle'>Keadaan</td>
                                                </tr>

                                                @foreach ($penilaian->riwayat_persalinan_pasien as $riwayat)
                                                    <tr>
                                                        <td align='center'>w</td>
                                                        <td align='center'>
                                                            {{ !empty($riwayat->tgl_thn) ? $riwayat->tgl_thn : '' }}</td>
                                                        <td>{{ !empty($riwayat->tempat_persalinan) ? $riwayat->tempat_persalinan : '' }}
                                                        </td>
                                                        <td align='center'>
                                                            {{ !empty($riwayat->usia_hamil) ? $riwayat->usia_hamil : '' }}
                                                        </td>
                                                        <td align='center'>
                                                            {{ !empty($riwayat->jenis_persalinan) ? $riwayat->jenis_persalinan : '' }}
                                                        </td>
                                                        <td>{{ !empty($riwayat->penolong) ? $riwayat->penolong : '' }}
                                                        </td>
                                                        <td>{{ !empty($riwayat->penyulit) ? $riwayat->penyulit : '' }}
                                                        </td>
                                                        <td align='center'>
                                                            {{ !empty($riwayat->jk) ? $riwayat->jk : '' }}</td>
                                                        <td align='center'>
                                                            {{ !empty($riwayat->bbpb) ? $riwayat->bbpb : '' }}</td>
                                                        <td>{{ !empty($riwayat->keadaan) ? $riwayat->keadaan : '' }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr class='isi'>
                                                    <td width='20%'>Riwayat Ginekologi</td>
                                                    <td width='80%'>
                                                        {{ !empty($penilaian->ginekologi) ? $penilaian->ginekologi : '' }}
                                                    </td>
                                                </tr>
                                                <tr class='isi'>
                                                    <td width='20%'>Riwayat Kebiasaan</td>
                                                    <td width='80%'>Obat/Vitamin :
                                                        {{ !empty($penilaian->kebiasaan) ? $penilaian->kebiasaan : '' }}({{ !empty($penilaian->ket_kebiasaan ? $penilaian->ket_kebiasaan : '') }},
                                                        {{ !empty($penilaian->ket_kebiasaan) ? $penilaian->ket_kebiasaan : '' }}).
                                                        Merokok :
                                                        {{ !empty($penilaian->kebiasaan1) ? $penilaian->kebiasaan1 : '' }}({{ !empty($penilaian->ket_kebiasaan1 ? $penilaian->ket_kebiasaan1 : '') }},
                                                        {{ !empty($penilaian->ket_kebiasaan1) ? $penilaian->ket_kebiasaan1 : '' }}
                                                        batang/hari). Alkohol :
                                                        {{ !empty($penilaian->kebiasaan2) ? $penilaian->kebiasaan2 : '' }}({{ !empty($penilaian->ket_kebiasaan2 ? $penilaian->ket_kebiasaan2 : '') }}
                                                        {{ !empty($penilaian->ket_kebiasaan2) ? $penilaian->ket_kebiasaan2 : '' }}
                                                        gelas/hari). Obat Tidur/Narkoba :
                                                        {{ !empty($penilaian->kebiasaan3) ? $penilaian->kebiasaan3 : '' }}
                                                    </td>
                                                </tr>
                                                <tr class='isi'>
                                                    <td width='20%'>Riwayat K.B.</td>
                                                    <td width='80%'>
                                                        {{ !empty($penilaian->kb) ? $penilaian->kb : '' }}, Lamanya :
                                                        {{ !empty($penilaian->ket_kb) ? $penilaian->ket_kb : '' }}.
                                                        Komplikasi
                                                        KB :
                                                        {{ !empty($penilaian->komplikasi) ? $penilaian->komplikasi : '' }}({{ !empty($penilaian->ket_komplikasi ? $penilaian->ket_komplikasi : '') }},
                                                        {{ !empty($penilaian->ket_komplikasi) ? $penilaian->ket_komplikasi : '' }}).
                                                        Berhenti KB :
                                                        {{ !empty($penilaian->berhenti) ? $penilaian->berhenti : '' }},
                                                        Alasan :
                                                        {{ !empty($penilaian->alasan) ? $penilaian->alasan : '' }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            IV. FUNGSIONAL
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='33%' border='1'>Alat Bantu :
                                                        {{ !empty($penilaian->alat_bantu) ? $penilaian->alat_bantu : '' }}({{ !empty($penilaian->ket_bantu ? $penilaian->ket_bantu : '') }},
                                                        {{ !empty($penilaian->ket_bantu) ? $penilaian->ket_bantu : '' }})
                                                    </td>
                                                    <td width='33%' border='1'>Prothesa :
                                                        {{ !empty($penilaian->prothesa) ? $penilaian->prothesa : '' }}({{ !empty($penilaian->ket_pro ? $penilaian->ket_pro : '') }},
                                                        {{ !empty($penilaian->ket_pro) ? $penilaian->ket_pro : '' }})</td>
                                                    <td width='33%' border='1'>Aktivitas Sehari-hari ( ADL ) :
                                                        {{ !empty($penilaian->adl) ? $penilaian->adl : '' }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            V. RIWAYAT PSIKO-SOSIAL, SPIRITUAL DAN BUDAYA
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='50%' border='1'>Status Psikologis</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->status_psiko) ? $penilaian->status_psiko : '' }}({{ !empty($penilaian->ket_psiko ? $penilaian->ket_psiko : '') }},
                                                        {{ !empty($penilaian->ket_psiko) ? $penilaian->ket_psiko : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td border='1' colspan='2'>Status Sosial dan ekonomi :</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;a.
                                                        Hubungan pasien dengan anggota
                                                        keluarga</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->hub_keluarga) ? $penilaian->hub_keluarga : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;b. Tinggal
                                                        dengan</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->tinggal_dengan) ? $penilaian->tinggal_dengan : '' }}({{ !empty($penilaian->ket_tinggal ? $penilaian->ket_tinggal : '') }},
                                                        {{ !empty($penilaian->ket_tinggal) ? $penilaian->ket_tinggal : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;c. Ekonomi
                                                    </td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->ekonomi) ? $penilaian->ekonomi : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Kepercayaan / Budaya / Nilai-nilai
                                                        khusus yang perlu
                                                        diperhatikan</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->budaya) ? $penilaian->budaya : '' }}({{ !empty($penilaian->ket_budaya ? $penilaian->ket_budaya : '') }},
                                                        {{ !empty($penilaian->ket_budaya) ? $penilaian->ket_budaya : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Edukasi diberikan kepada</td>
                                                    <td width='50%' border='1'>:
                                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}({{ !empty($penilaian->ket_edukasi ? $penilaian->ket_edukasi : '') }},
                                                        {{ !empty($penilaian->ket_edukasi) ? $penilaian->ket_edukasi : '' }})
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VI. PENILAIAN RESIKO JATUH
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td colpsan='2' border='1'>a. Cara Berjalan :</td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;1. Tidak
                                                        seimbang / sempoyongan /
                                                        limbung</td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_a) ? $penilaian->berjalan_a : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;2. Jalan
                                                        dengan menggunakan alat bantu
                                                        (kruk, tripot, kursi roda, orang lain)
                                                    </td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_b) ? $penilaian->berjalan_b : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='75%' border='1'>b. Menopang saat akan duduk,
                                                        tampak memegang pinggiran kursi
                                                        atau meja / benda lain sebagai penopang</td>
                                                    <td width='25%' border='1'>:
                                                        {{ !empty($penilaian->berjalan_c) ? $penilaian->berjalan_c : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2' border='1'>Hasil :
                                                        {{ !empty($penilaian->hasil) ? $penilaian->hasil : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dilaporkan
                                                        kepada dokter ?
                                                        {{ !empty($penilaian->lapor) ? $penilaian->lapor : '' }}({{ !empty($penilaian->ket_lapor ? $penilaian->ket_lapor : '') }}
                                                        Jam
                                                        dilaporkan :
                                                        {{ !empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : '' }})
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VII. SKRINING GIZI
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td valign='middle' bgcolor='#FFFAF8' align='center'
                                                        width='5%'>No</td>
                                                    <td valign='middle' bgcolor='#FFFAF8' align='center'
                                                        width='70%'>Parameter</td>
                                                    <td valign='middle' bgcolor='#FFFAF8' align='center'
                                                        width='25%' colspan='2'>Nilai</td>
                                                </tr>
                                                <tr>
                                                    <td valign='top'>1</td>
                                                    <td valign='top'>Apakah ada penurunan berat badanyang tidak
                                                        diinginkan selama enam bulan
                                                        terakhir ?</td>
                                                    <td valign='top' align='center' width='20%'>
                                                        {{ !empty($penilaian->sg1) ? $penilaian->sg1 : '' }}</td>
                                                    <td valign='top' align='right' width='5%'>
                                                        {{ !empty($penilaian->nilai1) ? $penilaian->nilai1 : '' }}&nbsp;&nbsp;
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign='top'>2</td>
                                                    <td valign='top'>Apakah nafsu makan berkurang karena tidak nafsu
                                                        makan ?</td>
                                                    <td valign='top' align='center' width='20%'>
                                                        {{ !empty($penilaian->sg2) ? $penilaian->sg2 : '' }}</td>
                                                    <td valign='top' align='right' width='5%'>
                                                        {{ !empty($penilaian->nilai2) ? $penilaian->nilai2 : '' }}&nbsp;&nbsp;
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign='top' align='right' colspan='2'>Total Skor</td>
                                                    <td valign='top' align='right' colspan='2'>
                                                        {{ !empty($penilaian->total_hasil) ? $penilaian->total_hasil : '' }}&nbsp;&nbsp;
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VIII. PENILAIAN TINGKAT NYERI
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='50%' border='1'>Tingkat Nyeri :
                                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}, Waktu /
                                                        Durasi :
                                                        {{ !empty($penilaian->durasi) ? $penilaian->durasi : '' }} Menit
                                                    </td>
                                                    <td width='50%' border='1'>Penyebab :
                                                        {{ !empty($penilaian->provokes) ? $penilaian->provokes : '' }}({{ !empty($penilaian->ket_provokes ? $penilaian->ket_provokes : '') }},
                                                        {{ !empty($penilaian->ket_provokes) ? $penilaian->ket_provokes : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Kualitas :
                                                        {{ !empty($penilaian->quality) ? $penilaian->quality : '' }}({{ !empty($penilaian->ket_quality ? $penilaian->ket_quality : '') }},
                                                        {{ !empty($penilaian->ket_quality) ? $penilaian->ket_quality : '' }})
                                                    </td>
                                                    <td width='50%' border='1'>Severity : Skala Nyeri
                                                        {{ !empty($penilaian->skala_nyeri) ? $penilaian->skala_nyeri : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='0' border='1'>Wilayah :</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;Lokasi :
                                                        {{ !empty($penilaian->lokasi) ? $penilaian->lokasi : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Menyebar :
                                                        {{ !empty($penilaian->menyebar) ? $penilaian->menyebar : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Nyeri hilang bila :
                                                        {{ !empty($penilaian->nyeri_hilang) ? $penilaian->nyeri_hilang : '' }}({{ !empty($penilaian->ket_nyeri ? $penilaian->ket_nyeri : '') }},
                                                        {{ !empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : '' }})
                                                    </td>
                                                    <td width='50%' border='1'>Diberitahukan pada dokter ?
                                                        {{ !empty($penilaian->pada_dokter) ? $penilaian->pada_dokter : '' }}({{ !empty($penilaian->ket_dokter ? $penilaian->ket_dokter : '') }},
                                                        Jam :
                                                        {{ !empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : '' }})
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td valign='middle' bgcolor='#FFFAF8' align='center'
                                                        width='50%'>MASALAH KEBIDANAN :</td>
                                                    <td valign='middle' bgcolor='#FFFAF8' align='center'
                                                        width='50%'>TINDAKAN :</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ !empty($penilaian->masalah) ? $penilaian->masalah : '' }}</td>
                                                    <td>{{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </td>
                    </tr>
                @endif

                <!-- Penilaian Keperawatan Rawat Inap Kandungan  -->
                @if (!empty($rawat->penilaian_keperawatan_ranap_kandungan) and
                    count($rawat->penilaian_keperawatan_ranap_kandungan) > 0)
                    <tr class='isi'>
                        <td valign='top' width='2%'></td>
                        <td valign='top' width='18%'>Penilaian Awal Keperawatan Rawat Inap Kandungan</td>
                        <td valign='top' width='1%' align='center'>:</td>
                        <td valign='top' width='79%'>
                            <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form'>
                                @foreach ($rawat->penilaian_keperawatan_ranap_kandungan as $penilaian)
                                    <tr>
                                        <td valign='top'>
                                            YANG MELAKUKAN PENGKAJIAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='16%' border='1' align='left'>Tanggal</td>
                                                    <td width='35%' border='1'>:
                                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                                    <td width='11%' border='1' align='left'>Anamnesis</td>
                                                    <td width='38%' border='1'>:
                                                        {{ !empty($penilaian->informasi) ? $penilaian->informasi : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='16%' border='1' align='left'>Tiba di Ruang
                                                        Rawat</td>
                                                    <td width='35%' border='1'>:
                                                        {{ !empty($penilaian->tiba_diruang_rawat) ? $penilaian->tiba_diruang_rawat : '' }}
                                                    </td>
                                                    <td width='11%' border='1' align='left'>Cara Masuk</td>
                                                    <td width='38%' border='1'>:
                                                        {{ !empty($penilaian->cara_masuk) ? $penilaian->cara_masuk : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='16%' border='1' align='left'>Pengkaji 1</td>
                                                    <td width='35%' border='1'>:
                                                        {{ !empty($penilaian->nip1) ? $penilaian->nip1 : '' }}
                                                        {{ !empty($penilaian->pengkaji1) ? $penilaian->pengkaji1 : '' }}
                                                    </td>

                                                    <td width='11%' border='1' align='left'>Pengkaji 2</td>
                                                    <td width='38%' border='1'>:
                                                        {{ !empty($penilaian->nip2) ? $penilaian->nip2 : '' }}
                                                        {{ !empty($penilaian->pengkaji2) ? $penilaian->pengkaji2 : '' }}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td width='16%' border='1' align='left'>DPJP</td>
                                                    <td width='35%' border='1' colspan='3'>:
                                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            I. RIWAYAT KESEHATAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='50%'>Keluhan Utama :
                                                        {{ !empty($penilaian->keluhan) ? $penilaian->keluhan : '' }}</td>
                                                    <td width='50%'>Penyakit Selama Kehamilan :
                                                        {{ !empty($penilaian->psk) ? $penilaian->psk : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%'>Riwayat Penyakit Keluarga :
                                                        {{ !empty($penilaian->rpk) ? $penilaian->rpk : '' }}</td>
                                                    <td width='50%'>Riwayat Pembedahan :
                                                        {{ !empty($penilaian->rp) ? $penilaian->rp : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%'>Riwayat Alergi :
                                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                                    <td width='50%'>Komplikasi Kehamilan Sebelumnya :
                                                        {{ !empty($penilaian->komplikasi_sebelumnya) ? $penilaian->komplikasi_sebelumnya : '' }}({{ !empty($penilaian->keterangan_komplikasi_sebelumnya) ? $penilaian->keterangan_komplikasi_sebelumnya : '' }},
                                                        {{ !empty($penilaian->keterangan_komplikasi_sebelumnya) ? $penilaian->keterangan_komplikasi_sebelumnya : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2'>
                                                        Riwayat Menstruasi :
                                                        <table width='99%' border='1' align='right'
                                                            cellspacing='0px' class='tbl_form'>
                                                            <tr>
                                                                <td width='14%' border='1' align='left'>Umur
                                                                    Menarche</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_mens_umur) ? $penilaian->riwayat_mens_umur : '' }}
                                                                    tahun</td>

                                                                <td width='20%' border='1' align='left'>
                                                                    Lamanya</td>
                                                                <td width='21%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_mens_lamanya) ? $penilaian->riwayat_mens_lamanya : '' }}
                                                                    hari
                                                                </td>
                                                                <td width='10%' border='1' align='left'>
                                                                    Banyaknya</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_mens_banyaknya) ? $penilaian->riwayat_mens_banyaknya : '' }}
                                                                    pembalut</td>
                                                            </tr>
                                                            <tr>
                                                                <td width='14%' border='1' align='left'>
                                                                    Siklus</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_mens_siklus) ? $penilaian->riwayat_mens_siklus : '' }}hari,
                                                                    ({{ !empty($penilaian->riwayat_mens_ket_siklus) ? $penilaian->riwayat_mens_ket_siklus : '' }})
                                                                </td>
                                                                <td width='20%' border='1' align='left'>
                                                                    Dirasakan Saat Menstruasi</td>
                                                                <td border='1' colspan='3'>:
                                                                    {{ !empty($penilaian->riwayat_mens_dirasakan) ? $penilaian->riwayat_mens_dirasakan : '' }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2'>
                                                        Riwayat Perkawinan :
                                                        <table width='99%' border='1' align='right'
                                                            cellspacing='0px' class='tbl_form'>
                                                            <tr>
                                                                <td width='18%' border='1' align='left'>
                                                                    Status Menikah</td>
                                                                <td width='32%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_perkawinan_status) ? $penilaian->riwayat_perkawinan_status : '' }},
                                                                    {{ !empty($penilaian->riwayat_perkawinan_ket_status) ? $penilaian->riwayat_perkawinan_ket_status : '' }}
                                                                    kali</td>
                                                                <td width='18%' border='1' align='left'>Usia
                                                                    Perkawinan Ke 1</td>
                                                                <td width='32%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_perkawinan_usia1) ? $penilaian->riwayat_perkawinan_usia1 : '' }}
                                                                    tahun, Status :
                                                                    {{ !empty($penilaian->riwayat_perkawinan_ket_usia1) ? $penilaian->riwayat_perkawinan_ket_usia1 : '' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width='18%' border='1' align='left'>Usia
                                                                    Perkawinan Ke 2</td>
                                                                <td width='32%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_perkawinan_usia2) ? $penilaian->riwayat_perkawinan_usia2 : '' }}
                                                                    tahun, Status :
                                                                    {{ !empty($penilaian->riwayat_perkawinan_ket_usia2) ? $penilaian->riwayat_perkawinan_ket_usia2 : '' }}
                                                                </td>
                                                                <td width='18%' border='1' align='left'>Usia
                                                                    Perkawinan Ke 3</td>
                                                                <td width='32%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_perkawinan_usia3) ? $penilaian->riwayat_perkawinan_usia3 : '' }}
                                                                    tahun, Status :
                                                                    {{ !empty($penilaian->riwayat_perkawinan_ket_usia3) ? $penilaian->riwayat_perkawinan_ket_usia3 : '' }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2'>
                                                        Riwayat Persalinan & Nifas :
                                                        <table width='99%' border='1' align='right'
                                                            cellspacing='0px' class='tbl_form'>
                                                            <tr class='isi'>
                                                                <td width='100%' colspan='10' border='1'>G :
                                                                    {{ !empty($penilaian->riwayat_persalinan_g) ? $penilaian->riwayat_persalinan_g : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P
                                                                    :
                                                                    {{ !empty($penilaian->riwayat_persalinan_p) ? $penilaian->riwayat_persalinan_p : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A
                                                                    :
                                                                    {{ !empty($penilaian->riwayat_persalinan_a) ? $penilaian->riwayat_persalinan_a : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anak
                                                                    Yang Hidup :
                                                                    {{ !empty($penilaian->riwayat_persalinan_hidup) ? $penilaian->riwayat_persalinan_hidup : '' }}
                                                                </td>
                                                            </tr>
                                                            <tr class='isi'>
                                                                <td width='3%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle' rowspan='2'>No
                                                                </td>
                                                                <td width='8%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle' rowspan='2'>
                                                                    Tgl/Thn Persalinan</td>
                                                                <td width='23%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle' rowspan='2'>
                                                                    Tempat Persalinan</td>
                                                                <td width='5%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle' rowspan='2'>
                                                                    Usia Hamil</td>
                                                                <td width='8%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle' rowspan='2'>
                                                                    Jenis persalinan</td>
                                                                <td width='16%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle' rowspan='2'>
                                                                    Penolong</td>
                                                                <td width='16%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle' rowspan='2'>
                                                                    Penyulit</td>
                                                                <td bgcolor='#FFFAF8' align='center' valign='middle'
                                                                    colspan='3'>Anak</td>
                                                            </tr>
                                                            <tr class='isi'>
                                                                <td width='3%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle'>JK</td>
                                                                <td width='5%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle'>BB/PB</td>
                                                                <td width='13%' bgcolor='#FFFAF8' align='center'
                                                                    valign='middle'>Keadaan</td>
                                                            </tr>
                                                            @foreach ($penilaian->riwayat_persalinan_pasien as $riwayat)
                                                                <tr>
                                                                    <td align='center'>w</td>
                                                                    <td align='center'>
                                                                        {{ !empty($riwayat->tgl_thn) ? $riwayat->tgl_thn : '' }}
                                                                    </td>
                                                                    <td>{{ !empty($riwayat->tempat_persalinan) ? $riwayat->tempat_persalinan : '' }}
                                                                    </td>
                                                                    <td align='center'>
                                                                        {{ !empty($riwayat->usia_hamil) ? $riwayat->usia_hamil : '' }}
                                                                    </td>
                                                                    <td align='center'>
                                                                        {{ !empty($riwayat->jenis_persalinan) ? $riwayat->jenis_persalinan : '' }}
                                                                    </td>
                                                                    <td>{{ !empty($riwayat->penolong) ? $riwayat->penolong : '' }}
                                                                    </td>
                                                                    <td>{{ !empty($riwayat->penyulit) ? $riwayat->penyulit : '' }}
                                                                    </td>
                                                                    <td align='center'>
                                                                        {{ !empty($riwayat->jk) ? $riwayat->jk : '' }}
                                                                    </td>
                                                                    <td align='center'>
                                                                        {{ !empty($riwayat->bbpb) ? $riwayat->bbpb : '' }}
                                                                    </td>
                                                                    <td>{{ !empty($riwayat->keadaan) ? $riwayat->keadaan : '' }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2'>
                                                        Riwayat Hamil Sekarang :
                                                        <table width='99%' border='1' align='right'
                                                            cellspacing='0px' class='tbl_form'>
                                                            <tr>
                                                                <td width='16%' border='1' align='left'>HPHT
                                                                </td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_hamil_hpht) ? $penilaian->riwayat_hamil_hpht : '' }}
                                                                </td>
                                                                <td width='16%' border='1' align='left'>Usia
                                                                    Hamil</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_hamil_usiahamil) ? $penilaian->riwayat_hamil_usiahamil : '' }}
                                                                </td>

                                                                <td width='16%' border='1' align='left'>
                                                                    Tanggal Perkiraan</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_hamil_tp) ? $penilaian->riwayat_hamil_tp : '' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width='16%' border='1' align='left'>
                                                                    Riwayat Imunisasi</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_hamil_imunisasi) ? $penilaian->riwayat_hamil_imunisasi : '' }}
                                                                </td>

                                                                <td width='16%' border='1' align='left'>ANC
                                                                </td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_hamil_anc) ? $penilaian->riwayat_hamil_anc : '' }}
                                                                    X</td>
                                                                <td width='16%' border='1' align='left'>ANC
                                                                    Ke</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_hamil_ancke) ? $penilaian->riwayat_hamil_ancke : '' }}
                                                                    {{ !empty($penilaian->riwayat_hamil_ket_ancke) ? $penilaian->riwayat_hamil_ket_ancke : '' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width='16%' border='1' align='left'>
                                                                    Keluhan Hamil Muda</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_hamil_keluhan_hamil_muda) ? $penilaian->riwayat_hamil_keluhan_hamil_muda : '' }}
                                                                </td>
                                                                <td width='16%' border='1' align='left'>
                                                                    Keluhan Hamil Tua</td>
                                                                <td border='1' colspan='3'>:
                                                                    {{ !empty($penilaian->riwayat_hamil_keluhan_hamil_tua) ? $penilaian->riwayat_hamil_keluhan_hamil_tua : '' }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2'>
                                                        Riwayat Keluarga Berencana :
                                                        <table width='99%' border='1' align='right'
                                                            cellspacing='0px' class='tbl_form'>
                                                            <tr>
                                                                <td width='16%' border='1' align='left'>
                                                                    Status</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_kb) ? $penilaian->riwayat_kb : '' }}
                                                                </td>
                                                                <td width='10%' border='1' align='left'>
                                                                    Lamanya</td>
                                                                <td width='20%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_kb_lamanya) ? $penilaian->riwayat_kb_lamanya : '' }}
                                                                </td>
                                                                <td width='10%' border='1' align='left'>
                                                                    Komplikasi</td>
                                                                <td width='26%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_kb_komplikasi) ? $penilaian->riwayat_kb_komplikasi : '' }}({{ !empty($penilaian->riwayat_kb_ket_komplikasi) ? $penilaian->riwayat_kb_ket_komplikasi : '' }},
                                                                    {{ !empty($penilaian->riwayat_kb_ket_komplikasi) ? $penilaian->riwayat_kb_ket_komplikasi : '' }})
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width='16%' border='1' align='left'>Kapan
                                                                    Berhenti KB</td>
                                                                <td width='17%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_kb_kapaberhenti) ? $penilaian->riwayat_kb_kapaberhenti : '' }}
                                                                </td>

                                                                <td width='10%' border='1' align='left'>
                                                                    Alasan</td>
                                                                <td colspan='3' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_kb_alasanberhenti) ? $penilaian->riwayat_kb_alasanberhenti : '' }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2'>
                                                        Riwayat Ginekologi :
                                                        {{ !empty($penilaian->riwayat_genekologi) ? $penilaian->riwayat_genekologi : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2'>
                                                        Riwayat Kebiasaan :
                                                        <table width='99%' border='1' align='right'
                                                            cellspacing='0px' class='tbl_form'>
                                                            <tr>
                                                                <td width='15%' border='1' align='left'>
                                                                    Obat/Vitamin</td>
                                                                <td width='35%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_kebiasaan_obat) ? $penilaian->riwayat_kebiasaan_obat : '' }}({{ !empty($penilaian->riwayat_kebiasaan_ket_obat) ? $penilaian->riwayat_kebiasaan_ket_obat : '' }},
                                                                    {{ !empty($penilaian->riwayat_kebiasaan_ket_obat) ? $penilaian->riwayat_kebiasaan_ket_obat : '' }})
                                                                </td>
                                                                <td width='20%' border='1' align='left'>
                                                                    Merokok</td>
                                                                <td width='30%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_kebiasaan_merokok) ? $penilaian->riwayat_kebiasaan_merokok : '' }}({{ !empty($penilaian->riwayat_kebiasaan_ket_merokok) ? $penilaian->riwayat_kebiasaan_ket_merokok : '' }},
                                                                    {{ !empty($penilaian->riwayat_kebiasaan_ket_merokok) ? $penilaian->riwayat_kebiasaan_ket_merokok : '' }}
                                                                    batang/hari)</td>
                                                            </tr>
                                                            <tr>
                                                                <td width='15%' border='1' align='left'>
                                                                    Alkohol</td>
                                                                <td width='35%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_kebiasaan_alkohol) ? $penilaian->riwayat_kebiasaan_alkohol : '' }}({{ !empty($penilaian->riwayat_kebiasaan_ket_alkohol) ? $penilaian->riwayat_kebiasaan_ket_alkohol : '' }},
                                                                    {{ !empty($penilaian->riwayat_kebiasaan_ket_alkohol) ? $penilaian->riwayat_kebiasaan_ket_alkohol : '' }})
                                                                    gelas/hari</td>
                                                                <td width='20%' border='1' align='left'>Obat
                                                                    Tidur/Narkoba</td>
                                                                <td width='30%' border='1'>:
                                                                    {{ !empty($penilaian->riwayat_kebiasaan_narkoba) ? $penilaian->riwayat_kebiasaan_narkoba : '' }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            II. PEMERIKSAAN KEBIDANAN
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='25%' border='1'>Kesadaran Mental :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_mental) ? $penilaian->pemeriksaan_kebidanan_mental : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Keadaan Umum :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_keadaan_umum) ? $penilaian->pemeriksaan_kebidanan_keadaan_umum : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>GCS(E,V,M) :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_gcs) ? $penilaian->pemeriksaan_kebidanan_gcs : '' }}
                                                    </td>

                                                    <td width='25%' border='1'>TD :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_td) ? $penilaian->pemeriksaan_kebidanan_td : '' }}
                                                        mmHg</td>
                                                </tr>
                                                <tr>
                                                    <td width='25%' border='1'>Nadi :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_nadi) ? $penilaian->pemeriksaan_kebidanan_nadi : '' }}
                                                        x/menit
                                                    </td>
                                                    <td width='25%' border='1'>RR :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_rr) ? $penilaian->pemeriksaan_kebidanan_rr : '' }}
                                                        x/menit</td>

                                                    <td width='25%' border='1'>Suhu :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_suhu) ? $penilaian->pemeriksaan_kebidanan_suhu : '' }}
                                                        °C</td>
                                                    <td width='25%' border='1'>SpO2 :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_spo2) ? $penilaian->pemeriksaan_kebidanan_spo2 : '' }}
                                                        %</td>
                                                </tr>
                                                <tr>
                                                    <td width='25%' border='1'>BB :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_bb) ? $penilaian->pemeriksaan_kebidanan_bb : '' }}
                                                        Kg</td>
                                                    <td width='25%' border='1'>TB :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_tb) ? $penilaian->pemeriksaan_kebidanan_tb : '' }}
                                                        cm</td>
                                                    <td width='25%' border='1'>LILA :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_lila) ? $penilaian->pemeriksaan_kebidanan_lila : '' }}
                                                        cm</td>
                                                    <td width='25%' border='1'>TFU :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_tfu) ? $penilaian->pemeriksaan_kebidanan_tfu : '' }}
                                                        cm</td>
                                                </tr>
                                                <tr>
                                                    <td width='25%' border='1'>TBJ :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_tbj) ? $penilaian->pemeriksaan_kebidanan_tbj : '' }}
                                                        gr</td>
                                                    <td width='25%' border='1'>Letak :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_letak) ? $penilaian->pemeriksaan_kebidanan_letak : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Presentasi :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_presentasi) ? $penilaian->pemeriksaan_kebidanan_presentasi : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Penurunan :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_penurunan) ? $penilaian->pemeriksaan_kebidanan_penurunan : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='25%' border='1'>Kontraksi/HIS :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_his) ? $penilaian->pemeriksaan_kebidanan_his : '' }}
                                                        x/10’, Kekuatan :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_kekuatan) ? $penilaian->pemeriksaan_kebidanan_kekuatan : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Lamanya :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_lamanya) ? $penilaian->pemeriksaan_kebidanan_lamanya : '' }}
                                                        detik</td>
                                                    <td width='25%' border='1'>DJJ
                                                        :{{ !empty($penilaian->pemeriksaan_kebidanan_djj) ? $penilaian->pemeriksaan_kebidanan_djj : '' }}/mnt
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_ket_djj) ? $penilaian->pemeriksaan_kebidanan_ket_djj : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Portio :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_portio) ? $penilaian->pemeriksaan_kebidanan_portio : '' }}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td width='25%' border='1'>Pembukaan Serviks :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_pembukaan) ? $penilaian->pemeriksaan_kebidanan_pembukaan : '' }}
                                                        cm</td>
                                                    <td width='25%' border='1'>Ketuban :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_ketuban) ? $penilaian->pemeriksaan_kebidanan_ketuban : '' }}
                                                        kep/bok</td>
                                                    <td width='25%' border='1'>Hodge :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_hodge) ? $penilaian->pemeriksaan_kebidanan_hodge : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Panggul :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_panggul) ? $penilaian->pemeriksaan_kebidanan_panggul : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='25%' border='1'>Inspekulo :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_inspekulo) ? $penilaian->pemeriksaan_kebidanan_inspekulo : '' }}({{ !empty($penilaian->pemeriksaan_kebidanan_ket_inspekulo)
                                                            ? $penilaian->pemeriksaan_kebidanan_ket_inspekulo
                                                            : '' }},
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_ket_inspekulo) ? $penilaian->pemeriksaan_kebidanan_ket_inspekulo : '' }})
                                                    </td>
                                                    <td width='25%' border='1'>Lakmus :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_lakmus) ? $penilaian->pemeriksaan_kebidanan_lakmus : '' }}({{ !empty($penilaian->pemeriksaan_kebidanan_ket_lakmus) ? $penilaian->pemeriksaan_kebidanan_ket_lakmus : '' }},
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_ket_lakmus) ? $penilaian->pemeriksaan_kebidanan_ket_lakmus : '' }})
                                                    </td>
                                                    <td width='25%' border='1' colspan='2'>CTG :
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_ctg) ? $penilaian->pemeriksaan_kebidanan_ctg : '' }}({{ !empty($penilaian->pemeriksaan_kebidanan_ket_ctg) ? $penilaian->pemeriksaan_kebidanan_ket_ctg : '' }},
                                                        {{ !empty($penilaian->pemeriksaan_kebidanan_ket_ctg) ? $penilaian->pemeriksaan_kebidanan_ket_ctg : '' }})
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            III. PEMERIKSAAN UMUM
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='25%' border='1'>Kepala :
                                                        {{ !empty($penilaian->pemeriksaan_umum_kepala) ? $penilaian->pemeriksaan_umum_kepala : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Muka :
                                                        {{ !empty($penilaian->pemeriksaan_umum_muka) ? $penilaian->pemeriksaan_umum_muka : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Mata :
                                                        {{ !empty($penilaian->pemeriksaan_umum_mata) ? $penilaian->pemeriksaan_umum_mata : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Hidung :
                                                        {{ !empty($penilaian->pemeriksaan_umum_hidung) ? $penilaian->pemeriksaan_umum_hidung : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='25%' border='1'>Telinga :
                                                        {{ !empty($penilaian->pemeriksaan_umum_telinga) ? $penilaian->pemeriksaan_umum_telinga : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Mulut :
                                                        {{ !empty($penilaian->pemeriksaan_umum_mulut) ? $penilaian->pemeriksaan_umum_mulut : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Leher :
                                                        {{ !empty($penilaian->pemeriksaan_umum_leher) ? $penilaian->pemeriksaan_umum_leher : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Dada :
                                                        {{ !empty($penilaian->pemeriksaan_umum_dada) ? $penilaian->pemeriksaan_umum_dada : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='25%' border='1'>Perut :
                                                        {{ !empty($penilaian->pemeriksaan_umum_perut) ? $penilaian->pemeriksaan_umum_perut : '' }}
                                                    </td>
                                                    <td width='25%' border='1'>Genitalia :
                                                        {{ !empty($penilaian->pemeriksaan_umum_genitalia) ? $penilaian->pemeriksaan_umum_genitalia : '' }}
                                                    </td>

                                                    <td width='50%' border='1' colspan='2'>Ekstremitas :
                                                        {{ !empty($penilaian->pemeriksaan_umum_ekstrimitas) ? $penilaian->pemeriksaan_umum_ekstrimitas : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            IV. PENGKAJIAN FUNGSI
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='37%' border='1'>a. Kemampuan Aktifitas Sehari-hari
                                                    </td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='62%' border='1'>
                                                        {{ !empty($penilaian->pengkajian_fungsi_kemampuan_aktifitas) ? $penilaian->pengkajian_fungsi_kemampuan_aktifitas : '' }}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td width='37%' border='1'>b. Berjalan</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='62%' border='1'>
                                                        {{ !empty($penilaian->pengkajian_fungsi_berjalan) ? $penilaian->pengkajian_fungsi_berjalan : '' }}({{ !empty($penilaian->pengkajian_fungsi_ket_berjalan) ? $penilaian->pengkajian_fungsi_ket_berjalan : '' }},
                                                        {{ !empty($penilaian->pengkajian_fungsi_ket_berjalan) ? $penilaian->pengkajian_fungsi_ket_berjalan : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='37%' border='1'>c. Aktifitas</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='62%' border='1'>
                                                        {{ !empty($penilaian->pengkajian_fungsi_aktivitas) ? $penilaian->pengkajian_fungsi_aktivitas : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='37%' border='1'>d. Alat Ambulasi</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='62%' border='1'>
                                                        {{ !empty($penilaian->pengkajian_fungsi_ambulasi) ? $penilaian->pengkajian_fungsi_ambulasi : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='37%' border='1'>e. Ekstremitas Atas</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='62%' border='1'>
                                                        {{ !empty($penilaian->pengkajian_fungsi_ekstrimitas_atas) ? $penilaian->pengkajian_fungsi_ekstrimitas_atas : '' }}({{ !empty($penilaian->pengkajian_fungsi_ket_ekstrimitas_atas)
                                                            ? $penilaian->pengkajian_fungsi_ket_ekstrimitas_atas
                                                            : '' }},
                                                        {{ !empty($penilaian->pengkajian_fungsi_ket_ekstrimitas_atas) ? $penilaian->pengkajian_fungsi_ket_ekstrimitas_atas : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='37%' border='1'>f. Ekstremitas Bawah</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='62%' border='1'>
                                                        {{ !empty($penilaian->pengkajian_fungsi_ekstrimitas_bawah) ? $penilaian->pengkajian_fungsi_ekstrimitas_bawah : '' }}({{ !empty($penilaian->pengkajian_fungsi_ket_ekstrimitas_bawah)
                                                            ? $penilaian->pengkajian_fungsi_ket_ekstrimitas_bawah
                                                            : '' }},
                                                        {{ !empty($penilaian->pengkajian_fungsi_ket_ekstrimitas_bawah) ? $penilaian->pengkajian_fungsi_ket_ekstrimitas_bawah : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='37%' border='1'>g. Kemampuan Menggenggam</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='62%' border='1'>
                                                        {{ !empty($penilaian->pengkajian_fungsi_kemampuan_menggenggam) ? $penilaian->pengkajian_fungsi_kemampuan_menggenggam : '' }}({{ !empty($penilaian->pengkajian_fungsi_ket_kemampuan_menggenggam)
                                                            ? $penilaian->pengkajian_fungsi_ket_kemampuan_menggenggam
                                                            : '' }},
                                                        {{ !empty($penilaian->pengkajian_fungsi_ket_kemampuan_menggenggam) ? $penilaian->pengkajian_fungsi_ket_kemampuan_menggenggam : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='37%' border='1'>h. Kemampuan Koordinasi</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='62%' border='1'>
                                                        {{ !empty($penilaian->pengkajian_fungsi_koordinasi) ? $penilaian->pengkajian_fungsi_koordinasi : '' }}({{ !empty($penilaian->pengkajian_fungsi_ket_koordinasi) ? $penilaian->pengkajian_fungsi_ket_koordinasi : '' }},
                                                        {{ !empty($penilaian->pengkajian_fungsi_ket_koordinasi) ? $penilaian->pengkajian_fungsi_ket_koordinasi : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='37%' border='1'>i. Kesimpulan Gangguan Fungsi</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='62%' border='1'>
                                                        {{ !empty($penilaian->pengkajian_fungsi_gangguan_fungsi) ? $penilaian->pengkajian_fungsi_gangguan_fungsi : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            V. RIWAYAT PSIKOLOGIS – SOSIAL – EKONOMI – BUDAYA – SPIRITUAL
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='49%' border='1'>a. Kondisi Psikologis</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($penilaian->riwayat_psiko_kondisipsiko) ? $penilaian->riwayat_psiko_kondisipsiko : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>b. Adakah Perilaku</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($penilaian->riwayat_psiko_adakah_prilaku) ? $penilaian->riwayat_psiko_adakah_prilaku : '' }}({{ !empty($penilaian->riwayat_psiko_ket_adakah_prilaku) ? $penilaian->riwayat_psiko_ket_adakah_prilaku : '' }},
                                                        {{ !empty($penilaian->riwayat_psiko_ket_adakah_prilaku) ? $penilaian->riwayat_psiko_ket_adakah_prilaku : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>c. Gangguan Jiwa di Masa Lalu</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($penilaian->riwayat_psiko_gangguan_jiwa) ? $penilaian->riwayat_psiko_gangguan_jiwa : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>d. Hubungan Pasien dengan Anggota
                                                        Keluarga</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($penilaian->riwayat_psiko_hubungan_pasien) ? $penilaian->riwayat_psiko_hubungan_pasien : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>e. Agama</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($dataPasien->Agama) ? $dataPasien->Agama : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>f. Tinggal Dengan</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($penilaian->riwayat_psiko_tinggal_dengan) ? $penilaian->riwayat_psiko_tinggal_dengan : '' }}({{ !empty($penilaian->riwayat_psiko_ket_tinggal_dengan) ? $penilaian->riwayat_psiko_ket_tinggal_dengan : '' }},
                                                        {{ !empty($penilaian->riwayat_psiko_ket_tinggal_dengan) ? $penilaian->riwayat_psiko_ket_tinggal_dengan : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>g. Pekerjaan</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($dataPasien->Pekerjaan) ? $dataPasien->Pekerjaan : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>h. Pembayaran</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($rawat->png_jawab) ? $rawat->png_jawab : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>i. Nilai-nilai Kepercayaan/Budaya
                                                        Yang Perlu Diperhatikan</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($penilaian->riwayat_psiko_budaya) ? $penilaian->riwayat_psiko_budaya : '' }}({{ !empty($penilaian->riwayat_psiko_ket_budaya) ? $penilaian->riwayat_psiko_ket_budaya : '' }},
                                                        {{ !empty($penilaian->riwayat_psiko_ket_budaya) ? $penilaian->riwayat_psiko_ket_budaya : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>j. Bahasa Sehari-hari</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($dataPasien->Bahasa) ? $dataPasien->Bahasa : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>k. Pendidikan Pasien</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($dataPasien->Pendidikan) ? $dataPasien->Pendidikan : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>l. Pendidikan P.J.</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($penilaian->riwayat_psiko_pend_pj) ? $penilaian->riwayat_psiko_pend_pj : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='49%' border='1'>m. Edukasi Diberikan Kepada</td>
                                                    <td width='1%' border='1'>:</td>
                                                    <td width='50%' border='1'>
                                                        {{ !empty($penilaian->riwayat_psiko_edukasi_pada) ? $penilaian->riwayat_psiko_edukasi_pada : '' }}({{ !empty($penilaian->riwayat_psiko_ket_edukasi_pada) ? $penilaian->riwayat_psiko_ket_edukasi_pada : '' }},
                                                        {{ !empty($penilaian->riwayat_psiko_ket_edukasi_pada) ? $penilaian->riwayat_psiko_ket_edukasi_pada : '' }})
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VI. PENILAIAN TINGKAT NYERI
                                            <table width='100%' border='1' align='center' cellspacing='0px'
                                                class='tbl_form'>

                                                <tr>
                                                    <td width='50%' border='1'>Tingkat Nyeri :
                                                        {{ !empty($penilaian->penilaian_nyeri) ? $penilaian->penilaian_nyeri : '' }},
                                                        Waktu /
                                                        Durasi :
                                                        {{ !empty($penilaian->penilaian_nyeri_waktu) ? $penilaian->penilaian_nyeri_waktu : '' }}
                                                        Menit</td>
                                                    <td width='50%' border='1'>Penyebab :
                                                        {{ !empty($penilaian->penilaian_nyeri_penyebab) ? $penilaian->penilaian_nyeri_penyebab : '' }}({{ !empty($penilaian->penilaian_nyeri_ket_penyebab) ? $penilaian->penilaian_nyeri_ket_penyebab : '' }},
                                                        {{ !empty($penilaian->penilaian_nyeri_ket_penyebab) ? $penilaian->penilaian_nyeri_ket_penyebab : '' }})
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Kualitas :
                                                        {{ !empty($penilaian->penilaian_nyeri_kualitas) ? $penilaian->penilaian_nyeri_kualitas : '' }}({{ !empty($penilaian->penilaian_nyeri_ket_kualitas) ? $penilaian->penilaian_nyeri_ket_kualitas : '' }},
                                                        {{ !empty($penilaian->penilaian_nyeri_ket_kualitas) ? $penilaian->penilaian_nyeri_ket_kualitas : '' }})
                                                    </td>
                                                    <td width='50%' border='1'>Severity : Skala Nyeri
                                                        {{ !empty($penilaian->penilaian_nyeri_skala) ? $penilaian->penilaian_nyeri_skala : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='0' border='1'>Wilayah :</td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>&nbsp;&nbsp;&nbsp;&nbsp;Lokasi :
                                                        {{ !empty($penilaian->penilaian_nyeri_lokasi) ? $penilaian->penilaian_nyeri_lokasi : '' }}
                                                    </td>
                                                    <td width='50%' border='1'>Menyebar :
                                                        {{ !empty($penilaian->penilaian_nyeri_menyebar) ? $penilaian->penilaian_nyeri_menyebar : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='50%' border='1'>Nyeri hilang bila :
                                                        {{ !empty($penilaian->penilaian_nyeri_hilang) ? $penilaian->penilaian_nyeri_hilang : '' }}({{ !empty($penilaian->penilaian_nyeri_ket_hilang) ? $penilaian->penilaian_nyeri_ket_hilang : '' }},
                                                        {{ !empty($penilaian->penilaian_nyeri_ket_hilang) ? $penilaian->penilaian_nyeri_ket_hilang : '' }})
                                                    </td>
                                                    <td width='50%' border='1'>Diberitahukan pada dokter ?
                                                        {{ !empty($penilaian->penilaian_nyeri_diberitahukan_dokter) ? $penilaian->penilaian_nyeri_diberitahukan_dokter : '' }}({{ !empty($penilaian->penilaian_nyeri_jam_diberitahukan_dokter)
                                                            ? $penilaian->penilaian_nyeri_jam_diberitahukan_dokter
                                                            : '' }},
                                                        Jam :
                                                        {{ !empty($penilaian->penilaian_nyeri_jam_diberitahukan_dokter) ? $penilaian->penilaian_nyeri_jam_diberitahukan_dokter : '' }})
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>
                                            VII. PENILAIAN RESIKO JATUH
                                            <table width='100%' border='1' align='center' cellpadding='3px'
                                                cellspacing='0px' class='tbl_form'>

                                                <tr class='isi'>
                                                    <td width='40%' bgcolor='#FFFAF8' align='center'>Faktor Resiko
                                                    </td>
                                                    <td width='40%' bgcolor='#FFFAF8' align='center'>Skala</td>
                                                    <td width='10%' bgcolor='#FFFAF8' align='center'>Poin</td>
                                                </tr>
                                                <tr>
                                                    <td>1. Riwayat Jatuh</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_skala1) ? $penilaian->penilaian_jatuh_skala1 : '' }}
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_nilai1) ? $penilaian->penilaian_jatuh_nilai1 : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2. Diagnosis Sekunder (≥ 2 Diagnosis Medis)</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_skala2) ? $penilaian->penilaian_jatuh_skala2 : '' }}
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_nilai2) ? $penilaian->penilaian_jatuh_nilai2 : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3. Alat Bantu</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_skala3) ? $penilaian->penilaian_jatuh_skala3 : '' }}
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_nilai3) ? $penilaian->penilaian_jatuh_nilai3 : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4. Terpasang Infuse</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_skala4) ? $penilaian->penilaian_jatuh_skala4 : '' }}
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_nilai4) ? $penilaian->penilaian_jatuh_nilai4 : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5. Gaya Berjalan</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_skala5) ? $penilaian->penilaian_jatuh_skala5 : '' }}
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_nilai5) ? $penilaian->penilaian_jatuh_nilai5 : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6. Status Mental</td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_skala6) ? $penilaian->penilaian_jatuh_skala6 : '' }}
                                                    </td>
                                                    <td align='center'>
                                                        {{ !empty($penilaian->penilaian_jatuh_nilai6) ? $penilaian->penilaian_jatuh_nilai6 : '' }}
                                                    </td>
                                                </tr>
                                                <td align='right' colspan='2'>Total :</td>
                                                <td align='center'>
                                                    {{ !empty($penilaian->penilaian_jatuh_totalnilai) ? $penilaian->penilaian_jatuh_totalnilai : '' }}
                                                </td>
                                    </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VIII. SKRINING GIZI
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td valign='middle' bgcolor='#FFFAF8' align='center' width='5%'>No</td>
                                    <td valign='middle' bgcolor='#FFFAF8' align='center' width='55%'>Parameter
                                    </td>
                                    <td valign='middle' bgcolor='#FFFAF8' align='center' width='40%'
                                        colspan='2'>Nilai</td>
                                </tr>
                                <tr>
                                    <td valign='top'>1</td>
                                    <td valign='top'>Apakah ada penurunan BB yang tidak diinginkan selama 6 bulan
                                        terakhir ?</td>
                                    <td valign='top' align='center' width='35%'>
                                        {{ !empty($penilaian->skrining_gizi1) ? $penilaian->skrining_gizi1 : '' }}</td>
                                    <td valign='top' align='right' width='5%'>
                                        {{ !empty($penilaian->nilai_gizi1) ? $penilaian->nilai_gizi1 : '' }}&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td valign='top'>2</td>
                                    <td valign='top'>Apakah asupan makan berkurang karena tidak nafsu makan ?</td>
                                    <td valign='top' align='center' width='35%'>
                                        {{ !empty($penilaian->skrining_gizi2) ? $penilaian->skrining_gizi2 : '' }}</td>
                                    <td valign='top' align='right' width='5%'>
                                        {{ !empty($penilaian->nilai_gizi2) ? $penilaian->nilai_gizi2 : '' }}&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td valign='top' align='left' colspan='2'>Total Skor : </td>
                                    <td valign='top' align='right' colspan='2'>
                                        {{ !empty($penilaian->nilai_total_gizi) ? $penilaian->nilai_total_gizi : '' }}&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td valign='top' align='left' colspan='4' border='1'>Pasien dengan
                                        diagnosis khusus :
                                        {{ !empty($penilaian->skrining_gizi_diagnosa_khusus) ? $penilaian->skrining_gizi_diagnosa_khusus : '' }}({{ !empty($penilaian->skrining_gizi_ket_diagnosa_khusus) ? $penilaian->skrining_gizi_ket_diagnosa_khusus : '' }},
                                        {{ !empty($penilaian->skrining_gizi_ket_diagnosa_khusus) ? $penilaian->skrining_gizi_ket_diagnosa_khusus : '' }})
                                    </td>
                                </tr>
                                <tr>
                                    <td valign='top' align='left' colspan='4' border='1'>Sudah dibaca dan
                                        diketahui oleh Dietisen :
                                        {{ !empty($penilaian->skrining_gizi_diketahui_dietisen) ? $penilaian->skrining_gizi_diketahui_dietisen : '' }}({{ !empty($penilaian->skrining_gizi_jam_diketahui_dietisen)
                                            ? $penilaian->skrining_gizi_jam_diketahui_dietisen
                                            : '' }},
                                        {{ !empty($penilaian->skrining_gizi_jam_diketahui_dietisen) ? $penilaian->skrining_gizi_jam_diketahui_dietisen : '' }})
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td valign='middle' bgcolor='#FFFAF8' align='center' width='50%'>
                                        ASESMEN/PENILAIAN KEBIDANAN :</td>
                                    <td valign='middle' bgcolor='#FFFAF8' align='center' width='50%'>RENCANA
                                        KEBIDANAN :</td>
                                </tr>
                                <tr>
                                    <td>{{ !empty($penilaian->masalah) ? $penilaian->masalah : '' }}</td>
                                    <td>{{ !empty($penilaian->rencana) ? $penilaian->rencana : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
    </table>
</td>
</tr>
@endforeach
@endif

<!-- Penilaian Medis IGD -->
@if (!empty($rawat->penilaian_medis_igd) and count($rawat->penilaian_medis_igd) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis IGD</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_igd as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan='2'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Keluarga :
                                        {{ !empty($penilaian->rpk) ? $penilaian->rpk : '' }}</td>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width='100%' valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='25%' border='1'>Keadaan Umum :
                                        {{ !empty($penilaian->keadaan) ? $penilaian->keadaan : '' }}</td>
                                    <td width='25%' border='1'>Kesadaran :
                                        {{ !empty($penilaian->kesadaran) ? $penilaian->kesadaran : '' }}</td>
                                    <td width='25%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}</td>
                                    <td width='25%' border='1'>TB :
                                        {{ !empty($penilaian->tb) ? $penilaian->tb : '' }} Cm</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>BB :
                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                    <td width='25%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='25%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='25%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                    <td width='25%' border='1'>SpO2 :
                                        {{ !empty($penilaian->spo) ? $penilaian->spo : '' }} %</td>
                                    <td width='25%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}</td>
                                    <td width='25%' border='1'>Mata :
                                        {{ !empty($penilaian->mata) ? $penilaian->mata : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Gigi & Mulut :
                                        {{ !empty($penilaian->gigi) ? $penilaian->gigi : '' }}</td>
                                    <td width='25%' border='1'>Leher :
                                        {{ !empty($penilaian->leher) ? $penilaian->leher : '' }}</td>
                                    <td width='25%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}</td>
                                    <td width='25%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Genital & Anus :
                                        {{ !empty($penilaian->genital) ? $penilaian->genital : '' }}</td>
                                    <td width='25%' border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}</td>
                                    <td border='1' colspan='2'>Keterangan Fisik :
                                        {{ !empty($penilaian->ket_fisik) ? $penilaian->ket_fisik : '' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS LOKALIS
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->ket_lokalis) ? $penilaian->ket_lokalis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>EKG :
                                        {{ !empty($penilaian->ekg) ? $penilaian->ekg : '' }}</td>
                                    <td width='33%' border='1'>Radiologi :
                                        {{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</td>
                                    <td width='33%' border='1'>Laborat :
                                        {{ !empty($penilaian->lab) ? $penilaian->lab : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->tata) ? $penilaian->tata : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif

<!-- Penilaian Awal Medis Rawat Jalan Umum  -->
@if (!empty($rawat->penilaian_medis_ralan_umum) and count($rawat->penilaian_medis_ralan_umum) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Umum</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellspacing='0' class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_umum as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan='2'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Keluarga :
                                        {{ !empty($penilaian->rpk) ? $penilaian->rpk : '' }}</td>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='25%' border='1'>Keadaan Umum :
                                        {{ !empty($penilaian->keadaan) ? $penilaian->keadaan : '' }}</td>
                                    <td width='25%' border='1'>Kesadaran :
                                        {{ !empty($penilaian->kesadaran) ? $penilaian->kesadaran : '' }}</td>
                                    <td width='25%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}</td>
                                    <td width='25%' border='1'>TB :
                                        {{ !empty($penilaian->tb) ? $penilaian->tb : '' }} Cm</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>BB :
                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                    <td width='25%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='25%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='25%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                    <td width='25%' border='1'>SpO2 :
                                        {{ !empty($penilaian->spo) ? $penilaian->spo : '' }} %</td>
                                    <td width='25%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}</td>
                                    <td width='25%' border='1'>Gigi & Mulut :
                                        {{ !empty($penilaian->gigi) ? $penilaian->gigi : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>THT :
                                        {{ !empty($penilaian->tht) ? $penilaian->tht : '' }}</td>
                                    <td width='25%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}</td>
                                    <td width='25%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}</td>
                                    <td width='25%' border='1'>Genital & Anus :
                                        {{ !empty($penilaian->genital) ? $penilaian->genital : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}</td>
                                    <td width='25%' border='1'>Kulit :
                                        {{ !empty($penilaian->kulit) ? $penilaian->kulit : '' }}</td>
                                    <td border='1' colspan='2'>Keterangan Fisik :
                                        {{ !empty($penilaian->ket_fisik) ? $penilaian->ket_fisik : '' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS LOKALIS
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->ket_lokalis) ? $penilaian->ket_lokalis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->penunjang) ? $penilaian->penunjang : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->tata) ? $penilaian->tata : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. KONSUL/RUJUK
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->konsulrujuk) ? $penilaian->konsulrujuk : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif





@if (!empty($rawat->penilaian_medis_ralan_kandungan) and count($rawat->penilaian_medis_ralan_kandungan) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Kebidanan & Kandungan</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_kandungan as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan='2'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Keluarga :
                                        {{ !empty($penilaian->rpk) ? $penilaian->rpk : '' }}</td>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='25%' border='1'>Keadaan Umum :
                                        {{ !empty($penilaian->keadaan) ? $penilaian->keadaan : '' }}</td>
                                    <td width='25%' border='1'>Kesadaran :
                                        {{ !empty($penilaian->kesadaran) ? $penilaian->kesadaran : '' }}</td>
                                    <td width='25%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}</td>
                                    <td width='25%' border='1'>TB :
                                        {{ !empty($penilaian->tb) ? $penilaian->tb : '' }} Cm</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>BB :
                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                    <td width='25%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='25%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='25%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                    <td width='25%' border='1'>SpO2 :
                                        {{ !empty($penilaian->spo) ? $penilaian->spo : '' }} %</td>
                                    <td width='25%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}</td>
                                    <td width='25%' border='1'>Mata :
                                        {{ !empty($penilaian->mata) ? $penilaian->mata : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Gigi & Mulut :
                                        {{ !empty($penilaian->gigi) ? $penilaian->gigi : '' }}</td>
                                    <td width='25%' border='1'>THT :
                                        {{ !empty($penilaian->tht) ? $penilaian->tht : '' }}</td>
                                    <td width='25%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}</td>
                                    <td width='25%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Genital & Anus :
                                        {{ !empty($penilaian->genital) ? $penilaian->genital : '' }}</td>
                                    <td width='25%' border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}</td>
                                    <td width='25%' border='1'>Kulit :
                                        {{ !empty($penilaian->kulit) ? $penilaian->kulit : '' }}</td>
                                    <td width='25%' border='1'>Keterangan Fisik :
                                        {{ !empty($penilaian->ket_fisik) ? $penilaian->ket_fisik : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS OBSTETRI / GINEKOLOGI
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1' colspan='2'>TFU :
                                        {{ !empty($penilaian->tfu) ? $penilaian->tfu : '' }}
                                        Cm&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TBJ :
                                        {{ !empty($penilaian->tbj) ? $penilaian->tbj : '' }}
                                        gram&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;His :
                                        {{ !empty($penilaian->his) ? $penilaian->his : '' }} x/10
                                        Menit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kontraksi :
                                        {{ !empty($penilaian->kontraksi) ? $penilaian->kontraksi : '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DJJ
                                        : {{ !empty($penilaian->djj) ? $penilaian->djj : '' }}Dpm</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Inspeksi :
                                        {{ !empty($penilaian->inspeksi) ? $penilaian->inspeksi : '' }}</td>
                                    <td width='50%' border='1'>VT :
                                        {{ !empty($penilaian->vt) ? $penilaian->vt : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Inspekulo :
                                        {{ !empty($penilaian->inspekulo) ? $penilaian->inspekulo : '' }}</td>
                                    <td width='50%' border='1'>RT :
                                        {{ !empty($penilaian->rt) ? $penilaian->rt : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='33%' border='1'>Ultrasonografi :
                                        {{ !empty($penilaian->ultra) ? $penilaian->ultra : '' }}</td>
                                    <td width='33%' border='1'>Kardiotokografi :
                                        {{ !empty($penilaian->kardio) ? $penilaian->kardio : '' }}</td>
                                    <td width='33%' border='1'>Laboratorium :
                                        {{ !empty($penilaian->lab) ? $penilaian->lab : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. TATALAKSANA
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->tata) ? $penilaian->tata : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. KONSUL/RUJUK
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->konsul) ? $penilaian->konsul : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif


<!-- Penilaian Awal Medis Rawat Jalan Bayi/Anak -->
@if (!empty($rawat->penilaian_medis_ralan_bayi) and count($rawat->penilaian_medis_ralan_bayi) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Bayi/Anak</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_bayi as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan='2'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Keluarga :
                                        {{ !empty($penilaian->rpk) ? $penilaian->rpk : '' }}</td>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='25%' border='1'>Keadaan Umum :
                                        {{ !empty($penilaian->keadaan) ? $penilaian->keadaan : '' }}</td>
                                    <td width='25%' border='1'>Kesadaran :
                                        {{ !empty($penilaian->kesadaran) ? $penilaian->kesadaran : '' }}</td>
                                    <td width='25%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}</td>
                                    <td width='25%' border='1'>TB :
                                        {{ !empty($penilaian->tb) ? $penilaian->tb : '' }} Cm</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>BB :
                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                    <td width='25%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='25%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='25%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                    <td width='25%' border='1'>SpO2 :
                                        {{ !empty($penilaian->spo) ? $penilaian->spo : '' }} %</td>
                                    <td width='25%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}</td>
                                    <td width='25%' border='1'>Mata :
                                        {{ !empty($penilaian->mata) ? $penilaian->mata : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Gigi & Mulut :
                                        {{ !empty($penilaian->gigi) ? $penilaian->gigi : '' }}</td>
                                    <td width='25%' border='1'>THT :
                                        {{ !empty($penilaian->tht) ? $penilaian->tht : '' }}</td>
                                    <td width='25%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}</td>
                                    <td width='25%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Genital & Anus :
                                        {{ !empty($penilaian->genital) ? $penilaian->genital : '' }}</td>
                                    <td width='25%' border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}</td>
                                    <td width='25%' border='1'>Kulit :
                                        {{ !empty($penilaian->kulit) ? $penilaian->kulit : '' }}</td>
                                    <td width='25%' border='1'>Keterangan Fisik :
                                        {{ !empty($penilaian->ket_fisik) ? $penilaian->ket_fisik : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS LOKALIS
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->ket_lokalis) ? $penilaian->ket_lokalis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->penunjang) ? $penilaian->penunjang : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. TATALAKSANA
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->tata) ? $penilaian->tata : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. KONSUL/RUJUK
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->konsul) ? $penilaian->konsul : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif

<!-- Penilaian Awal Medis Rawat Jalan Psikiatri -->
@if (!empty($rawat->penilaian_medis_ralan_psikiatri) and count($rawat->penilaian_medis_ralan_psikiatri) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Psikiatri</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_psikiatri as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan='2'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                    <td width='50%'>Riwayat Penyakit Fisik & Neurologi
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Napza :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            II. STATUS PSIKIATRIK
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='50%'>Penampilan :
                                        {{ !empty($penilaian->penampilan) ? $penilaian->penampilan : '' }}</td>
                                    <td width='50%'>Ganguan Persepsi :
                                        {{ !empty($penilaian->gangguan_persepsi) ? $penilaian->gangguan_persepsi : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Pembicaraan :
                                        {{ !empty($penilaian->gangguan_persepsi) ? $penilaian->gangguan_persepsi : '' }}</td>
                                    <td width='50%'>Proses Pikir & Isi Pikir :
                                        {{ !empty($penilaian->proses_pikir) ? $penilaian->proses_pikir : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Psikomotor :
                                        {{ !empty($penilaian->psikomotor) ? $penilaian->psikomotor : '' }}</td>
                                    <td width='50%'>Pengendalian Implus :
                                        {{ !empty($penilaian->pengendalian_impuls) ? $penilaian->pengendalian_impuls : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Sikap :
                                        {{ !empty($penilaian->sikap) ? $penilaian->sikap : '' }}</td>
                                    <td width='50%'>Tilikan :
                                        {{ !empty($penilaian->tilikan) ? $penilaian->tilikan : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Mood/Afek :
                                        {{ !empty($penilaian->mood) ? $penilaian->mood : '' }}</td>
                                    <td width='50%'>Reality Testing Ability :
                                        {{ !empty($penilaian->rta) ? $penilaian->rta : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Fungsi Kognitif :
                                        {{ !empty($penilaian->fungsi_kognitif) ? $penilaian->fungsi_kognitif : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width='100%' valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='25%' border='1'>Keadaan Umum :
                                        {{ !empty($penilaian->keadaan) ? $penilaian->keadaan : '' }}</td>
                                    <td width='25%' border='1'>Kesadaran :
                                        {{ !empty($penilaian->kesadaran) ? $penilaian->kesadaran : '' }}</td>
                                    <td width='25%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}</td>
                                    <td width='25%' border='1'>TB :
                                        {{ !empty($penilaian->tb) ? $penilaian->tb : '' }} °C</td>

                                </tr>
                                <tr>
                                    <td width='25%' border='1'>BB :
                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                    <td width='25%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='25%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='25%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                    <td width='25%' border='1'>SpO2 :
                                        {{ !empty($penilaian->spo) ? $penilaian->spo : '' }} %</td>
                                    <td width='25%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}</td>
                                    <td width='25%' border='1'>Gigi & Mulut :
                                        {{ !empty($penilaian->gigi) ? $penilaian->gigi : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>THT :
                                        {{ !empty($penilaian->tht) ? $penilaian->tht : '' }}</td>
                                    <td width='25%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}</td>
                                    <td width='25%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}</td>
                                    <td width='25%' border='1'>Genital & Anus :
                                        {{ !empty($penilaian->genital) ? $penilaian->genital : '' }}</td>
                                </tr>
                                <tr>
                                    <td  border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}</td>
                                    <td  border='1'>Kulit :
                                        {{ !empty($penilaian->kulit) ? $penilaian->kulit : '' }}</td>
                                    <td colspan="2" border='1' colspan='3'>Keterangan Fisik :
                                        {{ !empty($penilaian->ket_fisik) ? $penilaian->ket_fisik : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->penunjang) ? $penilaian->penunjang : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->tata) ? $penilaian->tata : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. KONSUL/RUJUK
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->konsulrujuk) ? $penilaian->konsulrujuk : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif

<!-- Penilaian Awal Medis Rawat Jalan Neurologi -->
@if (!empty($rawat->penilaian_medis_ralan_neurologi) and count($rawat->penilaian_medis_ralan_neurologi) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Neurologi</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_neurologi as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='20%' border='1'>Kesadaran :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }}</td>
                                    <td width='20%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='20%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='20%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                    <td width='20%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>


                                </tr>
                                <tr>
                                    <td width='20%' border='1'>Status Nutrisi : :
                                        {{ !empty($penilaian->status) ? $penilaian->status : '' }}</td>
                                    <td width='20%' border='1'>BB :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} Kg</td>
                                    <td width='20%' border='1'>Nyeri :
                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}</td>
                                    <td width='20%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }} °C</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS KELAINAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='50%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }} ({{ !empty($penilaian->keterangan_kepala) ? $penilaian->keterangan_kepala : '' }})</td>
                                    <td width='50%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }} ({{ !empty($penilaian->keterangan_thoraks) ? $penilaian->keterangan_thoraks : '' }})</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}, {{ !empty($penilaian->keterangan_abdomen) ? $penilaian->keterangan_abdomen : '' }}</td>
                                    <td width='50%' border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}, {{ !empty($penilaian->keterangan_ekstremitas) ? $penilaian->keterangan_ekstremitas : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Columna Verbralis :
                                        {{ !empty($penilaian->columna) ? $penilaian->columna : '' }}, {{ !empty($penilaian->keterangan_columna) ? $penilaian->keterangan_columna : '' }}</td>
                                    <td width='50%' border='1'>Muskoloskeletal :
                                        {{ !empty($penilaian->muskulos) ? $penilaian->muskulos : '' }}, {{ !empty($penilaian->keterangan_muskulos) ? $penilaian->keterangan_muskulos : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Lainnya : {{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <td valign='top'>
                        IV. PEMERIKSAAN PENUNJANG
                        <table width='100%' border='1' align='center' cellpadding='3px'
                            cellspacing='0px' class='tbl_form'>
                            <tr>
                                <td width='33%' border='1'>Laboratorium :
                                    {{ !empty($penilaian->lab) ? $penilaian->lab : '' }} </td>
                            </tr>
                            <tr>
                                <td width='33%' border='1'>Radiologi :
                                    {{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</td>
                            </tr>
                            <tr>
                                <td width='33%' border='1'>Penunjang lainnya :
                                {{ !empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : '' }}</td>
                            </tr>
                        </table>
                    </td>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td  border='1'>Asesmen Kerja :
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Asesmen Banding :
                                        {{ !empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. PERMASALAHAN & TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td border='1'>Permasalahan :
                                        {{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Terapi/Pengobatan :
                                        {{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" border='1'>Tindakan/Rencana Pengobatan : {{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. EDUKASI
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif

<!-- Penilaian Awal Medis Rawat Jalan Dalam -->
@if (!empty($rawat->penilaian_medis_ralan_penyakit_dalam) and count($rawat->penilaian_medis_ralan_penyakit_dalam) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Penyakit Dalam</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_penyakit_dalam as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='25%' border='1'>Status Nutrisi : :
                                        {{ !empty($penilaian->status) ? $penilaian->status : '' }}</td>
                                    <td width='25%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='25%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='25%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                    <td width='25%' border='1'>BB :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} Kg</td>
                                    <td width='25%' border='1'>Nyeri :
                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}</td>
                                    <td width='25%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }} °C</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS KELAINAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='50%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }} ({{ !empty($penilaian->keterangan_kepala) ? $penilaian->keterangan_kepala : '' }})</td>
                                    <td width='50%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }} ({{ !empty($penilaian->keterangan_thoraks) ? $penilaian->keterangan_thoraks : '' }})</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }} ({{ !empty($penilaian->keterangan_abdomen) ? $penilaian->keterangan_abdomen : '' }})</td>
                                    <td width='50%' border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }} ({{ !empty($penilaian->keterangan_ekstremitas) ? $penilaian->keterangan_ekstremitas : '' }})</td>
                                </tr>
                                <tr>
                                    <td colspan="2" border='1'>Kondisi Umum :
                                        {{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='33%' border='1'>Laboratorium :
                                        {{ !empty($penilaian->lab) ? $penilaian->lab : '' }} </td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Radiologi :
                                        {{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Penunjang lainnya :
                                    {{ !empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td  border='1'>Asesmen Kerja :
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Asesmen Banding :
                                        {{ !empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. PERMASALAHAN & TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td border='1'>Permasalahan :
                                        {{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Terapi/Pengobatan :
                                        {{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" border='1'>Tindakan/Rencana Pengobatan : {{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. EDUKASI
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif

<!-- Penilaian Awal Medis Rawat Jalan Mata -->
@if (!empty($rawat->penilaian_medis_ralan_mata) and count($rawat->penilaian_medis_ralan_mata) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Mata</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_mata as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='20%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='20%' border='1'>BB :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} Kg</td>
                                    <td width='20%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                    <td width='20%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='20%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>

                                </tr>
                                <tr>
                                    <td colspan="2" border='1'>Status Nutrisi :
                                        {{ !empty($penilaian->status) ? $penilaian->status : '' }}</td>
                                    <td colspan="3" border='1'>Nyeri :
                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS OFTAMOLOGIS
                            <table width='100%' border='1' align='center'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td align='center' width='40%' border='1'>OD : Mata Kanan</td>
                                    <td align='center' width='20' border='1'>Status</td>
                                    <td align='center' width='40%' border='1'>OS : Mata Kiri</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->visuskanan) ? $penilaian->visuskanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Visus SC</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->visuskiri) ? $penilaian->visuskiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->cckanan) ? $penilaian->cckanan : '' }}</td>
                                    <td align='center' width='20' border='1'>CC</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->cckiri) ? $penilaian->cckiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->palkanan) ? $penilaian->palkanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Palebra</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->palkiri) ? $penilaian->palkiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->conkanan) ? $penilaian->conkanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Conjungtiva</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->conkiri) ? $penilaian->conkiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->corneakanan) ? $penilaian->corneakanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Cornea</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->corneakiri) ? $penilaian->corneakiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->coakanan) ? $penilaian->coakanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Coa</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->coakiri) ? $penilaian->coakiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->pupilkanan) ? $penilaian->pupilkanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Pupil</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->pupilkiri) ? $penilaian->pupilkiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->lensakanan) ? $penilaian->lensakanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Lensa</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->lensakiri) ? $penilaian->lensakiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->funduskanan) ? $penilaian->funduskanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Fundus Media</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->funduskiri) ? $penilaian->funduskiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->papilkanan) ? $penilaian->papilkanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Papil</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->papilkiri) ? $penilaian->papilkiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->retinakanan) ? $penilaian->retinakanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Retina</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->retinakiri) ? $penilaian->retinakiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->makulakanan) ? $penilaian->makulakanan : '' }}</td>
                                    <td align='center' width='20' border='1'>Makula</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->makulakiri) ? $penilaian->makulakiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->tiokanan) ? $penilaian->tiokanan : '' }}</td>
                                    <td align='center' width='20' border='1'>TIO</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->tiokiri) ? $penilaian->tiokiri : '' }}</td>
                                </tr>
                                <tr>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->mbokanan) ? $penilaian->mbokanan : '' }}</td>
                                    <td align='center' width='20' border='1'>MBO</td>
                                    <td align='center' width='40%' border='1'>{{ !empty($penilaian->mbokiri) ? $penilaian->mbokiri : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='33%' border='1'>Laboratorium :
                                        {{ !empty($penilaian->lab) ? $penilaian->lab : '' }} </td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Radiologi :
                                        {{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Penunjang lainnya :
                                    {{ !empty($penilaian->penunjanglain) ? $penilaian->penunjanglain : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Tes Penglihatan :
                                    {{ !empty($penilaian->tes) ? $penilaian->tes : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Pemeriksa Lainnya :
                                    {{ !empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : '' }}</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td  border='1'>Asesmen Kerja :
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Asesmen Banding :
                                        {{ !empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. PERMASALAHAN & TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td border='1'>Permasalahan :
                                        {{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Terapi/Pengobatan :
                                        {{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" border='1'>Tindakan/Rencana Pengobatan : {{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. EDUKASI
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif

<!-- Penilaian Awal Medis Rawat Jalan THT -->
@if (!empty($rawat->penilaian_medis_ralan_tht) and count($rawat->penilaian_medis_ralan_tht) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan THT</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_tht as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                    <td width='33%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='33%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>BB :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} Kg</td>
                                    <td width='33%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                    <td width='33%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }} °C</td>
                                </tr>
                                <tr>
                                    <td colspan="2" border='1'>Status Nutrisi :
                                        {{ !empty($penilaian->status) ? $penilaian->status : '' }}</td>
                                    <td width='33%' border='1'>Nyeri :
                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" border='1'>Kondisi Umum :
                                        {{ !empty($penilaian->kondisi) ? $penilaian->kondisi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS LOKALIS
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='50%' border='1'>
                                        {{ !empty($penilaian->ket_lokalis) ? $penilaian->ket_lokalis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='33%' border='1'>Laboratorium :
                                        {{ !empty($penilaian->lab) ? $penilaian->lab : '' }} </td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Radiologi :
                                        {{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Pemeriksa Lainnya :
                                    {{ !empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Tes Pendengaran
                                    {{ !empty($penilaian->tes_pendengaran) ? $penilaian->tes_pendengaran : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td  border='1'>Asesmen Kerja :
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Asesmen Banding :
                                        {{ !empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. PERMASALAHAN & TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='50%' border='1'>Permasalahan :
                                        {{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</td>
                                    <td width='50%' border='1'>Terapi/Pengobatan :
                                        {{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Tindakan/Rencana Pengobatan : {{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</td>
                                    <td width='50%' border='1'>Tatalaksana lainnya : {{ !empty($penilaian->tatalaksana) ? $penilaian->tatalaksana : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. EDUKASI
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif


<!-- Penilaian Awal Medis Rawat Jalan Bedah -->
@if (!empty($rawat->penilaian_medis_ralan_bedah) and count($rawat->penilaian_medis_ralan_bedah) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Bedah</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_bedah as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width='100%' valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>

                                    <td width='25%' border='1'>Kesadaran :
                                        {{ !empty($penilaian->kesadaran) ? $penilaian->kesadaran : '' }}</td>
                                    <td width='25%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='25%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='25%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                    <td width='25%' border='1'>Status Nutrisi :
                                        {{ !empty($penilaian->status) ? $penilaian->status : '' }}</td>
                                    <td width='25%' border='1'>BB :
                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                    <td width='25%' border='1'>Nyeri :
                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}</td>
                                    <td width='25%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}</td>
                                    <td width='25%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}</td>
                                    <td width='25%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}</td>
                                </tr>
                                <<tr>
                                    <td width='25%' border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}</td>
                                    <td width='25%' border='1'>Columna Vertebralis :
                                        {{ !empty($penilaian->columna) ? $penilaian->columna : '' }}</td>
                                    <td width='25%' border='1'>Muskuloskeletal :
                                        {{ !empty($penilaian->muskulos) ? $penilaian->muskulos : '' }}</td>
                                    <td width='25%' border='1'>Genetalia Os Pubis :
                                        {{ !empty($penilaian->genetalia) ? $penilaian->genetalia : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" border='1' colspan='3'>Keterangan Lainnya :
                                        {{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS LOKALIS
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='50%' border='1'>
                                        {{ !empty($penilaian->ket_lokalis) ? $penilaian->ket_lokalis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                     <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='33%' border='1'>Laboratorium :
                                        {{ !empty($penilaian->lab) ? $penilaian->lab : '' }} </td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Radiologi :
                                        {{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Penunjang lainnya :
                                    {{ !empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td  border='1'>Asesmen Kerja :
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Asesmen Banding :
                                        {{ !empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. PERMASALAHAN & TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td border='1'>Permasalahan :
                                        {{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Terapi/Pengobatan :
                                        {{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" border='1'>Tindakan/Rencana Pengobatan : {{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. EDUKASI
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif


<!-- Penilaian Awal Medis Rawat Jalan Orthopedi -->
@if (!empty($rawat->penilaian_medis_ralan_orthopedi) and count($rawat->penilaian_medis_ralan_orthopedi) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Orthopedi</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_orthopedi as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                     <tr>
                        <td width='100%' valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>

                                    <td width='25%' border='1'>Kesadaran :
                                        {{ !empty($penilaian->kesadaran) ? $penilaian->kesadaran : '' }}</td>
                                    <td width='25%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='25%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='25%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                    <td width='25%' border='1'>Status Nutrisi :
                                        {{ !empty($penilaian->status) ? $penilaian->status : '' }}</td>
                                    <td width='25%' border='1'>BB :
                                        {{ !empty($penilaian->bb) ? $penilaian->bb : '' }} Kg</td>
                                    <td width='25%' border='1'>Nyeri :
                                        {{ !empty($penilaian->nyeri) ? $penilaian->nyeri : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>GCS(E,V,M) :
                                        {{ !empty($penilaian->gcs) ? $penilaian->gcs : '' }}</td>
                                    <td width='25%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}</td>
                                    <td width='25%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}</td>
                                    <td width='25%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}</td>
                                </tr>
                                <<tr>
                                    <td width='25%' border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }}</td>
                                    <td width='25%' border='1'>Columna Vertebralis :
                                        {{ !empty($penilaian->columna) ? $penilaian->columna : '' }}</td>
                                    <td width='25%' border='1'>Muskuloskeletal :
                                        {{ !empty($penilaian->muskulos) ? $penilaian->muskulos : '' }}</td>
                                    <td width='25%' border='1'>Genetalia Os Pubis :
                                        {{ !empty($penilaian->genetalia) ? $penilaian->genetalia : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" border='1' colspan='3'>Keterangan Lainnya :
                                        {{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS LOKALIS
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td width='50%' border='1'>
                                        {{ !empty($penilaian->ket_lokalis) ? $penilaian->ket_lokalis : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='33%' border='1'>Laboratorium :
                                        {{ !empty($penilaian->lab) ? $penilaian->lab : '' }} </td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Radiologi :
                                        {{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Penunjang lainnya :
                                    {{ !empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                     <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td  border='1'>Asesmen Kerja :
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Asesmen Banding :
                                        {{ !empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. PERMASALAHAN & TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td border='1'>Permasalahan :
                                        {{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Terapi/Pengobatan : {{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Tindakan/Rencana Pengobatan : {{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. EDUKASI
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif

<!-- Penilaian Awal Medis Rawat Jalan Geriatri -->
@if (!empty($rawat->penilaian_medis_ralan_geriatri) and count($rawat->penilaian_medis_ralan_geriatri) > 0)
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>Penilaian Awal Medis Rawat Jalan Geriatri</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0'
                class='tbl_form'>
                @foreach ($rawat->penilaian_medis_ralan_geriatri as $penilaian)
                    <tr>
                        <td valign='top'>
                            YANG MELAKUKAN PENGKAJIAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>

                                <tr>
                                    <td width='33%' border='1'>Tanggal :
                                        {{ !empty($penilaian->tanggal) ? $penilaian->tanggal : '' }}</td>
                                    <td width='33%' border='1'>Dokter :
                                        {{ !empty($penilaian->kd_dokter) ? $penilaian->kd_dokter : '' }}
                                        {{ !empty($penilaian->nm_dokter) ? $penilaian->nm_dokter : '' }}</td>
                                    <td width='33%' border='1'>Anamnesis :
                                        {{ !empty($penilaian->anamnesis) ? $penilaian->anamnesis : '' }}({{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }},
                                        {{ !empty($penilaian->hubungan) ? $penilaian->hubungan : '' }})</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            I. RIWAYAT KESEHATAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td colspan='2'>Keluhan Utama :
                                        {{ !empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Penyakit Sekarang :
                                        {{ !empty($penilaian->rps) ? $penilaian->rps : '' }}</td>
                                    <td width='50%'>Riwayat Penyakit Dahulu :
                                        {{ !empty($penilaian->rpd) ? $penilaian->rpd : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%'>Riwayat Pengunaan Obat :
                                        {{ !empty($penilaian->rpo) ? $penilaian->rpo : '' }}</td>
                                    <td width='50%'>Riwayat Alergi :
                                        {{ !empty($penilaian->alergi) ? $penilaian->alergi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                      <tr>
                        <td width='100%' valign='top'>
                            II. PEMERIKSAAN FISIK
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td colspan="2">Kondisi Umum : {{ !empty($penilaian->kondisi_umum) ? $penilaian->kondisi_umum : '' }}</td>
                                    <td colspan="2">Postur Tulang Belakang : {{ !empty($penilaian->tulang_belakang) ? $penilaian->tulang_belakang : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='25%' border='1'>TD :
                                        {{ !empty($penilaian->td) ? $penilaian->td : '' }} mmHg</td>
                                    <td width='25%' border='1'>Nadi :
                                        {{ !empty($penilaian->nadi) ? $penilaian->nadi : '' }} x/menit</td>
                                    <td width='25%' border='1'>Suhu :
                                        {{ !empty($penilaian->suhu) ? $penilaian->suhu : '' }} °C</td>
                                    <td width='25%' border='1'>RR :
                                        {{ !empty($penilaian->rr) ? $penilaian->rr : '' }} x/menit</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            III. STATUS KELAINAN
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='50%' border='1'>Kepala :
                                        {{ !empty($penilaian->kepala) ? $penilaian->kepala : '' }}, {{ !empty($penilaian->keterangan_kepala) ? $penilaian->keterangan_kepala : '' }}</td>
                                    <td width='50%' border='1'>Thoraks :
                                        {{ !empty($penilaian->thoraks) ? $penilaian->thoraks : '' }}, {{ !empty($penilaian->keterangan_thoraks) ? $penilaian->keterangan_thoraks : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Abdomen :
                                        {{ !empty($penilaian->abdomen) ? $penilaian->abdomen : '' }}, {{ !empty($penilaian->keterangan_abdomen) ? $penilaian->keterangan_abdomen : '' }}</td>
                                    <td width='50%' border='1'>Ekstremitas :
                                        {{ !empty($penilaian->ekstremitas) ? $penilaian->ekstremitas : '' }} {{ !empty($penilaian->keterangan_ekstremitas) ? $penilaian->keterangan_ekstremitas : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Integument :</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Kebersihan :
                                        {{ !empty($penilaian->Integument_kebersihan) ? $penilaian->Integument_kebersihan : '' }}</td>
                                    <td width='50%' border='1'>Warna :
                                        {{ !empty($penilaian->Integument_warna) ? $penilaian->Integument_warna : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Kelembaban :
                                        {{ !empty($penilaian->Integument_kelembaban) ? $penilaian->Integument_kelembaban : '' }}</td>
                                    <td width='50%' border='1'>Gangguan Kulit :
                                        {{ !empty($penilaian->Integument_gangguan_kulit) ? $penilaian->Integument_gangguan_kulit : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Lainya : {{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Kondisi Sosial : {{ !empty($penilaian->lainnya) ? $penilaian->lainnya : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Kognitif (MMSE) :
                                        {{ !empty($penilaian->status_kognitif_mmse) ? $penilaian->status_kognitif_mmse : '' }}</td>
                                    <td width='50%' border='1'>Nutrisi (MNA) :
                                        {{ !empty($penilaian->status_nutrisi) ? $penilaian->status_nutrisi : '' }}, {{ !empty($penilaian->keterangan_muskulos) ? $penilaian->keterangan_muskulos : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Risiko Jatuh (OMS) :
                                        {{ !empty($penilaian->skrining_jatuh) ? $penilaian->skrining_jatuh : '' }}</td>
                                    <td width='50%' border='1'>Fungsional (BARTHEL INDEX) :
                                        {{ !empty($penilaian->status_fungsional) ? $penilaian->status_fungsional : '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Psikologis GDS (Geriatric Depression Scale) : {{ !empty($penilaian->status_psikologis_gds) ? $penilaian->status_psikologis_gds : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                      <tr>
                        <td valign='top'>
                            IV. PEMERIKSAAN PENUNJANG
                            <table width='100%' border='1' align='center' cellpadding='3px'
                                cellspacing='0px' class='tbl_form'>
                                <tr>
                                    <td width='33%' border='1'>Laboratorium :
                                        {{ !empty($penilaian->lab) ? $penilaian->lab : '' }} </td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Radiologi :
                                        {{ !empty($penilaian->rad) ? $penilaian->rad : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='33%' border='1'>Penunjang lainnya :
                                    {{ !empty($penilaian->pemeriksaan) ? $penilaian->pemeriksaan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            V. DIAGNOSIS/ASESMEN
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td  border='1'>Asesmen Kerja :
                                        {{ !empty($penilaian->diagnosis) ? $penilaian->diagnosis : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Asesmen Banding :
                                        {{ !empty($penilaian->diagnosis2) ? $penilaian->diagnosis2 : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VI. PERMASALAHAN & TATALAKSANA
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>

                                <tr>
                                    <td border='1'>Permasalahan :
                                        {{ !empty($penilaian->permasalahan) ? $penilaian->permasalahan : '' }}</td>
                                </tr>
                                <tr>
                                    <td width='50%' border='1'>Terapi/Pengobatan : {{ !empty($penilaian->terapi) ? $penilaian->terapi : '' }}</td>
                                </tr>
                                <tr>
                                    <td border='1'>Tindakan/Rencana Pengobatan : {{ !empty($penilaian->tindakan) ? $penilaian->tindakan : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'>
                            VII. EDUKASI
                            <table width='100%' border='1' align='center' cellspacing='0px'
                                class='tbl_form'>
                                <tr>
                                    <td width='100%' border='1'>
                                        {{ !empty($penilaian->edukasi) ? $penilaian->edukasi : '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif

<!-- Pemeriksaan Rawat Jalan -->
@if (!empty($rawat->cppt))
    @if (count($rawat->cppt))
        <?php
        $model = !empty($rawat->cppt) ? $rawat->cppt : [];
        $paramater_view = [
            'model' => $model,
            'type_akses' => $type_akses,
        ];
        ?>
        @include('riwayat-pasien.bagan-cppt', $paramater_view)
    @endif
@endif

<!-- Perencanaan pemulangan -->
@if (!empty($rawat->perencanaan_pemulangan) and count($rawat->perencanaan_pemulangan) > 0)
@include('riwayat-pasien.bagan-perencanaan-pemulangan')
@endif
<!-- Biaya & Perawatan -->
@include('riwayat-pasien.bagan-biaya-perawatan')

<!-- resume -->
@if (!empty($rawat->resume))
    @if (!empty($type_akses))
        <?php
        $model = !empty($rawat->resume) ? $rawat->resume : [];
        $paramater_view = [
            'model' => $model,
        ];
        ?>
        @if ($type_akses == 'ri')
            @include('riwayat-pasien.bagan-resume-ranap', $paramater_view)
        @else
            @include('riwayat-pasien.bagan-resume-ralan', $paramater_view)
        @endif
    @endif
@endif

<tr class='isi'>
    <td></td>
    <td colspan='3' align='right'>&nbsp;
</tr>

</div>
@endforeach
</table>

</html>
