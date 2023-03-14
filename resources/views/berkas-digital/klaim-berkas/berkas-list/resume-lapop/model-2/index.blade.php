<section id="laporan_operasi">
@include('berkas-digital.klaim-berkas.berkas-kop') 
    <div style="border-bottom:1px solid black;font-size:x-large">LAPORAN OPERASI</div>
    @include("berkas-digital.klaim-berkas.berkas-list.resume-lapop.model-2.pasien_data")

    <div style="font-size:large;border:1px solid black; text-align:center;background-color: rgb(200,200,200)">PRE SURGICAL ASSESMENT</div>
    @include("berkas-digital.klaim-berkas.berkas-list.resume-lapop.model-2.surgical_assesments")

    <div style="font-size:large;border:1px solid black; text-align:center;background-color: rgb(200,200,200)">POST SURGICAL REPORT</div>
    @include("berkas-digital.klaim-berkas.berkas-list.resume-lapop.model-2.surgical_report")
    
    <div style="font-size:large;border:1px solid black; text-align:center;background-color: rgb(200,200,200)">REPORT ( PROCEDURES, SPECIFIC FINDINGS AND COMPLICATIONS )</div>
    @include("berkas-digital.klaim-berkas.berkas-list.resume-lapop.model-2.psfc_report")
</section>