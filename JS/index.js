$(document).ready(function () {


	var jsonToSend = {
		"action" : "loadNResults"
	}

	$.ajax({
            url: "PHP/appLayer.php",
            type: "POST",
            data: jsonToSend,
            dataType: "json",
            contentType: "application/x-www-form-urlencoded",
            success: function(jsonResponse){
                var newHtml = "";
                for(i = 0; i < Math.min(10, jsonResponse.length); i++){
                	var email = jsonResponse[i].email;
                	var emailOwner = "<a href='mailto:" + email + "?Subject=Housing%20Question' target='_top'>" + jsonResponse[i].owner + "</a>";
                	var renta = (jsonResponse[i].renta === "Y") ? " For Rent " : "";
                	var venta = (jsonResponse[i].venta === "Y") ? " For Sell " : "";
                	newHtml+= "<table>" + "<tr>" + "<th>" +"<img src='Images/" + jsonResponse[i].imagen + "' width='200' height='110'/>" + "</th>" +
                   	"<td>" + jsonResponse[i].titulo + "<br>" + jsonResponse[i].direccion + "<br>" +
                   	jsonResponse[i].descripcion + "<br>" + venta + " " + renta + "<br>" +
                   	jsonResponse[i].property + "<br>" +
                   	jsonResponse[i].precio + "  Contact: " + emailOwner + "</td>" + "</tr>";
                }
                newHtml += "</table>";
                $("#resDiv").append(newHtml);
            },
            error: function(errorMessage){
                console.log("failed");

            }		
	});


	$("#btnListall").click(function(){
	$("#resDiv").html("");
	var jsonToSend = {
		"action" : "loadNResults"
	}

	$.ajax({
            url: "PHP/appLayer.php",
            type: "POST",
            data: jsonToSend,
            dataType: "json",
            contentType: "application/x-www-form-urlencoded",
            success: function(jsonResponse){
                var newHtml = "";
                for(i = 0; i < Math.min(10, jsonResponse.length); i++){
                	var email = jsonResponse[i].email;
                	var emailOwner = "<a href='mailto:" + email + "?Subject=Housing%20Question' target='_top'>" + jsonResponse[i].owner + "</a>";
                	var renta = (jsonResponse[i].renta === "Y") ? " For Rent " : "";
                	var venta = (jsonResponse[i].venta === "Y") ? " For Sell " : "";
                	newHtml+= "<table>" + "<tr>" + "<th>" +"<img src='Images/" + jsonResponse[i].imagen + "' width='200' height='110'/>" + "</th>" +
                   	"<td>" + jsonResponse[i].titulo + "<br>" + jsonResponse[i].direccion + "<br>" +
                   	jsonResponse[i].descripcion + "<br>" + venta + " " + renta + "<br>" +
                   	jsonResponse[i].property + "<br>" +
                   	jsonResponse[i].precio + "  Contact: " + emailOwner + "</td>" + "</tr>";
                }
                newHtml += "</table>";
                $("#resDiv").append(newHtml);
            },
            error: function(errorMessage){
                console.log("failed");

            }		
	});

	});


	$("#btnRefresh").click(function () {
		$("#resDiv").html("");
		var min = ($("#from").val())? $("#from").val() : -9223372036854775807;
		var max = ($("#to").val())? $("#to").val() : 9223372036854775807;
	   	var jsonToSend = {
			"action" : "refresh",
			"rent" : $("#rent").is(":checked"),
	        "sell" : $("#sell").is(":checked"),
	        "school" : $("#school").is(":checked"),
	        "market" : $("#market").is(":checked"),
	        "pool" : $("#pool").is(":checked"),
	        "from" : min,
	        "to" : max,
	        "ustate" : $('input[name=Estado]:checked').val(),
	        "house" : $("#house").is(":checked"),
	        "dept" : $("#dept").is(":checked")
		}

		$.ajax({
            url: "PHP/appLayer.php",
            type: "POST",
            data: jsonToSend,
            dataType: "json",
            contentType: "application/x-www-form-urlencoded",
            success: function(jsonResponse){
                var newHtml = "";
                for(i = 0; i < Math.min(10, jsonResponse.length); i++){
                	var email = jsonResponse[i].email;
                	var emailOwner = "<a href='mailto:" + email + "?Subject=Housing%20Question' target='_top'>" + jsonResponse[i].owner + "</a>";
                	var renta = (jsonResponse[i].renta === "Y") ? " For Rent " : "";
                	var venta = (jsonResponse[i].venta === "Y") ? " For Sell " : "";
                	newHtml+= "<table>" + "<tr>" + "<th>" +"<img src='Images/" + jsonResponse[i].imagen + "' width='200' height='110'/>" + "</th>" +
                   	"<td>" + jsonResponse[i].titulo + "<br>" + jsonResponse[i].direccion + "<br>" +
                   	jsonResponse[i].descripcion + "<br>" + venta + " " + renta + "<br>" +
                   	jsonResponse[i].property + "<br>" +
                   	jsonResponse[i].precio + " Contact: " + emailOwner + "</td>" + "</tr>";
                }
                newHtml += "</table>";
                $("#resDiv").append(newHtml);
            },
            error: function(errorMessage){
            	$("#resDiv").append("No matches found");
                console.log("failed");

            }		
		});
	});

    $("#btnSearch").click(function () {
        $("#resDiv").html("");
        var jsonToSend = {
            "action" : "search",
            "address" : $("#searchBar").val()
        }

        $.ajax({
            url: "PHP/appLayer.php",
            type: "POST",
            data: jsonToSend,
            dataType: "json",
            contentType: "application/x-www-form-urlencoded",
            success: function(jsonResponse){
                var newHtml = "";
                for(i = 0; i < Math.min(10, jsonResponse.length); i++){
                    var email = jsonResponse[i].email;
                    var emailOwner = "<a href='mailto:" + email + "?Subject=Housing%20Question' target='_top'>" + jsonResponse[i].owner + "</a>";
                    var renta = (jsonResponse[i].renta === "Y") ? " For Rent " : "";
                    var venta = (jsonResponse[i].venta === "Y") ? " For Sell " : "";
                    newHtml+= "<table>" + "<tr>" + "<th>" +"<img src='Images/" + jsonResponse[i].imagen + "' width='200' height='110'/>" + "</th>" +
                    "<td>" + jsonResponse[i].titulo + "<br>" + jsonResponse[i].direccion + "<br>" +
                    jsonResponse[i].descripcion + "<br>" + venta + " " + renta + "<br>" +
                    jsonResponse[i].property + "<br>" +
                    jsonResponse[i].precio + " Contact: " + emailOwner + "</td>" + "</tr>";
                }
                newHtml += "</table>";
                $("#resDiv").append(newHtml);
            },
            error: function(errorMessage){
                $("#resDiv").append("No matches found");
            }       
        });
    });

});