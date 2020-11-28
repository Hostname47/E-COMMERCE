$("#top-nav-shop").removeClass("header-top-underline-style");

$("#cart-button").addClass("simple-menu-button-style");

$("#products-in-cart").innerHTML = "TEST";

function fillCartProducts() {
    let cookie = getCookie("cart");

    if(cookie == "") {
        setCookie("cart", "", 360);
    }
    let iqs = cookie.split(", ");

    for(let i = 0;i<iqs.length;i++) {
        // Here we don't have to clear curly bracket because the file that will fetch it will do all the work for us
        // splite iqs and get both id and qte in different variables
        addproductToCart(iqs[i]);
    }
}

function addSubTotal() {
    let productsContainer = $("#products-in-cart");
    if(productsContainer.find("#edit-qte").length > 0) {
        document.getElementById("products-in-cart").innerHTML += `
            <div style="display: flex">
                <p class="cart-sub">Subtotal (<span class="number-of-items"></span> items): <span class="cart-prd-price sb-total">$4,238.65<span></p>
            </div>
        `;

        $(".number-of-items").text($("#total-qte").val());

        let formatedTotalPrice = number_format($("#total-price").val(), 2, ".", ",");
        $(".sb-total").text("$" + formatedTotalPrice);
    } else {
        $(".empty-cart").css("display","block");
    }
}

function number_format(number, decimals, dec_point, thousands_sep) {
    // http://kevin.vanzonneveld.net
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://getsprink.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +     bugfix by: Howard Yeend
    // +    revised by: Luke Smith (http://lucassmith.name)
    // +     bugfix by: Diogo Resende
    // +     bugfix by: Rival
    // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
    // +   improved by: davook
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Jay Klehr
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Amir Habibi (http://www.residence-mixte.com/)
    // +     bugfix by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // +   improved by: Drew Noakes
    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');
    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'
    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    // *     example 7: number_format(1000.55, 1);
    // *     returns 7: '1,000.6'
    // *     example 8: number_format(67000, 5, ',', '.');
    // *     returns 8: '67.000,00000'
    // *     example 9: number_format(0.9, 0);
    // *     returns 9: '1'
    // *    example 10: number_format('1.20', 2);
    // *    returns 10: '1.20'
    // *    example 11: number_format('1.20', 4);
    // *    returns 11: '1.2000'
    // *    example 12: number_format('1.2000', 3);
    // *    returns 12: '1.200'
    var n = !isFinite(+number) ? 0 : +number, 
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        toFixedFix = function (n, prec) {
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            var k = Math.pow(10, prec);
            return Math.round(n * k) / k;
        },
        s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function addproductToCart(id) {
    if (id == null) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let productsContainer = document.getElementById("products-in-cart");

                let product = JSON.parse(this.responseText);

                // Get quantity from every product in cart by using cookie qte
                let qte = id.substr(1, id.length-2);
                qte = qte.split(",");
                qte = qte[1];

                let price = number_format(product['unitPrice'],2,".",",");

                let stockState = product["productAvailable"] > 0 ? 1 : 0;
                let stockText = "";
                let stockClass = "";

                if(stockState == 1) {
                    stockText = "In Stock";
                    stockClass = "in-stock";
                } else {
                    stockText = "Out of Stock";
                    stockClass = "out-of-stock";
                }


                let productString = `
                    <div class="cart-product-item">
                        <div class="cart-product-img-container">
                            <a href="#"><img src="http://localhost/E-COMMERCE/Admin/products/${product['pic']}" alt=""></a>
                        </div>
                        <div class="cart-prd-infos-section">
                            <p class="cart-prd-name">${product['productName']} by - <span class="normal-p" style="color: rgb(60, 60, 60)">by Mouad Nassri(here use other file to get product by joining supplier to product data to get supplier name here)</span></p>
                            <p class="bold-p cart-prd-category">${product["categoryName"]}</p>
                            <p class="stock-state ${stockClass}">${stockText}</p>
                            <!-- quantity and edit button -->
                            <div style="display: flex; align-items: center; margin-top: 5px" >
                                <input type="hidden" value="${qte}" class="tst" >
                                <select name="quantity" class="card-prd-quantity" style="background-color: rgb(240, 240, 240)" value="${qte}">
                                    
                                </select>
                                <a href="#" id="edit-qte">edit</a>
                            </div>
                        </div>
                        <div class="price-section">
                            <p class="cart-prd-price">$${price}</p>
                        </div>
                    </div>
                    <div class="line-underneath" style="margin-bottom: 10px"></div>
                `;

                productsContainer.innerHTML += productString;
            }
        };
        xmlhttp.open("GET", "common/get_single_product.php?id=" + id, false);
        xmlhttp.send();
    }
}

function fillQuantity() {
    let cookie = getCookie("cart");
    if(cookie == "" || cookie == "-1") {
        setCookie("cart", "", 360);
    } else {
        let iqs = cookie.split(", ");    
        for(let i=0;i<iqs.length;i++) {
            for(let j=1;j<=20;j+=1){
                let optn = document.createElement("option");
                optn.text = j;
                optn.value = j;
                document.getElementsByClassName("card-prd-quantity")[i].appendChild(optn);
            };
        }
    }
}

function fillQuantitiesValues() {
    let number_of_items = 0;
    let totalPrice = 0;
    $('.card-prd-quantity').each(function() {
        // get the quantity
        let qte = $(this).attr("value");

        // Accumulate the quantities to get total number of items
        number_of_items += parseInt(qte);

        // Get price of each product and multiply it by the qunatity for sake of total price accumulation
        let prodPrice = $(this).parent().parent().parent().find(".price-section").find(".cart-prd-price").text();

        // Here we get formated price with dollar sign and comma and dots separators we need to get rid of them
        prodPrice = prodPrice.substr(1, prodPrice.length-1);
        prodPrice = parseFloat(prodPrice.replace(/,/g, ''));

        totalPrice += qte*prodPrice;
        
        /* Here we loop over options and find out the one equals to quantity in cookie
           and when we find it we change the selected option to this value
        */
        $(this).children().each(function() {
            if($(this).val() == qte) {
                $(this).attr("selected","selected");
            }
        })
    });

    $("#total-qte").val(number_of_items);
    $("#total-price").val(totalPrice);
}

fillCartProducts();
fillQuantity();
fillQuantitiesValues();
addSubTotal();