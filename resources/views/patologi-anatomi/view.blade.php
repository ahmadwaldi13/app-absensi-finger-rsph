@if( !empty($model) )
    <?php 
        $tgl_sampel=!empty($model->tgl_sampel) ? $model->tgl_sampel : '';
        $tgl_sampel=($tgl_sampel=='0000-00-00') ? '' : $tgl_sampel;

        $tgl_hasil=!empty($model->tgl_hasil) ? $model->tgl_hasil : '';
        $tgl_hasil=($tgl_hasil=='0000-00-00') ? '' : $tgl_hasil;

        $custome_1='';
        if($type_akses=='ri'){
            $custome_1=!empty($model->nm_bangsal) ? $model->nm_bangsal : '';
        }else{
            $custome_1=!empty($model->nm_poli) ? $model->nm_poli : '';
        }
        $item=!empty($list_pp_lab) ? $list_pp_lab : [];
    ?>
@endif

<div class="mt-3">
    <div style="overflow-x: auto; max-width: auto;">
        <table class="table border table-responsive-tablet">
            <thead>
                <tr>
                    <th class="py-3 border" >Nomor Permintaan</th>
                    <th class="py-3 border" >Nomor Rawat</th>
                    <th class="py-3 border" >Pasien</th>
                    <th class="py-3 border" >Permintaan</th>
                    <th class="py-3 border" >Jam</th>
                    <th class="py-3 border" >Sampel</th>
                    <th class="py-3 border" >Jam</th>
                    <th class="py-3 border" >Hasil</th>
                    <th class="py-3 border" >Jam</th>
                    
                    <th class="py-3 border" >Dokter Perujuk</th>
                    @if($type_akses=='ri')
                        <th class="py-3 border" >Kamar Terakhir</th>
                    @else
                        <th class="py-3 border" >Poli Registrasi</th>
                    @endif
                    <th class="py-3 border" >Informasi Tambahan</th>
                    <th class="py-3 border" >Diagnosis Klinis</th>
                    <th class="py-3 border" >Jenis Bayar</th>
                    <th class="py-3 border" >Tgl.Bahan</th>
                    <th class="py-3 border" >Diperoleh Dengan</th>
                    <th class="py-3 border" >Lokasi Jaringan</th>
                    <th class="py-3 border" >Diawetkan Dengan</th>
                    <th class="py-3 border" >Pernah Dilakukan PA Di</th>
                    <th class="py-3 border" >Pada Tanggal</th>
                    <th class="py-3 border" >Dengan Nomor PA</th>
                    <th class="py-3 border" >Dengan Diagnosa PA</th>
                </tr>
            </thead>
            <tbody data-jml="">
                @if( !empty($model) )
                    <tr>
                        <td class="border">{{ !empty($model->noorder) ? $model->noorder : ''  }}</td>
                        <td class="border">{{ !empty($model->no_rawat) ? $model->no_rawat : ''  }}</td>
                        <td class="border">{{ !empty($model->nm_pasien) ? $model->nm_pasien : ''  }}</td>
                        <td class="border">{{ !empty($model->tgl_permintaan) ? $model->tgl_permintaan : ''  }}</td>
                        <td class="border">{{ !empty($model->jam_permintaan) ? $model->jam_permintaan : ''  }}</td>
                        <td class="border">{{ $tgl_sampel  }}</td>
                        <td class="border">{{ !empty($model->jam_sampel) ? $model->jam_sampel : ''  }}</td>
                        <td class="border">{{ $tgl_hasil  }}</td>
                        <td class="border">{{ !empty($model->jam_hasil) ? $model->jam_hasil : ''  }}</td>
                        <td class="border">{{ !empty($model->nm_dokter) ? $model->nm_dokter : ''  }}</td>
                        <td class="border">{{ $custome_1  }}</td>
                        <td class="border">{{ !empty($model->informasi_tambahan) ? $model->informasi_tambahan : ''  }}</td>
                        <td class="border">{{ !empty($model->diagnosa_klinis) ? $model->diagnosa_klinis : ''  }}</td>
                        <td class="border">{{ !empty($model->png_jawab) ? $model->png_jawab : ''  }}</td>
                        <td class="border">{{ !empty($model->pengambilan_bahan) ? $model->pengambilan_bahan : ''  }}</td>
                        <td class="border">{{ !empty($model->diperoleh_dengan) ? $model->diperoleh_dengan : ''  }}</td>
                        <td class="border">{{ !empty($model->lokasi_jaringan) ? $model->lokasi_jaringan : ''  }}</td>
                        <td class="border">{{ !empty($model->diawetkan_dengan) ? $model->diawetkan_dengan : ''  }}</td>
                        <td class="border">{{ !empty($model->pernah_dilakukan_di) ? $model->pernah_dilakukan_di : ''  }}</td>
                        <td class="border">{{ !empty($model->tanggal_pa_sebelumnya) ? $model->tanggal_pa_sebelumnya : ''  }}</td>
                        <td class="border">{{ !empty($model->nomor_pa_sebelumnya) ? $model->nomor_pa_sebelumnya : ''  }}</td>
                        <td class="border">{{ !empty($model->diagnosa_pa_sebelumnya) ? $model->diagnosa_pa_sebelumnya : ''  }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@if(!empty($item))
    <div class="mt-3">
        <div style="overflow-x: auto; max-width: auto;">
            <legend>List Permintaan</legend>
            <table class="table border table-responsive-tablet">
                <tbody data-jml="">
                    @foreach($item as $key => $value)
                        <tr>
                            <td class="py-3 border" >{{ !empty($value->kd_jenis_prw) ? $value->kd_jenis_prw : ''  }}</td>
                            <td class="py-3 border" >{{ !empty($value->nm_perawatan) ? $value->nm_perawatan : ''  }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif