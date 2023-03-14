@foreach($data_antrian as $item)
<?php $item = (array)$item; ?>
<tr>
    <td class="py-3 ps-4"><span>{{ $item["no_rawat"] }}</span> <span class="p-2" id="p-{{$item['no_resep']}}-nm_pasien" contenteditable="true">{{ ucwords(strtolower($item["nm_pasien"])) }}</span></td>
    <td id="p-{{$item['no_resep']}}-from" class="py-3">{{ $item["nm_poli"] }}</td>
    <td class="py-3">{{ $item["nm_dokter"] }}</td>
    <td class="py-3">{{ $item["no_resep"] }}</td>
    <td class="py-3">{{ $item["tgl_perawatan"] }}</td>
    <td class="py-3">
        <select id="p-{{$item['no_resep']}}-konter_no" class="form-select" aria-label="Default select example">
            <option {{count($konters) > 1 ? 'selected': ''}}>Pilih No</option>
            @foreach($konters as $konter)
            <option {{count($konters) > 1 ? '': 'selected'}} value="{{$konter['konter_no']}}">{{$konter['konter_no']}}</option>
            @endforeach
        </select>
    </td>
    <td class="py-3 pe-4 text-primary" style="text-align: center;">
            <button id="speak" type="button" class="btn btn-primary" onclick="getPasien('p-{{$item['no_resep']}}')">
            Panggil
            </button>
            <button id="cancel_speak" type="button" class="btn btn-danger d-none" onclick="stopSpeak('p-{{$item['no_resep']}}')">
                Stop
            </button>
    </td>
    <td class="py-3 pe-4 text-primary" style="text-align: center;">
        <button type="button" onclick='PenyerahanResep(<?=json_encode($item)?>)' class="btn btn-success buttonModalPenyerahan">
            Penyerahan
        </button>
    </td>
</tr>
@endforeach