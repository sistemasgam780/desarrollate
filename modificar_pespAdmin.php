<?php
error_reporting(E_ALL);
require_once "php/conexion.php";
$conexion = conexion();

$edat = $_POST['edat_pon'];

// DATOS RECOLECTADOS DE ALAN
$contactosA_ponE = $_POST['contactosA_ponE'];
$entrevistasA_ponE = $_POST['entrevistasA_ponE'];
$evaluacionesA_ponE = $_POST['evaluacionesA_ponE'];
$ventasA_ponE = $_POST['ventasA_ponE'];
$induccionesA_ponE = $_POST['induccionesA_ponE'];
$conexionesA_ponE = $_POST['conexionesA_ponE'];

// DATOS RECOLECTADOS DE NALLELY
$contactosN_ponE = $_POST['contactosN_ponE'];
$entrevistasN_ponE = $_POST['entrevistasN_ponE'];
$evaluacionesN_ponE = $_POST['evaluacionesN_ponE'];
$ventasN_ponE = $_POST['ventasN_ponE'];
$induccionesN_ponE = $_POST['induccionesN_ponE'];
$conexionesN_ponE = $_POST['conexionesN_ponE'];

// DATOS RECOLECTADOS DE PALOMA
$contactosP_ponE = $_POST['contactosP_ponE'];
$entrevistasP_ponE = $_POST['entrevistasP_ponE'];
$evaluacionesP_ponE = $_POST['evaluacionesP_ponE'];
$ventasP_ponE = $_POST['ventasP_ponE'];
$induccionesP_ponE = $_POST['induccionesP_ponE'];
$conexionesP_ponE = $_POST['conexionesP_ponE'];

// DATOS RECOLECTADOS DE YAZMIN
$contactosY_ponE = $_POST['contactosY_ponE'];
$entrevistasY_ponE = $_POST['entrevistasY_ponE'];
$evaluacionesY_ponE = $_POST['evaluacionesY_ponE'];
$ventasY_ponE = $_POST['ventasY_ponE'];
$induccionesY_ponE = $_POST['induccionesY_ponE'];
$conexionesY_ponE = $_POST['conexionesY_ponE'];

date_default_timezone_set("America/Mexico_City");
$fecha_actual = date("Y-m-d h:i:s");


// Ejecuta la actualizacion del registro

if ($edat == 'Alan Soto') {
    $sqlUpdA = "UPDATE ponderacion SET contacto = '$contactosA_ponE', entrevista = '$entrevistasA_ponE', evaluacion = '$evaluacionesA_ponE', venta = '$ventasA_ponE', induccion = '$induccionesA_ponE', conexion = '$conexionesA_ponE', fecha = '$fecha_actual' WHERE edat = '$edat'";
    $resultA = mysqli_query($conexion, $sqlUpdA);
    echo "ENTRO CONDICIÓN ALAN";
} else if ($edat == 'Nallely Quintana') {
    $sqlUpdA = "UPDATE ponderacion SET contacto = '$contactosN_ponE', entrevista = '$entrevistasN_ponE', evaluacion = '$evaluacionesN_ponE', venta = '$ventasN_ponE', induccion = '$induccionesN_ponE', conexion = '$conexionesN_ponE', fecha = '$fecha_actual' WHERE edat = '$edat'";
    $resultA = mysqli_query($conexion, $sqlUpdA);
    echo "ENTRO CONDICIÓN NALLELY";
} else if ($edat == 'Paloma Razo') {
    $sqlUpdA = "UPDATE ponderacion SET contacto = '$contactosP_ponE', entrevista = '$entrevistasP_ponE', evaluacion = '$evaluacionesP_ponE', venta = '$ventasP_ponE', induccion = '$induccionesP_ponE', conexion = '$conexionesP_ponE', fecha = '$fecha_actual' WHERE edat = '$edat'";
    $resultA = mysqli_query($conexion, $sqlUpdA);
    echo "ENTRO CONDICIÓN PALOMA";
} else {
    $sqlUpdA = "UPDATE ponderacion SET contacto = '$contactosY_ponE', entrevista = '$entrevistasY_ponE', evaluacion = '$evaluacionesY_ponE', venta = '$ventasY_ponE', induccion = '$induccionesY_ponE', conexion = '$conexionesY_ponE', fecha = '$fecha_actual' WHERE edat = '$edat'";
    $resultA = mysqli_query($conexion, $sqlUpdA);
    echo "ENTRO CONDICIÓN YAZMIN";
}

mysqli_close($conexion);
