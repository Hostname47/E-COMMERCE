
$(".edit-setting-data").click(function() {
    let section = $(this).parent().parent().find(".setting-section");
    if(section.css("display") == "none") {
        $(".setting-section").css("display","none");
        section.css("display","block");
        console.log("collapse");
    }
    else {
        section.css("display","none");
        console.log("contract");
    }

    return false;
});

// Save fullname
$("#sv-account").click(function() {
    let firstname = $("#firstname").val();
    let lastname = $("#lastname").val();

    if(firstname == "") {
        $(".account-save-message").text("firstname is required !");
        $(".account-save-message").css("display", "block");
        $(".account-save-message").addClass("invalid-message");
    } else if(lastname == "") {
        $(".account-save-message").text("lastname is required !");
        $(".account-save-message").css("display", "block");
        $(".account-save-message").addClass("invalid-message");
    } else {
        let result = /^[a-zA-Z ]+$/.test(firstname);
        if(result) {
            result = /^[a-zA-Z ]+$/.test(lastname);
            if(!result) {
                $(".account-save-message").text("Error: Your lastname is invalid !");
                $(".account-save-message").css("display", "block");
                $(".account-save-message").addClass("invalid-message");
            }else {
                let id = $("#userid").val();
                // All data is correct: now we need to pass it to the api
                const xhr = new XMLHttpRequest();
                xhr.onload = () => {
                    // print JSON response
                    if (xhr.status >= 200 && xhr.status < 300) {
                        // parse JSON
                        const response = xhr.responseText;
                        console.log(response);
                    }
                };

                // create a JSON object
                const json = {
                    "userid":id,
                    "firstname": firstname,
                    "lastname": lastname
                };

                // open request
                xhr.open('POST', 'api/account/EditFullName.php');

                // set `Content-Type` header
                xhr.setRequestHeader('Content-Type', 'application/json');

                // send rquest with JSON payload
                xhr.send(JSON.stringify(json));


                $(".account-save-message").text("Your firstname and lastname has been changed successfully !");
                $(".account-save-message").addClass("correct-message");
                $(".account-save-message").removeClass("invalid-message");
            }
        } else {
            $(".account-save-message").text("Error: Your firstname is invalid !");
            $(".account-save-message").css("display", "block");
            $(".account-save-message").addClass("invalid-message");
        }
    }
    
    return false;
});

// Save username
$("#sv-username").click(function() {
    let username = $("#username").val();
    let firstname = $("#firstname").val();
    let lastname = $("#lastname").val();

    if(username == "") {
        $(".account-save-message").text("Username is required !");
        $(".account-save-message").css("display", "block");
        $(".account-save-message").addClass("invalid-message");
    }  else {
        let result = /^[a-zA-Z0-9_ ]+$/.test(username);
        if(result) {
            let id = $("#userid").val();
            // All data is correct: now we need to pass it to the api
            const xhr = new XMLHttpRequest();
            xhr.onload = () => {
                // print JSON response
                if (xhr.status >= 200 && xhr.status < 300) {
                    // parse JSON
                    const response = xhr.responseText;
                    console.log(response);
                }
            };

            // create a JSON object
            const json = {
                "userid":id,
                "firstname": firstname,
                "lastname": lastname,
                "username": username,
            };

            // open request
            xhr.open('POST', 'api/account/Edit.php');

            // set `Content-Type` header
            xhr.setRequestHeader('Content-Type', 'application/json');

            // send rquest with JSON payload
            xhr.send(JSON.stringify(json));

            $(".account-save-message").text("Username has been changed successfully ! You'll se the changes in the next connection");
            $(".account-save-message").addClass("correct-message");
            $(".account-save-message").removeClass("invalid-message");
        } else {
            $(".account-save-message").text("Error: The new username is invalid !");
            $(".account-save-message").css("display", "block");
            $(".account-save-message").addClass("invalid-message");
        }
    }
    
    return false;
});


$(".cancel-button").click(function() {
    $(this).parent().parent().find("input[type='text']").val("");
    $(".account-save-message").css("display", "none");
    $(this).parent().parent().parent().css("display","none");
    
    return false;
})

$("#see-psw").click(function() {
    if($(this).text() == "See your password") {
        $(this).parent().find(".psw").text($("#hidden-psw").val());
        $(this).text("Hide password");
    } else {
        $(this).parent().find(".psw").text("●".repeat($("#hidden-psw").val().length));
        $(this).text("See your password");
    }
    
    return false;
})

$(".psw").text("●".repeat($("#hidden-psw").val().length));
