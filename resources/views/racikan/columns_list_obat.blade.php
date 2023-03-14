<?php 
    $data_racikan=json_decode($data_racikan);
    $list_obat_prev=!empty($data_racikan->list_obat) ? $data_racikan->list_obat : '';
    $data_list_obat_old=[];
    
    if($list_obat_prev){
        $list_obat_prev=json_decode($list_obat_prev);
        if(!empty($list_obat_prev)){
            foreach($list_obat_prev as $key=>$value){
                $data_list_obat_old[$value->kode_barang]=$value;
            }
        }
    }
?>
<div id='bagan_form_modal'>
    <div style="overflow-x: auto; max-width: auto;" class="border mb-5">
        <table class="table border table-responsive-tablet">
            <thead>
                <tr>
                    <th class="py-4">Nama Racikan</th>
                    <th class="py-4">Metode Racikan</th>
                    <th class="py-4">Jumlah</th>
                    <th class="py-4">Aturan Pakai</th>
                    <th class="py-4">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ !empty($data_racikan->nm_racik) ? $data_racikan->nm_racik : '' }}</td>
                    <td>{{ !empty($data_racikan->metode_racik) ? $data_racikan->metode_racik : '' }}</td>
                    <td>
                        <input type="number" step="any" id='m_jml_racikan' class="form-control" required value="{{ !empty($data_racikan->jlh_racik) ? $data_racikan->jlh_racik : '' }}">
                        <input type="hidden" id='key_form' value="{{ !empty($data_racikan->key_form) ? $data_racikan->key_form : '' }}">
                    </td>
                    <td>{{ !empty($data_racikan->aturan_pakai) ? $data_racikan->aturan_pakai : '' }}</td>
                    <td>{{ !empty($data_racikan->keterengan) ? $data_racikan->keterengan : '' }}</td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="row justify-content-start align-items-end mb-3">
        <div class="col-lg-4 col-md-10 mb-3">
            <label for="pencarianPermintaan" class="form-label">Cari Obat</label>
            <input type="text" class="form-control search-data-table-2"  placeholder="Masukkan kata yang akan dicari">
        </div>
    </div>

    <table class="table data-table-2 border" id='m_table_obat' >
        <thead>
            <tr>
                <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Kode Barang/Nama Barang</th>
                <th rowspan="2" class="py-2 text-center" style='vertical-align: middle'>Satuan</th>
                <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Harga(Rp)</th>
                <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Jenis/Komposisi</th>
                <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Stok</th>
                <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Kapasitas</th>
                <th colspan="3" class="py-3 text-center">P1/P2</th>
                <th rowspan="2" class="py-3 text-center" style='vertical-align: middle'>Kandungan</th>
                <th rowspan="2" class="py-2 text-center" style="width: 15px !important; vertical-align: middle">Jumlah <span class="text-danger">*</span></th>
            </tr>
            <tr>
                <th class="py-3 text-center" style="width: 15px !important">P1</th>
                <th></th>
                <th class="py-3 text-center" style="width: 15px !important">P2</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($list_barang))
                @foreach($list_barang as $key => $item)
                    <?php 
                        $harga=!empty($item->h_beli) ? $item->h_beli  : 0;
                        $stok=!empty($item->stok) ? $item->stok  : 0;
                        $kapasitas=!empty($item->kapasitas) ? $item->kapasitas  : 0;

                        $get_data=[
                            'kode_barang'=>!empty($item->kode_brng) ? $item->kode_brng : '',
                            'nm_barang'=>!empty($item->nama_brng) ? $item->nama_brng : '',
                            'satuan'=>!empty($item->kode_sat) ? $item->kode_sat : '',
                            'harga'=>(new \App\Http\Traits\GlobalFunction)->formatMoney($harga),
                            'harga_real'=>$harga,
                            'jenis_obat'=>!empty($item->nama) ? $item->nama : '',
                            'stok'=>$stok,
                            'kapasitas'=>$kapasitas
                        ];

                        $get_data=json_encode($get_data);
                        $list_obat='';
                        $stok_sisa=$stok;
                        if(!empty($data_list_obat_old[$item->kode_brng])){
                            $list_obat=$data_list_obat_old[$item->kode_brng];
                            $stok_sisa=$stok-$list_obat->jlh_obat;
                        }
                    ?>
                    <tr class='m_tr_obat' data-key='{{ $get_data }}' >
                        <td>{{ !empty($item->kode_brng) ? $item->kode_brng : '' }} {{ !empty($item->nama_brng) ? $item->nama_brng : '' }}</td>
                        <td>{{ !empty($item->kode_sat) ? $item->kode_sat : '' }}</td>
                        <td>{{ (new \App\Http\Traits\GlobalFunction)->formatMoney($harga) }}</td>
                        <td>{{ !empty($item->nama) ? $item->nama : '' }}<br>( {{ !empty($item->letak_barang) ? $item->letak_barang : '' }} )</td>
                        <td class='m_text_stok'>
                            <span>{{ $stok }}</span>
                            <input type="hidden" class='m_jlh_stok' value='{{ $stok }}'>
                        </td>
                        <td class='m_text_kapasitas'>
                            <span>{{ $kapasitas }}</span>
                            <input type="hidden" class='m_jlh_kapasitas' value='{{ $kapasitas }}'>
                        </td>
                        <td style="width: 15px">
                            <input type="number" step="any" style="width: 100px" class="form-control c_jlh_p1 m_jlh_p1" value='{{ !empty($list_obat->p1) ? $list_obat->p1 : 1 }}'>
                        </td>
                        <td>/</td>
                        <td style="width: 15px">
                            <input type="number" step="any" style="width: 100px" class="form-control c_jlh_p2 m_jlh_p2" value='{{ !empty($list_obat->p2) ? $list_obat->p2 : 1 }}'>
                        </td>
                        <td>
                            <input type="text" style="width: 200px" maxlength="10" class="form-control c_kandungan m_kandungan" value='{{ !empty($list_obat->kandungan) ? $list_obat->kandungan : "" }}'>
                        </td>
                        <td style="width: 15px">
                            <input type="number" step="any" style="width: 100px" class="form-control c_jlh_obat m_jlh_obat" value='{{ !empty($list_obat->jlh_obat) ? $list_obat->jlh_obat : 0 }}'>
                            <input type="hidden" class='m_sisa_stok' value='{{ !empty($stok_sisa) ? $stok_sisa : 0 }}'>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div>
        <a href='#' class='btn btn-info' id='pilih-obat-selesai' style='color:#383838; font-size:20px'><span> Selesai Pilih</span></a>
    </div>
</div>