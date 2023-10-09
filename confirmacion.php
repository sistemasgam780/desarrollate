<?php

session_start();

error_reporting(E_ALL);
include 'php/conexion.php';
$conexion = conexion();

$edat = $_SESSION['user'];
$pros = $_SESSION['prospecto'];
$a = $_SESSION['apellido'];
$am = $_SESSION['amaterno'];
$t = $_SESSION['celular'];
$c =  $_SESSION['correo'];

$fec1 = date("Y-m-d h:i:s");

$fuente = $_SESSION['fuente']; 
$referido = $_SESSION['referido']; 
$resultado_llamada = $_SESSION['resultado_llamada']; 
$fecha_cita = $_SESSION['fecha_cita']; 
$hora_cita = $_SESSION['hora_cita']; 
$fecha_contacto = $_SESSION['fecha_contacto'];


$pertenece =  $_SESSION['pertenece'];



$sql = "insert into llenado_formulario(edat,nombre, a_paterno, a_materno, fechareg, celular, correo, fuente, referido, resul_llamada, fecha_cita, hora_cita, fecha_contacto) values('$edat','$pros', '$a', '$am','$fec1', '$t', '$c','$fuente','$referido','$resultado_llamada','$fecha_cita','$hora_cita','$fecha_contacto')";

    echo $result = mysqli_query($conexion, $sql);


$sql2 = "insert into duplicados(edat,nombre, a_paterno, a_materno, pertenece, fechareg) values('$edat','$pros', '$a', '$am', '$pertenece','$fec1')";

    echo $result2 = mysqli_query($conexion, $sql2);


    header("Location: edat.php");
exit;
 ?>