$(".product-like").hover(
    function () {
        $(this).attr("src", "images/product-assets/liked.png");
    }, 
    function () {
        $(this).attr("src", "images/product-assets/like.png");
    }
)

$(".product-add-to-cart").click(function() {
    
    $(this).text("go to cart");
    
    return false;
});