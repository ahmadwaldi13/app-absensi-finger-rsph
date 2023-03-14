$("#tanggal").on("change keyup", function () {
    $tanggal = (typeof $(document).find('#tgl') != "undefined" || $(document).find('#tgl') != null) ? $(document).find('#tgl') : '' ;

    if($tanggal){
        $.ajax({
            url:base_url +"/api/isi-resep/nomor?tgl=" +$tanggal.val(),
            method: "get",
            success: function (resultDataAnatomi) {
                $("#no_resep").val(resultDataAnatomi.content);
            },
        });
    }
});

$(document).delegate(".get-metode-racik", "click", function(event) {
    let key_bagan = (typeof $(this).attr('data-key-bagan') != "undefined" || $(this).attr('data-key-bagan') != null) ? $(this).attr('data-key-bagan') : '' ;
    $parent_bagan=$(document).find('.bagan-form-racikan[data-key='+key_bagan+']');

    let closeModal = (typeof $(this).attr('data-btn-close') != "undefined" || $(this).attr('data-btn-close') != null) ? $(this).attr('data-btn-close') : '' ;
    if(closeModal){
        closeModal = (typeof $(document).find(closeModal) != "undefined" || $(document).find(closeModal) != null) ? $(document).find(closeModal) : '' ;
    }
    let form_target = (typeof $(this).attr('data-target') != "undefined" || $(this).attr('data-target') != null) ? $(this).attr('data-target') : '' ;
    let target1='';
    let target2='';
    if(form_target){
        var data_tar = form_target.split("|");

        if(data_tar[0]){
            target1 = (typeof $parent_bagan.find(data_tar[0]) != "undefined" || $parent_bagan.find(data_tar[0]) != null) ? $parent_bagan.find(data_tar[0]) : '' ;
        }

        if(data_tar[1]){
            target2 = (typeof $parent_bagan.find(data_tar[1]) != "undefined" || $parent_bagan.find(data_tar[1]) != null) ? $parent_bagan.find(data_tar[1]) : '' ;
        }
    }

    let showError = (typeof $(this).attr('data-show-error') != "undefined" || $(this).attr('data-show-error') != null) ? $(this).attr('data-show-error') : '' ;
    if(showError){
        showError = (typeof $(document).find(showError) != "undefined" || $(document).find(showError) != null) ? $(document).find(showError) : '' ;
    }

    if(closeModal && target1){

        let item = (typeof $(this).attr('data-item') != "undefined" || $(this).attr('data-item') != null) ? $(this).attr('data-item') : '' ;
        item = item.split("@");

        target1.val( (item[1]) ? item[1] : '' );
        target2.val( (item[0]) ? item[0] : '' );

        $(document).find( closeModal ).trigger( "click" );
    }

    return false;
});

$(document).delegate("#btn-tambah-racikan", "click", function(event) {
    $bagan_copy=$(document).find('.body-racikan-copy');
    $bagan_target=$(document).find('.body-racikan');

    $html='';
    $html+="<div class='bagan-form-racikan' data-key='0'>";
    $html+=$bagan_copy.html();
    $html+="</div>";

    $bagan_target.append($html);

    restruktur_form_racik();

    return false;
});

$(document).delegate(".btn-hapus-racikan", "click", function(event) {
    $parent=$(this).parents('.bagan-form-racikan');
    $parent.remove();

    restruktur_form_racik();
    return false;
});

/*=======================function dalam modal=======================*/

