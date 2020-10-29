
// Product panel open nesting
$("#products-management").click(function() {
    let product_manag = $("#product-related-items");
    if(product_manag.css("display") == "none") {
        product_manag.css("display", "flex");
        $("#products-management").text("Products Management ▸");
    } else {
        product_manag.css("display", "none");
        $("#products-management").text("Products Management ▾");
    }
});

$("#category-management").click(function() {
    let category_manag = $("#category-related-items");
    if(category_manag.css("display") == "none") {
        category_manag.css("display", "flex");
        $("#category-management").text("Categories ▸");
    } else {
        category_manag.css("display", "none");
        $("#category-management").text("Categories ▾");
    }
});

$("#shippers-management").click(function() {
    let shipper_manag = $("#shippers-related-items");
    if(shipper_manag.css("display") == "none") {
        shipper_manag.css("display", "flex");
        $("#shippers-management").text("Shippers management ▸");
    } else {
        shipper_manag.css("display", "none");
        $("#shippers-management").text("Shippers management ▾");
    }
});
