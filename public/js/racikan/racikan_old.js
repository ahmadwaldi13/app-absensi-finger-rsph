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
    });

    $($bagan).find('.required-form').each(function (key, value) {
        $(this).prop('required',true);
        $(this).removeClass( "required-form" );
    });
    select2();
    select2_racikan();
}

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

function set_list_table_barang($data){
    $check_tampung=$(document).find('#tampung_data[data-check=1]').html();
    if($check_tampung){
        $list_obat=$(document).find('.list-aturan[data-id='+$data.id_tr+']');
        if($list_obat){
            $list_obat.find('.jlh_obat').val($data.jlh_input);
            $list_obat.find('.jlh_p1').val($data.jlh_p1);
            $list_obat.find('.jlh_p2').val($data.jlh_p2);
            $list_obat.find('.kandungan').val($data.kandungan);
        }
    }
}

function hitung_ppn(){
    $harga_resep=0;
    $total_harga_resep=0;
    $(document).find('#tampung_data li').each(function () {
        $data=$(this).find('.item').html();
        if($data){
            $data=JSON.parse($data);
            $checked='';
            $jlh=$data.jlh_input;

            $harga_resep=parseFloat($data.harga_real)*parseFloat($jlh);

            $total_harga_resep=$total_harga_resep+parseFloat($harga_resep);
        }

        $(document).find('#total_harga_resep').html(number_format($total_harga_resep,digit_decimal($total_harga_resep),',','.'));

        $total_harga_ppn=$total_harga_resep+12100;
        $(document).find('#total_harga_ppn').html(number_format($total_harga_ppn,digit_decimal($total_harga_ppn),',','.'));
    });
    if ( $(document).find('#tampung_data li').length == 0 ) {
        $(document).find('#total_harga_resep').html(0);
        $(document).find('#total_harga_ppn').html(0);
    }
}

function set_list_barang(){
    $target_bagan=$(document).find('#bagan-barang-terpilih');
    
    if($target_bagan){
        $target=$target_bagan.find('tbody');
        if($target){
            $html='';
            $check_jml=0;
            $total_harga_resep=0;
            $(document).find('#tampung_data li').each(function () {
                $data=$(this).find('.item').html();
                if($data){
                    $data=JSON.parse($data);
                    $checked='';
                    $jlh=$data.jlh_input;
                    
                    $html+='<tr class="tbl-terpilih" data-id='+$data.id_tr+'>';
                    $html+='<td>'+$data.kode_barang+'</td>';
                    $html+='<td>'+$data.nm_barang+'</td>';
                    $html+='<td>'+$data.satuan+'</td>';
                    $html+='<td>'+$data.harga+'</td>';
                    $html+='<td>'+$data.jenis_obat+'</td>';
                    $html+='<td>'+$data.stok+'</td>';
                    $html+='<td>'+$jlh+'</td>';
                    $html+='<td>'+$data.jlh_p1+'/'+$data.jlh_p2+'</td>';
                    $html+='<td>'+$data.kandungan+'</td>';
                    $html+='<td><a href="#" class="terpilih-delete"><span class="iconify text-danger" style="font-size: 24px;" data-icon="el:trash-alt"></span></a></td>';
                    $html+='</tr>';
                    $check_jml++;

                    set_list_table_barang($data);
                }
            });

            $(document).find('#tampung_data').attr('data-check',0);

            if($check_jml>0){
                $target_bagan.show();
                $target.html('');
                $target.html($html);
            }else{
                $target_bagan.hide();
            }
        }
    }

    return false;
}