$(document).delegate(".btn-tambah-obat", "click", function(event) {
    let bagan_parent=$(this).parents('.bagan-form-racikan');
    let target=bagan_parent.find('.lok-racikan-click');

    let nm_racikan=bagan_parent.find(".get-nm-racikan").val();
    let metode_racikan=bagan_parent.find(".nm_racik").val();
    let jml_racikan=bagan_parent.find(".jml_rc").val();
    let aturan_pk=bagan_parent.find(".get-aturan-pakai").val();
    let keterangan=bagan_parent.find(".ket").val();

    let list_obat='';
    bagan_parent.find(".obat_json").val('');
    let get_list_terpilih=bagan_parent.find('.bagan-barang-terpilih').find('tbody').find('.tbl-terpilih');
    if(get_list_terpilih.length>0){
        list_obat=set_list_obat_terpilih(get_list_terpilih);
        bagan_parent.find(".obat_json").val(list_obat);
    }


    let key_form=(typeof bagan_parent.attr('data-key') != "undefined" || bagan_parent.attr('data-key') != null) ? bagan_parent.attr('data-key') : '' ;

    if(( nm_racikan.length<1 )){
        alert('Nama Racikan tidak boleh kosong');
        return false;
    }

    if(( metode_racikan.length<1 )){
        alert('Metode Racikan tidak boleh kosong');
        return false;
    }

    if(( jml_racikan.length<1 )){
        if(jml_racikan<=0){
            alert('Jumlah Racikan tidak boleh kosong');
        }
        return false;
    }

    if(( aturan_pk.length<1 )){
        alert('Aturan Pakai tidak boleh kosong');
        return false;
    }

    if(( keterangan.length<1 )){
        alert('Keterangan tidak boleh kosong');
        return false;
    }

    let first_key = (typeof target.attr('data-modal-tmp') != "undefined" || target.attr('data-modal-tmp') != null) ? target.attr('data-modal-tmp') : '' ;
    $check_list_obat=is_valid_json_string(list_obat);
    if($check_list_obat===true){
        $data_obat=[];
        list_obat=JSON.parse(list_obat);
        $.each(list_obat, function( index, value ) {
            $check_=is_valid_json_string(value);
            if($check_){
                value=JSON.parse(value);
                $data_obat[index]={
                    'kode_barang':value.kode_barang,
                    'p1':value.p1,
                    'p2':value.p2,
                    'kandungan':value.kandungan,
                    'jlh_obat':value.jlh_obat,
                };
            }
        });
        if($data_obat.length!=0){
            list_obat='';
            list_obat=JSON.stringify($data_obat);
        }
    }else{
        list_obat='';
    }

    let me_key={
        'key_form':key_form,
        'nm_racik':nm_racikan,
        'metode_racik':metode_racikan,
        'jlh_racik':jml_racikan,
        'aturan_pakai':aturan_pk,
        'keterengan':keterangan,
        'list_obat':list_obat
    };
    me_key=JSON.stringify(me_key);
    let new_key=first_key+"@"+me_key;
    target.attr('data-modal-key',new_key);

    $(target).trigger( "click" );

    return false;
});

$(document).delegate("#m_jml_racikan", "change", function(event) {

    if ($(this).val() == '0' && $(this).val() == '' && $(this).val() == 'undefined' && $(this).val() == null){
        $(this).val(1);
    }
    m_change_jml_racikan();
    return false;
});

$(document).delegate(".c_jlh_p1,.c_jlh_p2", "keyup", function(event) {
    m_hitung_p1p2($(this),'.m_tr_obat',$(document).find('#m_jml_racikan'));
    return false;
});

$(document).delegate(".c_kandungan", "keyup", function(event) {
    m_hitung_kandungan($(this),'.m_tr_obat',$(document).find('#m_jml_racikan'));
    return false;
});

$(document).delegate(".c_jlh_obat", "keyup", function(event) {
    m_hitung_stok_obat($(this),'.m_tr_obat');
    return false;
});

$(document).delegate(".c_jlh_obat", "change", function(event) {
    if(!($(this).val())){
        $(this).val(0);
    }
});

