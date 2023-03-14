
<table width="100%" height=""  align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td  align="center" rowspan="4" width="10%">
            <img src="data:image/jpeg;base64,{{(!empty($settings->logo) ? $settings->logo : '')}}"  width="100" height="100" />
        </td>
        <td valign="middle" width="80%" align="center" style="font-size:xx-large;font-weight:bold;">
            {{(!empty($settings->nama_instansi) ? $settings->nama_instansi : '')}}
        </td>
        <td rowspan="4" width="10%"></td>
    </tr>
    <tr>
        <td width="80%" align="center" style="font-size:small;">
            {{(!empty($settings->alamat_instansi) ? $settings->alamat_instansi : '')}} {{(!empty($settings->kabupaten) ? $settings->kabupaten : '')}} {{(!empty($settings->propinsi) ? $settings->propinsi : '')}}
        </td>
    </tr>
    <tr>
        <td width="80%" align="center" style="font-size:small;">
            {{(!empty($settings->kontak) ? $settings->kontak : '')}}
        </td>

    </tr>
    <tr>
        <td width="80%" align="center "style="font-size:small;">E-mail : {{(!empty($settings->email) ? $settings->email : '')}}</td>
    </tr>

</table>
<hr>