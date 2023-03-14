$('.poli').select2({
    ajax:{
        url: base_url +"/jadwal-dokter-hfis/poli",
        data:{poli:poli},
        dataType: "json",
        delay: 250,
        data: function(params){
            return{
                poli : params.term
            };
        },
        processResults: function(data){
            var results = [];

            $.each(data, function(index, item){
                results.push({
                    id : item.kode,
                    text : item.nama
                });
            });
            return {
                results: results
            };
        }
    }
});