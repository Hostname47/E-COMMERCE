$('#go-to-ftr').click(function(){
    // Here normally instead of 540 try to calculate height of header plus height of feature product container and add them to go directly to our-services container
    $('html, body').animate({scrollTop:540}, 'slow');
});

$("#user-subscribe-button").click(function() {
    $(".news_thank").css("display", "block");
    return false;
})
