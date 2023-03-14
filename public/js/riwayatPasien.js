// Halaman riwayat pasien
var tabsResume = document.getElementById("tabs-resume");
var tabsLatest = document.getElementById("tabs-latest");
var resume = document.getElementById("resume");
var latest = document.getElementById("latest");

tabsResume.addEventListener("click", function () {
    tabsLatest.classList.remove("active");
    tabsResume.classList.add("active");
    resume.style.display = "inline-block";
    latest.style.display = "none";
});
// tabsLatest.addEventListener("click", function () {
//     tabsResume.classList.remove("active");
//     tabsLatest.classList.add("active");
//     latest.style.display = "inline-block";
//     resume.style.display = "none";
// });

// Setup daterange picker
$("#daterangeRiwayat").daterangepicker({
    startDate: new Date(),
    endDate: new Date(),
    locale: {
        format: "YYYY-MM-DD",
    },
    showDropdowns: true,
    linkedCalendars: false,
});

$("#daterangeRiwayat").on("apply.daterangepicker", function () {
    let daterange = $(this).val();
    let startDate = daterange.substring(0, 10);
    let endDate = daterange.substring(13, 24);
    let queryParams = (new URL(document.location)).searchParams;
    queryParams.set('start_date', startDate);
    queryParams.set('end_date', endDate);
    window.location = window.location.href.split('?')[0] + '?' + queryParams.toString();
});

$(window).on("load", function () {
    let queryParams = (new URL(document.location)).searchParams;
    let startDate = queryParams.get('start_date');
    let endDate = queryParams.get('end_date');
    if (startDate) {
        $('#daterangeRiwayat').data('daterangepicker').setStartDate(startDate);
        $('#daterangeRiwayat').data('daterangepicker').setEndDate(endDate);
    }
});