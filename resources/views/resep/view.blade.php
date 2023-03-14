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
                        <th class="py-3" style="width: 20%">Jumlah</th>
                        <th class="py-3" style="width: 20%;">Kode Obat</th>
                        <th class="py-3" style="width: 20%;">Nama Obat</th>
                        <th class="py-3" style="width: 40%;">Aturan Pakai</th>
                    </tr>
                </thead>
                <tbody data-jml="">
                    @if( !empty($model->item_obat) )
                        @foreach($model->item_obat as $key => $item)
                            <tr>
                                <td>{{ !empty($item->jml) ? (new \App\Http\Traits\GlobalFunction)->formatMoney($item->jml) : ''  }} {{ !empty($item->kode_sat) ? $item->kode_sat : ''  }}</td>
                                <td>{{ !empty($item->kode_brng) ? $item->kode_brng : ''  }}</td>
                                <td>{{ !empty($item->nama_brng) ? $item->nama_brng : ''  }}</td>
                                <td>{{ !empty($item->aturan_pakai) ? $item->aturan_pakai : ''  }}</td>
                            <tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>