$(document).delegate("#pilih-obat-selesai", "click", function(event) {

    let bagan_parent_form=$(document).find('#bagan_form_modal');
    let table =$(document).find('#m_table_obat').DataTable();
    let key_target=bagan_parent_form.find('#key_form').val();

    let form_target = $(document).find('.bagan-form-racikan[data-key="'+key_target+'"]');

    let m_jml_racikan=bagan_parent_form.find('#m_jml_racikan').val();
    m_jml_racikan=parseFloat(m_jml_racikan);
    m_jml_racikan=(m_jml_racikan) ?  m_jml_racikan : 0;

    if(!m_jml_racikan){
        alert('Jumlah Racik masih kosong..!!!');
        return false;
    }

    let return_sent=[];
    let check_sisa_stok=0;
    let check_jlh_kapasitas=0;
    table.rows().every( function ( rowIdx ) {
        let get_jlh_obat = $( this.node() ).first().find('.m_jlh_obat');

        if(get_jlh_obat.val() != '0' && get_jlh_obat.val() != '' && get_jlh_obat.val() != 'undefined' && get_jlh_obat.val() != null){
            let bagan_parent_tr_obat=get_jlh_obat.parents('.m_tr_obat');

            let m_jlh_p1=bagan_parent_tr_obat.find('.m_jlh_p1').val();
            let m_jlh_p2=bagan_parent_tr_obat.find('.m_jlh_p2').val();
            let m_jlh_kapasitas=bagan_parent_tr_obat.find('.m_jlh_kapasitas').val();
            let m_kandungan=bagan_parent_tr_obat.find('.m_kandungan').val();
            let m_sisa_stok=bagan_parent_tr_obat.find('.m_sisa_stok').val();

            if(m_sisa_stok<0){
                check_sisa_stok++;
            }

            let data_obat=(typeof bagan_parent_tr_obat.attr('data-key') != "undefined" || bagan_parent_tr_obat.attr('data-key') != null) ? bagan_parent_tr_obat.attr('data-key') : '' ;
            if(data_obat){
                data_obat=JSON.parse(data_obat);
                data_obat['p1']=m_jlh_p1;
                data_obat['p2']=m_jlh_p2;
                data_obat['kandungan']=m_kandungan;
                data_obat['jlh_obat']=get_jlh_obat.val();

                data_obat=JSON.stringify(data_obat);
                return_sent.push(data_obat);
            }
        }
    });

    if(check_sisa_stok>0){
        alert('Maaf ada stok tidak mencukupi..!!');
        return false;
    }

    if (return_sent.length === 0) {
        alert('Maaf tidak ada list obat terpilih..!!!');
        return false;
    }

    form_target.find('.jml_rc').val(m_jml_racikan);

    form_target.find('.obat_json').val(JSON.stringify(return_sent));

    form_target.find('.obat_json').trigger( "change" );

    $(document).find( '#closeModalData' ).trigger( "click" );

    return false;
});

/*=======================end function dalam modal=======================*/

$(document).delegate(".jml_rc", "change", function(event) {

    if ($(this).val() == '0' && $(this).val() == '' && $(this).val() == 'undefined' && $(this).val() == null){
        $(this).val(1);
    }
    p_change_jml_racikan($(this));

    return false;
});

$(document).delegate(".p_jlh_p1,.p_jlh_p2", "keyup", function(event) {
    let parent=$(this).parents('.bagan-form-racikan');
    m_hitung_p1p2($(this),'.tbl-terpilih',parent.find('.jml_rc'));
    return false;
});

$(document).delegate(".p_kandungan", "keyup", function(event) {
    let parent=$(this).parents('.bagan-form-racikan');
    m_hitung_kandungan($(this),'.tbl-terpilih',parent.find('.jml_rc'));
    return false;
});

$(document).delegate(".p_jlh_obat", "keyup", function(event) {
    m_hitung_stok_obat($(this),'.tbl-terpilih');
    return false;
});

$(document).delegate(".p_jlh_obat", "change", function(event) {
    if(!($(this).val())){
        $(this).val(0);
    }
});

$(document).delegate(".obat_json", "change", function(event) {
    let data_tmp=$(this).val();
    set_list_obat($(this),data_tmp);
    return false;
});

$(document).delegate(".btn-hapus-tbl-terpilih", "click", function(event) {
    $parent=$(this).parents('.tbl-terpilih');
    $parent.remove();
    return false;
});

$(document).delegate("#check_submit", "click", function(event) {
    $check=check_submit();
    if($check==false){
        return false;
    }
    return true;
});

$(document).ready(function() {
    select2();
    select2_racikan();

    $check_form_obat=$(document).find('#data_form_obat').val();
    $check_json=is_valid_json_string($check_form_obat);
    if($check_json){
        $check=set_data_form_obat($(document).find('#data_form_obat').val());
        if($check===false){
            alert('Maaf terjadi kegagalan sistem, silahkan hubungin admin');
            return false;
        }
    }else{
        $check_bagan = (typeof $(document).find('.bagan-form-racikan') != "undefined" || $(document).find('.bagan-form-racikan') != null) ? $(document).find('.bagan-form-racikan') : '' ;
        if($check_bagan!=''){
            $(document).find('#btn-tambah-racikan').trigger( "click" );
        }
    }    

    setTimeout(function(){
        hitung_ppn();
    },1000);
});