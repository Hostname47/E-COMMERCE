$(".product-like").hover(
    function () {
        $(this).attr("src", "images/product-assets/liked.png");
    }, 
    function () {
        $(this).attr("src", "images/product-assets/like.png");
    }
)

delete_cookie("cart");
console.log("cookie: " + getCookie("cart"));

$(".product-add-to-cart").click(function() {
    if($(this).text() == "go to cart") {
        console.log("go to cart");
    } else {
        // pid for product id
        let pid = $(this).parent().find("#p-id").val();
        let cookie = getCookie("cart");

        if(getCookie("cart") == "") {
            setCookie("cart", pid, 333);    
        } else {
            setCookie("cart", cookie + ", " + pid, 333);
        }
    }
    $(this).text("go to cart");
    
    return false;
});

function setCookie(cname, cvalue, exdays) {
    let d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function delete_cookie( name ) {
    if( getCookie(name) ) {
        document.cookie = name +
        ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
    }
}

function fillCart() {
    
}