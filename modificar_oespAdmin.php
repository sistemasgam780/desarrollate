<?php
error_reporting(E_ALL);

require_once "php/conexion.php";
$conexion = conexion();

$edat = $_POST['edat_obj'];
// DATOS RECOLECTADOS DE ALAN
$contactosA = $_POST['contactosA'];
$entrevistasA = $_POST['entrevistasA'];
$evaluacionesA = $_POST['evaluacionesA'];
$ventasA = $_POST['ventasA'];
$induccionesA = $_POST['induccionesA'];
$conexionesA = $_POST['conexionesA'];

// DATOS RECOLECTADOS DE NALLELY
$contactosN = $_POST['contactosN'];
$entrevistasN = $_POST['entrevistasN'];
$evaluacionesN = $_POST['evaluacionesN'];
$ventasN = $_POST['ventasN'];
$induccionesN = $_POST['induccionesN'];
$conexionesN = $_POST['conexionesN'];

// DATOS RECOLECTADOS DE PALOMA
$contactosP = $_POST['contactosP'];
$entrevistasP = $_POST['entrevistasP'];
$evaluacionesP = $_POST['evaluacionesP'];
$ventasP = $_POST['ventasP'];
$induccionesP = $_POST['induccionesP'];
$conexionesP = $_POST['conexionesP'];

// DATOS RECOLECTADOS DE YAZMIN
$contactosY = $_POST['contactosY'];
$entrevistasY = $_POST['entrevistasY'];
$evaluacionesY = $_POST['evaluacionesY'];
$ventasY = $_POST['ventasY'];
$induccionesY = $_POST['induccionesY'];
$conexionesY = $_POST['conexionesY'];

date_default_timezone_set("America/Mexico_City");
$fecha_actual = date("Y-m-d h:i:s");


// Ejecuta la actualizacion del registro

if ($edat == 'Alan Soto') {
    $sqlUpdA = "UPDATE metaa SET contacto = '$contactosA', entrevista = '$entrevistasA', evaluacion = '$evaluacionesA', venta = '$ventasA', induccion = '$induccionesA', conexion = '$conexionesA', fecha = '$fecha_actual' WHERE edat = '$edat'";
    $resultA = mysqli_query($conexion, $sqlUpdA);
    echo "ENTRO CONDICIÓN ALAN";
} else if ($edat == 'Nallely Quintana') {
    $sqlUpdA = "UPDATE metaa SET contacto = '$contactosN', entrevista = '$entrevistasN', evaluacion = '$evaluacionesN', venta = '$ventasN', induccion = '$induccionesN', conexion = '$conexionesN', fecha = '$fecha_actual' WHERE edat = '$edat'";
    $resultA = mysqli_query($conexion, $sqlUpdA);
    echo "ENTRO CONDICIÓN NALLELY";
} else if ($edat == 'Paloma Razo') {
    $sqlUpdA = "UPDATE metaa SET contacto = '$contactosP', entrevista = '$entrevistasP', evaluacion = '$evaluacionesP', venta = '$ventasP', induccion = '$induccionesP', conexion = '$conexionesP', fecha = '$fecha_actual' WHERE edat = '$edat'";
    $resultA = mysqli_query($conexion, $sqlUpdA);
    echo "ENTRO CONDICIÓN PALOMA";
} else {
    $sqlUpdA = "UPDATE metaa SET contacto = '$contactosY', entrevista = '$entrevistasY', evaluacion = '$evaluacionesY', venta = '$ventasY', induccion = '$induccionesY', conexion = '$conexionesY', fecha = '$fecha_actual' WHERE edat = '$edat'";
    $resultA = mysqli_query($conexion, $sqlUpdA);
    echo "ENTRO CONDICIÓN YAZMIN";
}

mysqli_close($conexion);
