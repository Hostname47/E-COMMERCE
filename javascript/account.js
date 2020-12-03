
$(".edit-setting-data").click(function() {
    let section = $(this).parent().parent().find(".setting-section");
    if(section.css("display") == "none") {
        section.css("display","block");
        console.log("collapse");
    }
    else {
        section.css("display","none");
        console.log("contract");
    }

    return false;
});