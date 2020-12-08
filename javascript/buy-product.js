
function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
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

function setTotalQuantityPrice() {
    let unitPrice = $("#u-price").text();
    unitPrice = unitPrice.substr(1, unitPrice.length - 1);

    let quantity = $("#quantity option:selected").text();
    let totalProductPrice = unitPrice * quantity;
    totalProductPrice = number_format(totalProductPrice, 2, ".", ",");
    $("#total-product-qte-price").text("$" + totalProductPrice);
}

function checkProductCartExistence() {
    let productID = getParameterByName("id");
    let found = false;
    let prds_and_qtes = getCookie("cart").split(", ");
    for(let i=0;i<prds_and_qtes.length;i++) {
        let id = prds_and_qtes[i].substr(1, prds_and_qtes[i].length-2).split(",")[0];
        if(id == productID) {
            found = true;
            break;
        }
    }

    if(found) {
        $("#add-to-crt").text("Already in cart - Check");
    } else {
        $("#add-to-crt").text("Add to cart");
        $(".edit-button").addClass("inactiveLink");
    }
}

checkProductCartExistence();

function add_product_to_cart() {
    if($("#add-to-crt").text() == "Already in cart - Check") {
        fillCart();
        $(".cart-container").css("display","flex");
    } else {
        let productID = getParameterByName("id");
        let quantity = $("#quantity option:selected").text();

        let cookie = getCookie("cart");
        let prd = "{" + productID + "," + quantity + "}";

        if(cookie == "") {
            setCookie("cart", prd, 365);
        } else {
            setCookie("cart", cookie + ", " + prd);
        }

        $("#add-to-crt").text("Already in cart - Check");
        fillCart();
    }
    
    event.preventDefault();
}


setTotalQuantityPrice();

$("#quantity").change(function() {
    setTotalQuantityPrice();
});

$("#add-to-crt").click(function() {
    add_product_to_cart();   
    
    event.preventDefault();
    return false;
});

$(".edit-button").click(function() {
    /*
        Here we have to take the edited value and compare it with the old quantity in cart cookie,
        if the user change it then update the quantity, otherwise print a message to tell th user to change
        the value before clicking on edit button. First fetch the quantity from cart cookie,
    */
    let pid = getParameterByName("id");
    let qte = getqteById(pid);
    let quantity = $("#quantity option:selected").text();

    if(qte != -1) {
        if(qte == quantity) {
            $("#edit-error").css("display", "block");
        } else {
            // HERE CHANGE THE QUANTITY
            changeQyantity(pid, quantity);
        }
    }

    return false;
});

function changeQyantity(id, newQuantity) {
    if(newQuantity < 0)
        return;
    let newCart = "";
    let ids_and_qts = getCookie("cart").split(", ");

    for(let i = 0;i<ids_and_qts.length;i++) {
        let pid = ids_and_qts[i].substr(1, ids_and_qts[i].length - 1).split(",")[0];
        
        if(pid == id) {
            console.log("found");
            let res = '{' + id + "," + newQuantity + '}';
            if(newCart == "") {
                newCart = res;
            } else {
                newCart += ", " + res;
            }
        } else {
            if(newCart == "")
                newCart = ids_and_qts[i];
            else
                newCart += ", " + ids_and_qts[i];
        }
    }

    setCookie("cart", newCart, 365);
}

$("#hide-hint").click(function() {
    $("#edit-error").css("display", "none");

    return false;
})

function fillQteIfProductExists() {
    let productID = getParameterByName("id");
    let prds_and_qtes = getCookie("cart").split(", ");
    let found = false;
    let qte = 1;
    for(let i=0;i<prds_and_qtes.length;i++) {
        let id = prds_and_qtes[i].substr(1, prds_and_qtes[i].length-2).split(",")[0];
        if(id == productID) {
            qte =  prds_and_qtes[i].substr(1, prds_and_qtes[i].length-2).split(",")[1];
            found = true;
            break;
        }
    }

    if(found) {
        $('#quantity option[value=' + qte + ']').attr('selected','selected');
    } else {
        $('#quantity option[value=' + 1 + ']').attr('selected','selected');
    }
    
}

fillQteIfProductExists();

var imageDemoCanvas = document.getElementById("img-demo");

var ctx = imageDemoCanvas.getContext("2d");
var prdImg = document.getElementById("image-demo");
// Draw the image inside the canvas
function fillCanvas(src) {
    let prdImg = new Image();
    prdImg.src = src;
    //var prdImg = document.getElementById("image-demo");

    let imgWidth = prdImg.width;
    let imgHeight = prdImg.height;
    let canvasWidth = 400;
    let canvasHeight = canvasWidth * imgHeight / imgWidth;

    ctx.canvas.width = canvasWidth;
    ctx.canvas.height = canvasHeight;

    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
    console.log("image width:" + prdImg.width + ", image height: " + prdImg.height);
    console.log("canvas width: " + ctx.canvas.width + ", height: " + ctx.canvas.height)
    ctx.drawImage(prdImg, 0, 0, ctx.canvas.width, ctx.canvas.height);
}

fillCanvas($("#image-demo").attr("src"));

