
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

function printByNature(inputId) {
    if(!isNumeric($(inputId).val())) {
        $(inputId+"-val").css("display", "block")
    } else {
        $(inputId + "-val").css("display", "none");
    }
}

function isNumeric(str) {
    if (typeof str != "string") return false // we only process strings!  
    return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
            !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}