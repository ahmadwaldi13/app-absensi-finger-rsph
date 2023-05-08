
function set_data() {
    $data_sent = {};

    $target = $(document).find('#item_list_terpilih');
    if ($($target).html()) {
        $data_sent = JSON.parse($target.html());
    }

    tabel = (typeof $(document).find('.data-table-cus') != "undefined" || $(document).find('.data-table-cus') != null) ? $(document).find('.data-table-cus') : '';
    if (tabel.length) {
        tabel = tabel.DataTable();

        // console.log(tabel);

        tabel.rows().every(function (key) {
            $data_me = tabel.rows(key).data();
            $data_me = $data_me[0];

            $form_checked = $(this.node()).find('.checked_me');
            $kode_data = (typeof $form_checked.data("kode") != "undefined" || $form_checked.data("kode") != null) ? $form_checked.data("kode") : '';

            if ($kode_data) {
                $me_data = {};

                if ($form_checked.length) {
                    if ($form_checked.prop('checked')) {
                        $me_data['jml'] = 'cheked';
                    }
                }

                if (!jQuery.isEmptyObject($me_data)) {
                    $data_me[0] = "";
                    // console.log($kode_data, $data_me);

                    $me_data['data'] = $data_me;
                    $data_sent[$kode_data] = $me_data;
                }
            }

        });
    }
    $return = {};
    if (!jQuery.isEmptyObject($data_sent)) {
        $return = JSON.stringify($data_sent);
        $target.html($return);
    }
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
                if (value.data) {
                    $tamplate += '<tr data-kode="' + key + '">';
                    console.log(key);
                    $.each(value.data, function (key1, value1) {
                        if (key1 == 0) {
                            value1 = "<input class='form-check-input' type='checkbox' disabled checked value=" + value[1] + ">";
                        }
                        $tamplate += "<td>" + decode_html_raw(value1) + "</td>";
                    });
                    $tamplate += "<td> <a href='#' class='btn btn-kecil btn-danger del_item'> <i class='fa-solid fa-trash'></i> </a> </td>";
                    $tamplate += '</tr>';
                }
            });

            $tabel.find('tbody').html('');
            $tabel.find('tbody').html($tamplate);
        }


        tabel = (typeof $(document).find('.data-table-cus') != "undefined" || $(document).find('.data-table-cus') != null) ? $(document).find('.data-table-cus') : '';
        if (tabel.length) {
            tabel = tabel.DataTable();
            tabel.rows().every(function (key) {
                $form_checked = $(this.node()).find('.checked_me');
                if ($form_checked.length && $form_checked.is(":checkbox")) {
                    $kode_data = (typeof $form_checked.data("kode") != "undefined" || $form_checked.data("kode") != null) ? $form_checked.data("kode") : '';
                    if ($item[$kode_data]) {
                        $form_checked.prop('checked', true);
                    } else {
                        $form_checked.prop('checked', false);
                    }
                }
            });
        }

    }

    check_data_terpilih();
}

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


$(document).delegate("input[type='checkbox'].checked_me", "change", function (event) {
    set_data();
    get_terpilih();
});

$(document).find('.data-table-cus').on('draw.dt', function () {
    set_data();
    get_terpilih();
});

$(document).ready(function () {
    check_data_terpilih();
    set_data();
});
