
$("#categories-dropdownlist").change(function() {
    let content = $("#categories-dropdownlist>option:selected").text();
    let width = content.length * 16; /* *16 Because one character is 16px width */
    $("#categories-dropdownlist").css("width", width);
    console.log("pressed");
});