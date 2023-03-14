const modalUnggahBerkas = new bootstrap.Modal($("#modalUnggahBerkas"), {
    keyboard: false
})

function UnggahBerkas(data) {
    const queryString = window.location.search;
    const dataParams = new URLSearchParams(queryString)
    patientDataBerkas = data

    $("#berkas-nrwt").text(data["no_rawat"])
    $("#berkas-nrm").text(data["no_rkm_medis"])
    // $("#berkas-nrsp").text(data["no_resep"])
    $("#berkas-nm").text(`${data["nm_pasien"]}, ${data["umurdaftar"]} TH`)

    modalUnggahBerkas.show()
}

$(".closeUnggahBerkasLabel").click(function () {
    modalUnggahBerkas.hide();
    $("#formUnggahBerkas .alert").addClass("d-none")
    $("#formUnggahBerkas").trigger("reset");
})

$("#formUnggahBerkas").submit(function (e) {
    e.preventDefault();


    const formData = new FormData(e.currentTarget)
    const berkas = formData.get('berkas')
    const berkasType = formData.get('jenis_berkas')
    const berkasTypeSplit = berkasType.split(",")
    console.log(berkasType)
    formData.append('no_rm', patientDataBerkas["no_rkm_medis"])
    formData.append('no_rw', berkasTypeSplit[1] === "2" ? patientDataBerkas["no_rawat"].replace(/\//g, "-") : "*")
    formData.append("nm_pasien", patientDataBerkas["nm_pasien"])

    console.log(patientDataBerkas["no_rawat"].replace(/\//g, "-"))

    const alertNode = document.querySelector('.alert')
    const alert = bootstrap.Alert.getInstance(alertNode)

    const validateBerkas = (f) => {
        const allowedTyped = ["application/pdf"]
        const maxSized = 3000000

        if (!allowedTyped.includes(f.type)) return [false, "File yang diperbolehkan hanya PDF "]
        if (!(parseInt(f.size) < maxSized)) return [false, "File Tidak Boleh Lebih dari 3MB"]

        return [true]
    }

    const validateBerkasType = (t) => {
        if (t === "-") return [false, "Silahkan Pilih Jenis Berkas"];
        return [true];
    }

    const validate_berkas = validateBerkas(berkas)
    const validate_berkas_type = validateBerkasType(berkasType)

    if (!validate_berkas[0] || !validate_berkas_type[0]) {

        console.log("wrong input")
        $("#formUnggahBerkas .alert").removeClass("d-none")
        if (!validate_berkas[0]) return $("#formUnggahBerkas .alert").text(validate_berkas[1]);
        if (!validate_berkas_type[0]) return $("#formUnggahBerkas .alert").text(validate_berkas_type[1]);
    }

    console.log("submit")
    $(".spinner-border").removeClass("d-none")
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: `${base_url}/berkas-digital/unggah`,
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data)
            $(".spinner-border").addClass("d-none")
            window.location.reload()

        },
        error: function (e) {
            console.log(e)
            $(".spinner-border").addClass("d-none")
            window.location.reload()
        }
    });

})



