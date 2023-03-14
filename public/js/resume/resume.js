
$(document).ready(function() {
    $.each( $('.form-duplicate'), function( key, value ) {
        $(this).trigger( "change" );
    });
});

$(".send_resume").on("click", function () {
    $target = (typeof $(this).attr('data-target') != "undefined" || $(this).attr('data-target') != null) ? $(this).attr('data-target') : '' ;
    if($target){
        $target=(typeof $(document).find($target) != "undefined" || $(document).find($target) != null) ? $(document).find($target) : '' ;
        if($target){
            $target.trigger("click");
        }
    }
    return false;
});

$('.get-diagnosa').each( function(idx, elem) {
    $(this).select2({
        tags: true,
        ajax: {
            url: base_url +'/isi-resume/diagnosa-list',
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
                    obj.id = obj.kd_penyakit;
                    obj.text = obj.nm_penyakit;
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
            if (data.loading) {
                return data.text;
            }

            $hasil_text=data.text;
            $hasil_kode='';
            if(data.nm_penyakit){
                $hasil_text=data.nm_penyakit;
            }

            if(data.kd_penyakit){
                $hasil_kode=data.kd_penyakit;
            }

            $(data.element).attr('data-custom-attribute', 1);

            return $hasil_text+(data.kd_penyakit ? '-'+data.kd_penyakit : '');
    
        },
        templateSelection: function (data) {
            return data.text || data.id;
        },
    });
});

$('.get-prosedur').each( function(idx, elem) {
    $(this).select2({
        tags: true,
        ajax: {
            url: base_url + '/isi-resume/prosedur-list',
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
                    obj.id = obj.kode;
                    obj.text = obj.deskripsi_panjang;
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
            if (data.loading) {
                return data.text;
            }

            $hasil_text=data.text;
            $hasil_kode='';
            if(data.deskripsi_panjang){
                $hasil_text=data.deskripsi_panjang;
            }

            if(data.kode){
                $hasil_kode=data.kode;
            }

            $(data.element).attr('data-custom-attribute', 1);

            return $hasil_text+(data.kode ? '-'+data.kode : '');
    
        },
        templateSelection: function (data) {
            return data.text || data.id;
        },
    });
});

$(".get-diagnosa,.get-prosedur").on("select2:select", function (e) {
    $target_text = (typeof $(this).attr('data-target-text') != "undefined" || $(this).attr('data-target-text') != null) ? $(this).attr('data-target-text') : '' ;
    $target_kode = (typeof $(this).attr('data-target-kode') != "undefined" || $(this).attr('data-target-kode') != null) ? $(this).attr('data-target-kode') : '' ;
    
    $parameter_=$(this).select2("data");
    $data=e.params.data;
    if($parameter_[0]){
        $parameter=$parameter_[0];
        if($data){
            $return_text='';
            if($(this).hasClass('get-diagnosa')){
                $return_text=$data.text;
                if($data.nm_penyakit){
                    $return_text=$data.nm_penyakit;
                }

                $return_kode='';
                if($data.kd_penyakit){
                    $return_kode=$data.kd_penyakit;   
                }
            }else if($(this).hasClass('get-prosedur')){
                $return_text=$data.text;
                if($data.deskripsi_panjang){
                    $return_text=$data.deskripsi_panjang;
                }

                $return_kode='';
                if($data.kode){
                    $return_kode=$data.kode;   
                }
            }

            $parameter.text=$return_text;
            var newOption = new Option($parameter.text, $parameter.id, false, false);
            $(this).append(newOption).trigger('change');
        }

        if($target_text){
            let data = $target_text.split("|");
            $.each( data, function( key, value ) {
                $me=(typeof $(document).find(value) != "undefined" || $(document).find(value) != null) ? $(document).find(value) : '' ;
                if($me){
                    $taq='input';
                    if($me.prop("tagName")){
                        $taq=$me.prop("tagName").toLowerCase();    
                    }
                    if($taq=='input' || $taq=='selected'){
                        $type='val';
                    }else{
                        $type='html';
                    }

                    if($type=='val'){
                        $me.val($return_text);
                    }else{
                        $me.html($return_text);
                    }
                }
            });
        }

        if($target_kode){
            let data = $target_kode.split("|");
            $.each( data, function( key, value ) {
                $me=(typeof $(document).find(value) != "undefined" || $(document).find(value) != null) ? $(document).find(value) : '' ;
                if($me){
                    $taq='input';
                    if($me.prop("tagName")){
                        $taq=$me.prop("tagName").toLowerCase();    
                    }
                    if($taq=='input' || $taq=='selected'){
                        $type='val';
                    }else{
                        $type='html';
                    }

                    if($type=='val'){
                        $me.val($return_kode);
                    }else{
                        $me.html($return_kode);
                    }
                }
            });
        }
    }
    return false;
});
