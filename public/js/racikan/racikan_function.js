function pembulatan_c($nilai){
    // $nilai=Math.round($nilai * 10) / 10;
    $nilai=Math.ceil($nilai);
    return $nilai;
}

function hitung_ppn(){
    $total_harga_resep=0;
    $(document).find('tr.tbl-terpilih').each(function(){
        let m_jlh_obat=$(this).find('.m_jlh_obat');
        let nilai_jlh_obat=parseFloat(m_jlh_obat.val());
        nilai_jlh_obat=(nilai_jlh_obat) ?  nilai_jlh_obat : 0;

        let m_harga_real=$(this).find('.m_harga_real');
        let nilai_harga_real=parseFloat(m_harga_real.val());
        nilai_harga_real=(nilai_harga_real) ?  nilai_harga_real : 0;

        $total_harga_resep=$total_harga_resep+(parseFloat(nilai_harga_real)*parseFloat(nilai_jlh_obat));
    });
    $total_harga_resep=Math.round($total_harga_resep);
    $total_ppn=Math.round($total_harga_resep*0.1);
    $total_semua=$total_harga_resep+$total_ppn;

    $(document).find('#total_harga_resep').html(number_format($total_harga_resep,digit_decimal($total_harga_resep),',','.'));
    $(document).find('#total_harga_ppn').html(number_format($total_semua,digit_decimal($total_semua),',','.'));
}

function select2(){
    $(document).find('.get-aturan-pakai').select2({
        tags: true,
        ajax: {
            url: base_url +"/resep/aturan-pakai",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // search term
                    page: params.page,
                };
            },
            processResults: function (data, params) {

                params.page = params.page || 1;

                data = $.map(data, function (obj) {
                    obj.id = obj.aturan;
                    obj.text = obj.aturan;
                    return obj;
                });

                return {
                    results: data,
                    pagination: {
                        more: params.page * 30 < data.total_count,
                    },
                };
            },
            success: function (data) {
                // console.log("SUCCESS: ", data);
            },
            error: function (data) {
                // console.log("ERROR: ", data);
            },
            cache: true,
        },
        placeholder: "",
        minimumInputLength: 1,
        templateResult: function (data, container) {
            return data.text;

        },
        templateSelection: function (data) {
            return data.text;
        },
    });
}

function select2_racikan(){
    $(document).find('.get-nm-racikan').select2({
        tags: true,
        ajax: {
            url: base_url +"/racikan/ajax?action=get_nm_racik",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // search term
                    page: params.page,
                };
            },
            processResults: function (data, params) {

                params.page = params.page || 1;

                data = $.map(data, function (obj) {
                    obj.id = obj.nama_racik;
                    obj.text = obj.nama_racik;
                    return obj;
                });

                return {
                    results: data,
                    pagination: {
                        more: params.page * 30 < data.total_count,
                    },
                };
            },
            success: function (data) {
                // console.log("SUCCESS: ", data);
            },
            error: function (data) {
                // console.log("ERROR: ", data);
            },
            cache: true,
        },
        placeholder: "",
        minimumInputLength: 1,
        templateResult: function (data, container) {
            return data.text;

        },
        templateSelection: function (data) {
            return data.text;
        },
    });
}

function restruktur_form_racik(){
    $bagan='.bagan-form-racikan';
    $(document).find($bagan).each(function (key, value) {
        $key_form=key+1;
        $(this).attr('data-key',$key_form);

        $form_metode_racikan=$(this).find('.form-motede-racikan');
        $get_data_action = (typeof $form_metode_racikan.attr('data-modal-action-change') != "undefined" || $form_metode_racikan.attr('data-modal-action-change') != null) ? $form_metode_racikan.attr('data-modal-action-change') : '' ;
        $get_data_action = $get_data_action.split("@");

        $set_action=[];
        $.each( $get_data_action, function( key_1, value_1 ) {
            $get_ac=value_1.split("=");
            if($get_ac[0]=="data-key-bagan"){
                $set_action.push($get_ac[0]+'='+$key_form);
            }else{
                $set_action.push(value_1);
            }
        });

        $set_action=$set_action.join('@').replace("\n", "", "g");

        $form_metode_racikan.attr('data-modal-action-change',$set_action);

        $form_metode_racikan=$(this).find('.form-motede-racikan');

        form_aturan_pakai=$(this).find('.form-aturan-pakai');
        form_aturan_pakai.addClass( "get-aturan-pakai" );
        form_aturan_pakai.removeClass( "form-aturan-pakai" );

        form_nm_racikan=$(this).find('.form-nm-racikan');
        form_nm_racikan.addClass( "get-nm-racikan" );
        form_nm_racikan.removeClass( "form-nm-racikan" );

        if($key_form==1){
            $(this).find('.bagan-hapus-racikan').remove();
        }
    });

    $($bagan).find('.required-form').each(function (key, value) {
        $(this).prop('required',true);
        $(this).removeClass( "required-form" );
    });
    select2();
    select2_racikan();
}

