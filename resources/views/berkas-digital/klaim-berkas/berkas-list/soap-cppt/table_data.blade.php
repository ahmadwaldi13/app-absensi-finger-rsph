@php
    $fr = !empty(Request::get('fr')) ? Request::get('fr') : '';
@endphp
    <table border="0.2" cellspacing="0" cellpadding="1">
        <tbody>
            <tr>
                <td width="20%">No. RM</td> 
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($dataPasien->no_rkm_medis) ? $dataPasien->no_rkm_medis : "" }} </td>  
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
            <tr>
                <td width="20%">Cara Bayar</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($reg_periksa->png_jawab) ? $reg_periksa->png_jawab : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Penanggung Jawab</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($reg_periksa->p_jawab) ? $reg_periksa->p_jawab : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Alamat P.J.</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($reg_periksa->almt_pj) ? $reg_periksa->almt_pj : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Hubungan P.J.</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($reg_periksa->hubunganpj) ? $reg_periksa->hubunganpj : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Status</td>
                <td width="1%" align="center">:</td>
                <td width="79%">{{ !empty($reg_periksa->status_lanjut) ? $reg_periksa->status_lanjut : ""}} </td>
            </tr>
            <tr>
                <td width="20%">Diagnosa/Penyakit/ICD 10</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" width="100%" cellpadding="3px" cellspacing="0" class="tbl_form">
                        <tr>
                            <td valign="top" width="24%" >Kode</td>
                            <td valign="top" width="55%" >Nama Penyakit</td>
                            <td valign="top" width="21%" >Status</td>
                        </tr>
                        @foreach($diagnosa_pasien as $v)
                        <tr>
                            <td valign="top">{{!empty($v->kd_penyakit) ? $v->kd_penyakit : ""}}</td>
                            <td valign="top">{{!empty($v->nm_penyakit) ? $v->nm_penyakit : ""}}</td>
                            <td valign="top">{{!empty($v->status) ? $v->status : ""}}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            <tr>
                <td width="20%">Prosedur Tindakan/ICD 9</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                <table border="0.2" cellspacing="0" cellpadding="1.8" width="100%" cellpadding="3px" cellspacing="0" class="tbl_form">
                        <tr>
                            <td valign="top" width="24%" >Kode</td>
                            <td valign="top" width="55%" >Nama Penyakit</td>
                            <td valign="top" width="21%" >Status</td>
                        </tr>
                        @foreach($prosedur_pasien as $v)
                        <tr>
                            <td valign="top">{{!empty($v->kode) ? $v->kode : ""}}</td>
                            <td valign="top">{{!empty($v->deskripsi_panjang) ? $v->deskripsi_panjang : ""}}</td>
                            <td valign="top">{{!empty($v->status) ? $v->status : ""}}</td>
                        </tr>
                        @endforeach
                    </table>

                </td>
            </tr>
            
            @if($pemeriksaan_ralan->count() > 0 && $fr == "rj")
            <tr>
                <td width="20%">Pemeriksaan Rawat Jalan</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td width="9%" valign="top" >Tanggal</td>
                            <td width="9%" valign="top" >Sudu (C)</td>
                            <td width="9%" valign="top" >Tensi</td>
                            <td width="9%" valign="top" >Nadi (/menit)</td>
                            <td width="9%" valign="top" >RR (/menit)</td>
                            <td width="9%" valign="top" >Tinggi (Cm)</td>
                            <td width="9%" valign="top" >Berat (Kg)</td>
                            <td width="9%" valign="top" >GCS (E,V,M)</td>
                            <td width="9%" valign="top" >Kesadaran</td>
                        </tr>
                        @foreach($pemeriksaan_ralan as $p)
                            <tr>
                                <td valign="top">{{!empty($p->tgl_perawatan) ? $p->tgl_perawatan : ""}} {{!empty($p->jam_rawat) ? $p->jam_rawat : ""}}</td>
                                <td valign="top">{{!empty($p->suhu_tubuh) ? $p->suhu_tubuh : ""}}</td>
                                <td valign="top">{{!empty($p->tensi) ? $p->tensi : ""}}</td>
                                <td valign="top">{{!empty($p->nadi) ? $p->nadi : ""}}</td>
                                <td valign="top">{{!empty($p->respirasi) ? $p->respirasi : ""}}</td>
                                <td valign="top">{{!empty($p->tinggi) ? $p->tinggi : ""}}</td>
                                <td valign="top">{{!empty($p->berat) ? $p->berat : ""}}</td>
                                <td valign="top">{{!empty($p->gcs) ? $p->gcs : ""}}</td>
                                <td valign="top">{{!empty($p->kesadaran) ? $p->kesadaran : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Subjek</td>
                                <td valign="top" colspan="7"> : {{!empty($p->keluhan) ? $p->keluhan : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Objek</td>
                                <td valign="top" colspan="7"> : {{!empty($p->pemeriksaan) ? $p->pemeriksaan : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Asesmen</td>
                                <td valign="top" colspan="7"> : {{!empty($p->penilaian) ? $p->penilaian : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Plan</td>
                                <td valign="top" colspan="7"> : {{!empty($p->rtl) ? $p->rtl : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Alergi</td>
                                <td valign="top" colspan="7"> : {{!empty($p->alergi) ? $p->alergi : ""}}</td>
                            </tr>
                        @endforeach
                    </table>

                </td>
            </tr>
            @endif
            @if($pemeriksaan_ranap->count() > 0 && $fr == "ri")
            <tr>
                <td width="20%">Pemeriksaan Rawat Inap</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td width="9%" valign="top" >Tanggal</td>
                            <td width="9%" valign="top" >Sudu (C)</td>
                            <td width="9%" valign="top" >Tensi</td>
                            <td width="9%" valign="top" >Nadi (/menit)</td>
                            <td width="9%" valign="top" >RR (/menit)</td>
                            <td width="9%" valign="top" >Tinggi (Cm)</td>
                            <td width="9%" valign="top" >Berat (Kg)</td>
                            <td width="9%" valign="top" >GCS (E,V,M)</td>
                            <td width="9%" valign="top" >Kesadaran</td>
                        </tr>
                        @foreach($pemeriksaan_ranap as $p)
                            <tr>
                                <td valign="top">{{!empty($p->tgl_perawatan) ? $p->tgl_perawatan : ""}} {{!empty($p->jam_rawat) ? $p->jam_rawat : ""}}</td>
                                <td valign="top">{{!empty($p->suhu_tubuh) ? $p->suhu_tubuh : ""}}</td>
                                <td valign="top">{{!empty($p->tensi) ? $p->tensi : ""}}</td>
                                <td valign="top">{{!empty($p->nadi) ? $p->nadi : ""}}</td>
                                <td valign="top">{{!empty($p->respirasi) ? $p->respirasi : ""}}</td>
                                <td valign="top">{{!empty($p->tinggi) ? $p->tinggi : ""}}</td>
                                <td valign="top">{{!empty($p->berat) ? $p->berat : ""}}</td>
                                <td valign="top">{{!empty($p->gcs) ? $p->gcs : ""}}</td>
                                <td valign="top">{{!empty($p->kesadaran) ? $p->kesadaran : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Subjek</td>
                                <td valign="top" colspan="7"> : {{!empty($p->keluhan) ? $p->keluhan : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Objek</td>
                                <td valign="top" colspan="7"> : {{!empty($p->pemeriksaan) ? $p->pemeriksaan : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Asesmen</td>
                                <td valign="top" colspan="7"> : {{!empty($p->penilaian) ? $p->penilaian : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Plan</td>
                                <td valign="top" colspan="7"> : {{!empty($p->rtl) ? $p->rtl : ""}}</td>
                            </tr>
                            <tr>
                                <td valign="top" colspan="2">Alergi</td>
                                <td valign="top" colspan="7"> : {{!empty($p->alergi) ? $p->alergi : ""}}</td>
                            </tr>
                        @endforeach
                    </table>

                </td>
            </tr>
            @endif

            @if($rawat_jl_dr->count() > 0)
            <tr>
                <td width="20%">Tindakan Rawat Jalan Dokter</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td valign='top' width='10%'>Tanggal</td>
                            <td valign='top' width='10%'>Kode</td>
                            <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
                            <td valign='top' width='20%'>Dokter</td>
                        </tr>
                        @foreach($rawat_jl_dr as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_perawatan) ? $v->tgl_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->kd_jenis_prw) ? $v->kd_jenis_prw : ""}}</td>
                                <td valign="top">{{!empty($v->nm_perawatan) ? $v->nm_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->nm_dokter) ? $v->nm_dokter : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
            @if($rawat_jl_pr->count() > 0)
            <tr>
                <td width="20%">Tindakan Rawat Jalan Paramedis</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                        <td valign='top' width='10%'>Tanggal</td>
            <td valign='top' width='10%'>Kode</td>
            <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
            <td valign='top' width='20%'>Perawat</td>
                        </tr>
                        @foreach($rawat_jl_pr as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_perawatan) ? $v->tgl_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->kd_jenis_prw) ? $v->kd_jenis_prw : ""}}</td>
                                <td valign="top">{{!empty($v->nm_perawatan) ? $v->nm_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->nm_dokter) ? $v->nm_dokter : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
            @if($rawat_jl_drpr->count() > 0)
            <tr>
                <td width="20%">Tindakan Rawat Jalan Dokter & Perawat</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                        <td valign='top' width='10%'>Tanggal</td>
            <td valign='top' width='10%'>Kode</td>
            <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
            <td valign='top' width='15%'>Dokter</td>
            <td valign='top' width='15%'>Petugas</td>
                        </tr>
                        @foreach($rawat_jl_drpr as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_perawatan) ? $v->tgl_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->kd_jenis_prw) ? $v->kd_jenis_prw : ""}}</td>
                                <td valign="top">{{!empty($v->nm_perawatan) ? $v->nm_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->nm_dokter) ? $v->nm_dokter : ""}}</td>
                                <td valign="top">{{!empty($v->nama) ? $v->nama : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
            @if($rawat_inap_dr->count() > 0)
            <tr>
                <td width="20%">Tindakan Rawat Inap Dokter</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                        <td valign='top' width='10%'>Tanggal</td>
            <td valign='top' width='10%'>Kode</td>
            <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
            <td valign='top' width='20%'>Dokter</td>
                        </tr>
                        @foreach($rawat_inap_dr as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_perawatan) ? $v->tgl_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->kd_jenis_prw) ? $v->kd_jenis_prw : ""}}</td>
                                <td valign="top">{{!empty($v->nm_perawatan) ? $v->nm_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->nm_dokter) ? $v->nm_dokter : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
            @if($rawat_inap_pr->count() > 0)
            <tr>
                <td width="20%">Tindakan Rawat Inap Perawat</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                        <td valign='top' width='10%'>Tanggal</td>
            <td valign='top' width='10%'>Kode</td>
            <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
            <td valign='top' width='20%'>Petugas</td>
                        </tr>
                        @foreach($rawat_inap_pr as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_perawatan) ? $v->tgl_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->kd_jenis_prw) ? $v->kd_jenis_prw : ""}}</td>
                                <td valign="top">{{!empty($v->nm_perawatan) ? $v->nm_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->nm_dokter) ? $v->nm_dokter  : "" }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
            @if($rawat_inap_drpr->count() > 0)
            <tr>
                <td width="20%">Tindakan Rawat Inap Dokter & Perawat</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                        <td valign='top' width='10%'>Tanggal</td>
            <td valign='top' width='10%'>Kode</td>
            <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
            <td valign='top' width='15%'>Dokter</td>
            <td valign='top' width='15%'>Petugas</td>
                        </tr>
                        @foreach($rawat_inap_drpr as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_perawatan) ? $v->tgl_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->kd_jenis_prw) ? $v->kd_jenis_prw : ""}}</td>
                                <td valign="top">{{!empty($v->nm_perawatan) ? $v->nm_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->nm_dokter) ? $v->nm_dokter : ""}}</td>
                                <td valign="top">{{!empty($v->nama) ? $v->nama : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
            @if($kamar_inap->count() > 0)
            <tr>
                <td width="20%">Kamar Inap</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td valign='top' width='15%'>Tanggal Masuk</td>
                            <td valign='top' width='15%'>Tanggak Keluar</td>
                            <td valign='top' width='10%'>Lama Inap</td>
                            <td valign='top' width='35%'>Kamar</td>
                            <td valign='top' width='10%'>Status</td>
                        </tr>
                        @foreach($kamar_inap as $v)
                            <tr>
                                <td valign="top">{{!empty($v->jam_masuk) ? $v->jam_masuk : ""}}</td>
                                <td valign="top">{{!empty($v->tgl_keluar) ? $v->tgl_keluar : ""}} {{!empty($v->jam_keluar) ? $v->jam_keluar : ""}}</td>
                                <td valign="top">{{!empty($v->lama) ? $v->lama : ""}}</td>
                                <td valign="top">{{!empty($v->kd_kamar) ? $v->kd_kamar : ""}} {{!empty($v->nm_bangsal) ? $v->nm_bangsal : ""}}</td>
                                <td valign="top">{{!empty($v->stts_pulang) ? $v->stts_pulang : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
            @if($operasi->count() > 0)
            <tr>
                <td width="20%">Operasi</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td valign='top' width='10%' >Tanggal</td>
                            <td valign='top' width='10%' >Kode</td>
                            <td valign='top' width='45%' >Nama Tindakan/Perawatan</td>
                            <td valign='top' width='20%' >Anastesi</td>
                        </tr>
                        @foreach($operasi as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_operasi) ? $v->tgl_operasi : ""}}</td>
                                <td valign="top">{{!empty($v->kode_paket) ? $v->kode_paket : ""}} </td>
                                <td valign="top">{{!empty($v->nm_perawatan) ? $v->nm_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->jenis_anasthesi) ? $v->jenis_anasthesi : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
            @if($tindakan_radiologi->count() > 0)
            <tr>
                <td width="20%">Tindakan Radiologi</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td valign='top' width='10%'>Tanggal</td>
                            <td valign='top' width='10%'>Kode</td>
                            <td valign='top' width='45%'>Nama Tindakan/Perawatan</td>
                            <td valign='top' width='20%'>Dokter</td>
                            <td valign='top' width='10%'>Petugas</td>
                        </tr>
                        @foreach($tindakan_radiologi as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_periksa) ? $v->tgl_periksa : ""}} {{!empty($v->jam) ? $v->jam : ""}}</td>
                                <td valign="top">{{!empty($v->kd_jenis_prw) ? $v->kd_jenis_prw : ""}} </td>
                                <td valign="top">{{!empty($v->nm_perawatan) ? $v->nm_perawatan : ""}}</td>
                                <td valign="top">{{!empty($v->nm_dokter) ? $v->nm_dokter : ""}}</td>
                                <td valign="top">{{!empty($v->nama) ? $v->nama : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
            @if($hasil_radiologi->count() > 0)
            <tr>
                <td width="20%">Hasil Radiologi</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td valign='top' width='10%' >Tanggal</td>
                            <td valign='top' width='90%' >Hasil Pemeriksaan</td>
                        </tr>
                        @foreach($hasil_radiologi as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_periksa) ? $v->tgl_periksa : ""}} {{!empty($v->jam) ? $v->jam : ""}}</td>
                                <td valign="top">{{!empty($v->hasil) ? $v->hasil : ""}} </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif

            @if(count($pemeriksaan_laboratorium) > 0)
            <tr>
                <td width="20%">Pemeriksaan Laboratorium </td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td valign="top" width="20%" >Tanggal</td>
                            <td valign="top" width="20%" >Nama Tindakan</td>
                            <td valign="top" width="20%" >Hasil</td>
                            <td valign="top" width="20%" >Nilai Rujukan</td>
                            <td valign="top" width="20%" >Keterangan</td>
                        </tr>
                        @foreach($pemeriksaan_laboratorium as $v)
                            <tr>
                                <th valign="top" width="20%">{{!empty($v->tgl_periksa) ? $v->tgl_periksa : ""}}</th>
                                <th colspan="4" valign="top" width="80%">{{!empty($v->nm_perawatan) ? $v->nm_perawatan : ""}}</th>
                            </tr>
                            @foreach($v["detail_periksa_lab"] as $d)
                            <tr>
                                <td valign="top"></td>
                                <td valign="top">{{!empty($d->Pemeriksaan) ? $d->Pemeriksaan : ""}} </td>
                                <td valign="top">{{!empty($d->nilai) ? $d->nilai : ""}} {{!empty($d->satuan) ? $d->satuan : ""}}</td>
                                <td valign="top">{{!empty($d->nilai_rujukan) ? $d->nilai_rujukan : ""}}</td>
                                <td valign="top"><?= nl2br($d->keterangan) ?></td>
                            </tr>
                            @endforeach
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif

            @if($pemberian_obat->count() > 0)
            <tr>
                <td width="20%">Pemberian Obat</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td valign='top' width='15%'>Tanggal</td>
                            <td valign='top' width='10%'>Kode</td>
                            <td valign='top' width='45%'>Nama Obat</td>
                            <td valign='top' width='10%'>Jumlah</td>
                        </tr>
                        @foreach($pemberian_obat as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_perawatan) ? $v->tgl_perawatan : ""}} <br> {{!empty($v->jam) ? $v->jam : ""}}</td>
                                <td valign="top">{{!empty($v->kode_brng) ? $v->kode_brng : ""}} </td>
                                <td valign="top">{{!empty($v->nama_brng) ? $v->nama_brng : ""}}</td>
                                <td valign="top">{{!empty($v->jml) ? $v->jml : ""}} {{!empty($v->kode_sat) ? $v->kode_sat : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif

            @if($obat_operasi->count() > 0)
            <tr>
                <td width="20%">Obat Operasi</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td valign='top' width='10%'>Tanggal</td>
                            <td valign='top' width='10%'>Kode</td>
                            <td valign='top' width='45%'>Nama Obat</td>
                            <td valign='top' width='20%'>Jumlah</td>
                        </tr>
                        @foreach($obat_operasi as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_perawatan) ? $v->tgl_perawatan : ""}} {{!empty($v->jam) ? $v->jam : ""}}</td>
                                <td valign="top">{{!empty($v->kode_brng) ? $v->kode_brng : ""}} </td>
                                <td valign="top">{{!empty($v->nama_brng) ? $v->nama_brng : ""}}</td>
                                <td valign="top">{{!empty($v->jumlah) ? $v->jumlah : ""}} {{!empty($v->kode_sat) ? $v->kode_sat : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif

            @if($resep_pulang->count() > 0)
            <tr>
                <td width="20%">Obat Operasi</td>
                <td width="1%" align="center">:</td>
                <td width="79%">
                    <table border="0.2" cellspacing="0" cellpadding="1.8" class="pemeriksaan">
                        <tr>
                            <td valign='top' width='10%'>Tanggal</td>
                            <td valign='top' width='10%'>Kode</td>
                            <td valign='top' width='45%'>Nama Obat</td>
                            <td valign='top' width='10%'>Jumlah</td>
                            <td valign='top' width='20%'>Dosis</td>
                        </tr>
                        @foreach($resep_pulang as $v)
                            <tr>
                                <td valign="top">{{!empty($v->tgl_perawatan) ? $v->tgl_perawatan : ""}} {{!empty($v->jam) ? $v->jam : ""}}</td>
                                <td valign="top">{{!empty($v->kode_brng) ? $v->kode_brng : ""}} </td>
                                <td valign="top">{{!empty($v->nama_brng) ? $v->nama_brng : ""}}</td>
                                <td valign="top">{{!empty($v->jumlah) ? $v->jumlah : ""}} {{!empty($v->kode_sat) ? $v->kode_sat : ""}}</td>
                                <td valign="top">{{!empty($v->dosis) ? $v->dosis : ""}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
        </tbody>
    </table>

<!-- 

    <table>
        <tbody>
            <tr>
                <td width="80%"></td>
                <td width="20%">
                    p
                </td>
            </tr>
        </tbody>
    </table>

     -->