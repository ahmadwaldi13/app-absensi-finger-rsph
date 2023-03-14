$(document).ready(function() {
    $('.poliklinik').select2({
        width: 'resolve'
    });
});

var tema = document.querySelector("#kode_template");
var link_video = document.querySelector(".link_video");
var peringatan = document.querySelector(".peringatan");
tema.addEventListener("change", () => {
    if (tema.value === '2') {
        link_video.style.display = "block";
        peringatan.style.display = "block";
    } else {
        link_video.style.display = "none";
        peringatan.style.display = "none";
    }
});