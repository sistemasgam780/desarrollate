<?php

  require_once "conexion.php";
  $conexion = conexion();
  $id = $_POST['id'];
  $c = $_POST['caracter'];
  $s = $_POST['sentido'];
  $o = $_POST['orientacion'];
  $e = $_POST['energia'];
  $m = $_POST['motivacion'];
  $p = $_POST['perseverancia'];
  $v = $_POST['suma_vitales'];
  $fecha_evaluacion = $_POST['fecha_evaluacion'];

  date_default_timezone_set("America/Mexico_City");
            $time = time();
            $fec2 = date("Y-m-d",$time);

  $sql="UPDATE llenado_formulario SET caracter='$c',
                                      sentido='$s',
                                      logro='$o',
                                      energia='$e',
                                      motivacion='$m',
                                      perseverancia='$p',
                                      puntos='$v',
                                      fec2='$fec2',
                                      fecha_evaluacion='$fecha_evaluacion'
        WHERE id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