/*=======================function hitung Racikan=======================*/

function m_hitung_p1p2(me,parent_table,tag_jlh_racikan){
    let bagan_parent_tr_obat=me.parents(parent_table);

    let m_jml_racikan=tag_jlh_racikan.val();
    m_jml_racikan=parseFloat(m_jml_racikan);
    m_jml_racikan=(m_jml_racikan) ?  m_jml_racikan : 0;

    let m_jlh_kapasitas=bagan_parent_tr_obat.find('.m_jlh_kapasitas').val();
    m_jlh_kapasitas=parseFloat(m_jlh_kapasitas);
    m_jlh_kapasitas=(m_jlh_kapasitas) ?  m_jlh_kapasitas : 0;

    let m_jlh_p1=bagan_parent_tr_obat.find('.m_jlh_p1').val();
    m_jlh_p1=parseFloat(m_jlh_p1);
    m_jlh_p1=(m_jlh_p1) ?  m_jlh_p1 : 1;

    let m_jlh_p2=bagan_parent_tr_obat.find('.m_jlh_p2').val();
    m_jlh_p2=parseFloat(m_jlh_p2);
    m_jlh_p2=(m_jlh_p2) ?  m_jlh_p2 : 1;

    if(!m_jlh_kapasitas){
        bagan_parent_tr_obat.find('.m_text_kapasitas').css({"color":"red"});
        alert('Kapasitas obat masih kosong..!!!');
        return false;
    }else{
        bagan_parent_tr_obat.find('.m_text_kapasitas').css({"color":"#212529"});
    }

    if(!m_jml_racikan){
        alert('Jumlah Racik masih kosong..!!!');
        return false;
    }

    let nilai_kandungan=m_jlh_kapasitas*(m_jlh_p1/m_jlh_p2);
    bagan_parent_tr_obat.find('.m_kandungan').val(nilai_kandungan);

    m_hitung_kandungan(bagan_parent_tr_obat.find('.m_kandungan'),parent_table,tag_jlh_racikan);

    return false;
}

function m_hitung_kandungan_persen(me,me_jlh_kapasitas,bagan_parent_tr_obat){

    let jml_racik=0;
    let me_persen=me.val();
    me_persen=me_persen.replace(/\%/g, '');
    me.val(me_persen+'%');
    let table=bagan_parent_tr_obat.parents('#m_table_obat')
    let bagan_form='';
    if(table.length===1){
        bagan_form=me.parents('.m_tr_obat');
        table = table.DataTable();
        table.rows().every( function ( rowIdx ) {
            $get_kandungan = $( this.node() ).find('.m_kandungan');
            if( !($get_kandungan.val().indexOf('%') != -1) ){
                $get_kapasitas =  $( this.node() ).find('.m_jlh_kapasitas');
                $nilai_get_kapasitas=parseFloat($get_kapasitas.val());
                $nilai_get_kapasitas=($nilai_get_kapasitas) ?  $nilai_get_kapasitas : 0;

                $get_jlh_obat =  $( this.node() ).find('.m_jlh_obat');
                $nilai_get_jlh_obat=parseFloat($get_jlh_obat.val());
                $nilai_get_jlh_obat=($nilai_get_jlh_obat) ?  $nilai_get_jlh_obat : 0;

                if($nilai_get_kapasitas>=1){
                    jml_racik=jml_racik+($nilai_get_kapasitas*$nilai_get_jlh_obat);
                }
            }
        });
    }else{
        bagan_form=me.parents('.tbl-terpilih');
        table=bagan_parent_tr_obat.parents('#tableObatSelected')
        table.find('.tbl-terpilih').each(function(index, value) {
            $get_kandungan = $(this).find('.m_kandungan');
            if( !($get_kandungan.val().indexOf('%') != -1) ){
                $get_kapasitas = $(this).find('.m_jlh_kapasitas');
                $nilai_get_kapasitas=parseFloat($get_kapasitas.val());
                $nilai_get_kapasitas=($nilai_get_kapasitas) ?  $nilai_get_kapasitas : 0;

                $get_jlh_obat = $(this).find('.m_jlh_obat');
                $nilai_get_jlh_obat=parseFloat($get_jlh_obat.val());
                $nilai_get_jlh_obat=($nilai_get_jlh_obat) ?  $nilai_get_jlh_obat : 0;

                if($nilai_get_kapasitas>=1){
                    jml_racik=jml_racik+($nilai_get_kapasitas*$nilai_get_jlh_obat);
                }
            }
        });
    }
    if(jml_racik){
        return hasil=(jml_racik*(me_persen/100))/me_jlh_kapasitas;
    }
    return 0;
}

