$("#close-supplier-infos").click(function() {
    $("#supplier-infos").css("display", "none");
});

function printSupplierInfos(id) {
    $("#supplier-infos").css("display", "flex");
    if (id == null) {
        return;
    } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("selected").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "ajaxGetSupplier.php?id=" + id, true);
    xmlhttp.send();
    }
}

