$("#close-supplier-infos").click(function() {
    $("#supplier-infos").css("display", "none");
});

function editSupplier(id) {
    fillEditedFields(id);
}

function fillEditedFields(id) {
    if (id == null) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                data = JSON.parse(this.responseText);
                $("#id_sup").val(data["sup_id"]);
                $("#company_name").val(data["companyName"]);
                $("#contact_firstname").val(data["contactFname"]);
                $("#contact_lastname").val(data["contactLname"]);
                $("#contact_address1").val(data["address1"]);
                $("#contact_address2").val(data["address2"]);
                $("#city").val(data["city"]);
                $("#postal_code").val(data["postalCode"]);
                $("#email").val(data["email"]);
                $("#type_goods").val(data["typeGoods"]);
                $("#payment_method").val(data["paymentMethods"]);
                $("#discount_available").val(data["discountAvailable"]);
            }
        };
        xmlhttp.open("GET", "API/getSupplierAsRow.php?id=" + id, true);
        xmlhttp.send();
    }
}

function deleteSupplier(id) {
    if (id == null) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
            }
        };
        xmlhttp.open("GET", "API/deleteSupplier.php?id=" + id, true);
        xmlhttp.send();
    }
}

function refresh() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementsByClassName("suppliers-container").innerHTML = this.responseText;
            console.log(this.responseText);
        }
    };
    xmlhttp.open("GET", "API/getAllSuppliers.php", true);
    xmlhttp.send();
}

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
        xmlhttp.open("GET", "API/ajaxGetSupplier.php?id=" + id, true);
        xmlhttp.send();
    }
}
