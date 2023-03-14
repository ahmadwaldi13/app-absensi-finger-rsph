<hr class="mb-5">
<div class='bagan-data-table-3'>
    <input type="hidden" id="count_data" value="{{ !empty($list_data) ? 1 : 0  }}"  >
    <input type="hidden" id="periksa_sub" name="periksa_sub" value=""  >
    <div class="row justify-content-start align-items-end">
        <div class="col-lg-7 col-md-10">
            <label for="cari_keyword" class="form-label">Pencarian Sub Permintaan</label>
            <input type="text" class="form-control search-data-table-3" id="cari_keyword" placeholder="Masukkan Kata">
        </div>
    </div>

    <table class="table border table-responsive-tablet data-table-3">
        <thead>
            <tr>
                <th></th>
                <th scope="col" class="w-40">Pemeriksaan</th>
                <th scope="col" class="w-5">Satuan</th>
                <th scope="col" class="w-10">Nilai Rujukan</th>
            </tr>
        </thead>
        <tbody id="data-pemeriksaan">
            @if(!empty($list_data_header))
                @foreach($list_data_header as $key_h => $item_h)
                    <?php
                        $me_item=[];
                        if(!empty($list_data[$key_h])){
                            $me_item=$list_data[$key_h];
                        }
                    ?>
                    @if(!empty($me_item))
                        <tr style='background:#ccc'>
                            <td></td>
                            <td>{{ trim($item_h) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($me_item as $key => $item)
                            <?php
                                $kode=$key_h.'$'.$item->id_template;
                            ?>
                            <tr style='background:#9dfbf3'>
                                <td>
                                    <input type="checkbox" class="form-check-input hover-pointer childCheckList" value="{{ $kode }}" style="border-radius: 0px;">
                                </td>
                                <td>{{ trim($item->Pemeriksaan) }}</td>
                                <td>{{ trim($item->satuan) }}</td>
                                <td>{{ trim($item->nilai_rujukan_ld) }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>