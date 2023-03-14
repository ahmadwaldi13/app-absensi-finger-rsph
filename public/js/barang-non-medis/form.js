$(document).delegate("#pil_jenis", "click", function(e) {
    e.stopPropagation();

    $(document).find('.pil').one('click', function(e) {
        var data_ = $(this).data('item').split("@");
        if(typeof data_[1] != 'undefined') {
            $kode=data_[1];
            if($kode){
                $.ajax({
                    url:base_url +"/ajax?action=kode_barang_by_jenis",
                    data : {kode:$kode},
                    method: "GET",
                    async       : false,
                    cache       : false,
                    ContentType : 'application/json',
                    success: function (hasil) {
                        $nilai=hasil.original.content;
                        $(document).find('#kode_brng').val($nilai);
                    },
                });
            }

        }
    });   
});