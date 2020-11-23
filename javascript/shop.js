
// Get category from query string
const urlParams = new URLSearchParams(window.location.search);
const category = getParameterByName("category");

/* Here, you need to check whether this category that is fetched from query string is valid or not
   by using ajax. if it's valide then ok, otherwise print a custom error
*/


// Set category dropdownlist to its names category by value
$(".categories-dropdownlist option[value='" + category + "']").attr('selected','selected');

// Change placeholder based on category
let catById = $(".categories-dropdownlist option[value=" + category + "]").first().text() + " ..";
$("#search-field").attr("placeholder", "Search on " + catById);

function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

// Setting result number of products
$("#row-count").text($("#hidden-row-count").val());

$(".product-see-more").click(function() {
    
});

$("#back-to-shop-result").click(function() {
    window.history.go(-1); 
    return false;
});

$(".product-asset-container").on("mouseenter", function() {
    $(".product-asset-container").removeClass("product-image-style");
    $(this).addClass("product-image-style");
});

$(".product-asset-container").on("mouseenter", function() {
    $("#image-demo").attr("src", $(this).find(".product-image-info").attr("src"));
});

/*$(".product-see-more").click(function() {
    // Get product id when user click on products image
    let productId = $(this).parent().parent().find(".current-product-id").val();
    
    // First put the css properties of the selected product to default values
    $("#selected").css("margin-top","auto");

    $(".semi-black-section-infos").css("display","flex");

    $("#selected").animate({width: "50%"}, 150, "linear");
    $("#selected").animate({marginTop: ""}, 200, "linear");

    return false;
});

$(".close-semi-black-section-info").click(function() {
    $(".semi-black-section-infos").css("display","none");
});*/

// Click somewhere except selected product section to close the section [LATER]
/*$(function() {
    $(document).on('click', function(e) {
        
        if (e.target.id == "selected") {
            console.log(e.target);
        } else {
            console.log("outside");
            
            $('.semi-black-section-infos').css("display","none");
        }
    })
})*/