function m_hitung_kandungan_persen_global(me,bagan_parent_tr_obat){
    let table=bagan_parent_tr_obat.parents('#m_table_obat');
    let bagan_form_me='';
    if(table.length===1){
        let name_class_bagan='.m_tr_obat';
        bagan_form_me=me.parents(name_class_bagan);
        table = table.DataTable();
        table.rows().every( function ( rowIdx ) {
            $get_kandungan = $( this.node() ).find('.m_kandungan');
            if( $get_kandungan.val().indexOf('%') != -1 ){

                $get_kapasitas =  $( this.node() ).find('.m_jlh_kapasitas');
                $nilai_get_kapasitas=parseFloat($get_kapasitas.val());
                $nilai_get_kapasitas=($nilai_get_kapasitas) ?  $nilai_get_kapasitas : 0;

                nilai_jlh_obat=m_hitung_kandungan_persen($get_kandungan,$nilai_get_kapasitas,bagan_parent_tr_obat);

                if(bagan_form_me.length>=1){
                    class_m_jlh_obat= $( this.node() ).find('.m_jlh_obat');
                    nilai_jlh_obat=pembulatan_c(nilai_jlh_obat);
                    class_m_jlh_obat.val(nilai_jlh_obat);
                    m_hitung_stok_obat(class_m_jlh_obat,name_class_bagan);
                }
            }
        });
    }else{
        let name_class_bagan='.tbl-terpilih';
        bagan_form_me=me.parents(name_class_bagan);
        table=bagan_parent_tr_obat.parents('#tableObatSelected')
        table.find('.tbl-terpilih').each(function(index, value) {
            $get_kandungan = $(this).find('.m_kandungan');
            if( $get_kandungan.val().indexOf('%') != -1 ){

                $get_kapasitas =  $(this).find('.m_jlh_kapasitas');
                $nilai_get_kapasitas=parseFloat($get_kapasitas.val());
                $nilai_get_kapasitas=($nilai_get_kapasitas) ?  $nilai_get_kapasitas : 0;

                nilai_jlh_obat=m_hitung_kandungan_persen($get_kandungan,$nilai_get_kapasitas,bagan_parent_tr_obat);

                if(bagan_form_me.length>=1){
                    class_m_jlh_obat=$(this).find('.m_jlh_obat');
                    nilai_jlh_obat=pembulatan_c(nilai_jlh_obat);
                    class_m_jlh_obat.val(nilai_jlh_obat);
                    m_hitung_stok_obat(class_m_jlh_obat,name_class_bagan);
                }
            }
        });
    }
}

