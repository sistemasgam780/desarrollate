<?php

  require_once "conexion.php";
  $conexion = conexion();
  $id = $_POST['id'];
  $e = htmlentities($_POST['estatus']);  
  $a = $_POST['arranque'];
  $f = $_POST['fecha_induccion'];
  $d = $_POST['documentacion'];
  date_default_timezone_set("America/Mexico_City");
            $time = time();
            $fec1 = date("Y-m-d",$time);


  $sql="UPDATE llenado_formulario set estatus='$e',
                                      arranque='$a',
                                      fecha_induccion='$f',
                                      documentacion='$d',
                                      fec4='$fec1'
              where id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
