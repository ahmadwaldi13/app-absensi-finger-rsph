<div>
    <div class="row justify-content-start align-items-end">
        <div class="col-lg-3 mb-3">
            <label for="norawat" class="form-label">No.Rawat</label>
            <input type="text" class="form-control readonly" readonly id="norawat" value="{{ !empty($model->no_rawat) ? $model->no_rawat : '' }}">
        </div>
        <div class="col-lg-3 mb-3">
            <input type="text" class="form-control readonly" readonly id="name" value="{{ !empty($model->no_rkm_medis) ? $model->no_rkm_medis : '' }} {{ !empty($model->nm_pasien) ? $model->nm_pasien : '' }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="daterangereview" class="form-label">Jenis.Ans :</label>
            <input type="text" class="form-control readonly input-daterange" readonly value="{{ !empty($model->jenis_anasthesi) ? $model->jenis_anasthesi : '' }}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="daterangereview" class="form-label">Tgl. Operasi :</label>
            <input type="text" class="form-control readonly input-daterange" readonly value="{{ !empty($model->tgl_operasi) ? $model->tgl_operasi : '' }}">
        </div>
    </div>
    <hr class="mb-5">

    <div style="overflow-x: auto; max-width: auto;">
        <table class="table border table-responsive-tablet" style='background:#e9e9e9'>
            <thead>
                <tr>
                    <th class="py-3" style="width: 15%">Perawatan</th>
                    <th class="py-3" style="width: 15%">Operator 1</th>
                    <th class="py-3" style="width: 15%">Operator 2</th>
                    <th class="py-3" style="width: 15%">Operator 3</th>
                    <th class="py-3" style="width: 15%">Asisten <br> Operator 1</th>
                    <th class="py-3" style="width: 15%">Asisten <br> Operator 2</th>
                    <th class="py-3" style="width: 15%">Asisten <br> Operator 3</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list_data_operasi as $item_detail)
                    <tr>
                        <td>{{ !empty($item_detail->nm_perawatan) ? $item_detail->nm_perawatan : '-' }}</td>
                        <td>{{ !empty($item_detail->nm_operator1) ? $item_detail->nm_operator1 : '-' }}</td>
                        <td>{{ !empty($item_detail->nm_operator2) ? $item_detail->nm_operator2 : '-' }}</td>
                        <td>{{ !empty($item_detail->nm_operator3) ? $item_detail->nm_operator3 : '-' }}</td>
                        <td>{{ !empty($item_detail->nm_asisten_operator1) ? $item_detail->nm_asisten_operator1 : '-' }}</td>
                        <td>{{ !empty($item_detail->nm_asisten_operator2) ? $item_detail->nm_asisten_operator2 : '-' }}</td>
                        <td>{{ !empty($item_detail->nm_asisten_operator3) ? $item_detail->nm_asisten_operator3 : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr class="mb-5">

    <div style="overflow-x: auto; max-width: auto;">
        <table class="table border table-responsive-tablet">
            <tbody>
                <tr>
                    <td class='col-md-3'>Selesai Operasi</td>
                    <td>:</td>
                    <td class='col-md-9'>{{ !empty($data_laporan->selesaioperasi) ? $data_laporan->selesaioperasi : '' }}</td>
                </tr>
                <tr>
                    <td class='col-md-3'>Diagnosis pre-operatif</td>
                    <td>:</td>
                    <td class='col-md-9'>{{ !empty($data_laporan->diagnosa_preop) ? $data_laporan->diagnosa_preop : '' }}</td>
                </tr>
                <tr>
                    <td class='col-md-3'>Diagnosis post-operatif</td>
                    <td>:</td>
                    <td class='col-md-9'>{{ !empty($data_laporan->diagnosa_postop) ? $data_laporan->diagnosa_postop : '' }}</td>
                </tr>
                <tr>
                    <td class='col-md-3'>Jaringan di-Eksisi / -Insisi</td>
                    <td>:</td>
                    <td class='col-md-9'>{{ !empty($data_laporan->jaringan_dieksekusi) ? $data_laporan->jaringan_dieksekusi : '' }}</td>
                </tr>
                <tr>
                    <td class='col-md-3'>Dikirim Pemeriksaan PA</td>
                    <td>:</td>
                    <td class='col-md-9'>{{ !empty($data_laporan->permintaan_pa) ? $data_laporan->permintaan_pa : '' }}</td>
                </tr>
                <tr>
                    <td class='col-md-3'>Laporan</td>
                    <td>:</td>
                    <td class='col-md-9' style='white-space: pre-wrap'>{{ !empty($data_laporan->laporan_operasi) ? $data_laporan->laporan_operasi : '' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>