function m_hitung_kandungan(me,parent_table,tag_jlh_racikan){
    let nilai_kandungan=me.val();

    let bagan_parent_tr_obat=me.parents(parent_table);

    let m_jml_racikan=tag_jlh_racikan.val();
    m_jml_racikan=parseFloat(m_jml_racikan);
    m_jml_racikan=(m_jml_racikan) ?  m_jml_racikan : 0;

    let m_jlh_kapasitas=bagan_parent_tr_obat.find('.m_jlh_kapasitas').val();
    m_jlh_kapasitas=parseFloat(m_jlh_kapasitas);
    m_jlh_kapasitas=(m_jlh_kapasitas) ?  m_jlh_kapasitas : 0;

    bagan_parent_tr_obat.find('.m_text_kapasitas').css({"color":"#212529"});
    if(!m_jlh_kapasitas){
        alert('Kapasitas obat masih kosong..!!!');
        bagan_parent_tr_obat.find('.m_text_kapasitas').css({"color":"red"});
        return false;
    }

    if(!m_jml_racikan){
        alert('Jumlah Racik masih kosong..!!!');
        return false;
    }

    if(nilai_kandungan.indexOf('%') != -1){
        nilai_jlh_obat=m_hitung_kandungan_persen(me,m_jlh_kapasitas,bagan_parent_tr_obat);
    }else{
        nilai_jlh_obat=(m_jml_racikan*nilai_kandungan)/m_jlh_kapasitas;
    }

    nilai_jlh_obat=pembulatan_c(nilai_jlh_obat);
    bagan_parent_tr_obat.find('.m_jlh_obat').val(nilai_jlh_obat);

    m_hitung_stok_obat(bagan_parent_tr_obat.find('.m_jlh_obat'),parent_table);

    if( !(nilai_kandungan.indexOf('%') != -1) ){
        m_hitung_kandungan_persen_global(me,bagan_parent_tr_obat);
    }

    return false;
}

function m_hitung_stok_obat(me,parent_table){
    let bagan_parent_tr_obat=me.parents(parent_table);

    let m_jlh_stok=bagan_parent_tr_obat.find('.m_jlh_stok').val();
    m_jlh_stok=parseFloat(m_jlh_stok);
    m_jlh_stok=(m_jlh_stok) ?  m_jlh_stok : 0;

    bagan_parent_tr_obat.find('.m_text_stok').css({"color":"#212529"});
    if(!m_jlh_stok){
        alert('Stok obat masih kosong..!!!');
        bagan_parent_tr_obat.find('.m_text_stok').css({"color":"red"});
        return false;
    }

    let jlh_obat=me.val();

    let sisa_obat=0;
    if(jlh_obat){
        sisa_obat=m_jlh_stok-jlh_obat
        sisa_obat=(isNaN(sisa_obat)) ? 0 : sisa_obat;
    }

    bagan_parent_tr_obat.find('.m_sisa_stok').val(sisa_obat);

    if(sisa_obat<0){
        alert('Maaf stok tidak mencukupi..!!');
        bagan_parent_tr_obat.find('.m_jlh_obat').css({"background-color":"#e57070","color":"#fff"});
        return false;
    }else{
        bagan_parent_tr_obat.find('.m_jlh_obat').css({"background-color":"#fff","color":"#212529"});
    }

    setTimeout(function(){
        hitung_ppn();
    },1000);
}

/*=======================end function hitung Racikan=======================*/

function m_change_jml_racikan(){

    let bagan_parent_table_obat=$(document).find('#m_table_obat');

    var table = bagan_parent_table_obat.DataTable();

    table.rows().every( function ( rowIdx ) {
        $get_kandungan = $( this.node() ).find('.m_kandungan');

        $nilai_get_kandungan=parseFloat($get_kandungan.val());
        $nilai_get_kandungan=($nilai_get_kandungan) ?  $nilai_get_kandungan : 0;

        if($nilai_get_kandungan!=0){
            m_hitung_kandungan($get_kandungan,'.m_tr_obat',$(document).find('#m_jml_racikan'));
        }
    });

    return false;
};

function p_change_jml_racikan(me){

    let parent=me.parents('.bagan-form-racikan');

    let table=parent.find('#tableObatSelected');

    table.find('.tbl-terpilih').each(function(index, value) {
        $get_kandungan = $(this).find('.m_kandungan');

        $nilai_get_kandungan=parseFloat($get_kandungan.val());
        $nilai_get_kandungan=($nilai_get_kandungan) ?  $nilai_get_kandungan : 0;

        if($nilai_get_kandungan!=0){
            m_hitung_kandungan($get_kandungan,'.tbl-terpilih',parent.find('.jml_rc'));
        }
    });

    return false;
};

