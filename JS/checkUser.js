$(document).ready(function(){
    var sess, html;
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
                $("#login").hide();
                $("#register").hide();
                sess = 1;
            },
            error: function(errorMessage){
                console.log("failed");
                $("#logout").hide();
                $("#profile").hide();
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
            $("#logUser").html(jsonResp.fName); 
            console.log("sacda el nombreeeee");
        },
        error: function(errorMessage){
            console.log(errorMsg.message);
        }
    });
});