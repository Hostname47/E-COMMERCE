$('.mobile-menu-top').click(function() {
    let height = $("#top-mobile-nav").css("height");

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
    $("#top-mobile-nav").css("height", "auto");
    $("#top-mobile-nav").css("transition", "all 0.4s ease");

    $('.mobile-menu-top').css(`background-image`, `url(http://localhost/E-COMMERCE/images/x.png)`);
}

function closeMobileMenu() {
    $("#top-mobile-nav").css("height", "0px");

    $('.mobile-menu-top').css(`background-image`, `url(http://localhost/E-COMMERCE/images/menu.png)`);
}

$('#go-to-ftr').click(function(){
    $('html, body').animate({scrollTop:540}, 'slow');
});

