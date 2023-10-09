
function showInp() {
    getSelectValue = document.getElementById("seleccion").value;
    if (getSelectValue == "1") {
        document.getElementById("mostrarIndividual").style.display = "none";
        document.getElementById("mostrarGeneral").style.display = "block";
    } else if (getSelectValue == "2") {
        document.getElementById("mostrarIndividual").style.display = "block";
        document.getElementById("mostrarGeneral").style.display = "none";
    }
}


function enviarGeneral() {
    var date1T = document.getElementById('fecha1G').value;
    var date2T = document.getElementById('fecha2G').value;

    var dataenT = 'fecha1G=' + date1T + '&fecha2G=' + date2T;

    $.ajax({
        type: 'POST',
        url: 'resultados_generales.php',
        data: dataenT,
        success: function (resp) {
            $('#respG').html(resp);
        }
    });
    return false;
}


function enviarIndividual() {
    var date1Ind = document.getElementById('fecha1Ind').value;
    var date2Ind = document.getElementById('fecha2Ind').value;
    var seleccionAgente = document.getElementById('seleccion2').value;

    var dataenInd = '&fecha1Ind=' + date1Ind + '&fecha2Ind=' + date2Ind + '&seleccion2=' + seleccionAgente;

    $.ajax({
        type: 'POST',
        url: 'resultados_individuales.php',
        data: dataenInd,
        success: function (resp) {
            $('#respInd').html(resp);
        }
    });
    return false;
}
