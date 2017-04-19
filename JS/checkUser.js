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
                $("#myuploads").hide();
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

            if(jsonResp.fName != null){
                $("#logUser").html("Logged in as " + jsonResp.fName); 
                $("#logUser").show();
                console.log("sacda el nombreeeee");

                
            }
            else{
                $("#logUser").hide();

            }  

        },
        error: function(errorMessage){
            console.log(errorMsg.message);
        }
    });
});