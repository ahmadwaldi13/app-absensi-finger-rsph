<section id="billing">
@include('berkas-digital.klaim-berkas.berkas-kop')
<div class="section-header">
    <p class="font-lg">Billing</p>
</div>

<div class="section-body">
    @include("berkas-digital.klaim-berkas.berkas-list.billing.table_data")
</div>
<div class="section-footer">
    <table class="table_equal_column_half page-break-inside-avoid">
        <tr>
            <td>
                Keluarga Pasien
            </td>
            <td>
                Kasir
            </td>
        </tr>
        <tr>
            <td>
                @php
                    if($billing_data->count() > 0){
                        $matches = array();
                        preg_match('/:(.*)\(/', $billing_data[4]->nm_perawatan, $matches);
                        $name = $matches[1]; 
                    }
                @endphp
                <div class="qrCode" >
                    <?php $text = "Nama Pasien: ".(isset($name) ? $name : "");?>
                    <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                </div>
            </td>
            <td>
                <div class="qrCode">
                    <?php $text = "Kasir: KASIR $settings->nama_instansi";?>
                    <img src="data:image/svg+xml;base64,{{base64_encode(qrcode($text))}}"  width="100" height="100" />
                </div>
            </td>
        </tr>
    </table>
</div>

</section>