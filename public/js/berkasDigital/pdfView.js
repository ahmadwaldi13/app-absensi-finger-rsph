// const viewImageModal = new bootstrap.Modal($("#viewImageModal"), {
//     keyboard: false
// })
const confirmDeleteImageModal = new bootstrap.Modal($("#deleteImage"), {
    keyboard: true
})

let imageData = {}

function openViewImageModal(url) {
    console.log(url)
    $("#modal_image").attr("src", url)
    viewImageModal.show()
}

function openDeleteConfirm(nama, id, url) {
    $("#deleteImageLabel span").text(nama)
    imageData = { nama, id, url }
    confirmDeleteImageModal.show()
}

$("#deleteImage form").submit(function (e) {
    e.preventDefault()
    const formData = new FormData(e.currentTarget)
    formData.append("nama", imageData["nama"])
    formData.append("id", imageData["id"])
    formData.append("url", imageData["url"])
    $(".spinner-border").removeClass("d-none")
    $.ajax({
        type: "POST",
        url: `${base_url}berkas-digital/hapus`,
        data: formData,
        processData: false,
        contentType: false,
        success: (data) => {
            $(".spinner-border").addClass("d-none")
            window.location.reload()

        },
        error: (e) => {
            $(".spinner-border").addClass("d-none")
            window.location.reload()
        }
    });
})



function manage_checkbox(checkbox, parent_id) {
    let count_checked_option = 0;
    let optional_download = [];
    let id_check_all = $(parent_id).hasClass("option_checkbox_sub") ? "berkas_unduh_semua_sub" : "berkas_unduh_semua";
    let parent_element = $(parent_id).hasClass("option_checkbox_sub") ? $(checkbox).parents(".option_checkbox_sub") : $(parent_id)


    if ($(checkbox).attr('id') === id_check_all) {
        parent_element.find("input:checkbox").prop('checked', $(checkbox).prop('checked'));
    }


    parent_element.find(".berkas_unduh_opsi:checkbox").map(function (i, v) {
        count_checked_option++;
        if (this.checked) {
            optional_download.push(this.value);

        } else {
            parent_element.find(`input:checkbox#${id_check_all}`).prop('checked', false);
        }
    })

    if (count_checked_option === optional_download.length) {
        parent_element.find(`input:checkbox#${id_check_all}`).prop('checked', true);
    }

    console.log(optional_download)

    parent_element.find(`#option_download_list`).val(optional_download);
}


function set_optional_download_event(selector) {
    let sub_selector = selector + " .option_checkbox_sub";
    $(selector).change(function (e) { manage_checkbox(e.target, selector) })
    $(sub_selector).change(function (e) { manage_checkbox(e.target, sub_selector) })
}

set_optional_download_event("#optionDownload");
set_optional_download_event("#optionDownloadBerkasUnggah");
set_optional_download_event("#opsi-semua-klaim");
set_optional_download_event("#opsi-semua-unggah");