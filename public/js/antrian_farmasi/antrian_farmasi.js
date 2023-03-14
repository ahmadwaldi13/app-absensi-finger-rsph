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

$("#dateRange").daterangepicker({
    startDate: new Date(),
    endDate: new Date(),
    locale: {
        format: "YYYY-MM-DD",
    },
    showDropdowns: true,
    linkedCalendars: false,
});

$(document).ready(function () {
    $('.js-example-basic-multiple').select2({
        placeholder: "Masukkan Kata"
    });
});

// $(".tindakanRj").on("click", function(){
//     window.localStorage.setItem("halaman", "rj");
// })
document.getElementById("modalKamar")?.addEventListener("click", function () {
    document.getElementById("showModal").click();
});


document.getElementById("modalKlinik")?.addEventListener("click", function () {
    document.getElementById("showModal").click();
});

function setValue(key, item) {
    document.getElementById("poliklinik").value = item;
    document.getElementById("valuePoli").value = key;
    document.getElementById("close").click();

    window.localStorage.setItem("dataPoli", item);
}

$("#dateRange").on("change keyup", function () {
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
    $("#dateRange").val(start + " - " + end);
    $("#start").val(start);
    $("#end").val(end);
}

let tablePoliklinik = $('#tablePoliklinik').DataTable({
    ordering: false,
    paging: false,
    info: false,
    searching: true,
    language: { search: "" },
    fnDrawCallback: function () {
        $("#tablePoliklinik_filter").find("input[type='search']").attr("id", "pencarianChildK");
        $("#tablePoliklinik_filter").find("input[type='search']").attr("hidden", true);
    },
    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    responsive: true
});
$('#tablePoliklinik').attr("style", "width: 100%");
$("#pencarianPoliklinik").on("change keyup paste", function () {
    tablePoliklinik.search($(this).val()).draw()
})

let url = window.location

$(".tindakanRj").on("click", function () {
    setCookie("previousLink", url, 86400)
})

$(".tindakanRp").on("click", function () {
    setCookie("previousLink", url, 86400)
})

const speech = window.speechSynthesis;
let voices = speech.getVoices();
let current_list_patients = [];
function getBahasa() {
    voices = speech.getVoices();
    let voicesLang = []
    voices.forEach(v => {
        if (v.lang === "id-ID") voicesLang.push(v)
    })
    return voicesLang
}
// untuk manggil pasien dari nama pasien dan loket yang dituju
// async function panggilPasien(namaPasien, loket, from, patientTableRow) {
//     const queryString = window.location.search;
//     const tab = new URLSearchParams(queryString).get("tab")
//     const voiceBahasa = getBahasa();
//     const msg = new SpeechSynthesisUtterance();
//     msg.text = `${namaPasien}. dari ${tab === "ri" ? 'ruangan' : ''} ${from} Silahkan Menuju ke ${loket}`.toUpperCase();
//     msg.voice = voiceBahasa[1] ? voiceBahasa[1] : voiceBahasa[0]
//     msg.rate = 0.7;
//     msg.lang = "id-ID";
//     msg.onstart = () => patientTableRow.classList.add("bg-info")
//     msg.onend = () => patientTableRow.classList.remove("bg-info")
//     speech.speak(msg);
// }

async function panggilPasien(namaPasien, loket, from, patientTableRow) {
    const queryString = window.location.search;
    const tab = new URLSearchParams(queryString).get("tab")
    function play() {
        const panggil = `${namaPasien}. dari ${tab === "ri" ? 'ruangan' : ''} ${from}. Silahkan Menuju ke ${loket}`.toLowerCase();
        responsiveVoice.speak(
            panggil, "Indonesian Male", {
            pitch: 1,
            rate: 0.7,
            volume: 2,
            onstart: () => {
                patientTableRow.classList.add("bg-info");
                $(patientTableRow).find("#speak").toggleClass("d-none")
                $(patientTableRow).find("#cancel_speak").toggleClass("d-none")
            },
            onend: () => {
                patientTableRow.classList.remove("bg-info")
                $(patientTableRow).find("#speak").toggleClass("d-none")
                $(patientTableRow).find("#cancel_speak").toggleClass("d-none")
            }
        }
        );
    }

    play();
}

function stopSpeak(p_id) {
    responsiveVoice.cancel()
    const patientTableRow = $(`#${p_id}-from`).parent()[0]
    $(patientTableRow).find("#speak").toggleClass("d-none")
    $(patientTableRow).find("#cancel_speak").toggleClass("d-none")
    $(patientTableRow).removeClass("bg-info")

}

async function getPasien(p_id) {
    const nama_pasien = $(`#${p_id}-nm_pasien`).text();
    const loket = $(`#${p_id}-konter_no`).val();
    const from = $(`#${p_id}-from`).text();
    const patientTableRow = $(`#${p_id}-from`).parent()[0]
    if (loket.length === 0) return alert("Silahkan Pilih No Loket Terlebih Dahulu");

    await panggilPasien(nama_pasien, loket, from, patientTableRow)
    // await panggilPasien2(nama, loket, from, patientTableRow)

}


// var patientData = {}
const modal = new bootstrap.Modal($("#modalPenyerahan"), {
    keyboard: false
})

function PenyerahanResep(data) {
    const queryString = window.location.search;
    const dataParams = new URLSearchParams(queryString)
    let patientData = data
    patientData = {
        ...data,
        start: dataParams.get("start"),
        end: dataParams.get("end"),
        tab: (!dataParams.get("tab") || dataParams.get("tab") === "rj") ? "rj" : "ri"
    }
    $("#pyrh-nrwt").text(patientData["no_rawat"])
    $("#pyrh-nm").text(`(${patientData["no_rkm_medis"]}) ${patientData["nm_pasien"]}`)
    $("#pyrh-nrsp").text(patientData["no_resep"])
    if (patientData["tab"] === "rj") $("#pyrh-np").text(patientData["nm_poli"])
    else $("#pyrh-nrgn").text(patientData["nm_bangsal"])
    modal.show()
    $("#modalPenyerahanForm #patient_data").val(JSON.stringify(patientData));
    $("#modalPenyerahan .patient-name").text(patientData.nm_pasien)
}

$(".closePenyerahanLabel").click(function () {
    modal.hide();
    $("#modalPenyerahanForm #patient_data").val('');
    // patientData = {}
})

// $("#modalPenyerahan #submitPenyerahanResep").click(function () {
//     post(`${base_url}/antrian-farmasi-petugas/penyerahan-resep`, patientData)
// })

function post(path, parameters) {
    var form = $('<form></form>');

    form.attr("method", "post");
    form.attr("action", path);

    $.each(parameters, function (key, value) {
        var field = $('<input></input>');

        field.attr("type", "p");
        field.attr("name", key);
        field.attr("value", value);

        form.append(field);
    });
    var token_field = $('<input></input>');
    token_field.attr("type", "p");
    token_field.attr("name", "_token");
    token_field.attr("value", $('meta[name="csrf-token"]').attr('content'));

    form.append(token_field);
    $(document.body).append(form);
    form.submit();
}


setInterval(() => {
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString)
    let dataParams = {}
    for (const param of params) {
        dataParams[param[0]] = param[1]
    }
    // dataParams["table_only"] = true;
    // const getCurrentUrl = window.location.origin + window.location.pathname
    // $.get(getCurrentUrl, dataParams, function (data, status) {
    //     console.log(current_list_patients, data?.data.data, arraysEqual(data?.data.data, current_list_patients))
    //     if (!arraysEqual(data?.data.data, current_list_patients)) {
    //         console.log("newer patients list detected, rerendering...")
    //         $("#tabelAntrianFarmasi tbody").html(data.html)
    //     } else {
    //         console.log("there are no changes in the patients list")
    //     }
    //     current_list_patients = data ? data.data.data : [];
    // });
    dataParams["table_only"] = true;
    const getCurrentUrl = window.location.origin + window.location.pathname
    $.get(getCurrentUrl, dataParams, function (data, status) {
        $("#tableRawatJalan tbody").html(data)
    });
}, 8000)


async function panggilPasien2(namaPasien, loket, from, patientTableRow) {
    const queryString = window.location.search;
    const tab = new URLSearchParams(queryString).get("tab")
    const text = `${namaPasien}. dari ${tab === "ri" ? 'ruangan' : ''} ${from} Silahkan Menuju ke ${loket}`.toUpperCase();
    let data = await fetch(`http://127.0.0.1:105/tts?text=${text}`)
    let blob = await data.blob()
    const audio = new Audio(blob);
    audio.src = window.URL.createObjectURL(blob);
    audio.play();
}   