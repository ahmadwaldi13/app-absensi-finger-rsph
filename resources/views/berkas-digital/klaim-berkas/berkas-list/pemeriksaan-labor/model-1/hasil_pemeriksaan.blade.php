<table border="1" cellpadding="1">
    <thead>
        <tr align="center">
            <th><b>Pemeriksaan</b></th>
            <th><b>Hasil</b></th>
            <th><b>Satuan</b></th>
            <th><b>Nilai Rujukan</b></th>
            <th><b>Nilai Rujukan</b></th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($v))
            <?php 
                $rows = explode('|', $hasil_pemeriksaan_lab_pk->detail_pemeriksaan);
                $detail_pemeriksaan=[];
                foreach($rows as $key=> $val){
                    $columns = explode(',', $val);
                    foreach($columns as $keyb => $valb){
                        $detail_pemeriksaan[$key][$keyb] = $valb;
                    }
                }
            ?>
            @foreach($detail_pemeriksaan as $detail)
            <tr>
                <td>{{!empty($detail[0]) ? $detail[0] : ""}}</td>
                <td>{{!empty($detail[1]) ? $detail[1] : ""}}</td>
                <td>{{!empty($detail[2]) ? $detail[2] : ""}}</td>
                <td>{{!empty($detail[3]) ? $detail[3] : ""}}</td>
                <td>{{!empty($detail[4]) ? $detail[4] : ""}}</td>
            </tr>
            @endforeach                        
        @else
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        @endif
    </tbody>
</table>