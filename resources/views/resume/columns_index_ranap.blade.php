<?php
    $item_pasien=(new \App\Http\Traits\ItemPasienFunction)->getItemPasien(Request::get('fr'));
?>
<div style="overflow-x: auto; max-width: auto;">
    <table class="table border table-responsive-tablet">
        <thead>
            <tr>
                <th class="py-3" style="width: 2%">Tgl.Rawat</th>
                <th class="py-3" style="width: 7%;">No.Rawat</th>
                <th class="py-3" style="width: 20%;">Nama Pasien</th>
                <th class="py-3" style="width: 10%;">Dokter P.J</th>
                <th class="py-3" style="width: 10%;">Dokter Pengirim</th>
                <th class="py-3" style="width: 15%;">Alasan Masuk DiRawat</th>
                <th class="py-3" style="width: 15%;">Keluhan Utama</th>
                <th class="py-3" style="width: 15%;">Keluhan Awal</th>
                <th colspan='2' class="py-6 text-center" style="width: 10%;">Action</th>
            </tr>
        </thead>
        <tbody data-jml="">
            @if(!empty($dataList))
                @foreach($dataList as $item)
                    <?php
                        $kode=$item_pasien->no_fr.'@'.$item->no_rawat.'@'.$item->no_rkm_medis.'@'.$item->kodes;
                        if(!empty($item->id_resume_ranap)){
                            $kode.='@'.$item->id_resume_ranap;
                        }
                        $check_akses=(new \App\Http\Traits\GlobalFunction)->check_akses($item->kd_dokter);
                        if( (new \App\Http\Traits\AuthFunction)->checkAkses('isi-resume/fullAkses') ){
                            $check_akses=1;
                        }

                        $link_param_copy = [
                            'no_rm' => (!empty($item->no_rkm_medis) ? $item->no_rkm_medis : ''),
                            'no_rawat' => (!empty($item->no_rawat) ? $item->no_rawat : ''),
                            'fr' => $item_pasien->no_fr,
                            'cdata'=>$item->kodes,
                            'cid_resume'=>!empty($item->id_resume_ranap) ? $item->id_resume_ranap : '',
                        ];

                        $url_target_copy=(new \App\Http\Traits\GlobalFunction)->generateLink($link_param_copy,url('isi-resume'));
                    ?>
                    <tr>
                        <td class="py-3 px-0">{{ !empty($item->tgl_registrasi) ? $item->tgl_registrasi : '' }}</td>
                        <td class="py-3">{{ !empty($item->no_rawat) ? $item->no_rawat : '' }}</td>
                        <td class="py-3">{{ !empty($item->no_rkm_medis) ? $item->no_rkm_medis : '' }} {{ !empty($item->nm_pasien) ? $item->nm_pasien : '' }}</td>
                        <td class="py-3">{{ !empty($item->nm_dokter) ? $item->nm_dokter : '' }}</td>
                        <td class="py-3">{{ !empty($item->pengirim) ? $item->pengirim : '' }}</td>
                        <td class="py-3">{{ !empty($item->alasan) ? $item->alasan : '' }}</td>
                        <td class="py-3">{{ !empty($item->keluhan_utama) ? $item->keluhan_utama : '' }}</td>
                        <td class="py-3">{{ !empty($item->diagnosa_utama) ? $item->diagnosa_utama : '' }}</td>

                        <td style="width: 30px;">
                            <a href="{{ $url_target_copy }}" class="btn btn-primary">
                                <i class='fa-solid fa-clone'></i><span>Salin</span>
                            </a>
                        </td>
                        <td class="py-3">
                            <a href="{{ url('isi-resume/view') }}" class='btn btn-info modal-remote' style='color:#fff' data-modal-key='{{ $kode }}' data-modal-title='View Resume'>
                                <i class='fa-solid fa-info-circle'></i>
                            </a>
                            @if($check_akses)
                                <a href="{{ url('isi-resume/form_update?data_sent='.$kode) }}" class='btn btn-warning'>
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <a href="{{ url('isi-resume/delete') }}" class='btn btn-danger modal-remote-delete' data-modal-key='{{ $kode }}' data-confirm-message="Apakah anda yakin menghapus data ini ?" >
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>