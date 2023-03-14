<table width='100%'  align='center'  cellspacing='0' class='tbl_form'>
    <tr>
        <td valign='top'>
           YANG MELAKUKAN PENGKAJIAN
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td width='33%' >Tanggal : {{!empty($penilaian->tanggal) ? $penilaian->tanggal : ""}} </td>
                    <td width='33%' >Petugas : {{!empty($penilaian->nip) ? $penilaian->nip : ""}} {{!empty($penilaian->nama) ? $penilaian->nama : ""}}</td>
                    <td width='33%' >Informasi didapat dari : {{!empty($penilaian->informasi) ? $penilaian->informasi : ""}} {{!empty($penilaian->informasi) ? $penilaian->informasi : ""}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign='top'>
            I. KEADAAN UMUM
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td width='20%' >TD : {{!empty($penilaian->td) ? $penilaian->td : ""}} mmHg</td>
                    <td width='20%' >Nadi : {{!empty($penilaian->nadi) ? $penilaian->nadi : ""}} x/menit</td>
                    <td width='20%' >RR : {{!empty($penilaian->rr) ? $penilaian->rr : ""}} x/menit</td>
                    <td width='20%' >Suhu : {{!empty($penilaian->suhu) ? $penilaian->suhu : ""}} °C</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign='top'>
            II. STATUS NUTRISI
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td width='33%' >BB : {{!empty($penilaian->bb) ? $penilaian->bb : ""}} Kg</td>
                    <td width='33%' >TB : {{!empty($penilaian->tb) ? $penilaian->tb : ""}} Cm</td>
                    <td width='33%' >BMI : {{!empty($penilaian->bmi) ? $penilaian->bmi : ""}} Kg/m²</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign='top'>
            III. RIWAYAT KESEHATAN
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td colspan='2'>Keluhan Utama : {{!empty($penilaian->keluhan_utama) ? $penilaian->keluhan_utama : ""}}</td>
                </tr>
                <tr>
                    <td width='50%'>Riwayat Penyakit :
                        {{!empty($penilaian->riwayat_penyakit) ? $penilaian->riwayat_penyakit : ""}} {{!empty($penilaian->ket_riwayat_penyakit) ? $penilaian->ket_riwayat_penyakit  : ""}}</td>
                    <td width='50%'>Riwayat Perawatan Gigi :
                        {{!empty($penilaian->riwayat_perawatan_gigi) ? $penilaian->riwayat_perawatan_gigi : ""}} {{!empty($penilaian->ket_riwayat_perawatan_gigi) ? $penilaian->ket_riwayat_perawatan_gigi  : ""}}</td>
                </tr>
                <tr>
                    <td width='50%'>Riwayat Alergi : {{!empty($penilaian->alergi) ? $penilaian->alergi : ""}}</td>
                    <td width='50%'>Kebiasaan Lain :
                        {{!empty($penilaian->kebiasaan_lain) ? $penilaian->kebiasaan_lain : ""}} {{!empty($penilaian->ket_kebiasaan_lain) ? $penilaian->ket_kebiasaan_lain  : ""}}</td>
                </tr>
                <tr>
                    <td width='50%'>Kebiasaan Sikat Gigi : {{!empty($penilaian->kebiasaan_sikat_gigi) ? $penilaian->kebiasaan_sikat_gigi : ""}}</td>
                    <td width='50%'>Obat Yang Diminum Saat Ini : {{!empty($penilaian->obat_yang_diminum_saatini) ? $penilaian->obat_yang_diminum_saatini : ""}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign='top'>
            IV. FUNGSIONAL
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td width='50%' >Alat Bantu :
                        {{!empty($penilaian->alat_bantu) ? $penilaian->alat_bantu : ""}} {{!empty($penilaian->ket_alat_bantu) ? $penilaian->ket_alat_bantu  : ""}}</td>
                    <td width='50%' >Prothesa :
                        {{!empty($penilaian->prothesa) ? $penilaian->prothesa : ""}} {{!empty($penilaian->ket_pro) ? $penilaian->ket_pro  : "" }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign='top'>
            V. RIWAYAT PSIKO-SOSIAL, SPIRITUAL DAN BUDAYA
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td width='50%' >Status Psikologis</td>
                    <td width='50%' >:
                        {{!empty($penilaian->status_psiko) ? $penilaian->status_psiko : ""}} {{!empty($penilaian->ket_psiko) ? $penilaian->ket_psiko  : ""}}</td>
                </tr>
                <tr>
                    <td  colspan='2'>Status Sosial dan ekonomi :</td>
                </tr>
                <tr>
                    <td width='50%' >&nbsp;&nbsp;&nbsp;&nbsp;a. Hubungan pasien dengan anggota
                        keluarga</td>
                    <td width='50%' >: {{!empty($penilaian->hub_keluarga) ? $penilaian->hub_keluarga : ""}}</td>
                </tr>
                <tr>
                    <td width='50%' >&nbsp;&nbsp;&nbsp;&nbsp;b. Tinggal dengan</td>
                    <td width='50%' >:
                        {{!empty($penilaian->tinggal_dengan) ? $penilaian->tinggal_dengan : ""}} {{!empty($penilaian->ket_tinggal) ? $penilaian->ket_tinggal  : ""}}</td>
                </tr>
                <tr>
                    <td width='50%' >&nbsp;&nbsp;&nbsp;&nbsp;c. Ekonomi</td>
                    <td width='50%' >: {{!empty($penilaian->ekonomi) ? $penilaian->ekonomi : ""}}</td>
                </tr>
                <tr>
                    <td width='50%' >Kepercayaan / Budaya / Nilai-nilai khusus yang perlu diperhatikan
                    </td>
                    <td width='50%' >: {{!empty($penilaian->budaya) ? $penilaian->budaya : ""}} {{!empty($penilaian->ket_budaya) ? $penilaian->ket_budaya  : ""}}</td>
                </tr>
                <tr>
                    <td width='50%' >Edukasi diberikan kepada</td>
                    <td width='50%' >: {{!empty($penilaian->edukasi) ? $penilaian->edukasi : ""}} {{!empty($penilaian->ket_edukasi) ? $penilaian->ket_edukasi  : ""}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign='top'>
            VI. PENILAIAN RESIKO JATUH
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td colpsan='2' >a. Cara Berjalan :</td>
                </tr>
                <tr>
                    <td width='75%' >&nbsp;&nbsp;&nbsp;&nbsp;1. Tidak seimbang / sempoyongan / limbung
                    </td>
                    <td width='25%' >: {{!empty($penilaian->berjalan_a) ? $penilaian->berjalan_a : ""}}</td>
                </tr>
                <tr>
                    <td width='75%' >&nbsp;&nbsp;&nbsp;&nbsp;2. Jalan dengan menggunakan alat bantu
                        (kruk, tripot, kursi roda, orang lain)</td>
                    <td width='25%' >: {{!empty($penilaian->berjalan_b) ? $penilaian->berjalan_b : ""}}</td>
                </tr>
                <tr>
                    <td width='75%' >b. Menopang saat akan duduk, tampak memegang pinggiran kursi atau
                        meja / benda lain sebagai penopang</td>
                    <td width='25%' >: {{!empty($penilaian->berjalan_c) ? $penilaian->berjalan_c : ""}}</td>
                </tr>
                <tr>
                    <td colspan='2' >Hasil :
                        {{!empty($penilaian->hasil) ? $penilaian->hasil : ""}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dilaporkan kepada dokter 
                        {{!empty($penilaian->lapor) ? $penilaian->lapor : ""}} ,{{!empty($penilaian->ket_lapor) ? $penilaian->ket_lapor : ""}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign='top'>
            VII. PENILAIAN TINGKAT NYERI
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td width='50%' >Tingkat Nyeri : {{!empty($penilaian->nyeri) ? $penilaian->nyeri : ""}}</td>
                    <td width='50%' >Skala Nyeri : {{!empty($penilaian->skala_nyeri) ? $penilaian->skala_nyeri : ""}}</td>
                </tr>
                <tr>
                    <td width='50%' >Lokasi : {{!empty($penilaian->lokasi) ? $penilaian->lokasi : ""}}</td>
                    <td width='50%' >Durasi : {{!empty($penilaian->durasi) ? $penilaian->durasi : ""}}</td>
                </tr>
                <tr>
                    <td width='50%' >Frekuensi : {{!empty($penilaian->frekuensi) ? $penilaian->frekuensi : ""}}</td>
                    <td width='50%' >Nyeri hilang bila :
                        {{!empty($penilaian->nyeri_hilang) ? $penilaian->nyeri_hilang : ""}} ,{{!empty($penilaian->ket_nyeri) ? $penilaian->ket_nyeri : ""}}</td>
                </tr>
                <tr>
                    <td  colspan='2'>Diberitahukan pada dokter 
                        {{!empty($penilaian->pada_dokter) ? $penilaian->pada_dokter : ""}}  ,Jam :{{!empty($penilaian->ket_dokter) ? $penilaian->ket_dokter : ""}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign='top'>
            VIII. PENILAIAN INTRAORAL
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td width='50%' >Kebersihan Mulut : {{!empty($penilaian->kebersihan_mulut) ? $penilaian->kebersihan_mulut : ""}}</td>
                    <td width='50%' >Mukosa Mulut : {{!empty($penilaian->mukosa_mulut) ? $penilaian->mukosa_mulut : ""}}</td>
                </tr>
                <tr>
                    <td width='50%' >Karies : {{!empty($penilaian->karies) ? $penilaian->karies : ""}}</td>
                    <td width='50%' >Karang Gigi : {{!empty($penilaian->karang_gigi) ? $penilaian->karang_gigi : ""}}</td>
                </tr>
                <tr>
                    <td width='50%' >Gingiva : {{!empty($penilaian->gingiva) ? $penilaian->gingiva : ""}}</td>
                    <td width='50%' >Palatum : {{!empty($penilaian->palatum) ? $penilaian->palatum : ""}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign='top'>
            <table width='100%'  align='center'  cellspacing='0px' class='tbl_form'>
                <tr>
                    <td valign='middle' bgcolor='#FFFAF8' align='center' width='50%'>MASALAH KEPERAWATAN :</td>
                    <td valign='middle' bgcolor='#FFFAF8' align='center' width='50%'>RENCANA KEPERAWATAN :</td>
                </tr>
                <tr>
                    <td>
                        @foreach($masalah as $masalah)
                            {{!empty($masalah->nama_masalah) ? $masalah->nama_masalah : ""}}<br>
                        @endforeach
                    </td>
                    <td>{{!empty($penilaian->rencana) ? $penilaian->rencana : ""}}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>