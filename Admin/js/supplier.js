$("#close-supplier-infos").click(function() {
    $("#supplier-infos").css("display", "none");
})

function printSupplierInfos(id) {
    $("#supplier-infos").css("display", "flex");
    console.log(id);
    /*if (id == null) {
        return;
    } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "gethint.php?q=" + str, true);
    xmlhttp.send();
    }*/
}