$(document).ready(function () {
    $("#registerButton").click(function () {
    	console.log("click");
        var fName = $("#userFName").val();
        var lName = $("#userLName").val();
        var email = $("#userEmail").val(); 
        var pwd = $("#userPassword").val();
        var state = $("#userState").val();
        var pwdConf = $("#userPasswordConfirmation").val();
        var username = $("#userName").val();
        var isMale = $("#genderMale").prop("checked");
        var gender;
        if(isMale)
            gender = "Male";
        else
            gender = "Female";
        if (fName === "" || lName === "" || email === "" || pwd === "" || pwdConf === "" || state == "x" || username == "")
            alert("Fields are missing");
        else if (pwd != pwdConf)
            alert("Passwords do not match");
        else{
            var jsonToSend = {
                "action": "registerUser",
                "fname": fName,
                "lname": lName,
                "username": username,
                "email": email,
                "passwrd": pwd,
                "gender": gender,
                "state": state
            }

            $.ajax({
                url: "PHP/appLayer.php",
                type: "POST",
                data: jsonToSend,
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                success: function(jsonResponse) {
                	console.log("ni modo");
                    alert("Account succesfully created.");
                    window.location.replace("index.html");
                },
                error: function(errorMessage) {
                    console.log("chales");
                    alert(errorMessage.responseText + "hola");
                }
            });
        }
    });
});