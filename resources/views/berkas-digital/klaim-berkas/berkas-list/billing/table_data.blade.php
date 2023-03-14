<table class="">
    @foreach($billing_data as $value)
    <?php
        $value = array_values((array)$value);
    ?>
    <tr class="isi12" padding="0">
        <td padding="0" width="18%">{{!empty($value[0]) ? $value[0] : ""}}</td>
        <td padding="0" width="40%">{{!empty($value[1]) ? $value[1] : ""}}</td>
        <td padding="0" width="2%">{{!empty($value[2]) ? $value[2] : ""}}</td>
        <td padding="0" width="10%" align="right">{{!empty($value[3]) ? $value[3] : ""}}</td>
        <td padding="0" width="5%" align="right">{{!empty($value[4]) ? $value[4] : ""}}</td>
        <td padding="0" width="10%" align="right">{{!empty($value[5]) ? $value[5] : ""}}</td>
        <td padding="0" width="15%" align="right">{{!empty($value[6]) ? $value[6] : ""}}</td>
    </tr>
    @endforeach
    <tr class="isi12" padding="0">
        <td padding="0" width="18%"><b>TOTAL BIAYA</b></td>
        <td padding="0" width="40%"><b>:</b></td>
        <td padding="0" width="2%"></td>
        <td padding="0" width="10%" align="right"></td>
        <td padding="0" width="5%" align="right"></td>
        <td padding="0" width="10%" align="right"></td>
        <td padding="0" width="15%" align="right"><b>{{!empty($total) ? $total : ""}}</b></td>
    </tr>
</table>