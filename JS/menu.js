$(document).ready(function (e) {
	$("#menu li").click(function () {
        if($(this).text() == "Logout"){
            $.ajax({
                url: "PHP/appLayer.php",
                type: "POST",
                data: {"action": "logout"},
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",

                success: (jsonReply) => {
                    window.location.replace("login.html");
                    console.log("ya se armo");
                },
                error: (errorMessage) => {
                    console.log(errorMessage.result);
                    alert("error: " + errorMessage);
                }
            })
        }
        else if($(this).text() == "Publish")
        	window.location.replace("publish.php");
        else if($(this).text() == "Home")
            window.location.replace("index.html");
        else if($(this).text() == "My uploads")
            window.location.replace("myuploads.html");
        else
            window.location.replace($(this).text() + ".html");
    });	
});