function set_list_obat(me,data){

    let parent=me.parents('.obat-terpilih');

    let target_bagan=parent.find('.bagan-barang-terpilih');
    let target=target_bagan.find('tbody');

    let check_json=is_valid_json_string(data);
    if(check_json){
        $html='';
        $check_jml=0;
        data_tmp=JSON.parse(data);
        $.each(data_tmp, function(i, item) {
            let value=JSON.parse(data_tmp[i]);
            $id_table=value.kode_barang;
            $sisa_stok=value.stok-value.jlh_obat;

            $get_data={
                'kode_barang':(value.kode_barang) ? value.kode_barang : '',
                'nm_barang':(value.nm_barang) ? value.nm_barang : '',
                'satuan':(value.satuan) ? value.satuan : '',
                'harga':(value.harga) ? value.harga : 0,
                'harga_real':(value.harga_real) ? value.harga_real : 0,
                'jenis_obat':(value.jenis_obat) ? value.jenis_obat : '',
                'stok':(value.stok) ? value.stok : '',
                'kapasitas':(value.kapasitas) ? value.kapasitas : ''
            };

            $get_data=JSON.stringify($get_data);

            $html+='<tr class="tbl-terpilih" data-id='+$id_table+'>';
            $html+='<td></textarea><textarea hidden class="data_obat">'+$get_data+'</textarea>'+value.kode_barang+'/'+value.nm_barang+'</td>';
            $html+='<td>'+value.satuan+'</td>';
            $html+='<td>'+value.harga+'<input type="hidden" class="m_harga_real" value='+value.harga_real+'></input></td>';
            $html+='<td>'+value.jenis_obat+'</td>';
            $html+='<td><span>'+value.stok+'</span><input type="hidden" class="m_jlh_stok" value='+value.stok+'></td>';
            $html+='<td><span>'+value.kapasitas+'</span><input type="hidden" class="m_jlh_kapasitas" value='+value.kapasitas+'></td>';
            $html+='<td><input type="number" step="any" style="width: 80px" class="form-control p_jlh_p1 m_jlh_p1" value='+value.p1+'></td>';
            $html+='<td>/</td>';
            $html+='<td><input type="number" step="any" style="width: 80px" class="form-control p_jlh_p2 m_jlh_p2" value='+value.p2+'></td>';
            $html+='<td><input type="text" style="width: 100px" maxlength="10" class="form-control p_kandungan m_kandungan" value='+value.kandungan+'></td>';
            $html+='<td><input type="number" style="width: 100px" step="any" class="form-control p_jlh_obat m_jlh_obat" value='+value.jlh_obat+'><input type="hidden" class="m_sisa_stok" value='+$sisa_stok+'></input></td>';
            $html+='<td><a href="#" class="btn btn-danger btn-hapus-tbl-terpilih"><span class="iconify" style="font-size: 28px;" data-icon="el:trash-alt"></span></a></td>';
            $html+='</tr>';
            $check_jml++;
        });

        if($check_jml>0){
            target_bagan.show();
            target.html('');
            target.html($html);
        }else{
            target_bagan.hide();
        }
    }else{
        parent.html('');
    }

    return false;
}

function set_list_obat_terpilih(me){
    let bagan_parent=me.parents('.bagan-form-racikan');

    let return_sent=[];
    me.each(function(index, value) {
        let data_obat=$(this).find('.data_obat').html();

        if(data_obat){
            let check_json=is_valid_json_string(data_obat);
            if(check_json){
                data_obat=JSON.parse(data_obat);
                data_obat['p1']=$(this).find('.m_jlh_p1').val();
                data_obat['p2']=$(this).find('.m_jlh_p2').val();
                data_obat['kandungan']=$(this).find('.m_kandungan').val();
                data_obat['jlh_obat']=$(this).find('.m_jlh_obat').val();

                data_obat=JSON.stringify(data_obat);
                return_sent.push(data_obat);
            }
        }
    });
    return JSON.stringify(return_sent);
}

