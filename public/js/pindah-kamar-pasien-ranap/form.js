$(document).find(".money").inputmask({ alias : "money" });

function hitung(){
    $tarif_awal=$(document).find('#trf_kamar_awal').val();
    $tarif_awal=$tarif_awal.replace(/\./g, "");
    $tarif_awal=$tarif_awal.replace(/\,/g, ".");
    $tarif_awal=parseFloat($tarif_awal);
    if(isNaN($tarif_awal)) {
        $tarif_awal = 0;
    }

    $tarif_pindah=$(document).find('#trf_kamar_pindah').val();
    $tarif_pindah=$tarif_pindah.replace(/\./g, "");
    $tarif_pindah=$tarif_pindah.replace(/\,/g, ".");
    $tarif_pindah=parseFloat($tarif_pindah);
    if(isNaN($tarif_pindah)) {
        $tarif_pindah = 0;
    }

    $selisih=$tarif_pindah-$tarif_awal;
    $(document).find('#selisih').val($selisih);

    $lama_nginap=$(document).find('#lama_nginap').val();
    $lama_nginap=$lama_nginap.replace(/\./g, "");
    $lama_nginap=$lama_nginap.replace(/\,/g, ".");
    $lama_nginap=parseFloat($lama_nginap);
    if(isNaN($lama_nginap)) {
        $lama_nginap = 1;
        $(document).find('#lama_nginap').val($lama_nginap);
    }

    $total=$selisih*$lama_nginap;
    $(document).find('#total').val($total);

}

function hitung_selisih_tanggal(){
    $tgl_masuk=$(document).find('#tgl_masuk').val();
    $tgl_masuk=$tgl_masuk.split('-');
    $year=$tgl_masuk[0].replace(/ /g,'');
    $month=$tgl_masuk[1].replace(/ /g,''); 
    $day=$tgl_masuk[2].replace(/ /g,''); 
    $jam=$tgl_masuk[3].replace(/ /g,'');
    $jam=$jam.split(':');
    $hour=$jam[0].replace(/ /g,'');
    $minute=$jam[1].replace(/ /g,'');
    $tgl_masuk=$year+'-'+$month+'-'+$day;
    $jam_masuk=$hour+':'+$minute;
    // $date1=new Date($tgl_masuk + " " + $jam_masuk).getTime();
    $date1=new Date($tgl_masuk).getTime();

    $tgl_keluar=$(document).find('#tgl_keluar').val();
    $tgl_keluar=$tgl_keluar.split('-');
    $year=$tgl_keluar[0].replace(/ /g,'');
    $month=$tgl_keluar[1].replace(/ /g,''); 
    $day=$tgl_keluar[2].replace(/ /g,''); 
    $jam=$tgl_keluar[3].replace(/ /g,'');
    $jam=$jam.split(':');
    $hour=$jam[0].replace(/ /g,'');
    $minute=$jam[1].replace(/ /g,'');
    $tgl_keluar=$year+'-'+$month+'-'+$day;
    $jam_keluar=$hour+':'+$minute;
    // $date2=new Date($tgl_keluar + " " + $jam_keluar).getTime();
    $date2=new Date($tgl_keluar).getTime();

    var msec = $date2 - $date1;
    var mins = Math.floor(msec / 60000);
    var hrs = Math.floor(mins / 60);
    var days = Math.floor(hrs / 24);
    var yrs = Math.floor(days / 365);

    mins = mins % 60;
    hrs = hrs % 24;
    days = days % 365;
    if($tgl_masuk==$tgl_keluar){
        days=1;
    }
    $(document).find('#lama_nginap').val(days);

    hitung();
};

function check_validasi(){
    
    $trf_awal=$(document).find('#trf_kamar_awal').val();
    $trf_awal=parseFloat($trf_awal);
    if(isNaN($trf_awal)) {
        $trf_awal = 0;
    }
    $trf_pindah=$(document).find('#trf_kamar_pindah').val();
    $trf_pindah=parseFloat($trf_pindah);
    if(isNaN($trf_pindah)) {
        $trf_pindah = 0;
    }

    $lama_nginap=$(document).find('#lama_nginap').val();
    $lama_nginap=parseFloat($lama_nginap);
    if(isNaN($lama_nginap)) {
        $lama_nginap = 0;
    }

    $selisih=$(document).find('#selisih').val();
    $selisih=parseFloat($selisih);
    if(isNaN($selisih)) {
        $selisih = 0;
    }

    if($trf_pindah<$trf_awal){
        alert('Maaf Tarif Kamar Pindah, tidak boleh lebih kecil dari tarif kamar awal');
        return false;
    }

    if($selisih<0){
        alert('Selisih tidak boleh kurang dari 0');
        return false;
    }

    if($lama_nginap<=0){
        alert('Lama Menginap tidak boleh kurang dari 0');
        return false;
    }
    return true;
}

$(document).delegate(".set-data-list-from-modal-custome-me", "click", function (event) {
    let closeModal = (typeof $(this).attr('data-btn-close') != "undefined" || $(this).attr('data-btn-close') != null) ? $(this).attr('data-btn-close') : '';
    if (closeModal) {
        closeModal = (typeof $(document).find(closeModal) != "undefined" || $(document).find(closeModal) != null) ? $(document).find(closeModal) : '';
    }
    let target_tmp = (typeof $(this).attr('data-target') != "undefined" || $(this).attr('data-target') != null) ? $(this).attr('data-target') : '';
    let showError = (typeof $(this).attr('data-show-error') != "undefined" || $(this).attr('data-show-error') != null) ? $(this).attr('data-show-error') : '';
    if (showError) {
        showError = (typeof $(document).find(showError) != "undefined" || $(document).find(showError) != null) ? $(document).find(showError) : '';
    }

    if (closeModal && target_tmp) {

        let hasil = (typeof $(this).attr('data-item') != "undefined" || $(this).attr('data-item') != null) ? $(this).attr('data-item') : '';
        hasil = hasil.split("@");

        target_tmp = target_tmp.split("|");

        if (hasil) {
            $.each(hasil, function (key, value) {
                let target = '';
                if (target_tmp[key]) {
                    target = (typeof $(document).find(target_tmp[key]) != "undefined" || $(document).find(target_tmp[key]) != null) ? $(document).find(target_tmp[key]) : '';
                    if (target.length == 1) {
                        if (target[0].value !== undefined) {
                            target.val(value);
                        } else {
                            target.html(value);
                        }
                    }
                }
            });
        }
        
        hitung();

        $(document).find(closeModal).trigger("click");
    }

    return false;
});

$(document).delegate("#lama_nginap", "change keyup", function (event) {
    
});

$(document).find(".input-date-time-cus-me").on("change keyup", function () {
    hitung_selisih_tanggal();
});


$(document).find("#btn_save").on("click", function () {
    
    return check_validasi();
});

$("#tmp_semua_kawal").on("change", function () {
    $target= (typeof $(document).find('#form_kamar_awal') != "undefined" || $(document).find('#form_kamar_awal') != null) ? $(document).find('#form_kamar_awal') : '';
    $data_kawal_default= (typeof $(document).find('#kamar_awal_default') != "undefined" || $(document).find('#kamar_awal_default') != null) ? $(document).find('#kamar_awal_default') : '';
    if ($target.length) {
        if ($(this).is(':checked')) {
            $target.attr("data-modal-key",'');
        }else{
            $target.attr("data-modal-key",$data_kawal_default.val());
        }
    }
    return false;
});


$(document).ready(function () {
    if($(document).find('#key_data').val()){
        hitung_selisih_tanggal();
        hitung();
    }
});
