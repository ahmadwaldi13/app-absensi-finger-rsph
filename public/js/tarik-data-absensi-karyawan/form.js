

$('#proses').click(function(e) {
    e.preventDefault();
    
    $url=$(document).find('#url_get_mesin').val();
    $tanggal=$(document).find('#tgl').val();
    $data_sent=$tanggal;

    $.ajax({
        type: "GET",
        url:$url,
        // data: { data_sent: $data_sent },
        success: function(hasil){
            $bagan=$(document).find('#progress-item');
            $bagan.html(hasil.html);
            // setTimeout(function(){
                proses_data();
            // }, 2000);
        },
        error: function(xhr, status, error){
            console.log(error);
        }
    });

    return false;
});

function proses_data(){
    $get_data=$(document).find('#progress-item').find('tbody').find('tr[ data-status="0" ]');
    if($get_data.length){
        $get_data.each( function(idx, elem) {
            $data=$(this).find('.data');
            $key=$data.find('.id_mesin').val();
            $status=$(this).attr('data-status');
            if($key && $status==0){
                // setTimeout(function(){
                    import_data($key,1,0,0);
                // }, 2000);
                return false;
            }
        });
    }else{
        setTimeout(function(){
            alert('Proses Selesai');
        }, 800);
        return false;
    }

    return false;
}

function import_data($key,$urut_proses,$start_query,$end_query){
    $url=$(document).find('#url_proses').val();
    $tanggal=$(document).find('#tgl').val();
    
    $.ajax({
        type: "GET",
        url:$url,
        data:{
            key:$key,
            tanggal:$tanggal,
            urut_proses:$urut_proses,
            start_query:$start_query,
            end_query:$end_query,
        },
        success: function(hasil){
            $tampil_console={
                'callback':hasil.hasil,
                'proses_ke':hasil.no_proses,
            }
            console.log($tampil_console);

            if(hasil.hasil==504){
                alert('Proses Terhenti, System Error');
                return false;
            }

            $get_html=$(document).find('#progress-item').find('#item_'+$key);
            $progress=$get_html.find('.progress-bar');
            $progress.css('width',hasil.progres_bar+'%');
            $get_html.find('#bar-progress-label').html(hasil.progres_bar+'%');
            if(hasil.status_mesin==1){
                $get_html.find('.status_mesin').html(hasil.message);
                $progress.css('width','0%');
                $get_html.find('#bar-progress-label').html('0%');
            }
            
            if(hasil.proses_selesai==0){
                // setTimeout(function(){
                    import_data($key,hasil.no_proses,hasil.start_query,hasil.end_query);
                // }, 1000);
            }else{
                $get_html.attr('data-status',1);
                $target_jml_progress=$(document).find('#jumlah_progres_dinas');
                $jml_progress=parseInt($target_jml_progress.val());
                
                $jml_progress=$jml_progress+1;
                $target_jml_progress.val($jml_progress);

                // setTimeout(function(){
                    proses_data();
                // }, 2000);
                return false;
            }
        },
        error: function(xhr, status, error){
            console.log(error);
        }
    });

    return false;
}