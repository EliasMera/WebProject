$(document).ready(function(){
    //SESSION_START();
    var sess ;
    var jsonSession = {
        "action" : "checkSession"
    }

    $.ajax({
            url: "PHP/appLayer.php",
            type: "POST",
            data: jsonSession,
            dataType: "json",
            contentType: "application/x-www-form-urlencoded",
            success: function(jsonResponse){
                console.log("successs");
                sess = 1;
            },
            error: function(errorMessage){
                console.log("failed");
                //window.location.replace("Login.html")
                
                alert("Error please log in");
                window.location.replace("Login.html").delay(800);

            }

    });
    var jsonToSend = {
            "action" : "loadProfile"     
    }
         
    $.ajax ({
        url : "PHP/appLayer.php",
        type : "POST",
        data : jsonToSend,
        dataType : "json",
        contentType : "application/x-www-form-urlencoded",
        success : function(jsonResp){
            if(sess == 1){
                $("#userProfile").text(jsonResp.username);
                $("#profileFn").text(jsonResp.fName);
                $("#profileLn").text(jsonResp.lName);
                $("#profileEmail").text(jsonResp.email);
                $("#profileGender").text(jsonResp.gender);
                $("#profileState").text(jsonResp.state);
            }       
        },
        error: function(errorMessage){
            console.log(errorMsg.message);
        }
    });
});