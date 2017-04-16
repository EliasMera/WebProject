$(document).ready(function () {


	var jsonToSend = {
		"action" : "loadNResults",
		"num" : 10
	}

	$.ajax({
            url: "PHP/appLayer.php",
            type: "POST",
            data: jsonSession,
            dataType: "json",
            contentType: "application/x-www-form-urlencoded",
            success: function(jsonResponse){
                console.log("wuu cargue cosas");
                var newHtml = "";
                for(i = 0; i < jsonResponse.length; i++){
                   newHtml+= "<table>" + "<tr>" + "<th>" + jsonResponse[i].imagen + "</th>" +
                   "<td>" + jsonResponse[i].titulo + "<br>" + jsonResponse[i].direccion + "<br>" +
                   jsonResponse[i].descripcion + "<br>" + jsonResponse[i].venta + " " + jsonResponse[i].renta + "<br>" +
                   jsonResponse[i].property + "<br>" +
                   jsonResponse[i].precio + " " + jsonResponse[i].owner + "</td>" + "</tr>";
                }
                newHtml += "</table>";
                $("#resDiv").append(newHtml);
            },
            error: function(errorMessage){
                console.log("failed");

            }		
	});



$("#btnSearch").click(function () {
    //guarda los valores en el arreglo values de donde este checked el checkbox
    var values = $('input:checkbox:checked.check').map(function () {
        return this.value;
    }).get();    
  });

});