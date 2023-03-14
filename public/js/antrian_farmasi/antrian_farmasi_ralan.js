

function setValue(key, item) {
    document.getElementById("poliklinik").value = item;
    document.getElementById("valuePoli").value = key;
    document.getElementById("close").click();

    window.localStorage.setItem("dataPoli", item);
}