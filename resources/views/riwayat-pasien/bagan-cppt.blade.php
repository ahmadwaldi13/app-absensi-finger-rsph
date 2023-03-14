@if(!empty($model))
    <?php 
        $judul='Pemeriksaan Rawat Jalan';
        if(!empty($type_akses)){
            if($type_akses=='ri'){
                $judul='Pemeriksaan Rawat Inap';
            }
        }
    ?>
    <tr class='isi'>
        <td valign='top' width='2%'></td>
        <td valign='top' width='18%'>{{ $judul }}</td>
        <td valign='top' width='1%' align='center'>:</td>
        <td valign='top' width='79%'>
            <table width='100%' border='1' align='center' cellpadding='3px' cellspacing='0' class='tbl_form table table-bordered'>
                <tr align='center'>
                    <td valign='top' width='4%' bgcolor='#FFF7F3'>No.</td>
                    <td valign='top' width='15%' bgcolor='#FFF7F3'>Tanggal</td>
                    <td valign='top' width='54%' bgcolor='#FFF7F3' colspan='6'>Dokter/Paramedis</td>
                    <td valign='top' width='27%' bgcolor='#FFF7F3' colspan='3'>Profesi/Jabatan/Departemen</td>
                </tr>

                @foreach ($model as $index => $item)
                    <tr>
                        <td valign='top' align='center'>{{ $index+1 }}</td>
                        <td valign='top'>{{ !empty($item->tgl_perawatan) ? $item->tgl_perawatan : '' }} {{ !empty($item->jam_rawat) ? $item->jam_rawat : '' }}</td>
                        <td valign='top' colspan='6'>{{ !empty($item->nip) ? $item->nip : '' }} {{ !empty($item->nama) ? $item->nama : '' }}</td>
                        <td valign='top' colspan='3'>{{ !empty($item->jbtn) ? $item->jbtn : '' }}</td>
                    </tr>

                    <tr>
                        <td valign='top' align='center'></td>
                        <td valign='top' align='center'></td>
                        <td valign='top' colspan='2'>Subjek</td>
                        <td valign='top' colspan='7'> : {{ !empty($item->keluhan) ? $item->keluhan : '' }}</td>
                    </tr>
                    
                    <tr>
                        <td valign='top' align='center'></td>
                        <td valign='top' align='center'></td>
                        <td valign='top' colspan='2'>Objek</td>
                        <td valign='top' colspan='7'> : {!! !empty($item->pemeriksaan) ? str_replace("\n","<br/>",$item->pemeriksaan) : '' !!}</td>
                    </tr>
                    <tr>
                        <td valign='top' align='center'></td>
                        <td valign='top' align='center'></td>
                        <td valign='top' width='9%' bgcolor='#FFF7F3' align='center'>Suhu(C)</td>
                        <td valign='top' width='9%' bgcolor='#FFF7F3' align='center'>Tensi</td>
                        <td valign='top' width='9%' bgcolor='#FFF7F3' align='center'>Nadi(/menit)</td>
                        <td valign='top' width='9%' bgcolor='#FFF7F3' align='center'>Respirasi(/menit)</td>
                        <td valign='top' width='9%' bgcolor='#FFF7F3' align='center'>Tinggi(Cm)</td>
                        <td valign='top' width='9%' bgcolor='#FFF7F3' align='center'>Berat(Kg)</td>
                        <td valign='top' width='9%' bgcolor='#FFF7F3' align='center'>SpO2(%)</td>
                        <td valign='top' width='9%' bgcolor='#FFF7F3' align='center'>GCS(E,V,M)</td>
                        <td valign='top' width='9%' bgcolor='#FFF7F3' align='center'>Kesadaran</td>
                    </tr>

                    <tr>
                        <td valign='top' align='center'></td>
                        <td valign='top'></td>
                        <td valign='top' align='center'>{{ !empty($item->suhu_tubuh) ? $item->suhu_tubuh : '' }}</td>
                        <td valign='top' align='center'>{{ !empty($item->tensi) ? $item->tensi : '' }}</td>
                        <td valign='top' align='center'>{{ !empty($item->nadi) ? $item->nadi : '' }}</td>
                        <td valign='top' align='center'>{{ !empty($item->respirasi) ? $item->respirasi : '' }}</td>
                        <td valign='top' align='center'>{{ !empty($item->tinggi) ? $item->tinggi : '' }}</td>
                        <td valign='top' align='center'>{{ !empty($item->berat) ? $item->berat : '' }}</td>
                        <td valign='top' align='center'>{{ !empty($item->spo2) ? $item->spo2 : '' }}</td>
                        <td valign='top' align='center'>{{ !empty($item->gcs) ? $item->gcs : '' }}</td>
                        <td valign='top' align='center'>{{ !empty($item->kesadaran) ? $item->kesadaran : '' }}</td>
                    </tr>
                    
                    <tr>
                        <td valign='top' align='center'></td>
                        <td valign='top' align='center'></td>
                        <td valign='top' colspan='2'>Alergi</td>
                        <td valign='top' colspan='7'> : {{ !empty($item->alergi) ? $item->alergi : '' }}</td>
                    </tr>
                    
                    <tr>
                        <td valign='top' align='center'></td>
                        <td valign='top' align='center'></td>
                        <td valign='top' colspan='2'>Asesmen</td>
                        <td valign='top' colspan='7'> : {{ !empty($item->penilaian) ? $item->penilaian : '' }}</td>
                    </tr>
                    
                    <tr>
                        <td valign='top' align='center'></td>
                        <td valign='top' align='center'></td>
                        <td valign='top' colspan='2'>Plan</td>
                        <td valign='top' colspan='7'> : {{ !empty($item->rtl) ? $item->rtl : '' }}</td>
                    </tr>
                    
                    <tr>
                        <td valign='top' align='center'></td>
                        <td valign='top' align='center'></td>
                        <td valign='top' colspan='2'>Instruksi</td>
                        <td valign='top' colspan='7'> : {{ !empty($item->instruksi) ? $item->instruksi : '' }}</td>
                    </tr>

                    <tr>
                        <td valign='top' align='center'></td>
                        <td valign='top' align='center'></td>
                        <td valign='top' colspan='2'>Evaluasi</td>
                        <td valign='top' colspan='7'> : {{ !empty($item->evaluasi) ? $item->evaluasi : '' }}</td>
                    </tr>
                    <tr>
                        <td valign='top' colspan='11'></td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
@endif