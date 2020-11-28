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
        fillCart();
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
        fillCart();
    }
    $(this).text("go to cart");
    
    return false;
});

function fillCart() {
    let ids = getCookie("cart");
    
    if(ids == "-1" || ids == "") {
        $("#empty-message-box").css("display","block");
        $("#remaining-cart-info").css("display","none");
        $("#cart-products").css("display","none");
    } else {
        $("#cart-products").css("display","block");
        $("#remaining-cart-info").css("display","block");
        $("#empty-message-box").css("display","none");
        let arrIds = ids.split(", ");
        $("#hidden-sub-total").val("0");
        document.getElementById("cart-products").innerHTML = "";
        arrIds.forEach(fillProductsToCart);
    }
}

function fillProductsToCart(id_and_qte) {
    if (id_and_qte == null) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let product = JSON.parse(this.responseText);
                let name = (product["productName"].length > 35) ? product["productName"].substring(0, 25) + " .." : product["productName"];

                document.getElementById("cart-products").innerHTML += `
                    <div class="cart-product-item">
                        <input type="hidden" value="${product["productID"]}" class="pr-id"/>
                        <input type="hidden" value="${id_and_qte}" class="id_and_qte"/>
                        <div class="img-container">
                            <img src="http://localhost/E-COMMERCE/Admin/products/${product['pic']}" class="cart-product-image" alt="">
                        </div>
                        <div style="width: 800px;">
                            <p class="cart-product-info">${name} id=${product['productID']}</p>
                            <p class="cart-product-info"><span class="gray-font">${product["qte"]} <span style="font-size: 11px">✖</span></span> <span>$${product["unitPrice"]}</span></p>
                        </div>
                        <div class="delete-product-container">
                            <a href="" class="delete-cart-product-button">✖</a>
                        </div>
                    </div>
                    <div class="line-underneath"></div>
                `;

                // Calculate subtotal and past it to hidden input to use it by subtotal span
                prds = product["qte"] * product["unitPrice"];
                old = parseInt($("#hidden-sub-total").val());
                old += prds;
                $("#hidden-sub-total").val(old);
                $("#sub").text("$" + old);

                $(".delete-cart-product-button").on("click", function(e) {
                    e.preventDefault();
                    //console.log($(this).parent().parent().find(".id_and_qte").val());
                    prod_id = $(this).parent().parent().find(".pr-id").val();
                    deleteProductFromCart($(this).parent().parent().find(".id_and_qte").val(), prod_id);
                    console.log(prod_id + " changed to add to text");

                });                
            }
        };
        xmlhttp.open("GET", "common/get_single_product.php?id=" + id_and_qte, true);
        xmlhttp.send();
    }
}

function deleteProductFromCart(id_nd_qte, id) {
    let ids_and_qtes =  getCookie("cart");
    if(ids_and_qtes == "") {
        setCookie("cart", "-1", 360);
    }
    iq = ids_and_qtes.split(", ");
    iq = removeA(iq, id_nd_qte);
    iq = iq.join(", ");

    setCookie("cart", iq, 365);
    $("#hidden-sub-total").val(old);
    $("#sub").text("$" + old);
    fillCart();

    /* We have to change the text of add to cart to add to cart to be able to add it again
       To do that we have to loop over products and find this specific deleted product and 
       turn its add to cart text to add to cart
    */
    $(".product-item").each(function() {
        if($(this).find(".current-product-id").val() == id) {
            $(this).find(".product-add-to-cart").text("Add to cart");
        }
    });
}

function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}

fillCart();

