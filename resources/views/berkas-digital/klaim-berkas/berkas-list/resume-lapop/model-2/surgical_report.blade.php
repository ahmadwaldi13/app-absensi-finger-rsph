<table>
    <tr>
        <td style="border-right:1px solid black;" width="75%">
            <table>
                <tr>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Tanggal & Waktu",
                            "data" =>!empty($laporan_operasi->tgl_operasi) ? $laporan_operasi->tgl_operasi : "-"
                        ])
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Dokter Bedah",
                            "data" => !empty($laporan_operasi->operator1) ? $laporan_operasi->operator1 : "-"
                        ])
                    </td>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Asisten Bedah",
                            "data" => !empty($laporan_operasi->asistenoperator1) ? $laporan_operasi->asistenoperator1 : "-"
                        ])
                    </td>
                </tr>
                <tr>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Dokter Bedah 2",
                            "data" => !empty($laporan_operasi->operator2) ? $laporan_operasi->operator2 : "-"
                        ])
                    </td>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Asisten Bedah 2",
                            "data" => !empty($laporan_operasi->asistenoperator2) ? $laporan_operasi->asistenoperator2 : "-"
                        ])
                    </td>
                </tr>
                <tr>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Perawat Resusitas",
                            "data" => !empty($laporan_operasi->perawatresusitas) ? $laporan_operasi->perawatresusitas : "-"
                        ])
                    </td>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Dokter Anastesi",
                            "data" => !empty($laporan_operasi->anastesi) ? $laporan_operasi->anastesi : "-"
                        ])
                    </td>
                </tr>
                <tr>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Instrumen",
                            "data" => !empty($laporan_operasi->instrumen) ? $laporan_operasi->instrumen : "-"
                        ])
                    </td>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Asisten Anastesi",
                            "data" => !empty($laporan_operasi->asistenanastesi) ? $laporan_operasi->asistenanastesi : "-"
                        ])
                    </td>
                </tr>
                <tr>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Dokter Anak",
                            "data" => !empty($laporan_operasi->pjanak) ? $laporan_operasi->pjanak : "-"
                        ])
                    </td>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Bidan",
                            "data" => !empty($laporan_operasi->bidan1) ? $laporan_operasi->bidan1 : "-"
                        ])
                    </td>
                </tr>
                <tr>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Dokter Umum",
                            "data" => !empty($laporan_operasi->omloop) ? $laporan_operasi->omloop : "-"
                        ])
                    </td>
                    <td>
                        @include('berkas-digital.klaim-berkas.components.column', [
                            "title" => "Onloop",
                            "data" => !empty($laporan_operasi->omloop) ? $laporan_operasi->omloop : "-"
                        ])
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color:rgb(200,200,200);">&nbsp;Diagnosa Pre-Op / Pre Operation Diagnosis</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;{{!empty($laporan_operasi->diagnosa_preop) ? $laporan_operasi->diagnosa_preop : "-"}}</td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color:rgb(200,200,200);">&nbsp;Jaringan Yang di-Eksisi/-Insisi</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;{{!empty($laporan_operasi->jaringan_dieksekusi) ? $laporan_operasi->jaringan_dieksekusi : "-"}}</td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color:rgb(200,200,200);">&nbsp;Diagnosa Post-Op / Post Operation Diagnosis</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;{{!empty($laporan_operasi->diagnosa_postop) ? $laporan_operasi->diagnosa_postop : "-"}}</td>
                </tr>

            </table>
        </td>
        <td width="25%" valign="middle" align="center">
            <div>
                <span>Tipe/Jenis Anastesi</span><br>
                <span>{{!empty($laporan_operasi->jenis_anasthesi) ? $laporan_operasi->jenis_anasthesi : "-"}}</span>
            </div>
            <div>
                <span>Dikirim ke PemeriksaanPA</span><br>
                <span>{{!empty($laporan_operasi->permintaan_pa) ? $laporan_operasi->permintaan_pa : "-"}}</span>
            </div>
            <div>
                <span>Tipe/ Kategori Operasi</span><br>
                <span>{{!empty($laporan_operasi->kategori) ? $laporan_operasi->kategori : "-"}}</span>

            </div>
            <div>
                <span>Selesai Operasi</span><br>
                <span>{{!empty($laporan_operasi->selesaioperasi) ? $laporan_operasi->selesaioperasi : "-"}}</span>
            </div>
        </td>
    </tr>
</table>