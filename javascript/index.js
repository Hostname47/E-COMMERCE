$('.mobile-menu-top').click(function() {
    let right = $("#top-mobile-nav").css("right");

    if(right != "0px") {
        $("#top-mobile-nav").css("right", "0%");
        $('.mobile-menu-top').css(`background-image`, `url(http://localhost/E-COMMERCE/images/x.png)`);
    } else {
        $("#top-mobile-nav").css("right", "-100%");
        $('.mobile-menu-top').css(`background-image`, `url(http://localhost/E-COMMERCE/images/menu.png)`);
    }
});

$('.mobile-search-top').click(function() {
    let container = $(".search-mobile-container");

    if(container.css("display") == "none") {
        container.css("display", "block");
    } else {
        container.css("display", "none");
    }
});