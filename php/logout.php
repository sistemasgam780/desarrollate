<?php
include 'conexion.php';
$conexion = conexion();
session_start();

	date_default_timezone_set('America/Mexico_City');
	$hoy = date("Y-m-d");
	$nomusuario = $_SESSION['user'];
	$fecha1 = $_COOKIE["tiempo"];
    $fecha2=date("H:i");
    $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
    $tiempoTotal = ( $tiempo / 60 ." Minutos");


     $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha)
            values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
            	$inserT = mysqli_query($conexion,$ti);





session_destroy();

header('Location: ../index.php');
?>