function set_data_form_obat($data){
    $check_json=is_valid_json_string($data);
    if($check_json){
        $data_form_obat=JSON.parse($check_form_obat);
        $.each($data_form_obat, function(i, item) {
            $(document).find('#btn-tambah-racikan').trigger( "click" );
            setTimeout(function(){
                $value=$data_form_obat[i];
                $bagan_form_racikan=$(document).find('.bagan-form-racikan[data-key="'+(i+1)+'"]');

                var new_option = new Option($value.nm_racikan, $value.nm_racikan, true, true);
                $bagan_form_racikan.find('[name="nama_racikan[]"]').append(new_option).trigger('change');

                $bagan_form_racikan.find('[name="nm_racik[]"]').val( ($value.metode_racikan) ? $value.metode_racikan : '' );
                $bagan_form_racikan.find('[name="kd_racik[]"]').val( ($value.kode_racikan) ? $value.kode_racikan : '' );
                $bagan_form_racikan.find('[name="jml_dr[]"]').val( ($value.jml_racikan) ? $value.jml_racikan : '' );
                $bagan_form_racikan.find('[name="keterangan[]"]').val( ($value.keterangan) ? $value.keterangan : '' );

                var new_option = new Option($value.aturan_pk, $value.aturan_pk, true, true);
                $bagan_form_racikan.find('[name="aturan_pakai[]"]').append(new_option).trigger('change');

                $list_obat=$value.list_obat;
                if($list_obat){
                    $list_obat=JSON.stringify($list_obat);
                    $check_list_obat=is_valid_json_string($list_obat);
                    if($check_list_obat){
                        $bagan_form_racikan.find('.obat_json').val($list_obat);
                        $bagan_form_racikan.find('.obat_json').trigger( "change" );
                    }
                }
            },600);
        });
        return true;
    }
    return false;
}

