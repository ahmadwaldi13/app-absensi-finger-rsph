@extends('layouts.master2')

@section('title-header', $title)

@section('breadcrumbs')
    @include('layouts.breadcrumbs')
@endsection

<?php
    $router_name=(new \App\Http\Traits\GlobalFunction)->getRouterIndex();
    $data_pasien=!empty($get_data->data_pasien) ? $get_data->data_pasien : '';
    $text_tgl_perawatan='';
    if(!empty($data_pasien)){
        $text_tgl_perawatan.=!empty($data_pasien->registrasi) ? $data_pasien->registrasi : '';
        $text_tgl_perawatan.=!empty($text_tgl_perawatan) ? "<br>s/d" : '';
        if(!empty($text_tgl_perawatan)){
            $text_tgl_perawatan.=!empty($data_pasien->keluar) ? "<br>".$data_pasien->keluar : '';
        }
    }

    // dd($get_data);
    $data_detail=[];
    $total_biaya=0;
?>

@section('content')
    <div class="card card-body">
        <div class="row justify-content-start">
            <div class="row justify-content-start">
                <h4>Rincian Biaya</h4>
                <div class="col-lg-12 ">
                    <div style="overflow-x: auto; max-width: auto;">
                        <table class="table border table-responsive-tablet">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Keterangan</th>
                                    <th style="width: 30%">Tagihan/Tindakan/Terapi</th>
                                    <th style="width: 10%" class='text-end'>Biaya</th>
                                    <th style="width: 3%" class='text-end'>Jumlah</th>
                                    <th style="width: 10%" class='text-end'>Tambahan</th>
                                    <th style="width: 5%" class='text-end'>Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $title_no_rm='No.RM';
                                    $title_no_rawat='No.Rawat';
                                    $title_nm_pasien='Nama Pasien';

                                    if(!empty($get_data->bayi)){
                                        $title_no_rm='No.RM IBU';
                                        $title_no_rawat='No.Rawat IBU';
                                        $title_nm_pasien='Nama IBU';
                                    }
                                ?>
                                <tr>
                                    <td>{{ $title_no_rm }}</td>
                                    <td>{{ !empty($data_pasien->no_rkm_medis) ? $data_pasien->no_rkm_medis : ''  }}</td>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td>{{ $title_no_rawat }}</td>
                                    <td>{{ !empty($data_pasien->no_rawat) ? $data_pasien->no_rawat : ''  }}</td>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td>{{ $title_nm_pasien }}</td>
                                    <td>
                                        <?php
                                            $nm_pasien=!empty($data_pasien->nm_pasien) ? $data_pasien->nm_pasien : '';
                                            $umur='';
                                            $umur.=!empty($data_pasien->umurdaftar) ? $data_pasien->umurdaftar : '';
                                            if($umur){
                                                $umur.=!empty($data_pasien->sttsumur) ? $data_pasien->sttsumur : '';
                                            }
                                            $umur=!empty($umur) ? "( ".$umur." )" : '';
                                        ?>
                                        {{ $nm_pasien.$umur  }}
                                    </td>
                                    <td colspan="4"></td>
                                </tr>

                                @if(!empty($get_data->bayi))
                                    <?php $data_bayi=$get_data->bayi; ?>
                                    <tr>
                                        <td>No.R.M. Bayi</td>
                                        <td>{{ !empty($data_bayi->no_rkm_medis) ? $data_bayi->no_rkm_medis : ''  }}</td>
                                        <td colspan="4"></td>
                                    </tr>

                                    <tr>
                                        <td>Nama Bayi</td>
                                        <td>{{ !empty($data_bayi->nm_pasien) ? $data_bayi->nm_pasien : ''  }}</td>
                                        <td colspan="4"></td>
                                    </tr>
                                @endif

                                <tr>
                                    <td>Alamat Pasien</td>
                                    <td>{{ !empty($get_data->alamat) ? $get_data->alamat : ''  }}</td>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td>Bangsal/Kamar</td>
                                    <td>{{ !empty($get_data->bangsal) ? $get_data->bangsal : ''  }}</td>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td>Tgl.Perawatan</td>
                                    <td>{!! !empty($text_tgl_perawatan) ? $text_tgl_perawatan : ''  !!}</td>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td>Dokter</td>
                                    <td colspan="5"></td>
                                </tr>

                                @if(!empty($get_data->dokter_ralan))
                                    <tr>
                                        <td>Ralan</td>
                                        <td>
                                            <?php
                                                $list_dokter_ralan='';
                                                if(!empty($get_data->dokter_ralan)){
                                                    $dokter_ralan=$get_data->dokter_ralan;
                                                    $list_dokter_ralan.="<ul style='margin:0px; padding:0px'>";
                                                    foreach($dokter_ralan as $item_dr){
                                                        $list_dokter_ralan.="<li>";
                                                        $list_dokter_ralan.=!empty($item_dr->nm_dokter) ? $item_dr->nm_dokter : '-';
                                                        $list_dokter_ralan.="</li>";
                                                    }
                                                    $list_dokter_ralan.="</ul>";
                                                }
                                            ?>
                                            {!! $list_dokter_ralan !!}
                                        </td>
                                        <td colspan="4"></td>
                                    </tr>
                                @endif

                                @if(!empty($get_data->dokter_ranap))
                                    <tr>
                                        <td>Ranap</td>
                                        <td>
                                            <?php
                                                $list_dokter_ranap='';
                                                if(!empty($get_data->dokter_ranap)){
                                                    $dokter_ranap=$get_data->dokter_ranap;
                                                    $list_dokter_ranap.="<ul style='margin:0px; padding:0px'>";
                                                    foreach($dokter_ranap as $item_dr){
                                                        $list_dokter_ranap.="<li>";
                                                        $list_dokter_ranap.=!empty($item_dr->nm_dokter) ? $item_dr->nm_dokter : '-';
                                                        $list_dokter_ranap.="</li>";
                                                    }
                                                    $list_dokter_ranap.="</ul>";
                                                }
                                            ?>
                                            {!! $list_dokter_ranap !!}
                                        </td>
                                        <td colspan="4"></td>
                                    </tr>
                                @endif

                                @if(!empty($get_data->ruang))
                                    <tr>
                                        <td>Ruang</td>
                                        <td colspan="5"></td>
                                    </tr>
                                    <?php
                                        $total_me=0;
                                    ?>
                                    @foreach($get_data->ruang as $item_ruang)
                                        <?php
                                            $nm_ruang='';
                                            $nm_ruang.=!empty($item_ruang->kd_kamar) ? $item_ruang->kd_kamar : '';
                                            $nm_ruang.=!empty($item_ruang->nm_bangsal) ? ",".$item_ruang->nm_bangsal : '';

                                            $biaya=!empty($item_ruang->trf_kamar) ? $item_ruang->trf_kamar : 0;
                                            $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                            $qty=!empty($item_ruang->lama) ? $item_ruang->lama : 0;
                                            $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                            $total_form=!empty($item_ruang->total) ? $item_ruang->total : 0;
                                            $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                            $total_me+=$total_form;
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td>{{ $nm_ruang }}</td>
                                            <td class='text-end'>{{ $biaya_text }}</td>
                                            <td class='text-end'>{{ $qty_text }}</td>
                                            <td></td>
                                            <td class='text-end'>{{ $total_form_text }}</td>
                                        </tr>
                                    @endforeach
                                    <?php $total_biaya+=$total_me; ?>
                                    <tr style='font-weight:700'>
                                        <td colspan="5" class='text-end'>Total</td>
                                        <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                    </tr>
                                @endif

                            @if (!empty($get_data->data_perawatan_jalan))
                                    @if (!empty($get_data->data_perawatan_jalan['Konsultasi Dokter Spesialis']))
                                    <tr>
                                        <td colspan="3">Konsultasi Dokter Spesialis</td>
                                        <td colspan="3"></td>
                                    </tr>
                                    <?php
                                    $total_me=0;
                                ?>
                                @foreach($get_data->data_perawatan_jalan['Konsultasi Dokter Spesialis'] as $item_dokter_spesialis)
                                    <?php
                                    $biaya=!empty($item_dokter_spesialis->total_byrdr) ? $item_dokter_spesialis->total_byrdr : 0;
                                    $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                    $qty=!empty($item_dokter_spesialis->jml) ? $item_dokter_spesialis->jml : 0;
                                    $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                    $total_form=!empty($item_dokter_spesialis->biaya) ? $item_dokter_spesialis->biaya : 0;
                                    $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                    $total_me+=$total_form;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>{{ !empty($item_dokter_spesialis->nm_perawatan) ? $item_dokter_spesialis->nm_perawatan : '' }}</td>
                                        <td class='text-end'>{{ $biaya_text }}</td>
                                        <td class='text-end'>{{ $qty_text }}</td>
                                        <td class='text-end'>0</td>
                                        <td class='text-end'>{{ $total_form_text }}</td>
                                    </tr>
                                @endforeach
                                     <?php $total_biaya+=$total_me; ?>
                                        <tr style='font-weight:700'>
                                            <td colspan="5" class='text-end'>Total</td>
                                            <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($get_data->data_perawatan_jalan['Konsultasi Dokter Umum']))
                                    <tr>
                                        <td colspan="3">Konsultasi Dokter Umum</td>
                                        <td colspan="3"></td>
                                    </tr>
                                    <?php
                                    $total_me=0;
                                ?>
                                @foreach($get_data->data_perawatan_jalan['Konsultasi Dokter Umum'] as $item_dokter_umum)
                                    <?php
                                    $biaya=!empty($item_dokter_umum->total_byrdr) ? $item_dokter_umum->total_byrdr : 0;
                                    $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                    $qty=!empty($item_dokter_umum->jml) ? $item_dokter_umum->jml : 0;
                                    $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                    $total_form=!empty($item_dokter_umum->biaya) ? $item_dokter_umum->biaya : 0;
                                    $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                    $total_me+=$total_form;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>{{ !empty($item_dokter_umum->nm_perawatan) ? $item_dokter_umum->nm_perawatan : '' }}</td>
                                        <td class='text-end'>{{ $biaya_text }}</td>
                                        <td class='text-end'>{{ $qty_text }}</td>
                                        <td class='text-end'>0</td>
                                        <td class='text-end'>{{ $total_form_text }}</td>
                                    </tr>
                                @endforeach
                                     <?php $total_biaya+=$total_me; ?>
                                        <tr style='font-weight:700'>
                                            <td colspan="5" class='text-end'>Total</td>
                                            <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($get_data->data_perawatan_jalan['Oksigen']))
                                    <tr>
                                        <td colspan="3">Oksigen</td>
                                        <td colspan="3"></td>
                                    </tr>
                                    <?php
                                    $total_me=0;
                                ?>
                                @foreach($get_data->data_perawatan_jalan['Oksigen'] as $item_oksigen)
                                    <?php
                                    $biaya=!empty($item_oksigen->total_byrdr) ? $item_oksigen->total_byrdr : 0;
                                    $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                    $qty=!empty($item_oksigen->jml) ? $item_oksigen->jml : 0;
                                    $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                    $total_form=!empty($item_oksigen->biaya) ? $item_oksigen->biaya : 0;
                                    $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                    $total_me+=$total_form;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>{{ !empty($item_oksigen->nm_perawatan) ? $item_oksigen->nm_perawatan : '' }}</td>
                                        <td class='text-end'>{{ $biaya_text }}</td>
                                        <td class='text-end'>{{ $qty_text }}</td>
                                        <td class='text-end'>0</td>
                                        <td class='text-end'>{{ $total_form_text }}</td>
                                    </tr>
                                @endforeach
                                     <?php $total_biaya+=$total_me; ?>
                                        <tr style='font-weight:700'>
                                            <td colspan="5" class='text-end'>Total</td>
                                            <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($get_data->data_perawatan_jalan['Tindakan IGD']))
                                    <tr>
                                        <td colspan="3">Tindakan IGD</td>
                                        <td colspan="3"></td>
                                    </tr>
                                    <?php
                                    $total_me=0;
                                ?>
                                @foreach($get_data->data_perawatan_jalan['Tindakan IGD'] as $item_tindakan_igd)
                                    <?php
                                    $biaya=!empty($item_tindakan_igd->total_byrdr) ? $item_tindakan_igd->total_byrdr : 0;
                                    $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                    $qty=!empty($item_tindakan_igd->jml) ? $item_tindakan_igd->jml : 0;
                                    $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                    $total_form=!empty($item_tindakan_igd->biaya) ? $item_tindakan_igd->biaya : 0;
                                    $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                    $total_me+=$total_form;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>{{ !empty($item_tindakan_igd->nm_perawatan) ? $item_tindakan_igd->nm_perawatan : '' }}</td>
                                        <td class='text-end'>{{ $biaya_text }}</td>
                                        <td class='text-end'>{{ $qty_text }}</td>
                                        <td class='text-end'>0</td>
                                        <td class='text-end'>{{ $total_form_text }}</td>
                                    </tr>
                                @endforeach
                                     <?php $total_biaya+=$total_me; ?>
                                        <tr style='font-weight:700'>
                                            <td colspan="5" class='text-end'>Total</td>
                                            <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                        </tr>
                                    @endif
                            @endif

                            @if (!empty($get_data->data_perawatan_inap))
                                @if (!empty($get_data->data_perawatan_inap['VISITE DOKTER SPESIALIS']))
                                <tr>
                                    <td colspan="3">VISITE DOKTER SPESIALIS</td>
                                    <td colspan="3"></td>
                                </tr>
                                <?php
                                $total_me=0;
                            ?>
                            @foreach($get_data->data_perawatan_inap['VISITE DOKTER SPESIALIS'] as $item_visite)
                                <?php
                                $biaya=!empty($item_visite->total_byrdr) ? $item_visite->total_byrdr : 0;
                                $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                $qty=!empty($item_visite->jml) ? $item_visite->jml : 0;
                                $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                $total_form=!empty($item_visite->biaya) ? $item_visite->biaya : 0;
                                $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                $total_me+=$total_form;
                                ?>
                                <tr>
                                    <td></td>
                                    <td>{{ !empty($item_visite->nm_perawatan) ? $item_visite->nm_perawatan : '' }}</td>
                                    <td class='text-end'>{{ $biaya_text }}</td>
                                    <td class='text-end'>{{ $qty_text }}</td>
                                    <td class='text-end'>0</td>
                                    <td class='text-end'>{{ $total_form_text }}</td>
                                </tr>
                            @endforeach
                                 <?php $total_biaya+=$total_me; ?>
                                    <tr style='font-weight:700'>
                                        <td colspan="5" class='text-end'>Total</td>
                                        <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                    </tr>
                                @endif

                                @if (!empty($get_data->data_perawatan_inap['Tindakan Keperawatan Per hari']))
                                <tr>
                                    <td colspan="3">Tindakan Keperawatan Per hari</td>
                                    <td colspan="3"></td>
                                </tr>
                                <?php
                                $total_me=0;
                                ?>
                                 @foreach($get_data->data_perawatan_inap['Tindakan Keperawatan Per hari'] as $item_tindakan)
                                 <?php
                                 $biaya=!empty($item_tindakan->total_byrdr) ? $item_tindakan->total_byrdr : 0;
                                 $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                 $qty=!empty($item_tindakan->jml) ? $item_tindakan->jml : 0;
                                 $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                 $total_form=!empty($item_tindakan->biaya) ? $item_tindakan->biaya : 0;
                                 $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                 $total_me+=$total_form;
                                 ?>
                                 <tr>
                                     <td></td>
                                     <td>{{ !empty($item_tindakan->nm_perawatan) ? $item_tindakan->nm_perawatan : '' }}</td>
                                     <td class='text-end'>{{ $biaya_text }}</td>
                                     <td class='text-end'>{{ $qty_text }}</td>
                                     <td class='text-end'>0</td>
                                     <td class='text-end'>{{ $total_form_text }}</td>
                                 </tr>
                             @endforeach
                                  <?php $total_biaya+=$total_me; ?>
                                     <tr style='font-weight:700'>
                                         <td colspan="5" class='text-end'>Total</td>
                                         <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                     </tr>
                                @endif
                            @endif

                                @if(!empty($get_data->pemeriksaan_lab))
                                    <tr>
                                        <td>Pemeriksaan Lab</td>
                                        <td colspan="5"></td>
                                    </tr>
                                    <?php
                                        $total_me=0;
                                    ?>
                                    @foreach($get_data->pemeriksaan_lab as $item_lab)
                                        <?php
                                            $biaya=!empty($item_lab->biaya) ? $item_lab->biaya : 0;
                                            $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                            $qty=!empty($item_lab->jml) ? $item_lab->jml : 0;
                                            $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                            $total_detail_lab=!empty($get_data->pemeriksaan_lab_detail[$item_lab->kd_jenis_prw]) ? $get_data->pemeriksaan_lab_detail[$item_lab->kd_jenis_prw] : [];

                                            $tambahan=!empty($total_detail_lab) ? $total_detail_lab : 0;
                                            $tambahan_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($tambahan);

                                            $total_form=!empty($item_lab->total) ? $item_lab->total : 0;
                                            $total_form=$total_form+$tambahan;
                                            $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                            $total_me+=$total_form;
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td>{{ !empty($item_lab->nm_perawatan) ? $item_lab->nm_perawatan : '' }}</td>
                                            <td class='text-end'>{{ $biaya_text }}</td>
                                            <td class='text-end'>{{ $qty_text }}</td>
                                            <td class='text-end'>{{ $tambahan_text }}</td>
                                            <td class='text-end'>{{ $total_form_text }}</td>
                                        </tr>
                                    @endforeach
                                    <?php $total_biaya+=$total_me; ?>
                                    <tr style='font-weight:700'>
                                        <td colspan="5" class='text-end'>Total</td>
                                        <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                    </tr>
                                @endif

                                @if(!empty($get_data->operasi))
                                    <tr>
                                        <td>Operasi</td>
                                        <td colspan="5"></td>
                                    </tr>
                                    <?php
                                        $total_me=0;
                                    ?>
                                    @foreach ($get_data->operasi as $item)
                                    <?php
                                            $biaya=!empty($item->biaya) ? $item->biaya : 0;
                                            $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                            $qty=!empty($item->jumlah) ? $item->jumlah : 0;
                                            $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                            $tambah=!empty($item->tambahan) ? $item->tambahan : 0;
                                            $tambah_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($tambah);

                                            $total_form = !empty($qty > 0) ? $qty * $biaya + $tambah : 0;
                                            $total_form_text =(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                            $total_me+=$total_form;
                                        ?>
                                    <tr>
                                        <td></td>
                                        <td>{{ !empty($item->nm_perawatan) ? $item->nm_perawatan : '' }}</td>
                                        <td class="text-end">{{ $biaya_text }}</td>
                                        <td class="text-end">{{ $qty_text }}</td>
                                        <td class="text-end">{{ $tambah_text }}</td>
                                        <td class="text-end">{{ $total_form_text }}</td>
                                    </tr>
                                    @endforeach
                                    <?php $total_biaya+=$total_me; ?>
                                    <tr style='font-weight:700'>
                                        <td colspan="5" class='text-end'>Total</td>
                                        <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                    </tr>
                                @endif

                                @if(!empty($get_data->obat_bhp))
                                    <tr>
                                        <td>Obat & BHP</td>
                                        <td colspan="5"></td>
                                    </tr>
                                    <?php
                                    $total_me=0;
                                ?>
                                @foreach($get_data->obat_bhp as $item_obat)
                                    <?php
                                        $biaya=!empty($item_obat->biaya_obat) ? $item_obat->biaya_obat : 0;
                                        $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                        $qty=!empty($item_obat->jml) ? $item_obat->jml : 0;
                                        $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                        $tambahan=!empty($item_obat->tambahan) ? $item_obat->tambahan : 0;
                                        $tambahan_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($tambahan);

                                        $total_form=!empty($item_obat->total) ? $item_obat->total : 0;
                                        $total_form=$total_form+$tambahan;
                                        $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                        $total_me+=$total_form;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>{{ !empty($item_obat->nama_brng) ? $item_obat->nama_brng : '' }}</td>
                                        <td class='text-end'>{{ $biaya_text }}</td>
                                        <td class='text-end'>{{ $qty_text }}</td>
                                        <td class='text-end'>{{ $tambahan_text }}</td>
                                        <td class='text-end'>{{ $total_form_text }}</td>
                                    </tr>
                                @endforeach
                                <?php $total_biaya+=$total_me; ?>
                                <tr style='font-weight:700'>
                                    <td colspan="5" class='text-end'>Total</td>
                                    <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                </tr>
                                @endif


                                @if(!empty($get_data->pemeriksaan_radiologi))
                                    <tr>
                                        <td>Pemeriksaan Radiologi</td>
                                        <td colspan="5"></td>
                                    </tr>
                                    <?php
                                        $total_me=0;
                                    ?>
                                    @foreach($get_data->pemeriksaan_radiologi as $item_radiologi)
                                        <?php
                                            $biaya=!empty($item_radiologi->biaya) ? $item_radiologi->biaya : 0;
                                            $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                            $qty=!empty($item_radiologi->jml) ? $item_radiologi->jml : 0;
                                            $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                            $total_detail_lab=!empty($get_data->pemeriksaan_radiologi_detail[$item_radiologi->kd_jenis_prw]) ? $get_data->pemeriksaan_radiologi_detail[$item_radiologi->kd_jenis_prw] : [];

                                            $tambahan=!empty($total_detail_lab) ? $total_detail_lab : 0;
                                            $tambahan_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($tambahan);

                                            $total_form=!empty($item_radiologi->total) ? $item_radiologi->total : 0;
                                            $total_form=$total_form+$tambahan;
                                            $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                            $total_me+=$total_form;
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td>{{ !empty($item_radiologi->nm_perawatan) ? $item_radiologi->nm_perawatan : '' }}</td>
                                            <td class='text-end'>{{ $biaya_text }}</td>
                                            <td class='text-end'>{{ $qty_text }}</td>
                                            <td class='text-end'>{{ $tambahan_text }}</td>
                                            <td class='text-end'>{{ $total_form_text }}</td>
                                        </tr>
                                    @endforeach
                                    <?php $total_biaya+=$total_me; ?>
                                    <tr style='font-weight:700'>
                                        <td colspan="5" class='text-end'>Total</td>
                                        <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                    </tr>
                                @endif


                                <tr>
                                    <td>Pindah Kamar</td>
                                    <td>
                                        <?php
                                            $url_pindah_kamar='pindah-kamar-pasien-ranap';
                                        ?>
                                        @if( (new \App\Http\Traits\AuthFunction)->checkAkses($url_pindah_kamar) )
                                            <?php
                                                $paramater_send=[
                                                    'data_sent'=>$data_pasien->no_rkm_medis.'@'.$data_pasien->no_rawat,
                                                    'params_json'=>$params_parent_json,
                                                ];
                                                $tmp_para=[];
                                                foreach($paramater_send as $key => $value){
                                                    $tmp_para[]=$key.'='.$value;
                                                }
                                                $paramater_send=implode('&',$tmp_para);
                                                $url=$url_pindah_kamar.'?'.$paramater_send;
                                            ?>
                                            <div class='text-start'>
                                                <a href="{{ url($url) }}" class='btn btn-primary'>Tambah/Ubah Data Pindah Kamar</a>
                                            </div>
                                        @endif
                                    </td>
                                    <td colspan='4'></td>
                                </tr>
                                @if(!empty($get_data->pindah_kamar))
                                    <?php
                                        $total_me=0;
                                    ?>
                                    @foreach($get_data->pindah_kamar as $item_pk)
                                    <?php
                                        $kamar_awal=!empty($item_pk->kd_kamar_awal) ? $item_pk->kd_kamar_awal : '';
                                        if($kamar_awal){
                                            $kamar_awal.=!empty($item_pk->nm_bangsal_awal) ? ",".$item_pk->nm_bangsal_awal : '';
                                        }

                                        $kamar_pindah=!empty($item_pk->kd_kamar_pindah) ? $item_pk->kd_kamar_pindah : '';
                                        if($kamar_pindah){
                                            $kamar_pindah.=!empty($item_pk->nm_bangsal_pindah) ? ",".$item_pk->nm_bangsal_pindah : '';
                                        }

                                        $trf_kamar_awal=!empty($item_pk->trf_kamar_awal) ? $item_pk->trf_kamar_awal : 0;
                                        $trf_kamar_awal_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($trf_kamar_awal);

                                        $trf_kamar_pindah=!empty($item_pk->trf_kamar_pindah) ? $item_pk->trf_kamar_pindah : 0;
                                        $trf_kamar_pindah_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($trf_kamar_pindah);

                                        $selisih_kamar=$trf_kamar_pindah-$trf_kamar_awal;

                                        $selisih_kamar_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($selisih_kamar);

                                        $biaya=!empty($selisih_kamar) ? $selisih_kamar : 0;
                                        $biaya_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($biaya);

                                        $qty=!empty($item_pk->lama_inap) ? $item_pk->lama_inap : 0;
                                        $qty_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($qty);

                                        $total_form=$biaya*$qty;
                                        $total_form_text=(new \App\Http\Traits\GlobalFunction)->formatMoney($total_form);

                                        $total_me+=$total_form;

                                        $waktu_masuk=!empty($item_pk->waktu_masuk) ? (new \App\Http\Traits\GlobalFunction)->set_format_tanggal($item_pk->waktu_masuk) : 0;
                                        $waktu_masuk=!empty($waktu_masuk->tanggal_jam) ? $waktu_masuk->tanggal_jam : '';
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="card card-body">
                                                <div class="text-start mb-3">
                                                    Tanggal Masuk : {!! $waktu_masuk !!}
                                                </div>
                                                <div class="row justify-content-start align-items-end">
                                                    <div class="col-lg-8 text-start">
                                                        {!! $kamar_awal !!}
                                                    </div>
                                                    <div class="col-lg-4 text-end">
                                                        : {{ $trf_kamar_awal_text }}
                                                    </div>

                                                    <div class="col-lg-8 text-start">
                                                        {!! $kamar_pindah !!}
                                                    </div>
                                                    <div class="col-lg-4 text-end">
                                                        : {{ $trf_kamar_pindah_text }}
                                                    </div>
                                                </div>
                                                <div class='text-end'><hr></div>
                                                <div class="row justify-content-start align-items-end">
                                                    <div class="col-lg-8 text-start">
                                                        Selisih
                                                    </div>
                                                    <div class="col-lg-4 text-end">
                                                        : {{ $selisih_kamar_text }}
                                                    </div>
                                                </div>

                                                <?php
                                                    $url_pindah_kamar_cetak='pindah-kamar-pasien-ranap/cetak';
                                                ?>
                                                @if( (new \App\Http\Traits\AuthFunction)->checkAkses($url_pindah_kamar_cetak) )
                                                    <hr>
                                                    <?php


                                                        $paramater_cetak=[
                                                            'pindah_kamar_params'=>json_encode(['key_me'=>$item_pk->id_pindah_kamar]),
                                                        ];

                                                        $tmp_para=[];
                                                        foreach($paramater_cetak as $key => $value){
                                                            $tmp_para[]=$key.'='.$value;
                                                        }
                                                        $paramater_cetak=implode('&',$tmp_para);
                                                        $url_pindah_kamar_cetak=$url_pindah_kamar_cetak.'?'.$paramater_cetak;
                                                    ?>
                                                    <div>
                                                        <a href='{{ url($url_pindah_kamar_cetak) }}' target="_blank" class='btn btn-primary'>
                                                            Cetak Struk <i class="fa-solid fa-print"></i>
                                                        </a>
                                                    </div>
                                                @endif

                                            </div>
                                        </td>
                                        <td style='vertical-align: middle;' class='text-end'>{{ $biaya_text }}</td>
                                        <td style='vertical-align: middle;' class='text-end'>{{ $qty_text }}</td>
                                        <td></td>
                                        <td style='vertical-align: middle;' class='text-end'>{{ $total_form_text }}</td>
                                    </tr>
                                    @endforeach
                                    <?php $total_biaya+=$total_me; ?>
                                    <tr style='font-weight:700'>
                                        <td colspan="5" class='text-end'>Total</td>
                                        <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_me)}}</td>
                                    </tr>
                                @endif







                                <tr style='font-weight:700'>
                                    <td colspan="5" class='text-end'>Total Biaya</td>
                                    <td class='text-end'>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($total_biaya)}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
