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
// console.log(paramSesi.get("tab"))
if (paramSesi.get("tab") == "cppt" || "") {
    tabsReport.classList.remove("active");
    tabsCppt.classList.add("active");
    cppt.style.display = "inline-block";
    report.style.display = "none";
} else if (paramSesi.get("tab") == "report") {
    tabsCppt.classList.remove("active");
    tabsReport.classList.add("active");
    report.style.display = "inline-block";
    cppt.style.display = "none";
}

// tabsCppt.addEventListener("click", function () {
//     tabsReport.classList.remove("active");
//     tabsCppt.classList.add("active");
//     cppt.style.display = "inline-block";
//     report.style.display = "none";
// });
// tabsReport.addEventListener("click", function () {
//     tabsCppt.classList.remove("active");
//     tabsReport.classList.add("active");
//     report.style.display = "inline-block";
//     cppt.style.display = "none";
// });

document.getElementById("modalDokter").addEventListener("click", function () {
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

for (let i = 0; i < jml; i++) {
    let byid = "showModalReview" + i;
    document.getElementById(byid).addEventListener("click", function () {
        document.getElementById("modalReview" + i).click();
    });
}

for (let i = 0; i < jml; i++) {
    let tglReview = $("#tglReview" + i).val();
    let jamReview = $("#jamReview" + i).val();

    $("#daterangereview" + i)
        .daterangepicker({
            singleDatePicker: true,
            locale: {
                format: "DD/MM/YYYY hh:ii",
            },
            showDropdowns: true,
            linkedCalendars: false,
        })
        .val(tglReview + " - " + jamReview);
}

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
    
    // Lapaoran operasi
    let dateLaporanOperasi = $("#daterangecppt").val();
    let tglLaporanOperasi = dateLaporanOperasi.substring(0, 10);
    let jamLaporanOperasi = dateLaporanOperasi.substring(13);
    
    $("#selesaioperasi").val(tglLaporanOperasi + " " + jamLaporanOperasi);
    $("#tgl_jadwaloperasi").val(tglLaporanOperasi + " " + jamLaporanOperasi);
});