function check_submit(){

    $check_error=[];
    $return_data=[];
    $(document).find('.bagan-form-racikan').each(function(index, value) {
        let bagan_parent=$(this);

        let nm_racikan=bagan_parent.find(".get-nm-racikan").val();
        let metode_racikan=bagan_parent.find(".nm_racik").val();
        let kode_racikan=bagan_parent.find(".kd_racik").val();
        let jml_racikan=bagan_parent.find(".jml_rc").val();
        let aturan_pk=bagan_parent.find(".get-aturan-pakai").val();
        let keterangan=bagan_parent.find(".ket").val();

        if(( nm_racikan.length<1 )){
            $tmp=($check_error['nm_racikan']) ? $check_error['nm_racikan'] : 0;
            $tmp++;
            $check_error['nm_racikan']=$tmp;
        }

        if(( metode_racikan.length<1 )){
            $tmp=($check_error['metode_racikan']) ? $check_error['metode_racikan'] : 0;
            $tmp++;
            $check_error['metode_racikan']=$tmp;
        }

        if(( kode_racikan.length<1 )){
            $tmp=($check_error['metode_racikan']) ? $check_error['metode_racikan'] : 0;
            $tmp++;
            $check_error['metode_racikan']=$tmp;
        }

        if(( jml_racikan.length<1 )){
            $tmp=($check_error['jml_racikan']) ? $check_error['jml_racikan'] : 0;
            $tmp++;
            $check_error['jml_racikan']=$tmp;
        }

        if((  aturan_pk.length<1 )){
            $tmp=($check_error['aturan_pk']) ? $check_error['aturan_pk'] : 0;
            $tmp++;
            $check_error['aturan_pk']=$tmp;
        }

        if((  keterangan.length<1 )){
            $tmp=($check_error['keterangan']) ? $check_error['keterangan'] : 0;
            $tmp++;
            $check_error['keterangan']=$tmp;
        }

        let tbl_terpilih=bagan_parent.find(".tbl-terpilih");
        if(tbl_terpilih.length<=0){
            $tmp=($check_error['list_obat']) ? $check_error['list_obat'] : 0;
            $tmp++;
            $check_error['list_obat']=$tmp;
        }else{
            $data_list_obat=[];
            tbl_terpilih.each(function(index, value) {
                $me=$(this);

                let p1=$me.find('.m_jlh_p1').val();
                p1=parseFloat(p1);
                p1=(p1) ? p1 : 0;

                if((  p1<=0 )){
                    $tmp=($check_error['p1']) ? $check_error['p1'] : 0;
                    $tmp++;
                    $check_error['p1']=$tmp;
                }

                let p2=$me.find('.m_jlh_p2').val();
                p2=parseFloat(p2);
                p2=(p2) ? p2 : 0;

                if((  p2<=0 )){
                    $tmp=($check_error['p2']) ? $check_error['p2'] : 0;
                    $tmp++;
                    $check_error['p2']=$tmp;
                }

                let jlh_obat=$me.find('.m_jlh_obat').val();
                jlh_obat=parseFloat(jlh_obat);
                jlh_obat=(jlh_obat) ? jlh_obat : 0;

                if((  jlh_obat<=0 )){
                    $tmp=($check_error['jlh_obat']) ? $check_error['jlh_obat'] : 0;
                    $tmp++;
                    $check_error['jlh_obat']=$tmp;
                }

                let sisa_stok=$me.find('.m_sisa_stok').val();
                sisa_stok=parseFloat(sisa_stok);
                sisa_stok=(sisa_stok) ? sisa_stok : 0;

                if((  sisa_stok<0 )){
                    $tmp=($check_error['sisa_stok']) ? $check_error['sisa_stok'] : 0;
                    $tmp++;
                    $check_error['sisa_stok']=$tmp;
                }

                $get_list_obat=$me.find('.data_obat').html();

                if($get_list_obat){
                    $check_json=is_valid_json_string($get_list_obat);
                    if($check_json){
                        $get_list_obat=JSON.parse($get_list_obat);
                        $get_list_obat['p1']=p1;
                        $get_list_obat['p2']=p2;
                        $get_list_obat['kandungan']=$me.find('.m_kandungan').val();
                        $get_list_obat['jlh_obat']=jlh_obat;
                        $get_list_obat['sisa_stok']=sisa_stok;

                        $data_list_obat.push(JSON.stringify($get_list_obat));
                    }
                }
            });

            $get_data={
                'nm_racikan':(nm_racikan) ? nm_racikan : '',
                'metode_racikan':(metode_racikan) ? metode_racikan : '',
                'kode_racikan':(kode_racikan) ? kode_racikan : '',
                'jml_racikan':(jml_racikan) ? jml_racikan : 0,
                'aturan_pk':(aturan_pk) ? aturan_pk : '',
                'keterangan':(keterangan) ? keterangan : '',
                'list_obat':($data_list_obat.length>0) ? $data_list_obat : ''
            };

            $return_data.push($get_data);
        }
    });
    $(document).find('#data_form_obat').val('');
    $(document).find('#data_form_obat').val(JSON.stringify($return_data));

    if($check_error['nm_racikan']){
        alert('Nama Racikan tidak boleh kosong');
        return false;
    }

    if($check_error['metode_racikan']){
        alert('Metode Racikan tidak boleh kosong');
        return false;
    }

    if($check_error['jml_racikan']){
        alert('Jumlah Racikan tidak boleh kosong');
        return false;
    }

    if($check_error['aturan_pk']){
        alert('Aturan Pakai tidak boleh kosong');
        return false;
    }

    if($check_error['keterangan']){
        alert('Keterangan tidak boleh kosong');
        return false;
    }

    if($check_error['list_obat']){
        alert('Maaf ada list obat terpilih masih kosong pada salah satu racikan anda');
        return false;
    }

    if($check_error['p1']){
        alert('Maaf ada nilai p1 yang masih kosong / lebih kecil dari 0');
        return false;
    }

    if($check_error['p2']){
        alert('Maaf ada nilai p2 yang masih kosong / lebih kecil dari 0');
        return false;
    }

    if($check_error['jlh_obat']){
        alert('Maaf jumlah obat ada yang masih kosong / lebih kecil dari 0');
        return false;
    }

    if($check_error['sisa_stok']){
        alert('Maaf ada sisa stok obat yang tidak cukup');
        return false;
    }

    return true;
}
