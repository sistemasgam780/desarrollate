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

  $sql="UPDATE llenado_formulario set caracter='$c',
                                      sentido='$s',
                                      logro='$o',
                                      energia='$e',
                                      motivacion='$m',
                                      perseverancia='$p',
                                      suma='$v'
              where id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