$("#img-demo").on({
    mouseenter: function() {
        $("#zoomed-image-container").css("display", "flex");
        // Show the image into the absolut container in zoomed form

    },
    mouseleave: function() {
        $("#image-bck").css("display","none");
        $("#zoomed-image-container").css("display", "none");
    }
});

$(".product-asset-container").on("mouseenter", function() {
    $(".product-asset-container").removeClass("product-image-style");
    $(this).addClass("product-image-style");
    
    fillCanvas($(this).find(".product-image-info").attr("src"));
    
    if($(this).find(".product-video-asset").length > 0) {
        $("#video-entity").css("display", "block");
        $("#img-demo").css("display", "none");
    } else {
        $("#video-entity").css("display", "none");
        $("#img-demo").css("display", "block");
    }
});

$("#img-demo").mousemove(function (e) {
    let containerHeight = $(this).attr("height");
    // TOP, LEFT EDGE
    if(e.pageX - $('#img-demo').offset().left <= 40 && e.pageY - $('#img-demo').offset().top <= 40) {
        $(".cursor").show().css({
            "left": 95,
            "top": 138
        });
    }
    // RIGHT, BOTTOM EDGE
    else if(e.pageX - $('#img-demo').offset().left >=360 &&  containerHeight -(e.pageY - $('#img-demo').offset().top) <= 40 ) {
        $(".cursor").show().css({
            "left": 95 + 320,
            "top": 138 + parseInt(containerHeight) - 80
        });
    }
    // LEFT, BOTTOM EDGE
    else if(e.pageX - $('#img-demo').offset().left <=40 &&  containerHeight -(e.pageY - $('#img-demo').offset().top) <= 40 ) {
        $(".cursor").show().css({
            "left": 95,
            "top": 138 + parseInt(containerHeight) - 80
        });
    }
    // LEFT LINE
    else if(e.pageX - $('#img-demo').offset().left < 40 && e.pageY - $('#img-demo').offset().top >= 40) {
        $(".cursor").show().css({
            "left": 95,
            "top": 138 + (e.pageY - $('#img-demo').offset().top) - 40
        });
    }
    // TOP, RIGHT EDGE
    else if(e.pageX - $('#img-demo').offset().left >= 360 && e.pageY - $('#img-demo').offset().top < 40) {
        $(".cursor").show().css({
            /* 95 width before container, 360 to get to most left - 40 because pointer is in middle of cursor (80px of cursor) */
            "left": 95 + 360 - 40 + 2,
            "top": 138
        });
    }
    // TOP LINE
    else if(e.pageX - $('#img-demo').offset().left > 40 && e.pageY - $('#img-demo').offset().top < 40) {
        $(".cursor").show().css({
            "left": 55 + e.pageX - $('#img-demo').offset().left,
            "top": 138 + e.pageY - $('#img-demo').offset().top < 40
        });
    }
    // LEFT LINE
    else if(e.pageX - $('#img-demo').offset().left < 40 && e.pageY - $('#img-demo').offset().top >= 40) {
        $(".cursor").show().css({
            "left": 95,
            "top": 138 + (e.pageY - $('#img-demo').offset().top) - 40
        });
    }
    // RIGHT LINE
    else if(e.pageX - $('#img-demo').offset().left >= 360 && e.pageY - $('#img-demo').offset().top >= 40) {
        $(".cursor").show().css({
            "left": 95 + 360 - 40 + 2,
            "top": 138 + e.pageY - $('#img-demo').offset().top - 40
        });
    }
    // BOTTOM LINE
    else if(e.pageX - $('#img-demo').offset().left >= 40 && e.pageY - $('#img-demo').offset().top >= containerHeight - 40) {
        $(".cursor").show().css({
            "left": 95 + e.pageX - $('#img-demo').offset().left - 40,
            "top": 138 + parseInt(containerHeight) - 79
        });
    }
     /*
    else if(e.pageX - $('#img-demo').offset().left >= 40 && e.pageY - $('#img-demo').offset().top < 40) {
        $(".cursor").show().css({
            "left": 95 + e.pageX - $('#img-demo').offset().left,
            "top": 138
        });
    } else if(e.pageX - $('#img-demo').offset().left >= 360 && e.pageY - $('#img-demo').offset().top < 360) {
        $(".cursor").show().css({
            "left": 416,
            "top": 98 + e.pageY - $('#img-demo').offset().top
        });
    } else if(e.pageX - $('#img-demo').offset().left >= 360 && e.pageY - $('#img-demo').offset().top > 360) {
        $(".cursor").show().css({
            "left": 416,
            "top": e.pageY - $('#img-demo').offset().top + 40
        });
    }*/
    else {
        $(".cursor").show().css({
            "left": 95 + e.pageX - $('#img-demo').offset().left - 40,
            "top": 138 + e.pageY - $('#img-demo').offset().top - 40
        });
    }
}).mouseout(function () {
    $(".cursor").hide();
});



/*$("#image-demo").on("mousemove", function(e) {
    
    var x = e.pageX;     // Get the horizontal coordinate
    var y = e.pageY;

    $("#image-bck").css({left:x, top:y});
});*/





function getMousePos(e) {
    return {x:e.clientX,y:e.clientY};
}

/*$(".product-asset-container").on("mouseenter", function() {
    if($(this).find(".product-video-asset")) {
        console.log("It's a video");
    }

    console.log($(this).find(".product-video-asset").length);
});*/



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


