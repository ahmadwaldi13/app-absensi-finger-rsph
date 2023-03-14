function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

document.getElementById("modalKamar").addEventListener("click", function () {
    document.getElementById("showModal").click();
});

function setValue(key, item) {
    document.getElementById("kamar").value = item;
    document.getElementById("valueRoom").value = key;
    document.getElementById("close").click();

    window.localStorage.setItem("dataRoom", item);
}
$("#daterangeRanap").daterangepicker({
    startDate: new Date(),
    endDate: new Date(),
    locale: {
        format: "YYYY-MM-DD",
    },
    showDropdowns: true,
    linkedCalendars: false,
});
$("#daterangeRanap").on("change keyup", function () {
    console.log("change")
    let date = $(this).val().split(" ");
    let start = date[0].split("/").reverse().join("-");
    let end = date[2].split("/").reverse().join("-");

    $("#start").val(start);
    $("#end").val(end);
});
$(".table-responsive-tablet").removeAttr("style");
$(".table-responsive-tablet").removeClass("dataTable");
$(".dt").removeAttr("style");
$(".buttons-copy").removeClass("dt-button");
$(".buttons-copy").addClass("btn btn-primary btn-copy");

$("select[name=tableRawatInap_length]").addClass("ms-2 form-select");
$("select[name=tableRawatInap_length]").attr(
    "style",
    "width: 100px !important; display: inline !important;"
);

$("a.paginate_button").addClass("text-primary");
$("a.paginate_button").addClass("page-link border-0 text-center mx-1");
$("a.paginate_button").attr("style", "min-width: 40px; height: 40px");

$(".paging_simple_numbers").attr(
    "style",
    "display: flex; flex-direction: row;"
);
$(".paging_simple_numbers span").attr(
    "style",
    "display: flex; flex-direction: row;"
);
$("a.page-link").removeClass("paginate_button");

$("a.previous").text("«");
$("a.next").text("»");

$("select[name=tableRawatInap_length]").on("change", function () {
    $("select[name=tableRawatInap_length]").addClass("ms-2 form-select");
    $("select[name=tableRawatInap_length]").attr(
        "style",
        "width: 100px !important; display: inline !important;"
    );

    $("a.paginate_button").addClass("text-primary");
    $("a.paginate_button").addClass("page-link border-0 text-center mx-1");
    $("a.paginate_button").attr("style", "min-width: 40px; height: 40px");

    $(".paging_simple_numbers").attr(
        "style",
        "display: flex; flex-direction: row;"
    );
    $(".paging_simple_numbers span").attr(
        "style",
        "display: flex; flex-direction: row;"
    );
    $("a.page-link").removeClass("paginate_button");

    $("a.previous").text("«");
    $("a.next").text("»");
});

const urlParams = new URLSearchParams(location.search);

let room = urlParams.get("room");
let city = urlParams.get("city");
let stts = urlParams.get("status");
let start = urlParams.get("start");
let end = urlParams.get("end");
let search = urlParams.get("search");
let kondisi = urlParams.get("kondisi_waktu");

if (room) {
    let data = window.localStorage.getItem("dataRoom");
    $("#kamar").val(data);
    $("#valueRoom").val(room);
}

// if (city) {
//     window.localStorage.setItem("dataCity", city);
//     $("#pencarian").val(window.localStorage.getItem("dataCity"));
// }

if (search) {
    window.localStorage.setItem("dataSearch", search);
    $("#pencarianranap").val(window.localStorage.getItem("dataSearch"));
}

if (stts) {
    window.localStorage.setItem("dataStatusRI", stts);
    $("#stts").val(window.localStorage.getItem("dataStatusRI"));
}

if (kondisi) {
    window.localStorage.setItem("dataKondisiRI", kondisi);
    $("#kondisi").val(window.localStorage.getItem("dataKondisiRI"));
}

if (start && end) {
    $("#daterangeRanap").val(start + " - " + end);
    $("#start").val(start);
    $("#end").val(end);
}

let tableKamar = $('#tableKamar').DataTable({
    ordering: false,
    paging: false,
    info: false,
    searching: true,
    language: { search: "" },
    fnDrawCallback: function () {
        $("#tableKamar_filter").find("input[type='search']").attr("id", "pencarianChildK");
        $("#tableKamar_filter").find("input[type='search']").attr("hidden", true);
    }
});
$('#tableKamar').attr("style", "width: 100%");
$("#pencarianKamar").on("change keyup paste", function () {
    tableKamar.search($(this).val()).draw()
})

let url = window.location

$(".tindakanRi").on("click", function () {
    setCookie("previousLink", url, 86400)
});

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
    $('.js-example-basic-multiple').select2({
        placeholder: "Masukkan Kata"
    });
    check_periode_waktu();
});
