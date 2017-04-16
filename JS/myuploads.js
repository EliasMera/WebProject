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

                	newHtml+= "<table>" + "<tr>" + "<th>" +"<img src='Images/" + jsonResponse[i].imagen + "' width='200' height='110'/>" + "</th>" +
                   	"<td>" + jsonResponse[i].titulo + "<br>" + jsonResponse[i].direccion + "<br>" +
                   	jsonResponse[i].descripcion + "<br>" + venta + " " + renta + "<br>" +
                   	jsonResponse[i].property + "<br>" +
                   	jsonResponse[i].precio + " " + jsonResponse[i].owner +
                    escuelas + " " + mercado + " " + pool +
                     "</td>" + "</tr>";
                }
                newHtml += "</table>";
                $("#myUploads").append(newHtml);
            },
            error: function(errorMessage){
                console.log("failed");

            }		
	});

});