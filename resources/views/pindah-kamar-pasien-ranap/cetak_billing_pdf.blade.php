@php
    $data_pindahan = !empty($bill_tagihan_ranap['data_pindahan'])? (object)$bill_tagihan_ranap['data_pindahan'] : (object)[];
    $data_settings = !empty($bill_tagihan_ranap['data_settings']) ? (object)$bill_tagihan_ranap['data_settings'] : (object)[];
    // dd($data_pindahan);
@endphp
<div style="text-align:center;font-weight:100" cellspacing="0">
    <h4>RSUD KABUPATEN ACEH TAMIANG</h4>
    <h4>KWITANSI BIAYA PELAYANAN KESEHATAN RAWAT INAP</h4>
</div>
<table cellpadding="4" style="border:1px solid black">
    
    <tr>
        <td width="50%"><table cellpadding="2">
                <tr>
                    <td width="40%">NO MEDRECK</td>
                    <td width="5%">:</td>
                    <td width="55%">{{!empty($data_pindahan->no_rkm_medis) ? $data_pindahan->no_rkm_medis : ''}}</td>
                </tr>
                <tr>
                    <td width="40%">NAMA</td>
                    <td width="5%">:</td>
                    <td width="55%">{{!empty($data_pindahan->nm_pasien) ? $data_pindahan->nm_pasien : ''}}</td>
                </tr>
                <tr>
                    <td width="40%">ALAMAT</td>
                    <td width="5%">:</td>
                    <td width="55%">{{!empty($data_pindahan->alamat) ? $data_pindahan->alamat : ''}}</td>
                </tr>
                <tr>
                    <td width="40%">TGL. MASUK</td>
                    <td width="5%">:</td>
                    <td width="55%">{{!empty($data_pindahan->waktu_masuk) ? $data_pindahan->waktu_masuk : ''}}</td>
                </tr>
                <tr>
                    <td width="40%">TGL. KELUAR</td>
                    <td width="5%">:</td>
                    <td width="55%">{{!empty($data_pindahan->waktu_keluar) ? $data_pindahan->waktu_keluar : ''}}</td>
                </tr>
            </table>
        </td>
        <td width="50%"><table cellpadding="2">
                <tr>
                    <td width="40%">KELOMPOK PASIEN</td>
                    <td width="5%">:</td>
                    <td width="55%">{{!empty($data_pindahan->png_jawab) ? $data_pindahan->png_jawab : ''}}</td>
                </tr>
                <tr>
                    <td width="40%">RUANGAN</td>
                    <td width="5%">:</td>
                    <td width="55%">{{!empty($data_pindahan->kd_kamar_pindah) ? $data_pindahan->kd_kamar_pindah : '' }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <hr>
    <br><br>
    <tr>
        <td height="70" width="40%">SELISIH KAMAR</td>
        <td width="10%" style="text-align:right">{{!empty($data_pindahan->lama_inap) ? $data_pindahan->lama_inap : ''}} HARI </td>
        <td width="10%" style="text-align:right">X</td>
        @php
            $selisih_tarif = abs((int)$data_pindahan->trf_kamar_pindah - (int)$data_pindahan->trf_kamar_awal);
        @endphp
        <td width="20%" style="text-align:right">Rp. {{(!empty($data_pindahan->trf_kamar_pindah) && !empty($data_pindahan->trf_kamar_awal)) ? number_format($selisih_tarif,0,'','.')  : ''}}</td>
        <td width="20%" style="text-align:right">Rp. {{number_format((int)$data_pindahan->lama_inap * $selisih_tarif,0,'','.')}}</td>
    </tr>
    <hr>
    <tr>
        <td width="40%" height="20">TOTAL</td>
        <td width="60%" style="text-align:right">Rp. {{number_format((int)$data_pindahan->lama_inap * $selisih_tarif,0,'','.')}}</td>
    </tr>
    <br><br>
    <br><br>
    <tr>
        <td width="50%"><table cellpadding="2">
                <tr>
                    <td width="40%">KET RANGKAP</td>
                </tr>
                <tr>
                    <td width="40%">RANGKAP I</td>
                    <td width="5%">:</td>
                    <td width="55%">PASIEN</td>
                </tr>
                <tr>
                    <td width="40%">RANGKAP II</td>
                    <td width="5%">:</td>
                    <td width="55%">PERAWAT</td>
                </tr>
                <tr>
                    <td width="40%">RANGKAP III</td>
                    <td width="5%">:</td>
                    <td width="55%">KASIR</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
        <td width="40%"><table  cellpadding="2">
            @php
                setlocale(LC_ALL, 'IND');
            @endphp
            <tr><td align="center">{{strtoupper($data_settings->kabupaten.' '.strftime('%d %B %Y'))}} </td></tr>
            <tr><td></td></tr>
            <tr ><td></td></tr>
            <tr><td align="center">{{"..................................."}}</td></tr>
        </table>
        </td>
    </tr>
</table>