<?php

  require_once "conexion.php";
  
  $conexion = conexion();
 mysql_query("SET NAMES utf8");
  $id = $_POST['id'];
  $acudio = $_POST['acudio'];
  $edad = $_POST['edad'];
  $edo_civil = $_POST['edo_civil'];
  $direccion = $_POST['direccion'];
  $dependientes = $_POST['dependientes'];
  $ocupacion = $_POST['ocupacion'];
  $escolaridad = $_POST['escolaridad'];
  $carrera = $_POST['carrera'];
  $institucion = $_POST['institucion'];
  $ingreso = $_POST['ingreso'];
  $transporte = $_POST['transporte'];
  $tiempo = $_POST['tiempo'];
  $imagen = $_POST['imagen'];
  
  date_default_timezone_set("America/Mexico_City");
  $time = time();
  $fec1 = date("Y-m-d",$time);


  $sql="UPDATE llenado_formulario set acudio_entrevista='$acudio', edad='$edad', edo_civil='$edo_civil', direccion='$direccion', dependientes='$dependientes', ocupacion='$ocupacion', escolaridad='$escolaridad', carrera='$carrera', institucion='$institucion', ingreso='$ingreso', transporte='$transporte', t_disponible='$tiempo', imagen='$imagen', fec1='$fec1'
              where id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
