function set_data() {
    $data_sent = {};

    $target = $(document).find('#item_list_terpilih');
    if ($($target).html()) {
        $data_sent = JSON.parse($target.html());
        console.log($data_sent);
    }

    tabel = (typeof $(document).find('.data-table-cus') != "undefined" || $(document).find('.data-table-cus') != null) ? $(document).find('.data-table-cus') : '';
    if (tabel.length) {
        tabel = tabel.DataTable();

        tabel.rows().every(function (key) {
            $data_me = tabel.rows(key).data();
            $data_me = $data_me[0];

            $form_jml_b = $(this.node()).find('.jml_b');
            $form_ket_b = $(this.node()).find('.ket_b');
            $kode_data = (typeof $form_jml_b.data("kode") != "undefined" || $form_jml_b.data("kode") != null) ? $form_jml_b.data("kode") : '';
            if ($kode_data) {
                $me_data = {};

                if ($form_jml_b.length) {
                    if ($form_jml_b.val()) {
                        $me_data['jml'] = $form_jml_b.val();
                    }
                }

                if ($form_ket_b.length) {
                    if ($form_ket_b.val()) {
                        $me_data['ket'] = $form_ket_b.val();
                    }
                }

                if (!jQuery.isEmptyObject($me_data)) {
                    $data_me[0] = "";
                    $data_me[6] = "";
                    if ((parseInt($data_me[3]) - parseInt($form_jml_b.val())) < 0) {
                        alert("Jumlah Yang dimasukkan melebihi stok")
                        $me_data = {}
                    } else if (parseInt($form_jml_b.val()) == 0) {
                        alert("Jumlah Tidak Boleh 0")
                        $me_data = {}
                    }
                    else {
                        $me_data['data'] = $data_me;
                        $data_sent[$kode_data] = $me_data;
                    }
                }
            }
        });
    }
    $return = {};

    if (!jQuery.isEmptyObject($data_sent)) {
        $return = JSON.stringify($data_sent);
        console.log($data_sent);
        $target.html($return);
    }
}

function set_data2() {
    $parent = $(document).find('#data-terpilih');
    $table = $parent.find('table');
    $get_tr = $table.find('tbody');

    $data_sent = {};
    $target = $(document).find('#item_list_terpilih');
    if ($($target).html()) {
        $data_sent = JSON.parse($target.html());
    }

    $get_tr.find('tr').each(function () {
        $parent_tr = $(this);
        $kode_data = (typeof $parent_tr.data("kode") != "undefined" || $parent_tr.data("kode") != null) ? $parent_tr.data("kode") : '';
        if ($kode_data) {
            if ($data_sent[$kode_data]) {
                $item = $data_sent[$kode_data];

                if ($parent_tr.find('.jml_change').length) {
                    if ((parseInt($item.data[3]) - parseInt($parent_tr.find('.jml_change').val())) < 0) {
                        alert("Jumlah Barang Tidak Boleh Melebihi Stok")
                    } else if (parseInt($parent_tr.find('.jml_change').val()) === 0) {
                        alert("jumlah Barang Tidak Boleh Nol")
                    } else {
                        $item.jml = $parent_tr.find('.jml_change').val();
                    }
                }

                if ($parent_tr.find('.ket_change').length) {
                    $item.ket = $parent_tr.find('.ket_change').val();
                }
                $data_sent[$kode_data] = $item;
            }

        }
    });

    $data_sent = JSON.stringify($data_sent);
    $target.html('');
    $target.html($data_sent);
}

