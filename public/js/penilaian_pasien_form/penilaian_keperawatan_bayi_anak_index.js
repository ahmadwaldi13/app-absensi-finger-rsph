
const riwayatImunisasiModal = document.getElementById('imunisasiPasien') && new bootstrap.Modal(document.getElementById('imunisasiPasien'), {
    keyboard: false
})
let riwayatImunisasiCount = 1;
$("#imunisasiPasien form").submit(function () {
    let form_data = {}

    let table_id = generateString(5).trim();
    console.log($(this).serializeArray())
    let serialize_form = $(this).serializeArray().every((d) => {
        if (d.value != '') {
            form_data[d.name] = d.value
            return true;
        }
        else return false;
    })
    if (!serialize_form) return alert("Data tidak boleh kosong");
    kode_imunisasi = form_data['kode_imunisasi'].split("_");
    form_data['kode_imunisasi'] = kode_imunisasi[0];

    $("#tabelimunisasiPasien tbody").append(`<tr id='persalinan_${table_id}'>
                            <td><input  type="text" hidden name="imunisasi_${table_id}" value='${JSON.stringify(form_data)}'></td>
                            <td>${kode_imunisasi[1]} </td>
                            <td>${form_data['no_imunisasi'] == 1 ? '&check;' : ''}</td>
                            <td>${form_data['no_imunisasi'] == 2 ? '&check;' : ''}</td>
                            <td>${form_data['no_imunisasi'] == 3 ? '&check;' : ''}</td>
                            <td>${form_data['no_imunisasi'] == 4 ? '&check;' : ''}</td>
                            <td>${form_data['no_imunisasi'] == 5 ? '&check;' : ''}</td>
                            <td>${form_data['no_imunisasi'] == 6 ? '&check;' : ''}</td>
                            <td><button type="button" class="btn btn-danger" onclick="hapusDataRiwayat('persalinan_${table_id}')">Hapus</button></td>
                        </tr>`)
    riwayatImunisasiModal.hide();
    $(this)[0].reset();
})
function tambahEditDataImunisasi() {
    let form_el = document.querySelector("#editImunisasiForm");
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
    kode_imunisasi = form_data['kode_imunisasi'].split("_");
    form_data['kode_imunisasi'] = kode_imunisasi[0];
    if (!serialize_form) return alert("Data tidak boleh kosong");
    $("#tabelimunisasiPasien tbody").append(`<tr id='imunisasi_${table_id}'>
                            <td><input  type="text" hidden name="imunisasi_${table_id}" value='${JSON.stringify(form_data)}'></td>
                            <td>${kode_imunisasi[1]} </td>
                            <td><input  type="radio" onclick="updateImunisasi('${table_id}', '1')"  ${form_data['no_imunisasi'] == 1 ? 'checked' : ''}></td>
                            <td><input  type="radio" onclick="updateImunisasi('${table_id}', '2')"  ${form_data['no_imunisasi'] == 2 ? 'checked' : ''}></td>
                            <td><input  type="radio" onclick="updateImunisasi('${table_id}', '3')"  ${form_data['no_imunisasi'] == 3 ? 'checked' : ''}></td>
                            <td><input  type="radio" onclick="updateImunisasi('${table_id}', '4')"  ${form_data['no_imunisasi'] == 4 ? 'checked' : ''}></td>
                            <td><input  type="radio" onclick="updateImunisasi('${table_id}', '5')"  ${form_data['no_imunisasi'] == 5 ? 'checked' : ''}></td>
                            <td><input  type="radio" onclick="updateImunisasi('${table_id}', '6')"  ${form_data['no_imunisasi'] == 6 ? 'checked' : ''}></td>
                            <td><button type="button" class="btn btn-danger" onclick="hapusDataRiwayat('imunisasi_${table_id}')">Hapus</button></td>
                        </tr>`)

    form_inputs.forEach(x => {
        x.value = ""
    })
}
function hapusDataRiwayat(id) {
    $('#' + id).remove();
}
function updateImunisasi(key, no) {
    let imunisasi_data = document.querySelector(`input[name="imunisasi_${key}"]`)
    let old_data = JSON.parse(imunisasi_data.value)
    let new_data = old_data;
    new_data['no_imunisasi'] = no;

    let radioElements = document.querySelectorAll(`#imunisasi_${key} input[type='radio']`)
    radioElements.forEach(el => {
        el.checked = false
    })
    radioElements[no - 1].checked = true
    imunisasi_data.value = JSON.stringify(new_data)
    console.log(new_data)
}