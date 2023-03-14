@php
    $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
@endphp
    <table cellspacing="0" cellpadding="1">
        <tbody>
            <tr>
                <td width="20%">No. RM</td> 
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->no_rkm_medis) ? $dataPasien->no_rkm_medis : "" }} </td>  
            </tr>
            <tr>
                <td width="20%">No Rawat</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($no_rawat) ? $no_rawat : "" }} </td>
            </tr>
            <tr>
                <td width="20%">Nama Pasien</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->nm_pasien) ? $dataPasien->nm_pasien : "" }} </td>
            </tr>
            <tr>
                <td width="20%">Alamat</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->alamat) ? $dataPasien->alamat : "" }} </td>
            </tr>
            <tr>
                <td width="20%">Umur</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->umur) ? $dataPasien->umur : "" }} ({{$dataPasien->jk == 'L' ? 'Laki-Laki' : 'Perempuan'}})</td>
            </tr>
            <tr>
                <td width="20%">Tempat & Tanggal Lahir</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->tmp_lahir) ? $dataPasien->tmp_lahir : ""}} / {{ !empty($dataPasien->tgl_lahir) ? $dataPasien->tgl_lahir : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Ibu Kandung</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->nm_ibu) ? $dataPasien->nm_ibu : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Golongan Darah</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->gol_darah) ? $dataPasien->gol_darah : ""}} </td></tr>
            <tr>
                <td width="20%">Status Nikah</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->stts_nikah) ? $dataPasien->stts_nikah : ""}}</td>
            </tr>
            <tr>
                <td width="20%">Agama</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->agama) ? $dataPasien->agama : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Pendidikan Terakhir</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->pnd) ? $dataPasien->pnd : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Pertama Daftar</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->tgl_daftar) ? $dataPasien->tgl_daftar : ""}} </td>
            </tr>
            <tr>
                <td width="20%">No.Rawat</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($reg_periksa->no_rawat) ? $reg_periksa->no_rawat : ""}} </td>
            </tr>
            <tr>
                <td width="20%">No.Registrasi</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($reg_periksa->no_reg) ? $reg_periksa->no_reg : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Tanggal Registrasi</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($reg_periksa->tgl_registrasi) ? $reg_periksa->tgl_registrasi : ""}} {{ !empty($reg_periksa->jam_reg) ? $reg_periksa->jam_reg : ""}}</td>
            </tr>
            <tr>
                <td width="20%">Unit/Poliklinik</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($reg_periksa->nm_poli) ? $reg_periksa->nm_poli : ""}}, {{ !empty($rujukan_internal->nm_poli) ? $rujukan_internal->nm_poli : ""}}</td>
            </tr>
            <tr>
                <td width="20%">Dokter</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    @if(!empty($reg_periksa) && $reg_periksa->status_lanjut === 'Ralan')
                        {{!empty($reg_periksa->nm_dokter) ? $reg_periksa->nm_dokter : ""}} <br>
                        {{!empty($rujukan_internal->nm_dokter) ? $rujukan_internal->nm_dokter : ""}}
                    @else
                        tes
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>

    @php
        $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
    @endphp
    <table style="margin-top:20px" border="1" cellpadding="1">
        <thead >
            <tr align="center">
                <th><b>Tanggal Pemeriksaan</b></th>
                <th><b>Nama Dokter</b></th>
                <th><b>Subjek</b></th>
                <th><b>Objek</b></th>
                <th><b>Assessment</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataSoap as $item) 
            <tr>
                <td class="text-center">{{date('d-m-Y',strtotime($item->created_at))}}</td>
                <td>{{$item->nm_dokter}}</td>
                <td>{{$item->subjek}}</td>
                <td>{{$item->objek}}</td>
                <td>{{$item->assessment}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>