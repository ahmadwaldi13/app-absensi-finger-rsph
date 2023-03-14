<tr class='isi'>
    <?php 
        $total_biaya_perawatan=0;
        $total_biaya_perawatan=$total_biaya_perawatan+$rawat->biaya_reg;
    ?>
    <td valign='top' width='2%'></td>
    <td valign='top' width='18%'>Biaya & Perawatan</td>
    <td valign='top' width='1%' align='center'>:</td>
    <td valign='top' width='79%'>
        <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form table table-bordered'>
            <tr>
                <td valign='top' width='89%'>Administrasi</td>
                <td valign='top' width='1%' align='right'>:</td>
                <td valign='top' width='10%' align='right'>{{number_format($rawat->biaya_reg)}}</td>
            </tr>
        </table>

        @if (!empty($rawat->tindakan_rawat_jalan) and count($rawat->tindakan_rawat_jalan) > 0 )
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form table table-bordered'>
                <tr>
                    <td valign='top' colspan='4'>Tindakan Rawat Jalan Dokter</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='41%' bgcolor='#FFF7F3'>Nama Tindakan/Perawatan</td>
                    <td valign='top' width='20%' bgcolor='#FFF7F3'>Dokter</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($rawat->tindakan_rawat_jalan as $index => $tindakan_rawat_jalan)
                <tr>
                    <td valign='top' align='center'>{{$index+1}} </td>
                    <td valign='top'>{{$tindakan_rawat_jalan->tgl_perawatan}} {{$tindakan_rawat_jalan->jam_rawat}} </td>
                    <td valign='top'>{{$tindakan_rawat_jalan->kd_jenis_prw}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan->nm_perawatan}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan->nm_dokter}}</td>
                    <td valign='top' align='right'>{{number_format($tindakan_rawat_jalan->biaya_rawat)}}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$tindakan_rawat_jalan->biaya_rawat; ?>
                </tr>
                @endforeach
            </table>
        @endif
        
        @if (!empty($rawat->tindakan_rawat_jalan_paramedis) and count($rawat->tindakan_rawat_jalan_paramedis) > 0 )
            <?php $data=$rawat->tindakan_rawat_jalan_paramedis; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form table table-bordered'>
                <tr>
                    <td valign='top' colspan='4'>Tindakan Rawat Jalan Paramedis</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='41%' bgcolor='#FFF7F3'>Nama Tindakan/Perawatan</td>
                    <td valign='top' width='20%' bgcolor='#FFF7F3'>Paramedis</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data as $index => $tindakan_rawat_jalan_paramedis)
                <tr>
                    <td valign='top' align='center'>{{$index+1}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan_paramedis->tgl_perawatan}} {{$tindakan_rawat_jalan_paramedis->jam_rawat}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan_paramedis->kd_jenis_prw}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan_paramedis->nm_perawatan}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan_paramedis->nama}}</td>
                    <td valign='top' align='right'>{{number_format($tindakan_rawat_jalan_paramedis->biaya_rawat)}}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$tindakan_rawat_jalan_paramedis->biaya_rawat; ?>
                </tr>
                @endforeach
            </table>
        @endif

        @if (!empty($rawat->tindakan_rawat_jalan_dokter_paramedis) and count($rawat->tindakan_rawat_jalan_dokter_paramedis) > 0 )
            <?php $data=$rawat->tindakan_rawat_jalan_dokter_paramedis; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form table table-bordered'>
                <tr>
                    <td valign='top' colspan='5'>Tindakan Rawat Jalan Dokter & Paramedis</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='27%' bgcolor='#FFF7F3'>Nama Tindakan/Perawatan</td>
                    <td valign='top' width='17%' bgcolor='#FFF7F3'>Dokter</td>
                    <td valign='top' width='17%' bgcolor='#FFF7F3'>Paramedis</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data as $index => $tindakan_rawat_jalan_dokter_paramedis)
                <tr>
                    <td valign='top' align='center'>{{$index+1}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan_dokter_paramedis->tgl_perawatan}} {{$tindakan_rawat_jalan_dokter_paramedis->jam_rawat}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan_dokter_paramedis->kd_jenis_prw}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan_dokter_paramedis->nm_perawatan}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan_dokter_paramedis->nm_dokter}}</td>
                    <td valign='top'>{{$tindakan_rawat_jalan_dokter_paramedis->nama}}</td>
                    <td valign='top' align='right'>{{number_format($tindakan_rawat_jalan_dokter_paramedis->biaya_rawat)}}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$tindakan_rawat_jalan_dokter_paramedis->biaya_rawat; ?>
                </tr>
                @endforeach
            </table>
        @endif
        
        @if (!empty($rawat->tindakan_rawat_inap_dokter) and count($rawat->tindakan_rawat_inap_dokter) > 0 )
            <?php 
                $data=$rawat->tindakan_rawat_inap_dokter;
            ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form table table-bordered'>
                <tr>
                    <td valign='top' colspan='4'>Tindakan Rawat Inap Dokter</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='41%' bgcolor='#FFF7F3'>Nama Tindakan/Perawatan</td>
                    <td valign='top' width='45%' bgcolor='#FFF7F3'>Dokter</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td valign='top' align='center'>{{ $key+1 }} </td>
                    <td valign='top'>{{ !empty($item->tgl_perawatan) ? $item->tgl_perawatan : '' }} {{!empty($item->jam_rawat) ? $item->jam_rawat : ''}} </td>
                    <td valign='top'>{{ !empty($item->kd_jenis_prw) ? $item->kd_jenis_prw : '' }}</td>
                    <td valign='top'>{{ !empty($item->nm_perawatan) ? $item->nm_perawatan : '' }}</td>
                    <td valign='top'>{{ !empty($item->nm_dokter) ? $item->nm_dokter : ''}}</td>
                    <td valign='top' align='right'>{{ !empty($item->biaya_rawat) ? number_format($item->biaya_rawat) : 0}}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$item->biaya_rawat; ?>
                </tr>
                @endforeach
            </table>
        @endif
        
        @if (!empty($rawat->tindakan_rawat_inap_paramedis) and count($rawat->tindakan_rawat_inap_paramedis) > 0 )
            <?php $data=$rawat->tindakan_rawat_inap_paramedis; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='4'>Tindakan Rawat Inap Paramedis</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='41%' bgcolor='#FFF7F3'>Nama Tindakan/Perawatan</td>
                    <td valign='top' width='20%' bgcolor='#FFF7F3'>Paramedis</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $tindakan_rawat_inap_paramedis)
                <tr>
                    <td valign='top' align='center'>w</td>
                    <td valign='top'>{{$tindakan_rawat_inap_paramedis->tgl_perawatan}} {{$tindakan_rawat_inap_paramedis->jam_rawat}}</td>
                    <td valign='top'>{{$tindakan_rawat_inap_paramedis->kd_jenis_prw}}</td>
                    <td valign='top'>{{$tindakan_rawat_inap_paramedis->nm_perawatan}}</td>
                    <td valign='top'>{{$tindakan_rawat_inap_paramedis->nama}}</td>
                    <td valign='top' align='right'>{{number_format($tindakan_rawat_inap_paramedis->biaya_rawat)}}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$tindakan_rawat_inap_paramedis->biaya_rawat; ?>
                </tr>
                @endforeach
            </table>
        @endif

        @if (!empty($rawat->tindakan_rawat_inap_dokter_paramedis) and count($rawat->tindakan_rawat_inap_dokter_paramedis) > 0 )
            <?php $data=$rawat->tindakan_rawat_inap_dokter_paramedis; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='5'>Tindakan Rawat Inap Dokter & Paramedis</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='27%' bgcolor='#FFF7F3'>Nama Tindakan/Perawatan</td>
                    <td valign='top' width='17%' bgcolor='#FFF7F3'>Dokter</td>
                    <td valign='top' width='17%' bgcolor='#FFF7F3'>Paramedis</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $tindakan_rawat_inap_dokter_paramedis)
                <tr>
                    <td valign='top' align='center'>{{$index+1}}</td>
                    <td valign='top'>{{$tindakan_rawat_inap_dokter_paramedis->tgl_perawatan}} {{$tindakan_rawat_inap_dokter_paramedis->am_rawat}}</td>
                    <td valign='top'>{{$tindakan_rawat_inap_dokter_paramedis->kd_jenis_prw}})</td>
                    <td valign='top'>{{$tindakan_rawat_inap_dokter_paramedis->nm_perawatan}})</td>
                    <td valign='top'>{{$tindakan_rawat_inap_dokter_paramedis->nm_dokter}})</td>
                    <td valign='top'>{{$tindakan_rawat_inap_dokter_paramedis->nama}})</td>
                    <td valign='top' align='right'>{{number_format($tindakan_rawat_inap_dokter_paramedis->biaya_rawat)}}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$tindakan_rawat_inap_dokter_paramedis->biaya_rawat; ?>
                </tr>
                @endforeach
            </table>
        @endif

        @if (!empty($rawat->penggunaan_kamar) and count($rawat->penggunaan_kamar) > 0 )
            <?php $data=$rawat->penggunaan_kamar; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='5'>Penggunaan Kamar</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal Masuk</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggak Keluar</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Lama Inap</td>
                    <td valign='top' width='36%' bgcolor='#FFF7F3'>Kamar</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Status</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $penggunaan_kamar)
                <tr>
                    <td valign='top' align='center'>{{$index+1}}</td>
                    <td valign='top'>{{$penggunaan_kamar->tgl_masuk}} {{$penggunaan_kamar->jam_masuk}}</td>
                    <td valign='top'>{{$penggunaan_kamar->tgl_keluar}} {{$penggunaan_kamar->jam_keluar}}</td>
                    <td valign='top'>{{$penggunaan_kamar->lama}}</td>
                    <td valign='top'>{{$penggunaan_kamar->kd_kamar}}, {{$penggunaan_kamar->nm_bangsal}}</td>
                    <td valign='top'>{{$penggunaan_kamar->stts_pulang}}</td>
                    <td valign='top' align='right'>{{(new \App\Http\Traits\GlobalFunction)->formatMoney($penggunaan_kamar->ttl_biaya)}}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$penggunaan_kamar->ttl_biaya; ?>
                </tr>
                @endforeach
            </table>
        @endif
        
        @if (!empty($rawat->operasi_vk) and count($rawat->operasi_vk) > 0 )
            <?php $data=$rawat->operasi_vk; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='5'>Operasi/VK</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td colspan='2' valign='top' width='26%' bgcolor='#FFF7F3'>Nama Tindakan</td>
                    <td valign='top' width='18%' bgcolor='#FFF7F3'>Anastesi</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $operasi_vk)
                <tr>
                    <td valign='top' align='center'>{{ $index+1 }}</td>
                    <td valign='top'>{{ !empty($operasi_vk->tgl_operasi) ? $operasi_vk->tgl_operasi : '' }}</td>
                    <td valign='top'>{{ !empty($operasi_vk->kode_paket) ? $operasi_vk->kode_paket : '' }}</td>
                    <td valign='top'>{{ !empty($operasi_vk->nm_perawatan) ? $operasi_vk->nm_perawatan : '' }}</td>
                    <td colspan='2' valign='top'>{{ !empty($operasi_vk->jenis_anasthesi) ? $operasi_vk->jenis_anasthesi : '' }}</td>
                    <?php $total=!empty($operasi_vk->total) ? $operasi_vk->total : 0; ?>
                    <td valign='top' align='right'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total) }}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$total; ?>
                </tr>
                @endforeach
            </table>
        @endif

        @if (!empty($rawat->operasi_vk) and count($rawat->operasi_vk) > 0 )
            @if (!empty($rawat->laporan_operasi) and count($rawat->laporan_operasi) > 0 )
                <?php $data=$rawat->laporan_operasi; ?>
                <table width='100%' border='1' cellpadding='3px' cellspacing='0' class='tbl_form'>
                    <thead>
                        <tr>
                            <th style="text-align: left;" valign='top' colspan='5'>Laporan Operasi :</th>
                        </tr>
                    </thead>  
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td rowspan="7" width='4%' valign='top'  align='center'>{{ $key+1 }}</td>
                                <td valign='top' align='left' width='21%'>Mulai Operasi</td>
                                <td valign='top' align='left' width='1px'>:</td>
                                <td valign='top' align='left' width='75%'>{{ !empty($item->tanggal) ? $item->tanggal : '' }}</td>
                            </tr>
                            <tr>
                                <td valign='top' align='left' width='21%'>Diagnosa Pre-operatif</td>
                                <td valign='top' align='left' width='1px'>:</td>
                                <td valign='top' align='left' width='75%'>{{ !empty($item->diagnosa_preop) ? $item->diagnosa_preop : '' }}</td>
                            </tr>
                            <tr>
                                <td valign='top' align='left' width='21%'>Jaringan Yang di-Eksisi/-Insisi</td>
                                <td valign='top' align='left' width='1px'>:</td>
                                <td valign='top' align='left' width='75%'>{{ !empty($item->jaringan_dieksekusi) ? $item->jaringan_dieksekusi : '' }}</td>
                            </tr>
                            <tr>
                                <td valign='top' align='left' width='21%'>Diagnosa Post-operatif</td>
                                <td valign='top' align='left' width='1px'>:</td>
                                <td valign='top' align='left' width='75%'>{{ !empty($item->diagnosa_postop) ? $item->diagnosa_postop : '' }}</td>
                            </tr>
                            <tr>
                                <td valign='top' align='left' width='21%'>Selesai Operasi</td>
                                <td valign='top' align='left' width='1px'>:</td>
                                <td valign='top' align='left' width='75%'>{{ !empty($item->selesaioperasi) ? $item->selesaioperasi : '' }}</td>
                            </tr>
                            <tr>
                                <td valign='top' align='left' width='21%'>Dikirim Untuk Pemeriksaan PA</td>
                                <td valign='top' align='left' width='1px'>:</td>
                                <td valign='top' align='left' width='75%'>{{ !empty($item->permintaan_pa) ? $item->permintaan_pa : '' }}</td>
                            </tr>
                            <tr>
                                <td valign='top' align='left' width='21%'>Laporan</td>
                                <td valign='top' align='left' width='1px'>:</td>
                                <td valign='top' align='left' style='white-space: pre-wrap' width='75%'>{{ !empty($item->laporan_operasi) ? $item->laporan_operasi : '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif
        
        @if (!empty($rawat->pemeriksaan_radiologi) and count($rawat->pemeriksaan_radiologi) > 0 )
            <?php $data=$rawat->pemeriksaan_radiologi; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='5'>Pemeriksaan Radiologi</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='26%' bgcolor='#FFF7F3'>Nama Pemeriksaan</td>
                    <td valign='top' width='18%' bgcolor='#FFF7F3'>Dokter PJ</td>
                    <td valign='top' width='17%' bgcolor='#FFF7F3'>Petugas</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $perawatan_radiologi)
                <tr>
                    <td valign='top' align='center'>{{ $index+1 }}</td>
                    <td valign='top'>{{ $perawatan_radiologi->tgl_periksa }} {{ $perawatan_radiologi->jam }}</td>
                    <td valign='top'>{{ $perawatan_radiologi->kd_jenis_prw }}</td>
                    <td valign='top'>{{ $perawatan_radiologi->nm_perawatan }}<br>{{ $perawatan_radiologi->proyeksi }}</td>
                    <td valign='top'>{{ $perawatan_radiologi->nm_dokter }}</td>
                    <td valign='top'>{{ $perawatan_radiologi->nama }}</td>
                    <td valign='top' align='right'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($perawatan_radiologi->biaya) }}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$perawatan_radiologi->biaya; ?>
                </tr>
                @endforeach
            </table>
        
            @if (!empty($rawat->hasil_radiologi) and count($rawat->hasil_radiologi) > 0 )
                <?php $data=$rawat->hasil_radiologi; ?>
                <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                    <tr>
                        <td valign='top' colspan='3'>Bacaan/Hasil Radiologi</td>
                    </tr>
                    <tr align='center'>
                        <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                        <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                        <td valign='top' width='81%' bgcolor='#FFF7F3'>Hasil Pemeriksaan</td>
                    </tr>
                    @foreach ($data ?? [] as $index => $value_hasil_radiologi)
                    <tr>
                        <td valign='top' align='center'>{{ $index+1 }}</td>
                        <td valign='top'>{{ $value_hasil_radiologi->tgl_periksa }} {{ $value_hasil_radiologi->jam }}</td>
                        <td valign='top' style='white-space: pre-wrap'>{{ $value_hasil_radiologi->hasil }}</td>
                    </tr>
                    @endforeach
                </table>
            @endif
        @endif

        @if (!empty($rawat->periksa_lab) and count($rawat->periksa_lab) > 0 )
            <?php $data=$rawat->periksa_lab; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='5'>Pemeriksaan Laboratorium PK</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='26%' bgcolor='#FFF7F3'>Nama Pemeriksaan</td>
                    <td valign='top' width='18%' bgcolor='#FFF7F3'>Dokter PJ</td>
                    <td valign='top' width='17%' bgcolor='#FFF7F3'>Petugas</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $periksa_lab)
                    @if (!empty($periksa_lab->jenis) and count($periksa_lab->jenis) > 0 )
                        @foreach ($periksa_lab->jenis ?? [] as $index2 => $jenis)
                            @if($index2 == 0)
                                <tr>
                                    <td valign='top' align='center'>{{ $index + 1 }}</td>
                                    <td valign='top'>{{ $periksa_lab->tgl_periksa }} {{ $periksa_lab->jam }}</td>
                                    <td valign='top'>{{ $jenis->kd_jenis_prw }}</td>
                                    <td valign='top'>{{ $jenis->nm_perawatan }}</td>
                                    <td valign='top'>{{ $jenis->nm_dokter }}</td>
                                    <td valign='top'>{{ $jenis->nama }}</td>
                                    <td valign='top' align='right'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($jenis->biaya) }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td valign='top' align='center'></td>
                                    <td valign='top'></td>
                                    <td valign='top'>{{ $jenis->kd_jenis_prw }}</td>
                                    <td valign='top'>{{ $jenis->nm_perawatan }}</td>
                                    <td valign='top'>{{ $jenis->nm_dokter }}</td>
                                    <td valign='top'>{{ $jenis->nama }}</td>
                                    <td valign='top' align='right'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($jenis->biaya) }}</td>
                                </tr>
                            @endif

                            @if (!empty($jenis->template_labor) and count($jenis->template_labor) > 0 )
                                <tr>
                                    <td valign='top' align='center'></td>
                                    <td valign='top'></td>
                                    <td valign='top'></td>
                                    <td valign='top' align='center' bgcolor='#FFF7F3'>Detail Pemeriksaan</td>
                                    <td valign='top' align='center' bgcolor='#FFF7F3'>Hasil</td>
                                    <td valign='top' align='center' bgcolor='#FFF7F3'>Nilai Rujukan</td>
                                    <td valign='top' align='right'></td>
                                </tr>
                                @foreach ($jenis->template_labor ?? [] as $index2 => $template_labor)
                                    <tr>
                                        <td valign='top' align='center'></td>
                                        <td valign='top'></td>
                                        <td valign='top'></td>
                                        <td valign='top'>{{ $template_labor->Pemeriksaan }}</td>
                                        <td valign='top'>{{ $template_labor->nilai }} {{ $template_labor->satuan }}</td>
                                        <td valign='top'>{{ $template_labor->nilai_rujukan }}</td>
                                        <td valign='top' align='right'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($template_labor->biaya_item) }}</td>
                                        <?php $total_biaya_perawatan=$total_biaya_perawatan+$template_labor->biaya_item; ?>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @endif

                    @if (!empty($periksa_lab->saran_kesan) and count($periksa_lab->saran_kesan) > 0 )
                        @foreach($periksa_lab->saran_kesan as $saran_kesan)
                            <tr>
                                <td valign='top' align='center'></td>
                                <td valign='top'>Kesan</td>
                                <td valign='top' colspan='5'>: {{ $saran_kesan->kesan }}</td>
                            </tr>
                            <tr>
                                <td valign='top' align='center'></td>
                                <td valign='top'>Saran</td>
                                <td valign='top' colspan='5'>: {{ $saran_kesan->saran }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </table>
        @endif

        @if(!empty($rawat->periksa_lab2))
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='5'>Pemeriksaan Laboratorium PA</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td valign='top'></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='26%' bgcolor='#FFF7F3'>Nama Pemeriksaan</td>
                    <td valign='top' width='18%' bgcolor='#FFF7F3'>Dokter PJ</td>
                    <td valign='top' width='17%' bgcolor='#FFF7F3'>Petugas</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($rawat->periksa_lab2 ?? [] as $index => $periksa_lab2)
                <tr>
                    <td valign='top' align='center'>{{ $index+1 }}</td>
                    <td valign='top'>{{ $periksa_lab2->tgl_periksa }} {{ $periksa_lab2->jam }}</td>
                    <td valign='top'>{{ $periksa_lab2->kd_jenis_prw }}</td>
                    <td valign='top'>{{ $periksa_lab2->nm_perawatan }}</td>
                    <td valign='top'>{{ $periksa_lab2->nm_dokter }}</td>
                    <td valign='top'>{{ $periksa_lab2->nama }}</td>
                    <td valign='top' align='right'>{{ number_format($periksa_lab2->biaya) }}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$periksa_lab2->biaya; ?>
                </tr>
                @if(!empty($periksa_lab2->detail))
                <tr>
                    <td valign='top' align='center'></td>
                    <td valign='top'></td>
                    <td valign='top'>Diagnosa Klinis</td>
                    <td valign='top' colspan='4'>: {{ $periksa_lab2->detail->diagnosa_klinik }}</td>
                </tr>
                <tr>
                    <td valign='top' align='center'></td>
                    <td valign='top'></td>
                    <td valign='top'>Makroskopik</td>
                    <td valign='top' colspan='4'>: {{ $periksa_lab2->detail->makroskopik }}</td>
                </tr>
                <tr>
                    <td valign='top' align='center'></td>
                    <td valign='top'></td>
                    <td valign='top'>Mikroskopik</td>
                    <td valign='top' colspan='4'>: {{ $periksa_lab2->detail->mikroskopik }}</td>
                </tr>
                <tr>
                    <td valign='top' align='center'></td>
                    <td valign='top'></td>
                    <td valign='top'>Kesimpulan</td>
                    <td valign='top' colspan='4'>: {{ $periksa_lab2->detail->kesimpulan }}</td>
                </tr>
                <tr>
                    <td valign='top' align='center'></td>
                    <td valign='top'></td>
                    <td valign='top'>Kesan</td>
                    <td valign='top' colspan='4'>: {{ $periksa_lab2->detail->kesan }}</td>
                </tr>
                @if(!empty($periksa_lab2->detail->file))
                <tr>
                    <td valign='top' align='center'></td>
                    <td valign='top'></td>
                    <td valign='top' colspan='5' align='center'>
                        <a href='{{ $periksa_lab2->detail->file }}'>
                            <img alt='Gambar PA' src='{{ $periksa_lab2->detail->file }}' width='450' height='450' />
                        </a>
                    </td>
                </tr>
                @endif
                @endif
                @endforeach
            </table>
        @endif

        @if (!empty($rawat->pemberian_obat) and count($rawat->pemberian_obat) > 0 )
            <?php $data=$rawat->pemberian_obat; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='5'>Pemberian Obat/BHP/Alkes</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='35%' bgcolor='#FFF7F3'>Nama Obat/BHP/Alkes</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Jumlah</td>
                    <td valign='top' width='16%' bgcolor='#FFF7F3'>Aturan Pakai</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $pemberian_obat)
                <tr>
                    <td valign='top' align='center'>{{ $index+1 }}</td>
                    <td valign='top'>{{ $pemberian_obat->tgl_perawatan }} {{ $pemberian_obat->jam }}</td>
                    <td valign='top'>{{ $pemberian_obat->kode_brng }}</td>
                    <td valign='top'>{{ $pemberian_obat->nama_brng }}</td>
                    <td valign='top'>{{ $pemberian_obat->jml }} {{ $pemberian_obat->kode_sat }}</td>
                    <td valign='top'>{{ $pemberian_obat->aturan_pakai }}</td>
                    <td valign='top' align='right'>{{ number_format($pemberian_obat->total) }}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$pemberian_obat->total; ?>
                </tr>
                @endforeach
            </table>
        @endif

        @if (!empty($rawat->retur_obat) and count($rawat->retur_obat) > 0 )
            <?php $data=$rawat->retur_obat; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='5'>Retur Obat</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='35%' bgcolor='#FFF7F3'>Nama Obat/BHP/Alkes</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Jumlah</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $key => $item)
                <tr>
                    <td valign='top' align='center'>{{ $key+1 }}</td>
                    <td valign='top'>{{ $item->kode_brng }}</td>
                    <td valign='top'>{{ $item->nama_brng }}</td>
                    <td valign='top'>{{ $item->jumlah }} {{ $item->kode_sat }}</td>
                    <td valign='top' align='right'>{{ number_format($item->total) }}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$item->total; ?>
                </tr>
                @endforeach
            </table>
        @endif
        
        @if (!empty($rawat->penggunaan_obat_operasi) and count($rawat->penggunaan_obat_operasi) > 0 )
            <?php $data=$rawat->penggunaan_obat_operasi; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='4'>Penggunaan Obat/BHP Operasi</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td></td>
                </tr>

                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='51%' bgcolor='#FFF7F3'>Nama Obat/BHP</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Jumlah</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $penggunaan_op)
                <tr>
                    <td valign='top' align='center'>{{$index+1}}</td>
                    <td valign='top'>{{ $penggunaan_op->tanggal }}</td>
                    <td valign='top'>{{ $penggunaan_op->kd_obat }}</td>
                    <td valign='top'>{{ $penggunaan_op->nm_obat }}</td>
                    <td valign='top'>{{number_format( $penggunaan_op->jumlah )}} {{ $penggunaan_op->kode_sat }}+</td>
                    <td valign='top' align='right'>{{number_format( $penggunaan_op->total )}}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$penggunaan_op->total; ?>
                </tr>
                @endforeach
            </table>
        @endif
        
        @if (!empty($rawat->resep_pulang) and count($rawat->resep_pulang) > 0 )
            <?php $data=$rawat->resep_pulang; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='4'>Resep Pulang</td>
                    <td valign='top' colspan='1' align='right'>:</td>
                    <td></td>
                </tr>

                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Kode</td>
                    <td valign='top' width='50%' bgcolor='#FFF7F3'>Nama Obat/BHP/Alkes</td>
                    <td valign='top' width='16%' bgcolor='#FFF7F3'>Dosis</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Jumlah</td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $resep_pulang)
                <tr>
                    <td valign='top' align='center'>{{ $index+1 }}</td>
                    <td valign='top'>{{ $resep_pulang->kode_brng }}</td>
                    <td valign='top'>{{ $resep_pulang->nama_brng }}</td>
                    <td valign='top'>{{ $resep_pulang->dosis }}</td>
                    <td valign='top'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney( $resep_pulang->jml_barang) }} {{ $resep_pulang->kode_sat }}</td>
                    <td valign='top' align='right'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($resep_pulang->total) }}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$resep_pulang->total; ?>
                </tr>
                @endforeach
            </table>
        @endif

        @if (!empty($rawat->tambahan_biaya) and count($rawat->tambahan_biaya) > 0 )
            <?php $data=$rawat->tambahan_biaya; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='2'>Tambahan Biaya</td>
                    <td valign='top' align='right'>:</td>
                    <td></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='85%' bgcolor='#FFF7F3'>Nama Tambahan</td>
                    <td valign='top' width='1%' bgcolor='#FFF7F3'></td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $tambahan_biaya)
                <tr>
                    <td valign='top' align='center'>{{ $index+1 }}</td>
                    <td valign='top'>{{ $tambahan_biaya->nama_biaya }}</td>
                    <td valign='top'></td>
                    <td valign='top' align='right'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($tambahan_biaya->besar_biaya) }}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$tambahan_biaya->besar_biaya; ?>
                </tr>
                @endforeach
            </table>
        @endif

        @if (!empty($rawat->potongan_biaya) and count($rawat->potongan_biaya) > 0 )
            <?php $data=$rawat->potongan_biaya; ?>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
                <tr>
                    <td valign='top' colspan='2'>Potongan Biaya</td>
                    <td valign='top' align='right'>:</td>
                    <td></td>
                </tr>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='85%' bgcolor='#FFF7F3'>Nama Potongan</td>
                    <td valign='top' width='1%' bgcolor='#FFF7F3'></td>
                    <td valign='top' width='10%' bgcolor='#FFF7F3'>Biaya</td>
                </tr>
                @foreach ($data ?? [] as $index => $potongan_biaya)
                <tr>
                    <td valign='top' align='center'>{{ $index+1 }}</td>
                    <td valign='top'>{{ $potongan_biaya->nama_pengurangan }}</td>
                    <td valign='top'></td>
                    <td valign='top' align='right'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($potongan_biaya->besar_pengurangan) }}</td>
                    <?php $total_biaya_perawatan=$total_biaya_perawatan+$potongan_biaya->besar_pengurangan; ?>
                </tr>
                @endforeach
            </table>
        @endif

        <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form'>
            <tr style="font-size:17px; font-weight: 700;">
                <td valign='top' width='89%' colspan='2'>Total Biaya</td>
                <td valign='top' width='1%' align='right'>:</td>
                <td valign='top' width='10%' align='right'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_biaya_perawatan) }}</td>
            </tr>
        </table>
    </td>
</tr>