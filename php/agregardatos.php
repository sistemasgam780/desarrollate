<?php
session_start();
require_once "conexion.php";
$conexion = conexion();


$e = $_POST['edat'];
$fecha_contacto = $_POST['fecha_contacto'];
$nombre = $_POST['nombre'];
$apaterno = $_POST['apellido'];
$amaterno  = $_POST['amaterno'];


$n = str_replace('Ñ', 'N', $nombre);
$a = str_replace('Ñ', 'N', $apaterno);
$am = str_replace('Ñ', 'N', $amaterno);


$t = $_POST['telefono'];
$c = $_POST['correo'];
$fuente = $_POST['fuente'];
$referido = $_POST['referido'];
$resultado_llamada = $_POST['resultado_llamada'];
$fecha_cita = $_POST['fecha_cita'];
$hora_cita = $_POST['hora_cita'];
//$fecha_seg = $_POST['fecha_seg'];
date_default_timezone_set("America/Mexico_City");
$time = time();
$fec1 = date("Y-m-d h:i:s");
$fec2 = date("Y-m-d", $time);
$nuevafecha = strtotime('+1 month', strtotime($fec2));
$nuevafecha = date("Y-m-d", $nuevafecha);

$_SESSION['prospecto'] = $n;

$_SESSION['apellido'] = $a;
$_SESSION['amaterno'] = $am;

$_SESSION['celular'] = $t;
$_SESSION['correo'] = $c;
$_SESSION['fuente'] = $fuente;
$_SESSION['referido'] = $referido;
$_SESSION['resultado_llamada'] = $resultado_llamada;
$_SESSION['fecha_cita'] = $fecha_cita;
$_SESSION['fecha_contacto'] = $fecha_contacto;
$_SESSION['hora_cita'] = $hora_cita;


if (buscaRepetido($n,$a,$am,$t,$c, $conexion) == 1) {
  echo 2;
} else {

  if ($resultado_llamada == 'DAR SEGUIMIENTO') {
    $sql = "insert into llenado_formulario(edat,nombre, a_paterno, a_materno, fechareg, celular, correo, fuente, referido, resul_llamada, fecha_cita, hora_cita, fecha_seg, fecha_contacto) values('$e','$n','$a','$am', '$fec1', '$t', '$c','$fuente','$referido','$resultado_llamada','$fecha_cita','$hora_cita','$nuevafecha','$fecha_contacto')";

    echo $result = mysqli_query($conexion, $sql);
  } else {
    $sql = "insert into llenado_formulario(edat,nombre, a_paterno, a_materno, fechareg, celular, correo, fuente, referido, resul_llamada, fecha_cita, hora_cita, fecha_contacto) values('$e','$n', '$a', '$am','$fec1', '$t', '$c','$fuente','$referido','$resultado_llamada','$fecha_cita','$hora_cita','$fecha_contacto')";

    echo $result = mysqli_query($conexion, $sql);
  }
}



function buscaRepetido($n,$a,$am,$t,$c, $conexion)
{
  $sql1 = "select nombre, a_paterno, a_materno, celular,correo from llenado_formulario where nombre ='$n' AND a_paterno ='$a' AND a_materno = '$am'  ";
  $result1 = mysqli_query($conexion, $sql1);

  $sql12 = "select celular from llenado_formulario where celular ='$t' ";
  $result12 = mysqli_query($conexion, $sql12);


  $sql13 = "select correo from llenado_formulario where correo ='$c' ";
  $result13 = mysqli_query($conexion, $sql13);

  if (mysqli_num_rows($result1) > 0 || mysqli_num_rows($result12) > 0 || mysqli_num_rows($result13) > 0 ) {
    return 1;
  } else {
    return 0;
  }
}