function get_terpilih() {
    $form_data = $(document).find('#item_list_terpilih');
    if ($form_data.html()) {
        $tamplate = '';
        $item = [];
        $item = JSON.parse($form_data.html());

        $parent = $(document).find('#data-terpilih');
        $tabel = $parent.find('table');
        if ($tabel.find('tbody').length) {
            $.each($item, function (key, value) {
                value.data.splice(4, 0, String(parseInt(value.data[3] - parseInt(value.jml))))
                if (value.data) {
                    $tamplate += '<tr data-kode="' + key + '">';
                    $.each(value.data, function (key1, value1) {
                        if (key1 == 0) {
                            value1 = "<input type='number' class='form-control money jml_change' value=" + value.jml + ">";
                        }
                        if (key1 == 7) {
                            // if (key1 == 6) {
                            value.ket = (value.ket) ? value.ket : '';
                            value1 = "<textarea class='form-control ket_change' row='2'>" + value.ket + "</textarea>";
                        }
                        $tamplate += "<td>" + decode_html_raw(value1) + "</td>";
                    });
                    $tamplate += "<td> <a href='#' class='btn btn-kecil btn-danger del_item'> <i class='fa-solid fa-trash'></i> </a> </td>";
                    $tamplate += '</tr>';
                }
            });

            $tabel.find('tbody').html('');
            $tabel.find('tbody').html($tamplate);

            $(document).find(".money").inputmask({ alias: "money" });
        }


        tabel = (typeof $(document).find('.data-table-cus') != "undefined" || $(document).find('.data-table-cus') != null) ? $(document).find('.data-table-cus') : '';
        if (tabel.length) {
            tabel = tabel.DataTable();
            tabel.rows().every(function (key) {
                $form_jml_b = $(this.node()).find('.jml_b');
                $form_ket_b = $(this.node()).find('.ket_b');


                if ($form_jml_b.length) {
                    $kode_data = (typeof $form_jml_b.data("kode") != "undefined" || $form_jml_b.data("kode") != null) ? $form_jml_b.data("kode") : '';
                    if ($kode_data) {
                        if ($item[$kode_data]) {
                            $form_jml_b.val($item[$kode_data].jml);
                            if ($form_ket_b.length) {
                                $form_ket_b.html($item[$kode_data].ket);
                            }
                        } else {
                            $form_jml_b.val('');
                            if ($form_ket_b.length) {
                                $form_ket_b.html('');
                            }
                        }
                    }
                }
            });
        }
    }

    check_data_terpilih();
}



$(document).delegate(".jml_b", "change", function (event) {
    set_data();
    get_terpilih();
});

$(document).delegate(".ket_b", "change", function (event) {
    set_data();
    get_terpilih();
});

$(document).find('.data-table-cus').on('draw.dt', function () {
    set_data();
    get_terpilih();
});

$(document).delegate(".jml_change", "change", function (event) {
    set_data2();
    get_terpilih();
});

$(document).delegate(".ket_change", "change", function (event) {
    set_data2();
    get_terpilih();
});

$(document).delegate(".del_item", "click", function (event) {
    $parent = $(this).parents('tr');
    $kode_data = (typeof $parent.data("kode") != "undefined" || $parent.data("kode") != null) ? $parent.data("kode") : '';
    if ($kode_data) {
        $data_sent = {};
        $target = $(document).find('#item_list_terpilih');
        if ($($target).html()) {
            $data_sent = JSON.parse($target.html());
        }

        if ($data_sent[$kode_data]) {
            delete $data_sent[$kode_data];
            $data_sent = JSON.stringify($data_sent);
            $target.html('');
            $target.html($data_sent);

            get_terpilih();
        }
    }

    return false;
});


function check_data_terpilih() {
    $form_data = $(document).find('#item_list_terpilih');
    $(document).find('#btn_save').hide();
    if ($form_data.html()) {
        $tamplate = '';
        $item = [];
        $item = JSON.parse($form_data.html());

        if (!jQuery.isEmptyObject($item)) {
            $(document).find('#btn_save').show();
            return 1;
        } else {
            $(document).find('#btn_save').hide();
            return 0;
        }
    }
}

$(document).ready(function () {
    $check = check_data_terpilih();
    if ($check) {
        set_data();
        get_terpilih();
    }
});