function get_list_barang($this){
    $parent=$this.parents('.list-aturan');
    $key_parent = (typeof $parent.attr('data-id') != "undefined" || $parent.attr('data-id') != null) ? $parent.attr('data-id') : '' ;
    $data_parent = (typeof $parent.attr('data-key') != "undefined" || $parent.attr('data-key') != null) ? $parent.attr('data-key') : '' ;

    $input_jumlah=$parent.find('.jlh_obat');
    if($input_jumlah){
        $input_jumlah=$input_jumlah.val();
    }else{
        $input_jumlah=0;
    }

    $input_p1=$parent.find('.jlh_p1');
    if($input_p1){
        $input_p1=$input_p1.val();
    }else{
        $input_p1=1;
    }

    $input_p2=$parent.find('.jlh_p2');
    if($input_p2){
        $input_p2=$input_p2.val();
    }else{
        $input_p2=1;
    }

    $input_kandungan=$parent.find('.kandungan');
    if($input_kandungan){
        $input_kandungan=$input_kandungan.val();
    }else{
        $input_kandungan='';
    }

    if($input_jumlah){
        if($data_parent){
            $target=$(document).find('#tampung_data');
            $data_parent=JSON.parse($data_parent);
            if(parseFloat($data_parent.stok)<parseFloat($input_jumlah)){
                alert('Maaf stok tidak mencukupi..!!');
                $parent.find('.jlh_obat').val(0);
                return false;
            }

            $data_parent.id_tr=$key_parent;
            $data_parent.jlh_input=$input_jumlah;
            $data_parent.jlh_p1=$input_p1;
            $data_parent.jlh_p2=$input_p2;
            $data_parent.kandungan=$input_kandungan;

            $data_parent=JSON.stringify($data_parent);
            $check_input=$target.find('li#'+$key_parent);
            if($check_input.find('.item').html()){
                $check_input.find('.item').html($data_parent);    
            }else{
                $target.append('<li id='+$key_parent+'><textarea class="item" name="list_obat[]">'+$data_parent+'</textarea></li>');
            } 
        }
        
        $parent.attr('data-key',$data_parent);

        set_list_barang();
        hitung_ppn();
    }
    return false;
}

$(".change-key").on("change", function () {
    get_list_barang($(this));
    return false;
});

$(document).delegate(".terpilih-delete", "click", function(event) {
    $parent=$(this).parents('.tbl-terpilih');
    $key_parent = (typeof $parent.attr('data-id') != "undefined" || $parent.attr('data-id') != null) ? $parent.attr('data-id') : '' ;

    $li_parent=$(document).find('#tampung_data');
    $li=$li_parent.find('li#'+$key_parent);

    $list_obat=$(document).find('.list-aturan[data-id='+$key_parent+']');
    $list_obat.find('.jlh_obat').val('');
    $list_obat.find('.kandungan').val('');

    $parent.remove();
    $li.remove();

    hitung_ppn();

    $target_bagan=$(document).find('#bagan-barang-terpilih');
    $length_item_target=$target_bagan.find('tbody tr').length;
    if($length_item_target<=0){
        $target_bagan.hide();
    }

    return false;
});

$(document).delegate("#check_submit", "click", function(event) {
    $target=$(document).find('#tampung_data li');
    if($target.length<=0){
        alert('Maaf, silahkan masukkan terlebih dahulu obat yang mau diberikan...!!!');    
        return false;
    }
    return true;
});

function set_feeback_form_racik(){
    $bagan='.bagan-form-racikan';
    $get_feedback=$(document).find('#data_racikan_feedback');
    $data_feedback='';
    if($get_feedback.html()){
        $data_feedback=JSON.parse($get_feedback.html());
    }
    if($data_feedback){
        $(document).find($bagan).each(function (key, value) {
            if($data_feedback[key]){
                $value_fe=JSON.parse($data_feedback[key]);
                // $(this).find('[name="nama_racikan[]"]').val( ($value_fe.nama_racikan) ? $value_fe.nama_racikan : '' );
                $(this).find('[name="nm_racik[]"]').val( ($value_fe.nm_racik) ? $value_fe.nm_racik : '' );
                $(this).find('[name="kd_racik[]"]').val( ($value_fe.kd_racik) ? $value_fe.kd_racik : '' );
                $(this).find('[name="jml_dr[]"]').val( ($value_fe.jml_dr) ? $value_fe.jml_dr : '' );
                $(this).find('[name="keterangan[]"]').val( ($value_fe.keterangan) ? $value_fe.keterangan : '' );
            
                var new_option = new Option($value_fe.aturan_pakai, $value_fe.aturan_pakai, true, true);
                $(this).find('[name="aturan_pakai[]"]').append(new_option).trigger('change');

                var new_option = new Option($value_fe.nama_racikan, $value_fe.nama_racikan, true, true);
                $(this).find('[name="nama_racikan[]"]').append(new_option).trigger('change');
            }
        }); 
    }
}

$(document).ready(function() {
    select2();
    select2_racikan();
    set_list_barang();
    hitung_ppn();
    $data_feedback=$(document).find('#data_racikan_feedback');
    if($data_feedback.html()){
        $data_form=JSON.parse($data_feedback.html());
        for (let i = 1; i < $data_form.length; i++) {
            $(document).find('#btn-tambah-racikan').trigger('click');
        }
        set_feeback_form_racik();
    }
});