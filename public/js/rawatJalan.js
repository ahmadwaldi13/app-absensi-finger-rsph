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

$("#daterangeRalan").daterangepicker({
    startDate: new Date(),
    endDate: new Date(),
    locale: {
        format: "YYYY-MM-DD",
    },
    showDropdowns: true,
    linkedCalendars: false,
});

$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        placeholder: "Masukkan Kata"
    });
});

// $(".tindakanRj").on("click", function(){
//     window.localStorage.setItem("halaman", "rj");
// })

document.getElementById("modalKlinik").addEventListener("click", function () {
    document.getElementById("showModal").click();
});

function setValue(key, item) {
    document.getElementById("poliklinik").value = item;
    document.getElementById("valuePoli").value = key;
    document.getElementById("close").click();

    window.localStorage.setItem("dataPoli", item);
}

$("#daterangeRalan").on("change keyup", function () {
    let date = $(this).val().split(" ");
    let start = date[0].split("/").reverse().join("-");
    let end = date[2].split("/").reverse().join("-");

    $("#start").val(start);
    $("#end").val(end);
});

function doSubmit(sel) {
    let val = sel.value;
}

// $("#tableRawatJalan").DataTable({
//     dom: '<"top"i>rt<"bottom"flp><"clear">',
//     searching: false,
//     oLanguage: {
//         sLengthMenu: "Tampilkan Row Data _MENU_",
//     },
// });

$(".table-responsive-tablet").removeAttr("style");
$(".table-responsive-tablet").removeClass("dataTable");
$(".dt").removeAttr("style");
$(".buttons-copy").removeClass("dt-button");
$(".buttons-copy").addClass("btn btn-primary btn-copy");

$("select[name=tableRawatJalan_length]").addClass("ms-2 form-select");
$("select[name=tableRawatJalan_length]").attr(
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

$("select[name=tableRawatJalan_length]").on("change", function () {
    $("select[name=tableRawatJalan_length]").addClass("ms-2 form-select");
    $("select[name=tableRawatJalan_length]").attr(
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

let poli = urlParams.get("poli");
let city = urlParams.get("city");
let stts = urlParams.get("status");
let start = urlParams.get("start");
let end = urlParams.get("end");
let search = urlParams.get("search")

if (poli) {
    let data = window.localStorage.getItem("dataPoli");
    $("#poliklinik").val(data);
    $("#valuePoli").val(poli);
}

// if (city) {
//     window.localStorage.setItem("dataCity", city);
//     $("#city").val(window.localStorage.getItem("dataCity"));
// }

if (search) {
    window.localStorage.setItem("dataSearch", search);
    $("#pencarianralan").val(window.localStorage.getItem("dataSearch"));
}

if (stts) {
    window.localStorage.setItem("dataStatus", stts);
    $("select[name=status]").val(window.localStorage.getItem("dataStatus"));
}

if (start && end) {
    $("#daterangeRalan").val(start + " - " + end);
    $("#start").val(start);
    $("#end").val(end);
}

let tablePoliklinik = $('#tablePoliklinik').DataTable({
    ordering: false,
    paging: false,
    info: false,
    searching: true,
    language: { search: "" },
    fnDrawCallback:function(){
        $("#tablePoliklinik_filter").find("input[type='search']").attr("id", "pencarianChildK");
        $("#tablePoliklinik_filter").find("input[type='search']").attr("hidden", true);
    },
    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    responsive: true
});
$('#tablePoliklinik').attr("style", "width: 100%");
$("#pencarianPoliklinik").on("change keyup paste", function(){
    tablePoliklinik.search($(this).val()).draw()
})

let url = window.location

$(".tindakanRj").on("click", function(){
    setCookie("previousLink", url, 86400)
})

$(".tindakanRp").on("click", function(){
    setCookie("previousLink", url, 86400)
})

let patientData
$check_modal=$(document).find("#modalListMonitor");
if($check_modal.length){
    const modal = new bootstrap.Modal($("#modalListMonitor"), {
        keyboard: false
    })
}

function ListMonitor(data) {
    const queryString = window.location.search;
    const dataParams = new URLSearchParams(queryString)
    patientData = data
    patientData = {
        ...data,
        start: dataParams.get("start"),
        end: dataParams.get("end"),
    }
    $("#list-nrwt").text(patientData["no_rawat"])
    $("#list-nm").text(`(${patientData["no_rkm_medis"]}) ${patientData["nm_pasien"]}`)
    $("#list-np").text(patientData["nm_poli"])

    modal.show()
    $("#modalListMonitor .patient-name").text(patientData.nm_pasien)
}

$(".closeListMonitorLabel").click(function () {
    modal.hide();
    patientData = {}
})

$("#modalListMonitor #submitListMonitor").click(function () {
    post(`${base_url}/rawat-jalan/masuk-monitor`, patientData)
})

function post(path, parameters) {
    var form = $('<form></form>');

    form.attr("method", "post");
    form.attr("action", path);

    $.each(parameters, function (key, value) {
        var field = $('<input></input>');

        field.attr("type", "hidden");
        field.attr("name", key);
        field.attr("value", value);

        form.append(field);
    });
    var token_field = $('<input></input>');
    token_field.attr("type", "hidden");
    token_field.attr("name", "_token");
    token_field.attr("value", $('meta[name="csrf-token"]').attr('content'));

    form.append(token_field);
    $(document.body).append(form);
    form.submit();
}