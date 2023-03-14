function setValue(key, item) {
    document.getElementById("kamar").value = item;
    document.getElementById("valueRoom").value = key;
    document.getElementById("close").click();

    window.localStorage.setItem("dataRoom", item);
}
