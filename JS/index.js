$(document).ready(function () {

$("#btnSearch").click(function () {
    //guarda los valores en el arreglo values de donde este checked el checkbox
    var values = $('input:checkbox:checked.check').map(function () {
        return this.value;
    }).get();    
  });
});