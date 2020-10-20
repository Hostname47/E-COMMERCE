
$("#categories-dropdownlist").change(function() {
    let content = [];
    content[0] = $("#categories-dropdownlist>option:selected").text();
    content[1] = "▾";

    let width = content[0].length * 16; /* *16 Because one character is 16px width */
    $("#categories-dropdownlist").css("width", width);
});