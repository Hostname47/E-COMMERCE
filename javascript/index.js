$('#go-to-ftr').click(function(){
    // Here normally instead of 540 try to calculate height of header plus height of feature product container and add them to go directly to our-services container
    $('html, body').animate({scrollTop:440}, 'slow');
});

$("#user-subscribe-button").click(function() {
    $(".news_thank").css("display", "block");
    return false;
})

$(".featured-item-paging").click(function() {
    $(".featured-item-paging").removeClass("featured-item-selected");
    $(this).addClass("featured-item-selected");
    return false;
})

let container = $(".paging-container").first();


let allPagingItems = container.children();
let numberOfPagingItems = allPagingItems.length;
let pagingCounter = 1;

const interval = setInterval(function() {
    if(pagingCounter == numberOfPagingItems) {
        pagingCounter = 0;
    }

    $(".featured-item-paging").removeClass("featured-item-selected");
    allPagingItems[pagingCounter].classList.add("featured-item-selected");

    pagingCounter++;
}, 4000);
