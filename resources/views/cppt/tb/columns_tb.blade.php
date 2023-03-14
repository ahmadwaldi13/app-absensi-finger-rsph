<?php 
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
?>
<div style="overflow-x: auto; max-width: auto;">
    @if( (new \App\Http\Traits\AuthFunction)->checkAkses('TB/view') )
        <table class="table border table-responsive-tablet">
            <thead>
                <tr>
                    <th class="py-3" style="width: 7%">ID TB 03</th>
                    <th class="py-3" style="width: 10%;">No Rekam Medis</th>
                    <th class="py-3" style="width: 10%;">Nama Penyakit</th>
                    <th class="py-3" style="width: 18%;">Klasifikasi Riwayat Pengobatan</th>
                    <th class="py-3" style="width: 15%;">Tanggal Mulai Pengobatan</th>
                    <th class="py-3" style="width: 15%;">Tanggal Akhir Pengobatan</th>
                    <th colspan='2' class="py-6 text-center" style="width: 15%;">Action</th>
                </tr>
            </thead>
            <tbody data-jml="">
                @if(!empty($listDataTB))
                    @foreach($listDataTB as $item)
                        <?php 
                            $kode=$item_pasien->no_fr.'@'.$item->no_rkm_medis;  
                            $check_akses=(new \App\Http\Traits\GlobalFunction)->check_akses($item->kd_dokter);
                            if( (new \App\Http\Traits\AuthFunction)->checkAkses('isi-resume/fullAkses') ){
                                $check_akses=1;
                            }

                            $link_param_copy = [
                                'no_rm' => (!empty($item->no_rkm_medis) ? $item->no_rkm_medis : ''),
                                'no_rawat' => (!empty($item->no_rawat) ? $item->no_rawat : ''),
                                'fr' => $item_pasien->no_fr,
                                'cdata'=>$item->kodes
                            ];

                            $url_target_copy=(new \App\Http\Traits\GlobalFunction)->generateLink($link_param_copy,url('isi-resume'));
                        ?>
                        <tr>
                            <td class="py-3 px-0">{{ !empty($item->id_tb_03) ? $item->id_tb_03 : '' }}</td>
                            <td class="py-3">{{ !empty($item->no_rkm_medis) ? $item->no_rkm_medis : '' }}</td>
                            <td class="py-3">{{ !empty($item->nm_penyakit) ? $item->nm_penyakit : '' }} {{ !empty($item->nm_pasien) ? $item->nm_pasien : '' }}</td>
                            <td class="py-3">{{ view_data_tb('klasifikasi_riwayat_pengobatan',(!empty($item->klasifikasi_riwayat_pengobatan) ? $item->klasifikasi_riwayat_pengobatan : '' ))}}</td>
                            <td class="py-3">{{ !empty($item->tanggal_mulai_pengobatan) ? $item->tanggal_mulai_pengobatan : '' }}</td>
                            <td class="py-3">{{ !empty($item->tanggal_hasil_akhir_pengobatan) ? $item->tanggal_hasil_akhir_pengobatan : '' }}</td>

                        <td class="py-3 text-center">
                            <a href="{{ url('/TB/view') }}" class='modal-remote' data-modal-key='{{ $kode }}' data-modal-title='View Detail TB'>
                                <div class="btn btn-primary">Lihat Detail </div>
                            </a>
                        </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    @else
        <h5 class="text-danger">Tidak terdapat Akses untuk melihat riwayat TB</h5>
    @endif
</div>