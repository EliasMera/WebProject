$(document).ready(function () {
    $("#loginButton").click(function () {
        var remember = $("#rememberCheck").is(":checked");
        var rememberVal = (remember) ? 1 : 0;
        var jsonToSend = {
            "action": "login",
            "userName": $("#userID").val(),
            "userPassword": $("#userPass").val(),
            "rememberValue": rememberVal
        };
        $.ajax({
            url: "PHP/appLayer.php",
            type: "POST",
            data: jsonToSend,
            contentType: "application/x-www-form-urlencoded",
            success: function (jsonResponse) {
                if (jsonResponse.result == "ok")
                    window.location.replace("index.html");
                else{
                    alert(jsonResponse.responseText);
                }
            },
            error: function (errorMessage) {
                alert(errorMessage.responseText);
            }
        });
    });
});