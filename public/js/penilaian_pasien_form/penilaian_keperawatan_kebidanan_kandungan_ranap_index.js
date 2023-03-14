const persalinanModal = document.getElementById('persalinanPasien') && new bootstrap.Modal(document.getElementById('persalinanPasien'), {
    keyboard: false
})
let riwayatPersalinanCount = 1;


$("#persalinanPasien form").submit(tambahDataRiwayat);


function tambahDataRiwayat(e, table_el = "tabelRiwayatPersalinan", form_id = "") {

    let form_el = form_id.length > 0 ? document.querySelector(form_id) : e.currentTarget
    console.log(form_el, form_id)
    let table_id = generateString(5).trim();
    let form_data = {}

    console.log($(form_el).serializeArray())
    let serialize_form = $(form_el).serializeArray().every((d) => {
        if (d.value != '') {
            form_data[d.name] = d.value
            return true;
        }
        else return false;
    })
    if (!serialize_form) return alert("Data tidak boleh kosong");
    $(`#${table_el} tbody`).append(`<tr id='persalinan_${table_id}'>
                            <td><input  type="text" hidden name="persalinan_table_${table_id}" value='${JSON.stringify(form_data)}'></td>
                            <td>${form_data['tgl_thn']} </td>
                            <td>${form_data['tempat_persalinan']} </td>
                            <td>${form_data['usia_hamil']} </td>
                            <td>${form_data['jenis_persalinan']} </td>
                            <td>${form_data['penolong']} </td>
                            <td>${form_data['penyulit']} </td>
                            <td>${form_data['jk']} </td>
                            <td>${form_data['bbpb']} </td>
                            <td>${form_data['keadaan']} </td>
                            <td><button type="button" class="btn btn-danger" onclick="hapusDataRiwayat('persalinan_${table_id}')">Hapus</button></td>
                        </tr>`)
    persalinanModal.hide();
    console.log($(form_el));
    $(form_el)[0].reset();
    riwayatPersalinanCount++;

}

function tambahEditDataRiwayat() {
    let form_el = document.querySelector("#editPersalinanForm");
    let table_id = generateString(5).trim();
    let form_data = {}
    let serialize_form = true;
    let form_inputs = form_el.querySelectorAll('input,select')
    form_inputs.forEach((x) => {
        if (x.value === "") {
            serialize_form = false;
        }
        form_data[x.getAttribute('id')] = x.value
    })
    // let serialize_form = $(form_el).serializeArray().every((d) => { if (d.value != '') {
    //         form_data[d.name] = d.value
    //         return true;
    //     }
    //     else return false;
    // })
    if (!serialize_form) return alert("Data tidak boleh kosong");
    $(`#tabelEditRiwayatPersalinan tbody`).append(`<tr id='persalinan_${table_id}'>
                            <td><input  type="text" hidden name="persalinan_table_${table_id}" value='${JSON.stringify(form_data)}'></td>
                            <td>${form_data['tgl_thn']} </td>
                            <td>${form_data['tempat_persalinan']} </td>
                            <td>${form_data['usia_hamil']} </td>
                            <td>${form_data['jenis_persalinan']} </td>
                            <td>${form_data['penolong']} </td>
                            <td>${form_data['penyulit']} </td>
                            <td>${form_data['jk']} </td>
                            <td>${form_data['bbpb']} </td>
                            <td>${form_data['keadaan']} </td>
                            <td><button type="button" class="btn btn-danger" onclick="hapusDataRiwayat('persalinan_${table_id}')">Hapus</button></td>
                        </tr>`)

    form_inputs.forEach(x => {
        x.value = ""
    })
}

function hapusDataRiwayat(id) {
    $('#' + id).remove();
}