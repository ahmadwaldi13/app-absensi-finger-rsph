
$("#tanggal").on("change keyup", function () {
    $tanggal = (typeof $(document).find('#tgl') != "undefined" || $(document).find('#tgl') != null) ? $(document).find('#tgl') : '';

    if ($tanggal) {
        $.ajax({
            url: base_url + "/api/isi-resep/nomor?tgl=" + $tanggal.val(),
            method: "get",
            success: function (resultDataAnatomi) {
                $("#no_resep").val(resultDataAnatomi.content);
            },
        });
    }
});

function select2() {
    $(document).find('.get-aturan-pakai').select2({
        tags: true,
        ajax: {
            url: base_url + "/resep/aturan-pakai",
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

function select2_2() {
    $(document).find('.get-aturan-pakai-2').select2({
        tags: true,
        ajax: {
            url: base_url + "/resep/aturan-pakai",
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

function set_list_table_barang($data) {
    $check_tampung = $(document).find('#tampung_data[data-check=1]').html();
    if ($check_tampung) {
        $list_obat = $(document).find('.list-aturan[data-id=' + $data.id_tr + ']');
        if ($list_obat) {
            $checked = false;
            if ($data.checked_box) {
                $checked = true;
            }

            $list_obat.find('.form-check-input').prop('checked', $checked);

            $list_obat.find('.jlh_obat').val($data.jlh_input);
            $aturan = $list_obat.find('.get-aturan-pakai');
            $parent_aturan = $aturan.parent('.bagan_form');
            $parent_aturan.find('.select2-selection__rendered').attr('title', $data.aturan_pakai);
            $parent_aturan.find('.select2-selection__rendered').html($data.aturan_pakai);
        }
    }
}

function hitung_ppn() {
    $harga_resep = 0;
    $total_harga_resep = 0;
    $(document).find('#tampung_data li').each(function () {
        $data = $(this).find('.item').html();
        if ($data) {
            $data = JSON.parse($data);
            $checked = '';
            $jlh = $data.jlh_input;
            if ($data.checked_box) {
                $checked = 'checked';
                $kapasitas = $data.kapasitas;
                if ($kapasitas != 0) {
                    $jlh = parseFloat($data.jlh_input) / parseFloat($kapasitas);
                }
            }

            $harga_resep = parseFloat($data.harga_real) * parseFloat($jlh);

            $total_harga_resep = $total_harga_resep + parseFloat($harga_resep);
        }
    });
    if ($(document).find('#tampung_data li').length == 0) {
        $(document).find('#total_harga_resep').html(0);
        $(document).find('#total_harga_ppn').html(0);
    } else {

        $total_harga_resep = Math.round($total_harga_resep);
        $total_ppn = Math.round($total_harga_resep * 0.1);
        // $total_semua=$total_harga_resep+12100;
        $total_semua = $total_harga_resep + $total_ppn;

        $(document).find('#total_harga_resep').html(number_format($total_harga_resep, digit_decimal($total_harga_resep), ',', '.'));
        $(document).find('#total_harga_ppn').html(number_format($total_semua, digit_decimal($total_semua), ',', '.'));
    }
}

function set_list_barang() {
    $target_bagan = $(document).find('#bagan-barang-terpilih');

    if ($target_bagan) {
        $target = $target_bagan.find('tbody');
        if ($target) {
            $html = '';
            $check_jml = 0;
            $total_harga_resep = 0;
            $(document).find('#tampung_data li').each(function () {
                $data = $(this).find('.item').html();
                if ($data) {
                    $data = JSON.parse($data);
                    $checked = '';
                    $jlh = $data.jlh_input;
                    if ($data.checked_box) {
                        $checked = 'checked';
                        $kapasitas = $data.kapasitas;
                        if ($kapasitas != 0) {
                            $jlh = parseFloat($data.jlh_input) / parseFloat($kapasitas);
                        }
                    }

                    $html += '<tr class="tbl-terpilih" data-id=' + $data.id_tr + '>';
                    $html += '<td><input class="form-check-input checkbox_change" style="border-radius: 0px;" type="checkbox" ' + $checked + '></td>';
                    $html += '<td><input type="number" step="any" class="form-control change_jlh_obat" style="width: 100px" value=' + $jlh + '></td>';
                    $html += '<td>' + $data.kode_barang + '</td>';
                    $html += '<td>' + $data.nm_barang + '</td>';
                    $html += '<td>' + $data.satuan + '</td>';
                    $html += '<td>' + $data.harga + '</td>';
                    $html += '<td><textarea hidden class="vlist-apakai">' + $data.aturan_pakai + '</textarea><div class="bagan_form"><select class="get-aturan-pakai-2" style="width: 100%"><option selected></option></select><div class="message"></div></div></td>';
                    $html += '<td>' + $data.stok + '</td>';
                    $html += `<td><a href="#" class="terpilih-delete"><img src="${base_url}/icon/delete.png" /></a></td>`;
                    $html += '</tr>';
                    $check_jml++;

                    set_list_table_barang($data);
                }
            });

            $(document).find('#tampung_data').attr('data-check', 0);

            if ($check_jml > 0) {
                $target_bagan.show();
                $target.html('');
                $target.html($html);

                select2_2();

                $(document).find('.vlist-apakai').each(function () {
                    let value = $(this).val();
                    if (value.length >= 1 && value != 0) {
                        let parent_list = $(this).parents('tr');
                        if (parent_list.length >= 1) {
                            $aturan = parent_list.find('.get-aturan-pakai-2');
                            $parent_aturan = $aturan.parent('.bagan_form');
                            $parent_aturan.find('.select2-selection__rendered').attr('title', $(this).val());
                            $parent_aturan.find('.select2-selection__rendered').html($(this).val());
                        }
                    }
                });
            } else {
                $target_bagan.hide();
            }
        }
    }

    return false;
}

function get_list_barang($this) {
    $parent = $this.parents('.list-aturan');
    $key_parent = (typeof $parent.attr('data-id') != "undefined" || $parent.attr('data-id') != null) ? $parent.attr('data-id') : '';
    $data_parent = (typeof $parent.attr('data-key') != "undefined" || $parent.attr('data-key') != null) ? $parent.attr('data-key') : '';

    $input_jumlah = $parent.find('.jlh_obat');
    if ($input_jumlah) {
        $input_jumlah = $input_jumlah.val();
    } else {
        $input_jumlah = 0;
    }

    $input_aturan = $parent.find('.get-aturan-pakai');
    $get_tag_aturan = $parent.find('.get-aturan-pakai');
    if ($input_aturan) {
        $input_aturan = $input_aturan.val();
        if (!$input_aturan) {

            $parent_aturan = $get_tag_aturan.parent('.bagan_form');
            $input_aturan = $parent_aturan.find('.select2-selection__rendered').html();
            if ($input_aturan == '<span class="select2-selection__placeholder"></span>') {
                $input_aturan = '';
            }
        }
    } else {
        $input_aturan = '';
    }

    $input_checked = 0;
    $checked_box_ = $parent.find('.form-check-input');
    if ($checked_box_) {
        if ($checked_box_.is(':checked')) {
            $input_checked = 1;
        }
    }

    if ($input_jumlah && $input_aturan) {
        if ($data_parent) {
            $target = $(document).find('#tampung_data');
            $data_parent = JSON.parse($data_parent);
            if (parseFloat($data_parent.stok) < parseFloat($input_jumlah)) {
                alert('Maaf stok tidak mencukupi..!!');
                $parent.find('.jlh_obat').val(0);
                if ($data_parent.kode_barang) {
                    let table_target = $(document).find('.tbl-terpilih[data-id=' + $data_parent.kode_barang + ']');
                    let target_terpilih = table_target.find('.change_jlh_obat');
                    if (target_terpilih.length >= 1) {
                        target_terpilih.val(0);
                    }
                    hitung_ppn();
                }

                return false;
            }

            $data_parent.id_tr = $key_parent;
            $data_parent.jlh_input = $input_jumlah;
            $data_parent.aturan_pakai = $input_aturan;
            $data_parent.checked_box = $input_checked;

            $data_parent = JSON.stringify($data_parent);
            $check_input = $target.find('li#' + $key_parent);
            if ($check_input.find('.item').html()) {
                $check_input.find('.item').html($data_parent);
            } else {
                $target.append('<li id=' + $key_parent + '><textarea class="item" name="list_obat[]">' + $data_parent + '</textarea></li>');
            }
        }

        $parent.attr('data-key', $data_parent);

        set_list_barang();
        hitung_ppn();
    }
    return false;
}

$(".change-key").on("change keyup", function () {
    get_list_barang($(this));
});

$(document).delegate(".get-aturan-pakai-2", "change", function () {
    let parent = $(this).parents('.tbl-terpilih');
    let data_id = parent.data('id');
    let bagan_target = $(document).find('tr.list-aturan[data-id=' + data_id + ']');
    if (bagan_target.length >= 1) {
        let new_option = new Option($(this).val(), $(this).val(), true, true);
        bagan_target.find('.get-aturan-pakai').append(new_option).trigger('change');
    }
    return false;
});

$(document).delegate(".terpilih-delete", "click", function (event) {
    $parent = $(this).parents('.tbl-terpilih');
    $key_parent = (typeof $parent.attr('data-id') != "undefined" || $parent.attr('data-id') != null) ? $parent.attr('data-id') : '';

    $li_parent = $(document).find('#tampung_data');
    $li = $li_parent.find('li#' + $key_parent);

    $list_obat = $(document).find('.list-aturan[data-id=' + $key_parent + ']');
    $list_obat.find('.jlh_obat').val('');
    $list_obat.find('.get-aturan-pakai').val('');
    $list_obat.find('.form-check-input').prop('checked', false);

    $parent.remove();
    $li.remove();
    $list_obat.find('.get-aturan-pakai').trigger('change');

    hitung_ppn();

    $target_bagan = $(document).find('#bagan-barang-terpilih');
    $length_item_target = $target_bagan.find('tbody tr').length;
    if ($length_item_target <= 0) {
        $target_bagan.hide();
    }

    return false;
});

$(document).delegate(".checkbox_change", "change", function (event) {
    $parent = $(this).parents('.tbl-terpilih');
    $key_parent = (typeof $parent.attr('data-id') != "undefined" || $parent.attr('data-id') != null) ? $parent.attr('data-id') : '';

    $list_obat = $(document).find('.list-aturan[data-id=' + $key_parent + ']');
    $checked = false;
    if ($(this).is(':checked')) {
        $checked = true;
    }
    $list_obat.find('.form-check-input').prop('checked', $checked);
    $list_obat.find('.form-check-input').trigger('change');

    hitung_ppn();

    return false;
});

$(document).delegate(".change_jlh_obat", "change", function (event) {
    let parent = $(this).parents('.tbl-terpilih');
    let id_form = parent.data('id');
    let target = $(document).find('.jlh_obat[data-form-key=' + id_form + ']');
    target.val($(this).val());

    setTimeout(function () {
        target.trigger('change');
    }, 400);
});

$(document).delegate("#check_submit", "click", function (event) {
    $target = $(document).find('#tampung_data li');
    if ($target.length <= 0) {
        alert('Maaf, silahkan masukkan terlebih dahulu obat yang mau diberikan...!!!');
        return false;
    }
    return true;
});

$(document).ready(function () {
    select2();
    set_list_barang();
    hitung_ppn();
});
