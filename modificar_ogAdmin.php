<?php
error_reporting(E_ALL);

require_once "php/conexion.php";
$conexion = conexion();


$contactos = $_POST['contactos'];
$entrevistas = $_POST['entrevistas'];
$evaluaciones = $_POST['evaluaciones'];
$ventas = $_POST['ventas'];
$inducciones = $_POST['inducciones'];
$conexiones = $_POST['conexiones'];
date_default_timezone_set("America/Mexico_City");
$fecha_actual = date("Y-m-d h:i:s");


// Ejecuta la actualizacion del registro
$sqlUpd = "UPDATE metaa SET contacto = '$contactos', entrevista = '$entrevistas', evaluacion = '$evaluaciones', venta = '$ventas', induccion = '$inducciones', conexion = '$conexiones', fecha = '$fecha_actual'";
$result1 = mysqli_query($conexion, $sqlUpd);
mysqli_close($conexion);
