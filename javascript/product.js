$(".product-like").hover(
    function () {
        $(this).attr("src", "images/product-assets/liked.png");
    }, 
    function () {
        $(this).attr("src", "images/product-assets/like.png");
    }
)

// Set ids of products in cart to hidden input to work with it
if(getCookie("cart") == "")
    $("#products-ids").val("-1");
else
    $("#products-ids").val(getCookie("cart"));

$(".product-add-to-cart").click(function() {
    if($(this).text() == "go to cart") {
        $(".cart-container").css("display","flex");
    } else {
        // pid for product id
        let pid = $(this).parent().find("#p-id").val();
        let cookie = getCookie("cart");

        if(getCookie("cart") == "") {
            setCookie("cart", "{" + pid + ",1}", 333);    
        } else {
            setCookie("cart", cookie + ", {" + pid + ",1}", 333);
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

$("#empty-message-box").css("display","block");

function fillCart() {
    let ids = getCookie("cart");
    if(ids == "-1") {
        $("#empty-message-box").css("display","block");
    } else {
        let arrIds = ids.split(", ");
        arrIds.forEach(fillProductsToCart);
    }
    /*<div class="cart-product-item">
        <div class="img-container">
            <img src="images/headphone.webp" class="cart-product-image" alt="">
        </div>
        <div style="width: 800px;">
            <p class="cart-product-info">Product name</p>
            <p class="cart-product-info"><span class="gray-font">qte <span style="font-size: 11px">✖</span></span> <span>price</span></p>
        </div>
        <div class="delete-product-container">
            <a href="#" class="delete-cart-product-button">✖</a>
        </div>
    </div>
    <div class="line-underneath"></div>*/
}

function fillProductsToCart(id_and_qte) {
    if (id_and_qte == null) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let product = JSON.parse(this.responseText);
                console.log(product);
                let name = (product["productName"].length > 35) ? product["productName"].substring(0, 25) + " .." : product["productName"];

                document.getElementById("cart-products").innerHTML += `
                    <div class="cart-product-item">
                        <div class="img-container">
                            <img src="images/headphone.webp" class="cart-product-image" alt="">
                        </div>
                        <div style="width: 800px;">
                            <p class="cart-product-info">${name}</p>
                            <p class="cart-product-info"><span class="gray-font">${product["qte"]} <span style="font-size: 11px">✖</span></span> <span>$${product["unitPrice"]}</span></p>
                        </div>
                        <div class="delete-product-container">
                            <a href="#" class="delete-cart-product-button">✖</a>
                        </div>
                    </div>
                    <div class="line-underneath"></div>
                `;
            }
        };
        xmlhttp.open("GET", "common/get_single_product.php?id=" + id_and_qte, true);
        xmlhttp.send();
    }

    /*<div class="cart-product-item">
        <div class="img-container">
            <img src="images/headphone.webp" class="cart-product-image" alt="">
        </div>
        <div style="width: 800px;">
            <p class="cart-product-info">Product name</p>
            <p class="cart-product-info"><span class="gray-font">qte <span style="font-size: 11px">✖</span></span> <span>price</span></p>
        </div>
        <div class="delete-product-container">
            <a href="#" class="delete-cart-product-button">✖</a>
        </div>
    </div>
    <div class="line-underneath"></div>*/
}

fillCart();