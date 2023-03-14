function get_pdt(){
    $data=[];
    if($(document).find('#periksa_tmp').val()){
        $data=$(document).find('#periksa_tmp').val();
        $data=$data.split('@');
    }

    return {
        psd_1:$data
    };
}


function get_permintaan_sub(){
    $checked_list=[];

    $get_pds=get_pdt();

    $(document).find('.pil_p1').each(function () {
        if($get_pds.psd_1.length>=1){
            
            if( jQuery.inArray( $(this).val(), $get_pds.psd_1 )!=-1 ){
                $(this).prop( "checked",true );
            }
        }
        if(this.checked){
            $checked_list.push( $(this).val() );
        }
    });

    if($checked_list.length>=1){
        $(document).find('#bagan-save').show();
    }else{
        $(document).find('#bagan-save').hide();
    }
    
    return false;
}


$("#tanggal_permintaan").on("change keyup", function () {
    let date = $(this).val();
    let tgl = date.substring(0, 10);

    $.ajax({
        url: base_url +"/api/permintaan/pr/nomor?tgl=" +tgl,
        method: "get",
        success: function (hasil) {
            $("#nomor_permintaan").val(hasil.content);
        },
    });
});

$(document).delegate(".pil_p1", "change", function(event) {
    get_permintaan_sub();
});

$(document).delegate("#btn_submit", "click", function(event) {
    
    $jml_psd1=0;
    $(document).find('.pil_p1').each(function () {
        if(this.checked){
            $jml_psd1++;
        }
    });

    if($jml_psd1<=0){
        alert('Kode Periksa harus di pilih minimal 1');
        return false;
    }
});


$(document).ready(function () {
    $(document).find('#bagan-save').hide();
    get_permintaan_sub();
});