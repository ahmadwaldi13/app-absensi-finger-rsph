$(document).ready(function(){
    $('#jkn_online').on('show.bs.modal', function (e) {
        $("#wait").show();
        var noKartu = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'GET',
            url : base_url +"/referensi-bpjs/noka",
            data :  'noKartu='+ noKartu,
            beforeSend: function(){
                $("#wait").show();
            },
            success : function(data){ 
            var hasil = data;  
            if (hasil.metadata.code == '200') {
                $("#jkn_noKartu").val(hasil.peserta.noKartu);
                $("#jkn_norm").val(hasil.peserta.mr.noMR);
                $("#jkn_nama").val(hasil.peserta.nama);
                $("#jkn_nik").val(hasil.peserta.nik);
                $("#jkn_hp").val(hasil.peserta.mr.noTelepon);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops ada kesalah...',
                    text: ''+hasil.metadata.message+'',
                    timer: 10000
                })
            }   
            },
            complete:function(data){
                $("#wait").hide();
            }
        });
     });
});

$(document).ready(function(){
    $('#jkn_jeniskunjungan').change(function(){
      var rujukan=$(this).val();
      var noka = document.getElementById('jkn_noKartu').value;
      var tgl_sep = document.getElementById('dateSep').value;
      console.log(tgl_sep);
        if (rujukan == '1') {
            $.ajax({
                url: base_url +"/referensi-bpjs/cek_rujukan",
                method : "GET",
                data : {noka: noka},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                      html += '<option value="'+data[i].noKunjungan+'">'+data[i].provPerujuk.nama+' - '+data[i].poliRujukan.nama+'</option>';
                    }
                    $('.jkn_no_referensi').html(html);
                }
            });
        }else if(rujukan == '4') {
          $.ajax({
              url : base_url +"/referensi-bpjs/cek_rujukan_rs",
              method : "GET",
              data : {noka: noka},
              async : false,
              dataType : 'json',
              success: function(data){
                  var html = '';
                  var i;
                  for(i=0; i<data.length; i++){
                      html += '<option value="'+data[i].noKunjungan+'">'+data[i].provPerujuk.nama+' - '+data[i].poliRujukan.nama+'</option>';
                  }
                  $('.jkn_no_referensi').html(html);
              }
          });
        }else{
          $.ajax({
              url : base_url +"/referensi-bpjs/cek_surat_kontrol",
              method : "GET",
              data : {tgl_sep: tgl_sep},
              async : false,
              dataType : 'json',
              success: function(data){
                  var html = '';
                  var i;
                  for(i=0; i<data.length; i++){
                      html += '<option value="'+data[i].noSuratKontrol+'">'+data[i].noSuratKontrol+' - '+data[i].nama+'</option>';
                  }
                  $('.jkn_no_referensi').html(html);
              }
          });
        }
    });
});

$('.jkn_kodepoli').select2({
    dropdownParent: $('#jkn_online'),
    ajax:{
        url: base_url +"/referensi-bpjs/poli_local",
        data:{jkn_kodepoli: jkn_kodepoli},
        dataType: "json",
        delay: 250,
        data: function(params){
            return{
                jkn_kodepolili : params.term
            };
        },
        processResults: function(data){
            var results = [];

            $.each(data, function(index, item){
                results.push({
                    id : item.kode+'@'+item.nama,
                    text : item.nama
                });
            });
            return {
                results: results
            };
        }
    }
});

$(document).ready(function(){
    $('#jkn_kodepoli').change(function(){
        var poli = document.getElementById('jkn_kodepoli').value; 
        $.ajax({
            url : base_url +"/referensi-bpjs/reff-poli",
            method : "GET",
            data : {poli: poli},
            async : false,
            dataType : 'json',
            success: function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i].kodedokter+'@'+data[i].kapasitaspasien+'@'+data[i].namadokter+'@'+data[i].jadwal+'@'+data[i].kodesubspesialis+'">'+data[i].namadokter+'</option>';
                }
                $('.jkn_dpjp').html(html);
                 
            }
        });
    });
});