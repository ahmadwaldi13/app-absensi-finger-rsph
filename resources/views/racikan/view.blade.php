<div class="container">
    <div class="row justify-content-start align-items-start">
        <div class="col-lg-6">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-start border-0 px-0" style="width: 200px;">No Resep</li>
                <li class="list-group-item text-start border-0">: {{ !empty( $model->no_resep ) ? $model->no_resep : '' }}</li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-start border-0 px-0" style="width: 200px;">Tgl Resep</li>
                <li class="list-group-item text-start border-0">: {{ !empty( $model->tgl_peresepan ) ? $model->tgl_peresepan : '' }} {{ !empty( $model->jam_peresepan ) ? $model->jam_peresepan : '' }}</li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-start border-0 px-0" style="width: 200px;">Poli/Unit</li>
                <li class="list-group-item text-start border-0">: {{ !empty( $model->nm_poli ) ? $model->nm_poli : '' }}</li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-start border-0 px-0" style="width: 200px;">Pasien</li>
                <li class="list-group-item text-start border-0">: {{ !empty( $model->no_rawat ) ? $model->no_rawat : '' }} {{ !empty( $model->no_rkm_medis ) ? $model->no_rkm_medis : '' }} <br> {{ !empty( $model->nm_pasien ) ? $model->nm_pasien : '' }} <br> ( {{ !empty( $model->png_jawab ) ? $model->png_jawab : '' }} )</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-start border-0 px-0" style="width: 200px;">Dokter Peresep</li>
                <li class="list-group-item text-start border-0">: {{ !empty( $model->nm_dokter ) ? $model->nm_dokter : '' }}</li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-start border-0 px-0" style="width: 200px;">Status</li>
                <li class="list-group-item text-start border-0">: {{ !empty( $model->status ) ? $model->status : '' }}</li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-start border-0 px-0" style="width: 200px;">Tanggal & Jam Validasi</li>
                <li class="list-group-item text-start border-0">: {{ !empty( $model->tgl_perawatan ) ? $model->tgl_perawatan : '' }} {{ !empty( $model->jam ) ? $model->jam : '' }}</li>
            </ul>
            <ul class="list-group list-group-horizontal">
            <li class="list-group-item text-start border-0 px-0" style="width: 200px;">Tanggal & Jam Penyerahan</li>
                <li class="list-group-item text-start border-0">: {{ !empty( $model->tgl_penyerahan ) ? $model->tgl_penyerahan : '' }} {{ !empty( $model->jam_penyerahan ) ? $model->jam_penyerahan : '' }}</li>
            </ul>
        </div>
    </div>

    <div class="mt-3">
        <div style="overflow-x: auto; max-width: auto;">
            <table class="table border table-responsive-tablet">
                <thead>
                    <tr>
                        <th class="py-1" style="width: 5px">Nomor</th>
                        <th class="py-3" style="width: 20%">Jumlah</th>
                        <th class="py-3" style="width: 20%;">Kode Obat</th>
                        <th class="py-3" style="width: 20%;">Nama Obat</th>
                        <th class="py-3" style="width: 20%;">Aturan Pakai</th>
                        <th class="py-3" style="width: 20%;">Keterangan</th>
                    </tr>
                </thead>
                <tbody data-jml="">
                    @if( !empty($model->item_resep_racikan) )
                        @foreach($model->item_resep_racikan as $key => $item)
                            <tr style="background:#a8c7e5 ;">
                                <td class='text-center' style='vertical-align:middle'>{{ $key  }}</td>
                                <td>{{ !empty($item->jml_dr) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($item->jml_dr) : ''  }} {{ !empty($item->metode) ? $item->metode : ''  }}</td>
                                <td>No Racik : {{ !empty($item->no_racik) ? $item->no_racik : ''  }}</td>
                                <td>{{ !empty($item->nama_racik) ? $item->nama_racik : ''  }}</td>
                                <td>{{ !empty($item->aturan_pakai) ? $item->aturan_pakai : ''  }}</td>
                                <td>{{ !empty($item->keterangan) ? $item->keterangan : ''  }}</td>
                            <tr>
                            
                            @if( !empty($model->item_resep_racikan_detail[$key]) )
                                <?php $list_item=$model->item_resep_racikan_detail[$key]; ?>
                                @foreach($list_item as $key_detail => $item_detail)
                                    <tr style='background:#dedede;'>
                                        <td></td>
                                        <td style='vertical-align:middle'>{{ !empty($item_detail->jml) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($item_detail->jml) : ''  }} {{ !empty($item_detail->kode_sat) ? $item_detail->kode_sat : ''  }}</td>
                                        <td style='vertical-align:middle'>{{ !empty($item_detail->kode_brng) ? $item_detail->kode_brng : ''  }}</td>
                                        <td style='vertical-align:middle'>{{ !empty($item_detail->nama_brng) ? $item_detail->nama_brng : ''  }}</td>
                                        <td colspan='2'>
                                            <table width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 30%">P1/P2 :</td>
                                                        <td>{{ !empty($item_detail->p1) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($item_detail->p1) : ''  }}/{{ !empty($item_detail->p2) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($item_detail->p2) : ''  }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 30%">Kandungan :</td>
                                                        <td>{{ !empty($item_detail->kandungan) ? $item_detail->kandungan : ''  }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 30%">Jumlah :</td>
                                                        <td>{{ !empty($item_detail->jml) ? $item_detail->jml : ''  }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    <tr>
                                @endforeach
                            @endif


                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>