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

// Setup daterange picker
$("#daterangecppt")
    .daterangepicker({
        singleDatePicker: true,
        startDate: new Date(),
        locale: {
            format: "YYYY-MM-DD - HH:mm:ss",
        },
        timePicker: true,
        showDropdowns: true,
        linkedCalendars: false,
        timePickerSeconds: true,
    });

$("#daterange")
    .daterangepicker({
        singleDatePicker: true,
        startDate: new Date(),
        locale: {
            // format: moment().format("YYYY MM DD - h:mm:ss"),
            format: "YYYY-MM-DD - HH:mm",
        },
        timePicker: true,
        showDropdowns: true,
        linkedCalendars: false,
    });

let dateee = $("#daterange").on("change keyup", function () {
    let date = $(this).val();
    let tgl = date.substring(0, 10);
    let jam = date.substring(13);

    $("#tgl").val(tgl);
    $("#jam").val(jam);
});
// -------------------------
var tabsCppt = document.getElementById("tabs-cppt");
var tabsReport = document.getElementById("tabs-report");
var cppt = document.getElementById("cppt");
var report = document.getElementById("report");

const paramSesi = new URLSearchParams(location.search);


$(document).delegate("#modalDokter", "click", function(event) {
// document.getElementById("modalDokter").addEventListener("click", function () {
    document.getElementById("showModalPilihDokter").click();
});

function setValueDokter(item, kode, jabatan) {
    var input = $("#namaDokter");
    var inputkode = $("#kodeDokter");
    var inputjabatan = $("#profesi");
    var close = $("#closeModalDokter");

    input.val(item);
    inputkode.val(kode);
    inputjabatan.val(jabatan);
    close.trigger("click");
}

let jml = $("tbody").attr("data-jml");

$("#daterangecppt").on("change keyup", function () {
    let date = $(this).val();
    let tgl = date.substring(0, 10);
    let jam = date.substring(13);
    $("#selesaioperasi").val(tgl + " " + jam);
    $("#tgl_jadwaloperasi").val(tgl + " " + jam);
});

let tablePopupDokter = $('#tablePopupDokter').DataTable({
    ordering: false,
    paging: false,
    info: false,
    searching: true,
    language: { search: "" },
    fnDrawCallback:function(){
        $("#tablePopupDokter_filter").find("input[type='search']").attr("id", "pencarianChildK");
        $("#tablePopupDokter_filter").find("input[type='search']").attr("hidden", true);
    }
});
$('#tablePopupDokter').attr("style", "width: 100%");
$("#pencarianPopupDokter").on("change keyup paste", function(){
    tablePopupDokter.search($(this).val()).draw()
})

// On load page
$(window).on("load", function(){
    let date = $("#daterange").val();
    let tgl = date.substring(0, 10);
    let jam = date.substring(13);

    $("#tgl").val(tgl);
    $("#jam").val(jam);
});

// Modal in modal
$(document).delegate(".ModalDokter", "click", function(event){
    let row = $(this).parent().parent().parent().parent().parent().attr("data-modal-row")
    setCookie("modalRow", row, 86400)
    $("#buttonModalDokter").trigger("click")
})

$("#closeModalDokterDT").on("click", function(){
    let row = getCookie("modalRow")
    $(document).find(".modal-edit").eq(row).trigger("click")
})

$(document).delegate(".set-value-data-table-modal", "click", function(event){
    let kode = $(this).attr("data-value-kode")
    let nama = $(this).attr("data-value-nama")
    let row = getCookie("modalRow")

    $(document).find(".modal-edit").eq(row).trigger("click")
    $("#namaDokter").val(nama)
    $("#kodeDokter").val(kode)
})