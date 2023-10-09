<?php

  require_once "conexion.php";
  $conexion = conexion();
  $id = $_POST['id'];
  $g = $_POST['gerente'];
  $r = $_POST['res_gdd'];
  $ra = $_POST['razon'];
  $p = $_POST['pp200'];
  $po = $_POST['pp200_observaciones'];
  $c = $_POST['comentarios_gdd'];
  $fecha_ventaCarrera = $_POST['fecha_ventaCarrera'];
  date_default_timezone_set("America/Mexico_City");
            $time = time();
            $fec1 = date("Y-m-d",$time);

  $sql="UPDATE llenado_formulario set gerente='$g',
                                      res_gdd='$r',
                                      razon='$ra',
                                      pp200='$p',
                                      pp200_observaciones='$po',
                                      comentarios_gdd='$c',
                                      fec3='$fec1',
                                      fecha_ventaCarrera='$fecha_ventaCarrera'
                                      where id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
