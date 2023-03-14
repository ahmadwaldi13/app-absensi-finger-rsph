function get_pds(){
    $psd_1=[];
    $data=[];
    if($(document).find('#periksa_sub_tmp').val()){
        $data=$(document).find('#periksa_sub_tmp').val();
        $data=$data.split('@');
        if($data.length>=1){
            $.each( $data, function( key, value ) {
                $exp=value.split('$');
                if( ($exp[0].length) && ($exp[1].length) ){
                    $psd_1.push($exp[0]);
                }
            });
        }
        $.unique($psd_1);
    }

    return {
        psd_1:$psd_1,
        psd_2:$data,
    };
}


function get_permintaan_sub(){
    $checked_list=[];

    $get_pds=get_pds();
    $target=$(document).find('#tamplate_lab');

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
        $data_sent = $checked_list.join('@');

        $.ajax({
            url: base_url +"/patologi-klinis/ajax",
            method      : "GET",
            async       : false,
            cache       : false,
            ContentType : 'application/json',
            data        : {data_sent:$data_sent},
            success: function (hasil) {
                $target.html(hasil.html);
                $jml=$target.find('#count_data').val();
                
                if($jml==1){
                    $data_tabel=$target.find('.data-table-3');
                    if($data_tabel){
                        let table_leng_page = (typeof $data_tabel.attr('data-table-page') != "undefined" || $data_tabel.attr('data-table-page') != null) ? $data_tabel.attr('data-table-page') : 10 ;
                        $data_tabel.DataTable({
                            ordering: false,
                            paging: true,
                            pageLength: table_leng_page,
                            info: false,
                            searching: true,
                            language: { search: "" },
                            fnDrawCallback: function () {
                                $(".dataTables_filter").find("input[type='search']").attr("hidden", true);
                            },
                        });

                        $data_tabel.css("width","100%");
                        $target.find('.dataTables_length').hide();
                        $(document).find('#bagan-save').show();
                    }
                }else{
                    $target.html('');
                    $(document).find('#bagan-save').hide();
                }
            },
            error  : function(hasil){
                console.log('error');
            },
        });
        
    }else{
        $target.html('');
        $(document).find('#bagan-save').hide();
    }
    

    return false;
}

function get_checklist_sub(){
    $checked_list=[];
    $return='';

    $get_pds=get_pds();

    $target=$(document).find('#tamplate_lab');
    $tabel=$target.find('.data-table-3');
    $table = $tabel.DataTable();
    $table.rows().every( function ( rowIdx ) {
        if($get_pds.psd_2.length>=1){
            if( jQuery.inArray( $( this.node() ).find('.childCheckList').val(), $get_pds.psd_2 )!=-1 ){
                $( this.node() ).find('.childCheckList').prop( "checked",true );
            }
        }

        if($( this.node() ).find('.childCheckList').is(':checked')){
            $me_checked=$( this.node() ).find('.childCheckList');
            $checked_list.push( $me_checked.val() );
        }
    });

    if($checked_list.length>=1){
        $return = $checked_list.join('@');        
    }

    $(document).find('#periksa_sub').val($return);
}


$(document).delegate("#tamplate_lab .search-data-table-3", "change keyup paste", function() {
    let parent=$(document).find('#tamplate_lab');
    parent.find('.data-table-3').dataTable().fnFilter($(this).val());
});



$("#tanggal_permintaan").on("change keyup", function () {
    let date = $(this).val();
    let tgl = date.substring(0, 10);

    $.ajax({
        url: base_url +"/api/permintaan/pl/nomor?tgl=" +tgl,
        method: "get",
        success: function (hasil) {
            $("#nomor_permintaan").val(hasil.content);
        },
    });
});


$(document).delegate(".pil_p1", "change", function(event) {
    get_permintaan_sub();
});

$(document).delegate(".childCheckList", "change", function(event) {
    get_checklist_sub();
});

$(document).delegate("#btn_submit", "click", function(event) {
    
    $jml_psd1=0;
    $jml_psd2=0;
    $(document).find('.pil_p1').each(function () {
        if(this.checked){
            $jml_psd1++;
        }
    });

    $target=$(document).find('#tamplate_lab');
    $tabel=$target.find('.data-table-3');
    $table = $tabel.DataTable();
    $table.rows().every( function ( rowIdx ) {
        if($( this.node() ).find('.childCheckList').is(':checked')){
            $jml_psd2++;
        }
    });

    if($jml_psd1<=0){
        alert('Kode Periksa harus di pilih minimal 1');
        return false;
    }else if($jml_psd2<=0){
        alert('Pemeriksaan harus di pilih minimal 1');
        return false;
    }
});

$(document).ready(function () {
    $(document).find('#bagan-save').hide();
    get_permintaan_sub();
    get_checklist_sub();
});
