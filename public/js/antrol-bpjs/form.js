$("#daterange")
    .daterangepicker({
        singleDatePicker: true,
        startDate: new Date(),
        locale: {
            // format: moment().format("YYYY MM DD - h:mm:ss"),
            format: "YYYY-MM-DD",
        },
        timePicker: false,
        showDropdowns: true,
        linkedCalendars: false,
    });

let dateee = $("#daterange").on("change keyup", function () {
    let date = $(this).val();
    let tgl = date.substring(0, 10);

    $("#tgl").val(tgl);
});

$(window).on("load", function(){
    let date = $("#daterange").val();
    let tgl = date.substring(0, 10);
    // let jam = date.substring(13);

    $("#tgl").val(tgl);
    // $("#jam").val(jam);
});

