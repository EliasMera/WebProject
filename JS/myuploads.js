$(document).ready(function () {

	var jsonToSend = {
		"action" : "loadmyuploads"
	}

	$.ajax({
            url: "PHP/appLayer.php",
            type: "POST",
            data: jsonToSend,
            dataType: "json",
            contentType: "application/x-www-form-urlencoded",
            success: function(jsonResponse){
                console.log("wuu cargue cosas");
                var newHtml = "";
                for(i = 0; i < Math.min(10, jsonResponse.length); i++){
                	var renta = (jsonResponse[i].renta === "Y") ? " For Rent " : "";
                	var venta = (jsonResponse[i].venta === "Y") ? " For Sell " : "";
                    var escuelas = (jsonResponse[i].escuelas === "Y") ? " School Near " : "";
                    var mercado = (jsonResponse[i].mercado === "Y") ? " Market Near " : "";
                    var pool = (jsonResponse[i].pool === "Y") ? " Has a pool " : "";

                	newHtml+= "<table>" + "<tr>" + "<th>" +"<img src='Images/" + jsonResponse[i].imagen + "' width='200' height='150'/>" + "</th>" +
                   	"<td>" + jsonResponse[i].titulo + "<br>" + jsonResponse[i].direccion + "<br>" +
                   	jsonResponse[i].descripcion + "<br>" + venta + " " + renta + "<br>" +
                   	jsonResponse[i].property + "<br>" + "$" +
                   	jsonResponse[i].precio + " " + jsonResponse[i].owner +
                    escuelas + " " + mercado + " " + pool +
                    "<input  class='btnDelete' type='submit' value='Delete' dispName='"+ jsonResponse[i].imagen +"'/>" +
                     "</td>" + "</tr>";
                }
                newHtml += "</table>";
                $("#myUploads").append(newHtml);
            },
            error: function(errorMessage){
                $("#myUploads").append("No results found");
                console.log("failed");

            }		
	});

    $('#myUploads').on('click','.btnDelete', function() {

        var delList = $(this).attr("dispName");  
        console.log(delList);

        var jsonToSendF = {
            "action" : "delListing",
            "delList" : delList
        }
      

        $.ajax({
            url: "PHP/appLayer.php",
            type: "POST",
            dataType: "json",
            data: jsonToSendF,
            contentType: "application/x-www-form-urlencoded",
            success: function (data) {
                    alert("Listing deleted succesfully");
                    window.location.replace("myuploads.html");
            },
            error: function (errorMessage) {
                console.log("salio mal algo :v");
            }
        });
    });

});