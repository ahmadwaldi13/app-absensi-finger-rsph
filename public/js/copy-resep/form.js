function checked_tgl($var){
    if ($($var).is(':checked')) {
        $('#tgl_rawat').prop('disabled',false);
    }else{
        $('#tgl_rawat').prop('disabled',true);
    };
}

$(document).ready(function() {
    checked_tgl($("#pil_tgl"));
});

$("#pil_tgl").on("change keyup", function () {
    checked_tgl($(this));
});