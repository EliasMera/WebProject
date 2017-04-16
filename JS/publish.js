var picture;

$(document).ready(function (e) {


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
                $("#logUser").html(jsonResp.fName);
            }       
        },
        error: function(errorMessage){
            console.log(errorMsg.message);
        }
    });

    $("#uploadimage").on('submit', (function (e) {
        e.preventDefault();
        $("#message").empty();
        $('#loading').show();
        $.ajax({
            url: "ajax_php_file.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,        // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                console.log("1 llamada");
                picture = data.result;
                var jsonSession = {
                    "action" : "updateEntry",
                    "picture" : picture,
                    "rent" : ($("#rent").is(":checked"))? "Y" : "N",
                    "sell" : ($("#sell").is(":checked"))? "Y" : "N",
                    "house" : ($("#house").is(":checked"))? "Y" : "N",
                    "dept" : ($("#dept").is(":checked"))? "Y" : "N",
                    "school" : ($("#school").is(":checked"))? "Y" : "N",
                    "market" : ($("#market").is(":checked"))? "Y" : "N",
                    "pool" : ($("#pool").is(":checked"))? "Y" : "N",
                    "price" : $("#price").val(),
                    "ustate" : $('input[name=Estado]:checked').val(),
                    "title" : $("#textBoxTitle").val(),
                    "direction" : $("#textBoxDirection").val(),
                    "description" : $("#textBoxDescription").val()

                }
                
                if($("#textBoxTitle").val() && $("#textBoxDirection").val() && $("#textBoxDescription").val()){
                $.ajax({
                    url: "PHP/appLayer.php",
                    type: "POST",
                    data: jsonSession,
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded",
                    success: function(data){
                        alert("ya se armo");
                        console.log("2 llamada");
                    },
                    error: function(errorMessage){
                        console.log("failed");
                    }
                });
                }
                else{
                    var jsonToSendF = {
                        "picture" : picture,
                        "action" : "delete"
                    }
                    $.ajax({
	                    url: "PHP/appLayer.php",
	                    type: "POST",
	                    data: jsonToSendF,
	                    dataType: "json",
	                    contentType: "application/x-www-form-urlencoded",
	                    success: function(data){
	                        alert("Error could not create listing");
	                        
	                    },
	                    error: function(errorMessage){
	                        console.log("failed");
	                    }
                	});                        
                }
            }
        });
    }));

    // Function to preview image after validation
    $(function () {
        $("#file").change(function () {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                $('#previewing').attr('src', 'noimage.png');
                $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                return false;
            }
            else {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    
    function imageIsLoaded(e) {
        $("#file").css("color", "green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    };
});