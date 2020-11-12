
$("#product_unit_price").bind("change paste keyup", function() {
    printByNature("#product_unit_price");
});
$("#product_discount").bind("change paste keyup", function() {
    printByNature("#product_discount");
});
$("#product_unit_weight").bind("change paste keyup", function() {
    printByNature("#product_unit_weight");
});
$("#product_units_in_stock").bind("change paste keyup", function() {
    printByNature("#product_units_in_stock");
});
$("#product_units_on_order").bind("change paste keyup", function() {
    printByNature("#product_units_on_order");
});
$("#product_available").bind("change paste keyup", function() {
    printByNature("#product_available");
});

// save the selected category and change the search placeholder depending on admin choice
let catById = $("#category option[value=" + $("#id").val() + "]").text() + " ..";
$("#category").val($("#id").val());
$("#search-field").attr("placeholder", "Search on " + catById);

$("#category").on("change", function() {
    let _catById = $("#category option[value=" + $("#category").val() + "]").text() + " ..";
    $("#search-field").attr("placeholder", "Search on " + _catById);
});
 // -----------------

function printByNature(inputId) {
    if(!isNumeric($(inputId).val())) {
        $(inputId+"-val").css("display", "block")
    } else {
        $(inputId + "-val").css("display", "none");
    }
}

let numrows = $("#nums").val();
$("#res-title").html("Result: " + numrows + " item" + ((numrows > 1) ? "s" : ""));

function isNumeric(str) {
    if (typeof str != "string") return false // we only process strings!  
    return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
            !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}

$("#close-product-infos-section").click(function() {
    $("#product-selected-to-manage").css("display", "none");
});

function printProductInfos(id) {
    $("#product-selected-to-manage").css("display", "flex");
    if (id == null) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("selected").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "API/getProduct.php?id=" + id, true);
        xmlhttp.send();
    }
}

// change suppliers dropdownlist by its value$("#suppliers").val()
$("#suppliers option[value='" + $("#suppliers").attr("value") + "']").attr('selected','selected');

// change category dropdownlist by its value
//$("#category option[value='" + $("#category").attr("value") + "']").attr('selected','selected');