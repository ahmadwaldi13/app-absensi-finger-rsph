function check_periode_waktu() {
    if ($(".filter-waktu-bp").is(':checked')) {
        $('#filter-waktu').prop('disabled', true);
    } else {
        $('#filter-waktu').prop('disabled', false);
    }
}

$(".ranap-radio").on("change", function () {
    check_periode_waktu();
});

$(document).ready(function () {
    check_periode_waktu();
});
