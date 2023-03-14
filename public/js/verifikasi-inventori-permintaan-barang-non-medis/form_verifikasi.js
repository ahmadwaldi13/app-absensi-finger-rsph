$(document).delegate("#btn-setujuh", "click", function () {
    $(document).find('#bagan_question_1').hide();
    $(document).find('#bagan_question_2').show();
    $(document).find('#bagan-form-setujuh').show();
    $(document).find('.form-show').show();
    $(document).find('#bagan-form-tolak').hide();
    passing_data();
    hitung();
    hitungStok();
    return false;
});

$(document).delegate("#btn-tolak", "click", function () {
    $(document).find('#bagan_question_1').hide();
    $(document).find('#bagan_question_2').show();
    $(document).find('#bagan-form-setujuh').hide();
    $(document).find('.form-show').hide();
    $(document).find('#bagan-form-tolak').show();
    return false;
});

$(document).delegate(".btn-batal", "click", function () {
    $(document).find('#bagan_question_1').show();
    $(document).find('#bagan_question_2').hide();
    $(document).find('#bagan-form-setujuh').hide();
    $(document).find('.form-show').hide();
    $(document).find('#bagan-form-tolak').hide();
    $(document).find('.item-barang').css('background', 'none');
    $(document).find('.item-barang-header').css('background', 'none');
    return false;
});

function passing_data() {
    $data_sent = {};
    $target = $(document).find('#item_list_terpilih');
    if ($($target).html()) {
        $data_sent = JSON.parse($target.html());
    }

    $(document).find('.jml-text').each(function () {
        $parent = $(this).parents('.item-barang');
        $kode_data = $(this).data('key');

        $stok = $parent.find('.stok-value').val();

        if ($data_sent[$kode_data]) {
            if ($stok > 0) {
                $(this).val($data_sent[$kode_data].jml);
            }
        } else {
            $(this).val(0);
        }
    });
}

function hitungStok() {
    $(document).find('.jml-text').each(function () {
        $parent = $(this).parents('.item-barang');
        $key_item = $parent.data('uniq');
        $bagan_top = $(document).find('.item-barang-data-top[data-uniq="' + $key_item + '"]');
        $bagan_header = $(document).find('.item-barang-header[data-uniq="' + $key_item + '"]');

        $stok = parseFloat($parent.find('.stok-value').val());

        $check_stok_kosong = 0;
        $check_stok_kurang = 0;
        if ($stok <= 0) {
            $check_stok_kosong = 1;
            $parent.find('.jml-value').val(0);
            $parent.find('.jml-text').val(0);
        } else {
            $jml = parseFloat($parent.find('.jml-value').val());
            if ($jml > $stok) {
                $check_stok_kurang = 1;
            } else {
                $check_stok_kurang = 0;
            }
        }

        if ($check_stok_kosong == 1) {
            $parent.css('background', '#cbcbcb');
            $bagan_top.css('background', '#cbcbcb');
            $bagan_header.css('background', '#cbcbcb');

            $bagan_top.find('.status-text').html('Stok Kosong');
            $bagan_top.find('.status-text').css('color', '#212529');

            $(this).removeClass('form-active');
        } else {
            if ($check_stok_kurang == 1) {
                $parent.css('background', '#fac9c9');
                $bagan_top.css('background', '#fac9c9');
                $bagan_header.css('background', '#fac9c9');

                $bagan_top.find('.status-text').html('Stok Tidak cukup');
                $bagan_top.find('.status-text').css('color', '#ea0101');
            } else {
                $parent.css('background', 'none');
                $bagan_top.css('background', '#aff5de');
                $bagan_header.css('background', 'none');

                $bagan_top.find('.status-text').html('');
                $bagan_top.find('.status-text').css('color', '#212529');

                $(this).addClass('form-active');
            }
        }
    });
}

function hitung() {
    $total_jml = 0;
    $total_total = 0;
    $data_sent = {};

    $(document).find('.jml-text').each(function () {
        $parent = $(this).parents('.item-barang');
        $kode_data = $(this).data('key');
        $stok = $parent.find('.stok-value').val();

        if ($stok <= 0) {
            $(this).prop('disabled', true);
        } else {
            $(this).prop('disabled', false);
        }
        console.log($(this));
        $jml_permintaan = parseFloat($parent.find('.jml-permintaan').val())
        $stok = parseFloat($parent.find('.stok-value').val());

        if ($stok <= 0) {
            $(this).val(0);
        }
        $nilai_text = $(this).val();

        $nilai = $nilai_text.replace(/\./g, "");
        $nilai = $nilai.replace(/\,/g, ".");
        $nilai = parseFloat($nilai);
        $parent.find('.jml-value').val($nilai);
        console.log($parent);
        if ($nilai > 0) {
            $data_sent[$kode_data] = {
                'jml': $nilai
                // 'keterangan_pengeluaran': $(`textarea[data-key="${$kode_data}"]`).val()
            };
        }
        if ($nilai > $jml_permintaan) {
            alert("Jumlah yang disetujui tidak boleh melebih jumlah permintaan !!");
            $(this).val($jml_permintaan);
        } else if ($nilai < 0) {
            alert("Jumlah yang disetujui tidak boleh minus !!");
            $nilai = 0
            $(this).val($nilai);
        }
        $total_jml = parseFloat($total_jml) + $nilai;

        $harga = $parent.find('.harga-value').val();
        $total = $nilai * $harga;
        $parent.find('.total-value').val($total);


        $total_total = $total + $total_total;

        $total_text = number_format($total, digit_decimal($total), ',', '.');
        $parent.find('.total-text').html($total_text);

        // mengurangi stok yang tampil pada html
        $stok = parseFloat($parent.find('.stok-dasar').val()) - $nilai;
        $parent.find('.stok-text').html($stok);
    });
    console.log($data_sent)
    if (!jQuery.isEmptyObject($data_sent)) {
        $return = JSON.stringify($data_sent);
        $target = $(document).find('#item_list_terpilih');
        $target.html($return);
    }

    $(document).find('.total-jml').html(number_format($total_jml, digit_decimal($total_jml), ',', '.'));
    $(document).find('.total-total').html(number_format($total_total, digit_decimal($total_total), ',', '.'));
}

function keterangan_pengeluaran() {

}

$(document).delegate(".jml-text", "change", function () {
    hitungStok();
    hitung();
    return false;
});

$(document).delegate(".ket-barang-inventori", "change", function (e) {
    const data_key = $(this).data('key');
    const json_item_list_terpilih = $(document).find('#item_list_terpilih').html();
    let item_list_terpilih = JSON.parse(json_item_list_terpilih);

    item_list_terpilih[data_key] = {
        ...item_list_terpilih[data_key],
        'keterangan_pengeluaran': $(this).val()
    }
    $(document).find("#item_list_terpilih").val(JSON.stringify(item_list_terpilih));


})