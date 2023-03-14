@if(!empty($list_data))
    @foreach($list_data as $key => $item)
        <?php
            $paramater_url=[
                'data_sent'=>$item['no_rawat']
            ];
        ?>
        <tr>
            <td class="py-3">{{ (($list_data->currentPage() * 20) - 20) + $loop->iteration }}.</td>
            <td class="py-3">{{ $item["tgl_registrasi"] }}</td>
            <td class="py-3">{{ $item["no_reg"] }}
            </td>
            <td class="py-3"><span class="badge bg-primary">{{ $item["no_rkm_medis"] }}</span> <span class="badge" style="background-color: darkorange">{{ $item["no_rawat"] }}</span></td>
            <td class="py-3">{{ $item["nm_pasien"] }}</td>
            <td class="py-3">{{ $item["nm_poli"] }}</td>
            <td class="py-3">({{ $item["kd_dokter"] }}) {{$item["nm_dokter"]}}</td>
            <td class="py-3 pe-4">
                @if ($item->tindakan_pasien_perawat == 1)
                    <button type="button" name="delete" class="btn btn-danger buttonModalListMonitor" onclick='ListMonitor(<?=json_encode($item)?>)'><i class="fa-solid fa-volume-xmark"></i> Mute</button>
                @elseif($item->tindakan_pasien_perawat == 0)
                    <button type="button" class="btn btn-primary buttonModalListMonitor" onclick='ListMonitor(<?=json_encode($item)?>)'><i class="fa-solid fa-microphone"></i> Panggil</button>
                @endif
                    <a href='antrian-poliklinik-petugas/update' class='btn btn-success modal-remote-delete' data-modal-key='{{ $item["no_rawat"] }}' data-confirm-message="Terima Berkas pasien? dan langsung diperiksa petugas"><i class="fa-solid fa-check"></i> Hadir</a>
            </td>
        </tr>
    @endforeach
@endif