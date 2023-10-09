<?php
error_reporting(E_ALL);
include 'php/conexion.php';
$conexion = conexion();
session_start();

// Horario fijo para el envio de correo
date_default_timezone_set('America/Mexico_City');
$correo = date('Y-m-d 18:30:00');
$fecha_actual = date('m-d-Y');

$query = "SELECT edat FROM llenado_formulario WHERE LEFT(fechareg, 10) = LEFT(now(),10) AND fechareg <= '$correo' GROUP BY edat";
$result = mysqli_query($conexion, $query);

$arrayExample = array(
    "Alan Soto",
    "Paloma Razo",
    "Yazmin Albarran",
    "Nallely Quintana"
);

while ($ver = mysqli_fetch_array($result)) {
    //unset elinara un valor del $arrayExample en cada clico, seleccionando gracias a su indice
    //array_search devuelve el numero de indice de lo que se esta buscando (en este caso ver[0])
    unset($arrayExample[array_search($ver[0], $arrayExample)]);
}


$destinatario = "m.galvan@asesoresgam.com.mx";
$asunto = "Desarrolla-T";

//Recorremos lo que queda de $arrayExample con el bucle
foreach ($arrayExample as $noRegistrados) {
    $tmp[] = $noRegistrados;
}

$cuerpo = "No hay registros de: " . implode(", ", $tmp);
$de.= 'From: Reportes' . "\r\n";
$de.= 'Bcc: sistemas@asesoresgam.com.mx' . "\r\n";
mail($destinatario, $asunto, $cuerpo, $de);
// echo "<h1>Correo enviado</h1>";
