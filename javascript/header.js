$(".categories-dropdownlist").change(function() {
    let val = this.options[this.selectedIndex].text;
    $(".search-field").attr("placeholder", "Search on " + val);

    //.categories-dropdownlist scalable proportional to category text
    /*canvas = document.createElement("canvas"); 
    context = canvas.getContext("2d"); 
    context.font = "Karla"; 
    width = context.measureText(val).width + 58;
    formattedWidth = Math.ceil(width); 
    
    if(formattedWidth > 200.0)
        $(".categories-dropdownlist").css("width", "80px");

    $(".categories-dropdownlist").css("width", formattedWidth + "px");
    
    console.log(formattedWidth);*/
})

$('.menu-top').click(function(e) {
    e.preventDefault();

    let height = $("#top-small-device-nav").css("height");

    if(height != "0px") {
        closeMobileMenu();
    } else {
        openMobileMenu();
        closeMobileSearch();
    }
});

$('.mobile-search-top').click(function() {
    let container = $(".search-mobile-container");

    if(container.css("display") == "none") {
        openMobileSearch();
        closeMobileMenu();
    } else {
        closeMobileSearch();
    }
});

function openMobileSearch() {
    let container = $(".search-mobile-container");
    container.css("display", "block");
    closeMobileMenu();
}

function closeMobileSearch() {
    let container = $(".search-mobile-container");
    container.css("display", "none");
}

function openMobileMenu() {
    $("#top-small-device-nav").css("height", "auto");
    $('.menu-top').css(`background-image`, `url(http://localhost/E-COMMERCE/images/x.png)`);
}

function closeMobileMenu() {
    $("#top-small-device-nav").css("height", "0px");
    $('.menu-top').css(`background-image`, `url(http://localhost/E-COMMERCE/images/menu.png)`);
}

$(".menu-cart-button").click(function() {
    displayCartContainer();
    
    return false;
});

$("#close-cart-button").click(function() {
    displayCartContainer();
    
    return false;
});

function displayCartContainer() {
    let cart = $(".cart-container");
    if(cart.css("display") == "flex")
        $(".cart-container").css("display","none");
    else
        $(".cart-container").css("display","flex");
}

$("#account-picture").click(function() {
    if($(this).parent().parent().find(".account-name").text() != "Log In/Sign In")
        $("#account-picture-container").css("opacity", "1");

    return false;
})

if($("#account-picture").parent().parent().find(".account-name").text() != "Log In/Sign In") {
    $("#account-more").css("display","flex")
}

$(".close-section").click(function() {
    $(this).parent().css("opacity","0")

    return false;
})

$(".account-name").click(function() {
    if($("#isRegistred").val() == "0")
        window.location.href = "http://localhost/E-COMMERCE/login-entities/login.php";
    else
        window.location.href = "http://localhost/E-COMMERCE/account.php";

    return false;
})

$("#account-more").click(function() {
    let display = $(".more-section").css("display");
    if(display == "none") {
        $("#account-picture-container").css("opacity", "0");
        $(".more-section").css("display","block");
    } else {
        $(".more-section").css("display","none");
    }
    return false;
})
