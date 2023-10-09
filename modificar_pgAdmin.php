<?php
error_reporting(E_ALL);

require_once "php/conexion.php";
$conexion = conexion();


$contactosPg = $_POST['contactosPg'];
$entrevistasPg = $_POST['entrevistasPg'];
$evaluacionesPg = $_POST['evaluacionesPg'];
$ventasPg = $_POST['ventasPg'];
$induccionesPg = $_POST['induccionesPg'];
$conexionesPg = $_POST['conexionesPg'];
date_default_timezone_set("America/Mexico_City");
$fecha_actual = date("Y-m-d h:i:s");


// Ejecuta la actualizacion del registro
$sqlUpd = "UPDATE ponderacion SET contacto = '$contactosPg', entrevista = '$entrevistasPg', evaluacion = '$evaluacionesPg', venta = '$ventasPg', induccion = '$induccionesPg', conexion = '$conexionesPg', fecha = '$fecha_actual'";
$result1 = mysqli_query($conexion, $sqlUpd);
echo "entro";
mysqli_close($conexion);
