
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
let catById = $("#category option[value=" + $("#val").val() + "]").text() + " ..";
$("#category").val($("#val").val());
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
    $("#id-to-delete").val(id);
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

$("#edit-a").click(function(event){
    /*var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xmlhttp.open("GET", "API/edit.php?id=" + $("#edited-id").val(), true);
    xmlhttp.send();
    
    return false;*/
});

function deleteProduct() {
    $("#product-selected-to-delete").css("display", "flex");
}

$("#close-product-delete-section").click(function() {
    $("#product-selected-to-delete").css("display", "none");
});

$("#not-sure").click(function() {
    $("#product-selected-to-delete").css("display", "none");
    return false;
});

$("#sure").click(function(){
    let id = $("#id-to-delete").val();
    if (id == null) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText == 1) {
                    document.getElementById("delete-result").innerHTML = "Product deleted successfully.";
                    document.getElementById("delete-result").style.color = "green";
                } else {
                    document.getElementById("delete-result").innerHTML = "Error occured while deleting the product !";
                    document.getElementById("delete-result").style.color = "red";
                }
            }
        };
        xmlhttp.open("GET", "API/deleteProduct.php?id=" + id, true);
        xmlhttp.send();
    }

    return false;
});


// --------- PAGING ---------

$(".paging-button").click(function(e) {
    let productName = $("#search-field").val();
    let minPrice = $("#min-price").val();
    let maxPrice = $("#max-price").val();
    let category = $("#category").val();
    $(".paging-button").removeClass("paging-selected-page");

    if($(this).text() == "<< first") {

        $(this).next().addClass("paging-selected-page");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("products-container").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "API/getPagedProducts.php?min_bound=" + 0 + "&prod_number=" + 4 + "&name=" 
            + productName + "&min=" + minPrice + "&max=" + maxPrice + "&category=" + category, true);
        xmlhttp.send();
        
    } else if($(this).text() == "last >>") {
        $(this).prev().addClass("paging-selected-page");

        let minBound = ($(this).prev().text() - 1) * 4;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("products-container").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "API/getPagedProducts.php?min_bound=" + minBound + "&prod_number=" + 4 + "&name=" 
            + productName + "&min=" + minPrice + "&max=" + maxPrice + "&category=" + category, true);
        xmlhttp.send();

    } else {
        $(this).addClass("paging-selected-page");
        let minBound = ($(this).text() - 1) * 4 /* 4 here is number of products per page */;
        let maxBound = 4/* 4 here is number of products per page */;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("products-container").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "API/getPagedProducts.php?min_bound=" + minBound + "&prod_number=" + maxBound + "&name=" 
            + productName + "&min=" + minPrice + "&max=" + maxPrice + "&category=" + category, true);
        xmlhttp.send();
    }

    e.preventDefault();
});